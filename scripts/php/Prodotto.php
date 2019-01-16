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
        private $nomeImmaginePiccola;
        private $descrizione;

        /* Costruisce un ogeetto Prodotto in modo completo */
        public function __construct($categoria, $nome, $marca, $prezzo, $dataInizioValiditaPrezzo, $offerta, $nomeImmagine, $nomeImmaginePiccola, $descrizione, $idProdotto = NULL){
            $this -> idProdotto = $idProdotto;
            $this -> categoria = $categoria;
            $this -> nome = $nome;
            $this -> marca = $marca;
            $this -> prezzo = $prezzo;
            $this -> dataInizioValiditaPrezzo = $dataInizioValiditaPrezzo;
            $this -> offerta = $offerta;
            $this -> nomeImmagine = $nomeImmagine;
            $this -> nomeImmaginePiccola = $nomeImmaginePiccola;
            $this -> descrizione = $descrizione;
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

        public function getNomeImmaginePiccola(){
            return $this -> nomeImmaginePiccola;
        }

        public function getDescrizione() {
            return $this -> descrizione;
        }

        /* Ritorna una rappresentazione a stringa di un $this */
        public function __toString(){
            return "Identificativo: " . $this -> getID() . " Categoria: " . $this -> getCategoria() . " Nome: " . $this -> getNome() . " Marca: " . $this -> getMarca() .
                    " Prezzo: " . $this -> getPrezzo() . " Data inizio validità prezzo: " . $this -> getDataInizioPrezzo() . " Offerta: " . $this -> getOfferta();
        }

        public function buildHtml() {
            $document = new DOMDocument('1.0', 'utf-8');

            $node = $document->createElement("div");
            $document->appendChild($node);

            $node->setAttribute("id", $this->idProdotto);
            $node->setAttribute("class", "product");

            return $document->saveXML($node);
        }


    }
?>
