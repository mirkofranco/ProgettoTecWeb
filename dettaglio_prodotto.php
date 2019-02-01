<?php
// cerco l'attributo id nella query string
if (!(array_key_exists('id', $_REQUEST) && is_numeric($_REQUEST['id']))) {
    header("Location: ./404.php", 404);
    exit;
}

require_once "./scripts/php/Comments.php";
require_once "./scripts/php/connection.php";
require_once "./scripts/php/Prodotto.php";
require_once './scripts/php/Sessione.php';
require_once "./scripts/php/Util.php";
Sessione::startSession();

$productId = $_REQUEST['id'];
$stringaUsername = "";
$gestioneLogin = "";
$funzioniAdmin = "";
if (!isset($_SESSION['user'])) {
    $stringaUsername = "Fai login o registrati per scrivere commenti";
    $gestioneLogin = "<a href=\"index_admin.php\" class=\"header-button\" >Login</a><a href=\"registrazione.php\" class=\"header-button\" >Registrati</a>";
} else {
    if ($_SESSION['user']->getPermessi() == '11') {
        $gestioneLogin .= "<a href=\"index_admin.php\" class=\"header-button\">Area riservata</a>";
        $funzioniAdmin = "<div class=\"pannello-admin\">
                            <a href=\"modifica_prodotto.php?id=$_GET[id]\"  class=\"submit-action\">Modifica</a>
                            <a href=\"elimina_prodotto.php?id=$_GET[id]\" class=\"submit-action\">Elimina</a>
                          </div>";
    }
    $stringaUsername = "scrivi un commento come ". $_SESSION['user']->getUsername().":";
    $gestioneLogin .= "<a href=\"logout.php\" class=\"header-button\">Logout</a>";
}

$connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
$connection->connect();
$productAttributes = $connection->getProduct($productId);
// controllo se esiste un prodotto con quell'id
if (!$productAttributes) {
    header("Location: ./404.php", 404);
    exit;
}

$commentsList = $connection->getCommentsAndUsernames($productId);
$connection->close();

// nome della sottocategoria del prodotto attuale
$categoryName = $productAttributes[0];
$subCategoryName = $productAttributes[1];

$product = new Prodotto(...array_slice($productAttributes, 2));

$commentsBuilder = new CommentsListBuilder($product->getID());
$commentsBuilder->addCommentsList($commentsList);

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
    "{{elencoCommenti}}" => $commentsBuilder->buildHtml(),
    "{{usernameAttuale}}" => $stringaUsername
);

$page = str_replace(array_keys($daSostituire), array_values($daSostituire),
    file_get_contents('./static/_inizio.html') . file_get_contents('./static/dettaglio_prodotto.html') . file_get_contents("./static/_fine.html"));

echo $page;
