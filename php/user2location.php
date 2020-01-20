<?php
    // Code to update user2 (invited user) location so as to display it in fullmap.html
    require('app.php');
    $connection = new App;
    if(isset($_REQUEST['updLocation'])){
        $long = $_REQUEST['long'];
        $lat = $_REQUEST['lat'];
        $key = $_REQUEST['key'];
        $query = "UPDATE invite SET user2_long = '$long', user2_lat = '$lat' WHERE hash = '$key' ";
        $result = $connection->connect()->query($query);
        if ($result) {
            echo 'true';
        }else {
            echo 'false';
        }
    }
?>