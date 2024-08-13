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

use App\Case_master;
use App\doctor;
use App\timeslot;
use App\Medical_store;
use App\case_number_generators;
use App\prescription_list;
use App\appointment;
use App\report_image;
use App\Staff_user;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as HttpGuzzle;
use App\field_type_data;
use App\field_type_memory;
use App\quantity_dropdown;
use App\strength_dropdown;
use App\number_of_times_dropdown;
use App\Image_gallery;
use App\helperClass\drAppHelper;
use App\Models\form_dropdowns;
use DateTime;
use Auth;
use App\Helpers\Helpers;
use App\Models\paymentfor;
use Illuminate\Support\Facades\Mail;
use App\Mail\casePaperMail;
use App\Mail\GenralpformMail;
use PDF;
use App\helperClass\CommonHelper;
use App\entmedical_store;
use App\Models\ent_form_dropdowns;
use App\IpdPatientsDropdowns;
use App\patients_prescription_lists;

class NursesOverReportController  extends AdminRootController
{
	public function __construct()
    {
            //echo "============>>>>>> <pre>".__LINE__; print_r([]); exit;
        $this->acc=0;
        $this->commonHelper = new CommonHelper();
    }


    public function add(Request $request, $registration_id)
    {
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
        
        $registration_data = DB::table('patients')->where('id', $registration_id)->first();
        
        $discharge_data = DB::table('patients_discharge')->where('registration_id', $registration_id)->first();
        
        //------------------------------------------------------------------------------------------
$presDropdowns = [
    'prescriptions' =>  patients_prescription_lists::where('registration_id', $registration_id)->get(),
    'medicinlist' => entmedical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get(),

    'numberOfTimes_drpdwn' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Times a day')->pluck('ddText','ddText'),
    'quantity'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Quantity')->pluck('ddText','ddText'),
    'medicine_strength'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Strength')->pluck('ddText','ddText')
];
        
        $templates = DB::table('ent_prescription_templates')->where('parent', 0)->get();
       // dd($presDropdowns);
        //-------------------------------------------------------------------------------------------
        
         $ipd_doctors = IpdPatientsDropdowns::where('type', 'ipd_doctor')->get();
        
        foreach($ipd_doctors as $ipd_doctor) {
            $all_doctors[$ipd_doctor->id] = $ipd_doctor->name;
        }
        
    //$discharge_summary_data = DB::table('new_discharge_summary')->where('registration_id', $registration_id)->get();
    //$discharge_summary = $this->convert_to_data_object($discharge_summary_data, []);
        
        
        $final_data = DB::table('nurses_over_report')->where('registration_id', $registration_id)->get();
       //echo "<pre>". count($final_data); exit;
        return View('nurses_over_report.index', compact(
                'registration_data', 
                'discharge_data', 
                'presDropdowns', 
                'templates', 
                'final_data'
            )
        );

    }
    
    function save(Request $request, $registration_id = "") {
    //echo "============>>>>>> <pre>".__LINE__; print_r($_POST); exit;
     
     $final_data = [];
     foreach($request->date as $key => $val) {
        // dd($timing_val);
        //$date = $date_val[0];

        $date = $date_val;
        
        $medications = isset($request->medicine_checkbox[$key]) ? implode(',', $request->medicine_checkbox[$key]) : '';
        $insert_data = [
            'registration_id'   => $registration_id,
            'date'              => $request->date[$key],
            'from_time'         => $request->from[$key],
            'to_time'           => $request->to[$key],
            'medication'        => $medications,
            'nurse_name'        => $request->nurse_name[$key],
            'notes'             => $request->notes[$key]
        ];

        if(isset($request->nurses_over_report_id[$key]) && $request->nurses_over_report_id[$key] != "") {
            echo "<hr>Update : ". $request->nurses_over_report_id[$key];
            DB::table('nurses_over_report')->where('id', $request->nurses_over_report_id[$key])->update($insert_data);
        } else {
            echo "<hr>Insert : ". $request->nurses_over_report_id[$key];
            DB::table('nurses_over_report')->insert($insert_data);
        }

        $final_data[$date][] = $insert_data;        
     }
     
    /*
    if(isset($request->all_record_ids)) {
        $all_record_ids_for_update = isset($request->all_record_ids_for_update) ? $request->all_record_ids_for_update : [];
        foreach($request->all_record_ids as $all_record_ids_val) {
            if($all_record_ids_val != "" && !in_array($all_record_ids_val, $all_record_ids_for_update)) {
               DB::table('tpr_monitoring_chart')->where('id', $all_record_ids_val)->delete();  
                echo "<hr>delete : ". $all_record_ids_val;
            }
        }
    }
    */
     
     //echo "====>>>>>>>>>>> <pre>"; print_r($final_data); exit;

        return redirect()->back()->with('flash_message', 'Record added/updated successfully');
       
    }
    
    public function view(Request $request, $id) {
        $data = $this->get_icsi_form($request, $id);
        return view('ivf.ivf_icsi_view', $data);
    }
    
    public function ivf_hcg_injection_sop_print(Request $request, $id) {
        $data = $this->get_icsi_form($request, $id);
        return view('ivf.ivf_hcg_injection_sop_print', $data);
    }
    
    public function print(Request $request, $registration_id) {
        
       $registration_data = DB::table('patients')->where('id', $registration_id)->first();

       $main_record = DB::table('tpr_monitoring_chart')->where('registration_id', $registration_id)->orderBy('date')->get();
       
      // dd($main_record);
       $tpr_monitoring_chart_data = [];
       if($main_record) {
           foreach($main_record as $main_record_row) {
               $tpr_monitoring_chart_data[$main_record_row->date][$main_record_row->id] = $main_record_row;
           }
       }
       
       //dd($main_record);
       
       
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();  
        
         $payment_modes_array = [];
        $helperCls = new drAppHelper();
        $all_settings = $helperCls->get_all_settings();
        
        $payment_modes = $all_settings['payment_modes'];
        $payment_modes_array = $all_settings['all_payment_modes'];
        
        $ipd_ward_types = [];
        foreach($all_settings['ipd_ward_types'] as $ipd_ward_types_row) {
            $ipd_ward_types[$ipd_ward_types_row['id']] = $ipd_ward_types_row['name'];
        }
        
        $ipd_bed_numbers = [];
        foreach($all_settings['ipd_bed_numbers'] as $ipd_ward_types_row) {
            $ipd_bed_numbers[$ipd_ward_types_row['id']] = $ipd_ward_types_row['name'];
        }
        
        $all_docotrs = $all_settings['all_docotrs'];
       
        return view('trp_monitoring_chart.print', compact('registration_data', 'daily_order_sheet_record', 'daily_order_sheet_data', 'registration_id', 'logoUrl', 'FooterUrl', 'ipd_ward_types', 'ipd_bed_numbers', 'tpr_monitoring_chart_data', 'main_record'));
    }
    
     public function ivf_form(Request $request, $id) {
         $case_data = DB::table('case_master')->where('id', $id)->first();
       //echo "========".$id."====>>>>>> <pre>".__LINE__; print_r($case_data); exit;
       
       if($case_data->ivf_form == "od") {
           return redirect('ivf-od/'.$id);
       } else  if($case_data->ivf_form == "ed") {
           return redirect('ivf-ed/'.$id);
       } else  if($case_data->ivf_form == "fet") {
           return redirect('ivf-fet/'.$id);
       } else {
           return redirect('ivf-icsi/'.$id);
       }
    }
    
    function get_icsi_form($request, $id) {
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')
            ->pluck('doctor_name', 'id');
        $timeslot = timeslot::where('isActive', 1)->orderBy('id')
            ->pluck('name', 'id');
        $medicinlist = Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)
            ->orderBy('created_dt', 'desc')
            ->get();
        
        $ivf_icsi = DB::table('ivf_icsi')->where('case_id', $id)->first();
        
       //echo "============>>>>>> <pre>".__LINE__; print_r($ivf_icsi); exit;
        
        $ivf_icsi_menses  = DB::table('ivf_icsi_menses')->where('case_id', $id)->get();  
        
        //echo "============>>>>>> <pre>".__LINE__; print_r($ivf_icsi); exit;
        
        $ivf_icsi_ovary = DB::table('ivf_icsi_ovary')->where('case_id', $id)->get();
        
        $ivf_icsi_medicine = DB::table('ivf_icsi_medicine')->where('case_id', $id)->first();
        $ivf_icsi_medicine_details = DB::table('ivf_icsi_medicine_details')->where('case_id', $id)->get();
        
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();
        
        return ['casedata' => $this->getCaseData($id), 'doctorlist' => $doctorlist, 'ivf_icsi' => $ivf_icsi, 'ivf_icsi_menses' => $ivf_icsi_menses, 'ivf_icsi_ovary' => $ivf_icsi_ovary, 'ivf_icsi_medicine' => $ivf_icsi_medicine, 'ivf_icsi_medicine_details' => $ivf_icsi_medicine_details, 'logoUrl' => $logoUrl, 'FooterUrl' => $FooterUrl ];
    }
    
    
    
    
    function get_form($request, $id, $ivf_type) {
        
        $main_details = DB::table('ivf_od_ed_eft')->where('case_id', $id)->where('ivf_type', $ivf_type)->first();
        
        $ivf_agonist_data = DB::table('ivf_agonist_data')->where('reference_id', $main_details->id)->get();
        
        $ivf_menses_data = DB::table('ivf_menses_data')->where('reference_id', $main_details->id)->get();
        
        $ivf_menses_dosage_data = [];
        foreach($ivf_menses_data as $ivf_menses_data_row) {
            
             
            $ivf_menses_dosage_data_result = DB::table('ivf_menses_dosage_data')->where('reference_id', $ivf_menses_data_row->id)->get();
            
            foreach($ivf_menses_dosage_data_result as $ivf_menses_dosage_data_row) {
                if($ivf_menses_dosage_data_row->medicine != "" && $ivf_menses_dosage_data_row->duration != "" && $ivf_menses_dosage_data_row->time != "") {
                    $ivf_menses_dosage_data[$ivf_menses_data_row->id][] = array(
                        'dosage_id' => $ivf_menses_dosage_data_row->id,
                        'medicine' => $ivf_menses_dosage_data_row->medicine,
                        'duration' => $ivf_menses_dosage_data_row->duration,
                        'time'     => $ivf_menses_dosage_data_row->time
                    );
                }
            }
        }
        
        $casedata = $this->getCaseData($id);
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();
        
        $data = compact('casedata', 'form_dropdowns', 'main_details', 'ivf_agonist_data', 'ivf_menses_data', 'ivf_menses_dosage_data', 'ivf_type', 'logoUrl', 'FooterUrl');
        
        //echo "================ >>>>>>> <pre>"; print_r($data); exit;
        
        
        
        return $data;
        
        //return view('ivf.ivf_od', compact('casedata', 'form_dropdowns', 'main_details', 'ivf_agonist_data', 'ivf_menses_data', 'ivf_menses_dosage_data', 'ivf_type'));
    }
    
    public function ivf_od(Request $request, $id) {
        $data = $this->get_form($request, $id, "od");         
        return view('ivf.ivf_od', $data);
    }
    public function ivf_ed(Request $request, $id) {
         //return $this->get_form($request, $id, "ed");
        $data = $this->get_form($request, $id, "ed");         
        return view('ivf.ivf_od', $data);
    }

    public function ivf_fet(Request $request, $id) {
         //return $this->get_form($request, $id, "fet");
        $data = $this->get_form($request, $id, "fet");         
        return view('ivf.ivf_od', $data);
    }
    
    public function ivf_od_view(Request $request, $id) {
        $data = $this->get_form($request, $id, "od");  
        return view('ivf.ivf_od_view', $data);
    }
    
    public function ivf_ed_view(Request $request, $id) {
        $data = $this->get_form($request, $id, "ed");  
        return view('ivf.ivf_od_view', $data);
    }
    
    public function ivf_fet_view(Request $request, $id) {
        $data = $this->get_form($request, $id, "fet");  
        return view('ivf.ivf_od_view', $data);
    }
    
    public function ivf_od_print(Request $request, $id) {
        $data = $this->get_form($request, $id, "od");  
        return view('ivf.ivf_od_print', $data);
    }
    
     public function ivf_ed_print(Request $request, $id) {
        $data = $this->get_form($request, $id, "ed");  
        return view('ivf.ivf_ed_print', $data);
    }
    
    public function ivf_fet_print(Request $request, $id) {
        $data = $this->get_form($request, $id, "fet");  
        return view('ivf.ivf_fet_print', $data);
    }
    
    function save_ivf(Request $request, $case_id = "") {
        //echo "============>>>>>> <pre>".__LINE__; print_r($_POST); exit;
        if($request->submit == 'submit_icsi_main' || $request->submit == 'submit_icsi_print') {
            $this->save_icsi_main($request);
            
            DB::table('case_master')->where('id', $request->case_id)->update(['ivf_form' => 'icsi']);
        } else if($request->submit == 'submit_icsi_medicine') {
            
            $this->save_icsi_medicines($request);
            DB::table('case_master')->where('id', $request->case_id)->update(['ivf_form' => 'icsi']);
        } else if($request->submit == 'submit_od_main' || $request->submit == 'submit_od_print') {
            $this->save_od_ed_eft($request);
            DB::table('case_master')->where('id', $request->case_id)->update(['ivf_form' => $request->ivf_type]);
        }
        
        if($request->submit == 'submit_icsi_medicine') {
            return redirect('ivf-hcg-injection-sop-print/'.$case_id);
        } else if($request->submit != 'submit_od_print') {
            //echo "============>>>>>> <pre>".__LINE__;  print_r($_POST); exit;
            return redirect()->back()->with('flash_message', 'Record added successfully');
        } else {
            //echo "============>>>>>> <pre>".__LINE__; exit;
            return redirect('ivf-'.$request->ivf_type.'-print/'.$case_id);
        }
        //echo "============>>>>>> <pre>".__LINE__; print_r($_POST); exit;
    }
    
    function save_od_ed_eft($request) {
        
        $insert_data = array(
            'case_id' => $request->case_id,
            'ivf_type' => $request->ivf_type,
            'ivf_od_lmp' => $request->ivf_od_lmp,
            'ivf_od_pre_ivf_heteroscopy' => $request->ivf_od_pre_ivf_heteroscopy,
            
            'ivf_od_cycle_type' => $request->ivf_od_cycle_type,
            'ivf_od_injection' => $request->ivf_od_injection,
            
            'ivf_followup_1' => $request->ivf_followup_1,
            'ivf_followup_2' => $request->ivf_followup_2,
            'ivf_followup_3' => $request->ivf_followup_3,
            'ivf_followup_4' => $request->ivf_followup_4,
            'ivf_followup_time_1' => $request->ivf_followup_time_1,
            'ivf_followup_time_2' => $request->ivf_followup_time_2,
            'ivf_followup_time_3' => $request->ivf_followup_time_3,
            'ivf_followup_time_4' => $request->ivf_followup_time_4,
            'ivf_od_notes' => $request->ivf_od_notes
        );
       
        //DB::enableQueryLog();
        $main_record = DB::table('ivf_od_ed_eft')->where('case_id', $request->case_id)->first();
       
       
       
        if($main_record) {
            // echo "============>>>>>> <pre>".__LINE__;  print_r($insert_data); exit;
            DB::table('ivf_od_ed_eft')->where('id', $main_record->id)->update($insert_data);  
            $main_id = $main_record->id;
        } else {
            // echo "============>>>>>> <pre>".__LINE__;  print_r($insert_data); exit;
            DB::table('ivf_od_ed_eft')->insert($insert_data);    
            $main_id = DB::getPdo()->lastInsertId();
        }   
       // $query =  DB::getQueryLog();
       // echo "============>>>>>> <pre>".__LINE__;  print_r($query); exit; 
        
        foreach($request->agonist_OD as $agonist_key => $agonist_val) {
            
            if($agonist_val != "" && $request->agonist_OS[$agonist_key] != "") {
                $insert_data = array(
                    'reference_id' => $main_id,
                    'name' => $agonist_val,
                    'date' => $request->agonist_OS[$agonist_key]                
                );

                DB::table('ivf_agonist_data')->insert($insert_data);
            }
        }
        
        $this->save_ivf_menses_data($request, $main_id);
        
        
    }
    
    function save_ivf_menses_data($request, $main_id) {
        
         //echo "=====>>>>>>>>>>>>>> <pre>"; print_r($_POST); exit;
        
        if(isset($request->od_menses_all_old_ids)) {
            if(!isset($request->od_menses_old_id)) {
                DB::table('ivf_menses_data')->whereIn('id', $request->od_menses_all_old_ids)->delete();
                
                DB::table('ivf_menses_dosage_data')->whereIn('reference_id', $request->od_menses_all_old_ids)->delete();
            } else {
                foreach($request->od_menses_all_old_ids as $od_menses_all_old_ids_row) {
                    if(!in_array($od_menses_all_old_ids_row, $request->od_menses_old_id)) {
                        DB::table('ivf_menses_data')->where('id', $od_menses_all_old_ids_row)->delete();
                        
                        DB::table('ivf_menses_dosage_data')->where('reference_id', $od_menses_all_old_ids_row)->delete();
                    }
                }
            }
        }
        
       
        foreach($request->menses_injection_date as $menses_key => $menses_val) {
            if($menses_val[0] != "" || $request->menses_day[$menses_key][0] != "" || $request->menses_tablet_day[$menses_key][0] != "" || $request->menses_et[$menses_key][0] != "" || $request->notes[$menses_key][0] != "") {
                //if($request->od_menses_old_id[$menses_key]) {
                    $insert_data = array(
                        'reference_id' => $main_id,
                        'menses_injection_date' => $menses_val[0],
                        'menses_day' => $request->menses_day[$menses_key][0],
                        'menses_tablet_day' => $request->menses_tablet_day[$menses_key][0],

                        'menses_et' => $request->menses_et[$menses_key][0],
                        'notes' => $request->notes[$menses_key][0]
                    );
                    
                    
                    if(isset($request->od_menses_all_old_ids) && in_array($menses_key, $request->od_menses_all_old_ids)) {
                        DB::table('ivf_menses_data')->where('id', $menses_key)->update($insert_data);    
                        $reference_id = $menses_key;
                    } else {
                        DB::table('ivf_menses_data')->insert($insert_data);    
                        $reference_id = DB::getPdo()->lastInsertId();
                    }
                    //echo "=====>>>>>>>>>>>>>> <pre>"; print_r($insert_data); exit;
                   
               // }
                $this->save_ivf_menses_dosage_data($request, $reference_id, $menses_key);
            }
        }
    }
    
    function save_ivf_menses_dosage_data($request, $reference_id, $menses_key) {
        
        DB::table('ivf_menses_dosage_data')->where('reference_id', $reference_id)->delete();
        
        foreach($request->medicine[$menses_key] as $dosage_key => $dosage_val) {
            if($dosage_val != "" || $request->duration[$menses_key][$dosage_key] != "" || $request->time[$menses_key][$dosage_key] != "") {
                $insert_data = array(
                    'reference_id'  => $reference_id,
                    'medicine'      => $dosage_val,
                    'duration'      => $request->duration[$menses_key][$dosage_key],
                    'time'          => $request->time[$menses_key][$dosage_key]
                );
                
                DB::table('ivf_menses_dosage_data')->insert($insert_data);
            }
        }
    }
    
    function save_icsi_main($request) {
        $insert_data = array(
            'case_id' => $request->case_id,
            'pre_ivf_hysteroscopy' => $request->pre_ivf_hysteroscopy,
            'name' => $request->name,
            'age' => $request->age,
            'lmp_date' => $request->lmp_date,
            'amh' => $request->amh,
            'opu_date_time' => $request->opu_date_time,
            'ivf_followup_1' => $request->ivf_followup_1,
            'ivf_followup_2' => $request->ivf_followup_2,
            'ivf_followup_3' => $request->ivf_followup_3,
            'ivf_followup_4' => $request->ivf_followup_4,
            'ivf_followup_time_1' => $request->ivf_followup_time_1,
            'ivf_followup_time_2' => $request->ivf_followup_time_2,
            'ivf_followup_time_3' => $request->ivf_followup_time_3,
            'ivf_followup_time_4' => $request->ivf_followup_time_4,
            'stimulated' => $request->stimulated,
            'embryology_formed' => $request->embryology_formed,
            'fresh_et' => $request->fresh_et,
            'notes' => $request->notes,
        );
        
        $main_record = DB::table('ivf_icsi')->where('case_id', $request->case_id)->first();
        
        if($main_record) {
            DB::table('ivf_icsi')->where('id', $main_record->id)->update($insert_data);  
        } else {
            DB::table('ivf_icsi')->insert($insert_data);    
        }
        
        //================================= start ===================================
        if(!empty($request->icsi_menses_old_id)) {
            foreach($request->icsi_menses_old_id as $icsi_menses_key => $icsi_menses_row) {
                if($request->menses_injection_date[$icsi_menses_key] != '' || 
                        $request->menses_day[$icsi_menses_key] != '' || 
                        $request->menses_injection_day[$icsi_menses_key] != '' || 
                        $request->menses_injection_time[$icsi_menses_key] != '' || 
                        $request->menses_injection_inj_folisurge_150[$icsi_menses_key] != '' || 
                        $request->menses_injection_inj_hmg_150[$icsi_menses_key] != '' || 
                        $request->menses_injection_inj_cetorflix_150[$icsi_menses_key] != '') {
            //echo "============".__LINE__; exit;
                    
                    $menses_insert_data = array(
                        'case_id' => $request->case_id,
                        'menses_injection_date' => $request->menses_injection_date[$icsi_menses_key],
                        'menses_day' => $request->menses_day[$icsi_menses_key],
                        'menses_injection_day' => $request->menses_injection_day[$icsi_menses_key],
                        
                        'menses_injection_time' => $request->menses_injection_time[$icsi_menses_key],
                        'menses_injection_inj_folisurge_150' => $request->menses_injection_inj_folisurge_150[$icsi_menses_key],
                        'menses_injection_inj_hmg_150' => $request->menses_injection_inj_hmg_150[$icsi_menses_key],
                        'menses_injection_inj_cetorflix_150' => $request->menses_injection_inj_cetorflix_150[$icsi_menses_key]
                    );
                    
                    if($icsi_menses_row) {
                        DB::table('ivf_icsi_menses')->where('id', $icsi_menses_row)->update($menses_insert_data);  
                    } else {
                        DB::table('ivf_icsi_menses')->insert($menses_insert_data);    
                    }
                }
            } 
        }
        
        if(isset($request->icsi_menses_all_old_id)) {
           // echo "============".__LINE__; exit;
            //$icsi_menses_all_old_id_arr = explode(',', $request->icsi_menses_all_old_id);
            
            foreach($request->icsi_menses_all_old_id as $icsi_menses_all_old_id_val) {
                if($icsi_menses_all_old_id_val != "" && !in_array($icsi_menses_all_old_id_val, $request->icsi_menses_old_id)) {
                    DB::table('ivf_icsi_menses')->where('id', $icsi_menses_all_old_id_val)->delete();  
                }
            }
        }
        
            //echo "============".__LINE__; exit;
        //================================= end ===================================
        
        //================================= start ===================================
        if(!empty($request->icsi_ovary_old_id)) {
            foreach($request->icsi_ovary_old_id as $icsi_ovary_key => $icsi_ovary_row) {
                if($request->ivf_icsi_ovary_date[$icsi_ovary_key] || $request->ivf_icsi_ovary_right[$icsi_ovary_key] || $request->ivf_icsi_ovary_left[$icsi_ovary_key] || $request->ivf_icsi_ovary_mi[$icsi_ovary_key]) {
                    
                    $ovary_insert_data = array(
                        'case_id' => $request->case_id,
                        'ivf_icsi_ovary_date' => $request->ivf_icsi_ovary_date[$icsi_ovary_key],
                        'ivf_icsi_ovary_right' => $request->ivf_icsi_ovary_right[$icsi_ovary_key],
                        'ivf_icsi_ovary_left' => $request->ivf_icsi_ovary_left[$icsi_ovary_key],
                        'ivf_icsi_ovary_mi' => $request->ivf_icsi_ovary_mi[$icsi_ovary_key]
                    );
                    
                    //echo "=>>>>> <pre>"; print_r($ovary_insert_data); exit;
                    
                    if($icsi_ovary_row) {
                        DB::table('ivf_icsi_ovary')->where('id', $icsi_ovary_row)->update($ovary_insert_data);  
                    } else {
                        DB::table('ivf_icsi_ovary')->insert($ovary_insert_data);    
                    }
                }
            } 
        }
        
        if(isset($request->icsi_ovary_all_old_id)) {
            //$icsi_ovary_all_old_id_arr = explode(',', $request->icsi_ovary_all_old_id);
            
            foreach($request->icsi_ovary_all_old_id as $icsi_ovary_all_old_id_val) {
                
                if($icsi_ovary_all_old_id_val != "" && !in_array($icsi_ovary_all_old_id_val, $request->icsi_ovary_old_id)) {
                    DB::table('ivf_icsi_ovary')->where('id', $icsi_ovary_all_old_id_val)->delete();  
                }
            }
        }
        //echo "============".__LINE__; exit;
        //================================= end ===================================
        
        
    }
    
    
     function save_icsi_medicines($request) {
        $insert_data = array(
            'case_id' => $request->case_id,
            'sop_hcg_ing_trigger_date_time' => $request->sop_hcg_ing_trigger_date_time,
            'rmo_name' => $request->rmo_name,
            'reception_informed' => $request->reception_informed,
            'pt_instruction' => $request->pt_instruction,
            'real_time_video_sent_to_sir' => $request->real_time_video_sent_to_sir
        );
        
        $main_record = DB::table('ivf_icsi_medicine')->where('case_id', $request->case_id)->first();
        
        if($main_record) {
            DB::table('ivf_icsi_medicine')->where('id', $main_record->id)->update($insert_data);  
        } else {
            DB::table('ivf_icsi_medicine')->insert($insert_data);    
        }
        
        //================================= start ===================================
        if(!empty($request->icsi_medicine_old_id)) {
            foreach($request->icsi_medicine_old_id as $icsi_medicine_key => $icsi_medicine_row) {
                if($request->medicine_name[$icsi_medicine_key] || $request->time[$icsi_medicine_key] || $request->batch_number[$icsi_medicine_key] || $request->ivf_icsi_medicine_mi[$icsi_medicine_key]) {
                    
                    $ovary_insert_data = array(
                        'case_id' => $request->case_id,
                        'medicine_name' => $request->medicine_name[$icsi_medicine_key],
                        'time' => $request->time[$icsi_medicine_key],
                        'batch_number' => $request->batch_number[$icsi_medicine_key],
                        'expiry_date' => $request->expiry_date[$icsi_medicine_key]
                    );
                    
                    //echo "=>>>>> <pre>"; print_r($ovary_insert_data); exit;
                    
                    if($icsi_medicine_row) {
                        DB::table('ivf_icsi_medicine_details')->where('id', $icsi_medicine_row)->update($ovary_insert_data);  
                    } else {
                        DB::table('ivf_icsi_medicine_details')->insert($ovary_insert_data);    
                    }
                }
            } 
        }
        
        if(isset($request->icsi_medicine_all_old_id)) {
            //$icsi_medicine_all_old_id_arr = explode(',', $request->icsi_medicine_all_old_id);
            
            foreach($request->icsi_medicine_all_old_id as $icsi_medicine_all_old_id_val) {
                
                if($icsi_medicine_all_old_id_val != "" && !in_array($icsi_medicine_all_old_id_val, $request->icsi_medicine_old_id)) {
                    DB::table('ivf_icsi_medicine_details')->where('id', $icsi_medicine_all_old_id_val)->delete();  
                }
            }
        }
        //echo "============".__LINE__; exit;
        //================================= end ===================================
     }
    
    
    
     /*
    public function ivf_od(Request $request, $id) {
        $ivf_type = 'od';
        
        $main_details = DB::table('ivf_od_ed_eft')->where('case_id', $id)->where('ivf_type', $ivf_type)->first();
        
        $ivf_agonist_data = DB::table('ivf_agonist_data')->where('reference_id', $main_details->id)->get();
        
        $ivf_menses_data = DB::table('ivf_menses_data')->where('reference_id', $main_details->id)->get();
        
        $ivf_menses_dosage_data = [];
        foreach($ivf_menses_data as $ivf_menses_data_row) {
            
             
            $ivf_menses_dosage_data_result = DB::table('ivf_menses_dosage_data')->where('reference_id', $ivf_menses_data_row->id)->get();
            
            foreach($ivf_menses_dosage_data_result as $ivf_menses_dosage_data_row) {
                if($ivf_menses_dosage_data_row->medicine != "" && $ivf_menses_dosage_data_row->duration != "" && $ivf_menses_dosage_data_row->time != "") {
                    $ivf_menses_dosage_data[$ivf_menses_data_row->id][] = array(
                        'medicine' => $ivf_menses_dosage_data_row->medicine,
                        'duration' => $ivf_menses_dosage_data_row->duration,
                        'time'     => $ivf_menses_dosage_data_row->time
                    );
                }
            }
        }
        
        $casedata = $this->getCaseData($id);
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        return view('ivf.ivf_od', compact('casedata', 'form_dropdowns', 'main_details', 'ivf_agonist_data', 'ivf_menses_data', 'ivf_menses_dosage_data', 'ivf_type'));
    }
    */
    
    
     
    
    
    function remove_agonist($id) {
        DB::table('ivf_agonist_data')->where('id', $id)->delete();
        
        echo 1;
    }
    //============================================================================================

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

