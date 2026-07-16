<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Helpers;

final class Country
{
    /**
     * Get visitor country.
     */
    public static function visitor(): ?string
    {
        // Local development (DDEV / localhost)
        if (
            defined('WP_DEBUG')
            && WP_DEBUG
        ) {
            return 'IN'; // Change to 'US' when testing US surveys
        }

        // Cloudflare
        if (! empty($_SERVER['HTTP_CF_IPCOUNTRY'])) {
            return strtoupper(
                sanitize_text_field(
                    wp_unslash($_SERVER['HTTP_CF_IPCOUNTRY'])
                )
            );
        }

        return self::detect();
    }

    /**
     * Compare visitor country.
     */
    public static function matches(
        string $country
    ): bool {
        $visitor = self::visitor();

        if ($visitor === null || $country === '') {
            return false;
        }

        return strtoupper($visitor) === strtoupper($country);
    }

    /**
     * Detect country from IP.
     */
    private static function detect(): ?string
    {
        $ip = self::ip();

        if ($ip === null) {
            return null;
        }

        $cacheKey = 'a9_country_' . md5($ip);

        $cached = get_transient($cacheKey);

        if ($cached !== false) {
            return (string) $cached;
        }

        $response = wp_remote_get(
            sprintf(
                'https://ipwho.is/%s',
                rawurlencode($ip)
            ),
            [
                'timeout' => 5,
            ]
        );

        if (is_wp_error($response)) {
            return null;
        }

        $body = json_decode(
            wp_remote_retrieve_body($response),
            true
        );

        if (
            ! is_array($body) ||
            empty($body['country_code'])
        ) {
            return null;
        }

        $country = strtoupper(
            (string) $body['country_code']
        );

        set_transient(
            $cacheKey,
            $country,
            DAY_IN_SECONDS
        );

        return $country;
    }

    /**
     * Get visitor IP.
     */
    private static function ip(): ?string
    {
        $keys = [
            'HTTP_CF_CONNECTING_IP',
            'HTTP_X_FORWARDED_FOR',
            'REMOTE_ADDR',
        ];

        foreach ($keys as $key) {

            if (empty($_SERVER[$key])) {
                continue;
            }

            $ip = trim(
                explode(
                    ',',
                    sanitize_text_field(
                        wp_unslash($_SERVER[$key])
                    )
                )[0]
            );

            if (
                filter_var(
                    $ip,
                    FILTER_VALIDATE_IP
                )
            ) {
                return $ip;
            }
        }

        return null;
    }
}