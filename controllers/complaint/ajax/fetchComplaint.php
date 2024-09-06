<?php
// Include necessary configuration and classes
include '../../../config/config.php';
require_once '../../../classes/Database.php';
require_once '../../../classes/Complaint.php';

// Initialize database connection and Technician class
$database = new Database();
$db = $database->getConnection();
$complaint = new Complaint($db);

// Retrieve POST parameters
$action = isset($_POST['action']) ? $_POST['action'] : '';

$start = isset($_POST['start']) ? intval($_POST['start']) : 0; // Pagination: start index
$length = isset($_POST['length']) ? intval($_POST['length']) : 10; // Pagination: number of records per page
$searchValue = isset($_POST['search']['value']) ? $_POST['search']['value'] : ''; // Search: search term

// Capture sorting parameters from DataTables
$orderColumnIndex = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0; // Index of the column to sort by
$orderDir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc'; // Direction of sorting (asc/desc)

// Map the column index from DataTables to the actual column names in the database
// $columns = ["id", "username", "primarymobileno", "secondmobileno", "firstname", "lastname", "address", "city", "isactive"];

$columns = ["callnumber", "customername", "customermobileno", "customeraddress", "customerproblem", "calltype", "callstatus", "action"];
    // callnumber, customername,customermobileno,customeraddress, calltype,

$orderColumn = $columns[$orderColumnIndex];

try {
    // If action is 'getById', retrieve a technician by their ID
    if ($action == 'getComplaintById') {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $complaintDataById = $complaint->getComplaintById($id);
        echo json_encode($complaintDataById);
    } 
    // If action is 'getAllData', retrieve and return paginated, sorted, and filtered technician data
    elseif ($action == 'getAllComplaintData') {
        // Get total number of records without filtering
        $totalRecords = $complaint->getTotalRecords();

        // Get number of records matching the search filter
        $filteredRecords = $complaint->getFilteredRecords($searchValue);

        // Get paginated and sorted data with filtering applied
        $complaintData = $complaint->getPaginatedComplaints($start, $length, $searchValue, $orderColumn, $orderDir);

        // Prepare the response array as required by DataTables
        $response = [
            "draw" => intval($_POST['draw']), // Draw counter from DataTables request
            "recordsTotal" => $totalRecords, // Total records before filtering
            "recordsFiltered" => $filteredRecords, // Total records after filtering
            "data" => $complaintData // Actual data for the current page
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
