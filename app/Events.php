<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Events extends Model
{
    protected $fillable = [
        'event_name', 'start_date', 'end_date', "userid", "type", "idfakulty", "idkatedry", "event_place", "ishidden"
    ];

    public function tags(){
      return  $this->belongsToMany(Tag::class);
    }
}
