<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Services\ApiClient;

final class CategoryRepository
{
    private ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    /**
     * ---------------------------------------------------------
     * Category Listing
     *
     * GET /categories
     * ---------------------------------------------------------
     */
    public function all(array $filters = []): ?array
    {
        return $this->api->get(
            '/categories',
            $filters
        );
    }

    /**
     * ---------------------------------------------------------
     * Category By ID
     *
     * GET /categories/{id}
     * ---------------------------------------------------------
     */
    public function find(int $id): ?array
    {
        return $this->api->get(
            '/categories/' . $id
        );
    }

    /**
     * ---------------------------------------------------------
     * Category By Slug
     *
     * GET /categories/{slug}
     * ---------------------------------------------------------
     */
    public function findBySlug(string $slug): ?array
    {
        return $this->api->get(
            '/categories/' . $slug
        );
    }

    /**
     * ---------------------------------------------------------
     * Search Categories
     *
     * GET /categories?search=seo
     * ---------------------------------------------------------
     */
    public function search(string $keyword): ?array
    {
        return $this->api->get(
            '/categories',
            [
                'search' => $keyword,
            ]
        );
    }

    /**
     * ---------------------------------------------------------
     * Order Categories
     *
     * GET /categories?orderby=name&order=DESC
     * ---------------------------------------------------------
     */
    public function orderBy(
        string $orderby = 'name',
        string $order = 'ASC'
    ): ?array {

        return $this->api->get(
            '/categories',
            [
                'orderby' => $orderby,
                'order' => strtoupper($order),
            ]
        );
    }

    /**
     * ---------------------------------------------------------
     * Custom Filters
     *
     * Example:
     *
     * page
     * per_page
     * search
     * orderby
     * order
     * ---------------------------------------------------------
     */
    public function filter(array $filters): ?array
    {
        return $this->api->get(
            '/categories',
            $filters
        );
    }
}