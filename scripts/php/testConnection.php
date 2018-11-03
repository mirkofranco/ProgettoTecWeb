<?php
    require_once('connection.php');
    $connection = new DatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
    $connection -> connect();
    $connection -> close();
?>
