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
use App\Opd_bill;
use App\Bill_detail;
use App\Case_master;
use App\Image_gallery;
use App\doctor;
use DB;
use App\helperClass\drAppHelper;
use Auth;
use App\Helpers\Helpers;
use App\helperClass\CommonHelper;

use App\PaymentModes;
use App\FeesDetails;
use App\User;
use App\Setting;
use App\Models\form_dropdowns;

class IpdReportsController extends AdminRootController
{
    //

 public function __construct()
    {        
        $this->acc=0;
        $this->commonHelper = new CommonHelper();
    }
    
   
//=========================================================================================================================
//========================================================================================================
    #region Doctor bill report
    public function ipdViewReport(Request $request) {
        
        
       // $ipd_particulars_records = DB::table('ipd_patients_particulars')->where('registration_id',$registration_id)->where('status', '1')->get();
        
        // $ipd_particulars_records = DB::table('ipd_patients_particulars')->where('status', '1')->get();
        
        //echo "====>>>>>>>>>>>> <pre>"; print_r($ipd_particulars_records); exit;
        //
		//echo "============== : ".__LINE__; exit;
        //$doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
        
        
        
        

      $user = Auth::user()->id;
        $doctor=DB::select("SELECT * FROM `doctors` ORDER BY `doctor_name` ASC");
        
        $this->acc = $this->commonHelper->checkUserAccess("1_bill_details",Auth::user()->id);
        if ($this->acc == 1) { 
            $all_users_array = []; $payment_modes_array = []; $fees_details_array = [];
            $payment_modes = PaymentModes::all();

            foreach($payment_modes as $payment_modes_row) {
                    $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
            }
            $fees_details = [];
            //$fees_details = FeesDetails::all();

            $fees_details = DB::table('bill_details')->get();

            foreach($fees_details as $fees_details_row) {
                    //$fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
                    $fees_details_array[$fees_details_row->bill_item] = $fees_details_row->bill_item;
            }

            //echo "=====>>>>>> <pre>"; print_r($fees_details_array); exit;

            $all_users = User::all();
 $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();

            foreach($all_users as $all_users_row) {
                    $all_users_array[$all_users_row->id] = $all_users_row->name;
            }
            $defaultValues = [];
            return view('new_ipd_bill_reports.ipdViewReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array','form_dropdowns','defaultValues'));
        } else {
         $url= url()->previous();
           return redirect($url);
        }
    }
    
    
    public function get_advance_and_discount($registration_id) {
        $patientbill = DB::table('patients_ipd_patient_bill')->where('registration_id', $registration_id)->first();
        $payment_records = DB::table('patient_payments')->where('registration_id', $registration_id)->where('status', '1')->get();
        $total_payment = 0;        
        foreach($payment_records as $payment_records_row) {
            $total_payment += $payment_records_row->advance_amount;
        } 
        
       return ['disocunt' => isset($patientbill->discount_amount) ? $patientbill->discount_amount: 0, 'total_payment' => $total_payment];
    }
    
    public function ipdViewReportGrid(Request $request) {
        $len = $_GET['length'];
        $start = $_GET['start'];
        
        $select = "SELECT date(p.admission_date_time) as `Date`, p.ipd_summary_bill_number, CONCAT(p.first_name,' ',p.middle_name,' ', p.last_name ) as patient_name, ";
        
        $select .= " IF(ipp_t1.bill_total, ipp_t1.bill_total, 0) as bill_total, IF(pipb.discount_amount, pipb.discount_amount, 0) as discount_amount, IF(pp_t1.total_payment, pp_t1.total_payment, 0) as total_payment,  p.id as patient_id, p.id as patient_id ";
        
$presql = " FROM `patients` p LEFT JOIN (SELECT registration_id, SUM(total_amount) as bill_total FROM ipd_patients_particulars GROUP BY registration_id) as ipp_t1  ON ipp_t1.registration_id = p.id LEFT JOIN (SELECT registration_id, SUM(advance_amount) as total_payment FROM patient_payments GROUP BY registration_id) as pp_t1  ON pp_t1.registration_id = p.id LEFT JOIN patients_ipd_patient_bill as pipb  ON pipb.register_id = p.id ";
        
        $presql .= " WHERE p.admission_date_time IS NOT NULL ";
        
        $logged_user = Auth::user()->id;
        $presql .= "AND p.created_by = '".$logged_user."' ";
        
         //===========================================================
        if ($_GET['columns'][1]['search']['value']) {
            $fromDate =  $_GET['columns'][1]['search']['value'];
            $presql .= "and date(p.admission_date_time) >='".$fromDate."' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
            //$fromDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][2]['search']['value'])->format('Y-m-d');
            $toDate =  $_GET['columns'][2]['search']['value'];
            $presql .= "and date(p.admission_date_time) <='".$toDate."' ";
        }
        //================================================================
        
        $orderByStr = " order by 1 desc";
        
        if( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ){
            $orderColum = intval( $_GET['order'][0]['column'] )+1;
            $orderByStr = " order by ". $orderColum . " " . $_GET['order'][0]['dir'];
        }


        $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;
        
        $qcount = DB::select("SELECT COUNT(p.id) c".$presql);
        //print_r($qcount);
        $count = $qcount[0]->c;

        $results = DB::select($sql);
        $ret = [];
        $case_id = "";
        $cnt = 1;
        
        foreach ($results as $key => $row) {
           
            $r = [];
            foreach ($row as $value) {
                $r[] = $value;
            }
            $ret[] = $r;
        }

        $ret['data'] = $ret;
        $ret['recordsTotal'] = $count;
        $ret['iTotalDisplayRecords'] = $count;

        $ret['recordsFiltered'] = count($ret);
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }
    
    //-------------------------------------------------------------------------------------------------------
     #region Doctor bill report
    public function ipdBillPaymentReport(Request $request) {
		//echo "============== : ".__LINE__; exit;
        //$doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

      $user = Auth::user()->id;
        $doctor=DB::select("SELECT * FROM `doctors` ORDER BY `doctor_name` ASC");
        
        $this->acc = $this->commonHelper->checkUserAccess("1_bill_details",Auth::user()->id);
        if ($this->acc == 1) { 
            $all_users_array = []; $payment_modes_array = []; $fees_details_array = [];
            $payment_modes = PaymentModes::all();

            foreach($payment_modes as $payment_modes_row) {
                    $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
            }
            $fees_details = [];
            //$fees_details = FeesDetails::all();

            $fees_details = DB::table('bill_details')->get();

            foreach($fees_details as $fees_details_row) {
                    //$fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
                    $fees_details_array[$fees_details_row->bill_item] = $fees_details_row->bill_item;
            }

            //echo "=====>>>>>> <pre>"; print_r($fees_details_array); exit;

            $all_users = User::all();
 $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();

            foreach($all_users as $all_users_row) {
                    $all_users_array[$all_users_row->id] = $all_users_row->name;
            }
            $defaultValues = [];
            return view('new_ipd_bill_reports.ipdPaymentReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array','form_dropdowns','defaultValues'));
        } else {
         $url= url()->previous();
           return redirect($url);
        }
    }
    
    public function ipdBillPaymentReportGrid(Request $request) {
        
        $len = $_GET['length'];
        $start = $_GET['start'];
        
        $select = "SELECT p.ipd_summary_bill_number, CONCAT(p.first_name,' ',p.middle_name,' ', p.last_name ) as patient_name, pp.date_time, pp.advance_amount, ipd.name, pp.payment_id_number";
        
        $presql = " FROM `patient_payments` pp LEFT JOIN ipd_patients_dropdowns as ipd ON ipd.id = pp.payment_mode ";
         
        $presql .=  "LEFT JOIN patients p ON pp.registration_id = p.id ";
        
        $presql .= " WHERE pp.date_time IS NOT NULL ";
        
         //===========================================================
        if ($_GET['columns'][1]['search']['value']) {
            $fromDate =  $_GET['columns'][1]['search']['value'];
            $presql .= "and date(pp.date_time) >='".$fromDate."' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
            //$fromDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][2]['search']['value'])->format('Y-m-d');
            $toDate =  $_GET['columns'][2]['search']['value'];
            $presql .= "and date(pp.date_time) <='".$toDate."' ";
        }
        //================================================================
        
        $orderByStr = " order by 1 desc";
        
        if( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ){
            $orderColum = intval( $_GET['order'][0]['column'] )+1;
            $orderByStr = " order by ". $orderColum . " " . $_GET['order'][0]['dir'];
        }


        $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;
        
        $qcount = DB::select("SELECT COUNT(pp.id) c".$presql);
        //print_r($qcount);
        $count = $qcount[0]->c;

        $results = DB::select($sql);
        $ret = [];
        $case_id = "";
        $cnt = 1;
        
        foreach ($results as $key => $row) {
           
            $r = [];
            foreach ($row as $value) {
                $r[] = $value;
            }
            $ret[] = $r;
        }

        $ret['data'] = $ret;
        $ret['recordsTotal'] = $count;
        $ret['iTotalDisplayRecords'] = $count;

        $ret['recordsFiltered'] = count($ret);
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
        
        /*
        
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT "
            . "date(b.created_at) as `Date`, "
            . "b.case_number, "
            . "b.IPD_no, "
            //. "u.name, "
            . "CONCAT(COALESCE(b.`mr_mrs_ms`,''), ' ', COALESCE(b.`patient_name`,''), ' ', COALESCE(b.`middle_name`,''), ' ', COALESCE(b.`last_name`,'')),"
            . "doctors.doctor_name,"
            . "u2.name, "
            . "b.bill_number, "
            . "IF(a.sub_total, a.sub_total, 0) as sub_total, "
            . "IF(a.advance_amount, a.advance_amount, 0) as advance_amount, "
            //. "CONCAT(eyeform.advance_date,'/',advance_payment_mode.name) as advance_details, "

            . "CONCAT(advance_payment_mode.name,' / ', date_format(eyeform.advance_date, '%d-%m-%Y')) as advance_details, "        
            . "IF(a.discount_amount, a.discount_amount, 0) as discount_amount, "
            . "(IF(a.sub_total, a.sub_total, 0) - IF(a.advance_amount, a.advance_amount, 0) - IF(a.discount_amount, a.discount_amount, 0)) as total_payment, "
            . "IF(ibp.paid_amount, ibp.paid_amount, 0) as paid_amount , "
            . "pm.name as payment_modes_name, "
                . "(IF(a.sub_total, a.sub_total, 0) - IF(a.advance_amount, a.advance_amount, 0) - IF(a.discount_amount, a.discount_amount, 0)) as total_amount_paid, "
            . "(IF(a.sub_total, a.sub_total, 0) - IF(a.advance_amount, a.advance_amount, 0) - IF(a.discount_amount, a.discount_amount, 0) - IF(paid_tb.paid_amount_total, paid_tb.paid_amount_total, 0)) as remaining_balance, "
            
            . "a.case_id as case_id";
        
        $presql = " FROM "
                . "insurance_bill a "
                . "join ipd_bill_payments ibp on ibp.case_id = a.case_id "
                . "INNER join case_master b on a.case_id = b.id "
                . "LEFT join eyeform on eyeform.case_id = b.id "
                . "LEFT JOIN payment_modes pm ON pm.id= ibp.payment_mode "
                . "LEFT JOIN payment_modes advance_payment_mode ON advance_payment_mode.id= eyeform.advance_payment_type "
                . "LEFT JOIN (select SUM(paid_amount) as paid_amount_total, case_id from ipd_bill_payments group by case_id) paid_tb on b.id =paid_tb.case_id "                
                . "LEFT JOIN doctors ON doctors.id=b.doctor_id "
                . "LEFT JOIN users u ON u.id=a.created_by " 
                . "LEFT JOIN users u2 ON u2.id=ibp.created_by "; 
        
        $presql .= " WHERE b.is_ipd='1' and b.is_deleted = 0";
        
        $presql .= "  ";
        $orderByStr = " order by 1 desc";
        
        if( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ){
            $orderColum = intval( $_GET['order'][0]['column'] )+1;
            $orderByStr = " order by ". $orderColum . " " . $_GET['order'][0]['dir'];
        }


        $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;
        
        $qcount = DB::select("SELECT COUNT(a.id) c".$presql);
        //print_r($qcount);
        $count = $qcount[0]->c;
//dd($sql);
        $results = DB::select($sql);
        $ret = [];
        $case_id = "";
        $cnt = 1;
        if(!empty($results)) {
           
            $prev_case_id = "";
            
            $total_paid = 0;
            //echo "======== <pre>"; print_r($results); exit;
            foreach ($results as $key => $row) {

                $r = [];
                foreach ($row as $value) {
                    $r[] = $value;
                }

                if($prev_case_id == $row->case_id) {
                    $r[0] = '';
                    $r[1] = '';
                    $r[2] = '';
                    $r[3] = '';
                    $r[4] = '';
                    $r[5] = '';
                    $r[6] = '';
                    $r[7] = '';
                    $r[8] = '';
                    
                    $r[9] = '';
                    $r[10] = '';
                    $r[11] = '';
                }
               
                    if((isset($results[$key+1]) && $results[$key+1]->case_id == $row->case_id)) {
                        $r[14] = '';
                        
                        $total_paid += $r[12];
                        
                    } else {
                        $r[14] = $total_paid + $r[12];
                        
                        $total_paid = 0;
                    }
               

                $prev_case_id = $row->case_id;
                $ret[] = $r;
            }
            //==================================================================================
        }
        
        $ret['data'] = $ret;
        $ret['recordsTotal'] = $count;
        $ret['iTotalDisplayRecords'] = $count;

        $ret['recordsFiltered'] = count($ret);
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
        */
    }
    
    //---------------------------------------------------------------------------------------------------------
    
     #region Doctor bill report
    public function ipdBillBalanceReport(Request $request) {
		//echo "============== : ".__LINE__; exit;
        //$doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

      $user = Auth::user()->id;
        $doctor=DB::select("SELECT * FROM `doctors` ORDER BY `doctor_name` ASC");
        
        $this->acc = $this->commonHelper->checkUserAccess("1_bill_details",Auth::user()->id);
        if ($this->acc == 1) { 
            $all_users_array = []; $payment_modes_array = []; $fees_details_array = [];
            $payment_modes = PaymentModes::all();

            foreach($payment_modes as $payment_modes_row) {
                    $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
            }
            $fees_details = [];
            //$fees_details = FeesDetails::all();

            $fees_details = DB::table('bill_details')->get();

            foreach($fees_details as $fees_details_row) {
                    //$fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
                    $fees_details_array[$fees_details_row->bill_item] = $fees_details_row->bill_item;
            }

            //echo "=====>>>>>> <pre>"; print_r($fees_details_array); exit;

            $all_users = User::all();
 $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();

            foreach($all_users as $all_users_row) {
                    $all_users_array[$all_users_row->id] = $all_users_row->name;
            }
            $defaultValues = [];
            return view('new_ipd_bill_reports.ipdBalanceReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array','form_dropdowns','defaultValues'));
        } else {
         $url= url()->previous();
           return redirect($url);
        }
    }
    
    public function ipdBillBalanceReportGrid(Request $request) {
        $len = $_GET['length'];
        $start = $_GET['start'];
        
        $select = "SELECT date(p.admission_date_time) as `Date`, p.ipd_summary_bill_number, CONCAT(p.first_name,' ',p.middle_name,' ', p.last_name ) as patient_name, ";
        
        $select .= " IF(ipp_t1.bill_total, ipp_t1.bill_total, 0) as bill_total, IF(pipb.discount_amount, pipb.discount_amount, 0) as discount_amount, IF(pp_t1.total_payment, pp_t1.total_payment, 0) as total_payment, (bill_total - discount_amount - total_payment) as balance,  p.id as patient_id, p.id as patient_id";
        
$presql = " FROM `patients` p LEFT JOIN (SELECT registration_id, SUM(total_amount) as bill_total FROM ipd_patients_particulars GROUP BY registration_id) as ipp_t1  ON ipp_t1.registration_id = p.id LEFT JOIN (SELECT registration_id, SUM(advance_amount) as total_payment FROM patient_payments GROUP BY registration_id) as pp_t1  ON pp_t1.registration_id = p.id LEFT JOIN patients_ipd_patient_bill as pipb  ON pipb.register_id = p.id ";
        
        $presql .= " WHERE p.admission_date_time IS NOT NULL ";
        
        $logged_user = Auth::user()->id;
        $presql .= "AND p.created_by = '".$logged_user."' ";
        
         //===========================================================
        if ($_GET['columns'][1]['search']['value']) {
            $fromDate =  $_GET['columns'][1]['search']['value'];
            $presql .= "and date(p.admission_date_time) >='".$fromDate."' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
            //$fromDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][2]['search']['value'])->format('Y-m-d');
            $toDate =  $_GET['columns'][2]['search']['value'];
            $presql .= "and date(p.admission_date_time) <='".$toDate."' ";
        }
        //================================================================
        
        $orderByStr = " order by 1 desc";
        
        if( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ){
            $orderColum = intval( $_GET['order'][0]['column'] )+1;
            $orderByStr = " order by ". $orderColum . " " . $_GET['order'][0]['dir'];
        }


        $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;
        
        $qcount = DB::select("SELECT COUNT(p.id) c".$presql);
        //print_r($qcount);
        $count = $qcount[0]->c;

        $results = DB::select($sql);
        $ret = [];
        $case_id = "";
        $cnt = 1;
        
        foreach ($results as $key => $row) {
           
            $r = [];
            foreach ($row as $value) {
                $r[] = $value;
            }
            $ret[] = $r;
        }

        $ret['data'] = $ret;
        $ret['recordsTotal'] = $count;
        $ret['iTotalDisplayRecords'] = $count;

        $ret['recordsFiltered'] = count($ret);
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }
}