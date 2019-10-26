<?php
//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

// require '../vendor/autoload.php';
require('./src/Exception.php');
require('./src/PHPMailer.php');
require('./src/SMTP.php');

function sendMail($email, $name)
{
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 2;
    $mail->Host = 'smtp.gmail.com';
    //Set the SMTP port number - likely to be 25, 465 or 587
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = 'My email address';
    $mail->Password = 'my email password';
    $mail->setFrom('welcome@lokie.com', 'Lokie');
    $mail->addAddress($email, $name);
    //Set the subject line
    $mail->Subject = 'Welcome to Lokie';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML(file_get_contents('./welcome.html'), __DIR__);
    //Replace the plain text body with one created manually
    $mail->AltBody = 'Welcome to lokie';
    //Attach an image file
    // $mail->addAttachment('examples/images/phpmailer_mini.png');

    //send the message, check for errors
    if (!$mail->send()) {
        return false;
    } else {
        return true;
    }
}
if (isset($_REQUEST['sendMail'])) {
    $email = $_REQUEST['email'];
    $name = $_REQUEST['name'];
    $send = sendMail('asa@gmail.com','ass');
}

?>