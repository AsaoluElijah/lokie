<?php
    require('app.php');
    $conn = new App;
    if (isset($_REQUEST['inviteHash'])) {
        $inviteHash = $_REQUEST['inviteHash'];
        $query = "SELECT * FROM invite WHERE hash = '$inviteHash'";
        $result = $conn->connect()->query($query);
        if ($result) {
            $row = $result->fetch_assoc();
            if ($row > 0) {
                if ($row['cancel'] == 'true' OR $row['expired'] == 'true') {
                   echo "expired";
                }else{
                    echo json_encode($row, true);
                }
            }else{
                echo 'error';
            }
         }
            
    }
?>