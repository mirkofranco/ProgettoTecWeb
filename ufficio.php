<?php
    require_once('./scripts/php/catalogo/SidebarBuilder.php');
    require_once('./scripts/php/catalogo/MainContentBuilder.php');
    require_once('./scripts/php/connection.php');

    require_once('./scripts/php/Utente.php');
    require_once('./scripts/php/Sessione.php');
    Sessione::startSession();
    $gestioneLogin = "";
    if(!isset($_SESSION['user'])){
        $gestioneLogin = "<a href=\"login.php\" class=\"header-button\" >Login</a><a href=\"registrazione.php\" class=\"header-button\" >Registrati</a>";
    }else{
		if($_SESSION['user'] -> getPermessi() == '11'){
            $gestioneLogin .= "<a href=\"menu_admin.php\" class=\"header-button\">Area riservata</a>";
        }
        $gestioneLogin .= "<a href=\"logout.php\" class=\"header-button\">Logout</a>";
    }

    $currentCategory = "Ufficio";
    $file = "." . $_SERVER["PHP_SELF"];

    $daSostituire = array(
      "{{pageTitle}}" => "$currentCategory - Studio AR",
      "{{pageDescription}}"=> "Pagina del catalogo dedicata alla categoria $currentCategory di prodotti offerti dallo studio AR - architetti riuniti",
      "<a href=\"./catalogo.php\">" => "<a href=\"./catalogo.php\" class=\"current-page\">",
      "{{nomeCategoria}}" => $currentCategory,
      "{{gestioneLogin}}" => $gestioneLogin
    );

    $page = str_replace(array_keys($daSostituire),
                        array_values($daSostituire),
                          file_get_contents('./static/_inizio.html').
                          file_get_contents('./static/sottopagina_catalogo.html').
                          file_get_contents("./static/_fine.html"));

    $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
    $connection->connect();
    // prende dal db una mappa delle categorie, indicizzata sull'id
    $categoriesMap = $connection->categoriesMap();
    // prende dal db una mappa degli attributi di tutti prodotti appartenenti alla categoria attuale, indicizzata sulle sottocategorie
    $productsMap = $connection->productsMap($currentCategory);
    $connection->close();

    // costruisce dinamicamente il contenuto della pagina
    $mainContentBuilder = new MainContentBuilder($currentCategory);

    // assembla dinamicamente il menu laterale, inserendo le categorie prese dal db
    $mainContentBuilder->parseCategoriesMap($categoriesMap);

    // inserisce i prodotti
    $mainContentBuilder->parseProductsMap($productsMap);

    // inserisce gli elementi costruiti finora nella pagina
    $page = str_replace("{{contenutoDinamicoSidebar}}", $mainContentBuilder->getSidebar(), $page);
    $page = str_replace("{{contenutoDinamicoCategoria}}", $mainContentBuilder->getProducts(), $page);

    echo $page;
?>
