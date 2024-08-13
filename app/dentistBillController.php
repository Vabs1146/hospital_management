<?php

namespace App\Http\Controllers;

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

use App\Models\dentist_bill;
use App\Models\paymentfor;
use App\Case_master;
use App\helperClass\drAppHelper;

use DB;
use Storage;

class dentistBillController extends AdminRootController
{

    public function index(Request $request)
    {
        return view('dentist_bill.index', []);
    }

    public function edit(Request $request, $id)
    {
        $case_master  = Case_master::findOrFail($id);
        $dentist_bill = dentist_bill::where('case_id', $case_master->id)->get();
    
           $pay_bill=  DB::table('paymentfor')
            ->join('dentist_bill', 'paymentfor.dentist_bill_id', '=', 'dentist_bill.id')
            ->select('paymentfor.id', 'paymentfor.case_id', 'dentist_bill.treatmentDone','paymentfor.date','paymentfor.amountPaid','paymentfor.dentist_bill_id')
            ->get();

         
    
        $treatment=DB::select("SELECT * FROM `dentist_bill`");

        $DateWiseRecordLst = Case_master::where('case_number', $case_master->case_number)->where('is_deleted', '0')->orderBy('created_at', 'asc')->select('id', 'created_at')->get();
        return view('dentist_bill.add', compact('case_master','dentist_bill','pay_bill','treatment', 'DateWiseRecordLst'));
    }

    public function update(Request $request){
		$case_gen = Case_master::where('case_number', $request['case_number'])->where('id', $request['case_id'])->first();
        if(is_null($case_gen)){
            return redirect()->back()->withInput()->withErrors(array('message' => 'No patient found.'));
        }
		//check which submit was clicked on
        if (Input::get('Item_Add')) {
            $form_details = new dentist_bill();
            $form_details->fill($request->all());
            $form_details->balance=$request->amountPaid;
            $form_details->save();
        }

        if (Input::get('delete_item')) {
            $billdetail = dentist_bill::findOrFail($request['delete_item']);
            $paymentdetail = paymentfor::where('dentist_bill_id', $request['delete_item']);
            if ($billdetail === null) {
                return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
            }

         $billdetail->delete();
         $paymentdetail->delete();
        }
        if (Input::get('deleteAll')) {
            dentist_bill::where('case_id', $request['case_id'])->delete();
            return redirect('/PatientMedicalDetails'.'/'.$request['case_id'])->withErrors(array('message' => 'Bill deleted successfuly.'));
        }
        

        return redirect()->back()->with('flash_message', 'Record added/updated successfully');
    }

     public function printpaymenmt($case_id,$id1)
    {
        //$image_gallery = Image_gallery::where('imgTypeId', 4)->first();
         $case_master  = Case_master::findOrFail($case_id);

        $dentist_bill = paymentfor::where('id', $id1)->get();
         $pay_bill=  DB::table('paymentfor')
            ->join('dentist_bill', 'paymentfor.dentist_bill_id', '=', 'dentist_bill.id')
            ->select('paymentfor.id', 'paymentfor.case_id', 'dentist_bill.treatmentDone','paymentfor.date','paymentfor.amountPaid','paymentfor.dentist_bill_id')->where('paymentfor.id',$id1)
            ->get();
        // $pay_bill;
       // return  $pay_bill;
        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('payment.print_payment', compact('case_master','paymentfor', 'logoUrl','pay_bill'));
     
    }

    public function updatepaymentadd(Request $request){

 $treatmentDone= $request->treatmentDone;
 $amountPaid= $request->amountPaid;

              $balance = dentist_bill::where('id', $treatmentDone)->get();


  $rem=$balance[0]->balance;
 $blnc= ((int)$balance[0]->balance -(int)$request->amountPaid);
        //return intval($amountPaid);
    $updateblnc=DB::update("UPDATE dentist_bill SET balance='$blnc' WHERE id='$treatmentDone'");


        $case_gen = Case_master::where('case_number', $request['case_number'])->where('id', $request['case_id'])->first();
        if(is_null($case_gen)){
            return redirect()->back()->withInput()->withErrors(array('message' => 'No patient found.'));
        }
        //check which submit was clicked on
        if (Input::get('Item_Add')) {
            $form_details = new paymentfor();
            $form_details->dentist_bill_id=$request->treatmentDone;
            $form_details->fill($request->all());
            $form_details->save();
        }

        if (Input::get('delete_item')) {
            $billdetail = paymentfor::findOrFail($request['delete_item']);
            if ($billdetail === null) {
                return redirect()->back()->withInput()->withErrors(array('message' => 'No report file found.'));
            }
      

           $billdetail->delete();
          $treatmentid= $request->treatmentname;
      $amt= $request->amountdelt;
$balance = dentist_bill::where('id', $treatmentid)->get();

  $blnc1= ((int)$balance[0]->balance +(int)$request->amountdelt);

           $updateblnc=DB::update("UPDATE dentist_bill SET balance='$blnc1' WHERE id='$treatmentDone'");



        }
        if (Input::get('deleteAll')) {
            paymentfor::where('case_id', $request['case_id'])->delete();
            return redirect('/PatientMedicalDetails'.'/'.$request['case_id'])->withErrors(array('message' => 'Bill deleted successfuly.'));
        }
        

        return redirect()->back()->with('flash_message', 'Record added/updated successfully');
    }




    public function printbill($case_id){

        $case_master  = Case_master::findOrFail($case_id);
        $dentist_bill = dentist_bill::where('case_id', $case_id)->get();
        $paymentfor = paymentfor::where('case_id', $case_id)->get();
        
         $paymentfor=  DB::table('paymentfor')
            ->join('dentist_bill', 'paymentfor.dentist_bill_id', '=', 'dentist_bill.id')
            ->select('paymentfor.id', 'paymentfor.case_id', 'dentist_bill.treatmentDone','paymentfor.date','paymentfor.amountPaid','paymentfor.dentist_bill_id')
            ->get();

        $helperCls = new drAppHelper();
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('dentist_bill.print', compact('case_master','dentist_bill','paymentfor', 'logoUrl'));
    }

}