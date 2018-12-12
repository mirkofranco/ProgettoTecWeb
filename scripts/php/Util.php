<?php
    require_once('PHPMailer/class.phpmailer.php');
    class Util{
        public static function sendMail($to, $subject, $body){
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
            $mail -> AddReplyTo($to);
            $mail->Subject = $subject;
            $mail->Body = $body;
            if(!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "Message has been sent";
            }
        }
    }
    //funzione statica che manda la mail
?>
