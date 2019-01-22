<?php

    class CustomDomDocument {

        protected $document;

        public function __construct() {
            $this->document = new DOMDocument('1.0', 'utf-8');
            $this->document->formatOutput = true;
            // libxml_use_internal_errors(true);
        }
    }
?>
