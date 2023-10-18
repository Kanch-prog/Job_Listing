<?php
// db.php
class Database {
    private $host = "localhost"; 
    private $port = 3306;       
    private $username = "root"; 
    private $password = "  ";
    private $dbname = "job_listing";     


    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function connect() {
        return $this->conn;
    }
}
?>
