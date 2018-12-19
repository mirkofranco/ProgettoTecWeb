<?php
    require_once('./scripts/php/Sessione.php');
    require_once('./scripts/php/Utente.php');
    $errorLogin = "";
    if(isset($_POST['login'])){
        $utente = Utente::login($_POST['username'], $_POST['Password']);
        if($utente ==  null){
            $errorLogin = "Nome utente e\o password non corretti";
        }else{
            $_SESSION['user'] = $utente;
            header("location: ./dashboard.php");
        }
    }
    $previousUS = isset($_POST['username']) ? "value=\"". $_POST['username']. "\"" : "";
    $daSostituire =  array(
        "{{pageTitle}}" => "Login - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO",
        "{{errorForm}}" => $errorLogin,
        "{{previousUN}}" => $previousUS
    );
    Sessione::startSession();
    if(isset($_SESSION['user'])){
        header("location: ./dashboard.php");
    }
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_admin.html'));
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/login.html'));
    /*if(isset($_POST['login'])){
        $utente = Utente::login($_POST['username'], $_POST['Password']);
        if($utente ==  null){
            $errorLogin = "Nome utente e\o password non corretti";
        }else{
            $_SESSION['user'] = $utente;
            header("location: ./dashboard.php");
        }
    }*/
    echo file_get_contents('./static/_fine.html');
?>
