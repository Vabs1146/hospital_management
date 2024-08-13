@extends('adminlayouts.master')
@section('content')
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="card-body">
                               <div class="user-list">
                                    
                                   <a href="{{ route('add-new-dynamic-text')}}" class="btn btn-info btn-lg float-right">Add</a>
                               </div>
                           </div>
                           <br>
                    <div class="card">

                        <form>
                         <div class="header bg-pink">
                            <h2>
                               Dynamic Text List
                            </h2>
                          
                        </div>
                         <div class="form-group">
                          @include('shared.error')
                          @if(Session::has('flash_message'))
                          <div class="alert alert-success">
                          {{ Session::get('flash_message') }}
                          </div>
                          @endif
                         </div>
                        <div class="body">
                              <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="zero_config" name="sectiontable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Meta Description</th>
                                                <th>Meta Keywords</th>
                                               
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($new_dynamic_text_list as $galleryname)
                                          <tr>
											  <td>{{ $galleryname->name}}</td>
											  <td>{{ $galleryname->textType}}</td>
											  <td>{{ $galleryname->meta_desc}}</td>
											  <td>{{ $galleryname->meta_key}}</td>
                              
                                              <td>
												<a href="{{ route('edit-new-dynamic-text',$galleryname->id)}}" class="btn btn-danger">Edit</a>
                                              </td>
                                          </tr>
                                          @endforeach

                                        </tbody>
                                       
                                    </table>
                                </div> 
                          
                        </div>
                        
                       
                        </div>
                </div>
            </div>


</div>


 @endsection


@section('scripts')
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
 <script type="text/javascript">

  
   $(document).ready(function(){
    
            sectiontable = $('#zero_config').dataTable({
               "ordering": false,
               stateSave: true
              
            });

           
         
          });
 </script>


<script src="{{ url('/')}}/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>


@endsection

