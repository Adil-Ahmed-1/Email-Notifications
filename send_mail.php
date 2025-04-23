<?php
    require_once("require/mail.php");

    $user_email = 'Ahmedkhan@gmail.com';
    $subject = 'Account Activated';
    $message = 'Dear User, your account has been activated successfully.';
    
    if (sendMail($user_email, $subject, $message)) {
        echo "Email sent successfully.";
    } else {
        echo "Failed to send email.";
    }

?>