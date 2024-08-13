<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\gallery;

class GalleryController extends Controller
{
    public function index()
    {
    	return view('admin.gallery');
    }

    /*public function stored_images(Request $request)
    {
    	
    	$gallery_name = $request->input('gallery_name');

         if ($image = $request->file('filenames')) {
            $destinationPath = 'gallery_image/';
            foreach ($image as $files) {
             // upload path
            $profileImage = $files->getClientOriginalName();
            $files->move($destinationPath, $profileImage);
            $gallery =  new gallery();
            $gallery->gallery_name=$gallery_name;
             $gallery->filenames=$profileImage;
             $gallery->save();
            }

        }
        return redirect()->route('gallery_list');
		
  }*/


  public function stored_images(Request $request)
  {
    $gallery_name = $request->input('gallery_name');
     if ($request->hasFile('filenames1')) {
        $image = $request->file('filenames1');


        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'gallery_image/';
        $image->move($destinationPath, $name);

        //$path = url('/gallery_image/'.$name);
    
        
        DB::insert("INSERT INTO `tbl_gallery_main`(`filenames1`,`gallery_name`) VALUES ('$name','$gallery_name')");
        $main_id = DB::getPdo()->lastInsertId();
        //return redirect()->route('gallery_list');
    } 

       

         if ($image = $request->file('filenames')) {
            $destinationPath = 'gallery_image/';
            $i=1;
            foreach ($image as $files) {
             // upload path
            $profileImage = time().$i++.'.'.$files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $gallery =  new gallery();
            $gallery->gallery_name=$gallery_name;
             $gallery->filenames=$profileImage;
             $gallery->main_id = $main_id;
             $gallery->save();
            }

        }
        return redirect()->route('gallery_list'); 

  }

 public function gallery_list()
 {
    $data['gallery_list'] = DB::select("SELECT * FROM `tbl_gallery_main`");
    return view('admin.gallery_list',$data);
 } 

 public function deleteGallery($id)
 {
    DB::table('tbl_gallery_main')->where('main_id', $id)->delete();
    DB::table('tbl_gallery')->where('main_id', $id)->delete();

      return redirect()->route('gallery_list');
     
 }

 public function deletesubGallery($id)
 {
    DB::table('tbl_gallery')->where('id', $id)->delete();
               $url= url()->previous();
           return redirect($url);
     
 }
 public function showsubimage($id)
 { 

  $data['gallery_list'] = DB::select("SELECT * FROM `tbl_gallery` WHERE main_id='$id'");
    return view('admin.subimage_gallary',$data);

 }


 


}
