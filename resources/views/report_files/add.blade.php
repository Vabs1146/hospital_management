@extends('adminlayouts.master')
@section('content')
<div class="container-fluid">
    <div class="list-group list-group-horizontal">
        @forelse ($model['DateWiseRecordLst'] as $VisitListDateWise)
                @if($model['case_master']['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/report_files').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/report_files').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
    </div>
</div>
<div class="container-fluid">
<div class="row clearfix">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		     
                    @include('shared.error') 
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            {{ Session::get('flash_message') }}
                        </div>
                    @endif

          <div class="card">
        
          <div class="header bg-pink">
          <h2>Add/Edit Report File </h2>
          </div>

<form action="{{ url('/report_files'.( isset($model) ? "/" . $model['case_master']['id'] : "")) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

                @if (isset($model))
                    <input type="hidden" name="_method" value="PATCH">
                @endif

              
                <input type="hidden" id="case_id" name="case_id" value="{{ $model['case_master']['id'] or ''}}" >

         
              
              <div class="body">
                  <div class="row clearfix ">
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Case Number :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="case_number" id="case_number" class="form-control" readonly='readonly' value="{{ $model['case_master']['case_number'] or ''}}">                            
                              </div>
                              </div>
                              </div>    


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Patient Name :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="patient_name" id="patient_name" class="form-control"  readonly='readonly' value="{{ $model['case_master']['mr_mrs_ms'] or ''}} {{ $model['case_master']['patient_name'] or ''}} {{ $model['case_master']['middle_name'] or ''}} {{ $model['case_master']['last_name'] or ''}}">                            
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Upload File :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="file" name="uploaded_file" id="uploaded_file" class="form-control" value="{{$model['uploaded_file'] or ''}}">                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Report Title :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="report_title" id="report_title" class="form-control" value="{{$model['report_title'] or ''}}">                           
                              </div>
                              </div>
                              </div>
                          </div>


                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Report Description :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               <input type="text" name="report_description" id="report_description" class="form-control" value="{{$model['report_description'] or ''}}">                             
                              </div>
                              </div>
                              </div>

                             
                          </div>

                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"></label>
                              </div>
                              </div>


                               <div class="col-md-4">
                              <div class="form-group">
                              
                              <button type="submit" name="report_add" value="report_add" class="btn btn-success btn-lg">
                              <i class="fa fa-plus"></i> Add Report
                              </button>  


                              
                              </div>
                              </div>

                              
                          </div>
                           
                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> </label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              
                             @if(null !== old('Report_file',$model['Report_file']) && count(old('Report_file',$model['Report_file']))> 0 )
                    <div class="list-group">
                    @foreach(old('Report_file',$model['Report_file']) as $reportfile)                        
                            <div href="#" class="list-group-item clearfix">
                                <span>
                                    {{ Form::button('Delete', array('class'=> 'btn btn-warning pull-right', 'Value' => $reportfile->id, 'name' => 'report_delete', 'type'=>'submit')) }}
                                </span>


								<span>
                                    {{-- Form::button('View', array('class'=> 'btn btn-warning pull-right', 'Value' => $reportfile->id, 'name' => 'report_view_file', 'type'=>'submit')) --}}
                                </span>

								@php
									$files_arr[] = Storage::disk('local')->url($reportfile->file_path);
								@endphp
                                <div class="d-flex w-100 justify-content-between">
                                    @if(isset($reportfile->file_path) && $reportfile->file_path != null)
                                       <h5 class="mb-1"> <a href="{{ Storage::disk('local')->url($reportfile->file_path) }}" class="" target="_blank"> ..Report document </a> </h5>
                                    @endif
                                </div>
                                <p class="mb-1">
                                   {{$reportfile->report_title}}
                                </p>
                                <p class="mb-1">
                                    {{$reportfile->report_description}}
                                </p>
                            </div>
                    @endforeach
                    </div>
                @endif
                             
                          </div>
                              </div>

             <!-- ========================================================================================================================================================= -->        
			 

			<!--  ==================================================================================================== -->

                              
                          </div>
                         
                        
                                    
                  </div>    

                  <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-2">
                                <div class="form-group">
                                <a class="btn btn-default btn-lg" href="{{ url('/report_files') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                    <a class="btn btn-default btn-lg" href="{{ url('/PatientMedicalDetails').'/'.$model['case_master']['id'] }}"><i class="glyphicon glyphicon-chevron-left"></i> Back To Patient Details</a>


                                      
                                </div>
                                </div>
                               
                            </div>
                </div>
           </form>
            </div>
        </div>
</div>
</div>


        @endsection
  