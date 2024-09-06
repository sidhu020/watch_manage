<?php
require_once '../../config/config.php';
require_once '../../classes/Database.php';
require_once '../../classes/Dealer.php';
date_default_timezone_set('Asia/Kolkata'); // Set the timezone to IST

$database = new Database();
$db = $database->getConnection();
$dealer = new Dealer($db);


$id = $_POST['dealerId'];
$isActive = isset($_POST['isActive']) && $_POST['isActive'] == 'Y' ? 'Y' : 'N';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (isset($_POST['dealerId']) && isset($_POST['dealerPrimaryMobile'])) {
            $id = intval($_POST['dealerId']);

            // Sanitize and validate input data
            $name = htmlspecialchars(strip_tags($_POST['dealerName']));
            $primarymobileno = htmlspecialchars(strip_tags($_POST['dealerPrimaryMobile']));
            $secondmobileno = htmlspecialchars(strip_tags($_POST['dealerSecondaryMobile']));
            $emailaddress = htmlspecialchars(strip_tags($_POST['dealerEmail']));
            $address = htmlspecialchars(strip_tags($_POST['dealerAddress']));
            $city = htmlspecialchars(strip_tags($_POST['dealerCity']));

            // Data array
            $data = [
                'name' => $name,
                'isactive' => $isActive,
                'primarymobileno' => $primarymobileno,
                'secondmobileno' => $secondmobileno,
                'emailaddress' => $emailaddress,
                'address' => $address,
                'city' => $city
            ];

            if ($dealer->updateDealerById($id, $data)) {
                echo json_encode([
                    'status' => 'success',
                    'class' => 'bg-warning',
                    'title' => 'Update',
                    'subtitle' => 'Success',
                    'body' => 'Dealer updated successfully'
                ]);
            } else {
                throw new Exception('Failed to update Dealer.');
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