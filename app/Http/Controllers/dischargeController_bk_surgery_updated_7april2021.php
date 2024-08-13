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

use App\discharge;
use App\Case_master;
use App\helperClass\drAppHelper;

use DB;
use Storage;
use App\doctor;
use App\Models\form_dropdowns;
use App\insurance_bill;
use App\eyeform;
use App\Models\eyeformmultipleentry;

class dischargeController extends AdminRootController
{

    public function index(Request $request)
    {
        return view('discharge.index', []);
    }

    public function edit(Request $request, $id)
    {
        $case_master  = Case_master::findOrFail($id);
        $discharge = $case_master ->discharge()->first();
        if ($discharge === null || is_null($discharge) || empty($discharge) || !isset($discharge)) {
            $discharge = new discharge();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        return view('discharge.add', compact('case_master','discharge', 'DateWiseRecordLst'));
    }

    public function editOne(Request $request, $id)
    {
        $case_master  = Case_master::findOrFail($id);
        $discharge = $case_master ->discharge()->first();
        $insurance_bill = $case_master ->insurance_bill()->first();
        if ($insurance_bill === null || is_null($insurance_bill) || empty($insurance_bill) || !isset($insurance_bill)) {
            $insurance_bill = new insurance_bill();
        }
        if ($discharge === null || is_null($discharge) || empty($discharge) || !isset($discharge)) {
            $discharge = new discharge();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        
        $Dischargedata = DB::select("select * from case_master_operation_details where case_id=".$request->case_id);
        $newDischargeData = [];

        foreach($Dischargedata as $data) {
            $newDischargeData[$data->field_name][] = $data;
        }
      //echo "<pre> ================= ";print_r($newDischargeData);exit;
        /*
        echo "============>>>>>>>> <pre>"; 
        print_r($DateWiseRecordLst); 
        print_r($case_master); 
        print_r($discharge); 
        exit;
        */
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        //dd($doctorlist);

        $surgeryDetails = DB::table('insurance_surgery_dropdown')->where('case_id', $case_master->id)->get()->toArray();
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();

        //$discharge_appointments = DB::table('discharge_appointments')->where('case_id', $case_master->id)->get()->toArray();

        //echo "<pre> ======== ";print_r($discharge_appointments);exit;
        /*
        $doctorList = $this->doctorlist->toArray();
        $hideMenu = true;
        $doctor_id = $req->input('doctor_id');
        $timeslot = DB::select("SELECT starttime FROM `tbl_appoinment_slot` where doctor_id='$doctor_id'");
        */
        $doctorlist11 = DB::select("SELECT * FROM `doctors`");

        $form_details = eyeform::where('case_id', $case_master->id)->first();
		 if ($form_details === null) {
            $form_details = new eyeform();
        } 
		
		$defaultValues =[];
		foreach($form_details->toArray() as $key => $form_details_row) {
           $defaultValues[$key] = $form_details_row;
        }

		//echo "<pre> ========== ";print_r($form_details);exit;

       $appointment =  DB::table('discharge_appointments')->leftjoin('doctors', 'discharge_appointments.doctor_id', 'doctors.id')->select('discharge_appointments.*', 'doctors.doctor_name')->where('case_id', $case_master->id)->get()->toArray();
       // echo "<pre> ========== ";print_r($appointment);exit;
		
		$casedata = $case_master;
        return view('discharge.add1', compact('case_master','discharge', 'DateWiseRecordLst', 'doctorlist', 'surgeryDetails','form_dropdowns','newDischargeData','appointment','defaultValues','casedata','insurance_bill','form_details'));
    }

    public  function adddischargeAppointment(Request $request) {
       // echo "<pre> ========== ";print_r($_POST);exit;

        foreach ($_POST['appointment_doctor'] as $key => $value) {
            $data = array('case_id' => $_POST['case_id'], 'doctor_id' => $_POST['appointment_doctor_id'], 'date' => $_POST['appointment_date'][$key], 'time' => $_POST['appointment_time'][$key]);

            $qry = DB::table("discharge_appointments")->insert($data);
        }
        return redirect()->back()->with('flash_message', ' Record added successfully');
    }

    public  function dischargedeleteField(Request $request) {

        $id = $request->id;

            DB::table('case_master_operation_details')
              ->where('id', $id)
              ->delete();   
        /*return redirect()
            ->back()
            ->withInput()
            ->with('flash_message', 'Record deleted successfully'); */
      }

    public  function deleteAppointment(Request $request) {
        $id = $request->id;
        DB::table('discharge_appointments')
        ->where('id', $id)
        ->delete();         
      /*  return redirect()
            ->back()
            ->withInput()
            ->with('flash_message', 'Record deleted successfully');  */
        
    }

    public function update(Request $request){

        $isEdit = true;
        $form_details = discharge::where('case_id', $request->case_id)->first();
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new discharge();
            $isEdit = false;
        }



        $case_master                          = Case_master::findOrFail($request->case_id);
        $case_master->patient_name            = $request->patient_name;
        $case_master->patient_age             = $request->patient_age;
        $case_master->patient_address         = $request->patient_address;
        $case_master->male_female             = $request->male_female;
        $case_master->admission_date_time     = $request->admission_date_time;
        $case_master->surgery_date_time       = $request->surgery_date_time;
        $case_master->discharge_date_time     = $request->discharge_date_time;
        $case_master->diagnosis               = $request->diagnosis;
        $case_master->Surgeon                 = $request->surgeon_name;
        $case_master->save();

        $form_details->fill($request->all());
        $form_details->save();
        
        $dischargeimg = $request->file('dischargeimg');
     if ($request->hasFile('dischargeimg')) {
        $image = $request->file('dischargeimg');


        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'discharge_img/';
        $image->move($destinationPath, $name);

        //$path = url('/gallery_image/'.$name);
    
        $id=$request->case_id;
        DB::insert("UPDATE `discharge` SET `dischargeimg`='$name' WHERE case_id='$id'");
               
    } 

        return redirect()->back()->with('flash_message', ' Record added successfully');
    }
    public function updateOne(Request $request){
        //echo "<pre> =========== ";print_r($_POST);exit;
        $isEdit = true;
        $form_details = discharge::where('case_id', $request->case_id)->first();
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new discharge();
            $isEdit = false;
        }

        $case_master = Case_master::findOrFail($request->case_id);
        $case_master->patient_name = $request->patient_name;
        $case_master->patient_age = $request->patient_age;
        $case_master->patient_address = $request->patient_address;
        $case_master->male_female = $request->male_female;
        $case_master->patient_mobile = $request->patient_mobile;
        $case_master->admission_date_time = $request->admission_date_time;
        $case_master->surgery_date_time = $request->surgery_date_time;
        $case_master->discharge_date_time = $request->discharge_date_time;
       // $case_master->diagnosis = $request->diagnosis;
        $case_master->Surgeon = $request->surgeon_name;
        $case_master->elective_emergency      = $request->elective_emergency;
        $case_master->admission_reason      = $request->admission_reason;
        $case_master->save();

        $form_details->fill($request->all());
        $form_details->save();

        $dischargeimg = $request->file('dischargeimg');
     if ($request->hasFile('dischargeimg')) {
        $image = $request->file('dischargeimg');


        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'discharge_img/';
        $image->move($destinationPath, $name);

        //$path = url('/gallery_image/'.$name);
    
        $id=$request->case_id;
            DB::insert("UPDATE `discharge` SET `dischargeimg`='$name' WHERE case_id='$id'");

               
        }

        if(!empty($request['Surgery'])){
            foreach($request['Surgery'] as $surgery) {
                if(!empty($surgery)) {
                    $sql= DB::insert("INSERT INTO `insurance_surgery_dropdown`(`case_id`,`text`) VALUES ('$request->case_id','$surgery')");
                }
            }
        }
		
		$eyeform = eyeform::where('case_id', $request->case_id)->first();

		$multientryArry = array();
		$multientryArry = $this->GetMultipleEntryArray($eyeform->id, 'surgery', count($request->surgeryCount), $request->surgery, $request->surgery);
		
		$eyeform->eyeformmultipleentry()->saveMany($multientryArry);

        if(!empty($_POST['appointment_date'] )) {
            foreach ($_POST['appointment_date'] as $key => $value) {
                $data = array('case_id' => $_POST['case_id'], 'date' => $value);

                $qry = DB::table("discharge_appointments")->insert($data);
            }
        }

        if(Input::get('anaesthetistSurgeon') ) {
            $this->SingleEntrySave($request->case_id,'anaesthetistSurgeon',$request->anaesthetistSurgeon);         
        }
        if(Input::get('anaesthetistSurgeon') ) {
            $this->SingleEntrySave($request->case_id,'anesthesia',$request->anesthesia);         
        }
       if(Input::get('discharge_iol') ) {
            $this->MultipleEntrySave($request->case_id,'discharge_iol',$request->discharge_iol);     
        }
       if(Input::get('diagnosis') ) {
            $this->MultipleEntrySave($request->case_id,'diagnosis',$request->diagnosis);     
        }
       if(Input::get('systemicDiseases') ) {
            $this->MultipleEntrySave($request->case_id,'systemicDiseases',$request->systemicDiseases);     
        }        
       if(Input::get('operationNotes') ) {
            $this->MultipleEntrySave($request->case_id,'operationNotes',$request->operationNotes);     
        } 
       if(Input::get('advice') ) {
            $this->MultipleEntrySave($request->case_id,'advice',$request->advice);     
        }  
       if(Input::get('surgicalStepsNotes') ) {
            $this->MultipleEntrySave($request->case_id,'surgicalStepsNotes',$request->surgicalStepsNotes);     
        }        
              
        return redirect()->back()->with('flash_message', 'Record added successfully');
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

    function MultipleEntrySave($case_id,$fieldName,$fieldArray) {
        //echo " ----------------- <pre>";print_r($fieldArray);exit;
        
        foreach($fieldArray as $val) {
            if(!empty($val)) {
                $case_master_operation_details = DB::table('case_master_operation_details')->where('field_value', $val)->where('field_name', $fieldName)->where('case_id', $case_id)->first();   

                $insert_data = array(  
                        'case_id'     => $case_id,    
                        'field_name'  => $fieldName,
                        'field_value' => $val,
                    );     
                if ($case_master_operation_details === null) {
                    DB::table('case_master_operation_details')->insert($insert_data);   
                } 
            }
        } 
    }

    public function printbill($case_id){

        $case_master  = Case_master::findOrFail($case_id);
        $discharge = $case_master ->discharge()->first();
        if ($discharge === null || is_null($discharge) || empty($discharge) || !isset($discharge)) {
            $discharge = new discharge();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $billdata = $case_master->Bill_detail()->get();


        return view('discharge.print', compact('case_master','discharge', 'DateWiseRecordLst', 'logoUrl', 'billdata', 'insurance_bill'));
    }

    public function printbillOne($case_id){

        $case_master  = Case_master::findOrFail($case_id);
        $discharge = $case_master ->discharge()->first();
        if ($discharge === null || is_null($discharge) || empty($discharge) || !isset($discharge)) {
            $discharge = new discharge();
        }
        $appointment =  DB::table('discharge_appointments')->leftjoin('doctors', 'discharge_appointments.doctor_id', 'doctors.id')->select('discharge_appointments.*', 'doctors.doctor_name')->where('case_id', $case_master->id)->get()->toArray();

        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();


        $surgeon_name =  DB::table('discharge')->join('doctors', 'discharge.surgeon_name', 'doctors.id')->select('discharge.*', 'doctors.doctor_name')->first();

        //echo "   ++++++++++++ <pre> ";print_r($surgeon_name);exit;

        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $billdata = $case_master->Bill_detail()->get();
        $prescriptions = \App\prescription_list::where('case_id', $case_master->id)->get();

        $case_master_operation_details = DB::table('case_master_operation_details')->where('case_id', $case_master->id)->get()->toArray(); 
        $newDischargeData = [];

        foreach($case_master_operation_details as $data) {
            $newDischargeData[$data->field_name][] = $data;
        }

        //echo "<pre>====";print_r($newDischargeData);exit;
        $surgeryQry = "SELECT *
               FROM  insurance_surgery_dropdown where case_id=".$case_master->id;
        $surgonRes = DB::select($surgeryQry);
        //echo "<pre>====";print_r($surgonRes);exit;
        //$surgery = isset($surgonRes[0]) ? $surgonRes[0]->text : '-';
        $insurance_bill = $case_master ->insurance_bill()->first();
        if ($insurance_bill === null || is_null($insurance_bill) || empty($insurance_bill) || !isset($insurance_bill)) {
            $insurance_bill = new insurance_bill();
        }
        return view('discharge.print1', compact('insurance_bill','case_master','discharge', 'DateWiseRecordLst', 'logoUrl', 'billdata', 'prescriptions','newDischargeData','surgeon_name','surgonRes','appointment'));
    }

	public  function GetMultipleEntryArray($formId, $fieldName, $arrayLength, array $fieldArray_OD = NULL, array $fieldArray_OS = NULL, array $duration_OD = NULL, array $duration_OS = NULL){
        $multipleEntryArray = array();
        for ($i=0; $i < $arrayLength; $i++) {
            if((!empty($fieldArray_OD[$i]) && $fieldArray_OD[$i] != 'Select') | (!empty($fieldArray_OS[$i]) && $fieldArray_OS[$i] != 'Select'))
            { 
                

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
        return $multipleEntryArray;
        //$form_details->eyeformmultipleentry()->saveMany($ChiefComplaint_OD); 
    }

}

