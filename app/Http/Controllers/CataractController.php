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

class CataractController extends AdminRootController
{
    public function listing(Request $request) {
        return view('cataract.listing', []);
    }
    public function cataract_consent_listing(Request $request) {
        return view('cataract.cataract_consent_listing', []);
    }
    public function cataract_surgery_listing(Request $request) {
        return view('cataract.cataract_surgery_listing', []);
    }
    public function covid_consent_listing(Request $request) {
        return view('cataract.covid_consent_listing', []);
    }
    
    
    public function index(Request $request)
    {
        return view('cataract.index', []);
    }
    

    public function editOne(Request $request, $id) {
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
                
        
                $presDropdowns = ['numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')
                ->pluck('ddText', 'ddText') , 'quantity' => form_dropdowns::where('formName', 'Prescription')
                ->where('fieldName', 'Quantity')
                ->pluck('ddText', 'ddText') , 'medicine_strength' => form_dropdowns::where('formName', 'Prescription')
                ->where('fieldName', 'Strength')
                ->pluck('ddText', 'ddText') ];
           // $casedata = array_merge($casedata, $presDropdowns);
         
        $form_details = eyeform::where('case_id', $id)->first();
        if ($form_details === null) {
            $form_details = new eyeform();
        }
        
        $Dischargedata = DB::select("select * from case_master_operation_details where case_id=".$id);
        $newDischargeData = $defaultValues =[];

        foreach($Dischargedata as $data) {
            $newDischargeData[$data->field_name][] = $data;
        }
        
        $procedure_array = array(
            'section' => 'Section', 
            'site' => 'Site',
            'size_of_wound' => 'Size Of Wound ',
            'side_ports' => 'No of Side Ports',
            'acm' => 'ACM',
            'ccc' => 'C C C',
            'intra_cameral' => 'Intra cameral',
            'hydrodissect' => 'Hydrodissect',
            'hyrodelamination' => 'Hyrodelamination',
            'phacoemulisification' => 'Phacoemulisification',
            'sics' => 'SICS');
        
        $procedure_array2 = array(
            'iol' => 'IOL',
            'iol_type' => 'IOL Type',
            'stromal_hydration' => 'Stromal Hydration');
        
        $procedure_array3 = array(
            'intra_operative_event' => 'Intra Operative Event');
        
        $checkbox_array = array(
            'divide_conquer' => 'Divide & Conquer',
            'stop_chop' => 'Stop & Chop',
            'direct_chop' => 'Direct Chop',
            'phaco_aspiration' => 'Phaco Aspiration'
        );
        
        $custom_templates = DB::table('procedure_template')->where('status', '1')->get();
        
       //dd($case_master);
        //dd($form_details->eyeformmultipleentry()->where('field_name', 'surgery')->get());
        return view('cataract.add1', compact('case_master','discharge', 'DateWiseRecordLst', 'doctorlist', 'surgeryDetails','form_dropdowns','newDischargeData','appointment','defaultValues','casedata','insurance_bill', 'templates', 'medicinlist', 'presDropdowns', 'form_details', 'newDischargeData', 'procedure_array', 'procedure_array2', 'procedure_array3', 'checkbox_array', 'custom_templates'));
    }
    
    public function printCataract(Request $request, $id) {
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
                
        
                $presDropdowns = ['numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')
                ->pluck('ddText', 'ddText') , 'quantity' => form_dropdowns::where('formName', 'Prescription')
                ->where('fieldName', 'Quantity')
                ->pluck('ddText', 'ddText') , 'medicine_strength' => form_dropdowns::where('formName', 'Prescription')
                ->where('fieldName', 'Strength')
                ->pluck('ddText', 'ddText') ];
           // $casedata = array_merge($casedata, $presDropdowns);
         
        $form_details = eyeform::where('case_id', $id)->first();
        if ($form_details === null) {
            $form_details = new eyeform();
        }
        
        $Dischargedata = DB::select("select * from case_master_operation_details where case_id=".$id);
        $newDischargeData = $defaultValues =[];

        foreach($Dischargedata as $data) {
            $newDischargeData[$data->field_name][] = $data;
        }
        
        $procedure_array = array(
            'section' => 'Section', 
            'site' => 'Site',
            'side_ports' => 'No of Side Ports',
            'acm' => 'ACM',
            'ccc' => 'C C C',
            'intra_cameral' => 'Intra cameral',
            'hydrodissect' => 'Hydrodissect',
            'hyrodelamination' => 'Hyrodelamination');
        
        $procedure_array2 = array(
            'iol' => 'IOL',
            'iol_type' => 'IOL Type',
            'stromal_hydration' => 'Stromal Hydration');
        
        $procedure_array3 = array(
            'intra_operative_event' => 'Intra Operative Event');
        
        $checkbox_array = array(
            'divide_conquer' => 'Divide & Conquer',
            'stop_chop' => 'Stop & Chop',
            'direct_chop' => 'Direct Chop',
            'phaco_aspiration' => 'Phaco Aspiration'
        );
        //dd($form_details->eyeformmultipleentry()->where('field_name', 'surgery')->get());
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('cataract.print1', compact('case_master','discharge', 'DateWiseRecordLst', 'doctorlist', 'surgeryDetails','form_dropdowns','newDischargeData','appointment','defaultValues','casedata','insurance_bill', 'templates', 'medicinlist', 'presDropdowns', 'form_details', 'newDischargeData', 'procedure_array', 'procedure_array2', 'procedure_array3', 'checkbox_array', 'logoUrl'));
    }
    
    public function printbillOne1($case_id) {

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
        
        $form_details = eyeform::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new eyeform();
        }
        
        return view('cataract.print1', compact('insurance_bill','case_master','discharge', 'DateWiseRecordLst', 'logoUrl', 'billdata', 'prescriptions','newDischargeData','surgeon_name','surgonRes','appointment', 'form_details'));
    }
    
    
    
    public function edit_cataract_consent(Request $request, $id) {
        $case_master  = Case_master::findOrFail($id);
        return view('cataract.edit_cataract_consent',compact('case_master'));
    }    
    public function edit_cataract_surgery(Request $request, $id) {
        $case_master  = Case_master::findOrFail($id);
        return view('cataract.edit_cataract_surgery',compact('case_master'));
    }    
    public function edit_covid_consent(Request $request, $id) {
        $case_master  = Case_master::findOrFail($id);
        $consent_record = DB::table('covid_consent_form')->where('case_id', $request->case_id)->first();
        return view('cataract.edit_covid_consent',compact('case_master', 'consent_record'));
    }
    
    
    public function update_cataract_consent(Request $request, $id) {
        $case_master  = Case_master::findOrFail($id);
        return view('cataract.edit_cataract_consent',compact('case_master'));
    }    
    public function update_cataract_surgery(Request $request, $id) {
        $case_master  = Case_master::findOrFail($id);
        return view('cataract.edit_cataract_surgery',compact('case_master'));
    }    
    public function update_covid_consent(Request $request, $id) {
        
        //echo "<pre> =========== ";print_r($_POST);exit;
        
        $case_master = Case_master::findOrFail($request->case_id);
        $case_master->patient_name = $request->patient_name;
        $case_master->patient_address = $request->patient_address;
        //$case_master->male_female = $request->male_female;
        $case_master->patient_mobile = $request->patient_mobile;
        //$case_master->admission_date_time = $request->admission_date_time;
        //$case_master->surgery_date_time = $request->surgery_date_time;
        //$case_master->discharge_date_time = $request->discharge_date_time;
        //$case_master->discharge_history = $request->discharge_history;
       // $case_master->diagnosis = $request->diagnosis;
        //$case_master->Surgeon = $request->surgeon_name;
        //$case_master->elective_emergency      = $request->elective_emergency;
        //$case_master->admission_reason      = $request->admission_reason;
        $case_master->save();

        
        /*
        [case_id] => 2342
    [patient_name] => Deepak Ramsakha edited
    [consent_date] => 2021-08-18
    [patient_address] => Nashik
    [patient_mobile] => 8329730842
    [name_of_attendant] => Suresh Ramsakha
    [attendant_signature_date] => 2021-08-29
    [name_of_doctor] => Doctor hiii
      */  
        $consent_record = DB::table('covid_consent_form')->where('case_id', $request->case_id)->first();
        
        //dd($consent_record); 
        
        $consent_form_data = array(
            'case_id' => $request->case_id,
            'consent_date' => date('Y-m-d', strtotime($request->consent_date)),
            'name_of_attendant' => $request->name_of_attendant,
            'attendant_signature_date' => date('Y-m-d', strtotime($request->attendant_signature_date)),
            'name_of_doctor' => $request->name_of_doctor
        );
        if($consent_record) {
            DB::table('covid_consent_form')
                ->where('case_id', $request->case_id)
                ->update($consent_form_data);
        } else {
             DB::table('covid_consent_form')
                ->insert($consent_form_data);
        }
            
//================= inser cutom data ===========================

       return redirect()->back()->with('flash_message', 'Record updated successfully');
    
    }
    
    public function print_cataract_consent($case_id) {
        $case_master  = Case_master::findOrFail($case_id);
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('cataract.print.print_cataract_consent', compact('case_master', 'logoUrl'));
    }
    public function print_cataract_surgery($case_id) {
        $case_master  = Case_master::findOrFail($case_id);
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('cataract.print.print_cataract_surgery', compact('case_master', 'logoUrl'));
    }
    public function print_covid_consent($case_id) {
        $case_master  = Case_master::findOrFail($case_id);
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $consent_record = DB::table('covid_consent_form')->where('case_id', $case_id)->first();
        return view('cataract.print.print_covid_consent', compact('case_master', 'logoUrl', 'consent_record'));
    }
    //======================================================================================================================================

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
    
    
    public function update_cataract(Request $request) {
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
        //$case_master->patient_address = $request->patient_address;
        $case_master->male_female = $request->male_female;
        //$case_master->patient_mobile = $request->patient_mobile;
        //$case_master->admission_date_time = $request->admission_date_time;
        $case_master->surgery_date_time = $request->surgery_date_time;
        $case_master->surgery_complete_date_time = $request->surgery_complete_date_time;
        //$case_master->discharge_date_time = $request->discharge_date_time;
        //$case_master->discharge_history = $request->discharge_history;
       // $case_master->diagnosis = $request->diagnosis;
        $case_master->Surgeon = $request->surgeon_name;
        //$case_master->elective_emergency      = $request->elective_emergency;
        //$case_master->admission_reason      = $request->admission_reason;
        $case_master->save();
        
        if(Input::get('anaesthetistSurgeon') ) {
            $this->SingleEntrySave($request->case_id,'anaesthetistSurgeon',$request->anaesthetistSurgeon);         
        }
        if(Input::get('anesthesia') ) {
            $this->SingleEntrySave($request->case_id,'anesthesia',$request->anesthesia);         
        }
        
        /*
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

        if(!empty($_POST['appointment_date'] )) {
            foreach ($_POST['appointment_date'] as $key => $value) {
                $data = array('case_id' => $_POST['case_id'], 'date' => $value);

                $qry = DB::table("discharge_appointments")->insert($data);
            }
        }

        if(Input::get('anaesthetistSurgeon') ) {
            $this->SingleEntrySave($request->case_id,'anaesthetistSurgeon',$request->anaesthetistSurgeon);         
        }
        if(Input::get('anesthesia') ) {
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
        
         
        */
       // dd($form_details_eye);
       // /*
        
        $form_details_eye = eyeform::where('case_id', $request->case_id)->first();
         if ($form_details_eye === null) {
            $form_details_eye = new eyeform();
            $form_details_eye->case_id = $request->case_id;
            $form_details_eye->save();
        }
        
        
       
        
    if($request->custom_type == "template" && $request->select_template != "") {
        
        $procedure_array = array(
            'section' => 'Section', 
            'site' => 'Site',
            'size_of_wound' => 'Size Of Wound ',
            'side_ports' => 'No of Side Ports',
            'acm' => 'ACM',
            'ccc' => 'C C C',
            'intra_cameral' => 'Intra cameral',
            'hydrodissect' => 'Hydrodissect',
            'hyrodelamination' => 'Hyrodelamination',
            'phacoemulisification' => 'Phacoemulisification',
            'sics' => 'SICS');
        
        $procedure_array2 = array(
            'iol' => 'IOL',
            'iol_type' => 'IOL Type',
            'stromal_hydration' => 'Stromal Hydration');
        
        $procedure_array3 = array(
            'intra_operative_event' => 'Intra Operative Event');
        
        $merged_array = array_merge($procedure_array, $procedure_array2, $procedure_array3);
        
        foreach($merged_array as $merged_array_key => $merged_array_val) {
            DB::table('eyeformmultipleentry')->where('eyeformid', $form_details_eye->id)->where('field_name', $merged_array_key)->delete();
        }
    }
        $EfMultiEntryArray = array();
        $multientryArry = array();
        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'otherDetailsDiagnosis', count($request->otherDetailsDiagnosis_OD), $request->otherDetailsDiagnosis_OD, $request->otherDetailsDiagnosis_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'surgery', count($request->surgeryCount), $request->surgery_OD, $request->surgery_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        
        //------------------------------------------------------------------
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'section', count($request->section), $request->section_OD, $request->section_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'site', count($request->site), $request->site_OD, $request->section_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'size_of_wound', count($request->size_of_wound_OD), $request->size_of_wound_OD, $request->size_of_wound_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'side_ports', count($request->side_ports_OD), $request->side_ports_OD, $request->side_ports_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'acm', count($request->acm), $request->acm_OD, $request->acm_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'ccc', count($request->ccc), $request->ccc_OD, $request->ccc_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'intra_cameral', count($request->intra_cameral), $request->intra_cameral_OD, $request->intra_cameral_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'hydrodissect', count($request->hydrodissect), $request->hydrodissect_OD, $request->hydrodissect_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'hyrodelamination', count($request->hyrodelamination), $request->hyrodelamination_OD, $request->hyrodelamination_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'phacoemulisification', count($request->phacoemulisification_OD), $request->phacoemulisification_OD, $request->phacoemulisification_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'sics', count($request->sics_OD), $request->sics_OD, $request->sics_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        
         DB::table('eyeformmultipleentry')->where('eyeformid', $form_details_eye->id)->where('field_name', 'procedure_checkboxes')->delete();
         
        if(isset($request->procedure_checkboxes)) {
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'procedure_checkboxes', 1, [implode(',',$request->procedure_checkboxes)], [implode(',',$request->procedure_checkboxes)]);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        }
       
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'iol', count($request->iol), $request->iol_OD, $request->iol_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'iol_type', count($request->iol_type), $request->iol_type_OD, $request->iol_type_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'stromal_hydration', count($request->stromal_hydration), $request->stromal_hydration_OD, $request->stromal_hydration_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        
        DB::table('eyeformmultipleentry')->where('eyeformid', $form_details_eye->id)->where('field_name', 'sutures')->delete();
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'sutures', 1, [$request->sutures], [$request->sutures]);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        
        DB::table('eyeformmultipleentry')->where('eyeformid', $form_details_eye->id)->where('field_name', 'sc_injection')->delete();
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'sc_injection', 1, [$request->sc_injection], [$request->sc_injection]);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        DB::table('eyeformmultipleentry')->where('eyeformid', $form_details_eye->id)->where('field_name', 'eye_patch')->delete();
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'eye_patch', 1, [$request->eye_patch], [$request->eye_patch]);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'intra_operative_event', count($request->intra_operative_event), $request->intra_operative_event_OD, $request->intra_operative_event_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        DB::table('eyeformmultipleentry')->where('eyeformid', $form_details_eye->id)->where('field_name', 'anaesthetist_notes')->delete();
        $multientryArry = array();        
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'anaesthetist_notes', 1, [$request->anaesthetist_notes], [$request->anaesthetist_notes]);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        //==================================================================================
        
        
         
        
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
                'surgery' => 'surgery', 
                'otherDetailsDiagnosis' => 'otherDetailsDiagnosis', 
                
                'section' => 'section', 
                'site' => 'site', 
                'size_of_wound' => 'size_of_wound', 
                'side_ports' => 'side_ports', 
                'acm' => 'acm',
                
                'intra_cameral' => 'intra_cameral', 
                'hydrodissect' => 'hydrodissect', 
                'hydrodelamination' => 'hydrodelamination', 
                
                'phacoemulisification' => 'phacoemulisification', 
                'sics' => 'sics', 
                'iol' => 'iol', 
                'iol_type' => 'iol_type', 
                'stromal_hydration' => 'stromal_hydration', 
                'intra_operative_event' => 'intra_operative_event'
            ];

      /*      
      "custom_values" => array:17 [▼
    0 => "surgery"
    1 => "otherDetailsDiagnosis"
    2 => "section_OD[]"
    3 => "site_OD[]"
    4 => "size_of_wound_OD[]"
    5 => "side_ports_OD[]"
    6 => "acm_OD[]"
    7 => "ccc_OD[]"
    8 => "intra_cameral_OD[]"
    9 => "hydrodissect_OD[]"
    10 => "hyrodelamination_OD[]"
    11 => "phacoemulisification_OD[]"
    12 => "sics_OD[]"
    13 => "iol_OD[]"
    14 => "iol_type_OD[]"
    15 => "stromal_hydration_OD[]"
    16 => "intra_operative_event_OD[]"
  ]
  "custom_values_od" => array:17 [▼
    0 => "11"
    1 => "2"
    2 => "4"
    3 => "5"
    4 => "6"
    5 => "7"
    6 => "8"
    7 => "9"
    8 => "10"
    9 => "11"
    10 => "12"
    11 => "13"
    12 => "14"
    13 => "15"
    14 => "17"
    15 => "18"
    16 => "19"
  ]
  "surgery_OS_temp" => "right"
  "custom_values_os" => array:17 [▼
    0 => "right"
    1 => "3"
    2 => null
    3 => null
    4 => null
    5 => null
    6 => null
    7 => null
    8 => null
    9 => null
    10 => null
    11 => null
    12 => null
    13 => null
    14 => null
    15 => null
    16 => null
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
        $case_master->patient_name = $request->patient_name;
        $case_master->patient_age = $request->patient_age;
        $case_master->patient_address = $request->patient_address;
        $case_master->male_female = $request->male_female;
        $case_master->patient_mobile = $request->patient_mobile;
        $case_master->admission_date_time = $request->admission_date_time;
        $case_master->surgery_date_time = $request->surgery_date_time;
        $case_master->surgery_complete_date_time = $request->surgery_complete_date_time;
        $case_master->discharge_date_time = $request->discharge_date_time;
        $case_master->discharge_history = $request->discharge_history;
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

        if(!empty($_POST['appointment_date'] )) {
            foreach ($_POST['appointment_date'] as $key => $value) {
                $data = array('case_id' => $_POST['case_id'], 'date' => $value);

                $qry = DB::table("discharge_appointments")->insert($data);
            }
        }

        if(Input::get('anaesthetistSurgeon') ) {
            $this->SingleEntrySave($request->case_id,'anaesthetistSurgeon',$request->anaesthetistSurgeon);         
        }
        if(Input::get('anesthesia') ) {
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
        
         $form_details_eye = eyeform::where('case_id', $request->case_id)->first();
         if ($form_details_eye === null) {
            $form_details_eye = new eyeform();
            $form_details_eye->case_id = $request->case_id;
            $form_details_eye->save();
        }
       // dd($form_details_eye);
       // /*
        $EfMultiEntryArray = array();
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'surgery', count($request->surgeryCount), $request->surgery_OD, $request->surgery_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
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
        $multientryArry = $this->GetMultipleEntryArray($form_details_eye->id, 'surgeryvision', count($request->otherDetailsAnteriorSegment_OD), $request->surgeryvision_od, $request->surgeryvision_od);
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
        
        //dd($EfMultiEntryArray);
         $form_details_eye->eyeformmultipleentry()->saveMany($EfMultiEntryArray);
        
		//================= inser cutom data ===========================
		if(isset($request->custom_values)) {
			foreach($request->custom_values as $key => $custom_values_names_row) {
				if($request->custom_values_od[$key] != "") {
					

						$formName = "EyeForm";
						$value= $request->custom_values_od[$key];
						$fieldName1 = $custom_values_names_row;

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
				
						$insert_id = DB::getPdo()->lastInsertId();

						$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
						
						$multi_options = ['discharge_iol' => 'discharge_iol', 'diagnosis_history' => 'diagnosis', 'systemicDiseases_history' => 'systemicDiseases', 'advice_history' => 'advice', 'surgicalStepsNotes_history' => 'surgicalStepsNotes'];

						if(in_array($custom_values_names_row, ['anaesthetistSurgeon', 'anesthesia'])) {


							$this->SingleEntrySave($request->case_id,$custom_values_names_row,$value);
						} else if(isset($multi_options[$custom_values_names_row])) {

							//echo "<hr>". $custom_values_names_row.' = '.$multi_options[$custom_values_names_row];
							
							$this->MultipleEntrySave($request->case_id, $multi_options[$custom_values_names_row], [$value]);  
							
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
        
        $form_details = eyeform::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new eyeform();
        }
        
        return view('discharge.print1', compact('insurance_bill','case_master','discharge', 'DateWiseRecordLst', 'logoUrl', 'billdata', 'prescriptions','newDischargeData','surgeon_name','surgonRes','appointment', 'form_details'));
    }

}

