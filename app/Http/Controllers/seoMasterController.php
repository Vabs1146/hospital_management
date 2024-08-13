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
use Auth;
use App\Helpers\Helpers;
use App\seo_master;


class seoMasterController extends AdminRootController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
           // $pageSize = 5;
            // $doctors= doctor::orderBy('id', 'DESC')->paginate($pageSize);
            // //$doctorFormView = doctor_form_mapping::pluck('displayText', 'formViewName');
                // return view('doctorCRUD.index', compact('doctors'))
            // ->with('i', ($request->input('page', 1) - 1) * $pageSize);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	public function seolist(){
        return View('seoMaster.list',[]);
    }

	
    public function create()
    {
        
        // $doctor = new doctor();
        // $doctor->isActive = 0;
        // $doctorFormView = doctor_form_mapping::pluck('displayText', 'formViewName');
        //return view('seoMaster.create', compact('doctor', 'doctorFormView'));
       $data['urllist'] = DB::select("SELECT * FROM `menu_list` ORDER BY id DESC");
        return view('seoMaster.create',$data);
    }

	 public function EditSeo(Request $request){

        $seo_master = seo_master::findOrFail($request->seo_id);
        
        $seo_master->id = $seo_master->id?:0;
		//$seo_master->url = $request->page_url;
        $seo_master->meta_title = $request->meta_title;
        $seo_master->meta_desc = $request->meta_desc;
        $seo_master->meta_key = $request->meta_key;
        $seo_master->status = $request->is_active;
        $seo_master->created_by = '0';    
        $seo_master->modification_by = '0';
        // echo "<pre>";
		// print_r($seo_master);
        // echo "</pre>";
		// exit; 
        $seo_master->save();

        return redirect('/seo')->with('flash_message', 'SEO Master updated successfully');
        
    }
	
	public function SaveSeo(Request $request){

        //$case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
        // if (is_null($case_gen)) {
            // $case_gen = $this->createCaseNumber();
        // }
        $seo_master = true;
        $seo_master = $this->submitSeo($request);

		if($seo_master){
             // \LogActivity::addToLog('SEO Management record created successfully');
		return redirect('/seo')->with('flash_message', 'Record added successfully');

		}else{
		return redirect()->back()->withInput()->with('flash_message', 'This Url is already exist');
		}
        
       
    }
	
	public function submitSeo(Request $request)
    {
		//echo "adasds"; exit;
        //DB::enableQueryLog();
        $isEdit = true;
        $seo_master =  null;
		$page_url = $request->input('page_url'); 
		$seo_master = seo_master::find($page_url);
		$sql = "SELECT count(id) as cnt from seo_masters where url='".$page_url."'"; 
		$seo_master = DB::select($sql);
		
		// var_dump(DB::getQueryLog());
		//$seo_master = seo_master::where('url', $page_url);
		
		if ($seo_master[0]->cnt == 0) {
            $seo_master = new seo_master;
            $isEdit = false;
        }else{
			return false;
		}
        //$seo_master =  new stdclass();
        //echo "sdfs<pre>";
		//print_r($seo_master);
		//echo "</pre>";
		//exit;
        $seo_master->url = $request->page_url;
        $seo_master->meta_title = $request->meta_title;
        $seo_master->meta_desc = $request->meta_desc;
        $seo_master->meta_key = $request->meta_key;
        $seo_master->status = $request->is_active;
        $seo_master->created_by = '0';    
        $seo_master->modification_by = '0';
		
        $seo_master->save();
		
        return $seo_master;
    }
	
	 public function edit($seo_id){
		 
        //DB::enableQueryLog();
        //$seolist = seo_master::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
        //var_dump(DB::getQueryLog());
        //$appDetails = appointment::findOrFail($AppointmentId);//->first();
        //var_dump(DB::getQueryLog());
        //$doctor_id = $appDetails->doctor_id;
        $seolist = seo_master::findOrFail($seo_id);
		return View('seoMaster.edit', compact('seolist'));
    }
	
	public function grid(Request $request)
    {
        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = "SELECT id, url, meta_title, DATE_FORMAT(updated_at, \"%d %b %Y\"), status";
        $presql = " FROM seo_masters";
        $presql .= " WHERE 1=1";
        if ($_POST['search']['value']) {
            $presql .= " and url LIKE '%".$_POST['search']['value']."%' ";
        }
        // if ($_POST['columns'][1]['search']['value']) {
            // $presql .= " and a.case_number LIKE '%".$_POST['columns'][1]['search']['value']."%' ";
        // }
        if ($_POST['columns'][1]['search']['value']) {
            $presql .= " and url LIKE '%".$_POST['columns'][1]['search']['value']."%' ";
        }
        // if ($_POST['columns'][3]['search']['value']) {
            // $presql .= " and patient_name LIKE '%".$_POST['columns'][3]['search']['value']."%' ";
        // }
        $presql .= "  ";

        $orderByStr = " order by 1 desc";
        //$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;

        // if( isset( $_POST['order'][0]['column'] ) && is_numeric( $_POST['order'][0]['column'] ) ){
            // $orderColum = intval( $_POST['order'][0]['column'] )+1;
            // $orderByStr = " order by ". $orderColum . " " . $_POST['order'][0]['dir'];
        // }


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
        $ret['draw'] = $_POST['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }
	
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'doctor_name' => 'required'
        ]);
        
        $doctor = new doctor();
        $doctor->doctor_name = $request['doctor_name'];
        $doctor->isActive = is_null($request['isActive'])?0:1;
        $doctor->doctorDegree = $request['doctorDegree'];
        $doctor->mobile_no = $request['mobile_no'];
        $doctor->doctorFee = $request['doctorFee'];
        $doctor->formViewName = $request['formViewName'];
        $doctor->save();
        return redirect()->route('doctor.index')->with('flash_message', 'Record created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         $this->validate($request, [
            'doctor_name' => 'required'
        ]);
        $request['isActive'] =  is_null($request['isActive'])? 0 : 1;
        doctor::find($id)->update($request->all());
        return redirect()->route('doctor.index')->with('flash_message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
