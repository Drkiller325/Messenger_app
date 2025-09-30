<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// presence channel has to return an object not just true or false
Broadcast::channel('Messenger.{id}', function ($user, $id) {
    if ($user->id == $id){
        return $user;
    }
});
