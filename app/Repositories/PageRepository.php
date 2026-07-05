<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Support\Config;
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
        return $this->api->get('/pages/' . Config::get('app.home_page_slug'));
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