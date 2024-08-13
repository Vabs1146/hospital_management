<?php

namespace App\helperClass;

use Carbon\Carbon;
use App\doctor;
use App\Case_master;
use App\prescription_list;
use App\case_number_generators;
use App\Image_gallery;
use App\Medical_store;
use App\Setting;
use DB;
use Auth;
use App\IpdPatientsDropdowns;

class drAppHelper{


    public function createCaseNumber()
    {
        $case_number_ge = new case_number_generators;
        $case_number_ge->save();
        $case_number_ge->case_number = "p_".sprintf('%08d', $case_number_ge->id);
        $case_number_ge->save();
        return $case_number_ge;
    }

    public function GetLetterHeadImageUrl(){
        $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
        $logoUrl='';
        if(!is_null($image_gallery) && isset($image_gallery->imgUrl) && $image_gallery->isActive == '1'){
            $logoUrl=$image_gallery->imgUrl;
        }
        return $logoUrl;
    }

    public function GetLetterFooterImageUrl(){
        $image_gallery = Image_gallery::where('imgTypeId', 5)->first();
        $FooterUrl='';
        if(!is_null($image_gallery) && isset($image_gallery->imgUrl)){
            $FooterUrl=$image_gallery->imgUrl;
        }
        return $FooterUrl;
    }
    
    public function GetDentistLetterHeadImageUrl(){
        $image_gallery = Image_gallery::where('imgTypeId', 11)->first();
        $logoUrl='';
        if(!is_null($image_gallery) && isset($image_gallery->imgUrl) && $image_gallery->isActive == '1'){
            $logoUrl=$image_gallery->imgUrl;
        }
        return $logoUrl;
    }

    public function GetDentistLetterFooterImageUrl(){
        $image_gallery = Image_gallery::where('imgTypeId', 12)->first();
        $FooterUrl='';
        if(!is_null($image_gallery) && isset($image_gallery->imgUrl)){
            $FooterUrl=$image_gallery->imgUrl;
        }
        return $FooterUrl;
    }

    public function getCaseData($id)
    {
        
        $case_master = Case_master::findOrFail($id);
        
        //dd($case_master);
        
        //$medicinlist = Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get();
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $casedata = [
                    'id'=>$case_master->id,
                    //'medicinlist' => $medicinlist,
                    'prescriptions' =>  prescription_list::where('case_id', $case_master->id)->get(),
                    'DateWiseRecordLst' => $DateWiseRecordLst,
                    'case_number' => $case_master->case_number,//'p_00000001'
                    'patient_name' => $case_master->patient_name,
            
                    'mr_mrs_ms' => $case_master->mr_mrs_ms,
                    'middle_name' => $case_master->middle_name,
                    'last_name' => $case_master->last_name,
            
                    'doctor_id' => $case_master->doctor_id,
                    'doctor_name' => (!is_null($case_master->doctor) && !empty($case_master->doctor))?$case_master->doctor->doctor_name:'',
                    'patient_age' => $case_master->patient_age,
                    'patient_weight' => $case_master->patient_weight,
                    'patient_height' => $case_master->patient_height,
                    'infection' => $case_master->infection,
                    'miscellaneous_history' => $case_master->miscellaneous_history,
                    'patient_address' => $case_master->patient_address,
            
                    'area' => $case_master->area,
                    'city' => $case_master->city,
                    'district' => $case_master->district,
            
                    'patient_emailId' => $case_master->patient_emailId,
                    'patient_mobile' => $case_master->patient_mobile,
                    'male_female' => $case_master->male_female,
                    'complaint' => $case_master->complaint,
                    'diagnosis' => $case_master->diagnosis,
                    'treatment' => $case_master->treatment,
                    'diagnosis_file' => $case_master->diagnosis_filePath,
                    'appointment_dt' => ($case_master->FollowUpDate != null)? $case_master->FollowUpDate: null,
                    'appointment_timeslot' => $case_master->FollowUpTimeSlot,
                    'FollowUpDoctor_id' => $case_master->FollowUpDoctor_Id,
                    'Reports_file' => $case_master->Report_file()->get(),
                    'Before_file' => $case_master->BeforeImagePath,
                    'After_file' => $case_master->AfterImagePath,
                    'field_type_memory' => null,
                    'field_type_data' => null,
                    'visit_time' => $case_master->visit_time,
                    'casehistory_followup_notes' => $case_master->casehistory_followup_notes
                    ];
        
       // dd($casedata);
            return $casedata;
    }

    public function getPatientFormByDoctorId($doctor_id){
        //redirect logic based upon doctory type.
        $viewName = 'patientDetails.casHisFemale';
        $doctor_form_mapping = doctor::where('id', $doctor_id)->first();
        if(!is_null($doctor_form_mapping) && !empty($doctor_form_mapping) && !empty($doctor_form_mapping->formViewName)){
            if(view()->exists($doctor_form_mapping->formViewName)){
                $viewName = $doctor_form_mapping->formViewName;
            }
        }
        return $viewName;
    }

    public function getDoctorList(){
        return doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
    }

    public function getMedicineList(){
        $medicinlist = Medical_store::where('isactive', 1)->orderBy('created_dt', 'desc')->pluck('medicine_name','id');
        return $medicinlist;
    }

    function compress($source, $destination, $quality) {
        //Ref:- https://www.apptha.com/blog/how-to-reduce-image-file-size-while-uploading-using-php-code/
		$info = getimagesize($source);

		if (strtolower($info['mime']) == 'image/jpeg') 
			$image = imagecreatefromjpeg($source);

		elseif (strtolower($info['mime']) == 'image/gif') 
			$image = imagecreatefromgif($source);

		elseif (strtolower($info['mime']) == 'image/png') 
			$image = imagecreatefrompng($source);

        imagejpeg($image, $destination, $quality);

		return $destination;
	}

		function displaywords($number) {
    $no = round($number);
    $decimal = round($number - ($no = floor($number)), 2) * 100;    
    $digits_length = strlen($no);    
    $i = 0;
    $str = array();
    $words = array(
        0 => '',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',
        20 => 'Twenty',
        30 => 'Thirty',
        40 => 'Forty',
        50 => 'Fifty',
        60 => 'Sixty',
        70 => 'Seventy',
        80 => 'Eighty',
        90 => 'Ninety');
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_length) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;            
            $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
        } else {
            $str [] = null;
        }  
    }
    
    $Rupees = implode(' ', array_reverse($str));
    $paise = ($decimal) ? "And Paise " . ($words[$decimal - $decimal%10]) ." " .($words[$decimal%10])  : '';
    return ($Rupees ? 'Rupees ' . $Rupees : '') . $paise . " Only";
}

function get_patient_full_name($case_id) {
    //$name = DB::select("SELECT CONCAT(`mr_mrs_ms`, ' ', `patient_name`, ' ', `middle_name`, ' ', `last_name`) name FROM case_master a WHERE a.id='".$case_id."'");
    
    
    $name = DB::select("SELECT CONCAT(COALESCE(`mr_mrs_ms`,''), ' ', COALESCE(`patient_name`,''), ' ', COALESCE(`middle_name`,''), ' ', COALESCE(`last_name`,'')) name FROM case_master a WHERE a.id='".$case_id."'");
    
    //dd($name);
    
    return $name[0]->name;
}

function ipd_bill_number($patients_id = "") {
        $all_settings = Setting::all()->keyBy('name');
        
        //dd($all_settings);
        
        $ipd_ipd_bill_prefix        = $all_settings['ipd_ipd_bill_prefix']->value;
        $ipd_ipd_bill_number        = $all_settings['ipd_ipd_bill_number']->value;
        
        $ipd_summary_bill_prefix    = $all_settings['ipd_summary_bill_prefix']->value;
        $ipd_summary_bill_number    = $all_settings['ipd_summary_bill_number']->value;
        
        
        $current_patient = $last_record = DB::table('patients')->where('id', $patients_id)->first();
        $last_ipd_bill_number_record = DB::table('patients')->whereNotNull('ipd_bill_number_used')->orderBy('id', 'DESC')->first();
        $last_ipd_summary_bill_number_record = DB::table('patients')->whereNotNull('ipd_summary_bill_number_used')->orderBy('id', 'DESC')->first();
        
        
        //get_ipd_bill_number
        if($current_patient->ipd_bill_number_used != '') {
            $ipd_bill_number_format = $current_patient->ipd_bill_number_format;
            $ipd_bill_prefix        = $current_patient->ipd_bill_prefix;
            $ipd_bill_number_used   = $current_patient->ipd_bill_number_used;
            
            $ipd_ipd_bill_number_len  = strlen($ipd_bill_number_format);
            
            $response = array(
                'ipd_bill_number' => $ipd_bill_prefix.str_pad($ipd_bill_number_used, $ipd_ipd_bill_number_len, 0, STR_PAD_LEFT),
                'ipd_bill_number_used'     => $ipd_bill_number_used,
                'ipd_bill_number_format'   => $ipd_bill_number_format,
                'ipd_bill_number_prefix'   => $ipd_bill_prefix
            );
        } else {
            if($last_ipd_bill_number_record) {
                $ipd_bill_number_next  = 1 + $last_ipd_bill_number_record->ipd_bill_number_used;

                $ipd_ipd_bill_number_len  = strlen($ipd_ipd_bill_number);

                if($ipd_ipd_bill_number != $last_ipd_bill_number_record->ipd_bill_number_format) {
                    $ipd_bill_number_next  = $ipd_ipd_bill_number;
                }

                $response = array(
                  'ipd_bill_number' => $ipd_ipd_bill_prefix.str_pad($ipd_bill_number_next, $ipd_ipd_bill_number_len, 0, STR_PAD_LEFT),
                  'ipd_bill_number_used'     => intval($ipd_bill_number_next),
                  'ipd_bill_number_format'   => $ipd_ipd_bill_number,
                  'ipd_bill_number_prefix'   => $ipd_ipd_bill_prefix
                );
            } else {
                $response = array(
                  'ipd_bill_number' => $ipd_ipd_bill_prefix.$ipd_ipd_bill_number,
                  'ipd_bill_number_used'     => intval($ipd_ipd_bill_number),
                  'ipd_bill_number_format'   => $ipd_ipd_bill_number,
                  'ipd_bill_number_prefix'   => $ipd_ipd_bill_prefix
                );
            }
        }
        
        //dd($response);
        
        return $response;
    }

function ipd_summary_bill_number($patients_id = "") {
        $all_settings = Setting::all()->keyBy('name');
        
        $prefix         = $all_settings['ipd_summary_bill_prefix']->value;
        $number_format  = $all_settings['ipd_summary_bill_number']->value;     
	
	
        $ipd_summary_bill_number_len  = strlen($number_format);
        
        $current_patient = $last_record = DB::table('patients')->where('id', $patients_id)->first();
        
        $last_ipd_summary_bill_number_record = DB::table('patients')->whereNotNull('ipd_summary_bill_number_used')->orderBy('id', 'DESC')->first();
        
        
        //get_ipd_bill_number
        if($current_patient->ipd_summary_bill_number_used != '') {
            $ipd_summary_bill_number_format = $current_patient->ipd_summary_bill_number_format;
            $ipd_summary_bill_prefix        = $current_patient->ipd_summary_bill_prefix;
            $ipd_summary_bill_number_used   = $current_patient->ipd_summary_bill_number_used;
            
            $ipd_summary_bill_number_len  = strlen($ipd_summary_bill_number_format);
            
            $response = array(
                'ipd_summary_bill_number' => $ipd_summary_bill_prefix.str_pad($ipd_summary_bill_number_used, $ipd_summary_bill_number_len, 0, STR_PAD_LEFT),
                'ipd_summary_bill_number_used'     => $ipd_summary_bill_number_used,
                'ipd_summary_bill_number_format'   => $ipd_summary_bill_number_format,
                'ipd_summary_bill_prefix'   => $ipd_summary_bill_prefix
            );
        } else {
            if($last_ipd_summary_bill_number_record) {
                $ipd_summary_bill_number_next  = 1 + $last_ipd_summary_bill_number_record->ipd_summary_bill_number_used;

                $ipd_summary_bill_number_len  = strlen($number_format);

                if($number_format != $last_ipd_summary_bill_number_record->ipd_summary_bill_number_format) {
                    $ipd_summary_bill_number_next  = $number_format;
                }

                $response = array(
                  'ipd_summary_bill_number' => $prefix.str_pad($ipd_summary_bill_number_next, $ipd_summary_bill_number_len, 0, STR_PAD_LEFT),
                  'ipd_summary_bill_number_used'     => intval($ipd_summary_bill_number_next),
                  'ipd_summary_bill_number_format'   => $number_format,
                  'ipd_summary_bill_prefix'   => $prefix
                );
            } else {
                $response = array(
                  'ipd_summary_bill_number' => $prefix.$number_format,
                  'ipd_summary_bill_number_used'     => intval($number_format),
                  'ipd_summary_bill_number_format'   => $number_format,
                  'ipd_summary_bill_prefix'   => $prefix
                );
            }
        }
        
        return $response;
    }
    
    function get_hospital_name() {
        $all_settings = Setting::where('name', 'ipd_hospital_name')->first();
        
        return ($all_settings) ? $all_settings->value : '';
      
    }
    
    function get_advertisement() {
     return $advertisement = IpdPatientsDropdowns::where('type', 'advertisement')->first();
    }
    
    function get_all_settings() {
        $all_settings = Setting::all()->keyBy('name');
        
        //dd($all_settings);
        
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();
        
        foreach($payment_modes as $payment_modes_row) {
            $all_payment_modes[$payment_modes_row->id] = $payment_modes_row->name;
        }
        
        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        
        foreach($ipd_ward_types as $ipd_ward_type) {
            $all_wards[$ipd_ward_type->id] = $ipd_ward_type->name;
        }
        
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        
        foreach($ipd_bed_numbers as $ipd_bed_number) {
            $all_beds[$ipd_bed_number->id] = $ipd_bed_number->name;
        }
        
        $ipd_particulars_result = IpdPatientsDropdowns::where('type', 'ipd_particulars')->get();
        
        $ipd_doctors = IpdPatientsDropdowns::where('type', 'ipd_doctor')->get();
        
        foreach($ipd_doctors as $ipd_doctor) {
            $all_docotrs[$ipd_doctor->id] = $ipd_doctor->name;
        }
        
        $ipd_particulars_all = [];
        foreach($ipd_particulars_result as $ipd_particulars_row) {
            $ipd_particulars_all[$ipd_particulars_row->id] = $ipd_particulars_row->name;
            if($ipd_particulars_row->parent == 0) {
                $ipd_particulars[$ipd_particulars_row->id]['name'] = $ipd_particulars_row->name;
            } else {
                $ipd_particulars[$ipd_particulars_row->parent]['childs'][] = ['id' => $ipd_particulars_row->id, 'name' => $ipd_particulars_row->name, 'value' => $ipd_particulars_row->value];
            }
        }
        
        $data = [
            'all_settings' => $all_settings,
            'payment_modes' => $payment_modes,
            'all_payment_modes' => $all_payment_modes,
            'ipd_ward_types' => $ipd_ward_types,
            'all_wards' => $all_wards,
            'ipd_bed_numbers' => $ipd_bed_numbers,
            'all_beds' => $all_beds,
            'ipd_particulars' => $ipd_particulars,
            'ipd_particulars_all' => $ipd_particulars_all,
            'ipd_doctors' => $ipd_doctors,
            'all_docotrs' => $all_docotrs,
        ];
        
        return $data;
    }
    
    function receipt_numbers($patients_id = "") {
        $all_settings = Setting::all()->keyBy('name');
        
        //$advance_receipt_number     = $all_settings['ipd_advance_receipt_number']->value;
        $payment_receipt_number     = $all_settings['ipd_payment_receipt_number']->value;
        
        $last_record = DB::table('patient_payments')->where('type', 'bill_payment')->orderBy('id', 'DESC')->first();
        
        if($last_record) {            
            //$ipd_ipd_number_next  = 1 + $last_record->ipd_number_used;
            $payment_receipt_number_next = 1 + intval($last_record->receipt_number);
            
            $payment_receipt_number_len  = strlen($payment_receipt_number);
                                
            $recipt_number = str_pad($payment_receipt_number_next, $payment_receipt_number_len, 0, STR_PAD_LEFT);
        } else {
            $recipt_number = $payment_receipt_number;
        }
        
        return $recipt_number;
    }
    
    function format_date_time($date) {
        return date('d/m/Y h:i A', strtotime(str_replace(' - ', '', $date)));
    }
    
    function format_date($date) {
        return date('d/m/Y ', strtotime($date));
    }
}