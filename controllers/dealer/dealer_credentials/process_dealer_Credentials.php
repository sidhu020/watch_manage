<?php
require_once '../../../config/config.php';
require_once '../../../classes/Database.php';
require_once '../../../classes/Dealer_Credentials.php';
date_default_timezone_set('Asia/Kolkata'); // Set the timezone to IST

header('Content-Type: application/json'); // Ensure the response is JSON formatted

$database = new Database();
$db = $database->getConnection();
$dealerUser = new Dealer_Credentials($db);

$response = ['status' => 'error', 'message' => 'Unknown error']; // Default response

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['username_check'])) {
            // Username check logic
            $dealerUserUsername = trim($_POST['dealerUser_username']);

            // Prepare the SQL statement
            $query = "SELECT COUNT(*) AS count FROM `distributoruser` WHERE username = ?";
            $stmt = $db->prepare($query); // $conn is your mysqli connection
            $stmt->bind_param('s', $dealerUserUsername);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();

            if ($count > 0) {
                echo json_encode(['exists' => true]);
            } else {
                echo json_encode(['exists' => false]);
            }

            exit; // Stop further execution
        }

        // Sanitize and validate input data
        $username = htmlspecialchars(strip_tags($_POST['dealerUser_username']));
        $userpassword = htmlspecialchars(strip_tags($_POST['dealerUser_password']));
        $distributorId = htmlspecialchars(strip_tags($_POST['currentDealerId']));

        $firstname = htmlspecialchars(strip_tags($_POST['dealerUser_firstname']));
        $lastname = htmlspecialchars(strip_tags($_POST['dealerUser_lastname']));
        $mobileno = htmlspecialchars(strip_tags($_POST['dealerUser_mobile']));
        $roletype = htmlspecialchars(strip_tags($_POST['dealerUser_role']));


        // Validate required fields
        if (empty($username) || empty($userpassword) || empty($distributorId) || empty($firstname) || empty($lastname) || empty($mobileno) || empty($roletype)) {
            throw new Exception("All fields are required.");
        }

        $createdate = date('Y-m-d H:i:s');
        $isActive = 'Y';

        // Data array
        $data = [
            'username' => $username,
            'userpassword' => $userpassword,
            'isactive' => $isActive,
            'distributorid' => $distributorId,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'mobileno' => $mobileno,
            'roletype' => $roletype,
            'createdate' => $createdate
            ];

        // Attempt to register the DealerCredential
        if ($dealerUser->registerDealerUserCredentials($data)) {
            $response = ['status' => 'success', 'class' => 'bg-success', 'title' => 'Added', 'subtitle' => 'Success', 'body' => 'Dealer Cradensial Added successfully'];
        } else {
            throw new Exception("Failed to register Dealer Cradensial.");
        }
    } else {
        throw new Exception("Invalid request method.");
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage(); // Capture and return any error message
}

echo json_encode($response); // Return the response as JSON
