<?php
    require("app.php");
    $trusteeEmail = $_REQUEST['trustee_email'];
    $userId = $_REQUEST['user_id'];

    $app = new App;
    $result = $app->addTrustee($trusteeEmail,$userId);
    echo $result;
?>