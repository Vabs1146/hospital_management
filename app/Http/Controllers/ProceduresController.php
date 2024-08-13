<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Procedures;
use Auth;
use DB;
use App\helperClass\CommonHelper;

class ProceduresController extends Controller
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
        $access = $this->commonHelper->checkUserAccess("doctor",Auth::user()->id);
        if($access){
            $pageSize = 15;
            $procedures= Procedures::orderBy('id', 'DESC')->paginate($pageSize);
            return view('procedures.index', compact('procedures'))
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
        $access = $this->commonHelper->checkUserAccess("doctor",Auth::user()->id);
        if($access){
            $procedure = new Procedures();
            return view('procedures.create', compact('procedure'));
        } else {
            return redirect('admin/procedures');
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
        
        $procedure = new Procedures();
        $procedure->name = $request['name'];
        $procedure->userid = Auth::user()->id;
        $procedure->save(); 
         //\LogActivity::addToLog('Record created successfully');
        return redirect()->route('procedures.index')->with('flash_message', 'Record created successfully');
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
        if($access){
            $procedure= Procedures::find($id);
            return view('procedures.edit',compact('procedure'));
        } else {
            return redirect('admin/procedures');
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
        Procedures::find($id)->update($request->all());
        // \LogActivity::addToLog('Record updated successfully');
        return redirect()->route('procedures.index')->with('flash_message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
