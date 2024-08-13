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
use App\Case_master;
use App\helperClass\drAppHelper;

use DB;
use Storage;

class patientBillController extends AdminRootController
{

    public function index(Request $request)
    {
        return view('ipd_patientBill.ipdPbIndex', []);
    }

    public function edit(Request $request, $patientId)
    {
        $patientRegister  = patientRegister::firstOrNew(['id'=>$patientId]);
        $patientbill = $patientRegister->patientBill()->get()->first();
        if(empty($patientbill) | is_null($patientbill)){
            $patientbill = new patientBill();
        }
        $billItems = $patientbill->billItems()->get();
        // if(empty($billItems) | is_null($billItems)){
        //     $billItems = new billItems();
        // }
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        return view('ipd_patientBill.ipdPbAdd', compact('patientRegister','doctorlist','patientbill','billItems'));
    }

    public function update(Request $request, $patientRegisterId){

        	//check which submit was clicked on
            if (Input::get('Item_Add')) {
                $billItems = patientBill::find($request->id)->billItems();// new billItems();
                $billItems = $billItems->Create($request->all());
                return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
            }
            if (Input::get('delete_item')) {
                $billItems = billItems::findOrFail($request['delete_item']);
                if ($billItems === null) {
                    return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
                }
                $billItems->delete();
                return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
            }
            if (Input::get('submit')) {
				
			$this->validate($request, [
            'advance_amount' => 'numeric',
            'discount_amount' => 'numeric'
               ]);
				
                $patientRegister  = patientRegister::firstOrNew(['id'=>$patientRegisterId]);
                $patientbill = $patientRegister->patientBill()->updateOrCreate(['id'=>$request->id], $request->all());                
                $patientRegister->update($request->all());
                $ipdDischarge = $patientRegister->ipdDischarge()->get()->first();
                $ipdDischarge = $patientRegister->ipdDischarge()->updateOrCreate(['patient_id'=>$request->id], $request->all());
                // $form_details = new patientBill();
                // $form_details = $form_details->updateOrCreate(['id'=>$billId], $request->all());
                // if($billId == 0){
                //     return redirect('/IPD/patientBill')->with('flash_message', 'Record added successfully');
                // }
                return redirect()->back()->with('flash_message', 'Record updated successfully')->withInput();
            }
        
    }

    public function delete(Request $request, $id) {	
		$patientbill = patientBill::findOrFail($id);
		$patientbill->delete();
		return "OK";
    }
    
    public function printbill($patientId){

        $patientRegister  = patientRegister::firstOrNew(['id'=>$patientId]);
        $patientbill = $patientRegister->patientBill()->get()->first();
        if(empty($patientbill) | is_null($patientbill)){
            $patientbill = new patientBill();
        }
        $billItems = $patientbill->billItems()->get();
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('ipd_patientBill.ipdPbPrint0', compact('patientRegister', 'logoUrl', 'doctorlist','patientbill','billItems'));
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
        return view('ipd_patientBill.ipdPbPrint1', compact('patientRegister', 'logoUrl', 'doctorlist','patientbill','billItems'));
    }

}