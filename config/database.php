<?php
    class Database{
        private $host = "localhost";
        private $dbname = "smart_notes";
        private $username = "root";
        private $password = "";
        public $conn;

        public function connect(){
            $this->conn = new PDO("mysql:host = $this->host; dbname = $this->dbname", $this->username, $this->password);            
            return $this->conn;
        }
        
    }

?>