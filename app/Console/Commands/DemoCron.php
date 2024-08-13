<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as HttpGuzzle;
use Illuminate\Support\Facades\Input;

use Calendar;
use App\appointment;
use App\Case_master;
use App\doctor;
use App\timeslot;
use Event;
use DateTime;
use Auth;
use Response;
use App\Helpers\Helpers;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Message sent';

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
        
        // $client = new HttpGuzzle;
        // $mobileNoStr = '8698293032';
        // $pwd="12345678";
        // $smsStr = 'Your new password is :'.$pwd; 
     
        // $urlGet = str_replace(array('xxxxcommaSeperatedxxxx','xxxxSMSTextxxxx'), array($mobileNoStr, $smsStr), env('SMS_URL'));
    
        // $res = $client->request('GET', $urlGet);

        // $this->info('The message sent successfully!');
        $sql=DB::insert('INSERT INTO `section`(`sectionname`) VALUES ("new")');
        // $this->info('inserted successfully!');
    }
}
