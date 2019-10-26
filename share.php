<?php
    require('php/app.php');
    $connection = new App;
    if (isset($_REQUEST['share'])) {
        $user = $_REQUEST['user'];
        $query = "SELECT * FROM user WHERE email = '$user'";
        $result = $connection->connect()->query($query);
        $row = mysqli_fetch_array($result);
        $longitude = $row['longitude'];
        $latitude = $row['latitude'];
        $success = true;
        // echo 'Latitude: '.$latitude." <br> Longitude ".$longitude;
    }
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
<meta name="apple-mobile-web-app-capable" content="yes">
<style>
    body{
        background: linear-gradient(to left, #a6a8b3, #a9aab3);
    }
 #label {
    position: absolute;
    top: 0px;
    left: 50%;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
    color: #292b29;
    z-index: 99;
}
    #map{
        width: auto;
        height:100%;
    }
</style>
<!-- <strong>Mode of Travel: </strong>
<select id="mode" onchange="calcRoute();">
  <option value="DRIVING">Driving</option>
  <option value="WALKING">Walking</option>
  <option value="BICYCLING">Bicycling</option>
  <option value="TRANSIT">Transit</option>
</select> -->
<!-- <h1>Lokie</h1> -->
<?php if (isset($success)) { ?>
    <div id="label">
        <h1>Lokie</h1>
    </div>
    <div id="map">

    </div>
    <script>

        
            // HTML5 geolocation for longitude and latitude.
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
               localStorage.latitude = position.coords.latitude;
               localStorage.longitude = position.coords.longitude;
            });
        } else{
            alert("Sorry, your device does not support HTML5 geolocation.");
        }
        // Geo ends
        function initMap() {
            var directionsRenderer = new google.maps.DirectionsRenderer;
            var directionsService = new google.maps.DirectionsService;
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: {
                    lat: Number(localStorage.latitude),
                    lng: Number(localStorage.longitude)
                }
            });
            directionsRenderer.setMap(map);

            calculateAndDisplayRoute(directionsService, directionsRenderer);
            // document.getElementById('mode').addEventListener('change', function() {
            //     calculateAndDisplayRoute(directionsService, directionsRenderer);
            // });
        }

        function calculateAndDisplayRoute(directionsService, directionsRenderer) {
            // var selectedMode = document.getElementById('mode').value;
            var selectedMode = 'DRIVING';
            directionsService.route({
                origin: {
                    lat: Number(localStorage.latitude),
                    lng: Number(localStorage.longitude)
                }, // Invitee Current Location.
                destination: {
                    lat: <?php echo $latitude; ?>,
                    lng: <?php echo $longitude; ?>
                }, // Inviter Current Location.
                // Note that Javascript allows us to access the constant
                // using square brackets and a string value as its
                // "property."
                travelMode: google.maps.TravelMode[selectedMode]
            }, function(response, status) {
                if (status == 'OK') {
                    directionsRenderer.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmwbZFOM6zFZpFMOng9mZMc-UzQtXvsaU&callback=initMap">
    </script>
<?php } ?>