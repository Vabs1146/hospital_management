<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;

class GenralpformMail extends Mailable
{
    use Queueable, SerializesModels;
    public $id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;

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
             ->where('id','=', $this->id)
             ->first();
        $pd=$pdfnames->pdfname;
         return $this->view('case_masters.myDemoMail')
                    ->attach(public_path('gppdf/'.$pd), [
                         'as' => 'gpform.pdf',
                         'mime' => 'application/pdf',
                    ]);
    }
}
