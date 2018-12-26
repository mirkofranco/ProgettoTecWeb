<?php
    $daSostituire = array(
        "{{pageTitle}}" => "404: Page Not Found! - Studio AR",
        "{{pageDescription}}"=>"TODO",
        "{{pageKeywords}}"=>"TODO",
        "<a href=\"./index.php\" lang=\"en\">" => "<a href=\"./index.php\" class=\"current-page\" lang=\"en\">",
        "<a href=\"./index.php\"><img src=\"./images/logopngB.png\" id=\"logo\" alt=\"Studio Architetti Riuniti\"/></a>" => "<img src=\"./images/logopngB.png\" class=\"current-page\" id=\"logo\" alt=\"Studio Architetti Riuniti\"/>"
    );

    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html'));
    echo file_get_contents('./static/not-found.html');
    echo file_get_contents('./static/_fine.html');
?>
