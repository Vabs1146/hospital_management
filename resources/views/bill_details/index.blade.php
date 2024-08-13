@extends('adminlayouts.master')
@section('content')
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                        <div class="header">
                            <h2>Patient Bills page</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12"> 
                                  @if(Session::has('flash_message'))
                                      <div class="alert alert-success">
                                          {{ Session::get('flash_message') }}
                                      </div>
                                  @endif
                                </div>

                              <div class="col-md-12">
                                   <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Patient Number :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByNumber" name="searchByNumber">
                                        </div>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            Patient Name :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByName" name="searchByName">
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Doctor :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByDoctor" name="searchByDoctor">
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="button" onclick="return searchPatient()" class="btn btn-default waves-effect">Search</button></div>
                                  </div>
                              </div>
                           </div>
                        </div>
                    </div>
                    <div class="card">
                        <form>
                         <div class="header bg-pink">
                            <h2>
                                List of Case_masters
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
                                <table class="table  table-bordered table-hover dataTable js-exportable" id="thegrid">
                                  <thead>
                                    <tr>
                                        <th class="never">ID</th>
                                        <th>Patient Number</th>
                                        <th>Patient Name</th>
                                        <th>Ref. Doctor</th>                                        
                                        <th>Patient Mobile</th>
                                        <th>Doctor</th>
										@if($commonHelper->checkUserAccess("1_bill_details",Auth::user()->id, 'view_permission') == '1' || $commonHelper->checkUserAccess("1_bill_details",Auth::user()->id, 'add_permission') == '1' || $commonHelper->checkUserAccess("1_bill_details",Auth::user()->id, 'edit_permission') == '1' || AUTH::user()->role == 1)
                                        <th style="width:100px; text-align:center"></th>
									@endif
									@if($commonHelper->checkUserAccess("1_bill_details",Auth::user()->id, 'print_permission') == '1' || AUTH::user()->role == 1)
                                        <th style="width:50px"></th>
									@endif
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                            </div>  
                          
                        </div>
                        @if($commonHelper->checkUserAccess("2_patientbill/report", Auth::user()->id, 'listing_permission') == 1 || AUTH::user()->role == 1)
                        <div class="panel-footer"><a href="patientbill/report"> Bill Report </a>  <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/></div>
						@endif
                        </div>
                </div>
            </div>


</div>


 @endsection



@section('scripts')
    <script type="text/javascript">
        var theGrid = null;
         $("#theGrid").dataTable().fnDestroy();
        $(document).ready(function(){

            theGrid = $('#thegrid').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "responsive": false,
                "autoWidth": false,
                "order": "",
                "ajax": { "url" : "{{url('case_masters/bill_details_grid')}}", 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token')}},
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": true,
                        "class":"never"
                    },
					@if($commonHelper->checkUserAccess("1_bill_details",Auth::user()->id, 'view_permission') == '1' || $commonHelper->checkUserAccess("1_bill_details",Auth::user()->id, 'add_permission') == '1' || $commonHelper->checkUserAccess("1_bill_details",Auth::user()->id, 'edit_permission') == '1' || AUTH::user()->role == 1)
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/bill_details/') }}/'+row[0]+'/edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Add</a>';
                        },
                        "sortable": false,
                        "targets": 6                    
                    },
					@endif
					
					@if($commonHelper->checkUserAccess("1_bill_details",Auth::user()->id, 'print_permission') == '1' || AUTH::user()->role == 1)
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/bill_details/') }}/'+row[0]+'/print"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Print</a>';
                        },
                        "sortable": false,
                        "targets": 6+1
                    }
					@endif
                ],
                dom: 'Blfrtip',
              buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
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
         
      if($('#searchByNumber').val() != ""){
            theGrid.column(1).search(
                $('#searchByNumber').val()
            ).draw();
         }
         if($('#searchByDoctor').val() != ""){
           theGrid.column(2).search(
                $('#searchByDoctor').val()
            ).draw();
         }         
         if($('#searchByName').val() != ""){
           theGrid.column(3).search(
                $('#searchByName').val()
            ).draw();
         }
         if($('#searchByName').val() == "" && $('#searchByNumber').val() == "" && $('#searchByDoctor').val() == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
            theGrid.ajax.reload();
         }
        return false;
        }



    </script>
@endsection
