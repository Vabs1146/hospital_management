<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\doctor;
use App\timeslot;
use App\Stop_appointment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Helpers\Helpers;
use DB;
use App\helperClass\CommonHelper;

class Stop_appointmentsController extends AdminRootController
{


      public function __construct()
    {
        $this->acc=0;
         $this->commonHelper = new CommonHelper();
    }

    public function index(Request $request)
    {
         $id = Auth::user()->id;
		/*
        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='stop_appointments'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("stop_appointments",Auth::user()->id);
        if ($this->acc == 1) {
		*/
        $this->acc = $this->commonHelper->checkUserAccess("1_stop_appointments",Auth::user()->id);
        if ($this->acc == 1) {
             return view('stop_appointments.index', []);
        }

         else
        {
            return view('home');
        }
       
    }

    public function create(Request $request)
    {

           $id = Auth::user()->id;
	/*
         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='stop_appointments/create'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
                   $this->acc = $this->commonHelper->checkUserAccess("stop_appointments/create",Auth::user()->id);
        if ($this->acc == 1) {
			*/
        $this->acc = $this->commonHelper->checkUserAccess("1_stop_appointments",Auth::user()->id, 'add_permission');
        if ($this->acc == 1) {
        $model = [
            'doctorlst' =>  doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id'),
            'timeslotlst' =>  timeslot::where('isActive', 1)->orderBy('id')->pluck('name', 'id'),
            'stop_levelLst' =>  ['1'=>'Date', '2'=>'Doctor','3'=>'Time Slot', '4'=>'Date Doctor Time']
        ] + ['id'=> '', 'DoctorId'=>'', 'TimeSlotId'=>'','stop_level'=>''];
        return view('stop_appointments.add', ['model'=>$model]);
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
		/*
         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='stop_appointments/edit'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
                     $this->acc = $this->commonHelper->checkUserAccess("stop_appointments/edit",Auth::user()->id);
        if ($this->acc == 1) {
				*/
        $this->acc = $this->commonHelper->checkUserAccess("1_stop_appointments",Auth::user()->id, 'edit_permission');
        if ($this->acc == 1) {
                          $stop_appointment =
        [
             'doctorlst' =>  doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id'),
             'timeslotlst' =>  timeslot::where('isActive', 1)->orderBy('id')->pluck('name', 'id'),
             'stop_levelLst' =>  ['1'=>'Date', '2'=>'Doctor','3'=>'Time Slot', '4'=>'Date Doctor Time']
        ]+Stop_appointment::findOrFail($id)->toArray();

        return view('stop_appointments.add', ['model' => $stop_appointment]);
                    }
                      else
                        {
            $url= url()->previous();
           return redirect($url);
                        }

      
    }

    public function show(Request $request, $id)
    {
        $stop_appointment = Stop_appointment::findOrFail($id);
        return view('stop_appointments.show', [
            'model' => $stop_appointment        ]);
    }

    public function grid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT a.id, `date`, b.doctor_name, c.name, a.description, 1, 2";
        $presql = " FROM appointment_stop a 
					left join doctors b on a.DoctorId = b.id
					left join timeslots c on a.TimeSlotId = c.id";
        
        if ($_GET['search']['value']) {
            $presql .= " WHERE date LIKE '%".$_GET['search']['value']."%' ";
        }
        
        $presql .= "  ";

        $orderByStr = "";
        $orderColum = (isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;
        if ($orderColum > 0) {
            $orderByStr = " order by ". $orderColum . " " . $_GET['order'][0]['dir'];
        }


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


    public function update(Request $request)
    {
        //
        $this->validate($request, [
            'stop_level' => 'required',
			'date' => 'required_without_all:DoctorId,TimeSlotId',
            'DoctorId' => 'required_without_all:date,TimeSlotId',
            'TimeSlotId' => 'required_without_all:date,DoctorId'
        ]);
        $stop_appointment = null;
        if ($request->id > 0) {
            $stop_appointment = Stop_appointment::findOrFail($request->id);
        } else {
            $stop_appointment = new Stop_appointment;
        }
        

                //return $request->description;
                $stop_appointment->id = $request->id?:0;
                $stop_appointment->date = $request->date;
                $stop_appointment->DoctorId = $request->DoctorId;
                $stop_appointment->TimeSlotId = $request->TimeSlotId;
                $stop_appointment->description = $request->description;
                $stop_appointment->stop_level = is_numeric($request->stop_level)?$request->stop_level : 0 ;
        
                //$stop_appointment->user_id = $request->user()->id;
        $stop_appointment->save();
         //\LogActivity::addToLog('Stopped Appointment Data successfully added/updated!');

        return redirect('/stop_appointments')->with('flash_message', 'Data successfully added/updated!');
        ;
    }

    public function store(Request $request)
    {
        return $this->update($request);
    }

    public function destroy(Request $request, $id)
    {
        
        $stop_appointment = Stop_appointment::findOrFail($id);

        $stop_appointment->delete();
        return "OK";
       // \LogActivity::addToLog('Stopped Appointment Data successfully deleted!');
    }
}
