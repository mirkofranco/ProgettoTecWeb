<?php
require_once './scripts/php/connection.php';
$connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
$connection->connect();
$result = $connection->deleteProdotto($_GET['id']);
$connection->close();

if ($result) {
    header('Location: ./catalogo_amministratori.php');
} else {
    echo "Qualcosa è andato storto. Contatta il tuo sysadmin di fiducia, oppure <a href=\"./index.php\">torna alla home</a>";
}


// TODO: messaggio conferma....