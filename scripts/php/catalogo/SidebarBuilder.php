<?php
    require_once("CustomDomDocument.php");
    require_once(__DIR__."/../Util.php");

    /**
     * Costruisce il menu laterale del catalogo aggiungendo categorie e sottocategorie.
     */
    class SidebarBuilder extends CustomDomDocument {

      private $currentCategory;
      private $categories;

      public function __construct($currentCategory) {
          parent::__construct();
          
          $this->currentCategory = $currentCategory;
          $this->categories = array();
      }

      public function addCategory($name) {
          $this->categories[$name] = $this->document->createElement("div");
          $categoryContainer = $this->categories[$name];

          if ($name === $this->currentCategory) {
              $categoryContainer->setAttribute("class", "sidebar-category-container sidebar-current-page");
              $href = "#";
          } else {
              $href = "./".Util::customLinkEncoder($name).".php";
              $categoryContainer->setAttribute("class", "sidebar-category-container");
          }

          $link = $this->document->createElement("a");
          $link->setAttribute("href", $href);

          $h2 = $this->document->createElement("h2", $name);

          $this->document->appendChild($categoryContainer);
          $categoryContainer->appendChild($link);
          $link->appendChild($h2);

      }

      public function addSubCategory($parent, $name) {
          $parentCategory = $this->categories[$parent];

          if (is_null($name))
            return;

          $href = "";
          if ($parent !== $this->currentCategory) {
              $href .= "./".Util::customLinkEncoder($parent).".php";
          }

          $href .= "#".Util::customAttributeEncoder($name);

          $link = $this->document->createElement("a");
          $link->setAttribute("href", $href);

          $h3 = $this->document->createElement("h3", $name);
          
          $parentCategory->appendChild($link);
          $link->appendChild($h3);
      }

      /**
       * aggiunge categorie e sottocategorie a partire da un'array associativo con questa struttura:
       * 
       * array($idCategoria => array('Nome' => '$nome','IDCatPadre' => "$idPadre"), ... );
       */
      public function parseCategoriesMap($categoryMap) {

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
  
// ESEMPIO DI CONTENUTO DINAMICO
// CODICE:
// $sidebar = new SidebarBuilder("categoria attuale");

// $sidebar->addCategory("categoria attuale");
// $sidebar->addCategory("altra categoria");

// $sidebar->addSubCategory("categoria attuale", "Sottocategoria 1");
// $sidebar->addSubCategory("categoria attuale", "Sottocategoria 2");
// $sidebar->addSubCategory("altra categoria", "altra Sottocategoria")

// echo $sidebar->buildHtml();

// OUTPUT:

// <div class="sidebar-category-container sidebar-current-page">
//   <a href="./categoria_attuale.php"><h2>categoria attuale</h2></a>
//   <a href="#sottocategoria-1"><h3>Sottocategoria 1</h3></a>
//   <a href="#sottocategoria-2"><h3>Sottocategoria 2</h3></a>
// </div>
// <div class="sidebar-category-container">
//   <a href="./altra_categoria.php"><h2>altra categoria</h2></a>
//   <a href="./altra_categoria.php/#altra-sottocategoria"><h3>altra Sottocategoria</h3></a>
// </div>

// (la classe sidebar-current-page è presente solo sulla parte di menu corrispondente alla pagina attuale)
?>