<?php
require_once './scripts/php/Sessione.php';
Sessione::startSession();
Sessione::reservedPage();

// controlla che la query string contenga un id
if (!(array_key_exists('id', $_REQUEST) && is_numeric($_REQUEST['id']))) {
    header("Location: ./404.php", 404);
    exit;
}

$daSostituire = array(
    "{{pageTitle}}" => "Inserimento Prodotti - Studio AR",
    "{{pageDescription}}" => "Pagina per l'inserimento dei prodotti del sito dello studio AR - architetti riuniti",
    "<body>" => "<body onload=\"loadDataPicker()\">",
    "{{errorForm}}" => $errorForm,
    "{{idProdotto}}" => $productId,
    "{{elencoCategorie}}" => $elencoCategorie,
    "{{previousNome}}" => $previousNome,
    "{{previousMarca}}" => $previousMarca,
    "{{previousPrezzo}}" => $previousPrezzo,
    "{{previousIsOfferta" => $previousIsOfferta,
    "{{previousData}}" => $previousData,
    "{{previousDescrizione}}" => $previousDescrizione,
    // immagine???
    "{{successForm}}" => $successForm,
    "{{gestioneLogin}}" => $gestioneLogin,
);

$page = file_get_contents('./static/_inizio.html') .
file_get_contents('./static/inserimento_prodotto.html') .
file_get_contents('./static/_fine.html');

echo str_replace(array_keys($daSostituire), array_values($daSostituire), $page);
