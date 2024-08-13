<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\Menu_list;
use App\dynamic_text;
use App\Image_gallery;
use App\seo_master;
use Storage;
use App\Useraccess;
use DB;
use App\patient_details;
use App\appointment;
use App\Case_master;
use App\NewEvents;
use HTML;
use App\NewHomePage;
use App\doctor;
use Illuminate\Http\Request as NewRequest; 
use App\Models\rating;

class HomeController extends Controller
{
	

public function index()
    {
	$pageUrl =  Request::path();
		$seoDetails = seo_master::where('status', 1)->where('url',$pageUrl)->first();
        $imageGallery = Image_gallery::where('isActive', 1)->where('imgTypeId', 1)->where('displayed_in','homeSlider')->get();
	$bodyOne = dynamic_text::where('textType', 3)->first();
        $bodyOne = isset($bodyOne->html_text)?(HTML::decode($bodyOne->html_text)) : '';
        $bodyTwo = dynamic_text::where('textType', 4)->first();
        $bodyTwo->html_text = isset($bodyTwo->html_text)?(HTML::decode($bodyTwo->html_text)) : '';
        
        
        $slider_footer_data = NewHomePage::where('type', 'section_slider_footer')->where('is_active', '1')->take(3)->get();
            $departments_data = NewHomePage::where('type', 'section_departments')->where('is_active', '1')->get();
            $welcome_data = NewHomePage::where('type', 'section_welcome')->where('is_active', '1')->first();
            $doctors = doctor::where('isActive', '1')->orderBy('id', 'DESC')->get();
            //dd($doctors);
            
        $slider_footer2_data = NewHomePage::where('type', 'section_slider_footer2')->where('is_active', '1')->take(3)->get();
	
	$slider2_data = NewHomePage::where('type', 'section_slider2')->where('is_active', '1')->take(3)->get();
	
	$siteLogo = (empty($siteLogo) || isset($siteLogo->imgUrl)) ? config('app.name', 'Dr App') : Storage::disk('local')->url($siteLogo->imgUrl);
        
        //return view('shared.index', ['bodyOne'=>$bodyOne,'bodyTwo'=>$bodyTwo, 'imageGallery'=>$imageGallery,'seo'=>$seoDetails]);
	
	if(env('layoutTemplate') == "shared/layout2022") {
            //dd($all_settings);
            $new_homepage_slider_images = DB::table('new_web_image_gallery')->where('displayed_in', 'homeSlider')->get(); 
            $new_get_section_1 = DB::table('new_wbsite_dynamic_text')->where('textType', 'section_1')->first(); 
            $services_data = DB::table('tbl_service_main')->get(); 
            $consultant_data = DB::table('tbl_consultant_main')->get(); 
            $certificates_data = DB::table('tbl_certificate_main')->get(); 
            $feedback_data = DB::table('tbl_feedback_main')->get(); 
            $ratingLst =  rating::where('isActive', 1)->get();
            
            //dd($ratingLst);
            
		return view('shared.index2022', ['bodyOne'=>$bodyOne,'bodyTwo'=>$bodyTwo, 'imageGallery'=>$imageGallery,'seo'=>$seoDetails, 'new_homepage_slider_images' => $new_homepage_slider_images, 
                    'new_get_section_1' => $new_get_section_1,
                    'services_data' => $services_data,
                    'consultant_data' => $consultant_data,
                    'certificates_data' => $certificates_data,
                    'feedback_data' => $feedback_data,
                    'ratingLst' => $ratingLst
                ]);
	} else {
        return view('shared.index', ['bodyOne'=>$bodyOne,'bodyTwo'=>$bodyTwo, 'imageGallery'=>$imageGallery,'seo'=>$seoDetails]);
    }
            
	  //return view('shared_new.index', ['bodyOne'=>$bodyOne,'bodyTwo'=>$bodyTwo, 'imageGallery'=>$imageGallery,'seo'=>$seoDetails,'slider_footer_data'=>$slider_footer_data,'slider_footer2_data'=>$slider_footer2_data,'departments_data'=>$departments_data,'welcome_data'=>$welcome_data,'doctors'=>$doctors,'siteLogo'=>$siteLogo,'slider2_data'=>$slider2_data]);
		
        // $siteLogo = Image_gallery::where('isActive', 1)->where('imgTypeId',2)->first();
        // $siteLogo = (empty($siteLogo) || isset($siteLogo->imgUrl)) ? config('app.name', 'Dr App') : Storage::disk('local')->url($siteLogo->imgUrl);
        
      
    }
    
    public function show_events()
    {
	$pageUrl =  Request::path();
                
	$all_events = NewEvents::where('is_active', '1')->orderBy('start_date', 'desc')->get();
        
       // dd($all_events);
        
        $events_data = [];
        foreach($all_events as $all_events_row) {     
            $id = $all_events_row->id;
            $events_data[$all_events_row->id]['comments'] = DB::table('event_comments')->where('event_id', $id)->where('status', '1')->where('is_deleted', '0')->orderBy('id', 'DESC')->get();
            $events_data[$all_events_row->id]['likes'] = DB::table('event_likes')->where('event_id', $id)->orderBy('id', 'DESC')->get();
        }
        
      // echo "=======>>>>>>>>>>> <pre>"; print_r($events_data); exit;
        
        /*
        dd($all_events);
        $imageGallery = Image_gallery::where('isActive', 1)->where('imgTypeId', 1)->where('displayed_in','homeSlider')->get();
	$bodyOne = dynamic_text::where('textType', 3)->first();
        $bodyOne = isset($bodyOne->html_text)?(HTML::decode($bodyOne->html_text)) : '';
        $bodyTwo = dynamic_text::where('textType', 4)->first();
        $bodyTwo->html_text = isset($bodyTwo->html_text)?(HTML::decode($bodyTwo->html_text)) : '';
        */
	  return view('new_home_page.all_events', compact('all_events', 'events_data'));
		
        // $siteLogo = Image_gallery::where('isActive', 1)->where('imgTypeId',2)->first();
        // $siteLogo = (empty($siteLogo) || isset($siteLogo->imgUrl)) ? config('app.name', 'Dr App') : Storage::disk('local')->url($siteLogo->imgUrl);
        
      
    }
    
    public function event_details($id)
    {
	$pageUrl =  Request::path();
                
	$event_data = NewEvents::find($id);
        
        $event_comments = DB::table('event_comments')->where('event_id', $id)->where('status', '1')->where('is_deleted', '0')->orderBy('id', 'DESC')->get();
        
        $event_likes = DB::table('event_likes')->where('event_id', $id)->orderBy('id', 'DESC')->get();
        
        //dd($event_data);
       
	  return view('new_home_page.event_details', compact('event_data', 'event_comments', 'event_likes'));
    }
	
	

    public function dynamic_page($id)
    {
		
		$pageUrl =  Request::path();
		
		$menutext = Menu_list::where('name',$id)->first();
        $dynamicText = dynamic_text::where('textType', 1)->where('relationshipKey',$menutext->id)->first();
        $seoDetails = seo_master::where('status', 1)->where('url',$pageUrl)->first();
		
        if(empty($dynamicText) || is_null($dynamicText) ){
            $dynamicText = new dynamic_text;
        }
        $dynamicText->html_text = isset($dynamicText->html_text)?(HTML::decode($dynamicText->html_text)) : '';
        $title = $menutext->name;
        //return view('dynamic_text/dynamic_page',['dynamicText'=>$dynamicText,'title'=> $title,'seo'=>$seoDetails]);
		if(env('layoutTemplate') == "shared/layout2022") {
        return view('homepage.frontend.dynamic_page',['dynamicText'=>$dynamicText,'title'=> $title,'seo'=>$seoDetails]);
        } else {
        return view('dynamic_text/dynamic_page',['dynamicText'=>$dynamicText,'title'=> $title,'seo'=>$seoDetails]);
        }
    }

    public function Imagaegallery_old() {
        $galleryData = Image_gallery::where('isActive', 1)->where('imgTypeId', 1)->where('displayed_in','galleryPage')->get();
        
        //dd($galleryData);
        return view('image_galleries/GalleryPage',['galleryData'=>$galleryData, 'title'=>'Image Gallery']);
    }
    
    public function Imagaegallery() {

        $photo_gallery = DB::select('SELECT * FROM tbl_gallery');
        $main_gallery_image = DB::select("SELECT * FROM `tbl_gallery_main`");

        //sreturn $photo_gallery;

        $galleryData = Image_gallery::where('isActive', 1)->where('imgTypeId', 1)->where('displayed_in','galleryPage')->get();


        //dd($main_gallery_image);
        return view('image_galleries/GalleryPage',['photo_gallery'=>$photo_gallery,'main_gallery_image'=>$main_gallery_image]);
    }

   
        public function save_event_comments(NewRequest $request) {
            //dd($request->all());
            
            $insert_data = array(
                'event_id' => $request->event_id,
                'comment' => $request->comment,
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'ip_address' => $this->get_client_ip(),
            );
            
            DB::table('event_comments')->insert($insert_data);
            
            return redirect()->back()->with('flash_message', 'Your message is submitted. After review we will show your message in comments. Thank you!');
        }
        
        
        public function like_event(NewRequest $request) {
            //dd($request->all());
            
            $insert_data = array(
                'event_id' => $request->event_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'ip_address' => $this->get_client_ip(),
            );
            
            DB::table('event_likes')->insert($insert_data);
            
            return redirect()->back()->with('flash_message', 'Thank you for liking this event!');
        }
        
        
        
        
        
        // Function to get the client IP address
        function get_client_ip() {
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }
        
        
        
    public function all_works() {
	$pageUrl =  Request::path();
                
	 $all_work = NewHomePage::where('type', 'section_work')->where('is_active', '1')->get();
        
	  return view('new_home_page.all_work', compact('all_work'));
          
    }
    
    public function all_paper_cttings() {

        $pageUrl =  Request::path();
                
	$all_paper_cttings = NewHomePage::where('type', 'section_paper_cutting')->where('is_active', '1')->get();


        //dd($all_paper_cttings);
        
        return view('new_home_page/all_paper_cuttings',['all_paper_cttings'=>$all_paper_cttings]);
    }

}
