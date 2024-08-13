<?php

namespace App\Http\Controllers;


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
  
use Illuminate\Http\Request;
use PDF;

class MainController extends Controller
{
 

      public function generatePDF($case_id){


        $casedata = $this->getCaseData($case_id);
        $viewName = $this->getPatientFormByDoctorId($casedata['doctor_id']);
       // return $viewName;
        switch($viewName)
        {
            case 'patientDetails.caseHistory';
            case 'patientDetails.CasHisFemale';
                $patient_details = patient_details::where('case_id', $case_id)->first();
                if ($patient_details === null) {
                    $patient_details = new patient_details();
                }
                $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
                $logoUrl='';
                if(!is_null($image_gallery) && isset($image_gallery->imgUrl)){
                    $logoUrl=$image_gallery->imgUrl;
                }

            break;
            case 'case_masters.add';
               return redirect()->action('Case_mastersController@printPatientDetails',['case_master'=>$case_id]);
            break;
            case 'EyeForm.EyeForm';
                return redirect()->route('eyeDetails.print',['case_master'=>$case_id]);
            break;
            case 'dentist.add';
                return redirect()->route('dentist.pdf',['case_master'=>$case_id]);
            break;
            case 'skin.addUpdate';
                return redirect()->route('skin.print',['case_master'=>$case_id]);
            break;
        }
    }

      public function getPatientFormByDoctorId($doctor_id){
        //redirect logic based upon doctory type.
        $viewName = 'case_masters.add';
        $doctor_form_mapping = doctor::where('id', $doctor_id)->first();
        if(!is_null($doctor_form_mapping) && !empty($doctor_form_mapping) && !empty($doctor_form_mapping->formViewName)){
            if(view()->exists($doctor_form_mapping->formViewName)){
                $viewName = $doctor_form_mapping->formViewName;
            }
        }
        return $viewName;
    }

      public function getCaseData($id)
    {
        
        $case_master = Case_master::findOrFail($id);
        //$medicinlist = Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get();
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $casedata = [
                    'id'=>$case_master->id,
                    //'medicinlist' => $medicinlist,
                    'prescriptions' =>  prescription_list::where('case_id', $case_master->id)->get(),
                    'DateWiseRecordLst' => $DateWiseRecordLst,
                    'case_number' => $case_master->case_number,//'p_00000001'
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
                    'field_type_memory' => null,
                    'field_type_data' => null
                    ];
            return $casedata;
    }
}
