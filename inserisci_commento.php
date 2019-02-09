<?php
// TODO: controllare che l'utente sia autenticato;
require_once "./scripts/php/connection.php";
require_once "./scripts/php/Sessione.php";
Sessione::startSession();

$inputJSON = file_get_contents('php://input');
$body = json_decode($inputJSON, true);

$productId = $body["productId"];
$userId = $_SESSION['user']->getIdentifier();
// sanitizzazione commento per prevenire HTML injection
$comment = str_replace(array("<script>", "</script>"), "" , $body["comment"]);

$connection = new MySqlDatabaseConnection("localhost", "mifranco", "mifranco", "Aideebe4esooDuqu");
$connection->connect();
$result = $connection->inserisciCommento($userId, $productId, $comment);
$connection->close();

if (!$result) {
    echo 0;
} else {
    echo 1;
}
