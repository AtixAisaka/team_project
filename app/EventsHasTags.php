<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventsHasTags extends Model
{
    protected $fillable = [
        'idtag', 'idevent',
    ];
}
