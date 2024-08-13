@extends('adminlayouts.master')
@section('content')

<div class="container-fluid">
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  @if(Session::has('flash_message'))
      <div class="alert alert-success">
          {{ Session::get('flash_message') }}
      </div>
  @endif
<div class="card">
<div class="header">
<h2>Doctor Surgery report</h2>
</div>

<div class="body">
<div class="row clearfix">
<form class="form-inline" action="{{ url('/doctorbill/SurgeryReport/printReport') }}" method="POST" target="_blank">
    {!! Form::token() !!}


<div class="col-md-12">
<div class="col-md-3">
<div class="input-group">
    <span class="input-group-addon">
        Doctor Name : 
    </span>
    <div class="form-line">
     {{ Form::select('doctorName', array(''=>'Please select') + $doctorlist->toArray(), Request::old('doctorName'), array('class' => 'form-control',  'id'=>'doctorName')) }} 
    </div>
</div>
</div>

<div class="col-md-3">
<div class="input-group">
    <span class="input-group-addon">
       From Date :
    </span>
    <div class="form-line">
     <input type="text" id="fromDate" autocomplete="off" name="fromDate"  class="form-control datepicker" />  
    </div>
</div>
</div>

<div class="col-md-3">
<div class="input-group">
    <span class="input-group-addon">
        To Date : 
    </span>
    <div class="form-line">
      <input type="text" id="ToDate" name="ToDate" autocomplete="off" class="form-control datepicker"/> 
    </div>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<button id="search" onclick="return searchPatient()" class="btn btn-default btn-lg"> Search </button>
<button id="printbill" type="submit" class="btn btn-default btn-lg"> Print </button>
</div>
</div>

</div>
</form>
</div>
</div>
</div>

<div class="card">
<div class="header bg-pink">
    <h2>Bill Data</h2>
</div>

<div class="body">
<div class="table-responsive">
  <table class="table table-striped table-striped table-bordered table-hover" id="thegrid">
     <thead>
           <tr>
               <th class="never">Id</th>
               <th>Patient Name</th>
               <th>Surgeon Name</th>
               <th>Procedure Name</th>
               <th>Surgery Date</th>
               <th>Surgery Time</th>
               <th>Amount</th>
           </tr>
           </thead>
           <tbody>
           </tbody>
  </table>
</div>
<div>
<a href="{{url('doctorbill/')}}" class="btn btn-default btn-lg"> Back </a>
</div>   
</div>
</div>
</div>
</div>
</div>

 @endsection
@section('scripts')
    <script type="text/javascript">
        var theGrid = null;
        $(document).ready(function(){
            theGrid = $('#thegrid').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "responsive": false,
                "autoWidth": false,
                "ajax": "{{url('doctorbill/report/SurgeryReport/grid')}}",
                "order": [[ 0, "desc" ]],
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                        "class":"never"
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/PatientMedicalDetails') }}/'+row[0] + '">'+data+'</a>';
                        },
                        "sortable": false,
                        "targets": 1
                    }
                ],
                dom: 'Blfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });

           
        });
        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url('/case_masters') }}/' + id, type: 'DELETE'}).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }

        function searchPatient(){
         
         if($('#doctorName').val() != ""){
            theGrid.column(1).search(
                $('#doctorName').val()
            );
         }
         if($('#fromDate').val() != ""){
           theGrid.column(2).search(
                $('#fromDate').val()
            );
         }         
         if($('#ToDate').val() != ""){
           theGrid.column(3).search(
                $('#ToDate').val()
            );
         }
         if($('#doctorName').val() == "" && $('#fromDate').val() == "" && $('#ToDate').val() == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
            theGrid.ajax.reload();
         }else{
            theGrid.draw(); 
         }
        return false;
        }



    </script>
@endsection