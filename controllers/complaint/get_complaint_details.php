<?php
require_once '../../config/config.php';
require_once '../../classes/Database.php';
require_once '../../classes/Complaint.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $database = new Database();
    $db = $database->getConnection();
    $complaint = new Complaint($db);
    $complaintDetails = $complaint->getComplaintById($id);

    if ($complaintDetails) {
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<tr><th>Field</th><th>Value</th></tr>";
        echo "<tr><td><strong>Call Number:</strong></td><td>{$complaintDetails['callnumber']}</td></tr>";
        echo "<tr><td><strong>Customer Name:</strong></td><td>{$complaintDetails['customername']}</td></tr>";
        echo "<tr><td><strong>Customer Mobile No:</strong></td><td>{$complaintDetails['customermobileno']}</td></tr>";
        echo "<tr><td><strong>Customer Address:</strong></td><td>{$complaintDetails['customeraddress']}</td></tr>";
        echo "<tr><td><strong>Customer City:</strong></td><td>{$complaintDetails['customercity']}</td></tr>";
        echo "<tr><td><strong>Call Type:</strong></td><td>{$complaintDetails['calltype']}</td></tr>";
        echo "<tr><td><strong>Payment Type:</strong></td><td>{$complaintDetails['paymenttype']}</td></tr>";
        echo "<tr><td><strong>Call Date:</strong></td><td>{$complaintDetails['calldate']}</td></tr>";
        echo "<tr><td><strong>Call Assign Date:</strong></td><td>{$complaintDetails['callassigndate']}</td></tr>";
        echo "<tr><td><strong>Technician Assigned:</strong></td><td>{$complaintDetails['technicianassigned']}</td></tr>";
        echo "<tr><td><strong>Call Complete Date:</strong></td><td>{$complaintDetails['callcompletedate']}</td></tr>";
        echo "<tr><td><strong>Call Status:</strong></td><td>{$complaintDetails['callstatus']}</td></tr>";
        echo "<tr><td><strong>Total Amount:</strong></td><td>{$complaintDetails['totalamount']}</td></tr>";
        echo "<tr><td><strong>Discount Amount:</strong></td><td>{$complaintDetails['discountamount']}</td></tr>";
        echo "<tr><td><strong>Final Amount:</strong></td><td>{$complaintDetails['finalamount']}</td></tr>";
        echo "<tr><td><strong>Customer Problem:</strong></td><td>{$complaintDetails['customerproblem']}</td></tr>";
        echo "<tr><td><strong>Call Resolution:</strong></td><td>{$complaintDetails['callresolution']}</td></tr>";
        echo "</table>";
    } else {
        echo "<p>No details found for the selected complaint.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
