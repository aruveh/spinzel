<?php

declare(strict_types=1);

namespace App\Services;

use App\Support\Config;
use Exception;

final class ApiClient
{
    private string $baseUrl;

    private int $timeout;

    public function __construct()
    {
        $this->baseUrl = rtrim(
            (string) Config::get('api.base_url'),
            '/'
        );

        $this->timeout = (int) Config::get(
            'api.timeout',
            30
        );
    }

    /**
     * Perform a GET request.
     *
     * Returns:
     *  - array : Success response
     *  - null  : HTTP 404
     *
     * Throws:
     *  - Exception : Network/Server/JSON errors
     */
    public function get(
        string $endpoint,
        array $query = []
    ): ?array {

        $url = $this->baseUrl
            . '/'
            . ltrim($endpoint, '/');

        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        $ch = curl_init($url);

        if ($ch === false) {
            throw new Exception(
                'Unable to initialize cURL.'
            );
        }

        curl_setopt_array($ch, [

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_FOLLOWLOCATION => true,

            CURLOPT_TIMEOUT => $this->timeout,

            CURLOPT_CONNECTTIMEOUT => 10,

            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
            ],

            /**
             * Local development.
             *
             * Remove these in production if
             * SSL certificates are valid.
             */
            CURLOPT_SSL_VERIFYPEER => false,

            CURLOPT_SSL_VERIFYHOST => false,

        ]);

        $response = curl_exec($ch);

        if ($response === false) {

            throw new Exception(
                curl_error($ch)
            );

        }

        $status = (int) curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );

        /**
         * PHP 8+
         *
         * curl_close() is unnecessary.
         */

        /**
         * Resource not found.
         */
        if ($status === 404) {

            return null;

        }

        /**
         * HTTP Error
         */
        if ($status < 200 || $status >= 300) {

            throw new Exception(
                'HTTP Error ' . $status
            );

        }

        $json = json_decode(
            $response,
            true
        );

        if (
            json_last_error() !== JSON_ERROR_NONE
        ) {

            throw new Exception(
                'JSON Error: '
                . json_last_error_msg()
            );

        }

        if (!is_array($json)) {

            throw new Exception(
                'Invalid JSON response.'
            );

        }

        if (
            isset($json['success']) &&
            $json['success'] === false
        ) {

            throw new Exception(
                $json['message']
                ?? 'API request failed.'
            );

        }

        return $json;
    }
}