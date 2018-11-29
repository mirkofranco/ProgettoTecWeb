<?php
    $daSostituire = array(
        "Titolo" => "Catalogo - Studio AR",
        "<a href=\"./catalogo.php\">" => "<a href=\"./catalogo.php\" class=\"active\">"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioU.html'));
    echo file_get_contents('./static/catalogo.html');
    echo file_get_contents('static/fineU.html');
?>
