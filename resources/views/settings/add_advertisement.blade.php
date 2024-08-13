@extends('adminlayouts.master')
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
				<form action="{{ url('/update-advertisement') }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data'>
				{{ csrf_field() }}
				

				<div class="header bg-pink">
					<h2>
					Advertisement
					</h2>

				</div>
				<div class="body">
					<div class="row clearfix ">
						<div class="col-md-12 ">
							<div class="col-md-2 col-md-offset-1">
								<div class="form-group labelgrp">
									<label for="uploadeImage" class="form-control">Image :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="file" name="uploadeImage" id="uploadeImage" class="form-control" accept="image/*"> 
									</div>                             
								</div>
							</div>
						</div>

						@if(isset($model->name) && !empty($model->name))
						<div class="col-md-12 ">
							<div class="col-md-6 col-md-offset-3">
								<div class="form-group">
									<img class="img-responsive thumbnail" src="{{ Storage::disk('local')->url($model->name) }}" alt="Image" width="304" height="300">
								</div>
							</div>
						</div>
						@endif


						<div class="col-md-12 ">                           
							<div class="col-md-2 col-md-offset-1">
								<div class="form-group labelgrp">
									<label for="ed_degree" class="form-control">URL :</label>
								</div>
							</div>

							<div class="col-md-9">
								<div class="form-group">
									<input class="form-control" type="text" id="url" name="url"  value="{{ (isset($model->value))? $model->value : '' }}" >
								</div>
							</div>
						</div>   


						<div class="col-md-12 ">                           
							<div class="col-md-2 col-md-offset-1">
								<div class="form-group labelgrp">
									<label for="ed_degree" class="form-control">Is Active :</label>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<input type="checkbox" id="remember_me_3" name="isActive"  value="1" {{ (isset($model->status) && $model->status == 1)? 'checked' : '' }} >
									<label for="remember_me_3"></label>
								</div>
							</div>
						</div>   

						<div class="col-md-12">                           
							<div class="col-md-4 col-md-offset-4">
								<div class="form-group">
								<button type="submit" class="btn btn-primary btn-lg">
								<i class="fa fa-plus"></i> Save
								</button> 
								</div>
							</div>


						</div>                  
						<!-- End Of row -->
					</div>                              
				</div>
				
				</form>
			</div>

		</div>
	</div>
</div>



@endsection
