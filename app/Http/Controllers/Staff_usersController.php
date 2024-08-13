<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Staff_user;
use App\User;
use App\staff_type;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as HttpGuzzle;
use Auth;
use App\Helpers\Helpers;
use DB;

class Staff_usersController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(Request $request)
    {
        return view('staff_users.index', []);
    }

    public function create(Request $request)
    {

         $id1 = Auth::user()->id;
/*
        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id1' AND section.sectionname='membercontact/staff_users/create'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
        if($acc==1)
        {
         return view('staff_users.useraddd', [
        'model' => null,
        'staff_type_lst'=> staff_type::where('is_active', 1)->pluck('type_name', 'id')
        ]);
        }

       else
        {
           $url= url()->previous();
           return redirect($url);
        }

 */
         
         $roles = DB::table('roles')->where('status', '1')->get();
         
          return view('staff_users.useraddd', [
        'model' => null,
        'staff_type_lst'=> staff_type::where('is_active', 1)->pluck('type_name', 'id'),
              'roles' => $roles
        ]);
      
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
/*
        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id1' AND section.sectionname='membercontact/staff_users/edit'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
        if($acc==1)
        {
                $staff_user = User::findOrFail($id);
        return view('staff_users.add', [
            'model' => $staff_user,
            'staff_type_lst'=> staff_type::where('is_active', 1)->pluck('type_name', 'id')
            ]);
        }
         else
        {
           $url= url()->previous();
           return redirect($url);
        }
*/
          
           $staff_user = User::findOrFail($id);
$roles = DB::table('roles')->where('status', '1')->get();
		  //echo "=====>>>>>> <pre>"; print_r($staff_user); exit;
        return view('staff_users.add', [
            'model' => $staff_user,
            'staff_type_lst'=> staff_type::where('is_active', 1)->pluck('type_name', 'id'),
            'roles' => $roles
            ]);
    
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

        $select = "SELECT users.id,users.name,roles.role,users.mobile,users.password ";
        $presql = " FROM users LEFT JOIN roles ON roles.id = users.role";
        if ($_GET['search']['value']) {
            $presql .= " WHERE id LIKE '%".$_GET['search']['value']."%' ";
        }
        
        $presql .= "  ";

        $sql = $select.$presql." LIMIT ".$start.",".$len;


        $qcount = DB::select("SELECT COUNT(users.id) c".$presql);
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
        
		//echo "=========>>>>>>>> <pre>"; print_r($_POST); exit;
        $user = null;
        if ($request->id > 0) {
            $user = User::findOrFail($request->id);
        } else {
            $user = new User;
        }
        

            //dd($request->all());     
         $user->id = $request->id?:0;
         $user->name = $request->name;
         $user->role = $request->role;

        $user->doctor_degree = $request->doctor_degree;
        $user->doctor_registration_number = $request->doctor_registration_number;

         $user->mobile = $request->mobile;
         $user->email = $request->email;


        if($request->password != '') {
			$user->password = bcrypt($request->password);
		}

        $user->save();
           // \LogActivity::addToLog('User Record updated successfully');
        return redirect('/staff_users')->with('flash_message', 'Record updated successfully');
    }

    public function store(Request $request)
    {
		//echo "=========>>>>>>>> <pre>"; print_r($_POST); exit;
        return $this->update($request);
    }

    public function destroy(Request $request, $id)
    {
    
      $user = User::find($id);


        $user->delete();
        return "OK";

    }

     public function deleteuser(Request $request, $id) {    
        $user = User::findOrFail($id);
        $user->delete();
        //\LogActivity::addToLog('Old Register Record deleted successfully');
        return "OK";
    }
}
