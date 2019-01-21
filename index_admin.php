<?php
// TODO: rinominare index admin a login?
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
        $utente = Utente::login($_POST['username'], md5($_POST['Password']));
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

    require_once('./scripts/php/Sessione.php');
    Sessione::startSession();
    $gestioneLogin = "";
    if(!isset($_SESSION['user'])){
        $gestioneLogin = "<a href=\"index_admin.php\" class=\"header-button\" >Login</a><a href=\"registrazione.php\" class=\"header-button\" >Registrati</a>";
    }else{
        if($_SESSION['user'] -> getPermessi() == '11'){
            $gestioneLogin .= "<a href=\"index_admin.php\" class=\"header-button\">Area riservata</a>";
        }
        $gestioneLogin .= "<a href=\"logout.php\" class=\"header-button\">Logout</a>";
    }

    $previousUS = isset($_POST['username']) ? "value=\"". $_POST['username']. "\"" : "";
    $daSostituire =  array(
        "{{pageTitle}}" => "Login - Studio AR",
        "{{pageDescription}}"=>"Pagina con il menù per gli amministratori del sito dello studio AR - architetti riuniti",
        "{{pageKeywords}}"=>"architetti,design,interni,arredamento,stile di vita",
        "{{errorForm}}" => $errorLogin,
        "{{previousUN}}" => $previousUS,
        "{{gestioneLogin}}" => $gestioneLogin
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio.html'));
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/login.html'));
    echo file_get_contents('./static/_fine.html');
?>
