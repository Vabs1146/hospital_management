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
                         <div class="header bg-pink">
                            <h2>List of Patients</h2>
                         </div>
                        <div class="body">
                           <div class="table-responsive">
                            <table class="table table-hover table-bordered dataTable js-exportable" id="thegrid" data-stripe-classes="[]">
                              <thead>
                                <tr>
                                    <th class="never">ID</th>                
                                    <th>Registration Date</th>                     
                                    <th>IPD Number</th>                
                                    <th>UHID Number</th>               
                                    <th>Patient Name</th>
                                    <th></th>
                                    <!-- <th></th>
                                    <th></th>
                                    <th></th> -->
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
                "ajax": { "url" : "{{url('patients/grid')}}", 'type':'POST', data: {_method: 'POST', _tokdssdsen :$("#hdnCsrfToken").data('token'), searchByDay: $("#searchByDay").val()}},
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
                        "render": function (data, type, row ) {
								//let action = '<a href="'+{{ url('/edit-patient') }}+'/'+row[0]+'"><i class="fa fa-pencil-alt" aria-hidden="true"></i>Case History</a>';

								let action = '<a href="{{ url('/edit-patient') }}/'+row[0]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

                             action += '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-times" aria-hidden="true"></i></a>';

							 action += '<a href="{{ url('/patients/consent/') }}/'+row[0]+'" class="btn btn-info ">Consent</a>';

							 action += '<a href="{{ url('/patients/discharge/') }}/'+row[0]+'" class="btn btn-info ">Discharge</a>';



								return action;
                        },
                        "sortable": false,
                        "targets": 5
                    }
						/*
                    {
                        "render": function ( data, type, row ) {
                            return data;
                        },
                        "targets": 1
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/PatientMedicalDetails') }}/'+row[0]+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Case History</a>';
                        },
                        "sortable": false,
                        "targets": 13                    
                    },
                    {
                        "render": function ( data, type, row ) {
                            //return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                            //return '<a href="{{ url('/ViewMedicalDetails') }}/'+row[0]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-eye" aria-hidden="true"></i></a>';
							return data;
                        },
                        "sortable": false,
                        "targets": 13+1
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/editPatientDetials') }}/'+row[0]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-edit" aria-hidden="true"></i></a>';

                        },
                        "sortable": false,
                        "targets": 13+2
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-times" aria-hidden="true"></i></a>';
                        },
                        "sortable": false,
                        "targets": 13+3
                    },
					*/

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
    </script>
@endsection
