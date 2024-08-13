<?php

namespace App\Http\Controllers;

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
use App\Case_master;
use App\helperClass\drAppHelper;

use App\Models\Patients;

use DB;
use Storage;

class patient_BillController extends AdminRootController
{

    public function index(Request $request)
    {
        return view('patient_ipd_bill.ipdPbIndex', []);
    }

    public function edit(Request $request, $patientId)
    {
        $patientRegister  = Patients::firstOrNew(['id'=>$patientId]);
        
        //dd($patientRegister);
        
        $patientbill = $patientRegister->patientBill()->get()->first();
        if(empty($patientbill) | is_null($patientbill)){
            $patientbill = new patientBill();
        }
        $billItems = $patientbill->billItems()->get();
        // if(empty($billItems) | is_null($billItems)){
        //     $billItems = new billItems();
        // }
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        return view('patient_ipd_bill.ipdPbAdd', compact('patientRegister','doctorlist','patientbill','billItems'));
    }

    public function update(Request $request, $patientRegisterId){

        	//check which submit was clicked on
            if (Input::get('Item_Add')) {
                $billItems = patientBill::find($request->id)->billItems();// new billItems();
                $billItems = $billItems->Create($request->all());
                return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
            }
            if (Input::get('delete_item')) {
                $billItems = billItems::findOrFail($request['delete_item']);
                if ($billItems === null) {
                    return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
                }
                $billItems->delete();
                return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
            }
            if (Input::get('submit')) {
				
			$this->validate($request, [
            'advance_amount' => 'numeric',
            'discount_amount' => 'numeric'
               ]);
				
                $patientRegister  = patientRegister::firstOrNew(['id'=>$patientRegisterId]);
                $patientbill = $patientRegister->patientBill()->updateOrCreate(['id'=>$request->id], $request->all());                
                $patientRegister->update($request->all());
                $ipdDischarge = $patientRegister->ipdDischarge()->get()->first();
                $ipdDischarge = $patientRegister->ipdDischarge()->updateOrCreate(['patient_id'=>$request->id], $request->all());
                // $form_details = new patientBill();
                // $form_details = $form_details->updateOrCreate(['id'=>$billId], $request->all());
                // if($billId == 0){
                //     return redirect('/IPD/patientBill')->with('flash_message', 'Record added successfully');
                // }
                return redirect()->back()->with('flash_message', 'Record updated successfully')->withInput();
            }
        
    }

    public function delete(Request $request, $id) {	
		$patientbill = patientBill::findOrFail($id);
		$patientbill->delete();
		return "OK";
    }
    
    public function printbill($patientId){

        $patientRegister  = patientRegister::firstOrNew(['id'=>$patientId]);
        $patientbill = $patientRegister->patientBill()->get()->first();
        if(empty($patientbill) | is_null($patientbill)){
            $patientbill = new patientBill();
        }
        $billItems = $patientbill->billItems()->get();
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('ipd_patientBill.ipdPbPrint0', compact('patientRegister', 'logoUrl', 'doctorlist','patientbill','billItems'));
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
        return view('ipd_patientBill.ipdPbPrint1', compact('patientRegister', 'logoUrl', 'doctorlist','patientbill','billItems'));
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

}