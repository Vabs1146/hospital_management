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

use App\Models\old_register;
use App\Case_master;
use App\helperClass\drAppHelper;
use Auth;
use App\Helpers\Helpers;
use DB;
use Storage;
use App\helperClass\CommonHelper;

class old_registerController extends AdminRootController
{

     public function __construct()
    {
        $this->acc=0;
         $this->commonHelper = new CommonHelper();
    }
    

    public function index(Request $request)
    {
        return view('oldregistry.index', []);
    }

    public function create(Request $request)
    {
           $user = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='oldregister/create'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("oldregister/create",Auth::user()->id);
        if ($this->acc == 1) {
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        $old_register = new old_register();
        return view('oldregistry.add', compact('old_register','doctorlist'));
         }
          else
        {
           $url= url()->previous();
           return redirect($url);
        }
     
    }

    public function edit(Request $request, $oldregister)
    {
   $user = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='oldregister/edit'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("oldregister/edit",Auth::user()->id);
        if ($this->acc == 1) {

        $old_register  = old_register::findOrFail($oldregister);  
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        return view('oldregistry.add', compact('old_register','doctorlist'));
        }
          else
        {
           $url= url()->previous();
           return redirect($url);
        }
     

    }

    public function update(Request $request, $oldregister){

        // $isEdit = true;
        // $form_details = old_register::where('id', $oldregister)->first();
        // //var_dump(DB::getQueryLog());
        // if ($form_details === null) {
        //     $form_details = new eye_operation_notes();
        //     $isEdit = false;
        // }
        $form_details = new old_register();
        $form_details = $form_details->updateOrCreate(['id'=>$oldregister], $request->all());
        // $form_details->fill($request->all());
        // $form_details->save();

            // \LogActivity::addToLog('Old Register Record created successfully');
        return redirect()->back()->with('flash_message', 'Record added/updated successfully');
    }

    public function printbill($case_id){

        $case_master  = Case_master::findOrFail($case_id);
        $eyeoperation = eye_operation_notes::where('case_id', $case_id)->first();
        if (count($eyeoperation) <= 0 ||  $eyeoperation === null || is_null($eyeoperation) || empty($eyeoperation) || !isset($eyeoperation)) {
            $eyeoperation = new eye_operation_notes();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $billdata = $case_master->Bill_detail()->get();
        $anesthetist_notes = $eyeoperation->eye_op_nt_anesthetist_notes()->first();
        if(count($anesthetist_notes) <= 0 ){
            $anesthetist_notes = new eye_op_nt_anesthetist_notes();
        }
        return view('eyeoperation.print', compact('case_master','eyeoperation', 'DateWiseRecordLst', 'logoUrl', 'billdata','anesthetist_notes'));
    }

    public function deleteregistry(Request $request, $id) {	
		$old_register = old_register::findOrFail($id);
		$old_register->delete();
        //\LogActivity::addToLog('Old Register Record deleted successfully');
		return "OK";
	}

    public function grid(Request $request){

        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = " SELECT a.id, a.ipd_no, a.patient_name, a.patient_address, a.date_of_admission, a.date_of_discharge, a.mobile_no, c.doctor_name ";
        $presql = " from old_register a
                    left join doctors c on a.consulting_doctor = c.id
				   ";
        $presql .= " WHERE 1=1 ";
        if ($_POST['search']['value']) {
            $presql .= " and a.patient_name LIKE '%".$_POST['search']['value']."%' ";
        }
        if ($_POST['columns']['1']['search']['value']) {
            $presql .= " and a.ipd_no LIKE '%".$_POST['columns']['1']['search']['value']."%' ";
        }
        if ($_POST['columns']['2']['search']['value']) {
            $presql .= " and a.patient_name LIKE '%".$_POST['columns']['2']['search']['value']."%' ";
        }
        if ($_POST['columns']['3']['search']['value']) {
            $presql .= " and c.doctor_name LIKE '%".$_POST['columns']['3']['search']['value']."%' ";
        }
        $presql .= " ";

        $orderByStr = " order by 1 desc";
        //$orderColum = ( isset( $_POST['order'][0]['column'] ) && is_numeric( $_POST['order'][0]['column'] ) ) ? intval( $_POST['order'][0]['column'] )+1 : 1;

        if( isset( $_POST['order']['0']['column'] ) && is_numeric( $_POST['order']['0']['column'] ) ){
            $orderColum = intval( $_POST['order']['0']['column'] )+1;
            $orderByStr = " order by ". $orderColum . " " . $_POST['order']['0']['dir'];
        }

        $sql = $select.$presql.$orderByStr;

        $sql =  $sql." LIMIT ".$start.",".$len;

        //echo json_encode($presql);

        $qcount = DB::select("SELECT COUNT(a.id) c".$presql);
        //print_r($qcount);
        $count = $qcount[0]->c;


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


}