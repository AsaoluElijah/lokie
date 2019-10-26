<?php
    require('./PHPMailer/invite.php');
    if (isset($_REQUEST['invite'])) {
        $email = $_REQUEST['email'];
        $name = 'Request Via Lokie';
        $send = sendMail($email,$name);
        echo $send;
    }
?>