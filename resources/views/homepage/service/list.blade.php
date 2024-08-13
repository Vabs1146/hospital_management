@extends('adminlayouts.master')
@section('content')
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="card-body">
                               <div class="user-list">
                                    
                                   <a href="{{ route('add-services')}}" class="btn btn-info btn-lg float-right">Add Service</a>
                               </div>
                           </div>
                           <br>
                    <div class="card">

                        <form>
                         <div class="header bg-pink">
                            <h2>
                               Service List
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
                                                <th>Certificate</th>
                                                <th>Link</th>
                                               
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($service_list as $galleryname)
                                          <tr>
                                          <td><a href="{{ route('showsubimage',$galleryname->main_id)}}">{{ $galleryname->gallery_name}}</a></td>
                                              
                                                   <td>
                                                    <img src="{{ url('/')}}/gallery_image/{{$galleryname->filenames1}}" style="width: 200px;height: 100px;" alt="">
                                                </td>
                                             <td><a href="{{ $galleryname->link }}">link</a></td>  
                                              <td>
                                                  <a href="{{ route('delete-services',$galleryname->main_id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
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

