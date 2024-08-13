<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Staff_user;
use App\staff_type;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as HttpGuzzle;

use DB;

use Auth;
use App\Helpers\Helpers;
use App\helperClass\CommonHelper;

class StaffController extends Controller
{
  //
  public function __construct()
    {
         $this->acc=0;
         $this->commonHelper = new CommonHelper();
    }


    public function index(Request $request)
    {

        return view('staff.index', []);
    }

    public function create(Request $request)
    {

         $id1 = Auth::user()->id;
/*
        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id1' AND section.sectionname='staff_member/create'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            */
        //if($acc==1)
        $this->acc = $this->commonHelper->checkUserAccess("staff_member/create",Auth::user()->id);
        if ($this->acc == 1) {
         return view('staff.add', [
        'model' => null,
        'staff_type_lst'=> staff_type::where('is_active', 1)->pluck('type_name', 'id')
        ]);
        }

       else
        {
           $url= url()->previous();
           return redirect($url);
        }
      
    }

        

    public function get_member_sms(Request $request){
        return view('staff_users.get_member_sms',[
		'model' => null,
		'staff_type_lst'=> staff_type::where('is_active', 1)->pluck('type_name', 'id')          
        ]);
    }

    public function get_user_by_type($id){
        return staff_type::where('id', $id)->first()->Staff_user()->get(['id' ,'name']);
    }

    public function post_member_sms(Request $request){
        
        $this->validate($request,['staff_type_id' => 'required','sms_text'=>'required'],['staff_type_id.required'=>'Please select User role.','sms_text.required'=>'Please enter text']);
        
        $TomobileNo = "";
        $sf_usr = staff_type::where('id', $request->staff_type_id)->first()->Staff_user();
        if(empty($request->user_id)){
            $TomobileNo = implode(', ',$sf_usr->get(['mobile_no']));
        }
        if(!empty($request->user_id)){
            $TomobileNo =  $sf_usr->where('id',$request->user_id)->whereNotNull('mobile_no')->get(['mobile_no']);
        }
        if(empty($TomobileNo)){
            return redirect()->back()->withInput()->with('flash_message', 'No Mobile no. found for selected Users');    
        }
        $client = new HttpGuzzle;
        $urlGet = str_replace(array('xxxxcommaSeperatedxxxx','xxxxSMSTextxxxx'), array($request->sms_text, $TomobileNo), env('SMS_URL'));
        $res = $client->request('GET', $urlGet);
         //\LogActivity::addToLog('Member SMS send successfully');
        return redirect()->back()->with('flash_message', 'Message send successfully');

    }

   public function edit(Request $request, $id)
    {

         $id1 = Auth::user()->id;

        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id1' AND section.sectionname='staff_member/edit'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("staff_member/create",Auth::user()->id);
        if ($this->acc == 1) {
                  $staff_user = Staff_user::findOrFail($id);
        return view('staff.add', [
            'model' => $staff_user,
            'staff_type_lst'=> staff_type::where('is_active', 1)->pluck('type_name', 'id')
            ]);
        }
          else
        {
           $url= url()->previous();
           return redirect($url);
        }

  
    }


    public function show(Request $request, $id)
    {
        $staff_user = Staff_user::findOrFail($id);
        return view('staff_users.show', [
            'model' => $staff_user      ]);
    }

     public function grid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT a.id,a.name,b.type_name,a.mobile_no,a.email_id,1 ";
        $presql = " FROM staff_users a 
					join staff_type b on a.staff_type_id = b.id";
        if ($_GET['search']['value']) {
            $presql .= " WHERE a.name LIKE '%".$_GET['search']['value']."%' ";
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



   public function update(Request $request)
    {
        //
        $this->validate($request, [
            'staff_type_id' => 'required',
            'name' => 'required'
        ], [
            'staff_type_id.required' => 'User Role is required.',
            'name.required' => 'Name is required.'
        ]);


        $staff_user = null;
        if ($request->id > 0) {
            $staff_user = Staff_user::findOrFail($request->id);
        } else {
            $staff_user = new Staff_user;
        }
        

                
        $staff_user->id = $request->id?:0;
        
        
        $staff_user->staff_type_id = $request->staff_type_id;


        $staff_user->name = $request->name;


        $staff_user->description = $request->description;


        $staff_user->ed_degree = $request->ed_degree;


        $staff_user->mobile_no = $request->mobile_no;


        $staff_user->email_id = $request->email_id;


        $staff_user->address = $request->address;


        $staff_user->is_active = is_null($request->is_active)?0:1;
        //$staff_user->user_id = $request->user()->id;
        $staff_user->save();

        return redirect('/staff_member')->with('flash_message', 'Record added successfully');
    }

    public function store(Request $request)
    {
        return $this->update($request);
    }

    public function destroy(Request $request, $id)
    {
    
      $user = User::find($id);


        $user->delete();
        return "OK";

    }
}
