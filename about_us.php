<?php
	require_once('./scripts/php/Utente.php');
	require_once('./scripts/php/Sessione.php');
    Sessione::startSession();
    $gestioneLogin = "";
    if(!isset($_SESSION['user'])){
        $gestioneLogin = "<a href=\"login.php\" class=\"header-button\" >Login</a><a href=\"registrazione.php\" class=\"header-button\" >Registrati</a>";
    }else{
		if($_SESSION['user'] -> getPermessi() == '11'){
            $gestioneLogin .= "<a href=\"menu_admin.php\" class=\"header-button\">Area riservata</a>";
        }
        $gestioneLogin .= "<a href=\"logout.php\" class=\"header-button\">Logout</a>";
    }
    $daSostituire = array(
        "{{pageTitle}}" => "About Us - Studio AR",
        "{{pageDescription}}"=>"Pagina about us del sito dello studio AR - architetti riuniti",
        "<li class=\"flex-element\"><a href=\"./about_us.php\"><span lang=\"en\" class=\"navbar-element\">About Us</span></a></li>" => "<li class=\"flex-element current-page\"><span lang=\"en\" class=\"navbar-element\">About Us</span></li>" ,
        "{{gestioneLogin}}" => $gestioneLogin
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio.html'));
    echo file_get_contents('./static/about_us.html');
    echo file_get_contents('./static/_fine.html');
?>
