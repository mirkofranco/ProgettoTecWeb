<?php
require_once('./AbstractConnection.php');
class MySqlDatabaseConnection extends AbstractConnection{


    /* Inzializza la connessione con:
        1. Il nome del server
        2. Il nome del database
        3. Le credenziali per l'accesso al database
    */
    public function __construct($hostname, $databaseName, $username, $password){
        parent::__construct($hostname, $databaseName, $username, $password);
    }//__construct


    /* Crea la connessione */
    public function connect(){
        try{
            $this -> pdo = new PDO(('mysql:dbname=' . $this -> databaseName . ';host=' . $this -> hostname . ';charset=utf8'), $this -> username, $this -> password);
            $this -> pdo -> setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        }catch(PDOException $e){
            echo "Si è verificato un errore";
        }//trycatch
    }//connect*/

    /* Inserisce un prodotto nel database */
    public function insertProdotto($prodotto){
        $toInsert = "INSERT INTO PRODOTTO(IDProdotto, Categoria, Nome, Marca, Prezzo, DataInizio, isOfferta) VALUES (?, ?, ?, ?, ?, ?, ?);";
        //$this -> connect();
        $stmt = $this -> pdo -> prepare($toInsert);
        $okai = $stmt -> execute([$prodotto -> getID(), $prodotto -> getCategoria(), $prodotto -> getNome(), $prodotto -> getMarca(), $prodotto -> getPrezzo(), $prodotto -> getDataInizioPrezzo(), $prodotto -> getOfferta()]);
        //$this -> close();
        return $okai;
    }

    /* Ritorna un array con i prodotti estratti dal database */
    public function selectAllProdotti(){
        $prodotti = $this -> pdo -> query("SELECT * FROM PRODOTTO") -> fetchAll();
        $toReturn = array();
        foreach($prodotti as $row){
            array_push($toReturn, new Prodotto($row['IDProdotto'], $row['Categoria'], $row['Nome'], $row['Marca'], $row['Prezzo'], $row['DataInizio'], $row['isOfferta']));
        }
        return $toReturn;
    }


    /* Chiude la conenssione */
    public function close(){
        $pdo = null;
    }//close

}//DatabaseConnection
?>
