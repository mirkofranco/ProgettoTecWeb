<?php
    require_once("SubCategoryBuilder.php");
    require_once("SidebarBuilder.php");

    class MainContentBuilder {

      private $sidebarBuilder;
      private $subCategoriesHtml;

        public function __construct($currentCategory) {
          $this->sidebarBuilder = new SidebarBuilder($currentCategory);
        }

        public function parseCategoriesMap($categoriesMap) {
          $this->sidebarBuilder->parseCategoriesMap($categoriesMap);
        }
        
        public function parseProductsMap($productsMap) {
          $this->subCategoriesHtml = Array();

          foreach ($productsMap as $subCategoryName => $products) {

            $subCategory = new SubCategoryBuilder($subCategoryName);

            foreach ($products as $productAttributes) {
                $subCategory->addNewProduct($productAttributes);
            }
    
            $this->subCategoriesHtml[] = $subCategory->buildHtml();
          }
        }

        public function getSidebar() {
          return $this->sidebarBuilder->buildHtml();
        }

        public function getProducts() {
          return join("\n", $this->subCategoriesHtml);
        }
    }

    // <div id="#sottocategoria">
    //   ........
    // </div>
    // ....... ALTRE SOTTOCATEGORIE......
?>
