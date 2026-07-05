<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\PostRepository;

final class BlogController extends Controller
{
    private PostRepository $posts;

    public function __construct()
    {
        $this->posts = new PostRepository();
    }

    /**
     * ---------------------------------------------------------
     * Blog Listing
     * ---------------------------------------------------------
     */
    public function index(): void
    {
        $filters = [];

        if (isset($_GET['page'])) {
            $filters['page'] = (int) $_GET['page'];
        }

        if (isset($_GET['per_page'])) {
            $filters['per_page'] = (int) $_GET['per_page'];
        }

        if (isset($_GET['search'])) {
            $filters['search'] = trim($_GET['search']);
        }

        if (isset($_GET['category'])) {
            $filters['category'] = trim($_GET['category']);
        }

        if (isset($_GET['author'])) {
            $filters['author'] = (int) $_GET['author'];
        }

        if (isset($_GET['orderby'])) {
            $filters['orderby'] = trim($_GET['orderby']);
        }

        if (isset($_GET['order'])) {
            $filters['order'] = strtoupper(trim($_GET['order']));
        }

        $response = $this->posts->all($filters);

        if (
            $response === null ||
            empty($response['data'])
        ) {
            http_response_code(404);

            exit('Posts not found.');
        }

        $posts = $response['data'];

        $pagination = $response['meta']['pagination'] ?? [];

        $this->render(
            'blogs/list',
            [
                'posts'      => $posts,
                'pagination' => $pagination,
            ],
            [
                'title'       => 'Blogs',
                'description' => 'Browse the latest blog articles.',
                'keywords'    => 'blogs',
            ]
        );
    }

    /**
     * ---------------------------------------------------------
     * Blog Details
     * ---------------------------------------------------------
     */
    public function show(string $slug): void
    {
        $response = $this->posts->findBySlug($slug);

        if (
            $response === null ||
            empty($response['data'])
        ) {
            http_response_code(404);

            exit('Post not found.');
        }

        $post = $response['data'];

        $this->render(
            'blogs/show',
            [
                'post' => $post,
            ],
            [
                'title'       => $post['title'] ?? '',
                'description' => $post['excerpt'] ?? '',
                'keywords'    => '',
            ]
        );
    }
}