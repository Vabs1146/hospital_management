<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as HttpGuzzle;
use Illuminate\Support\Facades\Input;

use Calendar;
use App\appointment;
use App\doctor;
use App\timeslot;
use App\Models\rating;
use Auth;
use App\Helpers\Helpers;
use App\helperClass\CommonHelper;

class NewfrontendController extends Controller
{

    public function Imagaegallery() {
        $sql = "SELECT * FROM new_web_image_gallery where imgTypeId = '2' AND isActive = '1'";
        
        $gallery_images = DB::select($sql);
        
        //$gallery_images = ($gallery_images) ? (array) $gallery_images : [];
        
        //dd($gallery_images);
        //dd($main_gallery_image);
        return view('homepage.frontend.gallery',['gallery_images'=>$gallery_images]);
    }
    public function client_feedback() {
        $sql = "SELECT * FROM new_web_image_gallery where imgTypeId = '2' AND isActive = '1'";
        
        $gallery_images = DB::select($sql);
        
        $address = DB::table('new_settings')->where('name', 'address')->first(); 
        $email = DB::table('new_settings')->where('name', 'email')->first(); 
        $call_us = DB::table('new_settings')->where('name', 'call_us')->first(); 
        $google_map = DB::table('new_settings')->where('name', 'google_map')->first(); 
        
        return view('homepage.frontend.feedback',[
            'address'=>$address,
            'email'=>$email,
            'call_us'=>$call_us,
            'google_map'=>$google_map
        ]);
    }
    
    public function save_client_feedback(Request $request){
        
        //dd($request->all());
        $form_details = new rating();
        $form_details = $form_details->Create($request->all());

        $form_details->username=$request->input('username');
        $form_details->mobileno=$request->input('mobileno');
        $form_details->feedback=$request->input('feedback');
        $form_details->ratingscore=$request->input('ratingscore');


        $image = $request->file('userimage');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'images/';
        $image->move($destinationPath, $name);
        $form_details->userimage=$name;
        $form_details->save();

   // \LogActivity::addToLog('Rating record added/updated successfully');
        return redirect()->back()->withInput()->with('flash_message', 'Record added/updated successfully');
    }
	
	public function all_doctors() {
        $sql = "SELECT * FROM tbl_consultant_main";
        //$sql = "SELECT * FROM tbl_consultant_main where imgTypeId = '2' AND isActive = '1'";
        
        $gallery_images = DB::select($sql);
        
        //$gallery_images = ($gallery_images) ? (array) $gallery_images : [];
        
        //dd($gallery_images);
        //dd($main_gallery_image);
        return view('homepage.frontend.all_doctors',['gallery_images'=>$gallery_images]);
    }
}