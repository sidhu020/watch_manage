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
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1><strong>Technician Management <i class="fas fa-user-ninja"></i></strong></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>pages/dashboard/admin.php">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="<?php echo BASE_URL; ?>pages/technician/show_techinician.php">Technician</a></li>
                                    <li class="breadcrumb-item active">Show</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
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
                            <table id="technicianTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Primary Mobile No</th>
                                        <th>Secondary Mobile No</th>
                                        <th>Address</th>
                                        <th>City</th>
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

                    <!-- Register Modal -->
                    <div class="modal fade" id="registerTechnicianModal" tabindex="-1" role="dialog" aria-labelledby="registerTechnicianModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                            <form id="registerTechnicianForm" novalidate>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="registerTechnicianModalLabel"><b>Register Technician</b></h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card card-success card-outline mt-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="registerTechnicianUsername" class="form-label">Username <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" autocomplete="off" name="username" id="registerTechnicianUsername" required>
                                                        <div class="invalid-feedback">Please enter a username.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="registerTechnicianPassword" class="form-label">Password <span class="text-danger"> * </span></label>
                                                        <input type="password" class="form-control shadow-none" name="password" id="registerTechnicianPassword" required>
                                                        <div class="invalid-feedback">Please enter a Password.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="registerTechnicianPrimaryMobile" class="form-label">Primary Mobile No <span class="text-danger"> * </span></label>
                                                        <input type="tel" class="form-control shadow-none" name="primaryMobile" id="registerTechnicianPrimaryMobile" autocomplete="off" pattern="[0-9]{10}" required>
                                                        <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="registerTechnicianSecondaryMobile" class="form-label">Secondary Mobile No <span class="text-danger"> * </span></label>
                                                        <input type="tel" class="form-control shadow-none" name="secondaryMobile" id="registerTechnicianSecondaryMobile" autocomplete="off" pattern="[0-9]{10}" required>
                                                        <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="registerTechnicianFirstName" class="form-label">First Name <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="firstName" id="registerTechnicianFirstName" required>
                                                        <div class="invalid-feedback">Please enter a first name.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="registerTechnicianLastName" class="form-label">Last Name <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="lastName" id="registerTechnicianLastName" required>
                                                        <div class="invalid-feedback">Please enter a last name.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="registerTechnicianAddress" class="form-label">Address <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="address" id="registerTechnicianAddress" required>
                                                        <div class="invalid-feedback">Please enter an address.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="registerTechnicianCity" class="form-label">City <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="city" id="registerTechnicianCity" required>
                                                        <div class="invalid-feedback">Please enter a city.</div>
                                                    </div>
                                                </div>
                                            </div><!-- /.card-body -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary shadow-none mr-2" id="resetButton">Reset</button>
                                        <button type="submit" class="btn btn-primary shadow-none">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Update Modal -->
                    <div class="modal fade" id="updateTechnicianModal" tabindex="-1" role="dialog" aria-labelledby="updateTechnicianModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                            <form id="updateTechnicianForm" novalidate>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="updateTechnicianModalLabel"><b>Update Technician</b></h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <h3 id="technicianUserName"> </h3>
                                        <div class="card card-primary card-outline mt-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <input type="hidden" id="technicianId" name="technicianId">
                                                    <div class="col-md-6">
                                                        <label for="technicianPrimaryMobile" class="form-label">Primary Mobile No <span class="text-danger"> * </span></label>
                                                        <input type="tel" class="form-control shadow-none" name="primaryMobile" id="technicianPrimaryMobile" pattern="[0-9]{10}" required>
                                                        <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="technicianSecondaryMobile" class="form-label">Secondary Mobile No <span class="text-danger"> * </span></label>
                                                        <input type="tel" class="form-control shadow-none" name="secondaryMobile" id="technicianSecondaryMobile" pattern="[0-9]{10}" required>
                                                        <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="technicianFirstName" class="form-label">First Name <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="firstName" id="technicianFirstName" required>
                                                        <div class="invalid-feedback">Please enter a first name.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="technicianLastName" class="form-label">Last Name <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="lastName" id="technicianLastName" required>
                                                        <div class="invalid-feedback">Please enter a last name.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="technicianAddress" class="form-label">Address <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="address" id="technicianAddress" required>
                                                        <div class="invalid-feedback">Please enter an address.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="technicianCity" class="form-label">City <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="city" id="technicianCity" required>
                                                        <div class="invalid-feedback">Please enter a city.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="technicianStatus" class="form-label">Technician Status</label>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="technicianStatus" name="isActive" value="Y">
                                                            <label class="custom-control-label" for="technicianStatus" id="statusLabel">Inactive</label>
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
            </div>
            <?php require_once('../../includes/footer.php') ?>
            <?php require_once('../../includes/asidde-end.php') ?>

        </div>

        <?php require_once('../../includes/script.php')  ?>

        <script>
            $(document).ready(function() {

                // Initialize the technician DataTable
                var table = $('#technicianTable').DataTable({
                    "processing": true, // Show a processing indicator
                    "serverSide": true, // Server-side processing for pagination, sorting, and searching
                    "ajax": {
                        "url": "../../controllers/Technician/ajax/fetchTechnicians.php", // URL of the PHP file handling the AJAX request
                        "type": "POST", // Type of HTTP request
                        "data": {
                            "action": "getAllData" // Action to be performed (fetch data)
                        },
                        "dataSrc": function(json) {
                            if (json.error) {
                                alert(json.error); // Alert the user if there's an error
                                return []; // Return an empty array if there's an error
                            } else {
                                return json.data; // Otherwise, return the data
                            }
                        }
                    },
                    "columns": [
                        // { "data": "id" },  // Technician ID
                        {
                            "data": "username", // Username
                            "render": function(data, type, row) {
                                var statusDot = '<span class="badge badge-pill badge-' + (row.isactive == 'Y' ? 'success' : 'danger') + ' ml-1 p-1"> </span>';
                                return data + statusDot; // Show username with a status dot
                            }
                        },
                        {
                            "data": "firstname"
                        }, // First name
                        {
                            "data": "lastname"
                        }, // Last name
                        {
                            "data": "primarymobileno"
                        }, // Primary mobile number
                        {
                            "data": "secondmobileno"
                        }, // Secondary mobile number
                        {
                            "data": "address", // Address
                            "orderable": false // Disable sorting for the address column
                        },
                        {
                            "data": "city"
                        },
                        {
                            "data": null, // Action buttons (Edit)
                            "orderable": false, // Disable sorting for this column
                            "render": function(data, type, row) {
                                return `  <button
    class="btn btn-outline-warning btn-edit"
    data-id="${row.id}"
    title="Edit"
  >
    <i class="fas fa-pencil-alt"></i>
  </button>`;
                            }
                        }
                    ],
                    "responsive": true, // Make the table responsive
                    "pageLength": 10, // Default number of rows per page
                    "lengthChange": true, // Allow the user to change the number of rows displayed
                    "lengthMenu": [5, 10, 25, 50, 100], // Options for the rows-per-page dropdown
                    "autoWidth": false, // Disable automatic column width calculation
                    "order": [
                        [0, 'asc']
                    ], // Default sorting: ascending by ID
                    "language": {
                        "paginate": {
                            "previous": "<i class='fas fa-angle-left'></i>", // Customize the "previous" pagination button
                            "next": "<i class='fas fa-angle-right'></i>" // Customize the "next" pagination button
                        }
                    },
                    // "dom": 'lBfrtip',  // Include the length menu and buttons
                });



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
                $("#registerTechnicianForm").on("submit", function(event) {
                    event.preventDefault();
                    var form = $(this);

                    // Check username uniqueness
                    checkUsername(function(isUnique) {
                        if (isUnique) {
                            submitForm(form, '../../controllers/Technician/process_technician.php', function() {
                                table.ajax.reload();
                                resetForm(form);
                                $('#registerTechnicianModal').modal('hide');
                            });
                        } else {
                            event.stopPropagation();
                        }
                    });
                });

                // Update Form Submission
                $('#updateTechnicianForm').on('submit', function(e) {
                    e.preventDefault();
                    var form = $(this);

                    submitForm(form, '../../controllers/Technician/processUpdate_technician.php', function() {
                        $('#updateTechnicianModal').modal('hide');
                        table.ajax.reload();
                        resetForm(form);
                    });
                });

                // Edit Technician
                $('#technicianTable').on('click', '.btn-edit', function() {
                    var technicianId = $(this).data('id');

                    $.ajax({
                        url: '../../controllers/Technician/ajax/fetchTechnicians.php',
                        method: 'POST',
                        data: {
                            action: 'getById',
                            id: technicianId
                        },
                        dataType: 'json',
                        success: function(response) {
                            // Populate the form fields with fetched data
                            $('#technicianId').val(response.id);
                            // $('#Technician_password').val(response.password);
                            $('#technicianUserName').text(response.username);
                            $('#technicianPrimaryMobile').val(response.primarymobileno);
                            $('#technicianSecondaryMobile').val(response.secondmobileno);
                            $('#technicianFirstName').val(response.firstname);
                            $('#technicianLastName').val(response.lastname);
                            $('#technicianAddress').val(response.address);
                            $('#technicianCity').val(response.city);

                            // Update status switch and label
                            if (response.isactive === 'Y') {
                                $('#technicianStatus').prop('checked', true);
                                $('#statusLabel').text('Active');
                            } else {
                                $('#technicianStatus').prop('checked', false);
                                $('#statusLabel').text('Inactive');
                            }

                            // Show the modal
                            $('#updateTechnicianModal').modal('show');
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });

                // Status Label Update on Switch Toggle
                $('#technicianStatus').change(function() {
                    if ($(this).is(':checked')) {
                        $('#statusLabel').text('Active');
                        $(this).val('Y');
                    } else {
                        $('#statusLabel').text('Inactive');
                        $(this).val('N');
                    }
                });

                // Handle Modal Hidden Event to Reset Form
                $('#updateTechnicianModal').on('hidden.bs.modal', function() {
                    resetForm($('#updateTechnicianForm'));
                });

                // Handle Username Input to Check Uniqueness
                $("#registerTechnicianUsername").on("input", function() {
                    checkUsername(function() {});
                });

                // Check Username Uniqueness
                function checkUsername(callback) {
                    var registerTechnicianUsername = $("#registerTechnicianUsername").val();

                    if (registerTechnicianUsername.length > 0) {
                        $.ajax({
                            url: '../../controllers/Technician/process_technician.php',
                            type: 'POST',
                            data: {
                                registerTechnicianUsername: registerTechnicianUsername,
                                username_check: true
                            },
                            success: function(response) {
                                if (response.exists) {
                                    $("#registerTechnicianUsername").addClass("is-invalid");
                                    $("#registerTechnicianUsername").siblings(".invalid-feedback").text("This username is already taken.");
                                    callback(false);
                                } else {
                                    $("#registerTechnicianUsername").removeClass("is-invalid");
                                    $("#registerTechnicianUsername").siblings(".invalid-feedback").text("");
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
                        $("#registerTechnicianUsername").removeClass("is-invalid");
                        $("#registerTechnicianUsername").siblings(".invalid-feedback").text("");
                        callback(true);
                    }
                }

                // Handle Reset Button Click (Optional)
                $("#resetButton").on("click", function() {
                    resetForm($('#registerTechnicianForm'));
                });
            });
        </script>

    </body>

    </html>