<?php

declare(strict_types=1);

namespace App\Support;

final class Url
{
    /**
     * Frontend Base URL
     */
    public static function base(): string
    {
        return rtrim(
            $_ENV['APP_URL'] ?? '',
            '/'
        );
    }

    /**
     * Convert API URL
     * to Frontend URL
     *
     * Example:
     *
     * https://www.spinzel.com/about/
     *
     * becomes
     *
     * /about
     */
    public static function frontend(string $url): string
    {
        $path = parse_url(
            $url,
            PHP_URL_PATH
        );

        if (!$path) {
            return '/';
        }

        $path = rtrim($path, '/');

        return $path === ''
            ? '/'
            : $path;
    }

    /**
     * Asset URL
     */
    public static function asset(string $path): string
    {
        return '/assets/' . ltrim($path, '/');
    }

    /**
     * Current URL
     */
    public static function current(): string
    {
        return parse_url(
            $_SERVER['REQUEST_URI'],
            PHP_URL_PATH
        );
    }

    /**
     * Is Current URL?
     */
    public static function is(string $path): bool
    {
        return self::current() === $path;
    }
}