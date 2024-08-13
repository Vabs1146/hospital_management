<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Setting;
use App\IpdPatientsDropdowns;
use DB;
use App\Image_gallery;
use Storage;

class IpdSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $all_settings = Setting::all()->keyBy('name');

        $payment_modes = IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->get();

        $ipd_ward_types = IpdPatientsDropdowns::where('type', 'ipd_ward_type')->get();

        $ipd_bed_numbers = IpdPatientsDropdowns::where('type', 'ipd_bed_number')->get();

        $ipd_particulars_result = IpdPatientsDropdowns::where('type', 'ipd_particulars')->get();

        $ipd_doctors = IpdPatientsDropdowns::where('type', 'ipd_doctor')->get();

        foreach ($ipd_particulars_result as $ipd_particulars_row) {
            if ($ipd_particulars_row->parent == 0) {
                $ipd_particulars[$ipd_particulars_row->id]['name'] = $ipd_particulars_row->name;
            } else {
                $ipd_particulars[$ipd_particulars_row->parent]['childs'][] = ['id' => $ipd_particulars_row->id, 'name' => $ipd_particulars_row->name, 'amount' => $ipd_particulars_row->value];
            }
        }

        return view('settings.ipd-add', compact('all_settings', 'payment_modes', 'ipd_ward_types', 'ipd_bed_numbers', 'ipd_particulars', 'ipd_doctors'));

        //echo "===========>>>>>>. <pre>".__LINE__; print_r($all_settings); exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo "====>>>>>>>>>>> <pre>"; print_r($_POST); exit;
        if ($request->has('update_ipd_hospital_name')) {

            $this->validate($request, ['ipd_hospital_name' => 'required']);

            //Setting::where('name', 'ipd_hospital_name')->update(['value' => $request->ipd_hospital_name]);

            $setting = Setting::firstOrNew(array('name' => 'ipd_hospital_name'));
            $setting->name = 'ipd_hospital_name';
            $setting->value = $request->ipd_hospital_name;
            $setting->save();

            $message = "Hospital updated successfully!";
        }

        if ($request->has('update_ipd_payment_receipt_number')) {

            $this->validate($request, ['ipd_payment_receipt_number' => 'required']);

            //Setting::where('name', 'ipd_payment_receipt_number')->update(['value' => $request->ipd_payment_receipt_number]);


            $setting = Setting::firstOrNew(array('name' => 'ipd_payment_receipt_number'));
            $setting->name = 'ipd_payment_receipt_number';
            $setting->value = $request->ipd_payment_receipt_number;
            $setting->save();

            $message = "IPD receipt number updated successfully!";
        }

        if ($request->has('update_ipd_advance_receipt_number')) {

            $this->validate($request, ['ipd_advance_receipt_number' => 'required']);

            $setting = Setting::firstOrNew(array('name' => 'ipd_advance_receipt_number'));
            $setting->name = 'ipd_advance_receipt_number';
            $setting->value = $request->ipd_advance_receipt_number;
            $setting->save();

            $message = "Advance receipt number updated successfully!";
        }

        if ($request->has('update_ipd_ipd_bill_prefix')) {

            $this->validate($request, ['ipd_ipd_bill_prefix' => 'required']);

            //Setting::where('name', 'ipd_ipd_bill_prefix')->update(['value' => $request->ipd_ipd_bill_prefix]);

            $setting = Setting::firstOrNew(array('name' => 'ipd_ipd_bill_prefix'));
            $setting->name = 'ipd_ipd_bill_prefix';
            $setting->value = $request->ipd_ipd_bill_prefix;
            $setting->save();

            $message = "IPD Bill Prefix updated successfully!";
        }

        if ($request->has('update_ipd_ipd_bill_number')) {

            $this->validate($request, ['ipd_ipd_bill_number' => 'required']);

            $setting = Setting::firstOrNew(array('name' => 'ipd_ipd_bill_number'));
            $setting->name = 'ipd_ipd_bill_number';
            $setting->value = $request->ipd_ipd_bill_number;
            $setting->save();

            $message = "IPD Bill Number updated successfully!";
        }

        if ($request->has('update_ipd_summary_bill_prefix')) {

            $this->validate($request, ['ipd_summary_bill_prefix' => 'required']);

            $setting = Setting::firstOrNew(array('name' => 'ipd_summary_bill_prefix'));
            $setting->name = 'ipd_summary_bill_prefix';
            $setting->value = $request->ipd_summary_bill_prefix;
            $setting->save();

            $message = "IPD Summary Bill Prefix updated successfully!";
        }

        if ($request->has('update_ipd_summary_bill_number')) {

            $this->validate($request, ['ipd_summary_bill_number' => 'required']);

            $setting = Setting::firstOrNew(array('name' => 'ipd_summary_bill_number'));
            $setting->name = 'ipd_summary_bill_number';
            $setting->value = $request->ipd_summary_bill_number;
            $setting->save();

            $message = "IPD Summary Bill Number updated successfully!";
        }


        if ($request->has('update_ipd_uhid_prefix')) {

            $this->validate($request, ['ipd_uhid_prefix' => 'required']);

            $setting = Setting::firstOrNew(array('name' => 'ipd_uhid_prefix'));
            $setting->name = 'ipd_uhid_prefix';
            $setting->value = $request->ipd_uhid_prefix;
            $setting->save();

            $message = "UHID prefix updated successfully!";
        }

        if ($request->has('update_ipd_uhid_number')) {

            $this->validate($request, ['ipd_uhid_number' => 'required']);

            $setting = Setting::firstOrNew(array('name' => 'ipd_uhid_number'));
            $setting->name = 'ipd_uhid_number';
            $setting->value = $request->ipd_uhid_number;
            $setting->save();

            $message = "UHID number updated successfully!";
        }

        if ($request->has('update_ipd_ipd_prefix')) {

            $this->validate($request, ['ipd_ipd_prefix' => 'required']);

            $setting = Setting::firstOrNew(array('name' => 'ipd_ipd_prefix'));
            $setting->name = 'ipd_ipd_prefix';
            $setting->value = $request->ipd_ipd_prefix;
            $setting->save();

            $message = "IPD prefix updated successfully!";
        }

        if ($request->has('update_ipd_ipd_number')) {

            $this->validate($request, ['ipd_ipd_number' => 'required']);

            $setting = Setting::firstOrNew(array('name' => 'ipd_ipd_number'));
            $setting->name = 'ipd_ipd_number';
            $setting->value = $request->ipd_ipd_number;
            $setting->save();

            $message = "IPD number updated successfully!";
        }


        //==================================================================
        // echo "====>>>>>>>>>>> <pre>"; print_r($_POST); exit;
        if ($request->has('update_ipd_doctor')) {

            if ($request->old_payment_modes) {
                IpdPatientsDropdowns::where('type', 'ipd_doctor')->whereNotIn('id', $request->old_ipd_doctors)->delete();
            } else {
                IpdPatientsDropdowns::where('type', 'ipd_doctor')->delete();
            }


            foreach ($request->ipd_doctor as $ipd_doctor) {
                if ($ipd_doctor != "") {
                    $dropdown = new IpdPatientsDropdowns;
                    $dropdown->name = $ipd_doctor;
                    $dropdown->type = 'ipd_doctor';
                    $dropdown->save();
                }
            }

            $message = "IPD doctors updated successfully!";
        }

        if ($request->has('update_ipd_payment_mode')) {

            if ($request->old_payment_modes) {
                //DB::table('ipd_patients_dropdowns')->where('type', 'ipd_payment_mode')->whereNotIn('id', $request->old_payment_modes)->delete();        
                IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->whereNotIn('id', $request->old_payment_modes)->delete();
            } else {
                //DB::table('ipd_patients_dropdowns')->where('type', 'ipd_payment_mode')->delete();

                IpdPatientsDropdowns::where('type', 'ipd_payment_mode')->delete();
            }


            foreach ($request->ipd_payment_mode as $ipd_payment_mode) {
                if ($ipd_payment_mode != "") {
                    $dropdown = new IpdPatientsDropdowns;
                    $dropdown->name = $ipd_payment_mode;
                    $dropdown->type = 'ipd_payment_mode';
                    $dropdown->save();
                }
            }

            $message = "Payment modes updated successfully!";
        }



        if ($request->has('update_ipd_ward_type')) {
            // echo "====>>>>>>>>>>> <pre>".__LINE__;      
            if ($request->old_ipd_ward_types) {
                // echo "====>>>>>>>>>>> <pre>".__LINE__;                 
                //DB::table('ipd_patients_dropdowns')->where('type', 'ipd_ward_type')->whereNotIn('id', $request->old_payment_modes)->delete();        
                IpdPatientsDropdowns::where('type', 'ipd_ward_type')->whereNotIn('id', $request->old_ipd_ward_types)->delete();
            } else {
                //echo "====>>>>>>>>>>> <pre>".__LINE__;
                //DB::table('ipd_patients_dropdowns')->where('type', 'ipd_ward_type')->delete();

                IpdPatientsDropdowns::where('type', 'ipd_ward_type')->delete();
            }


            foreach ($request->ipd_ward_type as $ipd_ward_type) {
                if ($ipd_ward_type != "") {
                    $dropdown = new IpdPatientsDropdowns;
                    $dropdown->name = $ipd_ward_type;
                    $dropdown->type = 'ipd_ward_type';
                    $dropdown->save();
                }
            }

            $message = "Ward Types updated successfully!";
        }
        // echo "====>>>>>>>>>>> <pre>"; print_r($_POST); exit;
        if ($request->has('update_ipd_bed_number')) {

            if ($request->old_ipd_bed_numbers) {
                //DB::table('ipd_patients_dropdowns')->where('type', 'ipd_bed_number')->whereNotIn('id', $request->old_payment_modes)->delete();        
                IpdPatientsDropdowns::where('type', 'ipd_bed_number')->whereNotIn('id', $request->old_ipd_bed_numbers)->delete();
            } else {
                //DB::table('ipd_patients_dropdowns')->where('type', 'ipd_bed_number')->delete();

                IpdPatientsDropdowns::where('type', 'ipd_bed_number')->delete();
            }


            foreach ($request->ipd_bed_number as $ipd_bed_number) {
                if ($ipd_bed_number != "") {
                    $dropdown = new IpdPatientsDropdowns;
                    $dropdown->name = $ipd_bed_number;
                    $dropdown->type = 'ipd_bed_number';
                    $dropdown->save();
                }
            }

            $message = "Bed Numbers updated successfully!";
        }

        //echo "====>>>>>>>>>>> <pre>"; print_r($_POST); exit;

        if ($request->has('update_ipd_particulars')) {

            if ($request->old_ipd_particulars) {
                IpdPatientsDropdowns::where('type', 'ipd_particulars')->whereNotIn('id', $request->old_ipd_particulars)->delete();
            } else {
                IpdPatientsDropdowns::where('type', 'ipd_particulars')->delete();
            }


            $amounts = $request->ipd_particulars_amount;

            foreach ($request->ipd_particulars as $particular_key => $ipd_particular) {
                if ($ipd_particular != "") {
                    $dropdown = new IpdPatientsDropdowns;
                    $dropdown->name = $ipd_particular;
                    $dropdown->parent = $request->main_category;
                    $dropdown->type = 'ipd_particulars';
                    $dropdown->value = $amounts[$particular_key];
                    $dropdown->save();
                }
            }

            $message = "Particulars updated successfully!";
        }
        //echo "====>>>>>>>>>>> <pre>"; print_r($_POST); exit;
        //===================================================================

        return back()->with('flash_message', $message);
        //dd($request->all());
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_ipd_perticulars(Request $request){
        $ipd_doctors = IpdPatientsDropdowns::where('id', $request->id)->first();
        $ipd_doctors->value = $request->value;
        $ipd_doctors->save();
    }



    public function manage_advertisement($id = "")
    {

        $model = DB::table('ipd_patients_dropdowns')->where('type', 'advertisement')->first();
        return view('settings.add_advertisement', compact('model'));
    }

    public function update_advertisement(Request $request)
    {
        $model = DB::table('ipd_patients_dropdowns')->where('type', 'advertisement')->first();
        //      / echo "=====>>>>>>>>>>>>>>> <pre>"; print_r($_FILES); exit;


        $update_data = array(
            'value' => $request->url,
            'status' => ($request->isActive) ? '1' : '0',
            'type' => 'advertisement',
        );

        if ($request->hasFile('uploadeImage')) {
            if (isset($model->id) && !empty($model->id) && !empty($model->name)) {

                Storage::Delete($model->name);

            }
            $uploaded_image = Storage::putFile('uploads', $request->file('uploadeImage'));

            $update_data['name'] = $uploaded_image;

        }




        if ($model) {
            DB::table('ipd_patients_dropdowns')->update($update_data);
        } else {
            DB::table('ipd_patients_dropdowns')->insert($update_data);
        }

        $message = "Advertisement updated successfully!";

        return back()->with('flash_message', $message);
    }
}
