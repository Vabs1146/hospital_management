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
use App\Medical_store;
use App\eyeform;
use App\Models\eyeformmultipleentry;
use App\timeslot;

use App\field_type_memory;
use App\field_type_data;
use App\prescription_list;
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
        
       // dd($case_master);
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
        
        //dd($form_dropdowns);

        //$discharge_appointments = DB::table('discharge_appointments')->where('case_id', $case_master->id)->get()->toArray();

        //echo "<pre> ======== ";print_r($discharge_appointments);exit;
        /*
        $doctorList = $this->doctorlist->toArray();
        $hideMenu = true;
        $doctor_id = $req->input('doctor_id');
        $timeslot = DB::select("SELECT starttime FROM `tbl_appoinment_slot` where doctor_id='$doctor_id'");
        */
        $doctorlist11 = DB::select("SELECT * FROM `doctors`");

        

       $appointment =  DB::table('discharge_appointments')->leftjoin('doctors', 'discharge_appointments.doctor_id', 'doctors.id')->select('discharge_appointments.*', 'doctors.doctor_name')->where('case_id', $case_master->id)->get()->toArray();
        $templates = DB::table('prescription_templates')->where('parent', 0)->get();
        
        $medicinlist = Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)
            ->orderBy('created_dt', 'desc');
        
       // echo "<pre> ========== ";print_r($appointment);exit;
		$defaultValues =[];
		$casedata = $case_master;
                
                /*
                $presDropdowns = [
                    'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') , 
                    'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
                    'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText') 
                ];
                */
                
                 $presDropdowns = [
                    'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
                    'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
                    'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
                    'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText'), 
                    'no_of_days' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'no_of_days')->pluck('ddText', 'ddText') 
                ];
                 
                 $getdata = $this->getCaseData($id);
                 
            foreach($getdata['prescriptions'] as $key => $val) {
                 $generic_medicine = DB::table('medical_store')->where('id',$val->generic_medicine_id)->first();
                 
                 $getdata['prescriptions'][$key]->generic_name = ($generic_medicine) ? $generic_medicine->generic_name: '';
             }
             
             $prescription_data_array = DB::table('prescription_data')->where('case_id', $id)->orderBy('prescription_id')->get();
            
            $prescription_data = [];
            foreach($prescription_data_array as $prescription_data_row) {
                $prescription_data[$prescription_data_row->prescription_id][] = $prescription_data_row;
            }
             
             //dd($getdata['prescriptions']);
             
             //dd($getdata);
             
           // $mergeArray = array_merge($getdata, $presDropdowns);
         
        $form_details = eyeform::where('case_id', $id)->first();
        if ($form_details === null) {
            $form_details = new eyeform();
        }
        
        $Dischargedata = DB::select("select * from case_master_operation_details where case_id=".$id);
        $newDischargeData = $defaultValues =[];

        foreach($Dischargedata as $data) {
            $newDischargeData[$data->field_name][] = $data;
        }
        
        $surgeryDetails = DB::table('insurance_surgery_dropdown')->where('case_id', $case_master->id)->get()->toArray();
        
       
        
        //dd($form_details->eyeformmultipleentry()->where('field_name', 'surgery')->get());
        return view('discharge.add1', compact('case_master','discharge', 'DateWiseRecordLst', 'doctorlist', 'surgeryDetails','form_dropdowns','newDischargeData','appointment','defaultValues','casedata','insurance_bill', 'templates', 'medicinlist', 'presDropdowns', 'form_details', 'newDischargeData', 'surgeryDetails', 'presDropdowns', 'getdata', 'prescription_data'));
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
    public function updateOne(Request $request) {
        //echo "<pre> =========== ";print_r($_POST);exit;
        $isEdit = true;
        $form_details = discharge::where('case_id', $request->case_id)->first();
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new discharge();
            $isEdit = false;
        }

        $case_master = Case_master::findOrFail($request->case_id);
        
        $case_master->mr_mrs_ms = $request->mr_mrs_ms;
        
        $case_master->patient_name = $request->patient_name;
        $case_master->middle_name = $request->middle_name;
        $case_master->last_name = $request->last_name;
        
        $case_master->patient_age = $request->patient_age;
        
        $case_master->patient_address = $request->patient_address;
        $case_master->area = $request->patient_area;
        $case_master->city = $request->city;
        $case_master->district = $request->district;
        
        $case_master->male_female = $request->male_female;
        $case_master->patient_mobile = $request->patient_mobile;
        $case_master->admission_date_time = $request->admission_date_time;
        $case_master->surgery_date_time = $request->surgery_date_time;
        $case_master->discharge_date_time = $request->discharge_date_time;
        $case_master->discharge_history = $request->discharge_history[0];
       // $case_master->diagnosis = $request->diagnosis;
        $case_master->Surgeon = $request->surgeon_name;
        $case_master->elective_emergency      = $request->elective_emergency;
        $case_master->admission_reason      = $request->admission_reason;
        $case_master->save();
            
        $form_fill_data = $request->all();
        
        unset($form_fill_data['investigation']);
        
        $form_details->fill($form_fill_data);
        
        //$form_details->fill($request->all());
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

        if(!empty($_POST['appointment_date'] )) {
            foreach ($_POST['appointment_date'] as $key => $value) {
                $data = array('case_id' => $_POST['case_id'], 'date' => $value);

                $qry = DB::table("discharge_appointments")->insert($data);
            }
        }
        /*
        if(Input::get('anaesthetistSurgeon') ) {
            $this->SingleEntrySave($request->case_id,'anaesthetistSurgeon',$request->anaesthetistSurgeon);         
        }
        if(Input::get('anesthesia') ) {
            $this->SingleEntrySave($request->case_id,'anesthesia',$request->anesthesia);         
        }
        */
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
        
         $form_details_eye = eyeform::where('case_id', $request->case_id)->first();
         if ($form_details_eye === null) {
            $form_details_eye = new eyeform();
            $form_details_eye->case_id = $request->case_id;
            $form_details_eye->save();
        }
        
        //========================================================================
        $case_id = $request->case_id;
        if(!empty($request['surgery_OD'])){
            foreach($request['surgery_OD'] as $key => $surgery) {
                if(!empty($surgery)) {
                    $eye = $request['surgery_OS'][$key];
                    $sql= DB::insert("INSERT INTO `insurance_surgery_dropdown`(`case_id`,`text`,`eye_operated`) VALUES ('$case_id','$surgery','$eye')");
                }
            }
        }
        ////===================================================================
       // dd($form_details_eye);
       // /*
        $EfMultiEntryArray = array();
        $multientryArry = array();
        //$multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'surgery', count($request->surgeryCount), $request->surgery_OD, $request->surgery_OS);
        //$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
       // */
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'otherDetailsDiagnosis', count($request->otherDetailsDiagnosis_OD), $request->otherDetailsDiagnosis_OD, $request->otherDetailsDiagnosis_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'investigation', count($request->investigation_od), $request->investigation_od, $request->investigation_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        //dd($EfMultiEntryArray);
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'treatmentgiven', count($request->treatmentgiven_od), $request->treatmentgiven_od, $request->treatmentgiven_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'reasonofadmission', count($request->reasonofadmission_od), $request->reasonofadmission_od, $request->reasonofadmission_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'systemicdiseases', count($request->systemicdiseases_od), $request->systemicdiseases_od, $request->systemicdiseases_od);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'surgerydetails', count($request->surgerydetails_od), $request->surgerydetails_od, $request->surgerydetails_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'surgeryvision', count($request->surgeryvision_od), $request->surgeryvision_od, $request->surgeryvision_od);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'otherDetailsAnteriorSegment', count($request->otherDetailsAnteriorSegment_OD), $request->otherDetailsAnteriorSegment_OD, $request->otherDetailsAnteriorSegment_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'otherDetailsPosteriorSegment', count($request->otherDetailsPosteriorSegment_OD), $request->otherDetailsPosteriorSegment_OD, $request->otherDetailsPosteriorSegment_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'discharge_iol_name', count($request->discharge_iol_name_od), $request->discharge_iol_name_od, $request->discharge_iol_name_od);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'followup_date_time', count($request->followup_date_time), $request->followup_date_time, $request->followup_date_time);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'anaesthetistSurgeon', count($request->anaesthetistSurgeon_OD), $request->anaesthetistSurgeon_OD, $request->anaesthetistSurgeon_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'anesthesia', count($request->anesthesia_OD), $request->anesthesia_OD, $request->anesthesia_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        //dd($EfMultiEntryArray);
         $form_details_eye->eyeformmultipleentry()->saveMany($EfMultiEntryArray);
        
//================= inser cutom data ===========================
         
       //dd($request->all());
if(isset($request->custom_values)) {
   
    foreach($request->custom_values as $key => $custom_values_names_row) {
        if($request->custom_values_od[$key] != "") {
            // dd($request->all());
            $formName = "EyeForm";
            $value= $request->custom_values_od[$key];
            $os_value = isset($request->custom_values_os[$key]) ? $request->custom_values_os[$key] : $value;
            $fieldName1 = $custom_values_names_row;

            $sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");

            $insert_id = DB::getPdo()->lastInsertId();

            $sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
            
            if(isset($request->custom_values_os[$key])) {
                 $sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$os_value','$os_value')");
                $os_id = DB::getPdo()->lastInsertId();

                $sql= DB::table('form_dropdowns')->where('id',$os_id)->update(['group_id' => $insert_id]);
            }

            $multi_options = [
                'discharge_iol' => 'discharge_iol', 
                'diagnosis_history' => 'diagnosis', 
                'systemicDiseases_history' => 'systemicDiseases', 
                'advice_history' => 'advice', 
                'surgicalStepsNotes_history' => 'surgicalStepsNotes',
                
                'surgery' => 'surgery', 
                'otherDetailsDiagnosis' => 'otherDetailsDiagnosis', 
                'investigation' => 'investigation', 
                'otherDetailsPosteriorSegment' => 'otherDetailsPosteriorSegment', 
                'treatmentgiven' => 'treatmentgiven', 
                
                'reasonofadmission' => 'reasonofadmission', 
                'systemicdiseases' => 'systemicdiseases', 
                'surgerydetails' => 'surgerydetails', 
                'surgeryvision' => 'surgeryvision', 
                'otherDetailsAnteriorSegment' => 'otherDetailsAnteriorSegment', 
                'otherDetailsPosteriorSegment' => 'otherDetailsPosteriorSegment', 
                'discharge_iol_name' => 'discharge_iol_name', 
                'followup_date_time' => 'followup_date_time', 
            ];
      /*      
      "custom_values" => array:14 [▼
    0 => "surgon_name"
    1 => "surgery"
    2 => "otherDetailsDiagnosis"
    3 => "investigation"
    4 => "treatmentgiven"
       * 
    5 => "reasonofadmission"
    6 => "systemicdiseases"
    7 => "surgerydetails"
    8 => "anaesthetistSurgeon"
    9 => "anesthesia"
    10 => "surgeryvision"
    11 => "otherDetailsAnteriorSegment"
    12 => "otherDetailsPosteriorSegment"
    13 => "discharge_iol_name"
  ]
  "custom_values_od" => array:14 [▼
    0 => "11"
    1 => "22"
    2 => "33"
    3 => "55"
    4 => "66"
    5 => "8"
    6 => "110"
    7 => "121"
    8 => "124"
    9 => "125"
    10 => "126"
    11 => "128"
    12 => "130"
    13 => "12332"
  ]
  "custom_values_os" => array:14 [▼
    0 => null
    1 => "both"
    2 => "44"
    3 => null
    4 => "77"
    5 => "99"
    6 => null
    7 => "123"
    8 => null
    9 => null
    10 => "127"
    11 => "129"
    12 => "131"
    13 => null
  ]
*/
            if(in_array($custom_values_names_row, ['anaesthetistSurgeon', 'anesthesia'])) {
                $this->SingleEntrySave($request->case_id,$custom_values_names_row,$value);
            } else if(isset($multi_options[$custom_values_names_row])) {

               // echo "<hr>". $custom_values_names_row.' = '.$multi_options[$custom_values_names_row]; exit;

                //$this->MultipleEntrySave($request->case_id, $multi_options[$custom_values_names_row], [$value]); 
                
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, $custom_values_names_row, 1, [$value], [$os_value]);
        
        //dd($EfMultiEntryArray);
         $form_details_eye->eyeformmultipleentry()->saveMany($multientryArry);

            } else if($custom_values_names_row == "surgery"){
                $sql= DB::insert("INSERT INTO `insurance_surgery_dropdown`(`case_id`,`text`) VALUES ('$request->case_id','$value')");
            }
            
        }
    }
}
        return redirect()->back()->with('flash_message', 'Record added successfully');
    }
    
    public  function GetMultipleEntryArray($formId, $fieldName, $arrayLength, array $fieldArray_OD = NULL, array $fieldArray_OS = NULL, array $duration_OD = NULL, array $duration_OS = NULL){
        $multipleEntryArray = array();
        for ($i=0; $i < $arrayLength; $i++) {
            //echo "<hr>======".$arrayLength."===== : ".$fieldArray_OD[$i]."=== : ".__LINE__;// exit;
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

    public function printbill($case_id) {

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

    public function printbillOne($case_id) {

        $case_master  = Case_master::findOrFail($case_id);
        $discharge = $case_master ->discharge()->first();
        if ($discharge === null || is_null($discharge) || empty($discharge) || !isset($discharge)) {
            $discharge = new discharge();
        }
        $appointment =  DB::table('discharge_appointments')->leftjoin('doctors', 'discharge_appointments.doctor_id', 'doctors.id')->select('discharge_appointments.*', 'doctors.doctor_name')->where('case_id', $case_master->id)->get()->toArray();

        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();


        $surgeon_name =  DB::table('discharge')->join('doctors', 'discharge.surgeon_name', 'doctors.id')->where('doctors.id', $discharge->surgeon_name)->select('discharge.*', 'doctors.doctor_name')->first();

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
        
        $form_details = eyeform::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new eyeform();
        }
        $surgeryDetails = DB::table('insurance_surgery_dropdown')->where('case_id', $case_master->id)->get()->toArray();
        
        $prescription_data_array = DB::table('prescription_data')->where('case_id', $case_id)->orderBy('prescription_id')->get();
            
        foreach($prescription_data_array as $prescription_data_row) {
            $prescription_data[$prescription_data_row->prescription_id][] = $prescription_data_row;
        }
        
        return view('discharge.print1', compact('insurance_bill','case_master','discharge', 'DateWiseRecordLst', 'logoUrl', 'billdata', 'prescriptions','newDischargeData','surgeon_name','surgonRes','appointment', 'form_details', 'surgeryDetails', 'prescription_data'));
    }
    
     public function getCaseData($id)
    {

        $case_master = Case_master::findOrFail($id);
        
        //dd($case_master);

        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')
            ->pluck('doctor_name', 'id');
        $timeslot = timeslot::where('isActive', 1)->orderBy('id')
            ->pluck('name', 'id');
        $medicinlist = Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)
            ->orderBy('created_dt', 'desc')
            ->get();
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)
            ->where('is_deleted', '0')
            ->orderBy('created_at', 'asc')
            ->select('id', 'created_at')
            ->get();
        $field_type_memory = field_type_memory::get();
        $field_type_data = field_type_data::where('case_id', $case_master->id)
            ->get();
        $casedata = [
            'id' => $case_master->id, 
            'doctorlist' => $doctorlist, 
            'timeslot' => $timeslot, 
            'medicinlist' => $medicinlist, 
            'prescriptions' => prescription_list::where('case_id', $case_master->id)->get(), 
            'DateWiseRecordLst' => $DateWiseRecordLst, 
            'case_number' => $case_master->case_number, //'p_00000001'
            'patient_name' => $case_master->patient_name, 
            'middle_name' => $case_master->middle_name, 
            'last_name' => $case_master->last_name, 
            'mr_mrs_ms' => $case_master->mr_mrs_ms, 
            'doctor_id' => $case_master->doctor_id, 
            'patient_age' => $case_master->patient_age, 
            'patient_weight' => $case_master->patient_weight, 
            'patient_height' => $case_master->patient_height, 
            'patient_address' => $case_master->patient_address, 
            'patient_emailId' => $case_master->patient_emailId, 
            'patient_mobile' => $case_master->patient_mobile, 
            'male_female' => $case_master->male_female, 
            'complaint' => $case_master->complaint, 
            'diagnosis' => $case_master->diagnosis, 
            'treatment' => $case_master->treatment, 
            'diagnosis_file' => $case_master->diagnosis_filePath, 
            'appointment_dt' => ($case_master->FollowUpDate != null) ? Carbon::createFromFormat('Y-m-d', $case_master->FollowUpDate)->format('d/M/Y') : null, 
            'appointment_timeslot' => $case_master->FollowUpTimeSlot, 
            'FollowUpDoctor_id' => $case_master->FollowUpDoctor_Id, 
            'Reports_file' => $case_master->Report_file()->get(),
            'Before_file' => $case_master->BeforeImagePath, 
            'After_file' => $case_master->AfterImagePath, 
            'field_type_memory' => $field_type_memory, 
            'field_type_data' => $field_type_data
        ];
        return $casedata;
    }

}

