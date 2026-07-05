<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Services\ApiClient;

final class PageRepository
{
    private ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    /**
     * Home Page
     */
    public function home(): ?array
    {
        return $this->api->get(
            '/pages/home'
        );
    }

    /**
     * Page by Slug
     */
    public function findBySlug(string $slug): ?array
    {
        return $this->api->get(
            '/pages/' . $slug
        );
    }
}