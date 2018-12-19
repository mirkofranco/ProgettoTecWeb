<?php
    require_once('./scripts/php/Sessione.php');
    require_once('./scripts/php/Utente.php');
    Sessione::startSession();
    if(isset($_SESSION['user']) &&  substr($_SESSION['user'] -> getPermessi(), 0, 1) == '1' ){
        echo "Oh! Ti sei loggato!<br/>";
        echo $_SESSION['user'];
    }else {
        header('location: ./index.php');
    }
?>
