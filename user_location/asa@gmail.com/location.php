<?php
    // create a setTimeOut fxn in Js that access this page with ajaz every nSEC and write to a file
    // $location[1] = array(
    //     'time'=> '12:00pm',
    //     'long' => '12.000',
    //     'lat' => '12.000'
    // );
   
?>
<?php
$file = "note.txt";
    
// String of data to be written
$data = "The quick brown fox jumps over the lazy dog.";
    
// Write data to the file
file_put_contents($file, $data, FILE_APPEND) or die("ERROR: Cannot write the file.");
    
echo "success";
?>