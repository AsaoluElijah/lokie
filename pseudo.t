return Notification as a json Array
then loop it with each one having an event AudioListener
e.g
while (json...) {
    template = `user sent a req, <btn-accept onclick="accept('user','hash')"> | btn-rejeect`
}
fxn accept('user', 'hash') {
    if (invitestatus == 'closed') {
        say 'invite has been closed'
    } else {
        getCurrentLocation()
        'send query to db to accept invite along with currentLocation'
    }
}