<?php
require_once 'BaseModel.php';

class Dealer extends BaseModel
{
    protected $table = "distributor";

    // Method to register a new complaint

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
                          WHERE `name` LIKE ? OR `primarymobileno` LIKE ? OR `secondmobileno` LIKE ? OR `emailaddress` LIKE ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("ssss", $searchValue, $searchValue, $searchValue, $searchValue);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return $row['total'];
            }
        
            // Get paginated records based on start, length, search value, and sorting
            public function getPaginatedDealers($start, $length, $searchValue, $orderColumn = 'id', $orderDir = 'asc')
            {
                $searchValue = "%$searchValue%";
                $query = "SELECT `id`, `name`, `isactive`, `primarymobileno`, `secondmobileno`, `emailaddress`, `address`, `city`
                          FROM $this->table 
                          WHERE `name` LIKE ? OR `primarymobileno` LIKE ? OR `secondmobileno` LIKE ? OR `emailaddress` LIKE ?
                          ORDER BY $orderColumn $orderDir
                          LIMIT ?, ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("ssssii", $searchValue, $searchValue, $searchValue, $searchValue, $start, $length);
                $stmt->execute();
                $result = $stmt->get_result();
                $dealers = [];
                while ($row = $result->fetch_assoc()) {
                    $dealers[] = $row;
                }
                return $dealers;
            }

    public function getAllDealer()
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


    public function registerDealer($data)
    {
        return $this->create($data);
    }

    // public function registerDealerUser($data)
    // {
    //     return $this->create($data);
    // }


    public function getDealerById($id)
    {
        $query = "SELECT * FROM $this->table WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }



    public function updateDealerById($id, $data)
    {
        return $this->update($id, $data);
    }

}
