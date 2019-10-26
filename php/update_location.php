<?php
    require('app.php');
        $connection = new App;
        $long = $_REQUEST['long'];
        $lat = $_REQUEST['lat'];
        $userId = $_REQUEST['userId'];

        $query = "UPDATE user SET longitude = $long , latitude = $lat WHERE id = $userId";
        $result = $connection->connect()->query($query);
        if ($result) {
            echo "working";
        }else {
            echo "not working 😪";
        }
?>