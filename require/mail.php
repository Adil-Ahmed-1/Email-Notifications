<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'require/PHPMailer-master/src/Exception.php';
require_once 'require/PHPMailer-master/src/PHPMailer.php';
require_once 'require/PHPMailer-master/src/SMTP.php';

function sendMail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'adil.khoso128@gmail.com';
        $mail->Password   = 'aujq kkmj mrwy laag '; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('adil.khoso128@gmail.com', 'Adil Khoso');

        //  Add CC and BCC with names
        $mail->addCC('salim_khoso@gmail.com', 'Mr. Salim Khoso');
        $mail->addBCC('ambreen_koondhar@gmail.com', 'Ms. Ambreen');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

?>
