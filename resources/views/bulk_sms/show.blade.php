@extends('adminlayouts.master')
@section('content')

<div class="container-fluid">
<div class="row clearfix">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
         <form action="{{ url('/bulk_sms') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
          <div class="header bg-pink">
          <h2>View Bulk_sms </h2>
          </div>
          
              <div class="body">
                  <div class="row clearfix ">
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Id :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">                          
                              </div>
                              </div>
                              </div>   


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Group Name :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="group_name" id="group_name" class="form-control" value="{{$model['group_name'] or ''}}" readonly="readonly">                          
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Mobile Numbers :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="mobile_numbers" id="mobile_numbers" class="form-control" value="{{$model['mobile_numbers'] or ''}}" readonly="readonly">                          
                              </div>
                              </div>
                              </div>


                                <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Created At :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="created_at" id="created_at" class="form-control" value="{{$model['created_at'] or ''}}" readonly="readonly">                          
                              </div>
                              </div>
                              </div>

                             
                          </div>

                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Updated At :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="updated_at" id="updated_at" class="form-control" value="{{$model['updated_at'] or ''}}" readonly="readonly">                      
                              </div>
                              </div>
                              </div>
                          </div>
                         </div>    

                  <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-2">
                                <div class="form-group">
                                   <a class="btn btn-default btn-lg" href="{{ url('/bulk_sms') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>


                                      
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
  

  @section('scripts')
    <script type="text/javascript">
        $(':input :textarea', base).keypress(function(e) {
            var code = e.keyCode || e.which;
            if(code == 13)
                return false;
        });
    </script>
@endsection