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
        $url = $_ENV['APP_URL'] ?? $_SERVER['APP_URL'] ?? getenv('APP_URL') ?: Config::get('app.url');
        return rtrim((string) $url, '/');
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
     * /about/
     */
    public static function frontend(string $url): string
    {
        $path = parse_url(
            $url,
            PHP_URL_PATH
        );

        if (!$path || $path === '/') {
            return '/';
        }

        if (str_starts_with($path, '/category/')) {
            $path = '/' . substr($path, 10);
        } elseif (str_starts_with($path, '/tag/')) {
            $path = '/' . substr($path, 5);
        }

        if (preg_match('#\.[a-zA-Z0-9]+$#', $path)) {
            return $path;
        }

        return rtrim($path, '/') . '/';
    }

    /**
     * Clean HTML Content
     * Replaces WordPress category (/category/slug, /cateogry/slug) and tag (/tag/slug) links in HTML content with clean single-slash relative links (/slug/)
     */
    public static function cleanContent(string $html): string
    {
        if (trim($html) === '') {
            return $html;
        }

        // 1. Clean /category/, /cateogry/, /tag/ prefixes
        $html = preg_replace(
            '#href=(["\'])(?:https?://[^/\s"\']*)?/(?:category|cateogry|tag)/([^"\'?/\s\#]+)/?(\?[^"\'\s\#]*)?(\#[^"\'\s]*)?\1#i',
            'href=$1/$2/$3$4\1',
            $html
        ) ?? $html;

        // 2. Fix any double trailing slashes in href attributes (e.g. href="/market-research//")
        return preg_replace('#href=(["\'])(/[^"\'?\s\#]+)//+(?=["\'?\s\#])#i', 'href=$1$2/', $html) ?? $html;
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