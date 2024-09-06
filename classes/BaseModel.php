<?php
class BaseModel
{
    protected $conn;
    protected $table;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($data)
    {
        $fields = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));
        $stmt = $this->conn->prepare("INSERT INTO $this->table ($fields) VALUES ($placeholders)");

        $types = str_repeat('s', count($data));
        $values = array_values($data);
        $stmt->bind_param($types, ...$values);

        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            return false;                   
        }
    }

    public function read($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id, $data)
    {
        $fields = implode(" = ?, ", array_keys($data)) . " = ?";
        $stmt = $this->conn->prepare("UPDATE $this->table SET $fields WHERE id = ?");

        $types = str_repeat('s', count($data)) . 'i';
        $values = array_values($data);
        $values[] = $id;
        $stmt->bind_param($types, ...$values);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
