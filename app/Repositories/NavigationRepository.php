<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Services\ApiClient;

final class NavigationRepository
{
    private ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    /**
     * ---------------------------------------------------------
     * Get all navigation locations
     *
     * GET /navigation
     * ---------------------------------------------------------
     */
    public function all(): ?array
    {
        return $this->api->get('/navigation');
    }

    /**
     * ---------------------------------------------------------
     * Get navigation by location
     *
     * GET /navigation?location=primary
     * ---------------------------------------------------------
     */
    public function location(string $location): ?array
    {
        return $this->api->get(
            '/navigation',
            [
                'location' => $location,
            ]
        );
    }
}