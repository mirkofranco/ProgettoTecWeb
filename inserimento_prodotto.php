<?php
    require_once('./scripts/php/connection.php');
    require_once('./scripts/php/Prodotto.php');
    $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
    $connection -> connect();
    $listaCategorie = $connection -> listSottoCategorie();
    $connection -> close();
    //$previosCat = "value=\"" . (isset($_POST['fcat']) ? "value=\"". $_POST['fcat']. "\"" : "") . "\"" ;
    $elencoCategorie = "<select id=\"fcat\" name=\"fcat\">";
    foreach ($listaCategorie as $categoria) {
        $elencoCategorie .= "<option value=\"" . $categoria['CodiceCategoria'] . "\"";
        if(isset($_POST['fcat']) && $_POST['fcat'] == $categoria['CodiceCategoria']){
            $elencoCategorie .= " selected";
        }
        $elencoCategorie .=  ">" . $categoria['NomeCategoria'] . "</option>";
    }
    $elencoCategorie .= "</select>";
    $errorForm = "";
    $previousCodProd = "";
    $previousNome = "";
    $previousMarca = "";
    $previousPrezzo = "";
    $previousData = "";
    $previousDescrizione = "";
    if(isset($_POST['inserisciProdotto'])){
        if(strlen($_POST['idProdotto']) < 3){
            $errorForm .= "Il codice del prodotto deve contenere almento 3 caratteri<br/>";
        }
        if(strlen($_POST['nomeProdotto']) < 3){
            $errorForm .= "Il nome del prodotto deve contenere almeno 3 caratteri<br/>";
        }
        if(strlen($_POST['marcaProdotto']) < 3){
            $errorForm .= "La marca del prodotto deve contenere almeno 3 caratteri<br/>";
        }
        if(strlen($_POST['Descrizione']) < 10){
            $errorForm .= "La descrizione deve contenere almeno 10 caratteri<br/>";
        }
        if($errorForm == ""){
            $connection -> connect();
            $connection -> insertProdotto(new Prodotto($_POST['idProdotto'], $_POST['fcat'], $_POST['nomeProdotto'], $_POST['marcaProdotto'], $_POST['prezzoProdotto'], date_format(date_create($_POST['dataInizioPrezzo']), "Y/m/d"), 0, $_FILES['immagineProdotto']['name'], $_POST['Descrizione']));
            $connection -> close();
            $connection = null;
            $uploadDir = '../ProgettoTecWeb/images/Catalogo/';
            $tmp = $_FILES['immagineProdotto']['tmp_name'];
            if(move_uploaded_file($tmp, $uploadDir . $_FILES['immagineProdotto']['name'])){
                echo "Immagine caricata con successo!<br/>";
            }
            echo "Prodotto inserito";
        }else{
            $previousCodProd = isset($_POST['idProdotto']) ? "value=\"". $_POST['idProdotto']. "\"" : "" ;
            $previousNome = isset($_POST['nomeProdotto']) ? "value=\"". $_POST['nomeProdotto']. "\"" : "" ;
            $previousMarca = isset($_POST['marcaProdotto']) ? "value=\"". $_POST['marcaProdotto']. "\"" : "" ;
            $previousPrezzo = isset($_POST['prezzoProdotto']) ? "value=\"". $_POST['prezzoProdotto']. "\"" : "" ;
            $previousData = isset($_POST['dataInizioPrezzo']) ? "value=\"". $_POST['dataInizioPrezzo']. "\"" : "" ;
            $previousDescrizione = isset($_POST['Descrizione']) ? "value=\"". $_POST['Descrizione']. "\"" : "" ;
        }
    }
    $daSostituire = array(
            "{{pageTitle}}" => "Inserimento Prodotti - Studio AR",
            "{{pageDescription}}"=>"TODO",
            "{{pageKeywords}}"=>"TODO",
            "{{elencoCategorie}}" => $elencoCategorie,
            "{{errorForm}}" => $errorForm,
            "{{previousCodProd}}" => $previousCodProd,
            "{{previousNome}}" => $previousNome,
            "{{previousMarca}}" => $previousMarca,
            "{{previousPrezzo}}" => $previousPrezzo,
            "{{previousData}}" => $previousData,
            "{{previousDescrizione}}" => $previousDescrizione
        );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html'));
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/form_inserimento_prodotti.html'));
    echo file_get_contents('./static/_fine.html');
?>
