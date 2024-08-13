<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
   protected $table = 'tbl_events';
   protected $fillable = ['title','start_date','end_date'];
}
