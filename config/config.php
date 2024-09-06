<?php

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'servicecenter');
define('DB_USER', 'root');
define('DB_PASS', 'admin');

define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/SCMS/');

// Function to set session messages
function setSessionMessage($type, $title, $subtitle, $body)
{
    $_SESSION['toast'] = [
        'class' => 'bg-' . $type,
        'title' => $title,
        'subtitle' => $subtitle,
        'body' => $body
    ];
}


// Function to display session messages
function displaySessionMessage($autohideTime = 5000)
{ // Default is 5000 milliseconds (5 seconds)
    if (isset($_SESSION['toast'])) {
        echo "<script>
            $(document).Toasts('create', {
                class: '{$_SESSION['toast']['class']}',
                title: '{$_SESSION['toast']['title']}',
                subtitle: '{$_SESSION['toast']['subtitle']}',
                body: '{$_SESSION['toast']['body']}',
                delay: $autohideTime,
                autohide: true
            });
        </script>";
        unset($_SESSION['toast']); // Clear the message after displaying it
    }
}
