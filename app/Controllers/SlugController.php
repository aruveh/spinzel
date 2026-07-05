<?php

declare(strict_types=1);

namespace App\Core;
namespace App\Controllers;

use App\Repositories\PageRepository;
use App\Repositories\PostRepository;
use App\Repositories\NavigationRepository;

final class SlugController
{
    private PageRepository $pages;

    private PostRepository $posts;

    public function __construct()
    {
        $this->pages = new PageRepository();
        $this->posts = new PostRepository();
    }

    /**
     * Handle every frontend slug.
     *
     * Order:
     *
     * 1. CMS Page
     * 2. Blog Post
     * 3. 404
     */
    public function show(string $slug): void
    {

        /*
        |--------------------------------------------------------------------------
        | SEO
        |--------------------------------------------------------------------------
        */

        $pageTitle = $seo['title'] ?? '';

        $pageDescription = $seo['description'] ?? '';

        $pageKeywords = $seo['keywords'] ?? '';
        
        /*
        |--------------------------------------------------------------------------
        | Navigation
        |--------------------------------------------------------------------------
        */

        $navigationRepository = new NavigationRepository();

        $navigation = [];

        $primary = $navigationRepository->location('primary');

        if ($primary !== null) {
            $navigation['primary'] = $primary;
        }

        /**
         * ----------------------------------------
         * Try CMS Page
         * ----------------------------------------
         */

        $pageResponse = $this->pages->findBySlug($slug);

        if ($pageResponse !== null) {

            $page = $pageResponse['data'];

            require __DIR__ . '/../Views/pages/show.php';

            return;
        }

        /**
         * ----------------------------------------
         * Try Blog
         * ----------------------------------------
         */

        $postResponse = $this->posts->findBySlug($slug);

        if ($postResponse !== null) {

            $post = $postResponse['data'];

            require __DIR__ . '/../Views/blogs/show.php';

            return;
        }

        /**
         * ----------------------------------------
         * Nothing Found
         * ----------------------------------------
         */

        http_response_code(404);

        exit('404 Page Not Found');
    }
}