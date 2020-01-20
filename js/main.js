const xhr = new XMLHttpRequest();
if (localStorage.userdata != 'undefined') {
    userData = JSON.parse(localStorage.userdata);
    localStorage.userId = Number(userData.id);
    localStorage.userEmail = userData.email;
    localStorage.userName = userData.name;
    // console.table(userData)

}

function connTimeout(xhr) {
    // timeout to check for connection error after 10sec
    setTimeout(function() {
        if (xhr.status != 200) {
            app.dialog.close();
            app.dialog.alert('Connection Time-out', 'Error');
        }
    }, 10000);
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
// INVITE USER
function inviteUser() {
    var formData = app.form.convertToData('#invite-form');
    var email = formData.email;
    var name = formData.name;
    if (name == "") {
        app.dialog.alert('User Name is Required', 'Error');
    } else if (email == "") {
        app.dialog.alert('Email Address Required', 'Error');
    } else if (validateEmail(email) == false) {
        app.dialog.alert('Invalid Email Address', 'Error');
    }
    //  else if (navigator.onLine == false) {
    //     app.dialog.alert('Internet Connection Error', 'Error')
    // } 
    else {

        localStorage.inviteName = name;
        localStorage.inviteEmail = email;
        localStorage.hostEmail = localStorage.userEmail;
        var sender = localStorage.userEmail;
        var senderName = localStorage.userName;
        // invite = true;
        app.dialog.preloader('Loading, please wait');
        xhr.open('GET', `https://werefer.com.ng/lokie/php/mail/invite.php?senderEmail=${sender}&receiver=${email}&senderName=${senderName}&sendInvite=true`, true);
        xhr.onload = function() {
            if (this.status === 200) {
                data = this.responseText;
                console.log(data);
                returnVal = JSON.parse(data);
                if (returnVal.response == "error") {
                    // unable to save to db
                    app.dialog.close();
                    app.dialog.alert('Unable To Send Request', 'Error');
                    console.log("unable to save to db");
                } else if (returnVal.response == 'failed') {
                    // saved to db, unable to send email
                    localStorage.inviteHash = returnVal.key;
                    app.dialog.close();
                    location.href = './full_map.html';
                } else if (returnVal.response == 'success') {
                    // all good
                    localStorage.inviteHash = returnVal.key;
                    app.dialog.close();
                    location.href = './full_map.html';

                } else {
                    app.dialog.close();
                    app.dialog.alert('Unknown Error Occured', 'Error');
                }
            } else if (this.status === 404) {
                // Close loading dialog
                app.dialog.close();
                app.dialog.alert('Internal Server Error', 'Error 404');
            } else if (this.status === 503) {
                // Close loading dialog
                app.dialog.close();
                app.dialog.alert('Service Currently Unavailable', 'Error 503');
            } else if (this.status === 504) {
                // Close loading dialog
                app.dialog.close();
                app.dialog.alert('Gateway Timeout', 'Error 504');
            }
        }

        xhr.send();
        connTimeout(xhr)
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
    } else if (validateEmail(email) == false) {
        app.dialog.alert('Invalid Email Address', 'Error');
    }
    // else if (navigator.onLine == false) {
    //     app.dialog.alert('Internet Connection Error', 'Error')
    // } 
    else {
        app.dialog.preloader('Loading, please wait');
        xhr.open('GET', `https://werefer.com.ng/lokie/php/register.php?name=${name}&email=${email}&password=${password}`, true);
        xhr.onload = function() {
            if (this.status === 200) {
                data = this.responseText;
                if (data == "exist") {
                    app.dialog.close();
                    app.dialog.alert('Email has already been registered', 'Error');
                } else if (data == "failed") {
                    app.dialog.close();
                    app.dialog.alert('Unknown error occured', 'Error');
                } else {
                    localStorage.userdata = data;
                    var newXhr = new XMLHttpRequest();
                    newXhr.open('GET', `https://werefer.com.ng/lokie/php/mail/welcome.php?sendWelcome=true&userName=${name}&userEmail=${email}`, true);
                    newXhr.onload = function() {
                        if (this.status === 200) {
                            var newData = this.responseText;
                            app.dialog.close();
                            app.dialog.alert('Account created successfully 🚀', 'Success', function() {
                                // Change to route 👇
                                location.href = "index.html";
                            });
                        } else {
                            app.dialog.close();
                            app.dialog.alert('Account created successfully 🚀', 'Success', function() {
                                // Change to route 👇
                                location.href = "index.html";
                            });
                        }
                    }
                    newXhr.send();
                }
            } else if (this.status === 404) {
                // Close loading dialog
                app.dialog.close();
                app.dialog.alert('Internal Server Error', 'Error 404');
            } else if (this.status === 503) {
                // Close loading dialog
                app.dialog.close();
                app.dialog.alert('Service Currently Unavailable', 'Error 503');
            } else if (this.status === 504) {
                // Close loading dialog
                app.dialog.close();
                app.dialog.alert('Gateway Timeout', 'Error 504');
            }
        }
        xhr.send();
        connTimeout(xhr)
    }
}

function addTrustee() {
    var formData = app.form.convertToData('#addTrusteForm');
    var name = formData.name;
    var email = formData.email;
    var phone = formData.phone;
    if (name == "" || email == "" || phone == "") {
        app.dialog.alert('All fields are required', 'Error');
    } else if (validateEmail(email) == false) {
        app.dialog.alert('Invalid Email Address', 'Error');
    }
    //  else if (navigator.onLine == false) {
    //     app.dialog.alert('Internet Connection Error', 'Error')
    // }
    else {
        app.dialog.preloader('Loading, please wait');
        user_id = localStorage.userId;
        user_id = Number(user_id);
        xhr.open('GET', `https://werefer.com.ng/lokie/php/add_trustee.php?trusteeName=${name}&trustee_email=${email}&phone=${phone}&user_id=${user_id}`, true);
        xhr.onload = function() {
            if (this.status === 200) {
                data = this.responseText;
                if (data == "maximum") {
                    app.dialog.close();
                    app.dialog.alert('You have reached a maximum of 5 trustee', 'Error');
                } else if (data == "exist") {
                    app.dialog.close();
                    app.dialog.alert('This trustee already exist', 'Error');
                } else if (data == "failed") {
                    app.dialog.close();
                    app.dialog.alert('Unknown error occured', 'Error');
                } else {
                    app.dialog.close();
                    app.dialog.alert('New Trustee added successfully', 'Success', function() {
                        // app.router.navigate({ url: '/index/' })
                        // Change to route 👇
                        // location.href = "index.html"
                    });
                }
            } else if (this.status === 404) {
                // Close loading dialog
                app.dialog.close();
                app.dialog.alert('Internal Server Error', 'Error 404');
            } else if (this.status === 503) {
                // Close loading dialog
                app.dialog.close();
                app.dialog.alert('Service Currently Unavailable', 'Error 503');
            } else if (this.status === 504) {
                // Close loading dialog
                app.dialog.close();
                app.dialog.alert('Gateway Timeout', 'Error 504');
            }
        }
        xhr.send();
        connTimeout(xhr)
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
    }
    //  else if (navigator.onLine == false) {
    //     app.dialog.alert('Internet Connection Error', 'Error')
    // }
    else {
        app.dialog.preloader('Loading, please wait');
        // ....
        xhr.open('GET', `https://werefer.com.ng/lokie/php/login.php?email=${email}&password=${password}`, true);
        xhr.onload = function() {

            if (this.status === 200) {
                data = this.responseText;
                console.log(data);
                if (data == "failed") {
                    // Close loading dialog
                    app.dialog.close();
                    app.dialog.alert('Incorrect Credentials', 'Error');
                } else {
                    localStorage.userdata = data;
                    // Close loading dialog
                    app.dialog.close();
                    // Open new dialog
                    app.dialog.alert('Login Successfull', 'Success', function() {
                        // Change to route 👇
                        location.href = "index.html";
                    });
                }
            } else if (this.status === 404) {
                // Close loading dialog
                app.dialog.close();
                app.dialog.alert('Internal Server Error', 'Error 404');
            } else if (this.status === 503) {
                // Close loading dialog
                app.dialog.close();
                app.dialog.alert('Service Currently Unavailable', 'Error 503');
            } else if (this.status === 504) {
                // Close loading dialog
                app.dialog.close();
                app.dialog.alert('Gateway Timeout', 'Error 504');
            }
        };
        // Send Request
        xhr.send();
        connTimeout(xhr);
    }
}