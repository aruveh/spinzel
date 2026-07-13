<?php

/**
 * Detect visitor country code.
 *
 * @return string|null ISO 3166-1 alpha-2 country code (e.g. US, IN)
 */
function getVisitorCountryCode(): ?string
{
    // Cloudflare
    if (!empty($_SERVER['HTTP_CF_IPCOUNTRY'])) {
        return strtoupper(trim($_SERVER['HTTP_CF_IPCOUNTRY']));
    }

    // Vercel
    if (!empty($_SERVER['HTTP_X_VERCEL_IP_COUNTRY'])) {
        return strtoupper(trim($_SERVER['HTTP_X_VERCEL_IP_COUNTRY']));
    }

    // Netlify
    if (!empty($_SERVER['HTTP_X_NF_GEO_COUNTRY'])) {
        return strtoupper(trim($_SERVER['HTTP_X_NF_GEO_COUNTRY']));
    }

    // Get client IP
    $headers = [
        'HTTP_CF_CONNECTING_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_CLIENT_IP',
        'REMOTE_ADDR',
    ];

    $ip = null;

    foreach ($headers as $header) {

        if (empty($_SERVER[$header])) {
            continue;
        }

        $candidate = trim(explode(',', $_SERVER[$header])[0]);

        if (filter_var($candidate, FILTER_VALIDATE_IP)) {
            $ip = $candidate;
            break;
        }
    }

    if ($ip === null) {
        return null;
    }

    // Localhost / private network (development)
    if (
        $ip === '127.0.0.1' ||
        $ip === '::1' ||
        str_starts_with($ip, '10.') ||
        str_starts_with($ip, '192.168.') ||
        str_starts_with($ip, '172.')
    ) {
        return 'IN'; // Change while testing
    }

    $url = 'https://ipwho.is/' . urlencode($ip);

    $context = stream_context_create([
        'http' => [
            'timeout' => 5,
        ],
    ]);

    $response = @file_get_contents($url, false, $context);

    if ($response === false) {
        return null;
    }

    $data = json_decode($response, true);

    if (
        !is_array($data) ||
        empty($data['country_code'])
    ) {
        return null;
    }

    return strtoupper($data['country_code']);
}