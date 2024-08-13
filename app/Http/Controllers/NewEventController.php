<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Image_gallery;
use App\NewEvents;

use DB;
use Storage;
class NewEventController extends AdminRootController
{
    
//-------------------------------------- Start our departments section -----------------------------------------------------------    
   //-------------------------------------- Start our departments section -----------------------------------------------------------    

    public function list_events(Request $request) {
        return view('new_home_page.new_events.index', []);
    }
    
    public function list_comments(Request $request, $event_id) {
        return view('new_home_page.new_events.list_comments', ['event_id' => $event_id]);
    }
    
    public function list_comments_grid(Request $request) {
        $len = $_POST['length'];
        $start = $_POST['start'];
        $event_id = $_POST['event_id'];

        $select = "SELECT id, name, mobile, email, comment, status, id";
        $presql = " FROM event_comments a ";
        $presql .= " WHERE a.event_id = '".$event_id."' AND a.is_deleted = '0' ";
        if($_POST['search']['value']) {	
                $presql .= " and name LIKE '%".$_POST['search']['value']."%' ";
        }

        $presql .= "  ";
        
        $orderByStr = " order by a.id desc";
        if (isset($_POST['order'][0]['column']) && is_numeric($_POST['order'][0]['column']))
        {
            $orderColum = intval($_POST['order'][0]['column']) + 1;
            $orderByStr = " order by " . $orderColum . " " . $_POST['order'][0]['dir'];
        }

        $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;


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

    public function new_events_grid(Request $request) {
        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = "SELECT id, title, description, is_active, id, id, id";
        $presql = " FROM new_events a ";
        $presql .= " WHERE type = 'general' ";
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

    public function add_event(Request $request, $id = "") {
            $model = ($id) ? NewEvents::find($request->id) :  new NewEvents() ;
            
           //dd($model);
         return view('new_home_page.new_events.add', ['model'=>$model]);
    }

    public function manage_event(Request $request) {

       //dd($request->all());
 $img_url = [];
        $new_event_record = null;
        if($request->id > 0) { 
                $new_event_record = NewEvents::findOrFail($request->id); 
                
                
                if($request->has('old_images')) {
                    $old_images = $request->old_images;


                    $db_old_iomages = explode(',', $new_event_record->img_url);

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
                $new_event_record = new NewEvents() ;
        }
        
        /*
        if ($request->hasFile('uploadeImage')) {
            if(isset($new_event_record->id) && !empty($new_event_record->id) && !empty($new_event_record->img_url)){
                    Storage::Delete($new_home_page_record->img_url);	

            }
            $new_event_record->img_url = Storage::putFile('uploads', $request->file('uploadeImage'));

        }
        */
        
         if ($request->hasFile('uploadeImage')) {
            foreach($request->file('uploadeImage') as $file) {
                $img_url[] = Storage::putFile('uploads', $file);
            }
        }
        
        $new_event_record->img_url = implode(',', $img_url);
        
        
        $new_event_record->type = $request->type;
        $new_event_record->title = $request->title;
        $new_event_record->start_date = ($request->start_date) ? date('Y-m-d', strtotime($request->start_date)) : null;
        $new_event_record->end_date = ($request->end_date) ? date('Y-m-d', strtotime($request->end_date)) : null;
        $new_event_record->description = $request->description;

        $new_event_record->is_active = $request->is_active;
        $new_event_record->read_more_link = $request->read_more_link;
        //$new_event_record->displayed_in = $request->displayed_in;

        $new_event_record->save();

        return redirect('/list-events')->with('flash_message', 'Record added/updated successfully');

    }
    
     public function delete_event(Request $request, $id) {
            
            DB::table('new_events')->where('id', $id)->delete();
	    return "OK";
	    
	}
//-------------------------------------- End slider footer section -----------------------------------------------------------         
//-------------------------------------- End our departments section -----------------------------------------------------------

	public function destroy(Request $request, $id) {
		
		$image_gallery = Image_gallery::findOrFail($id);

		$image_gallery->delete();
		return "OK";
	    
	}
        
        public function hide_comment(Request $request, $id) {
            DB::table('event_comments')->where('id', $request->event_id)->update(['status' => '0']);
            return "OK";
	}
        
        public function show_comment(Request $request, $id) {
		
            DB::table('event_comments')->where('id', $request->event_id)->update(['status' => '1']);
            return "OK";
	    
	}
        
        public function delete_comment(Request $request, $id) {
            DB::table('event_comments')->where('id', $request->event_id)->update(['is_deleted' => '0']);
	    return "OK";
	    
	}
        
        

	
}