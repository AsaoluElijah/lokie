<?php

    $connection = mysqli_connect('localhost', 'root', '', 'lokie');
    // WRITE THE CODE TO INSERT THE INVITE AND NOTIFICATION IN DB
    require('../cors.php');
    require('../app.php');
    $notiFy = new App;
    // Get current date,time, minute and second. Hash it and send as key to verify invitation 
    $date =  date("F d, Y h:i:s A");
    $key = sha1($date);
    $response = [];
    if (isset($_REQUEST['sendInvite'])) {
        $senderName = $_REQUEST['senderName'];
        $senderEmail = $_REQUEST['senderEmail'];
        $receiverEmail = $_REQUEST['receiver'];

        // code to insert invite to db
        $query = "INSERT INTO invite(user1, user2, hash)
                    VALUES('$senderEmail', '$receiverEmail', '$key')";
        $result = mysqli_query($connection, $query);
        if ($result) {
            $url = "http://lokiee.herokuapp.com/invite?sender=$senderEmail&email=$receiverEmail&senderName=$senderName";
            $fetch = file_get_contents($url);
            // send notification to the user
            $notiContent = "Hi, $senderName just sent you an invite to share your real time location. <br> Accept below to continue";
            $notiFy->sendNotification($receiverEmail, "Invite From $senderName", $notiContent, $key);
            // notification ends here
            $regex = preg_match('/world/', $fetch);
            // $regex = true;
            if ($regex) {
                $response['response'] = 'success';
                $response['key'] = $key;
                echo json_encode($response, true);
           
            }else{
                // unable to send email
                $response['response'] = 'failed';
                $response['key'] = $key;
                echo json_encode($response, true);
            }
        }else{
            $response['response'] = 'error';
            $response['key'] = $key;
            echo json_encode($response, true);
        }
        
    }
?>