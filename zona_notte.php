<?php
    require_once './scripts/php/connection.php';
    require_once './scripts/php/DomUtils.php';

    require_once('./scripts/php/Sessione.php');
    Sessione::startSession();
    $gestioneLogin = "";
    if(!isset($_SESSION['user'])){
        $gestioneLogin = "<a href=\"index_admin.php\" class=\"header-button\" >Login</a><a href=\"registrazione.php\" class=\"header-button\" >Registrati</a>";
    }else{
        $gestioneLogin = "<a href=\"logout.php\" class=\"header-button\">Logout</a>";
    }

    // definisce variabili della pagina corrente
    $currentCategory = "Zona Notte";

    $file = ".".$_SERVER["PHP_SELF"];

    $daSostituire = array(
        "{{pageTitle}}" => "$currentCategory - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO",
        "{{nomeCategoria}}" => $currentCategory,
        "{{gestioneLogin}}" => $gestioneLogin
    );

    $page = file_get_contents('./static/_inizio_user.html').
            file_get_contents('./static/menu_catalogo.html').
            file_get_contents('./static/categoria_catalogo.html').
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


    // costruisce dinamicamente il contenuto della pagina
    $subCategory = new SubCategoryBuilder("sottocategoria #1");

    foreach ($productsMap as $subCategoryName => $products) {
        $subCategory = new SubCategoryBuilder($subCategoryName);

        foreach ($products as $product) {
            $unpackedProduct = new Prodotto(...$product);

            echo $unpackedProduct."<br>";

            // $subCategory->addProduct($unpackedProduct);
        }
    }
    die();

    // costruisce l'html di una sottocategoria usando gli elementi aggiunti finora e lo inserisce nella pagina
    $page = str_replace("{{contenutoDinamicoCategoria}}", $subCategory->buildHtml(), $page);

    // TODO rimuovere questo prima della consegna!
    // salva file html in ./cache_catalogo/
    $cacheFilename = str_replace(" ", "_", strtolower($currentCategory)).".html";
    $folder = "cache_catalogo";
    if (!is_dir($folder))
        mkdir($folder);
    $file = fopen("$folder/$cacheFilename", "w") or die("Cannot create file to write into!");
    fwrite($file, str_replace("./", "../", $page));


    echo $page;
?>
