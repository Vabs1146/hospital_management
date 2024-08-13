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

use App\Case_master;
use App\doctor;
use App\timeslot;
use App\Medical_store;
use App\case_number_generators;
use App\prescription_list;
use App\appointment;
use App\report_image;
use App\Staff_user;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as HttpGuzzle;
use App\field_type_data;
use App\field_type_memory;
use App\quantity_dropdown;
use App\strength_dropdown;
use App\number_of_times_dropdown;
use App\Image_gallery;
use App\helperClass\drAppHelper;
use App\Models\form_dropdowns;
use DateTime;
use Auth;
use App\Helpers\Helpers;
use App\Models\paymentfor;
use Illuminate\Support\Facades\Mail;
use App\Mail\casePaperMail;
use App\Mail\GenralpformMail;
use PDF;
use App\helperClass\CommonHelper;
use App\eyeform;

class PrescriptionController extends AdminRootController
{
    public function __construct() {
        $this->acc=0;
        $this->commonHelper = new CommonHelper();
    }

    public function index(Request $request, $case_id = "") {
        return view('prescriptions.index', ['case_id' => $case_id]);
    }

   public function prescription_templates_grid(Request $request) {
        $len = $_POST['length'];
        $start = $_POST['start'];
        
        
        $select = "SELECT a.id, a.template_name";
        
        $presql = " FROM prescription_templates a ";
        $presql .= " WHERE 1=1 and a.parent = 0";
        
        
        
        $presql .= "  ";
        $orderByStr = " order by 1 desc";
        //$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;
        if (isset($_POST['order'][0]['column']) && is_numeric($_POST['order'][0]['column']))
        {
            $orderColum = intval($_POST['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_POST['order'][0]['dir'];
        }

        //$sql = $select . $presql . $orderByStr . " LIMIT " . $start . "," . $len;
        if($len > 0) {
            $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;
        } else {
            $sql = $select.$presql.$orderByStr;
        }

        $qcount = DB::select("SELECT COUNT(a.id) c" . $presql);
        //print_r($qcount);
        $count = $qcount[0]->c;
        $results = DB::select($sql);
        $ret = [];
        foreach ($results as $row)
        {
            $r = [];
            foreach ($row as $value)
            {
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
    
    public function ent_template_list(Request $request, $case_id = "") {
        return view('prescriptions.ent_template_list', ['case_id' => $case_id]);
    }

   public function ent_prescription_templates_grid(Request $request) {
        $len = $_POST['length'];
        $start = $_POST['start'];
        
        
        $select = "SELECT a.id, a.template_name";
        
        $presql = " FROM ent_prescription_templates a ";
        $presql .= " WHERE 1=1 and a.parent = 0";
        
        
        
        $presql .= "  ";
        $orderByStr = " order by 1 desc";
        //$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;
        if (isset($_POST['order'][0]['column']) && is_numeric($_POST['order'][0]['column']))
        {
            $orderColum = intval($_POST['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_POST['order'][0]['dir'];
        }

        //$sql = $select . $presql . $orderByStr . " LIMIT " . $start . "," . $len;
        if($len > 0) {
            $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;
        } else {
            $sql = $select.$presql.$orderByStr;
        }

        $qcount = DB::select("SELECT COUNT(a.id) c" . $presql);
        //print_r($qcount);
        $count = $qcount[0]->c;
        $results = DB::select($sql);
        $ret = [];
        foreach ($results as $row)
        {
            $r = [];
            foreach ($row as $value)
            {
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
    
    public function edit_ent_prescription_templates($template_id = "", $case_id = "") {
        $user = Auth::user()->id;
        $template = DB::table('prescription_templates')->where('id', $template_id)->orWhere('parent', $template_id)->get();
        
        //dd($template);
        $getdata = [];
        //echo "111111111111111111"; exit;
        $presDropdowns = [
'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText') 
        ];

        //dd($presDropdowns);
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')
        ->pluck('doctor_name', 'id');
        $timeslot = timeslot::where('isActive', 1)->orderBy('id')
        ->pluck('name', 'id');
        $medicinlist = Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)
        ->orderBy('created_dt', 'desc')
        ->get();

        //dd($presDropdowns);
        $mergeArray = array_merge($getdata, $presDropdowns, ['doctorlist' => $doctorlist, 'timeslot' => $timeslot, 'medicinlist' => $medicinlist]);
        //echo "=========>>>>>>> <pre>"; print_r($template); exit;
        return view('prescriptions.edit_prescription_templates', ['casedata' => $mergeArray, 'templates' => $template, 'case_id' => $case_id, 'template_id' => $template_id]);
    }
    
    public function edit_prescription_templates($template_id = "", $case_id = "") {
        $user = Auth::user()->id;
        $template = DB::table('prescription_templates')->where('id', $template_id)->orWhere('parent', $template_id)->get();
        
        //dd($template);
        $getdata = [];
        //echo "111111111111111111"; exit;
        $presDropdowns = [
'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText') 
        ];

        //dd($presDropdowns);
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')
        ->pluck('doctor_name', 'id');
        $timeslot = timeslot::where('isActive', 1)->orderBy('id')
        ->pluck('name', 'id');
        $medicinlist = Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)
        ->orderBy('created_dt', 'desc')
        ->get();

        //dd($presDropdowns);
        $mergeArray = array_merge($getdata, $presDropdowns, ['doctorlist' => $doctorlist, 'timeslot' => $timeslot, 'medicinlist' => $medicinlist]);
        //echo "=========>>>>>>> <pre>"; print_r($template); exit;
        return view('prescriptions.edit_prescription_templates', ['casedata' => $mergeArray, 'templates' => $template, 'case_id' => $case_id, 'template_id' => $template_id]);
    }
    
    public function update_prescription_templates(Request $request) {
        //echo "===========>>>>>>>> <pre>"; print_r($_POST); exit;
        $parent = 0;
        
        if($request->id) {
            $template = DB::table('prescription_templates')->where('id', $request->id)->orWhere('parent', $request->id)->delete();
        }
        foreach($request->medicine_id as $key => $medicine) {
            
            $insert_data = [
                'template_name' => $request->template_name,
                'medicine_id' => $medicine,
                'frequency' => $request->frequency[$key],
                'duration' => $request->duration[$key],
                'generic_medicine_id' => $request->generic_medicine[$key],
                'medicine_timing' => $request->medicine_timing[$key]
            ];
            
            if($parent != 0) {
                $insert_data['parent'] = $parent;
                DB::table('prescription_templates')->insert($insert_data);
            } else {
                $parent = DB::table('prescription_templates')->insertGetId($insert_data);
            }
            
        }
        
       // echo "==========1111111111=>>>>>>>> <pre>"; print_r($request->medicine_id); exit;
        
        return redirect()->back()
                //->withInput()
                ->with('flash_message', 'Template added Successully.');
    }
    
    public function delete_prescription_templates(Request $request, $template_id) {
        DB::table('prescription_templates')->where('id', $template_id)->orWhere('parent', $template_id)->delete();
        
        //return redirect()->back()
                //->withInput()
                //->with('flash_message', 'Template deleted Successully.');
    }
    
    public function delete_ent_prescription_templates(Request $request, $template_id) {
        DB::table('ent_prescription_templates')->where('id', $template_id)->orWhere('parent', $template_id)->delete();
        
        //return redirect()->back()
                //->withInput()
                //->with('flash_message', 'Template deleted Successully.');
    }
    
    //===============================================================================================
    
    public function list_finding_templates(Request $request, $case_id = "") {
        return view('templates.findings.list', ['case_id' => $case_id]);
    }

   public function findings_templates_grid(Request $request) {
        $len = $_POST['length'];
        $start = $_POST['start'];
        
        
        $select = "SELECT a.id, a.name as template_name";
        
        $presql = " FROM finding_template a ";
        $presql .= " WHERE 1 = 1";
        
        //$finding_templates = DB::table('finding_template')->where('status', '1')->get();
        
        $presql .= "  ";
        $orderByStr = " order by 1 desc";
        //$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;
        if (isset($_POST['order'][0]['column']) && is_numeric($_POST['order'][0]['column']))
        {
            $orderColum = intval($_POST['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_POST['order'][0]['dir'];
        }

        //$sql = $select . $presql . $orderByStr . " LIMIT " . $start . "," . $len;
        if($len > 0) {
            $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;
        } else {
            $sql = $select.$presql.$orderByStr;
        }

        $qcount = DB::select("SELECT COUNT(a.id) c" . $presql);
        //print_r($qcount);
        $count = $qcount[0]->c;
        $results = DB::select($sql);
        $ret = [];
        foreach ($results as $row)
        {
            $r = [];
            foreach ($row as $value)
            {
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
    
    
    public function getFindingTemplateHtml(Request $request, $case_id = "") {}
    
    public function edit_finding_templates($template_id = "", $case_id = "") {
       
        $user = Auth::user()->id;
        
        $template = DB::table('finding_template')->where('id', $template_id)->first();
        
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        $form_details = new eyeform();
        $template_data_result = DB::table('finding_template_data')->where('template_id', $template_id)->get();
        
        //dd($template_data_result);
        foreach($template_data_result as $template_data_result_row) {
            $template_data[$template_data_result_row->key_text][] = $template_data_result_row;
        }
        
        $case_data = null;
//dd($template_data);
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        $form_details = new eyeform();
        return view('templates.findings.finding_templates.edit_finding_templates', ['form_dropdowns' => $form_dropdowns, 'form_details' => $form_details, 'case_id' => $case_id, 'casedata' => null, 'defaultValues' => [], 'template' => $template, 'template_data' => $template_data,'template_id' => $template_id]);
    }
    
    public function update_finding_templates(Request $request, $template_id = "") {
        dd($request->all());
    }
            
            
    
    public function update_finding_templates11(Request $request, $template_id = "", $case_id = "") {
        
        
        DB::table('finding_template')->where('id', $template_id)->delete();
        
        DB::table('finding_template_data')->where('template_id', $template_id)->delete();
        
        //echo "===========>>>>>>>> <pre>".$template_id; print_r($_POST); exit;
        
        $template_id = DB::table('finding_template')->insertGetId(['name' => $request->template_name]);
  
        foreach($request->Lids_OD as $key => $val) {
            $os = $request->Lids_OS[$key];
            $key_text = "Lids";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->OrbitSacsEyeMotility_OD as $key => $val) {
            $os = $request->OrbitSacsEyeMotility_OS[$key];
            $key_text = "OrbitSacsEyeMotility";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->ConjAndLids_OD as $key => $val) {
            $os = $request->ConjAndLids_OS[$key];
            $key_text = "ConjAndLids";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->cornia_od as $key => $val) {
            $os = $request->cornia_os[$key];
            $key_text = "cornia";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->AC_OD as $key => $val) {
            $os = $request->AC_OS[$key];
            $key_text = "AC";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->IRIS_OD as $key => $val) {
            $os = $request->IRIS_OS[$key];
            $key_text = "IRIS";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->pupilIrisac_OD as $key => $val) {
            $os = $request->pupilIrisac_OS[$key];
            $key_text = "pupilIrisac";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->lens_od as $key => $val) {
            $os = $request->lens_os[$key];
            $key_text = "lens";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->vitreoretinal_OD as $key => $val) {
            $os = $request->vitreoretinal_OS[$key];
            $key_text = "vitreoretinal";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->Retina_OD as $key => $val) {
            $os = $request->Retina_OS[$key];
            $key_text = "Retina";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                    'duration_od' => $request->retina_eye_OD[$key],
                    'duration_os' => $request->retina_eye_OS[$key]
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->ONH_OD as $key => $val) {
            $os = $request->ONH_OS[$key];
            $key_text = "ONH";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->Macula_OD as $key => $val) {
            $os = $request->Macula_OS[$key];
            $key_text = "Macula";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        foreach($request->sac_OD as $key => $val) {
            $os = $request->sac_OS[$key];
            $key_text = "sac";
            if($val != "" && $os != "") {
                $insert_data = array(
                    'template_id' => $template_id,
                    'key_text' => $key_text,
                    'od' => $val,
                    'os' => $os,
                );
                DB::table('finding_template_data')->insert($insert_data);
            }
        }
        
        return redirect('list-finding-templates')->with('flash_message', 'Template updated Successully.');
    }
    
    public function delete_finding_templates(Request $request, $template_id) {
        DB::table('finding_template')->where('id', $template_id)->delete();
    }
    
    public function addFindingTemplate($case_id = "") {
        $user = Auth::user()->id;
        
        $case_data = null;
//dd($template_data);
        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();
        $form_details = new eyeform();
        return view('EyeForm.finding_templates.add_finding_templates', ['form_dropdowns' => $form_dropdowns, 'form_details' => $form_details, 'case_id' => $case_id, 'casedata' => null, 'defaultValues' => []]);
    }
    
    


}

