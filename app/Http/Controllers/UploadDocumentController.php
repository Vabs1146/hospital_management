<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\report_image;

use App\Case_master;
use App\doctor;
use App\timeslot;
use App\Medical_store;
use App\field_type_memory;
use App\field_type_data;
use App\prescription_list;
use App\case_number_generators;
use DB;

class UploadDocumentController extends AdminRootController {
    
    
    public function upload_listing() {
        
        return view('upload_document.upload_listing', compact('all_docotrs'));
    }
    
    public function grid(Request $request) {       
        
        $len = $_POST['length'];
        $start = $_POST['start'];
        
        $url = url('/').'/uploads/';
        
        $select = "SELECT p.id, CONCAT(COALESCE(p.`first_name`,''), ' ', COALESCE(p.`middle_name`,''), ' ', COALESCE(p.`last_name`,'')), p.ipd_number, p.id as action_id, p.id as action_id1 , p.id as action_id2 , p.id as action_id3 , p.id as action_id4 , p.id as action_id5 , p.id as action_id6 , p.id as action_id7 , p.id as action_id8 , p.id as action_id9  ";
        
        
        $presql = " FROM patients p LEFT JOIN ipd_patients_dropdowns pd ON pd.id = p.consulting_doctor AND pd.type = 'ipd_doctor' ";
        
         $presql .= " WHERE is_deleted = '0' ";
          $logged_user = Auth::user()->id;
         $presql .= "AND created_by = '".$logged_user."' ";
        //Auth::user()->id;
         
        if ($_REQUEST['search']['value']) {
            $presql .= " and p.first_name LIKE '%".$_REQUEST['search']['value']."%' ";
        }
        
        //echo "====>>>>>>>>>>>> <pre>"; print_r($_POST); exit;
        if ($_REQUEST['columns'][1]['search']['value']) {
            $presql .= " and (p.first_name LIKE '%".$_REQUEST['columns'][1]['search']['value']."%' OR p.middle_name LIKE '%".$_REQUEST['columns'][1]['search']['value']."%' OR  p.last_name LIKE '%".$_REQUEST['columns'][1]['search']['value']."%') ";
        }
        if ($_REQUEST['columns'][2]['search']['value']) {
            $docotor_id =  $_REQUEST['columns'][2]['search']['value'];
            $presql .= " and p.consulting_doctor ='".$docotor_id."' ";
        }
        if ($_REQUEST['columns'][3]['search']['value']) {
            $ipd_number =  $_REQUEST['columns'][3]['search']['value'];
            $presql .= " and p.ipd_number LIKE '%".$ipd_number."%' ";
        }
        
        if ($_REQUEST['columns'][4]['search']['value']) {
            $fromDate =  $_REQUEST['columns'][4]['search']['value'];
            //$presql .= " and date(p.admission_date_time) >='".$fromDate."' ";
            $presql .= " and date(SUBSTRING_INDEX(p.admission_date_time,' - ', 1)) >='".$fromDate."' ";
        }
        
        if ($_REQUEST['columns'][5]['search']['value']) {
            $toDate =  $_REQUEST['columns'][5]['search']['value'];
            //$presql .= " and date(p.admission_date_time) <='".$toDate."' ";
            
            $presql .= " and date(SUBSTRING_INDEX(p.admission_date_time,' - ', 1)) <='".$toDate."' ";
            
            
        }
        
        $presql .= "  ";
        
        $orderByStr = " order by 1 desc";
        
        if (isset($_POST['order'][0]['column']) && is_numeric($_POST['order'][0]['column'])) {
            $orderColum = intval($_POST['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_POST['order'][0]['dir'];
        }

        //$sql = $select . $presql . $orderByStr . " LIMIT " . $start . "," . $len;
        if($len > 0) {
            $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;
        } else {
            $sql = $select.$presql.$orderByStr;
        }

        $qcount = DB::select("SELECT COUNT(*) c ".$presql);
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
    
    public function upload_document(Request $request, $id)
    {
         $sp_test_image = report_image::where('case_id', $id)->Where('reportFileName', 'upload_document')->get()->toArray();
        return view('upload_document.upload_form', ['casedata' => $this->getCaseData($id), 'sp_test_image' => $sp_test_image]);
    }

    public function ipd_upload_document(Request $request, $id)
    {
        //$sp_test_image = report_image::where('case_id', $id)->Where('reportFileName', 'upload_document')->get()->toArray();
        //return view('upload_document.upload_form', ['casedata' => $this->getCaseData($id), 'sp_test_image' => $sp_test_image]);

        $sp_test_image = DB::table('ipd_report_images')->where('patients_id', $id)->Where('reportFileName', 'upload_document')->get()->toArray();
        
        $sp_test_image = $sp_test_image ? json_decode(json_encode($sp_test_image), 1) : $sp_test_image ;
        //dd($sp_test_image);
        return view('upload_document.ipd_upload_form', ['casedata' => ['id' => $id], 'sp_test_image' => $sp_test_image]);
    }
    
     public function store_upload_document(Request $request)
    {
        $isEdit = true;
        $case_master = null;
        $case_master = Case_master::where('id', $request->id)
            //->whereDate('created_at', Carbon::today()
            //->toDateString())
            ->first();
        
        //dd($case_master);
        if ($case_master === null) {
            $case_master = new Case_master;
            $isEdit = false;
        }
        
        
        if($request->has('old_images')) {
            $old_images = $request->old_images;

            $db_old_iomages = report_image::where('case_id', $request->id)->whereNotIn('id', $old_images)->delete();
            
            foreach($request->old_images_title as $old_images_title_key => $old_images_title_row) {
                report_image::where('id', $old_images_title_key)->update(['title' => $old_images_title_row]);
            }
            
           // dd($db_old_iomages);
        } else {
             $db_old_iomages = report_image::where('case_id', $request->id)->delete();
        }
        
        foreach($request->new_image_data as $key => $new_image_data_row) {
            $data = $new_image_data_row;

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            
            $name = strtotime('now').'_'. $key .'.png';

            file_put_contents('sp_test_images/'.$name, $data);
            
            $report_image = new report_image();
            $report_image->reportFileName = 'upload_document';
            $report_image->case_id = $request->id;
            $report_image->filePath = $name;
            $report_image->title = $request->new_image_title[$key];
            $report_image->save();
        }
        
        $case_master->casehistory_followup_notes =  $request->casehistory_followup_notes;
        if (isset($request->FollowUpDoctorID) && isset($request->appointment_dt) && $request->appointment_dt != null && $request->appointment_dt != '') {
            $case_master->FollowUpDate =  $request->appointment_dt;
            $case_master->FollowUpTimeSlot = $request->FollowUpTimeSlot;
            $case_master->FollowUpDoctor_Id = $request->FollowUpDoctorID;
            
             $case_master->touch(); //updated_at = Carbon::now();
             $case_master->save();
        }
        
        return redirect()->back()->with('flash_message','Record Added Successfully!');

    }

    public function ipd_store_upload_document(Request $request)
    {

        //dd($request->all());
        if($request->has('old_images')) {
            $old_images = $request->old_images;

            //$db_old_iomages = report_image::where('case_id', $request->id)->whereNotIn('id', $old_images)->delete();

            DB::table('ipd_report_images')->where('patients_id', $request->id)->whereNotIn('id', $old_images)->delete();
            
            foreach($request->old_images_title as $old_images_title_key => $old_images_title_row) {
                //report_image::where('id', $old_images_title_key)->update(['title' => $old_images_title_row]);
                DB::table('ipd_report_images')->where('id', $old_images_title_key)->update(['title' => $old_images_title_row]);
            }
            
           // dd($db_old_iomages);
        } else {
             //$db_old_iomages = report_image::where('case_id', $request->id)->delete();
             DB::table('ipd_report_images')->where('patients_id', $request->id)->delete();
        }
        
        foreach($request->new_image_data as $key => $new_image_data_row) {
            $data = $new_image_data_row;

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            
            $name = strtotime('now').'_'. $key .'.png';

            file_put_contents('sp_test_images/'.$name, $data);
            
            /*
            $report_image = new report_image();
            $report_image->reportFileName = 'upload_document';
            $report_image->case_id = $request->id;
            $report_image->filePath = $name;
            $report_image->title = $request->new_image_title[$key];
            $report_image->save();
            */

            $insert_data = array(
                'reportFileName'    => 'upload_document',
                'patients_id'       => $request->id,
                'filePath'          => $name,
                'title'             => $request->new_image_title[$key]
            );

            DB::table('ipd_report_images')->insert($insert_data);
        }

        
        return redirect()->back()->with('flash_message','Record Added Successfully!');

    }
//----------------------------Upload reports--------------------------------------------------
 public function upload_reports(Request $request, $id) {
         $sp_test_image = report_image::where('case_id', $id)->Where('reportFileName', 'upload_reports')->get()->toArray();
        return view('upload_document.upload_reports_form', ['casedata' => $this->getCaseData($id), 'sp_test_image' => $sp_test_image]);
    }

    public function ipd_upload_reports(Request $request, $id) {
       //$sp_test_image = report_image::where('case_id', $id)->Where('reportFileName', 'upload_reports')->get()->toArray();
       //return view('upload_document.upload_reports_form', ['casedata' => $this->getCaseData($id), 'sp_test_image' => $sp_test_image]);

       $sp_test_image = DB::table('ipd_report_images')->where('patients_id', $id)->Where('reportFileName', 'upload_reports')->get()->toArray();
        
       $sp_test_image = $sp_test_image ? json_decode(json_encode($sp_test_image), 1) : $sp_test_image ;
       //dd($sp_test_image);
       return view('upload_document.upload_reports_form', ['casedata' => ['id' => $id], 'sp_test_image' => $sp_test_image]);
   }

   public function ipd_store_upload_reports(Request $request) {
        if($request->has('old_images')) {
            $old_images = $request->old_images;
            DB::table('ipd_report_images')->where('patients_id', $request->id)->whereNotIn('id', $old_images)->delete();
            
            foreach($request->old_images_title as $old_images_title_key => $old_images_title_row) {
                DB::table('ipd_report_images')->where('id', $old_images_title_key)->update(['title' => $old_images_title_row]);
            }
        } else {
             DB::table('ipd_report_images')->where('patients_id', $request->id)->delete();
        }
        
        foreach($request->new_image_data as $key => $new_image_data_row) {
            $data = $new_image_data_row;

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            
            $name = strtotime('now').'_'. $key .'.png';

            file_put_contents('sp_test_images/'.$name, $data);
            $insert_data = array(
                'reportFileName'    => 'upload_reports',
                'patients_id'       => $request->id,
                'filePath'          => $name,
                'title'             => $request->new_image_title[$key]
            );

            DB::table('ipd_report_images')->insert($insert_data);
        }
        return redirect()->back()->with('flash_message','Record Added Successfully!');
    }
    
    public function store_upload_reports(Request $request) {
        $isEdit = true;
        $case_master = null;
        $case_master = Case_master::where('id', $request->id)
            //->whereDate('created_at', Carbon::today()
            //->toDateString())
            ->first();
        
        //dd($case_master);
        if ($case_master === null) {
            $case_master = new Case_master;
            $isEdit = false;
        }
        
        
        if($request->has('old_images')) {
            $old_images = $request->old_images;

            $db_old_iomages = report_image::where('case_id', $request->id)->whereNotIn('id', $old_images)->delete();
            
            foreach($request->old_images_title as $old_images_title_key => $old_images_title_row) {
                report_image::where('id', $old_images_title_key)->update(['title' => $old_images_title_row]);
            }
            
           // dd($db_old_iomages);
        } else {
             $db_old_iomages = report_image::where('case_id', $request->id)->delete();
        }
        
        foreach($request->new_image_data as $key => $new_image_data_row) {
            $data = $new_image_data_row;

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            
            $name = strtotime('now').'_'. $key .'.png';

            file_put_contents('sp_test_images/'.$name, $data);
            
            $report_image = new report_image();
            $report_image->reportFileName = 'upload_reports';
            $report_image->case_id = $request->id;
            $report_image->filePath = $name;
            $report_image->title = $request->new_image_title[$key];
            $report_image->save();
        }
        
        $case_master->casehistory_followup_notes =  $request->casehistory_followup_notes;
        if (isset($request->FollowUpDoctorID) && isset($request->appointment_dt) && $request->appointment_dt != null && $request->appointment_dt != '') {
            $case_master->FollowUpDate =  $request->appointment_dt;
            $case_master->FollowUpTimeSlot = $request->FollowUpTimeSlot;
            $case_master->FollowUpDoctor_Id = $request->FollowUpDoctorID;
            
             $case_master->touch(); //updated_at = Carbon::now();
             $case_master->save();
        }
        
         return redirect()->back()->with('flash_message','Record Added Successfully!');

    }   

//------------------------------------------------------------------------------
public function upload_report_documents(Request $request, $id)
    {
         $sp_test_image = report_image::where('case_id', $id)->Where('reportFileName', 'upload_report_documents')->get()->toArray();
        return view('upload_document.upload_report_documents_form', ['casedata' => $this->getCaseData($id), 'sp_test_image' => $sp_test_image]);
    }

public function ipd_upload_report_documents(Request $request, $id) {
    $sp_test_image = DB::table('ipd_report_images')->where('patients_id', $id)->Where('reportFileName', 'upload_report_documents')->get()->toArray();
        
    $sp_test_image = $sp_test_image ? json_decode(json_encode($sp_test_image), 1) : $sp_test_image ;
    //dd($sp_test_image);
    return view('upload_document.upload_report_documents_form', ['casedata' => ['id' => $id], 'sp_test_image' => $sp_test_image]);
}

public function ipd_store_upload_report_documents(Request $request) {
    if($request->has('old_images')) {
        $old_images = $request->old_images;
        DB::table('ipd_report_images')->where('patients_id', $request->id)->whereNotIn('id', $old_images)->delete();        
        foreach($request->old_images_title as $old_images_title_key => $old_images_title_row) {
            DB::table('ipd_report_images')->where('id', $old_images_title_key)->update(['title' => $old_images_title_row]);
        }
    } else {
         DB::table('ipd_report_images')->where('patients_id', $request->id)->delete();
    }
    
    $upload_report_title = ($request->upload_report_title) ? strtotime('now').'_'. str_replace(' ', '-', strtolower($request->upload_report_title)) : strtotime('now');    
    
    $file = $request->file('upload_report');

    if($file) {        
        $name = $upload_report_title.'.'.$file->getClientOriginalExtension();

        $destinationPath = 'sp_test_images';
        $file->move($destinationPath, $name);
        
        $insert_data = array(
            'reportFileName'    => 'upload_report_documents',
            'patients_id'       => $request->id,
            'filePath'          => $name,
            'title'             => $request->upload_report_title
        );

        DB::table('ipd_report_images')->insert($insert_data);
    }
    return redirect()->back()->with('flash_message','Record Added Successfully!');
}
    
     public function store_upload_report_documents(Request $request)
    {
         
         if($request->has('old_images')) {
            
            $old_images = $request->old_images;

            $db_old_iomages = report_image::where('case_id', $request->id)->whereNotIn('id', $old_images)->delete();
            
            foreach($request->old_images_title as $old_images_title_key => $old_images_title_row) {
                report_image::where('id', $old_images_title_key)->update(['title' => $old_images_title_row]);
            }
            
           // dd($db_old_iomages);
        } else {
             $db_old_iomages = report_image::where('case_id', $request->id)->delete();
        }
         
         
      // echo "===>>>>>>>>>>> <pre>"; print_r($_POST); exit;
       $upload_report_title = ($request->upload_report_title) ? strtotime('now').'_'. str_replace(' ', '-', strtolower($request->upload_report_title)) : strtotime('now');    
       
       
         
          $file = $request->file('upload_report');
   
          if($file) {
              
              $name = $upload_report_title.'.'.$file->getClientOriginalExtension();
                      
            $destinationPath = 'sp_test_images';
            $file->move($destinationPath, $name);

            $report_image = new report_image();
            $report_image->reportFileName = 'upload_report_documents';
            $report_image->case_id = $request->id;
            $report_image->filePath = $name;
            $report_image->title = $request->upload_report_title;
            $report_image->save();
          }
      
      return redirect()->back()->with('flash_message','Record Added Successfully!');
    }    
    
//===================================================================================
     public function getCaseData($id)
    {

        $case_master = Case_master::findOrFail($id);
        
        //dd($case_master);

        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')
            ->pluck('doctor_name', 'id');
        $timeslot = timeslot::where('isActive', 1)->orderBy('id')
            ->pluck('name', 'id');
        $medicinlist = Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)
            ->orderBy('created_dt', 'desc')
            ->get();
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)
            ->where('is_deleted', '0')
            ->orderBy('created_at', 'asc')
            ->select('id', 'created_at')
            ->get();
        $field_type_memory = field_type_memory::get();
        $field_type_data = field_type_data::where('case_id', $case_master->id)
            ->get();
        $casedata = [
            'id' => $case_master->id, 
            'doctorlist' => $doctorlist, 
            'timeslot' => $timeslot, 
            'medicinlist' => $medicinlist, 
            'prescriptions' => prescription_list::where('case_id', $case_master->id)->get(), 
            'DateWiseRecordLst' => $DateWiseRecordLst, 
            'case_number' => $case_master->case_number, //'p_00000001'
            'patient_name' => $case_master->patient_name, 
            'middle_name' => $case_master->middle_name, 
            'last_name' => $case_master->last_name, 
            'mr_mrs_ms' => $case_master->mr_mrs_ms, 
            'doctor_id' => $case_master->doctor_id, 
            'patient_age' => $case_master->patient_age, 
            'patient_weight' => $case_master->patient_weight, 
            'patient_height' => $case_master->patient_height, 
            'patient_address' => $case_master->patient_address, 
            'patient_emailId' => $case_master->patient_emailId, 
            'patient_mobile' => $case_master->patient_mobile, 
            'male_female' => $case_master->male_female, 
            'complaint' => $case_master->complaint, 
            'diagnosis' => $case_master->diagnosis, 
            'treatment' => $case_master->treatment, 
            'diagnosis_file' => $case_master->diagnosis_filePath, 
            'appointment_dt' => ($case_master->FollowUpDate != null) ? Carbon::createFromFormat('Y-m-d', $case_master->FollowUpDate)->format('d/M/Y') : null, 
            'appointment_timeslot' => $case_master->FollowUpTimeSlot, 
            'FollowUpDoctor_id' => $case_master->FollowUpDoctor_Id, 
            'Reports_file' => $case_master->Report_file()->get(),
            'Before_file' => $case_master->BeforeImagePath, 
            'After_file' => $case_master->AfterImagePath, 
            'field_type_memory' => $field_type_memory, 
            'field_type_data' => $field_type_data
        ];
        return $casedata;
    }
    
    public function createCaseNumber()
    {
        $case_number_ge = new case_number_generators;
        $case_number_ge->save();
        $case_number_ge->case_number = "p_" . sprintf('%08d', $case_number_ge->id);
        $case_number_ge->save();
        return $case_number_ge;
    }
}

?>

