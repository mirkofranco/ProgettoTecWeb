<?php
    $daSostituire = array(
        "{{pageTitle}}" => "Home - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO",
        "<a href=\"./index.php\" lang=\"en\">" => "<a href=\"./index.php\" class=\"navbar-active\">",
        "<a href=\"./index.php\"><img src=\"./images/logopngB.png\" id=\"logo\" alt=\"Studio Architetti Riuniti\"/></a>" => "<img src=\"./images/logopngB.png\" class=\"navbar-active\" id=\"logo\" alt=\"Studio Architetti Riuniti\"/>"
    );

    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html'));
    echo file_get_contents('./static/index.html');
    echo file_get_contents('./static/_fine.html');
?>
