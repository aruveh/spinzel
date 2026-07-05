<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\NavigationRepository;

abstract class Controller
{
    protected function render(
        string $view,
        array $data = [],
        array $seo = []
    ): void {

        extract($data);

        $pageTitle = $seo['title'] ?? '';
        $pageDescription = $seo['description'] ?? '';
        $pageKeywords = $seo['keywords'] ?? '';

        $navigationRepository = new NavigationRepository();

        $primaryMenu = $navigationRepository->location('primary');

        $pageView = __DIR__ . '/../Views/' . $view . '.php';

        require __DIR__ . '/../Views/layouts/main.php';
    }
}