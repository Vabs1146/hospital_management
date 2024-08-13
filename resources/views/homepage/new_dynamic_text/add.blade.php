@extends('adminlayouts.master')
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
                  <form action="{{ url('save-new-dynamic-text') }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data'>
                    {{ csrf_field() }}
                    
                         <div class="header bg-pink">
                            <h2>
                                 Add/Modify Dynamic Text 
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="row clearfix ">
                            <div class="col-md-12 ">                           
                             <div class="col-md-2 col-md-offset-1">
                              <div class="form-group labelgrp">
                              <label for="name" class="form-control">Name :</label>
                              </div>
                              </div>

                              <div class="col-md-6">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="name" id="name" class="form-control" value="{{ isset($new_dynamic_text->name) ? $new_dynamic_text->name : ''}}">
                              </div>
                              </div>
                              </div>
                            </div>

							
							<div class="col-md-12 ">                           
                             <div class="col-md-2 col-md-offset-1">
                              <div class="form-group labelgrp">
                              <label for="name" class="form-control">Content Type :</label>
                              </div>
                              </div>

                              <div class="col-md-6">
                              <div class="form-group">
                              <div class="form-line">
                              <!-- <input type="text" name="name" id="name" class="form-control" value="{{$model['name'] or ''}}"> -->

<select name="textType" class="form-control">
<option value="footer" {{ isset($new_dynamic_text->textType) && $new_dynamic_text->textType == "footer" ? 'selected' : ''}}>Footer</option>
<option value="section_1" {{ isset($new_dynamic_text->textType) && $new_dynamic_text->textType == "section_1" ? 'selected' : ''}}>Section 1</option>
</select>
                              </div>
                              </div>
                              </div>
                            </div>
                            
                              <div class="col-md-12">
                              <div class="col-md-2 col-md-offset-1">
                              <div class="form-group labelgrp">
                              <label for="html_text" class="form-control">Html Text :</label>
                              </div>
                              </div>

                              <div class="col-md-6">
                              <div class="form-group">
                              <textarea name="html_text" id="html_text" class="form-control" >
							  {!! isset($new_dynamic_text->html_text) ? $new_dynamic_text->html_text : '' !!}
							  </textarea>
                              </div>
                              </div>

                            
                               <div class="col-md-12 ">

                              <div class="col-md-2 col-md-offset-1">
                              <div class="form-group labelgrp">
                              <label for="meta_desc" class="form-control">Meta Description :</label>
                              </div>
                              </div>

                              <div class="col-md-6">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('meta_desc', isset($new_dynamic_text->meta_desc) ? $new_dynamic_text->meta_desc : '', array('class' => 'form-control', 'placeholder'=>'Type Meta Description')) }}
                              </div>
                              </div>
                              </div>
                                
                            </div> 

                            <div class="col-md-12 ">

                              <div class="col-md-2 col-md-offset-1">
                              <div class="form-group labelgrp">
                              <label for="meta_title" class="form-control">Meta Keywords :</label>
                              </div>
                              </div>

                              <div class="col-md-6">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('meta_key', isset($new_dynamic_text->meta_key) ? $new_dynamic_text->meta_key : '', array('class' => 'form-control', 'placeholder'=>'Type Meta Keywords')) }}
                              </div>
                              </div>
                              </div>
                                
                            </div> 

                             <div class="col-md-12 ">                           
                              <div class="col-md-2 col-md-offset-1">
                              <div class="form-group labelgrp">
                              <label for="ed_degree" class="form-control">Is Active :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                                <input type="checkbox" id="remember_me_3" name="isActive"  value="1" {{ $new_dynamic_text->isActive ? 'checked' : ''}} >
                                <label for="remember_me_3"></label>
                               
                              </div>
                              </div>
                            </div>   

                            <div class="col-md-12">                           
                              <div class="col-md-4 col-md-offset-4">
                              <div class="form-group">
                              <button type="submit" class="btn btn-primary btn-lg">
                               <i class="glyphicon glyphicon-plus btnicons"></i> Save
                              </button> 
                              @if($model->textType == 1)
                                  <a class="btn btn-default btn-lg" href="{{ url('/menu_lists') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                              @endif
                              </div>
                              </div>
                              
                            
                            </div>                  
                            <!-- End Of row -->
                            </div>                              
                            </div>
                             <input type="hidden" name="id" id="id" value="{{ isset($new_dynamic_text->id) ? $new_dynamic_text->id : ''}}">
                             <!--  <input type="hidden" name="textType" id="textType" value="{{$model->textType}}"> -->
                              <input type="hidden" name="relationshipKey" id="relationshipKey" value="{{$model->relationshipKey}}">
                          </form>
                        </div>


<iframe id="form_target" name="form_target" style="display:none"></iframe>
<form action="/dynamic_text/imgUpload" method="POST" name="my_form" id="my_form" target="form_target" enctype = "multipart/form-data", style = "width:0;height:0;overflow:hidden">
    {{ csrf_field() }}
    <input name="file" type="file" onchange="$('#my_form').submit();this.value='';">
</form> 
                        
                    </div>
                </div>
            </div>

</div>

@endsection

@section('scripts')
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
