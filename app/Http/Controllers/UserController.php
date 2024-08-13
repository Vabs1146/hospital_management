<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Hash;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as HttpGuzzle;
use Illuminate\Support\Facades\Input;

use Calendar;
use App\appointment;
use App\Case_master;
use App\doctor;
use App\timeslot;
use Event;
use DateTime;
use Auth;
use Response;
use App\Helpers\Helpers;

class UserController extends Controller
{
  public function checkphone(Request $request)
  {
  $mobile=$request->mobile;


 $userlist=DB::select("SELECT * FROM `users` WHERE mobile='$mobile'");
 $cnt=count($userlist);
 if($cnt>0)
 {
//return $userlist;
 	// return view('reset', $userlist);

        $client = new HttpGuzzle;
        $mobileNoStr = $request->mobile;
        $pwd="12345678";
        $smsStr = 'Your new password is :'.$pwd; 
     
        $urlGet = str_replace(array('xxxxcommaSeperatedxxxx','xxxxSMSTextxxxx'), array($mobileNoStr, $smsStr), env('SMS_URL'));
    
        $res = $client->request('GET', $urlGet);
        // $msg="Message send successfully.";
       //return redirect('login')->with('flash_message', 'New Password has been sent.');
          $pass = Hash::make($pwd);
         $sql = DB::update("UPDATE `users` SET `password`='$pass' WHERE mobile='$mobileNoStr'");
         // return  $sql;
       
       return redirect()->back()->withInput()->with('flash_message', 'New Password has been sent.');
         


  //return view('reset')->with('flash_message', 'Message send successfully.');
  
 }
 else
     {
       return redirect('/showerror')->with('error', 'If there is an account associated with this phone number, we would have sent you sms with a new password ');

     }
  }



  public function showerror()
  {
  	return view('errormsg');
  }

 // public function showpwdresetpage()
 //  {
 //  	return view('reset');
 //  }





}
