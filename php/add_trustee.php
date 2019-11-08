<?php
    require("app.php");
    $trusteeName = $_REQUEST['trusteeName'];
    $trusteeEmail = $_REQUEST['trustee_email'];
    $userId = $_REQUEST['user_id'];
    $phone = $_REQUEST['phone'];

    $app = new App;
    $result = $app->addTrustee($trusteeName,$trusteeEmail, $userId, $phone);
    echo $result;
?>