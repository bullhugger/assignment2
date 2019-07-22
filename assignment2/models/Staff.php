<?php
    class Staff{
        private $conn;
        private $table = 'staff';

        //Properties
        public $id;
        public $name;
        public $senior;

        //Constructor with Database
        public function __construct($db){
            $this->conn = $db;
        }

        //GET
        public function read(){
            $query = 'SELECT id, name, senior FROM ' . $this->table;
        
        $state = $this->conn->prepare($query);

        $state->execute();

        return $state;
        }
        //Filtering intern and senior
        public function read_filter(){
            // Create query
            $query = 'SELECT
                  id,
                  name
                FROM
                  ' . $this->table . '
              WHERE senior = :senior';
        
              //Prepare statement
              $state = $this->conn->prepare($query);
        
              // Bind ID
              $state->bindParam(1, $this->senior);
        
              // Execute query
              $state->execute();
        
              $row = $state->fetch(PDO::FETCH_ASSOC);
        
              // set properties
              $this->senior = $row['senior'];
              $this->name = $row['name'];
          }
        //Create user
        public function create(){
            $query = 'INSERT INTO ' . $this->table . '
            SET name = :name, senior = :senior';

            $state = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->senior = htmlspecialchars(strip_tags($this->senior));

            $state->bindParam(':name', $this->name);
            $state->bindParam(':senior', $this->senior);

            if($state->execute()){
                return true;
            }

            printf("Error: $s. \n", $state->error);

            return false;
        }

        //Update user
        public function update(){
            $query = 'UPDATE ' . 
                $this->table . ' 
            SET
                name = :name,
                senior = :senior
                WHERE
                id = :id
                ';
            
            $state = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->senior = htmlspecialchars(strip_tags($this->senior));

            $state->bindParam(':name', $this->name);
            $state->bindParam(':id', $this->id);
            $state->bindParam(':senior', $this->senior);

            if($state->execute()){
                return true;
            }

            prinf("Error: $s.\n", $state->error);

            return false;
        }

        //Delete user
        public function delete(){
            $query = 'DELETE FROM ' . 
                $this->table . ' 
            WHERE
                id = :id';
            
            $state = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $state->bindParam(':id', $this->id);

            if($state->execute()){
                return true;
            }

            prinf("Error: $s.\n", $state->error);

            return false;
        }
    }
?>