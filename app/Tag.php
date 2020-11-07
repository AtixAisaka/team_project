<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 'user_id'
    ];

    public function Events(){
        return  $this->belongsToMany(Events::class);
    }
}
