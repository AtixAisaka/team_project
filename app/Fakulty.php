<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fakulty extends Model
{
    public $table = "fakulty";
    protected $fillable = [
        'name',
    ];
}
