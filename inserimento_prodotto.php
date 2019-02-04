<?php
    require_once('./scripts/php/Sessione.php');
    Sessione::startSession();
    Sessione::reservedPage();

    $gestioneLogin = "<a href=\"menu_admin.php\" class=\"header-button\">Area riservata</a>";
    $gestioneLogin .= "<a href=\"logout.php\" class=\"header-button\">Logout</a>";

    require_once('./scripts/php/connection.php');
    require_once('./scripts/php/Prodotto.php');
    $connection = new MySqlDatabaseConnection("localhost", "mifranco", "mifranco", "Aideebe4esooDuqu");
    $connection -> connect();
    $listaCategorie = $connection -> listaSottoCategorie();
    $connection -> close();
    //$previosCat = "value=\"" . (isset($_POST['fcat']) ? "value=\"". $_POST['fcat']. "\"" : "") . "\""
    $elencoCategorie = "<select id=\"fcat\" name=\"fcat\" required=\"required\">";
    foreach ($listaCategorie as $categoria) {
        $elencoCategorie .= "<option value=\"" . $categoria['CodiceCategoria'] . "\"";
        /*if(isset($_POST['fcat']) && $_POST['fcat'] == $categoria['CodiceCategoria']){
            $elencoCategorie .= " selected";
        }*/
        $elencoCategorie .=  ">" . $categoria['NomeCategoria'] . "</option>";
    }
    $elencoCategorie .= "</select>";
    $errorForm = "";
    $previousNome = "";
    $previousMarca = "";
    $previousPrezzo = "";
    $previousData = "";
    $previousDescrizione = "";
    $successForm = "";
    if(isset($_POST['inserisciProdotto'])){
        if(strlen($_POST['nomeProdotto']) < 3){
            $errorForm .= "Il nome del prodotto deve contenere almeno tre caratteri<br/>";
        }
        if(strlen($_POST['marcaProdotto']) < 3){
            $errorForm .= "La marca del prodotto deve contenere almeno tre caratteri<br/>";
        }
        if(strlen($_POST['Descrizione']) < 10){
            $errorForm .= "La descrizione deve contenere almeno 10 caratteri<br/>";
        }
        $uploadDir = '../ProgettoTecWeb/images/catalogo/';
        $uploarDirPiccole = '../ProgettoTecWeb/images/catalogo/thumbnails/';
        $tmp = $_FILES['immagineProdotto']['tmp_name'];
        $tmpPiccola = $_FILES['immaginePiccolaProdotto']['tmp_name'];
        if(file_exists($uploadDir . $_FILES['immagineProdotto']['name'])){
            $errorForm .= "L'immmagine del prodotto è gia presente<br/>";
        }
        if(file_exists($uploarDirPiccole . $_FILES['immaginePiccolaProdotto']['name'])){
            $errorForm .= "La miniatura del prodotto gia esiste<br/>";
        }
        if($errorForm == ""){
            move_uploaded_file($tmp, $uploadDir . $_FILES['immagineProdotto']['name']);
            move_uploaded_file($tmpPiccola, $uploarDirPiccole . $_FILES['immaginePiccolaProdotto']['name']);
            $connection -> connect();
            if($connection -> insertProdotto(new Prodotto($_POST['fcat'], $_POST['nomeProdotto'], $_POST['marcaProdotto'], $_POST['prezzoProdotto'], date_format(date_create($_POST['dataInizioPrezzo']), "Y/m/d"), $_POST['isOfferta'], $_FILES['immagineProdotto']['name'], $_FILES['immaginePiccolaProdotto']['name'],  $_POST['Descrizione']))){
                $successForm .= "Complimenti! Il prodotto è stato inserito correttamente!";
            }
            $connection -> close();
            $connection = null;
        }else{
            $previousNome =  "value=\"". $_POST['nomeProdotto']. "\"";
            $previousMarca =  "value=\"". $_POST['marcaProdotto']. "\"";
            $previousPrezzo = "value=\"". $_POST['prezzoProdotto']. "\"";
            $previousData =  "value=\"". $_POST['dataInizioPrezzo']. "\"";
            $previousDescrizione =  "value=\"". $_POST['Descrizione']. "\"";
        }
    }

    $daSostituire = array(
            "{{pageTitle}}" => "Inserimento Prodotti - Studio AR",
            "{{pageDescription}}"=>"Pagina per l'inserimento dei prodotti del sito dello studio AR - architetti riuniti",
            "<body>" => "<body onload=\"loadDataPicker()\">",
            "{{elencoCategorie}}" => $elencoCategorie,
            "{{errorForm}}" => $errorForm,
            "{{previousNome}}" => $previousNome,
            "{{previousMarca}}" => $previousMarca,
            "{{previousPrezzo}}" => $previousPrezzo,
            "{{previousData}}" => $previousData,
            "{{previousDescrizione}}" => $previousDescrizione,
            "{{successForm}}" => $successForm,
            "{{gestioneLogin}}" => $gestioneLogin
        );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio.html'));
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inserimento_prodotto.html'));
    echo file_get_contents('./static/_fine.html');
?>
