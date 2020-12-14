<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    public $table = "tags";
    protected $fillable = ['name', 'user_id'];
}
