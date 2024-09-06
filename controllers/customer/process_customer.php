<?php
require_once '../../config/config.php';
require_once '../../classes/Database.php';
require_once '../../classes/Customer.php';
date_default_timezone_set('Asia/Kolkata'); // Set the timezone to IST
header('Content-Type: application/json'); // Ensure the response is JSON formatted

$database = new Database();
$db = $database->getConnection();
$customer = new Customer($db);
$response = ['status' => 'error', 'message' => 'Unknown error']; // Default response

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        // Sanitize and validate input data
        $CustomerName = htmlspecialchars(strip_tags($_POST['customerName']));
        $CustomerAddress = htmlspecialchars(strip_tags($_POST['customerAddress']));
        $CustomerCity = htmlspecialchars(strip_tags($_POST['customerCity']));
        $MobileNumber = htmlspecialchars(strip_tags($_POST['customerMobile']));
        $WhatsAppNumber = htmlspecialchars(strip_tags($_POST['customerWhatsApp']));
        $ProductCompanyName = htmlspecialchars(strip_tags($_POST['customerProductCompany']));
        $ProductNameOrModel = htmlspecialchars(strip_tags($_POST['customerProductModel']));

        // Validate required fields
        if (empty($CustomerName) || empty($CustomerAddress) || empty($CustomerCity) || empty($MobileNumber)) {
            throw new Exception("All fields are required.");
        }

        $CreateDate = date('Y-m-d H:i:s');
        $CreateBy = $_SESSION['user_id'];
        $isActive = 'Y';

        // Data array
        $data = [
            'CustomerName' => $CustomerName,
            'CustomerAddress' => $CustomerAddress,
            'CustomerCity' => $CustomerCity,
            'MobileNumber' => $MobileNumber,
            'WhatsAppNumber' => $WhatsAppNumber,
            'ProductCompanyName' => $ProductCompanyName,
            'ProductNameOrModel' => $ProductNameOrModel,

            'CreateDate' => $CreateDate,
            'CreateBy' => $CreateBy,
            'isActive' => $isActive,

        ];

        // Attempt to register the complaint
        if ($customer->registerCustomer($data)) {
            $response = ['status' => 'success', 'class' => 'bg-success', 'title' => 'Added', 'subtitle' => 'Success', 'body' => 'customer Added successfully'];
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
