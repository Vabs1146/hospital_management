<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doctor;
use App\User;
use App\Useraccess;
use DB;
use Hash;
use Illuminate\Support\Facades\Input;

class userAccessController extends Controller
{

	 protected $userlist;

    public function __construct()
    {
        
        $this->userlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
       
    }

                public function savesection($accesslevel,$id,Request $request)
            {
                 
                    $user_id=$request->user_id;
                    $selectrec=$request->selectrec;

                 // // return $selectrec;
                 //        $useraccess = new Useraccess($id);
          
               $sql = DB::update("UPDATE useraccess SET accesslevel='0' WHERE userid='$user_id'");


                      foreach ($selectrec as $value) {
                        // return  $value;
            $sql = DB::update("UPDATE useraccess SET accesslevel='$accesslevel' WHERE userid='$user_id' and sectionid='$value'");

          }

// elseif($accesslevel=="0")
// {
//        $sql = DB::update("UPDATE useraccess SET accesslevel='0' WHERE userid='$user_id' and sectionid='$value'");
// }
                    // $update= DB::update("UPDATE useraccess SET accesslevel='$accesslevel' WHERE userid='$user_id' and sectionid='$id'");
                       
                       
                            
             }

  
public function saveuser(Request $request) {

    $user = New User();

    $user->name = $request->input('name');

    $user->doctor_degree = $request->doctor_degree;
    $user->doctor_registration_number = $request->doctor_registration_number;
     $user->role = $request->role;
     
    $user->mobile= $request->input('mobile');
    $user->email= $request->input('email');
    $pssw = $request->input('password');
    $user->password = Hash::make($pssw);
    $res= $user->save();
    if($res) {
        $last_entry = User::latest()->first();
        $user_id= $last_entry->id;

        //$allsection=DB::SELECT("SELECT * FROM `section`");
        $allsection=DB::SELECT("SELECT * FROM `menu_section`");
        foreach ($allsection as $value) {
            $section_id=$value->sectionid;
            $sql= DB::insert("INSERT INTO `user_permission`(`user_id`, `section_id`) VALUES ('$user_id','$section_id')");
        }
        //\LogActivity::addToLog('User created successfully');
        return redirect('/staff_users')->with('flash_message', 'User created successfully');
    }
}

    public function useraccess($user_id)
    {
    	   $data['user_list'] = DB::SELECT("SELECT * FROM `users`");

    	   //$data['sectionlist']=DB::SELECT("SELECT section.sectionid,section.sectionname, useraccess.accesslevel FROM `section` LEFT JOIN useraccess ON section.sectionid=useraccess.sectionid AND useraccess.userid='$user_id' ORDER BY section.sectionid");

          //$sectionlist1=DB::SELECT("SELECT section.sectionid,section.sectionname, useraccess.accesslevel FROM `section` LEFT JOIN useraccess ON section.sectionid=useraccess.sectionid AND useraccess.userid='$user_id' ORDER BY section.sectionid");
           
             $data['sectionlist']=DB::SELECT("SELECT menu_section.sectionid,menu_section.sectionname, useraccess.accesslevel FROM `menu_section` LEFT JOIN useraccess ON menu_section.sectionid=useraccess.sectionid AND useraccess.userid='$user_id' ORDER BY menu_section.sectionid");

          $sectionlist1=DB::SELECT("SELECT menu_section.sectionid,menu_section.sectionname, useraccess.accesslevel FROM `menu_section` LEFT JOIN useraccess ON menu_section.sectionid=useraccess.sectionid AND useraccess.userid='$user_id' ORDER BY menu_section.sectionid");

         foreach ($sectionlist1 as  $value) {
         if( $value->accesslevel=="")
         {
          $sectionid=$value->sectionid;
        $ins=DB::insert("INSERT INTO `useraccess`(`userid`, `sectionid`, `accesslevel`) VALUES ('$user_id','$sectionid','0')");
//echo json_encode($value);  
         }
         }


           


           $data['user_id']=$user_id;
    	 return view('User_access.useracc',$data);
    }


public function ViewReportgrid(Request $request){

        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = "SELECT section.sectionid,section.sectionname, useraccess.accesslevel";
        $presql = " FROM `section` LEFT JOIN useraccess ON section.sectionid=useraccess.sectionid AND useraccess.userid='1' ";
        $presql .= " WHERE 1=1  ";
  
        if ($_POST['search']['value']) {
            $presql .= " and sectionname LIKE '%".$_POST['search']['value']."%' ";
        }
        if ($_POST['columns'][1]['search']['value']) {
            $presql .= " and section.sectionname LIKE '%".$_POST['columns'][1]['search']['value']."%' ";
        }
        if ($_POST['columns'][2]['search']['value']) {
            $fromDate = Carbon::createFromFormat('d/M/Y', $_POST['columns'][2]['search']['value'])->format('Y-m-d');
            $presql .= " and a.created_at >= '".$fromDate."' ";
        }
        if ($_POST['columns'][3]['search']['value']) {
            $toDate = Carbon::createFromFormat('d/M/Y', $_POST['columns'][3]['search']['value'])->format('Y-m-d');
            $presql .= " and a.created_at <= '".$toDate."' ";
        }
        $presql .= "  ";

       $orderByStr = " order by section.sectionid ASC";
        //$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;

        if( isset( $_POST['order'][0]['column'] ) && is_numeric( $_POST['order'][0]['column'] ) ){
            $orderColum = intval( $_POST['order'][0]['column'] )+1;
            $orderByStr = " order by ". $orderColum . " " . $_POST['order'][0]['dir'];
        }


        $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;


        $qcount = DB::select("SELECT COUNT(section.sectionid) c".$presql);
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


    public function user($user_id)
    {
      $userlst = User::get()->pluck('name','id');

     $sectionlist1=DB::SELECT("SELECT section.sectionid,section.sectionname, useraccess.accesslevel FROM `section` LEFT JOIN useraccess ON section.sectionid=useraccess.sectionid AND useraccess.userid='$user_id' ORDER BY section.sectionid");

         foreach ($sectionlist1 as  $value) {
         if( $value->accesslevel=="")
         {
          $sectionid=$value->sectionid;
        $ins=DB::insert("INSERT INTO `useraccess`(`userid`, `sectionid`, `accesslevel`) VALUES ('$user_id','$sectionid','0')");
//echo json_encode($value);  
         }
         }


           


           $selectuser=$user_id;
           //return
       return view('User_access.userright',['userlst'=>$userlst,'selectuser'=>$selectuser]);
    }

    public function grid($user_id,Request $request)
    {
       $len = $_GET['length'];
        $start = $_GET['start'];   
        $draw = $request->get('draw'); 

        $select = "SELECT s.sectionid,s.sectionname, u.accesslevel ";
        $presql = " FROM section s LEFT JOIN useraccess u ON s.sectionid=u.sectionid AND u.userid='$user_id' ORDER BY s.sectionid";
        if ($_GET['search']['value']) {
            $presql .= " and s.sectionid LIKE '%".$_GET['search']['value']."%' ";
        }
        
       // $presql .= " and a.morningEvening = '". $MorningEvening. "' ";

        if ($_GET['columns'][1]['search']['value']) {
            $presql .= " and s.sectionid LIKE '%".$_GET['columns'][1]['search']['value']."%' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
            $presql .= " and s.sectionid LIKE '%".$_GET['columns'][2]['search']['value']."%' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
            $presql .= " and s.sectionid LIKE '%".$_GET['columns'][2]['search']['value']."%' ";
        }
       
       
        //$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;

        if( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ){
            $orderColum = intval( $_GET['order'][0]['column'] )+1;
            $orderByStr = " order by ". $orderColum . " " . $_GET['order'][0]['dir'];
        }

        $sql = $select.$presql." LIMIT ".$start.",".$len;


        $qcount = DB::select("SELECT COUNT(s.sectionid) c".$presql);
        //print_r($qcount);
        $count = $qcount[0]->c;

        $results = DB::select($sql);

      $data_arr = array();
     
     foreach($results as $record){
        $sectionid = $record->sectionid;
        $sectionname = $record->sectionname;
        $accesslevel = $record->accesslevel;
        

        $data_arr[] = array(
          "sectionid" => $sectionid,
          "sectionname" => $sectionname,
          "accesslevel" => $accesslevel,
          
        );
     }

     $response = array(
       "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordswithFilter,
        "data" => $data_arr
     );
        
        
        echo json_encode($response);
    }
}
