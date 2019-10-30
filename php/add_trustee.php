<?php
    require("app.php");
    $trusteeEmail = $_REQUEST['trustee_email'];
    $userId = $_REQUEST['user_id'];
    $phone = $_REQUEST['phone'];

    $app = new App;
    $result = $app->addTrustee($trusteeEmail, $userId, $phone);
    echo $result;
?>