<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Menu_list;
use App\dynamic_text;
use App\Image_gallery;
use App\seo_master;
use Storage;
use App\Useraccess;
use App\patient_details;
use App\appointment;
use App\Case_master;
use HTML;
use DB;
use App\Setting;

class BackEndController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }

     public function admin()
    {
        $wordlist = patient_details::count(); 

    
        $case_mastercount = Case_master::count(); 
        
        $all_settings = Setting::all()->keyBy('name');
        
         
        $todayappoinment=DB::select("SELECT * from appointments WHERE DATE(appointment_dt)=DATE(NOW())");
        $count=count($todayappoinment);
        $FollowUpDate=DB::select("SELECT * from case_master WHERE DATE(FollowUpDate)=DATE(NOW())");
        $count1=count($FollowUpDate);
        
        //return view('home')->with('count',$wordlist);
        return view('home',compact('wordlist','case_mastercount','count','count1', 'all_settings'));
        
    }
}
