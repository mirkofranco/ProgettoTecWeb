<?php
    define('BAD_PATTERN_MAIL', 'Il contenuto di "%s" non è una mail valida');
    define('BAD_PATTERN_DATE', 'Il contenuto di "%s" non è una data nel formato valido');

    abstract class AbstractErrorHandler{
        protected $errors;

        public function __construct(){
            $this -> errors = array();
        }

        public function isValid(){
            return count($this -> errors) == 0;
        }

        public function getFirstError(){
            return array_shift($this -> errors);
        }

        public function getErrors(){
            return $this -> errors;
        }
    }

    abstract class AbstractRule extends AbstractErrorHandler{
        public function __construct(){
            parent::__construct();
        }
        public abstract function check($value, $label);
    }

?>
