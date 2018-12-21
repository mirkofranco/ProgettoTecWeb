<?php
    require_once('./scripts/php/connection.php');
    require_once('./scripts/php/Prodotto.php');
    $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
    $connection -> connect();
    $listaCategorie = $connection -> listSottoCategorie();
    $connection -> close();
    $elencoCategorie = "<select id=\"fcat\" name=\"fcat\">";
    foreach ($listaCategorie as $categoria) {
        $elencoCategorie .= "<option value=\"" . $categoria['CodiceCategoria'] . "\">" . $categoria['NomeCategoria'] . "</option>";
    }
    $elencoCategorie .= "</select>";
    $daSostituire = array(
            "{{pageTitle}}" => "Inserimento Prodotti - Studio AR",
            "{{pageDescription}}"=>"TODO",
            "{{pageKeywords}}"=>"TODO",
            "{{elencoCategorie}}" => $elencoCategorie
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html'));
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/form_inserimento_prodotti.html'));
    if(isset($_POST['inserisciProdotto'])){
        $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
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
    }
    echo file_get_contents('./static/_fine.html');
?>
