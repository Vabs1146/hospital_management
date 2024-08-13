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
.input-group {
    width: 100%;
    margin-bottom: 0px;
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
                        <div class="card col-md-10" style="float:none;margin:auto;">
                        <div class="header">
                            <center><h2><b>IPD BILL BALANCE REPORT </b></h2></center>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                
                                  @if(Session::has('flash_message'))
								  <div class="col-lg-12"> 
                                      <div class="alert alert-success">
                                          {{ Session::get('flash_message') }}
                                      </div>
                                </div>
                                  @endif

                             
                             
                                <div class="col-md-5">
                                  <div class="input-group">
                                      <span class="input-group-addon">
                                          Admission Date :
                                      </span>
                                      <div class="form-line">
                                          <input type="text" class="form-control datepicker" placeholder="" id="fromDate" name="fromDate">
                                      </div>
                                  </div>
                              </div>

                               <div class="col-md-5">
                                  <div class="input-group">
                                      <span class="input-group-addon">
                                         To Date :
                                      </span>
                                      <div class="form-line">
                                          <input type="text" class="form-control datepicker" placeholder="" id="ToDate" name="ToDate">
                                      </div>
                                  </div>
                              </div>  
							  <div class="col-md-2">
                                    <div class="form-group">
										<button type="button" onclick="return searchPatient()" class="btn btn-success waves-effect">Search</button>
									</div>
                              </div> 
                          
						 
                           </div>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 20px;">
                        <form>
                         <div class="header" style="background-color:#2b982b">
                            <h2 style="color:#fff !important;"> 
                               IPD BILL BALANCE REPORT DETAILS
                            </h2>
                          
                        </div>
                        
                        <div class="body">

                          <div class="table-responsive">
                             <table class="table table-striped table-hover table-bordered" id="thegrid">
                              <thead>
                                <tr>										
									<th>Admission Date</th>   								
									<th>Bill No.</th>                     
									<th>Patient</th>                       
									<th>Total Bill Amount</th>                   
									<th>Disount</th>
									<th>Total Paid</th>     
									<th>Balance</th>   
                                </tr>
                              </thead>
                              <tbody>

                              </tbody>
                               <tfoot>
								<tr>
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
    		"ajax": "{{url('new-ipd-bill-balance-report-grid')}}/",
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

			"drawCallback": function ( settings ) {
    			
    			//----------------------------------------------------------------------
    			var api = this.api();
    			$( api.table().footer() ).html("<th></th><th></th><th></th><th></th><th></th>"
				+"<th>Balance</th>"
    			+"<th><span style='b'>"+api.column( 6, {page:'current'} ).data().sum()+"</span></th>"
				//+"<th><span style='b'>"+ api.column( 4, {page:'current'} ).data().sum()+"</span></th>"
				//+"<th><span style='b'>"+ api.column( 5, {page:'current'} ).data().sum()+"</span></th>"
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
        if($('#fromDate').val() != "") {
           theGrid.column(1).search(
                $('#fromDate').val()
            ).draw();
         }         
         if($('#ToDate').val() != "") {
           theGrid.column(2).search(
                $('#ToDate').val()
            ).draw();
         }
   

         if($('#fromDate').val() == "" && $('#ToDate').val() == "") {
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.ajax.reload();
         }
        return false;
    }

    </script>
@endsection