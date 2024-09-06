<?php
    require_once '../../config/config.php';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Technician Management</title>
        <?php require_once('../../includes/link.php')  ?>
        
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <?php require_once('../../includes/preloder.php') ?>
            <?php require_once('../../includes/navbar.php') ?>
            <?php require_once('../../includes/asidde-st.php') ?>
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="card card-warning card-outline">
                        <div class="card-header d-flex justify-content-between">
                            <div class="ml-auto">
                                <!-- Button to open the modal -->
                                <button type="button" class="btn btn-block bg-gradient-success" data-toggle="modal" data-target="#registerTechnicianModal">
                                <i class="fas fa-user-plus"></i> Register
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <?php require_once('../../includes/footer.php') ?>
            <?php require_once('../../includes/asidde-end.php') ?>

        </div>

        <?php require_once('../../includes/script.php')  ?>
    </body>

    </html>