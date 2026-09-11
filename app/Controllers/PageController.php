<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\PageRepository;

final class PageController
{
    private PageRepository $pages;

    public function __construct()
    {
        $this->pages = new PageRepository();
    }

    public function show(string $slug): void
    {
        $response = $this->pages->findBySlug($slug);

        if (empty($response['data'])) {
            http_response_code(404);
            exit('Page not found.');
        }

        $page = $response['data'];

        $pageTitle = !empty($page['seo']['title']) ? $page['seo']['title'] : (!empty($page['title']) ? $page['title'] . ' - Spinzel' : 'Spinzel');
        $pageDescription = !empty($page['seo']['description']) ? $page['seo']['description'] : (!empty($page['excerpt']) ? strip_tags((string) $page['excerpt']) : '');

        require __DIR__ . '/../Views/pages/show.php';
    }
}