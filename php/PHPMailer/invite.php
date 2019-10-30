<?php
$connection = mysqli_connect('localhost','root','','lokie');
//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

// require '../vendor/autoload.php';
require('./src/Exception.php');
require('./src/PHPMailer.php');
require('./src/SMTP.php');

function sendMail($email, $name, $from)
{
    // Get current date,time, minute and second. Hash it and send as key to verify invitation 
    $date =  date("F d, Y h:i:s A");
    $key = sha1($date);
    $msgBody = '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invitiation To Lokie</title>
    <style>
        * {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        
        a {
            text-decoration: none;
            color: #3F51B5;
        }
        
        .btn {
            border: 0;
            outline: 0;
            width: 155px !important;
            height: 45px !important;
            padding: 15px;
            font-size: 16px;
            color: #fff;
            border-radius: 4px;
            margin: 0 5px;
            cursor: pointer;
        }
        
        .accept-btn {
            background: #2fab35;
            color: #fff;
            ;
        }
        
        .accept-btn:hover {
            background: #067415;
        }
        
        .decline-btn {
            background: #D32F2F;
        }
        
        .decline-btn:hover {
            background: rgb(138, 23, 23);
        }
    </style>
</head>

<body>
    <div class="msg-body">
        <center>
            <img src="meet.jpg" alt="An illustration" style="width: 350px;height: 300px;">
        </center>
        <p>Howdy, '.$from .' just sent a request to share real time locations on lokie.</p>
        <p>Click accept below to honour the invitation, or click decline to ignore the request.</p>
        <b>Optionally, <a href="lokie.000webhostapp.com/download">download</a> and install lokie on your mobile phone
            for easier access</b>
        <br><br>
        <a href="http://localhost/bright/share.php?key='.$key.'&user='.$email.'&share=true" class="btn accept-btn">
            Accept
        </a>
        <a class="btn decline-btn">
            Decline
        </a>
        <br><br><br>
        <hr>
    </div>
    <div class="msg-foot">
        <small>
            Lokie Mobile
            <br>
            <a href="#">Home</a>
            <br>
            <a href="#">Download Now</a>
            <br>
            <a href="#">Read Our Blog</a>
        </small>
    </div>
</body>

</html>
';
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com';
    //Set the SMTP port number - likely to be 25, 465 or 587
    $mail->Port = 25;
    $mail->SMTPAuth = true;
    $mail->Username = 'asaoluelijah7@gmail.com';
    $mail->Password = 'administration';
    $mail->setFrom($from, 'Request@Lokie');
    $mail->addAddress($email, $name);
    //Set the subject line

    // 🚀 $mail->Body = "$from sent you a request" 📌;

    $mail->Subject = '[IMPORTANT] New Invitation From Lokie 📬';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    // $mail->msgHTML(file_get_contents('./invite.html'), __DIR__);
    $mail->msgHTML($msgBody);
    //Replace the plain text body with one created manually
    $mail->AltBody = 'Someone just sent you an invite via Lokie';
    //Attach an image file
    // $mail->addAttachment('examples/images/phpmailer_mini.png');

    //send the message, check for errors
    if (!$mail->send()) {
        return 'false';
    } else {
        return $key;
    }
}

?>
<?php
    if (isset($_REQUEST['invite'])) {
        $sender = $_REQUEST['sender'];
        $email = $_REQUEST['email'];
        $name = 'Lokie';
        $send = sendMail($email,$name, $sender);
        
        if ($send != 'false') {
            $key =  $send;
            $query = "INSERT INTO invite(user1,user2,hash) VALUES('{$sender}','{$email}','{$key}')";
            $result = mysqli_query($connection,$query);
        }
        echo $send;
        
    }
?>