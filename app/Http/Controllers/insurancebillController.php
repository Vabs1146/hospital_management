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

use App\insurance_bill;
use App\Case_master;
use App\doctor;
use App\Bill_detail;
use App\helperClass\drAppHelper;
use Auth;
use App\Helpers\Helpers;
use DB;
use Storage;
use App\helperClass\CommonHelper;

use App\PaymentModes;
use App\FeesDetails;
use App\User;
use App\Setting;
use App\Models\form_dropdowns;


class insurancebillController extends AdminRootController
{

   public function __construct()
    {
        $this->acc=0;
         $this->commonHelper = new CommonHelper();
    }

    public function index(Request $request)
    {
        return view('insurance_bill.index', []);
    }

public function edit(Request $request, $id) {
    $user = Auth::user()->id;
    //echo "==============<pre>";print_r(session('permissions'));exit;

    $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='Eyeipdbill/insuranceBill/edit'");

    foreach ($accesslevel as $value) {
        $this->acc=$value->accesslevel;
    }

    $this->acc = $this->commonHelper->checkUserAccess("Eyeipdbill/insuranceBill/edit",Auth::user()->id);
    if ($this->acc == 1) {

        $payment_modes_array = [];
        $payment_modes = PaymentModes::all();

        foreach($payment_modes as $payment_modes_row) {
            $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        //dd($payment_modes_array);

        $case_master  = Case_master::findOrFail($id);
        $insurance_bill = $case_master ->insurance_bill()->first();
        
        //echo "======== : ".$id;
        //echo "=====>>>>>>>>> <pre>"; print_r($insurance_bill);
        //dd($case_master);
        //echo "======== : ".$id; exit;
        //$eyeform  =  DB::table('eyeform')->where('case_id','=', $id)->get(['advance_amount'])->first();

        $eyeform  =  DB::table('eyeform')->where('case_id','=', $id)->first();

        $advance_amount = isset($eyeform->advance_amount) ? $eyeform->advance_amount:'0';
        $advance_date = isset($eyeform->advance_date) ? $eyeform->advance_date:'';
        $advance_payment_type = isset($eyeform->advance_payment_type) ? $eyeform->advance_payment_type:'';

        // dd($advance_date);

        //dd($insurance_bill);
        if ($insurance_bill === null || is_null($insurance_bill) || empty($insurance_bill) || !isset($insurance_bill)) {
            $insurance_bill = new insurance_bill();
        }

        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();

        $bill_data = $case_master->Bill_detail()->where('department', 'Operation')->get(); 

        //dd($bill_data);
        $payment_details = DB::table('ipd_bill_payments')->where('case_id', $case_master->id)->get();

        //dd($payment_details);

        $total_paid = DB::table('ipd_bill_payments')->where('case_id', $case_master->id)->sum('paid_amount');
        $surgeryDetails = DB::table('insurance_surgery_dropdown')->where('case_id', $case_master->id)->get()->toArray();

        $bill_item = ''; 
        $bill_Amount = '';
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
        $defaultValues = [];
        //echo "<pre> =============== ";print_r($payment_details);exit;
        //return $case_master;

        $custom_templates = DB::table('ipdbill_item_template')->where('status', '1')->get();
//echo "====>>>>>>>>> <pre>"; print_r($case_master); exit;
        return view('insurance_bill.add', 
            compact(
                'case_master',
                'insurance_bill', 
                'DateWiseRecordLst', 
                'bill_data', 
                'bill_item', 'bill_Amount', 
                'doctorlist', 
                'payment_modes_array',
                'payment_modes', 
                'payment_details', 
                'total_paid', 
                'advance_amount','defaultValues',
                'form_dropdowns',
                'surgeryDetails', 
                'custom_templates', 
                'advance_payment_type', 
                'advance_date'
            )
        );
    } else {
        $url= url()->previous();
        return redirect($url);
    }
}


    public function update(Request $request){
      // echo " ================= <pre>";print_r($request->all());exit;
		//check which submit was clicked on
       
        if($request->custom_type == "template" && $request->select_template != "") {
            
             DB::table('bill_details')->where('case_id', $request['case_id'])->delete();
            $req_bill_item = new Bill_detail;
           
             foreach($request->bill_item as $bill_item_key => $bill_item) {
                 if($bill_item != "") {
               
                
                DB::table('bill_details')->insert(['case_number' => $request['case_number'], 'bill_item' => $bill_item, 'bill_Amount' => $request->bill_Amount[$bill_item_key], 'case_id' => $request['case_id'], 'department' => 'Operation', 'created_at' => date('Y-m-d h:i:s')]);
                 }
                 //echo "===========================";
             }   
             
             //echo "==========================="; exit;
        } else if (Input::get('Item_Add')) {
            $req_bill_item = new Bill_detail;
            $req_bill_item->case_number = $request['case_number'];
            $req_bill_item->bill_item = $request['bill_item'];
            $req_bill_item->bill_Amount = $request->bill_Amount;
            $req_bill_item->case_id = $request['case_id'];
            $req_bill_item->department = 'Operation';
            $req_bill_item->save();
              //\LogActivity::addToLog('Bill Item added successfully');
            return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
        }
        
        //echo " ================= <pre>";print_r($request->all());exit;
        
        $case_id = $request['case_id'];
        if(!empty($request['surgery_OD'])){
            foreach($request['surgery_OD'] as $key => $surgery) {
                if(!empty($surgery)) {
                    $eye = $request['surgery_OS'][$key];
                    $sql= DB::insert("INSERT INTO `insurance_surgery_dropdown`(`case_id`,`text`,`eye_operated`) VALUES ('$case_id','$surgery','$eye')");
                }
            }
        }

        if (Input::get('Payment_Add')) {
			$case_master = Case_master::findOrFail($request->case_id);
            return  $this->Add_BillPayment($request,$case_master); //if login then use this method
        } 
		if (Input::get('delete_payment_item')) {
			$case_master = Case_master::findOrFail($request->case_id);
            return  $this->delete_payment_item($request,$case_master); //if register then use this method
        }
        if (Input::get('delete_item')) {
            $billdetail = Bill_detail::findOrFail($request['delete_item']);
            if ($billdetail === null) {
                return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
            }
            $billdetail->delete();
            //\LogActivity::addToLog('Bill Item deleted successfully');
            return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
        }
        if(Input::get('submit')) {
			$record = Case_master::where('id','<',$request->case_id)->count();

			//echo "===================<pre>";print_r($record);exit; 

			$form_details =Case_master::findOrFail($request->case_id);

		   // echo $form_details->IPD_no;exit;
		   // $ipd_no = Setting::where('name', 'ipd_prefix')->first()->value ."_". str_pad($request->case_id, 5, "0", STR_PAD_LEFT);
		   // $ipd_bill_no = Setting::where('name', 'ipd_bill_prefix')->first()->value ."_". str_pad($request->case_id, 5, "0", STR_PAD_LEFT);          
                        if($request->ipd_no != "") {
                            $newIPD = $request->ipd_no;
                        } else if($form_details->IPD_no == "") {
                            if($record != 0) {
                                //$ipdArr = explode('_',$record->ipd_no);
                                $IPDNum = $record+1;
                                $newIPD = Setting::where('name', 'ipd_prefix')->first()->value.'_'.str_pad( $IPDNum, 4, "0", STR_PAD_LEFT);
                            } else {
                                $newIPD = Setting::where('name', 'ipd_prefix')->first()->value.'_'.str_pad( '1', 4, "0", STR_PAD_LEFT);
                            }  
			} else {
				//$newIPD = $form_details->IPD_no;
                           $newIPD = $form_details->IPD_no;
			}

			if($form_details->bill_number == "") {
				if($record != 0) {
					//$billArr = explode('_',$record->bill_no);
					if($request->bill_no != "") {
						$newBillNo = $request->bill_no;
					} else {
						$BillNum   = $record+111;
						$newBillNo = Setting::where('name', 'ipd_bill_prefix')->first()->value.'_'.str_pad( $BillNum, 4, "0", STR_PAD_LEFT);
					}
				} else {
					if($request->bill_no != "") {
						$newBillNo = $request->bill_no;
					} else {
						$newBillNo = Setting::where('name', 'ipd_bill_prefix')->first()->value.'_'.str_pad( '111', 4, "0", STR_PAD_LEFT);
					}
				} 
			} else {
				//$newBillNo = $form_details->bill_number;
				if($request->bill_no != "") {
					$newBillNo = $request->bill_no;
				} else {
					$BillNum   = $record+111;
					$newBillNo = Setting::where('name', 'ipd_bill_prefix')->first()->value.'_'.str_pad( $BillNum, 4, "0", STR_PAD_LEFT);
				}
			}
      
        //echo "This is the uhid no".$uhid_no;exit;
        
            $isEdit = true;
            $form_details = insurance_bill::where('case_id', $request->case_id)->first();
			$case_master = Case_master::findOrFail($request->case_id);
            $case_master->admission_date_time = $request->admission_date_time;
            $case_master->discharge_date_time = $request->discharge_date_time;
            $case_master->surgery_date_time = $request->surgery_date_time;
            $case_master->Surgeon = $request->surgon_name;
            $case_master->referedby = $request->referedby;
            $case_master->final_diagnosis = $request->final_diagnosis;
            $case_master->discharge_sts = $request->discharge_sts;
            $case_master->bill_number   = $newBillNo;
            $case_master->IPD_no        = $newIPD;
            $case_master->classes       = $request->classes;
            $case_master->save();
            //var_dump(DB::getQueryLog());
            //return $form_details;
            
            //echo "=================".__LINE__; exit;
            if ($form_details === null) {
                $form_details = new insurance_bill();
                $isEdit = false;
            }
			
            $form_details->fill($request->all());
            $form_details->save();

$eyeform  =  DB::table('eyeform')->where('case_id','=', $request->case_id)->update(['advance_amount' => $request->advance_amount, 'advance_payment_type' => $request->advance_payment_type, 'advance_date' => $request->advance_date]);

			$sub_total = $case_master->Bill_detail()->where('department', 'Operation')->sum('bill_Amount'); 
			//dd($bill_data);
			$total = $sub_total - $form_details->discount_amount;

			$form_details->sub_total = $sub_total;
			$form_details->total_bill_amount = $total;
			$form_details->save();


             // \LogActivity::addToLog('Insurance Bill created successfully');
            return redirect()->back()->with('flash_message', 'Record added successfully');
		}
	}

	public function Add_BillPayment(Request $request, $case_master) {
        $this->validate($request, [
            'payment_date' => 'required|not_in:0',
            'payment_mode' => 'required|not_in:0',
            'payment_amount' => 'required',
            'case_number' => 'required',
        ]);

		 //$case_master  = Case_master::findOrFail($case_id);
        $insurance_bill = $case_master ->insurance_bill()->first();

		if ($insurance_bill === null || is_null($insurance_bill) || empty($insurance_bill) || !isset($insurance_bill)) {
            $insurance_bill = new insurance_bill();

			$insurance_bill->case_id =   $case_master->id;		
        }

		//dd($insurance_bill);

		$inset_data = array(
			'case_number' => $case_master->case_number,	
			'paid_amount' => $request->payment_amount,	
			'payment_date' => date('Y-m-d',strtotime($request->payment_date)),	
			'created_at' => date('Y-m-d h:i:s',strtotime('now')),	
			'case_id' => $case_master->id,	
			'payment_mode' => $request->payment_mode,	
			'created_by' => AUTH::user()->id	
		);

		DB::table('ipd_bill_payments')->insert($inset_data);

		$total_paid = DB::table('ipd_bill_payments')->where('case_id', $case_master->id)->sum('paid_amount');

		//dd($total_paid);
		
		$insurance_bill->balance_amount_by_patient =  $total_paid;		
        $insurance_bill->save();

		//dd($case_master);
        return redirect()->back()->withInput()->with('flash_message', 'Ipd Bill Updated added successfully');
    }

	public function delete_payment_item(Request $request, $case_master){
        
        $billdetail = DB::table('ipd_bill_payments')->where('id', $request['delete_payment_item'])->first();
        if ($billdetail === null) {
            return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
        }
        DB::table('ipd_bill_payments')->where('id', $request['delete_payment_item'])->delete();

		$total_paid = DB::table('ipd_bill_payments')->where('case_id', $case_master->id)->sum('paid_Amount');


		$insurance_bill = $case_master ->insurance_bill()->first();
        if ($insurance_bill === null || is_null($insurance_bill) || empty($insurance_bill) || !isset($insurance_bill)) {
            $insurance_bill = new insurance_bill();
        }

		$insurance_bill->balance_amount_by_patient =  $total_paid;		
        $insurance_bill->save();
    
        return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
    }

    public function printbill($case_id,$typeId,$printval) {

       $user = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='Eyeipdbill/insuranceBill/print'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("Eyeipdbill/insuranceBill/print",Auth::user()->id);
        if ($this->acc == 1) {
              $case_master  = Case_master::findOrFail($case_id);
        $insurance_bill = $case_master ->insurance_bill()->first();
        if ($insurance_bill === null || is_null($insurance_bill) || empty($insurance_bill) || !isset($insurance_bill)) {
            $insurance_bill = new insurance_bill();
        }
         $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'DESC')->select('id', 'created_at')->skip(0)->take(1)->get();
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $billdata = $case_master->Bill_detail()->where('department', 'Operation')->get();
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

		$payment_details = DB::table('ipd_bill_payments')->where('case_id', $case_master->id)->get();

		//dd($payment_details);

		$total_paid = DB::table('ipd_bill_payments')->where('case_id', $case_master->id)->sum('paid_amount');
		$payment_modes = PaymentModes::all();
		foreach($payment_modes as $payment_modes_row) {
				$payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
			}

        $surgeryQry = "SELECT GROUP_CONCAT(insurance_surgery_dropdown.text) as text
               FROM  insurance_surgery_dropdown where case_id=".$case_master->id;
        $surgonRes = DB::select($surgeryQry);
        $surgery = isset($surgonRes[0]) ? $surgonRes[0]->text : '-';

        $surgonQry ="select doctor_name from doctors right join insurance_bill on doctors.id = insurance_bill.surgon_name where case_id=".$case_master->id;
        $surgon = DB::select($surgonQry);

        $surgon_name = isset($surgon[0]) ? $surgon[0]->doctor_name:'-';

        $itemsum = 0; 
        $itemsum = $billdata->sum('bill_Amount');
        $itemsum = floatval($itemsum);
        $itemsum = $itemsum - $insurance_bill->advance_amount - $insurance_bill->discount_amount;

        $billamountInWords_calculated = $this->commonHelper->displaywords($itemsum);
        
        $eyeform  =  DB::table('eyeform')->where('case_id','=', $case_id)->first();

        $advance_amount = isset($eyeform->advance_amount) ? $eyeform->advance_amount:'0';
        $advance_date = isset($eyeform->advance_date) ? $eyeform->advance_date:'';
        $advance_payment_type = isset($eyeform->advance_payment_type) ? $eyeform->advance_payment_type:'';

        //echo "-----------------".$surgonQry;print_r($surgonQry);exit;
        
        $surgeryDetails = DB::table('insurance_surgery_dropdown')->where('case_id', $case_master->id)->get()->toArray();
        
        return view('insurance_bill.print_'.$printval, compact('case_master','insurance_bill', 'DateWiseRecordLst', 'logoUrl', 'billdata', 'doctorlist', 'payment_details', 'total_paid', 'payment_modes_array','surgery','surgon_name','billamountInWords_calculated', 'advance_amount', 'advance_date', 'advance_payment_type', 'surgeryDetails'));
        }

              else
        {
           $url= url()->previous();
           return redirect($url);
        }
      
    }

//---------------------------------------------- Ipd Bill Reports ---------------------------------------------
	#region Doctor bill report
    public function ViewReport(Request $request) {
		//echo "============== : ".__LINE__; exit;
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
			$fees_details = [];
			//$fees_details = FeesDetails::all();

			$fees_details = DB::table('bill_details')->get();

			foreach($fees_details as $fees_details_row) {
				//$fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
				$fees_details_array[$fees_details_row->bill_item] = $fees_details_row->bill_item;
			}

			//echo "=====>>>>>> <pre>"; print_r($fees_details_array); exit;

			$all_users = User::all();
             $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();

			foreach($all_users as $all_users_row) {
				$all_users_array[$all_users_row->id] = $all_users_row->name;
			}
			$defaultValues = [];
            return view('insurance_bill.ViewReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array','form_dropdowns','defaultValues'));
        } else {
         $url= url()->previous();
           return redirect($url);
        }
    }
	
	public function reportGrid(Request $request) {
        $len = $_GET['length'];
        $start = $_GET['start'];

		$select = "SELECT null as `Date`, u.name, doctors.doctor_name,b.patient_name,null, b.bill_number, bd.bill_item, bd.bill_Amount, a.sub_total, a.discount_amount, a.total_bill_amount, a.advance_amount, (a.total_bill_amount - a.advance_amount) as balance, a.case_id as id";
        $presql = " FROM insurance_bill a INNER join case_master b on a.case_id = b.id LEFT join bill_details bd on bd.case_id = b.id LEFT JOIN doctors ON doctors.id=b.doctor_id LEFT JOIN users u ON u.id=a.created_by ";

        //$presql .= " WHERE 1=1 and b.is_deleted = 0 ";//AND b.doctor_id='$docid'";
		
		//$presql .= " WHERE b.patient_type='ipd' and b.is_deleted = 0";
        $presql .= " WHERE b.is_ipd='1' and b.is_deleted = 0";

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
           // $presql .= " and bd.bill_item = '".$_GET['columns'][4]['search']['value']."' ";
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
        
        //echo "==========>>>>>>. <pre>".$sql; print_r($results); exit;
        $ret = [];
		$case_id = "";
        $cnt = 1;
		if(!empty($results)) {
		foreach ($results as $row) {
			if($case_id != "" && $case_id != $row->id) {
				$prev_val[0] = '';
				$prev_val[1] = '';
				$prev_val[2] = '';
				$prev_val[3] = '';
				$prev_val[4] = '';
				$prev_val[5] = '';
                $prev_val[6] = '';
				$prev_val[7] = '';

				$ret[] = $prev_val;
			}

               $surgeryQry = "SELECT GROUP_CONCAT(insurance_surgery_dropdown.text) as text
               FROM  insurance_surgery_dropdown where case_id=".$row->id;
               if ($_GET['columns'][4]['search']['value']) {
                    $surgeryQry .= " and insurance_surgery_dropdown.text = '".$_GET['columns'][4]['search']['value']."' ";
                }
                $qr = DB::select($surgeryQry);
                //echo "<pre>======= ";print_r($qr);exit;   			
			
			

			$r = [];
            foreach ($row as $value) {
                $r[] = $value;
            }
            $r[0] = $cnt;
            $r[4] = $qr[0]->text;
			$prev_val = $r;

			
			$r[8] = '';
			$r[9] = '';
			$r[10] = '';
			$r[11] = '';
            $r[12] = '';


			if($case_id != "" && $case_id == $row->id) {
				//$r[0] = '';
				$r[1] = '';
				$r[2] = '';
				$r[3] = '';
                $r[4] = '';
				$r[5] = '';
			}

			$ret[] = $r;

			$case_id = $row->id;
			 $cnt++;
		}
		
		$prev_val[0] = '';
		$prev_val[1] = '';
		$prev_val[2] = '';
		$prev_val[3] = '';
		$prev_val[4] = '';
		$prev_val[5] = '';
        $prev_val[6] = '';
		$prev_val[7] = '';

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


public function ViewPaymentReport(Request $request) {
		//echo "============== : ".__LINE__; exit;
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
			$fees_details = [];
			$fees_details = FeesDetails::all();

			foreach($fees_details as $fees_details_row) {
				$fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
			}

			$all_users = User::all();

			foreach($all_users as $all_users_row) {
				$all_users_array[$all_users_row->id] = $all_users_row->name;
			}

 
            $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
			$defaultValues = [];
            return view('insurance_bill.ViewPaymentReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array','form_dropdowns','defaultValues'));
        } else {
         $url= url()->previous();
           return redirect($url);
        }
    }
	
	public function reportPaymentGrid(Request $request) {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT null as `Date`, u.name, doctors.doctor_name,b.patient_name,null, b.bill_number, pm.name as payment_mode_name, a.paid_Amount as payments, ib.balance_amount_by_patient as total_paid, (ib.total_bill_amount - CONVERT(ib.advance_amount, DECIMAL) -  CONVERT(ib.balance_amount_by_patient, DECIMAL)) as balance, a.case_id as id";
        $presql = " FROM ipd_bill_payments a INNER join case_master b on a.case_id = b.id INNER join insurance_bill ib on ib.case_id = b.id LEFT JOIN doctors ON doctors.id=b.doctor_id LEFT JOIN payment_modes pm ON pm.id=a.payment_mode LEFT JOIN users u ON u.id=a.created_by ";

        //$presql .= " WHERE 1=1 and b.is_deleted = 0 ";//AND b.doctor_id='$docid'";
		
		//$presql .= " WHERE b.patient_type='ipd' and b.is_deleted = 0";
        
        $presql .= " WHERE b.is_ipd='1' and b.is_deleted = 0";
       
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

        //echo "==========>>>>>>. <pre>".$sql; print_r($results); exit;
        
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
                $prev_val[7] = '';

                //$prev_val[7] = '';
                //$prev_val[8] = '';
                //$prev_val[9] = '';
                //$prev_val[0] = '';

                
                

                $ret[] = $prev_val;
            } else {
                $case_id = $row->id;
            }

                $surgeryQry = "SELECT GROUP_CONCAT(insurance_surgery_dropdown.text) as text
               FROM  insurance_surgery_dropdown where case_id=".$row->id;
               if ($_GET['columns'][4]['search']['value']) {
                    $surgeryQry .= " and insurance_surgery_dropdown.text = '".$_GET['columns'][4]['search']['value']."' ";
                }
                $qr = DB::select($surgeryQry);
                           
            $r = [];
           
            foreach ($row as $value) {
                
                $r[] = $value;

                unset($r[10]);
            }
             $r[0] = $count;
            $r[4] = $qr[0]->text;            
            
            $prev_val = $r;
            $r[8] = '';
            $r[9] = '';
            
            
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
                $prev_val[7] = '';
                

                
                
                $ret[] = $prev_val;
        //--------------------------------------------------
        } else {
            $ret = [];
        }   

        $ret['data'] = $ret;
        $ret['recordsTotal'] = $count;
        $ret['iTotalDisplayRecords'] = $count;

        $ret['recordsFiltered'] = count($ret);
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }
//------------------------- End IPD Bill Reports -----------------------------------------------
    
    
    //========================================================================================================
    	#region Doctor bill report
    public function ipdViewReport(Request $request) {
		//echo "============== : ".__LINE__; exit;
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
            $fees_details = [];
            //$fees_details = FeesDetails::all();

            $fees_details = DB::table('bill_details')->get();

            foreach($fees_details as $fees_details_row) {
                    //$fees_details_array[$fees_details_row->id] = $fees_details_row->fees_details;
                    $fees_details_array[$fees_details_row->bill_item] = $fees_details_row->bill_item;
            }

            //echo "=====>>>>>> <pre>"; print_r($fees_details_array); exit;

            $all_users = User::all();
 $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();

            foreach($all_users as $all_users_row) {
                    $all_users_array[$all_users_row->id] = $all_users_row->name;
            }
            $defaultValues = [];
            return view('insurance_bill.ipdViewReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array','form_dropdowns','defaultValues'));
        } else {
         $url= url()->previous();
           return redirect($url);
        }
    }
    
    public function ipdViewReportGrid(Request $request) {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT "
                . "date(b.created_at) as `Date`, "
                . "b.case_number, "
                . "b.IPD_no, "
                //. "u.name, "
                . "CONCAT(COALESCE(b.`mr_mrs_ms`,''), ' ', COALESCE(b.`patient_name`,''), ' ', COALESCE(b.`middle_name`,''), ' ', COALESCE(b.`last_name`,'')),"
                . "doctors.doctor_name,"
                . "null, "
                . "b.bill_number, "
                . "IF(a.sub_total, a.sub_total, 0) as sub_total, "
                . "IF(a.advance_amount, a.advance_amount, 0) as advance_amount, "
                //. "CONCAT(eyeform.advance_date,'/',advance_payment_mode.name) as advance_details, "
                
                . "CONCAT(advance_payment_mode.name,' / ', date_format(eyeform.advance_date, '%d-%m-%Y')) as advance_details, "
                
                
                . "IF(a.discount_amount, a.discount_amount, 0) as discount_amount, "
                . "(IF(a.sub_total, a.sub_total, 0) - IF(a.advance_amount, a.advance_amount, 0) - IF(a.discount_amount, a.discount_amount, 0)) as total_payment, "
                . "IF(ibp.paid_amount, ibp.paid_amount, 0) as paid_amount , "
                . "pm.name as payment_modes_name, "
                . "(IF(a.sub_total, a.sub_total, 0) - IF(a.advance_amount, a.advance_amount, 0) - IF(a.discount_amount, a.discount_amount, 0) - IF(paid_tb.paid_amount_total, paid_tb.paid_amount_total, 0)) as remaining_balance, "
                . "a.case_id as case_id";
        
        $presql = " FROM "
                . "insurance_bill a "
                . "INNER join case_master b on a.case_id = b.id "
                . "LEFT join eyeform on eyeform.case_id = b.id "
                . "LEFT join ipd_bill_payments ibp on ibp.case_id = b.id "
                . "LEFT JOIN payment_modes pm ON pm.id= ibp.payment_mode "
                . "LEFT JOIN payment_modes advance_payment_mode ON advance_payment_mode.id= eyeform.advance_payment_type "
                . "LEFT JOIN (select SUM(paid_amount) as paid_amount_total, case_id from ipd_bill_payments group by case_id) paid_tb on b.id =paid_tb.case_id "                
                . "LEFT JOIN doctors ON doctors.id=b.doctor_id "
                . "LEFT JOIN users u ON u.id=a.created_by "; 
        
        $presql .= " WHERE b.is_ipd='1' and b.is_deleted = 0";
        
        
        //$eyeform  =  DB::table('eyeform')->where('case_id','=', $id)->get(['advance_amount'])->first();
            //$advance_amount = isset($eyeform->advance_amount) ? $eyeform->advance_amount:'0';
        
        //===========================================================
        
        //================================================================
        
        $presql .= "  ";
        $orderByStr = " order by 1 desc";
        
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
        $cnt = 1;
        if(!empty($results)) {
            /*
            foreach ($results as $row) {
                $r = [];
                foreach ($row as $value) {
                    $r[] = $value;
                }
                $ret[] = $r;
            }
            */
            
            //================================================================================
            $prev_case_id = "";
            
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
                    
                    $r[9] = '';
                    $r[10] = '';
                    $r[11] = '';
                }
                if(isset($results[$key+1])) {
                    if($results[$key+1]->case_id == $row->case_id) {
                        $r[14] = '';
                    }
                } else {

                }

                $prev_case_id = $row->case_id;
                $ret[] = $r;
            }
            //==================================================================================
        }
        
        $ret['data'] = $ret;
        $ret['recordsTotal'] = $count;
        $ret['iTotalDisplayRecords'] = $count;

        $ret['recordsFiltered'] = count($ret);
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }
	
	public function ipdViewReportGrid1(Request $request) {
        $len = $_GET['length'];
        $start = $_GET['start'];

		$select = "SELECT null as `Date`, u.name, doctors.doctor_name,CONCAT(COALESCE(b.`mr_mrs_ms`,''), ' ', COALESCE(b.`patient_name`,''), ' ', COALESCE(b.`middle_name`,''), ' ', COALESCE(b.`last_name`,'')),null, b.bill_number, bd.bill_item, bd.bill_Amount, a.sub_total, a.discount_amount, a.total_bill_amount, a.advance_amount, (a.total_bill_amount - a.advance_amount) as balance, a.case_id as id";
        $presql = " FROM insurance_bill a INNER join case_master b on a.case_id = b.id LEFT join bill_details bd on bd.case_id = b.id LEFT JOIN doctors ON doctors.id=b.doctor_id LEFT JOIN users u ON u.id=a.created_by ";

        //$presql .= " WHERE 1=1 and b.is_deleted = 0 ";//AND b.doctor_id='$docid'";
		
		//$presql .= " WHERE b.patient_type='ipd' and b.is_deleted = 0";
        $presql .= " WHERE b.is_ipd='1' and b.is_deleted = 0";

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
           // $presql .= " and bd.bill_item = '".$_GET['columns'][4]['search']['value']."' ";
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
        
        //echo "==========>>>>>>. <pre>".$sql; print_r($results); exit;
        $ret = [];
		$case_id = "";
        $cnt = 1;
		if(!empty($results)) {
		foreach ($results as $row) {
			if($case_id != "" && $case_id != $row->id) {
				$prev_val[0] = '';
				$prev_val[1] = '';
				$prev_val[2] = '';
				$prev_val[3] = '';
				$prev_val[4] = '';
				$prev_val[5] = '';
                                $prev_val[6] = '';
				$prev_val[7] = '';

				$ret[] = $prev_val;
			}

               $surgeryQry = "SELECT GROUP_CONCAT(insurance_surgery_dropdown.text) as text
               FROM  insurance_surgery_dropdown where case_id=".$row->id;
               if ($_GET['columns'][4]['search']['value']) {
                    $surgeryQry .= " and insurance_surgery_dropdown.text = '".$_GET['columns'][4]['search']['value']."' ";
                }
                $qr = DB::select($surgeryQry);
                //echo "<pre>======= ";print_r($qr);exit;   			
			
			

            $r = [];
            foreach ($row as $value) {
                $r[] = $value;
            }
            $r[0] = $cnt;
            $r[4] = $qr[0]->text;
			$prev_val = $r;

			
			$r[8] = '';
			$r[9] = '';
			$r[10] = '';
			$r[11] = '';
            $r[12] = '';


			if($case_id != "" && $case_id == $row->id) {
				//$r[0] = '';
				$r[1] = '';
				$r[2] = '';
				$r[3] = '';
                $r[4] = '';
				$r[5] = '';
			}

			$ret[] = $r;

			$case_id = $row->id;
			 $cnt++;
		}
		
		$prev_val[0] = '';
		$prev_val[1] = '';
		$prev_val[2] = '';
		$prev_val[3] = '';
		$prev_val[4] = '';
		$prev_val[5] = '';
        $prev_val[6] = '';
		$prev_val[7] = '';

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
    
    
    public function surgeryViewReport(Request $request) {
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
            $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
            
            return view('insurance_bill.patientViewIpdSurgeryReport', compact('doctor', 'fees_details_array', 'payment_modes_array', 'all_users_array', 'form_dropdowns'));
        }
          else
        {
         $url= url()->previous();
           return redirect($url);
        }
    }
	
    public function surgeryReportGrid(Request $request) {
        
        //dd($_REQUEST);
        $len = $_GET['length'];
        $start = $_GET['start'];

        //$select = "SELECT a.id,  a.case_number, `patient_name`,  e.doctor_name,`patient_mobile`, a.patient_age , `patient_emailId`,`referedby`, e.doctor_name, DATE_FORMAT(a.updated_at, \"%d %b %Y\"), 1,2, DATE(a.updated_at)= DATE(NOW())";
        
        $url = url('/').'/uploads/';
        
        $select = "SELECT "
                . " date(a.surgery_date_time) as `Date`, "
                 . " TIME(a.surgery_date_time) as surgery_time, "
                . " a.case_number,"
                . " a.uhid_no, "
                . " a.IPD_no, "
                . " a.patient_name,"
                . " a.patient_age, "
                . " a.male_female, "
                //. " concat('<a target=\'_blank\' href=\'".$url."', a.patient_pic,'\'><img style=\'width:100px;\' src=\'".$url."', "
                //. "a.patient_pic,'\'></a>'), "
                . " e.doctor_name,"
                . " a.referedby, "
                //. " NULL as optometrist, "
                //. "u.name as user_name, "
                . "GROUP_CONCAT(diagnosis_tb.field_value_OD) as diagnosis, "
                //. "GROUP_CONCAT(surgery_tb.field_value_OD) as procedure_surgery, "
                //. "GROUP_CONCAT(vision_tb.field_value_OD) as vision, "
                . " anaesthetist_tb.field_value as anaesthetist, "
                . " anaesthesia_tb.field_value as anaesthesia, "
                . "u.name as by_user";
       
        $presql = " FROM case_master a
                    join (select max(id) as id from case_master where is_deleted = 0 group by case_number) b on a.id =b.id 
                    left join timeslots d on a.FollowUpDate = d.id
                    left join doctors c on a.FollowUpDoctor_Id = c.id "
                    ."left join doctors e on a.doctor_id = e.id "
                    ."LEFT JOIN users u ON u.id = a.created_by  "
                    ."left join eyeform  on eyeform.case_id = a.id "
                    ."left join eyeformmultipleentry diagnosis_tb on diagnosis_tb.eyeformid = eyeform.id AND diagnosis_tb.field_name = 'otherDetailsDiagnosis' "
                    ."left join eyeformmultipleentry surgery_tb on surgery_tb.eyeformid = eyeform.id AND surgery_tb.field_name = 'surgery' "
                    ."left join eyeformmultipleentry vision_tb on vision_tb.eyeformid = eyeform.id AND vision_tb.field_name = 'dvn_od' "
                ."left join case_master_operation_details anaesthetist_tb on anaesthetist_tb.case_id = b.id AND anaesthetist_tb.field_name = 'anaesthetistSurgeon' " 
                    ."left join case_master_operation_details anaesthesia_tb on anaesthesia_tb.case_id = b.id AND anaesthesia_tb.field_name = 'anesthesia' ";
                 
                    //LEFT JOIN users u ON u.id=a.created_by 
        
        
        
        
        $orderByStr = " order by 1 desc";
        //=================================================================================================================================
        
         $presql .= " WHERE 1=1 ";
         
          //searchByName      
        if ($_GET['columns'][1]['search']['value']) {
            
            $presql .= " and a.patient_name LIKE '%".$_GET['columns'][1]['search']['value']."%' ";
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
        
        
        
        //anaesthetistSurgeon      
        if ($_GET['columns'][5]['search']['value']) {
            $presql .= " and anaesthetist_tb.field_value LIKE '%".$_GET['columns'][5]['search']['value']."%' ";
        }
          //searchByUser      
        if ($_GET['columns'][6]['search']['value']) {
            //$presql .= " and a.patient_name LIKE '%".$_GET['columns'][6]['search']['value']."%' ";
            $presql .= " and u.id ='".$_GET['columns'][6]['search']['value']."' ";
        }
        //anesthesia      
        if ($_GET['columns'][7]['search']['value']) {
            $presql .= " and anaesthesia_tb.field_value LIKE '%".$_GET['columns'][7]['search']['value']."%' ";
        }
        
        //all_patient_show      
        if ($_GET['columns'][8]['search']['value']) {
            //$presql .= " and a.referedby LIKE '%".$_GET['columns'][8]['search']['value']."%' ";
        }
        
        //diagnosis      
        if ($_GET['columns'][9]['search']['value'] != '') {
            $presql .= " and diagnosis_tb.field_value_OD LIKE '%".$_GET['columns'][9]['search']['value']."%' ";
        }
        
        //surgery      
        if ($_GET['columns'][10]['search']['value'] != '') {
            $presql .= " and surgery_tb.field_value_OD LIKE '%".$_GET['columns'][10]['search']['value']."%' ";
        } 
        
        
        $age_array = array(
            'less_18' => '(a.patient_age < 18)',
            '18_40' => '(a.patient_age BETWEEN 18 AND 40)',
            '41_60' => '(a.patient_age BETWEEN 41 AND 60)',
            '60_more' => '(a.patient_age > 60)'
        );
        
        //patient_age      
        if ($_GET['columns'][11]['search']['value']) {
            $age_key = $_GET['columns'][11]['search']['value'];
            if(isset($age_array[$age_key])) {
                $presql .= " and ".$age_array[$age_key]." ";
            }
        }
       
        
         $presql .=  " GROUP BY a.id"; 
        //=================================================================================================================================
        //$sql = $select . $presql . $orderByStr . " LIMIT " . $start . "," . $len;
         
         if($len > 0) {
            $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;
        } else {
            $sql = $select.$presql.$orderByStr;
        }

        $qcount = DB::select("SELECT COUNT(a.id) c" . $presql);
        //print_r($qcount);
        $count = $qcount[0]->c;
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