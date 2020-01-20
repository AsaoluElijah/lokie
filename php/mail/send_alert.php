<?php
    require('../cors.php');
    $connection = mysqli_connect('localhost', 'root', '', 'lokie');
    $date =  date("F d, Y h:i:s A");
    $key = sha1($date);
    if (isset($_REQUEST['sendAlert'])) {
        $userId = $_REQUEST['userId'];
        $userName = $_REQUEST['userName'];
        $userEmail = $_REQUEST['userEmail'];
        $trusteeEmails = null;
        // .....
        $q = "SELECT trustee_email FROM trustee WHERE user_id = $userId";
        $r = mysqli_query($connection,$q);
        $rowCount = mysqli_num_rows($r);
        if (mysqli_num_rows($r) > 0) {
            while ($row = mysqli_fetch_array($r)) {
                $trusteeEmails = $row['trustee_email'];
                $url = "https://lokiee.herokuapp.com/sendalert?sendAlert=true&userId=$userId&trusteeEmails=$trusteeEmails&userName=$userName";
                $fetch = file_get_contents($url);
                $regex = preg_match('/hello/', $fetch);
                if ($regex) {
                    echo 'true';
                }else{
                    echo 'false';
                }
            }
        }else{
            echo 'You have no trustee';
        }
        
    }
?>