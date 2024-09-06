<?php
require_once 'BaseModel.php';

class Dealer_Credentials extends BaseModel
{
    protected $table = "distributoruser";

    // Method to register a new complaint

    public function getTotalRecordsByDealerId($distributorId)
    {
        $query = "SELECT COUNT(*) AS total FROM $this->table WHERE `distributorid` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $distributorId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    
    
        // Get the number of filtered records (for search functionality)
        public function getFilteredRecords($distributorId, $searchValue)
        {
            $searchValue = "%$searchValue%";
            $query = "SELECT COUNT(*) AS total FROM $this->table 
                    WHERE `distributorid` = ? 
                    AND (`username` LIKE ? OR `mobileno` LIKE ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("iss", $distributorId, $searchValue, $searchValue);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row['total'];
        }

        
        // Get paginated records based on start, length, search value, and sorting
        public function getPaginatedDealerCredentials($distributorId, $start, $length, $searchValue, $orderColumn = 'id', $orderDir = 'asc')
        {
            $searchValue = "%$searchValue%";
            $query = "SELECT `id`, `username`, `userpassword`, `isactive`, `distributorid`, `firstname`, `lastname`, `mobileno`, `roletype`, `createdate`, `modifydate`
                    FROM $this->table 
                    WHERE `distributorid` = ? 
                    AND (`username` LIKE ? OR `mobileno` LIKE ?)
                    ORDER BY $orderColumn $orderDir
                    LIMIT ?, ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("issii", $distributorId, $searchValue, $searchValue, $start, $length);
            $stmt->execute();
            $result = $stmt->get_result();
            $DealerCredentials = [];
            while ($row = $result->fetch_assoc()) {
                $DealerCredentials[] = $row;
            }
            return $DealerCredentials;
        }



    public function getAllDealerCredentials()
    {
        $query = "SELECT * FROM $this->table";
        $result = $this->conn->query($query);
        $dealers = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dealers[] = $row;
            }
        }
        return $dealers;
    }

    public function getDealerCredentialsByDealerId($id)
    {
        $query = "SELECT * FROM $this->table WHERE `distributorid` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $dealersCredentials = [];
        while ($row = $result->fetch_assoc()) {
            $dealersCredentials[] = $row;
        }
        
        return $dealersCredentials;
    }

    public function registerDealerCredentials($data)
    {
        return $this->create($data);
    }

     public function registerDealerUserCredentials($data)
     {
         return $this->create($data);
     }


    public function getDealerCredentialsById($id)
    {
        $query = "SELECT * FROM $this->table WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    



    public function updateDealerCredentialsById($id, $data)
    {
        return $this->update($id, $data);
    }

}
