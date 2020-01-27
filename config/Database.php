<?php

    class Database {

        // DB params
        private $host = 'mysql:host=localhost;dbname=myblog;port=8889';
        private $username = 'root';
        private $password = 'root';
        private $conn;

        //DB Connect
        public function connect(){
            $this->conn = null; 

            try {
                $this->conn = new PDO($this->host, $this->username, $this->password);
                
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch(PDOException $e){
                echo "Connection Error: " . $e->getMessage();
            }
            return $this->conn;
        }
    }