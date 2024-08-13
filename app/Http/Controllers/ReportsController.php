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

class ReportsController extends AdminRootController
{
    //

    public function __construct()
    {
        $this->acc = 0;
        $this->commonHelper = new CommonHelper();
    }

    public function ViewOnlyOpdReport(Request $request)
    {
        //$doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $user = Auth::user()->id;
        $doctor = DB::select("SELECT * FROM `doctors` ORDER BY `doctor_name` ASC");

        $this->acc = $this->commonHelper->checkUserAccess("1_bill_details", Auth::user()->id);
        if ($this->acc == 1) {
            $all_users_array = [];
            $payment_modes_array = [];
            $fees_details_array = [];
            $payment_modes = PaymentModes::all();

            foreach ($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
            }

            $fees_details_array = FeesDetails::all();

            // foreach ($fees_details as $fees_details_row) {
            //     $fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
            // }

            $all_users = User::all();

            foreach ($all_users as $all_users_row) {
                $all_users_array[$all_users_row->id] = $all_users_row->name;
            }

            return view('bill_details.new_reports.ViewOnlyOpdReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array'));
        } else {
            $url = url()->previous();
            return redirect($url);
        }
    }

    public function onlyOpdReportGrid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];
        DB::enableQueryLog();

        /*   
           $select = "SELECT 
       date(a.created_at) as `Date`, 
       b.case_number, 
       b.patient_name, 
       doctors.doctor_name,
       u.name as user_name, 
       b.bill_number, 
       df.fees_details as billing_category, 
       df.fees_amount,
       b.sub_total,
       b.bill_discount, 
       (b.sub_total - IF (b.bill_discount, b.bill_discount, 0)) as total_payment, 
       b.id as case_id 
   FROM 
       case_master b 
   LEFT join 
       opd_bill a on a.case_id = b.id 
   LEFT join 
       doctor_fees df on df.id = a.bill_item 
   LEFT JOIN  
       doctors ON doctors.id=a.doctor_id 
   LEFT JOIN 
       users u ON u.id=a.created_by "; 
      */

        $select = "SELECT "
            . "date(a.created_at) as `Date`, "
            . "b.case_number, "
            . "CONCAT(COALESCE(b.`mr_mrs_ms`,''), ' ', COALESCE(b.`patient_name`,''), ' ', COALESCE(b.`middle_name`,''), ' ', COALESCE(b.`last_name`,'')) as patient_name, "
            . "doctors.doctor_name,"
            . "u.name as user_name, "
            . "b.bill_number, "
            . "df.fees_details as billing_category, "
            . "df.fees_amount, "
            . "b.sub_total, "
            . "b.bill_discount, "
            . "(b.sub_total - IF (b.bill_discount, b.bill_discount, 0)) as total_payment, "
            . "pm.name as payment_mode";

        $presql = " FROM case_master b LEFT join opd_bill a on a.case_id = b.id LEFT join doctor_fees df on df.id = a.bill_item LEFT JOIN doctors ON doctors.id=a.doctor_id LEFT JOIN users u ON u.id=a.created_by LEFT JOIN payment_modes pm on a.payment_mode = pm.id ";

        $presql .= " WHERE 1=1 and b.is_deleted = 0 and df.fees_amount IS NOT NULL ";//AND b.doctor_id='$docid'";

        if ($_GET['search']['value']) {
            $presql .= " and bill_item LIKE '%" . $_GET['search']['value'] . "%' ";
        }
        if ($_GET['columns'][1]['search']['value']) {
            $presql .= " and b.doctor_id LIKE '%" . $_GET['columns'][1]['search']['value'] . "%' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
            //$fromDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][2]['search']['value'])->format('Y-m-d');
            $fromDate = $_GET['columns'][2]['search']['value'];
            //$presql .= " and a.created_at >= '".$fromDate."' ";
            $presql .= "and date(a.created_at) >='" . $fromDate . "' ";

        }
        if ($_GET['columns'][3]['search']['value']) {
            //$toDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][3]['search']['value'])->format('Y-m-d');
            $toDate = $_GET['columns'][3]['search']['value'];
            //$presql .= " and a.created_at <= '".$toDate."' ";
            $presql .= " and date(a.created_at) <= '" . $toDate . "' ";
        }

        if ($_GET['columns'][4]['search']['value']) {
            $presql .= " and a.bill_item = '" . $_GET['columns'][4]['search']['value'] . "' ";
        }

        if ($_GET['columns'][5]['search']['value']) {
            $presql .= " and a.payment_mode = '" . $_GET['columns'][5]['search']['value'] . "' ";
        }

        if ($_GET['columns'][6]['search']['value']) {
            $presql .= " and a.created_by = '" . $_GET['columns'][6]['search']['value'] . "' ";
        }

        if ($_GET['columns'][7]['search']['value']) {
            $presql .= " and patient_name LIKE '%" . $_GET['columns'][7]['search']['value'] . "%' ";
        }
        $presql .= "  ";

        $orderByStr = " order by 1 desc";
        //$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;

        if (isset($_GET['order'][0]['column']) && is_numeric($_GET['order'][0]['column'])) {
            $orderColum = intval($_GET['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_GET['order'][0]['dir'];
        }

        if ($len > 0) {
            $sql = $select . $presql . $orderByStr . " LIMIT " . $start . "," . $len;
        } else {
            $sql = $select . $presql . $orderByStr;
        }
        //dd($sql);

        $qcount = DB::select("SELECT COUNT(b.id) c " . $presql);

        $count = $qcount[0]->c;

        $results = DB::select($sql);
        $ret = [];

        $query_str = DB::getQueryLog();
        //dd($query_str);

        //dd($results);
        $prev_case_id = "";
        $balance = 0;
        $case_payment_record = 0;

        $prev_case_id = "";
        foreach ($results as $key => $row) {

            // if(isset($results[$key+1]) && $results[$key+1]->case_id != $row->case_id) {
            $r = [];
            foreach ($row as $value) {
                $r[] = $value;
            }

            if (isset($results[$key + 1])) {
                if ($results[$key + 1]->case_id == $row->case_id) {
                    $r[8] = '';
                    $r[9] = '';
                    $r[10] = '';
                }
            }

            $ret[] = $r;

            // }

        }

        /*
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
            }
            if(isset($results[$key+1])) {
                if($results[$key+1]->case_id == $row->case_id) {
                    $r[11] = '';
                }
            } else {
                
            }
            
            $prev_case_id = $row->case_id;
            $ret[] = $r;
        }
        */

        $ret['data'] = $ret;
        $ret['recordsTotal'] = $count;
        $ret['iTotalDisplayRecords'] = $count;

        $ret['recordsFiltered'] = count($ret);
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }

    //=============================================================================================

    public function opdBillPaymentReport(Request $request)
    {
        //$doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $user = Auth::user()->id;
        $doctor = DB::select("SELECT * FROM `doctors` ORDER BY `doctor_name` ASC");

        $this->acc = $this->commonHelper->checkUserAccess("1_bill_details", Auth::user()->id);
        if ($this->acc == 1) {
            $all_users_array = [];
            $payment_modes_array = [];
            $fees_details_array = [];
            $payment_modes = PaymentModes::all();

            foreach ($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
            }

            $fees_details = FeesDetails::all();

            foreach ($fees_details as $fees_details_row) {
                $fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
            }

            $all_users = User::all();

            foreach ($all_users as $all_users_row) {
                $all_users_array[$all_users_row->id] = $all_users_row->name;
            }

            return view('bill_details.new_reports.ViewOpdPaymentReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array'));
        } else {
            $url = url()->previous();
            return redirect($url);
        }
    }

    public function opdBillPaymentReportGrid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];
        DB::enableQueryLog();

        $select = "SELECT "
            . "date(b.created_at) as `Date`, "
            //. "b.case_number, "
            . "b.case_number, "
            . "CONCAT(COALESCE(b.`mr_mrs_ms`,''), ' ', COALESCE(b.`patient_name`,''), ' ', COALESCE(b.`middle_name`,''), ' ', COALESCE(b.`last_name`,'')), "
            . "doctors.doctor_name,"
            . "u.name as user_name, "
            . "b.bill_number, "
            . "b.sub_total, "
            . "b.bill_discount, "
            . "(b.sub_total - IF (b.bill_discount, b.bill_discount, 0)) as total_payment, "
            . "IF (a.paid_Amount, a.paid_Amount, 0) as paid_amount, "
            . "pm.name as payment_modes_name, "
            . "(b.sub_total - IF (b.bill_discount, b.bill_discount, 0)), "
            //. "((b.sub_total - IF (b.bill_discount, b.bill_discount, 0)) - IF (b.paidAmount, b.paidAmount, 0)) as balance, "
            . "b.id as case_id";

        $presql = " FROM case_master b LEFT join opd_bill_payments a on a.case_id = b.id LEFT JOIN  doctors ON doctors.id=b.doctor_id LEFT JOIN payment_modes pm ON pm.id=a.payment_mode LEFT JOIN users u ON u.id=a.created_by ";

        $presql .= " WHERE 1=1 and b.is_deleted = 0 ";//AND b.doctor_id='$docid'";

        if ($_GET['search']['value']) {
            $presql .= " and bill_item LIKE '%" . $_GET['search']['value'] . "%' ";
        }
        if ($_GET['columns'][1]['search']['value']) {
            $presql .= " and b.doctor_id LIKE '%" . $_GET['columns'][1]['search']['value'] . "%' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
            //$fromDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][2]['search']['value'])->format('Y-m-d');
            $fromDate = $_GET['columns'][2]['search']['value'];
            //$presql .= " and a.created_at >= '".$fromDate."' ";
            $presql .= "and date(a.created_at) >='" . $fromDate . "' ";

        }
        if ($_GET['columns'][3]['search']['value']) {
            //$toDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][3]['search']['value'])->format('Y-m-d');
            $toDate = $_GET['columns'][3]['search']['value'];
            //$presql .= " and a.created_at <= '".$toDate."' ";
            $presql .= " and date(a.created_at) <= '" . $toDate . "' ";
        }

        // if ($_GET['columns'][4]['search']['value']) {
        //     $presql .= " and a.bill_item = '" . $_GET['columns'][4]['search']['value'] . "' ";
        // }

        if ($_GET['columns'][5]['search']['value']) {
            $presql .= " and a.payment_mode = '" . $_GET['columns'][5]['search']['value'] . "' ";
        }

        if ($_GET['columns'][6]['search']['value']) {
            $presql .= " and a.created_by = '" . $_GET['columns'][6]['search']['value'] . "' ";
        }

        if ($_GET['columns'][7]['search']['value']) {
            $patient_name_search = $_GET['columns'][7]['search']['value'];

            //"CONCAT(COALESCE(b.`mr_mrs_ms`,''), ' ', COALESCE(b.`patient_name`,''), ' ', COALESCE(b.`middle_name`,''), ' ', COALESCE(b.`last_name`,'')), "
            if ($patient_name_search != "") {
                $presql .= " and (b.`patient_name` LIKE '%" . $patient_name_search . "%' OR b.`middle_name` LIKE '%" . $patient_name_search . "%' OR b.`last_name` LIKE '%" . $patient_name_search . "%') ";
            }
        }
        $presql .= "  ";

        $orderByStr = " order by 1 desc";
        //$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;

        if (isset($_GET['order'][0]['column']) && is_numeric($_GET['order'][0]['column'])) {
            $orderColum = intval($_GET['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_GET['order'][0]['dir'];
        }

        if ($len > 0) {
            $sql = $select . $presql . $orderByStr . " LIMIT " . $start . "," . $len;
        } else {
            $sql = $select . $presql . $orderByStr;
        }


        $qcount = DB::select("SELECT COUNT(b.id) c" . $presql);
        // dd($sql);
        $count = $qcount[0]->c;

        $results = DB::select($sql);
        $ret = [];

        $query_str = DB::getQueryLog();
        //dd($query_str);

        //dd($results);
        $prev_case_id = "";
        $balance = 0;
        $case_payment_record = 0;

        foreach ($results as $key => $row) {

            $r = [];
            foreach ($row as $value) {
                $r[] = $value;
            }
            /*
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
            }
            if(isset($results[$key+1])) {
                if($results[$key+1]->case_id == $row->case_id) {
                    $r[11] = '';
                }
            } else {
                
            }
            
            
            */
            if ($prev_case_id == $row->case_id) {
                $r[0] = '';
                $r[1] = '';
                $r[2] = '';

                $r[3] = '';
                $r[4] = '';
                $r[5] = '';
                /*
                $r[6] = '';
                $r[7] = '';
                $r[8] = '';
                 
                 */
            }

            if (isset($results[$key + 1])) {
                if ($results[$key + 1]->case_id == $row->case_id) {
                    $r[11] = '';
                }
            }

            $prev_case_id = $row->case_id;
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
    //=================================================================================================================================

    public function opdBillBalanceReport(Request $request)
    {
        //$doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $user = Auth::user()->id;
        $doctor = DB::select("SELECT * FROM `doctors` ORDER BY `doctor_name` ASC");

        $this->acc = $this->commonHelper->checkUserAccess("1_bill_details", Auth::user()->id);
        if ($this->acc == 1) {
            $all_users_array = [];
            $payment_modes_array = [];
            $fees_details_array = [];
            $payment_modes = PaymentModes::all();

            foreach ($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
            }

            $fees_details = FeesDetails::all();

            foreach ($fees_details as $fees_details_row) {
                $fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
            }

            $all_users = User::all();

            foreach ($all_users as $all_users_row) {
                $all_users_array[$all_users_row->id] = $all_users_row->name;
            }

            return view('bill_details.new_reports.ViewOpdBalanceReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array'));
        } else {
            $url = url()->previous();
            return redirect($url);
        }
    }

    public function opdBillBalanceReportReportGrid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];
        DB::enableQueryLog();

        $select = "SELECT "
            . "date(b.created_at) as `Date`, "
            //. "b.case_number, "
            . "b.case_number, "
            . "CONCAT(COALESCE(b.`mr_mrs_ms`,''), ' ', COALESCE(b.`patient_name`,''), ' ', COALESCE(b.`middle_name`,''), ' ', COALESCE(b.`last_name`,'')), "
            . "doctors.doctor_name,"
            . "u.name as user_name, "
            . "b.bill_number, "
            . "b.sub_total, "
            . "b.bill_discount, "
            . "(b.sub_total - IF (b.bill_discount, b.bill_discount, 0)) as total_payment, "
            . "IF (a.paid_Amount, a.paid_Amount, 0) as paid_amount, "
            . "pm.name as payment_modes_name, "
            . "((b.sub_total - IF (b.bill_discount, b.bill_discount, 0)) - IF (b.paidAmount, b.paidAmount, 0)) as balance, "
            . "b.id as case_id";

        $presql = " FROM case_master b LEFT join opd_bill_payments a on a.case_id = b.id LEFT JOIN  doctors ON doctors.id=b.doctor_id LEFT JOIN payment_modes pm ON pm.id=a.payment_mode LEFT JOIN users u ON u.id=a.created_by ";

        // $presql .= " WHERE 1=1 and b.is_deleted = 0 ";//AND b.doctor_id='$docid'";

        ///$presql .= " WHERE 1=1 and b.is_deleted = 0 AND ((b.sub_total - IF (b.bill_discount, b.bill_discount, 0)) - IF (b.paidAmount, b.paidAmount, 0)) != '' AND ((b.sub_total - IF (b.bill_discount, b.bill_discount, 0)) - IF (b.paidAmount, b.paidAmount, 0)) > 0;//AND b.doctor_id='$docid'";

        $presql .= " WHERE 1=1 and b.is_deleted = 0 ";//  AND ((b.sub_total - IF (b.bill_discount, b.bill_discount, 0)) - IF (b.paidAmount, b.paidAmount, 0)) != '' AND ((b.sub_total - IF (b.bill_discount, b.bill_discount, 0)) - IF (b.paidAmount, b.paidAmount, 0)) > 0";



        if ($_GET['search']['value']) {
            $presql .= " and bill_item LIKE '%" . $_GET['search']['value'] . "%' ";
        }
        if ($_GET['columns'][1]['search']['value']) {
            $presql .= " and b.doctor_id LIKE '%" . $_GET['columns'][1]['search']['value'] . "%' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
            //$fromDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][2]['search']['value'])->format('Y-m-d');
            $fromDate = $_GET['columns'][2]['search']['value'];
            //$presql .= " and a.created_at >= '".$fromDate."' ";
            $presql .= "and date(a.created_at) >='" . $fromDate . "' ";

        }
        if ($_GET['columns'][3]['search']['value']) {
            //$toDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][3]['search']['value'])->format('Y-m-d');
            $toDate = $_GET['columns'][3]['search']['value'];
            //$presql .= " and a.created_at <= '".$toDate."' ";
            $presql .= " and date(a.created_at) <= '" . $toDate . "' ";
        }

        if ($_GET['columns'][4]['search']['value']) {
            $presql .= " and a.bill_item = '" . $_GET['columns'][4]['search']['value'] . "' ";
        }

        if ($_GET['columns'][5]['search']['value']) {
            $presql .= " and a.payment_mode = '" . $_GET['columns'][5]['search']['value'] . "' ";
        }

        if ($_GET['columns'][6]['search']['value']) {
            $presql .= " and a.created_by = '" . $_GET['columns'][6]['search']['value'] . "' ";
        }
        $presql .= "  ";

        $orderByStr = " order by 1 desc";
        //$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;

        if (isset($_GET['order'][0]['column']) && is_numeric($_GET['order'][0]['column'])) {
            $orderColum = intval($_GET['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_GET['order'][0]['dir'];
        }

        if ($len > 0) {
            $sql = $select . $presql . $orderByStr . " LIMIT " . $start . "," . $len;
        } else {
            $sql = $select . $presql . $orderByStr;
        }

        //dd($sql);
        $qcount = DB::select("SELECT COUNT(b.id) c" . $presql);

        $count = $qcount[0]->c;

        $results = DB::select($sql);
        $ret = [];

        $query_str = DB::getQueryLog();
        //dd($query_str);

        //dd($results);
        $prev_case_id = "";
        $balance = 0;
        $case_payment_record = 0;

        foreach ($results as $key => $row) {
            if ($prev_case_id != $row->case_id) {
                $r = [];
                foreach ($row as $value) {
                    $r[] = $value;
                }
                $prev_case_id = $row->case_id;
                $ret[] = $r;
            }
        }

        $ret['data'] = $ret;
        $ret['recordsTotal'] = $count;
        $ret['iTotalDisplayRecords'] = $count;

        $ret['recordsFiltered'] = count($ret);
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }
    //=========================================================================================================================
//========================================================================================================
    #region Doctor bill report
    public function ipdViewReport(Request $request)
    {
        //echo "============== : ".__LINE__; exit;
        //$doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $user = Auth::user()->id;
        $doctor = DB::select("SELECT * FROM `doctors` ORDER BY `doctor_name` ASC");

        $this->acc = $this->commonHelper->checkUserAccess("12_new-ipd-bill-report", Auth::user()->id);
        if ($this->acc == 1) {
            $all_users_array = [];
            $payment_modes_array = [];
            $fees_details_array = [];
            $payment_modes = PaymentModes::all();

            foreach ($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
            }
            $fees_details = [];
            //$fees_details = FeesDetails::all();

            $fees_details = DB::table('bill_details')->get();

            foreach ($fees_details as $fees_details_row) {
                //$fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
                $fees_details_array[$fees_details_row->bill_item] = $fees_details_row->bill_item;
            }

            //echo "=====>>>>>> <pre>"; print_r($fees_details_array); exit;

            $all_users = User::all();
            $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();

            foreach ($all_users as $all_users_row) {
                $all_users_array[$all_users_row->id] = $all_users_row->name;
            }
            $defaultValues = [];
            return view('ipd_bill_reports.ipdViewReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array', 'form_dropdowns', 'defaultValues'));
        } else {
            $url = url()->previous();
            return redirect($url);
        }
    }

    public function ipdViewReportGrid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT "
            . "date(b.created_at) as `Date`, "
            . "b.case_number, "
            . "b.IPD_no, "
            //. "u.name, "
            . "b.patient_name,"
            . "doctors.doctor_name,"
            . "null, "
            . "b.bill_number, "
            . "IF(a.sub_total, a.sub_total, 0) as sub_total, "
            . "IF(a.advance_amount, a.advance_amount, 0) as advance_amount, "
            //. "CONCAT(eyeform.advance_date,'/',advance_payment_mode.name) as advance_details, "

            . "CONCAT(advance_payment_mode.name,' / ', date_format(eyeform.advance_date, '%d-%m-%Y')) as advance_details, "


            . "IF(a.discount_amount, a.discount_amount, 0) as discount_amount, "
            . "(IF(a.sub_total, a.sub_total, 0) - IF(a.advance_amount, a.advance_amount, 0) - IF(a.discount_amount, a.discount_amount, 0)) as total_payment, "
            . "IF(ibp.paid_amount, ibp.paid_amount, 0) as paid_amount , "
            . "pm.name as payment_modes_name, "
            . "(IF(a.sub_total, a.sub_total, 0) - IF(a.advance_amount, a.advance_amount, 0) - IF(a.discount_amount, a.discount_amount, 0) - IF(paid_tb.paid_amount_total, paid_tb.paid_amount_total, 0)) as remaining_balance, "
            . "a.case_id as case_id";

        $presql = " FROM "
            . "insurance_bill a "
            . "INNER join case_master b on a.case_id = b.id "
            . "LEFT join eyeform on eyeform.case_id = b.id "
            . "LEFT join ipd_bill_payments ibp on ibp.case_id = b.id "
            . "LEFT JOIN payment_modes pm ON pm.id= ibp.payment_mode "
            . "LEFT JOIN payment_modes advance_payment_mode ON advance_payment_mode.id= eyeform.advance_payment_type "
            . "LEFT JOIN (select SUM(paid_amount) as paid_amount_total, case_id from ipd_bill_payments group by case_id) paid_tb on b.id =paid_tb.case_id "
            . "LEFT JOIN doctors ON doctors.id=b.doctor_id "
            . "LEFT JOIN users u ON u.id=a.created_by ";

        $presql .= " WHERE b.is_ipd='1' and b.is_deleted = 0";


        //$eyeform  =  DB::table('eyeform')->where('case_id','=', $id)->get(['advance_amount'])->first();
        //$advance_amount = isset($eyeform->advance_amount) ? $eyeform->advance_amount:'0';

        //===========================================================

        //================================================================

        $presql .= "  ";
        $orderByStr = " order by 1 desc";

        if (isset($_GET['order'][0]['column']) && is_numeric($_GET['order'][0]['column'])) {
            $orderColum = intval($_GET['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_GET['order'][0]['dir'];
        }


        $sql = $select . $presql . $orderByStr . " LIMIT " . $start . "," . $len;

        $qcount = DB::select("SELECT COUNT(a.id) c" . $presql);
        //print_r($qcount);
        $count = $qcount[0]->c;

        $results = DB::select($sql);
        $ret = [];
        $case_id = "";
        $cnt = 1;
        if (!empty($results)) {
            /*
            foreach ($results as $row) {
                $r = [];
                foreach ($row as $value) {
                    $r[] = $value;
                }
                $ret[] = $r;
            }
            */

            //================================================================================
            $prev_case_id = "";

            foreach ($results as $key => $row) {

                $r = [];
                foreach ($row as $value) {
                    $r[] = $value;
                }

                if ($prev_case_id == $row->case_id) {
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
                if (isset($results[$key + 1])) {
                    if ($results[$key + 1]->case_id == $row->case_id) {
                        $r[14] = '';
                    }
                } else {

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
    }

    //-------------------------------------------------------------------------------------------------------
    #region Doctor bill report
    public function ipdBillPaymentReport(Request $request)
    {
        //echo "============== : ".__LINE__; exit;
        //$doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $user = Auth::user()->id;
        $doctor = DB::select("SELECT * FROM `doctors` ORDER BY `doctor_name` ASC");

        $this->acc = $this->commonHelper->checkUserAccess("12_new-ipd-bill-payment-report", Auth::user()->id);
        if ($this->acc == 1) {
            $all_users_array = [];
            $payment_modes_array = [];
            $fees_details_array = [];
            $payment_modes = PaymentModes::all();

            foreach ($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
            }
            $fees_details = [];
            //$fees_details = FeesDetails::all();

            $fees_details = DB::table('bill_details')->get();

            foreach ($fees_details as $fees_details_row) {
                //$fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
                $fees_details_array[$fees_details_row->bill_item] = $fees_details_row->bill_item;
            }

            //echo "=====>>>>>> <pre>"; print_r($fees_details_array); exit;

            $all_users = User::all();
            $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();

            foreach ($all_users as $all_users_row) {
                $all_users_array[$all_users_row->id] = $all_users_row->name;
            }
            $defaultValues = [];
            return view('ipd_bill_reports.ipdPaymentReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array', 'form_dropdowns', 'defaultValues'));
        } else {
            $url = url()->previous();
            return redirect($url);
        }
    }

    public function ipdBillPaymentReportGrid(Request $request)
    {
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


        //$eyeform  =  DB::table('eyeform')->where('case_id','=', $id)->get(['advance_amount'])->first();
        //$advance_amount = isset($eyeform->advance_amount) ? $eyeform->advance_amount:'0';

        //===========================================================

        //================================================================

        $presql .= "  ";
        $orderByStr = " order by 1 desc";

        if (isset($_GET['order'][0]['column']) && is_numeric($_GET['order'][0]['column'])) {
            $orderColum = intval($_GET['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_GET['order'][0]['dir'];
        }


        $sql = $select . $presql . $orderByStr . " LIMIT " . $start . "," . $len;

        $qcount = DB::select("SELECT COUNT(a.id) c" . $presql);
        //print_r($qcount);
        $count = $qcount[0]->c;
        //dd($sql);
        $results = DB::select($sql);
        $ret = [];
        $case_id = "";
        $cnt = 1;
        if (!empty($results)) {
            /*
            foreach ($results as $row) {
                $r = [];
                foreach ($row as $value) {
                    $r[] = $value;
                }
                $ret[] = $r;
            }
            */

            //================================================================================
            $prev_case_id = "";

            $total_paid = 0;
            //echo "======== <pre>"; print_r($results); exit;
            foreach ($results as $key => $row) {

                $r = [];
                foreach ($row as $value) {
                    $r[] = $value;
                }

                if ($prev_case_id == $row->case_id) {
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
                //if() {
                if ((isset($results[$key + 1]) && $results[$key + 1]->case_id == $row->case_id)) {
                    $r[14] = '';

                    $total_paid += $r[12];

                } else {
                    $r[14] = $total_paid + $r[12];

                    $total_paid = 0;
                }
                //}

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
    }

    //---------------------------------------------------------------------------------------------------------

    #region Doctor bill report
    public function ipdBillBalanceReport(Request $request)
    {
        //echo "============== : ".__LINE__; exit;
        //$doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $user = Auth::user()->id;
        $doctor = DB::select("SELECT * FROM `doctors` ORDER BY `doctor_name` ASC");

        $this->acc = $this->commonHelper->checkUserAccess("12_new-ipd-bill-balance-report", Auth::user()->id);
        if ($this->acc == 1) {
            $all_users_array = [];
            $payment_modes_array = [];
            $fees_details_array = [];
            $payment_modes = PaymentModes::all();

            foreach ($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
            }
            $fees_details = [];
            //$fees_details = FeesDetails::all();

            $fees_details = DB::table('bill_details')->get();

            foreach ($fees_details as $fees_details_row) {
                //$fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
                $fees_details_array[$fees_details_row->bill_item] = $fees_details_row->bill_item;
            }

            //echo "=====>>>>>> <pre>"; print_r($fees_details_array); exit;

            $all_users = User::all();
            $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();

            foreach ($all_users as $all_users_row) {
                $all_users_array[$all_users_row->id] = $all_users_row->name;
            }
            $defaultValues = [];
            return view('ipd_bill_reports.ipdBalanceReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array', 'form_dropdowns', 'defaultValues'));
        } else {
            $url = url()->previous();
            return redirect($url);
        }
    }

    public function ipdBillBalanceReportGrid(Request $request)
    {

        $till_date = isset($_GET['columns'][3]['search']['value']) && $_GET['columns'][3]['search']['value'] != '' ? date('Y-m-d', strtotime($_GET['columns'][3]['search']['value'])) : date('Y-m-d');
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
            //. "(IF(a.sub_total, a.sub_total, 0) - IF(a.advance_amount, a.advance_amount, 0) - IF(a.discount_amount, a.discount_amount, 0) - IF(paid_tb.paid_amount_total, paid_tb.paid_amount_total, 0)) as remaining_balance, "

            . "(IF(bill_items_total.total_bill_amount, bill_items_total.total_bill_amount, 0) - IF(a.advance_amount, a.advance_amount, 0) - IF(a.discount_amount, a.discount_amount, 0) - IF(paid_items_total.total_paid_amount, paid_items_total.total_paid_amount, 0)) as remaining_balance, "

            //    . "bill_items_total.total_bill_amount, "
            . " a.case_id as case_id";

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
            . "LEFT JOIN users u2 ON u2.id=ibp.created_by "

            . "LEFT JOIN (SELECT case_id, SUM(bill_amount) as total_bill_amount FROM bill_details WHERE DATE(created_at) <= '" . $till_date . "' GROUP BY case_id) as bill_items_total ON bill_items_total.case_id=a.case_id "

            . "LEFT JOIN (SELECT case_id, SUM(paid_amount) as total_paid_amount FROM ipd_bill_payments WHERE DATE(created_at) <= '" . $till_date . "' GROUP BY case_id) as paid_items_total ON paid_items_total.case_id=a.case_id ";

        //$presql .= " WHERE b.is_ipd='1' and b.is_deleted = 0 and DATE(a.created_at) <= '".$till_date."'";

        $presql .= " WHERE b.is_ipd='1' and b.is_deleted = 0 and DATE(a.created_at) <= '" . $till_date . "'";
        $presql .= " AND (IF(bill_items_total.total_bill_amount, bill_items_total.total_bill_amount, 0) - IF(a.advance_amount, a.advance_amount, 0) - IF(a.discount_amount, a.discount_amount, 0) - IF(paid_items_total.total_paid_amount, paid_items_total.total_paid_amount, 0)) != '' AND (IF(bill_items_total.total_bill_amount, bill_items_total.total_bill_amount, 0) - IF(a.advance_amount, a.advance_amount, 0) - IF(a.discount_amount, a.discount_amount, 0) - IF(paid_items_total.total_paid_amount, paid_items_total.total_paid_amount, 0)) > 0";

        //$eyeform  =  DB::table('eyeform')->where('case_id','=', $id)->get(['advance_amount'])->first();
        //$advance_amount = isset($eyeform->advance_amount) ? $eyeform->advance_amount:'0';

        //===========================================================

        //================================================================

        $presql .= " group by a.case_id ";

        // $presql .= " ";
        $orderByStr = " order by 1 desc";

        if (isset($_GET['order'][0]['column']) && is_numeric($_GET['order'][0]['column'])) {
            $orderColum = intval($_GET['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_GET['order'][0]['dir'];
        }
        /*
        if ($_GET['columns'][3]['search']['value']) {
            //$toDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][3]['search']['value'])->format('Y-m-d');
              $toDate = $_GET['columns'][3]['search']['value'];
            //$presql .= " and a.created_at <= '".$toDate."' ";
             $presql .= " and date(a.created_at) <= '".$toDate."' ";
        }
        */


        $sql = $select . $presql . $orderByStr . " LIMIT " . $start . "," . $len;
        //dd($sql);
        $qcount = DB::select("SELECT COUNT(a.id) c" . $presql);
        //print_r($qcount);
        $count = $qcount[0]->c;

        $results = DB::select($sql);
        $ret = [];
        $case_id = "";
        $cnt = 1;
        if (!empty($results)) {
            /*
            foreach ($results as $row) {
                $r = [];
                foreach ($row as $value) {
                    $r[] = $value;
                }
                $ret[] = $r;
            }
            */

            //================================================================================
            $prev_case_id = "";

            $total_paid = 0;
            //echo "======== <pre>"; print_r($results); exit;
            foreach ($results as $key => $row) {

                $r = [];
                foreach ($row as $value) {
                    $r[] = $value;
                }

                if ($prev_case_id == $row->case_id) {
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

    }
}