if (localStorage.userdata == undefined) {
    // console.log('Please login')
    app.router.navigate({
        url: '/login/',
    });
} else {
    userData = JSON.parse(localStorage.userdata);
    localStorage.userId = Number(userData.id);
    localStorage.userEmail = userData.email;
    localStorage.userName = userData.name;
    // console.table(userData)
}
// Function to update trustee page with info from DB.
// setInterval is used because the div for trustee doesnt exist at first.
// so setInterval and a function to check if the div exist so as to fill from DB

// FOR TRUSTEES YOU'VE ADDED 🎈
setInterval(function() {
        var page = document.getElementById('trustee_page');
        if (page == null) {
            // console.log('Page is not active')
        } else {
            // console.log('Page is active');
            app.request.get('php/trustee_list.php', {
                    userId: localStorage.userId
                },
                function(data) {
                    document.getElementById('trustee_list').innerHTML = data;
                });
        }
    },
    500
);

// FOR THOSE WHO ADDED YOU AS TRUSTEE 🤳
setInterval(function() {
        var page = document.getElementById('added_you_page');
        if (page == null) {
            // console.log('Page is not active')
        } else {
            // console.log('Page is active');
            app.request.get('php/added_you.php', {
                    userEmail: userEmail
                },
                function(data) {
                    // console.log(data)
                    document.getElementById('added_you_list').innerHTML = data;
                });
        }
    },
    500
);

// AUTO UPDATE USER LOCATION IN DB
// setInterval(function() {

//         navigator.geolocation.getCurrentPosition(function(position) {
//             var positionInfo = position.coords.latitude + " " + position.coords.longitude;
//             var lat = position.coords.latitude;
//             var long = position.coords.longitude;
//             app.request.get('php/update_location.php', {
//                     long: long,
//                     lat: lat,
//                     userId: 1,
//                     update: true
//                 },
//                 function(data) {
//                     console.log(data);
//                 }
//             )
//         });
//     },
//     500
// );
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
// INVITE USER
function inviteUser() {
    var formData = app.form.convertToData('#invite-form');
    // formData = JSON.stringify(formData);
    var email = formData.email;
    if (email == "") {
        app.dialog.alert('Please enter a value 😢', 'Error');
    } else if (validateEmail(email) == false) {
        app.dialog.alert('Invalid Email Address', 'Error');
    } else {
        // validateEmail(email);

        localStorage.inviteEmail = email;
        app.dialog.preloader('Loading, please wait');
        app.request.get('./php/PHPMailer/invite.php', {
                sender: localStorage.userEmail,
                email: email,
                invite: true
            },
            function(data) {
                if (data == 'false') {
                    app.dialog.close();
                    app.dialog.alert('Unable To Send Request', 'Error');
                } else {
                    localStorage.inviteHash = data;
                    app.dialog.close();
                    location.href = './full_map.html';
                }
            }
        );
    }
}

// Logout
function logout() {
    localStorage.userdata = 'undefined'
    location.href = 'login.html';
}

// SIGNUP
function signUp() {
    var formData = app.form.convertToData('#registerForm');
    // formData = JSON.stringify(formData);
    var name = formData.name;
    var email = formData.email;
    var password = formData.password;
    if (name == "" || email == "" || password == "") {
        app.dialog.alert('All fields are required', 'Error');
    } else {
        app.dialog.preloader('Loading, please wait');
        setTimeout(function() {
            app.request.get('./php/register.php', {
                name: name,
                email: email,
                password: password
            }, function(data) {
                console.log(data);
                if (data == "exist") {
                    app.dialog.alert('Email has already been registered', 'Error');
                } else if (data == "failed") {
                    app.dialog.alert('Unknown error occured', 'Error');
                } else {
                    localStorage.userdata = data;
                    app.dialog.alert('Account created successfully', 'Success', function() {
                        // Change to route 👇
                        location.href = "index.html"
                    });
                }
            });
            app.dialog.close();
        }, 1500);
    }
}

function addTrustee() {
    var formData = app.form.convertToData('#addTrusteForm');
    var email = formData.email;
    var phone = formData.phone;
    if (email == "" || phone == "") {
        app.dialog.alert('All fields are required', 'Error');
    } else if (validateEmail(email) == false) {
        app.dialog.alert('Invalid Email Address', 'Error');
    } else {
        app.dialog.preloader('Loading, please wait');
        setTimeout(function() {
            app.request.get('./php/add_trustee.php', {
                trustee_email: email,
                phone: phone,
                user_id: localStorage.userId
                    // Change userId value from 1 to normal 👌
            }, function(data) {
                console.log(data);
                if (data == "maximum") {
                    app.dialog.alert('You have reached a maximum of 5 trustee', 'Error');
                } else if (data == "exist") {
                    app.dialog.alert('This trustee already exist', 'Error');
                } else if (data == "failed") {
                    app.dialog.alert('Unknown error occured', 'Error');
                } else {
                    app.dialog.alert('New Trustee added successfully', 'Success', function() {
                        // app.router.navigate({ url: '/index/' })
                        // Change to route 👇
                        // location.href = "index.html"
                    });
                }
            });
            app.dialog.close();
        }, 1500);

    }

}

function logIn() {
    var formData = app.form.convertToData('#login-form');
    // formData = JSON.stringify(formData);
    var email = formData.email;
    var password = formData.password;
    if (email == "" || password == "") {
        app.dialog.alert('All fields are required', 'Error');
    } else if (validateEmail(email) == false) {
        app.dialog.alert('Invalid Email Address', 'Error');
    } else {
        app.dialog.preloader('Loading, please wait');
        setTimeout(function() {
            app.request.get('./php/login.php', {
                email: email,
                password: password
            }, function(data) {
                console.log(data);
                if (data == "failed") {
                    app.dialog.alert('Incorrect Credentials', 'Error');
                } else {
                    localStorage.userdata = data;
                    app.dialog.alert('Login Successfull', 'Success', function() {
                        // Change to route 👇
                        location.href = "index.html"
                    });
                }
            });
            app.dialog.close();
        }, 1500);
    }
}