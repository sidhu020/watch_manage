<?php
require_once '../../config/config.php';

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
                            <h1><strong>Complaint Managment <i class="fas fa-tools"></i></i></strong></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Complaint</li>
                                <li class="breadcrumb-item active">Show</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <div class="container-fluid">
                <div class="card card-warning card-outline">
                    <div class="card-header d-flex justify-content-between">
                        <div class="mr-auto mt-auto mb-auto">
                        </div>
                        <div class="ml-auto"><button type="button" class="btn btn-block bg-gradient-success" data-toggle="modal" data-target="#registerComplaintModal"><b>Register Complaint</b></button></div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- DataTables -->
                        <table id="complaintTable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Call Number</th>
                                    <th>Customer Name</th>
                                    <th>Customer MobileNo</th>
                                    <th>Customer Address</th>
                                    <th>Customer Problem</th>
                                    <th>Call Type</th>
                                    <th>Call Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Call Number</th>
                                    <th>Customer Name</th>
                                    <th>Customer MobileNo</th>
                                    <th>Customer Address</th>
                                    <th>Customer Problem</th>
                                    <th>Call Type</th>
                                    <th>Call Status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- /.DataTables -->
                    </div>
                    <!-- /.card-body -->


                    <!-- complaint View Model -->
                    <div class="modal fade" id="complaintModel" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewModalLabel"><b>Complaint Details <sup><i class="fas fa-expand-alt"></i></sup></b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-hover table-striped">
                                        <tr>
                                            <th>Field</th>
                                            <th>Value</th>
                                        </tr>
                                        <tr>
                                            <td><strong>Call Number:</strong></td>
                                            <td>
                                                <p id="callnumber"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Customer Name:</strong></td>
                                            <td>
                                                <p id="customername"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Customer Mobile No:</strong></td>
                                            <td>
                                                <p id="customermobileno"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Customer Address:</strong></td>
                                            <td>
                                                <p id="customeraddress"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Customer City:</strong></td>
                                            <td>
                                                <p id="customercity"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Call Type:</strong></td>
                                            <td>
                                                <p id="calltype"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Service Work Type:</strong></td>
                                            <td>
                                                <p id="serviceWorkType"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Payment Type:</strong></td>
                                            <td>
                                                <p id="paymenttype"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Call Date:</strong></td>
                                            <td>
                                                <p id="calldate"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Call Assign Date:</strong></td>
                                            <td>
                                                <p id="callassigndate"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Technician Assigned:</strong></td>
                                            <td>
                                                <p id="technicianassigned"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Call Complete Date:</strong></td>
                                            <td>
                                                <p id="callcompletedate"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Call Status:</strong></td>
                                            <td>
                                                <p class="text-danger" id="callstatus"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Amount:</strong></td>
                                            <td>
                                                <p id="totalamount"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Discount Amount:</strong></td>
                                            <td>
                                                <p id="discountamount"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Final Amount:</strong></td>
                                            <td>
                                                <p id="finalamount"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Customer Problem:</strong></td>
                                            <td>
                                                <p id="customerproblem"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Call Resolution:</strong></td>
                                            <td>
                                                <p id="callresolution"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Create By:</strong></td>
                                            <td>
                                                <p id="creatorUsername"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Modifie By:</strong></td>
                                            <td>
                                                <p id="modifierUsername"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Modifie Date:</strong></td>
                                            <td>
                                                <p id="modifiedDate"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Distributor Name:</strong></td>
                                            <td>
                                                <p id="distributorName"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Distributor username:</strong></td>
                                            <td>
                                                <p id="distributorUserUsername"></p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- complaint Register Model -->
                    <div class="modal fade" id="registerComplaintModal" tabindex="-1" role="dialog" aria-labelledby="registerComplaintModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                            <form id="registerComplaintForm" novalidate>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="registerComplaintModalLabel"><b>Register New Complaint <sup><i class="far fa-sticky-note"></i></sup></b></h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="card card-success card-outline mt-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="customerName" class="form-label">Customer Name <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="customerName" id="customerName" autocomplete="off" required>
                                                        <div class="invalid-feedback">Please enter a customer name.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="customerPhoneNumber" class="form-label">Customer Phone Number <span class="text-danger"> * </span></label>
                                                        <input type="tel" class="form-control shadow-none" name="customerPhoneNumber" id="customerPhoneNumber" autocomplete="off" pattern="[0-9]{10}" required>
                                                        <div class="invalid-feedback">Please enter a valid phone number.</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="customerAddress" class="form-label">Customer Address <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="customerAddress" id="customerAddress" autocomplete="off" required>
                                                        <div class="invalid-feedback">Please enter a customer address.</div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="customerCity" class="form-label">Customer City <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control shadow-none" name="customerCity" id="customerCity" autocomplete="off" required>
                                                        <div class="invalid-feedback">Please enter a customer city.</div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="complaintType" class="form-label">Complaint Type <span class="text-danger"> * </span></label>
                                                        <select class="form-control shadow-none" name="complaintType" id="complaintType" required>
                                                            <option value=""></option>
                                                            <option value="Microwave">Microwave</option>
                                                            <option value="Refrigerator">Refrigerator</option>
                                                            <option value="WashingMachine">Washing Machine</option>
                                                            <option value="Airconditioning">Air conditioning</option>
                                                            <option value="Dishwasher">Dishwasher</option>
                                                            <option value="Oven">Oven</option>
                                                            <option disabled="disabled" value="ClothesDryer">Clothes dryer</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="serviceWorkType" class="form-label">Service Worktype <span class="text-danger"> * </span></label>
                                                        <select class="form-control shadow-none" name="serviceWorkType" id="serviceWorkType" required>
                                                            <option value=""></option>
                                                            <option value="Repair">Repair</option>
                                                            <option value="Service">Service</option>
                                                            <option value="Installation">Installation</option>
                                                            <option value="Demo">Demo</option>
                                                            <option value="InstallationDemo">Installation and Demo</option>
                                                            <option value="InWarrentyService">In-Warrenty Service</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="complaintDate" class="form-label">Complaint Date <span class="text-danger"> * </span></label>
                                                        <input type="date" class="form-control shadow-none" name="complaintDate" id="complaintDate" required>
                                                        <div class="invalid-feedback">Please select a complaint date.</div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="complaintDescription" class="form-label">Complaint Description <span class="text-danger"> * </span></label>
                                                        <textarea class="form-control shadow-none" name="complaintDescription" id="complaintDescription" autocomplete="off" required></textarea>
                                                        <div class="invalid-feedback">Please select a complaint Description.</div>
                                                    </div>
                                                </div>
                                            </div>
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

            // Initialize DataTable
            var table = $('#complaintTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "../../controllers/complaint/ajax/fetchComplaint.php",
                    "type": "POST",
                    "data": {
                        "action": "getAllComplaintData"
                    },
                    "dataSrc": function(json) {
                        if (json.error) {
                            alert(json.error);
                            return [];
                        } else {
                            return json.data;
                        }
                    }
                },
                "columns": [{
                        "data": "callnumber"
                    },
                    {
                        "data": "customername"
                    },
                    {
                        "data": "customermobileno"
                    },
                    {
                        "data": "customeraddress",
                        "orderable": false
                    },
                    {
                        "data": "customerproblem",
                        "orderable": false
                    },
                    {
                        "data": "calltype",
                        "orderable": false
                    },
                    {
                        "data": "callstatus",
                        "orderable": true,
                        "render": function(data, type, row) {
                            var badgeClass;
                            switch (data) {
                                case 'New':
                                    badgeClass = 'danger';
                                    break;
                                case 'Assigned':
                                    badgeClass = 'warning';
                                    break;
                                case 'Close':
                                    badgeClass = 'success';
                                    break;
                                case 'Cancelled':
                                    badgeClass = 'dark';
                                    break;
                                default:
                                    badgeClass = '';
                                    break;
                            }
                            return `<span class="badge badge-${badgeClass}">${data}</span>`;
                        }
                    },
                    {
                        "data": null,
                        "orderable": false,
                        "render": function(data, type, row) {
                            return `<div class="d-flex flex-row justify-content-around">
                                            <button class="btn btn-outline-warning btn-edit" data-id="${row.id}" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                                            <button class="btn btn-outline-primary btn-view" data-id="${row.id}" title="View"><i class="far fa-eye"></i></button>
                                        </div>`;
                        }
                    }
                ],
                "responsive": true,
                "pageLength": 10,
                "lengthChange": true,
                "lengthMenu": [5, 10, 25, 50, 100],
                "autoWidth": true,
                "order": [
                    [0, 'desc']
                ],
                "language": {
                    "paginate": {
                        "previous": "<i class='fas fa-angle-left'></i>",
                        "next": "<i class='fas fa-angle-right'></i>"
                    }
                },
                "dom": 'lBfrtip', // Include the length menu and buttons
                "buttons": [{
                    extend: 'colvis',
                    text: 'Show/Hide Columns',
                    columns: ':not(:last-child)' // All columns except the Actions column
                }]
            });

            // View Complaint
            $('#complaintTable').on('click', '.btn-view', function() {
                var complaintId = $(this).data('id');
                $.ajax({
                    url: '../../controllers/complaint/ajax/fetchComplaint.php',
                    method: 'POST',
                    data: {
                        action: 'getComplaintById',
                        id: complaintId
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Populate the form fields with fetched data
                        $('#callnumber').text(response.callnumber);
                        $('#customername').text(response.customername);
                        $('#customermobileno').text(response.customermobileno);
                        $('#customeraddress').text(response.customeraddress);
                        $('#customercity').text(response.customercity);
                        $('#calltype').text(response.calltype);
                        $('#serviceWorkType').text(response.serviceworktype);
                        $('#paymenttype').text(response.paymenttype);
                        $('#calldate').text(response.calldate);
                        $('#callassigndate').text(response.callassigndate);
                        $('#technicianassigned').text(response.technician_name);
                        $('#callcompletedate').text(response.callcompletedate);
                        $('#callstatus').text(response.callstatus);
                        $('#totalamount').text(response.totalamount);
                        $('#discountamount').text(response.discountamount);
                        $('#finalamount').text(response.finalamount);
                        $('#customerproblem').text(response.customerproblem);
                        $('#callresolution').text(response.callresolution);

                        $('#createDate').text(response.createdate);
                        $('#creatorUsername').text(response.creator_username);
                        $('#distributorName').text(response.distributor_name);
                        $('#distributorUserUsername').text(response.distributoruser_username);
                        $('#modifierUsername').text(response.modifier_username);
                        $('#modifiedDate').text(response.modifieddate);

                        // Show the modal
                        $('#complaintModel').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Edit Complaint
            $('#complaintTable').on('click', '.btn-edit', function() {
                var complaintId = $(this).data('id');
                // Redirect to the update page with the complaint ID as a query parameter
                window.location.href = '../../pages/complaint/update.php?id=' + complaintId;
            });


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
            $("#registerComplaintForm").on("submit", function(event) {
                event.preventDefault();
                var form = $(this);

                submitForm(form, '../../controllers/complaint/process_complaint.php', function() {
                    table.ajax.reload();
                    resetForm(form);
                    $('#registerComplaintModal').modal('hide');
                });
            });


            // Handle Reset Button Click (Optional)
            $("#resetButton").on("click", function() {
                resetForm($('#registerComplaintForm'));
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