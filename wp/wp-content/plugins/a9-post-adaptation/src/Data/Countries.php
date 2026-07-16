<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Data;

final class Countries
{
    /**
     * Cached countries.
     *
     * @var array<string, array<string, mixed>>|null
     */
    private static ?array $countries = null;

    /**
     * Load countries from JSON.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        if (self::$countries !== null) {
            return self::$countries;
        }

        $file = A9_POST_ADAPTATION_PATH . 'country-list.json';

        if (! file_exists($file)) {
            self::$countries = [];

            return self::$countries;
        }

        $json = file_get_contents($file);

        if ($json === false) {
            self::$countries = [];

            return self::$countries;
        }

        $countries = json_decode($json, true);

        if (! is_array($countries)) {
            self::$countries = [];

            return self::$countries;
        }

        self::$countries = [];

        foreach ($countries as $country) {

            if (! isset($country['cca2'])) {
                continue;
            }

            self::$countries[$country['cca2']] = $country;
        }

        ksort(self::$countries);

        return self::$countries;
    }

    /**
     * Return dropdown options.
     *
     * Example:
     * [
     *     ''   => 'Select Country',
     *     'US' => 'United States',
     *     'GB' => 'United Kingdom',
     * ]
     *
     * @return array<string,string>
     */
    public static function options(): array
    {
        $countries = [];

        foreach (self::all() as $code => $country) {
            $countries[$code] = $country['name']['common'] ?? $code;
        }

        asort($countries);

        return [
            '' => __('Select Country', 'a9-post-adaptation'),
            ...$countries,
        ];
    }

    /**
     * Find a country by ISO-2 code.
     *
     * @return array<string,mixed>|null
     */
    public static function find(string $code): ?array
    {
        $countries = self::all();

        return $countries[strtoupper($code)] ?? null;
    }

    /**
     * Common country name.
     */
    public static function name(string $code): string
    {
        return self::find($code)['name']['common'] ?? '';
    }

    /**
     * Official country name.
     */
    public static function official(string $code): string
    {
        return self::find($code)['name']['official'] ?? '';
    }

    /**
     * Short country code for frontend display.
     *
     * Examples:
     * US → USA
     * GB → UK
     * IN → IND
     */
    public static function short(string $code): string
    {
        return match (strtoupper($code)) {
            'GB' => 'UK',
            default => self::cca3($code),
        };
    }

    /**
     * Emoji flag.
     */
    public static function emoji(string $code): string
    {
        return self::find($code)['flag'] ?? '';
    }

    /**
     * SVG flag URL.
     */
    public static function flagSvg(string $code): string
    {
        return self::find($code)['flags']['svg'] ?? '';
    }

    /**
     * PNG flag.
     */
    public static function flagPng(string $code): string
    {
        return self::find($code)['flags']['png'] ?? '';
    }

    /**
     * Currency information.
     *
     * @return array<string,mixed>
     */
    public static function currency(string $code): array
    {
        $country = self::find($code);

        if (! isset($country['currencies'])) {
            return [];
        }

        $currency = reset($country['currencies']);

        return is_array($currency) ? $currency : [];
    }

    /**
     * Continent.
     */
    public static function continent(string $code): string
    {
        return self::find($code)['continents'][0] ?? '';
    }

    /**
     * Region.
     */
    public static function region(string $code): string
    {
        return self::find($code)['region'] ?? '';
    }

    /**
     * ISO-3 country code.
     *
     * Examples:
     * US → USA
     * IN → IND
     * AU → AUS
     */
    public static function cca3(string $code): string
    {
        return self::find($code)['cca3'] ?? strtoupper($code);
    }
}