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
use App\entmedical_store;
use App\Models\ent_form_dropdowns;

class Case_mastersController extends AdminRootController
{
	public function __construct()
    {
        $this->acc=0;
        $this->commonHelper = new CommonHelper();
    }

    public function index(Request $request)
    {
        //echo "============>>>>>> <pre>".__LINE__; print_r([]); exit;
		
		$doctors = DB::table('doctors')->where('isActive', '1')->get();
        return view('case_masters.index', compact('doctors'));
    }

    public function avaibaletimeslotscasemaster($doctor_id, $appointment_dt, Request $request)
    {
        $mob = $request->input('mobile_no');
        $myDateTime = DateTime::createFromFormat('Y-m-d', $appointment_dt);
        $day = date('D', strtotime($appointment_dt));

        switch ($day)
        {
            case 'Mon':
                $day = 1;
            break;
            case 'Tue':
                $day = 2;
            break;
            case 'Wed':
                $day = 3;
            break;
            case 'Thu':
                $day = 4;
            break;
            case 'Fri':
                $day = 5;
            break;
            case 'Sat':
                $day = 6;
            break;
            case 'Sun':
                $day = 7;
            break;
            default:
                # code...
                
            break;
        }

        $timeslots = DB::select("SELECT * FROM `tbl_appoinment_slot` WHERE doctor_id='$doctor_id' AND day='$day'");

        $count1 = count($timeslots);

        if ($count1 == "0")
        {
            return "0";
        }
        else
        {
            //
            // }
            $avaibaletimeslot = DB::select("SELECT morningEvening FROM appointments WHERE doctor_id='$doctor_id' AND appointment_dt='$appointment_dt'");
            $count = count($avaibaletimeslot);

            if ($count == "0")
            {
                // return 0;
                foreach ($timeslots as $timeslotvalue)
                {
                    $timeslot1 = $timeslotvalue->starttime;
                    $slottime = $timeslotvalue->slotime;
                    $data['timeslot1'][] = $timeslot1;
                    $data['slottime'][] = $slottime;

                }

            }
            else
            {

                //
                foreach ($timeslots as $timeslotvalue)
                {

                    $timeslot1[] = $timeslotvalue->starttime;
                    $slottime[] = $timeslotvalue->slotime;

                }

                foreach ($avaibaletimeslot as $avaibaletimeslots1)
                { //return $avaibaletimeslot;
                    $avaitime = $avaibaletimeslots1->morningEvening;

                    if (in_array($avaitime, $timeslot1))
                    {
                        //return 0;
                        $key = array_search($avaitime, $timeslot1);
                        unset($timeslot1[$key]);
                        unset($slottime[$key]);

                    }

                }

                $data['timeslot1'] = array_values($timeslot1);
                $data['slottime'] = array_values($slottime);
            }

            return $data;
        }

    }

    public function create(Request $request)
    {
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')
            ->pluck('doctor_name', 'id');
        $timeslot = timeslot::where('isActive', 1)->orderBy('id')
            ->pluck('name', 'id');
        $medicinlist = Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)
            ->orderBy('created_dt', 'desc')
            ->get();

        $casedata = ['doctorlist' => $doctorlist, 'timeslot' => $timeslot, 'medicinlist' => $medicinlist, 'prescriptions' => [], //prescription_list::where('case_number', 'p_00000001')->get(),
        'case_number' => '', //'p_00000001'
        'DateWiseRecordLst' => [], 'field_type_memory' => field_type_memory::whereraw('1=2')->get() , 'field_type_data' => field_type_data::whereraw('1=2')
            ->get() ];
        return view('case_masters.add', ['casedata' => $casedata]);
    }

    public function ViewReport(Request $request)
    {
        //$doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
        return view('case_masters.patientReport', []);

    }

    public function patientdetailViewReport(Request $request)
    {
        //$doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
        $id = Auth::user()->id;

        /*
        $accesslevel = DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='patientDetails/patient/report'");

        foreach ($accesslevel as $value)
        {
            $acc = $value->accesslevel;
        }
        */


        if($this->commonHelper->checkUserAccess("2_patientDetails/patient/report",Auth::user()->id, 'listing_permission') || $this->commonHelper->checkUserAccess("2_patientDetails/patient/report",Auth::user()->id, 'add_permission') || AUTH::user()->role == 1) {

        //if ($acc == 1)
        //{
            return view('case_masters.patientReport', []);
        }
        else
        {
            $url = url()->previous();
            return redirect($url);
        }
    }

    public function ViewReportgrid(Request $request)
    {

        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = "SELECT a.id as `chkId`, a.id, a.case_number, uhid_no, DATE_FORMAT(a.created_at, \"%d %b %Y\"), DATE_FORMAT(a.FollowUpDate, \"%d %b %Y\"), e.doctor_name, a.patient_emailId, CONCAT(COALESCE(`mr_mrs_ms`,''), ' ', COALESCE(`patient_name`,''), ' ', COALESCE(`middle_name`,''), ' ', COALESCE(`last_name`,'')), patient_age, male_female, `patient_mobile`";
        $presql = " FROM case_master a
                    join (select max(id) as id from case_master where is_deleted = 0 group by case_number) b on a.id =b.id 
                    left join timeslots d on a.FollowUpDate = d.id
                    left join doctors c on a.FollowUpDoctor_Id = c.id
                    left join doctors e on a.doctor_id = e.id
                    ";
        //$presql .= " WHERE 1=1 and a.is_deleted = 0";
		$presql .= " WHERE a.patient_type='opd' and a.is_deleted = 0";

        if ($_POST['search']['value'])
        {
            //$presql .= " and patient_name LIKE '%" . $_POST['search']['value'] . "%' ";
            $presql .= " and (patient_name LIKE '%" . $_POST['search']['value'] . "%' OR middle_name LIKE '%" . $_POST['search']['value'] . "%' OR last_name LIKE '%" . $_POST['search']['value'] . "%')";

        }
        if ($_POST['columns'][1]['search']['value'])
        {
            $presql .= " and e.doctor_name LIKE '%" . $_POST['columns'][1]['search']['value'] . "%' ";
        }
        if ($_POST['columns'][2]['search']['value'])
        {
            //$fromDate = Carbon::createFromFormat('d/M/Y', $_POST['columns'][2]['search']['value'])->format('Y-m-d');
            $fromDate = $_POST['columns'][2]['search']['value'];
            $presql .= " and a.created_at >= '" . $fromDate . "' ";
        }
        if ($_POST['columns'][3]['search']['value'])
        {
            //$toDate = Carbon::createFromFormat('d/M/Y', $_POST['columns'][3]['search']['value'])->format('Y-m-d');
            $toDate = $_POST['columns'][3]['search']['value'];
            $presql .= " and a.created_at <= '" . $toDate . "' ";
        }
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

    public function fitnessCertificate(Request $request)
    {
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('case_masters.fitnessCertificate', ['logoUrl' => $logoUrl]);
    }

    public function createCaseNumber()
    {
        $case_number_ge = new case_number_generators;
        $case_number_ge->save();
        $case_number_ge->case_number = "p_" . sprintf('%08d', $case_number_ge->id);
        $case_number_ge->save();
        return $case_number_ge;
    }

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

    public function edit(Request $request, $id)
    {
        // return "jbg";
        return view('case_masters.add', ['casedata' => $this->getCaseData($id) ]);
    }

    public function show(Request $request, $id)
    {
        $user = Auth::user()->id;
		/*
        $accesslevel = DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='case_master/patientno_info'");

        foreach ($accesslevel as $value)
        {
            $this->acc = $value->accesslevel;
        }

        if ($this->acc == 1)
        {
			*/
		$this->acc = $this->commonHelper->checkUserAccess("2_case_masters",Auth::user()->id, 'view_permission');
        if ($this->acc == 1) {
            $case_master = Case_master::findOrFail($id);
            return view('case_masters.show', ['casedata' => $this->getCaseData($id) ]);
        }
        else
        {

            $url = url()->previous();
            return redirect($url);
        }

        // return view('case_masters.show', [
        //     'model' => $case_master     ]);
        
    }

    public function getMemoryDetials($id)
    {
        $field_type_memory = field_type_memory::find($id);
        return $field_type_memory;
    }

    public function grid(Request $request)
    {
        $len = $_POST['length'];
        $start = $_POST['start'];

        //$select = "SELECT a.id,  a.case_number, `patient_name`,  e.doctor_name,`patient_mobile`, a.patient_age , `patient_emailId`,`referedby`, e.doctor_name, DATE_FORMAT(a.updated_at, \"%d %b %Y\"), 1,2, DATE(a.updated_at)= DATE(NOW())";
        
        $url = url('/').'/uploads/';
        $select = "SELECT a.id, a.case_number, a.uhid_no, a.patient_priority, a.visit_time, CONCAT(COALESCE(`mr_mrs_ms`,''), ' ', COALESCE(`patient_name`,''), ' ', COALESCE(`middle_name`,''), ' ', COALESCE(`last_name`,'')), concat('<a target=\'_blank\' href=\'".$url."', a.patient_pic,'\'><img style=\'width:100px;\' src=\'".$url."', a.patient_pic,'\'></a>'), e.doctor_name,`patient_mobile`, a.patient_age , `patient_emailId`,`referedby`, e.doctor_name, DATE_FORMAT(a.updated_at, \"%d %b %Y\"), 1, CONCAT(a.case_type,' ', a.case_appointment_time), DATE(a.updated_at)= DATE(NOW())";
        
        $presql = " FROM case_master a
                    join (select max(id) as id from case_master where is_deleted = 0 group by case_number) b on a.id =b.id 
                    left join timeslots d on a.FollowUpDate = d.id
                    left join doctors c on a.FollowUpDoctor_Id = c.id
                    left join doctors e on a.doctor_id = e.id 
                    ";
        //$presql .= " WHERE 1=1 and a.is_deleted = 0";
		
		if(isset($request->list_type) && $request->list_type == "ipd") {
			//$presql .= " WHERE a.patient_type='ipd' and a.is_deleted = 0";
                    $presql .= " WHERE a.is_ipd='1' and a.is_deleted = 0";
		} else {
			$presql .= " WHERE a.patient_type='opd' and a.is_deleted = 0";
		}
		
		//=======================================================
		//$from_date = date("Y-m-d");
		//$to_date = date("Y-m-d");
		
		$from_date = "";
		$to_date = "";
		
		if((!empty($_POST['columns'][9]['search']['value']) &&  $_POST['columns'][9]['search']['value'] != ""))
        {
            $from_date = date("Y-m-d", strtotime($_POST['columns'][9]['search']['value']));
        }
		
		
		if((!empty($_POST['columns'][10]['search']['value']) &&  $_POST['columns'][9]['search']['value'] != "")) {
            $to_date = date("Y-m-d", strtotime($_POST['columns'][10]['search']['value']));
        }
		
		 if($from_date == "" && $to_date == "" && $_POST['columns'][1]['search']['value'] == "" && $_POST['columns'][2]['search']['value'] == "" && $_POST['columns'][3]['search']['value'] == "" ) {
			 $from_date = date("Y-m-d");
			 $to_date = date("Y-m-d");
		}

		if($from_date != "" && $to_date != "") {
			 $presql .= " and date(a.updated_at) BETWEEN '".$from_date."' AND  '".$to_date."'";
		} else if($from_date != "" ) {
			 $presql .= " and date(a.updated_at) >= '".$from_date."' ";
		} else if($to_date != "") {
			 $presql .= " and date(a.updated_at) <= '".$to_date."'";
		}
		//=======================================================
		
        
        if((!empty($_POST['columns'][8]['search']['value']) &&  $_POST['columns'][8]['search']['value'] == "today") || $_POST['draw'] == 1)
        {
            $presql .= " and date(a.updated_at) = '".date("Y-m-d")."' ";
        }
        if ($_POST['search']['value'])
        {
            $presql .= " and (patient_name LIKE '%" . $_POST['search']['value'] . "%' OR middle_name LIKE '%" . $_POST['search']['value'] . "%' OR last_name LIKE '%" . $_POST['search']['value'] . "%')";
        }
        if ($_POST['columns'][1]['search']['value'])
        {
            $presql .= " and a.case_number LIKE '%" . $_POST['columns'][1]['search']['value'] . "%' ";
        }
        if ($_POST['columns'][2]['search']['value'])
        {
            //$presql .= " and e.doctor_name LIKE '%" . $_POST['columns'][2]['search']['value'] . "%' ";
            $presql .= " and e.id = '" . $_POST['columns'][2]['search']['value'] . "' ";
        }
        if ($_POST['columns'][3]['search']['value'])
        {
            //$presql .= " and patient_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' ";
            
            $presql .= " and (patient_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' OR middle_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' OR last_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%')";
        }
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
    
    
    

    public function store(Request $request)
    {
        
        
        $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
        if (is_null($case_gen))
        {
            $case_gen = $this->createCaseNumber();
        }
        if (Input::get('submit'))
        {
            $this->submitCase($request, $case_gen);
        }
        if (Input::get('submitMsg'))
        {
            $case_master = $this->submitCase($request, $case_gen);
            if (!empty($case_master) && !empty($request->patient_mobile))
            {
                $client = new HttpGuzzle;
                $smsStr = 'Welcome ' . (empty($request->patient_name) ? "" : $request->patient_name) . ' /n your case number is :' . $case_master->case_number . ' /n ' . env('SMS_From_Name');
                $urlGet = str_replace(array(
                    'xxxxcommaSeperatedxxxx',
                    'xxxxSMSTextxxxx'
                ) , array(
                    $request->patient_mobile,
                    $smsStr
                ) , env('SMS_URL'));
                $res = $client->request('GET', $urlGet);
            }
        }
        if (Input::get('drAddToMemory'))
        {
            if (empty($request->id))
            {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors('Patient Not created');
            }
            if (empty($request->field_type_id) || empty($request->title))
            {
                return redirect()
                    ->back()
                    ->withInput();
            }
            $field_type_id = $this->getFieldTypeIdFromName($request->field_type_id);
            $field_memory = field_type_memory::find($request->memory_id);
            if ($field_memory == null || empty($field_memory))
            {
                $field_memory = new field_type_memory;
            }
            $field_memory->field_type_id = $field_type_id;
            $field_memory->title = $request->title;
            $field_memory->data = $request->memory_data;
            $field_memory->save();
            $allInput = Input::all();
            $allInput['memory_id'] = '';
            Input::replace($allInput);
            return redirect()->back()
                ->withInput()
                ->with('field_type_memory', field_type_memory::get());
        }
        if (Input::get('mem_delete'))
        {
            field_type_memory::find($request->memory_id)
                ->delete();
            return redirect()
                ->back()
                ->withInput()
                ->with('field_type_memory', field_type_memory::get())
                ->with('memory_id', '');
        }
        if (Input::get('Add_complaint') || Input::get('Add_Diagnosis') || Input::get('Add_Treatment'))
        {
            if (empty($request->id))
            {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors('Patient Not created');
            }
            $field_type_id = $this->getFieldTypeIdFromName($request->field_type_id);
            if (($field_type_id == 1 && empty($request->complaint)) || ($field_type_id == 2 && empty($request->Diagnosis)) || ($field_type_id == 3 && empty($request->Treatment)))
            {
                return redirect()
                    ->back()
                    ->withInput();
            }

            $field_type_data = new field_type_data;
            $field_type_data->field_type_id = $field_type_id;
            $field_type_data->case_id = $request->id;
            if ($field_type_id == 1)
            {
                $field_type_data->field_data = $request->complaint;
            }
            if ($field_type_id == 2)
            {
                $field_type_data->field_data = $request->Diagnosis;
            }
            if ($field_type_id == 3)
            {
                $field_type_data->field_data = $request->Treatment;
            }
            $field_type_data->save();
            $fieldtypeId = field_type_data::where('case_id', $request->id)
                ->get();
            return redirect()
                ->back()
                ->withInput()
                ->with('field_type_data', field_type_data::where('case_id', $request->id)
                ->get());
        }

        return redirect('/case_masters')
            ->withInput()
            ->with('flash_message', 'Record Added Successfully');
        //return $this->update($request);
        
    }

    public function getFieldTypeIdFromName($fieldName)
    {
        $field_type_id;
        switch ($fieldName)
        {
            case "#Complaints":
                $field_type_id = 1;
            break;
            case "#Diagnosis":
                $field_type_id = 2;
            break;
            case "#Treatment":
                $field_type_id = 3;
            break;
            default:
                $field_type_id = 1;
            break;
        }
        return $field_type_id;
    }

    public function printPatientDetails($id)
    {
        $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
        return view('case_masters.print', ['casedata' => $this->getCaseData($id) , 'logoUrl' => $image_gallery->imgUrl]);
    }

    public function update_prescription(Request $request) {
        
        //echo "======>>>>>> <pre>"; print_r($_POST); exit;
        
        
        if($request->prescription_notes) {
            
            $case_id = $request->id;
              $prescription_notes = DB::table('psychiatrist_notes')->where('is_deleted', '0')->where('case_id', $case_id)->where('type', 'prescription_notes')->first();
              
              
              $insert_data = ['type' => 'prescription_notes', 'case_id' => $case_id, 'notes' => $request->prescription_notes];
              
              if($prescription_notes) {
                    DB::table('psychiatrist_notes')->where('id', $prescription_notes->id)->update($insert_data); 
              } else {
                    DB::table('psychiatrist_notes')->insert($insert_data); 
              }
          }
          
          //echo "======>>>>>> <pre>"; print_r($_POST); exit;
          
        $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
        if (is_null($case_gen))
        {
            return redirect()->back()
                ->withInput()
                ->withErrors(array(
                'message' => 'No patient found.'
            ));
        }
        //check which submit was clicked on
		if (Input::get('save_note'))
			{
				DB::table('prescription_lists')->where('case_number', $case_gen->case_number)->update(['notes' => $request->notes]);
				
				return redirect()->back()->with('flash_message', 'notes added successfully');
			}
		
        if (Input::get('prescription_save'))
        {
            //return $this->save_prescription($request, $case_gen); //if login then use this method
            
            if($request->prescription_type == 'template') {
                $this->save_multiple_prescription($request, $case_gen); //if login then use this method
                
                
            } else {
                return $this->save_prescription($request, $case_gen); //if login then use this method
            }
            
            return redirect()->back()->with('flash_message', 'Record added successfully');
        }
        //echo "======>>>>>> <pre>".__LINE__; print_r($_POST); exit;
        if (Input::get('prescription_delete'))
        {

            return $this->deletePrescription($request, $case_gen); //if register then use this method
            
        }
        //Send Prescription Summary Via Email
        if (Input::get('sendemailpres'))
        {
            return $this->save_prescription_send($request, $case_gen); //if login then use this method
            
        }
        if (Input::get('submiitemailpres'))
        {
            //return $this->save_prescription_submit($request, $case_gen); //if login then use this method
            
            if($request->prescription_type == 'template') {
                $this->save_multiple_prescription($request, $case_gen); //if login then use this method
                
                $getdata = $this->getCaseData($request->id);
                /*
                $presDropdowns = ['numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')
                    ->pluck('ddText', 'ddText') , 'quantity' => form_dropdowns::where('formName', 'Prescription')
                    ->where('fieldName', 'Quantity')
                    ->pluck('ddText', 'ddText') , 'medicine_strength' => form_dropdowns::where('formName', 'Prescription')
                    ->where('fieldName', 'Strength')
                    ->pluck('ddText', 'ddText') ];
                */
                 $presDropdowns = [
'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText') 
        ];
                 
                $msg = config('app.name', 'Laravel');
                $doctorlst = DB::table('doctors')->select('doctor_name')
                    ->where('id', '=', $request->doctor_id)
                    ->first();
                $doctor_name = $doctorlst->doctor_name;
                $mergeArray = array_merge($getdata, $presDropdowns);
                $mailTemplate = 'case_masters.FormEmailPrescription';
                $helperCls = new drAppHelper();
                $logoUrl = $helperCls->GetLetterHeadImageUrl();
                Mail::to($request->patient_emailId)
                    ->send(new casePaperMail(['casedata' => $mergeArray, 'msg' => $msg, 'doctor_name' => $doctor_name], $mailTemplate));

                $request['prescriptions'] = prescription_list::where('case_id', $request->id)
                    ->get();
                
                return redirect()->back()->with('flash_message', 'Email has been sent to ' . $request->patient_emailId);
            } else {
                return $this->save_prescription_submit($request, $case_gen);
            }
            
        }
        if (Input::get('prescription_msg'))
        {
            $preLst = prescription_list::where('case_id', $request['prescription_msg'])->get();
            if ($preLst->isEmpty())
            {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors('Prescription list empty!');
            }
            $MedicalStoreNumber = Staff_user::where('staff_type_id', 4)->get();
            $caseMaster = Case_master::findOrFail($request['prescription_msg']);
            $MedicineLst = '';
            foreach ($preLst as $pre)
            {
                $MedicineLst = $MedicineLst . $pre
                    ->Medical_store->medicine_name . ' -- ' . $pre->strength . ' %0a ';
            }
            //$MedicineLst = rtrim($MedicineLst,' %0a ');
            //$MedicineLst = rtrim(implode('%0a', $preLst->Medical_store->medicine_name . ' -- ' . $preLst->strength), '%0a');
            //$MedicalStoreNumber->pluck('mobile_no')->toArray();
            $MobileNoLst = rtrim(implode(',', $MedicalStoreNumber->pluck('mobile_no')
                ->toArray()) , ',');

            if (!empty($caseMaster->patient_mobile))
            {
                $MobileNoLst = $MobileNoLst . ',' . $caseMaster->patient_mobile;
            }

            $client = new HttpGuzzle;
            $smsStr = 'Prescription List for Patient ' . (empty($request->patient_name) ? "" : $request->patient_name) . ' %0a case number :' . $request->case_number . ' %0a ' . $MedicineLst . env('SMS_From_Name');
            $urlGet = str_replace(array(
                'xxxxcommaSeperatedxxxx',
                'xxxxSMSTextxxxx'
            ) , array(
                $MobileNoLst,
                $smsStr
            ) , env('SMS_URL'));
            $res = $client->request('GET', $urlGet);

            return redirect()->back()
                ->withInput()
                ->with('flash_message', 'Message send successfully');
        }
    }

    public function submitCase(Request $request, case_number_generators $case_gen)
    {
        $isEdit = true;
        $case_master = null;
        $case_master = Case_master::where('case_number', $case_gen->case_number)
            ->whereDate('created_at', Carbon::today()
            ->toDateString())
            ->first();
        if ($case_master === null)
        {
            $case_master = new Case_master;
            $isEdit = false;
        }
        $case_master->id = $case_master->id ? : 0;
        $case_master->patient_name = $request->patient_name;
        $case_master->patient_age = $request->patient_age;
        $case_master->patient_address = $request->patient_address;
        $case_master->patient_emailId = $request->patient_emailId;
        $case_master->patient_mobile = $request->patient_mobile;
        $case_master->male_female = $request->male_female;
        $case_master->complaint = $request->complaint;
        $case_master->diagnosis = $request->diagnosis;
        $case_master->case_number = $case_gen->case_number;
        $case_master->FollowUpDate = $request->appointment_dt;

        $case_master->FollowUpTimeSlot = $request->FollowUpTimeSlot;
        $case_master->FollowUpDoctor_Id = $request->FollowUpDoctor_id;
        $case_master->treatment = $request->treatment;
        $case_master->patient_weight = $request->patient_weight;
        $case_master->patient_height = $request->patient_height;
        $case_master->doctor_id = $request->FollowUpDoctor_id;

        if ($request->hasFile('diagnosis_file'))
        {
            $case_master->diagnosis_filePath = $request->file('diagnosis_file')
                ->store('uploads');
        }
        if ($request->hasFile('Reports_file'))
        {
            $case_master->ReportfilePath = $request->file('Reports_file')
                ->store('uploads');
        }
        if ($request->hasFile('Before_file'))
        {
            $case_master->BeforeImagePath = $request->file('Before_file')
                ->store('uploads');
        }
        if ($request->hasFile('After_file'))
        {
            $case_master->AfterImagePath = $request->file('After_file')
                ->store('uploads');
        }
        $case_master->save();

        $doctor_id = $request->FollowUpDoctor_id;
        $patient_name = $request->patient_name;
        $patient_mobile = $request->patient_mobile;
        $patient_emailId = $request->patient_emailId;
        $FollowUpDate = $request->appointment_dt;
        $FollowUpTimeSlot = $request->FollowUpTimeSlot;

        $sql = DB::insert("INSERT INTO `appointments`(`doctor_id`, `name`, `mobile_no`, `email`, `appointment_dt`, `morningEvening`) VALUES ('$doctor_id','$patient_name','$patient_mobile','$patient_emailId','$FollowUpDate','$FollowUpTimeSlot')");
        if ($sql)
        {
            return $case_master;
        }

    }

    public function edit_prescription($id)
    {
        $templates = DB::table('prescription_templates')->where('parent', 0)->get();
        
        $user = Auth::user()->id;
		/*
        $accesslevel = DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='AddEdit/prescription'");

        foreach ($accesslevel as $value)
        {
            $this->acc = $value->accesslevel;
        }

        if ($this->acc == 1)
        {	*/
		$this->acc = $this->commonHelper->checkUserAccess("2_case_masters/prescriptionlst",Auth::user()->id, 'add_permission');
        if ($this->acc == 1) {
            $getdata = $this->getCaseData($id);
            
            //dd($getdata);
            /*
            $presDropdowns = ['numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')
                ->pluck('ddText', 'ddText') , 'quantity' => form_dropdowns::where('formName', 'Prescription')
                ->where('fieldName', 'Quantity')
                ->pluck('ddText', 'ddText') , 'medicine_strength' => form_dropdowns::where('formName', 'Prescription')
                ->where('fieldName', 'Strength')
                ->pluck('ddText', 'ddText') ];
            */
             $presDropdowns = [
'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText'), 
'no_of_days' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'no_of_days')->pluck('ddText', 'ddText') 
        ];
             
             //dd($getdata['prescriptions']);
             
             foreach($getdata['prescriptions'] as $key => $val) {
                 $generic_medicine = DB::table('medical_store')->where('id',$val->generic_medicine_id)->first();
                 
                 $getdata['prescriptions'][$key]->generic_name = ($generic_medicine) ? $generic_medicine->generic_name: '';
             }
             
             //dd($getdata['prescriptions']);
             
             //dd($getdata);
             
            $mergeArray = array_merge($getdata, $presDropdowns);
            
            $prescription_data_array = DB::table('prescription_data')->where('case_id', $id)->orderBy('prescription_id')->get();
            
            $prescription_data = [];
            foreach($prescription_data_array as $prescription_data_row) {
                $prescription_data[$prescription_data_row->prescription_id][] = $prescription_data_row;
            }
			
			$prscription_notes_data = DB::table('prescription_lists')->where('case_number', $getdata['case_number'])->first();
			
			$prscription_notes = ($prscription_notes_data) ? $prscription_notes_data->notes : '';
            
            //dd($prescription_data);
            //dd($mergeArray);
            return view('case_masters.add_prescription', ['casedata' => $mergeArray, 'templates' => $templates, 'form_dropdowns', 'prescription_data' => $prescription_data, 'prscription_notes' => $prscription_notes]);
        }

        else
        {

            $url = url()->previous();
            return redirect($url);
        }

    }
    public function get_prescription_template(Request $request) {
        $user = Auth::user()->id;
        
        $templates = DB::table('prescription_templates')->where('id', $request->id)->orWhere('parent', $request->id)->get();
        
        $all_templates = DB::table('prescription_templates')->where('parent', 0)->get();
        /*
        $presDropdowns = ['numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')
            ->pluck('ddText', 'ddText') , 'quantity' => form_dropdowns::where('formName', 'Prescription')
            ->where('fieldName', 'Quantity')
            ->pluck('ddText', 'ddText') , 'medicine_strength' => form_dropdowns::where('formName', 'Prescription')
            ->where('fieldName', 'Strength')
            ->pluck('ddText', 'ddText') ];
        */
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
            ->orderBy('created_dt', 'desc');
            //->get();
//dd($mergeArray);
        $mergeArray = array_merge($presDropdowns, ['doctorlist' => $doctorlist, 'timeslot' => $timeslot, 'medicinlist' => $medicinlist]);
        //dd($mergeArray);
            return view('case_masters.add_prescription_templates_row', ['casedata' => $mergeArray, 'templates' => $templates, 'all_templates' => $all_templates, 'template_id' => $request->id]);    
    }
    public function add_prescription_templates($case_id = "") {
        $user = Auth::user()->id;

        $templates = DB::table('prescription_templates')->where('parent', 0)->get();

        //dd($templates);
        //$getdata = $this->getCaseData($id);
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
        return view('case_masters.add_prescription_templates', ['casedata' => $mergeArray, 'templates' => $templates, 'case_id' => $case_id]);
    }
	
	//===============================================================================================
	
	//public function update_finding_templates(Request $request) {
	public function update_finding_templates(Request $request, $template_id = "", $case_id = "") {
        //echo "===========>>>>>>>> <pre>".$template_id; print_r($_POST); exit;
        
        DB::table('finding_template')->where('id', $request->template_id)->delete();
        
        DB::table('finding_template_data')->where('template_id', $request->template_id)->delete();
        
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
    
    public function update_prescription_templates(Request $request) {
        if($request->id) {
            //$template = DB::table('prescription_templates')->where('id', $request->id)->orWhere('parent', $request->id)->delete();
        }
        
        //echo "==========1111111111=>>>>>>>> <pre>"; print_r($_POST); exit;
        
        $parent = 0;
        foreach($request->medicine_id as $key => $medicine) {
            $frequency_data = [];
            foreach($request->numberoftimes[$key] as $frequency_key => $frequency_row) {
                $frequency_data[] = array(
                    'frequency' => $frequency_row,
                    'from' => $request->from[$key][$frequency_key],
                    'to' => $request->to[$key][$frequency_key]
                );
            }
            
            $insert_data = [
                'template_name' => $request->template_name,
                'medicine_id' => $medicine,
                //'frequency' => $request->frequency[$key],
                'frequency' => json_encode($frequency_data),
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
        
        if($request->id) {
            return redirect('psychiatrist-prescription-templates-listing/'.$request->case_id)->with('flash_message', 'Template Updated Successully.');
             
        }
        if($request->case_id) {
            return redirect('AddEdit/prescription/'.$request->case_id)
                //->withInput()
                ->with('flash_message', 'Template added Successully.');
        } else {
            return redirect()->back()
                //->withInput()
                ->with('flash_message', 'Template added Successully.');
        }
    }

    //////////////////////////////////////////////////
    public function prescriptionlstother(Request $request)
    {
        return view('case_masters.prescriptionlstother', ['patientlist']);
    }

    public function edit_prescriptionother($id)
    {

        $user = Auth::user()->id;
		/*
        $accesslevel = DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='AddEdit/prescription'");

        foreach ($accesslevel as $value)
        {
            $this->acc = $value->accesslevel;
        }

        if ($this->acc == 1)
        {
				*/
		$this->acc = $this->commonHelper->checkUserAccess("2_case_masters",Auth::user()->id, 'edit_permission');
        if ($this->acc == 1) {
            $getdata = $this->getCaseData($id);
            /*
            $presDropdowns = ['numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')
                ->pluck('ddText', 'ddText') , 'quantity' => form_dropdowns::where('formName', 'Prescription')
                ->where('fieldName', 'Quantity')
                ->pluck('ddText', 'ddText') , 'medicine_strength' => form_dropdowns::where('formName', 'Prescription')
                ->where('fieldName', 'Strength')
                ->pluck('ddText', 'ddText') ];
            */
             $presDropdowns = [
'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText') 
        ];
             
            $mergeArray = array_merge($getdata, $presDropdowns);
            return view('case_masters.add_prescriptionother', ['casedata' => $mergeArray]);
        }

        else
        {

            $url = url()->previous();
            return redirect($url);
        }

    }

    public function update_prescriptionother(Request $request)
    {
        
        
        $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
        if (is_null($case_gen))
        {
            return redirect()->back()
                ->withInput()
                ->withErrors(array(
                'message' => 'No patient found.'
            ));
        }
        //check which submit was clicked on
        if (Input::get('prescription_save'))
        {
            return $this->save_prescription($request, $case_gen); //if login then use this method
            
        }
        if (Input::get('prescription_delete'))
        {
            return $this->deletePrescription($request, $case_gen); //if register then use this method
            
        }
        if (Input::get('prescription_msg'))
        {
            $preLst = prescription_list::where('case_id', $request['prescription_msg'])->get();
            if ($preLst->isEmpty())
            {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors('Prescription list empty!');
            }
            $MedicalStoreNumber = Staff_user::where('staff_type_id', 4)->get();
            $caseMaster = Case_master::findOrFail($request['prescription_msg']);
            $MedicineLst = '';
            foreach ($preLst as $pre)
            {
                $MedicineLst = $MedicineLst . $pre
                    ->Medical_store->medicine_name . ' -- ' . $pre->strength . ' %0a ';
            }
            //$MedicineLst = rtrim($MedicineLst,' %0a ');
            //$MedicineLst = rtrim(implode('%0a', $preLst->Medical_store->medicine_name . ' -- ' . $preLst->strength), '%0a');
            //$MedicalStoreNumber->pluck('mobile_no')->toArray();
            $MobileNoLst = rtrim(implode(',', $MedicalStoreNumber->pluck('mobile_no')
                ->toArray()) , ',');

            if (!empty($caseMaster->patient_mobile))
            {
                $MobileNoLst = $MobileNoLst . ',' . $caseMaster->patient_mobile;
            }

            $client = new HttpGuzzle;
            $smsStr = 'Prescription List for Patient ' . (empty($request->patient_name) ? "" : $request->patient_name) . ' %0a case number :' . $request->case_number . ' %0a ' . $MedicineLst . env('SMS_From_Name');
            $urlGet = str_replace(array(
                'xxxxcommaSeperatedxxxx',
                'xxxxSMSTextxxxx'
            ) , array(
                $MobileNoLst,
                $smsStr
            ) , env('SMS_URL'));
            $res = $client->request('GET', $urlGet);

            return redirect()->back()
                ->withInput()
                ->with('flash_message', 'Message send successfully');
        }
    }

    public function printprescriptionother($id)
    {
        //$image_gallery = Image_gallery::where('imgTypeId', 4)->first();
        $user = Auth::user()->id;
		/*
        $accesslevel = DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='print/prescription'");

        foreach ($accesslevel as $value)
        {
            $this->acc = $value->accesslevel;
        }

        if ($this->acc == 1)
        {
				*/
		$this->acc = $this->commonHelper->checkUserAccess("2_case_masters",Auth::user()->id, 'view_permission');
        if ($this->acc == 1) {
            $helperCls = new drAppHelper();
            $logoUrl = $helperCls->GetLetterHeadImageUrl();
            
            return view('case_masters.print_prescriptionother', ['casedata' => $this->getCaseData($id) , 'logoUrl' => $logoUrl]);
        }

        else
        {

            $url = url()->previous();
            return redirect($url);
        }

    }

    // SAVE Prescription using Email To other
    public function save_prescription_send(Request $request, case_number_generators $case_gen)
    {
        try
        {
            $request['case_number'] = $case_gen->case_number;
            $request['prescriptions'] = prescription_list::where('case_id', $request->id)
                ->get();
            $case_master = Case_master::where('case_number', $case_gen->case_number)
                ->first();
            if ($request->email && !empty($request->email))
            {
                $this->validate($request, ['email' => 'required|email'

                ]);

                $getdata = $this->getCaseData($request->id);
                /*
                $presDropdowns = ['numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')
                    ->pluck('ddText', 'ddText') , 'quantity' => form_dropdowns::where('formName', 'Prescription')
                    ->where('fieldName', 'Quantity')
                    ->pluck('ddText', 'ddText') , 'medicine_strength' => form_dropdowns::where('formName', 'Prescription')
                    ->where('fieldName', 'Strength')
                    ->pluck('ddText', 'ddText') ];
                */
                 $presDropdowns = [
'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText') 
        ];
                $msg = config('app.name', 'Laravel');
                $doctorlst = DB::table('doctors')->select('doctor_name')
                    ->where('id', '=', $request->doctor_id)
                    ->first();
                $doctor_name = $doctorlst->doctor_name;
                $mergeArray = array_merge($getdata, $presDropdowns);
                //return $mergeArray['prescriptions'];
                $mailTemplate = 'case_masters.FormEmailPrescription';
                $helperCls = new drAppHelper();
                $logoUrl = $helperCls->GetLetterHeadImageUrl();
                if (count($mergeArray['prescriptions']) > 0)
                {

                    Mail::to($request->email)
                        ->send(new casePaperMail(['casedata' => $mergeArray, 'msg' => $msg, 'doctor_name' => $doctor_name], $mailTemplate));
                }
                else
                {
                    $validator = Validator::make($request->all() , ['medicine_id' => 'required',
                    //'medicine_quantity' => 'required|numeric',
                    ]);

                    if ($validator->fails())
                    {
                        return redirect()
                            ->back()
                            ->withErrors($validator)->withInput();
                    }

                    $medicalStore = Medical_store::find($request['medicine_id']);
                    $preslist = new prescription_list;
                    $preslist->case_number = $case_gen->case_number;
                    $preslist->medicine_id = $request['medicine_id'];
                    $preslist->medicine_Quntity = empty($request['medicine_quantity']) ? 0 : $request['medicine_quantity'];
                    $preslist->numberoftimes = $request['numberoftimes'];
                    $preslist->strength = $request['strength'];
                    $preslist->per_unit_cost = $medicalStore->unit_price;
                    $preslist->case_id = $request->id;
                    $preslist->no_of_days = $request->no_of_days;

                    $preslist->save();
                    $getdata = $this->getCaseData($request->id);
                    /*
                    $presDropdowns = ['numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')
                        ->pluck('ddText', 'ddText') , 'quantity' => form_dropdowns::where('formName', 'Prescription')
                        ->where('fieldName', 'Quantity')
                        ->pluck('ddText', 'ddText') , 'medicine_strength' => form_dropdowns::where('formName', 'Prescription')
                        ->where('fieldName', 'Strength')
                        ->pluck('ddText', 'ddText') ];
                    */
                     $presDropdowns = [
'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText') 
        ];
                     
                    $msg = config('app.name', 'Laravel');
                    $doctorlst = DB::table('doctors')->select('doctor_name')
                        ->where('id', '=', $request->doctor_id)
                        ->first();
                    $doctor_name = $doctorlst->doctor_name;
                    $mergeArray = array_merge($getdata, $presDropdowns);
                    //return $mergeArray['prescriptions'];
                    $mailTemplate = 'case_masters.FormEmailPrescription';
                    $helperCls = new drAppHelper();
                    $logoUrl = $helperCls->GetLetterHeadImageUrl();
                    //  return $mergeArray['prescriptions'];
                    Mail::to($request->email)
                        ->send(new casePaperMail(['casedata' => $mergeArray, 'msg' => $msg, 'doctor_name' => $doctor_name], $mailTemplate));
                }

                $request['prescriptions'] = prescription_list::where('case_id', $request->id)
                    ->get();
            }

        }
        catch(Execption $e)
        {
            //throw $e;
            
        }

        return redirect()->back()
            ->with('flash_message', 'Email has been sent to ' . $request->email);
        //return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
        
    }

    // SAVE Prescription using submit & Mail Button
    public function save_prescription_submit(Request $request, case_number_generators $case_gen)
    {
        try
        {
            $request['case_number'] = $case_gen->case_number;
            $request['prescriptions'] = prescription_list::where('case_id', $request->id)
                ->get();
            $case_master = Case_master::where('case_number', $case_gen->case_number)
                ->first();
            if ($request->patient_emailId && !empty($request->patient_emailId))
            {
                $this->validate($request, ['patient_emailId' => 'required|email'

                ]);

                $validator = Validator::make($request->all() , ['medicine_id' => 'required',
                //'medicine_quantity' => 'required|numeric',
                ]);

                if ($validator->fails())
                {
                    return redirect()
                        ->back()
                        ->withErrors($validator)->withInput();
                }

                $medicalStore = Medical_store::find($request['medicine_id']);
                $preslist = new prescription_list;
                $preslist->case_number = $case_gen->case_number;
                $preslist->medicine_id = $request['medicine_id'];
                $preslist->medicine_Quntity = empty($request['medicine_quantity']) ? 0 : $request['medicine_quantity'];
                $preslist->numberoftimes = $request['numberoftimes'];
                $preslist->strength = $request['strength'];
                $preslist->per_unit_cost = $medicalStore->unit_price;
                $preslist->case_id = $request->id;
                $preslist->no_of_days = $request->no_of_days;

                $preslist->save();
                
                $getdata = $this->getCaseData($request->id);
                /*
                $presDropdowns = ['numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')
                    ->pluck('ddText', 'ddText') , 'quantity' => form_dropdowns::where('formName', 'Prescription')
                    ->where('fieldName', 'Quantity')
                    ->pluck('ddText', 'ddText') , 'medicine_strength' => form_dropdowns::where('formName', 'Prescription')
                    ->where('fieldName', 'Strength')
                    ->pluck('ddText', 'ddText') ];
                */
                 $presDropdowns = [
'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText') 
        ];
                 
                $msg = config('app.name', 'Laravel');
                $doctorlst = DB::table('doctors')->select('doctor_name')
                    ->where('id', '=', $request->doctor_id)
                    ->first();
                $doctor_name = $doctorlst->doctor_name;
                $mergeArray = array_merge($getdata, $presDropdowns);
                $mailTemplate = 'case_masters.FormEmailPrescription';
                $helperCls = new drAppHelper();
                $logoUrl = $helperCls->GetLetterHeadImageUrl();
                Mail::to($request->patient_emailId)
                    ->send(new casePaperMail(['casedata' => $mergeArray, 'msg' => $msg, 'doctor_name' => $doctor_name], $mailTemplate));

                $request['prescriptions'] = prescription_list::where('case_id', $request->id)
                    ->get();
            }

        }
        catch(Execption $e)
        {
            //throw $e;
            
        }

        return redirect()->back()
            ->with('flash_message', 'Email has been sent to ' . $request->patient_emailId);
        //return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
        
    }
    
    public function save_multiple_prescription(Request $request, case_number_generators $case_gen) {
        //echo "==========>>>>> <pre>"; print_r($_POST); exit;
        $request['case_number'] = $case_gen->case_number;
        
        $case_master = Case_master::where('case_number', $case_gen->case_number)
            ->first();
        foreach($request['template_medicine_id'] as $key => $request_row) {
            $medicalStore = Medical_store::find($request_row);

            $preslist = new prescription_list;
            $preslist->case_number = $case_gen->case_number;
            $preslist->medicine_id = $request_row;
            $preslist->generic_medicine_id = $request['generic_template_medicine_id'][$key];
            $preslist->medicine_timing = $request['template_medicine_timing'][$key];
            $preslist->medicine_Quntity = empty($request['template_medicine_quantity'][$key]) ? 0 : $request['template_medicine_quantity'][$key];
            //$preslist->numberoftimes = $request['template_numberoftimes'][$key];
            $preslist->strength = $request['template_strength'][$key];
            $preslist->per_unit_cost = $medicalStore->unit_price;
            $preslist->case_id = $request->id;
            //$preslist->no_of_days = $request->template_no_of_days[$key];
            $preslist->no_of_days = empty($request['template_medicine_quantity'][$key]) ? 0 : $request['template_medicine_quantity'][$key];
            //$preslist->from_date = $request->template_from[$key];
            //$preslist->to_date = $request->template_to[$key];

            $preslist->save();
            
            $this->update_multiple_prescription_data($request, $preslist->id, $key);
        }
        return true;
    }
    
    public function update_multiple_prescription_data($request, $prescription_id, $template_key) {
        $request['prescriptions'] = prescription_list::where('case_id', $request->id)->get();
        
        if(count($request->numberoftimes[$template_key]) > 0) {
            foreach($request->numberoftimes[$template_key] as $key => $frequency_row) {
                $data = array(
                    'prescription_id' => $prescription_id,
                    'case_id'   => $request->id,
                    'frequency' => $frequency_row,
                    'date_from' => $request->from[$template_key][$key],
                    'date_to'   => $request->to[$template_key][$key]
                );

                DB::table('prescription_data')->insert($data);
            }
        }
    }

    ///////////////////////////////////////////////////
    public function save_prescription(Request $request, case_number_generators $case_gen)
    {
        //echo "==========>>>>> <pre>"; print_r($_POST); exit;
        try {
            $request['case_number'] = $case_gen->case_number;
            $request['prescriptions'] = prescription_list::where('case_id', $request->id)
                ->get();
            $case_master = Case_master::where('case_number', $case_gen->case_number)
                ->first();
            $validator = Validator::make($request->all() , ['medicine_id' => 'required',
            //'medicine_quantity' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)->withInput();
            }
            
            $medicalStore = Medical_store::find($request['medicine_id']);

            $preslist = new prescription_list;
            $preslist->case_number = $case_gen->case_number;
            $preslist->medicine_id = $request['medicine_id'];
            $preslist->generic_medicine_id = $request['generic_medicine_id'];
            $preslist->medicine_Quntity = empty($request['medicine_quantity']) ? 0 : $request['medicine_quantity'];
            //$preslist->numberoftimes = $request['numberoftimes'];
            $preslist->strength = $request['strength'];
            $preslist->per_unit_cost = $medicalStore->unit_price;
            $preslist->case_id = $request->id;
            //$preslist->no_of_days = $request->no_of_days;
            $preslist->no_of_days = empty($request['medicine_quantity']) ? 0 : $request['medicine_quantity'];
            //$preslist->from_date = $request->from;
            //$preslist->to_date = $request->to;
            $preslist->medicine_timing = $request->medicine_timing;
            //update medical store balance only if case exists
            /*if ($case_master !== null) {
                $preslist->Medical_store->balance_quantity -= intval($request['medicine_quantity']);
                $preslist->Medical_store->save();
            }*/

            $preslist->save();

            $this->update_prescription_data($request, $preslist->id);
            
        }
        catch(Execption $e)
        {
            //throw $e;
            
        }
        //dd($request);
        return redirect()->back()
            ->withInput()
            ->with('flash_message', 'Record added successfully');
        //return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
        
    }
    
    public function update_prescription_data($request, $prescription_id) {
        $request['prescriptions'] = prescription_list::where('case_id', $request->id)->get();
        
        if(count($request->numberoftimes) > 0) {
            foreach($request->numberoftimes as $key => $frequency_row) {
                $data = array(
                    'prescription_id' => $prescription_id,
                    'case_id'   => $request->id,
                    'frequency' => $frequency_row,
                    'date_from' => $request->from[$key],
                    'date_to'   => $request->to[$key]
                );

                DB::table('prescription_data')->insert($data);
            }
        }
    }

    public function deletePrescription(Request $request, case_number_generators $case_gen)
    {
        //return "dfhn";
        $prescription_list = prescription_list::find($request['prescription_delete']);
        
        DB::table('prescription_data')->where('prescription_id', $request['prescription_delete'])->delete();
        
        if ($prescription_list === null)
        {
            return redirect()->back()
                ->withInput()
                ->withErrors(array(
                'message' => 'No prescription found.'
            ));
        }

        //update medical store balance only if case exists
        /*$case_master = Case_master::where('case_number', $case_gen->case_number)->first();
        if ($case_master !== null) {
            $prescription_list->Medical_store->balance_quantity += intval($prescription_list->medicine_Quntity);
            $prescription_list->Medical_store->save();
        }*/

        $prescription_list->delete();

        $request['prescriptions'] = prescription_list::where('case_id', $request->id)
            ->get();
        return redirect()
            ->back()
            ->withInput()
            ->with('flash_message', 'Record deleted successfully');
    }

    public function printprescription($id)
    {
        //$image_gallery = Image_gallery::where('imgTypeId', 4)->first();
        $user = Auth::user()->id;

        $accesslevel = DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='print/prescription'");

        foreach ($accesslevel as $value)
        {
            $this->acc = $value->accesslevel;
        }
	
        $casedata = $this->getCaseData($id);
        
        //dd($this->getCaseData($id));
		//$doctor = DB::table('users')->whereNotNull('doctor_degree')->whereNotNull('doctor_registration_number')->first();
        $doctor = DB::table('doctors')->where('id', $casedata['doctor_id'])->first();
        //dd($doctor);
        if ($this->acc == 1)
        {
            $helperCls = new drAppHelper();
            $logoUrl = $helperCls->GetLetterHeadImageUrl();
            
            $getdata = $this->getCaseData($id);
            foreach($getdata['prescriptions'] as $key => $val) {
                 $generic_medicine = DB::table('medical_store')->where('id',$val->generic_medicine_id)->first();
                 
                 $getdata['prescriptions'][$key]->generic_name = ($generic_medicine) ? $generic_medicine->generic_name: '';
             }
             
             $prescription_data_array = DB::table('prescription_data')->where('case_id', $id)->orderBy('prescription_id')->get();
            
            foreach($prescription_data_array as $prescription_data_row) {
                $prescription_data[$prescription_data_row->prescription_id][] = $prescription_data_row;
            }
			
			$prscription_notes_data = DB::table('prescription_lists')->where('case_number', $getdata['case_number'])->first();
				$prscription_notes = ($prscription_notes_data) ? $prscription_notes_data->notes : '';
				
            
            return view('case_masters.print_prescription', ['casedata' => $getdata, 'logoUrl' => $logoUrl, 'doctor' => $doctor, 'prescription_data' => $prescription_data, 'prscription_notes' => $prscription_notes]);
        }

        else
        {

            $url = url()->previous();
            return redirect($url);
        }

    }

    public function prescriptionlst(Request $request)
    {
        return view('case_masters.prescriptionlst', ['patientlist']);
    }

    public function destroy(Request $request, $id)
    {
        $case_master = Case_master::findOrFail($id);
        //$idsToDelete = Case_master::where('case_number', $case_master->case_number)->pluck('id')->toArray();
        //Case_master::destroy($idsToDelete);
        //$case_master->delete();
        $idsToDelete = Case_master::where('case_number', $case_master->case_number)
            ->update(['is_deleted' => '1']);

        return "OK";
    }

    ////////////////////////email////////////////////////
    public function SaveCaseHistoryotherpris(Request $request)
    {

        $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
        if (is_null($case_gen))
        {
            $case_gen = $this->createCaseNumber();
        }

        //$case_master = $this->save_prescription($request,$case_gen);
        if ($request->email && !empty($request->email))
        {

            $msg = 'Welcome To Tejas Infotech Eye Hospital.';
            $case_number = $request->case_number;
            $doctor_id = $request->doctor_id;
            $email = $request->email;
            //return $doctor_id;
            $medicine_id = $request->medicine_id;
            $numberoftimes = $request->numberoftimes;
            $medicine_quantity = $request->medicine_quantity;
            $strength = $request->strength;

            //return $strength;
            $mailContent = compact('case_number', 'doctor_id', 'medicine_id', 'numberoftimes', 'medicine_quantity', 'strength', 'msg');

            $doctor_name = DB::table('doctors')->select('doctor_name')
                ->where('id', '=', $doctor_id)->first();
            $doctor_name = $doctor_name->doctor_name;

            $medicalStorename = DB::table('medical_store')->select('medicine_name')
                ->where('id', '=', $medicine_id)->first();
            $medicine_name = $medicalStorename->medicine_name;

            $mailTemplate = 'case_masters.FormEmailPrescription';

            Mail::to($request->email)
                ->send(new casePaperMail(compact('case_number', 'email', 'doctor_name', 'medicine_name', 'numberoftimes', 'medicine_quantity', 'strength', 'msg') , $mailTemplate));

            //return view('case_masters.FormEmailPrescription',compact('case_number','email','doctor_name','entmedical_store','numberoftimes','medicine_quantity','strength','msg'));
            
        }

        $medicalStore = Medical_store::find($request['medicine_id']);

        $preslist = new prescription_list;
        $preslist->case_number = $case_gen->case_number;
        $preslist->medicine_id = $request['medicine_id'];
        $preslist->medicine_Quntity = empty($request['medicine_quantity']) ? 0 : $request['medicine_quantity'];
        $preslist->numberoftimes = $request['numberoftimes'];
        $preslist->strength = $request['strength'];
        $preslist->per_unit_cost = $medicalStore->unit_price;
        $preslist->case_id = $request->id;
        $preslist->no_of_days = $request->no_of_days;

        $preslist->save();
        return redirect()
            ->back()
            ->with('flash_message', 'Email has been sent to ' . $request->email);
    }

    /////////////////////////////////
    public function SaveCaseHistoryotherpris1(Request $request)
    {
        $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
        if (is_null($case_gen))
        {
            $case_gen = $this->createCaseNumber();
        }

        //$case_master = $this->save_prescription($request,$case_gen);
        if ($request->patient_emailId && !empty($request->patient_emailId))
        {

            $msg = 'Welcome To Tejas Infotech Eye Hospital.';
            $case_number = $request->case_number;
            $doctor_id = $request->doctor_id;
            $patient_emailId = $request->patient_emailId;
            //return $doctor_id;
            $medicine_id = $request->medicine_id;
            $numberoftimes = $request->numberoftimes;
            $medicine_quantity = $request->medicine_quantity;
            $strength = $request->strength;

            //return $strength;
            $mailContent = compact('case_number', 'doctor_id', 'medicine_id', 'numberoftimes', 'medicine_quantity', 'strength', 'msg');

            $doctor_name = DB::table('doctors')->select('doctor_name')
                ->where('id', '=', $doctor_id)->first();
            $doctor_name = $doctor_name->doctor_name;

            $medicalStorename = DB::table('medical_store')->select('medicine_name')
                ->where('id', '=', $medicine_id)->first();
            $medicine_name = $medicalStorename->medicine_name;

            $mailTemplate = 'case_masters.FormEmailPrescription';

            //$doctor_name=DB::table('doctors')->where('id',$doctor_id)->pluck('doctor_name');
            //return $doctor_name;
            //$medicalStore=DB::table('medical_store')->where('id',$medicine_id)->pluck('medicine_name');
            //$doctor_name= DB::select("SELECT doctor_name FROM `doctors` WHERE id='$doctor_id'");
            //return $medicalStore;
            Mail::to($request->patient_emailId)
                ->send(new casePaperMail(compact('case_number', 'patient_emailId', 'doctor_name', 'medicine_name', 'numberoftimes', 'medicine_quantity', 'strength', 'msg') , $mailTemplate));

            //return view('case_masters.FormEmailPrescription',compact('case_number','patient_emailId','doctor_name','entmedical_store','numberoftimes','medicine_quantity','strength','msg'));
            
        }

        $medicalStore = Medical_store::find($request['medicine_id']);

        $preslist = new prescription_list;
        $preslist->case_number = $case_gen->case_number;
        $preslist->medicine_id = $request['medicine_id'];
        $preslist->medicine_Quntity = empty($request['medicine_quantity']) ? 0 : $request['medicine_quantity'];
        $preslist->numberoftimes = $request['numberoftimes'];
        $preslist->strength = $request['strength'];
        $preslist->per_unit_cost = $medicalStore->unit_price;
        $preslist->case_id = $request->id;
        $preslist->no_of_days = $request->no_of_days;

        $preslist->save();

        return redirect()
            ->back()
            ->with('flash_message', 'Email has been sent to ' . $request->patient_emailId);
    }

    ////////General-Practictioner-pdfemail//////////////////////
    

    public function Send_email(Request $request)
    {

        if (Input::get('Send_email'))
        {

            if ($request->Email_To && !empty($request->Email_To))
            {
                $this->validate($request, ['Email_To' => 'required|email'

                ]);

                $case_master = Case_master::findOrFail($request->id);
                $pdfname = "gpFormEmail" . $request->id . ".pdf";
                $case_master->pdfname = $pdfname;
                $case_master->save();

                $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
                //return $case_gen;
                if (is_null($case_gen))
                {
                    $case_gen = $this->createCaseNumber();
                }

                $this->submitCase($request, $case_gen);
                $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
                $casedata = $this->getCaseData($request->id);

                $logoUrl = $image_gallery->imgUrl;

                if (\File::exists(public_path('gppdf/' . $pdfname)))
                {
                    \File::delete(public_path('gppdf/' . $pdfname));
                    $pdf = PDF::loadView('case_masters.genralppdfemail', compact('case_master', 'field_type_data', 'fieldtypeId', 'field_memory', 'casedata', 'logoUrl'));
                    $path = public_path('gppdf/');
                    $fileName = 'gpFormEmail' . $request->id . '.pdf';
                    $pdf->save($path . '/' . $fileName);
                }
                else
                {
                    $pdf = PDF::loadView('case_masters.genralppdfemail', compact('case_master', 'field_type_data', 'fieldtypeId', 'field_memory', 'casedata', 'logoUrl'));
                    $path = public_path('gppdf/');
                    $fileName = 'gpFormEmail' . $request->id . '.pdf';
                    $pdf->save($path . '/' . $fileName);
                }

                $mailContent = compact('case_master', 'field_type_data', 'fieldtypeId', 'field_memory');
                $mailTemplate = 'case_masters.genralppdfemail';

                Mail::to($request->Email_To)
                    ->send(new GenralpformMail($request->id));
                return redirect()
                    ->back()
                    ->with('flash_message', 'Email has been sent to ' . $request->Email_To);
            }
        }

        if (Input::get('Submit_email'))
        {

            if ($request->patient_emailId && !empty($request->patient_emailId))
            {
                $this->validate($request, ['patient_emailId' => 'required|email'

                ]);

                $case_master = Case_master::findOrFail($request->id);
                $pdfname = "gpFormEmail" . $request->id . ".pdf";
                $case_master->pdfname = $pdfname;
                $case_master->save();

                $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
                //return $case_gen;
                if (is_null($case_gen))
                {
                    $case_gen = $this->createCaseNumber();
                }

                $this->submitCase($request, $case_gen);
                $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
                $casedata = $this->getCaseData($request->id);
                $logoUrl = $image_gallery->imgUrl;

                if (\File::exists(public_path('gppdf/' . $pdfname)))
                {
                    \File::delete(public_path('gppdf/' . $pdfname));
                    $pdf = PDF::loadView('case_masters.genralppdfemail', compact('case_master', 'field_type_data', 'fieldtypeId', 'field_memory', 'casedata', 'logoUrl'));
                    $path = public_path('gppdf/');
                    $fileName = 'gpFormEmail' . $request->id . '.pdf';
                    $pdf->save($path . '/' . $fileName);
                }
                else
                {
                    $pdf = PDF::loadView('case_masters.genralppdfemail', compact('case_master', 'field_type_data', 'fieldtypeId', 'field_memory', 'casedata', 'logoUrl'));
                    $path = public_path('gppdf/');
                    $fileName = 'gpFormEmail' . $request->id . '.pdf';
                    $pdf->save($path . '/' . $fileName);
                }

                $mailContent = compact('case_master', 'field_type_data', 'fieldtypeId', 'field_memory');
                $mailTemplate = 'case_masters.genralppdfemail';

                Mail::to($request->patient_emailId)
                    ->send(new GenralpformMail($request->id));
                return redirect()
                    ->back()
                    ->with('flash_message', 'Email has been sent to ' . $request->patient_emailId);
            }
        }

    }
    
    public function patient_activity(Request $request)
    {
        //echo "============>>>>>> <pre>".__LINE__; print_r([]); exit;
        return view('patient_activity.index', []);
    }
    
    public function patient_activity_grid(Request $request) {
        $len = $_POST['length'];
        $start = $_POST['start'];

        //$select = "SELECT a.id,  a.case_number, `patient_name`,  e.doctor_name,`patient_mobile`, a.patient_age , `patient_emailId`,`referedby`, e.doctor_name, DATE_FORMAT(a.updated_at, \"%d %b %Y\"), 1,2, DATE(a.updated_at)= DATE(NOW())";
        
        $url = url('/').'/uploads/';
        /*
        $select = "SELECT "
                . "a.id, "
                . "concat('<a target=\'_blank\' href=\'".$url."', a.patient_pic,'\'><img style=\'width:100px;\' src=\'".$url."', "
                . "a.patient_pic,'\'></a>'), "
                . "a.visit_time, "
                . "a.case_number, "
                . "`patient_name`, "
                . "e.doctor_name,"
                . "a.referedby,"
                . "pa_1.status as a,"
                . "pa_2.status as b,"
                . "pa_3.status as c,"
                . "pa_4.status as d,"
                . "pa_5.status as e,"
                . "pa_6.status as f,"
                . "pa_7.status as g";
         */
        
        
        $select = "SELECT "
    . "a.id, "
    . "concat('<a target=\'_blank\' href=\'".$url."', a.patient_pic,'\'><img style=\'width:100px;\' src=\'".$url."', "
    . "a.patient_pic,'\'></a>'), "
    . "a.visit_time, "
    . "a.case_number, "
    . "CONCAT(COALESCE(`mr_mrs_ms`,''), ' ', COALESCE(`patient_name`,''), ' ', COALESCE(`middle_name`,''), ' ', COALESCE(`last_name`,'')) as patient_name, "
    . "e.doctor_name,"
    . "a.referedby,"
    . "CONCAT(pa_1.status, '_',IF(pa_1.in_created_time, pa_1.in_created_time, ''), '_',IF(pa_1.out_created_time, pa_1.out_created_time, '')) as a,"
    . "CONCAT(pa_2.status, '_',IF(pa_2.in_created_time, pa_2.in_created_time, ''), '_',IF(pa_2.out_created_time, pa_2.out_created_time, '')) as b,"
    . "CONCAT(pa_3.status, '_',IF(pa_3.in_created_time, pa_3.in_created_time, ''), '_',IF(pa_3.out_created_time, pa_3.out_created_time, '')) as c,"
    . "CONCAT(pa_4.status, '_',IF(pa_4.in_created_time, pa_4.in_created_time, ''), '_',IF(pa_4.out_created_time, pa_4.out_created_time, '')) as d,"
    . "CONCAT(pa_5.status, '_',IF(pa_5.in_created_time, pa_5.in_created_time, ''), '_',IF(pa_5.out_created_time, pa_5.out_created_time, '')) as e,"
    . "CONCAT(pa_6.status, '_',IF(pa_6.in_created_time, pa_6.in_created_time, ''), '_',IF(pa_6.out_created_time, pa_6.out_created_time, '')) as f,"
    . "CONCAT(pa_7.status, '_',IF(pa_7.in_created_time, pa_7.in_created_time, ''), '_',IF(pa_7.out_created_time, pa_7.out_created_time, '')) as g";
        
        //CONCAT(pa_2.status, '_', IF(pa_2.in_created_time, pa_2.in_created_time, ''), '_',IF(pa_2.out_created_time, pa_2.out_created_time, '')) as b

                //. "`referedby`, "
                //. "e.doctor_name, ";
                //. "DATE_FORMAT(a.updated_at, \"%d %b %Y\"), 1, CONCAT(a.case_type,' ', a.case_appointment_time), "
                //. "DATE(a.updated_at)= DATE(NOW())";
        
        $presql = " FROM case_master a
                    join (select max(id) as id from case_master where is_deleted = 0 group by case_number) b on a.id =b.id 
                    left join timeslots d on a.FollowUpDate = d.id
                    left join doctors c on a.FollowUpDoctor_Id = c.id
                    left join doctors e on a.doctor_id = e.id 
                    
                    
                    left join patient_activity pa_1 on pa_1.case_id = a.id AND pa_1.activity_type = 'reception_activity'
                    left join patient_activity pa_2 on pa_2.case_id = a.id AND pa_2.activity_type = 'ophthalmetry' 
                    left join patient_activity pa_3 on pa_3.case_id = a.id AND pa_3.activity_type = 'patient_doctor_state' 
                    left join patient_activity pa_4 on pa_4.case_id = a.id AND pa_4.activity_type = 'doctor_procedure' 
                    left join patient_activity pa_5 on pa_5.case_id = a.id AND pa_5.activity_type = 'patient_billing' 
                    left join patient_activity pa_6 on pa_6.case_id = a.id AND pa_6.activity_type = 'consultant_activity' 
                    left join patient_activity pa_7 on pa_7.case_id = a.id AND pa_7.activity_type = 'patient_out' 
                    
                    ";
        //$presql .= " WHERE 1=1 and a.is_deleted = 0";
		
		if(isset($request->list_type) && $request->list_type == "ipd") {
			//$presql .= " WHERE a.patient_type='ipd' and a.is_deleted = 0";
                    $presql .= " WHERE a.is_ipd='1' and a.is_deleted = 0";
		} else {
			$presql .= " WHERE a.patient_type='opd' and a.is_deleted = 0";
		}
		
        
        if((!empty($_POST['columns'][8]['search']['value']) &&  $_POST['columns'][8]['search']['value'] == "today") || $_POST['draw'] == 1)
        {
           $presql .= " and date(a.updated_at) = '".date("Y-m-d")."' ";
        }
        if ($_POST['search']['value'])
        {
            //$presql .= " and patient_name LIKE '%" . $_POST['search']['value'] . "%' ";
            $presql .= " and (patient_name LIKE '%" . $_POST['search']['value'] . "%' OR middle_name LIKE '%" . $_POST['search']['value'] . "%' OR last_name LIKE '%" . $_POST['search']['value'] . "%')";
        }
        if ($_POST['columns'][1]['search']['value'])
        {
            $presql .= " and a.case_number LIKE '%" . $_POST['columns'][1]['search']['value'] . "%' ";
        }
        if ($_POST['columns'][2]['search']['value'])
        {
            $presql .= " and e.doctor_name LIKE '%" . $_POST['columns'][2]['search']['value'] . "%' ";
        }
        if ($_POST['columns'][3]['search']['value'])
        {
            //$presql .= " and patient_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' ";
            $presql .= " and (patient_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' OR middle_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' OR last_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%')";
        }
        $presql .= "  ";
        $orderByStr = " order by a.id desc";
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
        
        //echo "========= : ".$sql; exit;
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
    
    function update_patient_activity(Request $request) {
        $update_data = array(
            'case_id' => $request->case_id,
            'activity_type' => $request->activity_type,
            'status' => $request->status,
            'created_by' => Auth::user()->id
        );
        
        if($request->status == "In") {
            $update_data['in_created_date'] = date('Y-m-d');
            $update_data['in_created_time'] = date('h:i A');
            $update_data['in_created_by'] = Auth::user()->id;
            
            $update_data['in_timestamp'] = date('Y-m-d h:i:s');
        } else {
            $update_data['out_created_date'] = date('Y-m-d h:i:s');
            $update_data['out_created_time'] = date('h:i A');
            $update_data['out_created_by'] = Auth::user()->id;
            
            $update_data['out_timestamp'] = date('Y-m-d h:i:s');
        }
        
        $is_record = DB::table('patient_activity')->where(['case_id' => $request->case_id, 'activity_type' => $request->activity_type])->first();
        
        if($is_record) {
            DB::table('patient_activity')->where(['case_id' => $request->case_id, 'activity_type' => $request->activity_type])->update($update_data);
        } else {
            DB::table('patient_activity')->insert($update_data);
        }
    }

    //////////////////////////////////
    
    public function certificate(Request $request) {
        return view('certificate.certificate_listing', []);
    }
    
    public function edit_certificate(Request $request, $id) {
        $case_master  = Case_master::findOrFail($id);
        $certificate = DB::table('certificate')->where('case_id', $request->case_id)->first();
        return view('certificate.edit_certificate',compact('case_master', 'certificate'));
    }
    
     public function update_certificate(Request $request, $id) {
        
        //echo "<pre> =========== "; print_r($_POST); exit;
        
        $case_master = Case_master::findOrFail($request->case_id);
        $case_master->patient_name = $request->patient_name;
        $case_master->middle_name = $request->middle_name;
        $case_master->last_name = $request->last_name;
        //$case_master->patient_address = $request->patient_address;
        $case_master->male_female = $request->male_female;
        $case_master->patient_age = $request->patient_age;
        //$case_master->patient_mobile = $request->patient_mobile;
        //$case_master->admission_date_time = $request->admission_date_time;
        //$case_master->surgery_date_time = $request->surgery_date_time;
        //$case_master->discharge_date_time = $request->discharge_date_time;
        //$case_master->discharge_history = $request->discharge_history;
       // $case_master->diagnosis = $request->diagnosis;
        //$case_master->Surgeon = $request->surgeon_name;
        //$case_master->elective_emergency      = $request->elective_emergency;
        //$case_master->admission_reason      = $request->admission_reason;
        $case_master->save();

        
        /*
       
    [diagnosis] => Corona
    [show_is_opd_ipd] => on
    [is_opd_ipd] => Array
        (
            [0] => opd
            [1] => opd
        )

    [show_opd] => on
    [opd_from] => 2021-09-16
    [opd_to] => 2021-09-16
    [show_ipd] => on
    [ipd_on] => 2021-09-22
    [discharge_on] => 2021-09-25
    [show_operated] => on
    [operated_for] => Corona
    [operated_date] => 2021-09-18
    [show_advised] => on
    [rest_days] => 20
    [rest_from] => 2021-09-25
    [show_further_advised] => on
    [further_rest_from] => 2021-09-24
    [further_rest_days] => 100
    [show_resume_work] => on
    [is_nominal_or_light_work] => light
    [nominal_or_light_work_from] => 2021-09-26
    [show_identification_mark] => on
    [identification_mark] => Eyes
    [consent_date] => 
      */  
        $certificate_record = DB::table('certificate')->where('case_id', $request->case_id)->first();
        
        //dd($consent_record); 
        
        $certificate_form_data = array(
            'case_id' => $request->case_id,
            'diagnosis' => $request->diagnosis,
            'show_is_opd_ipd' => isset($request->show_is_opd_ipd) ? $request->show_is_opd_ipd : '0',
            'is_opd_ipd' => isset($request->is_opd_ipd) ? implode('_',$request->is_opd_ipd) : '',
            'show_opd' =>  isset($request->show_opd) ? $request->show_opd : '0',
            'opd_from' => ($request->opd_from != '') ? date('Y-m-d', strtotime($request->opd_from)) : '',
            'opd_to' => ($request->opd_to != '') ? date('Y-m-d', strtotime($request->opd_to)) : '',
            'show_ipd' =>  isset($request->show_ipd) ? $request->show_ipd : '0',
            'ipd_on' => ($request->ipd_on != '') ? date('Y-m-d', strtotime($request->ipd_on)) : '',
            'discharge_on' => ($request->discharge_on != '') ? date('Y-m-d', strtotime($request->discharge_on)) : '',
            'show_operated' => isset($request->show_operated) ? $request->show_operated : '0',
            'operated_for' => $request->operated_for,
            'operated_date' => ($request->operated_date != '') ? date('Y-m-d', strtotime($request->operated_date)) : '',
            
            'show_advised' => isset($request->show_advised) ? $request->show_advised : '0',
            'rest_days' => $request->rest_days,
            'rest_from' => ($request->rest_from != '') ? date('Y-m-d', strtotime($request->rest_from)) : '',
            
            'show_further_advised' => isset($request->show_further_advised) ? $request->show_further_advised : '0',
            'further_rest_from' => ($request->further_rest_from != '') ? date('Y-m-d', strtotime($request->further_rest_from)) : '',
            'further_rest_days' => $request->further_rest_days,
            
            'show_resume_work' => isset($request->show_resume_work) ? $request->show_resume_work : '0',
            'is_nominal_or_light_work' => $request->is_nominal_or_light_work,
            'nominal_or_light_work_from' => ($request->nominal_or_light_work_from != '') ? date('Y-m-d', strtotime($request->nominal_or_light_work_from)) : '',
            
            'show_identification_mark' => isset($request->show_identification_mark)? $request->show_identification_mark  :'0',
            'identification_mark' => $request->identification_mark
        );
        if($certificate_record) {
            $certificate_form_data['updated_by'] = Auth::user()->id;
            DB::table('certificate')
                ->where('case_id', $request->case_id)
                ->update($certificate_form_data);
        } else {
            $certificate_form_data['created_by'] = Auth::user()->id;
             DB::table('certificate')
                ->insert($certificate_form_data);
        }
            
//================= inser cutom data ===========================
        if(isset($request->submit) && $request->submit == "submit") {
            return redirect()->back()->with('flash_message', 'Record updated successfully');
        } else {
           
            return redirect('certificate/print/1/'.$request->case_id);
        }
    
    }
    
    public function print_certificate($case_id) {
        $case_master  = Case_master::findOrFail($case_id);
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $certificate = DB::table('certificate')->where('case_id', $case_id)->first();
        return view('certificate.print_certificate', compact('case_master', 'logoUrl', 'certificate'));
    }
    
    //=======================================================================
    
    public function add_prescription_dropdowns($id) {
        
        $templates = DB::table('prescription_templates')->where('parent', 0)->get();
        
        $user = Auth::user()->id;
		/*
        $accesslevel = DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='AddEdit/prescription'");

        foreach ($accesslevel as $value)
        {
            $this->acc = $value->accesslevel;
        }

        if ($this->acc == 1)
        {	*/
		$this->acc = $this->commonHelper->checkUserAccess("2_case_masters/prescriptionlst",Auth::user()->id, 'add_permission');
        if ($this->acc == 1) {
            $getdata = $this->getCaseData($id);
            
             $presDropdowns = [
'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText') ,
'quantity' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText') , 
'medicine_strength' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText'), 
'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText'), 
'no_of_days' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'no_of_days')->pluck('ddText', 'ddText') 
        ];
             
             //dd($getdata['prescriptions']);
             
             foreach($getdata['prescriptions'] as $key => $val) {
                 $generic_medicine = DB::table('medical_store')->where('id',$val->generic_medicine_id)->first();
                 
                 $getdata['prescriptions'][$key]->generic_name = ($generic_medicine) ? $generic_medicine->generic_name: '';
             }
             
             //dd($getdata['prescriptions']);
             
            $mergeArray = array_merge($getdata, $presDropdowns);
            
            $prescription_data_array = DB::table('prescription_data')->where('case_id', $id)->orderBy('prescription_id')->get();
            
            $prescription_data = [];
            foreach($prescription_data_array as $prescription_data_row) {
                $prescription_data[$prescription_data_row->prescription_id][] = $prescription_data_row;
            }
            
            //dd($prescription_data);
            
            return view('prescriptions.add_dropdowns', ['casedata' => $mergeArray, 'templates' => $templates, 'form_dropdowns', 'prescription_data' => $prescription_data]);
        } else {

            $url = url()->previous();
            return redirect($url);
        }
    }
    
    public function certificate_grid(Request $request)
    {
        $len = $_POST['length'];
        $start = $_POST['start'];

        //$select = "SELECT a.id,  a.case_number, `patient_name`,  e.doctor_name,`patient_mobile`, a.patient_age , `patient_emailId`,`referedby`, e.doctor_name, DATE_FORMAT(a.updated_at, \"%d %b %Y\"), 1,2, DATE(a.updated_at)= DATE(NOW())";
        
        $url = url('/').'/uploads/';
        $select = "SELECT a.id, a.case_number, CONCAT(COALESCE(`mr_mrs_ms`,''), ' ', COALESCE(`patient_name`,''), ' ', COALESCE(`middle_name`,''), ' ', COALESCE(`last_name`,'')), a.referedby, `patient_mobile`, `patient_age`, e.doctor_name ,`referedby`, e.doctor_name, DATE_FORMAT(a.updated_at, \"%d %b %Y\"), 1, CONCAT(a.case_type,' ', a.case_appointment_time), DATE(a.updated_at)= DATE(NOW()), null, null, null";
        
        $presql = " FROM case_master a
                    join (select max(id) as id from case_master where is_deleted = 0 group by case_number) b on a.id =b.id 
                    left join timeslots d on a.FollowUpDate = d.id
                    left join doctors c on a.FollowUpDoctor_Id = c.id
                    left join doctors e on a.doctor_id = e.id 
                    ";
        //$presql .= " WHERE 1=1 and a.is_deleted = 0";
		
		if(isset($request->list_type) && $request->list_type == "ipd") {
			//$presql .= " WHERE a.patient_type='ipd' and a.is_deleted = 0";
                    $presql .= " WHERE a.is_ipd='1' and a.is_deleted = 0";
		} else {
			$presql .= " WHERE a.patient_type='opd' and a.is_deleted = 0";
		}
		
        
        if((!empty($_POST['columns'][8]['search']['value']) &&  $_POST['columns'][8]['search']['value'] == "today") || $_POST['draw'] == 1)
        {
            $presql .= " and date(a.updated_at) = '".date("Y-m-d")."' ";
        }
        if ($_POST['search']['value'])
        {
            $presql .= " and (patient_name LIKE '%" . $_POST['search']['value'] . "%' OR middle_name LIKE '%" . $_POST['search']['value'] . "%' OR last_name LIKE '%" . $_POST['search']['value'] . "%')";
        }
        if ($_POST['columns'][1]['search']['value'])
        {
            $presql .= " and a.case_number LIKE '%" . $_POST['columns'][1]['search']['value'] . "%' ";
        }
        if ($_POST['columns'][2]['search']['value'])
        {
            $presql .= " and e.doctor_name LIKE '%" . $_POST['columns'][2]['search']['value'] . "%' ";
        }
        if ($_POST['columns'][3]['search']['value'])
        {
            //$presql .= " and patient_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' ";
            
            $presql .= " and (patient_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' OR middle_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' OR last_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%')";
        }
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
    
     public function prescription_grid(Request $request)
    {
         
         //echo "=====>>>>>>> <pre>"; print_r($_POST); exit;
         
        $len = $_POST['length'];
        $start = $_POST['start'];

        //$select = "SELECT a.id,  a.case_number, `patient_name`,  e.doctor_name,`patient_mobile`, a.patient_age , `patient_emailId`,`referedby`, e.doctor_name, DATE_FORMAT(a.updated_at, \"%d %b %Y\"), 1,2, DATE(a.updated_at)= DATE(NOW())";
        
        $url = url('/').'/uploads/';
        $select = "SELECT a.id, a.case_number, CONCAT(COALESCE(`mr_mrs_ms`,''), ' ', COALESCE(`patient_name`,''), ' ', COALESCE(`middle_name`,''), ' ', COALESCE(`last_name`,'')), a.referedby, `patient_mobile`, e.doctor_name ,`patient_age`, `referedby`, e.doctor_name, DATE_FORMAT(a.updated_at, \"%d %b %Y\"), 1, CONCAT(a.case_type,' ', a.case_appointment_time), DATE(a.updated_at)= DATE(NOW()), null, null, null";
        
        $presql = " FROM case_master a
                    join (select max(id) as id from case_master where is_deleted = 0 group by case_number) b on a.id =b.id 
                    left join timeslots d on a.FollowUpDate = d.id
                    left join doctors c on a.FollowUpDoctor_Id = c.id
                    left join doctors e on a.doctor_id = e.id 
                    ";
        //$presql .= " WHERE 1=1 and a.is_deleted = 0";
		
		if(isset($request->list_type) && $request->list_type == "ipd") {
			//$presql .= " WHERE a.patient_type='ipd' and a.is_deleted = 0";
                    $presql .= " WHERE a.is_ipd='1' and a.is_deleted = 0";
		} else {
			$presql .= " WHERE a.patient_type='opd' and a.is_deleted = 0";
		}
		
        
        if((!empty($_POST['columns'][4]['search']['value']) &&  $_POST['columns'][4]['search']['value'] == "today") || $_POST['draw'] == 1)
        {
            $presql .= " and date(a.updated_at) = '".date("Y-m-d")."' ";
        }
        if ($_POST['search']['value'])
        {
            $presql .= " and (patient_name LIKE '%" . $_POST['search']['value'] . "%' OR middle_name LIKE '%" . $_POST['search']['value'] . "%' OR last_name LIKE '%" . $_POST['search']['value'] . "%')";
        }
        if ($_POST['columns'][1]['search']['value'])
        {
            $presql .= " and a.case_number LIKE '%" . $_POST['columns'][1]['search']['value'] . "%' ";
        }
        if ($_POST['columns'][2]['search']['value'])
        {
            $presql .= " and e.doctor_name LIKE '%" . $_POST['columns'][2]['search']['value'] . "%' ";
        }
        if ($_POST['columns'][3]['search']['value'])
        {
            //$presql .= " and patient_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' ";
            
            $presql .= " and (patient_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' OR middle_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' OR last_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%')";
        }
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
    
     public function bill_details_grid(Request $request)
    {
         
         //echo "=====>>>>>>> <pre>"; print_r($_POST); exit;
         
        $len = $_POST['length'];
        $start = $_POST['start'];

        //$select = "SELECT a.id,  a.case_number, `patient_name`,  e.doctor_name,`patient_mobile`, a.patient_age , `patient_emailId`,`referedby`, e.doctor_name, DATE_FORMAT(a.updated_at, \"%d %b %Y\"), 1,2, DATE(a.updated_at)= DATE(NOW())";
        
        $url = url('/').'/uploads/';
        $select = "SELECT a.id, a.case_number, CONCAT(COALESCE(`mr_mrs_ms`,''), ' ', COALESCE(`patient_name`,''), ' ', COALESCE(`middle_name`,''), ' ', COALESCE(`last_name`,'')), a.referedby, `patient_mobile`, e.doctor_name ,`patient_age`, `referedby`, e.doctor_name, DATE_FORMAT(a.updated_at, \"%d %b %Y\"), 1, CONCAT(a.case_type,' ', a.case_appointment_time), DATE(a.updated_at)= DATE(NOW()), null, null, null";
        
        $presql = " FROM case_master a
                    join (select max(id) as id from case_master where is_deleted = 0 group by case_number) b on a.id =b.id 
                    left join timeslots d on a.FollowUpDate = d.id
                    left join doctors c on a.FollowUpDoctor_Id = c.id
                    left join doctors e on a.doctor_id = e.id 
                    ";
        //$presql .= " WHERE 1=1 and a.is_deleted = 0";
		
		if(isset($request->list_type) && $request->list_type == "ipd") {
			//$presql .= " WHERE a.patient_type='ipd' and a.is_deleted = 0";
                    $presql .= " WHERE a.is_ipd='1' and a.is_deleted = 0";
		} else {
			$presql .= " WHERE a.patient_type='opd' and a.is_deleted = 0";
		}
		
        
        if((!empty($_POST['columns'][4]['search']['value']) &&  $_POST['columns'][4]['search']['value'] == "today") || $_POST['draw'] == 1)
        {
            $presql .= " and date(a.updated_at) = '".date("Y-m-d")."' ";
        }
        if ($_POST['search']['value'])
        {
            $presql .= " and (patient_name LIKE '%" . $_POST['search']['value'] . "%' OR middle_name LIKE '%" . $_POST['search']['value'] . "%' OR last_name LIKE '%" . $_POST['search']['value'] . "%')";
        }
        if ($_POST['columns'][1]['search']['value'])
        {
            $presql .= " and a.case_number LIKE '%" . $_POST['columns'][1]['search']['value'] . "%' ";
        }
        if ($_POST['columns'][2]['search']['value'])
        {
            $presql .= " and e.doctor_name LIKE '%" . $_POST['columns'][2]['search']['value'] . "%' ";
        }
        if ($_POST['columns'][3]['search']['value'])
        {
            //$presql .= " and patient_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' ";
            
            $presql .= " and (patient_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' OR middle_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%' OR last_name LIKE '%" . $_POST['columns'][3]['search']['value'] . "%')";
        }
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
    
    public function add_ent_prescription_dropdowns($id = "") {
        
        $templates = DB::table('prescription_templates')->where('parent', 0)->get();
        
        $user = Auth::user()->id;
		/*
        $accesslevel = DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='AddEdit/prescription'");

        foreach ($accesslevel as $value)
        {
            $this->acc = $value->accesslevel;
        }

        if ($this->acc == 1)
        {	*/
        
		$this->acc = $this->commonHelper->checkUserAccess("2_case_masters/prescriptionlst",Auth::user()->id, 'add_permission');
        if ($this->acc == 1) {
            $getdata = ($id) ? $this->getCaseData($id) : [];
        //echo "=============: ".__LINE__; exit;
            
             $presDropdowns = [
                'numberOfTimes_drpdwn' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Times a day')->pluck('ddText','ddText'),
                'quantity'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Quantity')->pluck('ddText','ddText'),
                'medicine_strength'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Strength')->pluck('ddText','ddText'), 
    'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText') 
            ];
             
             //dd($getdata['prescriptions']);
             
             foreach($getdata['prescriptions'] as $key => $val) {
                 $generic_medicine = DB::table('medical_store')->where('id',$val->generic_medicine_id)->first();
                 
                 $getdata['prescriptions'][$key]->generic_name = ($generic_medicine) ? $generic_medicine->generic_name: '';
             }
             
             //dd($getdata['prescriptions']);
             
            $mergeArray = array_merge($getdata, $presDropdowns);
            
            $prescription_data_array = DB::table('prescription_data')->where('case_id', $id)->orderBy('prescription_id')->get();
            
            $prescription_data = [];
            foreach($prescription_data_array as $prescription_data_row) {
                $prescription_data[$prescription_data_row->prescription_id][] = $prescription_data_row;
            }
            
            //dd($prescription_data);
            
            $medicinlist = entmedical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get();
            
            $presDropdowns = [
                'numberOfTimes_drpdwn' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Times a day')->pluck('ddText','ddText'),
                'quantity'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Quantity')->pluck('ddText','ddText'),
                'medicine_strength'=>ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Strength')->pluck('ddText','ddText'), 
    'medicine_timing' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'medicine_timing')->pluck('ddText', 'ddText') 
            ];
            
            return view('prescriptions.add_ent_dropdowns', ['casedata' => $mergeArray, 'templates' => $templates, 'form_dropdowns', 'prescription_data' => $prescription_data, 'medicinlist' => $medicinlist]);
        } else {

            $url = url()->previous();
            return redirect($url);
        }
    }
    
    
    
    public function upload_case_form(Request $request, $id)
    {
         $sp_test_image = report_image::where('case_id', $id)->Where('reportFileName', 'upload_case_form')->get()->toArray();
		
//dd($sp_test_image);
         
         //dd($this->getCaseData($id));
        return view('EyeForm.UploadCaseForm', ['casedata' => $this->getCaseData($id), 'sp_test_image' => $sp_test_image]);
    }
    
    
    public function store_upload_case_form(Request $request)
    {
        //dd($request->all());
       // echo "====================".__LINE__; exit;
        $case_gen = case_number_generators::where('case_number', $request['case_number'])->first();
        if (is_null($case_gen)) {
            $case_gen = $this->createCaseNumber();
        }
        
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
		
		if(count($request->new_image_data) > 0) {
			foreach($request->new_image_data as $key => $new_image_data_row) {
			    $data = $new_image_data_row;

			    list($type, $data) = explode(';', $data);
			    list(, $data)      = explode(',', $data);
			    $data = base64_decode($data);
			    
			    $name = strtotime('now'). $key .'.png';

			    file_put_contents('sp_test_images/'.$name, $data);
			    
			    $report_image = new report_image();
			    $report_image->reportFileName = 'upload_case_form';
			    $report_image->case_id = $request->id;
			    $report_image->filePath = $name;
			    $report_image->title = $request->new_image_title[$key];
			    $report_image->save();
			}
		} else {
			if ( $request->hasFile('sp_test_images')) {
                //echo "in ifff";exit;
                $image = $request->File('sp_test_images');
                //echo "<pre> ============= ";print_r($image);exit;
                $destinationPath = 'sp_test_images/';
                $i=1;
                foreach ($image as $key => $files) {
                   // echo "<pre> ============= ";print_r($files);exit;
                    $profileImage = time().$i++.'.'.$files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $report_image = new report_image();
                    $report_image->reportFileName = 'upload_case_form';
                    $report_image->case_id = $request->id;
                    $report_image->filePath = $profileImage;
                    $report_image->title = $request->new_image_title[$key];
                    $report_image->save();
                }
            }
		}
       
		/*
        if ( $request->hasFile('sp_test_images')) {
                //echo "in ifff";exit;
                $image = $request->File('sp_test_images');
                //echo "<pre> ============= ";print_r($image);exit;
                $destinationPath = 'sp_test_images/';
                $i=1;
                foreach ($image as $key => $files) {
                   // echo "<pre> ============= ";print_r($files);exit;
                    $profileImage = time().$i++.'.'.$files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $report_image = new report_image();
                    $report_image->reportFileName = 'upload_case_form';
                    $report_image->case_id = $request->id;
                    $report_image->filePath = $profileImage;
                    $report_image->title = $request->new_image_title[$key];
                    $report_image->save();
                }
            }
		
		
		foreach($request->new_image_data as $key => $new_image_data_row) {
			    $data = $new_image_data_row;

			    list($type, $data) = explode(';', $data);
			    list(, $data)      = explode(',', $data);
			    $data = base64_decode($data);
			    
			    $name = strtotime(). $key .'.png';

			    file_put_contents('sp_test_images/'.$name, $data);
			    
			    $report_image = new report_image();
			    $report_image->reportFileName = 'upload_case_form';
			    $report_image->case_id = $request->id;
			    $report_image->filePath = $name;
			    $report_image->title = $request->new_image_title[$key];
			    $report_image->save();
			}
		*/
        
        $case_master->casehistory_followup_notes =  $request->casehistory_followup_notes;
        if (isset($request->FollowUpDoctorID) && isset($request->appointment_dt) && $request->appointment_dt != null && $request->appointment_dt != '') {
            $case_master->FollowUpDate =  $request->appointment_dt;
            $case_master->FollowUpTimeSlot = $request->FollowUpTimeSlot;
            $case_master->FollowUpDoctor_Id = $request->FollowUpDoctorID;
            
             $case_master->touch(); //updated_at = Carbon::now();
             $case_master->save();
        }
        
        return redirect()->back()
            ->with('flash_message', 'Record Added Successfully');

    }
    
    public function print_upload_case_form_image(Request $request) {
        //dd($request->all());
        
        return view('EyeForm.UploadCaseFormPrint', ['image_to_print' => $request->image_to_print, 'image_to_print_title' => $request->image_to_print_title]);
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
	
public function update_ent_prescription_templates(Request $request) {
        if($request->id) {
            $template = DB::table('ent_prescription_templates')->where('id', $request->id)->orWhere('parent', $request->id)->delete();
        }
        
        //echo "==========1111111111=>>>>>>>> <pre>"; print_r($_POST); exit;
        
    
            
        $parent = 0;
        foreach($request->medicine_id as $key => $medicine) {
            
            $insert_data = [
                'template_name' => $request->template_name,
                'medicine_id' => $medicine,
                'medicine_Quntity' => $request->medicine_quantity[$key],
                'numberoftimes' => $request->numberoftimes[$key],
                'strength' => $request->strength[$key]
            ];
            
            if($parent != 0) {
                $insert_data['parent'] = $parent;
                DB::table('ent_prescription_templates')->insert($insert_data);
            } else {
                $parent = DB::table('ent_prescription_templates')->insertGetId($insert_data);
            }
            
        }
        
       // echo "==========1111111111=>>>>>>>> <pre>"; print_r($request->medicine_id); exit;
        
        if($request->id) {
            return redirect('ent-prescription-templates-listing/'.$request->case_id)
                ->with('flash_message', 'Template Updated Successully.');
        }
        if($request->case_id) {
            return redirect('AddEdit/entprescription/'.$request->case_id)
                //->withInput()
                ->with('flash_message', 'Template added Successully.');
        } else {
            return redirect()->back()
                //->withInput()
                ->with('flash_message', 'Template added Successully.');
        }
    }
    
    
}

