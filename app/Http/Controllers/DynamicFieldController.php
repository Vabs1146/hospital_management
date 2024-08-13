<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DynamicField;
use DB;
use App\eyeform;
use App\entform;
use App\Models\form_dropdowns;
use Response;
use View;
use App\Models\ent_form_dropdowns;

class DynamicFieldController extends Controller
{
    function index()
    {
     return view('dynamic_field');
    }
  public function bloodinvestigation($uv_chkval,$pre_chkval,$caseid,Request $request)
  {
      $idexist = eyeform::select('*')
            ->where('case_id', $caseid) // use whereMonth here
            ->first();

 if($idexist == null)//if doesn't exist: create
        {
          //return $request->input('case_number');
            $processes = eyeform::create([
                'case_id' => $caseid,
                'case_number' => $request->input('case_number'),
            
            ]); 
            $sql = DB::update("UPDATE eyeform SET uveiitis_chk='$uv_chkval',preoperative_chk='$pre_chkval' WHERE case_id='$caseid'");
        }
        
          $sql = DB::update("UPDATE eyeform SET uveiitis_chk='$uv_chkval',preoperative_chk='$pre_chkval' WHERE case_id='$caseid'");
       
    
  
  }
  
  public function bloodinvestigation1($uv_chkval,$pre_chkval,$caseid,Request $request)
  {
  $idexist = entform::select('*')
            ->where('case_id', $caseid) // use whereMonth here
            ->first();

 if($idexist == null)//if doesn't exist: create
        {
          //return $request->input('case_number');
            $processes = entform::create([
                'case_id' => $caseid,
                'case_number' => $request->input('case_number'),
            
            ]); 
            $sql = DB::update("UPDATE entform SET uveiitis_chk='$uv_chkval',preoperative_chk='$pre_chkval' WHERE case_id='$caseid'");
        }
        
    $sql = DB::update("UPDATE entform SET uveiitis_chk='$uv_chkval',preoperative_chk='$pre_chkval' WHERE case_id='$caseid'");
  
  }
 

  ////////////////////////////////////////////////////////////////////
public function uveiitis_chk($checked,$caseid,Request $request)
  {

    $sql = DB::update("UPDATE entform SET uveiitis_chk='$checked' WHERE case_id='$caseid'");
  
  }

  public function preoperative_chk($checked,$caseid,Request $request)
  {

    $sql = DB::update("UPDATE entform SET preoperative_chk='$checked' WHERE case_id='$caseid'");
  
  }

  public function preoperative_chk1($checked,$caseid,Request $request)
  {

    $sql = DB::update("UPDATE entform SET preoperative_chk1='$checked' WHERE case_id='$caseid'");
  
  }

  ////////////////////////////////////////////////////////////////////

   public function ear1($checked,$caseid,Request $request)
  {

    $sql = DB::update("UPDATE entform SET ear1_chk='$checked' WHERE case_id='$caseid'");
  
  }

   public function ear2($checked,$caseid,Request $request)
  {

    $sql = DB::update("UPDATE entform SET ear2_chk='$checked' WHERE case_id='$caseid'");
  
  }

   public function nose($checked,$caseid,Request $request)
  {
   $sql = DB::update("UPDATE entform SET nose_chk='$checked' WHERE case_id='$caseid'");
  }

  public function neck($checked,$caseid,Request $request)
  {
   $sql = DB::update("UPDATE entform SET neck_chk='$checked' WHERE case_id='$caseid'");
  }

  public function throat($checked,$caseid,Request $request)
  {
   $sql = DB::update("UPDATE entform SET throat_chk='$checked' WHERE case_id='$caseid'");
  }


  
  function systemicinsert(Request $request)
    {

      $options = $request->optionsval;
      $field_name=$request->field_name;
    
      foreach ($options as $value) {
    
       $sql= DB::insert("INSERT INTO `eyeformmultipleentry`(`field_name`, `field_value_OD`,`field_value_OS`) VALUES ('$field_name','$value','$value')");
    
         }
           return response()->json([
       'success'  => 'Data Added successfully.'
      ]);
        } 
        
  function segmentinsert(Request $request)
    {

      $options = $request->optionsval;
      $field_name=$request->field_name;
    
      foreach ($options as $value) {
    
       $sql= DB::insert("INSERT INTO `eyeformmultipleentry`(`field_name`, `field_value_OD`,`field_value_OS`) VALUES ('$field_name','$value','$value')");
    
         }
           return response()->json([
       'success'  => 'Data Added successfully.'
      ]);
        }

      public  function AddBloodTitle(Request $request)
        {
         //echo "<pre> ============= ";print_r($_POST);exit;
          $options = $request->optionsval;
          $field_name=$request->field_name;
        
          foreach ($options as $value) {

           // $valuearr = explode('_',$value);

           // $val = $valuearr[1];

            $sql= DB::insert("INSERT INTO `blood_investigation_titles`(`blood_title`) VALUES ('$value')");
          } 
          //echo "<pre> ============= ";print_r($);exit;

          $sqlQuery = DB::select("select * from`blood_investigation_titles`");
         // echo "<pre> ============= ";print_r($sqlQuery);exit;

          $str = "";
          $str = '<option value="">Select Title</option>';
          foreach ($sqlQuery as $value) {
            $str .= '<option value="'.$value->id.'_'.$value->blood_title.'" data-id="'.$value->id.'">'.$value->blood_title.'</option>';
          }

          echo $str;exit;
            // $selectStr = "<option>".."</option>";
               return response()->json([
           'success'  => 'Data Added successfully.',
           'string'   => $str
          ]);
        }

      public  function AddBloodSubTitle(Request $request)
        {
         // echo "<pre> ============= ";print_r($_POST);exit;
          $options = $request->optionsval_subtitles;
          $blood_title=$request->blood_title;
          $valuearr = explode('_',$blood_title);

          $id = $valuearr[0];       
          foreach ($options as $value) {
        
           $sql= DB::insert("INSERT INTO `eye_blood_investigation`(`blood_title_id`,`blood_value`) VALUES ('$id','$value')");
        
             }
               return response()->json([
           'success'  => 'Data Added successfully.'
          ]);
        }

function insert(Request $request) {

    //echo "======>>>>>>>> <pre>"; print_r($_POST); exit;
    $formName='EyeForm';
    $options = $request->optionsval;
    $fieldName1=$request->fieldName1;
    $fieldName2=$request->fieldName2;

    foreach ($options as $value) {

        $sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$value','$value')");

        $insert_id = DB::getPdo()->lastInsertId();

        $sql= DB::table('form_dropdowns')->where('id',$insert_id)->update(['group_id' => $insert_id]);

        if($fieldName1 != $fieldName2) {
                $sql= DB::insert("INSERT INTO `form_dropdowns`(`group_id`, `formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$insert_id','$formName','$fieldName2','$value','$value')");
        }
    }
    return response()->json([
    'success'  => 'Data Added successfully.'
    ]);
}


function refraction_options(Request $request) {
    foreach ($request->optionsval as $key => $value_arr) {
        
        foreach ($value_arr as $value) {
            $sql= DB::insert("INSERT INTO `refraction_dropdown`(`key_value`, `os`) VALUES ('$key','$value')");
        }
    }
    return response()->json([
    'success'  => 'Data Added successfully.'
    ]);
}

function update_refraction_options(Request $request) {
    
   // echo "====>>>>>>>>> <pre>"; print_r($_POST); exit;
    
    
    
    foreach ($request->all_option_ids as $key => $value_arr) {     
        $deleted_options = array_diff($value_arr, $request->single_update_field_id[$key]);
        
        DB::table('refraction_dropdown')->whereIn('id', $deleted_options)->delete();
        
        foreach ($request->single_update_field_id[$key] as $k => $value) {
            DB::table('refraction_dropdown')->where('id', $value)->update(['os' => $request->update_option_values[$key][$k]]);
        }
    }
    return response()->json([
    'success'  => 'Data Added successfully.'
    ]);
}

function medicineinsert(Request $request) {
    $is_generic = $request->is_generic;
    $balance_quantity= ($request->balance_quantity)?:'1';
    $isactive=($request->isactive)?:'1';

    $options = $request->optionsval;

    foreach ($options as $key => $value) {
        if($is_generic) {
        $sql= DB::insert("INSERT INTO `medical_store`( `medicine_name`, `generic_name`, `is_generic`, `balance_quantity`,`isactive`) VALUES ('$value','$value','$is_generic','$balance_quantity','$isactive');");
        } else {
            //$sql= DB::insert("INSERT INTO `medical_store`( `medicine_name`,`balance_quantity`,`isactive`) VALUES ('$value','$balance_quantity','$isactive');");
            $generic_name = ($request->generic_name[$key]) ? $request->generic_name[$key] : '';
           $sql= DB::insert("INSERT INTO `medical_store`( `medicine_name`, `generic_name`, `balance_quantity`,`isactive`) VALUES ('$value','$generic_name','$balance_quantity','$isactive');");
        }
    }
}

function generic_medicine_insert(Request $request) {
    $is_generic = 1;
    $balance_quantity= ($request->balance_quantity)?:'1';
    $isactive=($request->isactive)?:'1';

    $options = $request->optionsval;

    foreach ($options as $value) {
        $sql= DB::insert("INSERT INTO `medical_store`( `medicine_name`, `generic_name`, `is_generic`, `balance_quantity`,`isactive`) VALUES ('$value','$value','$is_generic','$balance_quantity','$isactive');");
    }
}

        function entmedicineinsert(Request $request)
        {

      $balance_quantity=$request->balance_quantity;
      $isactive=$request->isactive;
    
      $options = $request->optionsval;

      foreach ($options as $value) {
   
       $sql= DB::insert("INSERT INTO `entmedical_store`( `medicine_name`,`balance_quantity`,`isactive`) VALUES ('$value','$balance_quantity','$isactive');");
    
          }
        }
      

      function eyeinsert(Request $request)
        {

      $formName=$request->formName;
      $fieldName=$request->fieldName;
    
      $options = $request->optionsval;

      foreach ($options as $value) {
   
     $sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName','$value','$value')");
      
    
          }
        }

       

           function blnceinsert(Request $request)
    {
      $options = $request->blncetestname;
      $case_id=$request->caseid;
      $case_number=$request->casenum;
     

      foreach ($options as $value) {
    
       $sql= DB::insert("INSERT INTO `blnc_test`(`case_id`, `case_number`, `blncetestname`) VALUES ('$case_id','$case_number','$value')");
    
     

          }
           return response()->json([
       'success'  => 'Data Added successfully.'
      ]);
        }

        public function checksts($sts,$caseid,Request $request)
            {
                 
                    $case_id=$request->case_id;
                    $selectrec=$request->checksts;

             $sql = DB::update("UPDATE blnc_test SET sts='0' WHERE case_id='$case_id'");
                      foreach ($selectrec as $value) {
                        // return  $value;
            $sql = DB::update("UPDATE blnc_test SET sts='$sts' WHERE case_id='$case_id' and id='$value'");

          }
        }
	
	
	function entinsert(Request $request)
        {

      $formName='ent_prescription';
      $fieldName=$request->fieldName;
    
      $options = $request->optionsval;
      
      //dd($request->all());

      foreach ($options as $value) {
   
     $sql= DB::insert("INSERT INTO `ent_form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName','$value','$value')");
      
    
          }
        }
	function gyninsert(Request $request)
        {

      $formName=$request->formName;
      $fieldName=$request->field_name;
    
      $options = $request->optionsval;

      foreach ($options as $value) {
   
     $sql= DB::insert("INSERT INTO `gyn_form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName','$value','$value')");
      
    
          }
        }
    
	//////////////////////////
  function mdinsert(Request $request)
        {

      $formName=$request->formName;
      $fieldName=$request->fieldName;
    
      $options = $request->optionsval;

      foreach ($options as $value) {
   
     $sql= DB::insert("INSERT INTO `md_form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName','$value','$value')");
      
    
          }
        }
	
	//////Skin Insert////
	 function skininsert(Request $request)
    {
     
      $options = $request->optionsval;
      $formName=$request->formName;
      $fieldName=$request->fieldName;

      foreach ($options as $value) {
       $sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName','$value','$value')");
      }
          
    }

/*
array:6 [
  "tableName" => "gyn_form_dropdowns"
  "formName" => "gyn"
  "fieldName" => "PastPersonalHistory"
  "initial_options_ids" => array:4 [
    0 => "4"
    1 => "14"
    2 => "15"
    3 => "16"
  ]
  "initial_optionsid" => array:4 [
    0 => "4"
    1 => "14"
    2 => "15"
    3 => "16"
  ]
  "initial_optionsval" => array:4 [
    0 => "PastPersonalHistory"
    1 => "PastPersonalHistory 2"
    2 => "PastPersonalHistory 3"
    3 => "PastPersonalHistory 4"
  ]
]
	  */

    
function update_ent_dropdown_options(Request $request) {

    //dd($request->all());

    $values = array();
    parse_str($_POST['form_data'], $post_array);

    //dd($post_array);

    foreach($post_array['initial_options_ids'] as $initial_options) {
        $check_for_updated_value = array_search($initial_options, $post_array['initial_optionsid']);

        if(in_array($initial_options, $post_array['initial_optionsid'])) {
            DB::table($post_array['tableName'])
                ->where('id', $initial_options)
                ->update(['ddText' => $post_array['initial_optionsval'][$check_for_updated_value], 'ddValue' => $post_array['initial_optionsval'][$check_for_updated_value]]);
            
            /*
            DB::table($post_array['tableName'])
                ->where('group_id', $initial_options)
                ->update(['ddText' => $post_array['initial_optionsval'][$check_for_updated_value], 'ddValue' => $post_array['initial_optionsval'][$check_for_updated_value]]);
            */

        } else {
            DB::table($post_array['tableName'])
                ->where('id', $initial_options)
                ->delete();
            
            /*
            DB::table($post_array['tableName'])
                ->where('group_id', $initial_options)
                ->delete();
            */
        }
    }

    $updated_records = DB::table($post_array['tableName'])->where('formName', $post_array['formName'])->where('fieldName', $post_array['fieldName'])->get();

    $options_html = '';

}

	function update_dropdown_options(Request $request) {

		//dd($request->all());

		$values = array();
		parse_str($_POST['form_data'], $post_array);
		
		//dd($post_array);

		foreach($post_array['initial_options_ids'] as $initial_options) {
			$check_for_updated_value = array_search($initial_options, $post_array['initial_optionsid']);

			if(in_array($initial_options, $post_array['initial_optionsid'])) {
				DB::table($post_array['tableName'])
					->where('id', $initial_options)
					->update(['ddText' => $post_array['initial_optionsval'][$check_for_updated_value], 'ddValue' => $post_array['initial_optionsval'][$check_for_updated_value]]);
			
				DB::table($post_array['tableName'])
					->where('group_id', $initial_options)
					->update(['ddText' => $post_array['initial_optionsval'][$check_for_updated_value], 'ddValue' => $post_array['initial_optionsval'][$check_for_updated_value]]);
			
			} else {
				DB::table($post_array['tableName'])
					->where('id', $initial_options)
					->delete();

				DB::table($post_array['tableName'])
					->where('group_id', $initial_options)
					->delete();
			}
		}

		$updated_records = DB::table($post_array['tableName'])->where('formName', $post_array['formName'])->where('fieldName', $post_array['fieldName'])->get();

		$options_html = '';

	}

  function insurancedeletesurgery(Request $request) {
    $id = $request->id;
        DB::table('insurance_surgery_dropdown')
          ->where('id', $id)
          ->delete();   
  }

  function update_dropdown_options_blood_ivn(Request $request) {
    
    //dd($request->all());

    $values = array();
    parse_str($_POST['form_data'], $post_array);
    
    //dd($post_array);
    //echo "<pre> =========== ";print_r($post_array);exit();
    
    foreach($post_array['initial_options_ids'] as $initial_options) { 
      $check_for_updated_value = array_search($initial_options, $post_array['initial_optionsid']);
        DB::table('blood_investigation_titles')
        ->where('id', $initial_options)
        ->update(['blood_title' => $post_array['initial_optionsval'][$check_for_updated_value]]);     
    }

  }


  public function delete_bloodinvestigatinTitles(Request $request) {
      $id = $request->idToDelete;
      if(($request->has('parent'))) {
        
        $qry = DB::delete('delete from blood_investigation_titles where id = ?',[$id]);
      } else {
        $qry = DB::delete('delete from eye_blood_investigation where id = ?',[$id]);
      }
      //echo "Id is ::".$id;exit;
      
      //$dropdown_options_field_name = $request->form_field;
  }

  public function get_update_dropdown_options_blood_investigation(Request $request) {
    //echo "<pre> ================ ";print_r($_POST);exit;

    $str = "";
    if($_POST['subtitle']) {
      $sqlQuery = DB::select("select * from `eye_blood_investigation` where blood_title_id = '".$_POST['selectedID']."'");
      if(!empty($sqlQuery)) {
        $str = '<div name="" class="update-dropdown-options-form-blood-ivn-subtitle" id="update-dropdown-options-form-blood-ivn-subtitle" method="POST" action="">';
        foreach ($sqlQuery as $value) {
          $str .= '
          <input type="hidden" name="initial_options_ids[]" value="'.$value->id.'">
          <div class="col-md-3 initial_options">
            <div class="input-group">
              <div class="form-line">
                <input class="form-control" type="hidden" placeholder="value1" class="initial_optionsid" name="initial_optionsid[]" value="'.$value->id.'">
                <input class="form-control" type="text" placeholder="value1" class="initial_optionsval" name="initial_optionsval[]" value="'.$value->blood_value.'">
              </div>
              <span class="input-group-addon remove-initial-options-BI" type="button"><i class="fa fa-times" aria-hidden="true"></i></span>
            </div>
          </div> ';
        }
      
        $str .= '<span class="update-dropdown-options-btn_blood_ign_subtitle btn btn-success">Update</span>
       <span class="cancel-dropdown-options-btn-subtitle btn btn-success">Cancel</span></div>'; 
      }     
    } else {



          $sqlQuery = DB::select("select * from`blood_investigation_titles`");
          $str = '<div name="" class="update-dropdown-options-form-blood-ivn" id="update-dropdown-options-form-blood-ivn" method="POST" action="">';
          if(!empty($sqlQuery)) {
            foreach ($sqlQuery as $value) {
              $str .= '
              <input type="hidden" name="initial_options_ids[]" value="'.$value->id.'">
              <div class="col-md-3 initial_options">
                <div class="input-group">
                  <div class="form-line">
                    <input class="form-control" type="hidden" placeholder="value1" class="initial_optionsid" name="initial_optionsid[]" value="'.$value->id.'">
                    <input class="form-control" type="text" placeholder="value1" class="initial_optionsval" name="initial_optionsval[]" value="'.$value->blood_title.'">
                  </div>
                  <span class="input-group-addon remove-initial-options-parent" type="button"><i class="fa fa-times" aria-hidden="true"></i></span>
                </div>
              </div> ';
            }

          $str .= '<span class="update-dropdown-options-btn_blood_ign btn btn-success">Update</span>
           <span class="cancel-dropdown-options-btn btn btn-success">Cancel</span></div>';   
        }   
    }
    
    // echo "<pre> ============= ";print_r($sqlQuery);exit;


    echo $str;exit;
  }

   function update_dropdown_options_blood_ivn_subtitle(Request $request) {
    
    //dd($request->all());

    $values = array();
    parse_str($_POST['form_data'], $post_array);
    
    //dd($post_array);
    //echo "<pre> =========== ";print_r($post_array);exit();
    
    foreach($post_array['initial_options_ids'] as $initial_options) { 
      $check_for_updated_value = array_search($initial_options, $post_array['initial_optionsid']);
        DB::table('eye_blood_investigation')
        ->where('id', $initial_options)
        ->update(['blood_value' => $post_array['initial_optionsval'][$check_for_updated_value]]);     
    }

  }
 

	public function get_update_dropdown_options(Request $request) {
		$form_dropdowns_array = [];
		$form_dropdowns = [];
		
		$dropdown_options_table_name = 'form_dropdowns';
		$dropdown_options_form_name = $request->form_name;
		$dropdown_options_field_name = $request->form_field;

		//$dropdown_options_field_name

		//$form_dropdowns = form_dropdowns::where('formName', $request->form_name)->where('fieldName', $request->field_name)->get();
		$form_dropdowns = form_dropdowns::where('formName', $request->form_name)->get();

		

		foreach($form_dropdowns as $form_dropdowns_row) {
			$form_dropdowns_array[$form_dropdowns_row->fieldName][$form_dropdowns_row->id]['ddText'] = $form_dropdowns_row->ddText;
			$form_dropdowns_array[$form_dropdowns_row->fieldName][$form_dropdowns_row->id]['ddValue'] = $form_dropdowns_row->ddValue;
		}

		//dd($form_dropdowns_array);

		//return $form_dropdowns_array;

		return Response::json(['view' => View::make('comman_templates.get_dropdown_options_update', compact('form_dropdowns_array', 'dropdown_options_table_name', 'dropdown_options_form_name', 'dropdown_options_field_name'))->render()]);
	}
        
public function get_update_ent_dropdown_options(Request $request) {
    $form_dropdowns_array = [];
    $form_dropdowns = [];

    $dropdown_options_table_name = 'ent_form_dropdowns';
    $dropdown_options_form_name = $request->form_name;
    $dropdown_options_field_name = $request->form_field;

    //$dropdown_options_field_name

    //$form_dropdowns = form_dropdowns::where('formName', $request->form_name)->where('fieldName', $request->field_name)->get();
    $form_dropdowns = ent_form_dropdowns::where('formName', $request->form_name)->get();

    foreach($form_dropdowns as $form_dropdowns_row) {
        $form_dropdowns_array[$form_dropdowns_row->fieldName][$form_dropdowns_row->id]['ddText'] = $form_dropdowns_row->ddText;
        $form_dropdowns_array[$form_dropdowns_row->fieldName][$form_dropdowns_row->id]['ddValue'] = $form_dropdowns_row->ddValue;
    }

    //dd($form_dropdowns_array);

    //return $form_dropdowns_array;

    return Response::json(['view' => View::make('comman_templates.get_dropdown_options_update', compact('form_dropdowns_array', 'dropdown_options_table_name', 'dropdown_options_form_name', 'dropdown_options_field_name'))->render()]);
}
	
		//Manage blood Investigation
  public function manageBloodinvestigation(Request $request)
  {
		$idexist = eyeform::select('*')
		->where('case_id', $request->input('caseid')) // use whereMonth here
		->first();

		$record = DB::table('blood_investigations')->where('case_id',$request->input('caseid'))->where('form_type',$request->input('form_type'))->where('test_type', $request->input('test_type'))->where('value',$request->input('test'))->first();

		if($idexist == null)//if doesn't exist: create
		{
			//return $request->input('case_number');
			$processes = eyeform::create([
				'case_id' => $caseid,
				'case_number' => $request->input('case_number')
			]); 
		}

		if($record == null) {
			$sql = DB::table('blood_investigations')->insert(['case_id' => $request->input('caseid'), 'form_type' => $request->input('form_type'), 'test_type' => $request->input('test_type'), 'value' => $request->input('test')]);
		} else {
			DB::table('blood_investigations')->delete($record->id);
		}
		
  }
  
  public function get_ent_prescription_dropdown_options(Request $request) {
    $form_dropdowns_array = [];
    $form_dropdowns = [];
		
    $dropdown_options_table_name = $request->table_name;
    $dropdown_options_form_name = $request->form_name;
    $dropdown_options_field_name = $request->form_field;

    $form_dropdowns = ent_form_dropdowns::where('formName', $request->form_name)->get();

		
    if($dropdown_options_table_name == "entmedical_store") {
        $form_dropdowns = DB::table('entmedical_store')->get();

        $field_name = "ent_medicine";
        $dropdown_options_form_name = 'ent_medicine';
        $dropdown_options_field_name = 'ent_medicine';
    } else {
        $form_dropdowns = ent_form_dropdowns::where('formName', $request->form_name)->get();
    }

		//dd($form_dropdowns);

    foreach($form_dropdowns as $form_dropdowns_row) {
        $field_name = isset($form_dropdowns_row->fieldName) ? $form_dropdowns_row->fieldName : $field_name;
        $form_dropdowns_array[$field_name][$form_dropdowns_row->id]['ddText'] = $form_dropdowns_row->medicine_name;
        $form_dropdowns_array[$field_name][$form_dropdowns_row->id]['ddValue'] = $form_dropdowns_row->id;
    }

		//dd($form_dropdowns_array);

		//return $form_dropdowns_array;

    return Response::json(['view' => View::make('comman_templates.get_prescription_dropdown_options_update', compact('form_dropdowns_array', 'dropdown_options_table_name', 'dropdown_options_form_name', 'dropdown_options_field_name'))->render()]);
    }

  public function get_prescription_dropdown_options(Request $request) {
		$form_dropdowns_array = [];
		$form_dropdowns = [];
		
		$dropdown_options_table_name = $request->table_name;
		$dropdown_options_form_name = $request->form_name;
		$dropdown_options_field_name = $request->form_field;

		//$dropdown_options_field_name

		//$form_dropdowns = form_dropdowns::where('formName', $request->form_name)->where('fieldName', $request->field_name)->get();
		$form_dropdowns = form_dropdowns::where('formName', $request->form_name)->get();

		
		if($dropdown_options_table_name == "medical_store") {
                        if($dropdown_options_field_name == 'is_generic') {
                            $form_dropdowns = DB::table('medical_store')->where('is_generic', '1')->get();
                        } else {
                            $form_dropdowns = DB::table('medical_store')->get();
                        }
                        
			$field_name = "medicine";
			$dropdown_options_form_name = 'medicine';
			$dropdown_options_field_name = 'medicine';
		} else {
			$form_dropdowns = form_dropdowns::where('formName', $request->form_name)->get();
		}

		//dd($form_dropdowns);

		foreach($form_dropdowns as $form_dropdowns_row) {

			$field_name = isset($form_dropdowns_row->fieldName) ? $form_dropdowns_row->fieldName : $field_name;
			$form_dropdowns_array[$field_name][$form_dropdowns_row->id]['ddText'] = $form_dropdowns_row->medicine_name;
                        $form_dropdowns_array[$field_name][$form_dropdowns_row->id]['generic_name'] = $form_dropdowns_row->generic_name;
			$form_dropdowns_array[$field_name][$form_dropdowns_row->id]['ddValue'] = $form_dropdowns_row->id;
		}

		//dd($form_dropdowns_array);

		//return $form_dropdowns_array;

		return Response::json(['view' => View::make('comman_templates.get_prescription_dropdown_options_update', compact('form_dropdowns_array', 'dropdown_options_table_name', 'dropdown_options_form_name', 'dropdown_options_field_name'))->render()]);
	}

	function update_prescription_dropdown_options(Request $request) {

		//dd($request->all());

		$values = array();
		parse_str($_POST['form_data'], $post_array);
		
		//dd($post_array);

		foreach($post_array['initial_options_ids'] as $initial_options) {
			$check_for_updated_value = array_search($initial_options, $post_array['initial_optionsid']);

			if(in_array($initial_options, $post_array['initial_optionsid'])) {
				if($post_array['tableName'] == "medical_store") {
            DB::table($post_array['tableName'])
                    ->where('id', $initial_options)
                    ->update(['medicine_name' => $post_array['initial_optionsval'][$check_for_updated_value], 'generic_name' => $post_array['generic_name'][$check_for_updated_value]]);
				}
			
			} else {
				if($post_array['tableName'] == "medical_store") {
					DB::table($post_array['tableName'])
					->where('id', $initial_options)
					->delete();
				}				
			}
		}

		//$updated_records = DB::table($post_array['tableName'])->where('formName', $post_array['formName'])->where('fieldName', $post_array['fieldName'])->get();

		//$options_html = '';

	}
        
        function update_ent_prescription_dropdown_options(Request $request) {

		//dd($request->all());

		$values = array();
		parse_str($_POST['form_data'], $post_array);
		
		//dd($post_array);

		foreach($post_array['initial_options_ids'] as $initial_options) {
			$check_for_updated_value = array_search($initial_options, $post_array['initial_optionsid']);

			if(in_array($initial_options, $post_array['initial_optionsid'])) {
				if($post_array['tableName'] == "entmedical_store") {
					DB::table($post_array['tableName'])
						->where('id', $initial_options)
						->update(['medicine_name' => $post_array['initial_optionsval'][$check_for_updated_value]]);
				}
			
			} else {
				if($post_array['tableName'] == "entmedical_store") {
					DB::table($post_array['tableName'])
					->where('id', $initial_options)
					->delete();
				}				
			}
		}

		//$updated_records = DB::table($post_array['tableName'])->where('formName', $post_array['formName'])->where('fieldName', $post_array['fieldName'])->get();

		//$options_html = '';

	}
	
				//Manage print display
  public function managePrintDisplay(Request $request) {
		$record = DB::table('print_page_settings')->where('form_type', $request->form_type)->where('value', $request->value)->first();

		if($record == null) {
			$sql = DB::table('print_page_settings')->insert(['form_type' => $request->input('form_type'), 'value' => $request->input('value')]);
		} else {
			DB::table('print_page_settings')->delete($record->id);
		}
		
  }
    
  
  public function set_dropdown_options() {
        /*
        $image_gallery = Image_gallery::where('imgTypeId', $id)->first();
        if($image_gallery === null || empty($image_gallery) || is_null($image_gallery)){
                $image_gallery = new Image_gallery();
                $image_gallery->imgTypeId = $id;
        }
        */
      
      $dropdown_options_array = array(
            'otherDetailsDiagnosis' => ['Diagnosis', 'OD', 'OS'],
'surgery' => ['Suregey', 'OD', 'OS'],
'investigation' => 'Investigation',
'investigation' => 'treatmentgiven',
'reasonofadmission' => 'reasonofadmission',
'systemicdiseases' => 'systemicdiseases',
'surgerydetails' => 'surgerydetails',
'surgeryvision' => 'Vision',
'otherDetailsAnteriorSegment' => ['Anterior Segment', 'OD', 'OS'],

'otherDetailsPosteriorSegment' => ['Posterior Segment', 'OD', 'OS'],
'discharge_iol_name' => 'Name of IOL',
          
            'section' => 'Section', 
            'site' => 'Site',
            'side_ports' => 'No of Side Ports',
            'acm' => 'ACM',
            'ccc' => 'C C C',
            'intra_cameral' => 'Intra cameral',
            'hydrodissect' => 'Hydrodissect',
            'hyrodelamination' => 'Hyrodelamination',
            'iol' => 'IOL',
            'iol_type' => 'IOL Type',
            'stromal_hydration' => 'Stromal Hydration',
            'intra_operative_event' => 'Intra Operative Event');
      
        return view('settings.set_options', compact('dropdown_options_array'));
    }
    
    
    public function get_update_refraction_dropdown_options(Request $request) {
        /*
		$form_dropdowns_array = [];
		$form_dropdowns = [];
		
		$dropdown_options_table_name = 'form_dropdowns';
		$dropdown_options_form_name = $request->form_name;
		$dropdown_options_field_name = $request->form_field;

		//$dropdown_options_field_name

		//$form_dropdowns = form_dropdowns::where('formName', $request->form_name)->where('fieldName', $request->field_name)->get();
		$form_dropdowns = form_dropdowns::where('formName', $request->form_name)->get();

		

		foreach($form_dropdowns as $form_dropdowns_row) {
			$form_dropdowns_array[$form_dropdowns_row->fieldName][$form_dropdowns_row->id]['ddText'] = $form_dropdowns_row->ddText;
			$form_dropdowns_array[$form_dropdowns_row->fieldName][$form_dropdowns_row->id]['ddValue'] = $form_dropdowns_row->ddValue;
		}

		//dd($form_dropdowns_array);

		//return $form_dropdowns_array;

		return Response::json(['view' => View::make('comman_templates.get_dropdown_options_update', compact('form_dropdowns_array', 'dropdown_options_table_name', 'dropdown_options_form_name', 'dropdown_options_field_name'))->render()]);
	*/
        //=======================================================
        $data_type = $request->type;  

        $refraction_dropdowns = DB::table('refraction_dropdown')->where('key_value', $data_type)->get();
        // $refraction_dropdowns_arr = $refraction_dropdowns->where('key_value', 'sph')->pluck('os','od')->toArray();
        $refraction_dropdowns_arr['sph'] = [];
        $refraction_dropdowns_arr['cyl'] = [];
        $refraction_dropdowns_arr['vision'] = [];
        foreach($refraction_dropdowns as $refraction_dropdowns_row) {
            $refraction_dropdowns_arr[$refraction_dropdowns_row->key_value][$refraction_dropdowns_row->id] = $refraction_dropdowns_row->os; 
        } 
        
        return Response::json(['view' => View::make('EyeForm.steps.refration_option_update.update_sph', compact('refraction_dropdowns_arr', 'data_type'))->render()]);
    }
	
	
    function insert_discharge(Request $request) {

      //echo "======>>>>>>>> <pre>"; print_r($_POST); exit;
      $formName=$request->dropdown_feild_form;
      $fieldName1=$request->dropdown_feild_name;

      $options = $request->optionsval;
      $titles = $request->optionsTitle;
  
      foreach ($options as $key => $value) {
          $sql= DB::insert("INSERT INTO `form_dropdowns`(`formName`, `fieldName`, `ddText`,`ddValue`) VALUES ('$formName','$fieldName1','$titles[$key]','$value')");
      }
      return response()->json([
      'success'  => 'Data Added successfully.'
      ]);
  }


  function get_record(Request $request) {

    //echo "======>>>>>>>> <pre>"; print_r($_POST); exit;
    
    $id = $request->id;

    $data = DB::table('form_dropdowns')->where('id', $id)->first();
    return response()->json([
      'success'  => isset($data->id) ? 1 : 0,
      'result'  => $data
    ]);
}
}

