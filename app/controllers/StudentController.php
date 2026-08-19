<?php 
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); 
 
class StudentController extends Controller 
{ 
    public function index() 
    { 
        session_start(); 

        // Access Denied Indicator
        if (isset($_SESSION['access_denied']) && $_SESSION['access_denied'] === true) {

            $message = $_SESSION['access_denied_message'];

            unset($_SESSION['access_denied']);
            unset($_SESSION['access_denied_message']);

            echo "<script>alert('$message');</script>";
        }

        $data['title'] = 'Student Home - BAGOT'; 
        $this->call->view('student_home', $data); 
    } 
 
    public function profile() 
    { 
        $student = [ 
            'student_id' => 'MCC2024-00074', 
            'name'       => 'ANGELO BAGOT', 
            'course'     => 'BSIT', 
            'year'       => '3RD YEAR', 
            'section'    => '3-F2', 
            'email'      => 'angelobagot@gmail.com' 
        ]; 
 
        $this->call->view('student_profile', $student); 
    } 
 
    public function grant_access() 
    { 
        session_start(); 

        $_SESSION['student_access'] = true; 

        echo '<div style="font-family:sans-serif;text-align:center;margin-top:100px;">'; 
        echo '<h1 style="color:#16a34a;">&#10003; Access Granted</h1>'; 
        echo '<p>Your session now has permission to view the Student Profile.</p>'; 
        echo '<a href="' . site_url('student/profile') . '" style="color:#2563eb;">Go to Profile &rarr;</a>'; 
        echo '</div>'; 
    } 
}