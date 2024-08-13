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

<!-- ================================================================================== -->
{{--
<div class="card">
	<div class="body">
		<div class="row clearfix">

		  <div class="col-md-12">
			  <div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">
						Patient Name :
					</span>
					<div class="form-line">
						<input type="text" class="form-control" placeholder="" id="searchByName" name="searchByName">
					</div>
				</div>
			</div>

			 <div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">
					   Doctor :
					</span>
					<div class="form-line">
						<select name="searchByDoctor" id="searchByDoctor" class="form-control select2" placeholder="select your doctor">
							<option value="">Select</option> 
							@foreach($all_docotrs as $all_doctor_key => $all_doctor)
								<option value="{{$all_doctor_key}}" >{{$all_doctor}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>

			  <div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">
						Ipd Number :
					</span>
					<div class="form-line">
						<input type="text" class="form-control" placeholder="" id="searchIpdNumber" name="searchIpdNumber">
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">
						From Date :
					</span>
					<div class="form-line">
						<input type="text" class="form-control datepicker" placeholder="" id="fromDate" name="fromDate">
					</div>
				</div>
			</div>

			 <div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">
					   To Date :
					</span>
					<div class="form-line">
						<input type="text" class="form-control datepicker" placeholder="" id="ToDate" name="ToDate">
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
--}}
<!-- ================================================================================== -->
                              
                   
                    <div class="card">
                         <div class="header bg-pink">
                            <h2>Uploaded Documents Listing</h2>
                         </div>
                        <div class="body">
                           <div class="table-responsive">
                            <table class="table table-hover table-bordered dataTable js-exportable" id="thegrid" data-stripe-classes="[]">
                              <thead>
                                <tr>
								 
								<th class="never">ID</th>   
								<th>Patient Name</th>   
								<th>IPD No.</th>   
								<th>Upload Documents</th>  
								<th>Upload Daily Report</th>  
								<th>Upload Report</th>  



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
                        "render": function (data, type, row ) {
							//let action = '<a href="{{ url('/upload-document') }}/'+row[0]+'" class="btn btn-default ">Manage Documents</a>';
							let action = '<a href="{{ url('/ipd-upload-document') }}/'+row[0]+'" class="btn btn-default ">Manage Documents</a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 3
                    },
                    {
                        "render": function (data, type, row ) {
							//let action = '<a href="{{ url('/upload-reports') }}/'+row[0]+'" class="btn btn-default ">Manage Documents</a>';
							let action = '<a href="{{ url('/ipd-upload-reports') }}/'+row[0]+'" class="btn btn-default ">Manage Documents</a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 4
                    },
                    {
                        "render": function (data, type, row ) {
							//let action = '<a href="{{ url('/upload-report-documents') }}/'+row[0]+'" class="btn btn-default ">Manage Documents</a>';
							let action = '<a href="{{ url('/ipd-upload-report-documents') }}/'+row[0]+'" class="btn btn-default ">Manage Documents</a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 5
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

		function searchPatient() {
         var searchByName=$('#searchByName').val();
         var searchByDoctor=$('#searchByDoctor').val();
         var searchIpdNumber=$('#searchIpdNumber').val();
         var fromDate=$('#fromDate').val();
         var ToDate=$('#ToDate').val();
		 
		
        
         if(searchByName != ""){		 
           //theGrid.column(1).search(searchByName).draw();

		   theGrid.column(1).search(searchByName);
         }

         if(searchByDoctor != ""){
           //theGrid.column(2).search(searchByDoctor).draw();
		   theGrid.column(2).search(searchByDoctor);
         }         
         if(searchIpdNumber != ""){
           //theGrid.column(3).search(searchIpdNumber).draw();

		   theGrid.column(3).search(searchIpdNumber);
         }

		 if(fromDate != ""){
           //theGrid.column(4).search(fromDate).draw();
		   theGrid.column(4).search(fromDate);
         }

		 if(ToDate != ""){
           //theGrid.column(5).search(ToDate).draw();
		   theGrid.column(5).search(ToDate);
         }

         if(searchByName == "" && searchByDoctor == "" && searchIpdNumber == "" && fromDate == "" && $('#payment_mode').val() == "" && ToDate == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
			theGrid.column(4).search('');
            theGrid.column(5).search('');
            //theGrid.ajax.reload();
         }

		 theGrid.ajax.reload();
        return false;
        }

		 function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url("/patients/delete") }}', 
               type: 'POST',
               data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token'), 'id' : id}
               }).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }
    </script>
@endsection
