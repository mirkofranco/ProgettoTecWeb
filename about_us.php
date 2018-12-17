<?php
    $daSostituire = array(
        "{{pageTitle}}" => "About Us - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO",
        "<a href=\"./about_us.php\" lang=\"en\">" => "<a href=\"./about_us.php\" class=\"navbar-active\">"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html'));
    echo file_get_contents('./static/about_us.html');
    echo file_get_contents('./static/_fine.html');
?>
