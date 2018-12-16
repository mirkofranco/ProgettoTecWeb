<?php
    $daSostituire = array(
        "{{pageTitle}}" => "Zona giorno - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO",
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizio_user.html'));
    echo file_get_contents('./static/menu_catalogo.html');
    echo file_get_contents('./static/zona_giorno.html');
    echo file_get_contents('./static/fine_user.html');
?>
