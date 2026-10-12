<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\PostRepository;
use App\Support\Url;

final class ReviewController
{
    private PostRepository $posts;

    private SlugController $slugController;

    public function __construct()
    {
        $this->posts = new PostRepository();
        $this->slugController = new SlugController();
    }

    /**
     * Handle review routes (/reviews/{slug})
     */
    public function show(string $slug): void
    {
        // 1. Try finding post with exact slug (e.g. inboxdollars-review or prizerebel-review or prizerebel)
        $postResponse = $this->posts->findBySlug($slug);

        // 2. If not found and slug ends with -review, try without -review (e.g. prizerebel-review -> prizerebel)
        if (($postResponse === null || empty($postResponse['data'])) && str_ends_with($slug, '-review')) {
            $baseSlug = substr($slug, 0, -7);
            $postResponse = $this->posts->findBySlug($baseSlug);
        }

        // 3. If found but NOT a platform post, check if alternate slug exists with platform category
        if ($postResponse !== null && !empty($postResponse['data']) && !Url::isPlatformPost($postResponse['data'])) {
            if (str_ends_with($slug, '-review')) {
                $baseSlug = substr($slug, 0, -7);
                $altResponse = $this->posts->findBySlug($baseSlug);
                if ($altResponse !== null && !empty($altResponse['data']) && Url::isPlatformPost($altResponse['data'])) {
                    $postResponse = $altResponse;
                }
            } else {
                $altResponse = $this->posts->findBySlug($slug . '-review');
                if ($altResponse !== null && !empty($altResponse['data']) && Url::isPlatformPost($altResponse['data'])) {
                    $postResponse = $altResponse;
                }
            }
        }

        // 4. If not found and slug does not end with -review, try with -review (e.g. inboxdollars -> inboxdollars-review)
        if (($postResponse === null || empty($postResponse['data'])) && !str_ends_with($slug, '-review')) {
            $postResponse = $this->posts->findBySlug($slug . '-review');
        }

        // If post does not exist, return 404
        if ($postResponse === null || empty($postResponse['data'])) {
            http_response_code(404);
            exit('404 Page Not Found');
        }

        $post = $postResponse['data'];

        // 5. Verify it belongs to a Platform category
        if (!Url::isPlatformPost($post)) {
            // Not a platform post -> redirect 301 to its standard URL
            header('Location: ' . Url::postUrl($post, true), true, 301);
            exit;
        }

        // 6. Ensure canonical review URL format: /reviews/{slug}-review/
        $canonicalPath = Url::postUrl($post, false);
        $currentPath = '/reviews/' . $slug . '/';
        if ($currentPath !== $canonicalPath) {
            header('Location: ' . Url::postUrl($post, true), true, 301);
            exit;
        }

        // 7. Render the post page using SlugController's renderPost
        $this->slugController->renderPost($post);
    }
}
