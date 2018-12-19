<?php
    require_once('./scripts/php/Util.php');
    $errorForm = "";
    if(isset($_POST['chiediConsulenza'])){ //si chiede se il bottone è stato cliccato
        if(!isset($_POST['forJs'])){ //se sì => controlla se js è attivo, fino a riga 20 js NON È ATTIVO
            if(/*$mail -> isValid()*/ preg_match('/^[A-Za-z0-9-_.+%]+@[A-Za-z0-9-.]+.[A-Za-z]{2,4}$/', $_POST['email'])){ //se la mail è valida => se l'array è vuoto ritorna true
                Util::sendMail("barinmonica.66@gmail.com", $_POST['fcat'], $_POST['comment']); //manda la mail
            }else{  //la mail non è valida
                //echo $mail -> getFirstError(); //messaggio di errore: la funzione è dentro una classe in uno dei due file sopra
                $errorForm = "La mail non è valida";
            }
        }else{ //se js è attivo si entra qua, il controllo sulla mail lo fa js e quindi mando la mail easy
            Util::sendMail("barinmonica.66@gmail.com", $_POST['fcat'], $_POST['comment']);
            echo "Mail has been sent!";
        }
    }
    $daSostituire = array(
            "{{pageTitle}}" => "Consulenza Online - AR",
            "{{pageDescription}}"=>"TODO",
            "{{pageKeywords}}"=>"TODO",
            "<a href=\"./consulenza_online.php\">" => "<a href=\"./consulenza_online.php\" class=\"current-page\">",
            "<body>" => "<body onload=\"jsAttivo()\">",
            "{{errorForm}}" => $errorForm
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html')); //cerca il primo parametro, e nel terzo ci
    //mette quello che trova nel secondo
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/consulenza_online.html'));
    echo file_get_contents('./static/_fine.html');
?>
