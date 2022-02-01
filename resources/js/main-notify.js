Echo.channel('test')
    .listen('.TestEvent', (data) => {
        console.log(data);
    });

Echo.channel('status-liked')
    .listen('.StatusLiked', (data) => {
        console.log(data);
    });

Echo.channel('notification-send')
    .listen('.NotificationEvent', (data) => {
        // this is called when the event notification is received...
        //alert(JSON.stringify(data));
        console.log(data);
    });