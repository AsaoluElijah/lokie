<?php
require('app.php');
$connection = new App;
$userEmail = $_REQUEST['userEmail'];
$query = "SELECT * FROM trustee WHERE trustee_email = '$userEmail'";
$result = $connection->connect()->query($query);
// $numRow = mysqli_num_rows($result);
if (mysqli_num_rows($result) > 0) {
?>
    <?php while ($row = mysqli_fetch_array($result)) {
        $userId = $row['user_id'];
        $query2 = "SELECT * FROM user WHERE id = $userId ";
        $result2 = $connection->connect()->query($query2);
        $row2 = mysqli_fetch_array($result2);
        $trusteeName = $row2['name'];
        $trusteeEmail = $row2['email'];
        $dateAdded = $row['date_added'];
    ?>
   
        <div class="popup popup-viewDetails<?php echo $userId; ?>">
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
                    <p>Name:</p>
                    <h3><?php echo $trusteeName; ?></h3>
                    <hr style="border: 1px solid #eee;">
                    <p>Email:</p>
                    <h3><?php echo $trusteeEmail; ?></h3>
                    <hr style="border: 1px solid #eee;">
                    <p>Added Since:</p>
                    <h3><?php echo $dateAdded; ?></h3>
                    <hr style="border: 1px solid #eee;">
                    <br>
                    <!-- <p>Click button below to view their last location</p> -->
                    <button class="col button button-fill color-orange">View Last Location</button>
                </div>
            </div>
        </div>
        <li>
            <a href="#" class="item-link item-content popup-open" data-popup=".popup-viewDetails<?php echo $userId; ?>">
                <div class="item-media"><img src="./img/new/avatar.png" alt="<?php echo $trusteeName; ?>" class="seller-img-list" /></div>
                <div class="item-inner">
                    <div class="item-title">
                        <span><?php echo $trusteeName; ?></span>
                        <div class="item-header">Click to view</div>
                    </div>
                </div>
            </a>
        </li>
<?php }
        }
else {
    echo 'empty';
}
?>