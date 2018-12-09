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
            if(!preg_match($this -> regex, $value)){
                $this -> errors[] = sprintf(BAD_PATTERN_MAIL, $label);
            }
        }

    }
?>
