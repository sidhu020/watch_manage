<?php
require_once '../../config/config.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management</title>
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
                            <h1><b><i class="fas fa-user-alt"></i> Customer Management</b></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>pages/dashboard/admin.php">Home</a></li>
                                <li class="breadcrumb-item active"><a href="<?php echo BASE_URL; ?>pages/technician/show_techinician.php">Customer</a></li>
                                <li class="breadcrumb-item active">Show</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="container-fluid">
                <div class="card card-warning card-outline">
                    <div class="card-header d-flex justify-content-between">
                        <div class="mr-auto">   
                        </div>
                        <div class="ml-auto">
                            <!-- Button to open the modal -->
                            <button type="button" class="btn btn-block bg-gradient-success" data-toggle="modal" data-target="#customerModal" id="showRegisterModal">
                                <i class="fas fa-user-plus"></i> Register
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="customerTable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Customer Address</th>
                                    <th>Customer City</th>
                                    <th>Mobile Number</th>
                                    <th>WhatsApp Number</th>
                                    <th>LastMessage Send Date</th>
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

                <!-- Customer Modal -->
                <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                        <form id="customerForm" novalidate>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title font-weight-bold" id="customerModalLabel">Customer Form</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card card-success card-outline mt-2">
                                        <div class="card-body">
                                            <div class="row">
                                                <!-- Common Fields -->
                                                <div class="col-md-6">
                                                    <label for="customerName" class="form-label">Customer Name <span class="text-danger"> * </span></label>
                                                    <input type="text" class="form-control shadow-none" autocomplete="off" name="customerName" id="customerName" required>
                                                    <div class="invalid-feedback">Please enter the customer name.</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="customerAddress" class="form-label">Address <span class="text-danger"> * </span></label>
                                                    <input type="text" class="form-control shadow-none" name="customerAddress" id="customerAddress" required>
                                                    <div class="invalid-feedback">Please enter the address.</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="customerCity" class="form-label">City <span class="text-danger"> * </span></label>
                                                    <input type="text" class="form-control shadow-none" name="customerCity" id="customerCity" required>
                                                    <div class="invalid-feedback">Please enter the city.</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="customerMobile" class="form-label">Mobile Number <span class="text-danger"> * </span></label>
                                                    <input type="tel" class="form-control shadow-none" name="customerMobile" id="customerMobile" autocomplete="off" pattern="[0-9]{10}" required>
                                                    <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="customerWhatsApp" class="form-label">WhatsApp Number</label>
                                                    <input type="tel" class="form-control shadow-none" name="customerWhatsApp" id="customerWhatsApp" autocomplete="off" pattern="[0-9]{10}">
                                                    <div class="invalid-feedback">Please enter a valid 10-digit WhatsApp number.</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="customerProductCompany" class="form-label">Product Company</label>
                                                    <input type="text" class="form-control shadow-none" name="customerProductCompany" id="customerProductCompany">
                                                    <div class="invalid-feedback">Please enter the product company name.</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="customerProductModel" class="form-label">Product Model</label>
                                                    <input type="text" class="form-control shadow-none" name="customerProductModel" id="customerProductModel">
                                                    <div class="invalid-feedback">Please enter the product model.</div>
                                                </div>

                                                <!-- Update Only Fields -->
                                                <div class="col-md-6 d-none" id="updateFields">
                                                    <label for="customerLastMessageSendDate" class="form-label">Last Message Send Date</label>
                                                    <input type="date" class="form-control shadow-none" name="customerLastMessageSendDate" id="customerLastMessageSendDate">
                                                    <div class="invalid-feedback">Please enter the last message send date.</div>
                                                </div>

                                                <!-- Hidden Field for ID -->
                                                <input type="hidden" name="id" id="id">
                                                <input type="hidden" name="formMode" id="formMode" value="register">
                                            </div>
                                        </div><!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary shadow-none mr-2" id="resetButton">Reset</button>
                                    <button type="submit" class="btn btn-primary shadow-none">Submit</button>
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
            var table = $('#customerTable').DataTable({
                "processing": true, // Show a processing indicator
                "serverSide": true, // Server-side processing for pagination, sorting, and searching
                "ajax": {
                    "url": "../../controllers/customer/ajax/fetchCustomer.php", // URL of the PHP file handling the AJAX request
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
                        "data": "CustomerName", // Username
                        "render": function(data, type, row) {
                            var statusDot = '<span class="badge badge-pill badge-' + (row.IsActive == 'Y' ? 'success' : 'danger') + ' ml-1 p-1"> </span>';
                            return data + statusDot; // Show username with a status dot
                        }
                    },
                    {
                        "data": "CustomerAddress"
                    }, // First name
                    {
                        "data": "CustomerCity"
                    }, // Last name
                    {
                        "data": "MobileNumber"
                    }, // Primary mobile number
                    {
                        "data": "WhatsAppNumber"
                    }, // Secondary mobile number
                    {
                        "data": "LastMessageSendDate", // Address
                        "orderable": false // Disable sorting for the address column
                    },
                    {
                        "data": "IsActive",
                        "orderable": false // Disable sorting for the address column
                    },
                    {
                        "data": null, // Action buttons (Edit)
                        "orderable": false, // Disable sorting for this column
                        "render": function(data, type, row) {
                            return `<button
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




            // Show modal for registering a new customer
            $('#showRegisterModal').click(function() {
                $('#customerModalLabel').text('Register New Customer');
                $('#formMode').val('register');
                $('#updateFields').addClass('d-none');
                $('#customerModal').modal('show');
            });

           // Form submission handler
            $('#customerForm').submit(function(event) {
                event.preventDefault();

                // Check if the form is valid
                if (this.checkValidity() === false) {
                    event.stopPropagation();
                    $(this).addClass('was-validated');
                    return;
                }

                var formMode = $('#formMode').val();
                var formData = $(this).serialize();

                if (formMode === 'register') {
                    // Handle register logic
                    $.ajax({
                        url: '../../controllers/customer/process_customer.php',
                        type: 'POST',
                        data: formData,
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
                            table.ajax.reload();
                            //alert('Customer registered successfully!');
                            $('#customerModal').modal('hide');
                                successCallback();
                            } else {
                                alert(response.message); // Handle response message
                            }
                        },
                        error: function() {
                            // Handle error
                            alert('Error registering customer.');
                        }
                    });
                } else if (formMode === 'update') {
                    // Handle update logic
                    $.ajax({
                        url: '../../controllers/customer/process_updateCustomer.php',
                        type: 'POST',
                        data: formData,
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
                            table.ajax.reload();
                            //alert('Customer registered successfully!');
                            $('#customerModal').modal('hide');
                                successCallback();
                            } else {
                                alert(response.message); // Handle response message
                            }
                        },
                        error: function() {
                            // Handle error
                            alert('Error updating customer.');
                        }
                    });
                }
            });

            // Handle edit button click
            $('#customerTable').on('click', '.btn-edit', function() {
                var customerId = $(this).data('id'); // Get the customer ID from the button

                // Fetch customer data using AJAX
                $.ajax({
                    url: '../../controllers/customer/ajax/fetchCustomer.php', // URL to fetch the data
                    type: 'POST',
                    data: {
                        action: 'getById',
                        id: customerId
                    }, // Send the customer ID
                    success: function(response) {
                        // Parse the response (assuming it's JSON)
                        var customerData = JSON.parse(response);

                        // Populate the form fields with the fetched data
                        $('#customerModalLabel').text('Update Customer');
                        $('#formMode').val('update');
                        $('#updateFields').removeClass('d-none'); // Show update-specific fields

                        // Populate form fields
                        $('#id').val(customerData.id);
                        $('#customerName').val(customerData.CustomerName);
                        $('#customerName').val(customerData.CustomerName);
                        $('#customerAddress').val(customerData.CustomerAddress);
                        $('#customerCity').val(customerData.CustomerCity);
                        $('#customerMobile').val(customerData.MobileNumber);
                        $('#customerWhatsApp').val(customerData.WhatsAppNumber);
                        $('#customerProductCompany').val(customerData.ProductCompanyName);
                        $('#customerProductModel').val(customerData.ProductNameOrModel);
                        $('#lastMessageSendDate').val(customerData.LastMessageSendDate);

                        // Show the modal
                        $('#customerModal').modal('show');
                    },
                    error: function() {
                        alert('Error fetching customer data.');
                    }
                });
            });

            // Handle Reset Button Click (Optional)
            $("#resetButton").on("click", function() {
                resetForm($('#customerForm'));
            });

            // Function to handle form reset and clear validation
            function resetForm(form) {
                form[0].reset();
                form.removeClass('was-validated');
                form.find('.is-invalid').removeClass('is-invalid');
                //form.find('.invalid-feedback').text('');
            }

        });
    </script>

</body>

</html>