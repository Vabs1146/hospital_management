<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Image_gallery;

use DB;
use Storage;
class Image_galleriesController extends AdminRootController
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

	
}