<?php
require('cors.php');
require('connection.php');

// < /> with love (<3) by Asaolu Elijah
class App extends Connect
{
    function sendAlert($userId)
    {
        $query = "SELECT * FROM trustee WHERE user_id = $userId";
        $result = $this->connect()->query($query);
        while ($row = mysqli_fetch_array($result)) {
            // Code to send email to the user trustee will be here;
            // echo $row['id'];
            // $trustee = $row['trustee_email'];
            // echo $trustee."<br>";
        }
    }
    function emailExist($email)
    {

        // $connection = $this->connect();
        $query = "SELECT email FROM user WHERE email = '{$email}'";
        $result = $this->connect()->query($query);
        $row = mysqli_num_rows($result);
        if ($row > 0) {
            return "yes";
        } else {
            return "no";
        }
    }

    function registerUser($name, $email, $password)
    {
        $checkEmail = $this->emailExist($email);

        if ($checkEmail == "yes") {
            return "exist";
        } else {
            // $pwd = $password;
            // $password = sha1($password);
            // $connection = connect();
            $query = "INSERT INTO user(name,email,password)
                VALUES('$name','$email','$password')";
            $result = $this->connect()->query($query);
            if ($result) {
                $q = "SELECT * FROM user WHERE email = '$email'";
                $re = $this->connect()->query($q);
                $rw = mysqli_fetch_array($re);

                $detail = array(
                    "id" => $rw['id'],
                    "name" => $rw['name'],
                    "email" => $rw['email']
                );
                $data = json_encode($detail);
                // "{id:".$row['id'].", name:"."'".$row['name']."'".", email:"."'".$row['email']."'"."}"
                return $data;
            } else {
                return 'failed';
            }
        }
    }

    function addTrustee($trusteeName,$trusteEmail, $userId, $phone)
    {
        $query = "SELECT * FROM trustee WHERE user_id = {$userId}";
        $result = $this->connect()->query($query);
        $row = mysqli_num_rows($result);
        // $trusteeCount = $row['trustee_count'];
        if ($row >= 5) {
            return "maximum";
        } else {
            // Code to check if trustee has already been added by the user;
            $trusteeExist = $this->trusteeExist($trusteEmail,$userId);
            if ($trusteeExist === true) {
                return 'exist';
            }else {
                // If trustee does not exist, add them to DB
            $addNewTrustee = $this->addNewTrustee($trusteeName,$trusteEmail,$userId, $phone);
            if ($addNewTrustee === true) {
                $this->updateTrusteeCount(+1,$userId);
                return 'success';
            }else{
                return 'failed';
            }
            }
        }
    }

    function addNewTrustee($trusteeName,$trusteEmail,$userId, $phone)
    {
        $query = "INSERT INTO trustee(trustee_name,user_id,trustee_email,trustee_phone) 
            VALUES('$trusteeName','$userId' , '$trusteEmail', '$phone')";
        $result = $this->connect()->query($query);
        if ($result) {
            return true;
        }else{
            return false;
        }

    }

    function updateTrusteeCount($val,$userId)
    {
        $query = "SELECT * FROM user WHERE id = {$userId}";
        $result = $this->connect()->query($query);
        $row = mysqli_fetch_array($result);
        $trustee_count = $row['trustee_count'];
        $trustee_count = $trustee_count + $val;
        $query2 = "UPDATE user SET trustee_count = $trustee_count WHERE id = $userId";
        $result2 = $this->connect()->query($query2);
        if ($result2) {
            return true;
        }else {
            return false;
        }
    }

    function trusteeExist($email,$userId)
    {
        $query = "SELECT * FROM trustee WHERE trustee_email = '$email' AND user_id = '$userId'";
        $result = $this->connect()->query($query);
        $row = mysqli_fetch_array($result);
        if ($row > 0) {
            return true;
        }else {
            return false;
        }
    }

    function login($email, $password)
    {
        // $connection = $this->connect();
        $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password' ";
        // $result = mysqli_query($connection,$query);
        $result =  $this->connect()->query($query);
        $row =  $result->fetch_array();
        if ($row > 0) {
            $detail = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "email" => $row['email']
            );
            $data = json_encode($detail);
            // "{id:".$row['id'].", name:"."'".$row['name']."'".", email:"."'".$row['email']."'"."}"
            return $data;
        } else {
            return 'failed';
        }
    }
    // send notification to user
    function sendNotification($userEmail, $title, $content, $hash)
    {
        // hash, used for invite notification
        $query = "INSERT INTO notification(user_email, title, content, hash) VALUES('$userEmail', '$title', '$content', '$hash')";
        $result = $this->connect()->query($query);
        if ($result) {
            return true;
        }else{
            return false;
        }
    }
    // set notification status to seen
    function seenNotification($notificationId){
        $query = "UPDATE notification SET seen = 'true' WHERE id = $notificationId";
        $result = $this->connect()->query($query);
        if ($result) {
            return true;
        }else{
            return false;
        }
    }
} 
    // $app = new App;
    // echo $app->seenNotification(2, 'user 1');
    // header('Content-Type: application/json');

    // $users = $app->listUsers(10,'asc');
    // $myfile = fopen('../users.json','w');
    // fwrite($myfile,$users);
    
    // mkdir('api/v1/',0,true);

    // $a = $app->registerUser('Asaro E.', 'aa@j.o','asa');
    // if ($a === 'exist') {
    //     echo "esixt";
    // }else if ($a === true) {
    //     echo "Dioe";
    // }else{
    //     echo "Nog";
    // }
    // echo $app->insertTransaction('86f7e437faa5a7fce15d1ddcb9eaeaea377667b8','df211ccdd94a63e0bcb9e6ae427a249484a49d60',10,'You re welcome');
?>