<?php
    $daSostituire = array(
            "Titolo" => "Consulenza Online - AR",
            "<a href=\"./consulenza_online.php\">" => "<a href=\"./consulenza_online.php\" class=\"active\">"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioU.html'));
    echo file_get_contents('./static/consulenzaOnline.html');
    if(isset($_POST['chiediConsulenza'])){
        $nome_mittente = "Negozio AR";
        $mail_mittente = $_POST['email'];
        $mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
        mail("mirko.franco@icloud.com", $_POST['fcat'], $_POST['comment'], $mail_headers);
    }
    echo file_get_contents('./static/fineU.html');
?>
