<?php

declare(strict_types=1);

namespace App\Core;
namespace App\Controllers;

use App\Repositories\PageRepository;
use App\Repositories\PostRepository;
use App\Repositories\NavigationRepository;
use App\Repositories\CategoryRepository;

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

            $pageTitle = !empty($page['seo']['title']) ? $page['seo']['title'] : (!empty($page['title']) ? $page['title'] . ' - Spinzel' : 'Spinzel');
            $pageDescription = !empty($page['seo']['description']) ? $page['seo']['description'] : (!empty($page['excerpt']) ? strip_tags((string) $page['excerpt']) : '');

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
            $currentCategory = $postResponse['data']['categories'][0]['slug'] ?? 'blogs';
            $recentResponse = $this->posts->all([
                'per_page' => 5,
                'category' => 'blogs',
            ]);
            $similarPosts = $this->posts->all([
                'category' => $currentCategory,
                'per_page' => 3,
                'order' => 'DESC'
            ]);
            $categoryRepository = new CategoryRepository();
            $categoriesResponse = $categoryRepository->all([
                'per_page' => 5,
            ]);

            $post = $postResponse['data'];
            $recentPosts = $recentResponse['data'] ?? [];
            $similarPosts = $similarPosts['data'] ?? [];

            $categories = $categoriesResponse['data'] ?? [];

            $pageTitle = !empty($post['seo']['title']) ? $post['seo']['title'] : (!empty($post['title']) ? $post['title'] . ' - Spinzel' : 'Spinzel');
            $pageDescription = !empty($post['seo']['description']) ? $post['seo']['description'] : (!empty($post['excerpt']) ? strip_tags((string) $post['excerpt']) : '');

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