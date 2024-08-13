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
                  <form action="{{ url('/manage-section-slider-footer'.( isset($model['id']) ? "/" . $model['id'] : "")) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data'>
                     {{ csrf_field() }}
                      @if (isset($model['id']))
                          <input type="hidden" name="_method" value="PATCH">
                      @endif

                         <div class="header bg-pink">
                            <h2>
                                Add/Modify Slider Footer
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="row clearfix ">
                            <div class="col-md-12 ">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="uploadeImage" class="form-control">Image :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="file" name="uploadeImage" id="uploadeImage" class="form-control" > 
                               </div>                             
                              </div>
                              </div>

                              <!-- <div class="col-md-2">
                              								  <div class="form-group labelgrp">
                              								  <label for="displayed_in" class="form-control">Add In :</label>
                              								  </div>
                              </div>
                              
                              <div class="col-md-4">
                              								  <div class="form-group">
                              		  {{ Form::select('displayed_in',   array('homeSlider'=>'Home Page Slider', 'galleryPage'=>'Gallery Page'), Request::old('displayed_in', $model['displayed_in']), array('class' => 'form-control select2','data-live-search'=>'true')) }}
                              								  </div>
                              </div> -->
                              </div>


                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="name" class="form-control">Title :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="title" id="title" class="form-control" value="{{$model['title'] or ''}}">
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="description" class="form-control">Description :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="description" id="description" class="form-control" value="{{$model['description'] or ''}}">
                              </div>
                              </div>
                              </div>
                            </div>

                            <div class="col-md-12">

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="description" class="form-control">Read More Link :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="read_more_link" id="read_more_link" class="form-control" value="{{$model['read_more_link'] or ''}}">
                              </div>
                              </div>
                              </div>

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="ed_degree" class="form-control">Is Active :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                               

                          {{ Form::checkbox('is_active', 1, $model['is_active'],array('id'=>'remember_me_3')) }}
                                <label for="remember_me_3"></label>
                               
                              </div>
                              </div>    
                            </div>  

                            <div class="col-md-12">                           
                              <div class="col-md-4 col-md-offset-4">
                              <div class="form-group">
                              <button type="submit" class="btn btn-success btn-lg">
                              <i class="fa fa-plus"></i> Save
                              </button> 
                              <a class="btn btn-default btn-lg" href="{{ url('/image_galleries') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                              </div>
                              </div>
                              
                            
                            </div>                  
                            <!-- End Of row -->
                            </div>                              
                            </div>
                             <input type="hidden" name="id" id="id" value="{{$model['id'] or ''}}">
                             <input type="hidden" name="type" id="type" value="section_slider_footer">
                          </form>
                        </div>
                        
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
@endsection  