<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Helpers\Helpers;
use App\Medical_store;
use App\helperClass\CommonHelper;

class Medical_storesController extends AdminRootController
{

  public function __construct()
    {
        $this->acc=0;
        $this->commonHelper = new CommonHelper();
    }


    public function index(Request $request)
    {
        return view('medical_stores.index', []);
    }

    public function medicie_list(Request $request)
    {
        return view('medical_stores.medicine_index', []);
    }

    public function create(Request $request)
    {
        return view('medical_stores.add', [
            []
        ]);
    }

    public function medicine_create(Request $request)
    {
   $user = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='menu_lists/create'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("menu_lists/create",Auth::user()->id);
        if ($this->acc == 1) {
             return view('medical_stores.medicine_add', [
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
        $medical_store = Medical_store::findOrFail($id);
        return view('medical_stores.add', [
            'model' => $medical_store]);
    

       
    }

    public function medicine_edit(Request $request, $id)
    {

            $user = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='Medicine/edit'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("menu_lists/edit",Auth::user()->id);
        if ($this->acc == 1) {


        $medical_store = Medical_store::findOrFail($id);
        return view('medical_stores.medicine_add', [
            'model' => $medical_store]);
           }
           else
        {
           $url= url()->previous();
           return redirect($url);
        }
    }

    public function show(Request $request, $id)
    {
        $medical_store = Medical_store::findOrFail($id);
        return view('medical_stores.show', [
            'model' => $medical_store       ]);
    }

    public function grid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT `id`, `medicine_name`, `available_quantity`, `unit_price`, `balance_quantity`, `isactive`, 1,2 ";
        $presql = " FROM medical_store a ";
        if ($_GET['search']['value']) {
            $presql .= " WHERE medicine_name LIKE '%".$_GET['search']['value']."%' ";
        }
        
        $presql .= "  ";

        $orderByStr = "";
        $orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;
        if ($orderColum > 0) {
            $orderByStr = " order by ". $orderColum . " " . $_GET['order'][0]['dir'];
        }
        // if(($_GET['order'][0])['column'] & (($_GET['order'][0])['column'] > 0) & ($_GET['order'][0])['dir']){
        // 	$orderByStr = " order by ".$_GET['order'][0]['column'] ." ". $_GET['order'][0]['dir'];
        // }

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
        echo json_encode($ret);
    }


    public function InsertUpdateMedicine(Request $request)
    {
            //
        $this->validate($request, [
            'medicine_name' => 'required|max:255',
            'available_quantity' => 'required|numeric|min:1',
            'unit_price' => 'required|numeric|min:1',
            'balance_quantity' => 'required|numeric',
        ]);
        
        $medical_store = null;
        $currentTimeStamp = new Carbon();
        $insertUpdate = "";
        if ($request->id > 0) {
            $medical_store = Medical_store::findOrFail($request->id);
            $insertUpdate = "Updated";
        } else {
            $medical_store = new Medical_store;
            $medical_store->created_dt = $currentTimeStamp;
            $insertUpdate = "Inserted";
        }
                
            $medical_store->updated_dt = $currentTimeStamp;
        
            $medical_store->id = $request->id?:0;
                

            $medical_store->medicine_name = $request->medicine_name;

            $medical_store->generic_name = $request->generic_name;

            $medical_store->available_quantity = $request->available_quantity;


            $medical_store->unit_price = $request->unit_price;


            $medical_store->balance_quantity = $request->balance_quantity;


            $medical_store->isactive = is_null($request->isactive)?0:1;



                //$medical_store->user_id = $request->user()->id;
            $medical_store->save();
    }

    public function update(Request $request)
    {
        $this->InsertUpdateMedicine($request);
        return redirect()->route('medical_stores.index')->with('flash_message', 'Record updated successfully');
    }

    public function store(Request $request)
    {
        $this->InsertUpdateMedicine($request);
        return redirect()->route('medical_stores.index')->with('flash_message', 'Record inserted successfully');
    }

    public function medicine_update(Request $request)
    {
        $request['available_quantity'] = empty($request['available_quantity'])? 1: $request['available_quantity'];
        $request['unit_price'] = empty($request['unit_price'])? 1: $request['unit_price'];
        $request['balance_quantity'] = empty($request['balance_quantity'])? 1: $request['balance_quantity'];
        $this->InsertUpdateMedicine($request);
         //\LogActivity::addToLog('Medical store updated successfully');
        return redirect("/Medicine")->with('flash_message', 'Record updated successfully');
    }

    public function medicine_store(Request $request)
    {
        $request['available_quantity'] = empty($request['available_quantity'])? 1: $request['available_quantity'];
        $request['unit_price'] = empty($request['unit_price'])? 1: $request['unit_price'];
        $request['balance_quantity'] = empty($request['balance_quantity'])? 1: $request['balance_quantity'];
        $this->InsertUpdateMedicine($request);
        // \LogActivity::addToLog('Medical store inserted successfully');
        return redirect("/Medicine")->with('flash_message', 'Record inserted successfully');
    }

    public function destroy(Request $request, $id)
    {
        
        $medical_store = Medical_store::findOrFail($id);

        $medical_store->delete();
        return "OK";
    }
}
