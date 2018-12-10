<?php
    class Sessione{

        public static function isStarted(){
            return session_id() == ""  ?  false : true;
        }

        public static function startSession(){
            if(!Sessione::isStarted())
                session_start();
        }

        public static function sessioneDestroy(){
            if(Sessione::isStarted())
                session_destroy();
        }

        public static function get($key){

        }

    }
?>
