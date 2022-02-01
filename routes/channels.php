<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Channels
Broadcast::channel('user-channel', function ($user) {
    return true;
});
Broadcast::channel('notification-send', function ($user) {
    return true;
});
Broadcast::channel('status-liked', function ($user) {
    return true;
});
Broadcast::channel('test', function ($user) {
    return true;
});


// Example Code
//Broadcast::channel('proses-data', ProsesDataChannel::class);
//Broadcast::channel('collected-fish-channel', CollectedFishObserver::class);

