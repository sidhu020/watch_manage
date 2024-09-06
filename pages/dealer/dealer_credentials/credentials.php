<?php
require_once '../../../config/config.php';
require_once '../../../classes/Database.php';
require_once '../../../classes/BaseModel.php';
require_once '../../../classes/Dealer.php';
require_once '../../../classes/Dealer_Credentials.php';


$dealerId = $_GET['id'];
//$currentDealer = $dealer->getDealerById($dealerId); // Assuming this function exists

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
                            <h1><strong>Dealer Credentials Info <i class="fas fa-fingerprint"></i></strong></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active"><a href="<?php echo BASE_URL; ?>pages/dealer/show.php">Dealer</a></li>
                                <li class="breadcrumb-item active">Credentials</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <div class="container-fluid">
                <!-- Dealer Info -->
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div>
                            <div class="section-1">
                                <div class="row row-gap-2">
                                    <!-- // id, name, isactive, primarymobileno, secondmobileno, emailaddress, address, city -->
                                    <div class="col-md-6">
                                        <label for="Dealer_Name" class="form-label">Name</label>
                                        <h1 id="dealerName"></h1>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="Dealer_City" class="form-label">City</label>
                                        <h3 id="dealerCity"></h3>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Dealer_PMobile_No" class="form-label">Primary Mobile No:-</label>
                                        <h4 id="dealerPrimaryMobile"></h4>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Dealer_SMobile_No" class="form-label">Second Mobile No:-</label>
                                        <h4 id="dealerSecondaryMobile"></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="Dealer_email" class="form-label">Email</label>
                                        <h4 id="dealerEmail"></h4>
                                    </div>
                                    <div class="col-10">
                                        <label for="Dealer_Address" class="form-label">Address</label>
                                        <h4 id="dealerAddress"></h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <!-- /.Dealer Info -->
            </div>

            <div class="container-fluid">
                <div class="card card-warning card-outline">
                    <div class="card-header d-flex justify-content-between">
                        <div class="ml-auto">
                            <!-- Button to open the modal -->
                            <button type="button" class="btn btn-block bg-gradient-success" data-toggle="modal" data-target="#registerDealerCredentialsModal">
                                <i class="fas fa-user-plus"></i> Register
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dealerCredentialTable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Mobile No</th>
                                    <th>Role Type</th>
                                    <th>IsActive</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table rows will be inserted here via AJAX -->
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <!-- Register Modal -->
            <div class="modal fade" id="registerDealerCredentialsModal" tabindex="-1" role="dialog" aria-labelledby="registerDealerCredentialsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <form id="registerDealerCredentialsForm" novalidate>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="registerDealerCredentialsModalLabel">
                                    <b>Register Dealer Credentials</b>
                                </h2>
                                <button
                                    type="button"
                                    class="close"
                                    data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card card-success card-outline mt-2">
                                    <div class="card-body">
                                        <input type="hidden" name="currentDealerId" id="currentDealerId" value="<?php echo $dealerId; ?>" />
                                        <div class="row row-gap-2">
                                            <div class="col-md-6">
                                                <label for="dealerUser_username" class="form-label">Username <span class="text-danger"> * </span></label>
                                                <input
                                                    type="text"
                                                    class="form-control shadow-none"
                                                    name="dealerUser_username"
                                                    id="dealerUser_username"
                                                    required />
                                                <div class="invalid-feedback">Please enter a username.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dealerUser_password" class="form-label">Password <span class="text-danger"> * </span></label>
                                                <input
                                                    type="password"
                                                    class="form-control shadow-none"
                                                    name="dealerUser_password"
                                                    id="dealerUser_password"
                                                    required />
                                                <div class="invalid-feedback">Please enter a password.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dealerUser_firstname" class="form-label">Firstname <span class="text-danger"> * </span></label>
                                                <input
                                                    type="text"
                                                    class="form-control shadow-none"
                                                    name="dealerUser_firstname"
                                                    id="dealerUser_firstname"
                                                    required />
                                                <div class="invalid-feedback">Please enter a firstname.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dealerUser_lastname" class="form-label">Lastname <span class="text-danger"> * </span></label>
                                                <input
                                                    type="text"
                                                    class="form-control shadow-none"
                                                    name="dealerUser_lastname"
                                                    id="dealerUser_lastname"
                                                    required />
                                                <div class="invalid-feedback">Please enter a lastname.</div>
                                            </div>
                                            <div class="col-6">
                                                <label for="dealerUser_mobile" class="form-label">Mobile No <span class="text-danger"> * </span></label>
                                                <input
                                                    type="text"
                                                    class="form-control shadow-none"
                                                    name="dealerUser_mobile"
                                                    id="dealerUser_mobile"
                                                    pattern="[0-9]{10}" 
                                                    required />
                                                <div class="invalid-feedback">
                                                    Please enter a mobile number.
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dealerUser_role" class="form-label">Role Type <span class="text-danger"> * </span></label>
                                                <select
                                                    class="form-control shadow-none"
                                                    name="dealerUser_role"
                                                    id="dealerUser_role"
                                                    required>
                                                    <option value="">Select Role Type</option>
                                                    <option value="Reception">Reception</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Other User">Other User</option>
                                                </select>
                                                <div class="invalid-feedback">Please select a role type.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="reset"
                                    class="btn btn-secondary shadow-none mr-2"
                                    id="resetButton">
                                    Reset
                                </button>
                                <button type="submit" class="btn btn-primary shadow-none">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update DealerCredentials Modal -->
            <div class="modal fade" id="updateDealerCredentialsModal" tabindex="-1" role="dialog" aria-labelledby="updateDealerCredentialsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <form id="updateDealerCredentialsForm" novalidate>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="updateDealerCredentialsModalLabel"><b>Update Dealer Credentials</b></h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h3 id="dealerUserUserName"> </h3>
                                <div class="card card-primary card-outline mt-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <input type="hidden" id="dealerUserId" name="dealerUserId">
                                            <div class="col-md-6">
                                                <label for="dealerUserFirstName" class="form-label">First Name</label>
                                                <input type="text" class="form-control shadow-none" name="dealerUserFirstName" id="dealerUserFirstName" required>
                                                <div class="invalid-feedback">Please enter a first name.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dealerUserLastName" class="form-label">Last Name</label>
                                                <input type="text" class="form-control shadow-none" name="dealerUserLastName" id="dealerUserLastName" required>
                                                <div class="invalid-feedback">Please enter a last name.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dealerUserMobile" class="form-label">Mobile No</label>
                                                <input type="tel" class="form-control shadow-none" name="dealerUserMobile" id="dealerUserMobile" pattern="[0-9]{10}" required>
                                                <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dealerUserStatus" class="form-label">Dealer User Status</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="dealerUserStatus" name="isActive" value="Y">
                                                    <label class="custom-control-label" for="dealerUserStatus" id="statusLabel">Inactive</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary shadow-none">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- /.content-wrapper -->
        <?php require_once('../../../includes/footer.php') ?>
        <?php require_once('../../../includes/asidde-end.php') ?>
    </div>
    <!-- ./wrapper -->
    <?php require_once('../../../includes/script.php') ?>
    <!-- Page specific script -->
    <script>
        $(document).ready(function() {

            var dealerId = "<?php echo $dealerId; ?>"; // Use the PHP variable to get the dealer ID
            // Load the dealer info on page load
            loadDealerInfo();

            // Initialize the dealerCredentialTable DataTable
            var table = $("#dealerCredentialTable").DataTable({
                processing: true, // Show a processing indicator
                serverSide: true, // Server-side processing for pagination, sorting, and searching
                ajax: {
                    url: "../../../controllers/dealer/dealer_credentials/ajax/fetchDealerCredentials.php", // URL of the PHP file handling the AJAX request
                    type: "POST", // Type of HTTP request
                    data: function(d) {
                        d.action = "getAlldealerCredentialsDataByDealerId"; // Action to be performed (fetch data)
                        d.dealerId = dealerId; // Pass the dealerId from PHP to JavaScript
                    },
                    dataSrc: function(json) {
                        if (json.error) {
                            alert(json.error); // Alert the user if there's an error
                            return []; // Return an empty array if there's an error
                        } else {
                            return json.data; // Otherwise, return the data
                        }
                    },
                },
                columns: [{
                        data: "username",
                        "render": function(data, type, row) {
                            var statusDot = '<span class="badge badge-pill badge-' + (row.isactive == 'Y' ? 'success' : 'danger') + ' ml-1 p-1"> </span>';
                            return data + statusDot; // Show username with a status dot
                        }
                    }, // First name
                    {
                        data: "firstname",
                    }, // Primary mobile number
                    {
                        data: "lastname",
                    }, // Secondary mobile number
                    {
                        data: "mobileno", // Address
                    },
                    {
                        data: "roletype",
                        orderable: false, // Disable sorting for the address column
                    },
                    {
                        data: "isactive",
                        orderable: false, // Disable sorting for the address column
                    }, // Last name
                    {
                        "data": null, // Action buttons (Edit)
                        "orderable": false, // Disable sorting for this column
                        "render": function(data, type, row) {
                            return `<div class="d-flex flex-row justify-content-around"><button
                                        class="btn btn-outline-warning btn-edit"
                                        data-id="${row.id}"
                                        title="Edit"
                                    >
                                        <i class="fas fa-pencil-alt"></i>
                                    </button></div>`;
                        }
                    }
                ],
                responsive: true, // Make the table responsive
                pageLength: 5, // Default number of rows per page
                lengthChange: true, // Allow the user to change the number of rows displayed
                lengthMenu: [5, 10, 25, 50, 100], // Options for the rows-per-page dropdown
                autoWidth: true, // Disable automatic column width calculation
                order: [
                    [0, "asc"]
                ], // Default sorting: ascending by ID
                language: {
                    paginate: {
                        previous: "<i class='fas fa-angle-left'></i>", // Customize the "previous" pagination button
                        next: "<i class='fas fa-angle-right'></i>", // Customize the "next" pagination button
                    },
                },
                // "dom": 'lBfrtip',  // Include the length menu and buttons
            });

            // Function to fetch and display dealer info
            function loadDealerInfo() {
                $.ajax({
                    url: "../../../controllers/dealer/ajax/fetchDealer.php",
                    type: "POST",
                    data: {
                        action: "getDealerById", // Pass the correct action
                        id: dealerId // Pass the dealerId from PHP to JavaScript
                    },
                    dataType: "json",
                    success: function(response) {
                        // Populate the dealer info card
                        $('#dealerName').text(response.name);
                        $('#dealerCity').text(response.city);
                        $('#dealerPrimaryMobile').text(response.primarymobileno);
                        $('#dealerSecondaryMobile').text(response.secondmobileno);
                        $('#dealerEmail').text(response.emailaddress);
                        $('#dealerAddress').text(response.address);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + error);
                    }
                });
            }

            // Function to handle form reset and clear validation
            function resetForm(form) {
                form[0].reset();
                form.removeClass('was-validated');
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.invalid-feedback').text('');
            }

            // Function to handle AJAX form submission with validation
            function submitForm(form, url, successCallback) {
                form.addClass('was-validated');

                if (form[0].checkValidity() === true) {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: form.serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.status.trim() === 'success') {
                                $(document).Toasts('create', {
                                    class: response.class,
                                    title: response.title,
                                    subtitle: response.subtitle,
                                    body: response.body,
                                    delay: 5000,
                                    autohide: true
                                });
                                successCallback();
                            } else {
                                alert(response.message); // Handle response message
                            }

                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            }

            // Registration Form Submission
            $("#registerDealerCredentialsForm").on("submit", function(event) {
                event.preventDefault();
                var form = $(this);

                // Check username uniqueness
                checkUsername(function(isUnique) {
                    if (isUnique) {
                        submitForm(form, '../../../controllers/dealer/dealer_credentials/process_dealer_Credentials.php', function() {
                            table.ajax.reload();
                            resetForm(form);
                            $('#registerDealerCredentialsModal').modal('hide');
                        });
                    } else {
                        event.stopPropagation();
                    }
                });
            });

            // Handle Username Input to Check Uniqueness
            $("#dealerUser_username").on("input", function() {
                checkUsername(function() {});
            });

            // Check Username Uniqueness
            function checkUsername(callback) {
                var dealerUser_username = $("#dealerUser_username").val();

                if (dealerUser_username.length > 0) {
                    $.ajax({
                        url: '../../../controllers/dealer/dealer_credentials/process_dealer_Credentials.php',
                        type: 'POST',
                        data: {
                            dealerUser_username: dealerUser_username,
                            username_check: true
                        },
                        success: function(response) {
                            if (response.exists) {
                                $("#dealerUser_username").addClass("is-invalid");
                                $("#dealerUser_username").siblings(".invalid-feedback").text("This username is already taken.");
                                callback(false);
                            } else {
                                $("#dealerUser_username").removeClass("is-invalid");
                                $("#dealerUser_username").siblings(".invalid-feedback").text("");
                                callback(true);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log('Full Response:', xhr.responseText);
                            alert('Error: ' + xhr.responseText);
                            callback(false);
                        }
                    });
                } else {
                    $("#dealerUser_username").removeClass("is-invalid");
                    $("#dealerUser_username").siblings(".invalid-feedback").text("");
                    callback(true);
                }
            }

            // Update Form Submission
            $('#updateDealerCredentialsForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);

                submitForm(form, '../../../controllers/dealer/dealer_credentials/process_update_dealer_credentials.php', function() {
                    $('#updateDealerCredentialsModal').modal('hide');
                    table.ajax.reload();
                    resetForm(form);
                });
            });

            // Edit DealerCredential
            $('#dealerCredentialTable').on('click', '.btn-edit', function() {
                var dealerCredentialId = $(this).data('id');

                $.ajax({
                    url: '../../../controllers/dealer/dealer_credentials/ajax/fetchDealerCredentials.php',
                    method: 'POST',
                    data: {
                        action: 'getDealerCredentialsById',
                        id: dealerCredentialId
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Populate the form fields with fetched data
                        $('#dealerUserUserName').text(response.username);
                        $('#dealerUserId').val(response.id);
                        $('#dealerUserFirstName').val(response.firstname);
                        $('#dealerUserLastName').val(response.lastname);
                        $('#dealerUserMobile').val(response.mobileno);
                        $('#dealerUserStatus').val(response.isactive);

                        // Update status switch and label
                        if (response.isactive === 'Y') {
                            $('#dealerUserStatus').prop('checked', true);
                            $('#statusLabel').text('Active');
                        } else {
                            $('#dealerUserStatus').prop('checked', false);
                            $('#statusLabel').text('Inactive');
                        }

                        // Show the modal
                        $('#updateDealerCredentialsModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Status Label Update on Switch Toggle
            $('#dealerUserStatus').change(function() {
                if ($(this).is(':checked')) {
                    $('#statusLabel').text('Active');
                    $(this).val('Y');
                } else {
                    $('#statusLabel').text('Inactive');
                    $(this).val('N');
                }
            });

            // Handle Modal Hidden Event to Reset Form
            $('#updateDealerCredentialsModal').on('hidden.bs.modal', function() {
                resetForm($('#updateDealerCredentialsForm'));
            });

            // Handle Reset Button Click (Optional)
            $("#resetButton").on("click", function() {
                resetForm($('#registerDealerCredentialsForm'));
            });



        });
    </script>


</body>

</html>