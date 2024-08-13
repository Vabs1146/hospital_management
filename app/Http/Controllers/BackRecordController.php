<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\back_record;
use DB;
use Illuminate\Support\Facades\Validator;

class BackRecordController extends Controller
{
    public function backrecord($case_id)
    {
    	$case_id=$case_id;
    	return view("back_record.backrecord",compact('case_id'));
    }

    public function savebackrecord(Request $req)
    {
		$this->validate($req, [
            'recorddata' => 'required',
            'rec_date' => 'required',
            ],
                [
            'recorddata.required' => 'Please Insert Some Data..',
            'rec_date.required' => 'Please Select Date..',
            
        ]);
     $backrecord = back_record::create($req->all());
      return redirect()->back()->with('flash_message', 'Record Added Successfully!!');
    }
    public function backrecordview($case_id)
    {
 
    $recorddate =DB::table('back_record_tbl')->where('case_id',$case_id)
                ->select('id','recorddata','case_id','rec_date')
                ->get();
    $case_id=$case_id   ;         
  
              

   return view("back_record.backrecordview",compact('recorddate','case_id'));

    }

    public function getRecordbyID($id)
    {
 
    $data=back_record::find($id);
    return $data;
  
              


    }
}
