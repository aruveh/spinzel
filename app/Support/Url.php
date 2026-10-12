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
     * Check if a category ends with "Platform" (by name or slug).
     *
     * Category examples:
     * - Research Platform (research-platform)
     * - Rewards Platform (rewards-platform)
     * - Survey Platform (survey-platform)
     *
     * @param array|string|null $category
     */
    public static function isPlatformCategory(mixed $category): bool
    {
        if (empty($category)) {
            return false;
        }

        if (is_string($category)) {
            $cat = trim($category);
            return (bool) preg_match('/Platform$/i', $cat)
                || (bool) preg_match('/-platform$/i', $cat)
                || stripos($cat, 'platform') !== false;
        }

        if (is_array($category)) {
            $name = trim((string) ($category['name'] ?? ''));
            $slug = trim((string) ($category['slug'] ?? ''));

            if ($name !== '') {
                if (preg_match('/Platform$/i', $name) || stripos($name, 'platform') !== false) {
                    return true;
                }
            }

            if ($slug !== '') {
                if (preg_match('/-platform$/i', $slug) || stripos($slug, 'platform') !== false) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Check if a post belongs to a category that ends with "Platform".
     */
    public static function isPlatformPost(array $post): bool
    {
        // Check categories array (e.g. single post endpoint)
        if (!empty($post['categories']) && is_array($post['categories'])) {
            foreach ($post['categories'] as $cat) {
                if (self::isPlatformCategory($cat)) {
                    return true;
                }
            }
        }

        // Check single category (e.g. listing endpoint)
        if (!empty($post['category'])) {
            if (self::isPlatformCategory($post['category'])) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get URL for a post.
     * If the post is in a category ending with "Platform",
     * the URL pattern is: APP_URL + '/reviews/' + post_slug + '-review/'
     * Otherwise: APP_URL + '/' + post_slug + '/'
     *
     * @param array $post Post data array
     * @param bool $absolute Whether to return absolute URL (including APP_URL) or relative path
     */
    public static function postUrl(array $post, bool $absolute = false): string
    {
        $rawSlug = (string) ($post['slug'] ?? '');
        $rawSlug = trim($rawSlug, '/');

        if (self::isPlatformPost($post)) {
            // Strip trailing -review if already present on rawSlug to prevent duplicate -review
            $postSlug = preg_replace('/-review$/i', '', $rawSlug);
            $path = '/reviews/' . $postSlug . '-review/';
        } else {
            $path = '/' . $rawSlug . '/';
        }

        if ($absolute) {
            return self::base() . $path;
        }

        return $path;
    }

    /**
     * Alias for postUrl(..., false)
     */
    public static function post(array $post): string
    {
        return self::postUrl($post, false);
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