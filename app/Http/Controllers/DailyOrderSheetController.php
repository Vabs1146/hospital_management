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

class DailyOrderSheetController extends AdminRootController
{
	public function __construct()
    {
            //echo "============>>>>>> <pre>".__LINE__; print_r([]); exit;
        $this->acc=0;
        $this->commonHelper = new CommonHelper();
    }


    public function add(Request $request, $registration_id)
    {

        $registration_data = DB::table('patients')->where('id', $registration_id)->first();

       $daily_order_sheet_record = DB::table('daily_order_sheet')->where('registration_id', $registration_id)->first();
       
       //dd($daily_order_sheet_record);
       
       if($daily_order_sheet_record) {
            $daily_order_sheet_data = DB::table('daily_order_sheet_data')->where('daily_order_sheet_id', $daily_order_sheet_record->id)->get();
       } else {
            $daily_order_sheet_data = [];
       }
       
       //dd($daily_order_sheet_data);
        return view('daily_order_sheet.add', compact('registration_data', 'daily_order_sheet_record', 'daily_order_sheet_data', 'registration_id'));
    }
    
    function save(Request $request, $registration_id = "") {
     //echo "============>>>>>> <pre>".__LINE__; print_r($_POST); exit;
         $insert_data = [
             'registration_id' => $request->registration_id, 
             'date' => $request->date,  
             'created_by' => Auth::user()->id 
        ];
                
        $where = ['registration_id' => $request->registration_id ];

        //echo "<hr>=======>>>>>11111111111>>>>>>> <pre>"; print_r($insert_data); exit;
        DB::table('daily_order_sheet')->updateOrInsert( $insert_data, $where);
        
        $daily_order_sheet_record = DB::table('daily_order_sheet')->where('registration_id', $request->registration_id)->first();
        
           
        //================================= start ===================================
        if(!empty($request->daily_order_sheet_old_id)) {
            
            
            foreach($request->daily_order_sheet_old_id as $key => $row) {
                
                
                if($request->daily_order_sheet_date[$key] != '' || 
                        $request->daily_order_sheet_clinical_notes[$key] != '' || 
                        $request->daily_order_sheet_day[$key] != '' || 
                        $request->daily_order_sheet_treatment_adviced[$key] != '') {
            //echo "============".__LINE__; exit;
                    
                    $insert_data = array(
                        'daily_order_sheet_id' => $daily_order_sheet_record->id,
                        'date' => $request->daily_order_sheet_date[$key],
                        'clinical_notes' => $request->daily_order_sheet_clinical_notes[$key],
                        'day' => $request->daily_order_sheet_day[$key],
                        'treatment_adviced' => $request->daily_order_sheet_treatment_adviced[$key]
                    );
                    
                     
                    if($row) {
                     //echo "<hr>=======>>>>>11111111111>>>>>>> <pre>".__LINE__; print_r($insert_data); exit;
                        DB::table('daily_order_sheet_data')->where('id', $row)->update($insert_data);  
                    } else {
                     //echo "<hr>=======>>>>>11111111111>>>>>>> <pre>".__LINE__; print_r($insert_data); exit;
                        DB::table('daily_order_sheet_data')->insert($insert_data);    
                    }
                }
            } 
        }
        
        if(isset($request->daily_order_sheet_all_old_id)) {
            foreach($request->daily_order_sheet_all_old_id as $daily_order_sheet_all_old_id_val) {
                if($daily_order_sheet_all_old_id_val != "" && !in_array($daily_order_sheet_all_old_id_val, $request->daily_order_sheet_old_id)) {
                    DB::table('daily_order_sheet_data')->where('id', $daily_order_sheet_all_old_id_val)->delete();  
                }
            }
        }
        
        return redirect()->back()->with('flash_message', 'Record added successfully');
       
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

       $daily_order_sheet_record = DB::table('daily_order_sheet')->where('registration_id', $registration_id)->first();
       
       //dd($daily_order_sheet_record);
       
       if($daily_order_sheet_record) {
            $daily_order_sheet_data = DB::table('daily_order_sheet_data')->where('daily_order_sheet_id', $daily_order_sheet_record->id)->get();
       } else {
            $daily_order_sheet_data = [];
       }
       
       
       //dd($daily_order_sheet_data);
       
       $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();
        
       
        return view('daily_order_sheet.print', compact('registration_data', 'daily_order_sheet_record', 'daily_order_sheet_data', 'registration_id', 'logoUrl', 'FooterUrl'));
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

