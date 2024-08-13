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
use Illuminate\Support\Facades\Log;

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
use App\eyeform;
use App\Eye_Blood_Investigation;
use App\blood_investigation_titles;
use App\helperClass\drAppHelper;
use App\glass_prescription;
use App\Models\form_dropdowns;
use App\Models\eyeformmultipleentry;
use App\report_image;
use Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\casePaperMail;
use App\Mail\MyDemoMail;
use Redirect;
use PDF;
use App\Models\eyform_refraction_retina_scopy;
use App\Models\eyform_vision_pgp;

use App\timeslot;
use App\field_type_memory;
use App\field_type_data;

use Auth;
use Response;
use App\PaymentModes;
use App\helperClass\CommonHelper;

class EyeFormController extends AdminRootController
{
public $Email_id;
 public function __construct()
    {        
       // $this->acc=0;
        $this->commonHelper = new CommonHelper();
    }
public function SetNormalValues($case_id){
     
     $doc1 =  DB::select("SELECT * from doctor");

      
        $form_details = eyeform::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new eyeform();
        }
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        $report_image = report_image::where('case_id', $case_id)->get();
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();

        //$defaultValues = form_dropdowns::where('formName', 'EyeForm')->where('isdefault', 1)->get();
        //DB::enableQueryLog();
        //$defaultValues = null;
        $formDropDown_DefaultNonNull = form_dropdowns::select(DB::raw("(CASE WHEN isdefault IS NOT NULL and isdefault != 0 THEN ddValue ELSE null END) AS ddText"), 'fieldName')->where('formName', 'EyeForm')->where('isdefault', '1')->groupBy('fieldName')->pluck('ddText', 'fieldName')->toArray();
        
        $formDropDown_DefaultNull = form_dropdowns::select(DB::raw("(CASE WHEN isdefault IS NOT NULL and isdefault != 0 THEN ddValue ELSE null END) AS ddText"), 'fieldName')->where('formName', 'EyeForm')->where('isdefault', '0')->orWhere('isdefault', '=', null)->whereNotIn('fieldName', array_keys($formDropDown_DefaultNonNull))->groupBy('fieldName')->pluck('ddText', 'fieldName')->toArray();
        
        //from form_dropdowns where formName = ?', ['EyeForm']);//->pluck('defaultValue', 'fieldName');
        //var_dump(DB::getQueryLog());
        
        $defaultValues = array_merge($formDropDown_DefaultNonNull, $formDropDown_DefaultNull);


        //return var_dump($defaultValues);
        //return redirect()->back()->with($casedata)->with($form_details)->with($form_dropdowns)->with($report_image)->with($defaultValues)->with($defaultValuesA);
        return view('EyeForm.EyeForm', compact('casedata','form_details', 'form_dropdowns', 'report_image', 'defaultValues','doc1'));
    
}

// Send Email And Save
    // Send Email And Save
    public function SendEmailSave(Request $request)
    { 
        // send email to other
     if (Input::get('Send_email')) {
    if($request->Email_To && !empty($request->Email_To)){
		$this->validate($request, [
                    'Email_To' => 'required|email'
                    
                ]);
          $this->Email_id=$request->Email_To;
                
                $form_details = eyeform::where('case_id', $request->case_id)->first();
                if ($form_details === null) {
                    $form_details = new eyeform();
                }
                $helperCls = new drAppHelper();
                $casedata = $helperCls->getCaseData($request->case_id);
                $logoUrl = $helperCls->GetLetterHeadImageUrl();
                $FooterUrl = $helperCls->GetLetterFooterImageUrl();
                $case_master  = Case_master::findOrFail($request->case_id);
                $pdfname="eyeFormEmail".$request->case_id.".pdf";
                $case_master->pdfname=$pdfname;
                $case_master->save();
                $glass_prescription = $case_master ->glass_prescription()->first();
                if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
                    $glass_prescription = new glass_prescription();
                }
               
               if(\File::exists(public_path('pdf/'.$pdfname))){
				  \File::delete(public_path('pdf/'.$pdfname));
				$pdf = PDF::loadView('EyeForm.eyeFormEmail1', compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription'));
				$path = public_path('pdf/');
				$fileName = 'eyeFormEmail'.$request->case_id.'.pdf' ;
				$pdf->save($path . '/' . $fileName);
				}else{
				$pdf = PDF::loadView('EyeForm.eyeFormEmail1', compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription'));
				$path = public_path('pdf/');
				$fileName = 'eyeFormEmail'.$request->case_id.'.pdf' ;
				$pdf->save($path . '/' . $fileName);
				}
				
				//return $pdf->download($fileName);

                $mailContent = compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription');
                $mailTemplate = 'EyeForm.eyeFormEmail1';
				  

                Mail::to($request->Email_To)->send(new MyDemoMail($request->case_id));
                
                }
	}
                // send email to existing email id
		 if (Input::get('SubmitMail')) {
                if($request->patient_emailId && !empty($request->patient_emailId)){
					$this->validate($request, [
                    'patient_emailId' => 'required|email'
                    
                ]);
                    $this->Email_id=$request->patient_emailId;
                
                $form_details = eyeform::where('case_id', $request->case_id)->first();
                if ($form_details === null) {
                    $form_details = new eyeform();
                }
                $helperCls = new drAppHelper();
                $casedata = $helperCls->getCaseData($request->case_id);
                $logoUrl = $helperCls->GetLetterHeadImageUrl();
                $FooterUrl = $helperCls->GetLetterFooterImageUrl();
                $case_master  = Case_master::findOrFail($request->case_id);
                $pdfname="eyeFormEmail".$request->case_id.".pdf";
                $case_master->pdfname=$pdfname;
                $case_master->save();
                $glass_prescription = $case_master ->glass_prescription()->first();
                if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
                    $glass_prescription = new glass_prescription();
                }
               
               if(\File::exists(public_path('pdf/'.$pdfname))){
				  \File::delete(public_path('pdf/'.$pdfname));
				$pdf = PDF::loadView('EyeForm.eyeFormEmail1', compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription'));
				$path = public_path('pdf/');
				$fileName = 'eyeFormEmail'.$request->case_id.'.pdf' ;
				$pdf->save($path . '/' . $fileName);
				}else{
				$pdf = PDF::loadView('EyeForm.eyeFormEmail1', compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription'));
				$path = public_path('pdf/');
				$fileName = 'eyeFormEmail'.$request->case_id.'.pdf' ;
				$pdf->save($path . '/' . $fileName);
				}
				
				//return $pdf->download($fileName);

                $mailContent = compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription');
                $mailTemplate = 'EyeForm.eyeFormEmail1';
				  

                Mail::to($request->patient_emailId)->send(new MyDemoMail($request->case_id));
                
                }
	}
        if (Input::get('submit_reportImage')) {
            if ($request->hasFile('reportImage')) {
                $report_image = new report_image();
                $report_image->reportFileName = 'EyeFormImage';
                $report_image->case_id = $request->case_id;
                $report_image->filePath = $request->file('reportImage')->store('uploads');
                $report_image->save();

                $helperCls = new drAppHelper();
                $casedata = $helperCls->compress(storage_path('app/'.$report_image->filePath), storage_path('app/'.$report_image->filePath), 90);
            }
            return redirect()->back()->with('flash_message', 'Record added successfully');//->withInputs();
        }

        if (Input::get('delete_reportImage')) {

            $reportFile = report_image::findOrFail($request['delete_reportImage']);
            if ($reportFile === null) {
                return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
            }
    
            if (!empty($reportFile->filePath)) {
                Storage::Delete($reportFile->filePath);
            }
            $reportFile->delete();
        
            return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
        }

        //$patient_details = patient_details();
        $isEdit = true;
        $form_details = eyeform::where('case_id', $request->case_id)->first();
        $case_master = Case_master::findOrFail($request->case_id);
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new eyeform();
            $isEdit = false;
        }
 if (isset($request->FollowUpDoctor_id) && isset($request->appointment_dt) && $request->appointment_dt != null && $request->appointment_dt != '') {
    $case_master->FollowUpDate =  $request->appointment_dt;
    $case_master->FollowUpTimeSlot = $request->FollowUpTimeSlot;
    $case_master->FollowUpDoctor_Id = $request->FollowUpDoctor_id;
        }
        if ($request->hasFile('Before_file')) {
            $case_master->BeforeImagePath = $request->file('Before_file')->store('uploads');
        }
        if ($request->hasFile('After_file')) {
            $case_master->AfterImagePath = $request->file('After_file')->store('uploads');
        }
       
      
        $case_master->touch(); //updated_at = Carbon::now();
        $case_master->save();


        $form_details->fill($request->except(['OdImg1', 'OsImg1', 'OdImg2', 'OsImg2', 'Before_file', 'After_file','otherDetailsDiagnosis']));
        $form_details->save();

        //Save file
        if (!empty($request->OdImg1)) {

            $img = filter_input(INPUT_POST, 'OdImg1', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OdImg1.png');
            file_put_contents($storagePath, $data);
            $form_details->OdImg1 = 'uploads/eyeform/'.$form_details->id .'_OdImg1.png';
            //Storage::Delete($form_details->OdImg1);
        }
        if (!empty($request->OsImg1)) {

            $img = filter_input(INPUT_POST, 'OsImg1', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OsImg1.png');
            file_put_contents($storagePath, $data);
            $form_details->OsImg1 = 'uploads/eyeform/'.$form_details->id .'_OsImg1.png';
            //Storage::Delete($form_details->OsImg1);
        }
        if (!empty($request->OdImg2)) {

            $img = filter_input(INPUT_POST, 'OdImg2', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OdImg2.png');
            file_put_contents($storagePath, $data);
            $form_details->OdImg2 = 'uploads/eyeform/'.$form_details->id .'_OdImg2.png';;
            //Storage::Delete($form_details->OdImg2);
        }
        if (!empty($request->OsImg2)) {

            $img = filter_input(INPUT_POST, 'OsImg2', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OsImg2.png');
            file_put_contents($storagePath, $data);
            $form_details->OsImg2 = 'uploads/eyeform/'.$form_details->id .'_OsImg2.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->retino_scopy_OD)) {

            $img = filter_input(INPUT_POST, 'retino_scopy_OD', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_retino_scopy_OD.png');
            file_put_contents($storagePath, $data);
            $form_details->retino_scopy_OD = 'uploads/eyeform/'.$form_details->id .'_retino_scopy_OD.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->retino_scopy_OS)) {

            $img = filter_input(INPUT_POST, 'retino_scopy_OS', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_retino_scopy_OS.png');
            file_put_contents($storagePath, $data);
            $form_details->retino_scopy_OS = 'uploads/eyeform/'.$form_details->id .'_retino_scopy_OS.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->gonio_od)) {

            $img = filter_input(INPUT_POST, 'gonio_od', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_gonio_od.png');
            file_put_contents($storagePath, $data);
            $form_details->gonio_od = 'uploads/eyeform/'.$form_details->id .'_gonio_od.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->gonio_os)) {

            $img = filter_input(INPUT_POST, 'gonio_os', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_gonio_os.png');
            file_put_contents($storagePath, $data);
            $form_details->gonio_os = 'uploads/eyeform/'.$form_details->id .'_gonio_os.png';
            //Storage::Delete($form_details->OsImg2);
        }

        if (!empty($request->OdImg1) || !empty($request->OsImg1) || !empty($request->OdImg2) || !empty($request->OsImg2) || !empty($request->retino_scopy_OD) || !empty($request->retino_scopy_OS) || !empty($request->gonio_od) || !empty($request->gonio_os)){
            $form_details->save();
        }
        
        #region MultipleEntry
        $EfMultiEntryArray = array();
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'ChiefComplaint', count($request->ChiefComplaint), $request->ChiefComplaint_OD, $request->ChiefComplaint_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        //$EfMultiEntryArray = $EfMultiEntryArray + $multientryArry;
        //$form_details->eyeformmultipleentry()->saveMany($multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'OpthalHistory',count($request->OpthalHistory), $request->OpthalHistory_OD, $request->OpthalHistory_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        //$form_details->eyeformmultipleentry()->saveMany($multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'SystemicHistory',count($request->SystemicHistory), $request->SystemicHistory_OD, $request->SystemicHistory_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'ConjAndLids',count($request->ConjAndLids), $request->ConjAndLids_OD, $request->ConjAndLids_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'Lids',count($request->Lids), $request->Lids_OD, $request->Lids_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'AC',count($request->AC), $request->AC_OD, $request->AC_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'IRIS',count($request->IRIS), $request->IRIS_OD, $request->IRIS_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'sac',count($request->sac), $request->sac_OD, $request->sac_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'Retina',count($request->Retina), $request->Retina_OD, $request->Retina_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'Macula',count($request->Macula), $request->Macula_OD, $request->Macula_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'ONH',count($request->ONH), $request->ONH_OD, $request->ONH_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'OrbitSacsEyeMotility',count($request->OrbitSacsEyeMotility), $request->OrbitSacsEyeMotility_OD, $request->OrbitSacsEyeMotility_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'cornia',count($request->cornia), $request->cornia_od, $request->cornia_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'pupilIrisac',count($request->pupilIrisac), $request->pupilIrisac_OD, $request->pupilIrisac_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'lens',count($request->lens), $request->lens_od, $request->lense_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'vitreoretinal',count($request->vitreoretinal), $request->vitreoretinal_OD, $request->vitreoretinal_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'diagno',count($request->diagno), $request->diagno_od, $request->diagno_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'OCT',count($request->OCT), $request->OCT_OD, $request->OCT_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'EOM',count($request->EOM), $request->EOM_OD, $request->EOM_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        
        $multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsDiagnosis', count($request->otherDetailsDiagnosis), $request->otherDetailsDiagnosis_OD, $request->otherDetailsDiagnosis_OS);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

//dd($_POST);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'surgery', count($request->surgeryCount), $request->surgery_OD, $request->surgery_OS);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

//Laser Procedure Entry

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'laser_procedure_laser_type', count($request->laser_procedure_laser_type), $request->laser_procedure_laser_type_OD, $request->laser_procedure_laser_type_OS);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $form_details->eyeformmultipleentry()->saveMany($EfMultiEntryArray);
        #endregion

//---------------------------------------------------------------------------------------------------------------------


$this->GetSingleEntryArray($form_details->id, 'flat_k', 1, [$request->flat_k_od], [$request->flat_k_os]);

$this->GetSingleEntryArray($form_details->id, 'flat_axis', 1, [$request->flat_axis_od], [$request->flat_axis_os]);

$this->GetSingleEntryArray($form_details->id, 'stap_k', 1, [$request->stap_k_od], [$request->stap_k_os]);

$this->GetSingleEntryArray($form_details->id, 'stap_axis', 1, [$request->stap_axis_od], [$request->stap_axis_os]);

$this->GetSingleEntryArray($form_details->id, 'axial_length', 1, [$request->axial_length_od], [$request->axial_length_os]);

$this->GetSingleEntryArray($form_details->id, 'optical_acd', 1, [$request->optical_acd_od], [$request->optical_acd_os]);

$this->GetSingleEntryArray($form_details->id, 'target_refraction', 1, [$request->target_refraction_od], [$request->target_refraction_os]);

$this->GetSingleEntryArray($form_details->id, 'lens_thickness', 1, [$request->lens_thickness_od], [$request->lens_thickness_os]);

$this->GetSingleEntryArray($form_details->id, 'wtw', 1, [$request->wtw_od], [$request->wtw_os]);

$this->GetSingleEntryArray($form_details->id, 'kc_formula_use', 1, [$request->kc_formula_use_od], [$request->kc_formula_use_os]);

$this->GetSingleEntryArray($form_details->id, 'type_of_lens', 1, [$request->type_of_lens_od], [$request->type_of_lens_os]);

$this->GetSingleEntryArray($form_details->id, 'se', 1, [$request->se_od], [$request->se_os]);

$this->GetSingleEntryArray($form_details->id, 'iol_cilinder', 1, [$request->iol_cilinder_od], [$request->iol_cilinder_os]);

$this->GetSingleEntryArray($form_details->id, 'other_details_comment', 1, [$request->other_details_comment], [$request->other_details_comment]);
$this->GetSingleEntryArray($form_details->id, 'surgery_comment', 1, [$request->surgery_comment], [$request->surgery_comment]);

//Laser Procedure Entry
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_date', 1, [$request->laser_procedure_date_OD], [$request->laser_procedure_date_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_power', 1, [$request->laser_procedure_power_OD], [$request->laser_procedure_power_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_exposure_time', 1, [$request->laser_procedure_exposure_time_OD], [$request->laser_procedure_exposure_time_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_sitting', 1, [$request->laser_procedure_sitting_OD], [$request->laser_procedure_sitting_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_spot_size', 1, [$request->laser_procedure_spot_size_OD], [$request->laser_procedure_spot_size_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_no_of_spots', 1, [$request->laser_procedure_no_of_spots_OD], [$request->laser_procedure_no_of_spots_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_note', 1, [$request->laser_procedure_note_OD], [$request->laser_procedure_note_OS]);

//-------------------------------------------------------------------------------------------------------------------------


      return redirect()->back()->with('flash_message', 'Email has been sent to '. $this->Email_id);   
	// return view('EyeForm.eyeFormEmail1',compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription'))  ;
    }

 

   public function SaveCaseHistory1_bk_16jan2022(Request $request) {
         $request->advance_amount = ($request->surgery_advance_amount != '') ? $request->surgery_advance_amount : $request->advance_amount;
       //echo "=========>>>>>>>>>> <pre>"; print_r($_POST); exit;
       if($request->finding_type == "template") {
            $eyeform_row = DB::table('eyeform')->where('case_id', $request->case_id)->select('id')->first();
            $fields = ['Lids','OrbitSacsEyeMotility','ConjAndLids','cornia','AC','IRIS','pupilIrisac','lens','vitreoretinal','Retina','retina_eye','ONH','Macula','sac'];
            DB::table('eyeformmultipleentry')->where('eyeformid', $eyeform_row->id)->whereIn('field_name', $fields)->delete();
           // return redirect()->back()->with('flash_message', 'Template added Successully.');
        }
        if (Input::get('submit_reportImage')) {
            if ($request->hasFile('reportImage')) {
                $report_image = new report_image();
                $report_image->reportFileName = 'EyeFormImage';
                $report_image->case_id = $request->case_id;
                $report_image->filePath = $request->file('reportImage')->store('uploads');
                $report_image->save();

                $helperCls = new drAppHelper();
                $casedata = $helperCls->compress(storage_path('app/'.$report_image->filePath), storage_path('app/'.$report_image->filePath), 90);
            }
            return redirect()->back()->with('flash_message', 'Record added successfully1');//->withInputs();
        }

        if (Input::get('delete_reportImage')) {

            $reportFile = report_image::findOrFail($request['delete_reportImage']);
            if ($reportFile === null) {
                return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
            }
    
            if (!empty($reportFile->filePath)) {
                Storage::Delete($reportFile->filePath);
            }
            $reportFile->delete();
        
            return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
        }
        
        if ( $request->hasFile('a_scan_images')) {
                //echo "in ifff";exit;
                $image = $request->File('a_scan_images');
                //echo "<pre> ============= ";print_r($image);exit;
                $destinationPath = 'a_scan_images/';
                $i=1;
                foreach ($image as $files) {
                   // echo "<pre> ============= ";print_r($files);exit;
                    $profileImage = time().$i++.'.'.$files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $report_image = new report_image();
                    $report_image->reportFileName = 'EyeFormScanImage';
                    $report_image->case_id = $request->case_id;
                    $report_image->filePath = $profileImage;
                    $report_image->save();

                    //$helperCls = new drAppHelper();
                    //$casedata = $helperCls->compress(storage_path('app/'.$report_image->filePath), storage_path('app/'.$report_image->filePath), 90);
                }
            }
            
            if ( $request->hasFile('sp_test_images')) {
                //echo "in ifff";exit;
                $image = $request->File('sp_test_images');
                //echo "<pre> ============= ";print_r($image);exit;
                $destinationPath = 'sp_test_images/';
                $i=1;
                foreach ($image as $files) {
                   // echo "<pre> ============= ";print_r($files);exit;
                    $profileImage = time().$i++.'.'.$files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $report_image = new report_image();
                    $report_image->reportFileName = 'EyeFormSpTestImage';
                    $report_image->case_id = $request->case_id;
                    $report_image->filePath = $profileImage;
                    $report_image->save();

                    //$helperCls = new drAppHelper();
                    //$casedata = $helperCls->compress(storage_path('app/'.$report_image->filePath), storage_path('app/'.$report_image->filePath), 90);
                }
            }

        //$patient_details = patient_details();
        $isEdit = true;
        $form_details = eyeform::where('case_id', $request->case_id)->first();
        $case_master = Case_master::findOrFail($request->case_id);
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new eyeform();
            $isEdit = false;
        }

		//======================== Start Systemic History Entry ==========================
		if(isset($request->SystemicHistory_OD)) {
		foreach($request->SystemicHistory_OD as $systemic_history_key => $systemic_history) {
			if($systemic_history != "") {
				$duration = isset($request->SystemicHistory_OD_duration) ? $request->SystemicHistory_OD_duration[$systemic_history_key]: '';
				DB::table('patients_systemic_history')->insert(['case_id' => $request->case_id, 'value' => $systemic_history, 'duration' => $duration]);
			}
		}
		}

		//echo "================>>>>>>>>> <pre>"; print_r($request->SystemicHistory_OD); exit;
       //========================= End Systemic history Entry ========================== 

    $case_master->casehistory_followup_notes = $request->casehistory_followup_notes;
 if (isset($request->FollowUpDoctorID) && isset($request->appointment_dt) && $request->appointment_dt != null && $request->appointment_dt != '') {
    $case_master->FollowUpDate =  $request->appointment_dt;
    $case_master->FollowUpTimeSlot = $request->FollowUpTimeSlot;
    $case_master->FollowUpDoctor_Id = $request->FollowUpDoctorID;
        }
        if ($request->hasFile('Before_file')) {
            $case_master->BeforeImagePath = $request->file('Before_file')->store('uploads');
        }
        if ($request->hasFile('After_file')) {
            $case_master->AfterImagePath = $request->file('After_file')->store('uploads');
        }
       
       $case_master->infection = $request->infection;
        $case_master->miscellaneous_history = $request->miscellaneous_history;
        
        $case_master->touch(); //updated_at = Carbon::now();
        $case_master->save();

        #region send followup SMS
        if (isset($request->appointment_dt) && $request->appointment_dt != null && $request->appointment_dt != '') {
            $client = new HttpGuzzle;
            $smsStr = 'Hi '
            .(empty($case_master->patient_name)?"":$case_master->patient_name)
            .' %0a your appointment is scheduled on :'
            .(empty($case_master->FollowUpDate)?"":$case_master->FollowUpDate) 
            . '  ' 
            .(empty($case_master->FollowUpTimeSlot)?"":$case_master->FollowUpTimeSlot) 
            .' %0a with '
            .env('SMS_From_Name')
            .' ' 
            .(empty($case_master->doctor()->doctor_name)?"":$case_master->doctor()->doctor_name);
            $urlGet = str_replace(array('xxxxcommaSeperatedxxxx','xxxxSMSTextxxxx'), array($case_master->patient_mobile, $smsStr), env('SMS_URL'));
            $res = $client->request('GET', $urlGet);
        }
        #endregion

        $form_details->fill($request->except(['OdImg1', 'OsImg1', 'OdImg2', 'OsImg2', 'Before_file', 'After_file','otherDetailsDiagnosis']));
        $form_details->save();
        
        $eyform_refraction_retina_scopy_details = eyform_refraction_retina_scopy::where('eyeformid', $form_details->id)->first();
        
        if ($eyform_refraction_retina_scopy_details === null) {
            $eyform_refraction_retina_scopy_details = new eyform_refraction_retina_scopy();
        }
        
        $eyform_refraction_retina_scopy_details_input = $request->all();
        $eyform_refraction_retina_scopy_details_input['eyeformid'] = $form_details->id;
        $eyform_refraction_retina_scopy_details->fill($eyform_refraction_retina_scopy_details_input);
        $eyform_refraction_retina_scopy_details->save();
        
        
        $eyform_vision_pgp_details = eyform_vision_pgp::where('eyeformid', $form_details->id)->first();
        
        if ($eyform_vision_pgp_details === null) {
                $eyform_vision_pgp_details = new eyform_vision_pgp();
        }

        $eyform_vision_pgp_details_input = $request->all();
        $eyform_vision_pgp_details_input['eyeformid'] = $form_details->id;
        $eyform_vision_pgp_details->fill($eyform_vision_pgp_details_input);
        $eyform_vision_pgp_details->save();
        
		
		//-------------save glass prescription --------------
		$glass_prescription_details = glass_prescription::where('case_id', $case_master->id)->first();

		//dd();
		$glass_prescription_details->fill($request->all());
        $glass_prescription_details->save();
		//------------ end save glass prescription -------------------
                
        //Save file
        if (!empty($request->OdImg1)) {

            $img = filter_input(INPUT_POST, 'OdImg1', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OdImg1.png');
            file_put_contents($storagePath, $data);
            $form_details->OdImg1 = 'uploads/eyeform/'.$form_details->id .'_OdImg1.png';
            //Storage::Delete($form_details->OdImg1);
        }
        if (!empty($request->OsImg1)) {

            $img = filter_input(INPUT_POST, 'OsImg1', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OsImg1.png');
            file_put_contents($storagePath, $data);
            $form_details->OsImg1 = 'uploads/eyeform/'.$form_details->id .'_OsImg1.png';
            //Storage::Delete($form_details->OsImg1);
        }
        if (!empty($request->OdImg2)) {

            $img = filter_input(INPUT_POST, 'OdImg2', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OdImg2.png');
            file_put_contents($storagePath, $data);
            $form_details->OdImg2 = 'uploads/eyeform/'.$form_details->id .'_OdImg2.png';;
            //Storage::Delete($form_details->OdImg2);
        }
        if (!empty($request->OsImg2)) {

            $img = filter_input(INPUT_POST, 'OsImg2', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OsImg2.png');
            file_put_contents($storagePath, $data);
            $form_details->OsImg2 = 'uploads/eyeform/'.$form_details->id .'_OsImg2.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->retino_scopy_OD)) {

            $img = filter_input(INPUT_POST, 'retino_scopy_OD', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_retino_scopy_OD.png');
            file_put_contents($storagePath, $data);
            $form_details->retino_scopy_OD = 'uploads/eyeform/'.$form_details->id .'_retino_scopy_OD.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->retino_scopy_OS)) {

            $img = filter_input(INPUT_POST, 'retino_scopy_OS', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_retino_scopy_OS.png');
            file_put_contents($storagePath, $data);
            $form_details->retino_scopy_OS = 'uploads/eyeform/'.$form_details->id .'_retino_scopy_OS.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->gonio_od)) {

            $img = filter_input(INPUT_POST, 'gonio_od', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_gonio_od.png');
            file_put_contents($storagePath, $data);
            $form_details->gonio_od = 'uploads/eyeform/'.$form_details->id .'_gonio_od.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->gonio_os)) {

            $img = filter_input(INPUT_POST, 'gonio_os', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_gonio_os.png');
            file_put_contents($storagePath, $data);
            $form_details->gonio_os = 'uploads/eyeform/'.$form_details->id .'_gonio_os.png';
            //Storage::Delete($form_details->OsImg2);
        }

        if (!empty($request->OdImg1) || !empty($request->OsImg1) || !empty($request->OdImg2) || !empty($request->OsImg2) || !empty($request->retino_scopy_OD) || !empty($request->retino_scopy_OS) || !empty($request->gonio_od) || !empty($request->gonio_os)){
            $form_details->save();
        }
        
        #region MultipleEntry
         $EfMultiEntryArray = array();
        $multientryArry = array();
        
        DB::table('eyeformmultipleentry')->where('eyeformid', $form_details->id)->where('field_name', 'other_details_treatment_given')->delete();
        
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'other_details_treatment_given', 1, [$request->treatment_given_od], [$request->treatment_given_os]);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        //echo "=====>>>>>>>> <pre>"; print_r($EfMultiEntryArray); exit;
        
       $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'ChiefComplaint', count($request->ChiefComplaint), $request->ChiefComplaint_OD, $request->ChiefComplaint_OS, $request->ChiefComplaint_OD_duration, $request->ChiefComplaint_OS_duration);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        //$EfMultiEntryArray = $EfMultiEntryArray + $multientryArry;
        //$form_details->eyeformmultipleentry()->saveMany($multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'OpthalHistory',count($request->OpthalHistory), $request->OpthalHistory_OD, $request->OpthalHistory_OS, $request->OpthalHistory_OD_duration, $request->OpthalHistory_OS_duration);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        //$form_details->eyeformmultipleentry()->saveMany($multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'SystemicHistory',count($request->SystemicHistory), $request->SystemicHistory_OD, $request->SystemicHistory_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'pastHistory',count($request->pastHistory), $request->pastHistory_OD, $request->pastHistory_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'planOfManagement',count($request->planOfManagement), $request->planOfManagement_OD, $request->planOfManagement_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'ConjAndLids',count($request->ConjAndLids), $request->ConjAndLids_OD, $request->ConjAndLids_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'Lids',count($request->Lids), $request->Lids_OD, $request->Lids_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'AC',count($request->AC), $request->AC_OD, $request->AC_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'IRIS',count($request->IRIS), $request->IRIS_OD, $request->IRIS_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'sac',count($request->sac), $request->sac_OD, $request->sac_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'Retina',count($request->Retina), $request->Retina_OD, $request->Retina_OS, $request->retina_eye_OD, $request->retina_eye_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'Macula',count($request->Macula), $request->Macula_OD, $request->Macula_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'tear_film_breakup_time',count($request->tear_film_breakup_time), $request->tear_film_breakup_time_OD, $request->tear_film_breakup_time_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'eye_sonography',count($request->eye_sonography), $request->eye_sonography_OD, $request->eye_sonography_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'ONH',count($request->ONH), $request->ONH_OD, $request->ONH_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'OrbitSacsEyeMotility',count($request->OrbitSacsEyeMotility), $request->OrbitSacsEyeMotility_OD, $request->OrbitSacsEyeMotility_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'cornia',count($request->cornia), $request->cornia_od, $request->cornia_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'pupilIrisac',count($request->pupilIrisac), $request->pupilIrisac_OD, $request->pupilIrisac_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'lens',count($request->lens), $request->lens_od, $request->lense_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'vitreoretinal',count($request->vitreoretinal), $request->vitreoretinal_OD, $request->vitreoretinal_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'diagno',count($request->diagno), $request->diagno_od, $request->diagno_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'OCT',count($request->OCT), $request->OCT_OD, $request->OCT_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'EOM',count($request->EOM), $request->EOM_OD, $request->EOM_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        


        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsAnteriorSegment', count($request->otherDetailsAnteriorSegment), $request->otherDetailsAnteriorSegment_OD, $request->otherDetailsAnteriorSegment_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsPosteriorSegment', count($request->otherDetailsPosteriorSegment), $request->otherDetailsPosteriorSegment_OD, $request->otherDetailsPosteriorSegment_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsAdditionalInformation', count($request->otherDetailsAdditionalInformationCount), $request->otherDetailsAdditionalInformation, $request->otherDetailsAdditionalInformation);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsAdvice', count($request->otherDetailsAdviceCount), $request->otherDetailsAdvice, $request->otherDetailsAdvice);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'surgery', count($request->surgeryCount), $request->surgery, $request->surgery);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsDiagnosis', count($request->otherDetailsDiagnosis), $request->otherDetailsDiagnosis_OD, $request->otherDetailsDiagnosis_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        //dd($_POST);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'surgery', count($request->surgeryCount), $request->surgery_OD, $request->surgery_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        //Laser Procedure Entry

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'laser_procedure_laser_type', count($request->laser_procedure_laser_type), $request->laser_procedure_laser_type_OD, $request->laser_procedure_laser_type_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'colour', count($request->colour), $request->colour_OD, $request->colour_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'schimerTest1', count($request->schimerTest1), $request->schimerTest1_OD, $request->schimerTest1_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'schimerTest2', count($request->schimerTest2), $request->schimerTest2_OD, $request->schimerTest2_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'perimetry_sp', count($request->perimetry_sp), $request->perimetry_sp_od, $request->perimetry_sp_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'laser_sp', count($request->laser_sp), $request->laser_sp_od, $request->laser_sp_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'oculizer_sp', count($request->oculizer_sp), $request->oculizer_sp_od, $request->oculizer_sp_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'ffa_sp', count($request->ffa_sp), $request->ffa_sp_od, $request->ffa_sp_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);


$form_details->eyeformmultipleentry()->saveMany($EfMultiEntryArray);
        #endregion

	//---------------------------------------------------------------------------------------------------------------------


$this->GetSingleEntryArray($form_details->id, 'flat_k', 1, [$request->flat_k_od], [$request->flat_k_os]);

$this->GetSingleEntryArray($form_details->id, 'flat_axis', 1, [$request->flat_axis_od], [$request->flat_axis_os]);

$this->GetSingleEntryArray($form_details->id, 'stap_k', 1, [$request->stap_k_od], [$request->stap_k_os]);

$this->GetSingleEntryArray($form_details->id, 'stap_axis', 1, [$request->stap_axis_od], [$request->stap_axis_os]);

$this->GetSingleEntryArray($form_details->id, 'axial_length', 1, [$request->axial_length_od], [$request->axial_length_os]);

$this->GetSingleEntryArray($form_details->id, 'optical_acd', 1, [$request->optical_acd_od], [$request->optical_acd_os]);

$this->GetSingleEntryArray($form_details->id, 'target_refraction', 1, [$request->target_refraction_od], [$request->target_refraction_os]);

$this->GetSingleEntryArray($form_details->id, 'lens_thickness', 1, [$request->lens_thickness_od], [$request->lens_thickness_os]);

$this->GetSingleEntryArray($form_details->id, 'wtw', 1, [$request->wtw_od], [$request->wtw_os]);

$this->GetSingleEntryArray($form_details->id, 'kc_formula_use', 1, [$request->kc_formula_use_od], [$request->kc_formula_use_os]);

$this->GetSingleEntryArray($form_details->id, 'type_of_lens', 1, [$request->type_of_lens_od], [$request->type_of_lens_os]);

$this->GetSingleEntryArray($form_details->id, 'se', 1, [$request->se_od], [$request->se_os]);

$this->GetSingleEntryArray($form_details->id, 'iol_cilinder', 1, [$request->iol_cilinder_od], [$request->iol_cilinder_os]);

$this->GetSingleEntryArray($form_details->id, 'other_details_comment', 1, [$request->other_details_comment], [$request->other_details_comment]);
$this->GetSingleEntryArray($form_details->id, 'surgery_comment', 1, [$request->surgery_comment], [$request->surgery_comment]);

//Laser Procedure Entry
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_date', 1, [$request->laser_procedure_date_OD], [$request->laser_procedure_date_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_power', 1, [$request->laser_procedure_power_OD], [$request->laser_procedure_power_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_exposure_time', 1, [$request->laser_procedure_exposure_time_OD], [$request->laser_procedure_exposure_time_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_sitting', 1, [$request->laser_procedure_sitting_OD], [$request->laser_procedure_sitting_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_spot_size', 1, [$request->laser_procedure_spot_size_OD], [$request->laser_procedure_spot_size_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_no_of_spots', 1, [$request->laser_procedure_no_of_spots_OD], [$request->laser_procedure_no_of_spots_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_note', 1, [$request->laser_procedure_note_OD], [$request->laser_procedure_note_OS]);

//-------------------------------------------------------------------------------------------------------------------------
//================= inser cutom data ===========================
		if(isset($request->custom_values)) {
		foreach($request->custom_values as $key => $custom_values_names_row) {
			if($request->custom_values_od[$key] != "") {
				if($custom_values_names_row == "systemicHistory") { 

					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];
					$fieldName1 = 'systemic_history';

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);

					DB::table('patients_systemic_history')->insert(['case_id' => $request->case_id, 'value' => $request->custom_values_od[$key]]);
				} else if(in_array($custom_values_names_row, ["dvn", "nvn", "withpinhole","colour_vision", "withglasses", "withglassesdilated"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['dvn' => 'dvn_od', 'nvn' => 'nvn_od', 'withpinhole' => 'withpinhole_OD', 'colour_vision' => 'colour_vision_OD', 'withglasses' => 'withglasses_OD', 'withglassesdilated' => 'with_glass_dilated_od'];
					$os = ['dvn' => 'dvn_os', 'nvn' => 'nvn_os', 'withpinhole' => 'withpinhole_OS', 'colour_vision' => 'colour_vision_OS', 'withglasses' => 'withglasses_OS', 'withglassesdilated' => 'with_glass_dilated_os'];
					
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");

						DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}

				} else if(in_array($custom_values_names_row, ["IOP", "CD", "Pachymetry","CCT"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['IOP' => 'IOP_OD', 'CD' => 'Ratio OD', 'Pachymetry' => 'Pachymetry_OD', 'CCT' => 'CCT_OD'];
					$os = ['IOP' => 'IOP_OS', 'CD' => 'Ratio OS', 'Pachymetry' => 'Pachymetry_OS', 'CCT' => 'CCT_OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					$fieldName1 = str_replace(' ', '_', $fieldName1);
					DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						$fieldName2 = str_replace(' ', '_', $fieldName2);
						DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}

				} else if(in_array($custom_values_names_row, ["k1", "k2", "axial_length", "lenspower", "KC", "lens_type"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['k1' => 'k1_od', 'k2' => 'k2_od', 'axial_length' => 'axial_length_OD', 'lenspower' => 'lenspower_od', 'KC' => 'KC_OD', 'lens_type' => 'lens_type_OD'];
					$os = ['k1' => 'k1_os', 'k2' => 'k2_os', 'axial_length' => 'axial_length_OS', 'lenspower' => 'lenspower_os', 'KC' => 'KC_OS', 'lens_type' => 'lens_type_OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					//$fieldName1 = str_replace(' ', '_', $fieldName1);
					DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						//$fieldName2 = str_replace(' ', '_', $fieldName2);
						DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}

				} else if(in_array($custom_values_names_row, ["otherDetailsDiagnosis", "otherDetailsAnteriorSegment", "otherDetailsPosteriorSegment"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					
					
					$fieldName1 = $custom_values_names_row;

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					//$fieldName1 = str_replace(' ', '_', $fieldName1);
					DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

				} else if(in_array($custom_values_names_row, ["colour", "schimerTest1", "schimerTest2", "perimetry_sp", "laser_sp", "oculizer_sp", "ffa_sp"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['colour' => 'colour OD', 'schimerTest1' => 'schimerTest1_OD', 'schimerTest2' => 'schimerTest2_OD', 'OCT' => 'OCT OD', 'EOM' => 'EOM OD', 'perimetry_sp' => 'perimetry_sp OD', 'laser_sp' => 'laser_sp OD', 'oculizer_sp' => 'oculizer_sp OD', 'ffa_sp' => 'ffa_sp OD'];
					$os = ['colour' => 'colour OS', 'schimerTest1' => 'schimerTest1_OS', 'schimerTest2' => 'schimerTest2_OS', 'OCT' => 'OCT OS', 'EOM' => 'EOM OS', 'perimetry_sp' => 'perimetry_sp OS', 'laser_sp' => 'laser_sp OS', 'oculizer_sp' => 'oculizer_sp OS', 'ffa_sp' => 'ffa_sp OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					$fieldName1 = str_replace(' ', '_', $fieldName1);
					//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						//$fieldName2 = str_replace(' ', '_', $fieldName2);
						//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}
                                        
                                        
                                        $custom_insert_data = array (
						'eyeformid' => $form_details->id,
						'field_name' => $custom_values_names_row,
						'field_value_OD' => $request->custom_values_od[$key]
					);

					if($request->custom_values_os[$key] != "") {
						$custom_insert_data['field_value_OS'] = $request->custom_values_os[$key];
					}

					DB::table('eyeformmultipleentry')->insert($custom_insert_data);
                                        

				} else if(in_array($custom_values_names_row, ["OCT", "EOM"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['OCT' => 'OCT OD', 'EOM' => 'EOM OD'];
					$os = ['OCT' => 'OCT OS', 'EOM' => 'EOM OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					$fieldName1 = str_replace(' ', '_', $fieldName1);
					//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						$fieldName2 = str_replace(' ', '_', $fieldName2);
						//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}


					$custom_insert_data = array (
						'eyeformid' => $form_details->id,
						'field_name' => $custom_values_names_row,
						'field_value_OD' => $request->custom_values_od[$key]
					);

					if($request->custom_values_os[$key] != "") {
						$custom_insert_data['field_value_OS'] = $request->custom_values_os[$key];
					}

					DB::table('eyeformmultipleentry')->insert($custom_insert_data);

				} else if(in_array($custom_values_names_row, ["ChiefComplaint", "OpthalHistory"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['ChiefComplaint' => 'Chief Complaint OD', 'OpthalHistory' => 'Opthal History OD'];
					$os = ['ChiefComplaint' => 'Chief Complaint OS', 'OpthalHistory' => 'Opthal History OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					$fieldName1 = str_replace(' ', '_', $fieldName1);
					//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						$fieldName2 = str_replace(' ', '_', $fieldName2);
						//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}


					$custom_insert_data = array (
						'eyeformid' => $form_details->id,
						'field_name' => $custom_values_names_row,
						'field_value_OD' => $request->custom_values_od[$key]
					);

					if($request->custom_values_os[$key] != "") {
						$custom_insert_data['field_value_OS'] = $request->custom_values_os[$key];
					}

					DB::table('eyeformmultipleentry')->insert($custom_insert_data);

				} else if(in_array($custom_values_names_row, ["Lids", "Orbit", "ConjAndLids", 
					"cornia", 
					"AC", 
					"IRIS", 
					"pupilIrisac", 
					"lens", 
					"vitreoretinal", 
					"Retina", 
					"ONH", 
					"Macula", 
					"sac","pastHistory", "planOfManagement", "tear_film_breakup_time", "eye_sonography"])) { 
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['Lids' => 'LIDS OD', 
						'Orbit' => 'OrbitSacsEyeMotility OD', 
						'ConjAndLids' => 'Conj And Lids OD',
						'cornia' => 'Cornea OD', 
						'AC' => 'AC OD', 
						'IRIS' => 'IRIS OD', 
						'pupilIrisac' => 'pupilIrisac OD', 
						'lens' => 'lens OD', 
						'vitreoretinal' => 'vitreoretinal OD', 
						'Retina' => 'Retina OD', 
						'ONH' => 'ONH OD', 
						'Macula' => 'Macula OD', 
						'sac' => 'sac OD',
                                                'pastHistory' => 'pastHistory_OD',
                                                'planOfManagement' => 'planOfManagement_OD',
                                                'tear_film_breakup_time' => 'tear_film_breakup_time_OD',
                                                'eye_sonography' => 'eye_sonography_OD'];

					$os = ['Lids' => 'LIDS OS', 
						'Orbit' => 'OrbitSacsEyeMotility OS', 
						'ConjAndLids' => 'Conj And Lids OS',
						'cornia' => 'Cornea OS', 
						'AC' => 'AC OS', 
						'IRIS' => 'IRIS OS', 
						'pupilIrisac' => 'pupilIrisac OS',  
						'lens' => 'lens OS', 
						'vitreoretinal' => 'vitreoretinal OS', 
						'Retina' => 'Retina OS', 
						'ONH' => 'ONH OS', 
						'Macula' => 'Macula OS', 
						'sac' => 'sac OS',
                                                'pastHistory' => 'pastHistory_OS',
                                                'planOfManagement' => 'planOfManagement_OS',
                                                'tear_film_breakup_time' => 'tear_film_breakup_time_OS',
                                                'eye_sonography' => 'eye_sonography_OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					$fieldName1 = str_replace(' ', '_', $fieldName1);
					//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						$fieldName2 = str_replace(' ', '_', $fieldName2);
						//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}


					$custom_insert_data = array (
						'eyeformid' => $form_details->id,
						'field_name' => $custom_values_names_row,
						'field_value_OD' => $request->custom_values_od[$key]
					);

					if($request->custom_values_os[$key] != "") {
						$custom_insert_data['field_value_OS'] = $request->custom_values_os[$key];
					}

					DB::table('eyeformmultipleentry')->insert($custom_insert_data);

				} else {					

					$custom_insert_data = array (
						'eyeformid' => $form_details->id,
						'field_name' => $custom_values_names_row,
						'field_value_OD' => $request->custom_values_od[$key]
					);

					if($request->custom_values_os[$key] != "") {
						$custom_insert_data['field_value_OS'] = $request->custom_values_os[$key];
					}

					DB::table('eyeformmultipleentry')->insert($custom_insert_data);
				}
			}
		}
		}
        return redirect('ViewEyeDetails/'.$request->case_id)->with('flash_message', 'Data Inserted successfully');
    }
    
    public function SaveCaseHistory(Request $request) {
        $this->save_case_history_mrthod($request);
        return Redirect::back()->with('flash_message','Record Added Successfully!');
    }
    
    public function SaveCaseHistory1(Request $request) {
        $this->save_case_history_mrthod($request);
        return redirect('ViewEyeDetails/'.$request->case_id)->with('flash_message', 'Data Inserted successfully');
    }
    
    
    public function save_case_history_mrthod($request) {
         //echo "<hr>".$request->advance_amount;
         //echo "===========>>>>>>>> <pre>"; print_r($_POST); exit;
         
         $request->advance_amount = ($request->surgery_advance_amount != '') ? $request->surgery_advance_amount : $request->advance_amount; 
         /*
         echo "<hr>".$request->surgery_advance_amount;
         echo "<hr>".$request->advance_amount;
        echo "===========>>>>>>>> <pre>".$request->surgery_advance_amount; print_r($_POST); exit;
         */
         
        //echo "===========>>>>>>>> <pre>".$request->surgery_advance_amount; print_r($_POST); exit;
          
         $case_master = Case_master::findOrFail($request->case_id);
         
         //echo "====>>>>>>>>>>>>> <pre>"; print_r($case_master); exit;
         
        //$case_master->patient_name = $request->patient_name;
        //$case_master->patient_age = $request->patient_age;
        //$case_master->patient_address = $request->patient_address;
        //$case_master->male_female = $request->male_female;
        //$case_master->patient_mobile = $request->patient_mobile;
        //$case_master->admission_date_time = $request->admission_date_time;
        
        //$case_master->surgery_complete_date_time = $request->surgery_complete_date_time;
        //$case_master->discharge_date_time = $request->discharge_date_time;
        //$case_master->discharge_history = $request->discharge_history;
       // $case_master->diagnosis = $request->diagnosis;
        //$case_master->Surgeon = $request->surgeon_name;
        //$case_master->elective_emergency      = $request->elective_emergency;
        //$case_master->admission_reason      = $request->admission_reason;
         
         if($request->surgery_date_time && $request->reporting_date_time) {
            $case_master->surgery_date_time = $request->surgery_date_time;
            $case_master->reporting_date_time = $request->reporting_date_time;
            $case_master->save();
         }
         
         if($request->posted_for_doctor) {
            $case_master->posted_for_doctor = $request->posted_for_doctor;
            $case_master->save();
         }
         
         
        
        if($request->finding_type == "template") {
            $eyeform_row = DB::table('eyeform')->where('case_id', $request->case_id)->select('id')->first();
            if($eyeform_row) {
            $fields = ['Lids','OrbitSacsEyeMotility', 'ConjAndLids','cornia','AC','IRIS','pupilIrisac', 'lens','vitreoretinal','Retina','retina_eye', 'ONH','Macula','sac'];
            DB::table('eyeformmultipleentry')->where('eyeformid', $eyeform_row->id)->whereIn('field_name', $fields)->delete();
            }
           // return redirect()->back()->with('flash_message', 'Template added Successully.');
        }
        //dd($request->all());

            if ( $request->hasFile('a_scan_images')) {
                //echo "in ifff";exit;
                $image = $request->File('a_scan_images');
                //echo "<pre> ============= ";print_r($image);exit;
                $destinationPath = 'a_scan_images/';
                $i=1;
                foreach ($image as $files) {
                   // echo "<pre> ============= ";print_r($files);exit;
                    $profileImage = time().$i++.'.'.$files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $report_image = new report_image();
                    $report_image->reportFileName = 'EyeFormScanImage';
                    $report_image->case_id = $request->case_id;
                    $report_image->filePath = $profileImage;
                    $report_image->save();

                    //$helperCls = new drAppHelper();
                    //$casedata = $helperCls->compress(storage_path('app/'.$report_image->filePath), storage_path('app/'.$report_image->filePath), 90);
                }
            }
           // echo "<pre> ============= ";print_r($_FILES);exit;
            if ( $request->hasFile('sp_test_images')) {
                //echo "in ifff";exit;
                $image = $request->File('sp_test_images');
                //echo "<pre> ============= ";print_r($image);exit;
                $destinationPath = 'sp_test_images/';
                $i=1;
                foreach ($image as $files) {
                   // echo "<pre> ============= ";print_r($files);exit;
                    $profileImage = time().$i++.'.'.$files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $report_image = new report_image();
                    $report_image->reportFileName = 'EyeFormSpTestImage';
                    $report_image->case_id = $request->case_id;
                    $report_image->filePath = $profileImage;
                    $report_image->save();

                    //$helperCls = new drAppHelper();
                    //$casedata = $helperCls->compress(storage_path('app/'.$report_image->filePath), storage_path('app/'.$report_image->filePath), 90);
                }
            }
            //return redirect()->back()->with('flash_message', 'Record added successfully');//->withInputs();

            if(Input::get('Send_email')){
            if($request->Email_To && !empty($request->Email_To)) {
                
                $form_details = eyeform::where('case_id', $request->case_id)->first();
                if ($form_details === null) {
                    $form_details = new eyeform();
                }
                $helperCls = new drAppHelper();
                $casedata = $helperCls->getCaseData($request->case_id);
                $logoUrl = $helperCls->GetLetterHeadImageUrl();
                $FooterUrl = $helperCls->GetLetterFooterImageUrl();
                $case_master  = Case_master::findOrFail($request->case_id);
               
                //return view('EyeForm.EyeFormPrint', );

                $mailContent = compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription');
                $mailTemplate = 'EyeForm.eyeFormEmail';

                Mail::to($request->Email_To)->send(new casePaperMail(compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription'), $mailTemplate));
                return redirect()->back()->with('flash_message', 'Email has been sent to '. $request->Email_To);

            }
            return redirect()->back();
        }

        if (Input::get('submit_reportImage')) {
          
            if ($request->hasFile('reportImage')) {
                $report_image = new report_image();
                $report_image->reportFileName = 'EyeFormImage';
                $report_image->case_id = $request->case_id;
                $report_image->filePath = $request->file('reportImage')->store('uploads');
                $report_image->save();

                $helperCls = new drAppHelper();
                $casedata = $helperCls->compress(storage_path('app/'.$report_image->filePath), storage_path('app/'.$report_image->filePath), 90);
            }
            return redirect()->back()->with('flash_message', 'Record added successfully');//->withInputs();
        }


    

        if (Input::get('delete_reportImage')) {

            $reportFile = report_image::findOrFail($request['delete_reportImage']);
            if ($reportFile === null) {
                return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
            }
    
            if (!empty($reportFile->filePath)) {
                Storage::Delete($reportFile->filePath);
            }
            $reportFile->delete();
        
            return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
        }

        //$patient_details = patient_details();
        $isEdit = true;
        //echo "<pre> ============== ";print_r($_POST);exit;
        $form_details = eyeform::where('case_id', $request->case_id)->first();

		//======================== Start Systemic History Entry ==========================
		if(isset($request->SystemicHistory_OD)) {
		foreach($request->SystemicHistory_OD as $systemic_history_key => $systemic_history) {
			if($systemic_history != "") {
				
				$duration = isset($request->SystemicHistory_OD_duration) ? $request->SystemicHistory_OD_duration[$systemic_history_key]: '';
				//echo "<pre> ============== ".__LINE__;print_r($request->SystemicHistory_OD_duration);exit;

				DB::table('patients_systemic_history')->insert(['case_id' => $request->case_id, 'value' => $systemic_history, 'duration' => $duration]);
			}
		}
		}

		//echo "================>>>>>>>>> <pre>"; print_r($request->SystemicHistory_OD); exit;
       //========================= End Systemic history Entry ========================== 

        $case_master = Case_master::findOrFail($request->case_id);
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new eyeform();
            $isEdit = false;
        }

		 $glass_prescription = $case_master ->glass_prescription()->first();
                if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
                    $glass_prescription = new glass_prescription();

					 $glass_prescription->case_id = $case_master->id;
					  $glass_prescription->case_number = $case_master->case_number;
					  $glass_prescription->save();
                }

				//dd($glass_prescription);
     $case_master->casehistory_followup_notes =  $request->casehistory_followup_notes;
 if (isset($request->FollowUpDoctorID) && isset($request->appointment_dt) && $request->appointment_dt != null && $request->appointment_dt != '') {
     
     //==================== case history followup history ============================
     
     
     //==================== case history followup history ============================
     
    $case_master->FollowUpDate =  $request->appointment_dt;
    $case_master->FollowUpTimeSlot = $request->FollowUpTimeSlot;
    $case_master->FollowUpDoctor_Id = $request->FollowUpDoctorID;
        } else {
            //echo "==============".__LINE__; exit;
        }
        if ($request->hasFile('Before_file')) {
            $case_master->BeforeImagePath = $request->file('Before_file')->store('uploads');
        }
        if ($request->hasFile('After_file')) {
            $case_master->AfterImagePath = $request->file('After_file')->store('uploads');
        }
        if ($request->hasFile('reportImage')) {
            $case_master->AfterImagePath = $request->file('reportImage')->store('uploads');
        }
       
      
        $case_master->infection = $request->infection;
        $case_master->miscellaneous_history = $request->miscellaneous_history;
        
        $case_master->touch(); //updated_at = Carbon::now();
        $case_master->save();

        #region send followup SMS
        // if (isset($request->appointment_dt) && $request->appointment_dt != null && $request->appointment_dt != '') {
        //     $client = new HttpGuzzle;
        //     $smsStr = 'Hi '
        //     .(empty($case_master->patient_name)?"":$case_master->patient_name)
        //     .' %0a your appointment is scheduled on :'
        //     .(empty($case_master->FollowUpDate)?"":$case_master->FollowUpDate) 
        //     . '  ' 
        //     .(empty($case_master->FollowUpTimeSlot)?"":$case_master->FollowUpTimeSlot) 
        //     .' %0a with '
        //     .env('SMS_From_Name')
        //     .' ' 
        //     .(empty($case_master->doctor()->doctor_name)?"":$case_master->doctor()->doctor_name);
        //     $urlGet = str_replace(array('xxxxcommaSeperatedxxxx','xxxxSMSTextxxxx'), array($case_master->patient_mobile, $smsStr), env('SMS_URL'));
        //     $res = $client->request('GET', $urlGet);
        // }
        #endregion
        
        //echo "==>>> <pre>"; print_r($_POST); exit;
        $form_details->fill($request->except(['OdImg1', 'OsImg1', 'OdImg2', 'OsImg2', 'Before_file', 'After_file','otherDetailsDiagnosis']));
        $form_details->save();
        
        $eyform_refraction_retina_scopy_details = eyform_refraction_retina_scopy::where('eyeformid', $form_details->id)->first();
        
        if ($eyform_refraction_retina_scopy_details === null) {
            $eyform_refraction_retina_scopy_details = new eyform_refraction_retina_scopy();
        }
        
        $eyform_refraction_retina_scopy_details_input = $request->all();
        $eyform_refraction_retina_scopy_details_input['eyeformid'] = $form_details->id;
        $eyform_refraction_retina_scopy_details->fill($eyform_refraction_retina_scopy_details_input);
        $eyform_refraction_retina_scopy_details->save();
        
        
        $eyform_vision_pgp_details = eyform_vision_pgp::where('eyeformid', $form_details->id)->first();
        
        if ($eyform_vision_pgp_details === null) {
                $eyform_vision_pgp_details = new eyform_vision_pgp();
        }

        $eyform_vision_pgp_details_input = $request->all();
        $eyform_vision_pgp_details_input['eyeformid'] = $form_details->id;
        $eyform_vision_pgp_details->fill($eyform_vision_pgp_details_input);
        $eyform_vision_pgp_details->save();
        
		
		//-------------save glass prescription --------------
		$glass_prescription_details = glass_prescription::where('case_id', $case_master->id)->first();

		//dd();
		$glass_prescription_details->fill($request->all());
        $glass_prescription_details->save();
		//------------ end save glass prescription -------------------
        //Save file
        if (!empty($request->OdImg1)) {

            $img = filter_input(INPUT_POST, 'OdImg1', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OdImg1.png');
            file_put_contents($storagePath, $data);
            $form_details->OdImg1 = 'uploads/eyeform/'.$form_details->id .'_OdImg1.png';
            //Storage::Delete($form_details->OdImg1);
        }
        if (!empty($request->OsImg1)) {

            $img = filter_input(INPUT_POST, 'OsImg1', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OsImg1.png');
            file_put_contents($storagePath, $data);
            $form_details->OsImg1 = 'uploads/eyeform/'.$form_details->id .'_OsImg1.png';
            //Storage::Delete($form_details->OsImg1);
        }
        if (!empty($request->OdImg2)) {

            $img = filter_input(INPUT_POST, 'OdImg2', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OdImg2.png');
            file_put_contents($storagePath, $data);
            $form_details->OdImg2 = 'uploads/eyeform/'.$form_details->id .'_OdImg2.png';;
            //Storage::Delete($form_details->OdImg2);
        }
        if (!empty($request->OsImg2)) {

            $img = filter_input(INPUT_POST, 'OsImg2', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OsImg2.png');
            file_put_contents($storagePath, $data);
            $form_details->OsImg2 = 'uploads/eyeform/'.$form_details->id .'_OsImg2.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->retino_scopy_OD)) {

            $img = filter_input(INPUT_POST, 'retino_scopy_OD', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_retino_scopy_OD.png');
            file_put_contents($storagePath, $data);
            $form_details->retino_scopy_OD = 'uploads/eyeform/'.$form_details->id .'_retino_scopy_OD.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->retino_scopy_OS)) {

            $img = filter_input(INPUT_POST, 'retino_scopy_OS', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_retino_scopy_OS.png');
            file_put_contents($storagePath, $data);
            $form_details->retino_scopy_OS = 'uploads/eyeform/'.$form_details->id .'_retino_scopy_OS.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->gonio_od)) {

            $img = filter_input(INPUT_POST, 'gonio_od', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_gonio_od.png');
            file_put_contents($storagePath, $data);
            $form_details->gonio_od = 'uploads/eyeform/'.$form_details->id .'_gonio_od.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->gonio_os)) {

            $img = filter_input(INPUT_POST, 'gonio_os', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_gonio_os.png');
            file_put_contents($storagePath, $data);
            $form_details->gonio_os = 'uploads/eyeform/'.$form_details->id .'_gonio_os.png';
            //Storage::Delete($form_details->OsImg2);
        }

        if (!empty($request->OdImg1) || !empty($request->OsImg1) || !empty($request->OdImg2) || !empty($request->OsImg2) || !empty($request->retino_scopy_OD) || !empty($request->retino_scopy_OS) || !empty($request->gonio_od) || !empty($request->gonio_os)){
            $form_details->save();
        }

        //echo "=====>>>>>>>> <pre>".__LINE__; print_r($_POST); exit;
        
        #region MultipleEntry
        $EfMultiEntryArray = array();
        $multientryArry = array();
        
        DB::table('eyeformmultipleentry')->where('eyeformid', $form_details->id)->where('field_name', 'other_details_treatment_given')->delete();
      
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'other_details_treatment_given', 1, [$request->treatment_given_od], [$request->treatment_given_os]);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        //echo "=====>>>>>>>> <pre>"; print_r($EfMultiEntryArray); exit;
        
       $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'ChiefComplaint', count($request->ChiefComplaint), $request->ChiefComplaint_OD, $request->ChiefComplaint_OS, $request->ChiefComplaint_OD_duration, $request->ChiefComplaint_OS_duration);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        //$EfMultiEntryArray = $EfMultiEntryArray + $multientryArry;
        //$form_details->eyeformmultipleentry()->saveMany($multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'OpthalHistory',count($request->OpthalHistory), $request->OpthalHistory_OD, $request->OpthalHistory_OS, $request->OpthalHistory_OD_duration, $request->OpthalHistory_OS_duration);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        //$form_details->eyeformmultipleentry()->saveMany($multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'SystemicHistory',count($request->SystemicHistory), $request->SystemicHistory_OD, $request->SystemicHistory_OD, $request->SystemicHistory_OD_duration, $request->SystemicHistory_OD_duration);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'pastHistory',count($request->pastHistory), $request->pastHistory_OD, $request->pastHistory_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'planOfManagement',count($request->planOfManagement), $request->planOfManagement_OD, $request->planOfManagement_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
		//echo "SystemicHistory : "; print_r($request->SystemicHistory); exit;
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'ConjAndLids',count($request->ConjAndLids), $request->ConjAndLids_OD, $request->ConjAndLids_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'Lids',count($request->Lids), $request->Lids_OD, $request->Lids_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'AC',count($request->AC), $request->AC_OD, $request->AC_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'IRIS',count($request->IRIS), $request->IRIS_OD, $request->IRIS_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'sac',count($request->sac), $request->sac_OD, $request->sac_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'Retina',count($request->Retina), $request->Retina_OD, $request->Retina_OS, $request->retina_eye_OD, $request->retina_eye_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'Macula',count($request->Macula), $request->Macula_OD, $request->Macula_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'ONH',count($request->ONH), $request->ONH_OD, $request->ONH_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'OrbitSacsEyeMotility',count($request->OrbitSacsEyeMotility), $request->OrbitSacsEyeMotility_OD, $request->OrbitSacsEyeMotility_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'cornia',count($request->cornia), $request->cornia_od, $request->cornia_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'pupilIrisac',count($request->pupilIrisac), $request->pupilIrisac_OD, $request->pupilIrisac_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'lens',count($request->lens), $request->lens_od, $request->lense_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'vitreoretinal',count($request->vitreoretinal), $request->vitreoretinal_OD, $request->vitreoretinal_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'diagno',count($request->diagno), $request->diagno_od, $request->diagno_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'OCT',count($request->OCT), $request->OCT_OD, $request->OCT_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'EOM',count($request->EOM), $request->EOM_OD, $request->EOM_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
 //---------------------------------------------------------------------------------------------------------------------
$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'flat_k', 1, [$request->flat_k_od], [$request->flat_k_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'flat_axis', 1, [$request->flat_axis_od], [$request->flat_axis_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'stap_k', 1, [$request->stap_k_od], [$request->stap_k_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'stap_axis', 1, [$request->stap_axis_od], [$request->stap_axis_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'axial_length', 1, [$request->axial_length_od], [$request->axial_length_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'optical_acd', 1, [$request->optical_acd_od], [$request->optical_acd_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'target_refraction', 1, [$request->target_refraction_od], [$request->target_refraction_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'lens_thickness', 1, [$request->lens_thickness_od], [$request->lens_thickness_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'wtw', 1, [$request->wtw_od], [$request->wtw_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'kc_formula_use', 1, [$request->kc_formula_use_od], [$request->kc_formula_use_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'type_of_lens', 1, [$request->type_of_lens_od], [$request->type_of_lens_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'se', 1, [$request->se_od], [$request->se_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'iol_cilinder', 1, [$request->iol_cilinder_od], [$request->iol_cilinder_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);


$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsAnteriorSegment', count($request->otherDetailsAnteriorSegment), $request->otherDetailsAnteriorSegment_OD, $request->otherDetailsAnteriorSegment_OS);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsPosteriorSegment', count($request->otherDetailsPosteriorSegment), $request->otherDetailsPosteriorSegment_OD, $request->otherDetailsPosteriorSegment_OS);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsAdditionalInformation', count($request->otherDetailsAdditionalInformationCount), $request->otherDetailsAdditionalInformation, $request->otherDetailsAdditionalInformation);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsAdvice', count($request->otherDetailsAdviceCount), $request->otherDetailsAdvice_OD, $request->otherDetailsAdvice_OS);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsDiagnosis', count($request->otherDetailsDiagnosis), $request->otherDetailsDiagnosis_OD, $request->otherDetailsDiagnosis_OS);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

//dd($_POST);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'surgery', count($request->surgeryCount), $request->surgery_OD, $request->surgery_OS);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

//Laser Procedure Entry

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'laser_procedure_laser_type', count($request->laser_procedure_laser_type), $request->laser_procedure_laser_type_OD, $request->laser_procedure_laser_type_OS);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'tear_film_breakup_time',count($request->tear_film_breakup_time), $request->tear_film_breakup_time_OD, $request->tear_film_breakup_time_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'eye_sonography',count($request->tear_film_breakup_time), $request->eye_sonography_OD, $request->eye_sonography_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'colour', count($request->colour_OD), $request->colour_OD, $request->colour_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        //dd($EfMultiEntryArray);
        //echo "============<pre>".__LINE__; print_r($multientryArry); exit;
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'schimerTest1', count($request->schimerTest1_OD), $request->schimerTest1_OD, $request->schimerTest1_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        
       // echo "============<pre>".__LINE__; print_r($multientryArry);
        //dd($EfMultiEntryArray);
        //echo "============<pre>".__LINE__; print_r($multientryArry); exit;
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'schimerTest2', count($request->schimerTest2_OD), $request->schimerTest2_OD, $request->schimerTest2_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'perimetry_sp', count($request->perimetry_sp_od), $request->perimetry_sp_od, $request->perimetry_sp_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'laser_sp', count($request->laser_sp_od), $request->laser_sp_od, $request->laser_sp_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'oculizer_sp', count($request->oculizer_sp_od), $request->oculizer_sp_od, $request->oculizer_sp_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'ffa_sp', count($request->ffa_sp_od), $request->ffa_sp_od, $request->ffa_sp_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'fix_srgery_eye', count($request->fix_srgery_eye), [$request->fix_srgery_eye], [$request->fix_srgery_eye]);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'planned_surgery', count($request->planned_surgery_OD), $request->planned_surgery_OD, $request->planned_surgery_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'selected_iol', count($request->selected_iol_OD), $request->selected_iol_OD, $request->selected_iol_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'package', count($request->package_OD), $request->package_OD, $request->package_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
//-------------------------------------------------------------------------------------------------------------------------
        
        //dd($EfMultiEntryArray);
        
        $form_details->eyeformmultipleentry()->saveMany($EfMultiEntryArray);
        #endregion

	//---------------------------------------------------------------------------------------------------------------------


$this->GetSingleEntryArray($form_details->id, 'flat_k', 1, [$request->flat_k_od], [$request->flat_k_os]);

$this->GetSingleEntryArray($form_details->id, 'flat_axis', 1, [$request->flat_axis_od], [$request->flat_axis_os]);

$this->GetSingleEntryArray($form_details->id, 'stap_k', 1, [$request->stap_k_od], [$request->stap_k_os]);

$this->GetSingleEntryArray($form_details->id, 'stap_axis', 1, [$request->stap_axis_od], [$request->stap_axis_os]);

$this->GetSingleEntryArray($form_details->id, 'axial_length', 1, [$request->axial_length_od], [$request->axial_length_os]);

$this->GetSingleEntryArray($form_details->id, 'optical_acd', 1, [$request->optical_acd_od], [$request->optical_acd_os]);

$this->GetSingleEntryArray($form_details->id, 'target_refraction', 1, [$request->target_refraction_od], [$request->target_refraction_os]);

$this->GetSingleEntryArray($form_details->id, 'lens_thickness', 1, [$request->lens_thickness_od], [$request->lens_thickness_os]);

$this->GetSingleEntryArray($form_details->id, 'wtw', 1, [$request->wtw_od], [$request->wtw_os]);

$this->GetSingleEntryArray($form_details->id, 'kc_formula_use', 1, [$request->kc_formula_use_od], [$request->kc_formula_use_os]);

$this->GetSingleEntryArray($form_details->id, 'type_of_lens', 1, [$request->type_of_lens_od], [$request->type_of_lens_os]);

$this->GetSingleEntryArray($form_details->id, 'se', 1, [$request->se_od], [$request->se_os]);

$this->GetSingleEntryArray($form_details->id, 'iol_cilinder', 1, [$request->iol_cilinder_od], [$request->iol_cilinder_os]);

$this->GetSingleEntryArray($form_details->id, 'other_details_comment', 1, [$request->other_details_comment], [$request->other_details_comment]);
$this->GetSingleEntryArray($form_details->id, 'surgery_comment', 1, [$request->surgery_comment], [$request->surgery_comment]);

//Laser Procedure Entry
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_date', 1, [$request->laser_procedure_date_OD], [$request->laser_procedure_date_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_power', 1, [$request->laser_procedure_power_OD], [$request->laser_procedure_power_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_exposure_time', 1, [$request->laser_procedure_exposure_time_OD], [$request->laser_procedure_exposure_time_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_sitting', 1, [$request->laser_procedure_sitting_OD], [$request->laser_procedure_sitting_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_spot_size', 1, [$request->laser_procedure_spot_size_OD], [$request->laser_procedure_spot_size_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_no_of_spots', 1, [$request->laser_procedure_no_of_spots_OD], [$request->laser_procedure_no_of_spots_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_note', 1, [$request->laser_procedure_note_OD], [$request->laser_procedure_note_OS]);
//-------------------------------------------------------------------------------------------------------------------------
//================= inser cutom data ===========================
		if(isset($request->custom_values)) {
		foreach($request->custom_values as $key => $custom_values_names_row) {
			if($request->custom_values_od[$key] != "") {
				if($custom_values_names_row == "systemicHistory") { 

					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];
					$fieldName1 = 'systemic_history';

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);

					DB::table('patients_systemic_history')->insert(['case_id' => $request->case_id, 'value' => $request->custom_values_od[$key]]);
				} else if(in_array($custom_values_names_row, ["dvn", "nvn", "withpinhole","colour_vision", "withglasses", "withglassesdilated"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['dvn' => 'dvn_od', 'nvn' => 'nvn_od', 'withpinhole' => 'withpinhole_OD', 'colour_vision' => 'colour_vision_OD', 'withglasses' => 'withglasses_OD', 'withglassesdilated' => 'with_glass_dilated_od'];
					$os = ['dvn' => 'dvn_os', 'nvn' => 'nvn_os', 'withpinhole' => 'withpinhole_OS', 'colour_vision' => 'colour_vision_OS', 'withglasses' => 'withglasses_OS', 'withglassesdilated' => 'with_glass_dilated_os'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");

						DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}

				} else if(in_array($custom_values_names_row, ["IOP", "CD", "Pachymetry","CCT"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['IOP' => 'IOP_OD', 'CD' => 'Ratio OD', 'Pachymetry' => 'Pachymetry_OD', 'CCT' => 'CCT_OD'];
					$os = ['IOP' => 'IOP_OS', 'CD' => 'Ratio OS', 'Pachymetry' => 'Pachymetry_OS', 'CCT' => 'CCT_OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					$fieldName1 = str_replace(' ', '_', $fieldName1);
					DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						$fieldName2 = str_replace(' ', '_', $fieldName2);
						DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}

				} else if(in_array($custom_values_names_row, ["k1", "k2", "axial_length", "lenspower", "KC", "lens_type"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['k1' => 'k1_od', 'k2' => 'k2_od', 'axial_length' => 'axial_length_OD', 'lenspower' => 'lenspower_od', 'KC' => 'KC_OD', 'lens_type' => 'lens_type_OD'];
					$os = ['k1' => 'k1_os', 'k2' => 'k2_os', 'axial_length' => 'axial_length_OS', 'lenspower' => 'lenspower_os', 'KC' => 'KC_OS', 'lens_type' => 'lens_type_OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					//$fieldName1 = str_replace(' ', '_', $fieldName1);
					DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						//$fieldName2 = str_replace(' ', '_', $fieldName2);
						DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}

				} else if(in_array($custom_values_names_row, ["otherDetailsAnteriorSegment", "otherDetailsPosteriorSegment"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];
					
					$fieldName1 = $custom_values_names_row;

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					//$fieldName1 = str_replace(' ', '_', $fieldName1);
					DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

				} else if(in_array($custom_values_names_row, ["colour", "schimerTest1", "schimerTest2", "perimetry_sp", "laser_sp", "oculizer_sp", "ffa_sp"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['colour' => 'colour OD', 'schimerTest1' => 'schimerTest1_OD', 'schimerTest2' => 'schimerTest2_OD', 'OCT' => 'OCT OD', 'EOM' => 'EOM OD', 'perimetry_sp' => 'perimetry_sp OD', 'laser_sp' => 'laser_sp OD', 'oculizer_sp' => 'oculizer_sp OD', 'ffa_sp' => 'ffa_sp OD'];
					$os = ['colour' => 'colour OS', 'schimerTest1' => 'schimerTest1_OS', 'schimerTest2' => 'schimerTest2_OS', 'OCT' => 'OCT OS', 'EOM' => 'EOM OS', 'perimetry_sp' => 'perimetry_sp OS', 'laser_sp' => 'laser_sp OS', 'oculizer_sp' => 'oculizer_sp OS', 'ffa_sp' => 'ffa_sp OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					$fieldName1 = str_replace(' ', '_', $fieldName1);
					//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						$fieldName2 = str_replace(' ', '_', $fieldName2);
						//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}
                                        
                                        $custom_insert_data = array (
						'eyeformid' => $form_details->id,
						'field_name' => $custom_values_names_row,
						'field_value_OD' => $request->custom_values_od[$key]
					);

					if($request->custom_values_os[$key] != "") {
						$custom_insert_data['field_value_OS'] = $request->custom_values_os[$key];
					}

					DB::table('eyeformmultipleentry')->insert($custom_insert_data);

				} else if(in_array($custom_values_names_row, ["OCT", "EOM"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['OCT' => 'OCT OD', 'EOM' => 'EOM OD'];
					$os = ['OCT' => 'OCT OS', 'EOM' => 'EOM OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					$fieldName1 = str_replace(' ', '_', $fieldName1);
					//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						$fieldName2 = str_replace(' ', '_', $fieldName2);
						//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}


					$custom_insert_data = array (
						'eyeformid' => $form_details->id,
						'field_name' => $custom_values_names_row,
						'field_value_OD' => $request->custom_values_od[$key]
					);

					if($request->custom_values_os[$key] != "") {
						$custom_insert_data['field_value_OS'] = $request->custom_values_os[$key];
					}

					DB::table('eyeformmultipleentry')->insert($custom_insert_data);

				} else if(in_array($custom_values_names_row, ["ChiefComplaint", "OpthalHistory"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['ChiefComplaint' => 'Chief Complaint OD', 'OpthalHistory' => 'Opthal History OD'];
					$os = ['ChiefComplaint' => 'Chief Complaint OS', 'OpthalHistory' => 'Opthal History OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					$fieldName1 = str_replace(' ', '_', $fieldName1);
					//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						$fieldName2 = str_replace(' ', '_', $fieldName2);
						//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}


					$custom_insert_data = array (
						'eyeformid' => $form_details->id,
						'field_name' => $custom_values_names_row,
						'field_value_OD' => $request->custom_values_od[$key]
					);

					if($request->custom_values_os[$key] != "") {
						$custom_insert_data['field_value_OS'] = $request->custom_values_os[$key];
					}

					DB::table('eyeformmultipleentry')->insert($custom_insert_data);

				} else if(in_array($custom_values_names_row, ["Lids", "Orbit", "ConjAndLids", 
					"cornia", 
					"AC", 
					"IRIS", 
					"pupilIrisac", 
					"lens", 
					"vitreoretinal", 
					"Retina", 
					"ONH", 
					"Macula", 
					"sac","pastHistory", "planOfManagement", "tear_film_breakup_time", "eye_sonography"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['Lids' => 'LIDS OD', 
						'Orbit' => 'OrbitSacsEyeMotility OD', 
						'ConjAndLids' => 'Conj And Lids OD',
						'cornia' => 'Cornea OD', 
						'AC' => 'AC OD', 
						'IRIS' => 'IRIS OD', 
						'pupilIrisac' => 'pupilIrisac OD', 
						'lens' => 'lens OD', 
						'vitreoretinal' => 'vitreoretinal OD', 
						'Retina' => 'Retina OD', 
						'ONH' => 'ONH OD', 
						'Macula' => 'Macula OD', 
						'sac' => 'sac OD',
                                                'pastHistory' => 'pastHistory_OD',
                                                'planOfManagement' => 'planOfManagement_OD',
                                                'tear_film_breakup_time' => 'tear_film_breakup_time_OD',
                                                'eye_sonography' => 'eye_sonography_OD'];

					$os = ['Lids' => 'LIDS OS', 
						'Orbit' => 'OrbitSacsEyeMotility OS', 
						'ConjAndLids' => 'Conj And Lids OS',
						'cornia' => 'Cornea OS', 
						'AC' => 'AC OS', 
						'IRIS' => 'IRIS OS', 
						'pupilIrisac' => 'pupilIrisac OS',  
						'lens' => 'lens OS', 
						'vitreoretinal' => 'vitreoretinal OS', 
						'Retina' => 'Retina OS', 
						'ONH' => 'ONH OS', 
						'Macula' => 'Macula OS', 
						'sac' => 'sac OS',
                                                'pastHistory' => 'pastHistory_OS',
                                                'planOfManagement' => 'planOfManagement_OS',
                                                'tear_film_breakup_time' => 'tear_film_breakup_time_OS',
                                                'eye_sonography' => 'eye_sonography_OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					$fieldName1 = str_replace(' ', '_', $fieldName1);
					//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						$fieldName2 = str_replace(' ', '_', $fieldName2);
						//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}


					$custom_insert_data = array (
						'eyeformid' => $form_details->id,
						'field_name' => $custom_values_names_row,
						'field_value_OD' => $request->custom_values_od[$key]
					);

					if($request->custom_values_os[$key] != "") {
						$custom_insert_data['field_value_OS'] = $request->custom_values_os[$key];
					}

					DB::table('eyeformmultipleentry')->insert($custom_insert_data);

				} else {					

					$custom_insert_data = array (
						'eyeformid' => $form_details->id,
						'field_name' => $custom_values_names_row,
						'field_value_OD' => $request->custom_values_od[$key]
					);
                                        
$formName = "EyeForm";
$value= $request->custom_values_od[$key];
$fieldName1 = $custom_values_names_row;

$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
$insert_id = DB::getPdo()->lastInsertId();



if($request->custom_values_os[$key] != "") {
        $custom_insert_data['field_value_OS'] = $request->custom_values_os[$key];
        
        $value= $request->custom_values_os[$key];
        $sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
}

$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
                                        
                                        //echo "============>>>>>>>> <pre>"; print_r($custom_insert_data);
                                        
					DB::table('eyeformmultipleentry')->insert($custom_insert_data);
				}
			}
		}
		}
                
             //   echo "============>>>>>>>> <pre>"; exit;
        //return Redirect::back()->with('flash_message','Record Added Successfully!');
    }

     public function SaveCaseHistory_bk_16jan2022(Request $request) {
         //echo "<hr>".$request->advance_amount;
         
         $request->advance_amount = ($request->surgery_advance_amount != '') ? $request->surgery_advance_amount : $request->advance_amount;
         
         /*
         echo "<hr>".$request->surgery_advance_amount;
         echo "<hr>".$request->advance_amount;
        echo "===========>>>>>>>> <pre>".$request->surgery_advance_amount; print_r($_POST); exit;
         */
         
        //echo "===========>>>>>>>> <pre>".$request->surgery_advance_amount; print_r($_POST); exit;
          
         $case_master = Case_master::findOrFail($request->case_id);
         
         //echo "====>>>>>>>>>>>>> <pre>"; print_r($case_master); exit;
         
        //$case_master->patient_name = $request->patient_name;
        //$case_master->patient_age = $request->patient_age;
        //$case_master->patient_address = $request->patient_address;
        //$case_master->male_female = $request->male_female;
        //$case_master->patient_mobile = $request->patient_mobile;
        //$case_master->admission_date_time = $request->admission_date_time;
        
        //$case_master->surgery_complete_date_time = $request->surgery_complete_date_time;
        //$case_master->discharge_date_time = $request->discharge_date_time;
        //$case_master->discharge_history = $request->discharge_history;
       // $case_master->diagnosis = $request->diagnosis;
        //$case_master->Surgeon = $request->surgeon_name;
        //$case_master->elective_emergency      = $request->elective_emergency;
        //$case_master->admission_reason      = $request->admission_reason;
         
         if($request->surgery_date_time && $request->reporting_date_time) {
            $case_master->surgery_date_time = $request->surgery_date_time;
            $case_master->reporting_date_time = $request->reporting_date_time;
            $case_master->save();
         }
         
         if($request->posted_for_doctor) {
            $case_master->posted_for_doctor = $request->posted_for_doctor;
            $case_master->save();
         }
         
         
        
        if($request->finding_type == "template") {
            $eyeform_row = DB::table('eyeform')->where('case_id', $request->case_id)->select('id')->first();
            if($eyeform_row) {
            $fields = ['Lids','OrbitSacsEyeMotility', 'ConjAndLids','cornia','AC','IRIS','pupilIrisac', 'lens','vitreoretinal','Retina','retina_eye', 'ONH','Macula','sac'];
            DB::table('eyeformmultipleentry')->where('eyeformid', $eyeform_row->id)->whereIn('field_name', $fields)->delete();
            }
           // return redirect()->back()->with('flash_message', 'Template added Successully.');
        }
        //dd($request->all());

            if ( $request->hasFile('a_scan_images')) {
                //echo "in ifff";exit;
                $image = $request->File('a_scan_images');
                //echo "<pre> ============= ";print_r($image);exit;
                $destinationPath = 'a_scan_images/';
                $i=1;
                foreach ($image as $files) {
                   // echo "<pre> ============= ";print_r($files);exit;
                    $profileImage = time().$i++.'.'.$files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $report_image = new report_image();
                    $report_image->reportFileName = 'EyeFormScanImage';
                    $report_image->case_id = $request->case_id;
                    $report_image->filePath = $profileImage;
                    $report_image->save();

                    //$helperCls = new drAppHelper();
                    //$casedata = $helperCls->compress(storage_path('app/'.$report_image->filePath), storage_path('app/'.$report_image->filePath), 90);
                }
            }
            
            if ( $request->hasFile('sp_test_images')) {
                //echo "in ifff";exit;
                $image = $request->File('sp_test_images');
                //echo "<pre> ============= ";print_r($image);exit;
                $destinationPath = 'sp_test_images/';
                $i=1;
                foreach ($image as $files) {
                   // echo "<pre> ============= ";print_r($files);exit;
                    $profileImage = time().$i++.'.'.$files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $report_image = new report_image();
                    $report_image->reportFileName = 'EyeFormSpTestImage';
                    $report_image->case_id = $request->case_id;
                    $report_image->filePath = $profileImage;
                    $report_image->save();

                    //$helperCls = new drAppHelper();
                    //$casedata = $helperCls->compress(storage_path('app/'.$report_image->filePath), storage_path('app/'.$report_image->filePath), 90);
                }
            }
            //return redirect()->back()->with('flash_message', 'Record added successfully');//->withInputs();

            if(Input::get('Send_email')){
            if($request->Email_To && !empty($request->Email_To)) {
                
                $form_details = eyeform::where('case_id', $request->case_id)->first();
                if ($form_details === null) {
                    $form_details = new eyeform();
                }
                $helperCls = new drAppHelper();
                $casedata = $helperCls->getCaseData($request->case_id);
                $logoUrl = $helperCls->GetLetterHeadImageUrl();
                $FooterUrl = $helperCls->GetLetterFooterImageUrl();
                $case_master  = Case_master::findOrFail($request->case_id);
               
                //return view('EyeForm.EyeFormPrint', );

                $mailContent = compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription');
                $mailTemplate = 'EyeForm.eyeFormEmail';

                Mail::to($request->Email_To)->send(new casePaperMail(compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription'), $mailTemplate));
                return redirect()->back()->with('flash_message', 'Email has been sent to '. $request->Email_To);

            }
            return redirect()->back();
        }

        if (Input::get('submit_reportImage')) {
          
            if ($request->hasFile('reportImage')) {
                $report_image = new report_image();
                $report_image->reportFileName = 'EyeFormImage';
                $report_image->case_id = $request->case_id;
                $report_image->filePath = $request->file('reportImage')->store('uploads');
                $report_image->save();

                $helperCls = new drAppHelper();
                $casedata = $helperCls->compress(storage_path('app/'.$report_image->filePath), storage_path('app/'.$report_image->filePath), 90);
            }
            return redirect()->back()->with('flash_message', 'Record added successfully');//->withInputs();
        }


    

        if (Input::get('delete_reportImage')) {

            $reportFile = report_image::findOrFail($request['delete_reportImage']);
            if ($reportFile === null) {
                return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
            }
    
            if (!empty($reportFile->filePath)) {
                Storage::Delete($reportFile->filePath);
            }
            $reportFile->delete();
        
            return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
        }

        //$patient_details = patient_details();
        $isEdit = true;
        //echo "<pre> ============== ";print_r($_POST);exit;
        $form_details = eyeform::where('case_id', $request->case_id)->first();

		//======================== Start Systemic History Entry ==========================
		if(isset($request->SystemicHistory_OD)) {
		foreach($request->SystemicHistory_OD as $systemic_history_key => $systemic_history) {
			if($systemic_history != "") {
				
				$duration = isset($request->SystemicHistory_OD_duration) ? $request->SystemicHistory_OD_duration[$systemic_history_key]: '';
				//echo "<pre> ============== ".__LINE__;print_r($request->SystemicHistory_OD_duration);exit;

				DB::table('patients_systemic_history')->insert(['case_id' => $request->case_id, 'value' => $systemic_history, 'duration' => $duration]);
			}
		}
		}

		//echo "================>>>>>>>>> <pre>"; print_r($request->SystemicHistory_OD); exit;
       //========================= End Systemic history Entry ========================== 

        $case_master = Case_master::findOrFail($request->case_id);
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new eyeform();
            $isEdit = false;
        }

		 $glass_prescription = $case_master ->glass_prescription()->first();
                if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
                    $glass_prescription = new glass_prescription();

					 $glass_prescription->case_id = $case_master->id;
					  $glass_prescription->case_number = $case_master->case_number;
					  $glass_prescription->save();
                }

				//dd($glass_prescription);
     $case_master->casehistory_followup_notes =  $request->casehistory_followup_notes;
 if (isset($request->FollowUpDoctorID) && isset($request->appointment_dt) && $request->appointment_dt != null && $request->appointment_dt != '') {
     
     //==================== case history followup history ============================
     
     
     //==================== case history followup history ============================
     
    $case_master->FollowUpDate =  $request->appointment_dt;
    $case_master->FollowUpTimeSlot = $request->FollowUpTimeSlot;
    $case_master->FollowUpDoctor_Id = $request->FollowUpDoctorID;
        } else {
            //echo "==============".__LINE__; exit;
        }
        if ($request->hasFile('Before_file')) {
            $case_master->BeforeImagePath = $request->file('Before_file')->store('uploads');
        }
        if ($request->hasFile('After_file')) {
            $case_master->AfterImagePath = $request->file('After_file')->store('uploads');
        }
        if ($request->hasFile('reportImage')) {
            $case_master->AfterImagePath = $request->file('reportImage')->store('uploads');
        }
       
      
        $case_master->infection = $request->infection;
        $case_master->miscellaneous_history = $request->miscellaneous_history;
        
        $case_master->touch(); //updated_at = Carbon::now();
        $case_master->save();

        #region send followup SMS
        // if (isset($request->appointment_dt) && $request->appointment_dt != null && $request->appointment_dt != '') {
        //     $client = new HttpGuzzle;
        //     $smsStr = 'Hi '
        //     .(empty($case_master->patient_name)?"":$case_master->patient_name)
        //     .' %0a your appointment is scheduled on :'
        //     .(empty($case_master->FollowUpDate)?"":$case_master->FollowUpDate) 
        //     . '  ' 
        //     .(empty($case_master->FollowUpTimeSlot)?"":$case_master->FollowUpTimeSlot) 
        //     .' %0a with '
        //     .env('SMS_From_Name')
        //     .' ' 
        //     .(empty($case_master->doctor()->doctor_name)?"":$case_master->doctor()->doctor_name);
        //     $urlGet = str_replace(array('xxxxcommaSeperatedxxxx','xxxxSMSTextxxxx'), array($case_master->patient_mobile, $smsStr), env('SMS_URL'));
        //     $res = $client->request('GET', $urlGet);
        // }
        #endregion
        
        //echo "==>>> <pre>"; print_r($_POST); exit;
        $form_details->fill($request->except(['OdImg1', 'OsImg1', 'OdImg2', 'OsImg2', 'Before_file', 'After_file','otherDetailsDiagnosis']));
        $form_details->save();
        
        $eyform_refraction_retina_scopy_details = eyform_refraction_retina_scopy::where('eyeformid', $form_details->id)->first();
        
        if ($eyform_refraction_retina_scopy_details === null) {
            $eyform_refraction_retina_scopy_details = new eyform_refraction_retina_scopy();
        }
        
        $eyform_refraction_retina_scopy_details_input = $request->all();
        $eyform_refraction_retina_scopy_details_input['eyeformid'] = $form_details->id;
        $eyform_refraction_retina_scopy_details->fill($eyform_refraction_retina_scopy_details_input);
        $eyform_refraction_retina_scopy_details->save();
        
        
        $eyform_vision_pgp_details = eyform_vision_pgp::where('eyeformid', $form_details->id)->first();
        
        if ($eyform_vision_pgp_details === null) {
                $eyform_vision_pgp_details = new eyform_vision_pgp();
        }

        $eyform_vision_pgp_details_input = $request->all();
        $eyform_vision_pgp_details_input['eyeformid'] = $form_details->id;
        $eyform_vision_pgp_details->fill($eyform_vision_pgp_details_input);
        $eyform_vision_pgp_details->save();
        
		
		//-------------save glass prescription --------------
		$glass_prescription_details = glass_prescription::where('case_id', $case_master->id)->first();

		//dd();
		$glass_prescription_details->fill($request->all());
        $glass_prescription_details->save();
		//------------ end save glass prescription -------------------
        //Save file
        if (!empty($request->OdImg1)) {

            $img = filter_input(INPUT_POST, 'OdImg1', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OdImg1.png');
            file_put_contents($storagePath, $data);
            $form_details->OdImg1 = 'uploads/eyeform/'.$form_details->id .'_OdImg1.png';
            //Storage::Delete($form_details->OdImg1);
        }
        if (!empty($request->OsImg1)) {

            $img = filter_input(INPUT_POST, 'OsImg1', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OsImg1.png');
            file_put_contents($storagePath, $data);
            $form_details->OsImg1 = 'uploads/eyeform/'.$form_details->id .'_OsImg1.png';
            //Storage::Delete($form_details->OsImg1);
        }
        if (!empty($request->OdImg2)) {

            $img = filter_input(INPUT_POST, 'OdImg2', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OdImg2.png');
            file_put_contents($storagePath, $data);
            $form_details->OdImg2 = 'uploads/eyeform/'.$form_details->id .'_OdImg2.png';;
            //Storage::Delete($form_details->OdImg2);
        }
        if (!empty($request->OsImg2)) {

            $img = filter_input(INPUT_POST, 'OsImg2', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_OsImg2.png');
            file_put_contents($storagePath, $data);
            $form_details->OsImg2 = 'uploads/eyeform/'.$form_details->id .'_OsImg2.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->retino_scopy_OD)) {

            $img = filter_input(INPUT_POST, 'retino_scopy_OD', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_retino_scopy_OD.png');
            file_put_contents($storagePath, $data);
            $form_details->retino_scopy_OD = 'uploads/eyeform/'.$form_details->id .'_retino_scopy_OD.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->retino_scopy_OS)) {

            $img = filter_input(INPUT_POST, 'retino_scopy_OS', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_retino_scopy_OS.png');
            file_put_contents($storagePath, $data);
            $form_details->retino_scopy_OS = 'uploads/eyeform/'.$form_details->id .'_retino_scopy_OS.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->gonio_od)) {

            $img = filter_input(INPUT_POST, 'gonio_od', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_gonio_od.png');
            file_put_contents($storagePath, $data);
            $form_details->gonio_od = 'uploads/eyeform/'.$form_details->id .'_gonio_od.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->gonio_os)) {

            $img = filter_input(INPUT_POST, 'gonio_os', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $form_details->id .'_gonio_os.png');
            file_put_contents($storagePath, $data);
            $form_details->gonio_os = 'uploads/eyeform/'.$form_details->id .'_gonio_os.png';
            //Storage::Delete($form_details->OsImg2);
        }

        if (!empty($request->OdImg1) || !empty($request->OsImg1) || !empty($request->OdImg2) || !empty($request->OsImg2) || !empty($request->retino_scopy_OD) || !empty($request->retino_scopy_OS) || !empty($request->gonio_od) || !empty($request->gonio_os)){
            $form_details->save();
        }

        //echo "=====>>>>>>>> <pre>".__LINE__; print_r($_POST); exit;
        
        #region MultipleEntry
        $EfMultiEntryArray = array();
        $multientryArry = array();
        
        DB::table('eyeformmultipleentry')->where('eyeformid', $form_details->id)->where('field_name', 'other_details_treatment_given')->delete();
      
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'other_details_treatment_given', 1, [$request->treatment_given_od], [$request->treatment_given_os]);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        //echo "=====>>>>>>>> <pre>"; print_r($EfMultiEntryArray); exit;
        
       $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'ChiefComplaint', count($request->ChiefComplaint), $request->ChiefComplaint_OD, $request->ChiefComplaint_OS, $request->ChiefComplaint_OD_duration, $request->ChiefComplaint_OS_duration);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        //$EfMultiEntryArray = $EfMultiEntryArray + $multientryArry;
        //$form_details->eyeformmultipleentry()->saveMany($multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'OpthalHistory',count($request->OpthalHistory), $request->OpthalHistory_OD, $request->OpthalHistory_OS, $request->OpthalHistory_OD_duration, $request->OpthalHistory_OS_duration);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        //$form_details->eyeformmultipleentry()->saveMany($multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'SystemicHistory',count($request->SystemicHistory), $request->SystemicHistory_OD, $request->SystemicHistory_OD, $request->SystemicHistory_OD_duration, $request->SystemicHistory_OD_duration);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'pastHistory',count($request->pastHistory), $request->pastHistory_OD, $request->pastHistory_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'planOfManagement',count($request->planOfManagement), $request->planOfManagement_OD, $request->planOfManagement_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
		//echo "SystemicHistory : "; print_r($request->SystemicHistory); exit;
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'ConjAndLids',count($request->ConjAndLids), $request->ConjAndLids_OD, $request->ConjAndLids_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'Lids',count($request->Lids), $request->Lids_OD, $request->Lids_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'AC',count($request->AC), $request->AC_OD, $request->AC_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'IRIS',count($request->IRIS), $request->IRIS_OD, $request->IRIS_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'sac',count($request->sac), $request->sac_OD, $request->sac_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'Retina',count($request->Retina), $request->Retina_OD, $request->Retina_OS, $request->retina_eye_OD, $request->retina_eye_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'Macula',count($request->Macula), $request->Macula_OD, $request->Macula_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'ONH',count($request->ONH), $request->ONH_OD, $request->ONH_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'OrbitSacsEyeMotility',count($request->OrbitSacsEyeMotility), $request->OrbitSacsEyeMotility_OD, $request->OrbitSacsEyeMotility_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'cornia',count($request->cornia), $request->cornia_od, $request->cornia_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'pupilIrisac',count($request->pupilIrisac), $request->pupilIrisac_OD, $request->pupilIrisac_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'lens',count($request->lens), $request->lens_od, $request->lense_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'vitreoretinal',count($request->vitreoretinal), $request->vitreoretinal_OD, $request->vitreoretinal_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'diagno',count($request->diagno), $request->diagno_od, $request->diagno_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'OCT',count($request->OCT), $request->OCT_OD, $request->OCT_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'EOM',count($request->EOM), $request->EOM_OD, $request->EOM_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
 //---------------------------------------------------------------------------------------------------------------------
$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'flat_k', 1, [$request->flat_k_od], [$request->flat_k_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'flat_axis', 1, [$request->flat_axis_od], [$request->flat_axis_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'stap_k', 1, [$request->stap_k_od], [$request->stap_k_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'stap_axis', 1, [$request->stap_axis_od], [$request->stap_axis_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'axial_length', 1, [$request->axial_length_od], [$request->axial_length_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'optical_acd', 1, [$request->optical_acd_od], [$request->optical_acd_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'target_refraction', 1, [$request->target_refraction_od], [$request->target_refraction_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'lens_thickness', 1, [$request->lens_thickness_od], [$request->lens_thickness_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'wtw', 1, [$request->wtw_od], [$request->wtw_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'kc_formula_use', 1, [$request->kc_formula_use_od], [$request->kc_formula_use_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'type_of_lens', 1, [$request->type_of_lens_od], [$request->type_of_lens_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'se', 1, [$request->se_od], [$request->se_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'iol_cilinder', 1, [$request->iol_cilinder_od], [$request->iol_cilinder_os]);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);


$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsAnteriorSegment', count($request->otherDetailsAnteriorSegment), $request->otherDetailsAnteriorSegment_OD, $request->otherDetailsAnteriorSegment_OS);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsPosteriorSegment', count($request->otherDetailsPosteriorSegment), $request->otherDetailsPosteriorSegment_OD, $request->otherDetailsPosteriorSegment_OS);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsAdditionalInformation', count($request->otherDetailsAdditionalInformationCount), $request->otherDetailsAdditionalInformation, $request->otherDetailsAdditionalInformation);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsAdvice', count($request->otherDetailsAdviceCount), $request->otherDetailsAdvice_OD, $request->otherDetailsAdvice_OS);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'otherDetailsDiagnosis', count($request->otherDetailsDiagnosis), $request->otherDetailsDiagnosis_OD, $request->otherDetailsDiagnosis_OS);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

//dd($_POST);

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'surgery', count($request->surgeryCount), $request->surgery_OD, $request->surgery_OS);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

//Laser Procedure Entry

$multientryArry = array();
$multientryArry = $this->GetMultipleEntryArray($form_details->id, 'laser_procedure_laser_type', count($request->laser_procedure_laser_type), $request->laser_procedure_laser_type_OD, $request->laser_procedure_laser_type_OS);
$EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

$multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'tear_film_breakup_time',count($request->tear_film_breakup_time), $request->tear_film_breakup_time_OD, $request->tear_film_breakup_time_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'eye_sonography',count($request->tear_film_breakup_time), $request->eye_sonography_OD, $request->eye_sonography_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'colour', count($request->colour_OD), $request->colour_OD, $request->colour_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        //dd($EfMultiEntryArray);
        //echo "============<pre>".__LINE__; print_r($multientryArry); exit;
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'schimerTest1', count($request->schimerTest1_OD), $request->schimerTest1_OD, $request->schimerTest1_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        
       // echo "============<pre>".__LINE__; print_r($multientryArry);
        //dd($EfMultiEntryArray);
        //echo "============<pre>".__LINE__; print_r($multientryArry); exit;
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'schimerTest2', count($request->schimerTest2_OD), $request->schimerTest2_OD, $request->schimerTest2_OS);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'perimetry_sp', count($request->perimetry_sp_od), $request->perimetry_sp_od, $request->perimetry_sp_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'laser_sp', count($request->laser_sp_od), $request->laser_sp_od, $request->laser_sp_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'oculizer_sp', count($request->oculizer_sp_od), $request->oculizer_sp_od, $request->oculizer_sp_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'ffa_sp', count($request->ffa_sp_od), $request->ffa_sp_od, $request->ffa_sp_os);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'fix_srgery_eye', count($request->fix_srgery_eye), [$request->fix_srgery_eye], [$request->fix_srgery_eye]);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'planned_surgery', count($request->planned_surgery_OD), $request->planned_surgery_OD, $request->planned_surgery_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'selected_iol', count($request->selected_iol_OD), $request->selected_iol_OD, $request->selected_iol_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
        
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'package', count($request->package_OD), $request->package_OD, $request->package_OD);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);
//-------------------------------------------------------------------------------------------------------------------------
        
        //dd($EfMultiEntryArray);
        
        $form_details->eyeformmultipleentry()->saveMany($EfMultiEntryArray);
        #endregion

	//---------------------------------------------------------------------------------------------------------------------


$this->GetSingleEntryArray($form_details->id, 'flat_k', 1, [$request->flat_k_od], [$request->flat_k_os]);

$this->GetSingleEntryArray($form_details->id, 'flat_axis', 1, [$request->flat_axis_od], [$request->flat_axis_os]);

$this->GetSingleEntryArray($form_details->id, 'stap_k', 1, [$request->stap_k_od], [$request->stap_k_os]);

$this->GetSingleEntryArray($form_details->id, 'stap_axis', 1, [$request->stap_axis_od], [$request->stap_axis_os]);

$this->GetSingleEntryArray($form_details->id, 'axial_length', 1, [$request->axial_length_od], [$request->axial_length_os]);

$this->GetSingleEntryArray($form_details->id, 'optical_acd', 1, [$request->optical_acd_od], [$request->optical_acd_os]);

$this->GetSingleEntryArray($form_details->id, 'target_refraction', 1, [$request->target_refraction_od], [$request->target_refraction_os]);

$this->GetSingleEntryArray($form_details->id, 'lens_thickness', 1, [$request->lens_thickness_od], [$request->lens_thickness_os]);

$this->GetSingleEntryArray($form_details->id, 'wtw', 1, [$request->wtw_od], [$request->wtw_os]);

$this->GetSingleEntryArray($form_details->id, 'kc_formula_use', 1, [$request->kc_formula_use_od], [$request->kc_formula_use_os]);

$this->GetSingleEntryArray($form_details->id, 'type_of_lens', 1, [$request->type_of_lens_od], [$request->type_of_lens_os]);

$this->GetSingleEntryArray($form_details->id, 'se', 1, [$request->se_od], [$request->se_os]);

$this->GetSingleEntryArray($form_details->id, 'iol_cilinder', 1, [$request->iol_cilinder_od], [$request->iol_cilinder_os]);

$this->GetSingleEntryArray($form_details->id, 'other_details_comment', 1, [$request->other_details_comment], [$request->other_details_comment]);
$this->GetSingleEntryArray($form_details->id, 'surgery_comment', 1, [$request->surgery_comment], [$request->surgery_comment]);

//Laser Procedure Entry
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_date', 1, [$request->laser_procedure_date_OD], [$request->laser_procedure_date_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_power', 1, [$request->laser_procedure_power_OD], [$request->laser_procedure_power_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_exposure_time', 1, [$request->laser_procedure_exposure_time_OD], [$request->laser_procedure_exposure_time_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_sitting', 1, [$request->laser_procedure_sitting_OD], [$request->laser_procedure_sitting_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_spot_size', 1, [$request->laser_procedure_spot_size_OD], [$request->laser_procedure_spot_size_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_no_of_spots', 1, [$request->laser_procedure_no_of_spots_OD], [$request->laser_procedure_no_of_spots_OS]);
$this->GetSingleEntryArray($form_details->id, 'laser_procedure_note', 1, [$request->laser_procedure_note_OD], [$request->laser_procedure_note_OS]);
//-------------------------------------------------------------------------------------------------------------------------
//================= inser cutom data ===========================
		if(isset($request->custom_values)) {
		foreach($request->custom_values as $key => $custom_values_names_row) {
			if($request->custom_values_od[$key] != "") {
				if($custom_values_names_row == "systemicHistory") { 

					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];
					$fieldName1 = 'systemic_history';

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);

					DB::table('patients_systemic_history')->insert(['case_id' => $request->case_id, 'value' => $request->custom_values_od[$key]]);
				} else if(in_array($custom_values_names_row, ["dvn", "nvn", "withpinhole","colour_vision", "withglasses", "withglassesdilated"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['dvn' => 'dvn_od', 'nvn' => 'nvn_od', 'withpinhole' => 'withpinhole_OD', 'colour_vision' => 'colour_vision_OD', 'withglasses' => 'withglasses_OD', 'withglassesdilated' => 'with_glass_dilated_od'];
					$os = ['dvn' => 'dvn_os', 'nvn' => 'nvn_os', 'withpinhole' => 'withpinhole_OS', 'colour_vision' => 'colour_vision_OS', 'withglasses' => 'withglasses_OS', 'withglassesdilated' => 'with_glass_dilated_os'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");

						DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}

				} else if(in_array($custom_values_names_row, ["IOP", "CD", "Pachymetry","CCT"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['IOP' => 'IOP_OD', 'CD' => 'Ratio OD', 'Pachymetry' => 'Pachymetry_OD', 'CCT' => 'CCT_OD'];
					$os = ['IOP' => 'IOP_OS', 'CD' => 'Ratio OS', 'Pachymetry' => 'Pachymetry_OS', 'CCT' => 'CCT_OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					$fieldName1 = str_replace(' ', '_', $fieldName1);
					DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						$fieldName2 = str_replace(' ', '_', $fieldName2);
						DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}

				} else if(in_array($custom_values_names_row, ["k1", "k2", "axial_length", "lenspower", "KC", "lens_type"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['k1' => 'k1_od', 'k2' => 'k2_od', 'axial_length' => 'axial_length_OD', 'lenspower' => 'lenspower_od', 'KC' => 'KC_OD', 'lens_type' => 'lens_type_OD'];
					$os = ['k1' => 'k1_os', 'k2' => 'k2_os', 'axial_length' => 'axial_length_OS', 'lenspower' => 'lenspower_os', 'KC' => 'KC_OS', 'lens_type' => 'lens_type_OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					//$fieldName1 = str_replace(' ', '_', $fieldName1);
					DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						//$fieldName2 = str_replace(' ', '_', $fieldName2);
						DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}

				} else if(in_array($custom_values_names_row, ["otherDetailsAnteriorSegment", "otherDetailsPosteriorSegment"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];
					
					$fieldName1 = $custom_values_names_row;

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					//$fieldName1 = str_replace(' ', '_', $fieldName1);
					DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

				} else if(in_array($custom_values_names_row, ["colour", "schimerTest1", "schimerTest2", "perimetry_sp", "laser_sp", "oculizer_sp", "ffa_sp"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['colour' => 'colour OD', 'schimerTest1' => 'schimerTest1_OD', 'schimerTest2' => 'schimerTest2_OD', 'OCT' => 'OCT OD', 'EOM' => 'EOM OD', 'perimetry_sp' => 'perimetry_sp OD', 'laser_sp' => 'laser_sp OD', 'oculizer_sp' => 'oculizer_sp OD', 'ffa_sp' => 'ffa_sp OD'];
					$os = ['colour' => 'colour OS', 'schimerTest1' => 'schimerTest1_OS', 'schimerTest2' => 'schimerTest2_OS', 'OCT' => 'OCT OS', 'EOM' => 'EOM OS', 'perimetry_sp' => 'perimetry_sp OS', 'laser_sp' => 'laser_sp OS', 'oculizer_sp' => 'oculizer_sp OS', 'ffa_sp' => 'ffa_sp OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					$fieldName1 = str_replace(' ', '_', $fieldName1);
					//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						$fieldName2 = str_replace(' ', '_', $fieldName2);
						//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}
                                        
                                        $custom_insert_data = array (
						'eyeformid' => $form_details->id,
						'field_name' => $custom_values_names_row,
						'field_value_OD' => $request->custom_values_od[$key]
					);

					if($request->custom_values_os[$key] != "") {
						$custom_insert_data['field_value_OS'] = $request->custom_values_os[$key];
					}

					DB::table('eyeformmultipleentry')->insert($custom_insert_data);

				} else if(in_array($custom_values_names_row, ["OCT", "EOM"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['OCT' => 'OCT OD', 'EOM' => 'EOM OD'];
					$os = ['OCT' => 'OCT OS', 'EOM' => 'EOM OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					$fieldName1 = str_replace(' ', '_', $fieldName1);
					//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						$fieldName2 = str_replace(' ', '_', $fieldName2);
						//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}


					$custom_insert_data = array (
						'eyeformid' => $form_details->id,
						'field_name' => $custom_values_names_row,
						'field_value_OD' => $request->custom_values_od[$key]
					);

					if($request->custom_values_os[$key] != "") {
						$custom_insert_data['field_value_OS'] = $request->custom_values_os[$key];
					}

					DB::table('eyeformmultipleentry')->insert($custom_insert_data);

				} else if(in_array($custom_values_names_row, ["ChiefComplaint", "OpthalHistory"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['ChiefComplaint' => 'Chief Complaint OD', 'OpthalHistory' => 'Opthal History OD'];
					$os = ['ChiefComplaint' => 'Chief Complaint OS', 'OpthalHistory' => 'Opthal History OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					$fieldName1 = str_replace(' ', '_', $fieldName1);
					//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						$fieldName2 = str_replace(' ', '_', $fieldName2);
						//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}


					$custom_insert_data = array (
						'eyeformid' => $form_details->id,
						'field_name' => $custom_values_names_row,
						'field_value_OD' => $request->custom_values_od[$key]
					);

					if($request->custom_values_os[$key] != "") {
						$custom_insert_data['field_value_OS'] = $request->custom_values_os[$key];
					}

					DB::table('eyeformmultipleentry')->insert($custom_insert_data);

				} else if(in_array($custom_values_names_row, ["Lids", "Orbit", "ConjAndLids", 
					"cornia", 
					"AC", 
					"IRIS", 
					"pupilIrisac", 
					"lens", 
					"vitreoretinal", 
					"Retina", 
					"ONH", 
					"Macula", 
					"sac","pastHistory", "planOfManagement", "tear_film_breakup_time", "eye_sonography"])) {  
					$formName = "EyeForm";
					$value= $request->custom_values_od[$key];

					$od = ['Lids' => 'LIDS OD', 
						'Orbit' => 'OrbitSacsEyeMotility OD', 
						'ConjAndLids' => 'Conj And Lids OD',
						'cornia' => 'Cornea OD', 
						'AC' => 'AC OD', 
						'IRIS' => 'IRIS OD', 
						'pupilIrisac' => 'pupilIrisac OD', 
						'lens' => 'lens OD', 
						'vitreoretinal' => 'vitreoretinal OD', 
						'Retina' => 'Retina OD', 
						'ONH' => 'ONH OD', 
						'Macula' => 'Macula OD', 
						'sac' => 'sac OD',
                                                'pastHistory' => 'pastHistory_OD',
                                                'planOfManagement' => 'planOfManagement_OD',
                                                'tear_film_breakup_time' => 'tear_film_breakup_time_OD',
                                                'eye_sonography' => 'eye_sonography_OD'];

					$os = ['Lids' => 'LIDS OS', 
						'Orbit' => 'OrbitSacsEyeMotility OS', 
						'ConjAndLids' => 'Conj And Lids OS',
						'cornia' => 'Cornea OS', 
						'AC' => 'AC OS', 
						'IRIS' => 'IRIS OS', 
						'pupilIrisac' => 'pupilIrisac OS',  
						'lens' => 'lens OS', 
						'vitreoretinal' => 'vitreoretinal OS', 
						'Retina' => 'Retina OS', 
						'ONH' => 'ONH OS', 
						'Macula' => 'Macula OS', 
						'sac' => 'sac OS',
                                                'pastHistory' => 'pastHistory_OS',
                                                'planOfManagement' => 'planOfManagement_OS',
                                                'tear_film_breakup_time' => 'tear_film_breakup_time_OS',
                                                'eye_sonography' => 'eye_sonography_OS'];
					
					$fieldName1 = $od[$custom_values_names_row];

					$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
					$insert_id = DB::getPdo()->lastInsertId();

					$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
					
					$fieldName1 = str_replace(' ', '_', $fieldName1);
					//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName1 => $value]);

					$value= $request->custom_values_os[$key];

					if($request->custom_values_os[$key] != "") {
						$fieldName2 = $os[$custom_values_names_row];

						$sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
						
						$fieldName2 = str_replace(' ', '_', $fieldName2);
						//DB::table('eyeform')->where('case_id', $request->case_id)->update([$fieldName2 => $value]);
					}


					$custom_insert_data = array (
						'eyeformid' => $form_details->id,
						'field_name' => $custom_values_names_row,
						'field_value_OD' => $request->custom_values_od[$key]
					);

					if($request->custom_values_os[$key] != "") {
						$custom_insert_data['field_value_OS'] = $request->custom_values_os[$key];
					}

					DB::table('eyeformmultipleentry')->insert($custom_insert_data);

				} else {					

					$custom_insert_data = array (
						'eyeformid' => $form_details->id,
						'field_name' => $custom_values_names_row,
						'field_value_OD' => $request->custom_values_od[$key]
					);
                                        
$formName = "EyeForm";
$value= $request->custom_values_od[$key];
$fieldName1 = $custom_values_names_row;

$sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
			
$insert_id = DB::getPdo()->lastInsertId();



if($request->custom_values_os[$key] != "") {
        $custom_insert_data['field_value_OS'] = $request->custom_values_os[$key];
        
        $value= $request->custom_values_os[$key];
        $sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");
}

$sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);
                                        
                                        //echo "============>>>>>>>> <pre>"; print_r($custom_insert_data);
                                        
					DB::table('eyeformmultipleentry')->insert($custom_insert_data);
				}
			}
		}
		}
                
             //   echo "============>>>>>>>> <pre>"; exit;
        return Redirect::back()->with('flash_message','Record Added Successfully!');
    }

    public function getfundusImage($case_id){

        return view('EyeForm.fundusImage', compact('case_id'));
    }

    public function SavefundusImage(Request $request){

        if (!empty($request->OdImg1)) {

            $img = filter_input(INPUT_POST, 'OdImg1', FILTER_SANITIZE_URL);
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $request->case_id .'_ODFundusImage.png');
            file_put_contents($storagePath, $data);

            $report_image = report_image::where('case_id', $request->case_id)->first();
            if ($report_image === null) {
                $report_image = new report_image();
            }
            $report_image->reportFileName = 'Fundus OD image for case ID'. $request->case_id;
            $report_image->case_id = $request->case_id;
            $report_image->filePath = 'uploads/eyeform/'. $request->case_id .'_ODFundusImage.png';//$request->file('reportImage')->store('uploads');
            $report_image->save();

        }
        if (!empty($request->OsImg1)) {

            $img = filter_input(INPUT_POST, 'OsImg1', FILTER_SANITIZE_URL);
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/eyeform/'. $request->case_id .'_OSFundusImage.png');
            file_put_contents($storagePath, $data);
            
            $report_image = report_image::where('case_id', $request->case_id)->first();
            if ($report_image === null) {
                $report_image = new report_image();
            }
            $report_image->reportFileName = 'Fundus OS image for case ID'. $request->case_id;
            $report_image->case_id = $request->case_id;
            $report_image->filePath = 'uploads/eyeform/'. $request->case_id .'_OSFundusImage.png';//$request->file('reportImage')->store('uploads');
            $report_image->save();

        }

        return redirect('AddEditEyeDetails/'.$request->case_id)->with('flash_message', 'Fundus Image saved successfully');

    }

    public  function GetSingleEntryArray($formId, $fieldName, $arrayLength, array $fieldArray_OD = NULL, array $fieldArray_OS = NULL) {

		
	$eyeformmultipleentry = DB::table('eyeformmultipleentry')->where('eyeformid', $formId)->where('field_name', $fieldName)->first();

	$insert_data = array(
		'eyeformid' => $formId,
		'field_name' => $fieldName,
		'field_value_OD' => $fieldArray_OD[0],
		'field_value_OS' => $fieldArray_OS[0],
	);
	
	//echo "========== <pre>"; print_r($insert_data); print_r($eyeformmultipleentry); exit;
	if ($eyeformmultipleentry === null) {
		$insert_data['created_at'] = date('Y-m-d h:i:s');
		DB::table('eyeformmultipleentry')->insert($insert_data);
	} else {
		$insert_data['updated_at'] = date('Y-m-d h:i:s');
		DB::table('eyeformmultipleentry')->where('id', $eyeformmultipleentry->id)->update($insert_data);
	}
		
		
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

    public static function IsFieldEmpty($fieldValue){
        if (!empty($fieldValue) && !is_null($fieldValue) && (isset($fieldValue) && $fieldValue != 'Select')){
            return false;
        }
        return true;
    }

    public function deleteImage(Request $request){
        $eyeform = eyeform::where('case_id', $request->case_id)->first();
        if($request->imageName == "OdImg1"){
            Storage::Delete($eyeform->OdImg1);
            $eyeform->OdImg1 = null;
            $eyeform->save();
        }
        if($request->imageName == "OsImg1"){
            Storage::Delete($eyeform->OsImg1);
            $eyeform->OsImg1 = null;
            $eyeform->save();
        }
        if($request->imageName == "OdImg2"){
            Storage::Delete($eyeform->OdImg2);
            $eyeform->OdImg2 = null;
            $eyeform->save();
        }
        if($request->imageName == "OsImg2"){
            Storage::Delete($eyeform->OsImg2);
            $eyeform->OsImg2 = null;
            $eyeform->save();
        }
        if($request->imageName == "retino_scopy_OD"){
            Storage::Delete($eyeform->retino_scopy_OD);
            $eyeform->retino_scopy_OD = null;
            $eyeform->save();
        }
        if($request->imageName == "retino_scopy_OS"){
            Storage::Delete($eyeform->retino_scopy_OS);
            $eyeform->retino_scopy_OS = null;
            $eyeform->save();
        }
		return "OK";
    }


    public function deleteMultiEntry(Request $request, $id) {	
		if($request->type == "systemic_history") {
			DB::table('patients_systemic_history')->where('id', $id)->delete();
		} else {
			$eyeformmultipleentry = eyeformmultipleentry::findOrFail($id);
			$eyeformmultipleentry->delete();
		}
		
		return "OK";
	}
        
   

    public function AddEditEyeDetails($case_id) {
        
        $case_master_data  = Case_master::findOrFail($case_id);
        
        //dd($case_master);
        
        $doc1 =  DB::select("SELECT * from doctors");
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
         $doctorFormView = doctor_form_mapping::pluck('displayText', 'formViewName');
		$selectdoc       = Case_master::where('id',$case_id)->pluck('doctor_id');
		$doctorID = DB::table('case_master')
             ->select('doctor_id')
             ->where('id','=', $case_id)
             ->first();
        $DID=$doctorID->doctor_id;
          
        $form_details = eyeform::where('case_id', $case_id)->first();
        
        //dd($form_details);
        $blood_categories =  blood_investigation_titles::all();

        $allCats = DB::table('blood_investigation_titles')
            ->Join('eye_blood_investigation', 'blood_investigation_titles.id', '=', 'eye_blood_investigation.blood_title_id')
            ->get()->toArray();
		//dd($allCats);
       // echo "<pre> ================= ";print_r($allCats);

        foreach($allCats as $CatData) {
            $categories[$CatData->blood_title][] = $CatData->blood_value;
        }

        //echo "<pre> ==========******= ";print_r($categories);exit;

        if ($form_details === null) {
            $form_details = new eyeform();
        } 
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        $report_image = report_image::where('case_id', $case_id)->get();
        $reportScan_image = report_image::where('case_id', $case_id)->Where('reportFileName', 'EyeFormScanImage')->get()->toArray();
        $sp_test_image = report_image::where('case_id', $case_id)->Where('reportFileName', 'EyeFormSpTestImage')->get()->toArray();

        //echo "<pre> ==========******= ";print_r($sp_test_image);exit;


        // if (empty($report_image) || $report_image === null) {
        //     $form_details = new report_image();
        // }
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        $defaultValues = [];
        foreach($form_details->toArray() as $key => $form_details_row) {
           $defaultValues[$key] = $form_details_row;
        }
        
        if ($form_details != null) {
            $eyform_refraction_retina_scopy_details = eyform_refraction_retina_scopy::where('eyeformid', $form_details->id)->first();
            
            if($eyform_refraction_retina_scopy_details) {
                foreach($eyform_refraction_retina_scopy_details->toArray() as $key => $val) {
                    if($key != "created_at" && $key != "updated_at") {
                        $form_details->{$key} = $val;
                    }
                }
            }


            
            $eyform_vision_pgp_details = eyform_vision_pgp::where('eyeformid', $form_details->id)->first();
            
            if($eyform_vision_pgp_details) {
                foreach($eyform_vision_pgp_details->toArray() as $key => $val) {
                    if($key != "created_at" && $key != "updated_at") {
                        $form_details->{$key} = $val;
                    }
                }
            }
        }
		
		$case_master  = Case_master::findOrFail($case_id);
		$glass_prescription = $case_master ->glass_prescription()->first();
		if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
			$glass_prescription = new glass_prescription();
		}
//$glass_prescription = new glass_prescription();
		//dd($glass_prescription);

		$form_dropdowns_array = $this->get_form_dropdowns_array();
		$dropdown_options_table_name = 'form_dropdowns';
        
         //echo "====>>> <pre>"; print_r($reportScan_image); exit;
        
        //echo "======>>>>> <pre>"; print_r($defaultValues); exit;

		//echo "======>>>>> <pre>"; print_r($defaultValues); exit;
		
		//$form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'uveiitis_bloodtests')->pluck('value')->toArray();

        //$form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->pluck('value')->toArray();
		
		$form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->select(DB::Raw('CONCAT(test_type, "_",value) as value'))->pluck('value')->toArray();

		//echo "=========== <pre>";print_r($form_details->uveiitis_bloodtests_data);exit;

		$form_details->pre_operative_bloodtests_data = $pre_operative_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'pre_operative_bloodtests')->pluck('value')->toArray();

		$form_details->patients_systemic_history = DB::table('patients_systemic_history')->where('case_id',$case_id)->get()->toArray();
        $treatmentAdvice = DB::table('eyeformmultipleentry')->where('field_name','treatmentAdvice')->get()->toArray();

//echo "=========== <pre>";print_r($form_dropdowns->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray());exit;
      $fundus_main_images = $this->get_fundus_images();
      //$updated_fundus_images = $this->get_updated_fundus_images($case_id);
      
      $updated_fundus_images = DB::table('fundus_images')->where('case_id', $case_id)->get();
      
     //dd($updated_fundus_images);
      
      $refraction_dropdowns = DB::table('refraction_dropdown')->get();
      // $refraction_dropdowns_arr = $refraction_dropdowns->where('key_value', 'sph')->pluck('os','od')->toArray();
      $refraction_dropdowns_arr['sph'] = [];
      $refraction_dropdowns_arr['cyl'] = [];
      $refraction_dropdowns_arr['vision'] = [];
      foreach($refraction_dropdowns as $refraction_dropdowns_row) {
           $refraction_dropdowns_arr[$refraction_dropdowns_row->key_value][$refraction_dropdowns_row->id] = $refraction_dropdowns_row->os; 
      }
      
      $finding_templates = DB::table('finding_template')->where('status', '1')->get();
      //dd($refraction_dropdowns_arr);
      
      $patient_activity = DB::table('patient_activity')->where(['case_id' => $case_id, 'activity_type' => 'ophthalmetry'])->first();
      
      $doctor_activity = DB::table('patient_activity')->where(['case_id' => $case_id, 'activity_type' => 'patient_doctor_state'])->first();
      
      $procedure_activity = DB::table('patient_activity')->where(['case_id' => $case_id, 'activity_type' => 'doctor_procedure'])->first();
      
      
      $consultant_activity = DB::table('patient_activity')->where(['case_id' => $case_id, 'activity_type' => 'consultant_activity'])->first();
      //dd($patient_activity);
      
      $payment_modes_array = [];
			$payment_modes = PaymentModes::all();
		
			foreach($payment_modes as $payment_modes_row) {
				$payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
			}
                        
                        //dd($payment_modes_array);
                        
                        $commonHelper = $this->commonHelper;
                        
        return view('EyeForm.EyeForm', compact('case_master_data','casedata','form_details','selectdoc', 'form_dropdowns', 'report_image', 'defaultValues','doctorlist','DID', 'form_dropdowns_array', 'dropdown_options_table_name', 'glass_prescription', 'blood_categories', 'categories', 'treatmentAdvice','reportScan_image', 'fundus_main_images', 'updated_fundus_images', 'sp_test_image', 'refraction_dropdowns_arr', 'finding_templates', 'patient_activity', 'doctor_activity', 'procedure_activity','consultant_activity', 'payment_modes_array', 'payment_modes', 'commonHelper'));
    }

    public function scanPrint($case_id) {
        $reportScan_image = report_image::where('case_id', $case_id)->orWhere('reportFileName', 'EyeFormScanImage')->get()->toArray();
        $form_details = eyeform::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new eyeform();
        }
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();
        $case_master  = Case_master::findOrFail($case_id);
        $glass_prescription = $case_master ->glass_prescription()->first();
        if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
            $glass_prescription = new glass_prescription();
        }
        
        $eyform_refraction_retina_scopy_details = DB::table('eyform_refraction_retina_scopy')->where('eyeformid', $form_details->id)->first();
        
        $eyform_vision_pgp_details = DB::table('eyform_vision_pgp')->where('eyeformid', $form_details->id)->first();
        
        $form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'uveiitis_bloodtests')->pluck('value')->toArray();

        $form_details->pre_operative_bloodtests_data = $pre_operative_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'pre_operative_bloodtests')->pluck('value')->toArray();
        
        $form_details->patients_systemic_history = DB::table('patients_systemic_history')->where('case_id',$case_id)->get()->toArray();
		$multiple_entries_data = DB::table('eyeformmultipleentry')->where('eyeformid', $form_details->id)->get()->toArray();        
        $multiple_entries_data_arr = [];
        foreach($multiple_entries_data as $multiple_entries_data_row) {
            $multiple_entries_data_arr[$multiple_entries_data_row->field_name]['field_value_OD'] = $multiple_entries_data_row->field_value_OD;
            $multiple_entries_data_arr[$multiple_entries_data_row->field_name]['field_value_OS'] = $multiple_entries_data_row->field_value_OS;
        }
        //dd($casedata);
        return view('EyeForm.EyeScanPrint', compact('case_master','casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription', 'eyform_refraction_retina_scopy_details', 'eyform_vision_pgp_details','reportScan_image','multiple_entries_data_arr'));
    }

	public function get_form_dropdowns_array($form_name = "gyn") {
		$form_dropdowns_array = [];
		$form_dropdowns = [];
		
		$form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();

		foreach($form_dropdowns as $form_dropdowns_row) {
			$form_dropdowns_array[$form_dropdowns_row->fieldName][$form_dropdowns_row->id]['ddText'] = $form_dropdowns_row->ddText;
			$form_dropdowns_array[$form_dropdowns_row->fieldName][$form_dropdowns_row->id]['ddValue'] = $form_dropdowns_row->ddValue;
		}

		return $form_dropdowns_array;
	}

	
	// Old Eye form 
    public function AddEditEyeDetailsold_bk_26dec2021($case_id) {}
    
    public function AddEditEyeDetailsold($case_id) {
        
        $case_master_data  = Case_master::findOrFail($case_id);
        
        //dd($case_master);
        
        $doc1 =  DB::select("SELECT * from doctors");
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
         $doctorFormView = doctor_form_mapping::pluck('displayText', 'formViewName');
		$selectdoc       = Case_master::where('id',$case_id)->pluck('doctor_id');
		$doctorID = DB::table('case_master')
             ->select('doctor_id')
             ->where('id','=', $case_id)
             ->first();
        $DID=$doctorID->doctor_id;
          
        $form_details = eyeform::where('case_id', $case_id)->first();
        
        //dd($form_details);
        $blood_categories =  blood_investigation_titles::all();

        $allCats = DB::table('blood_investigation_titles')
            ->Join('eye_blood_investigation', 'blood_investigation_titles.id', '=', 'eye_blood_investigation.blood_title_id')
            ->get()->toArray();
		//dd($allCats);
       // echo "<pre> ================= ";print_r($allCats);

        foreach($allCats as $CatData) {
            $categories[$CatData->blood_title][] = $CatData->blood_value;
        }

        //echo "<pre> ==========******= ";print_r($categories);exit;

        if ($form_details === null) {
            $form_details = new eyeform();
        } 
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        $report_image = report_image::where('case_id', $case_id)->get();
        $reportScan_image = report_image::where('case_id', $case_id)->Where('reportFileName', 'EyeFormScanImage')->get()->toArray();
        $sp_test_image = report_image::where('case_id', $case_id)->Where('reportFileName', 'EyeFormSpTestImage')->get()->toArray();

        //echo "<pre> ==========******= ";print_r($sp_test_image);exit;


        // if (empty($report_image) || $report_image === null) {
        //     $form_details = new report_image();
        // }
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        $defaultValues = [];
        foreach($form_details->toArray() as $key => $form_details_row) {
           $defaultValues[$key] = $form_details_row;
        }
        
        if ($form_details != null) {
            $eyform_refraction_retina_scopy_details = eyform_refraction_retina_scopy::where('eyeformid', $form_details->id)->first();
            
            if($eyform_refraction_retina_scopy_details) {
                foreach($eyform_refraction_retina_scopy_details->toArray() as $key => $val) {
                    if($key != "created_at" && $key != "updated_at") {
                        $form_details->{$key} = $val;
                    }
                }
            }


            
            $eyform_vision_pgp_details = eyform_vision_pgp::where('eyeformid', $form_details->id)->first();
            
            if($eyform_vision_pgp_details) {
                foreach($eyform_vision_pgp_details->toArray() as $key => $val) {
                    if($key != "created_at" && $key != "updated_at") {
                        $form_details->{$key} = $val;
                    }
                }
            }
        }
		
		$case_master  = Case_master::findOrFail($case_id);
		$glass_prescription = $case_master ->glass_prescription()->first();
		if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
			$glass_prescription = new glass_prescription();
		}
//$glass_prescription = new glass_prescription();
		//dd($glass_prescription);

		$form_dropdowns_array = $this->get_form_dropdowns_array();
		$dropdown_options_table_name = 'form_dropdowns';
        
         //echo "====>>> <pre>"; print_r($reportScan_image); exit;
        
        //echo "======>>>>> <pre>"; print_r($defaultValues); exit;

		//echo "======>>>>> <pre>"; print_r($defaultValues); exit;
		
		//$form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'uveiitis_bloodtests')->pluck('value')->toArray();

        //$form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->pluck('value')->toArray();
		
		$form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->select(DB::Raw('CONCAT(test_type, "_",value) as value'))->pluck('value')->toArray();

		//echo "=========== <pre>";print_r($form_details->uveiitis_bloodtests_data);exit;

		$form_details->pre_operative_bloodtests_data = $pre_operative_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'pre_operative_bloodtests')->pluck('value')->toArray();

		$form_details->patients_systemic_history = DB::table('patients_systemic_history')->where('case_id',$case_id)->get()->toArray();
        $treatmentAdvice = DB::table('eyeformmultipleentry')->where('field_name','treatmentAdvice')->get()->toArray();

//echo "=========== <pre>";print_r($form_dropdowns->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray());exit;
      $fundus_main_images = $this->get_fundus_images();
      //$updated_fundus_images = $this->get_updated_fundus_images($case_id);
      
      $updated_fundus_images = DB::table('fundus_images')->where('case_id', $case_id)->get();
      
     //dd($updated_fundus_images);
      
      $refraction_dropdowns = DB::table('refraction_dropdown')->get();
      // $refraction_dropdowns_arr = $refraction_dropdowns->where('key_value', 'sph')->pluck('os','od')->toArray();
      $refraction_dropdowns_arr['sph'] = [];
      $refraction_dropdowns_arr['cyl'] = [];
      $refraction_dropdowns_arr['vision'] = [];
      foreach($refraction_dropdowns as $refraction_dropdowns_row) {
           $refraction_dropdowns_arr[$refraction_dropdowns_row->key_value][$refraction_dropdowns_row->id] = $refraction_dropdowns_row->os; 
      }
      
      $finding_templates = DB::table('finding_template')->where('status', '1')->get();
      //dd($refraction_dropdowns_arr);
      
      $patient_activity = DB::table('patient_activity')->where(['case_id' => $case_id, 'activity_type' => 'ophthalmetry'])->first();
      
      $doctor_activity = DB::table('patient_activity')->where(['case_id' => $case_id, 'activity_type' => 'patient_doctor_state'])->first();
      
      $procedure_activity = DB::table('patient_activity')->where(['case_id' => $case_id, 'activity_type' => 'doctor_procedure'])->first();
      
      
      $consultant_activity = DB::table('patient_activity')->where(['case_id' => $case_id, 'activity_type' => 'consultant_activity'])->first();
      //dd($patient_activity);
      
      $payment_modes_array = [];
			$payment_modes = PaymentModes::all();
		
			foreach($payment_modes as $payment_modes_row) {
				$payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
			}
                        
                        //dd($payment_modes_array);
                        
        //return view('EyeForm.EyeFormold', compact('casedata','form_details','selectdoc', 'form_dropdowns', 'report_image', 'defaultValues','doctorlist','DID'));
                        
        return view('EyeForm.EyeFormold', compact('case_master_data','casedata','form_details','selectdoc', 'form_dropdowns', 'report_image', 'defaultValues','doctorlist','DID', 'form_dropdowns_array', 'dropdown_options_table_name', 'glass_prescription', 'blood_categories', 'categories', 'treatmentAdvice','reportScan_image', 'fundus_main_images', 'updated_fundus_images', 'sp_test_image', 'refraction_dropdowns_arr', 'finding_templates', 'patient_activity', 'doctor_activity', 'procedure_activity','consultant_activity', 'payment_modes_array', 'payment_modes'));
    }


   public function avaibaletime($doctor_id,$appointment_dt,Request $request)
    {
        return "hii";
         $mob=$request->input('mobile_no');
 $myDateTime = DateTime::createFromFormat('Y-m-d', $appointment_dt);
        $day=date('D',strtotime($appointment_dt));
        
        switch ($day) {
            case 'Mon':
                $day=1;
                break;
            case 'Tue':
                $day=2;
                break;
                case 'Wed':
                $day=3;
                break;
                case 'Thu': 
                $day=4;
                break;
                case 'Fri':
                $day=5;
                break;
                case 'Sat':
                $day=6;
                break;
                case 'Sun':
                $day=7;
                break;
            default:
                # code...
                break;
        }

        
        $timeslots = DB::select("SELECT * FROM `tbl_appoinment_slot` WHERE doctor_id='$doctor_id' AND day='$day'");
         
 $count1 = count($timeslots);

 if($count1=="0")
 {
    return "0";
 }
 else
 {
//
 // }
         
        $avaibaletimeslot = DB::select("SELECT morningEvening FROM appointments WHERE doctor_id='$doctor_id' AND appointment_dt='$appointment_dt'");
         $count = count($avaibaletimeslot);
          
            if($count=="0")
            {
               // return 0;
              
                  foreach($timeslots as $timeslotvalue)
                    {
                        $timeslot1 = $timeslotvalue->starttime;
                         $slottime = $timeslotvalue->slotime;
                       $data['timeslot1'][]= $timeslot1;
                       $data['slottime'][]= $slottime;
                       
                    } 

            }else{
                                
      
                //
                foreach($timeslots as $timeslotvalue)
                        {

                            
                     $timeslot1[] = $timeslotvalue->starttime;
                      $slottime[] = $timeslotvalue->slotime;
                      
                   }

                foreach($avaibaletimeslot as $avaibaletimeslots1)
                { //return $avaibaletimeslot;
                    $avaitime = $avaibaletimeslots1->morningEvening;
               
                    if(in_array($avaitime, $timeslot1))
                    {
                        //return 0;
                        $key = array_search($avaitime, $timeslot1);
                        unset($timeslot1[$key]);
                        unset($slottime[$key]);

                     
                    }
                   
                }
            
                $data['timeslot1']= array_values($timeslot1);
                 $data['slottime']= array_values($slottime);
            }
         
       return $data; 
    }

    }

    public function ViewEyeDetails($case_id) {
        $form_details = eyeform::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new eyeform();
        }
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        
        $eyform_refraction_retina_scopy_details = DB::table('eyform_refraction_retina_scopy')->where('eyeformid', $form_details->id)->first();
        
        $eyform_vision_pgp_details = DB::table('eyform_vision_pgp')->where('eyeformid', $form_details->id)->first();

		$case_master  = Case_master::findOrFail($case_id);
		$glass_prescription = $case_master ->glass_prescription()->first();
		if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
			$glass_prescription = new glass_prescription();
		}

		//dd($glass_prescription);
        
        //dd($form_details);
        //dd($form_details->eyform_refraction_retina_scopy()->get());
//echo "<pre>"; 
//print_r($eyform_vision_pgp_details); 
//print_r($eyform_refraction_retina_scopy_details);
        //echo "=>>>>>>>> <pre>".$eyform_refraction_retina_scopy_details->retinaCopy_refraction_dv_sph_r;
        //echo "<pre>"; print_r($eyform_refraction_retina_scopy_details);
        //print_r($eyform_vision_pgp_details); 
        //print_r($form_details); 
        //exit;
		
		$form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'uveiitis_bloodtests')->pluck('value')->toArray();

		
		$form_details->pre_operative_bloodtests_data = $pre_operative_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'pre_operative_bloodtests')->pluck('value')->toArray();
        
		$form_details->patients_systemic_history = DB::table('patients_systemic_history')->where('case_id',$case_id)->get()->toArray();

		$form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->orderby('test_type')->get()->toArray();
		
		//echo "=====>>>>>>>>> <pre>"; print_r($form_details->uveiitis_bloodtests_data);exit;

		$multiple_entries_data = DB::table('eyeformmultipleentry')->where('eyeformid', $form_details->id)->get()->toArray();
		
		$multiple_entries_data_arr = [];
		foreach($multiple_entries_data as $multiple_entries_data_row) {
			$multiple_entries_data_arr[$multiple_entries_data_row->field_name]['field_value_OD'] = $multiple_entries_data_row->field_value_OD;
			$multiple_entries_data_arr[$multiple_entries_data_row->field_name]['field_value_OS'] = $multiple_entries_data_row->field_value_OS;
		}

        $bloodtests_data =  DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->get()->toArray();
		$print_eyeformFields =  DB::table('print_page_settings')->where('form_type', "eyeform")->pluck('value')->toArray();
		
                //-----------------------------------------------
             $doctor = DB::table('users')->whereNotNull('doctor_degree')->whereNotNull('doctor_registration_number')->first();
            
             //$prescription_data = $this->getPresriptionData($case_id);
             $prescription_summary = [];
             
             $prescription_data_array = DB::table('prescription_data')->where('case_id', $case_id)->orderBy('prescription_id')->get();
            
            $prescription_data = [];
            foreach($prescription_data_array as $prescription_data_row) {
                $prescription_data[$prescription_data_row->prescription_id][] = $prescription_data_row;
            }
             //---------------------------------------------
             //dd($multiple_entries_data_arr);
             //dd($prescription_data);
            
        return view('EyeForm.EyeFormView', compact('casedata','form_details', 'eyform_refraction_retina_scopy_details', 'eyform_vision_pgp_details','', 'glass_prescription', 'multiple_entries_data_arr', 'print_eyeformFields', 'doctor', 'prescription_data'));
    }
    
    public function getPresriptionData($id)
    {

        $case_master = Case_master::findOrFail($id);

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
        $casedata = ['id' => $case_master->id, 'doctorlist' => $doctorlist, 'timeslot' => $timeslot, 'medicinlist' => $medicinlist, 'prescriptions' => prescription_list::where('case_id', $case_master->id)
            ->get() , 'DateWiseRecordLst' => $DateWiseRecordLst, 'case_number' => $case_master->case_number, //'p_00000001'
        'patient_name' => $case_master->patient_name, 'doctor_id' => $case_master->doctor_id, 'patient_age' => $case_master->patient_age, 'patient_weight' => $case_master->patient_weight, 'patient_height' => $case_master->patient_height, 'patient_address' => $case_master->patient_address, 'patient_emailId' => $case_master->patient_emailId, 'patient_mobile' => $case_master->patient_mobile, 'male_female' => $case_master->male_female, 'complaint' => $case_master->complaint, 'diagnosis' => $case_master->diagnosis, 'treatment' => $case_master->treatment, 'diagnosis_file' => $case_master->diagnosis_filePath, 'appointment_dt' => ($case_master->FollowUpDate != null) ? Carbon::createFromFormat('Y-m-d', $case_master->FollowUpDate)
            ->format('d/M/Y') : null, 'appointment_timeslot' => $case_master->FollowUpTimeSlot, 'FollowUpDoctor_id' => $case_master->FollowUpDoctor_Id, 'Reports_file' => $case_master->Report_file()
            ->get() , 'Before_file' => $case_master->BeforeImagePath, 'After_file' => $case_master->AfterImagePath, 'field_type_memory' => $field_type_memory, 'field_type_data' => $field_type_data];
        return $casedata;
    }

    public function ViewEyeReportFiles($case_id){
        $report_image = report_image::where('case_id', $case_id)->get();
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        return view('EyeForm.ViewEyeReportFile', compact('report_image', 'casedata'));
    }

    public function printEyeReportFiles($file_id){
        $report_image = report_image::findOrFail($file_id);
        return view('EyeForm.PrintEyeReportFile', compact('report_image'));
    }

    public function PrintEyeOtherDetails($case_id) {
        $form_details = eyeform::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new eyeform();
        }
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();
        $case_master  = Case_master::findOrFail($case_id);
        $glass_prescription = $case_master ->glass_prescription()->first();
        if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
            $glass_prescription = new glass_prescription();
        }
        
        $eyform_refraction_retina_scopy_details = DB::table('eyform_refraction_retina_scopy')->where('eyeformid', $form_details->id)->first();
        
        $eyform_vision_pgp_details = DB::table('eyform_vision_pgp')->where('eyeformid', $form_details->id)->first();
        
        $form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'uveiitis_bloodtests')->pluck('value')->toArray();

        $form_details->pre_operative_bloodtests_data = $pre_operative_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'pre_operative_bloodtests')->pluck('value')->toArray();

        $bloodtests_data =  DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->get()->toArray();

        //echo "<pre> ================= ";print_r($bloodtests_data);exit;
		
        foreach ($bloodtests_data as $key => $value) {
            $newBloodtestdata[$value->test_type][] = $value;
        }
        //echo "<pre> ================= ";print_r($newBloodtestdata);exit;
        $form_details->newBloodtestdata = isset($newBloodtestdata) ? $newBloodtestdata : [];

        $form_details->patients_systemic_history = DB::table('patients_systemic_history')->where('case_id',$case_id)->get()->toArray();

        //dd($casedata);

        $multiple_entries_data = DB::table('eyeformmultipleentry')->where('eyeformid', $form_details->id)->get()->toArray();
        
		$form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->orderby('test_type')->get()->toArray();

        $multiple_entries_data_arr = [];
        foreach($multiple_entries_data as $multiple_entries_data_row) {
            $multiple_entries_data_arr[$multiple_entries_data_row->field_name]['field_value_OD'] = $multiple_entries_data_row->field_value_OD;
            $multiple_entries_data_arr[$multiple_entries_data_row->field_name]['field_value_OS'] = $multiple_entries_data_row->field_value_OS;
        }
        
        //dd($casedata);

        return view('EyeForm.EyeFormOthrDetailsPrint', compact('case_master','casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription', 'eyform_refraction_retina_scopy_details', 'eyform_vision_pgp_details', 'multiple_entries_data_arr'));
    }

    public function PrintEyeDetails($case_id) {
        $form_details = eyeform::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new eyeform();
        }
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();
        $case_master  = Case_master::findOrFail($case_id);
        $glass_prescription = $case_master ->glass_prescription()->first();
        if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
            $glass_prescription = new glass_prescription();
        }
        
        $eyform_refraction_retina_scopy_details = DB::table('eyform_refraction_retina_scopy')->where('eyeformid', $form_details->id)->first();
        
        $eyform_vision_pgp_details = DB::table('eyform_vision_pgp')->where('eyeformid', $form_details->id)->first();
        
		$form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'uveiitis_bloodtests')->pluck('value')->toArray();

		$form_details->pre_operative_bloodtests_data = $pre_operative_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'pre_operative_bloodtests')->pluck('value')->toArray();
		
		$form_details->patients_systemic_history = DB::table('patients_systemic_history')->where('case_id',$case_id)->get()->toArray();

        //dd($casedata);

		$multiple_entries_data = DB::table('eyeformmultipleentry')->where('eyeformid', $form_details->id)->get()->toArray();
		
		$form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->orderby('test_type')->get()->toArray();

		$multiple_entries_data_arr = [];
		foreach($multiple_entries_data as $multiple_entries_data_row) {
			$multiple_entries_data_arr[$multiple_entries_data_row->field_name]['field_value_OD'] = $multiple_entries_data_row->field_value_OD;
			$multiple_entries_data_arr[$multiple_entries_data_row->field_name]['field_value_OS'] = $multiple_entries_data_row->field_value_OS;
		}
		
		$print_eyeformFields =  DB::table('print_page_settings')->where('form_type', "eyeform")->pluck('value')->toArray();

		//$doctor = DB::table('users')->whereNotNull('doctor_degree')->whereNotNull('doctor_registration_number')->first();
                $doctor = DB::table('doctors')->where('id', $case_master->doctor_id)->first();
		//echo "=======>>>>>>> <pre>"; print_r($doctor); exit;
                
                //----------------------------------------------------------
                 $prescription_data_array = DB::table('prescription_data')->where('case_id', $case_id)->orderBy('prescription_id')->get();
            
            $prescription_data = [];
            foreach($prescription_data_array as $prescription_data_row) {
                $prescription_data[$prescription_data_row->prescription_id][] = $prescription_data_row;
            }
            
            //dd($casedata);
                //------------------------------------------------------------
		
        return view('EyeForm.EyeFormPrint', compact('case_master','casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription', 'eyform_refraction_retina_scopy_details', 'eyform_vision_pgp_details', 'multiple_entries_data_arr', 'print_eyeformFields', 'doctor', 'prescription_data'));
    }

    public function autocompleteList(Request $request){
        //DB::enableQueryLog();
        $query = $request->get('query','');
        $PropertyName = $request->get('PropertyName',''); 
        $PropertyNameAs = $PropertyName . ' as abcdds';
        $posts = eyeform::where($PropertyName,'LIKE','%'.$query.'%')->take(20)->pluck($PropertyName)->toArray();//->get(array($PropertyNameAs)); 
        //return var_dump(DB::getQueryLog());
        return response()->json($posts);
	}

	
	
////////////////////////email////////////////////////
 public function SaveCaseHistory2(Request $request) {
         $request->advance_amount = ($request->surgery_advance_amount != '') ? $request->surgery_advance_amount : $request->advance_amount;
         $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
        if (is_null($case_gen)) {
            $case_gen = $this->createCaseNumber();
        }
        
        $case_master = $this->submitKyc($request, $case_gen);
      
            if($request->patient_emailId && !empty($request->patient_emailId)) {
                
                   $msg = 'Welcome To Tejas Infotech Eye Hospital.';
                    $case_number=$request->case_number;
                    $patient_address=$request->patient_address;
                    $patient_mobile=$request->patient_mobile;
                    $doctor_id=$request->doctor_id;

                    $doctor_name = DB::table('doctors')
                                    ->select('doctor_name')
                                    ->where('id','=', $doctor_id)
                                    ->first();
                     $doctor_name=$doctor_name->doctor_name;
                   
                    $mailContent = compact('case_number','msg');

                    $mailTemplate = 'EyeForm.FormEmail';

                Mail::to($request->patient_emailId)->send(new casePaperMail(compact('case_number','msg','patient_address','patient_mobile','doctor_name'), $mailTemplate));
                return redirect()->back()->with('flash_message', 'Email has been sent to '. $request->patient_emailId);
               // return view('EyeForm.FormEmail',compact('case_number','msg','patient_address','patient_mobile','doctor_name'));

            }

            if(!is_null($request->appointment_Id) && !empty($request->appointment_Id) && $request->appointment_Id > 0){
            $appointment = appointment::findOrFail($request->appointment_Id);
            $appointment->isAccepted = 1;
            $appointment->save();
        }

        //Add doctor consultaion fee.
        if(!empty($request->doctor_fee) && !empty($request->doctor_id) && !empty($case_master)){
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

            return redirect()->back();
        }
           
/////////////////////////////////////////////


        public function submitKyc(Request $request, case_number_generators $case_gen)
    {
         //DB::enableQueryLog();
        $isEdit = true;
        $case_master = null;
        $case_master = Case_master::where('case_number', $case_gen->case_number)->where('is_deleted', '0')->whereDate('created_at', Carbon::today()->toDateString())->first();
        //var_dump(DB::getQueryLog());
        if ($case_master === null) {
            $case_master = new Case_master;
            $isEdit = false;
        }
        $case_master->id = $case_master->id?:0;
        $case_master->patient_name = $request->patient_name;
        $case_master->patient_age = $request->patient_age;
        $case_master->patient_address = $request->patient_address;
        $case_master->patient_emailId = $request->patient_emailId;
        $case_master->patient_mobile = $request->patient_mobile;
        $case_master->male_female = $request->male_female;
        $case_master->patient_weight = $request->patient_weight;
        $case_master->patient_height = $request->patient_height;
        $case_master->blood_pressure = $request->blood_pressure;
        //$case_master->referedby = $request->referedby;
        //$case_master->complaint = $request->complaint;
        //$case_master->diagnosis = $request->diagnosis;
        $case_master->case_number = $case_gen->case_number;
        $case_master->visit_time = $request->visit_time;
        $case_master->uhid_no = $request->uhid_no;
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
        $case_master->save();
        return $case_master;
    }
    
    public function saveFundusImages(Request $request) {
       
       
       if($request->hasfile('fundus_images'))
         {
            foreach($request->file('fundus_images') as $key => $file)
            {
                $name = time().$key.'.'.$file->extension();
                $file->move(public_path().'/fundus_images/', $name);  
                //$data[] = $name;  
            }
         }
         
         return redirect()->back()->with('flash_message', 'Record added successfully');
    }
    
    public function get_fundus_images() {
        $dir = public_path().'/fundus_images/';

		if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $a = scandir($dir);
        
       return $a;
       // echo "=====>>>>>>>>>> <pre>"; print_r($a); exit;
    }
    
    public function get_updated_fundus_images($case_id) {
        
        
        $dir = public_path().'/uploads/fundus_images/'.$case_id;
        $a = scandir($dir);
        //echo "=====>>>>111111111111>>>>>> <pre>"; print_r($a); exit;
       return $a;
       // echo "=====>>>>>>>>>> <pre>"; print_r($a); exit;
    }
    
    public function upload_fundus_image() {
        $image = imagecreatefrompng($_POST['image']);
        $id = uniqid();

        imagealphablending($image, false);
        imagesavealpha($image, true);
        
        if (!file_exists('uploads/fundus_images/')) {
            mkdir('uploads/fundus_images/', 0777, true);
        }
        
        if (!file_exists('uploads/fundus_images/'.$_POST['case_id'])) {
            mkdir('uploads/fundus_images/'.$_POST['case_id'], 0777, true);
        }

        imagepng($image, 'uploads/fundus_images/'.$_POST['case_id'].'/' . $id . '.png');

        $insert_data = array(
            'case_id' => $_POST['case_id'],
            'name'      => $_POST['fundus_image_name'],
            'eye'      => $_POST['fundus_image_eye'],
            'description'      => $_POST['fundus_image_description'],
            'image'      => $id . '.png'
        );
        DB::table('fundus_images')->insert($insert_data);
        // return image path
        echo '{"img": "uploads/fundus_images/'.$_POST['case_id'].'/' . $id . '.png"}';
    }
    
    
    public function remove_fundus_image() {
        if($_POST['main_image'] == 0) {
            $image_id = $_POST['image_id'];
            DB::table('fundus_images')->where('id', $image_id)->delete();
        } else if($_POST['main_image'] == 1) {
            $image_id = $_POST['image_id'];
            $dir = public_path().'/fundus_images/';
            unlink($dir.$image_id);
        }
        
        echo true;
    }
    
    
    
    public function updateFindingTemplate(Request $request, $case_id = "") {
        //echo "===========>>>>>>>> <pre>"; print_r($_POST); exit;
        $template_id = DB::table('finding_template')->insertGetId(['name' => $request->template_name]);
  
        foreach($request->Lids_OD as $key => $val) {
            $os = $request->Lids_OS[$key];
            $key_text = "Lids";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->OrbitSacsEyeMotility_OD as $key => $val) {
            $os = $request->OrbitSacsEyeMotility_OS[$key];
            $key_text = "OrbitSacsEyeMotility";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->ConjAndLids_OD as $key => $val) {
            $os = $request->ConjAndLids_OS[$key];
            $key_text = "ConjAndLids";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->cornia_od as $key => $val) {
            $os = $request->cornia_os[$key];
            $key_text = "cornia";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->AC_OD as $key => $val) {
            $os = $request->AC_OS[$key];
            $key_text = "AC";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->IRIS_OD as $key => $val) {
            $os = $request->IRIS_OS[$key];
            $key_text = "IRIS";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->pupilIrisac_OD as $key => $val) {
            $os = $request->pupilIrisac_OS[$key];
            $key_text = "pupilIrisac";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->lens_od as $key => $val) {
            $os = $request->lens_os[$key];
            $key_text = "lens";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->vitreoretinal_OD as $key => $val) {
            $os = $request->vitreoretinal_OS[$key];
            $key_text = "vitreoretinal";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->Retina_OD as $key => $val) {
            $os = $request->Retina_OS[$key];
            $key_text = "Retina";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                    'duration_od' => $request->retina_eye_OD[$key],
                    'duration_os' => $request->retina_eye_OS[$key]
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->ONH_OD as $key => $val) {
            $os = $request->ONH_OS[$key];
            $key_text = "ONH";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->Macula_OD as $key => $val) {
            $os = $request->Macula_OS[$key];
            $key_text = "Macula";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->sac_OD as $key => $val) {
            $os = $request->sac_OS[$key];
            $key_text = "sac";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        return redirect()->back()->with('flash_message', 'Template added Successully.');
    }
    
    public function addFindingTemplate($case_id = "") {
        $user = Auth::user()->id;
        
        /*
        $template_data_result = DB::table('finding_template_data')->where('template_id', 1)->get();
        
        foreach($template_data_result as $template_data_result_row) {
            $template_data[$template_data_result_row->key_text][] = $template_data_result_row;
        }
        */
        $case_data = null;
//dd($template_data);
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        $form_details = new eyeform();
        return view('EyeForm.finding_templates.add_finding_templates', ['form_dropdowns' => $form_dropdowns, 'form_details' => $form_details, 'case_id' => $case_id, 'casedata' => null, 'defaultValues' => []]);
    }
    
    public function editFindingTemplate($case_id = "") {
        $user = Auth::user()->id;
        
        /*
        $template_data_result = DB::table('finding_template_data')->where('template_id', 1)->get();
        
        foreach($template_data_result as $template_data_result_row) {
            $template_data[$template_data_result_row->key_text][] = $template_data_result_row;
        }
        */
        $case_data = null;
//dd($template_data);
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        $form_details = new eyeform();
        return view('EyeForm.finding_templates.add_finding_templates', ['form_dropdowns' => $form_dropdowns, 'form_details' => $form_details, 'case_id' => $case_id, 'casedata' => null, 'defaultValues' => []]);
    }
    
    public function getFindingTemplateHtml(Request $request, $case_id = "") {
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        $form_details = new eyeform();
        $template_data_result = DB::table('finding_template_data')->where('template_id', $request->id)->get();
        //return view('EyeForm.finding_templates.add_finding_templates', ['form_dropdowns' => $form_dropdowns, 'form_details' => $form_details, 'case_id' => $case_id]);
        
        //dd($template_data_result);
        foreach($template_data_result as $template_data_result_row) {
            $template_data[$template_data_result_row->key_text][] = $template_data_result_row;
        }
        
//$data = ['form_dropdowns' => $form_dropdowns, 'form_details' => $form_details, 'case_id' => $case_id, 'template_data' => $template_data];
        
        $data = ['case_id' => $case_id, 'template_data' => $template_data, 'form_dropdowns' => $form_dropdowns, 'form_details' => $form_details, 'casedata' => null, 'defaultValues' => []];
         
        return Response::json(['one' => View::make('EyeForm.finding_templates.get_finding_templates_one')->with($data)->render(),
             'two' => View::make('EyeForm.finding_templates.get_finding_templates_two')->with($data)->render(),
             'three' => View::make('EyeForm.finding_templates.get_finding_templates_three')->with($data)->render()]);
    }
    
    //Procedure Template functionality
    
    public function addCustomTemplate($case_id = "", $template_type = "") {
        $user = Auth::user()->id;
        
        $case_data = null;
//dd($template_data);
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        $form_details = new eyeform();
        
        
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
        
        return view('cataract.procedure_templates.add_procedure_template', ['form_dropdowns' => $form_dropdowns, 'form_details' => $form_details, 'case_id' => $case_id, 'casedata' => null, 'defaultValues' => [], 'checkbox_array' => $checkbox_array, 'procedure_array' => $procedure_array, 'procedure_array2' => $procedure_array2, 'procedure_array3' => $procedure_array3]);
    }
    
    public function getCustomTemplateHtml(Request $request, $case_id = "") {
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        $form_details = new eyeform();
        $template_data_result = DB::table('procedure_template_data')->where('template_id', $request->id)->get();
        //return view('EyeForm.finding_templates.add_finding_templates', ['form_dropdowns' => $form_dropdowns, 'form_details' => $form_details, 'case_id' => $case_id]);
        
        //dd($template_data_result);
        foreach($template_data_result as $template_data_result_row) {
            $template_data[$template_data_result_row->key_text][] = $template_data_result_row;
        }
        
        //dd($template_data);
        
//$data = ['form_dropdowns' => $form_dropdowns, 'form_details' => $form_details, 'case_id' => $case_id, 'template_data' => $template_data];
        
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
        
        $data = ['case_id' => $case_id, 'template_data' => $template_data, 'form_dropdowns' => $form_dropdowns, 'form_details' => $form_details, 'casedata' => null, 'defaultValues' => [], 'checkbox_array' => $checkbox_array, 'procedure_array' => $procedure_array, 'procedure_array2' => $procedure_array2, 'procedure_array3' => $procedure_array3];
        
        
         
        return Response::json(['one' => View::make('cataract.procedure_templates.get_procedure_template')->with($data)->render()]);
    }
    
    
    public function updateCustomTemplate(Request $request, $case_id = "") {
        //echo "===========>>>>>>>> <pre>"; print_r($_POST); exit;
        $template_id = DB::table('procedure_template')->insertGetId(['name' => $request->template_name]);
  
        foreach($request->section_OD as $key => $val) {
            $os = $request->section_OS[$key];
            $key_text = "section";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        foreach($request->site_OD as $key => $val) {
            $os = $request->site_OS[$key];
            $key_text = "site";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        foreach($request->size_of_wound_OD as $key => $val) {
            $os = $request->size_of_wound_OS[$key];
            $key_text = "size_of_wound";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        foreach($request->side_ports_OD as $key => $val) {
            $os = $request->side_ports_OS[$key];
            $key_text = "side_ports";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        foreach($request->acm_OD as $key => $val) {
            $os = $request->acm_OS[$key];
            $key_text = "acm";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        foreach($request->ccc_OD as $key => $val) {
            $os = $request->ccc_OS[$key];
            $key_text = "ccc";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        foreach($request->intra_cameral_OD as $key => $val) {
            $os = $request->intra_cameral_OS[$key];
            $key_text = "intra_cameral";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        foreach($request->hydrodissect_OD as $key => $val) {
            $os = $request->hydrodissect_OS[$key];
            $key_text = "hydrodissect";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        foreach($request->hyrodelamination_OD as $key => $val) {
            $os = $request->hyrodelamination_OS[$key];
            $key_text = "hyrodelamination";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        foreach($request->phacoemulisification_OD as $key => $val) {
            $os = $request->phacoemulisification_OS[$key];
            $key_text = "phacoemulisification";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        foreach($request->sics_OD as $key => $val) {
            $os = $request->sics_OS[$key];
            $key_text = "sics";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        
        if($request->procedure_checkboxes) {
            $os = "";
            $val = implode(',', $request->procedure_checkboxes);
            $key_text = "procedure_checkboxes";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        foreach($request->iol_OD as $key => $val) {
            $os = "";
            $key_text = "iol";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        foreach($request->iol_type_OD as $key => $val) {
            $os = "";
            $key_text = "iol_type";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        foreach($request->stromal_hydration_OD as $key => $val) {
            $os = "";
            $key_text = "stromal_hydration";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        if($request->sutures) {
            $os = "";
            $val = $request->sutures;
            $key_text = "sutures";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        if($request->sc_injection) {
            $os = "";
            $val = $request->sc_injection;
            $key_text = "sc_injection";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        if($request->eye_patch) {
            $os = "";
            $val = $request->eye_patch;
            $key_text = "eye_patch";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        foreach($request->intra_operative_event_OD as $key => $val) {
            $os = $request->intra_operative_event_OS[$key];
            $key_text = "intra_operative_event";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        
        if($request->anaesthetist_notes) {
            $os = "";
            $val = $request->anaesthetist_notes;
            $key_text = "anaesthetist_notes";
            $this->insert_custom_template_data($template_id, $key_text, $val, $os);
        }
        
        return redirect()->back()->with('flash_message', 'Template added Successully.');
    }
    
    function insert_custom_template_data($template_id, $key_text, $val, $os) {
        if($val != "") {
            $insert_data = array(
                'template_id' => $template_id,
                'key_text' => $key_text,
                'od' => $val,
                'os' => $os,
            );
            DB::table('procedure_template_data')->insert($insert_data);
        }
        
        //echo "============ : ".__LINE__; exit;
    }
    
    //Procedure Template functionality
    
    public function addIpdbillItemTemplate($case_id = "", $template_type = "") {
        $user = Auth::user()->id;
        
        $case_data = null;
//dd($template_data);
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        $form_details = new eyeform();
        
        
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
        
        return view('insurance_bill.templates.add_template', ['form_dropdowns' => $form_dropdowns, 'form_details' => $form_details, 'case_id' => $case_id, 'casedata' => null, 'defaultValues' => [], 'checkbox_array' => $checkbox_array, 'procedure_array' => $procedure_array, 'procedure_array2' => $procedure_array2, 'procedure_array3' => $procedure_array3]);
    }
    
    public function updateIpdbillItemTemplate(Request $request, $case_id = "") {
        //echo "===========>>>>>>>> <pre>"; print_r($_POST); exit;
        $template_id = DB::table('ipdbill_item_template')->insertGetId(['name' => $request->template_name]);
  
        foreach($request->bill_item as $key => $key_text) {
            $this->insert_ipdbill_item_template_data($template_id, $key_text, $request->bill_Amount[$key]);
        }
        
        return redirect()->back()->with('flash_message', 'Template added Successully.');
    }
    
    function insert_ipdbill_item_template_data($template_id, $key_text, $val) {
        if($val != "") {
            $insert_data = array(
                'template_id' => $template_id,
                'label' => $key_text,
                'value' => $val
            );
            DB::table('ipdbill_item_template_data')->insert($insert_data);
        }
    }
    
    public function getIpdbillItemTemplateHtml(Request $request, $case_id = "") {
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        $form_details = new eyeform();
        
        $template_data_result = DB::table('ipdbill_item_template_data')->where('template_id', $request->id)->get();
        //return view('EyeForm.finding_templates.add_finding_templates', ['form_dropdowns' => $form_dropdowns, 'form_details' => $form_details, 'case_id' => $case_id]);
        
        //dd($template_data_result);
        foreach($template_data_result as $template_data_result_row) {
            $template_data[$template_data_result_row->label] = $template_data_result_row->value;
        }
        
        //dd($template_data);
        
//$data = ['form_dropdowns' => $form_dropdowns, 'form_details' => $form_details, 'case_id' => $case_id, 'template_data' => $template_data];
        
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
        
        $data = ['case_id' => $case_id, 'template_data' => $template_data, 'form_dropdowns' => $form_dropdowns, 'form_details' => $form_details, 'casedata' => null, 'defaultValues' => [], 'checkbox_array' => $checkbox_array, 'procedure_array' => $procedure_array, 'procedure_array2' => $procedure_array2, 'procedure_array3' => $procedure_array3];
        
        return Response::json(['one' => View::make('insurance_bill.templates.get_template')->with($data)->render()]);
    }
    
    
    
     public function PrintFixSurgery($case_id) {
         /*
        $form_details = eyeform::where('case_id', $case_id)->first();
        
        dd($form_details);
        
        if ($form_details === null) {
            $form_details = new eyeform();
        }
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();
        $case_master  = Case_master::findOrFail($case_id);
        $glass_prescription = $case_master ->glass_prescription()->first();
        if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
            $glass_prescription = new glass_prescription();
        }
        
        $eyform_refraction_retina_scopy_details = DB::table('eyform_refraction_retina_scopy')->where('eyeformid', $form_details->id)->first();
        
        $eyform_vision_pgp_details = DB::table('eyform_vision_pgp')->where('eyeformid', $form_details->id)->first();
        
        $form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'uveiitis_bloodtests')->pluck('value')->toArray();

        $form_details->pre_operative_bloodtests_data = $pre_operative_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'pre_operative_bloodtests')->pluck('value')->toArray();

        $bloodtests_data =  DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->get()->toArray();

        //echo "<pre> ================= ";print_r($bloodtests_data);exit;
		
        foreach ($bloodtests_data as $key => $value) {
            $newBloodtestdata[$value->test_type][] = $value;
        }
        //echo "<pre> ================= ";print_r($newBloodtestdata);exit;
        $form_details->newBloodtestdata = isset($newBloodtestdata) ? $newBloodtestdata : [];

        $form_details->patients_systemic_history = DB::table('patients_systemic_history')->where('case_id',$case_id)->get()->toArray();

        //dd($casedata);

        $multiple_entries_data = DB::table('eyeformmultipleentry')->where('eyeformid', $form_details->id)->get()->toArray();
        
		$form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->orderby('test_type')->get()->toArray();

        $multiple_entries_data_arr = [];
        foreach($multiple_entries_data as $multiple_entries_data_row) {
            $multiple_entries_data_arr[$multiple_entries_data_row->field_name]['field_value_OD'] = $multiple_entries_data_row->field_value_OD;
            $multiple_entries_data_arr[$multiple_entries_data_row->field_name]['field_value_OS'] = $multiple_entries_data_row->field_value_OS;
        }
        
        //dd($casedata);

        return view('EyeForm.PrintFixSurgery', compact('case_master','casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription', 'eyform_refraction_retina_scopy_details', 'eyform_vision_pgp_details', 'multiple_entries_data_arr'));
          
          */
         
         $case_master_data  = Case_master::findOrFail($case_id);
        
        //dd($case_master);
        
        $doc1 =  DB::select("SELECT * from doctors");
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
         $doctorFormView = doctor_form_mapping::pluck('displayText', 'formViewName');
		$selectdoc       = Case_master::where('id',$case_id)->pluck('doctor_id');
		$doctorID = DB::table('case_master')
             ->select('doctor_id')
             ->where('id','=', $case_id)
             ->first();
        $DID=$doctorID->doctor_id;
          
        $form_details = eyeform::where('case_id', $case_id)->first();
        
        //dd($form_details);
        $blood_categories =  blood_investigation_titles::all();

        $allCats = DB::table('blood_investigation_titles')
            ->Join('eye_blood_investigation', 'blood_investigation_titles.id', '=', 'eye_blood_investigation.blood_title_id')
            ->get()->toArray();
		//dd($allCats);
       // echo "<pre> ================= ";print_r($allCats);

        foreach($allCats as $CatData) {
            $categories[$CatData->blood_title][] = $CatData->blood_value;
        }

        //echo "<pre> ==========******= ";print_r($categories);exit;

        if ($form_details === null) {
            $form_details = new eyeform();
        } 
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        $report_image = report_image::where('case_id', $case_id)->get();
        $reportScan_image = report_image::where('case_id', $case_id)->Where('reportFileName', 'EyeFormScanImage')->get()->toArray();
        $sp_test_image = report_image::where('case_id', $case_id)->Where('reportFileName', 'EyeFormSpTestImage')->get()->toArray();

        //echo "<pre> ==========******= ";print_r($sp_test_image);exit;


        // if (empty($report_image) || $report_image === null) {
        //     $form_details = new report_image();
        // }
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        $defaultValues = [];
        foreach($form_details->toArray() as $key => $form_details_row) {
           $defaultValues[$key] = $form_details_row;
        }
        
        if ($form_details != null) {
            $eyform_refraction_retina_scopy_details = eyform_refraction_retina_scopy::where('eyeformid', $form_details->id)->first();
            
            if($eyform_refraction_retina_scopy_details) {
                foreach($eyform_refraction_retina_scopy_details->toArray() as $key => $val) {
                    if($key != "created_at" && $key != "updated_at") {
                        $form_details->{$key} = $val;
                    }
                }
            }


            
            $eyform_vision_pgp_details = eyform_vision_pgp::where('eyeformid', $form_details->id)->first();
            
            if($eyform_vision_pgp_details) {
                foreach($eyform_vision_pgp_details->toArray() as $key => $val) {
                    if($key != "created_at" && $key != "updated_at") {
                        $form_details->{$key} = $val;
                    }
                }
            }
        }
		
		$case_master  = Case_master::findOrFail($case_id);
		$glass_prescription = $case_master ->glass_prescription()->first();
		if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
			$glass_prescription = new glass_prescription();
		}
//$glass_prescription = new glass_prescription();
		//dd($glass_prescription);

		$form_dropdowns_array = $this->get_form_dropdowns_array();
		$dropdown_options_table_name = 'form_dropdowns';
        
         //echo "====>>> <pre>"; print_r($reportScan_image); exit;
        
        //echo "======>>>>> <pre>"; print_r($defaultValues); exit;

		//echo "======>>>>> <pre>"; print_r($defaultValues); exit;
		
		//$form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'uveiitis_bloodtests')->pluck('value')->toArray();

        //$form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->pluck('value')->toArray();
		
		$form_details->uveiitis_bloodtests_data = $uveiitis_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->select(DB::Raw('CONCAT(test_type, "_",value) as value'))->pluck('value')->toArray();

		//echo "=========== <pre>";print_r($form_details->uveiitis_bloodtests_data);exit;

		$form_details->pre_operative_bloodtests_data = $pre_operative_bloodtests_data = DB::table('blood_investigations')->where('case_id',$case_id)->where('form_type','eyeform')->where('test_type', 'pre_operative_bloodtests')->pluck('value')->toArray();

		$form_details->patients_systemic_history = DB::table('patients_systemic_history')->where('case_id',$case_id)->get()->toArray();
        $treatmentAdvice = DB::table('eyeformmultipleentry')->where('field_name','treatmentAdvice')->get()->toArray();

//echo "=========== <pre>";print_r($form_dropdowns->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray());exit;
      $fundus_main_images = $this->get_fundus_images();
      //$updated_fundus_images = $this->get_updated_fundus_images($case_id);
      
      $updated_fundus_images = DB::table('fundus_images')->where('case_id', $case_id)->get();
      
     //dd($updated_fundus_images);
      
      $refraction_dropdowns = DB::table('refraction_dropdown')->get();
      // $refraction_dropdowns_arr = $refraction_dropdowns->where('key_value', 'sph')->pluck('os','od')->toArray();
      $refraction_dropdowns_arr['sph'] = [];
      $refraction_dropdowns_arr['cyl'] = [];
      $refraction_dropdowns_arr['vision'] = [];
      foreach($refraction_dropdowns as $refraction_dropdowns_row) {
           $refraction_dropdowns_arr[$refraction_dropdowns_row->key_value][$refraction_dropdowns_row->id] = $refraction_dropdowns_row->os; 
      }
      
      $finding_templates = DB::table('finding_template')->where('status', '1')->get();
      //dd($refraction_dropdowns_arr);
      
      $patient_activity = DB::table('patient_activity')->where(['case_id' => $case_id, 'activity_type' => 'ophthalmetry'])->first();
      
      $doctor_activity = DB::table('patient_activity')->where(['case_id' => $case_id, 'activity_type' => 'patient_doctor_state'])->first();
      
      $procedure_activity = DB::table('patient_activity')->where(['case_id' => $case_id, 'activity_type' => 'doctor_procedure'])->first();
      
      
      $consultant_activity = DB::table('patient_activity')->where(['case_id' => $case_id, 'activity_type' => 'consultant_activity'])->first();
      //dd($patient_activity);
      
      $payment_modes_array = [];
			$payment_modes = PaymentModes::all();
		
			foreach($payment_modes as $payment_modes_row) {
				$payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
			}
                        
                        //dd($payment_modes_array);
                        
                        $commonHelper = $this->commonHelper;
                        
                         $helperCls = new drAppHelper();
       
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();
                        
        return view('EyeForm.PrintFixSurgery', compact('case_master_data','casedata','form_details','selectdoc', 'form_dropdowns', 'report_image', 'defaultValues','doctorlist','DID', 'form_dropdowns_array', 'dropdown_options_table_name', 'glass_prescription', 'blood_categories', 'categories', 'treatmentAdvice','reportScan_image', 'fundus_main_images', 'updated_fundus_images', 'sp_test_image', 'refraction_dropdowns_arr', 'finding_templates', 'patient_activity', 'doctor_activity', 'procedure_activity','consultant_activity', 'payment_modes_array', 'payment_modes', 'commonHelper','logoUrl', 'FooterUrl'));
    }
}