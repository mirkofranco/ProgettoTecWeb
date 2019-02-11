<?php
    require_once('./scripts/php/connection.php');
    require_once('./scripts/php/Utente.php');
    require_once './scripts/php/Sessione.php';
    Sessione::startSession();

    $errorForm = "";
    $previousNome = "";
    $previousCognome = "";
    $previousUsername = "";
    $previousEmail = "";
    $successForm = "";
    if(isset($_POST['registrati'])){
        if(strlen($_POST['nome']) < 2){
            $errorForm .= "Il nome deve contenere almeno due caratteri<br/>";
        }
        if(strlen($_POST['cognome']) < 2){
            $errorForm .= "Il cognome deve contenere almeno due caratteri<br/>";
        }
        if(strlen($_POST['username']) < 4){
            $errorForm .= "Lo username deve contenere almeno quattro caratteri<br/>";
        }
        if(strlen($_POST['password']) < 4){
            $errorForm .= "La password deve contenere almeno quattro caratteri<br/>";
        }

        $connection = new MySqlDatabaseConnection("localhost", "mifranco", "mifranco", "Aideebe4esooDuqu");
        $connection -> connect();
        $username = $_POST['username'];
        $email = $_POST['email'];
        $checkExisting = $connection->checkExistingUsernameAndEmail($username, $email);

        if ($checkExisting[0] > 0) {
            $errorForm .= "Esiste già un utente con questo username<br />";
        }
        if ($checkExisting[1] > 0) {
            $errorForm .= "Esiste già un utente con questo indirizzo email<br />";
        }

        if($errorForm == "") {
            $user = new Utente($_POST['nome'], $_POST['cognome'], $username , md5($_POST['password']), $email);
            if($connection -> insertUtente($user) ){
                $_SESSION['user'] = $user;
                $successForm="Complimenti, la registrazione è avvenuta con successo!";
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
        if (isset($_SERVER['HTTP_REFERER'])) {
            // aggiorna previous page solo se non corrispondono alla pagina di login o registrazione
            if (strpos($_SERVER['HTTP_REFERER'], "login") === false &&
                strpos($_SERVER['HTTP_REFERER'], "registrazione")=== false ){
                $_SESSION['previousPage'] = $_SERVER['HTTP_REFERER'];
        }
        } else {
            $_SESSION['previousPage'] = "./index.php";
        }
    }

    // se il login/registrazione è andato a buon fine, elimina la variabile e redirige alla pagina precedente
    if (isset($_SESSION['user'])) {
        $temp = $_SESSION['previousPage'];
        unset($_SESSION['previousPage']);

        header("Location: " . $temp);
    }

    $gestioneLogin = "<a href=\"login.php\" class=\"header-button\" >Login</a>";

    $daSostituire = array(
        "{{pageTitle}}" => "Registrazione - Studio AR",
        "{{pageDescription}}"=>"Pagina di registrazione al sito dello Studio AR - architetti riuniti",
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
