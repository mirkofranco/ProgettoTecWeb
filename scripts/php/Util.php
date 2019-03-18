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
            return $mail->Send();
        }

        /**
         * ritorna la stringa argomento in minuscolo econ gli spazi sostituiti da "-".
         */
        public static function customAttributeEncoder($attr) {
          return strtolower(str_replace(" ", "-", $attr));
        }

        /**
         * ritorna la stringa argomento in minuscolo e con gli spazi sostituiti da "_".
         */
        public static function customLinkEncoder($link) {
          return strtolower(str_replace(" ", "_", $link));
        }
    }
    //funzione statica che manda la mail
?>
