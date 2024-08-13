<?php

namespace App\Http\Controllers\IPD;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminRootController;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use App\Models\IPD\ipd_treatment_daily_notes;
use App\Models\IPD\patientRegister;
use App\Models\IPD\ipdDischarge;
use App\helperClass\drAppHelper;

use DB;
use Storage;

class dailyTreatmentDetailsController extends AdminRootController
{

    public function Add(Request $request, $patientRegisterId){

        if (Input::get('AddTreatmentItem')) {
            $patientRegister  = patientRegister::firstOrNew(['id'=>$patientRegisterId]);
            $patientRegister->ipdTreatmentDailyNotes()->Create($request->all());
            return redirect()->back()->withInput()->with('flash_message', 'Added successfully');
        }
        if (Input::get('deleteTreatmentNotes')) {
            $ipdTreatmentDailyNotes = ipd_treatment_daily_notes::where('id', $request['deleteTreatmentNotes'])->delete();
            return redirect()->back()->withInput()->with('flash_message', 'Deleted successfully');
        }
    }

    public function deleteNote(Request $request, $NoteId){

    }

}