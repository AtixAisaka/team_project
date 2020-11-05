<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Katedry extends Model
{
    public $table = "katedry";
    protected $fillable = [
        'name',
    ];
}
