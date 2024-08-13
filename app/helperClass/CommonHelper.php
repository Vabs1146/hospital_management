<?php 
namespace App\helperClass;

use DB;
use Auth;
use App\Setting;

class CommonHelper{

    public function checkUserAccess($section, $userId, $permission_type = "listing_permission"){
        $access = 0;
        //$accesslevel = DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$userId' AND section.sectionname='$section'");
        /*
        $accesslevel = DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$userId' AND section.sectionname='$section'");
        
        if(!empty($accesslevel)){
            foreach ($accesslevel as $value) {
                $access = $value->accesslevel;
            }
        }
        //return $access;
        */
        
        //echo "SELECT user_permission.* FROM `user_permission` LEFT JOIN menu_section ON menu_section.sectionid=user_permission.section_id  WHERE user_permission.user_id='$userId' AND menu_section.sectionname='$section'"; //exit;

        $sql = "SELECT user_permission.* FROM `user_permission` LEFT JOIN menu_section ON menu_section.sectionid=user_permission.section_id  WHERE user_permission.user_id='$userId' AND menu_section.sectionname='$section'";
        
        $accesslevel = DB::select($sql);
        
        if($permission_type == "print_permission") {
            //echo "=========>>>>>>>> <pre>"; print_r($accesslevel);
            //echo $sql; exit;
        }

       // dd($accesslevel);
        if(!empty($accesslevel) && isset($accesslevel[0]->{$permission_type}) && $accesslevel[0]->{$permission_type} == '1'){
            $access = 1;
        } else {
            
        }
        
        if(AUTH::user()->role == 1) {
            $access = 1;
        }
        //echo "=====".$accesslevel[0]->{$permission_type}."======= : ".$access; exit;
        return $access;
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
        
        dd($response);
        
        return $response;
    }
    
    function ipd_summary_bill_number($patients_id = "") {
        $all_settings = Setting::all()->keyBy('name');
        
        $prefix         = $all_settings['ipd_summary_bill_prefix']->value;
        $number_format  = $all_settings['ipd_summary_bill_number']->value;        
        
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
                  'ipd_summary_bill_number' => $prefix.str_pad($ipd_bill_number_next, $ipd_ipd_bill_number_len, 0, STR_PAD_LEFT),
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
}