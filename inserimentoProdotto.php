<?php
    $daSostituire = array(
            "Titolo" => "Inserimento Prodotti - Studio AR"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioA.html'));
    echo file_get_contents('./static/formInserimentoProdotti.html');
    echo file_get_contents('./static/fineA.html');
?>
