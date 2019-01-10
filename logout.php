<?php
    require_once('./scripts/php/Sessione.php');
    Sessione::startSession();
    unset($_SESSION['user']);
    header("location: ./index.php");
?>
