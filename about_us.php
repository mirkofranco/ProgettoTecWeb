<?php
    $daSostituire = array(
        "Titolo" => "About Us - Studio AR",
        "<a href=\"./about_us.php\">" => "<a href=\"./about_us.php\" class=\"active\">"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioU.html'));
    echo file_get_contents('./static/about_us.html');
    echo file_get_contents('static/fineU.html');
?>
