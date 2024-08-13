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

use App\Models\eyeOperationRecord;
use App\Case_master;
use App\discharge;
use App\helperClass\drAppHelper;
use App\Models\form_dropdowns;

use DB;
use Storage;
use App\eyeform;
use App\Models\eyeformmultipleentry;

class EyeOperationRecordController extends AdminRootController
{

    public function index(Request $request)
    {
        return view('EyeOperationRecord.index', []);
    }

    public function edit(Request $request, $id)
    {
        $case_master  = Case_master::findOrFail($id);
        $eyeOperationRecord = $case_master->eyeOperationRecord()->first();
        if ($eyeOperationRecord === null || is_null($eyeOperationRecord) || empty($eyeOperationRecord) || !isset($eyeOperationRecord)) {
            $eyeOperationRecord = new eyeOperationRecord();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
		//return $eyeOperationRecord;
        $surgeryDetails = DB::table('insurance_surgery_dropdown')->where('case_id', $case_master->id)->get()->toArray();
        $form_dropdownsEye = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();        
        $form_dropdowns = form_dropdowns::where('formName', 'EyeOperationForm')->get();
        $Dischargedata = DB::select("select * from case_master_operation_details where case_id=".$id);
        $newDischargeData = $defaultValues =[];
        
         $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();

        foreach($Dischargedata as $data) {
            $newDischargeData[$data->field_name][] = $data;
        }      
        
        $form_details = eyeform::where('case_id', $id)->first();
        if ($form_details === null) {
            $form_details = new eyeform();
        }
        
        return view('EyeOperationRecord.add', compact('case_master','eyeOperationRecord', 'DateWiseRecordLst','doctorlist', 'form_dropdowns', 'surgeryDetails','newDischargeData','form_dropdownsEye','defaultValues', 'form_details'));
    }

    public function update(Request $request) {

        $form_details = new eyeOperationRecord();
        $form_details = $form_details->updateOrCreate(['case_id'=>$request->case_id], $request->all());

        $form_details->upload_image = "";
        if ($request->hasFile('upload_image')) {
			if(isset($form_details->id) && !empty($form_details->id) && !empty($form_details->imgUrl)){
				Storage::Delete($form_details->upload_image);	
			}
            $form_details->upload_image = $request->file('upload_image')->store('uploads');
            //$form_details->update(['upload_image'=>$request->file('upload_image')->store('uploads')]);
            $form_details->save();
        }

        //echo "<pre> ============= ";print_r($request->all());exit;
        // if(isset($form_details->Date_of_Surgery) && !empty($form_details->Date_of_Surgery) && !empty($form_details->Date_of_Surgery)){
        //     $form_details->Date_of_Surgery = Carbon::createFromFormat('d/M/Y', $form_details->Date_of_Surgery)->format('Y-m-d');
        // }
		 $case_master = Case_master::findOrFail($request->case_id);
            $case_master->admission_date_time = $request->admission_date_time;
            $case_master->discharge_date_time = $request->discharge_date_time;
            $case_master->surgery_date_time = $request->surgery_date_time;
            $case_master->Surgeon = $request->Surgeon;
           // $case_master->diagnosis = $request->diagnosis;
            $case_master->referedby = $request->referedby;
            $case_master->final_diagnosis = $request->final_diagnosis;
            $case_master->discharge_sts = $request->discharge_sts;
            $case_master->uhid_no = $request->uhid;
           // $case_master->IPD_no = $request->IPD_no;
           // $case_master->classes = $request->classes;
            $case_master->save();
        if(!empty($request['Surgery'])){
            foreach($request['Surgery'] as $key => $surgery) {
                if(!empty($surgery)) {
                    $eye = isset($request['surgery_OS']) ? $request['surgery_OS'][$key] : '';
                    $sql= DB::insert("INSERT INTO `insurance_surgery_dropdown`(`case_id`,`text`, `eye_operated`) VALUES ('$request->case_id','$surgery', '$eye')");
                }
            }
        }
        /*
        if(Input::get('anaesthetistSurgeon') ) {
            $this->SingleEntrySave($request->case_id,'anaesthetistSurgeon',$request->anaesthetistSurgeon);         
        }
        if(Input::get('anaesthetistSurgeon') ) {
            $this->SingleEntrySave($request->case_id,'anesthesia',$request->anesthesia);         
        }
        */
        /*
       if(Input::get('diagnosis_od') ) {
            $this->MultipleEntrySave($request->case_id,'diagnosis',$request->diagnosis_od,$request->diagnosis_os);     
        }
        */
        /*
        if(Input::get('diagnosis_os') ) {
            $this->MultipleEntrySave($request->case_id,'diagnosis',$request->diagnosis);     
        }
        */
      /*   
        if(Input::get('anaesthetistSurgeon_OD') ) {
            $this->MultipleEntrySave($request->case_id,'anaesthetistSurgeon',$request->anaesthetistSurgeon_OD);     
        } 
        
       
        if(Input::get('anesthesia_OD') ) {
            $this->MultipleEntrySave($request->case_id,'anesthesia',$request->anesthesia_OD);     
        }  
 */
       if(Input::get('classes') ) {
            $this->MultipleEntrySave($request->case_id,'classes',$request->classes);     
        }    
       
        
        $form_details_eye = eyeform::where('case_id', $request->case_id)->first();
        if ($form_details_eye === null) {
           $form_details_eye = new eyeform();
           $form_details_eye->case_id = $request->case_id;
           $form_details_eye->save();
        }
        
        $EfMultiEntryArray = array();
        $multientryArry = array();
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'otherDetailsDiagnosis', count($request->otherDetailsDiagnosis_OD), $request->otherDetailsDiagnosis_OD, $request->otherDetailsDiagnosis_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'anaesthetistSurgeon', count($request->anaesthetistSurgeon_OD), $request->anaesthetistSurgeon_OD, $request->anaesthetistSurgeon_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'anesthesia', count($request->anesthesia_OD), $request->anesthesia_OD, $request->anesthesia_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        //dd($EfMultiEntryArray);
         $form_details_eye->eyeformmultipleentry()->saveMany($EfMultiEntryArray);
         
        return redirect()->back()->with('flash_message', 'Record added successfully');
    }
    
    public  function GetMultipleEntryArray($formId, $fieldName, $arrayLength, array $fieldArray_OD = NULL, array $fieldArray_OS = NULL, array $duration_OD = NULL, array $duration_OS = NULL) {
        $multipleEntryArray = array();
        for ($i=0; $i < $arrayLength; $i++) {
            echo "<hr>======".$arrayLength."===== : ".$fieldArray_OD[$i]."=== : ".__LINE__;// exit;
            if((!empty($fieldArray_OD[$i]) && $fieldArray_OD[$i] != 'Select') | (!empty($fieldArray_OS[$i]) && $fieldArray_OS[$i] != 'Select'))
            { 
                
//echo "<hr>======".$arrayLength."===== : ".$fieldArray_OD[$i]."=== : ".__LINE__;
                if($duration_OD && $duration_OS) {

                    //echo "<hr>=============if===========".__LINE__." : ".$fieldName; //exit;
                    $multipleEntryArray[] = new eyeformmultipleentry([
                        'eyeformid' => $formId,
                        'field_name' => $fieldName,
                        'field_value_OD' => $fieldArray_OD[$i],
                        'field_value_OS' => $fieldArray_OS[$i],
                        'duration_OD' => $duration_OD[$i],
                        'duration_OS' => $duration_OS[$i],
                    ]);
                } else {
                    //echo "<hr>============else============".__LINE__." : ".$fieldName; //exit;
                    $multipleEntryArray[] = new eyeformmultipleentry([
                        'eyeformid' => $formId,
                        'field_name' => $fieldName,
                        'field_value_OD' => $fieldArray_OD[$i],
                        'field_value_OS' => $fieldArray_OS[$i],
                    ]);
                }
            }
        }
        //dd($multipleEntryArray);
        return $multipleEntryArray;
        //$form_details->eyeformmultipleentry()->saveMany($ChiefComplaint_OD); 
    }

    function SingleEntrySave($case_id,$fieldName,$fieldValue) {
        $case_master_operation_details = DB::table('case_master_operation_details')->where('field_name', $fieldName)->where('case_id', $case_id)->first();   

        $insert_data = array(  
                'case_id'     => $case_id,    
                'field_name'  => $fieldName,
                'field_value' => $fieldValue,
            );     
        if ($case_master_operation_details === null) {
            DB::table('case_master_operation_details')->insert($insert_data);   
        }  else {
            
                DB::table('case_master_operation_details')
                ->where('field_name', $fieldName)
                ->update(['field_value' => $fieldValue]);            
        }
    }

    function MultipleEntrySave($case_id,$fieldName,$fieldArray, $fieldOsArray = []) {
        //if($fieldName == 'diagnosis') {
        //echo " ----------fieldOsArray------- <pre>";print_r($fieldOsArray);exit;
        //}
        
        //dd($fieldArray);
        
        foreach($fieldArray as $key => $val) {
            if(!empty($val)) {
                $case_master_operation_details = DB::table('case_master_operation_details')->where('field_value', $val)->where('field_name', $fieldName)->where('case_id', $case_id)->first();   

                $insert_data = array(  
                        'case_id'     => $case_id,    
                        'field_name'  => $fieldName,
                        'field_value' => $val,
                    );  
                
                if(isset($fieldOsArray[$key])) {
                    $insert_data['field_value_os'] = $fieldOsArray[$key];
                }
                
                if ($case_master_operation_details === null || $fieldName == 'diagnosis') {
                    DB::table('case_master_operation_details')->insert($insert_data);   
                } 
            }
        } 
    }

    public function printbill($case_id) {

        $case_master  = Case_master::findOrFail($case_id);
        $discharge = $case_master ->discharge()->first();
        if ($discharge === null || is_null($discharge) || empty($discharge) || !isset($discharge)) {
            $discharge = new discharge();
        }
        $eyeOperationRecord = $case_master ->eyeOperationRecord()->first();
        if ($eyeOperationRecord === null || is_null($eyeOperationRecord) || empty($eyeOperationRecord) || !isset($eyeOperationRecord)) {
            $eyeOperationRecord = new eyeOperationRecord();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $billdata = $case_master->Bill_detail()->get();
        $case_master_operation_details = DB::table('case_master_operation_details')->where('case_id', $case_master->id)->get()->toArray(); 
        $newDischargeData = [];

        foreach($case_master_operation_details as $data) {
            $newDischargeData[$data->field_name][] = $data;
        }

            $surgeryDetails = DB::table('insurance_surgery_dropdown')->where('case_id', $case_id)->get()->toArray();
        //echo "<pre>====";print_r($newDischargeData);exit;
        $surgeryQry = "SELECT *
               FROM  insurance_surgery_dropdown where case_id=".$case_master->id;
        $surgonRes = DB::select($surgeryQry);    
        
        $form_details = eyeform::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new eyeform();
        }
        
        return view('EyeOperationRecord.print', compact('case_master','discharge', 'eyeOperationRecord', 'DateWiseRecordLst', 'logoUrl', 'billdata','newDischargeData','surgonRes', 'surgeryDetails', 'form_details'));
    }

    public function viewbill($case_id){

        $case_master  = Case_master::findOrFail($case_id);
        $discharge = $case_master ->discharge()->first();
        
        //dd($discharge);
        if ($discharge === null || is_null($discharge) || empty($discharge) || !isset($discharge)) {
            $discharge = new discharge();
        }
        $eyeOperationRecord = $case_master ->eyeOperationRecord()->first();
        if ($eyeOperationRecord === null || is_null($eyeOperationRecord) || empty($eyeOperationRecord) || !isset($eyeOperationRecord)) {
            $eyeOperationRecord = new eyeOperationRecord();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $billdata = $case_master->Bill_detail()->get();
       // return $eyeOperationRecord;
        
        $Dischargedata = DB::select("select * from case_master_operation_details where case_id=".$case_id);
        $newDischargeData = $defaultValues =[];

        foreach($Dischargedata as $data) {
            $newDischargeData[$data->field_name][] = $data;
        }  
        
        $surgeryDetails = DB::table('insurance_surgery_dropdown')->where('case_id', $case_id)->get()->toArray();
        $form_details = eyeform::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new eyeform();
        }
        //dd($newDischargeData);
        return view('EyeOperationRecord.view', compact('case_master','discharge', 'eyeOperationRecord', 'DateWiseRecordLst', 'logoUrl', 'billdata','newDischargeData', 'surgeryDetails', 'form_details'));        
    }

}