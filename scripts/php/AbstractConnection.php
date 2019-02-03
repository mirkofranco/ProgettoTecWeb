<?php
  /* si usa la classe astratta in modo da implementare a necessità una connessione che si interfaccia al database in modi diversi */
    abstract class AbstractConnection{
        protected $hostname;
        protected $databaseName;
        protected $username;
        protected $password;
        protected $pdo;

        public function __construct($hostname, $databaseName, $username, $password){
            $this -> hostname = $hostname;
            $this -> databaseName = $databaseName;
            $this -> username = $username;
            $this -> password = $password;
            $this -> pdo = null;
        }

        public abstract function connect();

        public abstract function close();

        public abstract function insertProdotto($prodotto);

        public abstract function selectAllProdotti();

        public abstract function searchUtenteForLogin($username, $password);

        public abstract function listaSottoCategorie();

        public abstract function listaCategorie();

        public abstract function categoriesMap();

        public abstract function getProduct($id);

        public abstract function productsMap($categoria);

        public abstract function insertUtente($utente);

        public abstract function deleteProdotto($id);

        public abstract function inserisciCommento($idUtente, $idProdotto, $commento);

        public abstract function getCommentsAndUsernames($productId);


    }
?>
