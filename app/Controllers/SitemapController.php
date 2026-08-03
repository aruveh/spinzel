<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\SitemapService;

final class SitemapController
{
    private SitemapService $sitemapService;

    public function __construct()
    {
        $this->sitemapService = new SitemapService();
    }

    /**
     * Display or serve the XML sitemap.
     */
    public function index(): void
    {
        $cacheFile = __DIR__ . '/../../public/sitemap.xml';
        $cacheTtl = 3600; // 1 hour cache

        $xml = null;

        // Check if cached version is valid and force parameter ?refresh=1 is not passed
        if (
            empty($_GET['refresh']) &&
            file_exists($cacheFile) &&
            (time() - filemtime($cacheFile) < $cacheTtl)
        ) {
            $xml = file_get_contents($cacheFile);
        }

        if (empty($xml)) {
            $xml = $this->sitemapService->generateSitemapXml();

            // Save to public directory for static file serving
            @file_put_contents($cacheFile, $xml);
            @file_put_contents(__DIR__ . '/../../sitemap.xml', $xml);
        }

        header('Content-Type: application/xml; charset=utf-8');
        echo $xml;
        exit;
    }
}
