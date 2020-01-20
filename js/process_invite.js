function showLoader() {
    app.dialog.preloader('Checking Invite');
    setTimeout(() => {
        app.dialog.close();
        // app.dialog.preloader('Preparing Interface');
        // setTimeout(() => {
        //     app.dialog.close();
        // }, 2000);
    }, 1000);
}

function acceptInvite(hash) {
    showLoader();
    var aXhr = new XMLHttpRequest();
    aXhr.open('GET', `./php/process_invite.php?inviteHash=${hash}`, true);
    aXhr.onload = function() {
        if (this.status === 200) {
            var data = this.responseText;
            // console.log(data);
            if (data == "expired") {
                app.dialog.alert('Invite Expired');
            } else if (data == "error") {
                app.dialog.alert('Error Processong Invite');
            } else {
                data = JSON.parse(data);
                console.table(data);
                app.dialog.alert('Invite Accepted', 'Loading');

                // set item to localstorage
                localStorage.hostEmail = data.user1;
                localStorage.inviteEmail = data.user2;
                localStorage.inviteEmail2 = data.user3;
                localStorage.inviteHash = data.hash;
                setTimeout(() => {
                    location.href = 'full_map.html';
                }, 2000);

            }
        }
    }
    aXhr.send();
}

function declineInvite(hash) {
    console.log('invite ' + hash + ' declined');
}