<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Services\ApiClient;

final class PostRepository
{
    private ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    /**
     * Blog Listing
     */
    public function all(array $filters = []): ?array
    {
        return $this->api->get(
            '/posts',
            $filters
        );
    }

    /**
     * Blog by ID
     */
    public function find(int $id): ?array
    {
        return $this->api->get(
            '/posts/' . $id
        );
    }

    /**
     * Blog by Slug
     */
    public function findBySlug(string $slug): ?array
    {
        return $this->api->get(
            '/posts/' . $slug
        );
    }
}