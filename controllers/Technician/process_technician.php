<?php
require_once '../../config/config.php';
require_once '../../classes/Database.php';
require_once '../../classes/Technician.php';
date_default_timezone_set('Asia/Kolkata'); // Set the timezone to IST
header('Content-Type: application/json'); // Ensure the response is JSON formatted

$database = new Database();
$db = $database->getConnection();
$technician = new Technician($db);
$response = ['status' => 'error', 'message' => 'Unknown error']; // Default response

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['username_check'])) {
            // Username check logic
            $Technician_username = trim($_POST['registerTechnicianUsername']);

            // Prepare the SQL statement
            $query = "SELECT COUNT(*) AS count FROM `servicecenteruser` WHERE username = ?";
            $stmt = $db->prepare($query); // $conn is your mysqli connection
            $stmt->bind_param('s', $Technician_username);
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
        $username = htmlspecialchars(strip_tags($_POST['username']));
        $password = htmlspecialchars(strip_tags($_POST['password']));
        $primarymobileno = htmlspecialchars(strip_tags($_POST['primaryMobile']));
        $secondmobileno = htmlspecialchars(strip_tags($_POST['secondaryMobile']));
        $firstname = htmlspecialchars(strip_tags($_POST['firstName']));
        $lastname = htmlspecialchars(strip_tags($_POST['lastName']));
        $address = htmlspecialchars(strip_tags($_POST['address']));
        $city = htmlspecialchars(strip_tags($_POST['city']));

        // Validate required fields
        if (empty($username) || empty($password) || empty($primarymobileno) || empty($firstname) || empty($lastname) || empty($address) || empty($city)) {
            throw new Exception("All fields are required.");
        }

        $createdate = date('Y-m-d H:i:s');
        $isActive = 'Y';
        $roleType = 'Technician';

        // Data array
        $data = [
            'username' => $username,
            'password' => $password,
            'primarymobileno' => $primarymobileno,
            'secondmobileno' => $secondmobileno,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'address' => $address,
            'city' => $city,
            'roletype' => $roleType,
            'isactive' => $isActive,
            'createdate' => $createdate
        ];

        // Attempt to register the technician
        if ($technician->registerTechnician($data)) {
            //$response = ['status' => 'success', 'message' => 'Technician registered successfully.'];
            $response = ['status' => 'success', 'class' => 'bg-success', 'title' => 'Added', 'subtitle' => 'Success', 'body' => 'Technician Added successfully'];
        } else {
            throw new Exception("Failed to register technician.");
        }
    } else {
        throw new Exception("Invalid request method.");
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage(); // Capture and return any error message
}

echo json_encode($response); // Return the response as JSON
