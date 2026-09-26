<?php

require_once __DIR__ . '/../dbcontroller.php';

class Faculty {

    private $db;

    public function __construct() {
        $this->db = new DBController();
    }

    // Retrieve all faculty records from the database
    public function getAll() {
        $query = "SELECT * FROM faculty ORDER BY faculty_id ASC";
        return $this->db->executeQuery($query);
    }

    // Retrieve a single faculty record by faculty_id
    public function getById($id) {
        $cleanId = $this->db->verifyData($id);
        $query = "SELECT * FROM faculty WHERE faculty_id = '$cleanId'";
        $result = $this->db->executeQuery($query);

        if (!empty($result)) {
            return $result[0];
        }

        return null;
    }

    // Insert a new faculty record
    public function create($data) {
        $firstName  = $this->db->verifyData($data['first_name']);
        $middleName = isset($data['middle_name']) ? $this->db->verifyData($data['middle_name']) : '';
        $lastName   = $this->db->verifyData($data['last_name']);
        $age        = (int)$data['age'];
        $gender     = $this->db->verifyData($data['gender']);
        $address    = $this->db->verifyData($data['address']);
        $position   = $this->db->verifyData($data['position']);
        $salary     = (float)$data['salary'];

        $query = "INSERT INTO faculty 
            (first_name, middle_name, last_name, age, gender, address, position, salary)
            VALUES 
            ('$firstName', '$middleName', '$lastName', $age, '$gender', '$address', '$position', $salary)";

        return $this->db->executeNonQueryIUP($query);
    }

    // Update an existing faculty record by faculty_id
    public function update($id, $data) {
        $cleanId    = $this->db->verifyData($id);
        $firstName  = $this->db->verifyData($data['first_name']);
        $middleName = isset($data['middle_name']) ? $this->db->verifyData($data['middle_name']) : '';
        $lastName   = $this->db->verifyData($data['last_name']);
        $age        = (int)$data['age'];
        $gender     = $this->db->verifyData($data['gender']);
        $address    = $this->db->verifyData($data['address']);
        $position   = $this->db->verifyData($data['position']);
        $salary     = (float)$data['salary'];

        $query = "UPDATE faculty SET 
            first_name = '$firstName',
            middle_name = '$middleName',
            last_name = '$lastName',
            age = $age,
            gender = '$gender',
            address = '$address',
            position = '$position',
            salary = $salary
            WHERE faculty_id = '$cleanId'";

        return $this->db->executeNonQueryIUP($query);
    }

    // Delete a faculty record by faculty_id
    public function delete($id) {
        $cleanId = $this->db->verifyData($id);
        $query = "DELETE FROM faculty WHERE faculty_id = '$cleanId'";
        $result = $this->db->executeNonQueryIUP($query);

        // Reset auto_increment to 1 if all records are deleted (from Output #3&4)
        $check = $this->db->executeQuery("SELECT COUNT(*) AS total FROM faculty");
        if (!empty($check) && $check[0]["total"] == 0) {
            $this->db->executeNonQueryIUP("ALTER TABLE faculty AUTO_INCREMENT = 1");
        }

        return $result;
    }
}

?>
