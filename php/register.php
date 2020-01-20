<?php
    require("app.php");
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $reg = new App;
    $result = $reg->registerUser($name, $email,$password) ;
    echo $result;
?>