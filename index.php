<?php
    require_once('./scripts/php/Sessione.php');
    Sessione::startSession();
    $gestioneLogin = "";
    if(!isset($_SESSION['user'])){
        $gestioneLogin = "<a href=\"index_admin.php\" class=\"header-button\" >Login</a><a href=\"registrazione.php\" class=\"header-button\" >Registrati</a>";
    }else{
        $gestioneLogin = "<a href=\"logout.php\" class=\"header-button\">Logout</a>";
    }
    $daSostituire = array(
        "{{pageTitle}}" => "Home - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO",
        "<a href=\"./index.php\" lang=\"en\">" => "<a href=\"./index.php\" class=\"current-page\" lang=\"en\">",
        "<a href=\"./index.php\"><img src=\"./images/logopngB.png\" id=\"logo\" alt=\"Studio Architetti Riuniti\"/></a>" => "<img src=\"./images/logopngB.png\" class=\"current-page\" id=\"logo\" alt=\"Studio Architetti Riuniti\"/>",
        "{{gestioneLogin}}" => $gestioneLogin
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html'));
    echo file_get_contents('./static/index.html');
    echo file_get_contents('./static/_fine.html');
?>
