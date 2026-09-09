<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function login()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (!empty($_SESSION['auth_user'])) {
            redirect('products');
            return;
        }
        $data = [
            'error' => $_SESSION['flash_error'] ?? '',
            'email' => $_SESSION['login_email'] ?? '',
        ];
        unset($_SESSION['flash_error'], $_SESSION['login_email']);
        $this->call->view('login', $data);
    }

    public function authenticate()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $email = trim((string) $this->request->post('email'));
        $password = (string) $this->request->post('password');
        $configuredEmail = getenv('ADMIN_EMAIL') ?: 'admin@example.com';
        $configuredHash = getenv('ADMIN_PASSWORD_HASH');
        $configuredPassword = getenv('ADMIN_PASSWORD');
        $validPassword = $configuredHash
            ? password_verify($password, $configuredHash)
            : ($configuredPassword ? hash_equals($configuredPassword, $password) : $password === 'ChangeMe123!');

        if (hash_equals($configuredEmail, $email) && $validPassword) {
            session_regenerate_id(true);
            $_SESSION['auth_user'] = ['email' => $email];
            redirect('products');
            return;
        }
        $_SESSION['flash_error'] = 'The email or password is incorrect.';
        $_SESSION['login_email'] = $email;
        redirect('login');
    }

    public function logout()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION = [];
        session_destroy();
        redirect('login');
    }
}