<?php
    require_once('./scripts/php/connection.php');
    $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
    $connection -> connect();
    $connection -> deleteProdotto($_GET['id']);
    $connection -> close();
    header("location: ./catalogo_amministratori.php");
?>
