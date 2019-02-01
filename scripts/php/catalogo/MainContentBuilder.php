<?php
require_once "SubCategoryBuilder.php";
require_once "SidebarBuilder.php";

/**
 * costruisce una sottopagina del catalogo
 */
class MainContentBuilder {

    private $sidebarBuilder;
    private $subCategoriesHtml;

    public function __construct($currentCategory) {
        $this->sidebarBuilder = new SidebarBuilder($currentCategory);
    }

    /**
     * aggiunge le sottocategorie (indicizzate per categoria) alla sidebar
     */
    public function parseCategoriesMap($categoriesMap) {
        $this->sidebarBuilder->parseCategoriesMap($categoriesMap);
    }

    /**
     * aggiunge i prodotti (indicizzati per sottocategoria) alla pagina
     */
    public function parseProductsMap($productsMap) {
        $this->subCategoriesHtml = array();

        foreach ($productsMap as $subCategoryName => $products) {

            $subCategory = new SubCategoryBuilder($subCategoryName);

            foreach ($products as $productAttributes) {
                $subCategory->addNewProduct($productAttributes);
            }

            $this->subCategoriesHtml[] = $subCategory->buildHtml();
        }
    }

    /**
     * ritorna il codice html della sidebar per questa categoria
     */
    public function getSidebar() {
        return $this->sidebarBuilder->buildHtml();
    }

    /**
     * ritorna il codice html della lista di prodotti per questa categoria
     */
    public function getProducts() {
        return join("\n", $this->subCategoriesHtml);
    }
}

// <div id="#sottocategoria">
//   [VEDI FILE /scripts/php/catalogo/SubCategoryBuilder.php]
// </div>
// ALTRE SOTTOCATEGORIE......
?>
