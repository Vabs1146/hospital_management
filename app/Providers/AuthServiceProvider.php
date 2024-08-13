<?php

namespace App\Providers;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

       public function __construct()
    {
        $this->acc=0;

    }
  
        public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

            $gate->define('isUseraccess', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='useraccess'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }


        }); 

           $gate->define('isDoctor', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='doctor'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1 || $id == 1)
        {
            return true;
        }


        }); 




   $gate->define('isAptpatientDetails', function($user){

        $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='aptpatientDetails1'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
           else
        {
          return false;  
        }


        }); 

      $gate->define('isAppointmentlist', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='appointmentlist'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        }); 

          $gate->define('isFollowupappoinment', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='followupappoinment'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        }); 


            $gate->define('isAppointment', function($user){

        $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='appointment'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        }); 


            $gate->define('isStop_appointments', function($user){

        $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='stop_appointments'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        }); 

   $gate->define('isAppointmentslot', function($user){

      $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='appointmentslot'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        }); 


  $gate->define('isCase_masters', function($user){

        $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='case_masters'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });


  $gate->define('isPatient_reports', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='patient/report'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });


   $gate->define('isCase_masters_prescriptionlst', function($user){

        $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='case_masters/prescriptionlst'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });



   $gate->define('isReport_files', function($user){

       $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='report_files'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });


      $gate->define('isFormDropDown', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='formDropDown'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });



      $gate->define('isBill_details', function($user){

        $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='bill_details'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });



      $gate->define('isBill_details', function($user){

        $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='bill_details'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });


 $gate->define('isDoctorbill', function($user){

        $id = Auth::user()->id;
         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='doctorbill'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });



  $gate->define('isInsuranceBill', function($user){

        $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='insuranceBill'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

  $gate->define('isGlassPrescription', function($user){

        $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='glassPrescription'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });


  $gate->define('isMedicine', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='Medicine'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });



  $gate->define('isRating_list', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='rating/list'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });
      

        $gate->define('isOldregister', function($user){

        $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='oldregister'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

         $gate->define('isSeo_add', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='seo/add'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

          $gate->define('isMenu_lists', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='menu_lists'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });


                $gate->define('isBulk_sms', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='bulk_sms'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

         $gate->define('isMember_sms', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='member_sms'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

           $gate->define('isStaff_users', function($user){

        $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='staff_users'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });
       
           $gate->define('isDownloaddatabase', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='downloaddatabase'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

            $gate->define('isComplaint', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='EyeDetails_Complaint'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

              $gate->define('isVision', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='EyeDetails_Vision'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });
       

         $gate->define('isRefraction', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='EyeDetails_Refraction'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });
       
         $gate->define('isFindings', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='EyeDetails_Findings'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });
       
         $gate->define('isGlaucoma', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='EyeDetails_Glaucoma'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });
       
         $gate->define('isA_Scan', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='EyeDetails_AScan'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });
       
         $gate->define('isSP_Tests', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='EyeDetails_SPTests'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });
       

           $gate->define('isHomepage_image_galleries', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='homepage/image_galleries'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });
       

       $gate->define('isHomepage_LogoAddEdit', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='homepage/LogoAddEdit'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

             $gate->define('isHomepage_editletterhead', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='homepage/editletterhead'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

                  $gate->define('isHomepage_editletterfooter', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='homepage/editletterfooter'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

                     $gate->define('ishomepage_body_editor', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='homepage/body_editor'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });


     
      $gate->define('isHomepage_body_layer2editor', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='homepage/body_layer2editor'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

    
     $gate->define('isHomepage_body_layer3editor', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='homepage/body_layer3editor'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });
          


           $gate->define('isHomepage_body_layer4editor', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='homepage/body_layer4editor'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });
          


          $gate->define('isHomepage_body_layer5editor', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='homepage/body_layer5editor'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

      
      $gate->define('isHomepage_body_layer6editor', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='homepage/body_layer6editor'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });


           
            $gate->define('isHomepage_body_layer7editor', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='homepage/body_layer7editor'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

             $gate->define('isHomepage_body_layer7editor', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='homepage/body_layer7editor'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

              $gate->define('isHomepage/body_editor', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='homepage/body_editor'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });
       
   
 $gate->define('isHomepage_footer_editor', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='homepage/footer_editor'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

  $gate->define('iswritingCasePaper', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='writingCasePaper'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });


    $gate->define('isStaff_member', function($user){

         $id = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$id' AND section.sectionname='staff_member'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        if($this->acc==1)
        {
            return true;
        }
        else
        {
          return false;  
        }


        });

   
    }
}
