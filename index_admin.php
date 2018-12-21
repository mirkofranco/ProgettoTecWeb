<?php
    require_once('./scripts/php/Sessione.php');
    require_once('./scripts/php/Utente.php');
    Sessione::startSession();
    if(isset($_SESSION['user'])){
        if($_SESSION['user'] -> getPermessi() == '11'){
            header("location: ./menu_admin.php");
        }else if($_SESSION['user'] -> getPermessi() == '01'){
            header("location: ./index.php");
        }
    }
    $errorLogin = "";
    if(isset($_POST['login'])){
        $utente = Utente::login($_POST['username'], $_POST['Password']);
        if($utente ==  null){
            $errorLogin = "Nome utente e\o password non corretti";
        }else{
            $_SESSION['user'] = $utente;
            if($utente -> getPermessi() == '11'){
                header("location: ./menu_admin.php");
            }else {
                header("location: ./index.php");
            }
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
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_admin.html'));
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/login.html'));
    echo file_get_contents('./static/_fine.html');
?>
