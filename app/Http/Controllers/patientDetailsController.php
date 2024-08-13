<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as HttpGuzzle;
use App\Case_master;
use App\doctor;
use App\appointment;
use App\case_number_generators;
use App\doctor_form_mapping;
use App\patient_details;
use App\Medical_store;
use App\prescription_list;
use App\quantity_dropdown;
use App\strength_dropdown;
use App\number_of_times_dropdown;
use App\DoctorBill;
use App\Image_gallery;
use Auth;
use App\Helpers\Helpers;
use App\Opd_bill;
use App\gyn_form_dropdowns;
use App\md_form_dropdowns;
use Illuminate\Support\Facades\Mail;
use App\Mail\casePaperMail;
use App\Mail\MdFormEmail;
use App\Mail\GynFormEmail;
use PDF;
use App\helperClass\CommonHelper;
use App\Setting;
use App\anxious_for_issue;
use App\ent_prescription_lists;
use App\Mail\AnxiousFormEmail;
use App\Models\form_dropdowns;
use App\eyeform;

use Illuminate\Support\Facades\Log;

class patientDetailsController extends AdminRootController {

//

    public function __construct() {
        $this->acc = 0;
        $this->commonHelper = new CommonHelper();
    }

    public function AptPatient_Kyc($AppointmentId) {

        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
//var_dump(DB::getQueryLog());
        if (!empty($AppointmentId) && $AppointmentId > 0) {
            $appDetails = appointment::find($AppointmentId); //->first();
//var_dump(DB::getQueryLog());
//$doctor_id = $appDetails->doctor_id;
            $case_details = case_master::where('patient_name', $appDetails->name)->orwhere('patient_mobile', $appDetails->mobile_no)->first();
        }
        if (empty($AppointmentId) || $AppointmentId == 0) {
            $appDetails = new appointment();
            $case_details = new case_master();
        }

        if (!empty($case_details) && is_null($case_details)) {
            $case_details->visit_time = Carbon::now()->format('H:i');
        }
        
        $form_dropdowns_array = $this->get_form_dropdowns_array();
            $dropdown_options_table_name = 'form_dropdowns';
            $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
            $defaultValues = [];
//var_dump(DB::getQueryLog());

        $webcam_settings = DB::table('settings')->where('name', 'webcam')->first();

        //return View('patientDetails.KycInfo', compact('doctorlist', 'appDetails', 'case_details', 'form_dropdowns', 'form_dropdowns_array', 'dropdown_options_table_name', 'defaultValues', 'webcam_settings'));
//var_dump(DB::getQueryLog());
        //dd();
        return View('patientDetails.KycInfo', compact('doctorlist', 'appDetails', 'case_details', 'form_dropdowns', 'form_dropdowns_array', 'dropdown_options_table_name', 'defaultValues', 'webcam_settings'));
    }

    public function AddPatient_Details($AppointmentId) {

        $user = Auth::user()->id;
        /*
          $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='case_master/AddPatient_Details'");

          foreach ($accesslevel as $value) {
          $this->acc=$value->accesslevel;
          }

          if($this->acc==1 || )
         */
        $this->acc = $this->commonHelper->checkUserAccess("1_AddPatient_Details/0", Auth::user()->id);
        if ($this->acc == 1) {

            $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
//var_dump(DB::getQueryLog());
            if (!empty($AppointmentId) && $AppointmentId > 0) {
                $appDetails = appointment::find($AppointmentId); //->first();
//var_dump(DB::getQueryLog());
//$doctor_id = $appDetails->doctor_id;
                $case_details = case_master::where('patient_name', $appDetails->name)->orwhere('patient_mobile', $appDetails->mobile_no)->first();
            }
            if (empty($AppointmentId) || $AppointmentId == 0) {
                $appDetails = new appointment();
                $case_details = new case_master();
            }

            if (!empty($case_details) && is_null($case_details)) {
                $case_details->visit_time = Carbon::now()->format('H:i');
            }

            $form_dropdowns_array = $this->get_form_dropdowns_array();
            $dropdown_options_table_name = 'form_dropdowns';
            $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
            $defaultValues = [];
//var_dump(DB::getQueryLog());

            $webcam_settings = DB::table('settings')->where('name', 'webcam')->first();

            return View('patientDetails.KycInfo', compact('doctorlist', 'appDetails', 'case_details', 'form_dropdowns', 'form_dropdowns_array', 'dropdown_options_table_name', 'defaultValues', 'webcam_settings'));
        } else {

            $url = url()->previous();
            return redirect($url);
        }
    }

    public function add_ipd_patient_details($AppointmentId) {

        $user = Auth::user()->id;
        /*
          $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='case_master/AddPatient_Details'");

          foreach ($accesslevel as $value) {
          $this->acc=$value->accesslevel;
          }

          if($this->acc==1 || )
         */
        $this->acc = $this->commonHelper->checkUserAccess("1_AddPatient_Details/0", Auth::user()->id);
        if ($this->acc == 1) {

            $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
//var_dump(DB::getQueryLog());
            if (!empty($AppointmentId) && $AppointmentId > 0) {
                $appDetails = appointment::find($AppointmentId); //->first();
//var_dump(DB::getQueryLog());
//$doctor_id = $appDetails->doctor_id;
                $case_details = case_master::where('patient_name', $appDetails->name)->orwhere('patient_mobile', $appDetails->mobile_no)->first();
            }
            if (empty($AppointmentId) || $AppointmentId == 0) {
                $appDetails = new appointment();
                $case_details = new case_master();
            }

            if (!empty($case_details) && is_null($case_details)) {
                $case_details->visit_time = Carbon::now()->format('H:i');
            }

            $form_dropdowns_array = $this->get_form_dropdowns_array();
            $dropdown_options_table_name = 'form_dropdowns';
            $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
            $defaultValues = [];
//var_dump(DB::getQueryLog());

            $webcam_settings = DB::table('settings')->where('name', 'webcam')->first();

            return View('patientDetails.KycInfoIpd', compact('doctorlist', 'appDetails', 'case_details', 'form_dropdowns', 'form_dropdowns_array', 'dropdown_options_table_name', 'defaultValues', 'webcam_settings'));
        } else {

            $url = url()->previous();
            return redirect($url);
        }
    }

    public function Patient_Kyc($AppointmentId) {
//DB::enableQueryLog();


        $id = Auth::user()->id;
        /*
          $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='aptpatientDetails'");

          foreach ($accesslevel as $value) {
          $this->acc=$value->accesslevel;
          }

          if($this->acc==1)
         */
        $this->acc = $this->commonHelper->checkUserAccess("1_AddPatient_Details/0", Auth::user()->id, 'edit_permission');
        if ($this->acc == 1) {

            $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
//var_dump(DB::getQueryLog());
            if (!empty($AppointmentId) && $AppointmentId > 0) {
                $appDetails = appointment::find($AppointmentId); //->first();
                //
                //dd($appDetails);
//var_dump(DB::getQueryLog());
//$doctor_id = $appDetails->doctor_id;
                $case_details = case_master::where('patient_name', $appDetails->name)->orwhere('patient_mobile', $appDetails->mobile_no)->first();
            }
            if (empty($AppointmentId) || $AppointmentId == 0) {
                $appDetails = new appointment();
                $case_details = new case_master();
            }

            if (!empty($case_details) && is_null($case_details)) {
                $case_details->visit_time = Carbon::now()->format('H:i');
            }
            
            $case_master = $case_details;
            
            //dd($case_master);
//var_dump(DB::getQueryLog());
            $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
            
            
            $form_dropdowns_array = $this->get_form_dropdowns_array();
            $dropdown_options_table_name = 'form_dropdowns';
            $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
            $defaultValues = [];
//var_dump(DB::getQueryLog());

        $webcam_settings = DB::table('settings')->where('name', 'webcam')->first();

        //return View('patientDetails.KycInfo', compact('doctorlist', 'appDetails', 'case_details', 'form_dropdowns', 'form_dropdowns_array', 'dropdown_options_table_name', 'defaultValues', 'webcam_settings'));
//var_dump(DB::getQueryLog());
            
            return View('patientDetails.KycInfo', compact('doctorlist', 'appDetails', 'case_details', 'case_master','form_dropdowns', 'form_dropdowns_array', 'dropdown_options_table_name', 'defaultValues', 'webcam_settings'));
        } else {
            $url = url()->previous();
            return redirect($url);
        }
    }

    public function Patient_Kyc1($AppointmentId) {
        $user = Auth::user()->id;
        /*
          $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='followuppatientDetails'");

          foreach ($accesslevel as $value) {
          $this->acc=$value->accesslevel;
          }

          if($this->acc==1)
         */
        $this->acc = $this->commonHelper->checkUserAccess("followuppatientDetails", Auth::user()->id);
        if ($this->acc == 1) {


//DB::enableQueryLog();
            $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
//var_dump(DB::getQueryLog());
            if (!empty($AppointmentId) && $AppointmentId > 0) {
                $appDetails = case_master::find($AppointmentId); //->first();
//var_dump(DB::getQueryLog());
//$doctor_id = $appDetails->doctor_id;
                $case_details = case_master::where('patient_name', $appDetails->name)->orwhere('patient_mobile', $appDetails->mobile_no)->first();
            }
            if (empty($AppointmentId) || $AppointmentId == 0) {
                $appDetails = new appointment();
                $case_details = new case_master();
            }

            if (!empty($case_details) && is_null($case_details)) {
                $case_details->visit_time = Carbon::now()->format('H:i');
            }
//var_dump(DB::getQueryLog());
            return View('patientDetails.FollolwupKycInfo', compact('doctorlist', 'appDetails', 'case_details'));
        } else {

            $url = url()->previous();
            return redirect($url);
        }
    }

    public function Show_Kyc($case_Id) {
//DB::enableQueryLog();
        $user = Auth::user()->id;
        /*
          $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='patientdetails/casemaster/editPatientDetials'");

          foreach ($accesslevel as $value) {
          $this->acc=$value->accesslevel;
          }

          if($this->acc==1)
         */
        $this->acc = $this->commonHelper->checkUserAccess("patientdetails/casemaster/editPatientDetials", Auth::user()->id);
        if ($this->acc == 1) {
            $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

            $case_details = Case_master::findOrFail($case_Id);
            
            //dd($case_details);

            $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
//$form_details = eyeform::where('case_id', $case_details->id)->first();
            $patients_systemic_history = DB::table('patients_systemic_history')->where('case_id', $case_details->id)->get()->toArray();

//echo "====>>>>>>>>> <pre>".$case_id; print_r($case_details); exit;
            $webcam_settings = DB::table('settings')->where('name', 'webcam')->first();
            return View('patientDetails.EditKycInfo', compact('doctorlist', 'case_details', 'form_dropdowns', 'patients_systemic_history', 'webcam_settings'));
        } else {

            $url = url()->previous();
            return redirect($url);
        }
    }

    public function createCaseNumber() {
        $case_number_ge = new case_number_generators;
        $case_number_ge->save();
        $case_number_ge->case_number = "p_" . sprintf('%08d', $case_number_ge->id);
        $case_number_ge->save();
        return $case_number_ge;
    }

    public function getCaseData($id) {

        $case_master = Case_master::findOrFail($id);
//$medicinlist = Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get();
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $casedata = [
            'id' => $case_master->id,
//'medicinlist' => $medicinlist,
//'prescriptions' =>  prescription_list::where('case_id', $case_master->id)->get(),
            'prescriptions' => ent_prescription_lists::where('case_id', $case_master->id)->get(),
            'DateWiseRecordLst' => $DateWiseRecordLst,
            'case_number' => $case_master->case_number, //'p_00000001'
            'uhid_no' => $case_master->uhid_no, //'p_00000001'
            'patient_name' => $case_master->patient_name,
            'infection' => $case_master->infection,
            'miscellaneous_history' => $case_master->miscellaneous_history,
            'doctor_id' => $case_master->doctor_id,
            'patient_age' => $case_master->patient_age,
            'patient_weight' => $case_master->patient_weight,
            'patient_height' => $case_master->patient_height,
            'patient_address' => $case_master->patient_address,
            'patient_emailId' => $case_master->patient_emailId,
            'Weight' => $case_master->Weight,
            'Height' => $case_master->Height,
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
            'field_type_memory' => null,
            'field_type_data' => null
        ];

//dd($casedata);
        return $casedata;
    }

    public function SaveKYC(Request $request) {

//echo "====>>>>>>>>> <pre>"; print_r($_POST); exit; 
        $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
        if (is_null($case_gen)) {
            $case_gen = $this->createCaseNumber();
        }

        $case_master = $this->submitKyc($request, $case_gen);

        if (Input::get('submitMsg')) {

            if (!empty($case_master) && !empty($request->patient_mobile)) {

                $client = new HttpGuzzle;
                $smsStr = 'Welcome ' . (empty($request->patient_name) ? "" : $request->patient_name) . ' /n your case number is :' . $case_master->case_number . ' /n ' . env('SMS_From_Name');
                $urlGet = str_replace(array('xxxxcommaSeperatedxxxx', 'xxxxSMSTextxxxx'), array($request->patient_mobile, $smsStr), env('SMS_URL'));
                $res = $client->request('GET', $urlGet);
            }
        }

//======================== Start Systemic History Entry ==========================
        foreach ($request->SystemicHistory_OD as $systemic_history) {
            if ($systemic_history != "") {
                DB::table('patients_systemic_history')->insert(['case_id' => $case_master->id, 'value' => $systemic_history]);
//DB::table('eyeformmultipleentry')->insert(['case_id' => $case_master->id, 'field_name' => 'SystemicHistory', 'field_value_OD' => $systemic_history]);
            }
        }

//echo "================>>>>>>>>> <pre>"; print_r($request->SystemicHistory_OD); exit;
//========================= End Systemic history Entry ========================== 

        if (!is_null($request->appointment_Id) && !empty($request->appointment_Id) && $request->appointment_Id > 0) {
            $appointment = appointment::findOrFail($request->appointment_Id);
            $appointment->isAccepted = 1;
            $appointment->save();
        }

//Add doctor consultaion fee.
        if (!empty($request->doctor_fee) && !empty($request->doctor_id) && !empty($case_master)) {
            $doctor_bill = new DoctorBill;
            $doctor_bill->case_id = $case_master->id;
            $doctor_bill->case_number = $case_master->case_number;
            $doctor_bill->doctor_Id = $request->doctor_id;
            $doctor_bill->bill_item = 'Consultation Charges';
            $doctor_bill->bill_Amount = $request->doctor_fee;
            $doctor_bill->billed_date = Carbon::now()->format('Y-m-d');
            $doctor_bill->save();

//             $patient_name = $request->patient_name;
//             $case_number = $case_master->case_number;
//             $bill_item = 'Consultation fees ';
//             $bill_Amount = $request->doctor_fee;
//             $case_id=$case_master->id;
//  DB::INSERT("INSERT INTO `opd_bill`(`case_number`,`bill_item`, `bill_Amount`,`case_id`) VALUES ('$case_number','$bill_item','$bill_Amount','$case_id')");
        }
// \LogActivity::addToLog('Record added successfully');
//return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
        return redirect()->back()->with('flash_message', 'Record added successfully');
//return  $this->PatineMedicalDetails($case_master->id);
//return redirect('/case_masters');
//return view('patientDetails.KycInfo', compact('doctorlist','appDetails'));
    }

//////////

    public function GetMultipleEntryArray($formId, $fieldName, $arrayLength, array $fieldArray_OD = NULL, array $fieldArray_OS = NULL) {
        $multipleEntryArray = array();
        for ($i = 0; $i < $arrayLength; $i++) {
            if ((!empty($fieldArray_OD[$i]) && $fieldArray_OD[$i] != 'Select') | (!empty($fieldArray_OS[$i]) && $fieldArray_OS[$i] != 'Select')) {
                $multipleEntryArray[] = new eyeformmultipleentry([
                    'eyeformid' => $formId,
                    'field_name' => $fieldName,
                    'field_value_OD' => $fieldArray_OD[$i],
                    'field_value_OS' => $fieldArray_OS[$i],
                ]);
            }
        }
        return $multipleEntryArray;
//$form_details->eyeformmultipleentry()->saveMany($ChiefComplaint_OD); 
    }

    public function SaveKYCWhatsapp(Request $request) {
//echo "================== : ".__LINE__; exit;
        $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
        if (is_null($case_gen)) {
            $case_gen = $this->createCaseNumber();
        }

        $case_master = $this->submitKyc($request, $case_gen);

        if (Input::get('submitMsg')) {
            if (!empty($case_master) && !empty($request->patient_mobile)) {
                $client = new HttpGuzzle;
                $smsStr = 'Welcome ' . (empty($request->patient_name) ? "" : $request->patient_name) . ' /n your case number is :' . $case_master->case_number . ' /n ' . env('SMS_From_Name');
                $urlGet = str_replace(array('xxxxcommaSeperatedxxxx', 'xxxxSMSTextxxxx'), array($request->patient_mobile, $smsStr), env('SMS_URL'));
                $res = $client->request('GET', $urlGet);
//\LogActivity::addToLog('Message sent successfully');
            }
        }

        if (!is_null($request->appointment_Id) && !empty($request->appointment_Id) && $request->appointment_Id > 0) {
            $appointment = appointment::findOrFail($request->appointment_Id);
            $appointment->isAccepted = 1;
            $appointment->save();
        }

//Add doctor consultaion fee.
        if (!empty($request->doctor_fee) && !empty($request->doctor_id) && !empty($case_master)) {
            $doctor_bill = new DoctorBill;
            $doctor_bill->case_id = $case_master->id;
            $doctor_bill->case_number = $case_master->case_number;
            $doctor_bill->doctor_Id = $request->doctor_id;
            $doctor_bill->bill_item = 'Consultation Charges';
            $doctor_bill->bill_Amount = $request->doctor_fee;
            $doctor_bill->billed_date = Carbon::now()->format('Y-m-d');
            $doctor_bill->save();

//             $patient_name = $request->patient_name;
//             $case_number = $case_master->case_number;
//             $bill_item = 'Consultation fees ';
//             $bill_Amount = $request->doctor_fee;
//             $case_id=$case_master->id;
//  DB::INSERT("INSERT INTO `opd_bill`(`case_number`,`bill_item`, `bill_Amount`,`case_id`) VALUES ('$case_number','$bill_item','$bill_Amount','$case_id')");
        }
//\LogActivity::addToLog('Record added successfully');
        $mob = $case_master->patient_mobile;
//return $mob;
        //return Redirect::to('https://api.whatsapp.com/send?phone=+91' . $mob . '&text=Wlcome To Tejas Infotech Eye Hospital%20');

		//return Redirect::to('https://api.whatsapp.com/send?phone=+91' . $mob . '&text=Wlcome To Tejas Infotech Eye Hospital%20');
        
      $smsStr = 'Welcome ' . (empty($request->patient_name) ? "" : $request->patient_name) . (empty($request->patient_last_name) ? "" : '%20'. $request->patient_last_name) . ', %20 your uhid number is : ' . $case_master->uhid_no . '. %20 ' . env('SMS_From_Name').'%20 ('. env('CONTACT_WHATSAPP_NUMBER').'). %20 Thank you for visiting.'; 

    $whatsapp_url =  'https://api.whatsapp.com/send?phone=+91' . $mob . '&text='.$smsStr.'%20';
     return Redirect::to( $whatsapp_url);
       // return Redirect::to('https://api.whatsapp.com/send?phone=+91' . $mob . '&text='.$smsStr.'%20');
        
        
		//https://api.whatsapp.com/send?phone=447777333333&text=Message%0awith%0anewlines

// return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
//return  $this->PatineMedicalDetails($case_master->id);
//return redirect('/case_masters');
//return view('patientDetails.KycInfo', compact('doctorlist','appDetails'));
    }

/////////////
    public function EditKYC(Request $request) {
//echo "===========>>>>>>>>> <pre>"; print_r($_POST); exit;
        $case_master = Case_master::findOrFail($request->case_id);
        $case_master->id = $case_master->id ?: 0;
        $case_master->patient_name = $request->patient_name;
        $case_master->patient_age = $request->patient_age;
        $case_master->patient_address = $request->patient_address;
        $case_master->patient_emailId = $request->patient_emailId;
        $case_master->patient_mobile = $request->patient_mobile;
        $case_master->male_female = $request->male_female;
        $case_master->uhid_no = $request->uhid_no;

        $case_master->alternate_number = $request->alternate_number;
        $case_master->pan = $request->pan;
        $case_master->adhar_number = $request->adhar_number;
        if(!empty($request->dob))
        $case_master->dob = date('Y-m-d', strtotime($request->dob));
        
        //===============================================================
        $case_master->admission_month = $request->admission_month;
        $case_master->patient_priority = $request->patient_priority;
        $case_master->mr_mrs_ms = $request->mr_mrs_ms;
        $case_master->middle_name = $request->patient_middle_name;
        $case_master->last_name = $request->patient_last_name;
        $case_master->area = $request->patient_area;
        $case_master->is_followup = $request->is_followup;
        $case_master->city = $request->city;
        $case_master->district = $request->district;
        
        $case_master->accompanied_by = $request->accompanied_by;
        $case_master->occupation = $request->occupation;
        $case_master->daily_travel_time = $request->daily_travel_time;
        $case_master->screen_time = $request->screen_time;
        //================================================================

        $case_master->referedby = $request->referedby;
        $case_master->patient_weight = $request->patient_weight;
        $case_master->patient_height = $request->patient_height;
        $case_master->blood_pressure = $request->blood_pressure;
        $case_master->infection = $request->infection;
        $case_master->miscellaneous_history = $request->miscellaneous_history;
        
        if ($request['profile_picture'] != "") {
//$safeName = $this->savePhoto($request['profile_picture'], $uhid_no);

            $img = $request['profile_picture'];
            $folderPath = public_path() . '/uploads/';

            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);
            $fileName = $request->uhid_no . '.png';

            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);

//print_r($fileName);

            $case_master->patient_pic = $fileName;
        }
        $case_master->save();

//Add doctor consultaion fee.
        if (!empty($request->doctor_fee) && !empty($request->doctor_id) && !empty($case_master)) {
            $doctor_bill = new DoctorBill;
// $doctor_bill->case_id = $case_master->id;
            $doctor_bill->case_number = $case_master->case_number;
            $doctor_bill->doctor_Id = $request->doctor_id;
            $doctor_bill->bill_item = 'Consultation Charges';
            $doctor_bill->bill_Amount = $request->doctor_fee;
            $doctor_bill->billed_date = Carbon::now()->format('Y-m-d');
            $case_master->DoctorBill()->save($doctor_bill);
        }

        foreach ($request->SystemicHistory_OD as $systemic_history) {
            if ($systemic_history != "") {
                DB::table('patients_systemic_history')->insert(['case_id' => $case_master->id, 'value' => $systemic_history]);
//DB::table('eyeformmultipleentry')->insert(['case_id' => $case_master->id, 'field_name' => 'SystemicHistory', 'field_value_OD' => $systemic_history]);
            }
        }
//\LogActivity::addToLog('Patient Kyc updated successfully');
        return redirect('/case_masters')->with('flash_message', 'Patient Kyc updated successfully');
    }

//////////////MD-PDF-Email-////////////////////////////
    public function SaveCaseHistory(Request $request) {

//echo "============ : ".__LINE__; exit;
//$patient_details = patient_details();
        $isEdit = true;
        $patient_details = patient_details::where('case_id', $request->case_id)->first();
//var_dump(DB::getQueryLog());
        if ($patient_details === null) {
            $patient_details = new patient_details;
            $isEdit = false;
        }
        if (isset($request->appointment_dt) && $request->appointment_dt != null && $request->appointment_dt != '') {
            $case_master = Case_master::findOrFail($request->case_id);
            $case_master->FollowUpDate = $request->appointment_dt;
            $case_master->FollowUpTimeSlot = $request->FollowUpTimeSlot;
            $case_master->save();
        }
        $patient_details->fill($request->all());
        $patient_details->save();

        if (Input::get('SendEmail')) {
            if ($request->email && !empty($request->email)) {
                $this->validate($request, [
                    'email' => 'required|email'
                ]);
                $casedata = $this->getCaseData($request->case_id);
                $patient_details = patient_details::where('case_id', $request->case_id)->first();
                $case_master = Case_master::findOrFail($request->case_id);
                $pdfname = "mdform" . $request->case_id . ".pdf";
                $case_master->pdfname = $pdfname;
                $case_master->save();
                if ($patient_details === null) {
                    $patient_details = new patient_details();
                }
                $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
                $logoUrl = '';
                if (!is_null($image_gallery) && isset($image_gallery->imgUrl)) {
                    $logoUrl = $image_gallery->imgUrl;
                }

                if (\File::exists(public_path('mdpdf/' . $pdfname))) {
                    \File::delete(public_path('mdpdf/' . $pdfname));
                    $pdf = PDF::loadView('patientDetails.mdformemail', compact('casedata', 'patient_details', 'logoUrl'));
                    $path = public_path('mdpdf/');
                    $fileName = 'mdform' . $request->case_id . '.pdf';
                    $pdf->save($path . '/' . $fileName);
                } else {
                    $pdf = PDF::loadView('patientDetails.mdformemail', compact('casedata', 'patient_details', 'logoUrl'));
                    $path = public_path('mdpdf/');
                    $fileName = 'mdform' . $request->case_id . '.pdf';
                    $pdf->save($path . '/' . $fileName);
                }
//return view('patientDetails.mdformemail', compact('casedata','patient_details','logoUrl'));

                $mailContent = compact('casedata', 'patient_details', 'logoUrl');
                $mailTemplate = 'patientDetails.mdformemail';

                Mail::to($request->email)->send(new MdFormEmail($request->case_id));
                return redirect()->back()->with('flash_message', 'Email has been sent to ' . $request->email);
            }
        }

// Send Email To Present Email ID
        if (Input::get('SubmitMail')) {
            if ($request->patient_emailId && !empty($request->patient_emailId)) {
                $this->validate($request, [
                    'patient_emailId' => 'required|email'
                ]);
                $casedata = $this->getCaseData($request->case_id);
                $patient_details = patient_details::where('case_id', $request->case_id)->first();
                $case_master = Case_master::findOrFail($request->case_id);
                $pdfname = "mdform" . $request->case_id . ".pdf";
                $case_master->pdfname = $pdfname;
                $case_master->save();
                if ($patient_details === null) {
                    $patient_details = new patient_details();
                }
                $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
                $logoUrl = '';
                if (!is_null($image_gallery) && isset($image_gallery->imgUrl)) {
                    $logoUrl = $image_gallery->imgUrl;
                }

                if (\File::exists(public_path('mdpdf/' . $pdfname))) {
                    \File::delete(public_path('mdpdf/' . $pdfname));
                    $pdf = PDF::loadView('patientDetails.mdformemail', compact('casedata', 'patient_details', 'logoUrl'));
                    $path = public_path('mdpdf/');
                    $fileName = 'mdform' . $request->case_id . '.pdf';
                    $pdf->save($path . '/' . $fileName);
                } else {
                    $pdf = PDF::loadView('patientDetails.mdformemail', compact('casedata', 'patient_details', 'logoUrl'));
                    $path = public_path('mdpdf/');
                    $fileName = 'mdform' . $request->case_id . '.pdf';
                    $pdf->save($path . '/' . $fileName);
                }                //return $pdf->download($fileName);

                $mailContent = compact('casedata', 'patient_details', 'logoUrl');
                $mailTemplate = 'patientDetails.mdformemail';

                Mail::to($request->patient_emailId)->send(new MdFormEmail($request->case_id));
                return redirect()->back()->with('flash_message', 'Email has been sent to ' . $request->patient_emailId);
            }
        }
// Send Email To Other OF Gynecologist form
        if (Input::get('casehisfemalesendbtn')) {
            if ($request->casehisemail && !empty($request->casehisemail)) {

                $this->validate($request, [
                    'casehisemail' => 'required|email'
                ]);

                $patient_details = patient_details::where('case_id', $request->case_id)->first();
                $case_master = Case_master::findOrFail($request->case_id);
                $pdfname = "gynform" . $request->case_id . ".pdf";
                $case_master->pdfname = $pdfname;
                $case_master->save();
                $casedata = $this->getCaseData($request->case_id);
                if ($patient_details === null) {
                    $patient_details = new patient_details();
                }
                $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
                $logoUrl = '';
                if (!is_null($image_gallery) && isset($image_gallery->imgUrl)) {
                    $logoUrl = $image_gallery->imgUrl;
                }


                if (\File::exists(public_path('gynpdf/' . $pdfname))) {
                    \File::delete(public_path('gynpdf/' . $pdfname));
                    $pdf = PDF::loadView('patientDetails.mdformemail', compact('casedata', 'patient_details', 'logoUrl'));
                    $path = public_path('gynpdf/');
                    $fileName = 'gynform' . $request->case_id . '.pdf';
                    $pdf->save($path . '/' . $fileName);
                } else {
                    $pdf = PDF::loadView('patientDetails.mdformemail', compact('casedata', 'patient_details', 'logoUrl'));
                    $path = public_path('gynpdf/');
                    $fileName = 'gynform' . $request->case_id . '.pdf';
                    $pdf->save($path . '/' . $fileName);
                }
// return view('patientDetails.mdformemail', compact('casedata','patient_details','logoUrl'));

                $mailContent = compact('casedata', 'patient_details', 'logoUrl');
                $mailTemplate = 'patientDetails.mdformemail';

                Mail::to($request->casehisemail)->send(new GynFormEmail($request->case_id));
                return redirect()->back()->with('flash_message', 'Email has been sent to ' . $request->casehisemail);
            }
        }

// Send Email To Present Email ID OF Gynecologist Form
        if (Input::get('casehisfemalsubbtn')) {
            if ($request->casehisfem_patient_emailId && !empty($request->casehisfem_patient_emailId)) {
                $this->validate($request, [
                    'casehisfem_patient_emailId' => 'required|email'
                ]);

                $patient_details = patient_details::where('case_id', $request->case_id)->first();
                $case_master = Case_master::findOrFail($request->case_id);
                $pdfname = "gynform" . $request->case_id . ".pdf";
                $case_master->pdfname = $pdfname;
                $case_master->save();
                $casedata = $this->getCaseData($request->case_id);
                if ($patient_details === null) {
                    $patient_details = new patient_details();
                }
                $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
                $logoUrl = '';
                if (!is_null($image_gallery) && isset($image_gallery->imgUrl)) {
                    $logoUrl = $image_gallery->imgUrl;
                }

                if (\File::exists(public_path('gynpdf/' . $pdfname))) {
                    \File::delete(public_path('gynpdf/' . $pdfname));
                    $pdf = PDF::loadView('patientDetails.mdformemail', compact('casedata', 'patient_details', 'logoUrl'));
                    $path = public_path('gynpdf/');
                    $fileName = 'gynform' . $request->case_id . '.pdf';
                    $pdf->save($path . '/' . $fileName);
                } else {
                    $pdf = PDF::loadView('patientDetails.mdformemail', compact('casedata', 'patient_details', 'logoUrl'));
                    $path = public_path('gynpdf/');
                    $fileName = 'gynform' . $request->case_id . '.pdf';
                    $pdf->save($path . '/' . $fileName);
                }                //return $pdf->download($fileName);

                $mailContent = compact('casedata', 'patient_details', 'logoUrl');
                $mailTemplate = 'patientDetails.mdformemail';

                Mail::to($request->casehisfem_patient_emailId)->send(new GynFormEmail($request->case_id));
                return redirect()->back()->with('flash_message', 'Email has been sent to ' . $request->casehisfem_patient_emailId);
            }
        }
//  \LogActivity::addToLog('Record added successfully');
        return redirect('/case_masters')->with('flash_message', 'Record added successfully');
    }

//////////////MD-PDF-Email-////////////////////////////
    public function SaveAnxiousCaseHistory(Request $request) {

        $this->validate($request, [
            'wife_name' => 'required',
            'husband_name' => 'required'
        ]);

        $isEdit = true;
        $anxious_for_issues_details = anxious_for_issue::where('case_id', $request->case_id)->first();
//var_dump(DB::getQueryLog());
        if ($anxious_for_issues_details === null) {
            $anxious_for_issues_details = new anxious_for_issue();
            $isEdit = false;
        }

        if (isset($request->appointment_dt) && $request->appointment_dt != null && $request->appointment_dt != '') {
            $case_master = Case_master::findOrFail($request->case_id);
            $case_master->FollowUpDate = $request->appointment_dt;
            $case_master->FollowUpTimeSlot = $request->FollowUpTimeSlot;
            $case_master->save();
        }

        $anxious_for_issues_details->fill($request->all());
        $anxious_for_issues_details->save();

// Send Email To Other OF Gynecologist form
        if (Input::get('casehisfemalesendbtn')) {
            if ($request->casehisemail && !empty($request->casehisemail)) {

                $this->validate($request, [
                    'casehisemail' => 'required|email'
                ]);

                $patient_details = anxious_for_issue::where('case_id', $request->case_id)->first();
                $case_master = Case_master::findOrFail($request->case_id);
                $pdfname = "anxiousform" . $request->case_id . ".pdf";
                $case_master->pdfname = $pdfname;
                $case_master->save();

                $casedata = $this->getCaseData($request->case_id);
                if ($patient_details === null) {
                    $patient_details = new anxious_for_issue();
                }
                $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
                $logoUrl = '';
                if (!is_null($image_gallery) && isset($image_gallery->imgUrl)) {
                    $logoUrl = $image_gallery->imgUrl;
                }



//return view('anxious_for_Issue.mdformemail', compact('casedata','patient_details','logoUrl'));


                if (\File::exists(public_path('anxiouspdf/' . $pdfname))) {
                    \File::delete(public_path('anxiouspdf/' . $pdfname));
                    $pdf = PDF::loadView('anxious_for_Issue.mdformemail', compact('casedata', 'patient_details', 'logoUrl'));
                    $path = public_path('anxiouspdf/');
                    $fileName = 'anxiousform' . $request->case_id . '.pdf';
                    $pdf->save($path . $fileName);
                } else {
                    $pdf = PDF::loadView('anxious_for_Issue.mdformemail', compact('casedata', 'patient_details', 'logoUrl'));
                    $path = public_path('anxiouspdf/');
                    $fileName = 'anxiousform' . $request->case_id . '.pdf';
                    $pdf->save($path . $fileName);
                }
// return view('patientDetails.mdformemail', compact('casedata','patient_details','logoUrl'));

                $mailContent = compact('casedata', 'patient_details', 'logoUrl');
                $mailTemplate = 'anxious_for_Issue.mdformemail';

                Mail::to($request->casehisemail)->send(new AnxiousFormEmail($request->case_id));
                return redirect()->back()->with('flash_message', 'Email has been sent to ' . $request->casehisemail);
            }
        }

// Send Email To Present Email ID OF Gynecologist Form
        if (Input::get('casehisfemalsubbtn')) {
            if ($request->casehisfem_patient_emailId && !empty($request->casehisfem_patient_emailId)) {
                $this->validate($request, [
                    'casehisfem_patient_emailId' => 'required|email'
                ]);

                $patient_details = anxious_for_issue::where('case_id', $request->case_id)->first();
                $case_master = Case_master::findOrFail($request->case_id);
                $pdfname = "anxiousform" . $request->case_id . ".pdf";
                $case_master->pdfname = $pdfname;
                $case_master->save();
                $casedata = $this->getCaseData($request->case_id);
                if ($patient_details === null) {
                    $patient_details = new anxious_for_issue();
                }
                $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
                $logoUrl = '';
                if (!is_null($image_gallery) && isset($image_gallery->imgUrl)) {
                    $logoUrl = $image_gallery->imgUrl;
                }

                if (\File::exists(public_path('anxiouspdf/' . $pdfname))) {
                    \File::delete(public_path('anxiouspdf/' . $pdfname));
                    $pdf = PDF::loadView('anxious_for_Issue.mdformemail', compact('casedata', 'patient_details', 'logoUrl'));
                    $path = public_path('anxiouspdf/');
                    $fileName = 'anxiousform' . $request->case_id . '.pdf';
                    $pdf->save($path . $fileName);
                } else {
                    $pdf = PDF::loadView('anxious_for_Issue.mdformemail', compact('casedata', 'patient_details', 'logoUrl'));
                    $path = public_path('gynpdf/');
                    $fileName = 'anxiousform' . $request->case_id . '.pdf';
                    $pdf->save($path . $fileName);
                }                //return $pdf->download($fileName);

                $mailContent = compact('casedata', 'patient_details', 'logoUrl');
                $mailTemplate = 'anxious_for_Issue.mdformemail';

                Mail::to($request->casehisfem_patient_emailId)->send(new GynFormEmail($request->case_id));
                return redirect()->back()->with('flash_message', 'Email has been sent to ' . $request->casehisfem_patient_emailId);
            }
        }
//  \LogActivity::addToLog('Record added successfully');
        return redirect('/case_masters')->with('flash_message', 'Record added successfully');
    }

//////////////MD-PDF-Email-////////////////////////////
    public function SaveAnxiousCaseHistory_bk(Request $request) {

        $this->validate($request, [
            'wife_name' => 'required',
            'husband_name' => 'required'
        ]);

// echo "=============>>>>>>> <pre>"; print_r($_POST); exit;
//$patient_details = patient_details();
        $isEdit = true;
        $anxious_for_issues_details = anxious_for_issue::where('case_id', $request->case_id)->first();
//var_dump(DB::getQueryLog());
        if ($anxious_for_issues_details === null) {
            $anxious_for_issues_details = new anxious_for_issue;
            $isEdit = false;
        }

        $anxious_for_issues_details->fill($request->all());
        $anxious_for_issues_details->save();

        return redirect('/case_masters')->with('flash_message', 'Record added successfully');
    }

    public function PatientMedicalDetails($case_id) {

        $casedata = $this->getCaseData($case_id);
        $viewName = $this->getPatientFormByDoctorId($casedata['doctor_id']);
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

//echo "============ : ".$viewName; exit;
        switch ($viewName) {
            case 'patientDetails.caseHistory';
                $md_form_dropdowns = md_form_dropdowns::where('formName', 'md')->get();
            case 'patientDetails.CasHisFemale';
                $patient_details = patient_details::where('case_id', $case_id)->first();

                if ($patient_details === null) {
                    $patient_details = new patient_details();
                }
                $selectdoc = Case_master::where('id', $case_id)->pluck('doctor_id');
                $form_dropdowns = gyn_form_dropdowns::where('formName', 'gyn')->get();

                $defaultValues = [];

                $form_dropdowns_array = $this->get_form_dropdowns_array();
                $dropdown_options_table_name = 'gyn_form_dropdowns';

//dd($form_dropdowns_array);

                return view($viewName, compact('casedata', 'patient_details', 'doctorlist', 'form_dropdowns', 'selectdoc', 'defaultValues', 'md_form_dropdowns', 'form_dropdowns_array', 'dropdown_options_table_name'));
                break;
            case 'anxious_for_Issue.anxious_for_Issue';
//echo "============ : ".__LINE__; exit;
                $patient_details = anxious_for_issue::where('case_id', $case_id)->first();

                if ($patient_details === null) {
                    $patient_details = new anxious_for_issue();
                }

                $selectdoc = Case_master::where('id', $case_id)->pluck('doctor_id');
                $form_dropdowns = gyn_form_dropdowns::where('formName', 'gyn')->get();

//dd($patient_details);
// return $patient_details->Education;
                $defaultValues = [];
                $dropdown_options_table_name = 'gyn_form_dropdowns';
                return view($viewName, compact('casedata', 'patient_details', 'doctorlist', 'form_dropdowns', 'selectdoc', 'defaultValues', 'md_form_dropdowns', 'dropdown_options_table_name'));
                break;
            case 'case_masters.add';
                return redirect()->route('case_masters.edit', ['case_master' => $case_id]);
                break;
            case 'EyeForm.EyeForm';
                return redirect()->route('eyeDetails.addEdit', ['case_master' => $case_id]);
                break;
            case 'EyeForm.UploadCaseForm';
                return redirect()->route('upload-case-form.addEdit', ['case_master' => $case_id]);
                break;
            case 'EyeForm.EyeFormold';
                return redirect()->route('eyeDetails.addEditold', ['case_master' => $case_id]);
                break;
            case 'dentist.add';
                return redirect()->route('dentist.edit', ['case_master' => $case_id]);
                break;
            case 'skin.addUpdate';
                return redirect()->route('skin.addUpdate', ['case_master' => $case_id]);
                break;
            case 'ent.index';
                return redirect()->route('ent.index', ['case_master' => $case_id]);
                break;
            case 'Psychiatrist.add';
                return redirect()->route('psyciatrist-case-form.add', ['case_master' => $case_id]);
                break;	
            case 'obg.obg';
                $patient_details = obg::where('case_id', $case_id)->first();
            
                if ($patient_details === null) {
                    $patient_details = new obg();
                }

               $selectdoc= Case_master::where('id', $case_id)->pluck('doctor_id');
               $form_dropdowns = gyn_form_dropdowns::where('formName', 'gyn')->get();
				 
				//dd($patient_details);
                // return $patient_details->Education;
                 $defaultValues = [];
				 $dropdown_options_table_name = 'gyn_form_dropdowns';
                return view($viewName, compact('casedata','patient_details','doctorlist','form_dropdowns','selectdoc','defaultValues','md_form_dropdowns', 'dropdown_options_table_name'));
            break;       
            case 'follow.follow';

                $patient_details = follow::where('case_id', $case_id)->first();
            
                if ($patient_details === null) {
                    $patient_details = new follow();
                }

               $selectdoc= Case_master::where('id', $case_id)->pluck('doctor_id');
               $form_dropdowns = gyn_form_dropdowns::where('formName', 'gyn')->get();
                 
                dd($patient_details);
                // return $patient_details->Education;
                 $defaultValues = [];
                 $dropdown_options_table_name = 'gyn_form_dropdowns';
                return view($viewName, compact('casedata','patient_details','doctorlist','form_dropdowns','selectdoc','defaultValues','md_form_dropdowns', 'dropdown_options_table_name'));
            break;
        }
    }

    public function viewPatientMedicalDetails($case_id) {


        $casedata = $this->getCaseData($case_id);
        $viewName = $this->getPatientFormByDoctorId($casedata['doctor_id']);

        switch ($viewName) {
            case 'patientDetails.caseHistory';
            case 'patientDetails.CasHisFemale';
                $patient_details = patient_details::where('case_id', $case_id)->first();
                if ($patient_details === null) {
                    $patient_details = new patient_details();
                }
                return view($viewName . 'View', compact('casedata', 'patient_details'));
                break;
            case 'anxious_for_Issue.anxious_for_Issue';
//echo "============ : ".__LINE__; exit;
                $patient_details = anxious_for_issue::where('case_id', $case_id)->first();

                if ($patient_details === null) {
                    $patient_details = new anxious_for_issue();
                }

//dd($patient_details);
                return view($viewName . 'View', compact('casedata', 'patient_details'));
                break;

            case 'case_masters.add';
                return redirect()->route('case_masters.show', ['case_master' => $case_id]);
                break;
            case 'EyeForm.EyeForm';
                return redirect()->route('eyeDetails.view', ['case_master' => $case_id]);
                break;
            case 'dentist.add';
                return redirect()->route('dentist.show', ['case_master' => $case_id]);
                break;
            case 'skin.addUpdate';
                return redirect()->route('skin.view', ['case_master' => $case_id]);
                break;
            case 'ent.index';
                return redirect()->route('entDetails.view', ['case_master' => $case_id]);
                break;
        }
    }

    public function printPatientMedicalDetails($case_id) {


        $casedata = $this->getCaseData($case_id);
        $viewName = $this->getPatientFormByDoctorId($casedata['doctor_id']);

        switch ($viewName) {
            case 'patientDetails.caseHistory';
            case 'patientDetails.CasHisFemale';
                $patient_details = patient_details::where('case_id', $case_id)->first();
                if ($patient_details === null) {
                    $patient_details = new patient_details();
                }
                $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
                $logoUrl = '';
                if (!is_null($image_gallery) && isset($image_gallery->imgUrl)) {
                    $logoUrl = $image_gallery->imgUrl;
                }
                return view($viewName . 'Print', compact('casedata', 'patient_details', 'logoUrl'));
                break;
            case 'anxious_for_Issue.anxious_for_Issue';
//echo "============ : ".__LINE__; exit;
                $patient_details = anxious_for_issue::where('case_id', $case_id)->first();

                if ($patient_details === null) {
                    $patient_details = new anxious_for_issue();
                }

//dd($patient_details);
                $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
                $logoUrl = '';
                if (!is_null($image_gallery) && isset($image_gallery->imgUrl)) {
                    $logoUrl = $image_gallery->imgUrl;
                }
                return view($viewName . 'Print', compact('casedata', 'patient_details', 'logoUrl'));
                break;
            case 'case_masters.add';
                return redirect()->action('Case_mastersController@printPatientDetails', ['case_master' => $case_id]);
                break;
            case 'EyeForm.EyeForm';
                return redirect()->route('eyeDetails.print', ['case_master' => $case_id]);
                break;
            case 'dentist.add';
                return redirect()->route('dentist.print', ['case_master' => $case_id]);
                break;
            case 'skin.addUpdate';
                return redirect()->route('skin.print', ['case_master' => $case_id]);
                break;
            case 'ent.index';
                return redirect()->route('entDetails.print', ['case_master' => $case_id]);
                break;
        }
    }
	
	public function GetCaseIdbyPatientNameMobile(Request $request) {
DB::enableQueryLog();
        $query = $request->get('query', '');
        $tableName = $request->get('tableName', '');
        $PropertyName = $request->get('PropertyName', '');
		$posts_1 = DB::table('case_master')->select(DB::raw("CONCAT(case_number, ' - ', IFNULL(patient_name, ''), ' ', IFNULL(middle_name, ''), ' ', IFNULL(last_name, ''), ' - ', IFNULL(patient_mobile, ''), ' - ', IFNULL(uhid_no, '')) AS label"), 'case_number as value', 'patient_name', 'patient_pic', 'alternate_number', DB::raw("DATE_FORMAT(dob, '%Y-%m-%d') as dob"), 'pan', 'adhar_number', 'patient_mobile', 'doctor_id', 'patient_age', 'patient_address', 'patient_emailId', 'patient_weight', 'patient_height', 'blood_pressure', 'infection', 'miscellaneous_history', 'male_female', 'uhid_no', 'referedby', 'doctor_name', 'payment_mode', 'billAmount', 'visit_time', 'middle_name', 'last_name', 'mr_mrs_ms', 'area', 'city', 'district', 'patient_priority')
                        ->where('is_deleted', '0')->join('doctors', 'doctors.id', '=', 'case_master.doctor_id')
                        ->whereNotNull('case_number')
                        ->Where(function ($q) use ($query) {
                            $q->orWhere('patient_name', 'LIKE', '%' . $query . '%')
                            ->orWhere('middle_name', 'LIKE', '%' . $query . '%')
                            ->orWhere('last_name', 'LIKE', '%' . $query . '%')
                            ->orWhere('patient_mobile', 'LIKE', '%' . $query . '%')
                            ->orWhere('case_number', 'LIKE', '%' . $query . '%')
                            ->orWhere('uhid_no', 'LIKE', '%' . $query . '%');
                        })->distinct()->get();
						
		$posts_2 = DB::table('patients')->select(DB::raw("CONCAT(ipd_number, ' - ', IFNULL(first_name, ''), ' ', IFNULL(middle_name, ''), ' ', IFNULL(last_name, ''), ' - ', IFNULL(contact, ''), ' - ', IFNULL(uhid_number, '')) AS label, NULL as value, first_name as patient_name, null as patient_pic, null as alternate_number, DATE_FORMAT(date_of_birth, '%Y-%m-%d') as dob, null as pan, null as adhar_number, contact as patient_mobile, null as doctor_id, null as patient_age, address as patient_address, email as patient_emailId, null as patient_weight, null as patient_height, null as blood_pressure, null as infection, null as miscellaneous_history, gender as male_female, uhid_number as uhid_no, null as referedby, null as doctor_name, null as payment_mode, null as billAmount, null as visit_time, middle_name, last_name, null as mr_mrs_ms, area, city, district, null as patient_priority"))
                        ->where('is_deleted', '0')
                        ->Where(function ($q) use ($query) {
                            $q->orWhere('first_name', 'LIKE', '%' . $query . '%')
                            ->orWhere('middle_name', 'LIKE', '%' . $query . '%')
                            ->orWhere('last_name', 'LIKE', '%' . $query . '%')
                            ->orWhere('contact', 'LIKE', '%' . $query . '%')
                            ->orWhere('ipd_number', 'LIKE', '%' . $query . '%')
                            ->orWhere('uhid_number', 'LIKE', '%' . $query . '%');
                        })->distinct()->get();
		
		$ipd_records = $posts_1;
		/*
		foreach($posts_1 as $posts_1_row) {
			$ipd_records[] = $posts_2_row;
		}
		*/
		foreach($posts_2 as $posts_2_row) {
			
			$key = array_search($posts_2_row->uhid_no, array_column($posts_1, 'uhid_no'));
			
			if(!$key) {			
				$ipd_records[] = $posts_2_row;
			}
		}
		
		//$post = array_merge($posts_1, $ipd_records);
			//echo "<hr><pre>"; print_r($ipd_records);
//return var_dump(DB::getQueryLog());
		Log::info(json_encode(DB::getQueryLog()));
        return response()->json($posts_1);
    }

    public function getPatientFormByDoctorId($doctor_id) {
//redirect logic based upon doctory type.
        $viewName = 'case_masters.add';
        $doctor_form_mapping = doctor::where('id', $doctor_id)->first();
        if (!is_null($doctor_form_mapping) && !empty($doctor_form_mapping) && !empty($doctor_form_mapping->formViewName)) {
            if (view()->exists($doctor_form_mapping->formViewName)) {
                $viewName = $doctor_form_mapping->formViewName;
            }
        }
        return $viewName;
    }

    public function GetCaseIdbyPatientNameMobile_bk_24apr2023(Request $request) {
DB::enableQueryLog();
        $query = $request->get('query', '');
        $tableName = $request->get('tableName', '');
        $PropertyName = $request->get('PropertyName', '');
//$posts = DB::table($tableName)->select($PropertyName)->where($PropertyName,'LIKE','%'.$query.'%')->take(20)->pluck($PropertyName)->toArray();
//DATE_FORMAT(dob, "%d-%m-%Y")
        $posts = Case_master::select(DB::raw("CONCAT(case_number, ' - ', IFNULL(patient_name, ''), ' ', IFNULL(middle_name, ''), ' ', IFNULL(last_name, ''), ' - ', IFNULL(patient_mobile, ''), ' - ', IFNULL(uhid_no, '')) AS label"), 'case_number as value', 'patient_name', 'patient_pic', 'alternate_number', DB::raw("DATE_FORMAT(dob, '%Y-%m-%d') as dob"), 'pan', 'adhar_number', 'patient_mobile', 'doctor_id', 'patient_age', 'patient_address', 'patient_emailId', 'patient_weight', 'patient_height', 'blood_pressure', 'infection', 'miscellaneous_history', 'male_female', 'uhid_no', 'referedby', 'doctor_name', 'payment_mode', 'billAmount', 'visit_time', 'middle_name', 'last_name', 'mr_mrs_ms', 'area', 'city', 'district', 'patient_priority')
                        ->where('is_deleted', '0')->join('doctors', 'doctors.id', '=', 'case_master.doctor_id')
                        ->whereNotNull('case_number')
                        ->Where(function ($q) use ($query) {
                            $q->orWhere('patient_name', 'LIKE', '%' . $query . '%')
                            ->orWhere('middle_name', 'LIKE', '%' . $query . '%')
                            ->orWhere('last_name', 'LIKE', '%' . $query . '%')
                            ->orWhere('patient_mobile', 'LIKE', '%' . $query . '%')
                            ->orWhere('case_number', 'LIKE', '%' . $query . '%')
                            ->orWhere('uhid_no', 'LIKE', '%' . $query . '%');
                        })->distinct()->get();
//return var_dump(DB::getQueryLog());
		Log::info(json_encode(DB::getQueryLog()));
        return response()->json($posts);
    }

    public function getBalanceAmount(Request $request) {
//DB::enableQueryLog();
        $case_number = $request->get('case_number', '');

        $previous_bill_details = Case_master::where('case_number', $case_number)->select('billAmount', 'paidAmount')->get();

        $total_bill = 0;
        $total_paid = 0;
        $balance = 0;
        foreach ($previous_bill_details as $previous_bill_details_row) {
            $total_bill += ($previous_bill_details_row->billAmount) ?: 0;
            $total_paid += ($previous_bill_details_row->paidAmount) ?: 0;
        }
        $balance = $total_bill - $total_paid;

        return response()->json(['balance' => $balance]);
    }

    public function submitKyc(Request $request, case_number_generators $case_gen) {
        $this->validate($request, [
            'patient_mobile' => 'required|digits:10',
        ]);

//dd($request->all());
//DB::enableQueryLog();
        $isEdit = true;
        $case_master = null;
        $case_master = Case_master::where('case_number', $case_gen->case_number)->where('is_deleted', '0')->whereDate('created_at', Carbon::today()->toDateString())->first();
//var_dump(DB::getQueryLog());
        if ($case_master === null) {
            $case_master = new Case_master;
            $isEdit = false;
        }
        
        $case_master->created_by = Auth::user()->id;
        $case_master->id = $case_master->id ?: 0;
        $case_master->patient_name = $request->patient_name;
        $case_master->patient_age = $request->patient_age;
        $case_master->patient_address = $request->patient_address;
        $case_master->patient_emailId = $request->patient_emailId;
        $case_master->patient_mobile = $request->patient_mobile;

        $case_master->alternate_number = $request->alternate_number;
        $case_master->pan = $request->pan;
        $case_master->adhar_number = $request->adhar_number;
        if(!empty($request->dob))
        $case_master->dob = date('Y-m-d', strtotime($request->dob));

        $case_master->admission_month = $request->admission_month;
        $case_master->male_female = $request->male_female;
        $case_master->patient_weight = $request->patient_weight;
        $case_master->patient_height = $request->patient_height;
        $case_master->blood_pressure = $request->blood_pressure;
        $case_master->infection = $request->infection;
        $case_master->miscellaneous_history = $request->miscellaneous_history;
        
        //===============================================================
        $case_master->patient_priority = $request->patient_priority;
        $case_master->mr_mrs_ms = $request->mr_mrs_ms;
        $case_master->middle_name = $request->patient_middle_name;
        $case_master->last_name = $request->patient_last_name;
        $case_master->area = $request->patient_area;
        $case_master->is_followup = $request->is_followup;
        $case_master->city = $request->city;
        $case_master->district = $request->district;
        
        $case_master->accompanied_by = $request->accompanied_by;
        $case_master->occupation = $request->occupation;
        $case_master->daily_travel_time = $request->daily_travel_time;
        $case_master->screen_time = $request->screen_time;
        //================================================================
        
//$case_master->complaint = $request->complaint;
//$case_master->diagnosis = $request->diagnosis;
        $case_master->case_number = $case_gen->case_number;
        $case_master->visit_time = $request->visit_time;
        $case_master->uhid_no = $request->uhid_no;
        $case_master->referedby = $request->referedby;
        
        
        
        if (!empty($request->doctor_fee) && !empty($request->payment_mode)) {
//return "fgkj";
            $case_master->billAmount = $request->doctor_fee;
            $case_master->payment_mode = $request->payment_mode;
        }
        $case_master->case_type = $request->case_type;

        $case_appointment_time = "";
        if ($case_master->case_type == "appointment") {
            $case_appointment_time = $request->case_appointment_time;
        }

        $case_master->case_appointment_time = $case_appointment_time;
//$case_master->FollowUpDate = null;
//if (isset($request->appointment_dt) && $request->appointment_dt != null && $request->appointment_dt != '') {
//    $case_master->FollowUpDate = Carbon::createFromFormat('d/M/Y', $request->appointment_dt)->format('Y-m-d');
//}
//$case_master->FollowUpTimeSlot = $request->appointment_timeslot;
//$case_master->FollowUpDoctor_Id = $request->FollowUpDoctor_id;
//$case_master->treatment = $request->treatment;
//$case_master->patient_weight = $request->patient_weight;
//$case_master->patient_height = $request->patient_height;
        $case_master->doctor_id = $request->doctor_id;

//if ($request->hasFile('diagnosis_file')) {
//    $case_master->diagnosis_filePath = $request->file('diagnosis_file')->store('uploads');
//}
//if ($request->hasFile('Reports_file')) {
//    $case_master->ReportfilePath = $request->file('Reports_file')->store('uploads');
//}
//if ($request->hasFile('Before_file')) {
//    $case_master->BeforeImagePath = $request->file('Before_file')->store('uploads');
//}
//if ($request->hasFile('After_file')) {
//    $case_master->AfterImagePath = $request->file('After_file')->store('uploads');
//}
		/*
		if (!isset($request->uhid_no) || $request->uhid_no == "") {
			$uhid_no = Setting::where('name', 'uhid_prefix')->first()->value . "_" . str_pad($case_master->id, 5, "0", STR_PAD_LEFT);
			$case_master->uhid_no = $uhid_no;
		}
		*/
		
		$sql = "SELECT id, DATE(created_at) FROM `case_master` WHERE DATE(created_at) = '".date('Y-m-d')."'";
        
        $total_records = DB::select(DB::raw($sql));
        $current_patient = count($total_records) + 1;
        $uhid_ipd_used_data = [];
        
        if (!isset($request->uhid_no) || $request->uhid_no == "") {
			/*
            $uhid_no = Setting::where('name', 'uhid_prefix')->first()->value . " / " . str_pad($current_patient, 5, "0", STR_PAD_LEFT);
            $uhid_no .= " / ".date('d/m/Y');
            $case_master->uhid_no = $uhid_no;
			*/
			$all_settings = Setting::all()->keyBy('name');
        
			$ipd_ipd_prefix     = $all_settings['ipd_prefix']->value;
			$ipd_uhid_prefix    = $all_settings['uhid_prefix']->value;  
			
			$registration_year  = date('Y');
			
			/*
			$uhid_number_count_sql = "SELECT DISTINCT new_table.uhid FROM (SELECT id as patients_id, NULL as case_master_id, uhid_number as uhid FROM patients  where registration_year = '".$registration_year."'
UNION
SELECT NULL as patients_id, id as case_master_id, uhid_no as uhid FROM case_master where registration_year = '".$registration_year."') as new_table WHERE new_table.uhid IS NOT NULL";
			*/
			
		$uhid_number_count_sql = "SELECT DISTINCT uhid FROM uhid_ipd_used WHERE uhid IS NOT NULL AND uhid <> '' AND registration_year = '".$registration_year."'";
        
        $uhid_number_count = DB::select($uhid_number_count_sql);
		$universal_uhid_number   = count($uhid_number_count) + 1;	
			
$uhid_no = $ipd_uhid_prefix.str_pad($universal_uhid_number, 4, 0, STR_PAD_LEFT).'/'.$registration_year;
        $case_master->uhid_no = $uhid_no;
			
			 $case_master->registration_year                        = $registration_year;           
             $case_master->uhid_suggested                     = $uhid_no;
			
$uhid_ipd_used_data = ['uhid' => $uhid_no, 'case_id' => $case_master->id, 'registration_year' => $registration_year];
			
        } else {
            $case_master->uhid_no = $request->uhid_no;
        }

        if ($request->submit == "submit_ipd") {
            $case_master->is_ipd = '1';
        }

        $case_master->save();
		
 if(!empty($uhid_ipd_used_data)) {

            $uhid_ipd_used_data['case_id'] = $case_master->id;
           // echo "<pre>"; print_r( $uhid_ipd_used_data); exit;
            DB::table('uhid_ipd_used')->insert($uhid_ipd_used_data);   
        }

        //$uhid_no = Setting::where('name', 'uhid_prefix')->first()->value . "_" . str_pad($case_master->id, 5, "0", STR_PAD_LEFT);
        //$case_master->uhid_no = $uhid_no;

        if ($request['profile_picture'] != "") {
//$safeName = $this->savePhoto($request['profile_picture'], $uhid_no);

            $img = $request['profile_picture'];
            $folderPath = public_path() . '/uploads/';

            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);
            $fileName = $uhid_no . '.png';

            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);

//print_r($fileName);

            $case_master->patient_pic = $fileName;
        }

        /*
          if($request['profile_picture'] != "") {
          //echo "<img src='".$request['profile_picture']."'>"; exit;
          $file = base64_decode($request['profile_picture']);
          $folderName = 'public/uploads/';
          $safeName = $uhid_no.'.'.'jpg';
          $destinationPath = public_path() . $folderName;
          $success = file_put_contents(public_path().'/uploads/'.$safeName, $file);
          }
         */



        $case_master->save();

        if (!empty($request->doctor_fee) && !empty($request->payment_mode)) {
// return "not null";
            $req_bill_item = new Opd_bill;
            $req_bill_item->case_number = $case_master->case_number;
            $req_bill_item->bill_item = 'Consulting Charges';
            $req_bill_item->bill_Amount = $request->doctor_fee;
            $req_bill_item->payment_mode = $request->payment_mode;
            $req_bill_item->case_id = $case_master->id ?: 0;
            $req_bill_item->save();
        }
        return $case_master;
    }

    public function savePhoto($image, $name) {



        try {
            if (strlen($image) > 128) {
                list($mime, $data) = explode(';', $image);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);

                $mime = explode(':', $mime)[1];
                $ext = explode('/', $mime)[1];
//$name = mt_rand().time();
                $savePath = 'uploads/images/' . $name . '.' . $ext;

                file_put_contents(public_path() . '/' . $savePath, $data);

                echo "============ : " . public_path() . '/' . $savePath;
                exit;
                return $name . '.' . $ext;
            }
        } catch (\Exception $e) {
//doing nothing here for not breaking the loop
// you can pass the error message to your view if you want.
        }
    }

    public function autocompleteList(Request $request) {
//DB::enableQueryLog();
        $query = $request->get('query', '');
        $PropertyName = $request->get('PropertyName', '');
        $PropertyNameAs = $PropertyName . ' as abcdds';
        $posts = patient_details::where($PropertyName, 'LIKE', '%' . $query . '%')->take(20)->pluck($PropertyName)->toArray(); //->get(array($PropertyNameAs)); 
//return var_dump(DB::getQueryLog());
        return response()->json($posts);
    }

    public function genericAutocompleteList(Request $request) {
//DB::enableQueryLog();
        $query = $request->get('query', '');
        $tableName = $request->get('tableName', '');
        $PropertyName = $request->get('PropertyName', '');
        $PropertyNameAs = $PropertyName . ' as abcdds';
//$posts = patient_details::where($PropertyName,'LIKE','%'.$query.'%')->take(20)->pluck($PropertyName)->toArray();//->get(array($PropertyNameAs));
        $posts = DB::table($tableName)->select($PropertyName)->where($PropertyName, 'LIKE', '%' . $query . '%')->take(20)->pluck($PropertyName)->toArray();
//return var_dump(DB::getQueryLog());
        return response()->json($posts);
    }

    public function get_dropdown_options($form_name = "gyn", $drop_down_field = "History") {

        if ($form_name == "gyn") {
            $form_dropdowns = gyn_form_dropdowns::where('formName', 'gyn')->where('fieldName', $drop_down_field)->pluck('ddText', 'ddText')->toArray();
        }
// $form_dropdowns = gyn_form_dropdowns::where('formName', 'gyn')->get();
// echo "======================="; dd($form_dropdowns); exit;
        $form_dropdowns->where('fieldName', 'History')->pluck('ddText', 'ddText')->toArray();
        return Response::json(['view' => View::make('yourbladename', $data)->render(), 'flag' => $flag]);
    }

    public function get_form_dropdowns_array($form_name = "gyn") {
        $form_dropdowns_array = [];
        $form_dropdowns = [];
        if ($form_name == "gyn") {
            $form_dropdowns = gyn_form_dropdowns::where('formName', 'gyn')->get();
        }

        foreach ($form_dropdowns as $form_dropdowns_row) {
            $form_dropdowns_array[$form_dropdowns_row->fieldName][$form_dropdowns_row->id]['ddText'] = $form_dropdowns_row->ddText;
            $form_dropdowns_array[$form_dropdowns_row->fieldName][$form_dropdowns_row->id]['ddValue'] = $form_dropdowns_row->ddValue;
        }

        return $form_dropdowns_array;
    }

}
