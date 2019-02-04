<?php
    require_once("CustomDomDocument.php");
    require_once(__DIR__.'/../Prodotto.php');
    require_once(__DIR__."/../Util.php");
    /**
     * Costruisce la lista di prodotti inclusa nella sottocategoria indicata
     */
    class SubCategoryBuilder extends CustomDomDocument {

      protected $mainContainer;
      protected $productsContainer;

      public function __construct($name) {
          parent::__construct();

          $this->mainContainer = $this->document->createElement("section");

          // caso limite: sottocategoria senza nome;
          if ($name !== '') {
            $this->mainContainer->setAttribute("id", Util::customAttributeEncoder($name));
            
            // crea header con nome della sottocategoria
            $mainHeader = $this->document->createElement("h2", $name);
            $this->mainContainer->appendChild($mainHeader);
          }
          $this->productsContainer = $this->document->createElement("div", "\n");
          $this->productsContainer->setAttribute("class", "flex-container subcategory-container");
          $this->mainContainer->appendChild($this->productsContainer);
      }

      public function addNewProduct($productAttributes) {
        $product = new Prodotto(...$productAttributes);

        $tempNode = $this->document->importNode($product->getAnteprimaProdotto(), TRUE);

        $this->productsContainer->appendChild($tempNode);
      }

      public function buildHtml() {
        return $this->document->saveXML($this->mainContainer);
      }

    }

    // <section id="#sottocategoria">
    //   <h2>sottocategoria</h2>
    //   <div class="flex-container subcategory-container">  
    //     <div id="#idProdotto" class="anteprima-prodotto">
    //     [VEDI FILE /scripts/php/Prodotto.php]
    //     </div>
  
    //     ALTRI PRODOTTI......
    //   </div>
?>