<?php
    require_once('./scripts/php/Util.php');
    require_once('./scripts/php/connection.php');
    $errorForm = "";
    $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
    $connection -> connect();
    $listaCategorie = $connection -> listaCategorie();
    $connection -> close();
    $elencoCategorie = "<select class=\"fInputBorder\" id=\"fcat\" name=\"fcat\" required>";
    $elencoCategorie .= "<option disabled selected hidden value> -- Seleziona un'opzione dalla lista -- </option>";
    foreach ($listaCategorie as $categoria) {
        $elencoCategorie .= "<option value=\"" . $categoria['CodiceCategoria'] . "\"";
        if(isset($_POST['fcat']) && $_POST['fcat'] == $categoria['CodiceCategoria']){
            $elencoCategorie .= " selected";
        }
        $elencoCategorie .=  ">" . $categoria['NomeCategoria'] . "</option>";
    }
    $elencoCategorie .= "</select>";
    if(isset($_POST['chiediConsulenza'])){ //si chiede se il bottone è stato cliccato
            Util::sendMail("barinmonica.66@gmail.com", $_POST['fcat'], $_POST['comment']);
            echo "Mail has been sent!";
    }
    $daSostituire = array(
            "{{pageTitle}}" => "Consulenza Online - AR",
            "{{pageDescription}}"=>"TODO",
            "{{pageKeywords}}"=>"TODO",
            "<a href=\"./consulenza_online.php\">" => "<a href=\"./consulenza_online.php\" class=\"current-page\">",
            "<body>" => "<body onload=\"jsAttivo()\">",
            "{{errorForm}}" => $errorForm,
            "{{elencoCategorie}}" => $elencoCategorie
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html')); //cerca il primo parametro, e nel terzo ci
    //mette quello che trova nel secondo
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/consulenza_online.html'));
    echo file_get_contents('./static/_fine.html');
?>
