<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventsFile extends Model
{
    protected $table = "events_file";
    protected $fillable = [
        'file','user_id', 'event_id',
    ];
}
