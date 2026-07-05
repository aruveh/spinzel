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

        $page = $response['data'];

        require __DIR__ . '/../Views/pages/show.php';
    }
}