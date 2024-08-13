<?php

namespace App\Http\Controllers\IPD;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminRootController;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use App\Models\IPD\patientRegister;
use App\Models\IPD\patientBill;
use App\Models\IPD\billItems;
use App\Models\IPD\patientMedicine;
use App\Models\IPD\ipdDischarge;
use App\Case_master;
use App\helperClass\drAppHelper;

use DB;
use Storage;

class patientMedicineController extends AdminRootController
{

    public function index(Request $request)
    {
        return view('ipd_patientMedicine.ipdPmIndex', []);
    }

    public function edit(Request $request, $patientId)
    {
        $patientRegister  = patientRegister::firstOrNew(['id'=>$patientId]);
        $patientbill = $patientRegister->patientBill()->get()->first();
        if(empty($patientbill) | is_null($patientbill)){
            $patientbill = new patientBill();
        }
        $patientMedicine = $patientRegister->patientMedicine()->get();
        // if(empty($patientMedicine) | is_null($patientMedicine)){
        //     $patientMedicine = new patientMedicine();
        // }
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        $medicinelist = $helperCls->getMedicineList();
        return view('ipd_patientMedicine.ipdPmAdd', compact('patientRegister','doctorlist','patientbill','patientMedicine', 'medicinelist'));
    }

    public function update(Request $request, $patientRegisterId){

        	//check which submit was clicked on
            if (Input::get('Item_Add')) {
                $patientRegister  = patientRegister::findOrFail(['id'=>$patientRegisterId]);
                $patientmedicine = $patientRegister->first()->patientMedicine()->Create($request->all());
                return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
            }
            if (Input::get('delete_item')) {
                $billItems = patientMedicine::findOrFail($request['delete_item']);
                if ($billItems === null) {
                    return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
                }
                $billItems->delete();
                return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
            }
            if (Input::get('submit')) {
                $patientRegister  = patientRegister::findOrFail(['id'=>$patientRegisterId]);
                $patientmedicine = $patientRegister->patientMedicine()->updateOrCreate(['id'=>$request->id], $request->all());
                return redirect()->back()->with('flash_message', 'Record updated successfully')->withInput();
            }
        
    }

    public function delete(Request $request, $id) {	
		$patientbill = patientBill::findOrFail($id);
		$patientbill->delete();
		return "OK";
    }
    
    public function printMedicine($patientId){

        $patientRegister  = patientRegister::firstOrNew(['id'=>$patientId]);
        $patientbill = $patientRegister->patientBill()->get()->first();
        if(empty($patientbill) | is_null($patientbill)){
            $patientbill = new patientBill();
        }
        $patientMedicine = $patientRegister->patientMedicine()->get();
        $discharge  = $patientRegister->ipdDischarge()->first();
        if(empty($discharge) | is_null($discharge)){
            $discharge = new ipdDischarge();
        }
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        $medicinelist = $helperCls->getMedicineList();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('ipd_patientMedicine.ipdPmPrint0', compact('patientRegister', 'logoUrl', 'doctorlist','patientbill','patientMedicine', 'medicinelist', 'discharge'));
    }

    public function printReceipt($patientId){

        $patientRegister  = patientRegister::firstOrNew(['id'=>$patientId]);
        $patientbill = $patientRegister->patientBill()->get()->first();
        if(empty($patientbill) | is_null($patientbill)){
            $patientbill = new patientBill();
        }
        $billItems = $patientbill->billItems()->get();
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('ipd_patientMedicine.ipdPmPrint1', compact('patientRegister', 'logoUrl', 'doctorlist','patientbill','billItems'));
    }

}