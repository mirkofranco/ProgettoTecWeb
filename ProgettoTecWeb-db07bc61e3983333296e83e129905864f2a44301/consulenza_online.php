<?php
    require_once('./scripts/php/PatternRule.php');
    require_once('./scripts/php/Util.php');
    $daSostituire = array(
            "Titolo" => "Consulenza Online - AR",
            "<a href=\"./consulenza_online.php\">" => "<a href=\"./consulenza_online.php\" class=\"active\">",
            "<body>" => "<body onload=\"jsAttivo()\">"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioU.html'));
    echo file_get_contents('./static/consulenzaOnline.html');
    if(isset($_POST['chiediConsulenza'])){
        if(!isset($_POST['forJs'])){
            $mail = new MailRule('/^[A-Za-z0-9-_.+%]+@[A-Za-z0-9-.]+.[A-Za-z]{2,4}$/');
            $mail -> check($_POST['email'], 'email');
            if($mail -> isValid()){
                Util::sendMail("barinmonica.66@gmail.com", $_POST['fcat'], $_POST['comment']);
            }else{
                echo $mail -> getFirstError();
            }
        }else{
            Util::sendMail("barinmonica.66@gmail.com", $_POST['fcat'], $_POST['comment']);
            echo "Mail has been sent!";
        }
    }
    echo file_get_contents('./static/fineU.html');
?>
