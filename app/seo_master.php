<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class seo_master extends Model
{
    //
     protected $guarded = ['id'];
	 public $timestamps = true;
	 protected $fillable = [ 
                'url',
                'meta_title',
                'meta_desc',
                'meta_key',
                'status',               
                'created_by',
                'modification_by'
                ];

}
