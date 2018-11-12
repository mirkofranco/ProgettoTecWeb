<?php
    require_once('connection.php');
    $connection = new DatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
    $connection -> connect();
    $marca = "Apple";
    $result = $connection -> query("SELECT * from PRODOTTO WHERE Marca='".$marca."';'");
    $resultOkai = $connection -> f($result);
    print_r($resultOkai);
    $connection -> close();
?>
