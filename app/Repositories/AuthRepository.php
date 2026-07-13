<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Services\ApiClient;

final class AuthRepository
{
    private ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    /**
     * Register
     */
    public function register(array $data): ?array
    {
        return $this->api->post(
            '/auth/register',
            $data
        );
    }

    /**
     * Login
     */
    public function login(array $data): ?array
    {
        return $this->api->post(
            '/auth/login',
            $data
        );
    }

    /**
     * Logout
     */
    public function logout(string $token): ?array
    {
        return $this->api->post(
            '/auth/logout',
            [],
            [
                'Authorization' => 'Bearer ' . $token,
            ]
        );
    }

    /**
     * Get Profile
     */
    public function profile(string $token): ?array
    {
        return $this->api->get(
            '/auth/profile',
            [],
            [
                'Authorization' => 'Bearer ' . $token,
            ]
        );
    }

    /**
     * Update Profile
     */
    public function updateProfile(
        string $token,
        array $data
    ): ?array {

        return $this->api->put(
            '/auth/profile',
            $data,
            [
                'Authorization' => 'Bearer ' . $token,
            ]
        );

    }

    /**
     * Forgot Password
     */
    public function forgotPassword(
        array $data
    ): ?array {

        return $this->api->post(
            '/auth/forgot-password',
            $data
        );

    }

    /**
     * Reset Password
     */
    public function resetPassword(
        array $data
    ): ?array {

        return $this->api->post(
            '/auth/reset-password',
            $data
        );

    }

    /**
     * Change Password
     */
    public function changePassword(
        string $token,
        array $data
    ): ?array {

        return $this->api->post(
            '/auth/change-password',
            $data,
            [
                'Authorization' => 'Bearer ' . $token,
            ]
        );

    }

    /**
     * Verify Email
     */
    public function verifyEmail(
        string $token
    ): ?array {

        return $this->api->get(
            '/auth/verify-email',
            [
                'token' => $token,
            ]
        );

    }
}