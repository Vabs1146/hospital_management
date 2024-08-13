<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as HttpGuzzle;
use App\Bulk_sm;
use App\Models\old_register;
use App\Case_master;
use Auth;
use App\Helpers\Helpers;
use App\helperClass\CommonHelper;
use DB;

class Bulk_smsController extends AdminRootController
{
	 public function __construct()
    {
        $this->acc=0;
        $this->commonHelper = new CommonHelper();
    }

    public function index(Request $request)
	{
	    return view('bulk_sms.index', []);
	}

	public function create(Request $request)
	{
		  $user = Auth::user()->id;
                  /*
         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='bulk_sms/create'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            */
        
        $this->acc = $this->commonHelper->checkUserAccess("bulk_sms",Auth::user()->id);
        if ($this->acc == 1) {
        	  return view('bulk_sms.add', [
	        []
	    ]);
        }
         else
        {
           $url= url()->previous();
           return redirect($url);
        }

	  
	}

	public function edit(Request $request, $id)
	{
		  $user = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='bulk_sms/edit'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("bulk_sms",Auth::user()->id);
        if ($this->acc == 1) {
        	$bulk_sm = Bulk_sm::findOrFail($id);
	    return view('bulk_sms.add', [
	        'model' => $bulk_sm	    ]);
        }
           else
        {
           $url= url()->previous();
           return redirect($url);
        }
		
	}

	public function sendSms_get(Request $request, $id)
	{
		  $user = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='bulk_sms/send_sms'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("bulk_sms",Auth::user()->id);
        if ($this->acc == 1) {
        	$bulk_sm = Bulk_sm::findOrFail($id);
	    return view('bulk_sms.sendSms', [
	        'model' => $bulk_sm	    ]);
        }
          else
        {
           $url= url()->previous();
           return redirect($url);
        }
		
		
	}

	public function show(Request $request, $id)
	{
		$bulk_sm = Bulk_sm::findOrFail($id);
	    return view('bulk_sms.show', [
	        'model' => $bulk_sm	    ]);
	}

	public function grid(Request $request)
	{
		$len = $_GET['length'];
		$start = $_GET['start'];

		$select = "SELECT id,group_name,1,2,3,mobile_numbers ";
		$presql = " FROM bulk_sms a ";

		$presql .= " WHERE 1=1 ";
		if($_GET['search']['value']) {	
			$presql .= " and group_name LIKE '%".$_GET['search']['value']."%' ";
		}
		if ($_GET['columns'][1]['search']['value']) {
            $presql .= " and mobile_numbers LIKE '%".$_GET['columns'][1]['search']['value']."%' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
            $presql .= " and group_name LIKE '%".$_GET['columns'][2]['search']['value']."%' ";
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
	    //
	    /*$this->validate($request, [
	        'name' => 'required|max:255',
	    ]);*/
		$bulk_sm = null;
		if($request->id > 0) { $bulk_sm = Bulk_sm::findOrFail($request->id); }
		else { 
			$bulk_sm = new Bulk_sm;
		}
	    

	    		
			    $bulk_sm->id = $request->id?:0;
				
	    		
					    $bulk_sm->group_name = $request->group_name;
		
	    		
					    $bulk_sm->mobile_numbers = $request->mobile_numbers;
		
	    		
					    // $bulk_sm->created_at = $request->created_at;
		
	    		
					    // $bulk_sm->updated_at = $request->updated_at;
		
	    	    //$bulk_sm->user_id = $request->user()->id;
	    $bulk_sm->save();
	     
  return redirect('/bulk_sms')->with('flash_message', 'Bulk SMS Record created successfully');
	  

	}

	public function store(Request $request)
	{
		return $this->update($request);
	}

	public function sendSms_post(Request $request)
	{
		$client = new HttpGuzzle;
		$smsStr =  $request->sms_text;
		$mobile_commaseperated = preg_split('/[\ \n\,]+/', $request->mobile_numbers);
		$mobile_commaseperated = implode (", ", $mobile_commaseperated);
        $mobile_commaseperated = rtrim($mobile_commaseperated, ' ');
        $mobile_commaseperated = rtrim($mobile_commaseperated, ',');
        $urlGet = str_replace(array('xxxxcommaSeperatedxxxx','xxxxSMSTextxxxx'), array($mobile_commaseperated, $smsStr), env('Bulk_SMS'));
        $res = $client->request('GET', $urlGet);
        //dd(json_decode($res->getBody()));
        
        return redirect()->back()->with('flash_message', 'Message Send Successfully.');

		//return $this->update($request);
	}

	public function sendOldRegisterSms_post(Request $request)
	{
		$client = new HttpGuzzle;
		$smsStr =  $request->messageBody;
		$mobile_commaseperated = old_register::whereIn('id', $request->oldRegisterId)->whereNotNull('mobile_no')->pluck('mobile_no')->toArray();
		//$mobile_commaseperated = preg_split('/[\ \n\,]+/', $request->mobile_numbers);
		$mobile_commaseperated = implode (", ", array_unique($mobile_commaseperated));
        $mobile_commaseperated = rtrim($mobile_commaseperated, ' ');
        $mobile_commaseperated = rtrim($mobile_commaseperated, ',');
        $urlGet = str_replace(array('xxxxcommaSeperatedxxxx','xxxxSMSTextxxxx'), array($mobile_commaseperated, $smsStr), env('Bulk_SMS'));
        $res = $client->request('GET', $urlGet);
        echo json_decode($res->getBody());
	}
	public function sendPatientReportSms_post(Request $request)
	{
		$client = new HttpGuzzle;
		$smsStr =  $request->messageBody;
		$mobile_commaseperated = Case_master::whereIn('id', $request->case_master_Id)->whereNotNull('patient_mobile')->pluck('patient_mobile')->toArray();
		//$mobile_commaseperated = preg_split('/[\ \n\,]+/', $request->mobile_numbers);
		$mobile_commaseperated = implode (", ", array_unique($mobile_commaseperated));
        $mobile_commaseperated = rtrim($mobile_commaseperated, ' ');
        $mobile_commaseperated = rtrim($mobile_commaseperated, ',');
        $urlGet = str_replace(array('xxxxcommaSeperatedxxxx','xxxxSMSTextxxxx'), array($mobile_commaseperated, $smsStr), env('Bulk_SMS'));
        $res = $client->request('GET', $urlGet);
        echo json_decode($res->getBody());
	}

	public function destroy(Request $request, $id) {
		
		$bulk_sm = Bulk_sm::findOrFail($id);

		$bulk_sm->delete();
	
		  //return redirect()->back()->with('flash_message', 'Bulk SMS Record deleted successfully');
		return "OK";
	    
	}

	
}