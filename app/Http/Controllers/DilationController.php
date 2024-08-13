<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use DB;
use App\Case_master;
use Flash;
use DateTime;

class DilationController extends Controller
{
    public function dilation(Request $request) {
		$user = Auth::user()->id;
		$case_details = case_master::get();
		
		//dd($case_details);
		$dilations = DB::table('dilations')->leftjoin('case_master', 'case_master.id', 'dilations.case_id')->select('case_master.*', 'dilations.id as dilation_id', 'dilations.date as dilation_date', 'dilations.start_time', 'dilations.end_time')->where('dilations.is_acknowledged', '0')->get();

		//dd($dilations);

		return View('dilations.dilation', compact('case_details', 'dilations'));
	}

	public function addNewDilation(Request $request) {
		//dd($request->all());
		
		$start_time = ($request->start_time) ?: date('H:i', strtotime('now'));

		$start_date_time = date('Y-m-d') ." ". $start_time;
		$end_time = date('H:i',strtotime('+20 minutes',strtotime($start_date_time)));
		
		$insert_data = array(
			'case_id' => $request->case_id,
			'date'    => date('Y-m-d'),
			'start_time' => $start_time,
			'end_time' => $end_time,
			'duration' => '20 minutes',
			'created_at' => date('Y-m-d h:i:s', strtotime('now')),
			'created_by' => Auth::user()->id		
		);
		//dd($insert_data);
		DB::table('dilations')->insert($insert_data);

		return redirect()->back()->with('flash_message', 'Record added successfully');
	}

	public function updateDilationStatus(Request $request) {
		$update_data = array(	
			'updated_at' => date('Y-m-d h:i:s', strtotime('now')),
			'updated_by' => Auth::user()->id	
		);
		if($request->action == "acknowledged") {
			$update_data['is_acknowledged'] = '1';
			DB::table('dilations')->where('id', $request->id)->update($update_data);
		}
	}
	
	//Ajax functionality
	public function getDilations_bk(Request $request) {
		//$dilations = DB::table('dilations')->leftjoin('case_master', 'case_master.id', 'dilations.case_id')->select('case_master.*', 'dilations.id as dilation_id', 'dilations.date as dilation_date', 'dilations.start_time', 'dilations.end_time', DB::RAW('TIMESTAMP(dilations.date, dilations.start_time) as dilation_timestamp'))->where('dilations.is_acknowledged', '0')->get();

		//$dilations = DB::table('dilations')->leftjoin('case_master', 'case_master.id', 'dilations.case_id')->select('case_master.*', 'dilations.id as dilation_id', 'dilations.date as dilation_date', 'dilations.start_time', 'dilations.end_time', DB::RAW('TIMEDIFF(NOW(), TIMESTAMP(dilations.date, dilations.start_time)) as dilation_timestamp'))->where('dilations.is_acknowledged', '0')->get();

		//$dilations = DB::table('dilations')->leftjoin('case_master', 'case_master.id', 'dilations.case_id')->select('case_master.*', 'dilations.id as dilation_id', 'dilations.date as dilation_date', 'dilations.start_time', 'dilations.end_time', DB::RAW('TIMEDIFF(NOW(), TIMESTAMP(dilations.date, dilations.start_time)) as dilation_timestamp'))->where('dilations.is_acknowledged', '0')->whereRaw('TIMESTAMP(dilations.date, dilations.start_time) > DATE_SUB(NOW(), INTERVAL 15 MINUTE)')->get();

		//$dilations = DB::table('dilations')->leftjoin('case_master', 'case_master.id', 'dilations.case_id')->select('case_master.*', 'dilations.id as dilation_id', 'dilations.date as dilation_date', 'dilations.start_time', 'dilations.end_time', DB::RAW('TIMEDIFF(NOW(), TIMESTAMP(dilations.date, dilations.start_time)) as dilation_timestamp'), DB::RAW('HOUR(TIMEDIFF(NOW(), TIMESTAMP(dilations.date, dilations.start_time))) as dilation_hours'), DB::RAW('MINUTE(TIMEDIFF(NOW(), TIMESTAMP(dilations.date, dilations.start_time))) as dilation_minutes'))->where('dilations.is_acknowledged', '0')->get();

		$dilations = DB::table('dilations')->leftjoin('case_master', 'case_master.id', 'dilations.case_id')->select('case_master.*', 'dilations.id as dilation_id', 'dilations.date as dilation_date', 'dilations.start_time', 'dilations.end_time', DB::RAW('TIMEDIFF(NOW(), TIMESTAMP(dilations.date, dilations.start_time)) as dilation_timestamp'), DB::RAW('HOUR(TIMEDIFF(NOW(), TIMESTAMP(dilations.date, dilations.start_time))) as dilation_hours'), DB::RAW('MINUTE(TIMEDIFF(NOW(), TIMESTAMP(dilations.date, dilations.start_time))) as dilation_minutes'))->where('dilations.is_acknowledged', '0')->get();


		$records = [];
		foreach($dilations as $key => $dilations_row) {
			$records[$key]['patient_name'] = $dilations_row->patient_name; 
			$records[$key]['dilation_date'] = $dilations_row->dilation_date; 
			$records[$key]['start_time'] = $dilations_row->start_time; 
			$records[$key]['end_time'] = $dilations_row->end_time; 
			$records[$key]['dilation_timestamp'] = $dilations_row->dilation_timestamp; 
			$records[$key]['dilation_hours'] = $dilations_row->dilation_hours; 
			$records[$key]['dilation_minutes'] = $dilations_row->dilation_minutes; 
			
			$concated_end_datetime = $dilations_row->dilation_date.' '.$dilations_row->end_time;
			$concated_start_datetime = $dilations_row->dilation_date.' '.$dilations_row->start_time;

			$current = new DateTime();
			$time_remaining = $current->diff(new DateTime($concated_end_datetime));

			//$records[$key]['dilation_remaining'] = '<div style="border:1px solid; padding:5px 10px; margin-right:20px; width:fit-content; display:inline-block;" data-patient_name="'.$dilations_row->patient_name.'" data-end_time="'.date('M j, Y G:i:s' , strtotime($concated_end_datetime)).'" class="remaining-timer"><label>'. $dilations_row->patient_name.'<label> : '.$time_remaining->i.':'.$time_remaining->s.'</div>';

			$records[$key]['dilation_remaining'] = '<div class="dilation-item dilations_tr dilation-about-to-complete " style="" ><label>'. $dilations_row->patient_name.'</label> : <div style="" data-patient_name="'.$dilations_row->patient_name.'" data-end_time="'.date('M j, Y G:i:s' , strtotime($concated_end_datetime)).'" class="remaining-timer dilation-item-timer">'.$time_remaining->i.':'.$time_remaining->s.'</div><a style="display:none;" class="dismiss-notification" href="javascript:void(0)" data-id="'.$dilations_row->dilation_id.'"><i class="fas fa-times"></i></a></div>';
		}
		//dd($records);
		echo json_encode($records);
	}
        
        
        //Ajax functionality
	public function getDilations(Request $request) {
		$dilations = DB::table('dilations')->leftjoin('case_master', 'case_master.id', 'dilations.case_id')->select('case_master.*', 'dilations.id as dilation_id', 'dilations.date as dilation_date', 'dilations.start_time', 'dilations.end_time', DB::RAW('TIMEDIFF(NOW(), TIMESTAMP(dilations.date, dilations.start_time)) as dilation_timestamp'), DB::RAW('HOUR(TIMEDIFF(NOW(), TIMESTAMP(dilations.date, dilations.start_time))) as dilation_hours'), DB::RAW('MINUTE(TIMEDIFF(NOW(), TIMESTAMP(dilations.date, dilations.start_time))) as dilation_minutes'))->where('dilations.is_acknowledged', '0')->get();
                
                //dd($dilations);


		$records = [];
		foreach($dilations as $key => $dilations_row) {
			$records[$key]['patient_name'] = $dilations_row->patient_name; 
			$records[$key]['dilation_date'] = $dilations_row->dilation_date; 
			$records[$key]['start_time'] = $dilations_row->start_time; 
			$records[$key]['end_time'] = $dilations_row->end_time; 
			$records[$key]['dilation_timestamp'] = $dilations_row->dilation_timestamp; 
			$records[$key]['dilation_hours'] = $dilations_row->dilation_hours; 
			$records[$key]['dilation_minutes'] = $dilations_row->dilation_minutes; 
			
			$concated_end_datetime = $dilations_row->dilation_date.' '.$dilations_row->end_time;
			$concated_start_datetime = $dilations_row->dilation_date.' '.$dilations_row->start_time;

			$current = new DateTime();
			$time_remaining = $current->diff(new DateTime($concated_end_datetime));

			$records[$key]['dilation_remaining'] = '<div class="dilation-item dilations_tr dilation-about-to-complete " style="" ><label>'. $dilations_row->patient_name.'</label> : <div style="" data-patient_name="'.$dilations_row->patient_name.'" data-end_time="'.date('M j, Y G:i:s' , strtotime($concated_end_datetime)).'" class="remaining-timer dilation-item-timer">'.$time_remaining->i.':'.$time_remaining->s.'</div><a style="display:none;" class="dismiss-notification" href="javascript:void(0)" data-id="'.$dilations_row->dilation_id.'"><i class="fas fa-times"></i></a></div>';
		}
		//dd($records);
		echo json_encode($records);
	}
}
