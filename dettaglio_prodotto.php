<?php
require_once "./scripts/php/connection.php";
require_once "./scripts/php/Prodotto.php";
require_once "./scripts/php/Util.php";

require_once './scripts/php/Utente.php';
require_once './scripts/php/Sessione.php';
Sessione::startSession();
$gestioneLogin = "";
$funzioniAdmin = "";
$inserimentoCommenti = "";
if (!isset($_SESSION['user'])) {
    $gestioneLogin = "<a href=\"index_admin.php\" class=\"header-button\" >Login</a><a href=\"registrazione.php\" class=\"header-button\" >Registrati</a>";
} else {
    if ($_SESSION['user']->getPermessi() == '11') {
        $gestioneLogin .= "<a href=\"index_admin.php\" class=\"header-button\">Area riservata</a>";
<<<<<<< Updated upstream
        $funzioniAdmin .= "<div class=\"pannello-admin submit-action\"> <a href=\"elimina.php?id=". $_GET['id'] . "\">Elimina</a>  </div>";
=======
>>>>>>> Stashed changes
        $funzioniAdmin .= "<div class=\"pannello-admin\"> <a href=\"eliminaProdotto.php?id=". $_GET['id'] . "\">Elimina</a>  </div>";
    }
    if($_SESSION['user'] -> getPermessi() == '01'){
        $inserimentoCommenti = "<div contenteditable = \"true\">Contenuto editabile</div>";
    }
    $gestioneLogin .= "<a href=\"logout.php\" class=\"header-button\">Logout</a>";
}

// cerco l'attributo id nella query string
if (!(array_key_exists('id', $_REQUEST) && is_numeric($_REQUEST['id']))) {
    // FIXME: quale dei due argomenti usare?
    // header("HTTP/1.0 404 Not Found");
    header("Location: ./404.php", 404);
    exit;
}

$connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
$connection->connect();
$attributes = $connection->selectFromProductsWhereId($_REQUEST['id']);
$connection->close();

// controllo se l'id corrisponde a un prodotto
if (!$attributes) {
    // FIXME: quale dei due argomenti usare?
    // header("HTTP/1.0 404 Not Found");
    header("Location: ./404.php", 404);
    exit;
}

// nome della sottocategoria del prodotto attuale
$categoryName = $attributes[0];
$subCategoryName = $attributes[1];

$product = new Prodotto(...array_slice($attributes, 2));

$daSostituire = array(
    "{{pageTitle}}" => $product->getNome() . " - Dettaglio prodotto - Studio AR",
    "{{pageDescription}}" => "Pagina di dettaglio per un prodotto venduto dallo studio AR - architetti riuniti",
    "{{gestioneLogin}}" => $gestioneLogin,
    "{{funzioniAdmin}}" => $funzioniAdmin,
    "{{nomeCategoria}}" => $categoryName,
    "{{nomeSottoCategoria}}" => $subCategoryName,
    "{{nomeProdotto}}" => $product->getNome() . " (dettaglio)",
    "{{linkSottoCategoria}}" => "./" . Util::customLinkEncoder($categoryName) . ".php#" . Util::customAttributeEncoder($subCategoryName),
    "{{dettaglioProdotto}}" => $product->getDettaglioProdotto(),
    "{{inserimentoCommenti}}" => $inserimentoCommenti
);

$page = str_replace(array_keys($daSostituire), array_values($daSostituire),
    file_get_contents('./static/_inizio.html') . file_get_contents('./static/dettaglio_prodotto.html') . file_get_contents("./static/_fine.html"));

// TODO pulsanti modifica/elimina....

echo $page;
