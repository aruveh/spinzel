<?php

declare(strict_types=1);

namespace App\Services;

use App\Support\Url;

final class SitemapService
{
    private ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    /**
     * Fetch all items from API endpoint with pagination handling.
     */
    private function fetchAll(string $endpoint): array
    {
        $items = [];
        $page = 1;

        do {
            $response = $this->api->get($endpoint, [
                'per_page' => 100,
                'page' => $page,
            ]);

            if (empty($response['success']) || empty($response['data']) || !is_array($response['data'])) {
                break;
            }

            $items = array_merge($items, $response['data']);
            $totalPages = (int) ($response['meta']['pagination']['total_pages'] ?? 1);
            $page++;
        } while ($page <= $totalPages);

        return $items;
    }

    /**
     * Generate complete XML sitemap content.
     */
    public function generateSitemapXml(): string
    {
        $baseUrl = Url::base();
        if (empty($baseUrl)) {
            $baseUrl = 'https://www.spinzel.com';
        }

        $pages = $this->fetchAll('/pages');
        $posts = $this->fetchAll('/posts');
        $categories = $this->fetchAll('/categories');

        $urls = [];
        $addedLocs = [];

        $addUrl = function (string $loc, ?string $lastmod = null, string $changefreq = 'weekly', string $priority = '0.8') use (&$urls, &$addedLocs): void {
            $normalizedLoc = rtrim($loc, '/') . '/';
            if (isset($addedLocs[$normalizedLoc])) {
                return;
            }
            $addedLocs[$normalizedLoc] = true;

            $item = [
                'loc' => $normalizedLoc,
                'changefreq' => $changefreq,
                'priority' => $priority,
            ];

            if ($lastmod !== null && trim($lastmod) !== '') {
                $timestamp = strtotime($lastmod);
                if ($timestamp !== false) {
                    $item['lastmod'] = date('c', $timestamp);
                }
            }

            $urls[] = $item;
        };

        // 1. Homepage
        $addUrl($baseUrl . '/', date('c'), 'daily', '1.0');

        // 2. Static Listing Routes
        $addUrl($baseUrl . '/blogs', date('c'), 'daily', '0.9');
        $addUrl($baseUrl . '/categories', date('c'), 'weekly', '0.8');

        // 3. Pages
        foreach ($pages as $page) {
            $slug = $page['slug'] ?? '';
            if (empty($slug)) {
                continue;
            }

            // Skip homepage slug as it's already added at root '/'
            if ($slug === 'home') {
                continue;
            }

            $loc = $baseUrl . '/' . trim($slug, '/');
            $lastmod = $page['modified'] ?? $page['date'] ?? null;
            $addUrl($loc, $lastmod, 'weekly', '0.8');
        }

        // 4. Categories
        foreach ($categories as $category) {
            $slug = $category['slug'] ?? '';
            if (empty($slug)) {
                continue;
            }

            $loc = $baseUrl . '/' . trim($slug, '/');
            $addUrl($loc, null, 'weekly', '0.7');
        }

        // 5. Posts
        foreach ($posts as $post) {
            $slug = $post['slug'] ?? '';
            if (empty($slug)) {
                continue;
            }

            $loc = $baseUrl . '/' . trim($slug, '/');
            $lastmod = $post['published']['datetime'] ?? null;
            $addUrl($loc, $lastmod, 'weekly', '0.7');
        }

        // Build XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $entry) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($entry['loc'], ENT_XML1, 'UTF-8') . '</loc>' . "\n";
            if (!empty($entry['lastmod'])) {
                $xml .= '    <lastmod>' . htmlspecialchars($entry['lastmod'], ENT_XML1, 'UTF-8') . '</lastmod>' . "\n";
            }
            $xml .= '    <changefreq>' . htmlspecialchars($entry['changefreq'], ENT_XML1, 'UTF-8') . '</changefreq>' . "\n";
            $xml .= '    <priority>' . htmlspecialchars($entry['priority'], ENT_XML1, 'UTF-8') . '</priority>' . "\n";
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }
}
