<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\SearchRepository;

final class SearchController
{
    private SearchRepository $search;

    public function __construct()
    {
        $this->search = new SearchRepository();
    }

    public function index(): void
    {
        $filters = [];

        if (!empty($_GET['q'])) {
            $filters['q'] = trim($_GET['q']);
        }

        if (!empty($_GET['type'])) {
            $filters['type'] = trim($_GET['type']);
        }

        if (!empty($_GET['page'])) {
            $filters['page'] = (int) $_GET['page'];
        }

        if (!empty($_GET['per_page'])) {
            $filters['per_page'] = (int) $_GET['per_page'];
        }

        /*
        |--------------------------------------------------------------------------
        | SEO
        |--------------------------------------------------------------------------
        */

        $pageTitle = $seo['title'] ?? '';

        $pageDescription = $seo['description'] ?? '';

        $pageKeywords = $seo['keywords'] ?? '';

        $response = $this->search->search($filters);

        $posts = $response['data'];

        $pagination = $response['meta']['pagination'];

        require __DIR__ . '/../Views/blogs/list.php';
    }
}