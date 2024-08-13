<span class="dropdown-container">
	<div id="{{$element_key}}" class="ContainerToAppend">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>{{$dropdown_lable}}</label>
					<input type="hidden" id="{{$element_key}}[]" name="{{$element_key}}[]" class="hiddenCounter" value="1" /> 
				</div>  
			</div>
			<div class="col-md-6">
				{{ Form::select($element_key.'_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', $element_key.'_od')->pluck('ddText','ddText')->toArray(), ($element_key.'_od') ? $value_1 : null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>

			@if($is_two)
			<div class="col-md-3">
				{{ Form::select($element_key.'_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', $element_key.'_os')->pluck('ddText','ddText')->toArray(), ($element_key.'_os') ?$value_2 : null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
			@endif
			<div class="col-md-4">
				<button type="button" name="add" id="{{$element_key}}_btn" class="btn btn-success set-dropdown-options"  data-field_name="{{$element_key}}_od" data-form_name="EyeForm" >Set Option </button>
				<button type='button' class="btn btn-primary" id='{{$element_key}}_save'>Save Option</button>
				<button id="{{$element_key}}" class="btn btn-default addmore_dropdown" data-templateDiv="{{$element_key}}_template">Add</button>
			</div>
		</div>

	</div>
	<div id='{{$element_key}}_TextBoxesGroup' class="col-md-12">

	</div>
	<div style="display:none;">
	<div id="{{$element_key}}_template">
			<div class="col-md-12">
				<div class="col-md-2">
					<input type="hidden" id="{{$element_key}}[]" name="{{$element_key}}[]" class="hiddenCounter" value="1" />  
				</div>
				<div class="col-md-6">
					{{ Form::select($element_key.'_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', $element_key.'_od')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
				@if($is_two)
				<div class="col-md-3">
					{{ Form::select($element_key.'_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', $element_key.'_os')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
				@endif
				<div class="col-md-2">
					<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
				</div>
			</div>
		</div>
	</div>
	<!-- ================================================================================= -->

	<!-- set-dropdown-options -->
	<!-- <span class="dropdown-container"> -->
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
	
	</div>
</span>
<!-- ================================================================================= -->



<div class="dbMultiEntryContainer">
	@foreach ($saved_data as $item)
	<div class="col-md-12">
		<div class="col-md-2">
		</div>
		<div class="col-md-6">
		<input type="text" class="form-control" readonly value="{{$item->value_1}}">
		</div>
		@if($is_two)
		<div class="col-md-3">
		<input type="text" class="form-control" readonly value="{{ucfirst($item->value_2)}}">
		</div>
		@endif
		<div class="col-md-2">
		<button class="removeDbItem btn btn-default" data-table_name="{{$database_table}}" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
</div>


<script>
function isEmpty( el ){
	return !$.trim(el.html())
}
 $("#{{$element_key}}_save").click(function () {

	
        var content=$("#{{$element_key}}_TextBoxesGroup").val();

		console.log("#{{$element_key}}_TextBoxesGroup");
        if (isEmpty($('#{{$element_key}}_TextBoxesGroup'))) {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        } else {
 //var data=$("#eyeform").serialize();
 var data=$("#{{$element_key}}_TextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For {{$dropdown_lable}}", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    }); 
</script>


<script type="text/javascript">
     var {{$element_key}}_cnt = 1;
$("#{{$element_key}}_btn").click(function () {
      
  if({{$element_key}}_cnt>10){
		swal("Only 10 Options Values are allow!");
		return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+{{$element_key}}_cnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="{{$element_key}}_od"><input class="form-control"  type="hidden"  name="fieldName2" value="{{$element_key}}_os"><input class="form-control"  type="text" id="optionsval'+{{$element_key}}_cnt+'" placeholder="value'+{{$element_key}}_cnt+'" name="optionsval[]"></div><span class="input-group-addon {{$element_key}}_removeButton" type="button" id="{{$element_key}}_removeButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#{{$element_key}}_TextBoxesGroup").append(newTextBoxDiv);
  {{$element_key}}_cnt++;
     });

$(document).on('click', '.{{$element_key}}_removeButton', function(e) {
	{{$element_key}}_cnt--;
	var target = $("#{{$element_key}}_TextBoxesGroup").find("#TextBoxDiv" +{{$element_key}}_cnt);
	$(target).remove();
});


$(document).on('click', '.addmore_dropdown', function(e) {
				//alert('hiiii');
	e.preventDefault();
	var template = $("#"+$(this).data('templatediv')).clone();

	$(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));

	$(this).closest('div.ContainerToAppend').append($(template).html());
	$(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});

});

$(document).on('click', '.removeItem' ,function(e){
	e.preventDefault();
	$(this).closest('div.col-md-12').remove();
	return false;
});

$(document).on('click', '.removeDbItem', function(e) {
	var ClickedButton = $(this);
	var containerDiv = $(this).closest('div.form-group.row');

	var delete_type = ClickedButton.data('type');
	var url='{{url("delete-dropdown-db-val")}}/'+ $(ClickedButton).data('deleteid');
	alert(url);
	swal({
		title: "Are you sure?",
		text: "This Will Remove !",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, delete it!",
		closeOnConfirm: false
	}, function () {
			
		$.ajax({ url: url, 
			type: 'DELETE',
			data: {
				_method: 'delete', 
				_token :$("input[name='_token'][type='hidden']").val(),
				id : $(ClickedButton).data('deleteid'),
				table_name : $(ClickedButton).data('table_name'),
				type: delete_type
			}
		})
		.success(function() {
			$(containerDiv).remove();
			$(ClickedButton).button('reset');

			swal({title: "Deleted", text: "Successfully!!!", type: "success"},
				function(){ 
					location.reload();
				}
			);
		}).error(function(){
		$(ClickedButton).button('reset');
		});

			location.reload();
	});
	e.preventDefault();

});

</script>