<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Image_gallery;
use App\NewHomePage;

use DB;
use Storage;
class NewHomePageController extends AdminRootController
{
    
//-------------------------------------- Start our departments section -----------------------------------------------------------    

    public function section_slider_footer(Request $request)
	{
	    return view('new_home_page.section_slider_footer.index', []);
	}
        
        public function section_slider_footer_grid(Request $request)
	{
            $len = $_POST['length'];
            $start = $_POST['start'];

            $select = "SELECT id,title,description,is_active, id, id";
            $presql = " FROM homepage_data a ";
            $presql .= " WHERE type = 'section_slider_footer' ";
            if($_POST['search']['value']) {	
                    $presql .= " and name LIKE '%".$_POST['search']['value']."%' ";
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

	public function add_section_slider_footer(Request $request, $id = "")
	{
            $model = ($id) ? NewHomePage::find($request->id) :  new NewHomePage() ;
		
            //dd($model);
	     return view('new_home_page.section_slider_footer.add_section_slider_footer', ['model'=>$model]);
	}
        
        public function manage_section_slider_footer(Request $request) {
            
           // dd($request->all());
            
            $new_home_page_record = null;
            if($request->id > 0) { 
                    $new_home_page_record = NewHomePage::findOrFail($request->id); 
            }
            else { 
                    $new_home_page_record = new NewHomePage;
            }
            
            if ($request->hasFile('uploadeImage')) {
                if(isset($new_home_page_record->id) && !empty($new_home_page_record->id) && !empty($new_home_page_record->img_url)){

                        Storage::Delete($new_home_page_record->img_url);	

                }
                $new_home_page_record->img_url = Storage::putFile('uploads', $request->file('uploadeImage'));
                
            
            }
            
            
                $new_home_page_record->type = $request->type;
                $new_home_page_record->title = $request->title;
		$new_home_page_record->description = $request->description;

		$new_home_page_record->is_active = $request->is_active;
		$new_home_page_record->read_more_link = $request->read_more_link;
		//$new_home_page_record->displayed_in = $request->displayed_in;
		
                $new_home_page_record->save();

		return redirect('/section-slider-footer')->with('flash_message', 'Record added/updated successfully');
        }
          public function delete_section_slider_footer(Request $request, $id) {
            
            DB::table('homepage_data')->where('id', $id)->delete();
	    return "OK";
	    
	}
//-------------------------------------- End slider footer section  -----------------------------------------------------------     
//

        
        //-------------------------------------- Start our departments section 2-----------------------------------------------------------    

    public function section_slider_footer2(Request $request)
	{
	    return view('new_home_page.section_slider_footer2.index', []);
	}
        
        public function section_slider_footer2_grid(Request $request)
	{
            $len = $_POST['length'];
            $start = $_POST['start'];

            $select = "SELECT id,title,description,is_active, id, id";
            $presql = " FROM homepage_data a ";
            $presql .= " WHERE type = 'section_slider_footer2' ";
            if($_POST['search']['value']) {	
                    $presql .= " and name LIKE '%".$_POST['search']['value']."%' ";
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

	public function add_section_slider_footer2(Request $request, $id = "")
	{
            $model = ($id) ? NewHomePage::find($request->id) :  new NewHomePage() ;
		
            //dd($model);
	     return view('new_home_page.section_slider_footer2.add_section_slider_footer', ['model'=>$model]);
	}
        
        public function manage_section_slider_footer2(Request $request) {
            
           // dd($request->all());
            
            $new_home_page_record = null;
            if($request->id > 0) { 
                    $new_home_page_record = NewHomePage::findOrFail($request->id); 
            }
            else { 
                    $new_home_page_record = new NewHomePage;
            }
            
            if ($request->hasFile('uploadeImage')) {
                if(isset($new_home_page_record->id) && !empty($new_home_page_record->id) && !empty($new_home_page_record->img_url)){

                        Storage::Delete($new_home_page_record->img_url);	

                }
                $new_home_page_record->img_url = Storage::putFile('uploads', $request->file('uploadeImage'));
                
            
            }
            
            
                $new_home_page_record->type = $request->type;
                $new_home_page_record->title = $request->title;
		$new_home_page_record->description = $request->description;

		$new_home_page_record->is_active = $request->is_active;
		$new_home_page_record->read_more_link = $request->read_more_link;
		//$new_home_page_record->displayed_in = $request->displayed_in;
		
                $new_home_page_record->save();

		return redirect('/section-slider-footer2')->with('flash_message', 'Record added/updated successfully');
        }
          public function delete_section_slider_footer2(Request $request, $id) {
            
            DB::table('homepage_data')->where('id', $id)->delete();
	    return "OK";
	    
	}
//-------------------------------------- End slider footer section -----------------------------------------------------------   
//
//
//-------------------------------------- Start our departments section -----------------------------------------------------------    
   //-------------------------------------- Start our departments section -----------------------------------------------------------    

    public function section_our_departments(Request $request) {
        return view('new_home_page.our_departments.index', []);
    }

    public function section_our_departments_grid(Request $request) {
        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = "SELECT id,title,description,is_active, id, id";
        $presql = " FROM homepage_data a ";
        $presql .= " WHERE type = 'section_departments' ";
        if($_POST['search']['value']) {	
                $presql .= " and name LIKE '%".$_POST['search']['value']."%' ";
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

    public function add_section_our_departments(Request $request, $id = "") {
            $model = ($id) ? NewHomePage::find($request->id) :  new NewHomePage() ;
            
           // dd($model);
         return view('new_home_page.our_departments.add', ['model'=>$model]);
    }

    public function manage_section_our_departments(Request $request) {

       //dd($request->all());

        $new_home_page_record = null;
        if($request->id > 0) { 
                $new_home_page_record = NewHomePage::findOrFail($request->id); 
        }
        else { 
                $new_home_page_record = new NewHomePage;
        }

        if ($request->hasFile('uploadeImage')) {
            if(isset($new_home_page_record->id) && !empty($new_home_page_record->id) && !empty($new_home_page_record->img_url)){

                    Storage::Delete($new_home_page_record->img_url);	

            }
            $new_home_page_record->img_url = Storage::putFile('uploads', $request->file('uploadeImage'));

            

        }
        $new_home_page_record->type = $request->type;
            $new_home_page_record->title = $request->title;
            $new_home_page_record->description = $request->description;

            $new_home_page_record->is_active = $request->is_active;
            $new_home_page_record->read_more_link = $request->read_more_link;
            //$new_home_page_record->displayed_in = $request->displayed_in;

            $new_home_page_record->save();

            return redirect('/section-our-departments')->with('flash_message', 'Record added/updated successfully');
    }
//-------------------------------------- End slider footer section -----------------------------------------------------------         
//-------------------------------------- End our departments section -----------------------------------------------------------
    
    //-------------------------------------- Start work section -----------------------------------------------------    

    public function section_work(Request $request) {
        return view('new_home_page.work.index', []);
    }

    public function section_work_grid(Request $request) {
        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = "SELECT id,title,description,is_active, id, id";
        $presql = " FROM homepage_data a ";
        $presql .= " WHERE type = 'section_work' ";
        if($_POST['search']['value']) {	
                $presql .= " and name LIKE '%".$_POST['search']['value']."%' ";
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

    public function add_section_work(Request $request, $id = "") {
            $model = ($id) ? NewHomePage::find($request->id) :  new NewHomePage() ;
            
           // dd($model);
         return view('new_home_page.work.add', ['model'=>$model]);
    }

    public function manage_section_work(Request $request) {

       //dd($request->all());

        $new_home_page_record = null;
        if($request->id > 0) { 
            $new_home_page_record = NewHomePage::findOrFail($request->id); 
        }
        else { 
                $new_home_page_record = new NewHomePage;
        }

        if ($request->hasFile('uploadeImage')) {
            if(isset($new_home_page_record->id) && !empty($new_home_page_record->id) && !empty($new_home_page_record->img_url)){
                    Storage::Delete($new_home_page_record->img_url);	
            }
            $new_home_page_record->img_url = Storage::putFile('uploads', $request->file('uploadeImage'));
        }
        $new_home_page_record->type = 'section_work';
        $new_home_page_record->title = $request->title;
        $new_home_page_record->description = $request->description;

        $new_home_page_record->is_active = $request->is_active;
        $new_home_page_record->read_more_link = $request->read_more_link;
        //$new_home_page_record->displayed_in = $request->displayed_in;

        $new_home_page_record->save();

        return redirect('/section-work')->with('flash_message', 'Record added/updated successfully');
    }
//-------------------------------------- End work section -----------------------------------------------------------      
    
    
     //-------------------------------------- Start Paper Cutting section -----------------------------------------------------    

    public function section_paper_cutting(Request $request) {
        return view('new_home_page.paper_cutting.index', []);
    }

    public function section_paper_cutting_grid(Request $request) {
        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = "SELECT id,title,description,is_active, id, id";
        $presql = " FROM homepage_data a ";
        $presql .= " WHERE type = 'section_paper_cutting' ";
        if($_POST['search']['value']) {	
                $presql .= " and name LIKE '%".$_POST['search']['value']."%' ";
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

    public function add_section_paper_cutting(Request $request, $id = "") {
            $model = ($id) ? NewHomePage::find($request->id) :  new NewHomePage() ;
            
           // dd($model);
         return view('new_home_page.paper_cutting.add', ['model'=>$model]);
    }

    public function manage_section_paper_cutting(Request $request) {

     // dd($request->all());
         $img_url = [];
        $new_home_page_record = null;
        if($request->id > 0) { 
            $new_home_page_record = NewHomePage::findOrFail($request->id); 
            
            
            if($request->has('old_images')) {
                $old_images = $request->old_images;
               
                
                $db_old_iomages = explode(',', $new_home_page_record->img_url);
                
                // echo "====>>>>>>>>> <pre>".__LINE__; print_r($db_old_iomages); exit;
                foreach($db_old_iomages as $db_old_iomages_row) {
                    if(!in_array($db_old_iomages_row, $old_images)) {
                         Storage::Delete($db_old_iomages_row);	
                    } else {
                        $img_url[] = $db_old_iomages_row;
                    }
                }
            }
        } else { 
            $new_home_page_record = new NewHomePage;
        }
       // echo "====>>>>>>>>> <pre>"; print_r($img_url); exit;
        if ($request->hasFile('uploadeImage')) {
            foreach($request->file('uploadeImage') as $file) {
                $img_url[] = Storage::putFile('uploads', $file);
            }
        }
        
        $new_home_page_record->img_url = implode(',', $img_url);
        
        $new_home_page_record->type = 'section_paper_cutting';
        $new_home_page_record->title = $request->title;
        $new_home_page_record->description = $request->description;

        $new_home_page_record->is_active = $request->is_active;
        $new_home_page_record->read_more_link = $request->read_more_link;
        //$new_home_page_record->displayed_in = $request->displayed_in;

        $new_home_page_record->save();

        return redirect('/section-paper-cutting')->with('flash_message', 'Record added/updated successfully');
    }
//-------------------------------------- End Paper Cutting section -----------------------------------------------------------       
    

    /*
	public function edit(Request $request, $id)
	{
		$NewHomePage = NewHomePage::findOrFail($id);
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
	    //$this->validate($request, [
	      //  'name' => 'required|max:255',
	    //]);
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
        
       */
	
	
	public function edit_section_welcome(Request $request, $id = "") {
        $model = NewHomePage::where('type', 'section_welcome')->first();
        $model = ($model) ? $model->toArray() :  new NewHomePage() ;

        // dd($model);
        return view('new_home_page.edit_section_welcome', ['model'=>$model]);
    }
       
    public function manage_section_welcome(Request $request) {

       //dd($request->all());

        $new_home_page_record = null;
        if($request->id > 0) { 
                $new_home_page_record = NewHomePage::findOrFail($request->id); 
        } else { 
                $new_home_page_record = new NewHomePage;
        }

        if ($request->hasFile('uploadeImage')) {
            if(isset($new_home_page_record->id) && !empty($new_home_page_record->id) && !empty($new_home_page_record->img_url)) {
                Storage::Delete($new_home_page_record->img_url);
            }
            $new_home_page_record->img_url = Storage::putFile('uploads', $request->file('uploadeImage'));
        }
        $new_home_page_record->type = $request->type;
        $new_home_page_record->title = $request->title;
        $new_home_page_record->description = $request->description;

        $new_home_page_record->is_active = $request->is_active;
        $new_home_page_record->read_more_link = $request->read_more_link;

        $new_home_page_record->save();

        return redirect('/section-welcome')->with('flash_message', 'Record added/updated successfully');
    }
	

	//-------------------------------------- Start Slider 2 section -----------------------------------------------------------    

    public function section_slider2(Request $request)
	{
	    return view('new_home_page.section_slider2.index', []);
	}
        
        public function section_slider2_grid(Request $request)
	{
            $len = $_POST['length'];
            $start = $_POST['start'];

            $select = "SELECT id,title,description,is_active, id, id";
            $presql = " FROM homepage_data a ";
            $presql .= " WHERE type = 'section_slider2' ";
            if($_POST['search']['value']) {	
                    $presql .= " and name LIKE '%".$_POST['search']['value']."%' ";
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

	public function add_section_slider2(Request $request, $id = "")
	{
            $model = ($id) ? NewHomePage::find($request->id) :  new NewHomePage() ;
		
            //dd($model);
	     return view('new_home_page.section_slider2.add_section_slider2', ['model'=>$model]);
	}
        
        public function manage_section_slider2(Request $request) {
            
          // dd($request->all());
            
            $new_home_page_record = null;
            if($request->id > 0) { 
                    $new_home_page_record = NewHomePage::findOrFail($request->id); 
            }
            else { 
                    $new_home_page_record = new NewHomePage;
            }
            
            if ($request->hasFile('uploadeImage')) {
                if(isset($new_home_page_record->id) && !empty($new_home_page_record->id) && !empty($new_home_page_record->img_url)){

                        Storage::Delete($new_home_page_record->img_url);	

                }
                $new_home_page_record->img_url = Storage::putFile('uploads', $request->file('uploadeImage'));
                
            
            }
            
            
                $new_home_page_record->type = $request->type;
                $new_home_page_record->title = $request->title;
		$new_home_page_record->description = $request->description;

		$new_home_page_record->is_active = $request->is_active;
		$new_home_page_record->read_more_link = $request->read_more_link;
		//$new_home_page_record->displayed_in = $request->displayed_in;
		
                $new_home_page_record->save();

		return redirect('/section-slider2')->with('flash_message', 'Record added/updated successfully');
        }
          public function delete_section_slider2(Request $request, $id) {
            
            DB::table('homepage_data')->where('id', $id)->delete();
	    return "OK";
	    
	}
//-------------------------------------- End slider 2 section -----------------------------------------------------------   

	
}