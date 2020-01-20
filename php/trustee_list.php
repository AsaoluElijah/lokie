<?php
// TRUSTEES IMAGE WILL BE RANDOM 📌📌📌
require('app.php');
   $connection = new App;
   $userId = $_REQUEST['userId'];
   $query = "SELECT * FROM trustee WHERE user_id = $userId";
   $result = $connection->connect()->query($query);
   if (mysqli_num_rows($result) > 0) {
?>
<?php while ($row = mysqli_fetch_array($result)) {
      $id = $row['id'];
      $userId = $row['user_id'];
      $trusteeEmail = $row['trustee_email'];
      $trusteeName = $row['trustee_name'];
      $dateAdded = $row['date_added'];
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
            <p>Name:</p>
               <h3><?php echo $trusteeName; ?></h3>
            <hr style="border: 1px solid #eee;">
            <p>Email:</p>
               <h3><?php echo $trusteeEmail; ?></h3>
            <hr style="border: 1px solid #eee;">
            <p>Date Added:</p>
               <h3><?php echo $dateAdded; ?></h3>
            <hr style="border: 1px solid #eee;">

            <?php if ($row['blocked'] === 'true') { ?>
               <div id="block-trustee">
                  <button style="" class="col button button-fill color-green" onclick="unblockTrustee(<?php echo $userId; ?>,'<?php echo $trusteeEmail; ?>')">Unblock</button>
                  <br>
               </div>
            <?php }else{ ?>
               <br>
               <div id="unblock-trustee">
                  <button class="col button button-fill color-orange" onclick="blockTrustee(<?php echo $userId; ?>,'<?php echo $trusteeEmail; ?>')">Block</button>
                  <br>
               </div>
            <?php } ?>
            <button class="col button button-fill color-red" onclick="deleteTrustee(<?php echo $userId; ?>,'<?php echo $trusteeEmail; ?>')">Delete</button>
         </div>
      </div>
   </div>
   <li>
      <a href="#" class="item-link item-content popup-open" data-popup=".popup-viewDetails<?php echo $id; ?>">
         <div class="item-media">
            <img src="./img/new/avatar.png" alt="<?php echo $trusteeName . " avatar"; ?>" class="seller-img-list" />
         </div>
         <div class="item-inner">
            <div class="item-title">
               <span><?php echo $trusteeName; ?></span>
               <div class="item-header">Click to view</div>
            </div>
         </div>
      </a>
   </li>

<?php }
} else {
         echo 'empty';
   }
?>