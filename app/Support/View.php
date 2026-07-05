<?php

declare(strict_types=1);

namespace App\Support;

final class View
{
    /**
     * Render a view.
     */
    public static function make(
        string $view,
        array $data = []
    ): void {

        extract($data);

        $path = __DIR__
            . '/../Views/'
            . str_replace('.', '/', $view)
            . '.php';

        if (!file_exists($path)) {

            http_response_code(500);

            exit(
                'View not found: ' . $view
            );
        }

        require $path;
    }
}