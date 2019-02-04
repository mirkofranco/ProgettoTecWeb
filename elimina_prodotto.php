<?php
require_once './scripts/php/Sessione.php';
Sessione::startSession();
Sessione::reservedPage();

require_once './scripts/php/connection.php';
$connection = new MySqlDatabaseConnection("localhost", "mifranco", "mifranco", "Aideebe4esooDuqu");
$connection->connect();
$result = $connection->deleteProdotto($_GET['id']);
$connection->close();

$previousPage = $_GET['previous'];

if ($result) {
    header("location: " . $previousPage);
} else {
    echo "Qualcosa è andato storto. Contatta il tuo sysadmin di fiducia, oppure <a href=\"./index.php\">torna alla home</a>";
}

// FIXME: eliminare anche l'immagine!
// FIXME: immagine letto_tais_colombini.jpg inutilizzata
