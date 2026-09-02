<?php 

class DBController {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "myfirstdb";
    private $conn;

    function __construct() {
        $this->conn = $this->connectDB();
    }

    function connectDB() {
        $cnn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        return $cnn;
    }

    function executeQuery($query) {
        $result = mysqli_query($this->conn,$query);
        while($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }

        if(!empty($resultset)) {
            return $resultset;
        }
    }

    function countRows($query) {
        $result = mysqli_query($this->conn,$query);
        $count = mysqli_num_rows($result);
        return $count;
    }

    function verifyData($data) {
        return mysqli_real_escape_string($this->conn,$data);
    }

    function executeNonQueryIUP($command) {
        return mysqli_query($this->conn,$command);
    }
}

?>