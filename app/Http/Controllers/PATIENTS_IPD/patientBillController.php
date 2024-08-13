<?php

namespace App\Http\Controllers\PATIENTS_IPD;

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

use App\Models\PATIENTS_IPD\patientRegister;
use App\Models\PATIENTS_IPD\patientBill;
use App\Models\PATIENTS_IPD\billItems;
use App\Case_master;
use App\helperClass\drAppHelper;

use Auth;
use DB;
use Storage;
use App\IpdPatientsDropdowns;
use App\Setting;

class patientBillController extends AdminRootController
{

    public function index(Request $request)
    {
        return view('patients_ipd_patientBill.ipdPbIndex', []);
    }

    public function edit(Request $request, $patientId)
    {
         $helperCls = new drAppHelper();
        $all_settings = $helperCls->get_all_settings();
        
        //echo "=====>>>>>>>>>>> <pre>"; print_r($all_settings['all_payment_modes']); exit;
        $patientRegister  = patientRegister::firstOrNew(['id'=>$patientId]);
        
        $helperCls = new drAppHelper();
        $initial_data = $helperCls->ipd_bill_number($patientId);
        
        //dd($initial_data);
        
        $patientbill = $patientRegister->patientBill()->get()->first();
        $discharge_data = DB::table('patients_discharge')->where('registration_id', $patientRegister->id)->first();
        
        $payment_records = DB::table('patient_payments')->where('registration_id', $patientRegister->id)->where('status', '1')->get();
        $advance_payment = DB::table('patient_payments')->where('registration_id', $patientRegister->id)->where('status', '1')->where('type', 'advance')->first();
        
        if(empty($patientbill) | is_null($patientbill)){
            $patientbill = new patientBill();
        }
        $billItems = $patientbill->billItems()->get();
        // if(empty($billItems) | is_null($billItems)){
        //     $billItems = new billItems();
        // }
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();
        
        
        $all_settings = $helperCls->get_all_settings();
        
        //dd($all_settings);
        
        /*
        $ipd_particulars_result = IpdPatientsDropdowns::where('type', 'ipd_particulars')->get();
        
        foreach($ipd_particulars_result as $ipd_particulars_row) {
            
            $ipd_particulars_all[$ipd_particulars_row->id] = $ipd_particulars_row->name;
            
            if($ipd_particulars_row->parent == 0) {
                $ipd_particulars[$ipd_particulars_row->id]['name'] = $ipd_particulars_row->name;
            } else {
                $ipd_particulars[$ipd_particulars_row->parent]['childs'][] = ['id' => $ipd_particulars_row->id, 'name' => $ipd_particulars_row->name];
            }
        }
        */
        
        
        $ipd_particulars_all = $all_settings['ipd_particulars_all'];
        
        $ipd_particulars = $all_settings['ipd_particulars'];
        
        
        
        $ipd_ward_types = $all_settings['ipd_ward_types'];
        
        $ipd_bed_numbers = $all_settings['ipd_bed_numbers'];
        
        $payment_modes_array = $all_settings['all_payment_modes'];
        
        
        
        
        
       //dd($patientbill);
        
        //dd($advance_payment);
        return view('patients_ipd_patientBill.ipdPbAdd', compact('patientRegister','doctorlist','patientbill','billItems', 'discharge_data', 'ipd_particulars', 'ipd_particulars_all', 'payment_records', 'advance_payment', 'ipd_ward_types', 'ipd_bed_numbers', 'initial_data', 'payment_modes_array'));
    }

    public function update(Request $request, $patientRegisterId){
$helperCls = new drAppHelper();
      // echo "=====>>>>>>>>>> <pre>"; print_r($_POST); exit;
        	//check which submit was clicked on
       
       if (Input::get('Payment_Add')) {
            $insert_data = array (
            'registration_id'               => $request->register_id,
            'type'                          => 'bill_payment',
            'advance_amount'                => $request->payment_amount,
            'payment_mode'                  => $request->payment_mode,
            'payment_id_number'             => $request->payment_id_number,
            'date_time'                     => $request->payment_date_time
        );
            $insert_data['receipt_number'] = $helperCls->receipt_numbers();
            $insert_data['created_by'] = Auth::user()->id;
            
            DB::table('patient_payments')->insert($insert_data);
            return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
        }
        
        if (Input::get('update_payment_item')) {
            
            $payment_id = $request->update_payment_item;
            $insert_data = array (
                'advance_amount'                => $request->{'payment_amount'.$payment_id},
                'payment_mode'                  => $request->{'payment_mode'.$payment_id},
                'payment_id_number'             => $request->{'payment_id_number'.$payment_id},
                'date_time'                     => $request->{'payment_date_time'.$payment_id}
            );
            
           // dd($insert_data);
            $insert_data['updated_by'] = Auth::user()->id;
            
            DB::table('patient_payments')->where('id', $payment_id)->update($insert_data);
            
            return redirect()->back()->withInput()->with('flash_message', 'Record updated successfully');
        }
        
        if (Input::get('delete_payment_item')) {
            $payment_id = $request->delete_payment_item;
            
            $payment_data = DB::table('patient_payments')->where('id', $payment_id)->first();
        
        $insert_data['status'] = '0';
                
        DB::table('patient_payments')->where('id', $payment_id)->update($insert_data);
        
            return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
        }
        
        if (Input::get('Item_Add')) {
            $billItems = patientBill::find($request->id)->billItems();// new billItems();
            $billItems = $billItems->Create($request->all());
            return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
        }
        if (Input::get('update_item')) {
            $item_id = $request['update_item'];
            $billItems = billItems::findOrFail($request['update_item']);
            if ($billItems === null) {
                return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
            }
            $billItems->particular = $request->{'particular_'.$item_id};
            $billItems->day = $request->{'day_'.$item_id};
            $billItems->rate = $request->{'rate_'.$item_id};
            $billItems->amount = $request->{'amount_'.$item_id};

            $billItems->save();

            return redirect()->back()->withInput()->with('flash_message', 'Record updated successfully');
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
                //'advance_amount' => 'numeric',
                //'discount_amount' => 'numeric'
            ]);

            $request->bill_date = ($request->bill_date) ? $request->bill_date : date('d-m-Y');
            
DB::table('patients')->where('id', $patientRegisterId)->update(
[
'ipd_bill_number'   =>  $request->bill_no,
'ipd_bill_number_used'      =>  $request->ipd_bill_number_used,
'ipd_bill_number_format'    =>  $request->ipd_bill_number_format,
'ipd_bill_prefix'    =>  $request->ipd_bill_number_prefix,
'ward_type'    =>  $request->ward,
'bed_number'    =>  $request->bed,
    

'admission_date_time'    =>  $request->admission_date_time,
'discharge_date_time'    =>  $request->discharge_date_time,
    'tpa_company'                      => $request->tpa_company,
            'insurance_company'                      => $request->insurance_company,
]
);

 DB::table('patients_discharge')->where('registration_id', $patientRegisterId)->update(
                 [
                     'discharge_date_time'  =>  $request->discharge_date_time
                 ]
         );

            $patientRegister  = patientRegister::firstOrNew(['id'=>$patientRegisterId]);
            $patientbill = $patientRegister->patientBill()->updateOrCreate(['id'=>$request->id], $request->all());                
            //$patientRegister->update($request->all());
            $ipdDischarge = $patientRegister->ipdDischarge()->get()->first();
            $ipdDischarge = $patientRegister->ipdDischarge()->updateOrCreate(['patient_id'=>$request->id], $request->all());
            // $form_details = new patientBill();
            // $form_details = $form_details->updateOrCreate(['id'=>$billId], $request->all());
            // if($billId == 0){
            //     return redirect('/IPD/patientBill')->with('flash_message', 'Record added successfully');
            // }
            if($request->submit == 'submit_print') {            
            return redirect('/patients_ipd/patientBill/print/'.$patientRegisterId);
            } else {
            return redirect()->back()->with('flash_message', 'Record updated successfully')->withInput();
            }
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
        
         $discharge_data = DB::table('patients_discharge')->where('registration_id', $patientRegister->id)->first();
         
         /*
         $ipd_particulars_result = IpdPatientsDropdowns::where('type', 'ipd_particulars')->get();
        
        foreach($ipd_particulars_result as $ipd_particulars_row) {
            
            $ipd_particulars_all[$ipd_particulars_row->id] = $ipd_particulars_row->name;
            
            if($ipd_particulars_row->parent == 0) {
                $ipd_particulars[$ipd_particulars_row->id]['name'] = $ipd_particulars_row->name;
            } else {
                $ipd_particulars[$ipd_particulars_row->parent]['childs'][] = ['id' => $ipd_particulars_row->id, 'name' => $ipd_particulars_row->name];
            }
        }
         */
         
        $helperCls = new drAppHelper();
        $doctorlist = $helperCls->getDoctorList();


        $all_settings = $helperCls->get_all_settings();
        $ipd_particulars_all = $all_settings['ipd_particulars_all'];

        $ipd_particulars = $all_settings['ipd_particulars'];

        $all_wards = $all_settings['all_wards'];

        $all_beds = $all_settings['all_beds'];
        
        // dd($all_beds);
         
        return view('patients_ipd_patientBill.ipdPbPrint0', compact('patientRegister', 'logoUrl', 'doctorlist','patientbill', 'billItems', 'discharge_data', 'ipd_particulars', 'ipd_particulars_all', 'all_wards', 'all_beds'));
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
        return view('patients_ipd_patientBill.ipdPbPrint1', compact('patientRegister', 'logoUrl', 'doctorlist','patientbill','billItems'));
    }

}