<?php
    require_once './scripts/php/connection.php';
    require_once './scripts/php/CatalogPageBuilder.php';
    require_once './scripts/php/Prodotto.php';
    require_once('./scripts/php/Utente.php');
    require_once('./scripts/php/Sessione.php');
    Sessione::startSession();
    $gestioneLogin = "";
    if(!isset($_SESSION['user'])){
        $gestioneLogin = "<a href=\"index_admin.php\" class=\"header-button\" >Login</a><a href=\"registrazione.php\" class=\"header-button\" >Registrati</a>";
    }else{
        if($_SESSION['user'] -> getPermessi() == '11'){
            $gestioneLogin .= "<a href=\"index_admin.php\" class=\"header-button\">Area riservata</a>";
        }
        $gestioneLogin .= "<a href=\"logout.php\" class=\"header-button\">Logout</a>";
    }

    // definisce variabili della pagina corrente
    $currentCategory = "Zona Notte";
    $file = "." . $_SERVER["PHP_SELF"];
    $daSostituire = array(
        "{{pageTitle}}" => "$currentCategory - Studio AR",
        "{{pageDescription}}"=>"Pagina del catalogo dedicata alla zona notte dello studio AR - architetti riuniti",
        "<a href=\"./catalogo.php\">" => "<a href=\"./catalogo.php\" class=\"current-page\">",
        "{{nomeCategoria}}" => $currentCategory,
        "{{gestioneLogin}}" => $gestioneLogin
    );

    $page = file_get_contents('./static/_inizio.html').
            file_get_contents('./static/sidebar_catalogo.html').
            file_get_contents('./static/sottopagina_catalogo.html').
            file_get_contents("./static/_fine.html");

    $page = str_replace(array_keys($daSostituire), array_values($daSostituire), $page);

    $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
    $connection->connect();
    // prende dal db una mappa delle categorie, indicizzata sull'id
    $categorie = $connection->mappaCategorie();
    // prende dal db una mappa di tutti i prodotti per la categoria attuale, indicizzata sulla sottocategoria
    $productsMap = $connection->mappaProdotti($currentCategory);
    $connection -> close();

    // echo '<pre>' , var_export($productsMap) , '</pre>';
    // die();

    // assembla dinamicamente il menu laterale
    $sidebar = new SidebarBuilder($currentCategory);

    // inserisce le categorie prese dal db
    $sidebar->parseMap($categorie);

    // costruisce l'html del menu laterale usando gli elementi aggiunti finora e lo inserisce nella pagina
    $page = str_replace("{{contenutoDinamicoSidebar}}", $sidebar->buildHtml(), $page);


    // // costruisce dinamicamente il contenuto della pagina
    // $subCategory = new SubCategoryBuilder("sottocategoria #1");

    // foreach ($productsMap as $subCategoryName => $products) {
    //     $subCategory = new SubCategoryBuilder($subCategoryName);

    //     foreach ($products as $product) {
    //         $unpackedProduct = new Prodotto(...$product);

    //         echo $unpackedProduct."<br>";

    //         // $subCategory->addProduct($unpackedProduct);
    //     }
    // }
    // die();

    // // costruisce l'html di una sottocategoria usando gli elementi aggiunti finora e lo inserisce nella pagina
    // $page = str_replace("{{contenutoDinamicoCategoria}}", $subCategory->buildHtml(), $page);

    echo $page;
?>
