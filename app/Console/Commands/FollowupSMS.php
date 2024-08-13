<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as HttpGuzzle;
use Illuminate\Support\Facades\Log;

class FollowupSMS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FollowupSMS:SendFollowUpSms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends SMS to patients before scheduled Followup date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        //->appendOutputTo($filePath); = 
        $ScheduleDate = Carbon::now()->AddDays(env('followupMsg'));
        $patiens = DB::table('case_master')
        ->select(DB::raw('max(case_master.id) as `ID`, case_number, patient_name, patient_mobile, patient_emailId, FollowUpDate,FollowUpTimeSlot, doctor_id, doctors.doctor_name,timeslots.name  as `time`'))
        ->leftJoin('doctors','doctor_id','=','doctors.id')
        ->leftJoin('timeslots','FollowUpTimeSlot','=','timeslots.id')
        ->where('is_deleted', '0')
        ->whereNotNull('FollowUpDate')
        ->whereDate('FollowUpDate','=',$ScheduleDate->toDateString())
        ->groupBy('case_number');

        $sqlquery = $patiens->toSql();
        Log::info('sql query'. $sqlquery);
        $patiens = $patiens->get();

        $client = new HttpGuzzle;
        foreach($patiens as $patien) {
            //DB::table('case_master')->where('id', $patien->ID)->update(['updated_at'=>Carbon::today()->toDateString()]);
            $smsStr = 'Hi '
                      .(empty($patien->patient_name)?"":$patien->patient_name)
                      .' %0a your appointment is scheduled on :'
                      .(empty($patien->FollowUpDate)?"":$patien->FollowUpDate) 
                      . '  ' 
                      .(empty($patien->time)?"":$patien->time) 
                      .' %0a with '
                      .env('SMS_From_Name')
                      .' ' 
                      .(empty($patien->doctor_name)?"":$patien->doctor_name);
            $urlGet = str_replace(array('xxxxcommaSeperatedxxxx','xxxxSMSTextxxxx'), array($patien->patient_mobile, $smsStr), env('SMS_URL'));
            $res = $client->request('GET', $urlGet);
            Log::info('follow up message Url'. $urlGet);
        }
    }
}
