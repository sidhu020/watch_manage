<?php
// Include necessary configuration and classes
include '../../../../config/config.php';
require_once '../../../../classes/Database.php';
require_once '../../../../classes/Dealer_Credentials.php';


$database = new Database();
$db = $database->getConnection();
$dealerCredentials = new Dealer_Credentials($db);

// Retrieve POST parameters
$action = isset($_POST['action']) ? $_POST['action'] : '';
// Retrieve POST parameters
$dealerId = isset($_POST['dealerId']) ? $_POST['dealerId'] : '';

$start = isset($_POST['start']) ? intval($_POST['start']) : 0; // Pagination: start index
$length = isset($_POST['length']) ? intval($_POST['length']) : 10; // Pagination: number of records per page
$searchValue = isset($_POST['search']['value']) ? $_POST['search']['value'] : ''; // Search: search term

// Capture sorting parameters from DataTables
$orderColumnIndex = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0; // Index of the column to sort by
$orderDir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc'; // Direction of sorting (asc/desc)

$columns = ["username", "isactive", "distributorid", "firstname", "lastname", "mobileno", "roletype"];

$orderColumn = $columns[$orderColumnIndex];

try {

    if ($action == 'getDealerCredentialsById') {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $dealerCredentialsDataById = $dealerCredentials->getDealerCredentialsById($id);
        echo json_encode($dealerCredentialsDataById);
    } 

    elseif ($action == 'getAlldealerCredentialsDataByDealerId') {
        // Get total number of records without filtering
        $totalRecords = $dealerCredentials->getTotalRecordsByDealerId($dealerId);

        // Get number of records matching the search filter
        $filteredRecords = $dealerCredentials->getFilteredRecords($dealerId, $searchValue);

        // Get paginated and sorted data with filtering applied
        $dealerCredentialsData = $dealerCredentials->getPaginatedDealerCredentials($dealerId, $start, $length, $searchValue, $orderColumn, $orderDir);

        // Prepare the response array as required by DataTables
        $response = [
            "draw" => intval($_POST['draw']), // Draw counter from DataTables request
            "recordsTotal" => $totalRecords, // Total records before filtering
            "recordsFiltered" => $filteredRecords, // Total records after filtering
            "data" => $dealerCredentialsData // Actual data for the current page
        ];

        // Return the response in JSON format
        echo json_encode($response);
    } else {
        // If the action is not recognized, throw an exception
        throw new Exception('Invalid action or missing ID.');
    }
} catch (Exception $e) {
    // If an error occurs, return the error message as JSON
    echo json_encode(['error' => $e->getMessage()]);
}
exit;
