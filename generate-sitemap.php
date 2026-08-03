<?php

declare(strict_types=1);

use App\Services\SitemapService;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo "Generating sitemap.xml..." . PHP_EOL;

$sitemapService = new SitemapService();
$xml = $sitemapService->generateSitemapXml();

$publicPath = __DIR__ . '/public/sitemap.xml';
$rootPath = __DIR__ . '/sitemap.xml';

file_put_contents($publicPath, $xml);
file_put_contents($rootPath, $xml);

echo "Successfully generated sitemap.xml!" . PHP_EOL;
echo "Public file: " . $publicPath . PHP_EOL;
echo "Root file:   " . $rootPath . PHP_EOL;
