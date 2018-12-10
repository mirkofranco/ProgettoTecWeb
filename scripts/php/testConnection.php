<?php
    require_once('connection.php');
    require_once('Prodotto.php');
    echo "Test DatabaseConnection<br/>";
    $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
    echo "Connessione costruita<br/>";
    $connectio = null;
    echo "Connessione distrutta<br/>";
    echo "Fine test connessione<br/>";
    echo "Test prodotto<br/>";
    $prodotto = new Prodotto(1, "Zona Giorno", "Mobile Nero", "Apple", 35, '2018-12-03', 0);
    echo "Ho creato il prodotto: <br/>";
    echo $prodotto . "<br/>";
    $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
    $connection -> connect();
    $connection -> insertProdotto($prodotto);
    echo "Ho inserito il prodotto " . $prodotto . "<br/>";
    echo "I prodotti presenti nel DB sono: <br/>";
    $prodotti = $connection -> selectAllProdotti();
    echo implode(" ........ ", $prodotti);
    $altroProdotto = new Prodotto(2, "Zona Notte", "Letto Nero", "Nicoletta and friends" , 102 , '2018-12-04', 1);
    $connection -> insertProdotto($altroProdotto);
    echo "Ho inserito il prodotto " . $prodotto . "<br/>";
    echo "I prodotti presenti nel DB sono: " . "<br/>";
    $prodotti = $connection -> selectAllProdotti();
    echo implode(" ........ ", $prodotti);
    $connection -> close();
?>
