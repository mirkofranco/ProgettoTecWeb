<?php
	require_once('./scripts/php/Sessione.php');
	require_once('./scripts/php/Utente.php');
	Sessione::startSession();
	if(isset($_SESSION['user'])){
		if($_SESSION['user'] -> getPermessi() == '01'){
			header("location: index.php");
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

    $daSostituire = array(
        "{{pageTitle}}" => "Menu Admin - Studio AR",
        "{{pageDescription}}"=>"Pagina del menù degli amministratori del sito dello studio AR - architetti riuniti",
        "{{gestioneLogin}}" => $gestioneLogin
    );

    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio.html'));
    echo file_get_contents('./static/menu_admin.html');
    echo file_get_contents('./static/_fine.html');
?>
