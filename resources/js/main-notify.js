//var socketId = Echo.socketId();
// Enable pusher logging - don't include this in production

//Pusher.logToConsole = true;
var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});

var channel = pusher.subscribe('cek-nomer');
channel.bind('App\\Events\\CekNomerEvent', function (data) {
    // this is called when the event notification is received...
    console.log(data);
    //alert(JSON.stringify(data));
});

var channel1 = pusher.subscribe('notification-send');
channel1.bind('App\\Events\\NotificationEvent', function (data) {
    // this is called when the event notification is received...
    //alert(JSON.stringify(data));
    console.log(data);
});

var channel2 = pusher.subscribe('proses-data');
channel2.bind('.proses.data', function (data) {
    // this is called when the event notification is received...
    console.log(data);
    alert(JSON.stringify(data));
});
