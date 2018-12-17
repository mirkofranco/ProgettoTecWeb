<?php
    $daSostituire = array(
        "{{pageTitle}}" => "Cucine - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html'));
    echo file_get_contents('./static/menu_catalogo.html');
    echo file_get_contents('./static/_fine.html');
?>
