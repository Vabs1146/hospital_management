<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class skin extends Model
{
    protected $table = 'skin';
    public $timestamps = true;    //

    public function getFollowUpDateAttribute($value)
    {
       // return ($value != null)? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/M/Y'): null;
    }
    public function setFollowUpDateAttribute($value)
    {
        $this->attributes['FollowUpDate'] = $value;
        if(!empty($value) && !is_null($value)){
           // $this->attributes['FollowUpDate'] = Carbon::createFromFormat('d/M/Y', $value)->format('Y-m-d H:i:s');
        }
    }

    protected $fillable = [
        'id',
        'case_id',
        'odp',
        'PalmSole',
        'GenitalArea',
        'OralMucosa',
        'Nails',
        'SpecialComment',
        'BeforeImagePath',
        'AfterImagePath',
        'FollowUpDate',
        'FollowUpTime',
        'casePaperImage'
    ];
}