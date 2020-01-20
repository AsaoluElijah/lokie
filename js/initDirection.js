// Show Map
function initDirectionMap(origin, destination) {
    var directionsRenderer = new google.maps.DirectionsRenderer;
    var directionsService = new google.maps.DirectionsService;
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: {
            lat: origin.lat,
            lng: origin.lng
        }
    });
    directionsRenderer.setMap(map);

    calculateAndDisplayRoute(directionsService, directionsRenderer, origin, destination);
    // document.getElementById('mode').addEventListener('change', function() {
    //     calculateAndDisplayRoute(directionsService, directionsRenderer);
    // });
}

function calculateAndDisplayRoute(directionsService, directionsRenderer, origin, destination) {
    // var selectedMode = document.getElementById('mode').value;
    var selectedMode = 'DRIVING';
    directionsService.route({
        origin: {
            lat: origin.lat,
            lng: origin.lng
        }, // Haight.
        destination: {
            lat: destination.lat,
            lng: destination.lng
        }, // Ocean Beach.
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