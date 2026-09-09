<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AdminMiddleware
{
    public function handle($next)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (($_SESSION['auth_user']['role'] ?? '') !== 'admin') {
            $_SESSION['flash_error'] = 'Read-only accounts cannot change products.';
            redirect('products');
            exit();
        }

        return $next();
    }
}