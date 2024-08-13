<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Models\PATIENTS_IPD\billItems;
use App\Models\form_dropdowns;
use App\eyeform;
use App\Models\eyeformmultipleentry;

class PatientsController extends AdminRootController
{
    public function __construct()
    {
        $this->acc = 0;
    }

    public function patients_listing(Request $request)
    {

        $user = Auth::user()->id;
        //echo "============>>>>>> <pre>".$user; print_r([]); exit;

        $payment_modes_array = [];
        $helperCls = new drAppHelper();
        $all_settings = $helperCls->get_all_settings();



        $payment_modes = $all_settings['payment_modes'];
        $payment_modes_array = $all_settings['all_payment_modes'];

        $ipd_ward_types = $all_settings['ipd_ward_types'];

        $ipd_bed_numbers = $all_settings['ipd_bed_numbers'];

        $all_docotrs = $all_settings['all_docotrs'];

        return view('patients.listing', compact('all_docotrs'));
    }

    public function grid(Request $request)
    {


        $len = $_POST['length'];
        $start = $_POST['start'];

        $url = url('/') . '/uploads/';

        $select = "SELECT p.id, CONCAT(COALESCE(p.`first_name`,''), ' ', COALESCE(p.`middle_name`,''), ' ', COALESCE(p.`last_name`,'')), p.ipd_number, p.uhid_number, p.id as action_id, p.id as action_id1 , p.id as action_id2 , p.id as action_id3 , p.id as action_id4 , p.id as action_id5 , p.id as action_id6 , p.id as action_id7 , p.id as action_id8 , p.id as action_id9  ";


        $presql = " FROM patients p LEFT JOIN ipd_patients_dropdowns pd ON pd.id = p.consulting_doctor AND pd.type = 'ipd_doctor' ";

        $presql .= " WHERE is_deleted = '0' ";
        $logged_user = Auth::user()->id;
        //$presql .= "AND created_by = '".$logged_user."' ";
        //Auth::user()->id;

        if ($_REQUEST['search']['value']) {
            $presql .= " and p.first_name LIKE '%" . $_REQUEST['search']['value'] . "%' ";
        }

        //echo "====>>>>>>>>>>>> <pre>"; print_r($_POST); exit;
        if ($_REQUEST['columns'][1]['search']['value']) {
            $presql .= " and (p.first_name LIKE '%" . $_REQUEST['columns'][1]['search']['value'] . "%' OR p.middle_name LIKE '%" . $_REQUEST['columns'][1]['search']['value'] . "%' OR  p.last_name LIKE '%" . $_REQUEST['columns'][1]['search']['value'] . "%') ";
        }
        if ($_REQUEST['columns'][2]['search']['value']) {
            $docotor_id = $_REQUEST['columns'][2]['search']['value'];
            $presql .= " and p.consulting_doctor ='" . $docotor_id . "' ";
        }
        if ($_REQUEST['columns'][3]['search']['value']) {
            $ipd_number = $_REQUEST['columns'][3]['search']['value'];
            $presql .= " and p.ipd_number LIKE '%" . $ipd_number . "%' ";
        }

        if ($_REQUEST['columns'][4]['search']['value']) {
            $fromDate = $_REQUEST['columns'][4]['search']['value'];
            //$presql .= " and date(p.admission_date_time) >='".$fromDate."' ";
            $presql .= " and date(SUBSTRING_INDEX(p.admission_date_time,' - ', 1)) >='" . $fromDate . "' ";
        }

        if ($_REQUEST['columns'][5]['search']['value']) {
            $toDate = $_REQUEST['columns'][5]['search']['value'];
            //$presql .= " and date(p.admission_date_time) <='".$toDate."' ";

            $presql .= " and date(SUBSTRING_INDEX(p.admission_date_time,' - ', 1)) <='" . $toDate . "' ";


        }

        $presql .= "  ";

        $orderByStr = " order by 1 desc";

        if (isset($_POST['order'][0]['column']) && is_numeric($_POST['order'][0]['column'])) {
            $orderColum = intval($_POST['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_POST['order'][0]['dir'];
        }

        //$sql = $select . $presql . $orderByStr . " LIMIT " . $start . "," . $len;
        if ($len > 0) {
            $sql = $select . $presql . $orderByStr . " LIMIT " . $start . "," . $len;
        } else {
            $sql = $select . $presql . $orderByStr;
        }

        $qcount = DB::select("SELECT COUNT(*) c " . $presql);
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
        $ret['draw'] = $_POST['draw'];
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }

    function ipd_uhid_numbers($patients_id = "")
    {
        $all_settings = Setting::all()->keyBy('name');

        $ipd_ipd_prefix = $all_settings['ipd_ipd_prefix']->value;
        $ipd_ipd_number = $all_settings['ipd_ipd_number']->value;
        $ipd_uhid_prefix = $all_settings['ipd_uhid_prefix']->value;
        $ipd_uhid_number = $all_settings['ipd_uhid_number']->value;

        if ($patients_id) {
            $last_record = DB::table('patients')->where('id', $patients_id)->orderBy('id', 'DESC')->first();
        } else {
            $last_record = DB::table('patients')->orderBy('id', 'DESC')->first();
        }

        //dd($last_record);

        if ($last_record) {
            $ipd_ipd_number_next = 1 + $last_record->ipd_number_used;
            $ipd_uhid_number_next = 1 + $last_record->uhid_number_used;

            $ipd_ipd_number_len = strlen($ipd_ipd_number);
            $ipd_uhid_number_len = strlen($ipd_uhid_number);

            if ($ipd_ipd_number != $last_record->ipd_number_format) {
                $ipd_ipd_number_next = $ipd_ipd_number;
            }

            if ($ipd_uhid_number != $last_record->uhid_number_format) {
                $ipd_uhid_number_next = $ipd_uhid_number;
            }

            $response = array(
                'ipd_number' => $ipd_ipd_prefix . str_pad($ipd_ipd_number_next, $ipd_ipd_number_len, 0, STR_PAD_LEFT),
                'uhid_number' => $ipd_uhid_prefix . str_pad($ipd_uhid_number_next, $ipd_uhid_number_len, 0, STR_PAD_LEFT),

                'ipd_number_used' => intval($ipd_ipd_number_next),
                'uhid_number_used' => intval($ipd_uhid_number_next),
                'ipd_number_format' => $ipd_ipd_number,
                'ipd_number_prefix' => $ipd_ipd_prefix,
                'uhid_number_format' => $ipd_uhid_number,
                'uhid_number_prefix' => $ipd_uhid_prefix,
            );
        } else {
            $response = array(
                'ipd_number' => $ipd_ipd_prefix . $ipd_ipd_number,
                'uhid_number' => $ipd_uhid_prefix . $ipd_uhid_number,

                'ipd_number_used' => intval($ipd_ipd_number),
                'uhid_number_used' => intval($ipd_uhid_number),
                'ipd_number_format' => $ipd_ipd_number,
                'ipd_number_prefix' => $ipd_ipd_prefix,
                'uhid_number_format' => $ipd_uhid_number,
                'uhid_number_prefix' => $ipd_uhid_prefix,
            );
        }

        return $response;
    }

    function get_unique_numbers_bk_21apr2023($patients_id = "")
    {
        $all_settings = Setting::all()->keyBy('name');

        $ipd_ipd_prefix = $all_settings['ipd_prefix']->value;
        $ipd_uhid_prefix = $all_settings['uhid_prefix']->value;

        $registration_year = date('Y');
        //$universal_year    = $all_settings['universal_year']->value;   

        //$last_record = DB::table('patients')->where('id', 'DESC')->first(); 


        $ipd_number_count_sql = "SELECT id FROM `patients` WHERE registration_year = '" . $registration_year . "'";

        $ipd_number_count = DB::select($ipd_number_count_sql);

        //dd($ipd_number_count);
        /*
          $uhid_number_count_sql = "SELECT DISTINCT new_table.uhid FROM (SELECT id as patients_id, NULL as case_master_id, uhid_number as uhid FROM patients  where registration_year = '".$registration_year."'
      UNION
      SELECT NULL as patients_id, id as case_master_id, uhid_no as uhid FROM case_master where registration_year = '".$registration_year."') as new_table WHERE new_table.uhid IS NOT NULL";
              
              $uhid_number_count = DB::select($uhid_number_count_sql);
              */
        //dd($uhid_number_count);

        //============================================================================
        $uhid_number_count_sql = "SELECT DISTINCT uhid FROM uhid_ipd_used WHERE uhid IS NOT NULL AND uhid <> '' AND registration_year = '" . $registration_year . "'";

        $uhid_number_count = DB::select($uhid_number_count_sql);

        //dd($uhid_number_count);

        $ipd_number_count_sql = "SELECT DISTINCT ipd FROM uhid_ipd_used WHERE ipd IS NOT NULL AND ipd <> '' AND registration_year = '" . $registration_year . "'";

        $ipd_number_count = DB::select($ipd_number_count_sql);

        //dd($ipd_number_count);
        //============================================================================

        $universal_ipd_number = count($ipd_number_count) + 1;
        $universal_uhid_number = count($uhid_number_count) + 1;

        $response = array(
            'ipd_number' => $ipd_ipd_prefix . '/' . $registration_year . '/' . str_pad($universal_ipd_number, 4, 0, STR_PAD_LEFT),
            'uhid_number' => $ipd_uhid_prefix . str_pad($universal_uhid_number, 4, 0, STR_PAD_LEFT) . '/' . $registration_year,

            'ipd_number_used' => intval($universal_ipd_number),
            'uhid_number_used' => intval($universal_uhid_number),
            'ipd_number_format' => '',
            'ipd_number_prefix' => $ipd_ipd_prefix,
            'uhid_number_format' => '',
            'uhid_number_prefix' => $ipd_uhid_prefix,
            'registration_year' => $registration_year

        );



        //dd($response);
        return $response;
    }

    function get_unique_numbers($patients_id = "")
    {
        $all_settings = Setting::all()->keyBy('name');

        $ipd_ipd_prefix = $all_settings['ipd_prefix']->value;
        $ipd_uhid_prefix = $all_settings['uhid_prefix']->value;

        $registration_year = date('Y');
        //$universal_year    = $all_settings['universal_year']->value;   

        //$last_record = DB::table('patients')->where('id', 'DESC')->first(); 


        $ipd_number_count_sql = "SELECT id FROM `patients` WHERE registration_year = '" . $registration_year . "'";

        $ipd_number_count = DB::select($ipd_number_count_sql);

        //dd($ipd_number_count);
        /*
          $uhid_number_count_sql = "SELECT DISTINCT new_table.uhid FROM (SELECT id as patients_id, NULL as case_master_id, uhid_number as uhid FROM patients  where registration_year = '".$registration_year."'
      UNION
      SELECT NULL as patients_id, id as case_master_id, uhid_no as uhid FROM case_master where registration_year = '".$registration_year."') as new_table WHERE new_table.uhid IS NOT NULL";
              
              $uhid_number_count = DB::select($uhid_number_count_sql);
              */
        //dd($uhid_number_count);

        //============================================================================
        $uhid_number_count_sql = "SELECT DISTINCT uhid FROM uhid_ipd_used WHERE uhid IS NOT NULL AND uhid <> '' AND registration_year = '" . $registration_year . "'";

        $uhid_number_count = DB::select($uhid_number_count_sql);

        //dd($uhid_number_count);

        $ipd_number_count_sql = "SELECT DISTINCT ipd FROM uhid_ipd_used WHERE ipd IS NOT NULL AND ipd <> '' AND registration_year = '" . $registration_year . "'";

        $ipd_number_count = DB::select($ipd_number_count_sql);

        //        dd($ipd_number_count);
        //============================================================================

        $universal_ipd_number = count($ipd_number_count) + 1;
        $universal_uhid_number = count($uhid_number_count) + 1;

        $response = array(
            'ipd_number' => $ipd_ipd_prefix . '/' . str_pad($universal_ipd_number, 4, 0, STR_PAD_LEFT) . '/' . $registration_year,
            'uhid_number' => $ipd_uhid_prefix . $registration_year . '/' . str_pad($universal_uhid_number, 4, 0, STR_PAD_LEFT),

            'ipd_number_used' => intval($universal_ipd_number),
            'uhid_number_used' => intval($universal_uhid_number),
            'ipd_number_format' => '',
            'ipd_number_prefix' => $ipd_ipd_prefix,
            'uhid_number_format' => '',
            'uhid_number_prefix' => $ipd_uhid_prefix,
            'registration_year' => $registration_year

        );



        //dd($response);
        return $response;
    }

    public function register(Request $request)
    {
        $initial_data = $this->ipd_uhid_numbers();
        $new_initial_data = $this->get_unique_numbers();
        //echo "====>>>>>>>> <pre>"; print_r($initial_data); exit;
        /*   
       $user = Auth::user()->id;
       $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');
       
       $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
       
       //dd($ipd_ward_types);
       
       $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
       
       $payment_modes_array = [];
       
       $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();

       foreach($payment_modes as $payment_modes_row) {
               $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
       }
       */
        $payment_modes_array = [];
        $helperCls = new drAppHelper();
        $all_settings = $helperCls->get_all_settings();



        $payment_modes = $all_settings['payment_modes'];
        $payment_modes_array = $all_settings['all_payment_modes'];

        $ipd_ward_types = $all_settings['ipd_ward_types'];

        $ipd_bed_numbers = $all_settings['ipd_bed_numbers'];

        $all_docotrs = $all_settings['all_docotrs'];

        //echo "<pre>"; print_r($all_docotrs); exit;

        return View('patients.registration_form', compact('doctorlist', 'payment_modes_array', 'initial_data', 'ipd_ward_types', 'ipd_bed_numbers', 'all_docotrs', 'new_initial_data'));
    }

    public function save(Request $request)
    {
        //echo "============>>>>>>>> <pre>"; print_r($_POST); exit;


        $post_data = array(
            'registration_date_time' => $request->date_time,
            'ipd_number' => $request->ipd_no,
            'uhid_number' => $request->uhid_no,
            'first_name' => $request->patient_name,
            'middle_name' => $request->patient_middle_name,
            'last_name' => $request->patient_last_name,
            'date_of_birth' => $request->date_of_birth,
            'admission_month' => $request->admission_month,

            'age' => $request->patient_age,
            'gender' => $request->gender,
            'address' => $request->patient_address,
            'area' => $request->patient_area,
            'city' => $request->city,
            'district' => $request->district,
            'email' => $request->patient_email,

            'contact' => $request->patient_contact,
            'responsible_realtive_name' => $request->responsible_realtive_name,
            'responsible_realtive_relation' => $request->responsible_realtive_relation,
            'relative_address' => $request->relative_address,
            'relative_contact_number' => $request->relative_contact_number,
            'blood_group' => $request->blood_group,
            'marital_status' => $request->marital_status,

            'weight' => $request->weight,
            'height' => $request->height,
            'admission_date_time' => $request->admission_date_time,
            'consulting_doctor' => $request->consulting_doctor,
            'referring_doctor' => $request->referring_doctor,
            'ward_type' => $request->ward_type,
            'bed_number' => $request->bed_number,

            'created_by' => Auth::user()->id,

            'ipd_number_used' => $request->ipd_number_used,
            'uhid_number_used' => $request->uhid_number_used,
            'ipd_number_format' => $request->ipd_number_format,
            'ipd_number_prefix' => $request->ipd_number_prefix,
            'uhid_number_format' => $request->uhid_number_format,
            'uhid_number_prefix' => $request->uhid_number_prefix,


            'adhar_card_number' => $request->adhar_card_number,
            'admission_type' => $request->admission_type,

            'tpa_company' => $request->tpa_company,
            'insurance_company' => $request->insurance_company,

            'registration_year' => $request->registration_year,
            'uhid_suggested' => $request->uhid_suggested,
            'ipd_number_suggested' => $request->ipd_number_suggested,
            'consultant' => $request->consultant
        );

        if ($request->is_consent_form) {
            $post_data['icu_out_date'] = $request->icu_out_date;
            $post_data['discharge_date_time'] = $request->discharge_date_time;
            $post_data['provisional_diagnosis'] = $request->provisional_diagnosis;
            $post_data['transfered'] = $request->transfered;
            $post_data['transferred_date_time'] = $request->transferred_date_time;
        } else {
            $post_data['advance_amount'] = $request->advance_amount;
            $post_data['payment_mode'] = $request->payment_mode;
            $post_data['payment_id_number'] = $request->payment_id_number;
        }



        //echo "=========>>>>>>> <pre>"; print_r($post_data); exit;


        if ($request->registration_id) {
            DB::table('patients')->where('id', $request->registration_id)->update($post_data);

            if ($request->is_consent_form) {
                if ($request->submit == 'print_consent') {
                    return redirect('/patients/print-consent/' . $request->registration_id . '/consent');
                }

                return redirect()->back()->with('flash_message', 'Consent details updated successfully.');
            } else if ($request->advance_amount) {
                $this->save_advance_payment($request->registration_id, $request);
            }

            //========================================================
            $registration_year = date('Y');

            $uhid_ipd_used_data = ['uhid' => $request->uhid_no, 'ipd' => $request->ipd_no, 'patient_id' => $request->registration_id, 'registration_year' => $registration_year];
            // dd($uhid_ipd_used_data);
            DB::table('uhid_ipd_used')->insert($uhid_ipd_used_data);
            //========================================================

            return redirect()->back()->with('flash_message', 'Patient details updated successfully.');
        } else {
            //DB::table('patients')->insert($post_data);

            $new_patient = patientRegister::create($post_data);

            $all_settings = Setting::all()->keyBy('name');

            //dd($all_settings);
            $registration_id = $new_patient->id;
            if ($request->advance_amount) {
                //$registration_id = DB::getPdo()->lastInsertId();


                $registration_id = $new_patient->id;

                DB::table('patients_ipd_patient_bill')->insert(['register_id' => $registration_id]);
                DB::table('patients_discharge')->insert(['registration_id' => $registration_id]);
                DB::table('patients_ipd_patients_estimate_bills')->insert(['registration_id' => $registration_id]);



                $this->save_advance_payment($registration_id, $request);
            }

            //========================================================
            $registration_year = date('Y');

            $uhid_ipd_used_data = ['uhid' => $request->uhid_no, 'ipd' => $request->ipd_no, 'patient_id' => $registration_id, 'registration_year' => $registration_year];
            // dd($uhid_ipd_used_data);
            DB::table('uhid_ipd_used')->insert($uhid_ipd_used_data);
            //========================================================

            return redirect()->back()->with('flash_message', 'Patient details saved successfully.');
        }
    }

    function create_receipt_number($id)
    {
        return $receipt_number = str_pad($id, 6, "0", STR_PAD_LEFT);
    }

    public function save_advance_payment($registration_id, $request)
    {
        //DB::table('patient_payments')->where('id', $registration_id)->update('status', '0');

        $payment_data = DB::table('patient_payments')->where('id', $registration_id)->first();

        $insert_data = array(
            'registration_id' => $registration_id,
            'type' => 'advance',
            'advance_amount' => $request->advance_amount,
            'advance_amount' => $request->advance_amount,
            'payment_mode' => $request->payment_mode,
            'payment_id_number' => $request->payment_id_number,
            'status' => '1'
            // 'created_by'                    => Auth::user()->id
        );

        if ($payment_data) {
            // echo "===========".__LINE__; exit;

            //$payment_data = DB::table('patient_payments')->where('advance_amount', $request->advance_amount)->where('payment_mode', $request->payment_mode)->where('payment_id_number', $request->payment_id_number)->first();
            //dd($payment_data);
            //if(!$payment_data) {
            $insert_data['date_time'] = $request->date_time;
            $insert_data['updated_by'] = Auth::user()->id;

            DB::table('patient_payments')->where('id', $registration_id)->update($insert_data);
            // }
        } else {
            // echo "===========".__LINE__; exit;
            $insert_data['created_by'] = Auth::user()->id;

            $insert_data['date_time'] = $request->date_time;

            DB::table('patient_payments')->insert($insert_data);
            $payment_id = DB::getPdo()->lastInsertId();

            //echo "=====$payment_id======".__LINE__; exit;

            $receipt_number = $this->create_receipt_number($payment_id);

            DB::table('patient_payments')->where('id', $payment_id)->update(['receipt_number' => $receipt_number]);
        }


    }

    public function advance_payment_receipt($receipt_id = "")
    {
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $payment_modes_array = [];
        $payment_modes = PaymentModes::all();

        foreach ($payment_modes as $payment_modes_row) {
            $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }

        return View('patients.advance_amount_payment_receipt', compact('doctorlist', 'payment_modes_array'));
    }

    public function print_advance_payment_receipt($registration_id = "")
    {
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $payment_modes_array = [];
        $payment_modes = PaymentModes::all();

        foreach ($payment_modes as $payment_modes_row) {
            $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }

        $payment_data = DB::table('patient_payments')->where('registration_id', $registration_id)->first();
        $registration_data = DB::table('patients')->where('id', $registration_id)->first();

        //dd($payment_data);

        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();

        return View('patients.advance_receipt_print', compact('doctorlist', 'payment_modes_array', 'payment_data', 'registration_data', 'logoUrl', 'FooterUrl'));
    }

    public function edit_patient($registration_id = "")
    {
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $registration_data = DB::table('patients')->where('id', $registration_id)->first();

        /*
        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();
        
       
        
        //dd($registration_data);
        
        $payment_modes_array = [];
        //$payment_modes = PaymentModes::all();

        foreach($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }
        */

        $payment_modes_array = [];
        $helperCls = new drAppHelper();
        $all_settings = $helperCls->get_all_settings();



        $payment_modes = $all_settings['payment_modes'];
        $payment_modes_array = $all_settings['all_payment_modes'];

        $ipd_ward_types = $all_settings['ipd_ward_types'];

        $ipd_bed_numbers = $all_settings['ipd_bed_numbers'];

        $all_docotrs = $all_settings['all_docotrs'];

        return View('patients.edit_form', compact('doctorlist', 'payment_modes_array', 'registration_data', 'ipd_ward_types', 'ipd_bed_numbers', 'all_docotrs'));

    }

    function get_ward_bed_payment($registration_id)
    {
        $registration_data = Patients::where('id', $registration_id)->first();

        $ipd_ward = IpdPatientsDropdowns::where('id', $registration_data->ward_type)->first();
        $ipd_bed = IpdPatientsDropdowns::where('id', $registration_data->bed_number)->first();
        $ipd_payment_mode = IpdPatientsDropdowns::where('id', $registration_data->payment_mode)->first();

        // dd($ipd_bed);
        return $data = array(
            'ward_type' => $ipd_ward->name,
            'bed_number' => $ipd_bed->name,
            'payment_mode' => $ipd_payment_mode->name,
        );
    }

    public function patients_registration_print($registration_id = "", $is_consent = "")
    {

        $ward_bed_payment_data = $this->get_ward_bed_payment($registration_id);

        //dd($ward_bed_payment_data);

        //echo "============= : ".$is_consent; exit;
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        //$registration_data = DB::table('patients')->where('id', $registration_id)->first();

        $registration_data = Patients::where('id', $registration_id)->first();


        /*
        $payment_modes_array = [];
        
        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();

        foreach($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }
        */

        $payment_modes_array = [];
        $helperCls = new drAppHelper();
        $all_settings = $helperCls->get_all_settings();

        $payment_modes = $all_settings['payment_modes'];
        $payment_modes_array = $all_settings['all_payment_modes'];

        $ipd_ward_types = $all_settings['ipd_ward_types'];

        $ipd_bed_numbers = $all_settings['ipd_bed_numbers'];

        $all_docotrs = $all_settings['all_docotrs'];


        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();

        //        /dd();

        //return View('patients.registration_form_print', compact('doctorlist', 'payment_modes_array', 'registration_data', 'logoUrl', 'FooterUrl'));
        if ($is_consent) {
            return View('patients.patients_consent_print', compact('doctorlist', 'payment_modes_array', 'registration_data', 'logoUrl', 'FooterUrl', 'ipd_ward_types', 'ipd_bed_numbers', 'ward_bed_payment_data', 'all_docotrs'));
        } else {
            return View('patients.registration_print', compact('doctorlist', 'payment_modes_array', 'registration_data', 'logoUrl', 'FooterUrl', 'ipd_ward_types', 'ipd_bed_numbers', 'ward_bed_payment_data', 'all_docotrs'));
        }
    }

    public function save_advance_payment_receipt(Request $request)
    {
        //DB::table('patient_payments')->where('id', $registration_id)->update('status', '0');

        $payment_data = DB::table('patient_payments')->where('id', $request->registration_id)->first();

        $insert_data = array(
            'advance_towards' => $request->registration_id,
            'type' => 'advance',
            'advance_amount' => $request->advance_amount,
            'advance_amount' => $request->advance_amount,
            'payment_mode' => $request->payment_mode,
            'payment_id_number' => $request->payment_id_number,
            // 'created_by'                    => Auth::user()->id
        );

        //dd($_POST);
        if ($payment_data) {
            //echo "===========".__LINE__; exit;

            $payment_data = DB::table('patient_payments')->where('advance_amount', $request->advance_amount)->where('payment_mode', $request->payment_mode)->where('payment_id_number', $request->payment_id_number)->first();

            if (!$payment_data) {
                $insert_data['updated_by'] = Auth::user()->id;

                DB::table('patient_payments')->where('id', $request->registration_id)->update($insert_data);
            }
        } else {
            //echo "===========".__LINE__; exit;
            $insert_data['created_by'] = Auth::user()->id;

            DB::table('patient_payments')->insert($insert_data);
            $payment_id = DB::getPdo()->lastInsertId();

            //echo "=====$payment_id======".__LINE__; exit;

            $receipt_number = $this->create_receipt_number($payment_id);

            DB::table('patient_payments')->where('id', $payment_id)->update(['receipt_number' => $receipt_number]);
        }
    }

    public function consent($registration_id = "")
    {
        $user = Auth::user()->id;
        // $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $patient_consent_form = DB::table('patient_consent_form')->where('patient_id', $registration_id)->first();

        //dd($registration_data);

        // $payment_modes_array = [];
        // $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        // $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        // $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();

        // foreach ($payment_modes as $payment_modes_row) {
        //     $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        // }

        // dd($registration_data);


        // return View('patients.consent_form', compact('doctorlist', 'payment_modes_array', 'registration_data', 'ipd_ward_types', 'ipd_bed_numbers'));
        return View('patients.consent_form_new', compact('patient_consent_form','registration_id'));

    }
    public function consent_print($registration_id = "", $is_consent = "")
    {

        $user = Auth::user()->id;
        // $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $patient_consent_form = DB::table('patient_consent_form')->where('patient_id', $registration_id)->first();

        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();

        //dd($patient_consent_form);

        //return View('patients.registration_form_print', compact('doctorlist', 'payment_modes_array', 'registration_data', 'logoUrl', 'FooterUrl'));
        if ($is_consent) {
            return View('patients.print_patient_consent', compact('patient_consent_form', 'logoUrl', 'FooterUrl'));
        } else {
            return View('patients.print_patient_consent', compact('patient_consent_form', 'logoUrl', 'FooterUrl'));
        }
    }
    public function save_consent(Request $request) {
        $patients_consent_records = DB::table('patient_consent_form')->where('patient_id', $request->registration_id)->first();
          
          if($patients_consent_records) {
            DB::table('patient_consent_form')->where('patient_id', $request->registration_id)->update(
                [
                  'patient_id' => $request->registration_id,
                  'performance_upon' => $request->performance_upon,
                  'surgery' => $request->surgery,
                  'treatment' => $request->treatment,
                  'treatment_dr' => $request->treatment_dr,
                  'required_dr' => $request->required_dr,
                  'patient_name_surg' => $request->patient_name_surg,
                  'patient_signature_surg' => $request->patient_signature_surg,
                  'patient_age_surg' => $request->patient_age_surg,
                  'patient_date_surg' => $request->patient_date_surg,
                  'patient_time_surg' => $request->patient_time_surg,
                  'witness_first_surg' => $request->witness_first_surg,
                  'witness_first_sign_surg' => $request->witness_first_sign_surg,
                  'witness_first_surg_age' => $request->witness_first_surg_age,
                  'witness_first_surg_date' => $request->witness_first_surg_date,
                  'witness_first_surg_time' => $request->witness_first_surg_time,
                  'witness_second_surg' => $request->witness_second_surg,
                  'witness_second_sign_surg' => $request->witness_second_sign_surg,
                  'witness_second_surg_age' => $request->witness_second_surg_age,
                  'witness_second_surg_date' => $request->witness_second_surg_date,
                  'witness_second_surg_time' => $request->witness_second_surg_time,
                  'admission_by_surg' => $request->admission_by_surg,
                  'authorized_sign_surg' => $request->authorized_sign_surg,
                  'patient_gen_name' => $request->patient_gen_name,
                  'patient_gen_age' => $request->patient_gen_age,
                  'patient_address' => $request->patient_address,
                  'under_care_of_dr' => $request->under_care_of_dr,
                  'patient_name_gen' => $request->patient_name_gen,
                  'patient_sign_gen' => $request->patient_sign_gen,
                  'patient_date_gen' => $request->patient_date_gen,
                  'patient_time_gen' => $request->patient_time_gen,
                  'witness_name_gen' => $request->witness_name_gen,
                  'witness_sign_gen' => $request->witness_sign_gen,
                  'witness_date_gen' => $request->witness_date_gen,
                  'witness_time_gen' => $request->witness_time_gen,
                  'addmission_by_gen' => $request->addmission_by_gen,
                  'authorized_sign_gen' => $request->authorized_sign_gen,
                ]
            );
          } else {
             DB::table('patient_consent_form')->insert([
                 'patient_id' => $request->registration_id,
                  'performance_upon' => $request->performance_upon,
                  'surgery' => $request->surgery,
                  'treatment' => $request->treatment,
                  'treatment_dr' => $request->treatment_dr,
                  'required_dr' => $request->required_dr,
                  'patient_name_surg' => $request->patient_name_surg,
                  'patient_signature_surg' => $request->patient_signature_surg,
                  'patient_age_surg' => $request->patient_age_surg,
                  'patient_date_surg' => $request->patient_date_surg,
                  'patient_time_surg' => $request->patient_time_surg,
                  'witness_first_surg' => $request->witness_first_surg,
                  'witness_first_sign_surg' => $request->witness_first_sign_surg,
                  'witness_first_surg_age' => $request->witness_first_surg_age,
                  'witness_first_surg_date' => $request->witness_first_surg_date,
                  'witness_first_surg_time' => $request->witness_first_surg_time,
                  'witness_second_surg' => $request->witness_second_surg,
                  'witness_second_sign_surg' => $request->witness_second_sign_surg,
                  'witness_second_surg_age' => $request->witness_second_surg_age,
                  'witness_second_surg_date' => $request->witness_second_surg_date,
                  'witness_second_surg_time' => $request->witness_second_surg_time,
                  'admission_by_surg' => $request->admission_by_surg,
                  'authorized_sign_surg' => $request->authorized_sign_surg,
                  'patient_gen_name' => $request->patient_gen_name,
                  'patient_gen_age' => $request->patient_gen_age,
                  'patient_address' => $request->patient_address,
                  'under_care_of_dr' => $request->under_care_of_dr,
                  'patient_name_gen' => $request->patient_name_gen,
                  'patient_sign_gen' => $request->patient_sign_gen,
                  'patient_date_gen' => $request->patient_date_gen,
                  'patient_time_gen' => $request->patient_time_gen,
                  'witness_name_gen' => $request->witness_name_gen,
                  'witness_sign_gen' => $request->witness_sign_gen,
                  'witness_date_gen' => $request->witness_date_gen,
                  'witness_time_gen' => $request->witness_time_gen,
                  'addmission_by_gen' => $request->addmission_by_gen,
                  'authorized_sign_gen' => $request->authorized_sign_gen,
             ]);
          }
          
          if($request->submit) {
             return redirect()->back()->with('flash_message', 'Patient consent form updated successfully.');
          } else {
             return redirect('/patients/print-patient-consent/'.$request->registration_id);
          }
     }
         
    public function discharge($registration_id = "")
    {
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $registration_data = DB::table('patients')->where('id', $registration_id)->first();

        $discharge_data = DB::table('patients_discharge')->where('registration_id', $registration_id)->first();

        //dd($registration_data);

        $payment_modes_array = [];
        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();

        foreach ($payment_modes as $payment_modes_row) {
            $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }

        // dd($registration_data);
        //------------------------------------------------------------------------------------------
        $presDropdowns = [
            'prescriptions' => patients_prescription_lists::where('registration_id', $registration_id)->get(),
            'medicinlist' => entmedical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get(),

            'numberOfTimes_drpdwn' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText'),
            'quantity' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText'),
            'medicine_strength' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText')
        ];

        $templates = DB::table('ent_prescription_templates')->where('parent', 0)->get();
        // dd($presDropdowns);
        //-------------------------------------------------------------------------------------------

        $ipd_doctors = IpdPatientsDropdowns::where('type', 'ipd_doctor')->get();

        foreach ($ipd_doctors as $ipd_doctor) {
            $all_doctors[$ipd_doctor->id] = $ipd_doctor->name;
        }

        $discharge_summary_data = DB::table('new_discharge_summary')->where('registration_id', $registration_id)->get();
        $discharge_summary = $this->convert_to_data_object($discharge_summary_data, []);


        //echo "=>>>>>>>>> <pre>"; print_r($discharge_summary); exit;
        return View('patients.discharge.discharge_add', compact('doctorlist', 'payment_modes_array', 'registration_data', 'discharge_data', 'presDropdowns', 'templates', 'ipd_ward_types', 'ipd_bed_numbers', 'all_doctors', 'discharge_summary'));

    }

    public function discharge_old($registration_id = "")
    {
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $registration_data = DB::table('patients')->where('id', $registration_id)->first();

        $discharge_data = DB::table('patients_discharge')->where('registration_id', $registration_id)->first();

        //dd($registration_data);

        $payment_modes_array = [];
        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();

        foreach ($payment_modes as $payment_modes_row) {
            $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }

        // dd($registration_data);
        //------------------------------------------------------------------------------------------
        $presDropdowns = [
            'prescriptions' => patients_prescription_lists::where('registration_id', $registration_id)->get(),
            'medicinlist' => entmedical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get(),

            'numberOfTimes_drpdwn' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText'),
            'quantity' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText'),
            'medicine_strength' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText')
        ];

        $templates = DB::table('ent_prescription_templates')->where('parent', 0)->get();
        // dd($presDropdowns);
        //-------------------------------------------------------------------------------------------

        $ipd_doctors = IpdPatientsDropdowns::where('type', 'ipd_doctor')->get();

        foreach ($ipd_doctors as $ipd_doctor) {
            $all_doctors[$ipd_doctor->id] = $ipd_doctor->name;
        }

        return View('patients.discharge.discharge_add', compact('doctorlist', 'payment_modes_array', 'registration_data', 'discharge_data', 'presDropdowns', 'templates', 'ipd_ward_types', 'ipd_bed_numbers', 'all_doctors'));

    }

    public function save_discharge_old(Request $request)
    {
        //echo "=======>>>>>>>>> <pre>"; print_r($_POST); exit;

        $post_data = array(
            'registration_id' => $request->registration_id,
            'discharge_summary_date_time' => $request->date_time,
            'discharge_date_time' => $request->discharge_date_time,
            'diagnosis' => $request->diagnosis,
            'history_clinical_findings' => $request->history_clinical_findings,
            'on_examination' => $request->on_examination,
            'operative_procedure' => $request->operative_procedure,
            'investigation' => $request->investigation,
            'surgical_maternity_notes' => $request->surgical_maternity_notes,

            'treatment_given' => $request->treatment_given,
            'treatment_advice' => $request->treatment_advice,
            'treatment_on_discharge' => $request->treatment_on_discharge,
            'followup_1' => $request->followup_1,
            'followup_2' => $request->followup_2,
            'followup_3' => $request->followup_3,
            'followup_4' => $request->followup_4,

            'created_by' => Auth::user()->id
        );

        if ($request->discharge_id) {
            DB::table('patients_discharge')->where('id', $request->discharge_id)->update($post_data);

            return redirect()->back()->with('flash_message', 'Discharge details updated successfully.');
        } else {
            DB::table('patients_discharge')->insert($post_data);

            return redirect()->back()->with('flash_message', 'Discharge details saved successfully.');
        }
    }

    public function patients_discharge_print($discharge_id = "")
    {



        //echo "============= : ".$is_consent; exit;
        $user = Auth::user()->id;

        $registration_data = DB::table('patients')->where('id', $discharge_id)->first();

        //dd($registration_data);
        $discharge_data = DB::table('patients_discharge')->where('registration_id', $discharge_id)->first();

        //$registration_data = DB::table('patients')->where('id', $discharge_data->registration_id)->first();

        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        //$priscriptions_data = patients_prescription_lists::where('registration_id', $discharge_data->registration_id)->get();

        $priscriptions_data = patients_prescription_lists::where('registration_id', $discharge_id)->get();
        //echo "==========> <pre>"; print_r($discharge_data); exit;

        $payment_modes_array = [];

        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();

        foreach ($payment_modes as $payment_modes_row) {
            $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }


        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();

        //dd($discharge_data);
        $ipd_doctors = IpdPatientsDropdowns::where('type', 'ipd_doctor')->get();

        foreach ($ipd_doctors as $ipd_doctor) {
            $all_doctors[$ipd_doctor->id] = $ipd_doctor->name;
        }

        $discharge_summary_data = DB::table('new_discharge_summary')->where('registration_id', $registration_data->id)->get();
        $discharge_summary = $this->convert_to_data_object($discharge_summary_data, []);

        //echo "====>>>>>>>>>>>>>> <pre>"; print_r($discharge_summary); exit;

        return View('patients.discharge.discharge_print', compact('doctorlist', 'payment_modes_array', 'registration_data', 'discharge_data', 'logoUrl', 'FooterUrl', 'ipd_ward_types', 'ipd_bed_numbers', 'priscriptions_data', 'all_doctors', 'discharge_summary'));

    }


    //---------------------------------- Prescription ----------------------------------------

    public function edit_prescription($id = "")
    {

        $user = Auth::user()->id;

        //echo "================ : ".__LINE__; exit; 

        $getdata = [];
        //return $getdata;
        $presDropdowns = [
            'medicinlist' => entmedical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get(),

            'numberOfTimes_drpdwn' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText'),
            'quantity' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText'),
            'medicine_strength' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText')
        ];
        //return $presDropdowns;
        // $mergeArray = array_merge($getdata, $presDropdowns);


        //dd($presDropdowns);

        $templates = DB::table('ent_prescription_templates')->where('parent', 0)->get();

        //return $mergeArray;
        return view('patients.prescriptions.medicine_prescription', ['casedata' => $presDropdowns, 'templates' => $templates]);

    }


    public function update_patients_prescription(Request $request)
    {

        //echo "========>>>>>>>>> <pre>"; print_r($_POST); exit;
        //check which submit was clicked on
        if (Input::get('prescription_save')) {
            $this->save_prescription($request); //if login then use this method
            return redirect()->back()->with('flash_message', 'Message Saved successfully');
        }
        if (Input::get('prescription_delete')) {
            $this->deletePrescription($request); //if register then use this method
            return redirect()->back()->with('flash_message', 'Message Deleted successfully');
        }
    }

    public function save_prescription(Request $request)
    {
        try {
            if ($request['prescription_type'] == "new") {

                $medicalStore = entmedical_store::find($request['medicine_id']);

                $preslist = new patients_prescription_lists;
                $preslist->registration_id = $request['registration_id'];
                $preslist->medicine_id = $request['medicine_id'];
                $preslist->medicine_Quntity = empty($request['medicine_quantity']) ? 0 : $request['medicine_quantity'];
                $preslist->numberoftimes = $request['numberoftimes'];
                $preslist->strength = $request['strength'];
                $preslist->per_unit_cost = $medicalStore->unit_price;
                $preslist->case_id = $request->id;
                $preslist->no_of_days = $request->no_of_days;
                $preslist->save();
                // \LogActivity::addToLog('Prescription saved successfully');
                $request['prescriptions'] = patients_prescription_lists::where('case_id', $request->id)->get();
            } else {

                foreach ($request['template_medicine_id'] as $current_key => $current_val) {
                    $medicalStore = entmedical_store::find($current_val);

                    //dd($medicalStore);

                    $preslist = new patients_prescription_lists;
                    $preslist->registration_id = $request['registration_id'];
                    $preslist->medicine_id = $current_val;
                    $preslist->medicine_Quntity = empty($request['template_medicine_quantity'][$current_key]) ? 0 : $request['template_medicine_quantity'][$current_key];
                    $preslist->numberoftimes = $request['template_numberoftimes'][$current_key];
                    $preslist->strength = $request['template_strength'][$current_key];
                    $preslist->per_unit_cost = $medicalStore->unit_price;
                    $preslist->case_id = $request->id;
                    $preslist->no_of_days = null;
                    $preslist->save();
                }
            }

        } catch (Execption $e) {
            //throw $e;
        }
        //dd($request);

        //return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
        //return redirect()->back()->withInput()->with('flash_message', 'Record added successfully');
    }



    public function deletePrescription(Request $request)
    {
        $prescription_list = patients_prescription_lists::find($request['prescription_delete']);
        if ($prescription_list === null) {
            return redirect()->back()->withInput()->withErrors(array('message' => 'No prescription found.'));
        }

        $prescription_list->delete();
        // \LogActivity::addToLog('Prescription deleted successfully');

        $request['prescriptions'] = patients_prescription_lists::where('registration_id', $request->registration_id)->get();
        return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
    }

    public function admission_consent($registration_id = "", $is_consent = "")
    {

        $ward_bed_payment_data = $this->get_ward_bed_payment($registration_id);

        //dd($ward_bed_payment_data);

        //echo "============= : ".$is_consent; exit;
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        //$registration_data = DB::table('patients')->where('id', $registration_id)->first();

        $registration_data = Patients::where('id', $registration_id)->first();


        /*
        $payment_modes_array = [];
        
        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();

        foreach($payment_modes as $payment_modes_row) {
                $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }
        */

        $payment_modes_array = [];
        $helperCls = new drAppHelper();
        $all_settings = $helperCls->get_all_settings();

        $payment_modes = $all_settings['payment_modes'];
        $payment_modes_array = $all_settings['all_payment_modes'];

        $ipd_ward_types = $all_settings['ipd_ward_types'];

        $ipd_bed_numbers = $all_settings['ipd_bed_numbers'];

        $all_docotrs = $all_settings['all_docotrs'];


        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();

        //        /dd();

        //return View('patients.registration_form_print', compact('doctorlist', 'payment_modes_array', 'registration_data', 'logoUrl', 'FooterUrl'));
        if ($is_consent) {
            return View('patients.patients_consent_print', compact('doctorlist', 'payment_modes_array', 'registration_data', 'logoUrl', 'FooterUrl', 'ipd_ward_types', 'ipd_bed_numbers', 'ward_bed_payment_data', 'all_docotrs'));
        } else {
            return View('patients.admission_consent_print', compact('doctorlist', 'payment_modes_array', 'registration_data', 'logoUrl', 'FooterUrl', 'ipd_ward_types', 'ipd_bed_numbers', 'ward_bed_payment_data', 'all_docotrs'));
        }
    }

    public function patients_delete(Request $request)
    {
        DB::table('patients')->where('id', $request->id)->update(['is_deleted' => '1']);
        return redirect()->back()->withInput()->with('flash_message', 'Record deleted successfully');
    }

    public function patients_history_sheet($registration_id = "")
    {
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $registration_data = DB::table('patients')->where('id', $registration_id)->first();

        $discharge_data = DB::table('patients_discharge')->where('registration_id', $registration_id)->first();

        //dd($registration_data);

        $payment_modes_array = [];
        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();

        foreach ($payment_modes as $payment_modes_row) {
            $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }

        // dd($registration_data);
        //------------------------------------------------------------------------------------------
        $presDropdowns = [
            'prescriptions' => patients_prescription_lists::where('registration_id', $registration_id)->get(),
            'medicinlist' => entmedical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get(),

            'numberOfTimes_drpdwn' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText'),
            'quantity' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText'),
            'medicine_strength' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText')
        ];

        $templates = DB::table('ent_prescription_templates')->where('parent', 0)->get();
        // dd($presDropdowns);
        //-------------------------------------------------------------------------------------------

        $ipd_doctors = IpdPatientsDropdowns::where('type', 'ipd_doctor')->get();

        foreach ($ipd_doctors as $ipd_doctor) {
            $all_doctors[$ipd_doctor->id] = $ipd_doctor->name;
        }

        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();

        $form_dropdowns_array = $this->get_form_dropdowns_array();
        $dropdown_options_table_name = 'form_dropdowns';

        $form_details = eyeform::where('case_id', $case_id)->first();

        //dd($form_details);
        //echo "=>>>>>>>>> <pre>"; print_r($discharge_data); exit;
        //$form_details = [];
        //echo "=>>>>>>>>> <pre>"; print_r($registration_data); exit;


        $patients_history_sheet_data = DB::table('patients_history_sheet')->where('registration_id', $registration_id)->get();
        $patients_history_sheet = $this->convert_to_data_object($patients_history_sheet_data, ['provisional_diagnosis']);
        //echo "<hr>=======>>>>>11111111111>>>>>>> <pre>"; print_r($patients_history_sheet); exit;

        return View('patients.discharge.patients_history_sheet', compact('doctorlist', 'payment_modes_array', 'registration_data', 'discharge_data', 'presDropdowns', 'templates', 'ipd_ward_types', 'ipd_bed_numbers', 'all_doctors', 'form_dropdowns', 'form_details', 'patients_history_sheet'));

    }

    public function patients_history_sheet_print($registration_id = "")
    {
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $registration_data = DB::table('patients')->where('id', $registration_id)->first();

        $discharge_data = DB::table('patients_discharge')->where('registration_id', $registration_id)->first();

        //dd($registration_data);

        $payment_modes_array = [];
        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();

        foreach ($payment_modes as $payment_modes_row) {
            $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }

        // dd($registration_data);
        //------------------------------------------------------------------------------------------
        $presDropdowns = [
            'prescriptions' => patients_prescription_lists::where('registration_id', $registration_id)->get(),
            'medicinlist' => entmedical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get(),

            'numberOfTimes_drpdwn' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText'),
            'quantity' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText'),
            'medicine_strength' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText')
        ];

        $templates = DB::table('ent_prescription_templates')->where('parent', 0)->get();
        // dd($presDropdowns);
        //-------------------------------------------------------------------------------------------

        $ipd_doctors = IpdPatientsDropdowns::where('type', 'ipd_doctor')->get();

        foreach ($ipd_doctors as $ipd_doctor) {
            $all_doctors[$ipd_doctor->id] = $ipd_doctor->name;
        }

        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();

        $form_dropdowns_array = $this->get_form_dropdowns_array();
        $dropdown_options_table_name = 'form_dropdowns';

        $form_details = eyeform::where('case_id', $case_id)->first();

        //dd($form_details);
        //echo "=>>>>>>>>> <pre>"; print_r($discharge_data); exit;
        //$form_details = [];
        //echo "=>>>>>>>>> <pre>"; print_r($registration_data); exit;


        $patients_history_sheet_data = DB::table('patients_history_sheet')->where('registration_id', $registration_id)->get();
        $patients_history_sheet = $this->convert_to_data_object($patients_history_sheet_data, ['provisional_diagnosis']);
        //echo "<hr>=======>>>>>11111111111>>>>>>> <pre>"; print_r($patients_history_sheet); exit;

        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();

        return View('patients.discharge.patients_history_sheet_print', compact('doctorlist', 'payment_modes_array', 'registration_data', 'discharge_data', 'presDropdowns', 'templates', 'ipd_ward_types', 'ipd_bed_numbers', 'all_doctors', 'form_dropdowns', 'form_details', 'patients_history_sheet', 'FooterUrl', 'logoUrl'));

    }

    function convert_to_data_object($data, $dropdowns)
    {
        foreach ($data as $data_row) {
            if (in_array($data_row->field_name, $dropdowns)) {
                $final_data[$data_row->field_name][] = $data_row;
            } else {
                $final_data[$data_row->field_name] = $data_row;
            }
        }
        return $final_data;
    }

    public function save_history_sheet(Request $request)
    {


        //echo "=======>>>>>11111111111>>>>>>> <pre>"; print_r($request->all()); exit;

        $registration_id = $request->registration_id;

        //====================================================================
        $post_data = array(
            //'ipd_number'                    => $request->ipd_no,
            //'uhid_number'                   => $request->uhid_no,
            //'first_name'                    => $request->patient_name,
            //'middle_name'                   => $request->patient_middle_name,
            //'last_name'                     => $request->patient_last_name,
            //'date_of_birth'                 => $request->date_of_birth,

            'age' => $request->patient_age,
            'gender' => $request->gender,
            //'address'                       => $request->address,
            //'area'                          => $request->patient_area,
            //'city'                          => $request->city,
            //'district'                      => $request->district,
            //'email'                         => $request->patient_email,

            'weight' => $request->weight,
            'height' => $request->height,

        );
        if ($request->registration_id) {
            DB::table('patients')->where('id', $request->registration_id)->update($post_data);
        }
        //====================================================================

        foreach ($request->all() as $request_key => $request_row) {
            if (in_array($request_key, ['date_time', 'chief_complaints', 'systemic_examination', 'local_examination', 'past_history', 'personal_history', 'family_history', 'proctoscopy', 'menstrual_history', 'treatment_history', 'drug_allergies', 'final_notes'])) {

                $insert_data = ['field_name' => $request_key, 'registration_id' => $registration_id, 'value_1' => $request_row];

                $where = ['field_name' => $request_key, 'registration_id' => $registration_id];

                //echo "<hr>=======>>>>>11111111111>>>>>>> <pre>"; print_r($insert_data);
                DB::table('patients_history_sheet')->updateOrInsert($insert_data, $where);
            }

            if (in_array($request_key, ['provisional_diagnosis'])) {
                foreach ($request->provisional_diagnosis_od as $dropdown_key => $dropdown_val) {
                    if ($dropdown_val) {
                        $insert_data = ['field_name' => $request_key, 'registration_id' => $registration_id, 'value_1' => $dropdown_val];

                        DB::table('patients_history_sheet')->Insert($insert_data);
                    }
                }
            }
        }

        //echo "=======>>>>>11111111111>>>>>>> <pre>"; print_r($request->all()); exit;

        return redirect()->back()->with('flash_message', 'Consent details updated successfully.');


    }

    public function save_discharge(Request $request)
    {
        $registration_id = $request->registration_id;

        //====================================================================
        $post_data = array(
            //'ipd_number'                    => $request->ipd_no,
            //'uhid_number'                   => $request->uhid_no,
            //'first_name'                    => $request->patient_name,
            //'middle_name'                   => $request->patient_middle_name,
            //'last_name'                     => $request->patient_last_name,
            //'date_of_birth'                 => $request->date_of_birth,

            'age' => $request->patient_age,
            'gender' => $request->gender,
            'address' => $request->address,
            'consultant' => $request->consultant,
            //'area'                          => $request->patient_area,
            //'city'                          => $request->city,
            //'district'                      => $request->district,
            //'email'                         => $request->patient_email,

            //'weight'                        => $request->weight,
            //'height'                        => $request->height,

        );
        if ($request->registration_id) {
            DB::table('patients')->where('id', $request->registration_id)->update($post_data);
        }
        //====================================================================

        $fields_array = [
            'date_time',
            'primary_consultant',
            'admission_date_time',
            'discharge_date_time',
            'diagnosis',
            'discharge_against_medical_advice',
            'bp_1',
            'bp_2',
            'pulse_1',
            'pulse_2',
            'rr_1',
            'rr_2',
            'rs',
            'temperature',
            'cvs',
            'consulting_doctor',
            'chief_complaints',
            'history_of_present_illness',
            'medical',
            'surgical',
            'course_in_hospital',
            'hemodynamic_condition',

            'discharge_temperature',
            'discharge_pulse_1',
            'discharge_pulse_2',
            'discharge_bp_1',
            'discharge_bp_2',
            'discharge_rr_1',
            'discharge_rr_2',
            'diet',
            'treatment_advice',
            'consult_symptoms',
            'final_notes',
            'followup_1',
            'followup_2',
            'followup_3',
            'followup_4',
            'spo2',
            'cns',
            'pa',
            'discharge_spo2',
            'discharge_notes',
            'child_sex',
            'child_date_time',
            'child_weight',
            'child_condition_at_birth',
            'child_blood_grp',
            'child_cgpd',
            'child_tsh',
            'child_bcg',
            'child_given_on_bcg',
            'child_hepb',
            'child_given_on_hepb',
            'child_opv',
            'child_given_on_opv',
            'child_sbill',
            'child_phototherapy',
            'child_weightdischarge',
        ];

        echo "<pre>";
        foreach ($request->all() as $request_key => $request_row) {
            if (in_array($request_key, $fields_array)) {
                $insert_data = ['field_name' => $request_key, 'registration_id' => $registration_id, 'value_1' => $request_row];
                $where = ['field_name' => $request_key, 'registration_id' => $registration_id];
                //echo "<hr>=======>>>>>11111111111>>>>>>> <pre>"; print_r($insert_data);
                DB::table('new_discharge_summary')->updateOrInsert( $insert_data, $where);
            }
        }
        //echo "=======>>>>>11111111111>>>>>>> <pre>"; print_r($request->all()); exit;
        return redirect()->back()->with('flash_message', 'Details updated successfully.');
    }



    public function get_form_dropdowns_array($form_name = "gyn")
    {
        $form_dropdowns_array = [];
        $form_dropdowns = [];

        $form_dropdowns = form_dropdowns::where('formName', 'EyeForm')->Orderby('ddText')->get();

        foreach ($form_dropdowns as $form_dropdowns_row) {
            $form_dropdowns_array[$form_dropdowns_row->fieldName][$form_dropdowns_row->id]['ddText'] = $form_dropdowns_row->ddText;
            $form_dropdowns_array[$form_dropdowns_row->fieldName][$form_dropdowns_row->id]['ddValue'] = $form_dropdowns_row->ddValue;
        }

        return $form_dropdowns_array;
    }

    public function discharge_2023($registration_id = "")
    {
        $user = Auth::user()->id;
        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        $registration_data = DB::table('patients')->where('id', $registration_id)->first();

        $discharge_data = DB::table('patients_discharge')->where('registration_id', $registration_id)->first();

        //dd($registration_data);

        $payment_modes_array = [];
        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();

        foreach ($payment_modes as $payment_modes_row) {
            $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }

        // dd($registration_data);
        //------------------------------------------------------------------------------------------
        $presDropdowns = [
            'prescriptions' => patients_prescription_lists::where('registration_id', $registration_id)->get(),
            'medicinlist' => entmedical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get(),

            'numberOfTimes_drpdwn' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Times a day')->pluck('ddText', 'ddText'),
            'quantity' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Quantity')->pluck('ddText', 'ddText'),
            'medicine_strength' => ent_form_dropdowns::where('formName', 'ent_prescription')->where('fieldName', 'Strength')->pluck('ddText', 'ddText')
        ];

        $templates = DB::table('ent_prescription_templates')->where('parent', 0)->get();
        // dd($presDropdowns);
        //-------------------------------------------------------------------------------------------

        $ipd_doctors = IpdPatientsDropdowns::where('type', 'ipd_doctor')->get();

        foreach ($ipd_doctors as $ipd_doctor) {
            $all_doctors[$ipd_doctor->id] = $ipd_doctor->name;
        }

        $discharge_summary_data = DB::table('new_discharge_summary')->where('registration_id', $registration_id)->get();
        $discharge_summary = $this->convert_to_data_object($discharge_summary_data, []);
        //dd($discharge_summary['child_sex']->value_1);

        $form_dropdowns = form_dropdowns::where('formName', 'discharge')->Orderby('ddText')->get();


        //echo "=>>>>>>>>> <pre>"; print_r($discharge_summary); exit;
        return View('patients.discharge.discharge_add_2023', compact('doctorlist', 'payment_modes_array', 'registration_data', 'discharge_data', 'presDropdowns', 'templates', 'ipd_ward_types', 'ipd_bed_numbers', 'all_doctors', 'discharge_summary', 'form_dropdowns'));

    }

    public function save_discharge_2023(Request $request)
    {

        // dd($_POST);
        $registration_id = $request->registration_id;

        //====================================================================
        $post_data = array(
            'age' => $request->patient_age,
            'gender' => $request->gender,
            'address' => $request->address
        );
        if ($request->registration_id) {
            DB::table('patients')->where('id', $request->registration_id)->update($post_data);
        }
        //====================================================================



        $fields_array = [
            'date_time',

            'admission_date_time',
            'discharge_date_time',

            'diagnosis',
            'clinical_profile',
            'discharge_investigation',
            'discharge_operative_labour_notes',
            'discharge_treatment_given',
            'discharge_treatment_adviced',
            'discharge_medication_explained_by',
            'discharge_histopathology',
            'discharge_condition_at_the_time',

            'discharge_pulse_1',
            'discharge_pulse_2',
            'discharge_bp_1',
            'discharge_bp_2',
            'discharge_spo2',

            'discharge_pulse_2',
            'discharge_bp_1',
            'discharge_bp_2',
            'discharge_rr_1',
            'discharge_rr_2',

            'followup_1',
            'followup_2',
            'followup_3',
            'followup_4',

            'discharge_card_received_by',
            'discharge_where_to_contact_in_emergency',
            'discharge_when_to_contact'
        ];

        foreach ($request->all() as $request_key => $request_row) {
            if (in_array($request_key, $fields_array)) {
                $insert_data = ['field_name' => $request_key, 'registration_id' => $registration_id, 'value_1' => $request_row];
                $where = ['field_name' => $request_key, 'registration_id' => $registration_id];
                //echo "<hr>=======>>>>>11111111111>>>>>>> <pre>"; print_r($insert_data);
                DB::table('new_discharge_summary')->updateOrInsert($insert_data, $where);
            }
        }
        //echo "=======>>>>>11111111111>>>>>>> <pre>"; print_r($request->all()); exit;
        return redirect()->back()->with('flash_message', 'Details updated successfully.');


    }

    public function patients_discharge_print_2023($discharge_id = "")
    {



        //echo "============= : ".$is_consent; exit;
        $user = Auth::user()->id;

        $registration_data = DB::table('patients')->where('id', $discharge_id)->first();

        //dd($registration_data);
        $discharge_data = DB::table('patients_discharge')->where('registration_id', $discharge_id)->first();

        //$registration_data = DB::table('patients')->where('id', $discharge_data->registration_id)->first();

        $doctorlist = doctor::where('isActive', 1)->orderBy('doctor_name')->pluck('doctor_name', 'id');

        //$priscriptions_data = patients_prescription_lists::where('registration_id', $discharge_data->registration_id)->get();

        $priscriptions_data = patients_prescription_lists::where('registration_id', $discharge_id)->get();
        //echo "==========> <pre>"; print_r($discharge_data); exit;

        $payment_modes_array = [];

        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();
        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();
        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();

        foreach ($payment_modes as $payment_modes_row) {
            $payment_modes_array[$payment_modes_row->id] = $payment_modes_row->name;
        }


        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        $FooterUrl = $helperCls->GetLetterFooterImageUrl();

        //dd($discharge_data);
        $ipd_doctors = IpdPatientsDropdowns::where('type', 'ipd_doctor')->get();

        foreach ($ipd_doctors as $ipd_doctor) {
            $all_doctors[$ipd_doctor->id] = $ipd_doctor->name;
        }

        $discharge_summary_data = DB::table('new_discharge_summary')->where('registration_id', $registration_data->id)->get();
        $discharge_summary = $this->convert_to_data_object($discharge_summary_data, []);

        //echo "====>>>>>>>>>>>>>> <pre>"; print_r($discharge_summary); exit;

        return View('patients.discharge.discharge_print_2023', compact('doctorlist', 'payment_modes_array', 'registration_data', 'discharge_data', 'logoUrl', 'FooterUrl', 'ipd_ward_types', 'ipd_bed_numbers', 'priscriptions_data', 'all_doctors', 'discharge_summary'));

    }
}
