<?php
    $daSostituire = array(
        "{{pageTitle}}" => "Catalogo - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO",
        "<a href=\"./catalogo.php\">" => "<a href=\"./catalogo.php\" class=\"current-page\">"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html'));
    echo file_get_contents('./static/catalogo.html');
    echo file_get_contents('./static/_fine.html');
?>
