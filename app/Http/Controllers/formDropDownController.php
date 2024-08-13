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

use App\Models\form_dropdowns;
use App\Models\form_field_master;
use App\Case_master;
use App\helperClass\drAppHelper;

use DB;
use Storage;

class formDropDownController extends AdminRootController
{

    public function index(Request $request)
    {
        $formNameList = form_field_master::select('formName')->distinct()->get()->pluck('formName','formName')->toArray();
        $fieldNameList = [];
        $fieldName1 = [];
        return view('formDropDown.add', compact('formNameList', 'fieldNameList'));
    }

    public function get_form_field($id){
        return form_field_master::where('formName', $id)->get(['fieldName' ,'fieldName']);
        
    }

    public function store(Request $request){
        if (Input::get('formDrDwnChange')) {
            $formNameList = form_field_master::select('formName')->distinct()->get()->pluck('formName','formName')->toArray();
            $fieldNameList = form_field_master::where('formName', $request['formName'])->select('fieldName')->get()->pluck('fieldName','fieldName')->toArray();  
            return back()->withInput();//->with('formNameList',$formNameList)->with('fieldNameList', $fieldNameList);
        }
        if (Input::get('submit')) {
            $form_details = form_dropdowns::where('formName', $request->formName)->where('fieldName', $request->fieldName)->where('ddText',$request->ddText)->first();
            //var_dump(DB::getQueryLog());
            if ($form_details === null) {
                $form_details = new form_dropdowns;
                $form_details->fill($request->all());
                $form_details->ddValue = $request->ddText;
                $form_details->save();
            }
            //Below query will make sure only one value for field is default
            form_dropdowns::where('id', '!=', $form_details->id)->where('formName', $request->formName)->where('fieldName', $request->fieldName)->where('isdefault', 1)->update(array('isdefault'=>null));

            $formNameList = form_field_master::select('formName')->distinct()->get()->pluck('formName','formName')->toArray();
            $fieldNameList = form_field_master::where('formName', $request['formName'])->select('fieldName')->get()->pluck('fieldName','fieldName')->toArray();
            //$request->add($fieldNameList);
            Input::merge(['fieldNameList'=>$fieldNameList, 'formNameList'=>$formNameList]);
             // \LogActivity::addToLog('Form Field values added successfully');
            return back()->with('flash_message', 'Record added successfully')->withInput();
        }
    }

}