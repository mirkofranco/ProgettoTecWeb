<?php
    $daSostituire =  array(
        "Titolo" => "Login - Studio AR"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioA.html'));
    echo file_get_contents('./static/login.html');
    echo file_get_contents('./static/fineA.html');
?>
