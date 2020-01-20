<?php
    require('./app.php');
    $app = new App;
    $conn = $app->connect();
    if (isset($_REQUEST['not_id'])) {
        $not_id = $_REQUEST['not_id'];
        $query = "UPDATE notification SET seen = 'true' WHERE id = $not_id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo 'mark as read';
        }else {
            echo 'error';
        }
    }
?>