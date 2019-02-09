<?php
require_once './scripts/php/connection.php';
require_once './scripts/php/Prodotto.php';
require_once './scripts/php/Sessione.php';
Sessione::startSession();
Sessione::reservedPage();

// controlla che la query string contenga un id
if (!(array_key_exists('id', $_REQUEST) && is_numeric($_REQUEST['id']))) {
    header("Location: ./404.php", 404);
    exit;
}

$productId = $_REQUEST['id'];

$gestioneLogin = "<a href=\"menu_admin.php\" class=\"header-button\">Area riservata</a>";
$gestioneLogin .= "<a href=\"logout.php\" class=\"header-button\">Logout</a>";

$connection = new MySqlDatabaseConnection("localhost", "mifranco", "mifranco", "Aideebe4esooDuqu");
$connection->connect();

$productAttributes = $connection->getProduct($productId);
// controllo se esiste un prodotto con quell'id
if (!$productAttributes) {
    header("Location: ./404.php", 404);
    exit;
}

$categoryName = $productAttributes[0];
$subCategoryName = $productAttributes[1];

$product = new Prodotto(...array_slice($productAttributes, 2));

function wrapValue($arg) {
    return "value=\"" . $arg . "\"";
}

$previousCategoria = wrapValue($product->getCategoria());
$previousNome = wrapValue($product->getNome());
$previousMarca = wrapValue($product->getMarca());
$previousPrezzo = wrapValue($product->getPrezzo());
$previousData = wrapValue($product->getDataInizioPrezzo());
$previousDescrizione = $product->getDescrizione();

$previousIsOfferta = array('si' => '', 'no' => '');
if ($product->getOfferta() == '0') {
    $previousIsOfferta['no'] = "checked=\"checked\"";
} elseif ($arg == '1') {
    $previousIsOfferta['si'] = "checked=\"checked\"";
}

$commonPath = "./images/catalogo/";

$previousImage = '<a href="' . $commonPath . $product->getNomeImmagine() . '" alt="immagine precedente" download="' . $product->getNomeImmagine() . '">scarica la vecchia immagine di questo prodotto</a>';
$previousImageThumbnail = '<a href="' . $commonPath . $product->getNomeImmaginePiccola() . '" alt="miniatura precedente" download="' . $product->getNomeImmaginePiccola() . '">scarica la vecchia miniatura di questo prodotto</a>';

$listaCategorie = $connection->listaSottoCategorie();

$elencoCategorie = "<select id=\"fcat\" name=\"fcat\" required=\"required\">";
foreach ($listaCategorie as $categoria) {
    $elencoCategorie .= "<option value=\"" . $categoria['CodiceCategoria'] . "\"";
    if ($previousCategoria == $categoria['CodiceCategoria']) {
        $elencoCategorie .= "selected=\"selected\" ";
    }
    $elencoCategorie .= ">" . $categoria['NomeCategoria'] . "</option>";
}
$elencoCategorie .= "</select>";

$errorForm = "";
$successForm = "";

if (isset($_POST['inserisciProdotto'])) {
    if (strlen($_POST['nomeProdotto']) < 4) {
        $errorForm .= "Il nome del prodotto deve contenere almeno quattro caratteri<br/>";
    }
    if (strlen($_POST['marcaProdotto']) < 4) {
        $errorForm .= "La marca del prodotto deve contenere almeno quattro caratteri<br/>";
    }
    if (strlen($_POST['Descrizione']) < 10) {
        $errorForm .= "La descrizione deve contenere almeno 10 caratteri<br/>";
    }

    $uploadDir = 'images/catalogo/';
    $uploarDirPiccole = 'images/catalogo/thumbnails/';

    $tmp = $_FILES['immagineProdotto']['tmp_name'];
    $tmpPiccola = $_FILES['immaginePiccolaProdotto']['tmp_name'];

    $sameImage = file_exists($uploadDir . $_FILES['immagineProdotto']['name']);
    $sameThumbnail = file_exists($uploarDirPiccole . $_FILES['immaginePiccolaProdotto']['name']);

    if (!$sameImage) {
        move_uploaded_file($tmp, $uploadDir . $_FILES['immagineProdotto']['name']);
    }

    if (!$sameThumbnail) {
        move_uploaded_file($tmpPiccola, $uploarDirPiccole . $_FILES['immaginePiccolaProdotto']['name']);
    }

    if ($errorForm == "") {
        $updatedProduct = new Prodotto($_POST['fcat'],
            $_POST['nomeProdotto'],
            $_POST['marcaProdotto'],
            $_POST['prezzoProdotto'],
            date_format(date_create($_POST['dataInizioPrezzo']), "Y/m/d"),
            $_POST['isOfferta'],
            $_FILES['immagineProdotto']['name'],
            $_FILES['immaginePiccolaProdotto']['name'],
            $_POST['Descrizione'],
            $_POST['idProdotto']
        );

        if ($connection->updateProduct($updatedProduct)) {
            $successForm .= "Complimenti! Il prodotto è stato modificato correttamente!";
            move_uploaded_file($tmp, $uploadDir . $_FILES['immagineProdotto']['name']);
            move_uploaded_file($tmpPiccola, $uploarDirPiccole . $_FILES['immaginePiccolaProdotto']['name']);
        }
    }
        $previousNome = wrapValue($_POST['nomeProdotto']);
        $previousMarca = wrapValue($_POST['marcaProdotto']);
        $previousPrezzo = wrapValue($_POST['prezzoProdotto']);
        $previousData = wrapValue($_POST['dataInizioPrezzo']);
        $previousDescrizione = $_POST['Descrizione'];
}

$connection->close();

$daSostituire = array(
    "{{pageTitle}}" => "Modifica Prodotti - Studio AR",
    "{{pageDescription}}" => "Pagina per la modifica di un prodotto del sito dello studio AR - architetti riuniti",
    "<body>" => "<body onload=\"loadDataPicker()\">",
    "{{errorForm}}" => $errorForm,
    "{{idProdotto}}" => wrapValue($productId),
    "{{elencoCategorie}}" => $elencoCategorie,
    "{{previousNome}}" => $previousNome,
    "{{previousMarca}}" => $previousMarca,
    "{{previousPrezzo}}" => $previousPrezzo,
    "{{previousIsOffertaSi}}" => $previousIsOfferta['si'],
    "{{previousIsOffertaNo}}" => $previousIsOfferta['no'],
    "{{previousData}}" => $previousData,
    "{{previousDescrizione}}" => $previousDescrizione,
    "{{previousImmagine}}" => $previousImage,
    "{{previousImmaginePiccola}}" => $previousImageThumbnail,
    "{{imageRequired}}}" => "",
    "{{successForm}}" => $successForm,
    "{{gestioneLogin}}" => $gestioneLogin,
    "{{submitText}}" => "Invia la modifica",
);

$page = file_get_contents('./static/_inizio.html') .
file_get_contents('./static/inserimento_prodotto.html') .
file_get_contents('./static/_fine.html');

echo str_replace(array_keys($daSostituire), array_values($daSostituire), $page);
