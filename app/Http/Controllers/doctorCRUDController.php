<?php
namespace App\Http\Controllers;

use App\doctor;
use App\DoctorCharges;
use App\FeesDetails;
use App\doctor_form_mapping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Helpers\Helpers;
use App\helperClass\CommonHelper;
use App\Procedures;
use Storage;

class doctorCRUDController extends AdminRootController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->acc = 0;
        $this->commonHelper = new CommonHelper();
    }
    public function index(Request $request)
    {
        $this->acc = $this->commonHelper->checkUserAccess("2_admin/doctor/create",Auth::user()->id);
        if ($this->acc == 1) {
            $pageSize = 15;
            $doctors = doctor::orderBy('id', 'DESC')->paginate($pageSize);
            //$doctorFormView = doctor_form_mapping::pluck('displayText', 'formViewName');
            return view('doctorCRUD.index', compact('doctors'))->with('i', ($request->input('page', 1) - 1) * $pageSize);
        } else {
            return view('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->acc = $this->commonHelper->checkUserAccess("2_admin/doctor/create",Auth::user()->id, 'add_permission');
        if ($this->acc == 1) {
            $doctor = new doctor();
            $doctor->isActive = 0;
            $doctorFormView = doctor_form_mapping::pluck('displayText', 'formViewName');
            $procedures = Procedures::all();
            return view('doctorCRUD.create', compact('doctor', 'doctorFormView', 'procedures'));
        } else {
            return redirect('admin/doctor');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, ['doctor_name' => 'required']);
        $doctor = new doctor();
        
        
if ($request->hasFile('uploadeImage')) {
    if(isset($doctor->id) && !empty($doctor->id) && !empty($doctor->img_url)){
            Storage::Delete($doctor->img_url);	
    }
    $doctor->img_url = Storage::putFile('uploads', $request->file('uploadeImage'));
}
        
        $doctor->doctor_name = $request['doctor_name'];
        $doctor->isActive = is_null($request['isActive']) ? 0 : 1;
        $doctor->doctorDegree = $request['doctorDegree'];
        $doctor->mobile_no = $request['mobile_no'];
        $doctor->doctorFee = $request['doctorFee'];
        $doctor->formViewName = $request['formViewName'];
        $doctor->reg_number = $request['reg_number'];
        $doctor->save();
        if($doctor->id && !empty($request['fees_details'][0])){
            foreach ($request['fees_details'] as $key => $value) {
                if (empty($value) && empty($request['doctor_fees'][$key])) {
                    continue;
                }
                $feesDetails = new FeesDetails();
                $feesDetails->created_by = Auth::user()->id;
                $feesDetails->fees_details = $value;
                $feesDetails->fees_amount = $request['fees_amount'][$key];
                $feesDetails->doctor_id = $doctor->id;
                $feesDetails->save();
            }
        }
        //\LogActivity::addToLog('Record created successfully');
        return redirect()
            ->route('doctor.index')
            ->with('flash_message', 'Record created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->acc = $this->commonHelper->checkUserAccess("2_admin/doctor/create",Auth::user()->id, 'edit_permission');
        if ($this->acc == 1) {
            $doctor = doctor::find($id);
            $doctorFormView = doctor_form_mapping::pluck('displayText', 'formViewName');
            $procedures = Procedures::all();
            $fees_details = FeesDetails::where('doctor_id', $id)
                                       ->orderBy('id', 'desc')
                                       ->get();
            return view('doctorCRUD.create', compact('doctor', 'doctorFormView', 'procedures', 'fees_details'));
        } else {
            return redirect('admin/doctor');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['doctor_name' => 'required']);
        $request['isActive'] = is_null($request['isActive']) ? 0 : 1;
        
       // dd($request->all());
        $doctor = doctor::find($id);
        
        if ($request->hasFile('uploadeImage')) {
            if(isset($doctor->id) && !empty($doctor->id) && !empty($doctor->img_url)){
                    Storage::Delete($doctor->img_url);	
            }
            $doctor->img_url = Storage::putFile('uploads', $request->file('uploadeImage'));
        }

        $doctor->doctor_name = $request['doctor_name'];
        $doctor->doctorDegree = $request['doctorDegree'];
        $doctor->mobile_no = $request['mobile_no'];
        $doctor->formViewName = $request['formViewName'];
        $doctor->reg_number = $request['reg_number'];
        $doctor->save();
        if($id && !empty($request['fees_details'][0])){
            foreach ($request['fees_details'] as $key => $value) {
                if (empty($value) && empty($request['fees_amount'][$key])) {
                    continue;
                }
                if(!empty($request['fees_details_id'][$key])){
                    $fessDetail = FeesDetails::find($request['fees_details_id'][$key]);
                    if($request['fees_details_status'][$key] == 'Inactive'){
                        $fessDetail->delete();
                    } else {
                        $updateData = array("fees_details"=>$value, "fees_amount" => $request['fees_amount'][$key]);
                        $fessDetail->update($updateData);
                    }
                } else {
                    $feesDetails = new FeesDetails();
					$feesDetails->created_by = Auth::user()->id;
					$feesDetails->fees_details = $value;
					$feesDetails->fees_amount = $request['fees_amount'][$key];
					$feesDetails->doctor_id = $doctor->id;
					$feesDetails->save();
                }
            }
        }
        // \LogActivity::addToLog('Record updated successfully');
        return redirect()
            ->route('doctor.index')
            ->with('flash_message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = doctor::find($id);
        
        if(!$doctor){
            return redirect('/admin/doctor')->with(['fail' => 'Page not found !']);
        }
        $doctor->delete();
        return redirect('/admin/doctor')->with(['success' => 'Docotor Deleted.']);
    }
}