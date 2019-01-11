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

    // prende dal db una mappa delle categorie, indicizzata sull'id
    $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
    $connection -> connect();
    $categorie = $connection->mappaCategorie();

    // assembla dinamicamente il menu laterale
    $sidebar = new SidebarBuilder($currentCategory);

    foreach ($categorie as $id => $categoria) {
        $nome = $categoria['Nome'];
        $idPadre = $categoria['IDCatPadre'];

        if (is_null($idPadre)) { // se non ha padre, è una categoria
            $sidebar->addCategory($nome);
        } else { // altrimenti è una sottocategoria quindi recupero il nome del padre
            $nomePadre = $categorie[$categoria['IDCatPadre']]['Nome'];

            $sidebar->addSubCategory($nomePadre, $nome);
        }
    }

    // costruisce l'html del menu laterale usando gli elementi aggiunti finora
    // e lo inserisce nella pagina
    $page = str_replace("{{contenutoDinamicoSidebar}}", $sidebar->buildHTML(), $page);

    // prende dal db i prodotti......
    // $products = $connection->getProdotti();

    $connection -> close();

    // costruisce dinamicamente il contenuto della pagina
    $subCategory = new SubCategoryBuilder("sottocategoria #1");

    $subCategory->addImg("./icons/_placeholder_black.png", "alt text");
    $subCategory->addImg("./icons/_placeholder_black.png", "alt text");
    $subCategory->addImg("./icons/_placeholder_black.png", "alt text");
    $subCategory->addImg("./icons/_placeholder_black.png", "alt text");

    // costruisce l'html della pagina usando gli elementi aggiunti finora
    // e lo inserisce nella pagina
    $page = str_replace("{{contenutoDinamicoCategoria}}", $subCategory->buildHTML(), $page);

    // TODO rimuovere questo prima della consegna!
    // salva file html in ./cache_catalogo/
    $cacheFilename = str_replace(" ", "_", strtolower($currentCategory)).".html";
    $file = fopen("cache_catalogo/$cacheFilename", "w") or die("Cannot create file to write into!");
    fwrite($file, str_replace("./", "../", $page));


    echo $page;
?>
