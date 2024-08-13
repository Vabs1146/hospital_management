<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doctor;
use App\FeesDetails;
use Auth;
use DB;
use App\helperClass\CommonHelper;

class FeesDetailsController extends Controller
{
    private $commonHelper;

    public function __construct(){
        $this->acc = 0;
        $this->commonHelper = new CommonHelper();
    }

    public function index(Request $request)
    {
        $this->acc = $this->commonHelper->checkUserAccess("doctor",Auth::user()->id);
        if (1) {
            $pageSize = 15;
            $fees_details = FeesDetails::orderBy('id', 'DESC')->paginate($pageSize);
            return view('fees_details.index', compact('fees_details'))->with('i', ($request->input('page', 1) - 1) * $pageSize);
        } else {
            return view('home');
        }
    }

	public function create()
    {
        $this->acc = $this->commonHelper->checkUserAccess("doctor",Auth::user()->id);
        if (1) {
            $fees_detail = new FeesDetails();
            $fees_detail->status = 1;
            //$doctorFormView = doctor_form_mapping::pluck('displayText', 'formViewName');
            $doctors = doctor::all();
            return view('fees_details.create', compact('fees_detail','doctors'));
        } else {
            return redirect('admin/fees-details');
        }
    }
}
