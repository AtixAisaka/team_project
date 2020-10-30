<?php


namespace App;

use Illuminate\Database\Eloquent\Model;


class events_image extends Model
{
    protected $table = "events_image";
    protected $fillable = [
        'image','user_id', 'event_id',
    ];
}
