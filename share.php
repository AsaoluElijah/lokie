<?php
    require('php/app.php');
    $connection = new App;
    if (isset($_REQUEST['share'])) {
        $user = $_REQUEST['user'];
        $key = $_REQUEST['key'];
        $q = "UPDATE invite SET accept = 'true' WHERE hash = '$key' AND user1 = '$user'";
        $r = $connection->connect()->query($q);
        // echo $r;
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
<script src="js/jquery-3.4.1.min.js"></script>
<script>
    // Function to get user current location and save to local storage
    function sendLocation() {
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
               localStorage.latitude = position.coords.latitude || 7.8271;
               localStorage.longitude = position.coords.longitude || 4.902;
            });
        } else{
            alert("Sorry, your device does not support Geolocation.");
        }
    }
</script>
<style>
    body{
        background: linear-gradient(to left, #fff, #fff);
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
<body onload="sendLocation()">
    
<?php if (isset($success)) { ?>
    <div id="label">
        <h1>Lokie</h1>
    </div>
    <div id="map">

    </div>
    <script>

        
            // HTML5 geolocation for longitude and latitude.
        // Geo ends
        function initMap() {
            var directionsRenderer = new google.maps.DirectionsRenderer;
            var directionsService = new google.maps.DirectionsService;
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: {
                    lat: Number(<?php echo $latitude; ?>),
                    lng: Number(<?php echo $longitude ?>)
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
        $.ajax({
            url: './php/user2location.php',
            method: 'post',
            data: {
                updLocation: true,
                key: '<?php echo $key; ?>',
                lat: localStorage.latitude,
                long: localStorage.longitude
            },
            success: function (data) {
                console.log(data);
            }

        });
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmwbZFOM6zFZpFMOng9mZMc-UzQtXvsaU&callback=initMap">
    </script>
<?php } ?>
</body>