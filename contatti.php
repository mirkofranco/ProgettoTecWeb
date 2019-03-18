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
        "{{pageTitle}}" => "Contatti - Studio AR",
        "{{pageDescription}}"=>"Informazioni utili per contattare lo studio AR - architetti riuniti",
        "<li class=\"flex-element\"><a href=\"./contatti.php\"><span class=\"navbar-element\">Contatti</span></a></li>" => "<li class=\"flex-element current-page\"><span class=\"navbar-element\">Contatti</span></li>",
        "{{gestioneLogin}}" => $gestioneLogin
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio.html'));
    echo file_get_contents('./static/contatti.html');
    echo file_get_contents('./static/_fine.html');
?>
