<?php
require_once('AbstractConnection.php');
require_once('Utente.php');

class MySqlDatabaseConnection extends AbstractConnection{

    /**
     * Inizializza la connessione con:
     *   1. Il nome del server
     *   2. Il nome del database
     *   3. Le credenziali per l'accesso al database 
     */
    public function __construct($hostname, $databaseName, $username, $password){
        parent::__construct($hostname, $databaseName, $username, $password); //parent chiama il costruttore della classe base
    }//__construct


    /** Crea la connessione */
    public function connect(){
        try{
            $this -> pdo = new PDO(('mysql:dbname=' . $this -> databaseName . ';host=' . $this -> hostname . ';charset=utf8'), $this -> username, $this -> password);
            $this -> pdo -> setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        }catch(PDOException $e){
            echo "<script>alert(\"Si è verificato un errore nella connessione al database\");</script>";
            exit;
        }//trycatch
    }//connect*/

    /** Inserisce un prodotto nel database */
    public function insertProdotto($prodotto){ //insert vista dal punto di vista del database, non del prodotto: per questo è qui e non in una eventuale classe prodotto
        $toInsert = "INSERT INTO PRODOTTO(sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = $this -> pdo -> prepare($toInsert);
        $okai = $stmt -> execute([$prodotto -> getCategoria(), $prodotto -> getNome(), $prodotto -> getMarca(), $prodotto -> getPrezzo(), $prodotto -> getDataInizioPrezzo(), $prodotto -> getOfferta(), $prodotto -> getNomeImmagine(), $prodotto -> getNomeImmaginePiccola(),  $prodotto->getDescrizione()]);

        return $okai;
    }

    /** modifica un prodotto esistente; */
    public function updateProduct($product) {
        $newValues = array(
            ':newSubcat' => $product->getCategoria(),
            ':newName' => $product->getNome(),
            ':brand' => $product->getMarca(),
            ':newPrice' => $product->getPrezzo(),
            ':newDate' => $product->getDataInizioPrezzo(),
            ':newIsDiscounted' => $product->getOfferta(),
            ':newDescription' => $product->getDescrizione(),
            ':id' => $product->getID()
        );

        $query = "UPDATE `PRODOTTO` SET `sottoCategoria` = :newSubcat, `Nome` = :newName, `Marca` = :brand, `Prezzo` = :newPrice, `DataInizio` = :newDate, `isOfferta` = :newIsDiscounted, `Descrizione` = :newDescription WHERE `PRODOTTO`.`IDProdotto` = :id";

        $statement = $this->pdo->prepare($query);

        $imageResult = true;

        if (!$product->getNomeImmagine()=='' && !$product->getNomeImmaginePiccola()=='') {
            $newImages = array(
                ':newImageName' => $product->getNomeImmagine(),
                ':newImageThumbnailName' => $product->getNomeImmaginePiccola(),
                ':id' => $product->getID()
            );

            $imageQuery = "UPDATE `PRODOTTO` SET `NomeImmagine` = :newImageName, `NomeThumbnail` = :newImageThumbnailName,WHERE `PRODOTTO`.`IDProdotto` = :id";

            $imageStatement = $this->pdo->prepare($imageQuery);

            $imageResult = $imageStatement->execute($newImages);
        }

        return $statement->execute($newValues) && $imageResult;
    }

    // PRE: l'oggetto di invocazione è la connessione al database
    /** Ritorna un array con i prodotti estratti dal database */
    public function selectAllProdotti(){
        $prodotti = $this -> pdo -> query("SELECT * FROM PRODOTTO") -> fetchAll();
        $toReturn = array();
        foreach($prodotti as $row){
            array_push($toReturn, new Prodotto($row['sottoCategoria'], $row['Nome'], $row['Marca'], $row['Prezzo'], $row['DataInizio'], $row['isOfferta'], $row ['Descrizione'], $row['IDProdotto']));
        }
        return $toReturn;
    }
    // POST: ritorna un array con tutti i prodotti inseriti nel db, e con tutti i relativi campi dati messi in un array associativo

    /** ritorna l'oggetto utente che ha password e username dati, o null se non esiste */
    public function searchUtenteForLogin($username, $password){
        $query = "SELECT * FROM UTENTE WHERE Username = ? AND Password = ? ;";
        $stmt = $this -> pdo -> prepare($query);
        $stmt -> execute(array($username, $password));
        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        return count($result) == 1 ? new Utente($result[0]['Nome'], $result[0]['Cognome'], $result[0]['Username'], $result[0]['Password'], $result[0]['Mail'], $result[0]['Permessi'], $result[0]['UID']) : null;
    }

    public function checkExistingUsernameAndEmail($username, $email) {
        $query = "SELECT COUNT(*) AS `existing` FROM UTENTE WHERE Username = ? UNION ALL SELECT COUNT(*) AS `existing` FROM UTENTE WHERE Mail = ? ";

        $statement = $this->pdo->prepare($query);
        $statement->execute(array($username, $email));

        $result = $statement->fetchAll(PDO::FETCH_COLUMN);

        return $result;
    }

    /** ritorna solo le sottocategorie */
    public function listaSottoCategorie(){
        $query = "SELECT IDC, Nome FROM CATEGORIA WHERE IDCatPadre IS NOT NULL;";
        $result = $this -> pdo -> query($query) -> fetchAll();
        $toReturn =  array();
        foreach($result as $row){
            array_push($toReturn, ["CodiceCategoria" => $row['IDC'], "NomeCategoria" => $row['Nome']]);
        }
        return $toReturn;
    }

    /** ritorna solo le categorie */
    public function listaCategorie(){
        $query = "SELECT IDC, Nome FROM CATEGORIA WHERE IDCatPadre IS NULL;";
        $result = $this -> pdo -> query($query) -> fetchAll();
        $toReturn = array();
        foreach ($result as $row) {
            array_push($toReturn, ["CodiceCategoria" => $row['IDC'], "NomeCategoria" => $row['Nome']]);
        }
        return $toReturn;
    }

    /** ritorna una mappa di tutte le categorie, indicizzate sull'id */
    public function categoriesMap() {
        $query = "SELECT * FROM CATEGORIA ORDER BY IDCatPadre, IDC;";
        // FETCH_GROUP indicizza il risultato della query rispetto alla prima colonna;
        // FETCH_UNIQUE semplifica la struttura dell'array ritornato (si può usare perché la prima colonna in questa query ha valori unici)
        $result = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC|\PDO::FETCH_GROUP|\PDO::FETCH_UNIQUE);

        return $result;
    }

    public function insertSubCategory($name, $ParentId) {
        $query = "INSERT INTO CATEGORIA (Nome, IDCatPadre) VALUES (?, ?)";

        $statement = $this->pdo->prepare($query);

        return $statement->execute(array($name, $ParentId));
    }

    /** dato un id, seleziona dal database il prodotto corrispondente e il nome della sua sottocategoria */
    public function getProduct($id) {
        $query = "SELECT cp.Nome AS nomeCategoriaPadre, sc.Nome AS nomeSottoCategoria, p.sottoCategoria AS idSottoCategoria, p.Nome, p.Marca, p.Prezzo, p.DataInizio, p.isOfferta, p.NomeImmagine, p.NomeThumbnail, p.Descrizione, p.IDProdotto FROM PRODOTTO p JOIN CATEGORIA sc ON p.sottoCategoria = sc.IDC JOIN CATEGORIA cp ON sc.IDCatPadre = cp.IDC WHERE p.IDProdotto = ?";

        $statement = $this->pdo->prepare($query);
        $statement->execute(array($id));

        return $statement->fetch(\PDO::FETCH_NUM);
    }

    /** ritorna gli url delle immagini  */
    public function getProductImages($id) {
        $query = "SELECT p.NomeImmagine, p.NomeThumbnail FROM PRODOTTO p WHERE p.IDProdotto = ?";

        $statement = $this->pdo->prepare($query);
        $statement->execute(array($id));

        return $statement->fetch(\PDO::FETCH_NUM);
    }

    /** ritorna una mappa di tutti i prodotti di una categoria, indicizzati per la loro sottocategoria */
    public function productsMap($categoria) {
        $query = "SELECT subcat.Nome AS sottocat, p.sottoCategoria, p.Nome, p.Marca, p.Prezzo, p.DataInizio, p.isOfferta, p.NomeImmagine, p.NomeThumbnail, p.Descrizione, p.IDProdotto FROM PRODOTTO p JOIN CATEGORIA subcat ON p.sottoCategoria = subcat.IDC JOIN CATEGORIA catpadre ON subcat.IDCatPadre = catpadre.IDC WHERE catpadre.Nome = ? ORDER BY subcat.IDC, p.IDProdotto";

        $statement = $this->pdo->prepare($query);
        $statement->execute(array($categoria));

        return $statement->fetchAll(\PDO::FETCH_NUM|\PDO::FETCH_GROUP);
    }

    /** inserisce un utente nel database */
    public function insertUtente($utente){
        $toInsert = "INSERT INTO UTENTE(Nome, Cognome, Username, Password, Mail, Permessi) VALUES(?, ?, ?, ?, ?, ?);";
        $stmt = $this -> pdo -> prepare($toInsert);
        $result = $stmt -> execute([$utente-> getNome(), $utente -> getCognome(), $utente -> getUsername(), $utente -> getPassword(), $utente -> getMail(), $utente -> getPermessi()]);
        return $result;
    }

    /** elimina un prodotto dal database */
    public function deleteProdotto($id){
        $toDelete = "DELETE FROM PRODOTTO WHERE IDProdotto = ?";
        $stmt = $this -> pdo -> prepare($toDelete);

        // ritorno lo stato per controllare se ci sono stati errori
        return $stmt->execute(array($id));
    }

    /** inserisce un commento nel database */
    public function inserisciCommento($idUtente, $idProdotto, $commento){
        $toInsert = "INSERT INTO COMMENTI(UID, IDProdotto, Commento) VALUES(?, ?, ?)";
        $stmt = $this -> pdo -> prepare($toInsert);
        
        // ritorno lo stato per controllare se ci sono stati errori
        return $stmt->execute([$idUtente, $idProdotto, $commento]);
    }

    /** ritorna tutti i commenti e i loro autori per un prodotto */
    public function getCommentsAndUsernames($productId) {
        $query = "SELECT u.Nome as name, u.Cognome as surname, u.Username AS username, c.Commento as commentBody FROM COMMENTI c, UTENTE u WHERE c.UID = u.UID AND c.IDProdotto = ? ORDER BY c.IDCommento";

        $statement = $this->pdo->prepare($query);
        $statement->execute(array($productId));

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Chiude la connessione */
    public function close(){
        $pdo = null;
    }//close

}//DatabaseConnection
?>
