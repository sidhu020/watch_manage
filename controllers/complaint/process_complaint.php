<?php
require_once '../../config/config.php';
require_once '../../classes/Database.php';
require_once '../../classes/Complaint.php';
date_default_timezone_set('Asia/Kolkata'); // Set the timezone to IST
header('Content-Type: application/json'); // Ensure the response is JSON formatted

$database = new Database();
$db = $database->getConnection();
$complaint = new Complaint($db);
$response = ['status' => 'error', 'message' => 'Unknown error']; // Default response

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $callnumber = date('YmdHi') . mt_rand(10, 99);
        $createdate = date('Y-m-d H:i:s');
        $createdBy = $_SESSION['user_id'];
        $callstatus = "New";

        // Sanitize and validate input data
        $customername = htmlspecialchars(strip_tags($_POST['customerName']));
        $customermobileno = htmlspecialchars(strip_tags($_POST['customerPhoneNumber']));
        $customeraddress = htmlspecialchars(strip_tags($_POST['customerAddress']));
        $customercity = htmlspecialchars(strip_tags($_POST['customerCity']));
        $calltype = htmlspecialchars(strip_tags($_POST['complaintType']));
        $serviceWorkType = htmlspecialchars(strip_tags($_POST['serviceWorkType']));
        $calldate = htmlspecialchars(strip_tags($_POST['complaintDate']));
        $customerproblem = htmlspecialchars(strip_tags($_POST['complaintDescription']));

        // Validate required fields
        if (empty($customername) || empty($customermobileno) || empty($customeraddress) || empty($customercity) || empty($calltype) || empty($serviceWorkType) || empty($calldate) || empty($customerproblem)) {
            throw new Exception("All fields are required.");
        }

        $createdate = date('Y-m-d H:i:s');
        $isActive = 'Y';
        $roleType = 'Technician';

        // Data array
        $data = [
            'callnumber' => $callnumber,
            'customername' => $customername,
            'customermobileno' => $customermobileno,
            'customeraddress' => $customeraddress,
            'customercity' => $customercity,
            'calltype' => $calltype,
            'serviceworktype' => $serviceWorkType,
            'calldate' => $calldate,
            'callstatus' => $callstatus,
            'createdate' => $createdate,
            'createby' => $createdBy,
            'customerproblem' => $customerproblem
        ];

        // Attempt to register the complaint
        if ($complaint->registerComplaint($data)) {
            $response = ['status' => 'success', 'class' => 'bg-success', 'title' => 'Added', 'subtitle' => 'Success', 'body' => 'Complaint Added successfully'];
        } else {
            throw new Exception("Failed to register Complaint.");
        }
    } else {
        throw new Exception("Invalid request method.");
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage(); // Capture and return any error message
}

echo json_encode($response); // Return the response as JSON
