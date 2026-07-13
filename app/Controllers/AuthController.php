<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\AuthRepository;

final class AuthController extends Controller
{
    private AuthRepository $auth;

    public function __construct()
    {
        $this->auth = new AuthRepository();
    }

    /**
     * Login Page
     */
    public function loginForm(): void
    {
        $this->render(
            'auth/login',
            [],
            [
                'title' => 'Login',
            ]
        );
    }

    /**
     * Register Page
     */
    public function registerForm(): void
    {
        $this->render(
            'auth/register',
            [],
            [
                'title' => 'Register',
            ]
        );
    }

    /**
     * Forgot Password Page
     */
    public function forgotPasswordForm(): void
    {
        $this->render(
            'auth/forgot-password',
            [],
            [
                'title' => 'Forgot Password',
            ]
        );
    }

    /**
     * Reset Password Page
     */
    public function resetPasswordForm(): void
    {
        $this->render(
            'auth/reset-password',
            [],
            [
                'title' => 'Reset Password',
            ]
        );
    }

    /**
     * Profile
     */
    public function profile(): void
    {
        if (
            empty($_SESSION['auth']['token'])
        ) {

            header('Location: /login');

            exit;

        }
        
        $response = $this->auth->profile(
            $_SESSION['auth']['token']
        );

        $user = $response['data'];

        $this->render(
            'auth/profile',
            [
                'user' => $user,
            ],
            [
                'title' => 'My Profile',
            ]
        );
    }

    /**
     * Change Password Page
     */
    public function changePasswordForm(): void
    {
        $this->render(
            'auth/change-password',
            [],
            [
                'title' => 'Change Password',
            ]
        );
    }

    /**
     * Login
     */
    public function login(): void
    {
        $username = trim(
            $_POST['username'] ?? ''
        );

        $password = trim(
            $_POST['password'] ?? ''
        );

        if (
            $username === '' ||
            $password === ''
        ) {
            header('Location: /login');
            exit;
        }

        $response = $this->auth->login([
            'username' => $username,
            'password' => $password,
        ]);

        if (empty($response['success'])) {
            header('Location: /login');
            exit;
        }

        $_SESSION['auth'] = [
            'token' => $response['data']['token'],
            'user' => $response['data']['user'],
        ];

        header('Location: /profile');
        exit;
    }

    /**
     * Register
     */
    public function register(): void
    {
        
        $username = trim(
            $_POST['username'] ?? ''
        );

        $displayName = trim(
            $_POST['display_name'] ?? ''
        );

        $email = trim(
            $_POST['email'] ?? ''
        );

        $password = trim(
            $_POST['password'] ?? ''
        );

        if (
            $username === '' ||
            $displayName === '' ||
            $email === '' ||
            $password === ''
        ) {
            header('Location: /register');
            exit;

        }

        $response = $this->auth->register([
            'username' => $username,
            'display_name' => $displayName,
            'email' => $email,
            'password' => $password,
        ]);

        if (empty($response['success'])) {
            $this->render(
                'auth/register',
                [
                    'error' => $response['message'] ?? 'Registration failed.',
                    'old' => [
                        'username' => $username,
                        'display_name' => $displayName,
                        'email' => $email,
                    ],
                ],
                [
                    'title' => 'Register',
                ]
            );
            return;
        }

        $login = $this->auth->login([
            'username' => $username,
            'password' => $password,

        ]);

        if (empty($login['success'])) {
            header('Location: /login');
            exit;
        }

        $_SESSION['auth'] = [
            'token' => $login['data']['token'],
            'user' => $login['data']['user'],
        ];

        header('Location: /profile');
        exit;
    }

    /**
     * Logout
     */
    public function logout(): void
    {
        if (empty($_SESSION['auth']['token'])) {
            header('Location: /');
            exit;
        }

        $this->auth->logout(
            $_SESSION['auth']['token']
        );

        unset($_SESSION['auth']);

        session_destroy();

        header('Location: /');

        exit;
    }

    /**
     * Forgot Password
     */
    public function forgotPassword(): void
    {
        $email = trim(
            $_POST['email'] ?? ''
        );

        if ($email === '') {

            header('Location: /forgot-password');

            exit;

        }

        $response = $this->auth->forgotPassword([

            'email' => $email,

        ]);

        if (empty($response['success'])) {

            $this->render(

                'auth/forgot-password',

                [

                    'error' => 'Unable to process your request. Please try again.',

                ],

                [

                    'title' => 'Forgot Password',

                ]

            );

            return;

        }

        $this->render(

            'auth/forgot-password',

            [

                'success' => 'If an account with that email exists, a password reset link has been sent.',

            ],

            [

                'title' => 'Forgot Password',

            ]

        );
    }

    /**
     * Reset Password
     */
    public function resetPassword(): void
    {
        $login = trim(
            $_POST['login'] ?? ''
        );

        $key = trim(
            $_POST['key'] ?? ''
        );

        $password = trim(
            $_POST['password'] ?? ''
        );

        if (
            $login === '' ||
            $key === '' ||
            $password === ''
        ) {

            header('Location: /reset-password');

            exit;

        }

        $response = $this->auth->resetPassword([

            'login' => $login,

            'key' => $key,

            'password' => $password,

        ]);

        if (empty($response['success'])) {

            $this->render(
                'auth/reset-password',
                [
                    'error' => 'Unable to reset your password.',
                ],
                [
                    'title' => 'Reset Password',
                ]
            );

            return;
        }

        $this->render(
            'auth/login',
            [
                'success' => 'Your password has been reset successfully. Please login.',
            ],
            [
                'title' => 'Login',
            ]
        );
    }

    /**
     * Update Profile
     */
    public function updateProfile(): void
    {
        if (
            empty($_SESSION['auth']['token'])
        ) {
            header('Location: /login');
            exit;
        }

        $response = $this->auth->updateProfile(
            $_SESSION['auth']['token'], [
                'display_name' => trim($_POST['display_name'] ?? ''),
                'first_name' => trim($_POST['first_name'] ?? ''),
                'last_name' => trim($_POST['last_name'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
            ]
        );

        if (!empty($response['data'])) {
            $_SESSION['auth']['user'] = $response['data'];
        }

        header('Location: /profile');
        exit;
    }

    /**
     * Change Password
     */
    public function changePassword(): void
    {
        if (empty($_SESSION['auth']['token'])) {

            header('Location: /login');

            exit;

        }

        $currentPassword = trim(
            $_POST['current_password'] ?? ''
        );

        $newPassword = trim(
            $_POST['new_password'] ?? ''
        );

        if (
            $currentPassword === '' ||
            $newPassword === ''
        ) {

            $this->render(
                'auth/change-password',
                [
                    'error' => 'Both password fields are required.',
                ],
                [
                    'title' => 'Change Password',
                ]
            );

            return;

        }

        $response = $this->auth->changePassword(

            $_SESSION['auth']['token'],

            [

                'current_password' => $currentPassword,

                'new_password' => $newPassword,

            ]

        );

        if (empty($response['success'])) {

            $this->render(

                'auth/change-password',

                [

                    'error' => 'Unable to change your password.',

                ],

                [

                    'title' => 'Change Password',

                ]

            );

            return;

        }

        header('Location: /profile');

        exit;
    }

    /**
     * Verify Email
     */
    public function verifyEmail(): void
    {
        $token = trim(
            $_GET['token'] ?? ''
        );

        if ($token === '') {

            header('Location: /login');

            exit;

        }

        $response = $this->auth->verifyEmail(
            $token
        );

        if (empty($response['success'])) {

            $this->render(
                'auth/verify-email',
                [
                    'success' => false,
                ],
                [
                    'title' => 'Verify Email',
                ]
            );

            return;

        }

        $this->render(
            'auth/verify-email',
            [
                'success' => true,
            ],
            [
                'title' => 'Verify Email',
            ]
        );
    }
}