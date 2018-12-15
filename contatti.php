<?php
    $daSostituire = array(
        "Titolo" => "Contatti - Studio AR",
        "<a href=\"./contatti.php\">" => "<a href=\"./contatti.php\" class=\"active\">"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioU.html'));
    echo file_get_contents('./static/contatti.html');
    echo file_get_contents('static/fineU.html');
?>
