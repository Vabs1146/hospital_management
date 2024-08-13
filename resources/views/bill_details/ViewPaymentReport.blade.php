@extends('adminlayouts.master')
@section('style')
<style>
        @media screen and (max-width: 767px) {
            .select2 {
                width: 100% !important;
            }
        }
         tfoot  {
    text-align: center;
}

</style>
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
 

@endsection
@section('content')
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  @include('shared.error')
                          @if(Session::has('flash_message'))
                          <div class="alert alert-success">
                          {{ Session::get('flash_message') }}
                          </div>
                          @endif
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
                                           Doctor Name :
                                        </span>
                                        <select name="doctor_id" id="doctor_id" class="form-control select2" placeholder="select your doctor">
										<option value="">Select</option> 
                                        @foreach($doctor as $doctor)
                                         <option value="{{$doctor->id}}">{{$doctor->doctor_name}}</option> 
                                        @endforeach
                                    </select>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            From Date :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control datepicker" placeholder="" id="fromDate" name="fromDate">
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-3">
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
							  <div class="col-md-12">
                                   <!-- <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Fees Detail :
                                        </span>
                                        <select name="fees_detail" id="fees_detail" class="form-control select2" placeholder="select fees detail">
                                   										<option value="">Select</option> 
                                        @foreach($fees_details_array as $key => $val)
                                         <option value="{{$key}}">{{$val}}</option> 
                                        @endforeach
                                    </select>
                                    </div>
                                                                     </div> -->
								  <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Payment Mode :
                                        </span>
                                        <select name="payment_mode" id="payment_mode" class="form-control select2" placeholder="select payment mode">
										<option value="">Select</option> 
                                        @foreach($payment_modes_array as $key => $val)
                                         <option value="{{$key}}">{{$val}}</option> 
                                        @endforeach
                                    </select>
                                    </div>
                                  </div>
								  <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           User :
                                        </span>
                                        <select name="user_id" id="user_id" class="form-control select2" placeholder="select user">
										<option value="">Select</option> 
                                        @foreach($all_users_array as $key => $val)
                                         <option value="{{$key}}">{{$val}}</option> 
                                        @endforeach
                                    </select>
                                    </div>
                                  </div>
							  </div>
                           </div>
                        </div>
                    </div>
                    <div class="card">
                        <form>
                         <div class="header bg-pink">
                            <h2>
                                Bill Data
                            </h2>
                          
                        </div>
                        
                        <div class="body">

                              <div class="table-responsive">
                                 <table class="table table-striped table-hover table-bordered" id="thegrid">
                                  <thead>
                                    <tr>
										<th>Payment Date</th>                     
										<th>User Name</th>                   
										<th>Doctor Name</th>
										<th>Patient Name</th>


										<th>Bill Number</th>
										<th>Payment Mode</th>  
										<th>Amount</th>

										<th>Sub Total</th> 									
										
										<th>Balance</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                  </tbody>
                                   <tfoot>
                                    <tr>
										<th>Payment Date</th>                     
										<th>User Name</th>                   
										<th>Doctor Name</th>
										<th>Patient Name</th>


										<th>Bill Number</th>
										<th>Payment Mode</th>  
										<th>Amount</th>

										<th>Sub Total</th> 									
										
										<th>Balance</th>
                                    </tr>
                                    </tfoot>
                              </table>
                             
                            </div>  
                           

                        </div>
                     </form>
                    </div>
                </div>
            </div>


</div>

 @endsection


@section('scripts')
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.20/api/sum().js"></script>
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
    <script type="text/javascript">
        var theGrid = null;
        $(document).ready(function(){
             $('.select2').select2();


var case_amount_total = 0;
	 theGrid = $('#thegrid').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": true,
		"responsive": false,
		"autoWidth": false,
		"ajax": "{{url('patientbill/payment-report/grid')}}/",
        "columnDefs": [
			{
				"targets": 0,
				"visible": true,
				"searchable": false,
				"class":"never"
			},
            //{ "visible": false, "targets": groupColumn }
        ],
        //"order": [[ groupColumn, 'asc' ]],
        "displayLength": 25,
		dom: 'Blfrtip',
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdfHtml5'
		],
        "drawCallback": function ( settings ) {
			//----------------------------------------------------------------------
			var api = this.api();
			$( api.table().footer() ).html("<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th><span style='b'>Sub Total "+
				api.column( 7, {page:'current'} ).data().sum()+"</span></th><th><span style='b'>Balance "+
				api.column( 8, {page:'current'} ).data().sum()+"</span></th>"
			);
        }
    } );

     
           
        });
        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url('/case_masters') }}/' + id, type: 'DELETE'}).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }

        function searchPatient() {
         var doctor_id=$('#doctor_id').val();
         //var fees_detail=$('#fees_detail').val();
         var payment_mode=$('#payment_mode').val();
         var user_id=$('#user_id').val();
		 
         //alert(doctor_id);
         if($('#doctor_id').val() != ""){
           theGrid.column(1).search(
                $('#doctor_id').val()
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

		 
		 if($('#payment_mode').val() != ""){
			 alert($('#payment_mode').val());
           theGrid.column(4).search(
                $('#payment_mode').val()
            ).draw();
         }

		 if($('#user_id').val() != ""){
           theGrid.column(5).search(
                $('#user_id').val()
            ).draw();
         }

         if($('#doctor_id').val() == "" && $('#fromDate').val() == "" && $('#ToDate').val() == "" && $('#payment_mode').val() == "" && $('#user_id').val() == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
            theGrid.column(4).search('');
            theGrid.column(5).search('');
            theGrid.ajax.reload();
         }
        return false;
        }



    </script>
@endsection