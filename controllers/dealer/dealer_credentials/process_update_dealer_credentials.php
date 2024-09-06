<?php
require_once '../../../config/config.php';
require_once '../../../classes/Database.php';
require_once '../../../classes/Dealer_Credentials.php';
date_default_timezone_set('Asia/Kolkata'); // Set the timezone to IST

$database = new Database();
$db = $database->getConnection();
$dealer_credentials = new Dealer_Credentials($db);

$id = $_POST['dealerUserId'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (isset($_POST['dealerUserId'])) {

            $isActive = isset($_POST['isActive']) && $_POST['isActive'] === 'Y' ? 'Y' : 'N';
            $firstname = htmlspecialchars(strip_tags($_POST['dealerUserFirstName']));
            $lastname = htmlspecialchars(strip_tags($_POST['dealerUserLastName']));
            $mobileno = htmlspecialchars(strip_tags($_POST['dealerUserMobile']));
            $modifydate = date('Y-m-d H:i:s');

            $data = [
                'isactive' => $isActive,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'mobileno' => $mobileno,
                'modifydate' => $modifydate,
            ];

            if ($dealer_credentials->updateDealerCredentialsById($id, $data)) {
                echo json_encode([
                    'status' => 'success',
                    'class' => 'bg-success',
                    'title' => 'Update',
                    'subtitle' => 'Success',
                    'body' => 'Dealer Credentials updated successfully'
                ]);
            } else {
                throw new Exception('Failed to update Dealer_Credentials..');
            }
        } else {
            throw new Exception('Missing required parameters.');
        }
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'class' => 'bg-danger',
            'title' => 'Update Error',
            'subtitle' => 'Error',
            'body' => $e->getMessage()
        ]);
    }
}
