<?php
    class DatabaseConnection{
        private $hostname;
        private $databaseName;
        private $username;
        private $password;
        private $pdo;

        public function __construct($hostname, $databaseName, $username, $password){
            $this -> hostname = $hostname;
            $this -> databaseName = $databaseName;
            $this -> username = $username;
            $this -> password = $password;
            $pdo = null;
        }//__construct

        public function connect(){
            try{
                $this -> pdo = new PDO(('mysql:dbname=' . $this -> databaseName . ';host=' . $this -> hostname . ';charset=utf8'), $this -> username, $this -> password);
            }catch(PDOException $e){
                echo "Si è verificato un errore";
            }//trycatch
        }//connect

        //For testing
        public function query($query){
            return $this -> pdo -> query($query);
        }//query

        //For testing
        //$result : PDOStatement
        public function f($result){
            return $result -> fetchAll();
        }

        public function close(){
            $pdo = null;
        }//close

    }//DatabaseConnection
?>
