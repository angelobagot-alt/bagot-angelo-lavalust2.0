<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware
{
    public function handle($next)
    {
        session_start();

        if (!isset($_SESSION['student_access']) || $_SESSION['student_access'] !== true) {

            // Access Denied Indicator
            $_SESSION['access_denied'] = true;
            $_SESSION['access_denied_message'] = 'Access Denied! You are not allowed to access this page.';

            redirect('student');
            exit();
        }

        return $next();
    }
}