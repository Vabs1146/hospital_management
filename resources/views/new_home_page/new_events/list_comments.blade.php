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
                            <h2>
                               Event Comments
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                 <table class="table table-hover dataTable table-bordered js-exportable" id="thegrid" data-stripe-classes="[]">
                                  <thead>
                                     <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Comments</th>
                                    <th style="width:50px"></th>
                                    <th style="width:50px"></th>
                                </tr>
                                  </thead>

                                  <tbody>
                                  </tbody>
                                </table>
                            </div>     
                        </div>
                        <div class="panel-footer">
                          <a href="{{url('add-event')}}" class="btn btn-primary btn-lg" role="button">Add</a>
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
            theGrid = $('#thegrid').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "responsive": false,
                "ajax": { 'url':'{{url('list-comments-grid')}}', 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token'), 'event_id' : '{{$event_id}}' }},
                "columnDefs": [
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/edit-event') }}/'+row[0]+'">'+data+'</a>';
                        },
                        "targets": 0
                    },
                    {
                        "render": function ( data, type, row ) {
                            //return '<a href="{{ url('/edit-event') }}/'+row[0]+'" class="btn btn-default">Update</a>';
							if(data == '1') {
								return '<a href="#" onclick="return doHide('+row[0]+')" class="btn btn-success">Visible (click to hide)</a>';
							} else {
								return '<a href="#" onclick="return doShow('+row[0]+')" class="btn btn-danger">Hidden (click to show)</a>';
							}
                        },
                        "targets": 5                    
					},
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                        },
                        "targets": 5+1
                    },
                ]
            });
        });
        function doDelete(id) {
            if(confirm('You really want to delete this comment?')) {
               $.ajax({ url: '{{ url('/delete-comment') }}/' + id, 
               type: 'post',
               data: {_method: 'post', _token :$("#hdnCsrfToken").data('token'), 'event_id' : id}
               }).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }
		function doHide(id) {
            if(confirm('You really want to hide this comment?')) {
               $.ajax({ url: '{{ url('/hide-comment') }}/' + id, 
               type: 'post',
               data: {_method: 'post', _token :$("#hdnCsrfToken").data('token'), 'event_id' : id}
               }).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }
		function doShow(id) {
            if(confirm('You really want to show this comment?')) {
               $.ajax({ url: '{{ url('/show-comment') }}/' + id, 
               type: 'post',
               data: {_method: 'post', _token :$("#hdnCsrfToken").data('token'), 'event_id' : id}
               }).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }
    </script>
@endsection