<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineStock extends Model
{
    protected $table = 'medicinestock';
    public $timestamps = false;
    protected $guarded = [];

    protected $fillable = [
        'id',
        'medicine_name', 
        'Remaining_Stock_Qty', 
        'Mfg_date', 
        'Exp_date', 
        'Stock_in_date', 
        'Stock_Out_date', 
        'Cost', 
        'unit_Received', 
        'unit_issued', 
        'created_at', 
        'updated_at', 
        

    ];


}
