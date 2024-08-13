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
                    <div class="card">
                        
                         <div class="header bg-pink">
                            <h2>
                                Doctor
                            </h2>
                          
                        </div>
                      
                             <div class="body">
                             
                             <table id='empTable' class="table table-bordered">
                              <thead>
                                <tr>
                                  <td>S.no</td>
                                  <td>Username</td>
                                  <td>Name</td>
                                  <td>Email</td>
                                </tr>
                              </thead>
                            </table>
                                                      
                       
                            

                            
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
   <script type="text/javascript">
    $(document).ready(function(){

      // DataTable
      $('#empTable').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{route('employees.getEmployees')}}",
         columns: [
            { data: 'id' ,orderable: false, "sortable": false},
            { data: 'username' },
            { data: 'name' },
            { data: 'email' },
         ]
      });

    });
    </script>
@endsection  
  