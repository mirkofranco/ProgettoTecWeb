<?php
    $daSostituire = array(
        "{{pageTitle}}" => "Contatti - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO",
        "<a href=\"./contatti.php\">" => "<a href=\"./contatti.php\" class=\"current-page\">"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html'));
    echo file_get_contents('./static/contatti.html');
    echo file_get_contents('./static/_fine.html');
?>
