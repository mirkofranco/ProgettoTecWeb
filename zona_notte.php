<?php
    echo "NOT WORKING";
    die();
    
    $thisFile = ".".$_SERVER["PHP_SELF"];

    $daSostituire = array(
        "{{pageTitle}}" => "Zona notte - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO",
        "{{linkPaginaCategoria}}" => $thisFile
    );

    $page = file_get_contents('./static/_inizio_user.html').
            file_get_contents('./static/menu_catalogo.html').
            file_get_contents('./static/zona_notte.html').
            file_get_contents('./static/_fine.html');

    $document = new DOMDocument();
    $document->loadHTML($page);
            
    echo $document->saveHTML;

    // $page = str_replace(array_keys($daSostituire), array_values($daSostituire), $page);
    // echo $page;


    // echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html'));
    // echo file_get_contents('./static/menu_catalogo.html');
    // echo file_get_contents('./static/zona_notte.html');
    // echo file_get_contents('./static/_fine.html');
?>
