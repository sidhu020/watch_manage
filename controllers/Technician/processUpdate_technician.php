<?php
require_once '../../config/config.php';
require_once '../../classes/Database.php';
require_once '../../classes/Technician.php';
date_default_timezone_set('Asia/Kolkata'); // Set the timezone to IST
$database = new Database();
$db = $database->getConnection();
$technician = new Technician($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (isset($_POST['technicianId']) && isset($_POST['primaryMobile'])) {
            $id = intval($_POST['technicianId']);

            $primarymobileno = htmlspecialchars(strip_tags($_POST['primaryMobile']));
            $secondmobileno = htmlspecialchars(strip_tags($_POST['secondaryMobile']));
            $firstname = htmlspecialchars(strip_tags($_POST['firstName']));
            $lastname = htmlspecialchars(strip_tags($_POST['lastName']));
            $address = htmlspecialchars(strip_tags($_POST['address']));
            $city = htmlspecialchars(strip_tags($_POST['city']));
            $isActive = isset($_POST['isActive']) && $_POST['isActive'] === 'Y' ? 'Y' : 'N';
            $modifydate = date('Y-m-d H:i:s');

            $data = [
                'primarymobileno' => $primarymobileno,
                'secondmobileno' => $secondmobileno,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'address' => $address,
                'city' => $city,
                'isactive' => $isActive,
                'modifydate' => $modifydate
            ];

            if ($technician->updateTechnician($id, $data)) {
                echo json_encode([
                    'status' => 'success',
                    'class' => 'bg-warning',
                    'title' => 'Update',
                    'subtitle' => 'Success',
                    'body' => 'Technician updated successfully'
                ]);
            } else {
                throw new Exception('Failed to update technician.');
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
