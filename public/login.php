<?php
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/SCMS/');
// Check if cookies are set and pre-fill the form
$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Log in </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?php echo BASE_URL; ?>assets/index2.html" class="h1"><b>Admin Login</b>RSS</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form id="adminLoginForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" novalidate>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="adminUsername" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-at"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">Please enter a valid Username.</div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="adminPassword" name="password" placeholder="Password" value="<?php echo $password; ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">Please enter your password.</div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe" <?php if ($username && $password) echo 'checked'; ?>>
                            <label class="form-check-label" for="rememberMe">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" name="Login" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo BASE_URL; ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo BASE_URL; ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo BASE_URL; ?>assets/dist/js/adminlte.min.js"></script>
    <script>

    </script>
</body>

</html>


<?php

$conn = mysqli_connect("localhost", "root", "admin", "servicecenter");
date_default_timezone_set('Asia/Kolkata'); // Set the timezone to IST
// Handle connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['Login'])) {
    // Get the username and password from POST request
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $rememberMe = isset($_POST['rememberMe']) ? true : false;

    // Validate and sanitize input
    $username = trim(htmlspecialchars(strip_tags($username)));
    $password = trim(htmlspecialchars(strip_tags($password)));

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);



    // Prepare the SQL query
    $query = "SELECT * FROM `servicecenteruser` WHERE BINARY `username` = ? AND `isactive` = 'Y'";

    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching record is found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Check if the password matches
        if ($password == $user['password']) {
            $lastlogindate = date('Y-m-d H:i:s');
            // Update last login date   
            $updateQuery = "UPDATE `servicecenteruser` SET `lastlogindate` = ? WHERE `id` = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param('si', $lastlogindate, $user['id']);
            $updateStmt->execute();
             // Handle the "Remember Me" feature
            if ($rememberMe) {
                // Set cookies for 30 days (86400 * 30 seconds)
                setcookie('username', $username, time() + (86400 * 30), "/");
                setcookie('password', $password, time() + (86400 * 30), "/");
            } else {
                // Clear cookies if "Remember Me" is not checked
                if (isset($_COOKIE['username'])) {
                    setcookie('username', '', time() - 3600, "/");
                }
                if (isset($_COOKIE['password'])) {
                    setcookie('password', '', time() - 3600, "/");
                }
            }
            session_start();
            // Store user information in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_username'] = $user['username'];

            // Redirect to dashboard
            header('Location: ' . BASE_URL . 'pages/dashboard/admin.php');

        } else {
            echo "<script> alert('User Password not found') </script>";
        }
    } else {
        echo "<script> alert('User not found or inactive') </script>";
    }
}


?> 