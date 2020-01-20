navigatior.geolocation.getCurrentPosition(function(position) {}, function(error) {
    calldialog();
});

function calldialog() {
    document.addEventListener("deviceready", function() {
        cordova.dialogGPS("Your Device Location is Disabled, this app needs to be enable to works.", //message
            "Enanble Location Services.", //description
            function(buttonIndex) { //callback
                switch (buttonIndex) {
                    case 0:
                        calldialog(); //cancel
                        break;
                    case 1:
                        calldialog(); //neutro option
                        break;
                    case 2:
                        break; //user go to configuration
                }
            },
            "Please Enable Device Location", //title
            ["Cancel", "Later", "Go"]); //buttons
    });
}