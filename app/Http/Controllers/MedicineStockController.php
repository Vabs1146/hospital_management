<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MedicineStock;
use DB;
use App\helperClass\drAppHelper;
use Carbon\Carbon;


class MedicineStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('MedicineStock.index', []);
    }

    public function grid(Request $request){

        $len = $_POST['length'];
        $start = $_POST['start'];

        $select = " SELECT a.id, a.medicine_name, a.Remaining_Stock_Qty,a.Mfg_date,a.Exp_date,a.Stock_in_date,a.Stock_Out_date,a.created_at,a.updated_at, DATE_FORMAT(a.Mfg_date, \"%d %b %Y\"), a.Cost, a.unit_Received, a.unit_issued";
        $presql = " from medicinestock a   ";
        $presql .= " WHERE 1=1 ";
        if ($_POST['search']['value']) {
            $presql .= " and a.medicine_name LIKE '%".$_POST['search']['value']."%' ";
        }
        if ($_POST['columns']['1']['search']['value']) {
            $presql .= " and a.medicine_name LIKE '%".$_POST['columns']['1']['search']['value']."%' ";
        }
      
       
        if ($_POST['columns']['2']['search']['value']) {
            $fromDate =  $_POST['columns']['2']['search']['value'];
            $presql .= " and  DATE(a.created_at) >= '".$fromDate."' ";
        }
        if ($_POST['columns']['3']['search']['value']) {
            $toDate =  $_POST['columns']['3']['search']['value'];
            $presql .= " and  DATE(a.created_at) <= '".$toDate."' ";
        }
        //$presql .= " group by a.ipd_no ";
       $presql .= "  ";

        $orderByStr = " order by a.updated_at desc";
        //$orderColum = ( isset( $_POST['order'][0]['column'] ) && is_numeric( $_POST['order'][0]['column'] ) ) ? intval( $_POST['order'][0]['column'] )+1 : 1;

        if( isset( $_POST['order']['0']['column'] ) && is_numeric( $_POST['order']['0']['column'] ) ){
            $orderColum = intval( $_POST['order']['0']['column'] )+1;
            $orderByStr = " order by ". $orderColum . " " . $_POST['order']['0']['dir'];
        }

        $sql = $select.$presql.$orderByStr;

        if($start && !empty($start) && !is_null($start) && $len && !empty($len) && !is_null($len)){
            $sql =  $sql." LIMIT ".$start.",".$len;
        }

        //print_r("SELECT COUNT(a.id) c".$presql); return;
        $count = 0;
        $qcount = DB::select("SELECT COUNT(a.id) c".$presql);
        //print_r($qcount);
        if(sizeof($qcount)>0){
            $count = $qcount[0]->c;
        }

        $results = DB::select($sql);
        
        //return array($results, $count, $sql);
        //return ['results'=>$results, 'count'=>$count];
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

  

    public function edit(Request $request, $id)
    {
        $MedicineStock  = MedicineStock::firstOrNew(['id'=>$id]);
       //return $MedicineStock;
       
       // $medicine_name = MedicineStock::pluck('medicine_name','id');
        return view('MedicineStock.add', compact('MedicineStock'));
    }

    public function update(Request $request, $id){

        $form_details = new MedicineStock();
        $form_details = $form_details->updateOrCreate(['id'=>$id], $request->all());
        if($id == 0){
            return redirect('/MedicineStock')->with('flash_message', 'Record added successfully');
        }
        return redirect()->back()->with('flash_message', 'Record updated successfully')->withInput();
        //
    }

     public function delete(Request $request, $id) {    
        $MedicineStock = MedicineStock::findOrFail($id);
        $MedicineStock->delete();
        return "OK";
    }

    public function print($id){
        
        $MedicineStock  = MedicineStock::firstOrNew(['id'=>$id]);
        
        $helperCls = new drAppHelper();
       
        $logoUrl = $helperCls->GetLetterHeadImageUrl();
        return view('MedicineStock.print', compact('MedicineStock', 'logoUrl'));
    }

     public function ViewMedicineStock($id){
        $form_details = MedicineStock::where('id', $id)->first();
        if ($form_details === null) {
            $form_details = new MedicineStock();
        }
        $helperCls = new drAppHelper();
         //$casedata = $this->getCaseData($case_id);
        // $blnc_test = blnc_test::where('case_id', $case_id)->get();
        
        return view('MedicineStock.view', compact('form_details'));
    }

}
