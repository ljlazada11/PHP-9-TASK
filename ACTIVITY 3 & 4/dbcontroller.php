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
        $cnn = mysqli_connect(
            $this->host,
            $this->user,
            $this->password,
            $this->database
        );

        return $cnn;
    }

    function executeQuery($query) {
        $result = mysqli_query($this->conn, $query);
        $resultset = array();

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $resultset[] = $row;
            }
        }

        return $resultset;
    }

    function countRows($query) {
        $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result);
    }

    function verifyData($data) {
        return mysqli_real_escape_string($this->conn, $data);
    }

    function executeNonQueryIUP($command) {
        return mysqli_query($this->conn, $command);
    }
}

?>