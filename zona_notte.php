<?php
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
        "{{nomeCategoria}}" => $currentCategory
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
