<?php
    require_once('error_const.php');
    abstract class PatternRule extends AbstractRule{

        protected $regex;

        public function __construct($regex){
            parent::__construct();
            $this -> regex = $regex;
        }
    }

    class MailRule extends PatternRule{
        public function __construct($regex){
            parent::__construct($regex);
        }

        public function check($value, $label){
            $value = trim($value);
            if(!preg_match($this -> regex, $value)){ //se l'intera mail non è valida rispetto all'espressione regolare usata per definirla (regex), ritorna errore 
                $this -> errors[] = sprintf(BAD_PATTERN_MAIL, $label);
            }
        }

    }
?>
