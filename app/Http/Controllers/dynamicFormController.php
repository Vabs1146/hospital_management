<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as HttpGuzzle;
use Illuminate\Support\Facades\Log;

use App\Models\form_master;
use App\Models\form_field_master;
use App\Models\form_field_values;
use App\Models\form_master_form_field;
use App\Case_master;
use App\Models\IPD\patientRegister;
use App\helperClass\drAppHelper;
use App\doctor;

class dynamicFormController extends AdminRootController
{

    public function index(Request $request, $formId)
    {
        $form_master = form_master::findOrFail($formId);
        if (is_null($form_master)) {
            return redirect()->back()->withInput()->withErrors(array('message' => 'Record Not fond.'));
        }
        return view($form_master->index_path, []);
    }
    
    public function edit($formId, $registration_id, $OpdIpd="Ipd"){
		
        $form_master = form_master::findOrFail($formId);
        if (is_null($form_master)) {
            return redirect()->back()->withInput()->withErrors(array('message' => 'Record Not fond.'));
        }
        if($OpdIpd == "Ipd"){
            $patientRegister  = patientRegister::firstOrNew(['id'=>$registration_id]);
            $form_field_values = form_field_values::where('register_id', $registration_id)->whereIn('form_field_code', $form_master->form_master_form_field()->select('form_field_code')->get())->get();
        }
        if($OpdIpd == "Opd"){
            $patientRegister  = Case_master::find($registration_id);
            $form_field_values = form_field_values::where('opd_case_master_id', $registration_id)->whereIn('form_field_code', $form_master->form_master_form_field()->select('form_field_code')->get())->get();
        }
      
      $field_name_id = $form_master->form_master_form_field()->with('form_field_master')->get()->pluck('form_field_code','form_field_master.fieldName');
        //var_dump(DB::getQueryLog());
		 //return $patientRegister;

		//echo $form_master->add_edit_path; exit;
        return view($form_master->add_edit_path, compact('patientRegister', 'form_master', 'form_field_values', 'field_name_id'));
    }

    public function update(Request $request, $formId, $registration_id, $OpdIpd="Ipd")
    {
        
        //update patient register details
        // $form_details = patientRegister::findorFail($request->register_id);
        // $form_details = $form_details->update($request->all());
        if($OpdIpd == "Ipd"){
            $form_details = new patientRegister();
            $form_details = $form_details->updateOrCreate(['id'=>$request->register_id], $request->all());
            $db_field_values = form_field_values::where('register_id', $form_details->id)->whereIn('form_field_code', array_keys($request->field_data_singular))->get();
        }
        if($OpdIpd == "Opd"){
            $form_details = Case_master::find($registration_id);
            $db_field_values = form_field_values::where('opd_case_master_id', $form_details->id)->whereIn('form_field_code', array_keys($request->field_data_singular))->get();
        }
        $ValuesToInsert = array();

        $todayDate = Carbon::now();
        //DB::enableQueryLog();
        foreach ($request->field_data_singular as $key => $value) {
            $dbfieldVal = $db_field_values->where('form_field_code', $key);
            if (!$dbfieldVal->isEmpty()) {
                $dbfieldValFirst = $dbfieldVal->first();
                if($dbfieldValFirst->field_data != $value){
                    $dbfieldValFirst->update(['field_data'=>$value]);
                }
            }else{
                $newdbFieldVal = [
                        'form_field_code' => $key,
                        'field_data' => $value,
                        'created_at' => $todayDate,
                        'updated_at' => $todayDate
                    ];
                    if($OpdIpd == "Ipd"){
                        $newdbFieldVal['register_id'] = $form_details->id;
                    }
                    if($OpdIpd == "Opd"){
                        $newdbFieldVal['opd_case_master_id'] = $form_details->id;
                    }
                array_push($ValuesToInsert, $newdbFieldVal);
            }
        }
        //dump(DB::getQueryLog());
        if (count($ValuesToInsert) > 0) {
            form_field_values::insert($ValuesToInsert);
        }
        if($request->returnUrl && !empty($request->returnUrl)){
            return redirect($request->returnUrl)->with('flash_message', 'Record added/updated successfully');            
        }

        return redirect(url('dynamicForm').'/'.$formId)->with('flash_message', 'Record added/updated successfully');
    }

    public function print($formId, $registration_id, $OpdIpd=""){

        $form_master = form_master::findOrFail($formId);
        if (is_null($form_master)) {
            return redirect()->back()->withInput()->withErrors(array('message' => 'Record Not fond.'));
        }
        $patientRegister  = patientRegister::firstOrNew(['id'=>$registration_id]);
        $form_field_values = form_field_values::where('register_id', $registration_id)->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
        $field_name_id = $form_master->form_master_form_field()->with('form_field_master')->get()->pluck('form_field_code','form_field_master.fieldName');
		if($OpdIpd == "Ipd"){
            $patientRegister  = patientRegister::firstOrNew(['id'=>$registration_id]);
            $form_field_values = form_field_values::where('register_id', $registration_id)->whereIn('form_field_code', $form_master->form_master_form_field()->select('form_field_code')->get())->get();
        } else {
            $patientRegister  = Case_master::find($registration_id);
            $form_field_values = form_field_values::where('opd_case_master_id', $registration_id)->whereIn('form_field_code', $form_master->form_master_form_field()->select('form_field_code')->get())->get();
        }
        return view($form_master->print_path, compact('patientRegister', 'form_master', 'form_field_values', 'logoUrl', 'doctorlist', 'field_name_id'));
    }
       public function view($formId, $registration_id, $OpdIpd=""){

        $form_master = form_master::findOrFail($formId);
        if (is_null($form_master)) {
            return redirect()->back()->withInput()->withErrors(array('message' => 'Record Not fond.'));
        }
        $patientRegister  = patientRegister::firstOrNew(['id'=>$registration_id]);
        $form_field_values = form_field_values::where('register_id', $registration_id)->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
        $field_name_id = $form_master->form_master_form_field()->with('form_field_master')->get()->pluck('form_field_code','form_field_master.fieldName');
		   if($OpdIpd == "Ipd"){
            $patientRegister  = patientRegister::firstOrNew(['id'=>$registration_id]);
            $form_field_values = form_field_values::where('register_id', $registration_id)->whereIn('form_field_code', $form_master->form_master_form_field()->select('form_field_code')->get())->get();
        } else {
            $patientRegister  = Case_master::find($registration_id);
            $form_field_values = form_field_values::where('opd_case_master_id', $registration_id)->whereIn('form_field_code', $form_master->form_master_form_field()->select('form_field_code')->get())->get();
        }
        return view($form_master->view_path, compact('patientRegister', 'form_master', 'form_field_values', 'logoUrl', 'doctorlist', 'field_name_id'));
    }

    public function grid_Admission(Request $request){

        $len = $_POST['length'];
        $start = $_POST['start'];
        $formId = $_POST['formId'];

        $select = " SELECT a.id, a.ipd_no, a.name, a.address, DATE_FORMAT(a.registration_date, \"%d %b %Y\"), a.mobile_no, c.doctor_name";
        $presql = " from ipd_patient_register a
                    left join doctors c on a.consultant_doctor = c.id
				   ";
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
            $presql .= " and c.doctor_name LIKE '%".$_POST['columns']['3']['search']['value']."%' ";
        }
        //$presql .= " group by a.ipd_no ";

        $orderByStr = " order by 1 desc";
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