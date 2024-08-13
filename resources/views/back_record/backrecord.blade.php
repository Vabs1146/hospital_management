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
                        <form action="{{url('savebackrecord')}}" method="post">
                         <div class="header bg-pink">
                            <h2>
                                Insert Data 
                            </h2>
                          
                        </div>
                        <div class="body">
                         
                            <div class="row clearfix">
                              <div class="col-md-12">
                              <div class="col-md-2">
                                <input type="hidden" name="case_id" value="{{$case_id}}">
                              <div class="form-group labelgrp">
                              <label class="form-control">Text :</label>
                              </div>
                              </div>

                              <div class="col-md-8">
                              <div class="form-group">
                             
                         

                              <textarea name="recorddata"></textarea>                          
                             
                              </div>
                              </div>  

                              </div>
                             

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Select Date :</label>
                              </div>
                              </div>
                             


                              <div class="col-md-8">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="rec_date" id="rec_date" class="form-control datepicker">                             
                              </div>
                              </div>
                              </div>

                              </div>
                             
                              
                            </div>
                             <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary waves-effect"><span>Submit</span>
                                </button>
                                <a class="btn btn-primary waves-effect btn-lg" href="{{ url('/backrecordview/').'/'.$case_id}}
                      ">  View </a>
                                      
                                </div>
                                </div>
                               
                            </div>

                            
                        </div>
                     </form>
                    </div>
                </div>
            </div>


</div>
<iframe id="form_target" name="form_target" style="display:none"></iframe>
<form action="/dynamic_text/imgUpload" method="POST" name="my_form" id="my_form" target="form_target" enctype = "multipart/form-data", style = "width:0;height:0;overflow:hidden">
    {{ csrf_field() }}
    <input name="file" type="file" onchange="$('#my_form').submit();this.value='';">
</form> 
@endsection
@section('scripts')
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function() {
   });
   $(".select2").select2();
 </script>
   <script src="{{ asset('tinymce/tinymce.min.js') }} "></script>
    <script type="text/javascript">
         tinymce.init({
            selector: 'textarea',
            height: 200,
            theme: 'modern',
            plugins: [
              'advlist autolink lists link image charmap print preview hr anchor pagebreak',
              'searchreplace wordcount visualblocks visualchars code fullscreen',
              'insertdatetime media nonbreaking save table contextmenu directionality',
              'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc code'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample | code',
            image_advtab: true,
            templates: [
              { title: 'Test template 1', content: 'Test 1' },
              { title: 'Test template 2', content: 'Test 2' }
            ],
            file_browser_callback: function (field_name, url, type, win) {
                if (type == 'image') $('#my_form input').click();
            }
        });
    </script>
@endsection   

  