<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle($next)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION['auth_user'])) {
            $_SESSION['flash_error'] = 'Sign in to access product management.';
            redirect('login');
            exit();
        }

        return $next();
    }
}