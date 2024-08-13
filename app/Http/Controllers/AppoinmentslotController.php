<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appoinmentslot;
use DB;
use Auth;
use App\Helpers\Helpers;
use App\helperClass\CommonHelper;

class AppoinmentslotController extends Controller
{

    public function __construct()
    {
      $shr=0;
      $ehr=0;
      
      $this->acc=0;
        $this->commonHelper = new CommonHelper();
    }

    public function index()
    {
  $id = Auth::user()->id;
        /*
        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='appointmentslot'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
        //if($acc==1)
        if(1)
        */
        
        $this->acc = $this->commonHelper->checkUserAccess("1_appointmentslot",Auth::user()->id);
        if ($this->acc == 1) {
          $data['doctor_list'] = DB::SELECT("SELECT * FROM `doctors` ORDER BY id DESC");
      $data['timeslot'] = DB::SELECT("SELECT * FROM `tbl_appoinment_slot` WHERE doctor_id='14'");
      return view('appointmentslot/createappoinment',$data);
        }

           else
        {
            return view('home');
        }

      
    }


         public function gettimeslotrecord(Request $req,$doctor_id,$time,$day)
    {
   
      $data= DB::SELECT("SELECT * FROM `tbl_appoinment_slot` WHERE doctor_id='$doctor_id' and slotime='$time' and day='$day'");
       return $data;
    }


       public function deleterecord($id)
    { 
    
      $admin=DB::delete("DELETE FROM `tbl_appoinment_slot` WHERE id='$id'");
      return redirect()->route('appointmentslot')->with('flash_message', 'Record Deleted successfully');
     
    }

    public function saveappintmentslot(Request $req)
    {
   
      $data['doctor_list'] = DB::SELECT("SELECT * FROM `doctors` ORDER BY id DESC");
      $did =  $req->input('doctor_id');
      $day =  $req->input('day');

      $sql=DB::select("SELECT * FROM `tbl_appoinment_slot` WHERE day='$day' AND doctor_id='$did'");
      foreach ($sql as $value) {
      $del=  DB::delete("DELETE FROM `tbl_appoinment_slot` WHERE day='$day' AND doctor_id='$did'");
      }

        $mstarttime =  $req->input('morningstarttime');
        $mornsttimemor=$mstarttime*60;
    

      $mornetime =  $req->input('morningendtime');
        $morningendtimemor=$mornetime*60;


      $morningminute =  $req->input('morningminute');
        $timediff=$mornsttimemor+$morningminute;

     
         $finaltime=$mornsttimemor;
         
          for($i=$mornsttimemor;$i<$morningendtimemor; $i=$i+$morningminute)
          {

            $timediff=$mornsttimemor;  
            $min=($finaltime -   floor($finaltime / 60) * 60);
            if($min<10)
            {
              $min="0".$min;
            }
           $starthours = floor($finaltime / 60).':'.$min.' AM';
           $timediff=$i;  
           $finaltime= $timediff+$morningminute;  


             
          $min=($finaltime -   floor($finaltime / 60) * 60);
            if($min<10)
            {
              $min="0".$min;
            }   

             $hours = floor($finaltime / 60).':'.$min.' AM';
            $insert = DB::insert("INSERT INTO `tbl_appoinment_slot`(`doctor_id`, `day`, `starttime`, `endtime`, `time_diff_minute`,`slotime`) VALUES ('$did','$day','$starthours','$hours','$morningminute','Morning')");
         



      
          }

         
         



// for loop for After noon time
        $starttimeafter =  $req->input('afternoonstarttime');
        $mornsttimeaf=$starttimeafter*60;
    

      $mornetimeafter =  $req->input('afternoonendtime');
        $morningendtimeaf=$mornetimeafter*60;


      $morningminute =  $req->input('afternoonminute');
        $timediff=$mornsttimeaf+$morningminute;

     
        
          $finaltime=$mornsttimeaf;
        
            for($i=$mornsttimeaf;$i<$morningendtimeaf; $i=$i+$morningminute)
          {

            $timediff=$mornsttimeaf;  //$timediff=660
            $min=($finaltime -   floor($finaltime / 60) * 60);//$min=0
            if($min<10)
            {
              $min="0".$min;   //$min=00
            }
            if(floor($finaltime / 60)>12)
             {
              $starthours = floor($finaltime / 60)-12;
             }
              else
             {
              $starthours = floor($finaltime / 60);//    $starthours=11
            
             
             }
               $shr=$starthours*60;
                 if(($shr>=720)||($shr<=600))
              {
                $starthours.= ':'.$min.' PM';
              }
              else
              {
                 $starthours.= ':'.$min.' AM'; 
              }
             // $starthours.= ':'.$min.' PM'; //$starthours=11:00 PM  11:20 PM 11:40 PM
           $timediff=$i;  //
           $finaltime= $timediff+$morningminute; // $finaltime=680


             
          $min=($finaltime -   floor($finaltime / 60) * 60);//  $min=20
            if($min<10)
            {
              $min="0".$min;
            }   
             if(floor($finaltime / 60)>12)
             {
              $hours = floor($finaltime / 60)-12;
             }
             else
             {
              $hours = floor($finaltime / 60); //$hours= 11
              
             }
             $ehr=$hours*60;
               if(($ehr>=720)||($ehr<=600))
              {
                $hours.= ':'.$min.' PM';
              }
              else
              {
                 $hours.= ':'.$min.' AM'; 
              }
            // $hours.= ':'.$min.' PM'; // $hours= 11:20 PM 11:40 PM  12:00 PM

            $insert = DB::insert("INSERT INTO `tbl_appoinment_slot`(`doctor_id`, `day`, `starttime`, `endtime`, `time_diff_minute`,`slotime`) VALUES ('$did','$day','$starthours','$hours','$morningminute','Afternoon')");

                    
      
          }
      
       



//for loop for Evening 
        $starttimeeve =  $req->input('eveningstarttime');
        $mornsttimeeve=$starttimeeve*60;
    

      $mornetimeeve =  $req->input('eveningendtime');
        $morningendtimeeve=$mornetimeeve*60;


      $morningminute =  $req->input('eveningminute');
        $timediff=$mornsttimeeve+$morningminute;

     
         $finaltime=$mornsttimeeve;

             
                   for($i=$mornsttimeeve;$i<$morningendtimeeve; $i=$i+$morningminute)
          {

            $timediff=$mornsttimeeve;  
            $min=($finaltime -   floor($finaltime / 60) * 60);
            if($min<10)
            {
              $min="0".$min;
            }
           $starthours = floor($finaltime / 60).':'.$min.' PM';
           $timediff=$i;  
           $finaltime= $timediff+$morningminute;  


             
          $min=($finaltime -   floor($finaltime / 60) * 60);
            if($min<10)
            {
              $min="0".$min;
            }   

             $hours = floor($finaltime / 60).':'.$min.' PM';
            $insert = DB::insert("INSERT INTO `tbl_appoinment_slot`(`doctor_id`, `day`, `starttime`, `endtime`, `time_diff_minute`,`slotime`) VALUES ('$did','$day','$starthours','$hours','$morningminute','Evening')");
            

      
          }

            return redirect()->route('appointmentslot')->with('flash_message', 'Record Added successfully');
             
      
     

    
    
      
    }
    
} 
