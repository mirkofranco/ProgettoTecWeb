<?php

    class CustomDOMDocument {

        protected $document;

        public function __construct() {
            $this->document = new DOMDocument('1.0', 'utf-8');
            libxml_use_internal_errors(true);
        }

        public function getHTML() {
            $result = array();

            foreach ($this->document->childNodes as $childNode) {
                $result[] = $this->document->saveXML($childNode);
            }

            return join("\n", $result);
        }
    }

    class SidebarBuilder extends CustomDOMDocument {

        private $currentPage;
        private $categories;

        public function __construct($currentPage) {
            parent::__construct();
            
            $this->currentPage = $currentPage;
            $this->categories = array();
        }

        public function addCategory($name, $href) {
            $this->categories[$name] = $this->document->createElement("div");
            $categoryContainer = $this->categories[$name];

            if ($name === $this->currentPage) {
                $categoryContainer->setAttribute("class", "category-container sidebar-current-page");
            } else {
                $categoryContainer->setAttribute("class", "category-container");
            }

            $this->document->appendChild($categoryContainer);

            $link = $this->document->createElement("a");
            $link->setAttribute("href", $href); // TODO: alt???
            $categoryContainer->appendChild($link);

            $h2 = $this->document->createElement("h2", $name);
            $link->appendChild($h2);
        }

        public function addSubCategory($parent, $name, $href) {
            $parentCategory = $this->categories[$parent];

            $link = $this->document->createElement("a");
            $link->setAttribute("href", $href);
            $parentCategory->appendChild($link);

            $h3 = $this->document->createElement("h3", $name);
            $link->appendChild($h3);
        }

    }

    class SubCategoryBuilder extends CustomDOMDocument {

        private $imgContainer;

        public function __construct($value) {
            parent::__construct();

            $node = $this->document->createElement("h2", $value);
            $this->document->appendChild($node);

            $this->imgContainer = $this->document->createElement("div");
            $this->imgContainer->setAttribute("class", "flex-container subcategory-container");

            $this->document->appendChild($this->imgContainer);
        }

        public function addImg($src, $alt, $classes = null) {
            $img = $this->document->createElement("img");

            $img->setAttribute("src", $src);
            $img->setAttribute("alt", $alt);

            if (!is_null($classes)) {
                $img->setAttribute("class", $classes);
            }

            $this->imgContainer->appendChild($img);
        }

        public function appendChild($tag, $value = null, $attributesMap = null) {
            $child = $this->document->createElement($tag, $value);

            if (!is_null($attributesMap)) {
                foreach ($attributes as $attributeName => $attributeValue) {
                    $child->setAttribute($attributeName, $attributeValue);
                }
            }

            $this->document->appendChild($child);
        }
    }
?>
