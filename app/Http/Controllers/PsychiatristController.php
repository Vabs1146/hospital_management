<?php

namespace App\Http\Controllers;

//use Request;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;


use App\Psychiatrist;
use App\Case_master;
use App\Models\form_dropdowns;
use App\Models\eyeformmultipleentry;
use App\eyeform;
use App\doctor;
use App\Medical_store;
use App\timeslot;
use App\field_type_memory;
use App\field_type_data;
use App\prescription_list;
use App\quantity_dropdown;
use App\strength_dropdown;
use App\number_of_times_dropdown;
use App\helperClass\drAppHelper;

class PsychiatristController extends AdminRootController
{    
     public function add($case_id) {          
         
        $casedata  = Case_master::findOrFail($case_id);
        
        $psychiatrist = Psychiatrist::where('case_id', $case_id)->first();
        
        
        $prev_record = Case_master::where('case_number', $casedata->case_number)
            ->where('is_deleted', '0')
            ->where('id', '<', $case_id)
            ->orderBy('id', 'desc')
            ->select('id', 'created_at')
            ->first();
        
        if(!$psychiatrist && $prev_record->id) {
            $psychiatrist = Psychiatrist::where('case_id', $prev_record->id)->first();
        }
        
        //dd($psychiatrist);
        
         $psychiatrist_case_form_family_history = DB::table('psychiatrist_case_form_family_history')->where('psychiatrist_form_id', $psychiatrist->id)->get();
        
        $psychiatrist_case_form_files = DB::table('psychiatrist_case_form_files')->where('psychiatrist_form_id', $psychiatrist->id)->get();
        
        
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
         $form_details = eyeform::where('case_id', $case_id)->first();
        //dd($psychiatrist_case_form_family_history);
         
         $treatment_notes = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $case_id)->where('type', 'treatment_notes')->get();
         
         $doctor_notes = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $case_id)->where('type', 'doctor_notes')->first();
         
        $psychiatrist_advice = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $case_id)->where('type', 'psychiatrist_advice')->first();
        
        $prescription_notes = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $case_id)->where('type', 'prescription_notes')->first();
         
         //dd($treatment_notes);
         
         $prescription_html = $this->get_prescription($case_id);
         
         
         $followup_html = $this->add_followup($case_id);
         
         $report_files_html = $this->add_report_files($case_id);
         
         //echo $followup_html; exit;
         
         //dd($casedata);
         
         /*
         $DateWiseRecordLst = Case_master::where('case_number', $casedata->case_number)
            ->where('is_deleted', '0')
            ->orderBy('created_at', 'asc')
            ->select('id', 'created_at')
            ->get();
         */
         
         $prescription_data_array = DB::table('prescription_data')->where('case_id', $case_id)->orderBy('prescription_id')->get();


foreach($prescription_data_array as $prescription_data_row) {
$prescription_data[$prescription_data_row->prescription_id][] = $prescription_data_row;
}
        
          return view('Psychiatrist.add', compact('casedata', 'psychiatrist', 'psychiatrist_case_form_family_history', 'psychiatrist_case_form_files', 'form_details', 'form_dropdowns', 'treatment_notes', 'doctor_notes', 'psychiatrist_advice', 'prescription_html', 'followup_html', 'report_files_html', 'prescription_data', 'prescription_notes'));
     }
     
     public function add_doctor($case_id) {          
         
        $casedata  = Case_master::findOrFail($case_id);
        
        $psychiatrist = Psychiatrist::where('case_id', $case_id)->first();
        
         $psychiatrist_case_form_family_history = DB::table('psychiatrist_case_form_family_history')->where('psychiatrist_form_id', $psychiatrist->id)->get();
        
        $psychiatrist_case_form_files = DB::table('psychiatrist_case_form_files')->where('psychiatrist_form_id', $psychiatrist->id)->get();
        
        
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
         $form_details = eyeform::where('case_id', $case_id)->first();
        //dd($psychiatrist_case_form_family_history);
         
         $treatment_notes = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $case_id)->where('type', 'treatment_notes')->get();
         
         $doctor_notes = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $case_id)->where('type', 'doctor_notes')->first();
         
        $psychiatrist_advice = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $case_id)->where('type', 'psychiatrist_advice')->first();
         
         //dd($treatment_notes);
         
         $prescription_html = $this->get_prescription($case_id);
         
         
         $followup_html = $this->add_followup($case_id);
         
         $report_files_html = $this->add_report_files($case_id);
         
         //echo $followup_html; exit;
         
        // dd($casedata);
         
         
         $DateWiseRecordLst = Case_master::where('case_number', $casedata->case_number)
            ->where('is_deleted', '0')
            ->orderBy('created_at', 'asc')
            ->select('id', 'created_at')
            ->get();
         
         //dd($DateWiseRecordLst);
         
$prescription_data_array = DB::table('prescription_data')->where('case_id', $case_id)->orderBy('prescription_id')->get();


foreach($prescription_data_array as $prescription_data_row) {
$prescription_data[$prescription_data_row->prescription_id][] = $prescription_data_row;
}

//dd($prescription_data);
        
        
          return view('Psychiatrist.add_doctor', compact('casedata', 'psychiatrist', 'psychiatrist_case_form_family_history', 'psychiatrist_case_form_files', 'form_details', 'form_dropdowns', 'treatment_notes', 'doctor_notes', 'psychiatrist_advice', 'prescription_html', 'followup_html', 'report_files_html', 'DateWiseRecordLst', 'prescription_data'));
     }
     
    function get_prescription($case_id) {
        $templates = DB::table('prescription_templates')->where('parent', 0)->get();

        $user = Auth::user()->id;


        $getdata = $this->getCaseData($case_id);

        $presDropdowns = [
            'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
            'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
            'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
            'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText'), 
            'no_of_days' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'no_of_days')->pluck('ddText', 'ddText') 
        ];

        //dd($getdata['prescriptions']);

        foreach($getdata['prescriptions'] as $key => $val) {
            $generic_medicine = DB::table('medical_store')->where('id',$val->generic_medicine_id)->first();

            $getdata['prescriptions'][$key]->generic_name = ($generic_medicine) ? $generic_medicine->generic_name: '';
        }

        //dd($getdata['prescriptions']);

        //dd($getdata);

        $mergeArray = array_merge($getdata, $presDropdowns);

        $prescription_data_array = DB::table('prescription_data')->where('case_id', $case_id)->orderBy('prescription_id')->get();

        $prescription_data = [];
        foreach($prescription_data_array as $prescription_data_row) {
            $prescription_data[$prescription_data_row->prescription_id][] = $prescription_data_row;
        }
        
         $prescription_notes = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $case_id)->where('type', 'prescription_notes')->first();

        //dd($prescription_data);
        //dd($mergeArray);
        return view('Psychiatrist.add_prescription', ['casedata' => $mergeArray, 'templates' => $templates, 'form_dropdowns', 'prescription_data' => $prescription_data, 'prescription_notes' => $prescription_notes])->render();

    }
     
     public function view($case_id) {  
        $casedata  = Case_master::findOrFail($case_id);

        $psychiatrist = Psychiatrist::where('case_id', $case_id)->first();

        $psychiatrist_case_form_family_history = DB::table('psychiatrist_case_form_family_history')->where('psychiatrist_form_id', $psychiatrist->id)->get();

        $psychiatrist_case_form_files = DB::table('psychiatrist_case_form_files')->where('psychiatrist_form_id', $psychiatrist->id)->get();

        return view('Psychiatrist.view', compact('casedata', 'psychiatrist', 'psychiatrist_case_form_family_history', 'psychiatrist_case_form_files'));
     }
     
     public function print($case_id) {  
        $casedata  = Case_master::findOrFail($case_id);

        $psychiatrist = Psychiatrist::where('case_id', $case_id)->first();

        $psychiatrist_case_form_family_history = DB::table('psychiatrist_case_form_family_history')->where('psychiatrist_form_id', $psychiatrist->id)->get();

        $psychiatrist_case_form_files = DB::table('psychiatrist_case_form_files')->where('psychiatrist_form_id', $psychiatrist->id)->get();

        return view('Psychiatrist.print', compact('casedata', 'psychiatrist', 'psychiatrist_case_form_family_history', 'psychiatrist_case_form_files'));
     }
     
      public function save(Request $request, $case_id = "") {  
          
        // echo "========>>>>>>>>>>>> <pre>"; print_r($_FILES);
        // echo "========>>>>>>>>>>>> <pre>"; print_r($_POST); exit;
          
        $psychiatrist = Psychiatrist::where('case_id', $request->case_id)->first();
        
        if(!$psychiatrist) {
             $psychiatrist = new Psychiatrist();
        }
        
        
        
        /*
        'id', 'case_id', 'patient_registration', 'patient_registration_date', 'first_name', 'middle_name', 'last_name',
                
                'patient_age', 'patient_gender', 'patient_address_1', 'patient_address_2', 'patient_address_3', 'patient_education', 'patient_occupation', 'patient_contact_number', 'relative_first_name', 'relative_middle_name', 'relative_last_name', 
                
                'question_1', 'question_2', 'question_3', 'question_4', 'question_5', 'question_6', 'question_7', 'undersigned_first_name', 'undersigned_middle_name', 'undersigned_last_name', 'about_person_first_name', 'about_person_middle_name', 'about_person_last_name', 'status', 'is_deleted', 'created_at', 'created_by', 'updated_at', 'updated_by'
                */
        $psychiatrist->case_id = $request->case_id;
        
        $psychiatrist->patient_registration = $request->patient_registration;
        $psychiatrist->patient_registration_date = $request->patient_registration_date;
        $psychiatrist->first_name = $request->first_name;
        $psychiatrist->middle_name = $request->middle_name;
        $psychiatrist->last_name = $request->last_name;
        
        
        $psychiatrist->patient_education = $request->patient_education;
        $psychiatrist->patient_occupation = $request->patient_occupation;
        $psychiatrist->patient_contact_number = $request->patient_contact_number;
        $psychiatrist->patient_marital_status = $request->patient_marital_status;
        
        $psychiatrist->patient_age = $request->patient_age;
        $psychiatrist->patient_gender = $request->patient_gender;
        $psychiatrist->relative_first_name = $request->relative_first_name;
        $psychiatrist->relative_middle_name = $request->relative_middle_name;
        $psychiatrist->relative_last_name = $request->relative_last_name;
        
        $psychiatrist->question_1 = $request->question_1;
        $psychiatrist->question_1_duration = $request->question_1_duration;
        $psychiatrist->question_2 = $request->question_2;
        $psychiatrist->question_2_duration = $request->question_2_duration;
        
        $psychiatrist->question_3 = $request->question_3;
        $psychiatrist->question_4 = isset($request->symptoms) ? implode('--***--', $request->symptoms) : null;
        $psychiatrist->question_5 = $request->question_5;
        $psychiatrist->question_6 = $request->question_6;
        $psychiatrist->question_7 = $request->question_7;
        $psychiatrist->question_8 = isset($request->question_8) ? implode('--***--', $request->question_8) : null;
        $psychiatrist->question_9 = isset($request->question_9) ? implode('--***--', $request->question_9) : null;
        
        $psychiatrist->undersigned_first_name = $request->undersigned_first_name;
        $psychiatrist->undersigned_middle_name = $request->undersigned_middle_name;
        $psychiatrist->undersigned_last_name = $request->undersigned_last_name;
        
        $psychiatrist->about_person = $request->about_person;
        $psychiatrist->about_person_first_name = $request->about_person_first_name;
        $psychiatrist->about_person_middle_name = $request->about_person_middle_name;
        $psychiatrist->about_person_last_name = $request->about_person_last_name;
        
        $psychiatrist->created_by = Auth::user()->id;
        
        $psychiatrist->save();
        
        // if (count($request->question_6) > 0) {
                
        if ( $request->hasFile('question_6_files')) {
           //echo "in ifff";exit;
            $image = $request->File('question_6_files');
          // echo "<pre> ============= ";print_r($image);exit;
            $destinationPath = 'psychiatrist_files/';
            $i=1;
            foreach ($image as $key => $files) {
               //echo "<pre> ============= ";print_r($files);exit;
                $profileImage = time().$i++.'.'.$files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                
                $insert_data = array(
                    'psychiatrist_form_id'  => $psychiatrist->id,
                    'file'                  => $profileImage
                );
                
                //echo "<pre> ============= ";print_r($insert_data);exit;
                
                DB::table('psychiatrist_case_form_files')->insert($insert_data);
            }
        }
        
        
        if(isset($request->psychiatrist_case_form_files_all_ids)) {
            
            $remaining_ids = isset($request->psychiatrist_case_form_files_all_ids_not_deleted) ? $request->psychiatrist_case_form_files_all_ids_not_deleted : [];
            $deleted_ids = array_diff($request->psychiatrist_case_form_files_all_ids, $remaining_ids);
            
            if(!empty($deleted_ids)) {
                DB::table('psychiatrist_case_form_files')->whereIn('id', $deleted_ids)->delete();
            }
        }
        
        //INSERT INTO `psychiatrist_case_form_family_history` (`id`, `relation`, `name`, `doctor`, `psychiatrist_form_id`) VALUES (NULL, NULL, NULL, NULL, NULL)
        
        if(isset($request->psychiatrist_case_form_family_all_ids)) {
            
            $remaining_ids = isset($request->psychiatrist_case_form_family_all_ids_not_deleted) ? $request->psychiatrist_case_form_family_all_ids_not_deleted : [];
            $deleted_ids = array_diff($request->psychiatrist_case_form_family_all_ids, $remaining_ids);
            
            if(!empty($deleted_ids)) {
                DB::table('psychiatrist_case_form_family_history')->whereIn('id', $deleted_ids)->delete();
            }

            if(isset($request->question_7_rlation_eidt) && !empty($request->question_7_rlation_eidt)) {
                foreach($request->question_7_rlation_eidt as $key => $name) {
            
                    $update_data = array(
                       'relation'              => $request->question_7_rlation_eidt[$key],
                       'name'                  => $request->question_7_name_eidt[$key],
                       'doctor'                => $request->question_7_doctor_eidt[$key]
                   );

                    DB::table('psychiatrist_case_form_family_history')->where('id', $key)->update($update_data);
               }
            }
        }
      
      
        foreach($request->question_7_name as $key => $name) {
             if($request->question_7_rlation[$key] || $name || $request->question_7_doctor[$key]) { 
                $insert_data = array(
                   'psychiatrist_form_id'  => $psychiatrist->id,
                   'relation'              => $request->question_7_rlation[$key],
                   'name'                  => $name,
                   'doctor'                => $request->question_7_doctor[$key]
               );

                DB::table('psychiatrist_case_form_family_history')->insert($insert_data);
           }
        }
        
        
         //echo "========>>>>>>>>>>>> <pre>"; print_r($_FILES);
     //echo "========>>>>>>>>>>>> <pre>"; print_r($_POST); exit;
        
         return redirect()->back() ->with('flash_message', 'Details added Successully.');
        
           // echo "========>>>>>>>>>>>> <pre>"; print_r($_FILES);
      //echo "========>>>>>>>>>>>> <pre>"; print_r($_POST); exit;
     }
     
     
      public function save_notes(Request $request, $case_id = "") {
         // dd($_POST);
          
          $case_id = $request->case_id;
          $insert_data = [];
          foreach($request->psychiatrist_notes as $psychiatrist_notes_row) {
              if($psychiatrist_notes_row) {
              $insert_data[] = ['type' => 'treatment_notes', 'case_id' => $case_id, 'notes' => $psychiatrist_notes_row];
              }
          }
          
          if(!empty($insert_data)) {
            DB::table('psychiatrist_notes')->insert($insert_data); 
          }
          
          if($request->doctor_notes) {
              $doctor_notes = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $case_id)->where('type', 'doctor_notes')->first();
              
              
              $insert_data = ['type' => 'doctor_notes', 'case_id' => $case_id, 'notes' => $request->doctor_notes];
              
              if($doctor_notes) {
                    DB::table('psychiatrist_notes')->where('id', $doctor_notes->id)->update($insert_data); 
              } else {
                    DB::table('psychiatrist_notes')->insert($insert_data); 
              }
          }
          
          if($request->psychiatrist_advice) {
              $doctor_notes = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $case_id)->where('type', 'psychiatrist_advice')->first();
              
              
              $insert_data = ['type' => 'psychiatrist_advice', 'case_id' => $case_id, 'notes' => $request->psychiatrist_advice];
              
              if($doctor_notes) {
                    DB::table('psychiatrist_notes')->where('id', $doctor_notes->id)->update($insert_data); 
              } else {
                    DB::table('psychiatrist_notes')->insert($insert_data); 
              }
          }
          //   dd($insert_data);
          
       
         return redirect()->back() ->with('flash_message', 'Details added Successully.');
      }
      
       public function delete_notes(Request $request, $note_id = "") {
           
          
           DB::table('psychiatrist_notes')->where('id', $note_id)->update(['is_deleted' => '1']); 
           // dd($note_id);
           echo 1;
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
            'casehistory_followup_notes' => $case_master->casehistory_followup_notes, 
            'Reports_file' => $case_master->Report_file()->get(),
            'Before_file' => $case_master->BeforeImagePath, 
            'After_file' => $case_master->AfterImagePath, 
            'field_type_memory' => $field_type_memory, 
            'field_type_data' => $field_type_data
        ];
        return $casedata;
    }
    
    
    public function printprescription($id)
    {
        //$image_gallery = Image_gallery::where('imgTypeId', 4)->first();
        $user = Auth::user()->id;

        $accesslevel = DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='print/prescription'");

        foreach ($accesslevel as $value)
        {
            $this->acc = $value->accesslevel;
        }
	
        $casedata = $this->getCaseData($id);
        
        //dd($this->getCaseData($id));
		//$doctor = DB::table('users')->whereNotNull('doctor_degree')->whereNotNull('doctor_registration_number')->first();
        $doctor = DB::table('doctors')->where('id', $casedata['doctor_id'])->first();
        //dd($doctor);
        if ($this->acc == 1)
        {
            $helperCls = new drAppHelper();
            $logoUrl = $helperCls->GetLetterHeadImageUrl();
            
            $getdata = $this->getCaseData($id);
            foreach($getdata['prescriptions'] as $key => $val) {
                 $generic_medicine = DB::table('medical_store')->where('id',$val->generic_medicine_id)->first();
                 
                 $getdata['prescriptions'][$key]->generic_name = ($generic_medicine) ? $generic_medicine->generic_name: '';
             }
             
             $prescription_data_array = DB::table('prescription_data')->where('case_id', $id)->orderBy('prescription_id')->get();
            
            foreach($prescription_data_array as $prescription_data_row) {
                $prescription_data[$prescription_data_row->prescription_id][] = $prescription_data_row;
            }
            
            
            $treatment_notes = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $id)->where('type', 'treatment_notes')->get();
         
         $doctor_notes = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $id)->where('type', 'doctor_notes')->first();
         
          $psychiatrist_advice = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $id)->where('type', 'psychiatrist_advice')->first();
          
          $prescription_notes = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $id)->where('type', 'prescription_notes')->first();
          
          //dd($psychiatrist_advice);
          
         // dd($getdata);
            
            return view('Psychiatrist.print_prescription', ['casedata' => $getdata, 'logoUrl' => $logoUrl, 'doctor' => $doctor, 'prescription_data' => $prescription_data, 'treatment_notes' => $treatment_notes, 'doctor_notes' => $doctor_notes, 'psychiatrist_advice' => $psychiatrist_advice, 'prescription_notes' => $prescription_notes]);
        }

        else
        {

            $url = url()->previous();
            return redirect($url);
        }

    }
    
    public function print_notes($id)
    {
        //$image_gallery = Image_gallery::where('imgTypeId', 4)->first();
        $user = Auth::user()->id;

        $accesslevel = DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='print/prescription'");

        foreach ($accesslevel as $value)
        {
            $this->acc = $value->accesslevel;
        }
	
        $casedata = $this->getCaseData($id);
        
        //dd($this->getCaseData($id));
		//$doctor = DB::table('users')->whereNotNull('doctor_degree')->whereNotNull('doctor_registration_number')->first();
        $doctor = DB::table('doctors')->where('id', $casedata['doctor_id'])->first();
        //dd($doctor);
        if ($this->acc == 1)
        {
            $helperCls = new drAppHelper();
            $logoUrl = $helperCls->GetLetterHeadImageUrl();
            
            $getdata = $this->getCaseData($id);
            foreach($getdata['prescriptions'] as $key => $val) {
                 $generic_medicine = DB::table('medical_store')->where('id',$val->generic_medicine_id)->first();
                 
                 $getdata['prescriptions'][$key]->generic_name = ($generic_medicine) ? $generic_medicine->generic_name: '';
             }
             
             $prescription_data_array = DB::table('prescription_data')->where('case_id', $id)->orderBy('prescription_id')->get();
            
            foreach($prescription_data_array as $prescription_data_row) {
                $prescription_data[$prescription_data_row->prescription_id][] = $prescription_data_row;
            }
            
            
            $treatment_notes = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $id)->where('type', 'treatment_notes')->get();
         
         $doctor_notes = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $id)->where('type', 'doctor_notes')->first();
         
          $psychiatrist_advice = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $id)->where('type', 'psychiatrist_advice')->first();
          
          $prescription_notes = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $id)->where('type', 'prescription_notes')->first();
          
          //dd($psychiatrist_advice);
          
         // dd($getdata);
            
            return view('Psychiatrist.print_notes', ['casedata' => $getdata, 'logoUrl' => $logoUrl, 'doctor' => $doctor, 'prescription_data' => $prescription_data, 'treatment_notes' => $treatment_notes, 'doctor_notes' => $doctor_notes, 'psychiatrist_advice' => $psychiatrist_advice, 'prescription_notes' => $prescription_notes]);
        }

        else
        {

            $url = url()->previous();
            return redirect($url);
        }

    }
    
    public function add_followup($id)
    {
         $sp_test_image = [];
        return view('Psychiatrist.followup', ['casedata' => $this->getCaseData($id), 'sp_test_image' => $sp_test_image]);
    }
    
    public function add_report_files($id)
    {
          $Case_master = Case_master::findOrFail($id);
        //return view('report_files.add', ['model' => $this->report_data($Case_master)]);
        return view('Psychiatrist.report_files', ['model' => $this->report_data($Case_master)]);
    }
    
    public function report_data(Case_master $Case_master)
    {
        $DateWiseRecordLst = Case_master::where('case_number', $Case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        return  ['case_master' => $Case_master, 'DateWiseRecordLst' => $DateWiseRecordLst,  'Report_file' => $Case_master->Report_file()->get(), 'report_description'=>'', 'uploaded_file'=>'' ];
    }
    
    public function save_followup(Request $request) {
        
       
        
        $case_master = Case_master::findOrFail($request->id);
        
        
        
        $case_master->casehistory_followup_notes =  $request->casehistory_followup_notes;
        if (isset($request->FollowUpDoctorID) && isset($request->appointment_dt) && $request->appointment_dt != null && $request->appointment_dt != '') {
            $case_master->FollowUpDate =  $request->appointment_dt;
            $case_master->FollowUpTimeSlot = $request->FollowUpTimeSlot;
            $case_master->FollowUpDoctor_Id = $request->FollowUpDoctorID;
        }
        
        $case_master->save();
        
        //echo "=====>>>>>>>>>>>>>> <pre>"; print_r($_POST); exit;
        
        return redirect()->back() ->with('flash_message', 'Details added Successully.');
    }
    
    
    public function get_prescription_template(Request $request) {
        $user = Auth::user()->id;
        
        $templates = DB::table('prescription_templates')->where('id', $request->id)->orWhere('parent', $request->id)->get();
        
        $all_templates = DB::table('prescription_templates')->where('parent', 0)->get();
      
         $presDropdowns = [
'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText') 
        ];
         
        //dd($presDropdowns);
         $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')
            ->pluck('doctor_name', 'id');
        $timeslot = timeslot::where('isActive', 1)->orderBy('id')
            ->pluck('name', 'id');
        $medicinlist = Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)
            ->orderBy('created_dt', 'desc');
            //->get();
//dd($mergeArray);
        $mergeArray = array_merge($presDropdowns, ['doctorlist' => $doctorlist, 'timeslot' => $timeslot, 'medicinlist' => $medicinlist]);
        //dd($mergeArray);
            return view('Psychiatrist.add_prescription_templates_row', ['casedata' => $mergeArray, 'templates' => $templates, 'all_templates' => $all_templates, 'template_id' => $request->id]);    
    }
    
     public function add_prescription_dropdowns($id) {
        
        $templates = DB::table('prescription_templates')->where('parent', 0)->get();

        $user = Auth::user()->id;


        $getdata = $this->getCaseData($id);

        $presDropdowns = [
            'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
            'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
            'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
            'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText'), 
            'no_of_days' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'no_of_days')->pluck('ddText', 'ddText') 
        ];

        //dd($getdata['prescriptions']);

        foreach($getdata['prescriptions'] as $key => $val) {
            $generic_medicine = DB::table('medical_store')->where('id',$val->generic_medicine_id)->first();

            $getdata['prescriptions'][$key]->generic_name = ($generic_medicine) ? $generic_medicine->generic_name: '';
        }

        //dd($getdata['prescriptions']);

        $mergeArray = array_merge($getdata, $presDropdowns);

        $prescription_data_array = DB::table('prescription_data')->where('case_id', $id)->orderBy('prescription_id')->get();

        $prescription_data = [];
        foreach($prescription_data_array as $prescription_data_row) {
            $prescription_data[$prescription_data_row->prescription_id][] = $prescription_data_row;
        }

        //dd($prescription_data);

        return view('Psychiatrist.add_dropdowns', ['casedata' => $mergeArray, 'templates' => $templates, 'form_dropdowns', 'prescription_data' => $prescription_data]);
       
    }
    
     public function add_prescription_templates($case_id = "") {
        $user = Auth::user()->id;

        $templates = DB::table('prescription_templates')->where('parent', 0)->get();

        //dd($templates);
        //$getdata = $this->getCaseData($id);
        $getdata = [];
        //echo "111111111111111111"; exit;
        $presDropdowns = [
'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText') 
        ];

        //dd($presDropdowns);
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')
        ->pluck('doctor_name', 'id');
        $timeslot = timeslot::where('isActive', 1)->orderBy('id')
        ->pluck('name', 'id');
        $medicinlist = Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)
        ->orderBy('created_dt', 'desc')
        ->get();

        //dd($presDropdowns);
        $mergeArray = array_merge($getdata, $presDropdowns, ['doctorlist' => $doctorlist, 'timeslot' => $timeslot, 'medicinlist' => $medicinlist]);
        return view('Psychiatrist.add_prescription_templates', ['casedata' => $mergeArray, 'templates' => $templates, 'case_id' => $case_id]);
    }
    
    public function psychiatrist_priscription_templates(Request $request, $case_id = "") {
        return view('Psychiatrist.psychiatrist_priscription_templates', ['case_id' => $case_id]);
    }
    
    public function edit_prescription_templates($template_id = "", $case_id = "") {
        $user = Auth::user()->id;
        $template = DB::table('prescription_templates')->where('id', $template_id)->orWhere('parent', $template_id)->get();

        //dd($template);
        $getdata = [];
        //echo "111111111111111111"; exit;
        $presDropdowns = [
    'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
    'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
    'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
    'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText') 
        ];

        //dd($presDropdowns);
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')
        ->pluck('doctor_name', 'id');
        $timeslot = timeslot::where('isActive', 1)->orderBy('id')
        ->pluck('name', 'id');
        $medicinlist = Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)
        ->orderBy('created_dt', 'desc')
        ->get();

        //dd($presDropdowns);
        $mergeArray = array_merge($getdata, $presDropdowns, ['doctorlist' => $doctorlist, 'timeslot' => $timeslot, 'medicinlist' => $medicinlist]);
        //echo "=========>>>>>>> <pre>"; print_r($template); exit;
        return view('Psychiatrist.edit_prescription_templates', ['casedata' => $mergeArray, 'templates' => $template, 'case_id' => $case_id, 'template_id' => $template_id]);
    }
}