

@php //echo "========= <pre>"; print_r($sp_test_image); exit;@endphp
@section('style')
<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }

    .canvas{
        position:relative; width:150px; height:200px; background-color:#7a7a7a; margin:70px auto 20px auto;
    }

</style>

<style>

    input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}


    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }

    .canvas{
        position:relative; width:150px; height:200px; background-color:#7a7a7a; margin:70px auto 20px auto;
    }
    #button {
  display: inline-block;
  background-color: #FF9800;
  text-decoration: none;
  width: 36px;
  height: 37px;
  text-align: center;
  border-radius: 4px;
  position: fixed;
  bottom: 52px;
  right: 33px;
  transition: background-color .3s, 
    opacity .5s, visibility .5s;
  opacity: 0;
  color: white;
  visibility: hidden;
  z-index: 1000;
}
#button::after {
 
  font-family: 'Material Icons';
  font-weight: bolder;
  font-style: normal;
  font-size: 1em;
  line-height: 40px;
  color: white;
}
#button:hover {
  cursor: pointer;
  background-color: #333;
}
#button:active {
  background-color: #555;
}
#button.show {
  opacity: 1;
  visibility: visible;
}
.details-section {
    color: initial;
    /* background-color: white; */
    text-align: center;
    margin-bottom: 7px;
    padding-top: 4px;
    padding-bottom: 1px;
    margin-top: -2px;
}

</style>

<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')

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
                </div>
           </form>
		   
                    </div>
                </div>
            </div>


</div>


