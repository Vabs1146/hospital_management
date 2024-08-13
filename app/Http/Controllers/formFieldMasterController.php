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

use App\Models\form_field_master;
use App\Models\form_master_form_field;
use App\Models\form_master;
use App\helperClass\drAppHelper;

use DB;
use Storage;

class formFieldMasterController extends AdminRootController
{
    public function index(Request $request)
    {
        return view('formFieldMaster.index', []);
    }

    public function addfield(Request $request, $field_id)
    {
        $form_field_master = form_field_master::firstOrNew(['id'=>$field_id]);
        return view('formFieldMaster.addField', compact('form_field_master'));
    }

    public function Storefield(Request $request, $field_id)
    {
        $form_field_master  = form_field_master::firstOrNew(['id'=>$field_id]);
        $form_field_master = $form_field_master->updateOrCreate(['id'=>$field_id], $request->all());
        $form_field_master->form_field_code = $form_field_master->id;
        $form_field_master->save();

        if(isset($request->form_master_id) && !is_null($request->form_master_id) && !empty($request->form_master_id)){
            $form_master = form_master::findOrFail($request->form_master_id);
            $form_master_form_field = $form_field_master->form_master_form_field()->firstOrNew(['form_master_id'=>$request->form_master_id]);
            //$form_master_form_field  = form_master_form_field::New();
            $form_master_form_field->updateOrCreate(['form_master_id'=>$request->form_master_id, 'form_field_code'=>$form_field_master->form_field_code], $request->all());
        }
        return redirect()->back()->with('flash_message', 'Record updated successfully')->withInput();
        // $form_field_master = form_field_master::firstOrNew($field_id);
        // $form_master_form_field = $form_field_master->form_master_form_field();
        // $form_master = $form_master_form_field->form_master();
        // return view('formFieldMaster.add', compact('form_field_master', 'form_master_form_field', 'form_master'));
    }

    
    public function editMapping(Request $request, $field_id)
    {
        $form_field_master = form_field_master::findOrFail($field_id);
        $form_master_form_field = $form_field_master->form_master_form_field();
        return view('formFieldMaster.addmapping', compact('form_field_master', 'form_master_form_field', 'form_master'));
    }

    public function updateMapping(Request $request, $field_id)
    {
        
        if (Input::get('delete_item')) {
            $form_master_form_field = form_master_form_field::findOrFail($request['delete_item']);
            if ($form_master_form_field === null) {
                return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
            }
            $form_master_form_field->delete();
        }
        if (Input::get('submit')) {
            $form_master = form_master::findOrFail($request->form_master_id);
            $form_field_master = form_field_master::findOrFail($field_id);
            $form_master_form_field = $form_field_master->form_master_form_field()->firstOrNew(['form_master_id'=>$request->form_master_id]);
            //$form_master_form_field  = form_master_form_field::New();
            $form_master_form_field->updateOrCreate(['form_master_id'=>$request->form_master_id, 'form_field_code'=>$request->form_field_code], $request->all());
        }
        return redirect()->back()->with('flash_message', 'Record updated successfully')->withInput();
        // $form_master_form_field = $form_field_master->form_master_form_field();
        // Input::merge(['form_field_master'=>$form_field_master, 'form_master_form_field'=>$form_master_form_field]);
    }

    public function grid(Request $request)
    {
        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = "select a.id, a.fieldName, a.form_field_code, GROUP_CONCAT(DISTINCT b.form_master_id), 1, 2";
        $presql = " from form_field_master a 
                    left join form_master_form_field b on a.form_field_code = b.form_field_code";

        $presql .= " WHERE 1=1 ";
        if ($_POST['search']['value']) {
            $presql .= " and a.fieldName LIKE '%".$_POST['search']['value']."%' ";
        }
        if ($_POST['columns'][1]['search']['value']) {
            $presql .= " and a.fieldName LIKE '%".$_POST['columns'][1]['search']['value']."%' ";
        }
        if ($_POST['columns'][2]['search']['value']) {
            $presql .= " and b.form_master_id = '".$_POST['columns'][2]['search']['value']."' ";
        }
        $presql .= " ";
        $groupByStr = " group by a.form_field_code ";
        $orderByStr = " order by a.updated_at desc ";
        if (isset($_POST['order'][0]['column']) && is_numeric($_POST['order'][0]['column'])) {
            $orderColum = intval($_POST['order'][0]['column']) + 1;
            if ($orderColum > 0) {
                $orderByStr = " order by ".$orderColum." ".$_POST['order'][0]['dir'];
            }
        }

        $sql = $select.$presql.$groupByStr.$orderByStr." LIMIT ".$start.",".$len;

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
        $ret['draw'] = $_POST['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }

}

