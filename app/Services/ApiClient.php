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
     * GET Request
     */
    public function get(
        string $endpoint,
        array $query = [],
        array $headers = []
    ): ?array {

        $url = $this->baseUrl
            . '/'
            . ltrim($endpoint, '/');

        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        return $this->execute(
            'GET',
            $url,
            [],
            $headers
        );
    }

    /**
     * POST Request
     */
    public function post(
        string $endpoint,
        array $body = [],
        array $headers = []
    ): ?array {

        $url = $this->baseUrl
            . '/'
            . ltrim($endpoint, '/');

        return $this->execute(
            'POST',
            $url,
            $body,
            $headers
        );
    }

    /**
     * PUT Request
     */
    public function put(
        string $endpoint,
        array $body = [],
        array $headers = []
    ): ?array {

        $url = $this->baseUrl
            . '/'
            . ltrim($endpoint, '/');

        return $this->execute(
            'PUT',
            $url,
            $body,
            $headers
        );
    }

    /**
     * DELETE Request
     */
    public function delete(
        string $endpoint,
        array $headers = []
    ): ?array {

        $url = $this->baseUrl
            . '/'
            . ltrim($endpoint, '/');

        return $this->execute(
            'DELETE',
            $url,
            [],
            $headers
        );
    }

    /**
     * Execute Request
     */
    private function execute(
        string $method,
        string $url,
        array $body = [],
        array $headers = []
    ): ?array {

        $ch = curl_init($url);

        if ($ch === false) {
            throw new Exception(
                'Unable to initialize cURL.'
            );
        }

        $httpHeaders = [
            'Accept: application/json',
        ];

        if ($method === 'POST' || $method === 'PUT' || $method === 'DELETE') {

            $httpHeaders[] = 'Content-Type: application/json';

            if (!empty($body)) {
                curl_setopt(
                    $ch,
                    CURLOPT_POSTFIELDS,
                    json_encode($body)
                );
            }
        }

        foreach ($headers as $key => $value) {
            $httpHeaders[] = $key . ': ' . $value;
        }

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $httpHeaders,
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

        if ($status === 404) {
            return null;
        }

        /**
         * Decode JSON Response
         */
        $json = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception(
                'JSON Error: ' . json_last_error_msg()
            );
        }
        if (!is_array($json)) {
            throw new Exception('Invalid JSON response.');
        }

        /**
         * Client Error (4xx)
         *
         * Return API response so controllers
         * can display validation messages.
         */
        if ($status >= 400 && $status < 500) {
            return $json;
        }
        /**
        * Server Error (5xx)
        */
        if ($status >= 500) {
            throw new Exception(
                'HTTP Error ' . $status
            );
        }

        return $json;
    }
}
