<?php
    abstract class AbstractConnection{
        protected $hostname;
        protected $databaseName;
        protected $username;
        protected $password;
        protected $pdo;

        public function __construct($hostname, $databaseName, $username, $password){
            $this -> hostname = $hostname;
            $this -> databaseName = $databaseName;
            $this -> username = $username;
            $this -> password = $password;
            $this -> pdo = null;
        }

        public abstract function connect();
    }
?>
