<?php
    require_once('./scripts/php/Sessione.php');
    require_once('./scripts/php/Utente.php');
    Sessione::startSession();
    echo "Oh! Ti sei loggato!<br/>";
    echo $_SESSION['user'];
?>
