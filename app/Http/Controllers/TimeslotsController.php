<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Timeslot;

use DB;

class TimeslotsController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index(Request $request)
	{
	    return view('timeslots.index', []);
	}

	public function create(Request $request)
	{
	    return view('timeslots.add', [
	        []
	    ]);
	}

	public function edit(Request $request, $id)
	{
		$timeslot = Timeslot::findOrFail($id);
	    return view('timeslots.add', [
	        'model' => $timeslot	    ]);
	}

	public function show(Request $request, $id)
	{
		$timeslot = Timeslot::findOrFail($id);
	    return view('timeslots.show', [
	        'model' => $timeslot	    ]);
	}

	public function grid(Request $request)
	{
		$len = $_GET['length'];
		$start = $_GET['start'];

		$select = "SELECT *,1,2 ";
		$presql = " FROM timeslots a ";
		if($_GET['search']['value']) {	
			$presql .= " WHERE name LIKE '%".$_GET['search']['value']."%'";
		}
		
		$presql .= "  ";

		$sql = $select.$presql." LIMIT ".$start.",".$len;


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
		//$ret['sqlQuery'] = $sql;
		echo json_encode($ret);
	}


	public function update(Request $request) {
	    //
	    /*$this->validate($request, [
	        'name' => 'required|max:255',
	    ]);*/
		$timeslot = null;
		if($request->id > 0) { $timeslot = Timeslot::findOrFail($request->id); }
		else { 
			$timeslot = new Timeslot;
		}
	    

	    		
			    $timeslot->id = $request->id?:0;
				
	    		
					    $timeslot->name = $request->name;
		
	    		
					    $timeslot->isActive = $request->isActive;
		
	    		
					    $timeslot->created_dt = $request->created_dt;
		
	    		
					    $timeslot->update_dt = $request->update_dt;
		
	    	    //$timeslot->user_id = $request->user()->id;
	    $timeslot->save();

	    return redirect('/timeslots');

	}

	public function store(Request $request)
	{
		return $this->update($request);
	}

	public function destroy(Request $request, $id) {
		
		$timeslot = Timeslot::findOrFail($id);

		$timeslot->delete();
		return "OK";
	    
	}

	
}