# TODO
* Change Active class for navbar in pages
TODO
⭕ Add welcome email ✔
⭕ Send email to invited user ✔
⭕ Add skeleton loader via fraework7.min.css ❌
⭕ download and add montesserrat font ✔
⭕ Create Menu ✔
⭕ Change db connection in ./php/phpmailer/invite.php 📌
<!-- code to open preloader indicator -->
👇✔
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
<!-- $('.open-preloader-indicator').on('click', function () {
  app.preloader.show();
  setTimeout(function () {
    app.preloader.hide();
  }, 3000);
});
Convert array to json 
 $u = array(
            'name' => 'asaolu',
            'id' => 1
        );
  $j = json_encode($u);
  echo $j; 
  -->
  Get location info via php
  <?php
$user_ip = getenv('REMOTE_ADDR');
$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
$country = $geo["geoplugin_countryName"];
$city = $geo["geoplugin_city"];
?> 