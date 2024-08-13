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
use App\Models\IPD\ipdDischarge;
use App\Models\IPD\ipd_prescription;
use App\Case_master;
use App\helperClass\drAppHelper;
use App\Models\form_dropdowns;

use DB;
use Storage;

class IpdDischargeController extends AdminRootController
{

    public function index(Request $request)
    {
        return view('ipd_discharge.discharge_index', []);
    }

    public function grid(Request $request){

        $len = $_POST['length'];
        $start = $_POST['start'];

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
        $presql .= " group by a.ipd_no ";

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

    public function edit(Request $request, $patientId)
    {
        $patientRegisterList = patientRegister::get();
        $patientRegister  = $patientRegisterList->where('id', $patientId)->first();
        $ipdDischarge = $patientRegister->ipdDischarge()->get()->first();
        if(empty($ipdDischarge) | is_null($ipdDischarge)){
            $ipdDischarge = new ipdDischarge();
        }
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
		//dd($ipdDischarge);
        return view('ipd_discharge.discharge_add', compact('patientRegisterList', 'patientRegister','doctorlist', 'ipdDischarge'));
    }

    public function delete(Request $request, $id) { 
        $patientRegister = patientRegister::findOrFail($id);
        $patientRegister->delete();
        return "OK";
    }


    public function update(Request $request, $patientId){

        $form_details = patientRegister::findorFail($patientId);
        $form_details->update($request->all());
        $form_details = $form_details->ipdDischarge()->updateOrCreate(['id'=>$request->id], $request->all());
        // if($patientId == 0){
        //     return redirect('/IPD/patientRegsiter')->with('flash_message', 'Record added successfully');
        // }
        return redirect()->back()->with('flash_message', 'Record updated successfully')->withInput();
        //
    }

    public function printbill($patientId){

        $patientRegisterList = patientRegister::get();
        $patientRegister  = $patientRegisterList->where('id', $patientId)->first();
        $ipdDischarge = $patientRegister->ipdDischarge()->get()->first();
        if(empty($ipdDischarge) | is_null($ipdDischarge)){
            $ipdDischarge = new ipdDischarge();
        }
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('ipd_discharge.discharge_print', compact('patientRegister', 'logoUrl', 'doctorlist','ipdDischarge'));
    }

    public function edit_prescription($id)
    {

        $getdata = $this->getCaseData($id);
        $presDropdowns = ['numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText','ddText'),
                          'quantity'=>form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText','ddText'),
                          'medicine_strength'=>form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText','ddText')
                         ];
        $mergeArray = array_merge($getdata, $presDropdowns);
        return view('shared.add_prescription', ['casedata'=>$mergeArray]);
    }

    public function update_prescription(Request $request)
    {
        $IpdPatient = patientRegister::find(['id'=>$request->id]);
        if (is_null($IpdPatient)) {
            return redirect()->back()->withInput()->withErrors(array('message' => 'No patient found.'));
        }
        //check which submit was clicked on
        if (Input::get('prescription_save')) {
            
            $preslist = new ipd_prescription;
            $preslist->register_id = $request->id;
            $preslist->medicine_id = $request['medicine_id'];
            $preslist->medicine_Quntity = empty($request['medicine_quantity'])?0:$request['medicine_quantity'];
            $preslist->numberoftimes = $request['numberoftimes'];
            $preslist->strength = $request['strength'];
            $preslist->per_unit_cost = 0;
            $preslist->no_of_days = $request->no_of_days;
            $preslist->save();

            return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
        }
        if (Input::get('prescription_delete')) {
            $preslist = ipd_prescription::find($request['prescription_delete']);
            if ($preslist === null) {
                return redirect()->back()->withInput()->withErrors(array('message' => 'No prescription found.'));
            }
            $preslist->delete();
            return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
        }

        if (Input::get('prescription_msg')) {
            $preLst = prescription_list::where('case_id', $request['prescription_msg'])->get();
            if ($preLst->isEmpty()) {
                return redirect()->back()->withInput()->withErrors('Prescription list empty!');
            }
            $MedicalStoreNumber = Staff_user::where('staff_type_id', 4)->get();
            $caseMaster = Case_master::findOrFail($request['prescription_msg']);
            $MedicineLst = '';
            foreach ($preLst as $pre) {
                $MedicineLst = $MedicineLst .  $pre->Medical_store->medicine_name . ' -- ' . $pre->strength . ' %0a ';
            }
            //$MedicineLst = rtrim($MedicineLst,' %0a ');
            //$MedicineLst = rtrim(implode('%0a', $preLst->Medical_store->medicine_name . ' -- ' . $preLst->strength), '%0a');
            //$MedicalStoreNumber->pluck('mobile_no')->toArray();
            $MobileNoLst = rtrim(implode(',', $MedicalStoreNumber->pluck('mobile_no')->toArray()), ',');

            if (!empty($caseMaster->patient_mobile)) {
                $MobileNoLst = $MobileNoLst . ','.$caseMaster->patient_mobile;
            }

            $client = new HttpGuzzle;
            $smsStr = 'Prescription List for Patient '.(empty($request->patient_name)?"":$request->patient_name).' %0a case number :'. $request->case_number .' %0a '.  $MedicineLst. env('SMS_From_Name');
            $urlGet = str_replace(array('xxxxcommaSeperatedxxxx','xxxxSMSTextxxxx'), array($MobileNoLst, $smsStr), env('SMS_URL'));
            $res = $client->request('GET', $urlGet);


            return redirect()->back()->withInput()->with('flash_message', 'Message send successfully');
        }
    }    

}