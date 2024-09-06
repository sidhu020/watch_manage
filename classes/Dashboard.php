<?php
require_once 'BaseModel.php';
class Dashboard {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch count of new complaints
    public function getNewComplaintCount() {
        $query = "SELECT COUNT(*) as count FROM servicecall WHERE callstatus = 'New'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'];
    }

    // Fetch count of assigned complaints
    public function getAssignedComplaintCount() {
        $query = "SELECT COUNT(*) as count FROM servicecall WHERE callstatus = 'Assigned'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'];
    }

    // Fetch count of active complaints (New and Assigned)
    public function getActiveComplaintCount() {
        $query = "SELECT COUNT(*) as count FROM servicecall WHERE callstatus IN ('New', 'Assigned')";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'];
    }

    // Fetch count of active technicians
    public function getActiveTechnicianCount() {
        $query = "SELECT COUNT(*) as count FROM servicecenteruser WHERE roletype = 'Technician' AND isactive = 'Y'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'];
    }

    // Fetch count of active distributors
    public function getActiveDistributorCount() {
        $query = "SELECT COUNT(*) as count FROM distributor WHERE isactive = 'Y'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'];
    }

    // Fetch today's complaints with only complaint number and customer name
    public function getTodaysComplaints() {
        $query = "SELECT callnumber, customername, customermobileno, calltype, serviceworktype, callstatus FROM servicecall WHERE DATE(calldate) = CURDATE()";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
