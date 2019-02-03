<?php
// TODO: controllare che l'utente sia autenticato;
require_once "./scripts/php/connection.php";
require_once "./scripts/php/Sessione.php";
Sessione::startSession();

$inputJSON = file_get_contents('php://input');
$body = json_decode($inputJSON, true);

$productId = $body["productId"];
$userId = $_SESSION['user']->getIdentifier();
$comment = $body["comment"];

$connection = new MySqlDatabaseConnection("localhost", "mifranco", "mifranci", "Aideebe4esooDuqu");
$connection->connect();
$result = $connection->inserisciCommento($userId, $productId, $comment);
$connection->close();

if (!$result) {
    echo 0;
    die();
}

echo 1;
