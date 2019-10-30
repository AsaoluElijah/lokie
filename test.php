<?php
    function a()
    {
        $key = date("F d, Y h:i:s A");
        return sha1($key);
    }
    $c = a();
    echo $c;
    ?>