<?php
    require('app.php');
    $connection = new App;
    if (isset($_REQUEST['checkInvite'])) {
        $user1 = $_REQUEST['user1'];
        $user2 = $_REQUEST['user2'];
        $key = $_REQUEST['key'];
        $query = "SELECT * FROM invite WHERE user1 = '$user1' AND user2 = '$user2' AND hash = '$key'";
        $result = $connection->connect()->query($query);
        $row = mysqli_fetch_array($result);
        if ($row['accept'] == "true") {

            $user2Long = $row['user2_long'];
            $user2Lat = $row['user2_lat'];
            
            $detail = array(
                "longitude" => $user2Long,
                "latitude" => $user2Lat
            );
            $data = json_encode($detail);
            echo $data;
        }else{
            echo 'false';
        }
    }
?>