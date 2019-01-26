<?php
/*
    Esame di stato 2016
    Mirko Franco Cl. 5IC
    cerca.php
*/
/**Imposto il tipo di documento come XML**/
header("Content-type: text/xml");
/**Disabilito la cache**/
header("Cache-control: no-cache, must-revalidate");
/**Imposto la data di scadenza con un giorno sicuramente già trascorso**/
header("Expires: Mon, 26 Jul 1997, 05:00:00 GMT");
require_once("./scripts/php/connection.php");
require_once("./scripts/php/Sessione.php");
Sessione::startSession();
$connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
$connection -> connect();
$xml = "<?xml version='1.0' encoding=\"" . "UTF-8\"" . "?>";
$prova = $_SESSION['user'] == null ? "ciao" : null ;
$xml .= "<utente>" . $_GET['id'] . $_GET["commento"] . $prova . "</utente>";
//$xml .= "<okai>" , $connection -> inserisciCommento($_GET['id'], $_SESSION['user'] -> getIdentifier(), $_GET['commento']) . "</okai>";
echo $xml;
?>
