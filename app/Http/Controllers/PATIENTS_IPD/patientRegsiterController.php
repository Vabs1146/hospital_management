<?php

namespace App\Http\Controllers\PATIENTS_IPD;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminRootController;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use App\Models\PATIENTS_IPD\patientRegister;
use App\Case_master;
use App\helperClass\drAppHelper;

use DB;
use Storage;

class patientRegsiterController extends AdminRootController
{
	public function GetPatientName(Request $request,$id){
       
        $posts=DB::select("SELECT * FROM `ipd_patient_register` where id='$id'");
        $userData['data'] = $posts;
        echo json_encode($userData);
    }

    public function index(Request $request)
    {
        return view('ipd_patientRegsiter.pr_index', []);
    }
    
    public function grid(Request $request){

        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = " SELECT a.id, a.ipd_number, a.first_name, a.address, DATE_FORMAT(a.registration_date_time, \"%d %b %Y\"), a.contact, a.consulting_doctor";
        $presql = " from patients a   ";
        $presql .= " WHERE 1=1 ";
        if ($_POST['search']['value']) {
            $presql .= " and a.name LIKE '%".$_POST['search']['value']."%' ";
        }
        if ($_POST['columns']['1']['search']['value']) {
            $presql .= " and a.ipd_number LIKE '%".$_POST['columns']['1']['search']['value']."%' ";
        }
        if ($_POST['columns']['2']['search']['value']) {
            $presql .= " and a.first_name LIKE '%".$_POST['columns']['2']['search']['value']."%' ";
        }
        if ($_POST['columns']['3']['search']['value']) {
            $presql .= " and a.consulting_doctor LIKE '%".$_POST['columns']['3']['search']['value']."%' ";
        }
        //$presql .= " group by a.ipd_no ";

        $orderByStr = " order by a.updated_at desc";
        //$orderColum = ( isset( $_POST['order'][0]['column'] ) && is_numeric( $_POST['order'][0]['column'] ) ) ? intval( $_POST['order'][0]['column'] )+1 : 1;

        if( isset( $_POST['order']['0']['column'] ) && is_numeric( $_POST['order']['0']['column'] ) ){
            $orderColum = intval( $_POST['order']['0']['column'] )+1;
            $orderByStr = " order by ". $orderColum . " " . $_POST['order']['0']['dir'];
        }

        $sql = $select.$presql.$orderByStr;

        if($start && !empty($start) && !is_null($start) && $len && !empty($len) && !is_null($len)){
            $sql =  $sql." LIMIT ".$start.",".$len;
        }

        //print_r("SELECT COUNT(a.id) c".$presql); return;
        $count = 0;
        $qcount = DB::select("SELECT COUNT(a.id) c".$presql);
        //print_r($qcount);
        if(sizeof($qcount)>0){
            $count = $qcount[0]->c;
        }

        $results = DB::select($sql);
        
        //return array($results, $count, $sql);
        //return ['results'=>$results, 'count'=>$count];
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

    public function grid1(Request $request) {

        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = " SELECT a.id, a.ipd_no, a.name, a.address, DATE_FORMAT(a.registration_date, \"%d %b %Y\"), a.mobile_no, a.consultant_doctor";
        $presql = " from ipd_patient_register a   ";
        $presql .= " WHERE 1=1 ";
        if ($_POST['search']['value']) {
            $presql .= " and a.name LIKE '%".$_POST['search']['value']."%' ";
        }
        if ($_POST['columns']['1']['search']['value']) {
            $presql .= " and a.ipd_no LIKE '%".$_POST['columns']['1']['search']['value']."%' ";
        }
        if ($_POST['columns']['2']['search']['value']) {
            $presql .= " and a.name LIKE '%".$_POST['columns']['2']['search']['value']."%' ";
        }
        if ($_POST['columns']['3']['search']['value']) {
            $presql .= " and a.consultant_doctor LIKE '%".$_POST['columns']['3']['search']['value']."%' ";
        }
        //$presql .= " group by a.ipd_no ";

        $orderByStr = " order by a.updated_at desc";
        //$orderColum = ( isset( $_POST['order'][0]['column'] ) && is_numeric( $_POST['order'][0]['column'] ) ) ? intval( $_POST['order'][0]['column'] )+1 : 1;

        if( isset( $_POST['order']['0']['column'] ) && is_numeric( $_POST['order']['0']['column'] ) ){
            $orderColum = intval( $_POST['order']['0']['column'] )+1;
            $orderByStr = " order by ". $orderColum . " " . $_POST['order']['0']['dir'];
        }

        $sql = $select.$presql.$orderByStr;

        if($start && !empty($start) && !is_null($start) && $len && !empty($len) && !is_null($len)){
            $sql =  $sql." LIMIT ".$start.",".$len;
        }

        //print_r("SELECT COUNT(a.id) c".$presql); return;
        $count = 0;
        $qcount = DB::select("SELECT COUNT(a.id) c".$presql);
        //print_r($qcount);
        if(sizeof($qcount)>0){
            $count = $qcount[0]->c;
        }

        $results = DB::select($sql);
        
        //return array($results, $count, $sql);
        //return ['results'=>$results, 'count'=>$count];
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

    public function edit(Request $request, $patientId)
    {

        $patientRegister  = patientRegister::firstOrNew(['id'=>$patientId]);
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        $names = patientRegister::pluck('name','id');
        return view('ipd_patientRegsiter.pr_add', compact('patientRegister','doctorlist','names'));
    }

    public function delete(Request $request, $id) { 
        $patientRegister = patientRegister::findOrFail($id);
        $patientRegister->delete();
        return "OK";
    }


    public function update(Request $request, $patientId){

        $form_details = new patientRegister();
        $form_details = $form_details->updateOrCreate(['id'=>$patientId], $request->all());
        if($patientId == 0){
            return redirect('/IPD/patientRegsiter')->with('flash_message', 'Record added successfully');
        }
        return redirect()->back()->with('flash_message', 'Record updated successfully')->withInput();
        //
    }

    public function printbill($IpdRegister_id){

        $patientRegister  = patientRegister::firstOrNew(['id'=>$IpdRegister_id]);
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('ipd_patientRegsiter.pr_print', compact('patientRegister', 'logoUrl', 'doctorlist'));
    }



}