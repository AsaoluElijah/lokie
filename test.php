<?php
    // echo sha1($a);
    $c = date("F d, Y h:i:s A");
    function a($d, $key)
    {
        $key = date("F d, Y h:i:s A");
        echo $d." ".$key;
    }
    $a = date("F d, Y h:i:s A");
    $c = a('Date1:',$a);
    echo "<br>";
    a('Date2','');
?>