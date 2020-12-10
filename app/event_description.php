<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event_description extends Model
{
    protected $table = "event_descriptions";
    protected $fillable = [
        'event_id','description',
    ];
}
