@extends('adminlayouts.master')
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
           <form action="{{ url('/member_sms'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            @if (isset($model))
                <input type="hidden" name="_method" value="PATCH">
            @endif


          <div class="header bg-pink">
          <h2>Send Member SMS </h2>
          </div>
                           <div class="body">
                  <div class="row clearfix ">

                    
                            <div class="col-md-12">
                              
                            <input type="hidden" name="id" id="id" class="form-control" value="{{ $model['id'] or ''}}" readonly="readonly">
                             

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control control-label">User Role :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              {{ Form::select('staff_type_id',array(''=>'Please select') + $staff_type_lst->toArray(),
                              Request::old('staff_type_id', $model['staff_type_id']), array('class' => 'form-control select2','required','data-live-search'=>'true')) }}
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control control-label">User :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              {{ Form::select('user_id',array(''=>'Please select'),
                    Request::old('user_id', $model['user_id']), array('class' => 'form-control select2','required','data-live-search'=>'true'
)) }}
                              </div>

                          </div>

                          <div class="col-md-12">
                              
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control control-label">SMS Text :</label>
                              </div>
                              </div>
                              
                              <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="sms_text" id="sms_text" value="" required></textarea>
                                        </div>
                                    </div>
                                </div>
                              

                             
                          </div>


                                    
                  </div>    

                  <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-2">
                                <div class="form-group">
                                <button type="submit" class="btn btn-success btn-lg">
                                <i class="fa fa-plus"></i> Send Message
                                </button>
                                
                                    
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
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function() {
   });
   $(".select2").select2();
 </script>

    <script type="text/javascript">
     $(document).ready(function(){
        $('#staff_type_id').on('change', function(e){
            if($('#staff_type_id').val() != ''){
                $.get('/get_user_by_type/' + $('#staff_type_id').val(), function(data){
                    //success data
                    $('#user_id').empty();
                    $('#user_id').append('<option> Please select </option>');
                    $.each(data, function(index, subcatObj){
                        $('#user_id').append('<option value="' + subcatObj.id +'" >'
                        + subcatObj.name + '</option>');
                    });
                });
            }
        });

     })
    </script>
@endsection