<?php
require_once './scripts/php/Sessione.php';
Sessione::startSession();
Sessione::reservedPage();

$gestioneLogin = "<a href=\"login.php\" class=\"header-button\">Area riservata</a>";
$gestioneLogin .= "<a href=\"logout.php\" class=\"header-button\">Logout</a>";

$daSostituire = array(
    "{{pageTitle}}" => "Catalogo Amministratori - Studio AR",
    "{{pageDescription}}" => "Pagina per il catalogo degli amministratori del sito dello studio AR - architetti riuniti",
    "{{gestioneLogin}}" => $gestioneLogin,
);

echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio.html'));
echo file_get_contents('./static/catalogo_amministratori.html');
echo file_get_contents('./static/_fine.html');
?>
