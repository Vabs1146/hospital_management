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
use App\helperClass\drAppHelper;
use App\Models\form_dropdowns;
use App\Models\form_field_master;
use App\Models\skin;
use App\Models\skinmultiple;
use App\report_image;

use DB;
use Storage;
use File;
use Illuminate\Support\Facades\Mail;
use App\Mail\casePaperMail;
use App\Mail\SkinformMail;
use PDF;

class SkinController extends AdminRootController
{

    public function index(Request $request)
    {
        return view('EyeOperationRecord.index', []);
    }

    public function edit(Request $request, $id)
    {
        $case_master  = Case_master::findOrFail($id);
        $skin = $case_master->skin()->first();
        if ($skin === null || is_null($skin) || empty($skin) || !isset($skin)) {
            $skin = new skin();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        $form_dropdowns = form_dropdowns::where('formName', 'skinOpd')->get();
        $form_field_master = form_field_master::where('formName', 'skinOpd')->get()->pluck('form_field_code','fieldName');
        $db_skinmultiple = skinmultiple::where('case_id', $case_master->id)->whereIn('formfieldCode', array_values($form_field_master->toArray()))->get();
        $report_image = report_image::where('case_id', $case_master->id)->get();
        //return var_dump($db_skinmultiple);
        return view('skin.addUpdate', compact('case_master','skin', 'DateWiseRecordLst','doctorlist', 'form_dropdowns', 'form_field_master', 'db_skinmultiple', 'report_image'));
    }

    public function update(Request $request){

  
    
     if (Input::get('submit_reportImage')) {
            if ($request->hasFile('CasePaperUpload')) {
                $report_image = new report_image();
                $report_image->reportFileName = 'SkinFormCaseImage';
                $report_image->case_id = $request->case_id;
                $report_image->filePath = $request->file('CasePaperUpload')->store('uploads');
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

        $form_details = new skin();
        $form_details = $form_details->updateOrCreate(['case_id'=>$request->case_id], $request->all());
        
        
         $getdata=Case_master::where('id', $request->case_id)->first();
         $patient_name= $getdata->patient_name;
         $doctor_id = $request->FollowUpDoctor_id;
         $patient_mobile=$getdata->patient_mobile;
         $patient_emailId=$getdata->patient_emailId;
         $FollowUpDate = $request->FollowUpDate;
         $FollowUpTimeSlot = $request->FollowUpTime;

   $sql= DB::insert("INSERT INTO `appointments`(`doctor_id`, `name`, `mobile_no`, `email`, `appointment_dt`, `morningEvening`) VALUES ('$doctor_id','$patient_name','$patient_mobile','$patient_emailId','$FollowUpDate','$FollowUpTimeSlot')");
        
        $form_field_master = form_field_master::where('formName', 'skinOpd')->get()->pluck('form_field_code','fieldName');
        $db_skinmultiple = skinmultiple::where('case_id', $request->case_id)->whereIn('formfieldCode', array_values($form_field_master->toArray()))->get();

        $ValuesToInsert = array();
        foreach ($form_field_master as $MasterFieldName => $MasterFieldCode) {
            if(!is_array($request[$MasterFieldCode])){
                continue;
            }
            foreach ($request[$MasterFieldCode] as $RequestKey => $RequestValue) {
                //Create or Update skinMultiple
                if(!empty($RequestValue)){
                    $dbValue =  $db_skinmultiple->where('formfieldCode', $RequestKey)->where('valueData', $RequestValue);
                    if($dbValue->isEmpty()){
                        $newdbFieldVal = [
                            'case_id' => $request->case_id,
                            'formFieldName' => $MasterFieldName,
                            'formfieldCode' => $MasterFieldCode,
                            'valueData' => $RequestValue
                        ];
                        array_push($ValuesToInsert, $newdbFieldVal);
                    }
                }
            }
        }
        if (count($ValuesToInsert) > 0) {
            skinmultiple::insert($ValuesToInsert);
        }

        
        if ($request->hasFile('BeforeImage')) {
            $form_details->BeforeImagePath = "";
            if(isset($form_details->id) && !empty($form_details->id) && !empty($form_details->BeforeImagePath)){
                Storage::Delete($form_details->BeforeImagePath);    
            }
            $full_path = storage_path('app/uploads/skinImage/beforeImage_'.$request->case_id.'.'.$request->file('BeforeImage')->getClientOriginalExtension());
            file_put_contents($full_path, File::get($request->file('BeforeImage')));
            
            $form_details->BeforeImagePath = 'uploads/skinImage/beforeImage_'.$request->case_id.'.'.$request->file('BeforeImage')->getClientOriginalExtension();
            //$form_details->update(['upload_image'=>$request->file('upload_image')->store('uploads')]);
            $form_details->save();
        }
        if ($request->hasFile('AfterImage')) {
            $form_details->AfterImagePath = "";
            if(isset($form_details->id) && !empty($form_details->id) && !empty($form_details->AfterImagePath)){
                Storage::Delete($form_details->AfterImagePath); 
            }
            $full_path = storage_path('app/uploads/skinImage/AfterImage_'.$request->case_id.'.'.$request->file('AfterImage')->getClientOriginalExtension());
            file_put_contents($full_path, File::get($request->file('AfterImage')));
            
            $form_details->AfterImagePath = 'uploads/skinImage/AfterImage_'.$request->case_id.'.'.$request->file('AfterImage')->getClientOriginalExtension();
            //$form_details->update(['upload_image'=>$request->file('upload_image')->store('uploads')]);
            $form_details->save();
          

        }
        

         if(Input::get('Send_email')){
            if($request->Email_To && !empty($request->Email_To)){
				$this->validate($request, [
                    'Email_To' => 'required|email'
                    
                ]);
                $case_master  = Case_master::findOrFail($request->case_id);
                 $pdfname="skinFormEmail".$request->case_id.".pdf";
                $case_master->pdfname=$pdfname;
                $case_master->save();

                $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
                $helperCls = new drAppHelper();
                $logoUrl = $helperCls->GetLetterHeadImageUrl();
                $skin = $case_master->skin()->first();
                $form_dropdowns = form_dropdowns::where('formName', 'skinOpd')->get();
                $form_field_master = form_field_master::where('formName', 'skinOpd')->get()->pluck('form_field_code','fieldName');
                $db_skinmultiple = skinmultiple::where('case_id', $case_master->id)->whereIn('formfieldCode', array_values($form_field_master->toArray()))->get();

                if(\File::exists(public_path('skinpdf/'.$pdfname))){
                  \File::delete(public_path('skinpdf/'.$pdfname));
                $skinpdf = PDF::loadView('skin.skinpdfemail', compact('case_master','skin', 'DateWiseRecordLst','form_dropdowns','form_field_master','db_skinmultiple', 'logoUrl'));
                $path = public_path('skinpdf/');
                $fileName = 'skinFormEmail'.$request->case_id.'.pdf' ;
                $skinpdf->save($path . '/' . $fileName);
                }else{
                $skinpdf = PDF::loadView('skin.skinpdfemail', compact('case_master','skin', 'DateWiseRecordLst','form_dropdowns','form_field_master','db_skinmultiple', 'logoUrl'));
                $path = public_path('skinpdf/');
                $fileName = 'skinFormEmail'.$request->case_id.'.pdf' ;
                $skinpdf->save($path . '/' . $fileName);
                }

                $mailContent = compact('case_master','skin', 'DateWiseRecordLst','form_dropdowns','form_field_master','db_skinmultiple', 'logoUrl');
                $mailTemplate = 'skin.skinpdfemail';

                Mail::to($request->Email_To)->send(new SkinformMail($request->case_id));
                return redirect()->back()->with('flash_message', 'Email has been sent to '. $request->Email_To);

            }
           // return redirect()->back();

        }

            if(Input::get('submit_email')){
            if($request->patient_emailId && !empty($request->patient_emailId)){
				$this->validate($request, [
                    'patient_emailId' => 'required|email'
                    
                ]);
                $case_master  = Case_master::findOrFail($request->case_id);
                $pdfname="skinFormEmail".$request->case_id.".pdf";
                $case_master->pdfname=$pdfname;
                $case_master->save();

                $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
                $helperCls = new drAppHelper();
                $logoUrl = $helperCls->GetLetterHeadImageUrl();
                $skin = $case_master->skin()->first();
                $form_dropdowns = form_dropdowns::where('formName', 'skinOpd')->get();
                $form_field_master = form_field_master::where('formName', 'skinOpd')->get()->pluck('form_field_code','fieldName');
                $db_skinmultiple = skinmultiple::where('case_id', $case_master->id)->whereIn('formfieldCode', array_values($form_field_master->toArray()))->get();
                if(\File::exists(public_path('skinpdf/'.$pdfname))){
                  \File::delete(public_path('skinpdf/'.$pdfname));
                $skinpdf = PDF::loadView('skin.skinpdfemail', compact('case_master','skin', 'DateWiseRecordLst','form_dropdowns','form_field_master','db_skinmultiple', 'logoUrl'));
                $path = public_path('skinpdf/');
                $fileName = 'skinFormEmail'.$request->case_id.'.pdf' ;
                $skinpdf->save($path . '/' . $fileName);
                }else{
                $skinpdf = PDF::loadView('skin.skinpdfemail', compact('case_master','skin', 'DateWiseRecordLst','form_dropdowns','form_field_master','db_skinmultiple', 'logoUrl'));
                $path = public_path('skinpdf/');
                $fileName = 'skinFormEmail'.$request->case_id.'.pdf' ;
                $skinpdf->save($path . '/' . $fileName);
                }


                $mailContent = compact('case_master','skin', 'DateWiseRecordLst','form_dropdowns','form_field_master','db_skinmultiple', 'logoUrl');
                $mailTemplate = 'skin.skinpdfemail';

                Mail::to($request->patient_emailId)->send(new SkinformMail($request->case_id));
               return redirect()->back()->with('flash_message', 'Email has been sent to '. $request->patient_emailId);
            }
            //return redirect()->back();
        }
          return redirect()->back()->with('flash_message', 'Record added successfully');
       
    }

    public function deletemultiselect(Request $request, $id) {	
		$skinmultiple = skinmultiple::findOrFail($id);
		$skinmultiple->delete();
		return "OK";
	}

    public function deleteImage(Request $request){
        $skin = skin::where('case_id', $request->case_id)->first();
        if($request->imageName == "BeforeImage"){
            Storage::Delete($skin->BeforeImagePath);
            $skin->BeforeImagePath = null;
            $skin->save();
        }
        if($request->imageName == "AfterImage"){
            Storage::Delete($skin->AfterImagePath);
            $skin->AfterImagePath = null;
            $skin->save();
        }
		return "OK";
    }

    public function ViewSkinReportFiles($case_id){
        $report_image = report_image::where('case_id', $case_id)->get();
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        return view('skin.ViewSkinReportFile', compact('report_image', 'casedata'));
    }

    public function print($case_id){

        $case_master  = Case_master::findOrFail($case_id);

        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $skin = $case_master->skin()->first();
        $form_dropdowns = form_dropdowns::where('formName', 'skinOpd')->get();
        $form_field_master = form_field_master::where('formName', 'skinOpd')->get()->pluck('form_field_code','fieldName');
        $db_skinmultiple = skinmultiple::where('case_id', $case_master->id)->whereIn('formfieldCode', array_values($form_field_master->toArray()))->get();
        $report_image = report_image::where('case_id', $case_master->id)->get();
        //return var_dump($db_skinmultiple);
        return view('skin.print', compact('case_master','skin', 'DateWiseRecordLst','form_dropdowns','form_field_master','db_skinmultiple', 'report_image', 'logoUrl'));
    }

    public function view($case_id){

        $case_master  = Case_master::findOrFail($case_id);

        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $skin = $case_master->skin()->first();
        $form_dropdowns = form_dropdowns::where('formName', 'skinOpd')->get();
        $form_field_master = form_field_master::where('formName', 'skinOpd')->get()->pluck('form_field_code','fieldName');
        $db_skinmultiple = skinmultiple::where('case_id', $case_master->id)->whereIn('formfieldCode', array_values($form_field_master->toArray()))->get();
        $report_image = report_image::where('case_id', $case_master->id)->get();
        //return var_dump($db_skinmultiple);
		
        return view('skin.view', compact('case_master','skin', 'DateWiseRecordLst','form_dropdowns','form_field_master','db_skinmultiple', 'report_image', 'logoUrl'));
    }

}