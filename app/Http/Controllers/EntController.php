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

use App\Case_master;
use App\doctor;
use App\helperClass\drAppHelper;
use App\Models\form_dropdowns;
use App\Models\ent_form_dropdowns;
use App\Models\form_field_master;
use App\Models\skin;
use App\Models\blnc_test;
use App\Models\skinmultiple;
use App\entreport_images;
use App\doctor_form_mapping;
use DB;
use Storage;
use App\glass_prescription;
use File;
use Auth;
use App\timeslot;
use App\entmedical_store;
use App\Medical_store;
use App\field_type_data;
use App\field_type_memory;
use App\case_number_generators;
use App\ent_prescription_lists;
use Illuminate\Support\Facades\Mail;
use App\Mail\casePaperMail;
use App\entform;
use App\Models\entformmultipleentry;
use App\Mail\EntformMail;
use PDF;
use App\helperClass\CommonHelper;

class EntController extends AdminRootController
{
    
    public function __construct()
    {
        $this->acc=0;
        $this->commonHelper = new CommonHelper();
    }

    public function index(Request $request ,$case_id)
    {

         $doc1 =  DB::select("SELECT * from doctors");

        $selectdoc= Case_master::where('id', $case_id)->pluck('doctor_id');
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
         $doctorFormView = doctor_form_mapping::pluck('displayText', 'formViewName');
          
        $form_details = entform::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new entform();
        }
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        $report_image = entreport_images::where('case_id', $case_id)->get();
        // if (empty($report_image) || $report_image === null) {
        //     $form_details = new report_image();
        // }
        $form_dropdowns = ent_form_dropdowns::where('formName', 'ENT')->get();
        $defaultValues = [];
        $blnc_test = blnc_test::where('case_id', $case_id)->get();
      
        return view('ent.index', compact('casedata','form_details', 'form_dropdowns', 'report_image', 'defaultValues','doctorlist','selectdoc','blnc_test'));
    
    }


    public function ViewEntDetails($case_id){
        $form_details = entform::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new entform();
        }
        $helperCls = new drAppHelper();
        $casedata = $this->getCaseData($case_id);
        $blnc_test = blnc_test::where('case_id', $case_id)->get();
        
        return view('ent.entformview', compact('casedata','form_details','blnc_test'));
    }
    public function PrintEntDetails($case_id){
        $form_details = entform::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new entform();
        }
        $helperCls = new drAppHelper();
        $casedata = $this->getCaseData($case_id);
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();
        $case_master  = Case_master::findOrFail($case_id);
        $glass_prescription = $case_master ->glass_prescription()->first();
        if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
            $glass_prescription = new glass_prescription();
        }
         $blnc_test = blnc_test::where('case_id', $case_id)->get();
        return view('ent.EntFormPrint', compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription','blnc_test'));
    }

    public function printEntReportFiles($file_id){
        $report_image = entreport_images::findOrFail($file_id);
        return view('ent.PrintEneReportFile', compact('report_image'));
    }

   public function ViewEntReportFiles($case_id){
        $report_image = entreport_images::where('case_id', $case_id)->get();
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        return view('ent.ViewEntReportFile', compact('report_image', 'casedata'));
    }

// Using Submit Button


    public function SaveEnt(Request $request)
    {
        if (Input::get('submit_reportImage')) {
            if ($request->hasFile('reportImage')) {
                $entreport_images = new entreport_images();
                $entreport_images->reportFileName = 'EntFormImage';
                $entreport_images->case_id = $request->case_id;
                $entreport_images->filePath = $request->file('reportImage')->store('uploads');
                $entreport_images->save();

                $helperCls = new drAppHelper();
                $casedata = $helperCls->compress(storage_path('app/'.$entreport_images->filePath), storage_path('app/'.$entreport_images->filePath), 90);
            }
            return redirect()->back()->with('flash_message', 'Record added successfully');//->withInputs();
        }

        if (Input::get('delete_reportImage')) {

            $reportFile = entreport_images::findOrFail($request['delete_reportImage']);
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
        $form_details = entform::where('case_id', $request->case_id)->first();
        $case_master = Case_master::findOrFail($request->case_id);
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new entform();
            $isEdit = false;
        }
        $form_details->case_id=$request->input('case_id');
        $form_details->case_number=$request->input('case_number');
        $form_details->save();

         //Save file
        if (!empty($request->leftear)) {


            $img = filter_input(INPUT_POST, 'leftear', FILTER_SANITIZE_URL);
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/entform/'. $form_details->id .'_leftear.png');
            file_put_contents($storagePath, $data);
            $form_details->leftear = 'uploads/entform/'.$form_details->id .'_leftear.png';
            //Storage::Delete($form_details->OdImg1);
        }


        if (!empty($request->rightear)) {
           

            $img = filter_input(INPUT_POST, 'rightear', FILTER_SANITIZE_URL);
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/entform/'. $form_details->id .'_rightear.png');
            file_put_contents($storagePath, $data);
            $form_details->rightear = 'uploads/entform/'.$form_details->id .'_rightear.png';
            //Storage::Delete($form_details->OsImg1);
        }
        if (!empty($request->nose)) {

            $img = filter_input(INPUT_POST, 'nose', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/entform/'. $form_details->id .'_nose.png');
            file_put_contents($storagePath, $data);
            $form_details->nose = 'uploads/entform/'.$form_details->id .'_nose.png';;
            //Storage::Delete($form_details->OdImg2);
        }
        if (!empty($request->neck)) {

            $img = filter_input(INPUT_POST, 'neck', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/entform/'. $form_details->id .'_neck.png');
            file_put_contents($storagePath, $data);
            $form_details->neck = 'uploads/entform/'.$form_details->id .'_neck.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->throat)) {

            $img = filter_input(INPUT_POST, 'throat', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/entform/'. $form_details->id .'_throat.png');
            file_put_contents($storagePath, $data);
            $form_details->throat = 'uploads/entform/'.$form_details->id .'_throat.png';
            //Storage::Delete($form_details->OsImg2);
        }
    
       if (!empty($request->leftear) || !empty($request->rightear) || !empty($request->nose) || !empty($request->neck) || !empty($request->throat)){
            $form_details->save();
        }

        #region MultipleEntry
        $EfMultiEntryArray = array();
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'complaint', count($request->ent_complaint), $request->complaint);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'finding', count($request->ent_findings), $request->finding);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Diagnosis save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'diagnosis', count($request->ent_diagnosis), $request->diagnosis);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'treatment_advice', count($request->ent_treatment_advice), $request->treatment_advice);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'life_style_chenger', count($request->ent_life_style_chenger), $request->life_style_chenger);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'finding', count($request->ent_finding), $request->finding);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);


        $form_details->entformmultipleentry()->saveMany($EfMultiEntryArray);
        #endregion
         return redirect('Ent/'.$request->case_id)->with('flash_message', 'Data Inserted successfully');

        // return redirect('/case_masters')->with('flash_message', 'Record added successfully2');
    }

    // Using Submit & View

 public function SaveEntView(Request $request)
    {
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


        //$patient_details = patient_details();
        $isEdit = true;
        $form_details = entform::where('case_id', $request->case_id)->first();
        $case_master = Case_master::findOrFail($request->case_id);
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new entform();
            $isEdit = false;
        }
        $form_details->case_id=$request->input('case_id');
        $form_details->case_number=$request->input('case_number');
        $form_details->save();

         //Save file
        if (!empty($request->leftear)) {


            $img = filter_input(INPUT_POST, 'leftear', FILTER_SANITIZE_URL);
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/entform/'. $form_details->id .'_leftear.png');
            file_put_contents($storagePath, $data);
            $form_details->leftear = 'uploads/entform/'.$form_details->id .'_leftear.png';
            //Storage::Delete($form_details->OdImg1);
        }


        if (!empty($request->rightear)) {
           

            $img = filter_input(INPUT_POST, 'rightear', FILTER_SANITIZE_URL);
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/entform/'. $form_details->id .'_rightear.png');
            file_put_contents($storagePath, $data);
            $form_details->rightear = 'uploads/entform/'.$form_details->id .'_rightear.png';
            //Storage::Delete($form_details->OsImg1);
        }
        if (!empty($request->nose)) {

            $img = filter_input(INPUT_POST, 'nose', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/entform/'. $form_details->id .'_nose.png');
            file_put_contents($storagePath, $data);
            $form_details->nose = 'uploads/entform/'.$form_details->id .'_nose.png';;
            //Storage::Delete($form_details->OdImg2);
        }
        if (!empty($request->neck)) {

            $img = filter_input(INPUT_POST, 'neck', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/entform/'. $form_details->id .'_neck.png');
            file_put_contents($storagePath, $data);
            $form_details->neck = 'uploads/entform/'.$form_details->id .'_neck.png';
            //Storage::Delete($form_details->OsImg2);
        }
        if (!empty($request->throat)) {

            $img = filter_input(INPUT_POST, 'throat', FILTER_SANITIZE_URL);
            //see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
            $img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
            $data = base64_decode($img);
            $storagePath = storage_path('app/uploads/entform/'. $form_details->id .'_throat.png');
            file_put_contents($storagePath, $data);
            $form_details->throat = 'uploads/entform/'.$form_details->id .'_throat.png';
            //Storage::Delete($form_details->OsImg2);
        }
    
       if (!empty($request->leftear) || !empty($request->rightear) || !empty($request->nose) || !empty($request->neck) || !empty($request->throat)){
            $form_details->save();
        }

        #region MultipleEntry
        $EfMultiEntryArray = array();
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'complaint', count($request->ent_complaint), $request->complaint);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'finding', count($request->ent_findings), $request->finding);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Diagnosis save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'diagnosis', count($request->ent_diagnosis), $request->diagnosis);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'treatment_advice', count($request->ent_treatment_advice), $request->treatment_advice);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'life_style_chenger', count($request->ent_life_style_chenger), $request->life_style_chenger);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'finding', count($request->ent_finding), $request->finding);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);


        $form_details->entformmultipleentry()->saveMany($EfMultiEntryArray);
        #endregion
         return redirect('ViewEntDetails/'.$request->case_id)->with('flash_message', 'Data Inserted successfully');
    }

    // *************************************************************
public function deleteImage(Request $request){
        $entform = entform::where('case_id', $request->case_id)->first();
        if($request->imageName == "leftear"){
            Storage::Delete($entform->leftear);
            $entform->leftear = null;
            $entform->save();
        }
        if($request->imageName == "rightear"){
            Storage::Delete($entform->rightear);
            $entform->rightear = null;
            $entform->save();
        }
        if($request->imageName == "nose"){
            Storage::Delete($entform->nose);
            $entform->nose = null;
            $entform->save();
        }
        if($request->imageName == "neck"){
            Storage::Delete($entform->neck);
            $entform->neck = null;
            $entform->save();
        }
        if($request->imageName == "throat"){
            Storage::Delete($entform->throat);
            $entform->throat = null;
            $entform->save();
        }
       
        return "OK";
    }


  public function deleteMultiEntry(Request $request, $id) { 
        $eyeformmultipleentry = entformmultipleentry::findOrFail($id);
        $eyeformmultipleentry->delete();
        return "OK";
    }

 public  function GetMultipleEntryArray($formId, $fieldName, $arrayLength, array $fieldArray_OD = NULL){
        $multipleEntryArray = array();
        for ($i=0; $i < $arrayLength; $i++) {
            if((!empty($fieldArray_OD[$i]) && $fieldArray_OD[$i] != 'Select'))
            { 
                $multipleEntryArray[] = new entformmultipleentry([
                    'eyeformid' => $formId,
                    'field_name' => $fieldName,
                    'field_value_OD' => $fieldArray_OD[$i],
                ]);
            }
        }
        return $multipleEntryArray;
       ; 
    }

    public static function IsFieldEmpty($fieldValue){
        if (!empty($fieldValue) && !is_null($fieldValue) && (isset($fieldValue) && $fieldValue != 'Select')){
            return false;
        }
        return true;
    }

    // Medicine Prescription
    
     public function add_ent_prescription_templates($case_id = "") {
        $user = Auth::user()->id;

        $templates = DB::table('prescription_templates')->where('parent', 0)->get();

        //dd($templates);
        //$getdata = $this->getCaseData($id);
        $getdata = [];
        //echo "111111111111111111"; exit;
        /*
        $presDropdowns = [
'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText') 
        ];
         */
        
        $presDropdowns = [
            'numberOfTimes_drpdwn' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Times a day')->pluck('ddText','ddText'),
            'quantity'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Quantity')->pluck('ddText','ddText'),
            'medicine_strength'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Strength')->pluck('ddText','ddText'), 
'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText') 
        ];

        //dd($presDropdowns);
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')
        ->pluck('doctor_name', 'id');
        $timeslot = timeslot::where('isActive', 1)->orderBy('id')
        ->pluck('name', 'id');
        //$medicinlist = Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get();
        
        $medicinlist = entmedical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get();

        //dd($presDropdowns);
        $mergeArray = array_merge($getdata, $presDropdowns, ['doctorlist' => $doctorlist, 'timeslot' => $timeslot, 'medicinlist' => $medicinlist]);
        return view('ent.add_ent_prescription_templates', ['casedata' => $mergeArray, 'templates' => $templates, 'case_id' => $case_id]);
    }
    
    public function get_ent_prescription_template(Request $request) {
        $user = Auth::user()->id;
        
        $templates = DB::table('ent_prescription_templates')->where('id', $request->id)->orWhere('parent', $request->id)->get();
        
        $all_templates = DB::table('ent_prescription_templates')->where('parent', 0)->get();
       
         $presDropdowns = [
            'numberOfTimes_drpdwn' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Times a day')->pluck('ddText','ddText'),
            'quantity'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Quantity')->pluck('ddText','ddText'),
            'medicine_strength'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Strength')->pluck('ddText','ddText'), 
'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText') 
        ];
         
        //dd($presDropdowns);
         $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')
            ->pluck('doctor_name', 'id');
        $timeslot = timeslot::where('isActive', 1)->orderBy('id')
            ->pluck('name', 'id');
        //$medicinlist = Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc');
        $medicinlist = entmedical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get();
            //->get();
//dd($mergeArray);
        $mergeArray = array_merge($presDropdowns, ['doctorlist' => $doctorlist, 'timeslot' => $timeslot, 'medicinlist' => $medicinlist]);
        //dd($mergeArray);
            return view('ent.add_ent_prescription_templates_row', ['casedata' => $mergeArray, 'templates' => $templates, 'all_templates' => $all_templates, 'template_id' => $request->id]);    
    }


    public function getCaseData($id)
    {
        
        $case_master = Case_master::findOrFail($id);

        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
        $timeslot = timeslot::where('isActive', 1)->orderBy('id')->pluck('name', 'id');
        $medicinlist = entmedical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get();
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $field_type_memory = field_type_memory::get();
        $field_type_data = field_type_data::where('case_id', $case_master->id)->get();
        $casedata = [
                    'id'=>$case_master->id,
                    'doctorlist' => $doctorlist,
                    'timeslot' => $timeslot,
                    'medicinlist' => $medicinlist,
                    'prescriptions' =>  ent_prescription_lists::where('case_id', $case_master->id)->get(),
                    'DateWiseRecordLst' => $DateWiseRecordLst,
                    'case_number' => $case_master->case_number,//'p_00000001'
                    'uhid_no' => $case_master->uhid_no,//'p_00000001'
                    'patient_name' => $case_master->patient_name,
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
                    'appointment_dt' => ($case_master->FollowUpDate != null)? Carbon::createFromFormat('Y-m-d', $case_master->FollowUpDate)->format('d/M/Y'): null,
                    'appointment_timeslot' => $case_master->FollowUpTimeSlot,
                    'FollowUpDoctor_id' => $case_master->FollowUpDoctor_Id,
                    'Reports_file' => $case_master->Report_file()->get(),
                    'Before_file' => $case_master->BeforeImagePath,
                    'After_file' => $case_master->AfterImagePath,
                    'field_type_memory' => $field_type_memory,
                    'field_type_data' => $field_type_data,
                    'visit_time' => $case_master->visit_time
                    ];
            return $casedata;
    }


    public function updateent_prescription(Request $request)
    {
        $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
        if (is_null($case_gen)) {
            return redirect()->back()->withInput()->withErrors(array('message' => 'No patient found.'));
        }
        //check which submit was clicked on
		
		 if (Input::get('save_note')) {
            
						$note_record = DB::table('prescription_notes')->where('prescription_type', 'ent')->where('case_id', $request->id)->first();
						
						if($note_record) {
				DB::table('prescription_notes')->where('case_id', $request->id)->where('prescription_type', 'ent')->update(['notes' => $request->notes]);
							} else {
				DB::table('prescription_notes')->insert(['prescription_type' => 'ent', 'notes' => $request->notes, 'case_id' => $request->id]);
							}

				return redirect()->back()->with('flash_message', 'notes added successfully');
			}
		
        if (Input::get('prescription_save')) {
            $this->save_prescription($request, $case_gen); //if login then use this method
            return redirect()->back()->with('flash_message', 'Message Saved successfully');
        }
        if (Input::get('prescription_delete')) {
            $this->deletePrescription($request, $case_gen); //if register then use this method
            return redirect()->back()->with('flash_message', 'Message Deleted successfully');
        }
		//Send Prescription Summary Via Email
        if (Input::get('sendemailpres')) {
            return  $this->save_prescription_send($request, $case_gen); //if login then use this method
        }
        if (Input::get('submiitemailpres')) {
            $this->save_prescription_submit($request, $case_gen); //if login then use this method
            return redirect()->back()->with('flash_message', 'Message Saved successfully');
        }
        if (Input::get('prescription_msg')) {
            $preLst = ent_prescription_lists::where('case_id', $request['prescription_msg'])->get();
            if ($preLst->isEmpty()) {
                return redirect()->back()->withInput()->withErrors('Prescription list empty!');
            }
            $MedicalStoreNumber = Staff_user::where('staff_type_id', 4)->get();
            $caseMaster = Case_master::findOrFail($request['prescription_msg']);
            $MedicineLst = '';
            foreach ($preLst as $pre) {
                $MedicineLst = $MedicineLst .  $pre->entmedical_store->medicine_name . ' -- ' . $pre->strength . ' %0a ';
            }
            $MobileNoLst = rtrim(implode(',', $MedicalStoreNumber->pluck('mobile_no')->toArray()), ',');

            if (!empty($caseMaster->patient_mobile)) {
                $MobileNoLst = $MobileNoLst . ','.$caseMaster->patient_mobile;
            }

            $client = new HttpGuzzle;
            $smsStr = 'Prescription List for Patient '.(empty($request->patient_name)?"":$request->patient_name).' %0a case number :'. $request->case_number .' %0a '.  $MedicineLst. env('SMS_From_Name');
            $urlGet = str_replace(array('xxxxcommaSeperatedxxxx','xxxxSMSTextxxxx'), array($MobileNoLst, $smsStr), env('SMS_URL'));
            $res = $client->request('GET', $urlGet);


            return redirect()->back()->withInput()->with('flash_message', 'Message send successfully');
        }
    }
     public function edit_prescription($id)
    {

  $user = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='AddEdit/prescription'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("4_case_masters/prescriptionlstother",Auth::user()->id);
        if ($this->acc == 1) {
             $getdata = $this->getCaseData($id);
             //return $getdata;
        $presDropdowns = ['numberOfTimes_drpdwn' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Times a day')->pluck('ddText','ddText'),
                          'quantity'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Quantity')->pluck('ddText','ddText'),
                          'medicine_strength'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Strength')->pluck('ddText','ddText')
                         ];
        //return $presDropdowns;
        $mergeArray = array_merge($getdata, $presDropdowns);
        
        $templates = DB::table('ent_prescription_templates')->where('parent', 0)->get();
        
        //return $mergeArray;
			
			$prscription_notes_data = DB::table('prescription_notes')->where('prescription_type', 'ent')->where('case_id', $id)->first();

			$prscription_notes = ($prscription_notes_data) ? $prscription_notes_data->notes : '';
			
        return view('ent.medicine_prescription', ['casedata'=>$mergeArray, 'templates' => $templates, 'prscription_notes' => $prscription_notes]);
        }

         else
        {
          
         $url= url()->previous();
           return redirect($url);
        }


      
    }
	
// SAVE Prescription using Email To other

public function save_prescription_send(Request $request, case_number_generators $case_gen)
    {
         try {
              $request['case_number'] = $case_gen->case_number;
            $request['prescriptions'] =  ent_prescription_lists::where('case_id', $request->id)->get();
            $case_master = Case_master::where('case_number', $case_gen->case_number)->first();
             if($request->email && !empty($request->email)){
                   $this->validate($request, [
                    'email' => 'required|email'
                    
                ]);
                  
$getdata = $this->getCaseData($request->id);
      $presDropdowns = ['numberOfTimes_drpdwn' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Times a day')->pluck('ddText','ddText'),
                          'quantity'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Quantity')->pluck('ddText','ddText'),
                          'medicine_strength'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Strength')->pluck('ddText','ddText')
                         ];
        $msg=config('app.name', 'Laravel');
        $doctorlst = DB::table('doctors')->select('doctor_name')->where('id','=', $request->doctor_id)->first();
        $doctor_name= $doctorlst->doctor_name;
        $mergeArray = array_merge($getdata, $presDropdowns);
        //return $mergeArray['prescriptions'];
        $mailTemplate = 'ent.entFormEmailPrescription';
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();                  
                   if(count($mergeArray['prescriptions'])> 0 )
                   {
                   
                    

 Mail::to($request->email)->send(new casePaperMail(['casedata'=>$mergeArray,'msg'=>$msg,'doctor_name'=>$doctor_name], $mailTemplate));
                   }
                   else
                   {
                    $validator = Validator::make($request->all(), [
            'medicine_id' => 'required',
            //'medicine_quantity' => 'required|numeric',
            ]);
          

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }



            $medicalStore = entmedical_store::find($request['medicine_id']);
          
            $preslist = new ent_prescription_lists;
            $preslist->case_number = $case_gen->case_number;
            $preslist->medicine_id = $request['medicine_id'];
            $preslist->medicine_Quntity = empty($request['medicine_quantity'])?0:$request['medicine_quantity'];
            $preslist->numberoftimes = $request['numberoftimes'];
            $preslist->strength = $request['strength'];
            $preslist->per_unit_cost = $medicalStore->unit_price;
            $preslist->case_id = $request->id;
            $preslist->no_of_days = $request->no_of_days;
            $preslist->save();
         
             $getdata = $this->getCaseData($request->id);
       $presDropdowns = ['numberOfTimes_drpdwn' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Times a day')->pluck('ddText','ddText'),
                          'quantity'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Quantity')->pluck('ddText','ddText'),
                          'medicine_strength'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Strength')->pluck('ddText','ddText')
                         ];
        $msg=config('app.name', 'Laravel');
        $doctorlst = DB::table('doctors')->select('doctor_name')->where('id','=', $request->doctor_id)->first();
        $doctor_name= $doctorlst->doctor_name;
        $mergeArray = array_merge($getdata, $presDropdowns);
        //return $mergeArray['prescriptions'];
       $mailTemplate = 'ent.entFormEmailPrescription';
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
          //  return $mergeArray['prescriptions'];
         Mail::to($request->email)->send(new casePaperMail(['casedata'=>$mergeArray,'msg'=>$msg,'doctor_name'=>$doctor_name], $mailTemplate));
                   }

            $request['prescriptions'] =  ent_prescription_lists::where('case_id', $request->id)->get();
        }
        
   
            
        } catch (Execption $e) {
            //throw $e;
        }

        return redirect()->back()->with('flash_message', 'Email has been sent to '. $request->email);
        //return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
    }

    // SAVE Prescription using submit & Mail Button

public function save_prescription_submit(Request $request, case_number_generators $case_gen)
    {
          try {
            $request['case_number'] = $case_gen->case_number;
            $request['prescriptions'] =  ent_prescription_lists::where('case_id', $request->id)->get();
            $case_master = Case_master::where('case_number', $case_gen->case_number)->first();
    if($request->patient_emailId && !empty($request->patient_emailId)){
           $this->validate($request, [
            'patient_emailId' => 'required|email'
            
        ]);
     
         $validator = Validator::make($request->all(), [
            'medicine_id' => 'required',
            //'medicine_quantity' => 'required|numeric',
            ]);
          

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }


           $medicalStore = entmedical_store::find($request['medicine_id']);
          
            $preslist = new ent_prescription_lists;
            $preslist->case_number = $case_gen->case_number;
            $preslist->medicine_id = $request['medicine_id'];
            $preslist->medicine_Quntity = empty($request['medicine_quantity'])?0:$request['medicine_quantity'];
            $preslist->numberoftimes = $request['numberoftimes'];
            $preslist->strength = $request['strength'];
            $preslist->per_unit_cost = $medicalStore->unit_price;
            $preslist->case_id = $request->id;
            $preslist->no_of_days = $request->no_of_days;
            $preslist->save();
		   $getdata = $this->getCaseData($request->id);
       $presDropdowns = ['numberOfTimes_drpdwn' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Times a day')->pluck('ddText','ddText'),
                          'quantity'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Quantity')->pluck('ddText','ddText'),
                          'medicine_strength'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Strength')->pluck('ddText','ddText')
                         ];
        $msg=config('app.name', 'Laravel');
        $doctorlst = DB::table('doctors')->select('doctor_name')->where('id','=', $request->doctor_id)->first();
        $doctor_name= $doctorlst->doctor_name;
        $mergeArray = array_merge($getdata, $presDropdowns);
       $mailTemplate = 'ent.entFormEmailPrescription';  
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
         Mail::to($request->patient_emailId)->send(new casePaperMail(['casedata'=>$mergeArray,'msg'=>$msg,'doctor_name'=>$doctor_name], $mailTemplate));
                

            $request['prescriptions'] =  ent_prescription_lists::where('case_id', $request->id)->get();
        }
        
   
            
        } catch (Execption $e) {
            //throw $e;
        }

        return redirect()->back()->with('flash_message', 'Email has been sent to '. $request->patient_emailId);
        //return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
    }
	
	
	///////////////////////////////////////////////////

    public function save_prescription(Request $request, case_number_generators $case_gen)
    {
        try {
            $request['case_number'] = $case_gen->case_number;
            $request['prescriptions'] =  ent_prescription_lists::where('case_id', $request->id)->get();
            $case_master = Case_master::where('case_number', $case_gen->case_number)->first();
			
			//dd($request->all());
if($request['prescription_type'] == "new") {
    $validator = Validator::make($request->all(), [
    //'medicine_id' => 'required',
    //'medicine_quantity' => 'required|numeric',
    ]);

    if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
    }
    $medicalStore = entmedical_store::find($request['medicine_id']);

    $preslist = new ent_prescription_lists;
    $preslist->case_number = $case_gen->case_number;
    $preslist->medicine_id = $request['medicine_id'];
    $preslist->medicine_Quntity = empty($request['medicine_quantity'])?0:$request['medicine_quantity'];
    $preslist->numberoftimes = $request['numberoftimes'];
    $preslist->strength = $request['strength'];
    $preslist->per_unit_cost = $medicalStore->unit_price;
    $preslist->case_id = $request->id;
    $preslist->no_of_days = $request->no_of_days;
    $preslist->save();
    // \LogActivity::addToLog('Prescription saved successfully');
    $request['prescriptions'] =  ent_prescription_lists::where('case_id', $request->id)->get();
} else {
    
    /*
    
       "id" => "10420"
  "case_number" => "p_00005872"
  "doctor_id" => "95"
  "patient_emailId" => "sureshramskha@gmail.com"
  "patient_name" => "Sure"
  "prescription_type" => "template"
  "total_template_rows" => "2"
  "template_medicine_id" => array:2 [▶]
  "template_numberoftimes" => array:2 [▶]
  "template_medicine_quantity" => array:2 [▶]
  "template_strength" => array:2 [▶]
  "medicine_id" => null
  "numberoftimes" => null
  "medicine_quantity" => null
  "strength" => null
  "email" => null
  "prescription_save" => "Add Prescription"
     
     */
    foreach($request['template_medicine_id'] as $current_key => $current_val) {
        $medicalStore = entmedical_store::find($current_val);
        
        //dd($medicalStore);
        
        $preslist = new ent_prescription_lists;
        $preslist->case_number = $case_gen->case_number;
        $preslist->medicine_id = $current_val;
        $preslist->medicine_Quntity = empty($request['template_medicine_quantity'][$current_key])?0:$request['template_medicine_quantity'][$current_key];
        $preslist->numberoftimes = $request['template_numberoftimes'][$current_key];
        $preslist->strength = $request['template_strength'][$current_key];
        $preslist->per_unit_cost = $medicalStore->unit_price;
        $preslist->case_id = $request->id;
        $preslist->no_of_days = null;
        $preslist->save();
    }
}
		
        } catch (Execption $e) {
            //throw $e;
        }
        //dd($request);
    
        //return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
        //return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
    }



    public function deletePrescription(Request $request, case_number_generators $case_gen)
    {
        $prescription_list = ent_prescription_lists::find($request['prescription_delete']);
        if ($prescription_list === null) {
            return redirect()->back()->withInput()->withErrors(array('message' => 'No prescription found.'));
        }

        $prescription_list->delete();
         // \LogActivity::addToLog('Prescription deleted successfully');
        
        $request['prescriptions'] =  ent_prescription_lists::where('case_id', $request->id)->get();
        return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
    }

    public function printprescription($id)
    {
        //$image_gallery = Image_gallery::where('imgTypeId', 4)->first();

          $user = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='print/prescription'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
            $this->acc = $this->commonHelper->checkUserAccess("4_case_masters/prescriptionlstother",Auth::user()->id);
        if ($this->acc == 1) {
               $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
			
			$prscription_notes_data = DB::table('prescription_notes')->where('prescription_type', 'ent')->where('case_id', $id)->first();

		$prscription_notes = ($prscription_notes_data) ? $prscription_notes_data->notes : '';
			
			$casedata = $this->getCaseData($id);
        $doctor = DB::table('doctors')->where('id', $casedata['doctor_id'])->first();
        
        return view('ent.print_prescription', ['casedata'=> $casedata, 'logoUrl'=>$logoUrl, 'prscription_notes' => $prscription_notes, 'doctor' => $doctor]);
        }

         else
        {
          
         $url= url()->previous();
           return redirect($url);
        }

     
    }
    
    
////////////////////////email////////////////////////
 
        public function entSaveCaseHistoryotherpris(Request $request){
         $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
        if (is_null($case_gen)) {
            $case_gen = $this->createCaseNumber();
        }
        
         //$case_master = $this->save_prescription($request,$case_gen);
      
            if($request->email && !empty($request->email)){
                
                    $msg = 'Welcome To lotusmaternityhome Hospital.';
                    $case_number=$request->case_number;
                    $doctor_id=$request->doctor_id;
                    $email=$request->email;
                    //return $doctor_id;
                    $medicine_id=$request->medicine_id;
                    $numberoftimes=$request->numberoftimes;
                    $medicine_quantity=$request->medicine_quantity;
                    $strength=$request->strength;
                    
                    //return $strength;
                    $mailContent = compact('case_number','email','doctor_id','medicine_id','numberoftimes','medicine_quantity','strength','msg');


                     $doctor_name = DB::table('doctors')
                                    ->select('doctor_name')
                                    ->where('id','=', $doctor_id)
                                    ->first();
                     $doctor_name=$doctor_name->doctor_name;

                     $entmedical_store = DB::table('entmedical_store')
                                    ->select('medicine_name')
                                    ->where('id','=', $medicine_id)
                                    ->first();
                     $entmedical_store=$entmedical_store->medicine_name;

                     $mailTemplate = 'ent.entFormEmailPrescription';

                    //$doctor_name=DB::table('doctors')->where('id',$doctor_id)->pluck('doctor_name');
                    //return $doctor_name;
                    //$medicalStore=DB::table('medical_store')->where('id',$medicine_id)->pluck('medicine_name');
                    //$doctor_name= DB::select("SELECT doctor_name FROM `doctors` WHERE id='$doctor_id'");
                    
                     //return $medicalStore;

                Mail::to($request->email)->send(new casePaperMail(compact('case_number','email','doctor_name','entmedical_store','numberoftimes','medicine_quantity','strength','msg'), $mailTemplate));
               
                //return view('ent.entFormEmailPrescription',compact('case_number','email','doctor_name','entmedical_store','numberoftimes','medicine_quantity','strength','msg'));

            }
        
            //$medicalStore = Medical_store::find($request['medicine_id']);
           
           $medicalStore = entmedical_store::find($request['medicine_id']);
               $preslist = new ent_prescription_lists;
            $preslist->case_number = $case_gen->case_number;
            $preslist->medicine_id = $request['medicine_id'];
            $preslist->medicine_Quntity = empty($request['medicine_quantity'])?0:$request['medicine_quantity'];
            $preslist->numberoftimes = $request['numberoftimes'];
            $preslist->strength = $request['strength'];
            $preslist->per_unit_cost = $medicalStore->unit_price;
            $preslist->case_id = $request->id;
            $preslist->no_of_days = $request->no_of_days;
            $preslist->save();
             return redirect()->back()->with('flash_message', 'Email has been sent to '. $request->email);
        } 
       
/////////////////////////////////

        public function entSaveCaseHistoryotherpris1(Request $request){
         $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
        if (is_null($case_gen)) {
            $case_gen = $this->createCaseNumber();
        }
        
         //$case_master = $this->save_prescription($request,$case_gen);
      
            if($request->patient_emailId && !empty($request->patient_emailId)){
                
                    $msg = 'Welcome To lotusmaternityhome Hospital.';
                    $case_number=$request->case_number;
                    $doctor_id=$request->doctor_id;
                    $patient_emailId=$request->patient_emailId;
                    //return $doctor_id;
                    $medicine_id=$request->medicine_id;
                    $numberoftimes=$request->numberoftimes;
                    $medicine_quantity=$request->medicine_quantity;
                    $strength=$request->strength;
                    
                    //return $strength;
                    $mailContent = compact('case_number','doctor_id','medicine_id','numberoftimes','medicine_quantity','strength','msg');


                     $doctor_name = DB::table('doctors')
                                    ->select('doctor_name')
                                    ->where('id','=', $doctor_id)
                                    ->first();
                     $doctor_name=$doctor_name->doctor_name;

                     $entmedical_store = DB::table('entmedical_store')
                                    ->select('medicine_name')
                                    ->where('id','=', $medicine_id)
                                    ->first();
                     $entmedical_store=$entmedical_store->medicine_name;

                     $mailTemplate = 'ent.entFormEmailPrescription';

                    //$doctor_name=DB::table('doctors')->where('id',$doctor_id)->pluck('doctor_name');
                    //return $doctor_name;
                    //$medicalStore=DB::table('medical_store')->where('id',$medicine_id)->pluck('medicine_name');
                    //$doctor_name= DB::select("SELECT doctor_name FROM `doctors` WHERE id='$doctor_id'");
                    
                     //return $medicalStore;

                Mail::to($request->patient_emailId)->send(new casePaperMail(compact('case_number','patient_emailId','doctor_name','entmedical_store','numberoftimes','medicine_quantity','strength','msg'), $mailTemplate));
               
                //return view('ent.entFormEmailPrescription',compact('case_number','patient_emailId','doctor_name','entmedical_store','numberoftimes','medicine_quantity','strength','msg'));

            }
        
            //$medicalStore = Medical_store::find($request['medicine_id']);
           
         
         
            $medicalStore = entmedical_store::find($request['medicine_id']);
          
            $preslist = new ent_prescription_lists;
            $preslist->case_number = $case_gen->case_number;
            $preslist->medicine_id = $request['medicine_id'];
            $preslist->medicine_Quntity = empty($request['medicine_quantity'])?0:$request['medicine_quantity'];
            $preslist->numberoftimes = $request['numberoftimes'];
            $preslist->strength = $request['strength'];
            $preslist->per_unit_cost = $medicalStore->unit_price;
            $preslist->case_id = $request->id;
            $preslist->no_of_days = $request->no_of_days;
            $preslist->save();
       return redirect()->back()->with('flash_message', 'Email has been sent to '. $request->patient_emailId);
        } 
       
 //////////////////////////////////////////////////////////////
           public function Send_emailent(Request $request)
        {
            if(Input::get('Send_email')){
            if($request->Email_To && !empty($request->Email_To)){
                $this->validate($request, [
                    'Email_To' => 'required|email'
                    
                ]);
                $case_master = Case_master::findOrFail($request->case_id);
                //return $case_master;
                $pdfname="entFormEmail".$request->case_id.".pdf";
                $case_master->pdfname=$pdfname;
                $case_master->save();
                 $form_details = entform::where('case_id', $request->case_id)->first();
                if ($form_details === null) {
                    $form_details = new entform();
                }
                $helperCls = new drAppHelper();
                $casedata = $helperCls->getCaseData($request->case_id);
                $logoUrl = $helperCls->GetLetterHeadImageUrl();
                $FooterUrl = $helperCls->GetLetterFooterImageUrl();
                $case_master  = Case_master::findOrFail($request->case_id);
                $glass_prescription = $case_master ->glass_prescription()->first();
                if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
                    $glass_prescription = new glass_prescription();
                }

                 $isEdit = true;
        $form_details = entform::where('case_id', $request->case_id)->first();
        $case_master = Case_master::findOrFail($request->case_id);
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new entform();
            $isEdit = false;
        }
        
       

       $form_details->fill($request->all());
       
      
        #region MultipleEntry
        $EfMultiEntryArray = array();
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'complaint', count($request->ent_complaint), $request->complaint);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'finding', count($request->ent_findings), $request->finding);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Diagnosis save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'diagnosis', count($request->ent_diagnosis), $request->diagnosis);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'treatment_advice', count($request->ent_treatment_advice), $request->treatment_advice);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'life_style_chenger', count($request->ent_life_style_chenger), $request->life_style_chenger);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'finding', count($request->ent_finding), $request->finding);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);


        $form_details->entformmultipleentry()->saveMany($EfMultiEntryArray);
        $blnc_test = blnc_test::where('case_id', $request->case_id)->get();
        #endregion
        

       
                //return view('EyeForm.EyeFormPrint', );
                if(\File::exists(public_path('entpdf/'.$pdfname))){
                  \File::delete(public_path('entpdf/'.$pdfname));
                $pdf = PDF::loadView('ent.entpdfemail', compact('case_master','field_type_data', 'fieldtypeId','field_memory','casedata', 'logoUrl','form_details','blnc_test','FooterUrl','logoUrl','glass_prescription'));
                $path = public_path('entpdf/');
                $fileName = 'entFormEmail'.$request->case_id.'.pdf' ;
                $pdf->save($path . '/' . $fileName);
                }else{
                $pdf = PDF::loadView('ent.entpdfemail', compact('case_master','field_type_data', 'fieldtypeId','field_memory','casedata','logoUrl','form_details','blnc_test','FooterUrl','logoUrl','glass_prescription'));
                $path = public_path('entpdf/');
                $fileName = 'entFormEmail'.$request->case_id.'.pdf' ;
                $pdf->save($path . '/' . $fileName);
                }
                
                $mailContent = compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription','blnc_test');
                $mailTemplate = 'ent.entpdfemail';

              Mail::to($request->Email_To)->send(new EntformMail(compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription','blnc_test'), $mailTemplate));
                $form_details->save();
                return redirect()->back()->with('flash_message', 'Email has been sent to '. $request->Email_To);
 
            }
            //return redirect()->back();
        }
   

      if(Input::get('Submit_emailent')){
            if($request->patient_emailId && !empty($request->patient_emailId)){
                $this->validate($request, [
                    'patient_emailId' => 'required|email'
                    
                ]);
                $case_master = Case_master::findOrFail($request->case_id);
                //return $case_master;
                $pdfname="entFormEmail".$request->case_id.".pdf";
                $case_master->pdfname=$pdfname;
                $case_master->save();
                 $form_details = entform::where('case_id', $request->case_id)->first();
                if ($form_details === null) {
                    $form_details = new entform();
                }
                $helperCls = new drAppHelper();
                $casedata = $helperCls->getCaseData($request->case_id);
                $logoUrl = $helperCls->GetLetterHeadImageUrl();
                $FooterUrl = $helperCls->GetLetterFooterImageUrl();
                $case_master  = Case_master::findOrFail($request->case_id);
                $glass_prescription = $case_master ->glass_prescription()->first();
                if ($glass_prescription === null || is_null($glass_prescription) || empty($glass_prescription) || !isset($glass_prescription)) {
                    $glass_prescription = new glass_prescription();
                }

                 $isEdit = true;
        $form_details = entform::where('case_id', $request->case_id)->first();
        $case_master = Case_master::findOrFail($request->case_id);
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new entform();
            $isEdit = false;
        }
        
       

       $form_details->fill($request->all());
       
      
        #region MultipleEntry
        $EfMultiEntryArray = array();
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'complaint', count($request->ent_complaint), $request->complaint);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'finding', count($request->ent_findings), $request->finding);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Diagnosis save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'diagnosis', count($request->ent_diagnosis), $request->diagnosis);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'treatment_advice', count($request->ent_treatment_advice), $request->treatment_advice);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'life_style_chenger', count($request->ent_life_style_chenger), $request->life_style_chenger);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);

        #Finding save entry
        $multientryArry = array();
        $multientryArry = $this->GetMultipleEntryArray($form_details->id, 'finding', count($request->ent_finding), $request->finding);
        $EfMultiEntryArray = array_merge($EfMultiEntryArray, $multientryArry);


        $form_details->entformmultipleentry()->saveMany($EfMultiEntryArray);
        $blnc_test = blnc_test::where('case_id', $request->case_id)->get();
        #endregion
        

       
                //return view('EyeForm.EyeFormPrint', );
                if(\File::exists(public_path('entpdf/'.$pdfname))){
                  \File::delete(public_path('entpdf/'.$pdfname));
                $pdf = PDF::loadView('ent.entpdfemail', compact('case_master','field_type_data', 'fieldtypeId','field_memory','casedata', 'logoUrl','form_details','blnc_test','FooterUrl','logoUrl','glass_prescription'));
                $path = public_path('entpdf/');
                $fileName = 'entFormEmail'.$request->case_id.'.pdf' ;
                $pdf->save($path . '/' . $fileName);
                }else{
                $pdf = PDF::loadView('ent.entpdfemail', compact('case_master','field_type_data', 'fieldtypeId','field_memory','casedata','logoUrl','form_details','blnc_test','FooterUrl','logoUrl','glass_prescription'));
                $path = public_path('entpdf/');
                $fileName = 'entFormEmail'.$request->case_id.'.pdf' ;
                $pdf->save($path . '/' . $fileName);
                }
                
                $mailContent = compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription','blnc_test');
                $mailTemplate = 'ent.entpdfemail';

              Mail::to($request->patient_emailId)->send(new EntformMail(compact('casedata','form_details','logoUrl', 'FooterUrl', 'glass_prescription','blnc_test'), $mailTemplate));
                $form_details->save();
                return redirect()->back()->with('flash_message', 'Email has been sent to '. $request->patient_emailId);
 
            }
            //return redirect()->back();
        }
    }
       
}