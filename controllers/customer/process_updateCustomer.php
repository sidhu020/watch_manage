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
        $id = htmlspecialchars(strip_tags($_POST['id']));
        $CustomerName = htmlspecialchars(strip_tags($_POST['customerName']));
        $CustomerAddress = htmlspecialchars(strip_tags($_POST['customerAddress']));
        $CustomerCity = htmlspecialchars(strip_tags($_POST['customerCity']));
        $MobileNumber = htmlspecialchars(strip_tags($_POST['customerMobile']));
        $WhatsAppNumber = htmlspecialchars(strip_tags($_POST['customerWhatsApp']));
        $ProductCompanyName = htmlspecialchars(strip_tags($_POST['customerProductCompany']));
        $ProductNameOrModel = htmlspecialchars(strip_tags($_POST['customerProductModel']));
        $LastMessageSendDate = !empty($_POST['customerLastMessageSendDate']) && strtotime($_POST['customerLastMessageSendDate']) ? $_POST['customerLastMessageSendDate'] : null;

        //$LastMessageSendDate = $_POST['customerLastMessageSendDate'];
        

        // Validate required fields
        if (empty($CustomerName) || empty($CustomerAddress) || empty($CustomerCity) || empty($MobileNumber)) {
            throw new Exception("All fields are required.");
        }

        $ModifiedDate = date('Y-m-d H:i:s');
        $ModifiedBy = $_SESSION['user_id'];
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
            'LastMessageSendDate' => $LastMessageSendDate,


            'ModifiedDate' => $ModifiedDate,
            'ModifiedBy' => $ModifiedBy,
            'isActive' => $isActive
                
        ];

        // Attempt to register the complaint
        if ($customer->updateCustomer($id, $data)) {
            $response = ['status' => 'success', 'class' => 'bg-warning', 'title' => 'Updated', 'subtitle' => 'Success', 'body' => 'customer Updated successfully'];
        } else {
            throw new Exception("Failed to register cusstomer.");
        }
    } else {
        throw new Exception("Invalid request method.");
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage(); // Capture and return any error message
}

echo json_encode($response); // Return the response as JSON
