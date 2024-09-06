<?php
require_once 'BaseModel.php';

class Customer extends BaseModel
{
    protected $table = "customer";

    // Get total number of records (for pagination)
    public function getTotalRecords()
    {
        $query = "SELECT COUNT(*) AS total FROM $this->table";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    // Get the number of filtered records (for search functionality)
    public function getFilteredRecords($searchValue)
    {
        $searchValue = "%$searchValue%";
        $query = "SELECT COUNT(*) AS total FROM $this->table 
                      WHERE `CustomerName` LIKE ? OR `MobileNumber` LIKE ? OR `WhatsAppNumber` LIKE ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $searchValue, $searchValue, $searchValue);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    // Get paginated records based on start, length, search value, and sorting
    public function getPaginatedCustomers($start, $length, $searchValue, $orderColumn = 'id', $orderDir = 'asc')
    {
        $searchValue = "%$searchValue%";
        $query = "SELECT `id`, `CustomerName`, `CustomerAddress`, `CustomerCity`, `MobileNumber`, `WhatsAppNumber`, `LastMessageSendDate`, `IsActive`
                      FROM $this->table 
                      WHERE `CustomerName` LIKE ? OR `MobileNumber` LIKE ? OR `WhatsAppNumber` LIKE ?
                      ORDER BY $orderColumn $orderDir
                      LIMIT ?, ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssii", $searchValue, $searchValue, $searchValue, $start, $length);
        $stmt->execute();
        $result = $stmt->get_result();
        $customers = [];
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
        return $customers;
    }

    // Fetch all customers with limited details
    public function getAllCustomers()
    {
        $query = "SELECT 
                    `id`, 
                    `username`, 
                    `primarymobileno`, 
                    `secondmobileno`, 
                    `firstname`, 
                    `lastname`, 
                    `address`, 
                    `city`, 
                    `isactive` 
                  FROM $this->table";
        $result = $this->conn->query($query);
        $customers = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $customers[] = $row;
            }
        }
        return $customers;
    }

    // Fetch a single customer by ID
    public function getCustomerById($id)
    {
        $query = "SELECT * FROM $this->table WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Fetch all active customers with basic details
    public function getCustomers()
    {
        $query = "SELECT 
                    `id`, 
                    `firstname`, 
                    `lastname` 
                  FROM $this->table 
                  WHERE `isactive` = 'Y'";
        $result = $this->conn->query($query);
        $customers = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $customers[] = $row;
            }
        }
        return $customers;
    }

    // Register a new customer
    public function registerCustomer($data)
    {
        return $this->create($data);
    }

    // Update an existing customer
    public function updateCustomer($id, $data)
    {
        return $this->update($id, $data);
    }
}
