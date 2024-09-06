
    <?php
    require_once '../../config/config.php';
    require_once '../../classes/Database.php';
    require_once '../../classes/Dealer.php';
    date_default_timezone_set('Asia/Kolkata'); // Set the timezone to IST
    header('Content-Type: application/json'); // Ensure the response is JSON formatted

    $database = new Database();
    $db = $database->getConnection();
    $dealer = new Dealer($db);
    $response = ['status' => 'error', 'message' => 'Unknown error']; // Default response

    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Sanitize and validate input data
            $name = htmlspecialchars(strip_tags($_POST['Dealer_Name']));
            $primarymobileno = htmlspecialchars(strip_tags($_POST['Dealer_PMobile_No']));
            $secondmobileno = htmlspecialchars(strip_tags($_POST['Dealer_SMobile_No']));
            $emailaddress = htmlspecialchars(strip_tags($_POST['Dealer_email']));
            $address = htmlspecialchars(strip_tags($_POST['Dealer_Address']));
            $city = htmlspecialchars(strip_tags($_POST['Dealer_City']));


            // Validate required fields
            if (empty($name) || empty($primarymobileno) || empty($secondmobileno) || empty($emailaddress) || empty($address) || empty($city)) {
                throw new Exception("All fields are required.");
            }

            $isActive = 'Y';

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

            // Attempt to register the technician
            if ($dealer->registerDealer($data)) {
                //$response = ['status' => 'success', 'message' => 'Technician registered successfully.'];
                $response = ['status' => 'success', 'class' => 'bg-success', 'title' => 'Added', 'subtitle' => 'Success', 'body' => 'Dealer Added successfully'];
            } else {
                throw new Exception("Failed to register dealer.");
            }
        } else {
            throw new Exception("Invalid request method.");
        }
    } catch (Exception $e) {
        $response['message'] = $e->getMessage(); // Capture and return any error message
    }

    echo json_encode($response); // Return the response as JSON
