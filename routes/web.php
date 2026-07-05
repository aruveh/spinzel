<?php

declare(strict_types=1);

use App\Controllers\BlogController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\SearchController;
use App\Controllers\SlugController;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

$router->get('/', [
    HomeController::class,
    'index',
]);

/*
|--------------------------------------------------------------------------
| Blog Listing
|--------------------------------------------------------------------------
*/

$router->get('/blogs', [
    BlogController::class,
    'index',
]);

/*
|--------------------------------------------------------------------------
| Search
|--------------------------------------------------------------------------
*/

$router->get('/search', [
    SearchController::class,
    'index',
]);

/*
|--------------------------------------------------------------------------
| Categories
|--------------------------------------------------------------------------
*/

$router->get('/categories', [
    CategoryController::class,
    'index',
]);

$router->get('/category/{slug}', [
    CategoryController::class,
    'show',
]);

/*
|--------------------------------------------------------------------------
| Catch All Slug
|--------------------------------------------------------------------------
|
| IMPORTANT:
| Keep this route LAST.
|
| It will resolve:
|
| /about
| /contact
| /privacy-policy
| /best-paid-surveys
| /make-money-as-a-virtual-assistant
|
*/

$router->get('/{slug}', [
    SlugController::class,
    'show',
]);