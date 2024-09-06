<?php
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/SCMS/');
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header('Location: ' . BASE_URL . 'public/login.php');
exit();
?>
