<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Homepage;

use DB;
use Storage;
use HTML;
class HomepageController extends AdminRootController
{

    public function index(Request $request)
	{
	    return view('image_galleries.index', []);
	}

	public function create(Request $request)
	{
		$model = new Image_gallery();
	    return view('image_galleries.add', ['model'=>$model]);
	}

	public function edit(Request $request, $id)
	{
		$image_gallery = Image_gallery::findOrFail($id);
	    return view('image_galleries.add', [
	        'model' => $image_gallery	    ]);
	}

	public function editlogo($id)
	{
		$image_gallery = Image_gallery::where('imgTypeId', $id)->first();
		if($image_gallery === null || empty($image_gallery) || is_null($image_gallery)){
			$image_gallery = new Image_gallery();
			$image_gallery->imgTypeId = $id;
		}
	    return view('image_galleries.addLogo', [
	        'model' => $image_gallery	    ]);
	}

	public function show(Request $request, $id)
	{
		$image_gallery = Image_gallery::findOrFail($id);
	    return view('image_galleries.show', [
	        'model' => $image_gallery	    ]);
	}

	public function grid(Request $request)
	{
		$len = $_POST['length'];
		$start = $_POST['start'];

		$select = "SELECT id,Name,Description,isActive,1,2 ";
		$presql = " FROM image_gallery a ";
		$presql .= " WHERE imgTypeId = 1 ";
		if($_POST['search']['value']) {	
			$presql .= " and Name LIKE '%".$_POST['search']['value']."%' ";
		}
		
		$presql .= "  ";

		$sql = $select.$presql." LIMIT ".$start.",".$len;
		

		$qcount = DB::select("SELECT COUNT(a.id) c".$presql);
		//print_r($qcount);
		$count = $qcount[0]->c;

		$results = DB::select($sql);
		$ret = [];
		foreach ($results as $row) {
			$r = [];
			foreach ($row as $value) {
				$r[] = $value;
			}
			$ret[] = $r;
		}

		$ret['data'] = $ret;
		$ret['recordsTotal'] = $count;
		$ret['iTotalDisplayRecords'] = $count;

		$ret['recordsFiltered'] = count($ret);
		$ret['draw'] = $_POST['draw'];

		echo json_encode($ret);

	}


	public function update(Request $request) {
		//return ;
		//return $request->all();
	    //
	    /*$this->validate($request, [
	        'name' => 'required|max:255',
	    ]);*/
		//dd($request);
		$image_gallery = null;
		if($request->id > 0) { 
			$image_gallery = Image_gallery::findOrFail($request->id); 
		}
		else { 
			$image_gallery = new Image_gallery;
		}
		$image_gallery->imgTypeId = $request->imgTypeId;

		if ($request->hasFile('uploadeImage')) {
			//return Storage::putFile('uploads', $request->file('uploadeImage'));
			if(isset($image_gallery->id) && !empty($image_gallery->id) && !empty($image_gallery->imgUrl)){

				Storage::Delete($image_gallery->imgUrl);	
				 
			}
            $image_gallery->imgUrl = Storage::putFile('uploads', $request->file('uploadeImage'));
           
        }

		
         $image_gallery->Name = $request->Name;
		$image_gallery->Description = $request->Description;

		$image_gallery->isActive = $request->isActive;
		$image_gallery->read_more_link = $request->read_more_link;
		$image_gallery->displayed_in = $request->displayed_in;
		
	    $image_gallery->save();

		if($request->imgTypeId == 1){
			return redirect('/image_galleries')->with('flash_message', 'Record added/updated successfully');
		}
		else{
			return back()->with('flash_message', 'Record added/updated successfully');
		}
	}

	public function store(Request $request)
	{
		return $this->update($request);
	}

	public function destroy(Request $request, $id) {
		
		$image_gallery = Image_gallery::findOrFail($id);

		$image_gallery->delete();
		return "OK";
	    
	}
        
        public function top_slider_text(Request $request, $id = "") {
            //echo "==============".__LINE__; exit;
           // 	$model = new Image_gallery();
            $top_slider_text = DB::table('homepage')->where(['type' => 'top_slider_text'])->first();
            
            //dd($top_slider_text);
            
	    return view('homepage.top_slider_text', compact('top_slider_text'));
        }
        
        public function update_data(Request $request, $id = "") {
            
            //dd($request->all());
            //echo "==============".__LINE__; exit;
           // 	$model = new Image_gallery();
	    //return view('homepage.top_slider_text');
            
            if($request->data_type == 'top_slider_text') {
                $insert_data = array(
                    'name' => 'top_slider_text',
                    'type' => $request->data_type,
                    'value' => $request->data_value
                );
            }
            $top_slider_text = DB::table('homepage')->where(['type' => $request->data_type])->first();
            if($top_slider_text) {
            DB::table('homepage')->where('id', $top_slider_text->id)->update($insert_data);
            } else {
            DB::table('homepage')->insert($insert_data);
            }
            
            return back()->with('flash_message', 'Record added/updated successfully');
        }
     
 //=======================  certificate ====================================================   
    public function certificate_list() {
        $data['certificate_list'] = DB::select("SELECT * FROM `tbl_certificate_main`");
        return view('homepage.certificate.list', $data);
    }
    public function add_certificate() {
        $data['certificate_list'] = DB::select("SELECT * FROM `tbl_certificate_main`");
        return view('homepage.certificate.add', $data);
    }
    public function save_certificate(Request $request)  {
    $gallery_name = $request->input('gallery_name');
     if ($request->hasFile('filenames1')) {
        $image = $request->file('filenames1');


        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'gallery_image/';
        $image->move($destinationPath, $name);

        //$path = url('/gallery_image/'.$name);
    
        
        DB::insert("INSERT INTO `tbl_certificate_main`(`filenames1`,`gallery_name`) VALUES ('$name','$gallery_name')");
        $main_id = DB::getPdo()->lastInsertId();
        //return redirect()->route('gallery_list');
    } 
        return redirect()->route('certificate-list'); 

  }
  
  public function delete_certificate($id) {
    DB::table('tbl_certificate_main')->where('main_id', $id)->delete();
               $url= url()->previous();
           return redirect($url);
     
 }
 //========================== certificate =================================================
 
 //=======================  service ====================================================   
    public function service_list() {
        $data['service_list'] = DB::select("SELECT * FROM `tbl_service_main`");
        return view('homepage.service.list', $data);
    }
    public function add_service() {
        $data['service_list'] = DB::select("SELECT * FROM `tbl_service_main`");
        return view('homepage.service.add', $data);
    }
    public function save_service(Request $request)  {
    $gallery_name = $request->input('gallery_name');
    $link = $request->input('link');
     if ($request->hasFile('filenames1')) {
        $image = $request->file('filenames1');


        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'gallery_image/';
        $image->move($destinationPath, $name);

        //$path = url('/gallery_image/'.$name);
    
        
        DB::insert("INSERT INTO `tbl_service_main`(`filenames1`,`gallery_name`, `link`) VALUES ('$name','$gallery_name','$link')");
        $main_id = DB::getPdo()->lastInsertId();
        //return redirect()->route('gallery_list');
    } 
        return redirect()->route('service-list'); 

  }
  
  public function delete_service($id) {
    DB::table('tbl_service_main')->where('main_id', $id)->delete();
               $url= url()->previous();
           return redirect($url);
     
 }
 //========================== service =================================================
 
 //=======================  Consultant ====================================================   
    public function consultant_list() {
        $data['consultant_list'] = DB::select("SELECT * FROM `tbl_consultant_main`");
        return view('homepage.consultant.list', $data);
    }
    public function add_consultant() {
        $data['consultant_list'] = DB::select("SELECT * FROM `tbl_consultant_main`");
        return view('homepage.consultant.add', $data);
    }
    public function save_consultant(Request $request)  {
    $gallery_name = $request->input('gallery_name');
    $degree = $request->input('degree');
     if ($request->hasFile('filenames1')) {
        $image = $request->file('filenames1');


        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'gallery_image/';
        $image->move($destinationPath, $name);

        //$path = url('/gallery_image/'.$name);
    
        
        DB::insert("INSERT INTO `tbl_consultant_main`(`filenames1`,`gallery_name`, `degree`) VALUES ('$name','$gallery_name','$degree')");
        $main_id = DB::getPdo()->lastInsertId();
        //return redirect()->route('gallery_list');
    } 
        return redirect()->route('consultant-list'); 

  }
  
  public function delete_consultant($id) {
    DB::table('tbl_consultant_main')->where('main_id', $id)->delete();
               $url= url()->previous();
           return redirect($url);
     
 }
 //========================== Consultant =================================================
 
 //=======================  Feedback ====================================================   
    public function feedback_list() {
        $data['feedback_list'] = DB::select("SELECT * FROM `tbl_feedback_main`");
        return view('homepage.feedback.list', $data);
    }
    public function add_feedback() {
        $data['feedback_list'] = DB::select("SELECT * FROM `tbl_feedback_main`");
        return view('homepage.feedback.add', $data);
    }
    public function save_feedback(Request $request)  {
    $gallery_name = $request->input('name');
    $message = $request->input('message');
     if ($request->hasFile('filenames1')) {
        $image = $request->file('filenames1');


        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'gallery_image/';
        $image->move($destinationPath, $name);

        //$path = url('/gallery_image/'.$name);
    
        
        DB::insert("INSERT INTO `tbl_feedback_main`(`filenames1`,`name`, `message`) VALUES ('$name','$gallery_name','$message')");
        $main_id = DB::getPdo()->lastInsertId();
        //return redirect()->route('gallery_list');
    } 
        return redirect()->route('feedback-list'); 

  }
  
  public function delete_feedback($id) {
    DB::table('tbl_feedback_main')->where('main_id', $id)->delete();
               $url= url()->previous();
           return redirect($url);
     
 }
 //========================== Feedback =================================================
 
  //=======================  Feedback ====================================================   
    public function new_dynamic_text_list() {
        $data['new_dynamic_text_list'] = DB::select("SELECT * FROM `new_wbsite_dynamic_text`");
        
       // dd($data);
        return view('homepage.new_dynamic_text.list', $data);
    }
    
    public function edit_new_dynamic_text(Request $request, $id = "") {
        $data['new_dynamic_text'] = DB::table('new_wbsite_dynamic_text')->where('id', $id)->first();
        
       //dd($data);
        return view('homepage.new_dynamic_text.add', $data);
    }
    
    public function add_new_dynamic_text() {
        $data['new_dynamic_text_list'] = DB::select("SELECT * FROM `new_wbsite_dynamic_text`");
        
       // dd([]);
        return view('homepage.new_dynamic_text.add', $data);
    }
    public function save_new_dynamic_text(Request $request)  {
        //dd($_POST);
        
        $insert_data = array(
            'name' => $request->name,
            'html_text' =>  HTML::entities($request->html_text),
            'html_content' =>  $request->html_text,
            'meta_desc' => $request->meta_desc,
            'meta_key' => $request->meta_key,
            'isActive' => is_null($request->isActive)?0:1,
            'textType' => $request->textType
        );
        
        
        
        if ($request->id > 0) {
            //echo "==========".__LINE__; //exit;
            DB::table('new_wbsite_dynamic_text')->where('id', $request->id)->update($insert_data);
            //$dynamic_text = new dynamic_text;
        } else {
           // echo "==========".__LINE__; //exit;
            DB::table('new_wbsite_dynamic_text')->insert($insert_data);
        }
        //dd($insert_data);
        return back()->withInput()->with('flash_message', 'Record added/updated successfully');

  }
  
  public function delete_new_dynamic_text($id) {
    DB::table('new_wbsite_dynamic_text')->where('main_id', $id)->delete();
               $url= url()->previous();
           return redirect($url);
     
 }
 //========================== Feedback =================================================
 
 //========================== settings =================================================
 public function edit_settings() {
		
    //$all_settings = Setting::all()->keyBy('name');
    
    $all_settings = DB::table('new_settings')->get()->keyBy('name');

    //echo "===========>>>>>>. <pre>".__LINE__; print_r($all_settings); exit;

    return view('homepage.settings.add', compact('all_settings'));

   // echo "===========>>>>>>. <pre>".__LINE__; print_r($all_settings); exit;
}

 public function new_update_settings(Request $request) {  
        
        //dd($_POST);
        
        if($request->has('update_hospital_logo')) {
            
            $message = "";
            
            $this->validate($request, [
                'hospital_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);


            $image = $request->file('hospital_logo');

            $input['imagename'] = 'new_logo.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/images');

            $image->move($destinationPath, $input['imagename']);
            
            $record = DB::table('new_settings')->where('name', 'hospital_logo')->first();
            
            if($record) {
                DB::table('new_settings')->where('name', 'hospital_logo')->update(['value' => $input['imagename']]);
            } else {
                DB::table('new_settings')->insert(['name' => 'hospital_logo','value' => $input['imagename']]);
            }
                                
           // Setting::where('name', 'hospital_logo')            ->update(['value' => $input['imagename']]);

            $message = "Logo updated successfully!";
        }
        
       
        //===================================================================
        if($request->has('update_top_slider_text')) {
            
            $this->validate($request,['top_slider_text' => 'required']);
            
            //Setting::where('name', 'top_slider_text')->update(['value' => $request->top_slider_text]);
            $record = DB::table('new_settings')->where('name', 'top_slider_text')->first();
            if($record) {
                DB::table('new_settings')->where('name', 'top_slider_text')->update(['value' => $request->top_slider_text]);
            } else {
                DB::table('new_settings')->insert(['name' => 'top_slider_text', 'value' => $request->top_slider_text]);
            }

            $message = "Top slider text updated successfully!";
        }
        //dd($_POST);
        
        if($request->has('update_twitter_link')) {
            //Setting::where('name', 'twitter_link')->update(['value' => $request->twitter_link]);
            
            //Setting::updateOrCreate(['name' => 'twitter_link'], ['value' => $request->twitter_link]);
            $record = DB::table('new_settings')->where('name', 'twitter_link')->first();
            if($record) {
                DB::table('new_settings')->where('name', 'twitter_link')->update(['value' => $request->twitter_link]);
            } else {
                DB::table('new_settings')->insert(['name' => 'twitter_link', 'value' => $request->twitter_link]);
            }

            $message = "Twitter link settings updated successfully!";
        }
        if($request->has('update_fb_link')) {
           
            //Setting::updateOrCreate(['name' => 'fb_link'], ['value' => $request->fb_link]);
            $record = DB::table('new_settings')->where('name', 'fb_link')->first();
            if($record) {
                DB::table('new_settings')->where('name', 'fb_link')->update(['value' => $request->fb_link]);
            } else {
                DB::table('new_settings')->insert(['name' => 'fb_link', 'value' => $request->fb_link]);
            }

            $message = "Facebook link settings updated successfully!";
        }
        if($request->has('update_linkedin_link')) {
            
           // Setting::updateOrCreate(['name' => 'linkedin_link'], ['value' => $request->linkedin_link]);
            
            $record = DB::table('new_settings')->where('name', 'linkedin_link')->first();
            if($record) {
                DB::table('new_settings')->where('name', 'linkedin_link')->update(['value' => $request->linkedin_link]);
            } else {
                DB::table('new_settings')->insert(['name' => 'linkedin_link', 'value' => $request->linkedin_link]);
            }
            
            $message = "Linkedin link settings updated successfully!";
        }
        if($request->has('update_insta_link')) {
            
           // Setting::updateOrCreate(['name' => 'insta_link'], ['value' => $request->insta_link]);
            $record = DB::table('new_settings')->where('name', 'insta_link')->first();
            if($record) {
                DB::table('new_settings')->where('name', 'insta_link')->update(['value' => $request->insta_link]);
            } else {
                DB::table('new_settings')->insert(['name' => 'insta_link', 'value' => $request->insta_link]);
            }
            
            $message = "Instagram link settings updated successfully!";
        }
        
       
         if($request->has('update_call_now')) {
            
            $this->validate($request,['call_now' => 'required']);
            
            //Setting::where('name', 'call_now')->update(['value' => $request->call_now]);
            
            $record = DB::table('new_settings')->where('name', 'call_now')->first();
            if($record) {
                DB::table('new_settings')->where('name', 'call_now')->update(['value' => $request->call_now]);
            } else {
                DB::table('new_settings')->insert(['name' => 'call_now', 'value' => $request->call_now]);
            }

            $message = "Call now updated successfully!";
        }
        
        if($request->has('update_appointment_link')) {
            
            $this->validate($request,['appointment_link' => 'required']);
            
            //Setting::where('name', 'appointment_link')->update(['value' => $request->appointment_link]);
            
            $record = DB::table('new_settings')->where('name', 'appointment_link')->first();
            if($record) {
                DB::table('new_settings')->where('name', 'appointment_link')->update(['value' => $request->appointment_link]);
            } else {
                DB::table('new_settings')->insert(['name' => 'appointment_link', 'value' => $request->appointment_link]);
            }

            $message = "Appointment link updated successfully!";
        }
        
        if($request->has('update_whatsapp')) {
            
            $this->validate($request,['whatsapp' => 'required']);
            
            //Setting::where('name', 'whatsapp')->update(['value' => $request->whatsapp]);
            $record = DB::table('new_settings')->where('name', 'whatsapp')->first();
            if($record) {
                DB::table('new_settings')->where('name', 'whatsapp')->update(['value' => $request->whatsapp]);
            } else {
                DB::table('new_settings')->insert(['name' => 'whatsapp', 'value' => $request->whatsapp]);
            }

            $message = "Whatsapp updated successfully!";
        }
        
        if($request->has('google_map')) {
            
            $this->validate($request,['google_map' => 'required']);
            
            //Setting::where('name', 'google_map')->update(['value' => $request->google_map]);
            $record = DB::table('new_settings')->where('name', 'google_map')->first();
            if($record) {
                DB::table('new_settings')->where('name', 'google_map')->update(['value' => $request->google_map]);
            } else {
                DB::table('new_settings')->insert(['name' => 'google_map', 'value' => $request->google_map]);
            }

            $message = "Whatsapp updated successfully!";
        }
        //===================================================================
        
        return back()->with('flash_message', $message);
        //dd($request->all());
    }
 //========================== end settings =============================================
    
    //========================= slider ============================
    
    public function new_home_slider_list() {
        //$data['new_dynamic_text_list'] = DB::select("SELECT * FROM `new_wbsite_dynamic_text`");
        
       // dd($data);
        return view('homepage.slider.list');
    }
    
    public function slider_grid(Request $request) {
        $len = $_POST['length'];
        $start = $_POST['start'];
        $imgTypeId = $_POST['imgTypeId'];

        $select = "SELECT id,Name,Description,isActive,1,2 ";
        $presql = " FROM new_web_image_gallery a ";
        $presql .= " WHERE imgTypeId = ".$imgTypeId;
        if($_POST['search']['value']) {	
                $presql .= " and Name LIKE '%".$_POST['search']['value']."%' ";
        }

        $presql .= "  ";

        $sql = $select.$presql." LIMIT ".$start.",".$len;

        $qcount = DB::select("SELECT COUNT(a.id) c".$presql);
        //print_r($qcount);
        $count = $qcount[0]->c;

        $results = DB::select($sql);
        $ret = [];
        foreach ($results as $row) {
            $r = [];
            foreach ($row as $value) {
                $r[] = $value;
            }
            $ret[] = $r;
        }

        $ret['data'] = $ret;
        $ret['recordsTotal'] = $count;
        $ret['iTotalDisplayRecords'] = $count;

        $ret['recordsFiltered'] = count($ret);
        $ret['draw'] = $_POST['draw'];

        echo json_encode($ret);

    }
    
    public function new_home_slider_add(Request $request) {
        return view('homepage.slider.add');
    }

    public function new_home_slider_edit(Request $request, $id) {
        $image_gallery = DB::table('new_web_image_gallery')->where('id', $id)->first();
        
        //dd((array)$image_gallery);
        return view('homepage.slider.add', ['model' => (array) $image_gallery]);
    }
    
    public function update_image_gallery(Request $request, $id = "") {
        
        $insert_data = array(
            'Name' => $request->Name,
            'Description' => $request->Description,
            'isActive' => $request->isActive,
            'read_more_link' => $request->read_more_link,
            'displayed_in' => $request->displayed_in,
            'imgTypeId' => $request->imgTypeId
        );
        
        if ($request->hasFile('uploadeImage')) {            
            //==================================================
            $this->validate($request, [
                'uploadeImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);


            $image = $request->file('uploadeImage');

            $input['imagename'] = 'new_slider'.strtotime('now').'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/images');

            $image->move($destinationPath, $input['imagename']);
            
            $insert_data['imgUrl'] = $input['imagename'];
            //===================================================
        }
        
        if($request->id > 0) { 
            DB::table('new_web_image_gallery')->where('id', $request->id)->update($insert_data);
        } else {
            DB::table('new_web_image_gallery')->insert($insert_data);
        }

        if($request->imgTypeId == 1){
            return redirect('new-home-slider-list')->with('flash_message', 'Record added/updated successfully');
        } else {
            return redirect('new-iamge-gallery-list')->with('flash_message', 'Record added/updated successfully');
        }
    }
    
    public function slider_delete(Request $request, $id) {		
        DB::table('new_web_image_gallery')->where('id', $id)->delete();
        return "OK";
    }
    //=========================== end slider =============================
    
     //=========================== Start Image gallery =============================
    public function new_image_gallery_list() {
        return view('homepage.image_gallery.list');
    }
    
    public function new_image_gallery_add(Request $request) {
        return view('homepage.image_gallery.add');
    }

    public function new_image_gallery_edit(Request $request, $id) {
        $image_gallery = DB::table('new_web_image_gallery')->where('id', $id)->first();
        return view('homepage.image_gallery.add', ['model' => (array) $image_gallery]);
    }
     //=========================== end Image gallery =============================
}