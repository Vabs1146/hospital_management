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
use HTML;

class HomeNewController extends Controller
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
		return view('shared_new.index', ['bodyOne'=>$bodyOne,'bodyTwo'=>$bodyTwo, 'imageGallery'=>$imageGallery,'seo'=>$seoDetails]);
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
        return view('dynamic_text/dynamic_page',['dynamicText'=>$dynamicText,'title'=> $title,'seo'=>$seoDetails]);
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

   

}
