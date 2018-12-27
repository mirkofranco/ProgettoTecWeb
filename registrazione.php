<?php
    require_once('./scripts/php/Utente.php');
    require_once('./scripts/php/connection.php');
    $errorForm = "";
    $previousNome = "";
    $previousCognome = "";
    $previousUsername = "";
    $previousEmail = "";

    if(isset($_POST['registrati'])){
        if(strlen($_POST['nome']) < 4){
            $errorForm .= "Il nome deve contenere almeno quattro caratteri<br/>";
        }
        if(strlen($_POST['cognome']) < 4){
            $errorForm .= "Il cognome deve contenere almeno quattro caratteri<br/>";
        }
        if(strlen($_POST['username']) < 4){
            $errorForm .= "Lo username deve contenere almeno quattro caratteri<br/>";
        }
        if(strlen($_POST['password'])  < 5){
            $errorForm .= "La password deve contenere almeno cinque caratteri<br/>";
        }
        if($errorForm == ""){
            $connection = new MySqlDatabaseConnection("localhost", "DatabaseTecnologieWeb", "root", "");
            $connection -> connect();
            $connection -> insertUtente(new Utente($_POST['nome'], $_POST['cognome'], $_POST['username'], md5($_POST['password']), $_POST['email'])) ;
            $connection -> close();
        }else{
            $previousNome = isset($_POST['nome']) ? "value=\"". $_POST['nome']. "\"" : "" ;
            $previousCognome = isset($_POST['cognome']) ? "value=\"". $_POST['cognome']. "\"" : "" ;
            $previousUsername = isset($_POST['username']) ? "value=\"". $_POST['username']. "\"" : "" ;
            $previousEmail = isset($_POST['email']) ? "value=\"". $_POST['email']. "\"" : "" ;
        }
    }
    $daSostituire =  array(
        "{{pageTitle}}" => "Registrazione - Studio AR",
        "{{pageDescription}}"=>"pagina di registrazione al sito dello Studio AR",
        "{{pageKeywords}}"=>"TODO",
        "{{errorForm}}" => $errorForm,
        "{{previousNome}}" => $previousNome,
        "{{previousCognome}}" => $previousCognome,
        "{{previousUsername}}" => $previousUsername,
        "{{previousEmail}}" => $previousEmail
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_admin.html'));
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/registrazione.html'));
    echo file_get_contents('./static/_fine.html');
?>
