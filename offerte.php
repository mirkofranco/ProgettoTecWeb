<?php
    $daSostituire = array(
        "{{pageTitle}}" => "Offerte - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO",
        "<a href=\"./offerte.php\">" => "<a href=\"./offerte.php\" class=\"active\">"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioU.html'));
    echo file_get_contents('./static/offerte.html');
    echo file_get_contents('static/fineU.html');
?>
