<?php

// $ch = curl_init("http://www.example.com/");
// $fp = fopen("example_homepage.txt", "w");

// curl_setopt($ch, CURLOPT_FILE, $fp);
// curl_setopt($ch, CURLOPT_HEADER, 0);

// curl_exec($ch);
// if(curl_error($ch)) {
//     fwrite($fp, curl_error($ch));
// }
// curl_close($ch);
// fclose($fp);

function url_get_contents ($url) {
    if (!function_exists('curl_init')){ 
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
$me = url_get_contents("http://www.example.com/");
echo $me;
?>