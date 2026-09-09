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
            'identity' => $_SESSION['login_identity'] ?? '',
        ];
        unset($_SESSION['flash_error'], $_SESSION['login_identity']);
        $this->call->view('login', $data);
    }

    public function authenticate()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $identity = trim((string) $this->request->post('identity'));
        $password = (string) $this->request->post('password');
        $configuredEmail = getenv('ADMIN_EMAIL') ?: 'admin@example.com';
        $configuredHash = getenv('ADMIN_PASSWORD_HASH');
        $configuredPassword = getenv('ADMIN_PASSWORD');
        $adminPasswordValid = $configuredHash
            ? password_verify($password, $configuredHash)
            : ($configuredPassword ? hash_equals($configuredPassword, $password) : $password === 'admin123');
        $viewerUsername = getenv('VIEWER_USERNAME') ?: 'viewer';
        $viewerPassword = getenv('VIEWER_PASSWORD') ?: 'viewer123';

        if (hash_equals($configuredEmail, $identity) && $adminPasswordValid) {
            session_regenerate_id(true);
            $_SESSION['auth_user'] = ['identity' => $identity, 'role' => 'admin'];
            redirect('products');
            return;
        }

        if (hash_equals($viewerUsername, $identity) && hash_equals($viewerPassword, $password)) {
            session_regenerate_id(true);
            $_SESSION['auth_user'] = ['identity' => $identity, 'role' => 'viewer'];
            redirect('products');
            return;
        }
        $_SESSION['flash_error'] = 'The email or password is incorrect.';
        $_SESSION['login_identity'] = $identity;
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