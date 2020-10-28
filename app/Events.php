<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = [
<<<<<<< HEAD
        'event_name', 'start_date', 'end_date',
=======
        'event_name', 'start_date', 'end_date', "userid",
>>>>>>> feature/TEAM-15-User_implementation_and_gui_change
    ];
}
