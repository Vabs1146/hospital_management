@extends('adminlayouts.master')
@section('style')
<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }

    .canvas{
        position:relative; width:150px; height:200px; background-color:#7a7a7a; margin:70px auto 20px auto;
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
                        <form action="{{ url('/menu_lists'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        @if (isset($model))
                            <input type="hidden" name="_method" value="PATCH">
                        @endif
                        <input type="hidden" name="id" id="id" value={{$model['id'] or ''}}  />
                         <div class="header bg-pink">
                            <h2>
                                Add/Modify Menu list
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="row clearfix ">
<div class="col-md-12 col-md-offset-1">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="name" class="form-control">Name :</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<div class="form-line">
				<input type="text" name="name" id="name" class="form-control" value="{{$model['name'] or ''}}"> 
			</div>                             
		</div>
	</div>
</div>

<div class="col-md-12 col-md-offset-1">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="link" class="form-control">Link :</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<div class="form-line">
				<input type="text" name="link" id="link" class="form-control" value="{{$model['link'] or ''}}"> 
			</div>                             
		</div>
	</div>
</div>

<div class="col-md-12 col-md-offset-1">

<div class="col-md-2">
<div class="form-group labelgrp">
<label for="description" class="form-control">Description :</label>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<div class="form-line">
<input type="text" name="description" id="description" class="form-control" value="{{$model['description'] or ''}}"> 
</div>
</div>
</div>
</div>


<div class="col-md-12 col-md-offset-1">                           
<div class="col-md-2">
<div class="form-group labelgrp">
<label for="orderNo" class="form-control">Order Number :</label>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<div class="form-line">
<input type="text" name="orderNo" id="orderNo" class="form-control" value="{{$model['orderNo'] or ''}}">
</div>
</div>
</div>
</div>

<div class="col-md-12 col-md-offset-1">

<div class="col-md-2">
<div class="form-group labelgrp">
<label for="parentId" class="form-control">Parent :</label>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
{{ Form::select('parentId',array(''=>'Please select') + $menulst->toArray(), isset($model['parentId'])?$model['parentId']:'', array('class' => 'form-control select2','data-live-search'=>'true')) }}
</div>
</div>

</div> 

<div class="col-md-12 col-md-offset-1">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="link" class="form-control">Orientation :</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<div class="form-line">
				<select id="orientation" name="orientation" class="form-control">
					<option {{ (isset($model['orientation']) && $model['orientation'] == 'portrait') ? 'selected' : '' }} value="portrait">Portrait</option>
					<option {{ (isset($model['orientation']) && $model['orientation'] == 'landscape') ? 'selected' : '' }} value="landscape">Landscape</option>
				</select>
			</div>                             
		</div>
	</div>
</div>


<div class="col-md-12 col-md-offset-1">                           
<div class="col-md-2">
<div class="form-group labelgrp">
<label for="ed_degree" class="form-control">Is Active :</label>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<input type="checkbox" id="remember_me_3" name="isActive"  value="{{$model['isActive'] or '1'}}" {{ (isset($model['isActive']) && $model['isActive'] == 1)? 'checked' : '' }} >
<label for="remember_me_3"></label>

</div>
</div>
</div>   

<div class="col-md-12">                           
<div class="col-md-4 col-md-offset-4">
<div class="form-group">
<button type="submit" class="btn btn-success btn-lg">
<i class="glyphicon glyphicon-plus btnicons"></i> Save
</button> 
<a class="btn btn-default btn-lg" href="{{ url('/menu_lists') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
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

@section('scripts')
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function() {
   });
   $(".select2").select2();
 </script>
@endsection  
