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
        $xml = $this->sitemapService->generateSitemapXml();

        header('Content-Type: application/xml; charset=utf-8');
        echo $xml;
        exit;
    }
}
