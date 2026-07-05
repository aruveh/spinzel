<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\PageRepository;

final class HomeController extends Controller
{
    private PageRepository $pages;

    public function __construct()
    {
        $this->pages = new PageRepository();
    }

    /**
     * Homepage
     */
    public function index(): void
    {
        $response = $this->pages->home();

        if (
            $response === null ||
            empty($response['data'])
        ) {

            http_response_code(404);

            exit('Home page not found.');
        }

        $page = $response['data'];

        $this->render(
            'home/index',
            [
                'page' => $page,
            ],
            [
                'title' => $page['title'] ?? 'Home',
                'description' => $page['excerpt'] ?? '',
                'keywords' => '',
            ]
        );
    }
}