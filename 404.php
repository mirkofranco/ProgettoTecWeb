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
        "{{pageTitle}}" => "404: Page Not Found! - Studio AR",
        "{{pageDescription}}" => "pagina di errore 404",
        "{{pageKeywords}}" => " ",
        "{{gestioneLogin}}" => $gestioneLogin
    );
    $requestedUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio.html'));
    echo str_replace("{{requestedUrl}}", $requestedUrl, file_get_contents('./static/404.html'));
?>
