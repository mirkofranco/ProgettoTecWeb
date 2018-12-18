<?php
    require_once('./scripts/php/connection.php');
    require_once('./scripts/php/Prodotto.php');
    $daSostituire = array(
            "{{pageTitle}}" => "Inserimento Prodotti - Studio AR",
            "{{pageDescription}}"=>"TODO",
            "{{pageKeywords}}"=>"TODO"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizio_admin.html'));
    echo file_get_contents('./static/form_inserimento_prodotti.html');
    if(isset($_POST['inserisciProdotto'])){
        $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
        $connection -> connect();
        $connection -> insertProdotto(new Prodotto($_POST['idProdotto'], $_POST['nomeCategoria'], $_POST['nomeProdotto'], $_POST['marcaProdotto'], $_POST['prezzoProdotto'], $_POST['dataInizioPrezzo'], 0, $_FILES['immagineProdotto']['name']));
        $connection -> close();
        $connection = null;
        $uploadDir = '../ProgettoTecWeb/images/Catalogo/';
        $tmp = $_FILES['immagineProdotto']['tmp_name'];
        if(move_uploaded_file($tmp, $uploadDir . $_FILES['immagineProdotto']['name'])){
            echo "Immagine caricata con successo!<br/>";
        }
        echo "Prodotto inserito";
    }
    echo file_get_contents('./static/fine_admin.html');
?>
