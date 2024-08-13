<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Menu_list;
use Auth;
use App\Helpers\Helpers;
use DB;
use App\helperClass\CommonHelper;

class Menu_listsController extends AdminRootController
{

     public function __construct()
    {
        $this->acc=0;
         $this->commonHelper = new CommonHelper();
    }

    public function index(Request $request)
    {
        return view('menu_lists.index', []);
    }

    public function create(Request $request)
    {
         $user = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='menu_lists/create'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("menu_lists/create",Auth::user()->id);
        if ($this->acc == 1) {
      $menulst = Menu_list::get()->pluck('name','id');
        //$Menu_list = $Menu_list+$menulst;
        return view('menu_lists.add', []+['menulst'=>$menulst]);
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

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='menu_lists/edit'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("menu_lists/edit",Auth::user()->id);
        if ($this->acc == 1) {
             $menu_list = Menu_list::findOrFail($id);
        $menulst = Menu_list::get()->pluck('name','id');
        return view('menu_lists.add', ['model' => $menu_list]+['menulst'=>$menulst]);
        }
             else
        {
           $url= url()->previous();
           return redirect($url);
        }
       
    }

    public function show(Request $request, $id)
    {

   $user = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='menu_lists/number'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("menu_lists/number",Auth::user()->id);
        if ($this->acc == 1) {
              $menu_list = Menu_list::findOrFail($id);
        return view('menu_lists.show', [
            'model' => $menu_list       ]);
        }

         else
        {
           $url= url()->previous();
           return redirect($url);
        }

      
    }

    public function grid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT Id,name,description,isActive,1,2 ";
        $presql = " FROM menu_list a ";
        if ($_GET['search']['value']) {
            $presql .= " WHERE name LIKE '%".$_GET['search']['value']."%' ";
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
        /*$this->validate($request, [
	        'name' => 'required|max:255',
	    ]);*/
        $menu_list = null;
        if ($request->id > 0) {
            $menu_list = Menu_list::findOrFail($request->id);
        } else {
            $menu_list = new Menu_list;
        }
              
		$menu_list->name = $request->name;


		$menu_list->description = $request->description;


		$menu_list->parentId = $request->parentId;


		$menu_list->menu_type = $request->menu_type;

        $menu_list->orderNo = $request->orderNo;
		
		$menu_list->orientation = $request->orientation;
		$menu_list->link = $request->link;
		$menu_list->isActive  = isset($request->isActive)?1:0;

        
                //$menu_list->user_id = $request->user()->id;
        $menu_list->save();

       //\LogActivity::addToLog('Menu list added successfully');
        // return redirect()->route('doctor.index')->with('flash_message', 'Record created successfully')
        // return redirect('/menu_lists');
         return redirect('/menu_lists')->with('flash_message', 'Record created successfully');
    }

    public function store(Request $request)
    {
        return $this->update($request);
    }

    public function destroy(Request $request, $id)
    {
        
        $menu_list = Menu_list::findOrFail($id);

        $menu_list->delete();
        return "OK";
    }
}
