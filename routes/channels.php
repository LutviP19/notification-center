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
Broadcast::channel('proses-data', function ($user) {
    return true;
});

//Broadcast::channel('proses-data', ProsesDataChannel::class);
//Broadcast::channel('collected-fish-channel', CollectedFishObserver::class);

// test
Broadcast::channel('cek-nomer', function ($user) {
    return true;
});
Broadcast::channel('notification-send', function ($user) {
    return true;
});
