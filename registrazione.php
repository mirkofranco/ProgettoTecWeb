<?php
    require_once('./scripts/php/Utente.php');
    require_once('./scripts/php/connection.php');
    $errorForm = "";
    $previousNome = "";
    $previousCognome = "";
    $previousUsername = "";
    $previousEmail = "";
    $successForm = "";
    // FIXME nomi e cognomi con spazi
    if(isset($_POST['registrati'])){
        if(strlen($_POST['nome']) < 3){
            $errorForm .= "Il nome deve contenere almeno tre caratteri<br/>";
        }
        if(strlen($_POST['cognome']) < 4){
            $errorForm .= "Il cognome deve contenere almeno quattro caratteri<br/>";
        }
        if(strlen($_POST['username']) < 4){
            $errorForm .= "Lo username deve contenere almeno quattro caratteri<br/>";
        }
        if(strlen($_POST['password'])  < 4){
            $errorForm .= "La password deve contenere almeno quattro caratteri<br/>";
        }
        if($errorForm == ""){
            $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
            $connection -> connect();
            if($connection -> insertUtente(new Utente($_POST['nome'], $_POST['cognome'], $_POST['username'], md5($_POST['password']), $_POST['email'])) ){
                $successForm .= "Complimenti! Utente inserito correttamente!";
            }else{
                $errorForm .= "Si è verificato un errore durante l'inserimento. Riprova!";
            }
            $connection -> close();
        }else{
            $previousNome = isset($_POST['nome']) ? "value=\"". $_POST['nome']. "\"" : "" ;
            $previousCognome = isset($_POST['cognome']) ? "value=\"". $_POST['cognome']. "\"" : "" ;
            $previousUsername = isset($_POST['username']) ? "value=\"". $_POST['username']. "\"" : "" ;
            $previousEmail = isset($_POST['email']) ? "value=\"". $_POST['email']. "\"" : "" ;
        }
    } else {
        $_SESSION['previousPage'] = $_SERVER['HTTP_REFERER'];
    }

    require_once('./scripts/php/Sessione.php');
    Sessione::startSession();
    $gestioneLogin = "";
    if(!isset($_SESSION['user'])){
        $gestioneLogin = "<a href=\"login.php\" class=\"header-button\" >Login</a><a href=\"registrazione.php\" class=\"header-button\" >Registrati</a>";
    }else{
        if($_SESSION['user'] -> getPermessi() == '11'){
            $gestioneLogin .= "<a href=\"menu_admin.php\" class=\"header-button\">Area riservata</a>";
        }
        $gestioneLogin .= "<a href=\"logout.php\" class=\"header-button\">Logout</a>";
    }

    $daSostituire =  array(
        "{{pageTitle}}" => "Registrazione - Studio AR",
        "{{pageDescription}}"=>"Pagina di registrazione al sito dello Studio AR - architetti riuniti",
        "<body>" => "<body onload=\"jsAttivo()\">",
        "{{errorForm}}" => $errorForm,
        "{{previousNome}}" => $previousNome,
        "{{previousCognome}}" => $previousCognome,
        "{{previousUsername}}" => $previousUsername,
        "{{previousEmail}}" => $previousEmail,
        "{{successForm}}" => $successForm,
        "{{gestioneLogin}}" => $gestioneLogin
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio.html'));
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/registrazione.html'));
    echo file_get_contents('./static/_fine.html');
?>
