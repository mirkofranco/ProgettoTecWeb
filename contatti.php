<?php
    $daSostituire = array(
        "{{pageTitle}}" => "Contatti - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO",
        "<a href=\"./contatti.php\">" => "<a href=\"./contatti.php\" class=\"active\">"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizio_user.html'));
    echo file_get_contents('./static/contatti.html');
    echo file_get_contents('static/fine_user.html');
?>
