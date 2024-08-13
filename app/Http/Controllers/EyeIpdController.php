<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Hash;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as HttpGuzzle;
use Illuminate\Support\Facades\Input;

use Calendar;
use App\appointment;
use App\Case_master;
use App\doctor;
use App\timeslot;
use Event;
use DateTime;
use Auth;
use Response;
use App\Helpers\Helpers;

class EyeIpdController extends Controller
{
  public function index(Request $request)
  {
return view('eye_ipd.operation_theater_index',[]);

 }
   
 public function grid(Request $request)
    {
        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = "SELECT a.id,  a.case_number, a.case_number, CONCAT(COALESCE(`mr_mrs_ms`,''), ' ', COALESCE(`patient_name`,''), ' ', COALESCE(`middle_name`,''), ' ', COALESCE(`last_name`,'')), `patient_emailId`, `patient_mobile`, a.patient_age, e.doctor_name, DATE_FORMAT(a.updated_at, \"%d %b %Y\"), 1,2, DATE(a.updated_at)= DATE(NOW())";
        $presql = " FROM case_master a
                    join (select max(id) as id from case_master where is_deleted = 0 group by case_number) b on a.id =b.id 
          left join timeslots d on a.FollowUpDate = d.id
          left join doctors c on a.FollowUpDoctor_Id = c.id
                    left join doctors e on a.doctor_id = e.id 
          ";
        //$presql .= " WHERE 1=1 and a.is_deleted = 0";
		//$presql .= " WHERE a.patient_type='ipd' and a.is_deleted = 0";
        
        $presql .= " WHERE a.is_ipd='1' and a.is_deleted = 0";

        if ($_POST['search']['value']) {
            //$presql .= " and patient_name LIKE '%".$_POST['search']['value']."%' ";
            $presql .= " and (patient_name LIKE '%" . $_POST['search']['value'] . "%' OR middle_name LIKE '%" . $_POST['search']['value'] . "%' OR last_name LIKE '%" . $_POST['search']['value'] . "%')";
        }
        if ($_POST['columns'][1]['search']['value']) {
            $presql .= " and a.case_number LIKE '%".$_POST['columns'][1]['search']['value']."%' ";
        }
        if ($_POST['columns'][2]['search']['value']) {
            $presql .= " and e.doctor_name LIKE '%".$_POST['columns'][2]['search']['value']."%' ";
        }
        if ($_POST['columns'][3]['search']['value']) {
            //$presql .= " and patient_name LIKE '%".$_POST['columns'][3]['search']['value']."%' ";
            $presql .= " and (patient_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' OR middle_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' OR last_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%')";
       
        }
        $presql .= "  ";

        $orderByStr = " order by 1 desc";
        //$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;

        if( isset( $_POST['order'][0]['column'] ) && is_numeric( $_POST['order'][0]['column'] ) ){
            $orderColum = intval( $_POST['order'][0]['column'] )+1;
            $orderByStr = " order by ". $orderColum . " " . $_POST['order'][0]['dir'];
        }


        $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;


        $qcount = DB::select("SELECT COUNT(a.id) c".$presql);
        //print_r($qcount);
        $count = $qcount[0]->c;

        $results = DB::select($sql);
        $ret = [];
        foreach ($results as $row) {
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
        $ret['draw'] = $_POST['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }

    public function operation()
    {
   return view('eye_ipd.index',[]);
    }
    public function discharge()
    {
    return view('eye_ipd.discharge_index',[]);
    }
    public function ipdbill()
    {
     return view('eye_ipd.ipdbillindex',[]);   
    }

    }
