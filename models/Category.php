<?php

    class Category {

        //DB stuff
        private $conn;
        private $table = 'categories';

        //Categories Properties
        public $id;
        public $name;
        public $created_at;

        //Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        //Get categories
        public function read(){

            //Create query
            $query = 'SELECT 
                    id, 
                    name,
                    created_at
                FROM
                    ' . $this->table . '
                ORDER BY
                    created_at DESC';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();

            return $stmt;

        }

        //Get single category
        public function read_single(){

            //Create query
            $query = 'SELECT
                id, 
                name,
                created_at
            FROM
                ' . $this->table . '
            WHERE
                id = ?
            LIMIT 0,1';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind id
            $stmt->bindParam(1, $this->id);

            //Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->name = $row['name'];

        }

        //Create Category
        public function create(){

            //Create query
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    name = :name';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));

            //Bind data
            $stmt->bindParam(':name', $this->name);

            //Execute query
            if($stmt->execute()){
                return true;
            } else {

                //Print error if something goes wrong
                printf("Error: %s.\n", $stms->error);

                return false;
            }

        }

        //Update Category
        public function update(){

            //Create query
            $query = 'UPDATE ' . $this->table . '
                SET
                    name = :name
                WHERE
                    id = :id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':id', $this->id);

            //Execute query
            if($stmt->execute()){
                return true;
            } else {

                //Print error if something goes wrong
                printf("Error: %s.\n", $stms->error);

                return false;
            }


        }

        //Delete Category
        public function delete(){

            //Create query
            $query = 'DELETE FROM ' . $this->table . '
                WHERE
                    id = :id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind data
            $stmt->bindParam(':id', $this->id);

            //Execute query
            if($stmt->execute()){
                return true;
            } else {

                //Print error if something goes wrong
                printf("Error: %s.\n", $stms->error);

                return false;
            }
        }




    }