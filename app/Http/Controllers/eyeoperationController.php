<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use App\eye_operation_notes;
use App\eye_op_nt_surgery_details;
use App\eye_op_nt_anesthetist_notes;
use App\Case_master;
use App\helperClass\drAppHelper;

use DB;
use Storage;

class eyeOperationController extends AdminRootController
{

    public function index(Request $request)
    {
        return view('eyeoperation.index', []);
    }

    public function edit(Request $request, $id)
    {
        $case_master  = Case_master::findOrFail($id);
        $eyeoperation = eye_operation_notes::where('case_id', $id)->first();
        if (count($eyeoperation) <= 0 ||  $eyeoperation === null || is_null($eyeoperation) || empty($eyeoperation) || !isset($eyeoperation)) {
            $eyeoperation = new eye_operation_notes();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $anesthetist_notes = $eyeoperation->eye_op_nt_anesthetist_notes()->first();
        if(count($anesthetist_notes) <= 0 ){
            $anesthetist_notes = new eye_op_nt_anesthetist_notes();
        }
        return view('eyeoperation.add', compact('case_master','eyeoperation', 'DateWiseRecordLst','anesthetist_notes'));
    }

    public function update(Request $request){

        $isEdit = true;
        $form_details = eye_operation_notes::where('case_id', $request->case_id)->first();
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new eye_operation_notes();
            $isEdit = false;
        }

        $case_master = Case_master::findOrFail($request->case_id);
        
        $case_master->mr_mrs_ms = $request->mr_mrs_ms;
        $case_master->patient_name = $request->patient_name;
        $case_master->middle_name = $request->middle_name;
        $case_master->last_name = $request->last_name;
        
        $case_master->patient_age = $request->patient_age;
        $case_master->patient_address = $request->patient_address;
        $case_master->area = $request->area;
        $case_master->city = $request->city;
        $case_master->district = $request->district;
        $case_master->male_female = $request->male_female;
        $case_master->save();

        $form_details->fill($request->all());
        $form_details->save();

        $surgeries = array();
        foreach($request->surgery_details as $surDetails){
            if (!empty($surDetails)) {
                $surgeries[] = new eye_op_nt_surgery_details([
                    'eye_op_nt_id' => $form_details->id,
                    'surgery_details' => $surDetails
                ]);
            }
            //$form_details->eye_op_nt_surgery_details()->createMany($surgeryDetails->fill($surDetails));
        }
        $form_details->eye_op_nt_surgery_details()->saveMany($surgeries);
        
        $eye_op_nt_anesthetist_notes = eye_op_nt_anesthetist_notes::where('eye_op_nt_id',$form_details->id)->first();
        if ($eye_op_nt_anesthetist_notes === null) {
            $eye_op_nt_anesthetist_notes = new eye_op_nt_anesthetist_notes();
        }
        $eye_op_nt_anesthetist_notes->fill($request->all());
        $form_details->eye_op_nt_anesthetist_notes()->save($eye_op_nt_anesthetist_notes);

        return redirect()->back()->with('flash_message', 'Record added successfully');
    }

    public function printbill($case_id){

        $case_master  = Case_master::findOrFail($case_id);
        $eyeoperation = eye_operation_notes::where('case_id', $case_id)->first();
        if (count($eyeoperation) <= 0 ||  $eyeoperation === null || is_null($eyeoperation) || empty($eyeoperation) || !isset($eyeoperation)) {
            $eyeoperation = new eye_operation_notes();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $billdata = $case_master->Bill_detail()->get();
        $anesthetist_notes = $eyeoperation->eye_op_nt_anesthetist_notes()->first();
        if(count($anesthetist_notes) <= 0 ){
            $anesthetist_notes = new eye_op_nt_anesthetist_notes();
        }
        return view('eyeoperation.print', compact('case_master','eyeoperation', 'DateWiseRecordLst', 'logoUrl', 'billdata','anesthetist_notes'));
    }

    public function deleteSurgeryDetials(Request $request, $id) {	
		$image_gallery = eye_op_nt_surgery_details::findOrFail($id);
		$image_gallery->delete();
		return "OK";
	}

}