import Echo from 'laravel-echo';

/* Pusher
//var socketId = Echo.socketId();
window.Pusher = require('pusher-js');
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});

var channel1 = pusher.subscribe('notification-send');
channel1.bind('App\\Events\\NotificationEvent', function (data) {
    // this is called when the event notification is received...
    //alert(JSON.stringify(data));
    console.log(data);
});*/

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ":" + window.laravel_echo_port
});

//console.log(window.location.hostname + ":" + window.laravel_echo_port);