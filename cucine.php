<?php
    $daSostituire = array(
        "Titolo" => "Cucine - Studio AR",
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioU.html'));
    echo file_get_contents('./static/menuCatalogo.html');
    echo file_get_contents('./static/cucine.html');
    echo file_get_contents('./static/fineU.html');
?>
