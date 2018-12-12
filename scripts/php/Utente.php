<?php
    require_once('connection.php');
    class Utente{
        private $indentificatoreUnico;
        private $nomeCognome;
        private $username;
        private $password;
        private $mail;
        private $tipo;

        public function __construct($id, $nome, $username, $password, $mail, $tipo){
            $this -> indentificatoreUnico = $id;
            $this -> nomeCognome = $nome;
            $this -> username = $username;
            $this -> password = $password;
            $this -> mail = $mail;
            $this -> tipo = $tipo;
        }



        public static function login($username, $password){
            $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
            $connection -> connect();
            $login = $connection -> searchUtenteForLogin($username, $password);
            $connection -> close();
            return $login;
        }

        public function getIdentifier(){
            return $this -> indentificatoreUnico;
        }

        public function getUsername(){
            return $this -> username;
        }

        public function getPassword(){
            return $this -> password;
        }

        public function getMail(){
            return $this -> mail;
        }

        public function __toString(){
            return "Identificatote: " . $this -> indentificatoreUnico . " Username: " . $this -> username ;
        }

    }
?>
