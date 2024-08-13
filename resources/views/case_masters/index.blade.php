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
                            <h2>Patient Search Case</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">

                                <div class="col-md-12">
@if($commonHelper->checkUserAccess("1_AddPatient_Details/0",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("1_AddPatient_Details/0",Auth::user()->id, 'add_permission') || AUTH::user()->role == 1)
<a href="{{url('/AddPatient_Details/0')}}" class="btn btn-primary btn-lg" role="button">Add Patient Details</a>
@endif
@if($commonHelper->checkUserAccess("2_patientDetails/patient/report",Auth::user()->id, 'listing_permission') || $commonHelper->checkUserAccess("2_patientDetails/patient/report",Auth::user()->id, 'add_permission') || AUTH::user()->role == 1)
<a href="{{url('/patientDetails/patient/report')}}" class="btn btn-primary btn-lg" role="button">Patient report</a>
@endif
                                </div>


                              <div class="col-md-12">
                                   <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Patient Number :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByNumber" name="searchByNumber">
                                        </div>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            Patient Name :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByName" name="searchByName">
                                        </div>
                                    </div>
                                </div>
<!--
                                 <div class="col-md-2">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Doctor :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByDoctor" name="searchByDoctor">
                                        </div>
                                    </div>
                                </div>
								  -->
								  
                                
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Doctor :
                                        </span>
                                        <div class="form-line">
                                            <select class="form-control select2" id="searchByDoctor">
                                                <option value=""></option>
												@foreach($doctors as $doctors_row) 
                                                <option value="{{ $doctors_row->id }}">{{ $doctors_row->doctor_name }}</option>
												@endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
								 {{-- 
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="form-line">
                                            <select class="form-control select2" id="searchByDay">
                                                <option value="today">Todays Patients</option>
                                                <option value="all">All Patients</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
							--}}
								 <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           From :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control datepicker" placeholder="" id="from_date" name="from_date">
                                        </div>
                                    </div>
                                </div>
								 <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           To :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control datepicker" placeholder="" id="to_date" name="to_date">
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="button" onclick="return searchPatient()" class="btn btn-default btn-lg waves-effect">Search</button></div>
                                  </div>
                              </div>
                           </div>
                        </div>
                    </div>
                    <div class="card">
                         <div class="header bg-pink">
                            <h2>List of Patients</h2>
                         </div>
                        <div class="body">
                           <div class="table-responsive">
                            <table class="table table-hover table-bordered dataTable js-exportable" id="thegrid" data-stripe-classes="[]">
                              <thead>
                                <tr>
                                    <th class="never">ID</th>               
                                    <th>Patient Number</th>                
                                    <th>UHID Number</th>               
                                    <th>Patient Type</th>                   
                                    <th>Visit Time</th>          
                                    <th>Patient Name</th>   
                                    <th>Photo</th>                                        
                                    <th>Doctor</th>
                                    <th>Patient Mobile</th>
                                    <th>Age</th>
									<th>Email</th>
                                    <th>Referred By </th>
                                    <th>Date</th>
@if($commonHelper->checkUserAccess("2_case_masters",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("2_case_masters",Auth::user()->id, 'add_permission') || AUTH::user()->role == 1)
                                    <th></th>
@endif

@if($commonHelper->checkUserAccess("2_ivf-icsi",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("2_ivf-icsi",Auth::user()->id, 'add_permission') || AUTH::user()->role == 1)
                                    <th>IVF</th>
@endif
                                    <th></th>

@if($commonHelper->checkUserAccess("1_AddPatient_Details/0",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("1_AddPatient_Details/0",Auth::user()->id, 'add_permission') || AUTH::user()->role == 1)
                                    <th></th>
@endif

@if($commonHelper->checkUserAccess("2_case_masters",Auth::user()->id, 'delete_permission') ||  AUTH::user()->role == 1)
                                    <th></th>
@endif
                                </tr>
                              </thead>
                                <tbody>
                                </tbody>
                            </table>
                           </div>
<input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>                            
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
            // $(".select2").select2()
            theGrid = $('#thegrid').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "responsive": false,
                "autoWidth": false,
                "ajax": { "url" : "{{url('case_masters/grid')}}", 'type':'POST', data: {_method: 'POST', _tokdssdsen :$("#hdnCsrfToken").data('token'), searchByDay: $("#searchByDay").val()}},
                "order": [[ 0, "desc" ]],
                lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
                "createdRow": function( row, data, dataIndex){
                    //console.log(row);
                    //console.log(data);
                    //console.log(dataIndex);
                    if(data[12] == "1"){
                        $(row).addClass('redClass');
                    }
                },
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                        "class":"never"
                    },
                    {
                        "render": function ( data, type, row ) {
                            return data;
                        },
                        "targets": 1
                    },


@if($commonHelper->checkUserAccess("2_case_masters",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("2_case_masters",Auth::user()->id, 'add_permission') || AUTH::user()->role == 1)
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/PatientMedicalDetails') }}/'+row[0]+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Case History</a>';
                        },
                        "sortable": false,
                        "targets": 13                    
                    },
@endif
                  
@if($commonHelper->checkUserAccess("2_ivf-icsi",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("2_ivf-icsi",Auth::user()->id, 'add_permission') || AUTH::user()->role == 1)
					
					{
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/ivf-form') }}/'+row[0]+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>IVF</a>';
                        },
                        "sortable": false,
                        "targets": 14,
                        "visible": false,                   
                    },
@endif
					
                    {
                        "render": function ( data, type, row ) {
                            //return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                            //return '<a href="{{ url('/ViewMedicalDetails') }}/'+row[0]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-eye" aria-hidden="true"></i></a>';
							return data;
                        },
                        "sortable": false,
                        "targets": 14+1,
                        "visible": false
                    },
@if($commonHelper->checkUserAccess("1_AddPatient_Details/0",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("1_AddPatient_Details/0",Auth::user()->id, 'add_permission') || AUTH::user()->role == 1)
                    {
                        "render": function ( data, type, row ) {
                            //return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                            return '<a href="{{ url('/editPatientDetials') }}/'+row[0]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-edit" aria-hidden="true"></i></a>';

                        },
                        "sortable": false,
                        "targets": 14+2
                    },
@endif

@if($commonHelper->checkUserAccess("2_case_masters",Auth::user()->id, 'delete_permission') ||  AUTH::user()->role == 1)
                    {
                        "render": function ( data, type, row ) {
                            //return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                            return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-times" aria-hidden="true"></i></a>';
                        },
                        "sortable": false,
                        "targets": 14+3
                    },
@endif
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
         /*
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
		 if($('#from_date').val() != ""){
           theGrid.column(9).search(
                $('#from_date').val()
            ).draw();
         }
		         
         if($('#to_date').val() != ""){
           theGrid.column(10).search(
                $('#to_date').val()
            ).draw();
         }
         if($('#searchByName').val() == "" && $('#searchByNumber').val() == "" && $('#searchByDoctor').val() == "" && $('#from_date').val() == "" && $('#to_date').val() == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
            theGrid.column(9).search('');
            theGrid.column(10).search('');
            theGrid.ajax.reload();
         }
        return false;
			*/
		
			theGrid.column(1).search($('#searchByNumber').val());
            theGrid.column(2).search($('#searchByDoctor').val());
            theGrid.column(3).search($('#searchByName').val());
            theGrid.column(9).search($('#from_date').val());
            theGrid.column(10).search($('#to_date').val());
			theGrid.ajax.reload();
        }
    </script>
@endsection
