<?php

namespace App\Http\Controllers;
ini_set('max_execution_time', 300);
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use App\Models\dentist_pain_in;
use App\Models\dentist;
use App\Case_master;
use App\helperClass\drAppHelper;
use App\Image_gallery;
use App\Models\dentist_bill;
use Illuminate\Support\Facades\Mail;
use App\Mail\DentistFormEmail;
use DB;
use Storage;
use PDF;
use App;

class dentistController extends AdminRootController
{

    public function index(Request $request)
    {
        return view('dentist.index', []);
    }

    public function edit(Request $request, $id)
    {
        $case_master  = Case_master::findOrFail($id);
        $dentist = dentist::where('case_id', $id)->first();
        if (count($dentist) <= 0 ||  $dentist === null || is_null($dentist) || empty($dentist) || !isset($dentist)) {
            $dentist = new dentist();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $dentist_pain_in = $dentist->dentist_pain_in()->get();
        if(count($dentist_pain_in) <= 0 ){
            $dentist_pain_in = new dentist_pain_in();
        }
        return view('dentist.add', compact('case_master','dentist', 'DateWiseRecordLst','dentist_pain_in'));
    }

   ///////////Dentist-pdf-Mail-///////////////////
    public function update(Request $request){

        $isEdit = true;
        $form_details = dentist::where('case_id', $request->case_id)->first();
        //var_dump(DB::getQueryLog());
        if ($form_details === null) {
            $form_details = new dentist();
            $isEdit = false;
        }

        $form_details->fill($request->all());
        $form_details->save();

        $dentist_pain_in = array();
        foreach($request->dentist_pain_in as $painIn){
            if (!empty($painIn)) {
                $dentist_pain_in_each = [
                    'dentist_id' => $form_details->id,
                    'pain_in_teeth' => $painIn
                ];
            }
            $form_details->dentist_pain_in()->updateOrCreate($dentist_pain_in_each);
        }
        // Send Email to Other
        if (Input::get('SendEmail')) {
           
        if($request->email && !empty($request->email)){
			$this->validate($request, [
                    'email' => 'required|email'
                    
                ]);
         $case_master  = Case_master::findOrFail($request->case_id);
         $pdfname="dentistFormEmail".$request->case_id.".pdf";
          $case_master->pdfname=$pdfname;
          $case_master->save(); 

        $dentist = dentist::where('case_id', $request->case_id)->first();
        if (count($dentist) <= 0 ||  $dentist === null || is_null($dentist) || empty($dentist) || !isset($dentist)) {
            $dentist = new dentist();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $dentist_pain_in = $dentist->dentist_pain_in()->get();
        if(count($dentist_pain_in) <= 0 ){
            $dentist_pain_in = new dentist_pain_in();
        }
        $dentist_bill = dentist_bill::where('case_id', $request->case_id)->get();
        $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
        $logoUrl='';
        if(!is_null($image_gallery) && isset($image_gallery->imgUrl)){
            $logoUrl=$image_gallery->imgUrl;
        }
      // return view('dentist.dentistformmail', compact('case_master','dentist', 'DateWiseRecordLst','dentist_pain_in','logoUrl','dentist_bill'));


                 if(\File::exists(public_path('dentistpdf/'.$pdfname))){
                  \File::delete(public_path('dentistpdf/'.$pdfname));
                $pdf = PDF::loadView('dentist.dentistformmail', compact('casedata','patient_details','logoUrl'));
                $path = public_path('dentistpdf/');
                $fileName = 'dentistFormEmail'.$request->case_id.'.pdf' ;
                $pdf->save($path . '/' . $fileName);
                }else{
  $pdf = PDF::loadView('dentist.dentistformmail', compact('case_master','dentist', 'DateWiseRecordLst','dentist_pain_in','logoUrl','dentist_bill'));
                $path = public_path('dentistpdf/');
                $fileName = 'dentistFormEmail'.$request->case_id.'.pdf' ;
                $pdf->save($path . '/' . $fileName);
                }
              

                $mailContent = compact('case_master','dentist', 'DateWiseRecordLst','dentist_pain_in','logoUrl','dentist_bill');
                $mailTemplate = 'dentist.dentistformmail';
                  

                Mail::to($request->email)->send(new DentistFormEmail($request->case_id));
        return redirect()->back()->with('flash_message', 'Email has been sent to '. $request->email);
                
                }

        }

        // Send Email To Present Email ID
        if (Input::get('SubmitMail')) {
            if($request->patient_emailId && !empty($request->patient_emailId)){
				$this->validate($request, [
                    'patient_emailId' => 'required|email'
                    
                ]);
            $case_master  = Case_master::findOrFail($request->case_id);
         $pdfname="dentistFormEmail".$request->case_id.".pdf";
          $case_master->pdfname=$pdfname;
          $case_master->save(); 

        $dentist = dentist::where('case_id', $request->case_id)->first();
        if (count($dentist) <= 0 ||  $dentist === null || is_null($dentist) || empty($dentist) || !isset($dentist)) {
            $dentist = new dentist();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $dentist_pain_in = $dentist->dentist_pain_in()->get();
        if(count($dentist_pain_in) <= 0 ){
            $dentist_pain_in = new dentist_pain_in();
        }
        $dentist_bill = dentist_bill::where('case_id', $request->case_id)->get();
        $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
        $logoUrl='';
        if(!is_null($image_gallery) && isset($image_gallery->imgUrl)){
            $logoUrl=$image_gallery->imgUrl;
        }
     // return view('dentist.dentistformmail', compact('case_master','dentist', 'DateWiseRecordLst','dentist_pain_in','logoUrl','dentist_bill'));


                 if(\File::exists(public_path('dentistpdf/'.$pdfname))){
                  \File::delete(public_path('dentistpdf/'.$pdfname));
                $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('dentist.dentistformmail', compact('case_master','dentist', 'DateWiseRecordLst','dentist_pain_in','logoUrl','dentist_bill'));
                $path = public_path('dentistpdf/');
                $fileName = 'dentistFormEmail'.$request->case_id.'.pdf' ;
                $pdf->save($path . '/' . $fileName);
                }else{
  $pdf = PDF::loadView('dentist.dentistformmail', compact('case_master','dentist', 'DateWiseRecordLst','dentist_pain_in','logoUrl','dentist_bill'));
                $path = public_path('dentistpdf/');
                $fileName = 'dentistFormEmail'.$request->case_id.'.pdf' ;
                $pdf->save($path . '/' . $fileName);
                }
              

                $mailContent = compact('case_master','dentist', 'DateWiseRecordLst','dentist_pain_in','logoUrl','dentist_bill');
                $mailTemplate = 'dentist.dentistformmail';
                  

                Mail::to($request->patient_emailId)->send(new DentistFormEmail($request->case_id));
        return redirect()->back()->with('flash_message', 'Email has been sent to '. $request->patient_emailId);
                
                }
        }
        

        return redirect()->back()->with('flash_message', 'Record added successfully');
    }
/////////////////////////////////////////

    public function show(Request $request, $id){
        $case_master  = Case_master::findOrFail($id);
        $dentist = dentist::where('case_id', $id)->first();
        if (count($dentist) <= 0 ||  $dentist === null || is_null($dentist) || empty($dentist) || !isset($dentist)) {
            $dentist = new dentist();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $dentist_pain_in = $dentist->dentist_pain_in()->get();
        if(count($dentist_pain_in) <= 0 ){
            $dentist_pain_in = new dentist_pain_in();
        }
        $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
        $logoUrl='';
        if(!is_null($image_gallery) && isset($image_gallery->imgUrl)){
            $logoUrl=$image_gallery->imgUrl;
        }
        return view('dentist.view', compact('case_master','dentist', 'DateWiseRecordLst','dentist_pain_in','logoUrl'));
    }

    public function printbill($id){
        $case_master  = Case_master::findOrFail($id);

        $dentist = dentist::where('case_id', $id)->first();
        if (count($dentist) <= 0 ||  $dentist === null || is_null($dentist) || empty($dentist) || !isset($dentist)) {
            $dentist = new dentist();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $dentist_pain_in = $dentist->dentist_pain_in()->get();
        if(count($dentist_pain_in) <= 0 ){
            $dentist_pain_in = new dentist_pain_in();
        }
        $dentist_bill = dentist_bill::where('case_id', $id)->get();
        $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
        $logoUrl='';
        if(!is_null($image_gallery) && isset($image_gallery->imgUrl)){
            $logoUrl=$image_gallery->imgUrl;
        }
        return view('dentist.print', compact('case_master','dentist', 'DateWiseRecordLst','dentist_pain_in','logoUrl','dentist_bill'));
    }


      public function pdfbill($id){
        $case_master  = Case_master::findOrFail($id);
        $dentist = dentist::where('case_id', $id)->first();
        if (count($dentist) <= 0 ||  $dentist === null || is_null($dentist) || empty($dentist) || !isset($dentist)) {
            $dentist = new dentist();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $dentist_pain_in = $dentist->dentist_pain_in()->get();
        if(count($dentist_pain_in) <= 0 ){
            $dentist_pain_in = new dentist_pain_in();
        }
        $dentist_bill = dentist_bill::where('case_id', $id)->get();
        $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
        $logoUrl='';
        if(!is_null($image_gallery) && isset($image_gallery->imgUrl)){
            $logoUrl=$image_gallery->imgUrl;
        }
       return view('dentist.pri', compact('case_master','dentist', 'DateWiseRecordLst','dentist_pain_in','logoUrl','dentist_bill'));

         $pdf = PDF::loadView('dentist.pri', compact('case_master','dentist', 'DateWiseRecordLst','dentist_pain_in','logoUrl','dentist_bill'));
  
        return $pdf->download('itsolutionstuff.pdf');
    }


  public function downloadpdf(Request $request,$id)
    {


           $case_master  = Case_master::findOrFail($id);
        $dentist = dentist::where('case_id', $id)->first();
        if (count($dentist) <= 0 ||  $dentist === null || is_null($dentist) || empty($dentist) || !isset($dentist)) {
            $dentist = new dentist();
        }
        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        $dentist_pain_in = $dentist->dentist_pain_in()->get();
        if(count($dentist_pain_in) <= 0 ){
            $dentist_pain_in = new dentist_pain_in();
        }
        $dentist_bill = dentist_bill::where('case_id', $id)->get();
        $image_gallery = Image_gallery::where('imgTypeId', 4)->first();
        $logoUrl='';
        if(!is_null($image_gallery) && isset($image_gallery->imgUrl)){
            $logoUrl=$image_gallery->imgUrl;
        }
            


            $data = array(
    'case_master' => $case_master,
    'dentist' => $dentist,
    'DateWiseRecordLst'=>$DateWiseRecordLst,
    'dentist_pain_in'=>$dentist_pain_in,
    'logoUrl'=>$logoUrl,
    'dentist_bill'=>$dentist_bill


);

          //  return  $data['dentist_pain_in'];
view()->share('data',$data);

      
//             // Set extra option
//             PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
//             // pass view file
//             $pdf = PDF::loadView('dentist.pri');
//             // download pdf
//             return $pdf->download('Dentist.pdf');
        
    return view('dentist.pri');


            $pdf = PDF::loadView('dentist.pri');
           return $pdf->download('dentist.pri.pdf');
        


        return view('dentist.pri');

// $pdf = App::make('dompdf.wrapper');

// $pdf = PDF::loadHTML($data);
//  return $pdf->stream('document.pdf');
    }
}