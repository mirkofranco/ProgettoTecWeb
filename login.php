<?php
require_once './scripts/php/Sessione.php';
require_once './scripts/php/Utente.php';
Sessione::startSession();

$errorLogin = "";
if (isset($_POST['login'])) {
    $utente = Utente::login($_POST['username'], md5($_POST['Password']));
    if ($utente == null) {
        $errorLogin = "Nome utente e\o password non corretti";
    } else {
        $_SESSION['user'] = $utente;
        header("Location: ". $_SESSION['previousPage']);
    }
} else {
    $_SESSION['previousPage'] = $_SERVER['HTTP_REFERER'];
}

$gestioneLogin = "<a href=\"registrazione.php\" class=\"header-button\" >Registrati</a>";
$previousUN = isset($_POST['username']) ? "value=\"" . $_POST['username'] . "\"" : "";

$daSostituire = array(
    "{{pageTitle}}" => "Login - Studio AR",
    "{{pageDescription}}" => "Pagina con il menù per gli amministratori del sito dello studio AR - architetti riuniti",
    "{{errorForm}}" => $errorLogin,
    "{{previousUN}}" => $previousUN,
    "{{gestioneLogin}}" => $gestioneLogin,
);
echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio.html'));
echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/login.html'));
echo file_get_contents('./static/_fine.html');
?>