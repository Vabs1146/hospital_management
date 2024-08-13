<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as HttpGuzzle;
use Illuminate\Support\Facades\Input;
use Calendar;
use App\appointment;
use App\Case_master;
use App\doctor;
use App\timeslot;
use Event;
use DateTime;
use Auth;
use Response;
use App\Helpers\Helpers;
use App\helperClass\CommonHelper;


class AppointmentController extends Controller
{
    protected $doctorlist, $timeslot, $appointment;

    public function __construct()
    {
        //DB::enableQueryLog(); //--- this to enable QueryLog for below query to execute
        //var_dump(DB::getQueryLog()); //--This line after query will dump sql query in browser.
        $this->doctorlist = doctor::where('isActive', 1)
            ->orderBy('doctor_name')
            ->pluck('doctor_name', 'id');
        $this->timeslot = timeslot::where('isActive', 1)
            ->orderBy('id')
            ->pluck('name', 'id');
        $this->appointment = new appointment();
        $this->acc = 0;
        $this->commonHelper = new CommonHelper();
    }

    // display list of all the appointment.
    public function index(Request $req)
    {
        // $events = [];
        // $data = appointment::whereMonth('appointment_dt', '=', date('m'))->get();
        // if($data->count()) {
        //     foreach ($data as $key => $value) {
        //         $events[] = Calendar::event(
        //             'Token Number : '. $value->tokenNumber,
        //             true,
        //             new \DateTime($value->appointment_dt),
        //             new \DateTime($value->appointment_dt),
        //             null,
        //             // Add color and link on event
        //             [
        //                 'color' => 'green',
        //                 'editable' => false,
        //             ]
        //         );
        //     }
        // }
        // $calendar = Calendar::addEvents($events)->setOptions([ //set fullcalendar options
        //     'firstDay' => 1,
        //     //'weekends' => false,
        //     //'hiddenDays' => [ 0 ],
        //     'header' => ['left'=>'','center'=>'title','right'=>'']
        // ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
        //     'dayClick' => 'dayClickEvent'
        //    // 'dayRender' => 'dayRenderEvent'
        // ]);
        $title = 'Appointment';
        $doctorList = $this
            ->doctorlist
            ->toArray();
        $hideMenu = true;
        $doctor_id = $req->input('doctor_id');
        $timeslot = DB::select("SELECT starttime FROM `tbl_appoinment_slot` where doctor_id='$doctor_id'");
        $doctorlist11 = DB::select("SELECT * FROM `doctors`");
        
        
        if (env('layoutTemplate') == 'shared/layoutProspera') {
            //echo "11111111111111122222222222222222222222222222222211111111111"; exit;
            //echo __LINE__; exit;
            return view('appointment.fullcalender', compact('title', 'doctorList', 'hideMenu', 'timeslot', 'doctorlist11'));
        }else if (env('layoutTemplate') == 'shared/layoutCaremed') {
            //echo "222222222222222222"; exit;
            $hideMenu = false;
            return view('appointment.fullcalenderCaremed', compact('title', 'doctorList', 'hideMenu', 'timeslot', 'doctorlist11'));
        }else {
			/*
			return View::make('appointment.create')->with(['appointment' => $this->appointment,
                                                            'doctorlist' => $this->doctorlist,
                                                            'timeslot' => $this->timeslot]);
															*/
															return view('appointment.fullcalender', compact('title', 'doctorList', 'hideMenu', 'timeslot', 'doctorlist11'));
		}
    }

    public function listAppointment($id)
    {
        $doctorList = $this
            ->doctorlist
            ->toArray();
        /*$data = DB::select("SELECT * FROM `tbl_events`");*/
        $events = [];
        $data['doctorlist'] = doctor::where('isActive', 1)
                                            ->orderBy('doctor_name')
                                            ->pluck('doctor_name', 'id');
        $doctor_list = $data['doctorlist']->toArray();
       //echo "<pre>"; print_r($doctor_list); exit;
        
        if($id == 0 && count($doctor_list) == 1) {
            
            //echo '/appointmentlist/'.array_key_first($doctor_list); exit;
            return redirect('/appointmentlist/'.key($doctor_list));
        }
        
        $selecteddoc = $id;
        $data = DB::select("SELECT *,`appointments`.id as patientid, doctors.doctor_name "
                . "FROM `appointments` "
                . "INNER JOIN doctors ON appointments.doctor_id=doctors.id "
                . "where appointments.doctor_id='$id' AND (isAccepted =1 OR isAccepted IS NULL)");
        //$count = DB::table('tbl_events')->count();
        if (DB::table('appointments')->count())
        {
            
            //dd($data);
            foreach ($data as $key => $value)
            {
                $events[] = Calendar::event(
                    date("H:i A", strtotime($value->morningEvening))."\n".$value->doctor_name . "\n" . $value->name . "\n",
                    false, 
                    new \DateTime($value->appointment_dt . $value->morningEvening) , 
                    new \DateTime($value->appointment_dt . $value->morningEvening) , 
                    null,
                    // Add color and link on event
                    ['color' => '#e91e63', 'url' => "/aptpatientDetails/" . $value->patientid, ]
                );
            }
        }
        //$calendar = Calendar::addEvents($events);
        
         $calendar = Calendar::addEvents($events)->setOptions([ 'contentHeight' => 'fit-content' ]);
        
        return view('appointment.index', compact('doctorList', 'selecteddoc', 'calendar', 'calendar'));
    }

    public function followappoinment($id)
    {
        $id1 = Auth::user()->id;
		/*
        $accesslevel = DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id1' AND section.sectionname='followupappoinment'");
        foreach ($accesslevel as $value)
        {
            $acc = $value->accesslevel;
        }
        if ($acc == 1)
        {
			*/
		$this->acc = $this->commonHelper->checkUserAccess("1_followupappoinment/0",Auth::user()->id);
        if ($this->acc == 1) {
            $events = [];
            $doctorList = $this
                ->doctorlist
                ->toArray();
            $selecteddoc = $id;
            //return $doctorList;
            $data['doctorlist'] = doctor::where('isActive', 1)->orderBy('doctor_name')
                ->pluck('doctor_name', 'id');
            
            $doctor_list = $data['doctorlist']->toArray();
            //echo "<pre>"; print_r($doctor_list); exit;

             if($id == 0 && count($doctor_list) == 1) {

                 //echo '/appointmentlist/'.array_key_first($doctor_list); exit;
                 return redirect('/followupappoinment/'.key($doctor_list));
             }
        
            $data = DB::select("SELECT *, case_master.id as patientid, doctors.doctor_name FROM `case_master` INNER JOIN doctors ON case_master.doctor_id=doctors.id WHERE FollowUpDate IS NOT NULL and case_master.doctor_id='$id'");
            //$count = DB::table('tbl_events')->count();
            if (DB::table('case_master')->count())
            {
                foreach ($data as $key => $value)
                {
                    $events[] = Calendar::event($value->doctor_name . "\n" . $value->FollowUpTimeSlot . "\n" . $value->patient_name,
                    false, new \DateTime($value->FollowUpDate) , new \DateTime($value->FollowUpDate . "10:30 AM") , null,
                    // Add color and link on event
                    ['color' => '#f05050', 'url' => "/followupshow/" . $value->patientid,
                    ]);
                }
            }
            $calendar = Calendar::addEvents($events);
            return view('appointment.followupappoinment', compact('doctorList', 'calendar', 'selecteddoc'));
        }
        else
        {
            return view('home');
        }
    }
    
    // show form to create new supplier.
    public function create()
    {
        return View::make('appointment.create')->with(['appointment' => $this->appointment, 'doctorlist' => $this->doctorlist, 'timeslot' => $this->timeslot]);
    }
    
    // show form to create new supplier.
    public function edit($id)
    {
        //echo "1111111111111111"; exit;
        $user = Auth::user()->id;
		
        $this->acc = $this->commonHelper->checkUserAccess("1_appointmentlist/0",Auth::user()->id, 'view_permission');
        $is_edit = $this->commonHelper->checkUserAccess("1_appointmentlist/0",Auth::user()->id, 'edit_permission');
        
        if ($this->acc == 1 || $is_edit == 1) {
            
            $appointment = appointment::findOrFail($id);
            
            //dd($appointment);
            
            $title = 'Appointment';
            $doctorList = $this
                ->doctorlist
                ->toArray();
            $hideMenu = true;
            $doctor_id = $$appointment->doctor_id;
            $timeslot = DB::select("SELECT starttime FROM `tbl_appoinment_slot` where doctor_id='$doctor_id'");
            $doctorlist11 = DB::select("SELECT * FROM `doctors`");
            

            if (env('layoutTemplate') == 'shared/layoutProspera') {
                //echo "11111111111111122222222222222222222222222222222211111111111"; exit;
                //echo __LINE__; exit;
                return view('appointment.edit_fullcalender', compact('title', 'doctorList', 'hideMenu', 'timeslot', 'doctorlist11', 'appointment'));
            } if (env('layoutTemplate') == 'shared/layoutCaremed') {
                //echo "222222222222222222"; exit;
                $hideMenu = false;
                return view('appointment.edit_fullcalenderCaremed', compact('title', 'doctorList', 'hideMenu', 'timeslot', 'doctorlist11', 'appointment'));
            }
        }
        else
        {
            $url = url()->previous();
            return redirect($url);
        }
        
    }

    // show form to create new supplier.
    public function store(Request $aptmntModel)
    {
        $validator = Validator::make($aptmntModel->all() , ['name' => 'required|max:255',
        //'email' => 'required|email',
        'mobile_no' => 'required|numeric|digits:10', 'appointment_dt' => 'required', 'doctor_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()
                ->json(['error' => $validator->errors()
                ->all() ]);
            //return redirect()->back()->withErrors($validator)->withInput();
        }
        $chkExist = appointment::where('doctor_id', $aptmntModel['doctor_id'])->whereDate('appointment_dt', $aptmntModel['appointment_dt'])->where('mobile_no', $aptmntModel['mobile_no'])->first();
        $selecteDt = $aptmntModel['appointment_dt'];
        $isAppointmentStop = DB::select("select count(1) c from appointment_stop 
                                            where 
                                            case stop_level
                                            when 1 then `date` = '" . $selecteDt . "' 
                                            when 2 then DoctorId = '" . $aptmntModel['doctor_id'] . "' 
                                            when 3 then TimeSlotId = '" . $aptmntModel['appointment_timeslot'] . "' 
                                            when 4 then `date` = '" . $selecteDt . "' and DoctorId = '" . $aptmntModel['doctor_id'] . "' 
                                            end");
        if (!is_null($chkExist) || $isAppointmentStop[0]->c > 0)
        {
            $validator->errors()
                ->add(' ', 'Appointment is Already Booked or is Closed for requested Time/Doctor/Date.');
            return response()
                ->json(['error' => $validator->errors()
                ->all() ]);
            //return redirect()->back()->withErrors($validator)->withInput();
        }
        $tokenNumber = appointment::whereDate('appointment_dt', $aptmntModel['appointment_dt'])->where('doctor_id', $aptmntModel['doctor_id'])->where('morningEvening', $aptmntModel['morningEvening'])->max('tokenNumber');
        //
        $aptmntModel['email'] = empty($aptmntModel['email']) ? ' ' : $aptmntModel['email'];
        $aptmntModel['appointment_dt'] = $aptmntModel['appointment_dt'];
        $aptmntModel['tokenNumber'] = is_null($tokenNumber) ? 1 : ($tokenNumber + 1);
        $aptmntModel['tokenNumber'] = is_null($tokenNumber) ? 1 : ($tokenNumber + 1);
        appointment::create($aptmntModel->all());
        //Send sms to doctor.
        $doc = doctor::findOrFail($aptmntModel['doctor_id']);
        $d = $doc->doctor_name;
        //$timeslot = timeslot::findOrFail($aptmntModel['appointment_timeslot']);
        $client = new HttpGuzzle;
        $mobileNoStr = array(
            $aptmntModel['mobile_no'],
            $doc->mobile_no
        );
        $mobileNoStr = implode(", ", $mobileNoStr);
        $mobileNoStr = rtrim($mobileNoStr, ' ');
        $mobileNoStr = rtrim($mobileNoStr, ',');
        // $smsStr = "Appointment request recieved successfully. ". env('SMS_From_Name', '')."\n date :". $aptmntModel['appointment_dt']."\n time :". date("H:i", time()) . " Patient Name : " . $aptmntModel['name']."\n Patient Mobile no :". $aptmntModel['mobile_no'];
        $smsStr = "Dear " . $aptmntModel['name'] . " Greetings from Dr Vidyashankar's Center for vision,  Chembur Your appointment has been confirmed with  " . $d . " on : " . $aptmntModel['appointment_dt'] . " at " . $aptmntModel['morningEvening'] . " For any queries, please contact 25293354/9819846802/9769022448";
        //$smsStr = 'Appointment request submitted for /n date :'. $aptmntModel['appointment_dt'].'/n time :'. $timeslot->name . '/n Patient Name :'. $aptmntModel['name']. '/n Mobile no :'. $aptmntModel['mobile_no'] ;
        $urlGet = str_replace(array(
            'xxxxcommaSeperatedxxxx',
            'xxxxSMSTextxxxx'
        ) , array(
            $mobileNoStr,
            $smsStr
        ) , env('SMS_URL'));
        //$urlGet = 'http://www.omdbapi.com/?t=titanic&y=1997';
        //dd($urlGet);
        $res = $client->request('GET', $urlGet);
        //dd(json_decode($res->getBody()));
        //return redirect()->back()->with('flash_message', 'Appointment successfully added!');
        return response()->json(['success' => 'Appointment created successfully.', 'tokenNumber' => $aptmntModel['tokenNumber']]);
    }
    
    public function update(Request $aptmntModel)
    {
        $validator = Validator::make($aptmntModel->all() , ['name' => 'required|max:255',
        //'email' => 'required|email',
        'mobile_no' => 'required|numeric|digits:10', 'appointment_dt' => 'required', 'doctor_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()
                ->all() ]);
            //return redirect()->back()->withErrors($validator)->withInput();
        }
        
        
        $appointment_id = $aptmntModel->appointment_id;
        
        //dd($aptmntModel->all());
        
        $chkExist = appointment::where('doctor_id', $aptmntModel['doctor_id'])->whereDate('appointment_dt', $aptmntModel['appointment_dt'])->where('mobile_no', $aptmntModel['mobile_no'])->where('id', '!=', $appointment_id)->first();
        
        //dd($chkExist);
        
        $selecteDt = $aptmntModel['appointment_dt'];
        $isAppointmentStop = DB::select("select count(1) c from appointment_stop 
                                            where 
                                            case stop_level
                                            when 1 then `date` = '" . $selecteDt . "' 
                                            when 2 then DoctorId = '" . $aptmntModel['doctor_id'] . "' 
                                            when 3 then TimeSlotId = '" . $aptmntModel['appointment_timeslot'] . "' 
                                            when 4 then `date` = '" . $selecteDt . "' and DoctorId = '" . $aptmntModel['doctor_id'] . "' 
                                            end");
        if (!is_null($chkExist) || $isAppointmentStop[0]->c > 0)
        {
            $validator->errors()
                ->add(' ', 'Appointment is Already Booked or is Closed for requested Time/Doctor/Date.');
            return response()
                ->json(['error' => $validator->errors()
                ->all() ]);
            //return redirect()->back()->withErrors($validator)->withInput();
        }
        $tokenNumber = appointment::whereDate('appointment_dt', $aptmntModel['appointment_dt'])->where('doctor_id', $aptmntModel['doctor_id'])->where('morningEvening', $aptmntModel['morningEvening'])->max('tokenNumber');
        //
        $aptmntModel['email'] = empty($aptmntModel['email']) ? ' ' : $aptmntModel['email'];
        $aptmntModel['appointment_dt'] = $aptmntModel['appointment_dt'];
        //$aptmntModel['tokenNumber'] = is_null($tokenNumber) ? 1 : ($tokenNumber + 1);
        //$aptmntModel['tokenNumber'] = is_null($tokenNumber) ? 1 : ($tokenNumber + 1);
        
        
       
        unset($aptmntModel['appointment_id']);
        unset($aptmntModel['_token']);
        
         //dd($aptmntModel);
        
        //appointment::create($aptmntModel->all());
        
        appointment::where('id', $appointment_id)->update($aptmntModel->all());
        
         //====================== Start commented to avoid sending message while testing=================================
         //
        
        
         /*
        //Send sms to doctor.
        $doc = doctor::findOrFail($aptmntModel['doctor_id']);
        $d = $doc->doctor_name;
        //$timeslot = timeslot::findOrFail($aptmntModel['appointment_timeslot']);
        $client = new HttpGuzzle;
        $mobileNoStr = array(
            $aptmntModel['mobile_no'],
            $doc->mobile_no
        );
        $mobileNoStr = implode(", ", $mobileNoStr);
        $mobileNoStr = rtrim($mobileNoStr, ' ');
        $mobileNoStr = rtrim($mobileNoStr, ',');
        
        $smsStr = "Dear " . $aptmntModel['name'] . " Greetings from Dr Vidyashankar's Center for vision,  Chembur Your appointment has been confirmed with  " . $d . " on : " . $aptmntModel['appointment_dt'] . " at " . $aptmntModel['morningEvening'] . " For any queries, please contact 25293354/9819846802/9769022448";
        
        $urlGet = str_replace(array(
            'xxxxcommaSeperatedxxxx',
            'xxxxSMSTextxxxx'
        ) , array(
            $mobileNoStr,
            $smsStr
        ) , env('SMS_URL'));
        //$urlGet = 'http://www.omdbapi.com/?t=titanic&y=1997';
        //dd($urlGet);
        $res = $client->request('GET', $urlGet);
        */
        
        //======================end commented to avoid sending message while testing=================================
        
        //dd(json_decode($res->getBody()));
        //return redirect()->back()->with('flash_message', 'Appointment successfully added!');
        return response()->json(['success' => 'Appointment updated successfully.', 'tokenNumber' => $aptmntModel['tokenNumber']]);
    }

    public function grid(Request $request, $MorningEvening, $id)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];
        $select = "SELECT a.id,a.name as `patientName`, b.doctor_name,a.mobile_no, a.appointment_dt,a.morningEvening,a.isAccepted ";
        $presql = " FROM appointments a
        LEFT JOIN doctors b on a.doctor_id = b.id
        WHERE  a.doctor_id='$id' AND (isAccepted =1 OR isAccepted IS NULL) ";
        if ($_GET['search']['value'])
        {
            $presql .= " and a.patient_name LIKE '%" . $_GET['search']['value'] . "%' ";
        }
        // $presql .= " and a.morningEvening = '". $MorningEvening. "' ";
        if ($_GET['columns'][1]['search']['value'])
        {
            $presql .= " and b.doctor_name LIKE '%" . $_GET['columns'][1]['search']['value'] . "%' ";
        }
        if ($_GET['columns'][2]['search']['value'])
        {
            $presql .= " and a.patient_name LIKE '%" . $_GET['columns'][2]['search']['value'] . "%' ";
        }
        if ($_GET['columns'][2]['search']['value'])
        {
            $presql .= " and a.patient_name LIKE '%" . $_GET['columns'][2]['search']['value'] . "%' ";
        }
        if ($_GET['columns'][3]['search']['value'])
        {
            $toDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][3]['search']['value'])->format('Y-m-d');
            $presql .= " and a.FollowUpDate = '" . $toDate . "' ";
        }
        $orderByStr = " order by a.FollowUpDate desc";
        //$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;
        if (isset($_GET['order'][0]['column']) && is_numeric($_GET['order'][0]['column']))
        {
            $orderColum = intval($_GET['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_GET['order'][0]['dir'];
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
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }

    public function grid1(Request $request, $MorningEvening, $id)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];
        $select = "SELECT a.id,a.patient_name as `patientName`, b.doctor_name,a.patient_mobile, a.FollowUpDate,a.visit_time ";
        $presql = " FROM case_master  a
        LEFT JOIN doctors b on a.doctor_id = b.id
      WHERE 1=1 and a.is_deleted = 0 AND FollowUpDate IS NOT NULL and a.doctor_id='$id'";
        if ($_GET['search']['value'])
        {
            $presql .= " and a.patient_name LIKE '%" . $_GET['search']['value'] . "%' ";
        }
        // $presql .= " and a.morningEvening = '". $MorningEvening. "' ";
        if ($_GET['columns'][1]['search']['value'])
        {
            $presql .= " and b.doctor_name LIKE '%" . $_GET['columns'][1]['search']['value'] . "%' ";
        }
        if ($_GET['columns'][2]['search']['value'])
        {
            $presql .= " and a.patient_name LIKE '%" . $_GET['columns'][2]['search']['value'] . "%' ";
        }
        if ($_GET['columns'][2]['search']['value'])
        {
            $presql .= " and a.patient_name LIKE '%" . $_GET['columns'][2]['search']['value'] . "%' ";
        }
        if ($_GET['columns'][3]['search']['value'])
        {
            $toDate = Carbon::createFromFormat('d/M/Y', $_GET['columns'][3]['search']['value'])->format('Y-m-d');
            $presql .= " and a.FollowUpDate = '" . $toDate . "' ";
        }
        $orderByStr = " order by a.FollowUpDate desc";
        //$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;
        if (isset($_GET['order'][0]['column']) && is_numeric($_GET['order'][0]['column']))
        {
            $orderColum = intval($_GET['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_GET['order'][0]['dir'];
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
        $ret['draw'] = $_GET['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }

    //store newly created resource in store.
    public function show($id)
    {
        $user = Auth::user()->id;
		/*
        $accesslevel = DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='appointment/acceptdeny'");
        foreach ($accesslevel as $value)
        {
            $this->acc = $value->accesslevel;
        }
        if ($this->acc == 1)
        {
			*/
		$this->acc = $this->commonHelper->checkUserAccess("1_appointmentlist/0",Auth::user()->id, 'view_permission');
		$is_edit = $this->commonHelper->checkUserAccess("1_appointmentlist/0",Auth::user()->id, 'edit_permission');
        if ($this->acc == 1 || $is_edit == 1) {
            $appointment = appointment::findOrFail($id);
            $model = ['doctorlist' => $this->doctorlist, 'timeslot' => $this
                ->timeslot] + $appointment->toArray();
            return view('appointment.show', ['model' => $model]);
        }
        else
        {
            $url = url()->previous();
            return redirect($url);
        }
    }

    public function followupshow($id)
    {
        $user = Auth::user()->id;
        $accesslevel = DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='followupacceptdenyappointment'");
        foreach ($accesslevel as $value)
        {
            $this->acc = $value->accesslevel;
        }
        if ($this->acc == 1)
        {
            $appointment = case_master::findOrFail($id);
            $model = ['doctorlist' => $this->doctorlist, 'timeslot' => $this
                ->timeslot] + $appointment->toArray();
            return view('appointment.followupacceptdenyshow', ['model' => $model]);
        }
        else
        {
            $url = url()->previous();
            return redirect($url);
        }
    }

    public function show2($AppointmentId)
    {
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')
            ->pluck('doctor_name', 'id');
        //var_dump(DB::getQueryLog());
        if (!empty($AppointmentId) && $AppointmentId > 0)
        {
            $appDetails = case_master::find($AppointmentId); //->first();
            //var_dump(DB::getQueryLog());
            //$doctor_id = $appDetails->doctor_id;
            $case_details = case_master::where('patient_name', $appDetails->name)
                ->orwhere('patient_mobile', $appDetails->mobile_no)
                ->first();
        }
        if (empty($AppointmentId) || $AppointmentId == 0)
        {
            $appDetails = new appointment();
            $case_details = new case_master();
        }
        if (!empty($case_details) && is_null($case_details))
        {
            $case_details->visit_time = Carbon::now()
                ->format('H:i');
        }
        //var_dump(DB::getQueryLog());
        return View('appointment.followuppatient', compact('doctorlist', 'appDetails', 'case_details'));
    }

    #region
    public function OnlineViewAppCalendar()
    {
        $calendar = Calendar::setOptions([ //set fullcalendar options
        'firstDay' => 1])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
        'dayClick' => 'dayClickEvent']);
        if (env('layoutTemplate') == 'shared/layoutProspera')
        {
            return view('appointment.fullcalender', compact('calendar'));
        }
        if (env('layoutTemplate') == 'shared/layoutCaremed')
        {
            return view('appointment.fullcalenderCaremed', compact('calendar'));
        }
    }

    public function OlCreateApp()
    {
        return View::make('appointment.create')
            ->with(['appointment' => $this->appointment, 'doctorlist' => $this->doctorlist, 'timeslot' => $this->timeslot]);
    }

    #endregion
    public function acceptdeny_post(Request $request)
    {
        $id = $request->id;
        $appointment = appointment::findOrFail($request->id);
        if (is_null($appointment))
        {
            return redirect()->back()
                ->withInput()
                ->withErrors(array(
                'message' => 'Appointment not found.'
            ));
        }
        $acceptedRejected = '';
        $acceptrejectComment = empty($request['AcceptDenyComment']) ? '' : '/n Comment :' . $request['AcceptDenyComment'];
        if (Input::get('Accept_Appointment'))
        {
            // $appointment->isAccepted = 1;
            $acceptedRejected = 1;
            $appointment->name = $request->name;
            $appointment->mobile_no = $request->mobile_no;
            $appointment->email = $request->email;
            $appointment->appointment_subject = $request->appointment_subject;
            $appointment->AcceptDenyComment = $request->AcceptDenyComment;
            $appointment->isAccepted = $acceptedRejected;
            //return $appointment;
            $appointment->save();
            $doc = doctor::findOrFail($request['doctor_id']);
            $client = new HttpGuzzle;
            $mobileNoStr = array(
                $request['mobile_no'],
                $doc->mobile_no
            );
            $mobileNoStr = implode(", ", $mobileNoStr);
            $mobileNoStr = rtrim($mobileNoStr, ' ');
            $mobileNoStr = rtrim($mobileNoStr, ',');
            $break = "\n";
            $dr = $doc->doctor_name;
            // $smsStr = "Dear Patient ". $request['name']. $break.' : Greeting From Dr. Vidya Shankar Your appointment is confirmed with '. $dr.' on '. $request['appointment_dt'].' '.$request['appointment_dt'].' and '.$request['morningEvening'].' for any queries call 022125293354';
            // $urlGet = str_replace(array('xxxxcommaSeperatedxxxx','xxxxSMSTextxxxx'), array($mobileNoStr, $smsStr), env('SMS_URL'));
            // $res = $client->request('GET', $urlGet);
            // return $dr;
        }
        if (Input::get('Deny_Appointment'))
        {
            // $appointment->isAccepted = 0;
            $acceptedRejected = 0;
            //return $acceptedRejected;
            $appointment->name = $request->name;
            $appointment->mobile_no = $request->mobile_no;
            $appointment->email = $request->email;
            $appointment->appointment_subject = $request->appointment_subject;
            $appointment->AcceptDenyComment = $request->AcceptDenyComment;
            $appointment->isAccepted = $acceptedRejected;
            //return $appointment;
            $appointment->save();
            $doc = doctor::findOrFail($request['doctor_id']);
            $client = new HttpGuzzle;
            $mobileNoStr = array(
                $request['mobile_no'],
                $doc->mobile_no
            );
            $mobileNoStr = implode(", ", $mobileNoStr);
            $mobileNoStr = rtrim($mobileNoStr, ' ');
            $mobileNoStr = rtrim($mobileNoStr, ',');
            $break = "\n";
            $doc = doctor::findOrFail($request['doctor_id']);
            $smsStr = 'Appointment denied for date :' . $request['appointment_dt'] . ':  Time :' . $request['morningEvening'] . $break . 'Patient Name: ' . $request['name'] . ' Mobile no  :' . $request['mobile_no'] . ' due to ' . $request['AcceptDenyComment'];
            $urlGet = str_replace(array(
                'xxxxcommaSeperatedxxxx',
                'xxxxSMSTextxxxx'
            ) , array(
                $mobileNoStr,
                $smsStr
            ) , env('SMS_URL'));
            $res = $client->request('GET', $urlGet);
        }
        //        $doc = doctor::findOrFail($request['doctor_id']);
        //        #$timeslot = timeslot::findOrFail($request['appointment_timeslot']);
        //        $client = new HttpGuzzle;
        //        $mobileNoStr = array($request['mobile_no'], $doc->mobile_no);
        //        $mobileNoStr = implode (", ", $mobileNoStr);
        //        $mobileNoStr = rtrim($mobileNoStr, ' ');
        //        $mobileNoStr = rtrim($mobileNoStr, ',');
        //        $break="\n";
        // $smsStr = 'Appointment request recieved for  date :'. $request['appointment_dt']. $break.' : Time :'. $request['morningEvening']. $break. 'Patient Name:'. $request['name']. $break.' Mobile no :'. $request['mobile_no'];
        //        $urlGet = str_replace(array('xxxxcommaSeperatedxxxx','xxxxSMSTextxxxx'), array($mobileNoStr, $smsStr), env('SMS_URL'));
        //        $res = $client->request('GET', $urlGet);
        //        \LogActivity::addToLog('Message send successfully');
        return redirect('/admin/')->with('flash_message', 'Appointment Rejected  successfully.');
    }

    public function followupacceptdeny_post(Request $request)
    {
        // return "in followupacceptdeny_post";
        $id = $request->id;
        $appointment = appointment::findOrFail($request->id);
        if (is_null($appointment))
        {
            return redirect()->back()
                ->withInput()
                ->withErrors(array(
                'message' => 'Appointment not found.'
            ));
        }
        $acceptedRejected = '';
        $acceptrejectComment = empty($request['AcceptDenyComment']) ? '' : '/n Comment :' . $request['AcceptDenyComment'];
        if (Input::get('Accept_Appointment'))
        {
            // $appointment->isAccepted = 1;
            $acceptedRejected = 1;
            $appointment->name = $request->name;
            $appointment->mobile_no = $request->mobile_no;
            $appointment->email = $request->email;
            $appointment->appointment_subject = $request->appointment_subject;
            $appointment->AcceptDenyComment = $request->AcceptDenyComment;
            $appointment->isAccepted = $acceptedRejected;
            //return $appointment;
            $appointment->save();
        }
        if (Input::get('Deny_Appointment'))
        {
            // $appointment->isAccepted = 0;
            $acceptedRejected = 0;
            //return $acceptedRejected;
            $appointment->name = $request->name;
            $appointment->mobile_no = $request->mobile_no;
            $appointment->email = $request->email;
            $appointment->appointment_subject = $request->appointment_subject;
            $appointment->AcceptDenyComment = $request->AcceptDenyComment;
            $appointment->isAccepted = $acceptedRejected;
            //return $appointment;
            $appointment->save();
        }
        $doc = doctor::findOrFail($request['doctor_id']);
        $doctorname = $doc->doctor_name;
        #$timeslot = timeslot::findOrFail($request['appointment_timeslot']);
        $client = new HttpGuzzle;
        $mobileNoStr = array(
            $request['mobile_no'],
            $doc->mobile_no
        );
        $mobileNoStr = implode(", ", $mobileNoStr);
        $mobileNoStr = rtrim($mobileNoStr, ' ');
        $mobileNoStr = rtrim($mobileNoStr, ',');
        $break = "\n";
        $smsStr = 'Appointment denied for date :' . $request['appointment_dt'] . ':  Time :' . $request['morningEvening'] . $break . 'Patient Name: ' . $request['name'] . ' Mobile no  :' . $request['mobile_no'] . ' due to ' . $request['AcceptDenyComment'];
        //$smsStr = 'Dear '. $request['name']. $break.'you have an appointment with '. $doctorname. ' at'. $request['name'].' tomorrow @ :'. $request['FollowUpTimeSlot']. $break.'Have a nice day !';
        // return  $smsStr;
        $urlGet = str_replace(array(
            'xxxxcommaSeperatedxxxx',
            'xxxxSMSTextxxxx'
        ) , array(
            $mobileNoStr,
            $smsStr
        ) , env('SMS_URL'));
        $res = $client->request('GET', $urlGet);
        //return redirect('/aptpatientDetails/0')->with('flash_message', 'Message send successfully.');
        return redirect('/admin/')->with('flash_message', 'Appointment Rejected  successfully.');
    }

    public function doctordata($doctor_id)
    {
        $data = DB::select("SELECT doctors.doctor_name, name,morningEvening,appointment_dt FROM `appointments` INNER JOIN doctors ON appointments.doctor_id=doctors.id WHERE appointments.doctor_id='$doctor_id'");
        echo json_encode($data);
    }

    public function avaibaleTimeSlot($doctor_id, $appointment_dt, Request $request)
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
                {
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
}
