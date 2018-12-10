<?php
    class Utente{
        private $indentificatoreUnico;
        private $nomeCognome;
        private $username;
        private $password;
        private $mail;
        private $tipo;

        public function __construct(){

        }

        public function login(){

        }

        public function getUsername(){
            return $this -> username;
        }

        public function getMail(){
            return $this -> mail;
        }

    }
?>
