        // Note: This example requires that you consent to location sharing when
        // prompted by your browser. If you see the error "The Geolocation service
        // failed.", it means you probably did not give permission for the browser to
        // locate you.
        // search-place
        var map, infoWindow, lat, long;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -34.397,
                    lng: 150.644
                },
                zoom: 10,
                // Or roadmap
                // mapTypeId: 'satellite'
            });
            infoWindow = new google.maps.InfoWindow;

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    infoWindow.setPosition(pos);
                    infoWindow.setContent('Location found.');
                    infoWindow.open(map);
                    map.setCenter(pos);
                    // To show map marker
                    // icon: '/path/to/image'
                    // label: text
                    // draggable: true,
                    var marker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        title: 'Current Location!'
                    });
                    // Map marker end
                    lat = position.coords.latitude;
                    long = position.coords.longitude;
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: Please turn on device location and enable internet connection.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }