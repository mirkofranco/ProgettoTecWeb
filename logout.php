<?php
    require_once('./scripts/php/Sessione.php');
    Sessione::startSession();
    unset($_SESSION['user']);
    Sessione::sessioneDestroy();
    
    header("location: ". $_SERVER['HTTP_REFERER']);
?>
