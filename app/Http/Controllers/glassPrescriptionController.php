<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
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
use App\case_number_generators;
use App\doctor_form_mapping;
use App\DoctorBill;
use App\glass_prescription;
use App\helperClass\drAppHelper;
use App\Models\form_dropdowns;
use Storage;
use Auth;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\Mail;
use App\Mail\GlassMail;
use App\helperClass\CommonHelper;

class glassPrescriptionController extends AdminRootController
{
public $Email_id;
    public function index(Request $request)
    {
        return view('glassPrescription.index', []);
    }

     public function __construct()
    {
        $this->acc=0;
         $this->commonHelper = new CommonHelper();
    }




    public function edit(Request $request, $id) {
      $user = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='Eyeglass/glassPrescription/edit'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("2_glassPrescription",Auth::user()->id, 'add_permission');
        if ($this->acc == 1) {
               $case_master  = Case_master::findOrFail($id);
        $glass_prescription = $case_master ->glass_prescription()->first();
        if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
            $glass_prescription = new glass_prescription();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $form_dropdowns = form_dropdowns::where('formName', 'GlassPrescription')->get();
        
        $refraction_dropdowns = DB::table('refraction_dropdown')->get();
      // $refraction_dropdowns_arr = $refraction_dropdowns->where('key_value', 'sph')->pluck('os','od')->toArray();
      $refraction_dropdowns_arr['sph'] = [];
      $refraction_dropdowns_arr['cyl'] = [];
      $refraction_dropdowns_arr['vision'] = [];
      foreach($refraction_dropdowns as $refraction_dropdowns_row) {
           $refraction_dropdowns_arr[$refraction_dropdowns_row->key_value][$refraction_dropdowns_row->id] = $refraction_dropdowns_row->os; 
      }
      
        return view('glassPrescription.add', compact('case_master','glass_prescription', 'DateWiseRecordLst', 'form_dropdowns','refraction_dropdowns_arr'));
        }

          else
        {
           $url= url()->previous();
           return redirect($url);
        }
    }

    public function update(Request $request){

        $isEdit = true;
        $form_details = glass_prescription::where('case_id', $request->case_id)->first();
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new glass_prescription();
            $isEdit = false;
        }

        if (!empty($request->retino_scopy_OD)) {
            $img = filter_input(INPUT_POST, 'retino_scopy_OD', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/glassPrescription/'. $form_details->case_id .'_retino_scopy_OD.png');
            file_put_contents($storagePath, $data);
            $form_details->retino_scopy_OD = 'uploads/glassPrescription/'.$form_details->case_id .'_retino_scopy_OD.png';
            //Storage::Delete($form_details->retino_scopy_OD);
        }
        if (!empty($request->retino_scopy_OS)) {
            $img = filter_input(INPUT_POST, 'retino_scopy_OS', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/glassPrescription/'. $form_details->case_id .'_retino_scopy_OS.png');
            file_put_contents($storagePath, $data);
            $form_details->retino_scopy_OS = 'uploads/glassPrescription/'.$form_details->case_id .'_retino_scopy_OS.png';
            //Storage::Delete($form_details->retino_scopy_OS);
        }

        $form_details->fill($request->except(['retino_scopy_OD','retino_scopy_OS']));
        $form_details->save();
        // \LogActivity::addToLog('Glass Prescription added successfully');
        return redirect()->back()->with('flash_message', 'Record added successfully');
    }

    public function deleteImage(Request $request){
        $glassPrescription = glass_prescription::where('case_id', $request->case_id)->first();
        if($request->imageName == "retino_scopy_OD"){
            Storage::Delete($glassPrescription->retino_scopy_OD);
            $glassPrescription->retino_scopy_OD = null;
            $glassPrescription->save();
        }
        if($request->imageName == "retino_scopy_OS"){
            Storage::Delete($glassPrescription->retino_scopy_OS);
            $glassPrescription->retino_scopy_OS = null;
            $glassPrescription->save();
        }
		return "OK";
    }

    public function printbill($case_id) {

        $user = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='Eyeglass/glassPrescription/print'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("2_glassPrescription",Auth::user()->id, 'view_permission');
        if ($this->acc == 1) {
               $case_master  = Case_master::findOrFail($case_id);
        $glass_prescription = $case_master ->glass_prescription()->first();
        if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
            $glass_prescription = new glass_prescription();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $billdata = $case_master->Bill_detail()->get();

	//$doctor = DB::table('users')->whereNotNull('doctor_degree')->whereNotNull('doctor_registration_number')->first();
        $doctor = DB::table('doctors')->where('id', $case_master->doctor_id)->first();
        
        
        return view('glassPrescription.print', compact('case_master','glass_prescription', 'DateWiseRecordLst', 'logoUrl', 'billdata', 'doctor'));
   
        }

          else
        {
           $url= url()->previous();
           return redirect($url);
        }
    }
     
////////////////////////email////////////////////////
 public function glass_prescriptionEmail(Request $request){

         $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
        if (is_null($case_gen)) {
            $case_gen = $this->createCaseNumber();
        }
        
        $isEdit = true;
        $form_details = glass_prescription::where('case_id', $request->case_id)->first();
        //return $form_details;
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new glass_prescription();
            $isEdit = false;
        }

        if (!empty($request->retino_scopy_OD)) {
            $img = filter_input(INPUT_POST, 'retino_scopy_OD', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/glassPrescription/'. $form_details->case_id .'_retino_scopy_OD.png');
            file_put_contents($storagePath, $data);
            $form_details->retino_scopy_OD = 'uploads/glassPrescription/'.$form_details->case_id .'_retino_scopy_OD.png';
            //Storage::Delete($form_details->retino_scopy_OD);
        }
        if (!empty($request->retino_scopy_OS)) {
            $img = filter_input(INPUT_POST, 'retino_scopy_OS', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/glassPrescription/'. $form_details->case_id .'_retino_scopy_OS.png');
            file_put_contents($storagePath, $data);
            $form_details->retino_scopy_OS = 'uploads/glassPrescription/'.$form_details->case_id .'_retino_scopy_OS.png';
            //Storage::Delete($form_details->retino_scopy_OS);
        }

        $form_details->fill($request->except(['retino_scopy_OD','retino_scopy_OS']));
        $form_details->save();
         if (Input::get('emailtoother')) {

             if($request->email && !empty($request->email)){
                    $this->validate($request, [
                    'email' => 'required|email'
                    
                ]);
                      $this->Email_id=$request->email;
                    $msg=config('app.name', 'Laravel');
                   $case_master  = Case_master::findOrFail($request->case_id);
        $glass_prescription = $case_master ->glass_prescription()->first();
        if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
            $glass_prescription = new glass_prescription();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $billdata = $case_master->Bill_detail()->get();
                  $doctorlst = DB::table('doctors')->select('doctor_name')->where('id','=', $request->doctor_id)->first();
        $doctor_name= $doctorlst->doctor_name;



                    
                    //return $strength;
                    $mailContent = compact('case_master','glass_prescription', 'DateWiseRecordLst', 'logoUrl', 'billdata','msg','doctor_name');


                     $mailTemplate = 'glassPrescription.FormEmailglassPrescription';

                   

                Mail::to($request->email)->send(new GlassMail(compact('case_master','glass_prescription', 'DateWiseRecordLst', 'logoUrl', 'billdata','msg','doctor_name'), $mailTemplate));
                }
            }
            
       return redirect()->back()->with('flash_message', 'Email has been sent to '. $this->Email_id);
         
              
        } 
           
   ////////////////////////email////////////////////////
 public function glass_prescriptionEmail1(Request $request){
         $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
        if (is_null($case_gen)) {
            $case_gen = $this->createCaseNumber();
        }
        
       
              $isEdit = true;
        $form_details = glass_prescription::where('case_id', $request->case_id)->first();
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new glass_prescription();
            $isEdit = false;
        }

        if (!empty($request->retino_scopy_OD)) {
            $img = filter_input(INPUT_POST, 'retino_scopy_OD', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/glassPrescription/'. $form_details->case_id .'_retino_scopy_OD.png');
            file_put_contents($storagePath, $data);
            $form_details->retino_scopy_OD = 'uploads/glassPrescription/'.$form_details->case_id .'_retino_scopy_OD.png';
            //Storage::Delete($form_details->retino_scopy_OD);
        }
        if (!empty($request->retino_scopy_OS)) {
            $img = filter_input(INPUT_POST, 'retino_scopy_OS', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/glassPrescription/'. $form_details->case_id .'_retino_scopy_OS.png');
            file_put_contents($storagePath, $data);
            $form_details->retino_scopy_OS = 'uploads/glassPrescription/'.$form_details->case_id .'_retino_scopy_OS.png';
            //Storage::Delete($form_details->retino_scopy_OS);
        }

        $form_details->fill($request->except(['retino_scopy_OD','retino_scopy_OS']));
        $form_details->save();
        if(Input::get('SubmitMail'))
        {
             if($request->patient_emailId && !empty($request->patient_emailId)){
                      $this->validate($request, [
                        'patient_emailId' => 'required|email'

                    ]);
                    $this->Email_id=$request->patient_emailId;
                    $msg=config('app.name', 'Laravel');
                  $case_master  = Case_master::findOrFail($request->case_id);
        $glass_prescription = $case_master ->glass_prescription()->first();
        if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
            $glass_prescription = new glass_prescription();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $billdata = $case_master->Bill_detail()->get();
         $doctorlst = DB::table('doctors')->select('doctor_name')->where('id','=', $request->doctor_id)->first();
        $doctor_name= $doctorlst->doctor_name;


                    
                    //return $strength;
                    $mailContent = compact('case_master','glass_prescription', 'DateWiseRecordLst', 'logoUrl', 'billdata','msg','doctor_name');


                     $mailTemplate = 'glassPrescription.FormEmailglassPrescription';

                   

                Mail::to($request->patient_emailId)->send(new GlassMail(compact('case_master','glass_prescription', 'DateWiseRecordLst', 'logoUrl', 'billdata','msg','doctor_name'), $mailTemplate));
                

            }
        }
        
           return redirect()->back()->with('flash_message', 'Email has been sent to '. $this->Email_id);
           
         
              
        }    


}