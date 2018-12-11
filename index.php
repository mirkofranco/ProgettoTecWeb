<?php
    require_once('./scripts/php/Sessione.php');
    require_once('./scripts/php/Utente.php');
    $daSostituire =  array(
        "Titolo" => "Login - Studio AR"
    );
    Sessione::startSession();
    if(isset($_SESSION['user'])){
        header("location: ./dashboard.php");
    }
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioA.html'));
    echo file_get_contents('./static/login.html');
    if(isset($_POST['login'])){
        $_SESSION['user'] = new Utente(1, "Utente Falso", "utentefalso", "password", "utente.falso@icloud.com", 1);
        header("location: ./dashboard.php");
    }
    echo file_get_contents('./static/fineA.html');
?>
