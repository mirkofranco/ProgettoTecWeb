<?php
require_once './scripts/php/connection.php';
$connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
$connection->connect();
$result = $connection->deleteProdotto($_GET['id']);
$connection->close();

if ($result) {
    echo "il prodotto è stato eliminato correttamente; tra 5 secondi verrai reindirizzato all'area riservata amministratori";
    sleep(5);
    header("location: ./catalogo_amministratori.php");
} else {
    echo "Qualcosa è andato storto. Contatta il tuo sysadmin di fiducia, oppure <a href=\"./index.php>torna alla home</a>";
}
