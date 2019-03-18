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

        /* Costruisce un oggetto Prodotto in modo completo */
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

        /**
         * restituisce un DOMElement contenente la struttura html dell'anteprima di questo prodotto
         */
        public function getAnteprimaProdotto() {
            $document = new DOMDocument('1.0', 'utf-8');
            $document->formatOutput = true;

            $mainContainer = $document->createElement("section");
            $mainContainer->setAttribute("id", $this->idProdotto);
            $mainContainer->setAttribute("class", "anteprima-prodotto");

            $detailsLink = $document->createElement("a");
            $detailsLink->setAttribute("href","./dettaglio_prodotto.php?id=" . $this->idProdotto);
            $detailsLink->setAttribute("title", "vai alla pagina dei dettagli di questo prodotto");
            $mainContainer->appendChild($detailsLink);

            $img = $document->createElement("img");
            $img->setAttribute("src", "./images/catalogo/" . $this->nomeImmaginePiccola);
            $img->setAttribute("alt", "");
            $detailsLink->appendChild($img);

            $textContainer = $document->createElement("div");
            $textContainer->setAttribute("class", "anteprima-testo");
            $detailsLink->appendChild($textContainer);

            $name = $document->createElement("h3", $this->nome);
            $name->setAttribute("class", "prodotto-info-importante");
            $textContainer->appendChild($name);

            $brand = $document->createElement("span", htmlspecialchars($this->marca));
            $brand->setAttribute("title", "marca");
            $brand->setAttribute("class", "prodotto-info-normale");
            $textContainer->appendChild($brand);

            // prezzo è l'unico attributo nullabile, quindi lo aggiungiamo al dom solo se esiste
            if (!is_null($this->prezzo)) {
                $price = $document->createElement("span", "€ " . $this->prezzo);
                $price->setAttribute("class", "prodotto-info-importante");

                if ($this->offerta == '1') {
                    $price->nodeValue .= " (attualmente in offerta)";
                }

                $textContainer->appendChild($price);
            }

            return $mainContainer;
        }

        /**
         * restituisce il codice HTML da inserire nella pagina dettaglio di questo prodotto
         */
        public function getDettaglioProdotto() {

            $document = new DOMDocument('1.0', 'utf-8');
            $document->formatOutput = true;

            $mainContainer = $document->createElement("section");
            $mainContainer->setAttribute("id", $this->idProdotto);
            $mainContainer->setAttribute("class", "dettaglio-prodotto clearfix");

            $img = $document->createElement("img");
            $img->setAttribute("src", "./images/catalogo/" . $this->nomeImmagine);
            $img->setAttribute("alt", "immagine del prodotto");
            $mainContainer->appendChild($img);

            $textContainer = $document->createElement("div");
            $textContainer->setAttribute("class","dettaglio-testo");
            $mainContainer->appendChild($textContainer);

            $name = $document->createElement("h1", $this->nome);
            $name->setAttribute("class", "prodotto-info-importante");
            $textContainer->appendChild($name);
     
            $brand = $document->createElement("span", htmlspecialchars($this->marca));
            $brand->setAttribute("title", "marca");
            $brand->setAttribute("class", "prodotto-info-normale");
            $textContainer->appendChild($brand);

            // prezzo è l'unico attributo nullabile, quindi lo aggiungiamo al dom solo se esiste
            if (!is_null($this->prezzo)) {
                $price = $document->createElement("span", "€ " . $this->prezzo);
                $price->setAttribute("class", "prodotto-info-importante");
                if ($this->offerta == '1') {
                    $price->nodeValue .= " (questo prodotto è in offerta per un tempo limitato)";
                }

                $textContainer->appendChild($price);
            }

            $description = $document->createElement("p", $this->descrizione);
            $description->setAttribute("title", "descrizione");
            $brand->setAttribute("class", "prodotto-info-normale");
            $textContainer->appendChild($description);

            return $document->saveXML($mainContainer);
        }

    }
?>
