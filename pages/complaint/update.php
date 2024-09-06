<?php
require_once '../../config/config.php';
require_once '../../classes/Database.php';
require_once '../../classes/BaseModel.php';
require_once '../../classes/Complaint.php';
require_once '../../classes/Technician.php'; // Assuming this class exists for fetching technician details

$database = new Database();
$db = $database->getConnection();
$complaint = new Complaint($db);
//$technician = new Technician($db);

$complaintId = $_GET['id'];
$currentComplaint = $complaint->getComplaintById($complaintId); // Assuming this function exists
$complaint_status = $currentComplaint['callstatus'];
$technicians = $complaint->getTechnicians(); // Assuming this function exists
$action = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Complaint</title>
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
                            <h1><b>Update Complaint <i class="fas fa-pen-alt"></i></b></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active"><a href="<?php echo BASE_URL; ?>pages/complaint/show.php">Complaint</a></li>
                                <li class="breadcrumb-item active">Update</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <div class="container-fluid">
                <div class="card card-warning card-outline">
                    <div class="card-body">
                        <form action="../../controllers/complaint/update_process.php" method="POST" id="complaintForm">
                            <input type="hidden" name="complaint_id" value="<?php echo $currentComplaint['id']; ?>">
                            <div>
                                <div class="section-0">
                                    <div class="row row-gap-2">
                                        <h2><?php echo htmlspecialchars($currentComplaint['callnumber']); ?> </h2>  &nbsp;  <h5><span class="badge badge-<?php echo ($currentComplaint['callstatus'] == 'New') ? 'danger' : (($currentComplaint['callstatus'] == 'Assigned')
                                                                                    ? 'warning' : (($currentComplaint['callstatus'] == 'Close')
                                                                                        ? 'success' : (($currentComplaint['callstatus'] == 'Cancelled')
                                                                                            ? 'dark' : '')))
                                                                                ?>">
                                                <?php echo htmlspecialchars($currentComplaint['callstatus']); ?>
                                            </span></h5>
                                        
                                        <div class="progress progress-xxs m-1 col-md-12">
                                            <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="section-1 mt-2 mb-2">
                                <div><h3>Customer Basic Deatiles</h3></div>
                                    <div class="row row-gap-2">
                                        <div class="col-md-6">
                                            <label for="Cus_Name" class="form-label">Name</label>
                                            <input type="text" class="form-control shadow-none" name="Cus_Name" id="Cus_Name" value="<?php echo htmlspecialchars($currentComplaint['customername']); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Cus_Mobile_No" class="form-label">Phone</label>
                                            <input type="tel" class="form-control shadow-none" name="Cus_Mobile_No" id="Cus_Mobile_No" value="<?php echo htmlspecialchars($currentComplaint['customermobileno']); ?>" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="Cus_Address" class="form-label">Address</label>
                                            <input type="text" class="form-control shadow-none" name="Cus_Address" id="Cus_Address" placeholder="1234 Main St" value="<?php echo htmlspecialchars($currentComplaint['customeraddress']); ?>" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="Cus_City" class="form-label">City</label>
                                            <input type="text" class="form-control shadow-none" name="Cus_City" id="Cus_City" value="<?php echo htmlspecialchars($currentComplaint['customercity']); ?>" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="Cus_calltype" class="form-label">Call-Type</label>
                                            <select class="form-control shadow-none" name="Cus_calltype" id="Cus_calltype" required>
                                                <option value="Microwave" <?php echo ($currentComplaint['calltype'] == 'Microwave') ? 'selected' : ''; ?>>Microwave</option>
                                                <option value="Refrigerator" <?php echo ($currentComplaint['calltype'] == 'Refrigerator') ? 'selected' : ''; ?>>Refrigerator</option>
                                                <option value="WashingMachine" <?php echo ($currentComplaint['calltype'] == 'WashingMachine') ? 'selected' : ''; ?>>WashingMachine</option>
                                                <option value="Airconditioning" <?php echo ($currentComplaint['calltype'] == 'Airconditioning') ? 'selected' : ''; ?>>Airconditioning</option>
                                                <option value="Dishwasher" <?php echo ($currentComplaint['calltype'] == 'Dishwasher') ? 'selected' : ''; ?>>Dishwasher</option>
                                                <option value="Oven" <?php echo ($currentComplaint['calltype'] == 'Oven') ? 'selected' : ''; ?>>Oven</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                                        <label for="serviceWorkType" class="form-label">Service Worktype</label>
                                                        <select class="form-control shadow-none" name="serviceWorkType" id="serviceWorkType" required>
                                                            <option value=""></option>
                                                            <option value="Repair" <?php echo ($currentComplaint['serviceworktype'] == 'Repair') ? 'selected' : ''; ?>>Repair</option>
                                                            <option value="Service" <?php echo ($currentComplaint['serviceworktype'] == 'Service') ? 'selected' : ''; ?>>Service</option>
                                                            <option value="Installation" <?php echo ($currentComplaint['serviceworktype'] == 'Installation') ? 'selected' : ''; ?>>Installation</option>
                                                            <option value="Demo" <?php echo ($currentComplaint['serviceworktype'] == 'Demo') ? 'selected' : ''; ?>>Demo</option>
                                                            <option value="InstallationDemo" <?php echo ($currentComplaint['serviceworktype'] == 'InstallationDemo') ? 'selected' : ''; ?>>Installation and Demo</option>
                                                            <option value="InWarrentyService" <?php echo ($currentComplaint['serviceworktype'] == 'InWarrentyService') ? 'selected' : ''; ?>>In-Warrenty Service</option>
                                                        </select>
                                                    </div>
                                        <div class="col-md-3">
                                            <label for="Cus_calldate" class="form-label">Call Date</label>
                                            <input type="date" class="form-control shadow-none" name="Cus_calldate" id="Cus_calldate" value="<?php echo htmlspecialchars(date('Y-m-d', strtotime($currentComplaint['calldate']))); ?>" required>
                                        </div>

                                        <input type="hidden" name="action" value="New">

                                        <div class="col-md-12">
                                            <label for="Cus_cusprob" class="form-label">Customer Problem</label>
                                            <input type="text" class="form-control shadow-none" name="Cus_cusprob" id="Cus_cusprob" value="<?php echo htmlspecialchars($currentComplaint['customerproblem']); ?>">
                                        </div>
                                        <div class="progress progress-xxs m-1 mt-2 col-md-12">
                                            <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="section-2  mt-2 mb-2">
                                <div><h3>Assign Call To Technician </h3></div>
                                    <div class="row row-gap-2">
                                        <div class="col-md-6">
                                            <label for="Cus_technicianassign" class="form-label">Technician Assigned</label>
                                            <select class="form-control shadow-none" id="Cus_technicianassign" name="Cus_technicianassign">
                                                <option value="">Select Technician</option>
                                                <?php foreach ($technicians as $technician) : ?>
                                                    <option value="<?php echo $technician['id']; ?>" <?php echo ($currentComplaint['technicianassigned'] == $technician['id']) ? 'selected' : ''; ?>>
                                                        <?php echo $technician['firstname'] . ' ' . $technician['lastname']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback" id="Cus_technicianassign_error"></div>
                                        </div>
                                        <input type="hidden" name="action" value="assigned">
                                        <div class="progress progress-xxs m-1 mt-2 col-md-12">
                                            <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="section-3 mt-2 mb-2 ">
                                    <div class="row row-gap-2">
                                        <div class="col-md-2 pt-4">
                                            <label for="action">Action: </label>
                                            <div class="form-check form-check-inline ml-1">
                                                <input class="form-check-input" type="radio" id="close" name="action" value="close">
                                                <label class="form-check-label" for="close">Close</label>
                                            </div>
                                            <div class="form-check form-check-inline ml-1">
                                                <input class="form-check-input" type="radio" id="cancel" name="action" value="cancel">
                                                <label class="form-check-label" for="cancel">Cancel</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="Cus_payment" class="form-label">Payment-Type</label>
                                            <input type="text" class="form-control shadow-none" name="Cus_payment" id="Cus_payment" autocomplete="off" value="<?php echo htmlspecialchars($currentComplaint['paymenttype']); ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="Cus_totalamount" class="form-label">Total Amount</label>
                                            <input type="number" class="form-control shadow-none" name="Cus_totalamount" id="Cus_totalamount" autocomplete="off" value="<?php echo htmlspecialchars($currentComplaint['totalamount']); ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="Cus_disamount" class="form-label">Discount Amount</label>
                                            <input type="number" class="form-control shadow-none" name="Cus_disamount" id="Cus_disamount" autocomplete="off" value="<?php echo htmlspecialchars($currentComplaint['discountamount']); ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="Cus_finalamount" class="form-label">Final Amount</label>
                                            <input type="number" class="form-control shadow-none" name="Cus_finalamount" id="Cus_finalamount" autocomplete="off" value="<?php echo htmlspecialchars($currentComplaint['finalamount']); ?>">
                                        </div>

                                        <div class="col-md-12">
                                            <label for="Cus_callresolution" class="form-label">Customer Resolution</label>
                                            <input type="text" class="form-control shadow-none" name="Cus_callresolution" id="Cus_callresolution" autocomplete="off" value="<?php echo htmlspecialchars($currentComplaint['callresolution']); ?>">
                                        </div>
                                        <div class="progress progress-xxs m-1 mt-2 col-md-12">
                                            <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="row row-gap-2">
                                    <div class="col-12 d-flex justify-content-end mt-2">
                                        <button type="reset" class="btn btn-secondary shadow-none mr-2">Reset</button>
                                        <button type="submit" class="btn btn-primary shadow-none">Update</button>
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

    <script>
        // Pass PHP variable to JavaScript
        var complaintStatus = '<?php echo $complaint_status; ?>';

        // Function to show/hide sections based on status
        function handleSectionVisibility(status) {
            var section1 = document.querySelector('.section-1');
            var section2 = document.querySelector('.section-2');
            var section3 = document.querySelector('.section-3');


            if (status === 'New') {
                section1.style.display = 'block';
                section2.style.display = 'block';
                section3.style.display = 'none';
            }

            if (status === 'Assigned') {
                section3.style.display = 'block';
            }

        }

        // Call the function on page load
        document.addEventListener('DOMContentLoaded', function() {
            handleSectionVisibility(complaintStatus);
        });
    </script>
</body>

</html>