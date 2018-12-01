<?php
    require_once('./scripts/php/PHPMailer/class.phpmailer.php');
    require_once('./scripts/php/PatternRule.php');
    $daSostituire = array(
            "Titolo" => "Consulenza Online - AR",
            "<a href=\"./consulenza_online.php\">" => "<a href=\"./consulenza_online.php\" class=\"active\">"
    );
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/inizioU.html'));
    echo file_get_contents('./static/consulenzaOnline.html');

    if(isset($_POST['chiediConsulenza'])){
        $mail = new MailRule('/^[A-Za-z0-9-_.+%]+@[A-Za-z0-9-.]+.[A-Za-z]{2,4}$/');
        $mail -> check($_POST['email'], 'email');
        if($mail -> isValid()){
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465; // or 587
            $mail->IsHTML(true);
            $mail->Username = "barinmonica.66@gmail.com";
            $mail->Password = "monica66";
            $mail->AddAddress("barinmonica.66@gmail.com");
            $mail -> AddReplyTo($_POST['email']);
            $mail->Subject = $_POST['fcat'];
            $mail->Body = $_POST['comment'];
            if(!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "Message has been sent";
            }
        }else{
            echo $mail -> getFirstError();
        }
    }//if
    echo file_get_contents('./static/fineU.html');
?>
