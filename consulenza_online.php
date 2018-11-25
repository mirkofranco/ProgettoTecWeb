<?php
    require_once('./scripts/php/PHPMailer/class.phpmailer.php');
    $daSostituire = array(
            "Titolo" => "Consulenza Online - AR",
            "<a href=\"./consulenza_online.php\">" => "<a href=\"./consulenza_online.php\" class=\"active\">"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioU.html'));
    echo file_get_contents('./static/consulenzaOnline.html');
    if(isset($_POST['chiediConsulenza'])){
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "barinmonica.66@gmail.com";
        $mail->Password = "monica66";
        $mail->SetFrom($_POST['email']);
        $mail -> AddReplyTo($_POST['email']);
        $mail->Subject = $_POST['fcat'];
        $mail->Body = $_POST['comment'];
        $mail->AddAddress("barinmonica.66@gmail.com");

         if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
         } else {
            echo "Message has been sent";
 }
    }//if
    echo file_get_contents('./static/fineU.html');
?>
