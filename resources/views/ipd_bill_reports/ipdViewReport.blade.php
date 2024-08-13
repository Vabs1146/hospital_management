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
.dataTables_wrapper .dt-buttons a.dt-button { background-color: #2b982b !important;line-height: 2.5; }
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
                        <div class="card col-md-10" style="float:none;margin:auto;">
                        <div class="header">
                            <center><h2><b>IPD BILL REPORT </b></h2></center>
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
                                   <div class="col-md-6">
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
                                 <div class="col-md-6">
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
                              <div class="col-md-12">
                                <div class="col-md-6">
                                  <div class="input-group">
                                      <span class="input-group-addon">
                                          From Date :
                                      </span>
                                      <div class="form-line">
                                          <input type="text" class="form-control datepicker" placeholder="" id="fromDate" name="fromDate">
                                      </div>
                                  </div>
                              </div>

                               <div class="col-md-6">
                                  <div class="input-group">
                                      <span class="input-group-addon">
                                         To Date :
                                      </span>
                                      <div class="form-line">
                                          <input type="text" class="form-control datepicker" placeholder="" id="ToDate" name="ToDate">
                                      </div>
                                  </div>
                              </div>                  
                          </div>
						  {{--
                          <div class="col-md-12">
                               <div class="col-md-6">
                                  <div class="input-group">
                                      <span class="input-group-addon">
                                         Surgery/Procedure
                                      </span>
                                      <div class="">
                                          {{ Form::select('Surgery[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgery_history')->pluck('ddText','ddText')->toArray(), array_key_exists('surgery_history', $defaultValues)?$defaultValues['surgery_history']:null, array('class'=> 'form-control surgery select2','data-live-search'=>'true')) }}
                                      </div>
                                  </div>
                              </div>  
                               <div class="col-md-6">
                                     <div class="form-group">
                                                  <button type="button" onclick="return searchPatient()" class="btn btn-success waves-effect">Search</button></div>
                              </div>                                        
                          </div>
						  --}}

							  {{--<div class="col-md-12">
                                   <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Fees Detail :
                                        </span>
                                        <select name="fees_detail" id="fees_detail" class="form-control select2" placeholder="select fees detail">
										<option value="">Select</option> 
                                        @foreach($fees_details_array as $key => $val)
                                         <option value="{{$val}}">{{$val}}</option> 
                                        @endforeach
                                    </select>
                                    </div>
                                  </div>
								  <div class="col-md-4" style="display:none;">
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

							  </div> --}}
                           </div>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 20px;">
                        <form>
                         <div class="header" style="background-color:#2b982b">
                            <h2 style="color:#fff !important;"> 
                                IPD Bill Report Details
                            </h2>
                          
                        </div>
                        
                        <div class="body">

                          <div class="table-responsive">
                             <table class="table table-striped table-hover table-bordered" id="thegrid">
                              <thead>
                                <tr>
								<!--
									<th>Sr No.</th>                    
									<th>User Name</th>                   
									<th>Doctor Name</th>
									<th>Patient Name</th>
									<th>Surgery/Procedure</th>
									<th>Bill Number</th>
									<th>Detail</th>
									<th>Amount</th>
									<th>Sub Total</th> 
									<th>Discount</th> 
									<th>Total</th>
									<th>Advance</th>  
									<th>Balance</th>
									-->
									
									<th>Date</th>                    
									<th>Case No.</th>                   
									<th>IPD No.</th>
									<th>Patient Name</th>                
									<th>Doctor Name</th>
									<th>User</th>
									<th>Bill Number</th>
									<th>Total Amount</th>
									<th>Advance Amount</th> 
									<th>Advance Amount Payment Mode / Date</th> 
									<th>Discount</th>
									<th>Total Payment</th>  
									<th>Paid</th>
									
									<th>Payment Mode</th>
									<th>Balance</th>
                                </tr>
                              </thead>
                              <tbody>

                              </tbody>
                               <tfoot>
							   <!--
                                <tr>
                                  <th>Date</th>                    
									<th>Case No.</th>                   
									<th>IPD No.</th>
									<th>Patient Name</th>                
									<th>Doctor Name</th>
									<th>User</th>
									<th>Bill Number</th>
									<th>Total Amount</th>
									<th>Advance Amount</th> 
									<th>Advance Amount Payment Mode / Date</th> 
									<th>Discount</th>
									<th>Total Payment</th>  
									<th>Paid</th>
									
									<th>Payment Mode</th>
									<th>Balance</th>

                                </tr> 
								-->
								<tr>
									<th></th>                    
									<th></th>                   
									<th></th>
									<th></th>                
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th> 
									<th></th> 
									<th></th>
									<th></th>  
									<th></th>
									
									<th></th>
									<th></th>

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
    $(document).ready(function() {
    	$('.select2').select2();
    	var case_amount_total = 0;
    	 theGrid = $('#thegrid').DataTable({
    		"processing": true,
    		"serverSide": true,
    		"ordering": true,
    		"responsive": false,
    		"autoWidth": false,
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    		"ajax": "{{url('ipdbill-report-grid')}}/",
    		"columnDefs": [
    			{
    				"targets": 0,
    				"visible": true,
    				"searchable": false,
    				"class":"never"
    			},
    		],
    		"displayLength": 25,
    		dom: 'Blfrtip',
    		buttons: [
    			
				{
					extend: 'copyHtml5',
					footer: true
				},
				{
					extend: 'excelHtml5',
					footer: true
				},
				{
					extend: 'csvHtml5',
					footer: true
				},
				{
					extend: 'pdfHtml5',
					footer: true
				},
    		],
			/*
    		"drawCallback": function ( settings ) {
    			
    			//----------------------------------------------------------------------
    			var api = this.api();
    			$( api.table().footer() ).html("<th></th><th></th><th></th><th></th><th></th><th></th>"
				+"<th>Total</th>"
    			+"<th><span style='b'>"+api.column( 7, {page:'current'} ).data().sum()+"</span></th>"
				+"<th><span style='b'>"+ api.column( 8, {page:'current'} ).data().sum()+"</span></th>"
				+"<th></th>"
				+"<th><span style='b'>"+ api.column( 10, {page:'current'} ).data().sum()+"</span></th>"
				+"<th><span style='b'>"+ api.column( 11, {page:'current'} ).data().sum()+"</span></th>"
				+"<th><span style='b'>"+ api.column( 12, {page:'current'} ).data().sum()+"</span></th>"
				+"<th><th>"
				+"<span style='b'>"+ api.column( 14, {page:'current'} ).data().sum()+"</span></th>"
    			);
    		}
			*/
			"footerCallback": function(row, data, start, end, display) {
				var api = this.api(), data;

				
				$(api.column(7).footer()).html( api.column( 7, {page:'current'} ).data().sum() );
				$(api.column(8).footer()).html( api.column( 8, {page:'current'} ).data().sum() );
				$(api.column(10).footer()).html( api.column( 10, {page:'current'} ).data().sum() );
				$(api.column(11).footer()).html( api.column( 11, {page:'current'} ).data().sum() );
				
				$(api.column(12).footer()).html( api.column( 12, {page:'current'} ).data().sum() );
				$(api.column(14).footer()).html( api.column( 14, {page:'current'} ).data().sum() );
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
         var surgery=$('.surgery').val();
		 
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

		/* if($('#fees_detail').val() != ""){
			 //alert( $('#fees_detail').val());
           theGrid.column(4).search(
                $('#fees_detail').val()
            ).draw();
         }*/
    if($('.surgery').val() != ""){
       //alert( $('#fees_detail').val());
           theGrid.column(4).search(
                $('.surgery').val()
            ).draw();
         }

		 if($('#payment_mode').val() != ""){
           theGrid.column(5).search(
                $('#payment_mode').val()
            ).draw();
         }

		 if($('#user_id').val() != ""){
           theGrid.column(6).search(
                $('#user_id').val()
            ).draw();
         }

         if($('#doctor_id').val() == "" && $('#fromDate').val() == "" && $('#ToDate').val() == "" && $('#fees_detail').val() == "" && $('#payment_mode').val() == "" && $('#user_id').val() == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
			theGrid.column(4).search('');
            theGrid.column(5).search('');
            theGrid.column(6).search('');
            theGrid.ajax.reload();
         }
        return false;
        }



    </script>
@endsection