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

<h1>Doctor Bills</h1>
<div class="card">
<div class="header bg-pink">
    <h2>List of {{ ucfirst('Docotors') }}</h2>
</div>

<div class="body">
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered" id="thegrid">
  <thead>
         <tr>
             <th class="never">ID</th>
             <th>Doctor Name</th>
             <th>Doctor Fee</th>
             <th></th>
             <th></th>
         </tr>
         </thead>
         <tbody>
         </tbody>
</table>
</div>


<div class="panel-footer">
  <a href="{{url('doctorbill/report/BillReport')}}"> Bill Report </a>&emsp;
  <a href="{{url('doctorbill/report/SurgeryReport')}}"> Surgery Report </a>
</div>

</div>

<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
        <!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Bill details</h4>
  </div>
  <div class="modal-body">
     <iframe id="viewDetailsFrame" frameborder="0" width="100%" ></iframe>
  </div>
  <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<script type="text/javascript">
    function viewDetailsClick(doctorId) {
        $("#viewDetailsFrame").attr("src", "{{url('doctorbill/')}}/" + doctorId + "/ViewBillDetails");
        $("#myModal").modal();
    }

    var theGrid = null;
    $(document).ready(function () {

        theGrid = $('#thegrid').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": true,
            "responsive": false,
            "autoWidth": false,
            "ajax": "{{url('doctorbill/grid')}}",
            "order": [
                [0, "desc"]
            ],
            "columnDefs": [{
                    "targets": 0,
                    "visible": false,
                    "searchable": false,
                    "class": "never"
                },
                {
                    "render": function (data, type, row) {
                        return '<a href="{{ url('/doctorbill/') }}/' + row[0] +
                            '/AddBill" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Add/Edit bill Items</a>';
                    },
                    "sortable": false,
                    "targets": 3
                },
                {
                    "render": function (data, type, row) {
                        return '<a href="#" name="ViewDetails" name="ViewBillDetails" id="ViewBillDetails" onclick="viewDetailsClick(\'' +
                            $.trim(row[0]) +
                            '\')" ><i class="fa fa-eye" aria-hidden="true"></i> View Details </a>';
                    },
                    "sortable": false,
                    "targets": 3 + 1
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
        if (confirm('You really want to delete this record?')) {
            $.ajax({
                url: '{{ url(' / case_masters ') }}/' + id,
                type: 'DELETE'
            }).success(function () {
                theGrid.ajax.reload();
            });
        }
        return false;
    }

    function searchPatient() {

        if ($('#searchByNumber').val() != "") {
            theGrid.column(1).search(
                $('#searchByNumber').val()
            ).draw();
        }
        if ($('#searchByDoctor').val() != "") {
            theGrid.column(2).search(
                $('#searchByDoctor').val()
            ).draw();
        }
        if ($('#searchByName').val() != "") {
            theGrid.column(3).search(
                $('#searchByName').val()
            ).draw();
        }
        if ($('#searchByName').val() == "" && $('#searchByNumber').val() == "" && $('#searchByDoctor').val() == "") {
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
            theGrid.ajax.reload();
        }
        return false;
    }
</script>
@endsection