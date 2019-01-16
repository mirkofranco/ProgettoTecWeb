<?php
require_once('AbstractConnection.php');
require_once('Utente.php');
class MySqlDatabaseConnection extends AbstractConnection{


    /* Inzializza la connessione con:
        1. Il nome del server
        2. Il nome del database
        3. Le credenziali per l'accesso al database
    */
    public function __construct($hostname, $databaseName, $username, $password){
        parent::__construct($hostname, $databaseName, $username, $password); //parent chiama il costruttore della classe base
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
    public function insertProdotto($prodotto){ //insert vista dal punto di vista del database, non del prodotto: per questo è qui e non in una eventuale classe prodotto
        $toInsert = "INSERT INTO PRODOTTO(sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        //$this -> connect();
        $stmt = $this -> pdo -> prepare($toInsert);
        $okai = $stmt -> execute([$prodotto -> getCategoria(), $prodotto -> getNome(), $prodotto -> getMarca(), $prodotto -> getPrezzo(), $prodotto -> getDataInizioPrezzo(), $prodotto -> getOfferta(), $prodotto -> getNomeImmagine(), $prodotto -> getNomeImmaginePiccola(),  $prodotto->getDescrizione()]);
        //$this -> close();
        return $okai;
    }

    // PRE: l'oggetto di invocazione è la connessione al database
    /* Ritorna un array con i prodotti estratti dal database */
    public function selectAllProdotti(){
        $prodotti = $this -> pdo -> query("SELECT * FROM PRODOTTO") -> fetchAll();
        $toReturn = array();
        foreach($prodotti as $row){
            array_push($toReturn, new Prodotto($row['sottoCategoria'], $row['Nome'], $row['Marca'], $row['Prezzo'], $row['DataInizio'], $row['isOfferta'], $row ['Descrizione'], $row['IDProdotto']));
        }
        return $toReturn;
    }
    // POST: ritorna un array con tutti i prodotti inseriti nel db, e con tutti i relativi campi dati messi in un array associativo

    public function searchUtenteForLogin($username, $password){
        $query = "SELECT * FROM UTENTE WHERE Username = \"$username\"  AND Password = \"$password\" ;";
        $stmt = $this -> pdo -> prepare($query);
        $stmt -> execute();
        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        return count($result) == 1 ? new Utente($result[0]['Nome'], $result[0]['Cognome'], $result[0]['Username'], $result[0]['Password'], $result[0]['Mail'], $result[0]['Permessi']) : null;
    }

    public function listaSottoCategorie(){
        $query = "SELECT IDC, Nome FROM categoria WHERE IDCatPadre IS NOT NULL;";
        $result = $this -> pdo -> query($query) -> fetchAll();
        $toReturn =  array();
        foreach($result as $row){
            array_push($toReturn, ["CodiceCategoria" => $row['IDC'], "NomeCategoria" => $row['Nome']]);
        }
        return $toReturn;
    }

    public function listaCategorie(){
        $query = "SELECT IDC, Nome FROM CATEGORIA WHERE IDCatPadre IS NULL;";
        $result = $this -> pdo -> query($query) -> fetchAll();
        $toReturn = array();
        foreach ($result as $row) {
            array_push($toReturn, ["CodiceCategoria" => $row['IDC'], "NomeCategoria" => $row['Nome']]);
        }
        return $toReturn;
    }

    /**
     * restituisce una mappa di tutte le categorie, indicizzate sull'id
     */
    public function mappaCategorie() {
        $query = "SELECT * FROM CATEGORIA ORDER BY IDCatPadre;";
        // FETCH_GROUP indicizza il risultato della query rispetto alla prima colonna;
        // FETCH_UNIQUE semplifica la struttura dell'array ritornato (si può usare perché la prima colonna in questa query ha valori unici)
        $result = $this -> pdo -> query($query) -> fetchAll(\PDO::FETCH_ASSOC|\PDO::FETCH_GROUP|\PDO::FETCH_UNIQUE);

        return $result;
    }

    /**
     * ritorna una mappa di tutti i prodotti di una categoria, indicizzati per la loro sottocategoria
     */
    public function mappaProdotti($categoria) {
        $query = "  SELECT
                        subcat.Nome AS sottocat,
                        p.sottoCategoria, p.Nome, p.Marca, p.Prezzo, p.DataInizio, p.isOfferta, p.NomeImmagine, p.NomeThumbnail, p.Descrizione, p.IDProdotto
                    FROM
                        PRODOTTO p
                    JOIN CATEGORIA subcat ON
                        p.sottoCategoria = subcat.IDC
                    LEFT JOIN CATEGORIA catpadre ON
                        subcat.IDCatPadre = catpadre.IDC
                    WHERE
                        catpadre.Nome = '$categoria' OR subcat.Nome = '$categoria' AND catpadre.IDCatPadre IS NULL
                    ORDER BY
                        subcat.IDC, p.IDProdotto";

        $result = $this -> pdo -> query($query) -> fetchAll(\PDO::FETCH_NUM|\PDO::FETCH_GROUP);

        return $result;
    }

    public function insertUtente($utente){
        $toInsert = "INSERT INTO UTENTE(Nome, Cognome, Username, Password, Mail, Permessi) VALUES(?, ?, ?, ?, ?, ?);";
        $stmt = $this -> pdo -> prepare($toInsert);
        $result = $stmt -> execute([$utente-> getNome(), $utente -> getCognome(), $utente -> getUsername(), $utente -> getPassword(), $utente -> getMail(), $utente -> getPermessi()]);
        return $result;
    }

    /* Chiude la connessione */
    public function close(){
        $pdo = null;
    }//close

}//DatabaseConnection
?>
