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

use App\discharge2;
use App\Case_master;
use App\helperClass\drAppHelper;

use DB;
use Storage;
class discharge2Controller extends Controller
{
    public function index(Request $request)
    {
        return view('discharge2.index', []);
    }

public function grid(Request $request)
    {
        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = "SELECT a.id,  a.case_number, `patient_name`, `patient_emailId`, `patient_mobile`, a.patient_age, e.doctor_name, DATE_FORMAT(a.updated_at, \"%d %b %Y\"), 1,2, DATE(a.updated_at)= DATE(NOW())";
        $presql = " FROM case_master a
                    join (select max(id) as id from case_master where is_deleted = 0 group by case_number) b on a.id =b.id 
          left join timeslots d on a.FollowUpDate = d.id
          left join doctors c on a.FollowUpDoctor_Id = c.id
                    left join doctors e on a.doctor_id = e.id 
          ";
        $presql .= " WHERE 1=1 and a.is_deleted = 0";
        if ($_POST['search']['value']) {
            $presql .= " and patient_name LIKE '%".$_POST['search']['value']."%' ";
        }
        if ($_POST['columns'][1]['search']['value']) {
            $presql .= " and a.case_number LIKE '%".$_POST['columns'][1]['search']['value']."%' ";
        }
        if ($_POST['columns'][2]['search']['value']) {
            $presql .= " and e.doctor_name LIKE '%".$_POST['columns'][2]['search']['value']."%' ";
        }
        if ($_POST['columns'][3]['search']['value']) {
            $presql .= " and patient_name LIKE '%".$_POST['columns'][3]['search']['value']."%' ";
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

    public function edit(Request $request, $id)
    {
        $case_master  = Case_master::findOrFail($id);
        $discharge2 = $case_master ->discharge2()->first();
        if ($discharge2 === null || is_null($discharge2) || empty($discharge2) || !isset($discharge2)) {
            $discharge2 = new discharge2();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        return view('discharge2.add', compact('case_master','discharge2', 'DateWiseRecordLst'));
    }
    public function editOne(Request $request, $id)
    {
        $case_master  = Case_master::findOrFail($id);
        $discharge2 = $case_master ->discharge2()->first();
        if ($discharge2 === null || is_null($discharge2) || empty($discharge2) || !isset($discharge2)) {
            $discharge2 = new discharge2();
        }
        //return $discharge2;
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        return view('discharge2.add1', compact('case_master','discharge2', 'DateWiseRecordLst'));
    }

    public function update(Request $request){

        $isEdit = true;
        $form_details = discharge2::where('case_id', $request->case_id)->first();
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new discharge2();
            $isEdit = false;
        }

        $case_master = Case_master::findOrFail($request->case_id);
        $case_master->patient_name = $request->patient_name;
        $case_master->patient_age = $request->patient_age;
        $case_master->patient_address = $request->patient_address;
        $case_master->male_female = $request->male_female;
        $case_master->admission_date_time = $request->admission_date_time;
        $case_master->surgery_date_time = $request->surgery_date_time;
        $case_master->discharge_date_time = $request->discharge_date_time;
        $case_master->diagnosis = $request->diagnosis;
        $case_master->Surgeon = $request->surgeon_name;
        $case_master->save();
        //image upload
       $dischargeimg2 = $request->file('dischargeimg2');
     if ($request->hasFile('dischargeimg2')) {
        $image = $request->file('dischargeimg2');


        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'discharge2image/';
        $image->move($destinationPath, $name);

        //$path = url('/gallery_image/'.$name);
    
        $id=$request->case_id;
        DB::insert("UPDATE `discharge2` SET `dischargeimg2`='$name' WHERE case_id='$id'");
               
    } 
    
    $form_details->fill($request->all());
        $form_details->save();
        return redirect()->back()->with('flash_message', 'Record added successfully');
}


    public function updateOne(Request $request){

        $isEdit = true;
        $form_details = discharge2::where('case_id', $request->case_id)->first();
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new discharge2();
            $isEdit = false;
        }

        $case_master = Case_master::findOrFail($request->case_id);
        $case_master->patient_name = $request->patient_name;
        $case_master->patient_age = $request->patient_age;
        $case_master->patient_address = $request->patient_address;
        $case_master->male_female = $request->male_female;
        $case_master->patient_mobile = $request->patient_mobile;
        $case_master->admission_date_time = $request->admission_date_time;
        $case_master->surgery_date_time = $request->surgery_date_time;
        $case_master->discharge_date_time = $request->discharge_date_time;
        $case_master->diagnosis = $request->diagnosis;
        $case_master->Surgeon = $request->surgeon_name;
        $case_master->save();
        
       //image upload
       // Code to upload img
        $dischargeimg = $request->file('dischargeimg');
     if ($request->hasFile('dischargeimg')) {
        $image = $request->file('dischargeimg');


        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'discharge_img/';
        $image->move($destinationPath, $name);

        //$path = url('/gallery_image/'.$name);
    
        $id=$request->case_id;
        DB::insert("UPDATE `discharge2` SET `dischargeimg`='$name' WHERE case_id='$id'");
               
    } 
        $form_details->fill($request->all());
        $form_details->save();
        return redirect()->back()->with('flash_message', 'Record added successfully');
    
}

    public function printbill($case_id){

        $case_master  = Case_master::findOrFail($case_id);
        $discharge = $case_master ->discharge()->first();
        if ($discharge === null || is_null($discharge) || empty($discharge) || !isset($discharge)) {
            $discharge = new discharge2();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $billdata = $case_master->Bill_detail()->get();
        return view('discharge2.print', compact('case_master','discharge', 'DateWiseRecordLst', 'logoUrl', 'billdata'));
    }
    public function printbillOne($case_id){

        $case_master  = Case_master::findOrFail($case_id);
        $discharge = $case_master ->discharge()->first();
        if ($discharge === null || is_null($discharge) || empty($discharge) || !isset($discharge)) {
            $discharge = new discharge2();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $billdata = $case_master->Bill_detail()->get();
        $prescriptions = \App\prescription_list::where('case_id', $case_master->id)->get();
        return view('discharge2.print1', compact('case_master','discharge', 'DateWiseRecordLst', 'logoUrl', 'billdata', 'prescriptions'));
    }
}
