<?php

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
        "{{pageTitle}}" => "Catalogo - Studio AR",
        "{{pageDescription}}"=>"Pagina del catalogo del sito dello studio AR - architetti riuniti",
        "{{pageKeywords}}"=>"architetti,design,interni,arredamento,stile di vita",
        "<a href=\"./catalogo.php\">" => "<a href=\"./catalogo.php\" class=\"current-page\">",
        "{{gestioneLogin}}" => $gestioneLogin
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html'));
    echo file_get_contents('./static/catalogo.html');
    echo file_get_contents('./static/_fine.html');
?>
