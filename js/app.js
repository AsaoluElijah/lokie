"use strict";
// Dom7
var $ = Dom7;

// Init App
var app = new Framework7({
    root: '#app',
    theme: 'ios',
    routes: routes
});

// setTimeout(checkStatus,
//     1000
// )
// document.getElementById('app').addEventListener('onload', checkStatus);

// function checkStatus() {
//     if (navigator.onLine === false) {
//         location.href = './offline.html';
//     }
// }

var range = app.range.create({
    el: '.range-price',
    on: {
        change: function(e) {
            $('.price-min').html(e.value[0] + "$");
            $('.price-max').html(e.value[1] + "$");
        }
    }
})