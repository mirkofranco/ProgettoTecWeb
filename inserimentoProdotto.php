<?php
    require_once('./scripts/php/connection.php');
    require_once('./scripts/php/Prodotto.php');
    $daSostituire = array(
            "{{pageTitle}}" => "Inserimento Prodotti - Studio AR",
            "{{pageDescription}}"=>"TODO",
            "{{pageKeywords}}"=>"TODO"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioA.html'));
    echo file_get_contents('./static/formInserimentoProdotti.html');
    if(isset($_POST['inserisciProdotto'])){
        $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
        $connection -> connect();
        $connection -> insertProdotto(new Prodotto($_POST['idProdotto'], $_POST['nomeCategoria'], $_POST['nomeProdotto'], $_POST['marcaProdotto'], $_POST['prezzoProdotto'], $_POST['dataInizioPrezzo'], 0));
        $connection -> close();
        $connection = null;
        echo "Prodotto inserito";
    }
    echo file_get_contents('./static/fineA.html');
?>
