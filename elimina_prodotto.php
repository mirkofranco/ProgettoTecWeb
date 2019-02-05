<?php
require_once './scripts/php/Sessione.php';
Sessione::startSession();
Sessione::reservedPage();

if (!(array_key_exists('id', $_REQUEST) && is_numeric($_REQUEST['id']))) {
    header("Location: ./404.php", 404);
    exit;
}

$id = $_GET['id'];

require_once './scripts/php/connection.php';
$connection = new MySqlDatabaseConnection("localhost", "mifranco", "mifranco", "Aideebe4esooDuqu");
$connection->connect();
$images = $connection->getProductImages($id);
$result = $connection->deleteProdotto($id);
$connection->close();

$deleteResult = true;

$trashFolder = "./old-images/";
if (!is_dir($trashFolder)) {
    mkdir($trashFolder);
    if (!is_dir("./thumbnails")) {
        mkdir("./thumbnails");
    }
}

foreach ($images as $value) {
    $deleteResult = $deleteResult && rename("./images/catalogo/". $value, $trashFolder. $value);
}

$previousPage = $_GET['previous'];

if ($result && $deleteResult) {
    header("location: " . $previousPage);
} else {
    echo "Qualcosa è andato storto. Contatta il tuo sysadmin di fiducia, oppure <a href=\"./index.php\">torna alla home</a>";
}

// FIXME: immagine letto_tais_colombini.jpg inutilizzata
