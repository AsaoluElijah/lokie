<?php
    require("app.php");
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $reg = new App;
    $result = $reg->login($email,$password);
    echo $result;
?>