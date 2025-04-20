<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "db_melody"; 
    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<!-- Database connected successfully -->";
        } catch (PDOException $e) {
            // Display error message
            die("Database Connection Error: " . $e->getMessage());
        }
    }
}
?>