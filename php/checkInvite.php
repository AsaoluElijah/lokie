<?php
    require('app.php');
    // $connection = new App;
    function checkInv($query)
    {
        $connection = new App;
        $result = $connection->connect()->query($query);
            $row = mysqli_fetch_array($result);
            if ($row < 1) {
                echo 'not-found';
            }
            // @if both users accepts the request, send the second user long and lat
            elseif ($row['user2_accept'] == "true" AND $row['user3_accept'] == "true") {
                $user2Long = $row['user2_long'];
                $user2Lat = $row['user2_lat'];

                $user3Long = $row['user3_long'];
                $user3Lat = $row['user3_lat'];

                $detail = array(
                    "accept" => 'user2 and user3',
                    "user2_longitude" => $user2Long,
                    "user2_latitude" => $user2Lat,
                    "user3_longitude" => $user3Long,
                    "user3_latitude" => $user3Lat,
                );
                $data = json_encode($detail);
                echo $data;
            }
            elseif ($row['user2_accept'] == "true") {
                $user2Long = $row['user2_long'];
                $user2Lat = $row['user2_lat'];
                $detail = array(
                    "accept" => 'user2',
                    "longitude" => $user2Long,
                    "latitude" => $user2Lat
                );
                $data = json_encode($detail);
                echo $data;
                // @........
                // @if third user accepts the request, send the third user long and lat
            }elseif ($row['user3_accept'] == "true") {
                $user3Long = $row['user3_long'];
                $user3Lat = $row['user3_lat'];
                $detail = array(
                    "accept" => 'user3',
                    "longitude" => $user3Long,
                    "latitude" => $user3Lat
                );
                $data = json_encode($detail);
                echo $data;
                // Checks if sec users has accepted the invitation
            }elseif ($row['user2_accept'] == "true" AND $row['user2_accept'] == "true") {
                $user2Long = $row['user2_long'];
                $user2Lat = $row['user2_lat'];

                $user3Long = $row['user3_long'];
                $user3Lat = $row['user3_lat'];

                $detail = array(
                    "accept" => 'user2 and user3',
                    "user2_longitude" => $user2Long,
                    "user2_latitude" => $user2Lat,
                    "user3_longitude" => $user3Long,
                    "user3_latitude" => $user3Lat,
                );
                $data = json_encode($detail);
                echo $data;
            }
            else{
                echo 'false';
            }
        
    }
    if (isset($_REQUEST['checkInvite'])) {
        $key = $_REQUEST['key'];
        $user1 = $_REQUEST['user1'];
        $user2 = $_REQUEST['user2'];
        // @check if there is a third user   
        if ($key == null) {
            echo 'false';
        }elseif (isset($_REQUEST['user3']) AND $_REQUEST['user3'] != '') {
            $user3 = $_REQUEST['user3'];
            $query = "SELECT * FROM invite WHERE user1 = '$user1' AND user2 = '$user2' AND user3 = '$user3' AND hash = '$key'";
            checkInv($query);
        }else{
            $query = "SELECT * FROM invite WHERE user1 = '$user1' AND user2 = '$user2' AND hash = '$key'";
            checkInv($query);
        }
    }
?>