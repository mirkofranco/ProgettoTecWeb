<?php
    require_once('connection.php');
    class Utente{
        private $nome;
        private $Cognome;
        private $username;
        private $password;
        private $mail;
        private $permessi;

        public function __construct($nome, $cognome,  $username, $password, $mail, $permessi = "01"){
            $this -> nome = $nome;
            $this -> Cognome = $cognome;
            $this -> username = $username;
            $this -> password = $password;
            $this -> mail = $mail;
            $this -> permessi = $permessi;
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

        public function getNome(){
            return $this -> nome;
        }

        public function getPermessi(){
            return $this -> permessi;
        }

        public function getCognome(){
            return $this -> Cognome;
        }

        public function __toString(){
            return "Identificatote: " . $this -> indentificatoreUnico . " Username: " . $this -> username ;
        }

    }
?>
