<?php

namespace App\Models;;

use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    protected $table = 'rating';
    public $timestamps = true;
    protected $fillable = ['username','mobileno','userimage','feedback', 'ratingscore', 'isActive', 'created_at', 'updated_at'];
     protected $guarded = ['id'];
}
