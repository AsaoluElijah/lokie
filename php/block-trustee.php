<?php
    // Contains code for block trustee, unblock and delete trustee;
    require('app.php');
    $app = new App;
    $conn = $app->connect();
    if (isset($_REQUEST['block']) && isset($_REQUEST['auth'])) {
        $userId = $_REQUEST['userId'];
        $trusteeEmail = $_REQUEST['trustee_email'];
        $query = "UPDATE trustee SET blocked = 'true' WHERE user_id = $userId AND trustee_email = '$trusteeEmail'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo 'success';
        }else{
            echo 'failed';
        }
    }
    if (isset($_REQUEST['unblock']) && isset($_REQUEST['auth'])) {
        $userId = $_REQUEST['userId'];
        $trusteeEmail = $_REQUEST['trustee_email'];
        $query = "UPDATE trustee SET blocked = 'false' WHERE user_id = $userId AND trustee_email = '$trusteeEmail'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo 'success';
        }else{
            echo 'failed';
        }
    }
    if (isset($_REQUEST['delete']) && isset($_REQUEST['auth'])) {
        $userId = $_REQUEST['userId'];
        $trusteeEmail = $_REQUEST['trustee_email'];
        $query = "DELETE FROM trustee WHERE user_id = $userId AND trustee_email = '$trusteeEmail'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo 'success';
        }else{
            echo 'failed';
        }
    }
?>