<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class timeslot extends Model
{
    //
    public $timestamps = true;
    const CREATED_AT = 'created_dt';
    const UPDATED_AT = 'update_dt';
    protected $fillable = ['name'];
}