<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Services\ApiClient;

final class SearchRepository
{
    private ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    /**
     * GET /search
     */
    public function search(array $filters = []): array
    {
        return $this->api->get('/search', $filters);
    }
}