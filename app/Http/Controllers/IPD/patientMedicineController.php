<?php

namespace App\Http\Controllers\IPD;

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

use App\Models\IPD\patientRegister;
use App\Models\IPD\patientBill;
use App\Models\IPD\billItems;
use App\Models\IPD\patientMedicine;
use App\Models\IPD\ipdDischarge;
use App\Case_master;
use App\helperClass\drAppHelper;

use DB;
use Storage;

class patientMedicineController extends AdminRootController
{

    public function index(Request $request)
    {
        return view('ipd_patientMedicine.ipdPmIndex', []);
    }
    
    public function grid(Request $request) {

        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = " SELECT a.id, a.ipd_no, a.name, a.address, DATE_FORMAT(a.registration_date, \"%d %b %Y\"), a.mobile_no, a.consultant_doctor, SUM(ipm.price) as total";
        $presql = " from ipd_patient_register a  ";
        
        $presql .= " LEFT JOIN ipd_patient_medicine ipm ON ipm.register_id = a.id   ";
        
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
        $presql .= " group by a.id ";

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
        $patientbill = $patientRegister->patientBill()->get()->first();
        if(empty($patientbill) | is_null($patientbill)){
            $patientbill = new patientBill();
        }
        $patientMedicine = $patientRegister->patientMedicine()->get();
        // if(empty($patientMedicine) | is_null($patientMedicine)){
        //     $patientMedicine = new patientMedicine();
        // }
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        $medicinelist = $helperCls->getMedicineList();
        return view('ipd_patientMedicine.ipdPmAdd', compact('patientRegister','doctorlist','patientbill','patientMedicine', 'medicinelist'));
    }

    public function update(Request $request, $patientRegisterId){

        	//check which submit was clicked on
            if (Input::get('Item_Add')) {
                $patientRegister  = patientRegister::findOrFail(['id'=>$patientRegisterId]);
                $patientmedicine = $patientRegister->first()->patientMedicine()->Create($request->all());
                return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
            }
            if (Input::get('delete_item')) {
                $billItems = patientMedicine::findOrFail($request['delete_item']);
                if ($billItems === null) {
                    return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
                }
                $billItems->delete();
                return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
            }
            if (Input::get('submit')) {
                $patientRegister  = patientRegister::findOrFail(['id'=>$patientRegisterId]);
                $patientmedicine = $patientRegister->patientMedicine()->updateOrCreate(['id'=>$request->id], $request->all());
                return redirect()->back()->with('flash_message', 'Record updated successfully')->withInput();
            }
        
    }

    public function delete(Request $request, $id) {	
		$patientbill = patientBill::findOrFail($id);
		$patientbill->delete();
		return "OK";
    }
    
    public function printMedicine($patientId){

        $patientRegister  = patientRegister::firstOrNew(['id'=>$patientId]);
        $patientbill = $patientRegister->patientBill()->get()->first();
        if(empty($patientbill) | is_null($patientbill)){
            $patientbill = new patientBill();
        }
        $patientMedicine = $patientRegister->patientMedicine()->get();
        $discharge  = $patientRegister->ipdDischarge()->first();
        if(empty($discharge) | is_null($discharge)){
            $discharge = new ipdDischarge();
        }
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        $medicinelist = $helperCls->getMedicineList();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('ipd_patientMedicine.ipdPmPrint0', compact('patientRegister', 'logoUrl', 'doctorlist','patientbill','patientMedicine', 'medicinelist', 'discharge'));
    }

    public function printReceipt($patientId){

        $patientRegister  = patientRegister::firstOrNew(['id'=>$patientId]);
        $patientbill = $patientRegister->patientBill()->get()->first();
        if(empty($patientbill) | is_null($patientbill)){
            $patientbill = new patientBill();
        }
        $billItems = $patientbill->billItems()->get();
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('ipd_patientMedicine.ipdPmPrint1', compact('patientRegister', 'logoUrl', 'doctorlist','patientbill','billItems'));
    }

}