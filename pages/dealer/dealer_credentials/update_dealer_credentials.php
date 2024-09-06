<?php
require_once '../../../config/config.php';
require_once '../../../classes/Database.php';
require_once '../../../classes/BaseModel.php';
require_once '../../../classes/Dealer_Credentials.php';

$database = new Database();
$db = $database->getConnection();
$dealer = new Dealer_Credentials($db);
//$technician = new Technician($db);

$dealer_credentialId = $_GET['id'];
$currentCredential = $dealer->getDealerCredentialsById($dealer_credentialId); // Assuming this function exists
$action = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Dealer</title>
    <?php require_once('../../../includes/link.php')  ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php require_once('../../../includes/preloder.php') ?>
        <?php require_once('../../../includes/navbar.php') ?>
        <?php require_once('../../../includes/asidde-st.php') ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Update Dealer Credentials</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dealer</li>
                                <li class="breadcrumb-item active">Update Credentials</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <div class="container-fluid">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <form action="../../../controllers/dealer/dealer_credentials/process_update_dealer_credentials.php" method="POST" id="complaintForm">
                        <input type="hidden" name="Dealer_Credentials_id" value="<?php echo $currentCredential['id']; ?>">
                                    <div class="row row-gap-2">
                                        <div class="col-md-6">
                                            <label for="DU_username" class="form-label">Userame</label>
                                            <input type="text" class="form-control shadow-none" name="DU_username" id="DU_username" value="<?php echo htmlspecialchars($currentCredential['username']); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="DU_password" class="form-label">User Password</label>
                                            <input type="tel" class="form-control shadow-none" name="DU_password" id="DU_password" value="<?php echo htmlspecialchars($currentCredential['userpassword']); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="DU_fname" class="form-label">Firstname</label>
                                            <input type="tel" class="form-control shadow-none" name="DU_fname" id="DU_fname" value="<?php echo htmlspecialchars($currentCredential['firstname']); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="DU_lname" class="form-label">Lastname</label>
                                            <input type="mail" class="form-control shadow-none" name="DU_fname" id="DU_lname" value="<?php echo htmlspecialchars($currentCredential['lastname']); ?>" required>
                                        </div>
                                        <div class="col-6">
                                            <label for="DU_mobile" class="form-label">MobileNo</label>
                                            <input type="text" class="form-control shadow-none" name="DU_mobile" id="DU_mobile" placeholder="1234 Main St" value="<?php echo htmlspecialchars($currentCredential['mobileno']); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="DU_role" class="form-label">RoleType</label>
                                            <input type="text" class="form-control shadow-none" name="DU_role" id="DU_role" value="<?php echo htmlspecialchars($currentCredential['roletype']); ?>" required>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="dealerStatus">Dealer User Status</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="dealerStatus" name="isactive" value="Y"
                                                        <?php echo ($currentCredential['isactive'] == 'Y') ? 'checked' : ''; ?>>
                                                    <label class="custom-control-label" for="dealerStatus">
                                                        <?php echo ($currentCredential['isactive'] == 'Y') ? 'Active' : 'Inactive'; ?>
                                                    </label>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end mt-2 p-3">
                                            <button type="reset" class="btn btn-secondary shadow-none mr-2">Reset</button>
                                            <button type="submit" class="btn btn-primary shadow-none">Register</button>
                                        </div>
                                    </div>
                    </form>
                </div><!-- /.card-body -->
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
    <?php require_once('../../../includes/footer.php') ?>
    <?php require_once('../../../includes/asidde-end.php') ?>
    </div>
    <!-- ./wrapper -->
    <?php require_once('../../../includes/script.php') ?>

</body>

</html>