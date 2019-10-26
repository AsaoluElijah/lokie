<?php
require('app.php');
$connection = new App;
$userId = $_REQUEST['userId'];
$query = "SELECT * FROM trustee WHERE user_id = $userId ORDER BY id desc";
$result = $connection->connect()->query($query);
?>
<?php while ($row = mysqli_fetch_array($result)) {
      $trusteeEmail = $row['trustee_email'];
      $query2 ="SELECT * FROM user WHERE email = '$trusteeEmail' ";
      $result2 = $connection->connect()->query($query2);
      $row2 = mysqli_fetch_array($result2);
      if ($row2 > 0) {
         $trusteeName = $row2['name'];
      }else {
         $trusteeName = $row['trustee_email'];
      }
      $dateAdded = $row['date_added'];
   ?>

   <li>
      <a href="#" class="item-link item-content">
         <div class="item-media"><img src="./img/seller1.png" alt="<?php echo $trusteeName." avatar"; ?>" class="seller-img-list" /></div>
         <div class="item-inner">
            <div class="item-title">
               <span><?php echo $trusteeName; ?></span>
               <div class="item-header">Trustee Since <?php echo $dateAdded; ?></div>
            </div>
         </div>
      </a>
   </li>
<?php } ?>