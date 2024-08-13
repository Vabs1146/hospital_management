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

<link href="{{ asset('css/dataTables.checkboxes.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="container-fluid">
<div class="row clearfix">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
          <form  class="form-horizontal" id="sectionform" action="#"  method="post">
            {{ csrf_field() }}

          <div class="header bg-pink">
          <h2>User Access</h2>
          </div>
             <div class="body">
                  <div class="row clearfix1 ">
                            <div class="col-md-12 col=md-offset-3">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="case_number">Select User :</label>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                            

                             {{ Form::select('user_id',array(''=>'Please select') + $userlst->toArray(), $selectuser, array('class' => 'form-control select2','data-live-search'=>'true','id'=>'user_id')) }}
                              </div>
                            </div>

                            </div>  

                             </div>
                       

<!-------------------------------------------------------------------------------->
 
   
                        <div class="body">
                       
                               <div class="table-responsive">
                              <table class="table table-striped table-bordered" id="thegrid">
                                <thead>
                                  <tr>
                                  
                                    <th class="never">Section ID</th>
                                    <th>Section Name</th>
                                    <th></th>
                                     
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                          

                          
                        </div>

                         <div class="panel-footer">
                        <button type="button" class="btn btn-lg btn-success" id="btnsbmit">Save </button>
                        </div> 
                    </div>

<!----------------------------------------------------------------------------------->

                           
                  

                     </form>
              </div>
            
     
            </div>
        </div>
</div>
</div>


@endsection
@section('scripts')
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
 <script src="{{ asset('js/dataTables1.checkboxes.min.js') }} "></script>
 <script type="text/javascript">
   $(document).ready(function() {
   });
   $(".select2").select2();
 </script>

    <script type="text/javascript">
        var theGrid = null;
        $(document).ready(function(){

           $('#thegrid').DataTable({
         "processing": true,
         "serverSide": true,
         "ordering": true,
                "responsive": false,
                "autoWidth": false,
         ajax: "{{url('/user_right/grid')}}/"+{{$selectuser}},
         'order':[],
         dataType: "json",
         columns: [
            { data: 'sectionid' },
            { data: 'sectionname' },
            {
                data:   "accesslevel",
                
                render: function ( data, type, row ) {
                  //var response=row;
                 
                  var sectionname=row['sectionname'];
                  var sectionid=row['sectionid'];
                  var accesslevel=row['accesslevel'];
                  // alert("sectionname "+sectionname+" sectionid "+sectionid+" accesslevel "+accesslevel);

            
                    if ( type === 'display' ) {
                     //  //alert(row);
                     if(accesslevel==1)
                     {
                      var ch="checked";
                     }
                     else
                     {
                      var ch="unchecked";
                     }

                        return '<input type="hidden" name="sectionid" id="sectionid" value="'+sectionid+'"> <input type="hidden" name="sectionname" id="sectionname" value="'+sectionname+'"><input type="checkbox" id="selectrec'+sectionid+'" name="selectrec[]" class=" chk filled-in" value="'+sectionid+'"  '+ch+' /><label for="selectrec'+sectionid+'"></label>';
                    }
                    return data;
                },
                className: "dt-body-center"
            },
       
         ], 
    //      drawCallback: function () {
    //   var api = this.api();
    //   $( api.table().footer() ).html("<th></th><th></th><th></th><th></th><th></th><th><span style='b'>Total "+
    //     api.column( 5, {page:'current'} ).data().sum()+"</span></th>"
    //   );
    // }
       
      }); 
           
            $('.datepicker').datepicker({
                format: "dd/M/yyyy",
                weekStart: 1,
                clearBtn: true,
                daysOfWeekHighlighted: "0,6",
                autoclose: true,
            });

            $("#sendMessage").on('click', function () {
                var rows_selected = theGrid.column(0).checkboxes.selected();
                var messageBody = $.trim($("#messageBody").val());
                if (rows_selected.length > 0 && messageBody != "") {
                    $("#sendMessage").button('loading');
                    $.ajax({
                        url: '{{ url('/bulk_sms/sendPatientReportSms') }}',
                        type: 'POST',
                        data: {
                            _method: 'POST',
                            _token: $("#hdnCsrfToken").data('token'),
                            'case_master_Id': $.makeArray(rows_selected),
                            'messageBody': messageBody
                        }
                    }).success(function (data) {
                        $("#messageBody").val('')
                        //theGrid.ajax.reload();
                        theGrid.column(0).checkboxes.deselectAll()
                        $("#sendMessage").button('reset');
                        alert('Message send successfully');
                    }).error(function(errmessage){
                        alert(errmessage);
                    });
                }
            });

        });
        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url('/case_masters') }}/' + id, 
               type: 'DELETE',
               data: {_method: 'delete', _token :$("#hdnCsrfToken").data('token')}
               }).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }

        function searchPatient(){
         
         if($('#searchByDoctor').val() != ""){
           theGrid.column(1).search(
                $('#searchByDoctor').val()
            ).draw();
         }
         if($('#fromDate').val() != ""){
            theGrid.column(2).search(
                $('#fromDate').val()
            ).draw();
         }
         if($('#ToDate').val() != ""){
           theGrid.column(3).search(
                $('#ToDate').val()
            ).draw();
         }
         if($('#ToDate').val() == "" && $('#fromDate').val() == "" && $('#searchByDoctor').val() == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
            theGrid.ajax.reload();
         }
        return false;
        }
    </script>
<script type="text/javascript">
  $( document ).ready(function() {
 $('#user_id').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var user_id = this.value;
    var url1="{{url('user_right')}}/"+user_id;
       window.location.replace(url1);

}); 
}); 

</script>

 <script type="text/javascript">
$( document ).ready(function() {
   $("#btnsbmit").click(function(){
 var user_id=$("#user_id").val();
if( !$('#user_id').val() ) { 
  alert("Please Select User First");
}
else
{  


   ckb = $(".chk").is(':checked');
   if(ckb)
   {
    var accesslevel=1;
   //alert(accesslevel);
   }
   else
   {
        var accesslevel=0;
         //alert(accesslevel);
   }
    var data=$("#sectionform").serialize();
    var url1="{{url('savesection')}}/"+accesslevel+"/"+user_id;
    alert(url1);

           $.ajax({
            url:url1,
            type:'POST',
            data:data,
            success:function(response) {
            alert("Access Granted");
            $("#thegrid").DataTable().ajax.reload();
            
           }

               
           
        }); 

}


});
});
  
 </script>



@endsection