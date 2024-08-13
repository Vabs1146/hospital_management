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

use App\DoctorBill;
use App\Case_master;
use App\doctor;
use App\Image_gallery;
use DB;
use Auth;
use App\Helpers\Helpers;
use App\helperClass\drAppHelper;
use App\helperClass\CommonHelper;

class DoctorBillController extends AdminRootController
{

 public function __construct()
    {
         $this->acc=0;
          $this->commonHelper = new CommonHelper();
    }


    public function index(Request $request)
	{
	    return view('doctorBill.index', []);
    }
    
    public function grid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "select id, doctor_name, doctorFee, isActive,1,2";
        $presql = " from doctors ";
        // $presql = " FROM case_master a
        //             join (select max(id) as id from case_master group by case_number) b on a.id =b.id 
		// 			left join timeslots d on a.FollowUpDate = d.id
		// 			left join doctors c on a.FollowUpDoctor_Id = c.id
        //             left join doctors e on a.doctor_id = e.id 
		// 			";
        $presql .= " WHERE 1=1 ";
        if ($_GET['search']['value']) {
            $presql .= " and doctor_name LIKE '%".$_GET['search']['value']."%' ";
        }
        $presql .= "  ";

        $orderByStr = "";
        $orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;
        if ($orderColum > 0) {
            $orderByStr = " order by ". $orderColum . " " . $_GET['order'][0]['dir'];
        }

        $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;


        $qcount = DB::select("SELECT COUNT(id) c".$presql);
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
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }

	public function AddBill(Request $request, $doctorId)
	{
        //DB::enableQueryLog();


 $user = Auth::user()->id;

        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='doctordetail/doctorbill/AddBill'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("doctordetail/doctorbill/AddBill",Auth::user()->id);
        if ($this->acc == 1) {
          $PatientList = Case_master::select(DB::raw("CONCAT(patient_name,' - ',case_number) AS name"),'id')
                                            ->where('doctor_id', $doctorId)
                                            ->where('is_deleted', '0')
                                            ->pluck('name', 'id');                         
        $doctor = doctor::find($doctorId);
        $doctorbill = DoctorBill::where('doctor_Id', $doctorId)->orderBy('id', 'DESC')->get();
        //dd(DB::getQueryLog());
        return view('doctorBill.add', [ 'model'=>
            [
            'Patient_list' => $PatientList, 
            'doctor' => $doctor,
            'doctorbill' => $doctorbill,
            ]
        ]);
        }
          else
        {
            
         $url= url()->previous();
           return redirect($url);
        }

      
    }

    public function SaveBill(Request $request)
	{
        if (Input::get('AddBillItems')) {
          return $this->AddbillItems($request);
        }
        if(Input::get('delete_item')){
            return $this->DeletebillItems($request);
        }
    }
    
    public function DeletebillItems(Request $request){
        $billdetail = DoctorBill::findOrFail($request['delete_item']);
        if ($billdetail === null) {
            return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
        }
		$billdetail->delete();
           //  \LogActivity::addToLog('Bill deleted successfully');
    
        return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
    }

    public function ViewBillDetails($doctorId){
        $PatientList = Case_master::select(DB::raw("CONCAT(patient_name,' - ',case_number) AS name"),'id')
                                            ->where('doctor_id', $doctorId)
                                            ->where('is_deleted', '0')
                                            ->pluck('name', 'id');                         
        $doctor = doctor::find($doctorId);
        $doctorbill = DoctorBill::where('doctor_Id', $doctorId)->orderBy('id', 'DESC')->get();
        //dd(DB::getQueryLog());
        return view('doctorBill.show', [ 'model'=>
            [
            'Patient_list' => $PatientList, 
            'doctor' => $doctor,
            'doctorbill' => $doctorbill,
            ]
	    ]);
    }

    public function AddBillItems(Request $request){

        $this->validate($request, [
            'bill_date' => 'required',
            'bill_item' => 'required',
            'bill_Amount' => 'required',
            'case_id' => 'required'
		],[
            'bill_date.required' => 'Date is required',
            'bill_item.required' => 'Bill item is required',
            'bill_Amount.required' => 'Bill Amount is required',
            'case_id.required' => 'Patient is required',
        ]);
        $Case_master = Case_master::where('id', $request['case_id'])->first();
        $doctor_bill = new DoctorBill;
		$doctor_bill->case_id = $request['case_id'];
		$doctor_bill->case_number = $Case_master->case_number;
        $doctor_bill->doctor_Id = $request['doctor_id'];
        $doctor_bill->bill_item = $request['bill_item'];
        $doctor_bill->bill_Amount = $request['bill_Amount'];
        $doctor_bill->billed_date = Carbon::createFromFormat('d/M/Y', $request->bill_date)->format('Y-m-d');
		$doctor_bill->save();
        // \LogActivity::addToLog('Bill added successfully');
		return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');

    }

	public function bill_data(Case_master $Case_master){
		$DateWiseRecordLst = DoctorBill::where('case_number', $Case_master->case_number)->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
		return 	['case_master' => $Case_master, 'DateWiseRecordLst' => $DateWiseRecordLst,  'bill_data' => $Case_master->DoctorBill()->get(), 'bill_item'=>'', 'bill_Amount'=>''];
	}

    public function edit(Request $request, $id)
	{
		//$bill_detail = Bill_detail::findOrFail($id);
		$Case_master = Case_master::findOrFail($id);
	    return view('doctorBill.add', ['model' => $this->bill_data($Case_master)]);
    }
    
    #region Doctor bill report 
    
    public function ViewReport(Request $request){

        $user = Auth::user()->id;

        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='doctordetail/doctorbill/report/BillReport'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("doctordetail/doctorbill/report/BillReport",Auth::user()->id);
        if ($this->acc == 1) {
          $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
        return view('doctorBill.ViewReport',['doctorlist'=>$doctorlist]);
        }
          else
        {
            
         $url= url()->previous();
           return redirect($url);
        }

      
    }

    public function reportGrid(Request $request){
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = " SELECT date(a.billed_date) as `bill_date`, time(a.billed_date) as `bill_time`, b.patient_name, a.bill_item, a.bill_Amount ";
        $presql = " from doctorbill a
                    join case_master b on a.case_id = b.id 
                    left join doctors e on a.doctor_Id = e.id  
				   ";
        $presql .= " WHERE 1=1 ";
        if ($_GET['search']['value']) {
            $presql .= " and a.bill_item LIKE '%".$_GET['search']['value']."%' ";
        }
        if ($_GET['columns'][1]['search']['value']) {
            $presql .= " and e.id = '".$_GET['columns'][1]['search']['value']."' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
            $fromDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][2]['search']['value'])->format('Y-m-d');
            $presql .= " and a.billed_date >= '".$fromDate."' ";
        }
        if ($_GET['columns'][3]['search']['value']) {
            $toDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][3]['search']['value'])->format('Y-m-d');
            $presql .= " and a.billed_date <= '".$toDate."' ";
        }
        $presql .= "  ";

        $orderByStr = " order by 1 desc";
        //$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;

        if( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ){
            $orderColum = intval( $_GET['order'][0]['column'] )+1;
            $orderByStr = " order by ". $orderColum . " " . $_GET['order'][0]['dir'];
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
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }

    public function printReport(Request $request){

        $doctor = doctor::find($request->doctorName);
        $doctorbill = new DoctorBill;
        if(!empty($request->doctorName)){
            $doctorbill = $doctorbill->where('doctor_Id',$request->doctorName);
        }
        if(!empty($request->fromDate)){
            $fromDate = Carbon::createFromFormat('d/M/Y', $request->fromDate)->format('Y-m-d');
            $doctorbill = $doctorbill->whereDate('billed_date','>=',$fromDate);
        }
        if(!empty($request->ToDate)){
            $ToDate = Carbon::createFromFormat('d/M/Y', $request->ToDate)->format('Y-m-d');
            $doctorbill = $doctorbill->whereDate('billed_date','<=',$ToDate);
        }
        $doctorbill = $doctorbill->orderBy('id', 'DESC')->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('doctorBill.printReport', ['doctor'=>$doctor, 'billdata'=>$doctorbill, 'logoUrl'=>$logoUrl]);


    }

    #endregion

    #region Doctor Surgery bill report 
    
    public function ViewSurgeryReport(Request $request){
      $user = Auth::user()->id;

        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='doctordetail/doctorbill/report/SurgeryReport'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("doctordetail/doctorbill/report/SurgeryReport",Auth::user()->id);
        if ($this->acc == 1) {
             $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
        return view('doctorBill.ViewSurgeryReport',['doctorlist'=>$doctorlist]);
        }

        else
        {
            
         $url= url()->previous();
           return redirect($url);
        }


       
    }

    public function SurgeryReportGrid(Request $request){

        $GET = array('length'=>$_GET['length'], 'start'=>$_GET['start'], 'search_value'=>$_GET['search']['value'], 'columns_1_search_value'=>$_GET['columns'][1]['search']['value'], 'columns_2_search_value'=>$_GET['columns'][2]['search']['value'], 'columns_3_search_value'=>$_GET['columns'][3]['search']['value'], 'order_0_column'=>$_GET['order'][0]['column'], 'order_0_dir'=>$_GET['order'][0]['dir']);

        list($results, $count, $sql) = $this->getSurgeryReportData($GET);
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
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }

    public function getSurgeryReportData(array $GET){

        $len = $GET['length'];
        $start = $GET['start'];

        $select = " SELECT bb.id, b.patient_name, c.doctor_name as`doctor_name`, a.Surgery as `Surgery`, a.Date_of_Surgery as `surgery_date`, a.Time_of_Surgery,  sum(IFNULL(d.bill_Amount,0)) as `Amount` ";
        $presql = " from eye_operation_record a
                    join case_master b on a.case_id = b.id
                    left join (select max(id) as id, case_number from case_master where is_deleted = 0 group by case_number) bb on b.case_number = bb.case_number 
                    left join doctors c on a.Surgeon = c.id
                    left join bill_details d on a.case_id = d.case_id and d.department = 'Operation'
				   ";
        $presql .= " WHERE 1=1 ";
        if ($GET['search_value']) {
            $presql .= " and a.procedure_surgery_done '%".$GET['search_value']."%' ";
        }
        if ($GET['columns_1_search_value']) {
            $presql .= " and c.id = '".$GET['columns_1_search_value']."' ";
        }
        if ($GET['columns_2_search_value']) {
            $fromDate = Carbon::createFromFormat('d/M/Y', $GET['columns_2_search_value'])->format('Y-m-d');
            $presql .= " and a.Date_of_Surgery >= '".$fromDate."' ";
        }
        if ($GET['columns_3_search_value']) {
            $toDate = Carbon::createFromFormat('d/M/Y', $GET['columns_3_search_value'])->format('Y-m-d');
            $presql .= " and a.Date_of_Surgery <= '".$toDate."' ";
        }
        $presql .= " group by a.case_number ";

        $orderByStr = " order by 1 desc";
        //$orderColum = ( isset( $GET['order'][0]['column'] ) && is_numeric( $GET['order'][0]['column'] ) ) ? intval( $GET['order'][0]['column'] )+1 : 1;

        if( isset( $GET['order_0_column'] ) && is_numeric( $GET['order_0_column'] ) ){
            $orderColum = intval( $GET['order_0_column'] )+1;
            $orderByStr = " order by ". $orderColum . " " . $GET['order_0_dir'];
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
        
        return array($results, $count, $sql);
        //return ['results'=>$results, 'count'=>$count];
    }

    public function printSurgeryReport(Request $request){

        $GET = array('columns_1_search_value'=>$request->doctorName, 'columns_2_search_value'=>$request->fromDate, 'columns_3_search_value'=>$request->ToDate, 'length'=>null, 'start'=>null, 'search_value'=> null);

        list($results, $count, $sql) = $this->getSurgeryReportData($GET);

        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();

        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
        return view('doctorBill.printSurgeryReport',['doctorlist'=>$doctorlist, 'results'=>$results,'logoUrl'=>$logoUrl]);

        /*$doctor = doctor::find($request->doctorName);
        $doctorbill = new DoctorBill;
        if(!empty($request->doctorName)){
            $doctorbill = $doctorbill->where('doctor_Id',$request->doctorName);
        }
        if(!empty($request->fromDate)){
            $fromDate = Carbon::createFromFormat('d/M/Y', $request->fromDate)->format('Y-m-d');
            $doctorbill = $doctorbill->whereDate('billed_date','>=',$fromDate);
        }
        if(!empty($request->ToDate)){
            $ToDate = Carbon::createFromFormat('d/M/Y', $request->ToDate)->format('Y-m-d');
            $doctorbill = $doctorbill->whereDate('billed_date','<=',$ToDate);
        }
        $doctorbill = $doctorbill->orderBy('id', 'DESC')->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('doctorBill.printReport', ['doctor'=>$doctor, 'billdata'=>$doctorbill, 'logoUrl'=>$logoUrl]);*/


    }

    #endregion




}