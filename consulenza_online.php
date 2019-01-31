<?php
    require_once('./scripts/php/Util.php');
    require_once('./scripts/php/connection.php');
    require_once('./scripts/php/Sessione.php');
    Sessione::startSession();
    $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
    $connection -> connect();
    $listaCategorie = $connection -> listaCategorie();
    $connection -> close();
    $elencoCategorie = "<select class=\"fInputBorder\" id=\"fcat\" name=\"fcat\" required=\"required\">";
    $elencoCategorie .= "<option disabled=\"disabled\" selected=\"selected\" hidden=\"hidden\" value> -- Seleziona un'opzione dalla lista -- </option>";
    foreach ($listaCategorie as $categoria) {
        $elencoCategorie .= "<option value=\"" . $categoria['CodiceCategoria'] . "\"";
        if(isset($_POST['fcat']) && $_POST['fcat'] == $categoria['CodiceCategoria']){
            $elencoCategorie .= " selected";
        }
        $elencoCategorie .=  ">" . $categoria['NomeCategoria'] . "</option>";
    }
    $elencoCategorie .= "</select>";
    $errorForm = "";
    $successForm = "";
    $previousNome = "";
    $previousMail = "";
    $previousCommento = "";
    if(isset($_SESSION['user'])){
        $previousNome = "value=\"" . $_SESSION['user'] -> getNome() . "\"";
        $previousMail = "value=\"" . $_SESSION['user'] -> getMail() . "\"";
    }
    if(isset($_POST['chiediConsulenza'])){ //si chiede se il bottone è stato cliccato
        if(strlen($_POST['firstName']) < 4){
            $errorForm .= "Il nome deve contenere almeno quattro caratteri.<br/>";
        }
        if(strlen($_POST['comment']) < 20){
            $errorForm .= "Il messaggio deve contenere almeno venti caratteri.<br/>";
        }
        if($errorForm == ""){
            $mail = Util::sendMail("barinmonica.66@gmail.com", $_POST['fcat'], $_POST['comment']);
            $errorForm .=  $mail == false  ?  "Si è verificato un errore nell'invio della mail. Riprovare più tardi.<br/>" : "";
            $successForm .= $mail == true ? "La mail è stata inviata con successo! Riceverai una risposta entro 48 ore.<br/>" : "";
        }else{
            $previousNome = "value=\"" . $_POST['firstName'] . "\"";
            $previousMail = "value=\"". $_POST['email'] . "\"";
            $previousCommento =  $_POST['comment'];
        }
    }

    require_once('./scripts/php/Sessione.php');
    Sessione::startSession();
    $gestioneLogin = "";
    if(!isset($_SESSION['user'])){
        $gestioneLogin = "<a href=\"index_admin.php\" class=\"header-button\" >Login</a><a href=\"registrazione.php\" class=\"header-button\" >Registrati</a>";
    }else{
        if($_SESSION['user'] -> getPermessi() == '11'){
            $gestioneLogin .= "<a href=\"index_admin.php\" class=\"header-button\">Area riservata</a>";
        }
        $gestioneLogin = "<a href=\"logout.php\" class=\"header-button\">Logout</a>";
    }

    $daSostituire = array(
            "{{pageTitle}}" => "Consulenza Online - Studio AR",
            "{{pageDescription}}"=>"Pagina di consulenza online per lo studio AR - architetti riuniti",
            "<a href=\"./consulenza_online.php\">" => "<a href=\"./consulenza_online.php\" class=\"current-page\">",
            "{{errorForm}}" => $errorForm,
            "{{elencoCategorie}}" => $elencoCategorie,
            "{{previousNome}}" => $previousNome,
            "{{previousMail}}" => $previousMail,
            "{{previousCommento}}" => $previousCommento,
            "{{successMessage}}" => $successForm,
            "{{gestioneLogin}}" => $gestioneLogin
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio.html')); //cerca il primo parametro, e nel terzo ci
    //mette quello che trova nel secondo
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/consulenza_online.html'));
    echo file_get_contents('./static/_fine.html');
?>
