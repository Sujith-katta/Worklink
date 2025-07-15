<?php
class Database {
    private static $instance = null;
    private $conn;
    
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "worklink";
    
    private function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        
        $this->conn->set_charset("utf8mb4");
    }
    
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
    
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

// Global connection function
function getDBConnection() {
    return Database::getInstance();
}

$conn = getDBConnection();
?>