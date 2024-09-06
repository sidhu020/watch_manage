<?php
require_once '../../config/config.php';
require_once '../../classes/Database.php';
require_once '../../classes/BaseModel.php';
require_once '../../classes/Dealer.php';

$database = new Database();
$db = $database->getConnection();
$dealer = new Dealer($db);
//$technician = new Technician($db);

$dealerId = $_GET['id'];
$currentDealer = $dealer->getDealerById($dealerId); // Assuming this function exists
$action = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Dealer</title>
    <?php require_once('../../includes/link.php')  ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php require_once('../../includes/preloder.php') ?>
        <?php require_once('../../includes/navbar.php') ?>
        <?php require_once('../../includes/asidde-st.php') ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Update Dealer Info</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dealer</li>
                                <li class="breadcrumb-item active">Update</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <div class="container-fluid">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <form action="../../controllers/dealer/updateDealer_process.php" method="POST" id="complaintForm">
                            <input type="hidden" name="Dealer_id" value="<?php echo $currentDealer['id']; ?>">
                            <div>
                                <div class="section-1">
                                    <div class="row row-gap-2">
                                        <!-- // id, name, isactive, primarymobileno, secondmobileno, emailaddress, address, city -->
                                        <div class="col-md-6">
                                            <label for="Dealer_Name" class="form-label">Name</label>
                                            <input type="text" class="form-control shadow-none" name="Dealer_Name" id="Dealer_Name" value="<?php echo htmlspecialchars($currentDealer['name']); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Dealer_City" class="form-label">City</label>
                                            <input type="text" class="form-control shadow-none" name="Dealer_City" id="Dealer_City" value="<?php echo htmlspecialchars($currentDealer['city']); ?>" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="Dealer_PMobile_No" class="form-label">Primary Mobile No:-</label>
                                            <input type="tel" class="form-control shadow-none" name="Dealer_PMobile_No" id="Dealer_PMobile_No" value="<?php echo htmlspecialchars($currentDealer['primarymobileno']); ?>" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="Dealer_SMobile_No" class="form-label">Second Mobile No:-</label>
                                            <input type="tel" class="form-control shadow-none" name="Dealer_SMobile_No" id="Dealer_SMobile_No" value="<?php echo htmlspecialchars($currentDealer['secondmobileno']); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Dealer_email" class="form-label">Email</label>
                                            <input type="mail" class="form-control shadow-none" name="Dealer_email" id="Dealer_email" value="<?php echo htmlspecialchars($currentDealer['emailaddress']); ?>" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="Dealer_Address" class="form-label">Address</label>
                                            <input type="text" class="form-control shadow-none" name="Dealer_Address" id="Dealer_Address" value="<?php echo htmlspecialchars($currentDealer['address']); ?>" placeholder="1234 Main St" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="Dealer_City" class="form-label">City</label>
                                            <input type="text" class="form-control shadow-none" name="Dealer_City" id="Dealer_City" value="<?php echo htmlspecialchars($currentDealer['city']); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dealerStatus">Dealer Status</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="dealerStatus" name="isactive" value="Y"
                                                        <?php echo ($currentDealer['isactive'] == 'Y') ? 'checked' : ''; ?>>
                                                    <label class="custom-control-label" for="dealerStatus">
                                                        <?php echo ($currentDealer['isactive'] == 'Y') ? 'Active' : 'Inactive'; ?>
                                                    </label>
                                                </div>  
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-2">
                                        <button type="reset" class="btn btn-secondary shadow-none mr-2">Reset</button>
                                        <button type="submit" class="btn btn-primary shadow-none">Register</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div><!-- /.card-body -->
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
    <?php require_once('../../includes/footer.php') ?>
    <?php require_once('../../includes/asidde-end.php') ?>
    </div>
    <!-- ./wrapper -->
    <?php require_once('../../includes/script.php') ?>

</body>

</html>