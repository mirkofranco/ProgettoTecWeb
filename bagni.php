<?php
	require_once('./scripts/php/Utente.php');
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
        "{{pageTitle}}" => "Cucine - Studio AR",
        "{{pageDescription}}"=>"Pagina del catalogo dedicata ai bagni venduti dallo studio AR - architetti riuniti",
        "<a href=\"./catalogo.php\">" => "<a href=\"./catalogo.php\" class=\"current-page\">",
        "{{gestioneLogin}}" => $gestioneLogin
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio.html'));
    echo file_get_contents('./static/sidebar_catalogo.html');
    echo file_get_contents('./static/bagni.html');
    echo file_get_contents('./static/_fine.html');
?>
