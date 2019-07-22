<?php
    class Database {
        //Database parameters
        private $host = 'localhost';
        private $db_name = 'assignment2';
        private $password = '';
        private $username = 'root';
        private $conn;
        
        //Database connect
        public function connect(){
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo 'Connection error: ' .$e->getMessage();
            }

            return $this->conn;
        }
    }
?>