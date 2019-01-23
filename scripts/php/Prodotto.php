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

            // FIXME: così prima viene letto "vai ai dettagli di.." ma non ho ancora visto l'elemento; non è molto accessibile....
            $detailsLink = $document->createElement("a");
            $detailsLink->setAttribute("href","./dettaglio_prodotto.php?id=" . $this->idProdotto);
            $detailsLink->setAttribute("title", "vai alla pagina dei dettagli di questo prodotto");

            $mainContainer = $document->createElement("div");
            $mainContainer->setAttribute("id", $this->idProdotto);
            $mainContainer->setAttribute("class", "anteprima-prodotto");
            $detailsLink->appendChild($mainContainer);

            $img = $document->createElement("img");
            $img->setAttribute("src", "./images/catalogo/" . $this->nomeImmaginePiccola);
            $img->setAttribute("alt", "immagine del prodotto");
            $mainContainer->appendChild($img);

            $textContainer = $document->createElement("div");
            $textContainer->setAttribute("class","anteprima-testo");
            $mainContainer->appendChild($textContainer);

            $name = $document->createElement("h3", $this->nome);
            $textContainer->appendChild($name);

            $brand = $document->createElement("span", htmlspecialchars($this->marca));
            $brand->setAttribute("title", "marca del prodotto");
            $textContainer->appendChild($brand);


            // prezzo è l'unico attributo nullabile, quindi lo aggiungiamo al dom solo se esiste
            if (!is_null($this->prezzo)) {
                $price = $document->createElement("h4", "€ " . $this->prezzo);
                $textContainer->appendChild($price);
            }

            return $detailsLink;
        }

        // <a href="./dettaglio_prodotto.php?id=..." title="vai alla pagina dei dettagli di questo prodotto">
        //   <div id="#idProdotto" class="anteprima-prodotto">
        //     <img src="./images/catalogo/thumbnails/$this->nomeImmaginePiccola" alt="immagine del prodotto" />
        //     <div class="anteprima-testo">
        //       <h3>nome</h3>
        //       <span title="marca del prodotto"> marca </span>
        //       <span title="prezzo del prodotto">€ 1400</h4>
        //     </div>
        //     pulsante "ottieni link a prodotto"? TODO?
        //   </div>
        // </a>

        public function getDetailsHtml() {

            $document = new DOMDocument('1.0', 'utf-8');
            $document->formatOutput = true;

            $mainContainer = $document->createElement("div");
            $mainContainer->setAttribute("id", $this->idProdotto);
            $mainContainer->setAttribute("class", "dettaglio-prodotto clearfix");

            $img = $document->createElement("img");
            $img->setAttribute("src", "./images/catalogo/" . $this->nomeImmagine);
            $img->setAttribute("alt", "immagine del prodotto");
            $mainContainer->appendChild($img);

            $textContainer = $document->createElement("div");
            $textContainer->setAttribute("class","dettaglio-testo");
            $mainContainer->appendChild($textContainer);

            $name = $document->createElement("h3", $this->nome);
            $textContainer->appendChild($name);
     
            $brand = $document->createElement("p", htmlspecialchars($this->marca));
            $brand->setAttribute("title", "marca del prodotto");
            $textContainer->appendChild($brand);

            // prezzo è l'unico attributo nullabile, quindi lo aggiungiamo al dom solo se esiste
            if (!is_null($this->prezzo)) {
                $price = $document->createElement("p", "€ " . $this->prezzo);
                $textContainer->appendChild($price);
            }

            $description = $document->createElement("p", $this->descrizione);
            $description->setAttribute("title", "descrizione del prodotto");
            $textContainer->appendChild($description);

            return $document->saveXML($mainContainer);
        }

        // <div class="dettaglio-prodotto clearfix">
        //   <img src="./images/catalogo/$this->nomeImmagine" alt="immagine del prodotto" />
        //   <div class="dettaglio-testo">
        //     <h3>$this->nome</h3>
        //     <p title="marca del prodotto">$this->marca</p>
        //     <p title="prezzo del prodotto">€ $this->prezzo</p>
        //     <p title="descrizione del prodotto">
        //       $this->descrizione
        //     </p>
        //   </div>
        // </div>

    }
?>
