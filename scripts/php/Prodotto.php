<?php
    class Prodotto{
        private $idProdotto;
        private $categoria;
        private $nome;
        private $marca;
        private $prezzo;
        private $dataInizioValiditaPrezzo;
        private $offerta;
        private $nomeImmagine;
        private $Descrizione;

        /* Costruisce un ogeetto Prodotto in modo completo */
        public function __construct($idProdotto, $categoria, $nome, $marca, $prezzo, $dataInizioValiditaPrezzo, $offerta, $nomeImmagine){
            $this -> idProdotto = $idProdotto;
            $this -> categoria = $categoria;
            $this -> nome = $nome;
            $this -> marca = $marca;
            $this -> prezzo = $prezzo;
            $this -> dataInizioValiditaPrezzo = $dataInizioValiditaPrezzo;
            $this -> offerta = $offerta;
            $this -> nomeImmagine = $nomeImmagine;
            $this -> Descrizione = $Descrizione;
        }

        /* Ritorna l'identificativo del prodotto */
        public function getID(){
            return $this -> idProdotto;
        }

        /* Ritorna la categoria del prodotto */
        public function getCategoria(){
            return $this -> categoria;
        }

        /* Ritorna il nome del prodotto */
        public function getNome(){
            return $this -> nome;
        }

        /* Ritorna la marca del prodotto */
        public function getMarca(){
            return $this -> marca;
        }

        /* Ritorna il prezzo del prodotto */
        public function getPrezzo(){
            return $this -> prezzo;
        }

        /* Ritorna la data da cui è valido il prezzo */
        public function getDataInizioPrezzo(){
            return $this -> dataInizioValiditaPrezzo;
        }

        /* Ritorna true se il prodotto è in offerta, false altrimenti */
        public function getOfferta(){
            return $this -> offerta;
        }

        public function getNomeImmagine(){
            return $this -> nomeImmagine;
        }

        public function getDescrizione() {
            return $this -> Descrizione;
        }
        /* Ritorna una rappresentazione a stringa di un $this */
        public function __toString(){
            return "Identificativo: " . $this -> getID() . " Categoria: " . $this -> getCategoria() . " Nome: " . $this -> getNome() . "Marca: " . $this -> getMarca() .
                    " Prezzo: " . $this -> getPrezzo() . " Data inizio validità prezzo: " . $this -> getDataInizioPrezzo() . " Offerta: " . $this -> getOfferta();
        }


    }
?>
