<?php
require('app.php');
$conn = new App;
if (isset($_REQUEST['viewNoti'])) {
    if (!isset($_REQUEST['auth']) OR !isset($_REQUEST['userEmail'])) {
        // echo "authorization required";
    } else {
        $userEmail = $_REQUEST['userEmail'];
        // show unseen first
        $query = "SELECT * FROM notification WHERE user_email = '$userEmail' ORDER BY seen asc";
        $result = $conn->connect()->query($query);
        $numRow = mysqli_num_rows($result);
        if ($numRow > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $title = $row['title'];
                // check if alert title contain invite or alert and show diff button for each
                $titleLow = strtolower($title);
                $inviteTrue = preg_match('/invite/', $titleLow);
                $alertTrue = preg_match('/alert/', $titleLow);
                $content = $row['content'];
                $id = $row['id'];
                $title = $title ?  $title :  'New';
                $seen = $row['seen'];
                $hash = $row['hash'];
                // shorten noti content if its length is greater than 50
                if (strlen($content) >= 10) {
                    $contentShort =  substr($content, 0, 50).".. ";
                }
                else {
                    $contencontentShort = $content;
                }
?>
    <div class="popup popup-viewDetails<?php echo $id; ?>">
        <div class="block">
            <p>
                <!-- Close Popup -->
                <a class="link popup-close" href="#">
                    <i class="icon f7-icons if-not-md">close</i>
                </a>
            </p>
            <div style="margin-top: 20px;">
                <img src="./img/new/avatar.png" style="width: 70px;height: 70px;margin: auto;" alt="">
                <br>
                <h3><?php echo $title; ?></h3>
                <p><?php echo $content; ?></p>
                <br>
                <?php if ($inviteTrue) { ?>
                    <button onclick="acceptInvite('<?php echo $hash; ?>');" class="col button button-fill color-green">Accept Invite</button>
                    <br>
                    <button onclick="declineInvite('<?php echo $hash; ?>');" class="col button button-fill color-red">Decline Invite</button>
                <?php }elseif ($alertTrue) { ?>
                    <button class="col button button-fill color-orange">View Last Location</button>
                <?php } ?>
            </div>
        </div>
    </div>
    <li>
        <!-- check if notification is seen, if not seen, show mark as read option 🤔💭 -->
        <a href=""
            onclick="markAsRead(<?php echo $id; ?>)"
            class="item-link item-content popup-open"
            data-popup=".popup-viewDetails<?php echo $id; ?>"
            <?php if($seen !== "true"){ ?>
                style="background: aliceblue;"
            <?php } ?>
            >
            <div class="item-media">
                <i alt="<?php echo $title; ?>" class="seller-img-list f7-icons color-red" style="color: blue;">bell</i>
            </div>
            <div class="item-inner">
                <div class="item-title">
                    <span><?php echo $title; ?></span>
                    <div class="item-header"><?php echo $contentShort; ?></div>
                </div>
            </div>
        </a>
    </li>
<?php
        }
    }else{
        echo "empty";
        }
    }
}
elseif (isset($_REQUEST['checkNewNot'])) {
    $userEmail = $_REQUEST['userEmail'];
    $query = "SELECT * FROM notification WHERE user_email = '$userEmail' AND seen = 'false' LIMIT 1";
    $result = $conn->connect()->query($query);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        echo 'new';
    }else{
        echo 'no new';
    }
}
?>