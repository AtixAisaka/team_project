<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersGoingEvents extends Model
{
    protected $fillable = [
        'userid', 'eventid',
    ];
}
