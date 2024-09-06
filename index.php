<?php
require_once 'config/config.php';
require_once 'classes/Database.php';
require_once 'classes/BaseModel.php';
require_once 'classes/Complaint.php';

$database = new Database();
$db = $database->getConnection();
// You can now use your models here

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <?php require_once('includes/link.php')  ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php require_once('includes/preloder.php') ?>
        <?php require_once('includes/navbar.php') ?>
        <?php require_once('includes/asidde-st.php') ?>

        <div class="content-wrapper">
            <div class="container-fluid">
                <h1>C:\xampp\htdocs\SCMS\index.php</h1>
                <h1>index page edited</h1>
            </div><!-- /.container-fluid -->
        </div>

        <?php require_once('includes/footer.php') ?>
        <?php require_once('includes/asidde-end.php') ?>
    </div>
    <?php require_once('includes/script.php')  ?>
</body>

</html>