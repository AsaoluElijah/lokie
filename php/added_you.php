<?php
require('app.php');
$connection = new App;
$userEmail = $_REQUEST['userEmail'];
$query = "SELECT * FROM trustee WHERE trustee_email = '$userEmail'";
$result = $connection->connect()->query($query);
?>
<?php while ($row = mysqli_fetch_array($result)) {
    $userId = $row['user_id'];
    $query2 = "SELECT * FROM user WHERE id = $userId ";
    $result2 = $connection->connect()->query($query2);
    $row2 = mysqli_fetch_array($result2);
    $trusteeName = $row2['name'];
    $dateAdded = $row['date_added'];
    ?>

    <li>
        <a href="#" class="item-link item-content">
            <div class="item-media"><img src="./img/seller3.png" alt="<?php echo $trusteeName; ?>" class="seller-img-list" /></div>
            <div class="item-inner">
                <div class="item-title">
                    <span><?php echo $trusteeName; ?></span>
                    <div class="item-header">Click to view</div>
                </div>
            </div>
        </a>
    </li>
<?php } ?>