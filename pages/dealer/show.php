<?php
require_once '../../config/config.php';
require_once '../../classes/Database.php';
require_once '../../classes/BaseModel.php';
require_once '../../classes/Dealer.php';

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
                            <h1><strong>Dealer Managment <i class="fas fa-users"></i></strong></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dealer</li>
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
                            <button type="button" class="btn btn-block bg-gradient-success" data-toggle="modal" data-target="#registerDealerModal">
                                <i class="fas fa-user-plus"></i> Register
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header id, name, isactive, primarymobileno, secondmobileno, emailaddress, address, city -->
                    <div class="card-body">
                        <table id="dealerTable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Dealer Name</th>
                                    <th>Dealer Pri. Number</th>
                                    <th>Dealer Sec. Number</th>
                                    <th>Dealer Mail</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Dealer Name</th>
                                    <th>Dealer Pri. Number</th>
                                    <th>Dealer Sec. Number</th>
                                    <th>Dealer Mail</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->

                    <!-- Dealer Register Modal -->
                    <div class="modal fade" id="registerDealerModal" tabindex="-1" role="dialog" aria-labelledby="registerDealerModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <form id="registerDealerForm" novalidate>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="registerDealerModalLabel"><b>Register New Dealer</b></h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card card-success card-outline mt-2">
                                            <div class="card-body">
                                                <div class="row row-gap-2">
                                                    <div class="col-md-6">
                                                        <label for="Dealer_Name" class="form-label">Dealer Name <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="Dealer_Name" id="Dealer_Name" required>
                                                        <div class="invalid-feedback">Please enter a Dealer Name.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="Dealer_PMobile_No" class="form-label">Primary Mobile No <span class="text-danger"> * </span></label>
                                                        <input type="tel" class="form-control shadow-none" name="Dealer_PMobile_No" id="Dealer_PMobile_No" autocomplete="off" pattern="[0-9]{10}" required>
                                                        <div class="invalid-feedback">Please enter a Primary Mobile No.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="Dealer_SMobile_No" class="form-label">Second Mobile No <span class="text-danger"> * </span></label>
                                                        <input type="tel" class="form-control shadow-none" name="Dealer_SMobile_No" id="Dealer_SMobile_No" autocomplete="off" pattern="[0-9]{10}" required>
                                                        <div class="invalid-feedback">Please enter a Second Mobile No.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="Dealer_email" class="form-label">Dealer Email <span class="text-danger"> * </span></label>
                                                        <input type="email" class="form-control shadow-none" name="Dealer_email" id="Dealer_email" required>
                                                        <div class="invalid-feedback">Please enter a Dealer Email.</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="Dealer_Address" class="form-label">Dealer Address <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="Dealer_Address" id="Dealer_Address" placeholder="1234 Main St" required>
                                                        <div class="invalid-feedback">Please enter a Dealer Address.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="Dealer_City" class="form-label">Dealer City <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="Dealer_City" id="Dealer_City" required>
                                                        <div class="invalid-feedback">Please enter a Dealer City.</div>
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


                    <!-- Update Dealer Modal -->
                    <div class="modal fade" id="updateDealerModal" tabindex="-1" role="dialog" aria-labelledby="updateDealerModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                            <form id="updateDealerForm" novalidate>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="updateDealerModalLabel"><b>Update Dealer</b></h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card card-primary card-outline mt-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <input type="hidden" id="dealerId" name="dealerId">
                                                    <div class="col-md-6">
                                                        <label for="dealerName" class="form-label">Dealer Name <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="dealerName" id="dealerName" required>
                                                        <div class="invalid-feedback">Please enter a Dealer name.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="dealerPrimaryMobile" class="form-label">Primary Mobile No <span class="text-danger"> * </span></label>
                                                        <input type="tel" class="form-control shadow-none" name="dealerPrimaryMobile" id="dealerPrimaryMobile" pattern="[0-9]{10}" required>
                                                        <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="dealerSecondaryMobile" class="form-label">Secondary Mobile No <span class="text-danger"> * </span></label>
                                                        <input type="tel" class="form-control shadow-none" name="dealerSecondaryMobile" id="dealerSecondaryMobile" pattern="[0-9]{10}" required>
                                                        <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="dealerEmail" class="form-label">Dealer Email <span class="text-danger"> * </span></label>
                                                        <input type="email" class="form-control shadow-none" name="dealerEmail" id="dealerEmail" required>
                                                        <div class="invalid-feedback">Please enter a valid Dealer Email.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="dealerAddress" class="form-label">Address <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="dealerAddress" id="dealerAddress" required>
                                                        <div class="invalid-feedback">Please enter an address.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="dealerCity" class="form-label">City <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="dealerCity" id="dealerCity" required>
                                                        <div class="invalid-feedback">Please enter a city.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="dealerStatus" class="form-label">Dealer Status</label>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="dealerStatus" name="isActive" value="Y">
                                                            <label class="custom-control-label" for="dealerStatus" id="statusLabel">Inactive</label>
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
            </div><!-- /.container-fluid -->
        </div>

        <?php require_once('../../includes/footer.php') ?>
        <?php require_once('../../includes/asidde-end.php') ?>
    </div>

    <?php require_once('../../includes/script.php')  ?>
    <!-- Page specific script -->
    <script>
        $(document).ready(function() {

            // Initialize the Dealer DataTable
            var table = $('#dealerTable').DataTable({
                "processing": true, // Show a processing indicator
                "serverSide": true, // Server-side processing for pagination, sorting, and searching
                "ajax": {
                    "url": "../../controllers/dealer/ajax/fetchDealer.php", // URL of the PHP file handling the AJAX request
                    "type": "POST", // Type of HTTP request
                    "data": {
                        "action": "getAllDealerData" // Action to be performed (fetch data)
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
                "columns": [{
                        "data": "name",
                        "render": function(data, type, row) {
                            var statusDot = '<span class="badge badge-pill badge-' + (row.isactive == 'Y' ? 'success' : 'danger') + ' ml-1 p-1"> </span>';
                            return data + statusDot; // Show username with a status dot
                        }
                    }, // First name
                    {
                        "data": "primarymobileno"
                    }, // First name
                    {
                        "data": "secondmobileno"
                    }, // First name
                    {
                        "data": "emailaddress",
                        "orderable": false, // Disable sorting for this column
                    }, // First name
                    {
                        "data": "address",
                        "orderable": false, // Disable sorting for this column
                    }, // First name
                    {
                        "data": "city",
                        "orderable": false, // Disable sorting for this column
                    }, // First name
                    {
                        "data": "isactive",
                        "orderable": false, // Disable sorting for this column

                    }, // First name
                    {
                        "data": null,
                        "orderable": false, // Disable sorting for this column
                        "render": function(data, type, row) {
                            return `<div class="d-flex flex-row justify-content-around"><button title="Edit Dealer Credentials"  class="btn btn-success btn-sm credentials-btn" data-id="${row.id}"><i class="fas fa-user-lock"></i> Credentials </button>
                                     <button title="Edit Dealer Info" class="btn btn-info btn-sm btn-edit ml-1" data-id="${row.id}"><i class="fas fa-pencil-alt"></i> Edit </button></div>`;
                        }

                    }, // First name
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
            $("#registerDealerForm").on("submit", function(event) {
                event.preventDefault();
                var form = $(this);
                submitForm(form, '../../controllers/dealer/process_dealer.php', function() {
                    table.ajax.reload();
                    resetForm(form);
                    $('#registerDealerModal').modal('hide');
                });
            });

            // Update Form Submission
            $('#updateDealerForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);

                submitForm(form, '../../controllers/dealer/updateDealer_process.php', function() {
                    $('#updateDealerModal').modal('hide');
                    table.ajax.reload();
                    resetForm(form);
                });
            });

            // Edit Technician on click model show
            $('#dealerTable').on('click', '.btn-edit', function() {
                var dealerId = $(this).data('id');

                $.ajax({
                    url: '../../controllers/dealer/ajax/fetchDealer.php',
                    method: 'POST',
                    data: {
                        action: 'getDealerById',
                        id: dealerId
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Populate the form fields with fetched data
                        $('#dealerId').val(response.id);
                        // $('#Technician_password').val(response.password);
                        $('#dealerName').val(response.name);
                        $('#dealerPrimaryMobile').val(response.primarymobileno);
                        $('#dealerSecondaryMobile').val(response.secondmobileno);
                        $('#dealerEmail').val(response.emailaddress);
                        $('#dealerAddress').val(response.address);
                        $('#dealerCity').val(response.city);

                        // Update status switch and label
                        if (response.isactive === 'Y') {
                            $('#dealerStatus').prop('checked', true);
                            $('#statusLabel').text('Active');
                        } else {
                            $('#dealerStatus').prop('checked', false);
                            $('#statusLabel').text('Inactive');
                        }

                        // Show the modal
                        $('#updateDealerModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Status Label Update on Switch Toggle
            $('#dealerStatus').change(function() {
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


            // Handle Reset Button Click (Optional)
            $("#resetButton").on("click", function() {
                resetForm($('#registerDealerForm'));
            });

            $(document).on('click', '.credentials-btn', function() {
                var id = $(this).data('id');
                window.location.href = '<?php echo BASE_URL; ?>pages/dealer/dealer_credentials/credentials.php?id=' + id;
            });
        });
    </script>

</body>

</html> 