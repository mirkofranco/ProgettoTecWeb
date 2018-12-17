<?php
    $daSostituire = array(
        "{{pageTitle}}" => "Offerte - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO",
        "<a href=\"./offerte.php\">" => "<a href=\"./offerte.php\" class=\"current-page\">"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html'));
    echo file_get_contents('./static/offerte.html');
    echo file_get_contents('./static/_fine.html');
?>
