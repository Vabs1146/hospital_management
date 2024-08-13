<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doctor;
use App\User;
use App\UserPermission;
use DB;
use Hash;
use Illuminate\Support\Facades\Input;

class userPermissionController extends Controller {

    protected $userlist;

    public function __construct() {
        
    }
    
    public function index($user_id = "0") {
        $data['user_list'] = DB::SELECT("SELECT * FROM `users`");


        //echo "SELECT parent_menu.parent_title, menu_section.sectionid,menu_section.menu_title,menu_section.parent_menu,menu_section.sectionname, user_permission.* FROM `menu_section` JOIN parent_menu ON parent_menu.id=menu_section.parent_menu AND parent_menu.status='1' LEFT JOIN user_permission ON menu_section.sectionid=user_permission.section_id AND user_permission.user_id='$user_id'  ORDER BY menu_section.parent_menu, menu_section.sectionid"; exit;
		
		 $data['sectionlist'] = DB::SELECT("SELECT parent_menu.parent_title, menu_section.sectionid,menu_section.menu_title,menu_section.parent_menu,menu_section.sectionname, user_permission.* FROM `menu_section` JOIN parent_menu ON parent_menu.id=menu_section.parent_menu AND parent_menu.status='1' LEFT JOIN user_permission ON menu_section.sectionid=user_permission.section_id AND user_permission.user_id='$user_id' where menu_section.status = '1'  ORDER BY menu_section.parent_menu, menu_section.sectionid");

       // $data['sectionlist'] = DB::SELECT("SELECT parent_menu.parent_title,menu_section.sectionid,menu_section.menu_title,menu_section.parent_menu,menu_section.sectionname, user_permission.* FROM `menu_section` JOIN parent_menu ON parent_menu.id=menu_section.parent_menu AND parent_menu.status='1' LEFT JOIN user_permission ON menu_section.sectionid=user_permission.section_id AND user_permission.user_id='$user_id' ORDER BY menu_section.sectionid");
        
        //$data['sectionlist'] = DB::SELECT("SELECT system_menu.menu_id,system_menu.link,system_menu.title, user_permission.* FROM `system_menu` LEFT JOIN user_permission ON system_menu.menu_id=user_permission.section_id AND user_permission.user_id='$user_id' ORDER BY system_menu.menu_id");

        $data['user_id'] = $user_id;
        
        //dd($data);
        return view('user_permissions.index', $data);
    }
    
    public function update(Request $request) {
        $record = DB::table('user_permission')->where('user_id', $request->user_id)->where('section_id', $request->section_id)->first();
        
        if($record) {
            DB::update("UPDATE user_permission SET user_id='$request->user_id', section_id='$request->section_id', {$request->column_name}='$request->update_value' WHERE user_id='$request->user_id' and section_id='$request->section_id'");
        } else {
            DB::table('user_permission')->insert(['user_id' => $request->user_id, 'section_id' => $request->section_id, $request->column_name => $request->update_value]);
        }
        echo 1;
    }

    public function savesection($accesslevel, $id, Request $request) {

        $user_id = $request->user_id;
        $selectrec = $request->selectrec;
        
        $sql = DB::update("UPDATE useraccess SET accesslevel='0' WHERE userid='$user_id'");


        foreach ($selectrec as $value) {
            $sql = DB::update("UPDATE useraccess SET accesslevel='$accesslevel' WHERE userid='$user_id' and sectionid='$value'");
        }
        
    }

    public function saveuser(Request $request) {

        $user = New User();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $pssw = $request->input('password');
        $user->password = Hash::make($pssw);
        $res = $user->save();
        if ($res) {
            $last_entry = User::latest()->first();
            $user_id = $last_entry->id;

            $allsection = DB::SELECT("SELECT * FROM `section`");
            foreach ($allsection as $value) {
                $sectionid = $value->sectionid;

                $sql = DB::insert("INSERT INTO `useraccess`(`userid`, `sectionid`, `accesslevel`) VALUES ('$user_id','$sectionid','0')");
            }
//\LogActivity::addToLog('User created successfully');
            return redirect('/staff_users')->with('flash_message', 'User created successfully');
        }
    }

    public function useraccess($user_id) {
        $data['user_list'] = DB::SELECT("SELECT * FROM `users`");

        $data['sectionlist'] = DB::SELECT("SELECT section.sectionid,section.sectionname, useraccess.accesslevel FROM `section` LEFT JOIN useraccess ON section.sectionid=useraccess.sectionid AND useraccess.userid='$user_id' ORDER BY section.sectionid");

        $sectionlist1 = DB::SELECT("SELECT section.sectionid,section.sectionname, useraccess.accesslevel FROM `section` LEFT JOIN useraccess ON section.sectionid=useraccess.sectionid AND useraccess.userid='$user_id' ORDER BY section.sectionid");

        foreach ($sectionlist1 as $value) {
            if ($value->accesslevel == "") {
                $sectionid = $value->sectionid;
                $ins = DB::insert("INSERT INTO `useraccess`(`userid`, `sectionid`, `accesslevel`) VALUES ('$user_id','$sectionid','0')");
//echo json_encode($value);  
            }
        }
        $data['user_id'] = $user_id;
        return view('User_access.useracc', $data);
    }

    public function ViewReportgrid(Request $request) {

        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = "SELECT section.sectionid,section.sectionname, useraccess.accesslevel";
        $presql = " FROM `section` LEFT JOIN useraccess ON section.sectionid=useraccess.sectionid AND useraccess.userid='1' ";
        $presql .= " WHERE 1=1  ";

        if ($_POST['search']['value']) {
            $presql .= " and sectionname LIKE '%" . $_POST['search']['value'] . "%' ";
        }
        if ($_POST['columns'][1]['search']['value']) {
            $presql .= " and section.sectionname LIKE '%" . $_POST['columns'][1]['search']['value'] . "%' ";
        }
        if ($_POST['columns'][2]['search']['value']) {
            $fromDate = Carbon::createFromFormat('d/M/Y', $_POST['columns'][2]['search']['value'])->format('Y-m-d');
            $presql .= " and a.created_at >= '" . $fromDate . "' ";
        }
        if ($_POST['columns'][3]['search']['value']) {
            $toDate = Carbon::createFromFormat('d/M/Y', $_POST['columns'][3]['search']['value'])->format('Y-m-d');
            $presql .= " and a.created_at <= '" . $toDate . "' ";
        }
        $presql .= "  ";

        $orderByStr = " order by section.sectionid ASC";
//$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;

        if (isset($_POST['order'][0]['column']) && is_numeric($_POST['order'][0]['column'])) {
            $orderColum = intval($_POST['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_POST['order'][0]['dir'];
        }


        $sql = $select . $presql . $orderByStr . " LIMIT " . $start . "," . $len;


        $qcount = DB::select("SELECT COUNT(section.sectionid) c" . $presql);
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

    public function user($user_id) {
        $userlst = User::get()->pluck('name', 'id');

        $sectionlist1 = DB::SELECT("SELECT section.sectionid,section.sectionname, useraccess.accesslevel FROM `section` LEFT JOIN useraccess ON section.sectionid=useraccess.sectionid AND useraccess.userid='$user_id' ORDER BY section.sectionid");

        foreach ($sectionlist1 as $value) {
            if ($value->accesslevel == "") {
                $sectionid = $value->sectionid;
                $ins = DB::insert("INSERT INTO `useraccess`(`userid`, `sectionid`, `accesslevel`) VALUES ('$user_id','$sectionid','0')");
//echo json_encode($value);  
            }
        }





        $selectuser = $user_id;
//return
        return view('User_access.userright', ['userlst' => $userlst, 'selectuser' => $selectuser]);
    }

    public function grid($user_id, Request $request) {
        $len = $_GET['length'];
        $start = $_GET['start'];
        $draw = $request->get('draw');

        $select = "SELECT s.sectionid,s.sectionname, u.accesslevel ";
        $presql = " FROM section s LEFT JOIN useraccess u ON s.sectionid=u.sectionid AND u.userid='$user_id' ORDER BY s.sectionid";
        if ($_GET['search']['value']) {
            $presql .= " and s.sectionid LIKE '%" . $_GET['search']['value'] . "%' ";
        }

// $presql .= " and a.morningEvening = '". $MorningEvening. "' ";

        if ($_GET['columns'][1]['search']['value']) {
            $presql .= " and s.sectionid LIKE '%" . $_GET['columns'][1]['search']['value'] . "%' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
            $presql .= " and s.sectionid LIKE '%" . $_GET['columns'][2]['search']['value'] . "%' ";
        }
        if ($_GET['columns'][2]['search']['value']) {
            $presql .= " and s.sectionid LIKE '%" . $_GET['columns'][2]['search']['value'] . "%' ";
        }


//$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;

        if (isset($_GET['order'][0]['column']) && is_numeric($_GET['order'][0]['column'])) {
            $orderColum = intval($_GET['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_GET['order'][0]['dir'];
        }

        $sql = $select . $presql . " LIMIT " . $start . "," . $len;


        $qcount = DB::select("SELECT COUNT(s.sectionid) c" . $presql);
//print_r($qcount);
        $count = $qcount[0]->c;

        $results = DB::select($sql);

        $data_arr = array();

        foreach ($results as $record) {
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
