<?php

    class CustomDOMDocument {

        protected $document;

        public function __construct() {
            $this->document = new DOMDocument('1.0', 'utf-8');
            $this->document->formatOutput = true;
            // libxml_use_internal_errors(true);
        }

        public function buildHtml() {
            $result = array();

            foreach ($this->document->childNodes as $childNode) {
                $result[] = $this->document->saveXML($childNode);
            }

            return join("\n", $result);
        }
    }

    /**
     * Costruisce il menu laterale del catalogo aggiungendo categorie e sottocategorie.
     * Vedi file /static/menu_catalogo.html per un esempio di output
     */
    class SidebarBuilder extends CustomDOMDocument {

        private $currentPage;
        private $categories;

        public function __construct($currentPage) {
            parent::__construct();
            
            $this->currentPage = $currentPage;
            $this->categories = array();
        }

        public function addCategory($name) {
            $this->categories[$name] = $this->document->createElement("div");
            $categoryContainer = $this->categories[$name];

            if ($name === $this->currentPage) {
                $categoryContainer->setAttribute("class", "sidebar-category-container sidebar-current-page");
                $href = "#";
            } else {
                $href = "./".strtolower(str_replace(" ", "_", $name)).".php";
                $categoryContainer->setAttribute("class", "sidebar-category-container");
            }

            $this->document->appendChild($categoryContainer);


            $link = $this->document->createElement("a");
            $link->setAttribute("href", $href);
            // alt text vuoto perchè il testo di questo link è già descrittivo
            $link->setAttribute("alt", " ");
            $categoryContainer->appendChild($link);

            $h2 = $this->document->createElement("h2", $name);
            $link->appendChild($h2);
        }

        public function addSubCategory($parent, $name) {
            $parentCategory = $this->categories[$parent];

            $href = "";
            if ($parent !== $this->currentPage) {
                $href .= "./".strtolower(str_replace(" ", "_", $parent)).".php";
            }

            $href .= "#".strtolower(str_replace(" ", "-", $name));

            $link = $this->document->createElement("a");
            $link->setAttribute("href", $href);
            // alt text vuoto perchè il testo di questo link è già descrittivo
            $link->setAttribute("alt", " ");
            $parentCategory->appendChild($link);

            $h3 = $this->document->createElement("h3", $name);
            $link->appendChild($h3);
        }

        /**
         * aggiunge categorie e sottocategorie a partire da un'array associativo con questa struttura:
         * 
         * array($idCategoria => array('Nome' => '$nome','IDCatPadre' => "$idPadre"), ... );
         */
        public function parseMap($categoryMap) {

            foreach (array_values($categoryMap) as $category) {
                $name = $category['Nome'];
                $parentId = $category['IDCatPadre'];
    
                if (is_null($parentId)) { // se non ha padre, è una categoria
                    $this->addCategory($name);
                } else { // altrimenti è una sottocategoria
                    // recupero il nome del padre
                    $parentName = $categoryMap[$category['IDCatPadre']]['Nome'];
        
                    $this->addSubCategory($parentName, $name);
                }
            }
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

        // public function appendChild($tag, $value = null, $attributesMap = null) {
        //     $child = $this->document->createElement($tag, $value);

        //     if (!is_null($attributesMap)) {
        //         foreach ($attributes as $attributeName => $attributeValue) {
        //             $child->setAttribute($attributeName, $attributeValue);
        //         }
        //     }

        //     $this->document->appendChild($child);
        // }
    }
?>