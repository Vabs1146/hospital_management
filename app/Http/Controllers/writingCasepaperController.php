<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as HttpGuzzle;
use Illuminate\Support\Facades\Log;

use App\Models\writing_casepaper;
use App\helperClass\drAppHelper;
use Auth;
use App\Helpers\Helpers;
use App\helperClass\CommonHelper;

class writingCasepaperController extends AdminRootController
{

     public function __construct()
    {
         $this->acc=0;
          $this->commonHelper = new CommonHelper();
    }


    public function index(Request $request)
    {
        return view('writtingPad.index', []);
    }
    
    public function AddEditDetails($case_id){

 $user = Auth::user()->id;

        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='writingCasePaper/edit'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("writingCasePaper/edit",Auth::user()->id);
        if ($this->acc == 1) {
              $form_details = writing_casepaper::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new writing_casepaper();
        }
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        return view('writtingPad.addEdit', compact('casedata','form_details'));
        }

          else
        {
            
         $url= url()->previous();
           return redirect($url);
        }
      
    }

    public function SaveDetails(Request $request, $writingCase_id)
    {
        $form_details = new writing_casepaper();
        $form_details = $form_details->updateOrCreate(['id'=>$writingCase_id], $request->all());
        return redirect()->back()->with('flash_message', 'Record added/updated successfully');
    }

    public function print(Request $request, $case_id){

         $user = Auth::user()->id;

        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='writingCasePaper/print'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
        $this->acc = $this->commonHelper->checkUserAccess("writingCasePaper/print",Auth::user()->id);
        if ($this->acc == 1) {
               $form_details = writing_casepaper::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new writing_casepaper();
        }
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('writtingPad.print', compact('casedata','form_details', 'logoUrl'));
        }

           else
        {
            
         $url= url()->previous();
           return redirect($url);
        }
     
    }
    public function view(Request $request, $case_id){
           $user = Auth::user()->id;

        $accesslevel=DB::select("SELECT useraccess.accesslevel FROM `useraccess` INNER JOIN section ON useraccess.sectionid=section.sectionid JOIN users ON useraccess.userid=users.id WHERE users.id='$user' AND section.sectionname='writingCasePaper/view'");

            foreach ($accesslevel as $value) {
            $acc=$value->accesslevel;
            }
            
         $this->acc = $this->commonHelper->checkUserAccess("writingCasePaper/view",Auth::user()->id);
        if ($this->acc == 1) {
              $form_details = writing_casepaper::where('case_id', $case_id)->first();
        if ($form_details === null) {
            $form_details = new writing_casepaper();
        }
        $helperCls = new drAppHelper();
        $casedata = $helperCls->getCaseData($case_id);
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('writtingPad.view', compact('casedata','form_details', 'logoUrl'));
        }
          else
        {
            
         $url= url()->previous();
           return redirect($url);
        }

      
    }

}