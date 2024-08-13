<?php
namespace App\Http\Controllers\PATIENTS_IPD;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminRootController;
use App\PaymentModes;
use Auth;
use DB;
use App\helperClass\CommonHelper;
use App\helperClass\drAppHelper;

use App\doctor;
use App\patients_medical_store;
use App\patients_form_dropdowns;
//use App\patients_form_dropdowns;
use App\entmedical_store;
use App\Models\ent_form_dropdowns;
use App\patients_prescription_lists;
use Illuminate\Support\Facades\Input;
use App\Setting;
use App\IpdPatientsDropdowns;
use App\Models\Patients;

use App\Models\PATIENTS_IPD\patientRegister;
use App\Models\PATIENTS_IPD\patientBill;

class PaymentsController extends AdminRootController {
   
    public function add_ipd_payment($registration_id = "") {
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
        
        $registration_data = DB::table('patients')->where('id', $registration_id)->first();
        
        
        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        
        //dd($ipd_ward_types);
        
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        
        $payment_modes_array = [];
        
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();
        
        $payment_records = DB::table('patient_payments')->where('registration_id',$registration_id)->where('status', '1')->get();
         
         //dd($payment_records);

        foreach($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }
        
       // echo "==================".__LINE__; exit;
                        
        return View('ipd_patients_payments.payments_form', compact('registration_data', 'doctorlist', 'payment_modes_array', 'initial_data', 'ipd_ward_types', 'ipd_bed_numbers', 'payment_records'));
    }
    
    function receipt_numbers($patients_id = "") {
        $all_settings = Setting::all()->keyBy('name');
        
        //$advance_receipt_number     = $all_settings['ipd_advance_receipt_number']->value;
        $payment_receipt_number     = $all_settings['ipd_payment_receipt_number']->value;
        
        $last_record = DB::table('patient_payments')->where('type', 'bill_payment')->orderBy('id', 'DESC')->first();
        
        if($last_record) {            
            //$ipd_ipd_number_next  = 1 + $last_record->ipd_number_used;
            $payment_receipt_number_next = 1 + intval($last_record->receipt_number);
            
            $payment_receipt_number_len  = strlen($payment_receipt_number);
                                
            $recipt_number = str_pad($payment_receipt_number_next, $payment_receipt_number_len, 0, STR_PAD_LEFT);
        } else {
            $recipt_number = $payment_receipt_number;
        }
        
        return $recipt_number;
    }
    
    public function save_ipd_payment(Request $request) {
        
        $payment_data = DB::table('patient_payments')->where('id', $request->payment_id)->first();
        
       // dd($payment_data);
        
        $insert_data = array (
            'registration_id'               => $request->registration_id,
            //'receipt_number'                => $this->receipt_numbers(),
            'type'                          => 'bill_payment',
            'advance_amount'                => $request->amount,
            'payment_mode'                  => $request->payment_mode,
            'payment_id_number'             => $request->payment_id_number,
            'date_time'                     => $request->date_time
        );
        
        if($payment_data) {
            
            $insert_data['updated_by'] = Auth::user()->id;
            
            DB::table('patient_payments')->where('id', $request->payment_id)->update($insert_data);
            
            //echo "===================".__LINE__; exit;
        } else {
            //echo "===================".__LINE__; exit;
            $insert_data['receipt_number'] = $this->receipt_numbers();
            $insert_data['created_by'] = Auth::user()->id;
            
            DB::table('patient_payments')->insert($insert_data);
        }
        //echo "============>>>>>>>> <pre>"; print_r($_POST); exit;
        
        return redirect()->back()->with('flash_message', 'Payment details updated successfully.');
    }
    
    public function delete_ipd_payment(Request $request) {
        
        $payment_data = DB::table('patient_payments')->where('id', $request->payment_id)->first();
        
        $insert_data['status'] = '0';
                
        DB::table('patient_payments')->where('id', $request->payment_id)->update($insert_data);
        
        return redirect()->back()->with('flash_message', 'Payment details deleted successfully.');
    }
    
    
    public function edit_ipd_payment($registration_id = "", $payment_id = "") {
        $user = Auth::user()->id;
       
        
        $registration_data = DB::table('patients')->where('id', $registration_id)->first();  
                
        $payment_modes_array = [];
        
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();
        
        $payment_records = DB::table('patient_payments')->where('registration_id',$registration_id)->where('status', '1')->get();
        
        $payment = DB::table('patient_payments')->where('id', $payment_id)->first();
         
         
         //dd($payment_records);

        foreach($payment_modes as $payment_modes_row) {
            $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }
                        
        return View('ipd_patients_payments.payments_form', compact('registration_data', 'payment_modes_array', 'payment_records', 'payment'));
    }
    
    public function print_ipd_payment($registration_id = "", $payment_id = "0") {
        $user = Auth::user()->id;
        
        $registration_data = DB::table('patients')->where('id', $registration_id)->first();  
        
        $payment_modes_array = [];
        
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();
        
        $payment_records = DB::table('patient_payments')->where('registration_id',$registration_id)->where('status', '1')->get();
        
        $payment = DB::table('patient_payments')->where('id', $payment_id)->first();
        
        foreach($payment_modes as $payment_modes_row) {
            $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }
        
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();
        
        return View('ipd_patients_payments.payment_receipt_print', compact('registration_data', 'payment_modes_array', 'payment_records', 'payment', 'logoUrl', 'FooterUrl', 'payment', 'payment_id'));
    }
    
    //======================================= Start particulars ==========================================================
    public function add_hospital_charges_particulars($registration_id = "") {
        $user = Auth::user()->id;
       
        $registration_data = DB::table('patients')->where('id', $registration_id)->first();
        
        $ipd_particulars_result = IpdPatientsDropdowns::where('type', 'ipd_particulars')->get();
        
        $ipd_particulars = [];
        
        foreach($ipd_particulars_result as $ipd_particulars_row) {
            $ipd_particulars_all[$ipd_particulars_row->id] = $ipd_particulars_row->name;
            if($ipd_particulars_row->parent == 0) {
                $ipd_particulars[$ipd_particulars_row->id]['name'] = $ipd_particulars_row->name;
            } else {
                $ipd_particulars[$ipd_particulars_row->parent]['childs'][] = ['id' => $ipd_particulars_row->id, 'name' => $ipd_particulars_row->name];
            }
        }
        
        $payment_modes_array = [];
        
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();
        
        $ipd_particulars_records = DB::table('ipd_patients_particulars')->where('registration_id',$registration_id)->where('status', '1')->get();
         
         //dd($ipd_particulars_all);

        foreach($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }
                        
        return View('ipd_patients_payments.particulars_form', compact('registration_data', 'payment_modes_array', 'ipd_particulars_records', 'ipd_particulars', 'ipd_particulars_all'));
    }
	
	public function save_hospital_charges_particulars(Request $request) {
        
       //echo "=>>>>>>>> <pre>"; print_r($_POST); exit;
       
       if($request->particular_id) {
           $particulars_data = DB::table('ipd_patients_particulars')->where('id', $request->particular_id)->first();
       }
        
        foreach($request->particular as $key => $row) {
            $insert_data[] = array (
                'registration_id'               => $request->registration_id,
                'date_time'                     => $request->date_time,
                'particular'                    => $row,
                'amount'                        => $request->amount[$key],
                'quantity'                      => $request->quantity[$key],
                'total_amount'                  => $request->total_amount[$key],
                'created_by'                    => Auth::user()->id
            );            
        }
        
        if($particulars_data) {
            DB::table('ipd_patients_particulars')->where('id', $request->particular_id)->update($insert_data[0]);
        } else if(isset($insert_data) && !empty($insert_data)) {
            DB::table('ipd_patients_particulars')->insert($insert_data);
        }
        // echo "=>>>>>>>> <pre>"; print_r($_POST); exit;
        return redirect()->back()->with('flash_message', 'Particular details updated successfully.');
    }
    
    
    public function save_hospital_charges_particulars_bk(Request $request) {
        
        $particulars_data = DB::table('ipd_patients_particulars')->where('id', $request->particular_id)->first();
        
       //dd($particulars_data);
        
        $insert_data = array (
            'registration_id'               => $request->registration_id,
            'date_time'                     => $request->date_time,
            'particular'                    => $request->particular,
            'amount'                        => $request->amount,
            'quantity'                      => $request->quantity,
            'total_amount'                  => $request->total_amount
        );
        
        if($particulars_data) {
            
            $insert_data['updated_by'] = Auth::user()->id;
            
            DB::table('ipd_patients_particulars')->where('id', $request->particular_id)->update($insert_data);
            
            //echo "===================".__LINE__; exit;
        } else {
            //echo "===================".__LINE__; exit;
            $insert_data['created_by'] = Auth::user()->id;
            
            DB::table('ipd_patients_particulars')->insert($insert_data);
        }
        //echo "============>>>>>>>> <pre>"; print_r($_POST); exit;
        
        return redirect()->back()->with('flash_message', 'Particular details updated successfully.');
    }
    
    public function delete_hospital_charges_particulars($registration_id = "", $particular_id = "") {
        
        $payment_data = DB::table('ipd_patients_particulars')->where('id', $particular_id)->first();
        
        $insert_data['status'] = '0';
                
        DB::table('ipd_patients_particulars')->where('id', $particular_id)->update($insert_data);
        
        //return redirect()->back()->with('flash_message', 'Particular details deleted successfully.');
        
        return redirect('/hospital-charges-particulars/'.$registration_id)->with('flash_message', 'Particular details deleted successfully.');
    }
    
    
    public function edit_hospital_charges_particulars($registration_id = "", $particular_id = "") {
        $user = Auth::user()->id;
       
        $registration_data = DB::table('patients')->where('id', $registration_id)->first();
        
        $patient_particular_data = DB::table('ipd_patients_particulars')->where('id', $particular_id)->first();
        
        $ipd_particulars_result = IpdPatientsDropdowns::where('type', 'ipd_particulars')->get();
        
        $ipd_particulars = [];
        
        foreach($ipd_particulars_result as $ipd_particulars_row) {
            $ipd_particulars_all[$ipd_particulars_row->id] = $ipd_particulars_row->name;
            if($ipd_particulars_row->parent == 0) {
                $ipd_particulars[$ipd_particulars_row->id]['name'] = $ipd_particulars_row->name;
            } else {
                $ipd_particulars[$ipd_particulars_row->parent]['childs'][] = ['id' => $ipd_particulars_row->id, 'name' => $ipd_particulars_row->name, 'value' => $ipd_particulars_row->value];
            }
        }
        
        $payment_modes_array = [];
        
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();
        
        $ipd_particulars_records = DB::table('ipd_patients_particulars')->where('registration_id',$registration_id)->where('status', '1')->get();
         
         //dd($ipd_particulars_all);

        foreach($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }
		
		$templates = DB::table('hospital_charges_particulars_template')->orWhere('parent', 0)->get();
                        
        return View('ipd_patients_payments.particulars_form', compact('registration_data', 'payment_modes_array', 'ipd_particulars_records', 'ipd_particulars', 'ipd_particulars_all', 'patient_particular_data', 'templates'));
    }
    
    public function print_hospital_charges_particulars($patientId){

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
         
         $ipd_particulars_result = IpdPatientsDropdowns::where('type', 'ipd_particulars')->get();
        
        foreach($ipd_particulars_result as $ipd_particulars_row) {
            
            $ipd_particulars_all[$ipd_particulars_row->id] = $ipd_particulars_row->name;
            
            if($ipd_particulars_row->parent == 0) {
                $ipd_particulars[$ipd_particulars_row->id]['name'] = $ipd_particulars_row->name;
            } else {
                $ipd_particulars[$ipd_particulars_row->parent]['childs'][] = ['id' => $ipd_particulars_row->id, 'name' => $ipd_particulars_row->name];
            }
        }
         
         //dd($ipd_particulars_all);
         
        return view('ipd_patients_payments.print_particulars', compact('patientRegister', 'logoUrl', 'doctorlist','patientbill', 'billItems', 'discharge_data', 'ipd_particulars', 'ipd_particulars_all'));
    }
    
    //======================================= End Particulars ==========================================================
    
    //======================================= start estimate bill=======================================================
   public function ipd_estimate_bill($registration_id = "") {
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');        
        $registration_data = DB::table('patients')->where('id', $registration_id)->first();
        
        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();
        
        //dd($registration_data);
        
        $payment_modes_array = [];
        //$payment_modes = PaymentModes::all();

        foreach($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }
        
        //==============================================================================================
        $ipd_particulars_records = DB::table('ipd_patients_particulars')->where('registration_id',$registration_id)->where('status', '1')->get();
        
        $total_bill = 0;        
        foreach($ipd_particulars_records as $ipd_particulars_records_row) {
            $total_bill += $ipd_particulars_records_row->total_amount;
        }         
        //echo "============= : ". $total_bill; exit;
        
        $patientRegister  = patientRegister::firstOrNew(['id'=>$registration_id]);
        
       
        
        $patientbill = $patientRegister->patientBill()->get()->first();
        $discharge_data = DB::table('patients_discharge')->where('registration_id', $registration_id)->first();
        
        $payment_records = DB::table('patient_payments')->where('registration_id', $registration_id)->where('status', '1')->get();
        
        $total_payment = 0;        
        foreach($payment_records as $payment_records_row) {
            $total_payment += $payment_records_row->advance_amount;
        }         
        //echo "============= : ". $total_payment; exit;
        
        $advance_payment = DB::table('patient_payments')->where('registration_id', $registration_id)->where('status', '1')->where('type', 'advance')->first();
        //========================================================================================================
        $estimated_bill_data = DB::table('patients_ipd_patients_estimate_bills')->where('registration_id', $registration_id)->where('status', '1')->first();
        
        $ipd_doctors = IpdPatientsDropdowns::where('type', 'ipd_doctor')->get();
        
        foreach($ipd_doctors as $ipd_doctor) {
            $all_doctors[$ipd_doctor->id] = $ipd_doctor->name;
        }
        
        //dd($estimated_bill__data);
        return View('ipd_patients_payments.estimate_bill', compact('doctorlist', 'payment_modes_array', 'registration_data', 'ipd_ward_types', 'ipd_bed_numbers', 'total_bill', 'total_payment', 'estimated_bill_data', 'discharge_data', 'all_doctors'));

    } 
    
    public function print_ipd_estimate_bill($registration_id = "") {
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
        
        $registration_data = DB::table('patients')->where('id', $registration_id)->first();
        
        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();
        
        $payment_modes_array = [];
        //$payment_modes = PaymentModes::all();

        foreach($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }
        
        $estimated_bill_data = DB::table('patients_ipd_patients_estimate_bills')->where('registration_id', $registration_id)->where('status', '1')->first();
        
        $payment_records = DB::table('patient_payments')->where('registration_id', $registration_id)->where('status', '1')->get();
        
        $total_payment = 0;        
        foreach($payment_records as $payment_records_row) {
            $total_payment += $payment_records_row->advance_amount;
        }   
        
        $ipd_particulars_records = DB::table('ipd_patients_particulars')->where('registration_id',$registration_id)->where('status', '1')->get();
        
        $total_bill = 0;        
        foreach($ipd_particulars_records as $ipd_particulars_records_row) {
            $total_bill += $ipd_particulars_records_row->total_amount;
        }   
        $discharge_data = DB::table('patients_discharge')->where('registration_id', $registration_id)->first();
        
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();
       
         $ipd_doctors = IpdPatientsDropdowns::where('type', 'ipd_doctor')->get();
        
        foreach($ipd_doctors as $ipd_doctor) {
            $all_doctors[$ipd_doctor->id] = $ipd_doctor->name;
        }
//        /dd($all_docotrs);
        return View('ipd_patients_payments.print_estimate_bill', compact('doctorlist', 'all_doctors', 'payment_modes_array', 'registration_data', 'ipd_ward_types', 'ipd_bed_numbers', 'estimated_bill_data', 'total_payment', 'total_bill', 'discharge_data', 'logoUrl', 'FooterUrl'));

    } 
    
    
     public function save_ipd_estimate_bill(Request $request) {
       // echo "============>>>>>>>> <pre>"; print_r($_POST); exit;
        
        $estimated_bill__data = DB::table('patients_ipd_patients_estimate_bills')->where('registration_id', $request->registration_id)->where('status', '1')->first();
        
       //dd($particulars_data);
        
        $insert_data = array (
            'registration_id'               => $request->registration_id,
            'date_time'                     => ($request->date_time) ? $request->date_time : date('Y-m-d h:i A'),
            //'diagnosis'                    => $request->diagnosis
        );
        
         $discharge_data = DB::table('patients_discharge')->where('registration_id', $request->registration_id)->update(['discharge_date_time' => $request->discharge_date_time]);
        
        if($estimated_bill__data) {
            
            $insert_data['updated_by'] = Auth::user()->id;
            
            DB::table('patients_ipd_patients_estimate_bills')->where('registration_id', $request->registration_id)->where('status', '1')->update($insert_data);
            
            //echo "===================".__LINE__; exit;
        } else {
            //echo "===================".__LINE__; exit;
            $insert_data['created_by'] = Auth::user()->id;
            
            DB::table('patients_ipd_patients_estimate_bills')->insert($insert_data);
        }
        //echo "============>>>>>>>> <pre>"; print_r($_POST); exit;
        
        return redirect()->back()->with('flash_message', 'Particular details updated successfully.');
    }
    
    //======================================= End Estimate bill ========================================================
    
    public function ipd_summary_final_bill($registration_id = "") {
        $helperCls = new drAppHelper();
        $initial_data = $helperCls->ipd_summary_bill_number($registration_id);
        
        //dd($initial_data);
        
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');        
        $registration_data = DB::table('patients')->where('id', $registration_id)->first();
        
        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();
        
        $ipd_particulars_result = IpdPatientsDropdowns::where('type', 'ipd_particulars')->get();
         
        $ipd_particulars = [];
        $ipd_particulars_all = [];
        $ipd_particulars_all_data = [];
        foreach($ipd_particulars_result as $ipd_particulars_row) {
            $ipd_particulars_all[$ipd_particulars_row->id] = $ipd_particulars_row->name;
            /*
            $ipd_particulars_all_data[$ipd_particulars_row->id] = array(
                'id' => $ipd_particulars_row->id,
                'name' => $ipd_particulars_row->name,
                'value' => $ipd_particulars_row->value,
                'parent' => $ipd_particulars_row->parent
            );
            */
            
            $ipd_particulars_parent[$ipd_particulars_row->id] = $ipd_particulars_row->parent;
            
            if($ipd_particulars_row->parent == 0) {
                $ipd_particulars[$ipd_particulars_row->id]['name'] = $ipd_particulars_row->name;
            } else {
                $ipd_particulars[$ipd_particulars_row->parent]['childs'][] = ['id' => $ipd_particulars_row->id, 'name' => $ipd_particulars_row->name];
            }
        }
        
        //echo "====>>>>>>>>>>>> <pre>"; print_r($ipd_particulars_parent); exit;
        
        $payment_modes_array = [];
        //$payment_modes = PaymentModes::all();

        foreach($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }
        
        //==============================================================================================
        $ipd_particulars_records = DB::table('ipd_patients_particulars')->where('registration_id',$registration_id)->where('status', '1')->get();
        
        //echo "====>>>>>>>>>>>> <pre>"; print_r($ipd_particulars_records); exit;
        $total_bill = 0; 
        
        $ipd_particulars_data = [];
        foreach($ipd_particulars_records as $ipd_particulars_records_row) {
            $child_id = $ipd_particulars_records_row->particular;
           // echo "===========1111111=== : <pre>".$child_id; print_r($ipd_particulars_records_row); exit;
            //$child_id = 53;
            $parent_id = $ipd_particulars_parent[$child_id];
            //$ipd_particulars_data[$parent_id][$child_id][] = $ipd_particulars_records_row;
            
            $ipd_particulars_data[$parent_id]['name'] = $ipd_particulars_all[$parent_id];
            $ipd_particulars_data[$parent_id]['childs'][$child_id]['name'] = $ipd_particulars_all[$child_id];
            
            $ipd_particulars_data[$parent_id]['childs'][$child_id]['amount'] = $ipd_particulars_records_row->amount;
            
            
            $ipd_particulars_data[$parent_id]['childs'][$child_id]['total_quantity'] = isset( $ipd_particulars_data[$parent_id]['childs'][$child_id]['total_quantity']) ?  $ipd_particulars_data[$parent_id]['childs'][$child_id]['total_quantity'] + $ipd_particulars_records_row->quantity : $ipd_particulars_records_row->quantity;
            
            $ipd_particulars_data[$parent_id]['childs'][$child_id]['total_amount'] = isset($ipd_particulars_data[$parent_id]['childs'][$child_id]['total_amount']) ? $ipd_particulars_data[$parent_id]['childs'][$child_id]['total_amount'] + ($ipd_particulars_records_row->amount * $ipd_particulars_records_row->quantity) : $ipd_particulars_records_row->amount * $ipd_particulars_records_row->quantity;
            
            $total_bill += $ipd_particulars_records_row->total_amount;
            
            $ipd_particulars_data[$parent_id]['particular_total_amount'] = isset( $ipd_particulars_data[$parent_id]['particular_total_amount']) ?  $ipd_particulars_data[$parent_id]['particular_total_amount'] + $ipd_particulars_records_row->total_amount : $ipd_particulars_records_row->total_amount;
        }         
        //echo "============= : ". $total_bill; exit;
       //echo "====>>>>>>>>>>>> <pre>"; print_r($ipd_particulars_data); exit;
        
        
        $patientRegister  = patientRegister::firstOrNew(['id'=>$registration_id]);
        
       
        
        $patientbill = $patientRegister->patientBill()->get()->first();
        $discharge_data = DB::table('patients_discharge')->where('registration_id', $registration_id)->first();
        
        $payment_records = DB::table('patient_payments')->where('registration_id', $registration_id)->where('status', '1')->get();
        
        $total_payment = 0;        
        foreach($payment_records as $payment_records_row) {
            $total_payment += $payment_records_row->advance_amount;
        }         
        //echo "============= : ". $total_payment; exit;
        
        $advance_payment = DB::table('patient_payments')->where('registration_id', $registration_id)->where('status', '1')->where('type', 'advance')->first();
        //========================================================================================================
        $estimated_bill_data = DB::table('patients_ipd_patients_estimate_bills')->where('registration_id', $registration_id)->where('status', '1')->first();
        
         $ipd_doctors = IpdPatientsDropdowns::where('type', 'ipd_doctor')->get();
        
        foreach($ipd_doctors as $ipd_doctor) {
            $all_doctors[$ipd_doctor->id] = $ipd_doctor->name;
        }

       // $registration_data = DB::table('patients')->where('id', $registration_id)->first();
        
       //dd($registration_data);
        return View('ipd_patients_payments.ipd_summary_final_bill', compact('doctorlist', 'payment_modes_array', 'registration_data', 'ipd_ward_types', 'ipd_bed_numbers', 'total_bill', 'total_payment', 'estimated_bill_data', 'advance_payment', 'patientbill', 'ipd_particulars_records', 'ipd_particulars_all', 'payment_records', 'discharge_data', 'ipd_particulars_data', 'initial_data', 'all_doctors'));
        
//   return View('ipd_patients_payments.ipd_summary_final_bill', compact('doctorlist', 'payment_modes_array', 'registration_data', 'ipd_ward_types', 'ipd_bed_numbers'));

    } 
    
    public function print_ipd_summary_final_bill($registration_id = "") {
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');        
        $registration_data = DB::table('patients')->where('id', $registration_id)->first();
        
        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();
        
        $ipd_particulars_result = IpdPatientsDropdowns::where('type', 'ipd_particulars')->get();
        
        $ipd_particulars = [];
        $ipd_particulars_all = [];
        $ipd_particulars_all_data = [];
        foreach($ipd_particulars_result as $ipd_particulars_row) {
            $ipd_particulars_all[$ipd_particulars_row->id] = $ipd_particulars_row->name;
            /*
            $ipd_particulars_all_data[$ipd_particulars_row->id] = array(
                'id' => $ipd_particulars_row->id,
                'name' => $ipd_particulars_row->name,
                'value' => $ipd_particulars_row->value,
                'parent' => $ipd_particulars_row->parent
            );
            */
            
            $ipd_particulars_parent[$ipd_particulars_row->id] = $ipd_particulars_row->parent;
            
            if($ipd_particulars_row->parent == 0) {
                $ipd_particulars[$ipd_particulars_row->id]['name'] = $ipd_particulars_row->name;
            } else {
                $ipd_particulars[$ipd_particulars_row->parent]['childs'][] = ['id' => $ipd_particulars_row->id, 'name' => $ipd_particulars_row->name];
            }
        }
        $total_bill = 0;     
        $ipd_particulars = [];
         $ipd_particulars_records = DB::table('ipd_patients_particulars')->where('registration_id',$registration_id)->where('status', '1')->get();
        $ipd_particulars_data = [];
        foreach($ipd_particulars_records as $ipd_particulars_records_row) {
            $child_id = $ipd_particulars_records_row->particular;
           // echo "===========1111111=== : <pre>".$child_id; print_r($ipd_particulars_records_row); exit;
            //$child_id = 53;
            $parent_id = $ipd_particulars_parent[$child_id];
            //$ipd_particulars_data[$parent_id][$child_id][] = $ipd_particulars_records_row;
            
            $ipd_particulars_data[$parent_id]['name'] = $ipd_particulars_all[$parent_id];
            $ipd_particulars_data[$parent_id]['childs'][$child_id]['name'] = $ipd_particulars_all[$child_id];
            
            $ipd_particulars_data[$parent_id]['childs'][$child_id]['amount'] = $ipd_particulars_records_row->amount;
            
            
            $ipd_particulars_data[$parent_id]['childs'][$child_id]['total_quantity'] = isset( $ipd_particulars_data[$parent_id]['childs'][$child_id]['total_quantity']) ?  $ipd_particulars_data[$parent_id]['childs'][$child_id]['total_quantity'] + $ipd_particulars_records_row->quantity : $ipd_particulars_records_row->quantity;
            
            $ipd_particulars_data[$parent_id]['childs'][$child_id]['total_amount'] = isset($ipd_particulars_data[$parent_id]['childs'][$child_id]['total_amount']) ? $ipd_particulars_data[$parent_id]['childs'][$child_id]['total_amount'] + ($ipd_particulars_records_row->amount * $ipd_particulars_records_row->quantity) : $ipd_particulars_records_row->amount * $ipd_particulars_records_row->quantity;
            
            $total_bill += $ipd_particulars_records_row->total_amount;
            
            $ipd_particulars_data[$parent_id]['particular_total_amount'] = isset( $ipd_particulars_data[$parent_id]['particular_total_amount']) ?  $ipd_particulars_data[$parent_id]['particular_total_amount'] + $ipd_particulars_records_row->total_amount : $ipd_particulars_records_row->total_amount;
        }
        
        $payment_modes_array = [];
        //$payment_modes = PaymentModes::all();

        foreach($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }
        
        //==============================================================================================
       
        
       
        
           $total_bill = 0;     
        foreach($ipd_particulars_records as $ipd_particulars_records_row) {
            $total_bill += $ipd_particulars_records_row->total_amount;
        }         
        //echo "============= : ". $total_bill; exit;
        
        $patientRegister  = patientRegister::firstOrNew(['id'=>$registration_id]);
        
       
        
        $patientbill = $patientRegister->patientBill()->get()->first();
        $discharge_data = DB::table('patients_discharge')->where('registration_id', $registration_id)->first();
        
        $payment_records = DB::table('patient_payments')->where('registration_id', $registration_id)->where('status', '1')->get();
        
        $total_payment = 0;        
        foreach($payment_records as $payment_records_row) {
            $total_payment += $payment_records_row->advance_amount;
        }         
        //echo "============= : ". $total_payment; exit;
        
        $advance_payment = DB::table('patient_payments')->where('registration_id', $registration_id)->where('status', '1')->where('type', 'advance')->first();
        //========================================================================================================
        $estimated_bill_data = DB::table('patients_ipd_patients_estimate_bills')->where('registration_id', $registration_id)->where('status', '1')->first();
        
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();
        
         $ipd_doctors = IpdPatientsDropdowns::where('type', 'ipd_doctor')->get();
        
        foreach($ipd_doctors as $ipd_doctor) {
            $all_doctors[$ipd_doctor->id] = $ipd_doctor->name;
        }
        
        //dd($all_doctors);
        return View('ipd_patients_payments.print_ipd_summary_final_bill', compact('doctorlist', 'payment_modes_array', 'registration_data', 'ipd_ward_types', 'ipd_bed_numbers', 'total_bill', 'total_payment', 'estimated_bill_data', 'advance_payment', 'patientbill', 'ipd_particulars_records', 'ipd_particulars_all', 'payment_records', 'discharge_data', 'ipd_particulars_data', 'logoUrl', 'FooterUrl', 'all_doctors'));
        
//   return View('ipd_patients_payments.ipd_summary_final_bill', compact('doctorlist', 'payment_modes_array', 'registration_data', 'ipd_ward_types', 'ipd_bed_numbers'));

    } 
    
    public function save_ipd_summary_final_bill(Request $request) {
        
       //echo "============>>>>>>>> <pre>"; print_r($_POST); exit;
         $patientRegister  = patientRegister::firstOrNew(['id'=>$request->registration_id]);
         
         DB::table('patients')->where('id', $request->registration_id)->update(
                 [
                     'admission_date_time'  =>  $request->admission_date_time,
                     'ipd_bill_summary_date_time'  =>  $request->ipd_bill_summary_date_time,
                     'ipd_summary_bill_number'  =>  $request->ipd_summary_bill_number,
                     'ipd_summary_bill_number_used'  =>  $request->ipd_summary_bill_number_used,
                     'ipd_summary_bill_number_format'  =>  $request->ipd_summary_bill_number_format,
                     'ipd_summary_bill_prefix'  =>  $request->ipd_summary_bill_prefix,
                     'consulting_doctor'  =>  $request->consulting_doctor,
                     'date_of_birth'  =>  $request->date_of_birth,
                     'middle_name'  =>  $request->patient_middle_name,
                     'last_name'  =>  $request->patient_last_name,
                 ]
         );

         $patients_ipd_patient_bill_data = DB::table('patients_ipd_patient_bill')->where('register_id', $request->registration_id)->first();
         
         if($patients_ipd_patient_bill_data) {
            DB::table('patients_ipd_patient_bill')->where('register_id', $request->registration_id)->update([
                'discount_amount'  =>  $request->discount_amount
            ]);
         } else {
            DB::table('patients_ipd_patient_bill')->insert([
                'discount_amount'  =>  $request->discount_amount,
                'register_id'  =>  $request->registration_id
            ]);
         }
         
         $patients_discharge_data = DB::table('patients_discharge')->where('registration_id', $request->registration_id)->first();

         if($patients_discharge_data) {
            DB::table('patients_discharge')->where('registration_id', $request->registration_id)->update([
                'discharge_date_time'  =>  $request->discharge_date_time
            ]);
         } else {

            DB::table('patients_discharge')->insert([
                'discharge_date_time'  =>  $request->discharge_date_time,
                'registration_id'  =>  $request->registration_id
            ]);
         }
        
         if($request->submit) {
            return redirect()->back()->with('flash_message', 'IPD Summary Bill details updated successfully.');
         } else {
            return redirect('/print-ipd-summary-final-bill/'.$request->registration_id);
         }
    }
	
	//============================= Particular templates =================================================
	public function add_hospital_charges_particulars_template($registration_id = "") {
        $ipd_particulars_result = IpdPatientsDropdowns::where('type', 'ipd_particulars')->get();
        
        $ipd_particulars = [];
        
        foreach($ipd_particulars_result as $ipd_particulars_row) {
            $ipd_particulars_all[$ipd_particulars_row->id] = $ipd_particulars_row->name;
            if($ipd_particulars_row->parent == 0) {
                $ipd_particulars[$ipd_particulars_row->id]['name'] = $ipd_particulars_row->name;
            } else {
                $ipd_particulars[$ipd_particulars_row->parent]['childs'][] = ['id' => $ipd_particulars_row->id, 'name' => $ipd_particulars_row->name, 'value' => $ipd_particulars_row->value];
            }
        }
        
        //dd($ipd_particulars);
        
        return view('ipd_patients_payments.template.add_templates', compact('ipd_particulars'));
    }
    
     public function edit_hospital_charges_particulars_template($template_id = "", $registration_id = "") {
        
        $ipd_particulars_result = IpdPatientsDropdowns::where('type', 'ipd_particulars')->get();
        
        $ipd_particulars = [];
        
        foreach($ipd_particulars_result as $ipd_particulars_row) {
            $ipd_particulars_all[$ipd_particulars_row->id] = $ipd_particulars_row->name;
            if($ipd_particulars_row->parent == 0) {
                $ipd_particulars[$ipd_particulars_row->id]['name'] = $ipd_particulars_row->name;
            } else {
                $ipd_particulars[$ipd_particulars_row->parent]['childs'][] = ['id' => $ipd_particulars_row->id, 'name' => $ipd_particulars_row->name, 'value' => $ipd_particulars_row->value];
            }
        }
        
        $template_data = DB::table('hospital_charges_particulars_template')->where('id', $template_id)->orWhere('parent', $template_id)->orderBY('parent')->get();
        
       // dd($template);
        
        return view('ipd_patients_payments.template.add_templates', compact('ipd_particulars', 'template_data'));
    
    }
    
    public function update_hospital_charges_particulars_template(Request $request) {
        if($request->id) {
            $template = DB::table('hospital_charges_particulars_template')->where('id', $request->id)->orWhere('parent_id', $request->id)->delete();
        }
        
       
        
        $parent = 0;
        foreach($request->particular as $key => $particular) {
            if($particular) {   
               $insert_data = [
                   'template_name' => $request->template_name,
                   'particular_id' => $particular,
                   'amount' => $request->amount[$key]
               ];

               if($parent != 0) {
                   $insert_data['parent'] = $parent;
                   DB::table('hospital_charges_particulars_template')->insert($insert_data);
               } else {
                   $insert_data['parent'] = $parent;
                   $parent = DB::table('hospital_charges_particulars_template')->insertGetId($insert_data);
               }
            }
            
        }
        
         //echo "==========1111111111=>>>>>>>> <pre>"; print_r($_POST); exit;
        
       // echo "==========1111111111=>>>>>>>> <pre>"; print_r($request->medicine_id); exit;
        
        if($request->id) {
            return redirect('hospital-charges-particulars-templates-listing/'.$request->case_id)
                ->with('flash_message', 'Template Updated Successully.');
        }
        if($request->case_id) {
            return redirect('edit-hospital-charges-particulars/'.$request->case_id)
                //->withInput()
                ->with('flash_message', 'Template added Successully.');
        } else {
            return redirect()->back()
                //->withInput()
                ->with('flash_message', 'Template added Successully.');
        }
    }
    
     public function hospital_charges_particulars_templates_listing(Request $request, $case_id = "") {
        return view('ipd_patients_payments.template.listing', ['case_id' => $case_id]);
    }
    
    public function hospital_charges_particulars_templates_listing_grid(Request $request) {
        $len = $_POST['length'];
        $start = $_POST['start'];        
        
        $select = "SELECT a.id, a.template_name";
        
        $presql = " FROM hospital_charges_particulars_template a ";
        $presql .= " WHERE 1=1 and a.parent = 0";      
        
        $presql .= "  ";
        $orderByStr = " order by 1 desc";
      
        if (isset($_POST['order'][0]['column']) && is_numeric($_POST['order'][0]['column'])) {
            $orderColum = intval($_POST['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_POST['order'][0]['dir'];
        }
        
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
            foreach ($row as $value) {
                $r[] = $value;
            }
            $ret[] = $r;
        }

        $ret['data'] = $ret;
        $ret['recordsTotal'] = $count;
        $ret['iTotalDisplayRecords'] = $count;

        $ret['recordsFiltered'] = count($ret);
        $ret['draw'] = $_POST['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }
    
      public function get_hospital_charges_particulars_template(Request $request) {
        $user = Auth::user()->id;
        
        $template = DB::table('hospital_charges_particulars_template')->where('id', $request->id)->orWhere('parent', $request->id)->get();
        
       // dd($template);
        
        $all_templates = DB::table('hospital_charges_particulars_template')->where('parent', 0)->get();
        
        $ipd_particulars_result = IpdPatientsDropdowns::where('type', 'ipd_particulars')->get();
        
        $ipd_particulars = [];
        
        foreach($ipd_particulars_result as $ipd_particulars_row) {
            $ipd_particulars_all[$ipd_particulars_row->id] = $ipd_particulars_row->name;
            if($ipd_particulars_row->parent == 0) {
                $ipd_particulars[$ipd_particulars_row->id]['name'] = $ipd_particulars_row->name;
            } else {
                $ipd_particulars[$ipd_particulars_row->parent]['childs'][] = ['id' => $ipd_particulars_row->id, 'name' => $ipd_particulars_row->name, 'value' => $ipd_particulars_row->value];
            }
        }
       
         
        return view('ipd_patients_payments.template.add_templates_row', ['template' => $template, 'all_templates' => $all_templates, 'template_id' => $request->id, 'ipd_particulars' => $ipd_particulars]);    
    }
    
     public function delete_hospital_charges_particulars_template(Request $request, $template_id) {
        DB::table('hospital_charges_particulars_template')->where('id', $template_id)->orWhere('parent', $template_id)->delete();
    }
	//============================= end particular templates =============================================
}
