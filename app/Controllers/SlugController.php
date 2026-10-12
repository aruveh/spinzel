<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\PageRepository;
use App\Repositories\PostRepository;
use App\Repositories\NavigationRepository;
use App\Repositories\CategoryRepository;
use App\Support\Url;

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
     * 2. Blog Post (redirects to /reviews/{slug}-review/ if in a Platform category)
     * 3. 404
     */
    public function show(string $slug): void
    {
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
            $pageKeywords = '';

            require __DIR__ . '/../Views/pages/show.php';

            return;
        }

        /**
         * ----------------------------------------
         * Try Blog Post
         * ----------------------------------------
         */

        $postResponse = $this->posts->findBySlug($slug);

        // If not found and slug ends with -review, try base slug
        if ($postResponse === null && str_ends_with($slug, '-review')) {
            $baseSlug = substr($slug, 0, -7);
            $postResponse = $this->posts->findBySlug($baseSlug);
        }

        if ($postResponse !== null) {
            $post = $postResponse['data'];

            // If this post belongs to a category ending with "Platform", redirect 301 to the review URL
            if (Url::isPlatformPost($post)) {
                header('Location: ' . Url::postUrl($post, true), true, 301);
                exit;
            }

            // If not a platform post and slug doesn't end with -review, check if a -review version exists in a Platform category
            if (!str_ends_with($slug, '-review')) {
                $platformCandidate = $this->posts->findBySlug($slug . '-review');
                if ($platformCandidate !== null && Url::isPlatformPost($platformCandidate['data'])) {
                    header('Location: ' . Url::postUrl($platformCandidate['data'], true), true, 301);
                    exit;
                }
            }

            $this->renderPost($post);

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

    /**
     * Render a blog or review post.
     */
    public function renderPost(array $post): void
    {
        $currentCategory = $post['categories'][0]['slug'] ?? 'blogs';
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

        $recentPosts = $recentResponse['data'] ?? [];
        $similarPosts = $similarPosts['data'] ?? [];
        $categories = $categoriesResponse['data'] ?? [];

        $pageTitle = !empty($post['seo']['title']) ? $post['seo']['title'] : (!empty($post['title']) ? $post['title'] . ' - Spinzel' : 'Spinzel');
        $pageDescription = !empty($post['seo']['description']) ? $post['seo']['description'] : (!empty($post['excerpt']) ? strip_tags((string) $post['excerpt']) : '');
        $pageKeywords = '';
        $pageCanonical = Url::postUrl($post, true);

        $navigationRepository = new NavigationRepository();
        $navigation = [];
        $primary = $navigationRepository->location('primary');

        if ($primary !== null) {
            $navigation['primary'] = $primary;
        }

        require __DIR__ . '/../Views/blogs/show.php';
    }
}