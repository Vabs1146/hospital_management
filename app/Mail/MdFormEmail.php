<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;
class MdFormEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $case_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($case_id)
    {
        
        $this->case_id = $case_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdfnames = DB::table('case_master')
             ->select('pdfname')
             ->where('id','=', $this->case_id)
             ->first();
        $pd=$pdfnames->pdfname;
         return $this->view('patientDetails.mdDemoMail')->attach(public_path('mdpdf/'.$pd), [
                         'as' => 'mdform.pdf',
                         'mime' => 'application/pdf',
                    ]);
    }
}
