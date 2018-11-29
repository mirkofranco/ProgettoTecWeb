<?php
    $daSostituire = array(
        "Titolo" => "Home - Studio AR",
        "<a href=\"./index.php\">" => "<a href=\"./index.php\" class=\"active\">",
        "<a href=\"index.php\"><img src=\"./images/logopngB.png\" id=\"logo\" alt=\"Studio Architetti Riuniti\"/></a>" => "<img src=\"./images/logopngB.png\" class=\"active\" id=\"logo\" alt=\"Studio Architetti Riuniti\"/>",
        /*"<li xml:lang=\"en\"><a href=\"./index.php\">Home</a></li>" => "<li xml:lang=\"en\">Home</li>"*/
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioU.html'));
    echo file_get_contents('./static/index.html');
    echo file_get_contents('static/fineU.html');
?>
