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

        public function getPreviewDomElement() {
            $document = new DOMDocument('1.0', 'utf-8');
            $document->formatOutput = true;

            $mainContainer = $document->createElement("div");
            $mainContainer->setAttribute("id", $this->idProdotto);
            $mainContainer->setAttribute("class", "anteprima-prodotto");

            $img = $document->createElement("img");
            $img->setAttribute("src", "./images/catalogo/" . $this->nomeImmaginePiccola);
            $img->setAttribute("alt", "immagine del prodotto");

            $textContainer = $document->createElement("div");
            $textContainer->setAttribute("class","anteprima-testo");

            $name = $document->createElement("h3", $this->nome);

            $brand = $document->createElement("span", htmlspecialchars($this->marca));
            $brand->setAttribute("title", "marca del prodotto");

            $mainContainer->appendChild($img);
            $mainContainer->appendChild($textContainer);
            $textContainer->appendChild($name);
            $textContainer->appendChild($brand);

            // prezzo è l'unico attributo nullabile, quindi lo aggiungiamo al dom solo se esiste
            if (!is_null($this->prezzo)) {
                $price = $document->createElement("h4", "€ " . $this->prezzo);
                $textContainer->appendChild($price);
            }

            return $mainContainer;
        }

        // <div id="#idProdotto" class="anteprima-prodotto">
        //   <img src="./images/catalogo/thumbnails/$this->nomeImmaginePiccola" alt="immagine del prodotto" />
        //   <div class="anteprima-testo">
        //     <h3>nome</h3>
        //     <span title="marca del prodotto"> marca </span>
        //     <span title="prezzo del prodotto">€ 1400</h4>
        //   </div>
        //   pulsante "ottieni link a prodotto"? TODO?
        // </div>

        public function getDetailsDomElement() {
            die("NOT IMPLEMENTED");
            $document = new DOMDocument('1.0', 'utf-8');
            $this->document->formatOutput = true;

            // $brand = $document->createElement("span", htmlspecialchars($this->marca));
            // htmlspecialchars($this->descrizione)
            return $mainContainer;
        }

        // <div class="dettaglio-prodotto">
        //   <img src="./images/catalogo/$this->nomeImmagine" alt="immagine del prodotto" />
        //   <div class="dettaglio-testo">
        //     <h3>$this->nome</h3>
        //     <span title="marca del prodotto">$this->marca</span>
        //     <span title="prezzo del prodotto">€ $this->prezzo</span>
        //     <span title="descrizione del prodotto">
        //       $this->descrizione
        //     </span>
        //   </div>
        // </div>

    }
?>
