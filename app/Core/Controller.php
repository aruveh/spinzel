<?php

declare(strict_types=1);

namespace App\Core;

use App\Repositories\NavigationRepository;

abstract class Controller
{
    /**
     * Render page.
     */
    protected function render(
        string $view,
        array $data = [],
        array $seo = []
    ): void {

        /*
        |--------------------------------------------------------------------------
        | View Data
        |--------------------------------------------------------------------------
        */

        extract($data);

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

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        $pageView = __DIR__
            . '/../Views/'
            . $view
            . '.php';

        /*
        |--------------------------------------------------------------------------
        | Layout
        |--------------------------------------------------------------------------
        */

        if(str_contains($view, 'auth/login') || str_contains($view, 'auth/register')) {
            require __DIR__
            . '/../Views/layouts/auth.php';
        } else {
            require __DIR__
            . '/../Views/layouts/main.php';
        }
    }
}