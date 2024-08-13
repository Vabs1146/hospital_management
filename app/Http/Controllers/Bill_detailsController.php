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

class Bill_detailsController extends AdminRootController
{
    //

 public function __construct()
    {        
        $this->acc=0;
        $this->commonHelper = new CommonHelper();
    }

    public function index(Request $request)
    {
        return view('bill_details.index', []);
    }

    public function create(Request $request)
    {
        return view('bill_details.add', [
            []
        ]);
    }

	public function getBalanceAmount($case_number){
        
		$previous_bill_details = Case_master::where('case_number', $case_number)->select('billAmount','paidAmount')->get();
		
		$total_bill = 0;
		$total_paid = 0;
		$balance = 0;
		foreach($previous_bill_details as $previous_bill_details_row) {
			$total_bill += ($previous_bill_details_row->billAmount) ?: 0;
			$total_paid += ($previous_bill_details_row->paidAmount) ?: 0;
		}
		$balance = $total_bill - $total_paid;

		return $balance;
    }
	
public function edit(Request $request, $id)
    {
        //$bill_detail = Bill_detail::findOrFail($id);

		$user = Auth::user()->id;
/*
        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='bill_details/edit'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
        //if($acc==1)
        if(1)
        */
        $this->acc = $this->commonHelper->checkUserAccess("1_bill_details",Auth::user()->id, 'edit_permission');
        if ($this->acc == 1) {
            $Case_master = Case_master::findOrFail($id);
		
		//dd($Case_master);
			$payment_modes = PaymentModes::all();
			$doctors = doctor::where('isActive', '1')->orderBy('id', 'desc')->get();

			//$fees_details = FeesDetails::all();
			$doctor_array = []; $payment_modes_array = []; $fees_details_array = [];
			foreach($doctors as $doctors_row) {
				$doctor_array[$doctors_row->id] = $doctors_row->doctor_name;
			}

			foreach($payment_modes as $payment_modes_row) {
				$payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
			}

			$fees_details = FeesDetails::all();

			foreach($fees_details as $fees_details_row) {
				$fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
			}

			$payment_details = DB::table('opd_bill_payments')->where('case_id', $Case_master->id)->get();
			
			$total_paid = DB::table('opd_bill_payments')->where('case_id', $Case_master->id)->sum('paid_Amount');
                        
                       
                                
                                $doctor_fees_details = FeesDetails::where('doctor_id', $Case_master->doctor_id)->get();
		

			//dd($total_paid);
$patient_activity = DB::table('patient_activity')->where(['case_id' => $Case_master->id, 'activity_type' => 'patient_billing'])->first();



        return view('bill_details.add', ['model' => $this->bill_data($Case_master), 'payment_modes' => $payment_modes, 'doctors' => $doctors, 'doctor_array' => $doctor_array, 'payment_modes_array' => $payment_modes_array, 'fees_details_array' => $fees_details_array, 'balance_amount' => $this->getBalanceAmount($Case_master->case_number), 'payment_details' => $payment_details, 'total_paid' => $total_paid, 'patient_activity' => $patient_activity, 'doctor_fees_details' => $doctor_fees_details]);
        }
          else
        {
            
         $url= url()->previous();
           return redirect($url);
        }

        
    }
    public function bill_data(Case_master $Case_master){
        $DateWiseRecordLst = Case_master::where('case_number', $Case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', DB::Raw("IF(bill_date ,bill_date, created_at) as created_at"))->get();
        return  ['case_master' => $Case_master, 'DateWiseRecordLst' => $DateWiseRecordLst,  'bill_data' => $Case_master->Opd_bill()->get(), 'bill_item'=>'', 'bill_Amount'=>''];
    }
    public function show(Request $request, $id)
    {
       // $bill_detail = Bill_detail::findOrFail($id);
		
		 $bill_detail = DB::table('bill_details')->where('id', $id)->first();
        return view('bill_details.show', [
            'model' => $bill_detail     ]);
    }

    public function grid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT *,1,2 ";
        $presql = " FROM bill_details a ";
        if($_GET['search']['value']) {  
            $presql .= " WHERE case_number LIKE '%".$_GET['search']['value']."%' ";
        }
        
        $presql .= "  ";

        $sql = $select.$presql." LIMIT ".$start.",".$len;


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

        echo json_encode($ret);

    }


    public function update(Request $request) {
        //dd($request->all());
        $case_gen = Case_master::where('case_number', $request['case_number'])->where('id', $request['id'])->first();
        if(is_null($case_gen)){
            return redirect()->back()->withInput()->withErrors(array('message' => 'No patient found.'));
        }
        //check which submit was clicked on
        if (Input::get('Item_Add')) {
            return  $this->Add_BillItem($request,$case_gen); //if login then use this method
        } 
		if (Input::get('Payment_Add')) {
            return  $this->Add_BillPayment($request,$case_gen); //if login then use this method
        } 
        if (Input::get('delete_item')) {
            return  $this->delete_item($request,$case_gen); //if register then use this method
        }
		if (Input::get('delete_payment_item')) {
            return  $this->delete_payment_item($request,$case_gen); //if register then use this method
        }
        if (Input::get('save_bill')) {
            return  $this->save_bill($request,$case_gen); //if register then use this method
        }
        if (Input::get('save_print_bill')) {
            return  $this->save_print_bill($request,$case_gen); //if register then use this method
        }

    }

    public function Add_BillItem(Request $request, Case_master $case_master){
        $this->validate($request, [
            'doctor_id' => 'required|not_in:0',
            'bill_item' => 'required|not_in:0',
            'bill_Amount' => 'required',
            'case_number' => 'required',
			//'payment_mode'=>'required|not_in:0'
        ]);

		//dd($request->all());

        $req_bill_item = new Opd_bill;
        $req_bill_item->case_number = $case_master->case_number;
        $req_bill_item->bill_item = $request['bill_item'];
        $req_bill_item->bill_Amount = $request->bill_Amount;
        $req_bill_item->case_id = $request['id'];
        $req_bill_item->department = $request['department'];
        //$req_bill_item->bill_no = $request['bill_no'];
        //$req_bill_item->payment_mode = $request['payment_mode'];
        $req_bill_item->created_by = AUTH::user()->id;
        $req_bill_item->doctor_id = $request['doctor_id'];
   
        $req_bill_item->save();
		
		$discount = ($request->bill_discount != "") ? $request->bill_discount : 0;
        $case_master->paidAmount = $request->paidAmount;
        $case_master->payment_mode = $request->payment_mode;
        $case_master->tax_percentage = $request->tax_percentage;
        $case_master->billAmount = $case_master->Opd_bill()->sum('bill_Amount') - $discount;
        $case_master->sub_total = $request->sub_total;
        $case_master->bill_discount = $request->bill_discount;
        $case_master->bill_number = $request->bill_number;
        $case_master->bill_created_by = AUTH::user()->id;
        $case_master->save();

		//dd($case_master);
        return redirect()->back()->withInput()->with('flash_message', 'OPD Bill Item added successfully');
    }

	public function Add_BillPayment(Request $request, Case_master $case_master){

		

        $this->validate($request, [
            'payment_date' => 'required|not_in:0',
            'payment_mode' => 'required|not_in:0',
            'payment_Amount' => 'required',
            'case_number' => 'required',
        ]);

		$inset_data = array(
			'case_number' => $case_master->case_number,	
			'paid_Amount' => $request->payment_Amount,	
			'payment_date' => date('Y-m-d',strtotime($request->payment_date)),	
			'created_at' => date('Y-m-d h:i:s',strtotime('now')),	
			'case_id' => $request->id,	
			'payment_mode' => $request->payment_mode,	
			'created_by' => AUTH::user()->id	
		);

		DB::table('opd_bill_payments')->insert($inset_data);

		

		$total_paid = DB::table('opd_bill_payments')->where('case_id', $request->id)->sum('paid_Amount');

		//dd($total_paid);
		
		$case_master->paidAmount = $total_paid;
        $case_master->save();

		//dd($case_master);
        return redirect()->back()->withInput()->with('flash_message', 'OPD Bill Updated added successfully');
    }

    public function delete_item(Request $request, Case_master $case_master){
        
        $billdetail = Opd_bill::findOrFail($request['delete_item']);
        if ($billdetail === null) {
            return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
        }
        $billdetail->delete();
    
        return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
    }

	public function delete_payment_item(Request $request, Case_master $case_master){
        
        $billdetail = DB::table('opd_bill_payments')->where('id', $request['delete_payment_item'])->first();
        if ($billdetail === null) {
            return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
        }
        DB::table('opd_bill_payments')->where('id', $request['delete_payment_item'])->delete();

		$total_paid = DB::table('opd_bill_payments')->where('case_id', $case_master->id)->sum('paid_Amount');
		$case_master->paidAmount = $total_paid;
		$case_master->save();
    
        return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
    }

    public function save_bill(Request $request, Case_master $case_master) {
		//dd($request->all());
		$total_paid = DB::table('opd_bill_payments')->where('case_id', $request->id)->sum('paid_Amount');

        $case_master->paidAmount = $total_paid;
        $case_master->payment_mode = $request->payment_mode;
        $case_master->tax_percentage = $request->tax_percentage;


		$discount = ($request->bill_discount != "") ? $request->bill_discount : 0;

        $case_master->billAmount = $case_master->Opd_bill()->sum('bill_Amount') - $discount;
        $case_master->sub_total = $request->sub_total;
        $case_master->bill_discount = $request->bill_discount;

		if($request->bill_date) {
			$case_master->bill_date = date('Y-m-d', strtotime($request->bill_date));
		}
		if($case_master->bill_number == "") {
			$case_master->bill_number = $this->generate_bill_number();
		}
        $case_master->bill_created_by = AUTH::user()->id;

        $case_master->save();
        

        return redirect()->back()->withInput()->with('flash_message', 'Case Master Record saved successfully'); 
    }

	public function save_print_bill(Request $request, Case_master $case_master) {
		
        $total_paid = DB::table('opd_bill_payments')->where('case_id', $request->id)->sum('paid_Amount');

        $case_master->paidAmount = $total_paid;
        $case_master->tax_percentage = $request->tax_percentage;

        $discount = ($request->bill_discount != "") ? $request->bill_discount : 0;

        $case_master->billAmount = $case_master->Opd_bill()->sum('bill_Amount') - $discount;
        $case_master->sub_total = $request->sub_total;
        $case_master->bill_discount = $request->bill_discount;
        if($case_master->bill_number == "") {
			$case_master->bill_number = $this->generate_bill_number();
		}
		if($request->bill_date) {
			$case_master->bill_date = date('Y-m-d', strtotime($request->bill_date));
		}
        $case_master->bill_created_by = AUTH::user()->id;

        $case_master->save();
        $helperCls = new drAppHelper();
        $pay=$case_master->pay()->get();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();

        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', DB::Raw("IF(bill_date ,bill_date, created_at) as created_at"))->get();

        //---------------------------------------------------------
        $payment_modes = PaymentModes::all();
        $doctors = doctor::where('isActive', '1')->orderBy('id', 'desc')->get();

        //$fees_details = FeesDetails::all();
		$doctor_array = []; $payment_modes_array = []; $fees_details_array = [];
        foreach($doctors as $doctors_row) {
                $doctor_array[$doctors_row->id] = $doctors_row->doctor_name;
        }

        foreach($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }

        $fees_details = FeesDetails::all();

        foreach($fees_details as $fees_details_row) {
                $fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
        }
        //---------------------------------------------------------------
		//dd($Case_master);
		$payment_details = DB::table('opd_bill_payments')->where('case_id', $request->id)->get();
			
		$total_paid = DB::table('opd_bill_payments')->where('case_id', $request->id)->sum('paid_Amount');
		
		$header_footer_data = Image_gallery::whereIn('imgTypeId', ['4','5'])->pluck('isActive','imgTypeId')->toArray();

		//dd($header_footer_data);
        return view('bill_details.print', ['casedata' => $case_master, 'billdata' => $case_master->Opd_bill()->get(),'pay' => $pay, 'logoUrl'=>$logoUrl,'DateWiseRecordLst'=>$DateWiseRecordLst,'case_master'=>$case_master, 'payment_modes' => $payment_modes, 'doctors' => $doctors, 'doctor_array' => $doctor_array, 'payment_modes_array' => $payment_modes_array, 'fees_details_array' => $fees_details_array, 'payment_details' => $payment_details, 'total_paid' => $total_paid, 'header_footer_data' => $header_footer_data, 'convert_to_words' => $this->commonHelper]);
        //return redirect()->back()->withInput()->with('flash_message', 'Record saved successfully');
    }

    public function print_bill($id) {

     $user = Auth::user()->id;
     /*
        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='bill_details/print'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
        if($acc==1)
        {
            */
    $this->acc = $this->commonHelper->checkUserAccess("1_bill_details",Auth::user()->id, 'view_permission');
        if ($this->acc == 1) {
            $case_gen = Case_master::findOrFail($id);
        if(is_null($case_gen)){
            return redirect()->back()->withInput()->withErrors(array('message' => 'No patient found.'));
        }
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $billdata = $case_gen->Opd_bill()->get();
        $case_master  = Case_master::findOrFail($id);
		$pay=$case_master->pay()->get();
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', DB::Raw("IF(bill_date ,bill_date, created_at) as created_at"))->get();

		
		//---------------------------------------------------------
		$payment_modes = PaymentModes::all();
		$doctors = doctor::where('isActive', '1')->orderBy('id', 'desc')->get();

		//$fees_details = FeesDetails::all();
$doctor_array = []; $payment_modes_array = []; $fees_details_array = [];
		foreach($doctors as $doctors_row) {
			$doctor_array[$doctors_row->id] = $doctors_row->doctor_name;
		}

		foreach($payment_modes as $payment_modes_row) {
			$payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
		}

		$fees_details = FeesDetails::all();

		foreach($fees_details as $fees_details_row) {
			$fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
		}
		//---------------------------------------------------------------
		
		$payment_details = DB::table('opd_bill_payments')->where('case_id', $case_master->id)->get();
			
		//	dd($case_master);
		$total_paid = DB::table('opd_bill_payments')->where('case_id', $case_master->id)->sum('paid_Amount');
		$header_footer_data = Image_gallery::whereIn('imgTypeId', ['4','5'])->pluck('isActive','imgTypeId')->toArray();

                //$convert_to_words = $this->commonHelper;
                
        return view('bill_details.print', ['casedata' => $case_gen, 'billdata' => $case_gen->Opd_bill()->get(), 'pay' => $pay,'logoUrl'=>$logoUrl,'DateWiseRecordLst'=>$DateWiseRecordLst,'case_master'=>$case_master, 'payment_modes' => $payment_modes, 'doctors' => $doctors, 'doctor_array' => $doctor_array, 'payment_modes_array' => $payment_modes_array, 'fees_details_array' => $fees_details_array, 'payment_details' => $payment_details, 'total_paid' => $total_paid, 'header_footer_data' => $header_footer_data, 'convert_to_words' => $this->commonHelper]);
        }
         else
        {
            
         $url= url()->previous();
           return redirect($url);
        }
        
    }

    public function store(Request $request)
    {
        return $this->update($request);
    }

    public function destroy(Request $request, $id) {
        
        $bill_detail = Bill_detail::findOrFail($id);

        $bill_detail->delete();
        return "OK";
        
    }

    #region Doctor bill report
    public function ViewReport(Request $request) {
        //$doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

      $user = Auth::user()->id;
        $doctor=DB::select("SELECT * FROM `doctors` ORDER BY `doctor_name` ASC");
        /*
        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='opdpatientbill/report'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
        if($acc==1)
        {
            */
        $this->acc = $this->commonHelper->checkUserAccess("1_bill_details",Auth::user()->id);
        if ($this->acc == 1) { 
			$all_users_array = []; $payment_modes_array = []; $fees_details_array = [];
			$payment_modes = PaymentModes::all();
		
		foreach($payment_modes as $payment_modes_row) {
			$payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
		}

		$fees_details = FeesDetails::all();

		foreach($fees_details as $fees_details_row) {
			$fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
		}

		$all_users = User::all();

		foreach($all_users as $all_users_row) {
			$all_users_array[$all_users_row->id] = $all_users_row->name;
		}

            return view('bill_details.ViewReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array'));
        }
          else
        {
         $url= url()->previous();
           return redirect($url);
        }
            
       
    }
	
	 public function reportGrid(Request $request) {
        $len = $_GET['length'];
        $start = $_GET['start'];
DB::enableQueryLog();
	$select = "SELECT date(a.created_at) as `Date`, u.name, doctors.doctor_name,b.patient_name, b.bill_number, df.fees_details as bill_item, a.bill_Amount, b.sub_total, b.bill_discount, b.paidAmount, (b.sub_total - b.paidAmount) as balance, a.case_id as id";
        $presql = " FROM opd_bill a INNER join case_master b on a.case_id = b.id LEFT JOIN  doctors ON doctors.id=b.doctor_id LEFT join doctor_fees df on df.id = a.bill_item  LEFT JOIN payment_modes pm ON pm.id=a.payment_mode LEFT JOIN users u ON u.id=a.created_by ";

        $presql .= " WHERE 1=1 and b.is_deleted = 0 ";//AND b.doctor_id='$docid'";

        if ($_GET['search']['value']) {
            $presql .= " and bill_item LIKE '%".$_GET['search']['value']."%' ";
        }
        if ($_GET['columns'][1]['search']['value']) {
            $presql .= " and b.doctor_id LIKE '%".$_GET['columns'][1]['search']['value']."%' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
        //$fromDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][2]['search']['value'])->format('Y-m-d');
            $fromDate =  $_GET['columns'][2]['search']['value'];
            //$presql .= " and a.created_at >= '".$fromDate."' ";
               $presql .= "and date(a.created_at) >='".$fromDate."' ";

        }
        if ($_GET['columns'][3]['search']['value']) {
            //$toDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][3]['search']['value'])->format('Y-m-d');
              $toDate = $_GET['columns'][3]['search']['value'];
            //$presql .= " and a.created_at <= '".$toDate."' ";
             $presql .= " and date(a.created_at) <= '".$toDate."' ";
        }

		if ($_GET['columns'][4]['search']['value']) {
            $presql .= " and a.bill_item = '".$_GET['columns'][4]['search']['value']."' ";
        }

		if ($_GET['columns'][5]['search']['value']) {
            $presql .= " and a.payment_mode = '".$_GET['columns'][5]['search']['value']."' ";
        }

		if ($_GET['columns'][6]['search']['value']) {
            $presql .= " and a.created_by = '".$_GET['columns'][6]['search']['value']."' ";
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
		$case_id = "";
                $query_str = DB::getQueryLog();
                //dd($query_str);
                
        foreach ($results as $row) {
			if($case_id != "" && $case_id != $row->id) {
			$case_id = $row->id;
				
				$prev_val[0] = '';
				$prev_val[1] = '';
				$prev_val[2] = '';
				$prev_val[3] = '';
				$prev_val[4] = '';
				$prev_val[5] = '';
				$prev_val[6] = '';

				//$prev_val[7] = '';
				//$prev_val[8] = '';
				//$prev_val[9] = '';
				//$prev_val[0] = '';

				
            //$prev_val[11] = floatval($prev_val[8]) - floatval($prev_val[9]);
            //$prev_val[12] =  floatval($prev_val[8]) - floatval($prev_val[9]) - floatval($prev_val[10]);
                                
            $prev_val[10] = floatval($prev_val[7]) - floatval($prev_val[8]);
        $prev_val[11] =  floatval($prev_val[7]) - floatval($prev_val[8]) - floatval($prev_val[9]);

				$ret[] = $prev_val;
			} else {
				$case_id = $row->id;
			}
            $r = [];
            foreach ($row as $value) {
                $r[] = $value;
            }
			
			$r[11] = '';
			$r[12] = '';
			$prev_val = $r;
			$r[7] = '';
			$r[8] = '';
			$r[9] = '';
			$r[10] = '';
			
            $ret[] = $r;
        }

        //----------------------------------------------------
        $prev_val[0] = '';
        $prev_val[1] = '';
        $prev_val[2] = '';
        $prev_val[3] = '';
        $prev_val[4] = '';
        $prev_val[5] = '';
        $prev_val[6] = '';
        //$prev_val[7] = '';
        //$prev_val[8] = '';
        //$prev_val[9] = '';
        //$prev_val[0] = '';


        //$prev_val[11] = floatval($prev_val[8]) - floatval($prev_val[9]);
        //$prev_val[12] =  floatval($prev_val[8]) - floatval($prev_val[9]) - floatval($prev_val[10]);
        
        $prev_val[10] = floatval($prev_val[7]) - floatval($prev_val[8]);
        $prev_val[11] =  floatval($prev_val[7]) - floatval($prev_val[8]) - floatval($prev_val[9]);
        
        //dd($prev_val);
        $ret[] = $prev_val;
        //--------------------------------------------------

        $ret['data'] = $ret;
        $ret['recordsTotal'] = $count;
        $ret['iTotalDisplayRecords'] = $count;

        $ret['recordsFiltered'] = count($ret);
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }
	
   
    
       public function gettotal()
    {

        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT sum('opd_bill.bill_Amount') ";
        $presql = " FROM opd_bill a
                    INNER join case_master b on a.case_id = b.id  JOIN doctors ON doctors.id=b.doctor_id 
                  ";
        $presql .= " WHERE 1=1 and b.is_deleted = 0 ";//AND b.doctor_id='$docid'";
        if ($_GET['search']['value']) {
            $presql .= " and bill_item LIKE '%".$_GET['search']['value']."%' ";
        }
        if ($_GET['columns'][1]['search']['value']) {
            $presql .= " and b.doctor_id LIKE '%".$_GET['columns'][1]['search']['value']."%' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
            $fromDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][2]['search']['value'])->format('Y-m-d');
            $presql .= " and a.created_at >= '".$fromDate."' ";
        }
        if ($_GET['columns'][3]['search']['value']) {
            $toDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][3]['search']['value'])->format('Y-m-d');
            $presql .= " and a.created_at <= '".$toDate."' ";
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
        //$sum=DB::select("SELECT sum(bill_Amount) FROM `opd_bill`");
        // $sum= Opd_bill::where('case_master.doctor_id', $docid)
        //             ->leftJoin('case_master', 'opd_bill.case_id', '=', 'case_master.id')->sum('opd_bill.bill_Amount');
                    
           return $sum;
       // $sum=  DB::table("opd_bill")JOIN("case_master")ON(Case_master)->get();
//echo json_encode($sum);
    }
    
    public function printReport(Request $request) {

        $doctorbill = new Opd_bill;
        if(!empty($request->searchName)){
            $doctorbill = $doctorbill->Case_master->where('patient_name',$request->searchName);
        }
        if(!empty($request->fromDate)){
            $fromDate = Carbon::createFromFormat('d/M/Y', $request->fromDate)->format('Y-m-d');
            $doctorbill = $doctorbill->whereDate('created_at','>=',$fromDate);
        }
        if(!empty($request->ToDate)){
            $ToDate = Carbon::createFromFormat('d/M/Y', $request->ToDate)->format('Y-m-d');
            $doctorbill = $doctorbill->whereDate('created_at','<=',$ToDate);
        }
        $doctorbill = $doctorbill->orderBy('id', 'DESC')->get();
        $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
        return view('bill_details.PrintReport', ['billdata'=>$doctorbill, 'logoUrl'=>$image_gallery->imgUrl]);

    }

    #endregion

	public function get_fees_details($doctor_id) {
		$fees_details = FeesDetails::where('doctor_id', $doctor_id)->get();
		//dd($fees_details);
		$options_html = '<option value="0" >Select Fees Detail</option>';
		foreach($fees_details as $fees_details_row) {
			$options_html .= '<option value="'.$fees_details_row->id.'" >'.$fees_details_row->fees_details.'</option>';
		}

		echo $options_html;
	}

	public function get_fees($fees_id) {
		$fees_detail = FeesDetails::where('id', $fees_id)->first();
		
		echo $fees_detail->fees_amount;
	}
        
        public function generate_bill_number() {
            $settings = Setting::where('name','bill_pointer')->first();
        
            if(!$settings->value) {
                $bill_number_data = Setting::where('name','bill_number')->first();

                $bill_number = $bill_number_data->value;
            } else {
                $pad_number = strlen($settings->value);
                $bill_number_ = $settings->value + 1;

                $bill_number = str_pad($bill_number_,$pad_number,"0",STR_PAD_LEFT);
            }

            $settings->value = $bill_number;

            $settings->save();
            
            return $bill_number;
        }


	//payment listing 

	#region Doctor bill report
    public function ViewPaymentReport(Request $request) {


		//$select = "SELECT date(a.created_at) as `Date`, u.name, doctors.doctor_name,b.patient_name, b.bill_number, df.fees_details as bill_item, a.bill_Amount, b.sub_total, b.bill_discount, b.paidAmount, (b.sub_total - b.paidAmount) as balance, a.case_id as id";
        //$presql = " FROM opd_bill a INNER join case_master b on a.case_id = b.id LEFT JOIN  doctors ON doctors.id=b.doctor_id LEFT join doctor_fees df on df.id = a.bill_item  LEFT JOIN payment_modes pm ON pm.id=a.payment_mode LEFT JOIN users u ON u.id=a.created_by ";
/*

$select = "SELECT date(a.payment_date) as `Date`, u.name, doctors.doctor_name,b.patient_name, b.bill_number, pm.name as payment_mode_name, a.paid_Amount as payments, b.paidAmount as total_paid, (b.sub_total - b.paidAmount) as balance, a.case_id as id";
        $presql = " FROM opd_bill_payments a INNER join case_master b on a.case_id = b.id LEFT JOIN  doctors ON doctors.id=b.doctor_id LEFT JOIN payment_modes pm ON pm.id=a.payment_mode LEFT JOIN users u ON u.id=a.created_by ";
       
$sql = $select.$presql;
 $results = DB::select($sql);


 

 echo "========>>>>>>> <pre>"; print_r($ret); exit;
*/

        //$doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

      $user = Auth::user()->id;
        $doctor=DB::select("SELECT * FROM `doctors` ORDER BY `doctor_name` ASC");
        /*
        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='opdpatientbill/report'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
        if($acc==1)
        {
            */
        $this->acc = $this->commonHelper->checkUserAccess("1_bill_details",Auth::user()->id);
        if ($this->acc == 1) { 
			$all_users_array = []; $payment_modes_array = []; $fees_details_array = [];
			$payment_modes = PaymentModes::all();
		
		foreach($payment_modes as $payment_modes_row) {
			$payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
		}

		$fees_details = FeesDetails::all();

		foreach($fees_details as $fees_details_row) {
			$fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
		}

		$all_users = User::all();

		foreach($all_users as $all_users_row) {
			$all_users_array[$all_users_row->id] = $all_users_row->name;
		}

            return view('bill_details.ViewPaymentReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array'));
        }
          else
        {
         $url= url()->previous();
           return redirect($url);
        }
            
       
    }
	
	 public function reportPaymentGrid(Request $request) {
        $len = $_GET['length'];
        $start = $_GET['start'];

		$select = "SELECT date(a.payment_date) as `Date`, u.name, doctors.doctor_name,b.patient_name, b.bill_number, pm.name as payment_mode_name, a.paid_Amount as payments, b.paidAmount as total_paid, (b.sub_total - b.paidAmount) as balance, a.case_id as id";
        $presql = " FROM opd_bill_payments a INNER join case_master b on a.case_id = b.id LEFT JOIN  doctors ON doctors.id=b.doctor_id LEFT JOIN payment_modes pm ON pm.id=a.payment_mode LEFT JOIN users u ON u.id=a.created_by ";

        $presql .= " WHERE 1=1 and b.is_deleted = 0 ";//AND b.doctor_id='$docid'";

       
        if ($_GET['columns'][1]['search']['value']) {
            $presql .= " and b.doctor_id LIKE '%".$_GET['columns'][1]['search']['value']."%' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
        //$fromDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][2]['search']['value'])->format('Y-m-d');
            $fromDate =  $_GET['columns'][2]['search']['value'];
            //$presql .= " and a.created_at >= '".$fromDate."' ";
               $presql .= "and date(a.payment_date) >='".$fromDate."' ";

        }
        if ($_GET['columns'][3]['search']['value']) {
            //$toDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][3]['search']['value'])->format('Y-m-d');
              $toDate = $_GET['columns'][3]['search']['value'];
            //$presql .= " and a.created_at <= '".$toDate."' ";
             $presql .= " and date(a.payment_date) <= '".$toDate."' ";
        }

		

		if ($_GET['columns'][4]['search']['value']) {
            $presql .= " and a.payment_mode = '".$_GET['columns'][4]['search']['value']."' ";
        }

		if ($_GET['columns'][5]['search']['value']) {
            $presql .= " and a.created_by = '".$_GET['columns'][5]['search']['value']."' ";
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
		$case_id = "";
		
		if(!empty($results)) {
        foreach ($results as $row) {
			if($case_id != "" && $case_id != $row->id) {
			$case_id = $row->id;
				
				$prev_val[0] = '';
				$prev_val[1] = '';
				$prev_val[2] = '';
				$prev_val[3] = '';
				$prev_val[4] = '';
				$prev_val[5] = '';
				$prev_val[6] = '';

				//$prev_val[7] = '';
				//$prev_val[8] = '';
				//$prev_val[9] = '';
				//$prev_val[0] = '';

				
				

				$ret[] = $prev_val;
			} else {
				$case_id = $row->id;
			}
            $r = [];
            foreach ($row as $value) {
				
                $r[] = $value;

				unset($r[9]);
            }
			
			
			$prev_val = $r;
			$r[7] = '';
			$r[8] = '';
			
			
            $ret[] = $r;
        }

		//----------------------------------------------------
				$prev_val[0] = '';
				$prev_val[1] = '';
				$prev_val[2] = '';
				$prev_val[3] = '';
				$prev_val[4] = '';
				$prev_val[5] = '';
				$prev_val[6] = '';
				

			
				
				$ret[] = $prev_val;
		}
		//--------------------------------------------------

        $ret['data'] = $ret;
        $ret['recordsTotal'] = $count;
        $ret['iTotalDisplayRecords'] = $count;

        $ret['recordsFiltered'] = count($ret);
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }
    
    
    public function ViewOpdReport(Request $request) {
        //$doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

      $user = Auth::user()->id;
        $doctor=DB::select("SELECT * FROM `doctors` ORDER BY `doctor_name` ASC");
       
        $this->acc = $this->commonHelper->checkUserAccess("1_bill_details",Auth::user()->id);
        if ($this->acc == 1) { 
			$all_users_array = []; $payment_modes_array = []; $fees_details_array = [];
			$payment_modes = PaymentModes::all();
		
		foreach($payment_modes as $payment_modes_row) {
			$payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
		}

		$fees_details = FeesDetails::all();

		foreach($fees_details as $fees_details_row) {
			$fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
		}

		$all_users = User::all();

		foreach($all_users as $all_users_row) {
			$all_users_array[$all_users_row->id] = $all_users_row->name;
		}

            return view('bill_details.ViewOpdReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array'));
        }
          else
        {
         $url= url()->previous();
           return redirect($url);
        }
    }
    
    
	
    public function opdReportGrid(Request $request) {
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

        $presql .= " WHERE 1=1 and b.is_deleted = 0 ";//AND b.doctor_id='$docid'";

        if ($_GET['search']['value']) {
            $presql .= " and bill_item LIKE '%".$_GET['search']['value']."%' ";
        }
        if ($_GET['columns'][1]['search']['value']) {
            $presql .= " and b.doctor_id LIKE '%".$_GET['columns'][1]['search']['value']."%' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
        //$fromDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][2]['search']['value'])->format('Y-m-d');
            $fromDate =  $_GET['columns'][2]['search']['value'];
            //$presql .= " and a.created_at >= '".$fromDate."' ";
               $presql .= "and date(a.created_at) >='".$fromDate."' ";

        }
        if ($_GET['columns'][3]['search']['value']) {
            //$toDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][3]['search']['value'])->format('Y-m-d');
              $toDate = $_GET['columns'][3]['search']['value'];
            //$presql .= " and a.created_at <= '".$toDate."' ";
             $presql .= " and date(a.created_at) <= '".$toDate."' ";
        }

        if ($_GET['columns'][4]['search']['value']) {
            $presql .= " and a.bill_item = '".$_GET['columns'][4]['search']['value']."' ";
        }

        if ($_GET['columns'][5]['search']['value']) {
            $presql .= " and a.payment_mode = '".$_GET['columns'][5]['search']['value']."' ";
        }

        if ($_GET['columns'][6]['search']['value']) {
            $presql .= " and a.created_by = '".$_GET['columns'][6]['search']['value']."' ";
        }
        $presql .= "  ";

        $orderByStr = " order by 1 desc";
        //$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;

        if( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ){
            $orderColum = intval( $_GET['order'][0]['column'] )+1;
            $orderByStr = " order by ". $orderColum . " " . $_GET['order'][0]['dir'];
        }

        if($len > 0) {
            $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;
        } else {
            $sql = $select.$presql.$orderByStr;
        }


        $qcount = DB::select("SELECT COUNT(b.id) c".$presql);
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

        $ret['data'] = $ret;
        $ret['recordsTotal'] = $count;
        $ret['iTotalDisplayRecords'] = $count;

        $ret['recordsFiltered'] = count($ret);
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }
    
    public function todayViewOpdReport(Request $request) {
        //$doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

      $user = Auth::user()->id;
        $doctor=DB::select("SELECT * FROM `doctors` ORDER BY `doctor_name` ASC");
       
        $this->acc = $this->commonHelper->checkUserAccess("1_bill_details",Auth::user()->id);
        if ($this->acc == 1) { 
			$all_users_array = []; $payment_modes_array = []; $fees_details_array = [];
			$payment_modes = PaymentModes::all();
		
		foreach($payment_modes as $payment_modes_row) {
			$payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
		}

		$fees_details = FeesDetails::all();

		foreach($fees_details as $fees_details_row) {
			$fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
		}

		$all_users = User::all();

		foreach($all_users as $all_users_row) {
                    $all_users_array[$all_users_row->id] = $all_users_row->name;
		}
                
                $ophtometry_users_array = array();
                foreach($all_users as $all_users_row) {
                    if($all_users_row->role == '4') {
                        $ophtometry_users_array[$all_users_row->id] = $all_users_row->name;
                    }
		}
                
            $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
            
            return view('bill_details.todayViewOpdReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array', 'form_dropdowns', 'ophtometry_users_array'));
        }
          else
        {
         $url= url()->previous();
           return redirect($url);
        }
    }
	
    public function todayOpdReportGrid(Request $request) {
        
        //dd($_REQUEST);
        $len = $_GET['length'];
        $start = $_GET['start'];

        //$select = "SELECT a.id,  a.case_number, `patient_name`,  e.doctor_name,`patient_mobile`, a.patient_age , `patient_emailId`,`referedby`, e.doctor_name, DATE_FORMAT(a.updated_at, \"%d %b %Y\"), 1,2, DATE(a.updated_at)= DATE(NOW())";
        
        $url = url('/').'/uploads/';
        
        $select = "SELECT "
                . " date(a.created_at) as `Date`, "
                . " a.visit_time,"
                . " a.case_number,"
                . " a.uhid_no, "
                . " CONCAT(COALESCE(a.`mr_mrs_ms`,''), ' ', COALESCE(a.`patient_name`,''), ' ', COALESCE(a.`middle_name`,''), ' ', COALESCE(a.`last_name`,''), ' | ', COALESCE(a.`patient_age`,''), ' | ', COALESCE(a.`area`,'')),"
                //. " a.patient_age, "
                //. " a.male_female, "
                //. " concat('<a target=\'_blank\' href=\'".$url."', a.patient_pic,'\'><img style=\'width:100px;\' src=\'".$url."', "
                //. "a.patient_pic,'\'></a>'), "
                . " e.doctor_name,"
                . " a.referedby, "
                . " optometrist_users.name as optometrist, "
                . " u.name as by_user, "
                //. "u.name as user_name, "
                . "GROUP_CONCAT(diagnosis_tb.field_value_OD) as diagnosis, "
                . "GROUP_CONCAT(surgery_tb.field_value_OD) as procedure_surgery, "
                . "GROUP_CONCAT(vision_tb.field_value_OD) as vision, "
                . " a.surgery_date_time , "
                . " posted_doctor.doctor_name as posted_for_doctor,"
                
                 //. " a.area,"
                 //. " IF(pa1.out_created_time, TIMESTAMPDIFF(MINUTE, a.created_at, pa1.out_timestamp), NULL)  AS waiting_time,"
                
                . " IF(pa1.out_created_time, CONCAT(TIMESTAMPDIFF(MINUTE, a.created_at, pa1.out_timestamp) DIV 60, ' Hours ',    
   TIMESTAMPDIFF(MINUTE, a.created_at, pa1.out_timestamp) % 60, ' Minutes'), NULL)  AS waiting_time,"              
                
                . "GROUP_CONCAT(selected_iol_tb.field_value_OD) as selected_iol, "
                 . " a.is_followup";
                 //. " a.middle_name,"
                 //. " a.last_name,"
                 //. " a.mr_mrs_ms";
        //patient_activity
        //posted_for_doctor
       
        $presql = " FROM case_master a
                    join (select max(id) as id from case_master where is_deleted = 0 group by case_number) b on a.id =b.id 
                    left join timeslots d on a.FollowUpDate = d.id
                    left join doctors c on a.FollowUpDoctor_Id = c.id "
                    ."left join doctors e on a.doctor_id = e.id "
                    ."left join doctors posted_doctor on a.posted_for_doctor = posted_doctor.id "
                    ."LEFT JOIN users u ON u.id = a.created_by  "
                    ."left join patient_activity on patient_activity.case_id = a.id "
                    ."LEFT JOIN users optometrist_users ON optometrist_users.id = patient_activity.created_by  "
                    ."left join eyeform  on eyeform.case_id = a.id "
                    ."left join eyeformmultipleentry diagnosis_tb on diagnosis_tb.eyeformid = eyeform.id AND diagnosis_tb.field_name = 'otherDetailsDiagnosis' "
                    ."left join eyeformmultipleentry surgery_tb on surgery_tb.eyeformid = eyeform.id AND surgery_tb.field_name = 'surgery' "
                    ."left join eyeformmultipleentry vision_tb on vision_tb.eyeformid = eyeform.id AND vision_tb.field_name = 'dvn_od' "
                    ."left join eyeformmultipleentry selected_iol_tb on selected_iol_tb.eyeformid = eyeform.id AND selected_iol_tb.field_name = 'selected_iol' "
                
                    ."left join patient_activity pa1 on pa1.case_id = a.id and pa1.activity_type = 'patient_out'";
                 
                    //LEFT JOIN users u ON u.id=a.created_by 
        
        $orderByStr = " order by 1 desc";
        //=================================================================================================================================
        
        $presql .= " WHERE 1=1 ";
         
          //searchByName      
        if ($_GET['columns'][1]['search']['value']) {
            $patients_arr = json_decode($_GET['columns'][1]['search']['value']);
            
            if($patients_arr[0] != '') {
                $presql .= " and a.mr_mrs_ms = '".$patients_arr[0]."' ";
            }
            if($patients_arr[1] != '') {
                $presql .= " and a.patient_name LIKE '%".$patients_arr[1]."%' ";
            }
            if($patients_arr[2] != '') {
                $presql .= " and a.middle_name LIKE '%".$patients_arr[1]."%' ";
            }
            if($patients_arr[3] != '') {
                $presql .= " and a.last_name LIKE '%".$patients_arr[1]."%' ";
            }
            if($patients_arr[4] != '') {
                $presql .= " and a.area LIKE '%".$patients_arr[4]."%' ";
            }
            /*
            if($patients_arr[5] != '') {
                $presql .= " and a.last_name LIKE '%".$patients_arr[1]."%' ";
            }
            */
        }
        
        //searchByDoctor
        if ($_GET['columns'][2]['search']['value']) {
            //$presql .= " and e.doctor_name LIKE '%".$_GET['columns'][2]['search']['value']."%' ";
            
            $presql .= " and e.id ='".$_GET['columns'][2]['search']['value']."' ";
        }
        //fromDate
        if ($_GET['columns'][3]['search']['value']) {
        //$fromDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][2]['search']['value'])->format('Y-m-d');
            $fromDate =  $_GET['columns'][3]['search']['value'];
            //$presql .= " and a.created_at >= '".$fromDate."' ";
               $presql .= "and date(a.created_at) >='".$fromDate."' ";

        }
        //ToDate
        if ($_GET['columns'][4]['search']['value']) {
            //$toDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][3]['search']['value'])->format('Y-m-d');
              $toDate = $_GET['columns'][4]['search']['value'];
            //$presql .= " and a.created_at <= '".$toDate."' ";
             $presql .= " and date(a.created_at) <= '".$toDate."' ";
        }
        
        
        
        //searchByOptometrist      
        if ($_GET['columns'][5]['search']['value']) {
            //$presql .= " and a.patient_name LIKE '%".$_GET['columns'][5]['search']['value']."%' ";
            
            $presql .= " and optometrist_users.id ='".$_GET['columns'][5]['search']['value']."' ";
        }
          //searchByUser      
        if ($_GET['columns'][6]['search']['value']) {
            //$presql .= " and a.patient_name LIKE '%".$_GET['columns'][6]['search']['value']."%' ";
            
            $presql .= " and u.id ='".$_GET['columns'][6]['search']['value']."' ";
        }
        //searchByReferrer      
        if ($_GET['columns'][7]['search']['value']) {
            $presql .= " and a.referedby LIKE '%".$_GET['columns'][7]['search']['value']."%' ";
        }
        
        
        
        //all_patient_show      
        if ($_GET['columns'][8]['search']['value']) {
            if($_GET['columns'][8]['search']['value'] == '0') {
                 $presql .= " and date(a.updated_at) = '".date('Y-m-d')."' ";
            }
            //$presql .= " and a.referedby LIKE '%".$_GET['columns'][8]['search']['value']."%' ";
        } else {
             $presql .= " and date(a.updated_at) = '".date('Y-m-d')."' ";    
        }
        
        //diagnosis      
        if ($_GET['columns'][9]['search']['value'] != '') {
            $presql .= " and diagnosis_tb.field_value_OD LIKE '%".$_GET['columns'][9]['search']['value']."%' ";
        }
        
        //surgery      
        if ($_GET['columns'][10]['search']['value'] != '') {
            $presql .= " and surgery_tb.field_value_OD LIKE '%".$_GET['columns'][10]['search']['value']."%' ";
        } 
        
        //vision      
        if ($_GET['columns'][11]['search']['value'] != '') {
            $presql .= " and vision_tb.field_value_OD LIKE '%".$_GET['columns'][11]['search']['value']."%' ";
        }
        
        $age_array = array(
            'less_18' => '(a.patient_age < 18)',
            '18_40' => '(a.patient_age BETWEEN 18 AND 40)',
            '41_60' => '(a.patient_age BETWEEN 41 AND 60)',
            '60_more' => '(a.patient_age > 60)'
        );
        
        //patient_age      
        if ($_GET['columns'][12]['search']['value']) {
            $age_key = $_GET['columns'][12]['search']['value'];
            if(isset($age_array[$age_key])) {
                $presql .= " and ".$age_array[$age_key]." ";
            }
        }
        
        //fix_surgery_date      
        if ($_GET['columns'][13]['search']['value']) {
            $fix_surgery_date =  $_GET['columns'][13]['search']['value'];
            //$presql .= " and a.created_at >= '".$fromDate."' ";
            $presql .= "and date(a.surgery_date_time) >='".$fix_surgery_date."' and date(a.surgery_date_time) <='".$fix_surgery_date."' ";
        }
        /*
        //area      
        if (isset($_GET['columns'][14]) && $_GET['columns'][14]['search']['value']) {
            $area =  $_GET['columns'][14]['search']['value'];
            $presql .= " and a.area LIKE '%".$_GET['columns'][14]['search']['value']."%' ";
        }
        */
        
        //waiting_time      
        if (isset($_GET['columns'][15]) && $_GET['columns'][15]['search']['value']) {
            
            $waiting_array = array(
				'1' => '30min. to 1 hours',
				'2' => '1 hours to 2 hours',
				'3' => '2 hours to 3 hours',
				'4' => '> 3 hours',
			);
            
            //$area =  $_GET['columns'][15]['search']['value'];
            //$presql .= " and a.are LIKE '%".$_GET['columns'][14]['search']['value']."%' ";
            
            //IF(pa1.out_created_time, TIMESTAMPDIFF(MINUTE, a.created_at, pa1.out_timestamp), NULL)  AS difference
            
            switch($_GET['columns'][15]['search']['value']) {
                case '1' :
                    $presql .= " and (pa1.out_created_time AND (TIMESTAMPDIFF(MINUTE, a.created_at, pa1.out_timestamp) BETWEEN 30 AND 60)) ";
                    break;
                case '2' :
                    $presql .= " and (pa1.out_created_time AND (TIMESTAMPDIFF(MINUTE, a.created_at, pa1.out_timestamp) BETWEEN 61 AND 120)) ";
                    break;
                case '3' :
                    $presql .= " and (pa1.out_created_time AND (TIMESTAMPDIFF(MINUTE, a.created_at, pa1.out_timestamp) BETWEEN 121 AND 180)) ";
                    break;
                case '4' :
                    $presql .= " and (pa1.out_created_time AND (TIMESTAMPDIFF(MINUTE, a.created_at, pa1.out_timestamp) > 181)) ";
                    break;
                default :
                    //$presql .= " and (pa1.out_created_time AND (TIMESTAMPDIFF(MINUTE, a.created_at, pa1.out_timestamp) > 181)) ";
                    break;
            }
        }
        
        //iol      
        if (isset($_GET['columns'][14]) && $_GET['columns'][14]['search']['value']) {
            $iol =  $_GET['columns'][14]['search']['value'];
            //$presql .= " and a.created_at >= '".$fromDate."' ";
            //$presql .= "and date(a.surgery_date_time) >='".$fix_surgery_date."' and date(a.surgery_date_time) <='".$fix_surgery_date."' ";
            
            //eyeformmultipleentry selected_iol_tb on selected_iol_tb.eyeformid = eyeform.id AND selected_iol_tb.field_name = 'selected_iol'
            
            $presql .= " and eyeform.id IN (SELECT eyeformid FROM eyeformmultipleentry WHERE field_name = 'selected_iol' AND field_value_OD = '".$_GET['columns'][16]['search']['value']."') ";
        }
        
         /*
        //followup      
        if (isset($_GET['columns'][17]) && $_GET['columns'][17]['search']['value'] != '') {
            $presql .= " and a.is_followup = '".$_GET['columns'][17]['search']['value']."'";
        } 
        
       
        //middle name      
        if (isset($_GET['columns'][18]) && $_GET['columns'][18]['search']['value']) {
            $middle_name =  $_GET['columns'][18]['search']['value'];
            $presql .= " and a.middle_name LIKE '%".$middle_name."%' ";
        }
        
        //last name      
        if (isset($_GET['columns'][19]) && $_GET['columns'][19]['search']['value']) {
            $last_name =  $_GET['columns'][19]['search']['value'];
            $presql .= " and a.last_name LIKE '%".$last_name."%' ";
        }
        
        //last name      
        if (isset($_GET['columns'][20]) && $_GET['columns'][20]['search']['value']) {
            $mr_mrs_ms =  $_GET['columns'][20]['search']['value'];
            $presql .= " and a.mr_mrs_ms LIKE '%".$mr_mrs_ms."%' ";
        }
        */
        
         $presql .=  " GROUP BY a.id"; 
        //=================================================================================================================================
        //$sql = $select . $presql . $orderByStr . " LIMIT " . $start . "," . $len; exit;
        
        if($len > 0) {
            $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;
        } else {
            $sql = $select.$presql.$orderByStr;
        }

        $qcount = DB::select("SELECT COUNT(a.id) c" . $presql);
        //echo "<pre>"."SELECT COUNT(a.id) c" . $presql; print_r($qcount); exit;
        //$count = isset($qcount[0]->c) ? $qcount[0]->c: 0;
        
        $count = count($qcount);
        
        $results = DB::select($sql);
        $ret = [];
        foreach ($results as $row)
        {
            $r = [];
            foreach ($row as $value)
            {
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
    
}