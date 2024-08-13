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
  <div class="list-group list-group-horizontal">
        @foreach($recorddate as $key => $recordlist)
     
         <a href="#" onclick='show_more_menu({{$recordlist->id}});' class="list-group-item">{{ $recordlist->rec_date }}</a> <span> &nbsp;</span>         
        @endforeach
    </div>
</div>
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   
                    <div class="card">
                       
                         <div class="header bg-pink">
                            <h2>
                                Display  Data
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                              <div class="col-md-12">
                                 <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingOne_1">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="true" aria-controls="collapseOne_1">
                                                        RECORD 
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
                                                <div class="panel-body" id="recordbyid">
                                                  Click the above date to see Record by Datewise!! 
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                               

                              </div>

                              
                             
                              
                            </div>
                             <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                
                                <a class="btn btn-primary waves-effect btn-lg" href="{{ url('/backrecord/').'/'.$case_id }}"> <i class="glyphicon glyphicon-chevron-left"></i> Back </a>
                                      
                                    </div>
                                </div>
                               
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
   $(document).ready(function() {
   });
   $(".select2").select2();
   function show_more_menu(id)
   {
    $.ajax({
            url:'{{ url("getRecordbyID") }}/'+id,
            method:'get',
            success:function(data)
            {
             // alert(data['getRecordbyID']);
             $("#recordbyid").html(data['recorddata']);
            }
        })
   }
 </script>
@endsection   

  