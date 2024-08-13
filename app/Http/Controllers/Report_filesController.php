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


use App\Report_file;
use App\Case_master;
use Auth;
use App\Helpers\Helpers;
use DB;
use Storage;
use App\helperClass\CommonHelper;

class Report_filesController extends AdminRootController
{

public function __construct()
    {
        $this->acc=0;
        $this->commonHelper = new CommonHelper();
    }

    public function index(Request $request)
    {
        return view('report_files.index', []);
    }

    public function create(Request $request)
    {
        return view('report_files.add', [
            []
        ]);
    }

    public function edit(Request $request, $id)
    {   
         $user = Auth::user()->id;

        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='report_files/edit'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("2_report_files",Auth::user()->id);
        if ($this->acc == 1) {
        $Case_master = Case_master::findOrFail($id);
        return view('report_files.add', ['model' => $this->report_data($Case_master)]);
    }
    else
        {
       
         $url= url()->previous();
           return redirect($url);
        }
    }

    public function report_data(Case_master $Case_master)
    {
        $DateWiseRecordLst = Case_master::where('case_number', $Case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        return  ['case_master' => $Case_master, 'DateWiseRecordLst' => $DateWiseRecordLst,  'Report_file' => $Case_master->Report_file()->get(), 'report_description'=>'', 'uploaded_file'=>'' ];
    }

    public function show(Request $request, $id)
    {
        $report_file = Report_file::findOrFail($id);
        return view('report_files.show', [
            'model' => $report_file     ]);
    }

    public function grid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT *,1,2 ";
        $presql = " FROM report_file a ";
        if ($_GET['search']['value']) {
            $presql .= " WHERE case_number LIKE '%".$_GET['search']['value']."%' ";
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

        echo json_encode($ret);
    }


    public function update(Request $request)
    {
        //
        $case_gen = Case_master::where('case_number', $request['case_number'])->first();
        if (is_null($case_gen)) {
            return redirect()->back()->withInput()->withErrors(array('message' => 'No patient found.'));
        }
        //check which submit was clicked on
        if (Input::get('report_add')) {
            return  $this->save_report($request, $case_gen); //if login then use this method
        }
        if (Input::get('report_delete')) {
            return  $this->delete_report($request, $case_gen); //if register then use this method
        }
        if (Input::get('report_view_file')) {
            return $this->report_view_file($request, $case_gen); //if register then use this method
        }
    }

    public function save_report(Request $request, Case_master $case_master)
    {

        $this->validate($request, [
            'case_number' => 'required',
            'uploaded_file' => 'required_without:report_description',
            'report_description' => 'required_without:uploaded_file',
        ]);

        $req_report_file = new Report_file;
        $req_report_file->case_number = $case_master->case_number;
        $req_report_file->report_description = $request['report_description'];
        $req_report_file->report_title = $request['report_title'];
        if ($request->hasFile('uploaded_file')) {
            $req_report_file->file_path = $request->file('uploaded_file')->store('uploads');
        }
        $req_report_file->created_at = Carbon::now();
        $req_report_file->updated_at = Carbon::now();
        $req_report_file->case_id = $request['case_id'];
        $req_report_file->save();
         // \LogActivity::addToLog('Report file added/updated successfully');
        return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
    }

    public function delete_report(Request $request, Case_master $case_master)
    {
        $reportFile = Report_file::findOrFail($request['report_delete']);
        if ($reportFile === null) {
            return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
        }

        if (!empty($reportFile->file_path)) {
           // return 1;
            Storage::Delete($reportFile->file_path);
        }
        $reportFile->delete();


          // \LogActivity::addToLog('Report file deleted successfully');
        return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
     
    }

    public function store(Request $request)
    {
        return $this->update($request);
    }

    public function destroy(Request $request, $id)
    {
        
        $report_file = Report_file::findOrFail($id);

        $report_file->delete();
        return "OK";
    }
    
     public function report_view_file(Request $request, Case_master $case_master)
    {
        $reportFile = Report_file::findOrFail($request['report_view_file']);
        
        //dd($reportFile);
        return view('report_files.view_file', ['reportFile' => $reportFile]);
     
    }
}
