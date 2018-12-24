<?php
    $daSostituire = array(
        "{{pageTitle}}" => "Menu Admin - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO",
    );

    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html'));
    echo file_get_contents('./static/menu_admin.html');
    echo file_get_contents('./static/_fine.html');
?>
