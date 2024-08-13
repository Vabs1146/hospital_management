<div style="display:none">

	@foreach($procedure_array as $procedure_array_key => $procedure_array_val)
	<div id="{{$procedure_array_key}}Template">
        <div class="col-md-12">
			<div class="col-md-2">
				<input type="hidden" id="{{$procedure_array_key}}[]" name="{{$procedure_array_key}}[]" class="hiddenCounter" value="" />
			</div>
			<div class="col-md-3">
				 {{ Form::select($procedure_array_key.'_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', $procedure_array_key)->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
			</div>
			<div class="col-md-3">
			  
			</div>
			<div class="col-md-2">
				<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
			</div>
        </div>
    </div>
	@endforeach
	
	
	@foreach($procedure_array2 as $procedure_array_key => $procedure_array_val)
	<div id="{{$procedure_array_key}}Template">
        <div class="col-md-12">
			<div class="col-md-2">
				<input type="hidden" id="{{$procedure_array_key}}[]" name="{{$procedure_array_key}}[]" class="hiddenCounter" value="" />
			</div>
			<div class="col-md-3">
				 {{ Form::select($procedure_array_key.'_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', $procedure_array_key)->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
			</div>
			<div class="col-md-3">
			  
			</div>
			<div class="col-md-2">
				<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
			</div>
        </div>
    </div>
	@endforeach
	
	@foreach($procedure_array3 as $procedure_array_key => $procedure_array_val)
	<div id="{{$procedure_array_key}}Template">
        <div class="col-md-12">
			<div class="col-md-2">
				<input type="hidden" id="{{$procedure_array_key}}[]" name="{{$procedure_array_key}}[]" class="hiddenCounter" value="" />
			</div>
			<div class="col-md-3">
				 {{ Form::select($procedure_array_key.'_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', $procedure_array_key)->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
			</div>
			<div class="col-md-3">
			  
			</div>
			<div class="col-md-2">
				<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
			</div>
        </div>
    </div>
	@endforeach
</div>