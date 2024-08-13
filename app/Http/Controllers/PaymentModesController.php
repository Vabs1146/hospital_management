<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentModes;
use Auth;
use DB;
use App\helperClass\CommonHelper;

class PaymentModesController extends Controller
{
    private $commonHelper;

    public function __construct(){
        $this->acc = 0;
        $this->commonHelper = new CommonHelper();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$access = $this->commonHelper->checkUserAccess("doctor",Auth::user()->id);
        if(1){
            $pageSize = 15;
            $payment_modes= PaymentModes::orderBy('id', 'DESC')->paginate($pageSize);
            return view('payment_modes.index', compact('payment_modes'))
            ->with('i', ($request->input('page', 1) - 1) * $pageSize);
        } else {
            return view('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$access = $this->commonHelper->checkUserAccess("doctor",Auth::user()->id);
        if(1){
            $payment_mode = new PaymentModes();
            return view('payment_modes.create', compact('payment_mode'));
        } else {
            return redirect('admin/payment-modes');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        
        $payment_mode = new PaymentModes();
        $payment_mode->name = $request['name'];
        $payment_mode->created_by = Auth::user()->id;
        $payment_mode->save(); 
         //\LogActivity::addToLog('Record created successfully');
        return redirect()->route('payment-modes.index')->with('flash_message', 'Record created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $access = $this->commonHelper->checkUserAccess("doctor",Auth::user()->id);
        if(1){
            $payment_mode= PaymentModes::find($id);
            return view('payment_modes.edit',compact('payment_mode'));
        } else {
            return redirect('admin/payment-modes');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'name' => 'required'
        ]);
        $request['name'] = $request['name'];
        PaymentModes::find($id)->update($request->all());
        // \LogActivity::addToLog('Record updated successfully');
        return redirect()->route('payment-modes.index')->with('flash_message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$payment_mode = PaymentModes::findOrFail($id);
		$payment_mode= PaymentModes::find($id);

		//dd($payment_mode);
        $payment_mode->delete();
         return redirect()->route('payment-modes.index')->with('flash_message', 'Record deleted successfully');
    }
}
