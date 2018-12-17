<?php
    $daSostituire = array(
        "{{pageTitle}}" => "Offerte - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO",
        "<a href=\"./offerte.php\">" => "<a href=\"./offerte.php\" class=\"navbar-active\">"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizio_user.html'));
    echo file_get_contents('./static/offerte.html');
    echo file_get_contents('static/_fine.html');
?>
