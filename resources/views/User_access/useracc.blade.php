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
          <form  class="form-horizontal" id="sectionform" action="#"  method="post">
            {{ csrf_field() }}

          <div class="header bg-pink">
          <h2>User Access New</h2>
          </div>
             <div class="body">
                  <div class="row clearfix ">
                            <div class="col-md-12 col=md-offset-3">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="case_number">Select User :</label>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                              <select id="user_id" name="user_id" class="form-control select2"  required="" data-live-search='true'>
                                <option selected value disabled>Select User</option>
                                @foreach($user_list as $userlist)
                                <option value="{{ $userlist->id }}" {{$userlist->id == $user_id  ? 'selected' : ''}}>{{ $userlist->name}}</option>
                                @endforeach
                              
                            </select>
                              </div>
                            </div>

                            </div>  

                            <div class="col-md-12">
                              <div class="body table-responsive">
                             <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="sectiontable" name="sectiontable">
                       <thead>
                        <tr>
                           <th align='center' class="never">Section Id</th>
                            <th align='center'>Section Name</th>
                            <th align='center'><input type="checkbox" id="selectall" name="isActive" class="filled-in" /><label for="selectall"></label></th>
                        </tr>
                         </thead>
                         <tbody>

                             @foreach($sectionlist as $sectionlist)
                             <tr>
                             <td>{{ $sectionlist->sectionid }}
                                <input type="hidden" name="sectionid" id="sectionid" value="{{ $sectionlist->sectionid }}">
                             </td>
                             <td>{{ $sectionlist->sectionname }}
                             <input type="hidden" name="sectionname" id="sectionname" value="{{ $sectionlist->sectionname }}"></td>
                             <td>
                              <div class="demo-checkbox">
                              <input type="checkbox" id="selectrec{{$sectionlist->sectionid}}" name="selectrec[]" class="chk" value="{{ $sectionlist->sectionid }}" <?php if($sectionlist->accesslevel=="1"){echo "checked";}else{echo "unchecked";}?> class="filled-in">
                              <label for="selectrec{{$sectionlist->sectionid}}"></label>
                                  </div>
                             
                        </td>

                             </tr>
                             @endforeach
                         </tbody>

                    </table>
                  </div>
                            </div>  

                </div>
              </div>
              <div class="panel-footer">
                 <button type="button" class="btn btn-lg btn-success" id="btnsbmit">Save </button> 
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
   $(document).ready(function(){
    
            sectiontable = $('#sectiontable').dataTable({
               "ordering": false,
               stateSave: true
              
            });

             

       // Handle click on "Select all" control
    $('#selectall').on('click', function(){
      // Check/uncheck all checkboxes in the table
      // var rows = theGrid.rows({ 'search': 'applied' }).nodes();
      // alert(rows);
      // $('input[type="checkbox"]', rows).prop('checked', this.checked);
       sectiontable.$("input[type='checkbox']").attr('checked', $(this.checked)); 
   });

         
          });
 </script>

<script type="text/javascript">
  $( document ).ready(function() {
 $('#user_id').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var user_id = this.value;
    var url1="{{url('useraccess')}}/"+user_id;
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

           $.ajax({
            url:url1,
            type:'POST',
            data:data,
            success:function(data)
            {
            
            swal({title: "Access Granted", text: "Successfully!!!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
            
          

               
           
        }); 

}


});
});
  
 </script>
<script src="{{ url('/')}}/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>


@endsection