<?php
require_once './scripts/php/Sessione.php';
Sessione::startSession();
Sessione::reservedPage();

$gestioneLogin = "<a href=\"menu_admin.php\" class=\"header-button\">Area riservata</a>";
$gestioneLogin .= "<a href=\"logout.php\" class=\"header-button\">Logout</a>";

require_once './scripts/php/connection.php';
require_once './scripts/php/Prodotto.php';
$connection = new MySqlDatabaseConnection("localhost", "mifranco", "mifranco", "Aideebe4esooDuqu");
$connection->connect();
$listaCategoriePadre = $connection->listaCategorie();

$elencoCategoriePadre = "<select id=\"nomeCategoriaPadre\" name=\"codiceCategoriaPadre\" required=\"required\">";

$previousCategoriaPadre = "";
if (isset($_POST['codiceCategoriaPadre'])) {
    $previousCategoriaPadre = $_POST['codiceCategoriaPadre'];
} else {
    $elencoCategoriePadre .= "<option disabled=\"disabled\" selected=\"selected\" value=\"\">-- seleziona un opzione dalla lista --</option>";
}

foreach ($listaCategoriePadre as $categoriaPadre) {
    $elencoCategoriePadre .= "<option value=\"" . $categoriaPadre['CodiceCategoria'] . "\"";
    if ($previousCategoriaPadre == $categoriaPadre['CodiceCategoria']) {
        $elencoCategoriePadre .= " selected=\"selected\"";
    }
    $elencoCategoriePadre .= ">" . $categoriaPadre['NomeCategoria'] . "</option>";
}

$elencoCategoriePadre .= "</select>";

$previousNomeSottoCategoria = "";
$errorForm = "";
$successForm = "";

if (isset($_POST['inserisciSottoCategoria'])) {
    if (strlen($_POST['nomeSottoCategoria']) < 2) {
        $errorForm .= "Il nome della sottocategoria deve contenere almeno 2 caratteri<br/>";
    }

    if ($errorForm == "") {

        if ($connection->insertSubCategory($_POST['nomeSottoCategoria'], $_POST['codiceCategoriaPadre'])) {
            $successForm = "Sottocategoria inserita correttamente nel database";
        } else {
            $errorForm .= "Si è verificato un problema con il database; contatta il tuo sysadmin di fiducia!";
        }
    } else {
        $previousNomeSottoCategoria = "value=\"" . $_POST['nomeSottoCategoria'] . "\"";
    }
}
$connection->close();

$daSostituire = array(
    "{{pageTitle}}" => "Inserimento Sottocategorie - Studio AR",
    "{{pageDescription}}" => "Pagina per l'inserimento di nuove sottocategoria del sito dello studio AR - architetti riuniti",
    "{{gestioneLogin}}" => $gestioneLogin,
    "{{elencoCategoriePadre}}" => $elencoCategoriePadre,
    "{{previousNomeSottoCategoria}}" => $previousNomeSottoCategoria,
    "{{errorForm}}" => $errorForm,
    "{{successForm}}" => $successForm,
);
echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio.html'));
echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inserimento_sottocategoria.html'));
echo file_get_contents('./static/_fine.html');
?>
