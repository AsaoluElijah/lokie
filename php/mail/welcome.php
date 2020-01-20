<?php
    require('cors.php');
    if (isset($_REQUEST['sendWelcome'])) {
        $userName = $_REQUEST['userName'];
        $userEmail = $_REQUEST['userEmail'];
        $url = "http://lokiee.herokuapp.com/welcome?userName=$userName&userEmail=$userEmail";
        $fetch = file_get_contents($url);
        $regex = preg_match('/world/', $fetch);
        if ($regex) {
            echo 'success';
        }else{
            echo 'failed';
        }
    }
?>