<?php
    require_once('./scripts/php/Utente.php');

    class Sessione{

        public static function isStarted(){
            return session_id() == ""  ?  false : true;
        }

        public static function startSession(){
            if(!Sessione::isStarted())
                session_start();
        }

        /**
         * redirige alla home se l'utente attuale non è admin
         */
        public static function reservedPage() {
            if (!(isset($_SESSION['user']) && $_SESSION['user']->getPermessi() == '11')){
                echo "aaaaaaaaaaaaaaaah";
                header("location: ./index.php");
            }
        }

        public static function sessioneDestroy(){
            if(Sessione::isStarted())
                session_destroy();
        }

    }
?>
