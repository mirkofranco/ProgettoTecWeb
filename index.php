<?php
    $daSostituire = array(
        "Titolo" => "Home - Studio AR",
        "<a href=\"./index.php\">" => "",
        "<a href=\"index.php\"><img src=\"./images/logopngB.png\" id=\"logo\" alt=\"Studio Architetti Riuniti\"/></a>" => "<img src=\"./images/logopngB.png\" id=\"logo\" alt=\"Studio Architetti Riuniti\"/>"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioU.html'));
    echo file_get_contents('./static/index.html');
    echo file_get_contents('static/fineU.html');
?>
