<?php
    require_once('./scripts/php/Sessione.php');
    Sessione::startSession();
    $gestioneLogin = "";
    if(!isset($_SESSION['user'])){
        $gestioneLogin = "<a href=\"index_admin.php\" class=\"header-button\" >Login</a><a href=\"registrazione.php\" class=\"header-button\" >Registrati</a>";
    }else{
        $gestioneLogin = "<a href=\"logout.php\" class=\"header-button\">Logout</a>";
    }
    require_once './scripts/php/DomUtils.php';

    // TODO: prendere lista categorie da db!
    // require_once './scripts/php/connection.php';
    // $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
    // $connection -> connect();
    // $listaCategorie = $connection -> listaCategorie();
    // $connection -> close();

    $currentCategory = "Zona notte";

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

    // costruisce dinamicamente il menu laterale
    $sidebar = new SidebarBuilder($currentCategory);

    $sidebar->addCategory("Zona notte", $file);
    $sidebar->addSubCategory("Zona notte", "Letti", "#letti");

    $sidebar->addCategory("cat1", "./cat1");
    $sidebar->addSubCategory("cat1", "subcat11", "#subcat11");
    $sidebar->addSubCategory("cat1", "subcat12", "#subcat12");

    $sidebar->addCategory("cat2", "./cat2");
    $sidebar->addSubCategory("cat2", "subcat21", "#subcat21");

    $daSostituire["{{contenutoDinamicoSidebar}}"] = $sidebar->getHTML();

    // costruisce dinamicamente il contenuto della pagina
    $subCategory = new SubCategoryBuilder("sottocategoria #1");

    $subCategory->addImg("./icons/_placeholder_black.png", "alt text");
    $subCategory->addImg("./icons/_placeholder_black.png", "alt text");
    $subCategory->addImg("./icons/_placeholder_black.png", "alt text");
    $subCategory->addImg("./icons/_placeholder_black.png", "alt text");

    $daSostituire["{{contenutoDinamicoCategoria}}"] = $subCategory->getHTML();

    echo str_replace(array_keys($daSostituire), array_values($daSostituire), $page);
?>
