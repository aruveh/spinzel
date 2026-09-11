<?php

declare(strict_types=1);

use App\Controllers\BlogController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\SearchController;
use App\Controllers\SlugController;
use App\Controllers\AuthController;
use App\Controllers\SitemapController;

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
| Sitemap
|--------------------------------------------------------------------------
*/

$router->get('/sitemap.xml', [
    SitemapController::class,
    'index',
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

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

/**
 * Login
 */
$router->get('/login', [
    AuthController::class,
    'loginForm',
]);

$router->post('/login', [
    AuthController::class,
    'login',
]);

/**
 * Register
 */
$router->get('/register', [
    AuthController::class,
    'registerForm',
]);

$router->post('/register', [
    AuthController::class,
    'register',
]);

/**
 * Logout
 */
$router->post('/logout', [
    AuthController::class,
    'logout',
]);

/**
 * Profile
 */
$router->get('/profile', [
    AuthController::class,
    'profile',
]);

$router->get('/profile/{username}', [
    AuthController::class,
    'publicProfile',
]);

$router->get('/author/{username}', [
    AuthController::class,
    'publicProfile',
]);

$router->post('/profile', [
    AuthController::class,
    'updateProfile',
]);

/**
 * Forgot Password
 */
$router->get('/forgot-password', [
    AuthController::class,
    'forgotPasswordForm',
]);

$router->post('/forgot-password', [
    AuthController::class,
    'forgotPassword',
]);

/**
 * Reset Password
 */
$router->get('/reset-password', [
    AuthController::class,
    'resetPasswordForm',
]);

$router->post('/reset-password', [
    AuthController::class,
    'resetPassword',
]);

/**
 * Change Password
 */
$router->get('/change-password', [
    AuthController::class,
    'changePasswordForm',
]);

$router->post('/change-password', [
    AuthController::class,
    'changePassword',
]);

/**
 * Verify Email
 */
$router->get('/verify-email', [
    AuthController::class,
    'verifyEmail',
]);