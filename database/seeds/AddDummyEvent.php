<?php

use Illuminate\Database\Seeder;
use App\Event;

class AddDummyEvent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
        	['title'=>'Demo Event-1', 'start_date'=>'2018-03-11', 'end_date'=>'2018-03-13'],
        	['title'=>'Demo Event-2', 'start_date'=>'2018-03-11', 'end_date'=>'2018-03-13'],
        	['title'=>'Demo Event-3', 'start_date'=>'2018-03-14', 'end_date'=>'2018-03-14'],
        	['title'=>'Demo Event-3', 'start_date'=>'2018-03-17', 'end_date'=>'2018-03-17'],
        ];
        foreach ($data as $key => $value) {
        	Event::create($value);
        }
    }
}
