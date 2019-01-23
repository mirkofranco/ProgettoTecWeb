<?php
require_once "./scripts/php/connection.php";
require_once "./scripts/php/Prodotto.php";
require_once "./scripts/php/Util.php";

require_once './scripts/php/Utente.php';
require_once './scripts/php/Sessione.php';
Sessione::startSession();
$gestioneLogin = "";
if (!isset($_SESSION['user'])) {
    $gestioneLogin = "<a href=\"index_admin.php\" class=\"header-button\" >Login</a><a href=\"registrazione.php\" class=\"header-button\" >Registrati</a>";
} else {
    if ($_SESSION['user']->getPermessi() == '11') {
        $gestioneLogin .= "<a href=\"index_admin.php\" class=\"header-button\">Area riservata</a>";
    }
    $gestioneLogin .= "<a href=\"logout.php\" class=\"header-button\">Logout</a>";
}

// parsing della stringa di query;
$queryString = array();
parse_str($_SERVER["QUERY_STRING"], $queryString);

if (!(array_key_exists('id', $queryString) && is_numeric($queryString['id']))) {
    // FIXME: quale dei due argomenti usare?
    // header("HTTP/1.0 404 Not Found");
    header("Location: ./404.php", 404);
    exit;
}

$connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
$connection->connect();
$attributes = $connection->selectFromProductWhereId($queryString['id']);
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
    "{{nomeCategoria}}" => $categoryName,
    "{{nomeSottoCategoria}}" => $subCategoryName,
    "{{nomeProdotto}}" => $product->getNome() . " (dettaglio)",
    "{{linkSottoCategoria}}" => "./" . Util::customLinkEncoder($categoryName) . ".php#" . Util::customAttributeEncoder($subCategoryName),
    "{{dettaglioProdotto}}" => $product->getDetailsHtml(),
);

$page = str_replace(array_keys($daSostituire), array_values($daSostituire),
    file_get_contents('./static/_inizio.html') . file_get_contents('./static/dettaglio_prodotto.html') . file_get_contents("./static/_fine.html"));

// TODO pulsanti modifica/elimina....

echo $page;
