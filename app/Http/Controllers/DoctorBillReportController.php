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


class DoctorBillReportController extends AdminRootController
{

    public function ViewReport(Request $request, $reportName){
        $DocBillContro = new DoctorBillController();
        switch ($reportName) {
            case "BillReport":
                return $DocBillContro->ViewReport($request);
                break;
            case "SurgeryReport":
                return $DocBillContro->ViewSurgeryReport($request);
                break;
            case "OperationReport":
                //return $DocBillContro->ViewReport($request);
                break;
            default:
                //$field_type_id = 1;
                break;
        }
    }

    public function reportGrid(Request $request, $reportName){
        $DocBillContro = new DoctorBillController();
        switch ($reportName) {
            case "BillReport":
                return $DocBillContro->reportGrid($request);
                break;
            case "SurgeryReport":
                return $DocBillContro->SurgeryReportGrid($request);
                break;
            case "OperationReport":
                $field_type_id = 3;
                break;
            default:
                //$field_type_id = 1;
                break;
        }
    }

    public function printReport(Request $request, $reportName){
        $PrintBillReport = new DoctorBillController();
        switch ($reportName) {
            case "BillReport":
                return  $PrintBillReport->printReport($request);
                break;
            case "SurgeryReport":
                return  $PrintBillReport->printSurgeryReport($request);
                break;
            case "dischargeReport":
                $field_type_id = 2;
                break;
            default:
                //$field_type_id = 1;
                break;
        }
    }

}

?>