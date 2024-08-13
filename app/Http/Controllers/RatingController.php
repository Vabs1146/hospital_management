<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as HttpGuzzle;
use Illuminate\Support\Facades\Input;

use Calendar;
use App\appointment;
use App\doctor;
use App\timeslot;
use App\Models\rating;
use Auth;
use App\Helpers\Helpers;
use App\helperClass\CommonHelper;

class RatingController extends Controller
{

 public function __construct()
    {
        $this->acc=0;
        $this->commonHelper = new CommonHelper();
    }
    
    public function AddRating(){
        $ratingLst =  rating::where('isActive', 1)->get();
        return view('rating.add', compact('ratingLst'));
    }

    public function submitRating(Request $request){
        $form_details = new rating();
        $form_details = $form_details->Create($request->all());

        $form_details->username=$request->input('username');
         $form_details->mobileno=$request->input('mobileno');
         $form_details->feedback=$request->input('feedback');
         $form_details->ratingscore=$request->input('ratingscore');
      

           $image = $request->file('userimage');
           $name = time().'.'.$image->getClientOriginalExtension();
           $destinationPath = 'images/';
           $image->move($destinationPath, $name);
           $form_details->userimage=$name;
          $form_details->save();

   // \LogActivity::addToLog('Rating record added/updated successfully');
        return redirect()->back()->withInput()->with('flash_message', 'Record added/updated successfully');
    }

    public function ratingList(Request $request){
        return view('rating.RatingList');
    }

    public function ApproveReject(Request $request, $RatingId){

          $user = Auth::user()->id;

         $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='rating/list/ApproveRejectRating'");

            foreach ($accesslevel as $value) {
            $this->acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("rating/list/ApproveRejectRating",Auth::user()->id);
        if ($this->acc == 1) {
              $rating =  rating::where('id', $RatingId)->first();
        if(empty($rating)){
            $rating = new rating();
        }
        return view('rating.approveReject', compact('rating'));
        }

         else
        {
           $url= url()->previous();
           return redirect($url);
        }

      
    }
    
    public function SubmitApproveReject(Request $request){
        // if($request->has('isActive')){
        //     $request->isActive = 1;
        // }else{
        //     $request->isActive = 0;
        // }
        $request->merge(['isActive' => ($request->has('isActive'))]);
        //return var_dump($request);
        $form_details = rating::firstOrNew(['id'=>$request->id]);
        $form_details = $form_details->update($request->all());
         //\LogActivity::addToLog('Rating added/updated  successfully');
        return redirect()->back()->withInput()->with('flash_message', 'Rating added/updated successfully');
    }

    public function grid(Request $request){
        
        $len = $_POST['length'];
        $start = $_POST['start'];

         $select = "SELECT id, username, mobileno, feedback, ratingscore, isActive";
        $presql = " FROM rating";
        $presql .= " WHERE 1=1 ";
        if ($_POST['search']['value']) {
            $presql .= " and name LIKE '%".$_POST['search']['value']."%' ";
        }
        $presql .= "  ";

        $orderByStr = " order by 1 desc";
        //$orderColum = ( isset( $_GET['order'][0]['column'] ) && is_numeric( $_GET['order'][0]['column'] ) ) ? intval( $_GET['order'][0]['column'] )+1 : 1;

        if( isset( $_POST['order'][0]['column'] ) && is_numeric( $_POST['order'][0]['column'] ) ){
            $orderColum = intval( $_POST['order'][0]['column'] )+1;
            $orderByStr = " order by ". $orderColum . " " . $_POST['order'][0]['dir'];
        }


        $sql = $select.$presql.$orderByStr." LIMIT ".$start.",".$len;


        $qcount = DB::select("SELECT COUNT(id) c".$presql);
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
        $ret['sql'] = $sql;
        echo json_encode($ret);
    }
	
	function delete_rating(Request $request, $RatingId) {

        rating::where('id', $RatingId)->delete();
		
        return redirect()->back()->withInput()->with('flash_message', 'Rating deleted successfully');
      
    }

}