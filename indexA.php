<?php
    require_once('./scripts/php/Sessione.php');
    require_once('./scripts/php/Utente.php');
    $daSostituire =  array(
        "Titolo" => "Login - Studio AR", 
    );
    Sessione::startSession();
    if(isset($_SESSION['user'])){
        header("location: ./dashboard.php");
    }
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioA.html'));
    echo file_get_contents('./static/login.html');
    if(isset($_POST['login'])){
        $utente = Utente::login($_POST['username'], $_POST['Password']);
        if($utente ==  null){
            echo  "Utente non presente!";
        }else{
            $_SESSION['user'] = $utente;
            header("location: ./dashboard.php");
        }
    }
    echo file_get_contents('./static/fineA.html');
?>
