<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
        $all_settings = Setting::all()->keyBy('name');
        
        //echo "===========>>>>>>. <pre>".__LINE__; print_r($all_settings); exit;
        
        return view('settings.add', compact('all_settings'));
		
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
        /*
        "hospital_name" => "akshayeyehospital"
  "hospital_logo" => "0025731.png"
  "update_hospital_logo" => "Update"
  "doctor_name" => "Dr. Akshay"
  "uhid_prefix" => "akshayeyehospital"
    */    
        if($request->has('update_hospital_name')) {
            
            $this->validate($request,['hospital_name' => 'required']);
            
            Setting::where('name', 'hospital_name')
            ->update(['value' => $request->hospital_name]);

            $message = "Hospital updated successfully!";
        }
        
        if($request->has('update_hospital_logo')) {
            //$this->validate($request,['staff_type_id' => 'required','sms_text'=>'required'],['staff_type_id.required'=>'Please select User role.','sms_text.required'=>'Please enter text']);
          
            $message = "";
            
            $this->validate($request, [

                'hospital_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ]);


            $image = $request->file('hospital_logo');

            $input['imagename'] = 'logo.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/images');

            $image->move($destinationPath, $input['imagename']);
                                
            Setting::where('name', 'hospital_logo')
            ->update(['value' => $input['imagename']]);

            $message = "Logo updated successfully!";
        }
        
        if($request->has('update_doctor_name')) {
            
            $this->validate($request,['doctor_name' => 'required']);
            
            Setting::where('name', 'doctor_name')
            ->update(['value' => $request->doctor_name]); 

            $message = "Doctor name updated successfully!";           
        }
        
        if($request->has('update_uhid_prefix')) {
            
            $this->validate($request,['uhid_prefix' => 'required']);
            
            Setting::where('name', 'uhid_prefix')
            ->update(['value' => $request->uhid_prefix]);

            $message = "UHID number prefix updated successfully!";
        }
        if($request->has('update_IPD_Number')) {
            
            $this->validate($request,['ipd_prefix' => 'required']);
            
            Setting::where('name', 'ipd_prefix')
            ->update(['value' => $request->ipd_prefix]);

            $message = "IPD number prefix updated successfully!";
        }  		
        if($request->has('update_IPD_bill_number')) {
            
            $this->validate($request,['update_IPD_bill_number' => 'required']);
            
            Setting::where('name', 'ipd_bill_prefix')
            ->update(['value' => $request->ipd_bill_prefix]);

            $message = "IPD Bill number updated successfully!";
        }
          
        if($request->has('update_bill_number')) {
            
            $this->validate($request,['update_bill_number' => 'required']);
            
            Setting::where('name', 'bill_number')
            ->update(['value' => $request->bill_number]);

            $message = "Bill number updated successfully!";
        }

        if($request->has('update_webcam')) {
            
            //$this->validate($request,['update_bill_number' => 'required']);
            
            Setting::where('name', 'webcam')
            ->update(['value' => $request->webcam]);

            $message = "Webcam settings updated successfully!";
        }
        
        //===================================================================
        if($request->has('update_top_bar')) {
            
            //$this->validate($request,['update_bill_number' => 'required']);
            
            //Setting::where('name', 'top_bar')->update(['value' => $request->top_bar]);
            
            Setting::updateOrCreate(['name' => 'top_bar'], ['value' => $request->top_bar]);

            $message = "Top bar settings updated successfully!";
        }
        
        if($request->has('update_twitter_link')) {
            //Setting::where('name', 'twitter_link')->update(['value' => $request->twitter_link]);
            
            Setting::updateOrCreate(['name' => 'twitter_link'], ['value' => $request->twitter_link]);

            $message = "Twitter link settings updated successfully!";
        }
        if($request->has('update_fb_link')) {
            /*
            Setting::where('name', 'fb_link')
            ->update(['value' => $request->fb_link]);
            */
            Setting::updateOrCreate(['name' => 'fb_link'], ['value' => $request->fb_link]);

            $message = "Facebook link settings updated successfully!";
        }
        if($request->has('update_linkedin_link')) {
            /*
            Setting::where('name', 'linkedin_link')
            ->update(['value' => $request->linkedin_link]);
*/
            Setting::updateOrCreate(['name' => 'linkedin_link'], ['value' => $request->linkedin_link]);
            $message = "Linkedin link settings updated successfully!";
        }
        if($request->has('update_insta_link')) {
            /*
            Setting::where('name', 'insta_link')
            ->update(['value' => $request->insta_link]);

*/
            Setting::updateOrCreate(['name' => 'insta_link'], ['value' => $request->insta_link]);
            $message = "Instagram link settings updated successfully!";
        }
        
        if($request->has('update_openeing_hours')) {
            /*
            Setting::where('name', 'openeing_hours')
            ->update(['value' => $request->openeing_hours]);

*/
            Setting::updateOrCreate(['name' => 'openeing_hours'], ['value' => $request->openeing_hours]);
            $message = "Opening Hours settings updated successfully!";
        }
        if($request->has('update_openeing_hours_text')) {
            /*
            Setting::where('name', 'webcam')
            ->update(['value' => $request->openeing_hours_text]);

*/
            Setting::updateOrCreate(['name' => 'openeing_hours_text'], ['value' => $request->openeing_hours_text]);
            $message = "Openening Hours Text settings updated successfully!";
        }
        if($request->has('update_appointment_number')) {
            /*
            Setting::where('name', 'appointment_number')
            ->update(['value' => $request->appointment_number]);

*/
            Setting::updateOrCreate(['name' => 'appointment_number'], ['value' => $request->appointment_number]);
            $message = "Appointment Number settings updated successfully!";
        }
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
}
