<span class="dropdown-container">
	<div id="pastHistory" class="ContainerToAppend">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Treatment Note </label>
					<input type="hidden" id="pastHistory[]" name="pastHistory[]" class="hiddenCounter" value="1" /> 
				</div>  
			</div>
			<div class="col-md-6">
				{{ Form::select('psychiatrist_notes[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'psychiatrist_notes')->pluck('ddText','ddText')->toArray(), array_key_exists('psychiatrist_notes', $defaultValues)?$defaultValues['psychiatrist_notes']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
			<div class="col-md-4">
				<button type="button" name="add" id="pastHistorybtn" class="btn btn-success  set-dropdown-options"  data-field_name="psychiatrist_notes" data-form_name="EyeForm" >Set Option </button>
				<button type='button' class="btn btn-primary" id='pastHistorybtnsave'>Save Option</button>
				<button id="pastHistory" class="btn btn-default addmore" data-templateDiv="pastHistoryTemplate">Add</button>
			</div>
		</div>

	</div>
	<div id='pastHistoryTextBoxesGroup' class="col-md-12">

	</div>
	<div style="display:none;">
	<div id="pastHistoryTemplate">
			<div class="col-md-12">
				<div class="col-md-2">
					<input type="hidden" id="pastHistory[]" name="pastHistory[]" class="hiddenCounter" value="1" />  
				</div>
				<div class="col-md-6">
					{{ Form::select('psychiatrist_notes[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'psychiatrist_notes')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<div class="col-md-2">
					<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
				</div>
			</div>
		</div>
	</div>
	<!-- ================================================================================= -->

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
	@php 
	$dropdown_options_field_name = 'psychiatrist_notes';
	$dropdown_options_form_name = 'EyeForm';
	@endphp
	</div>
</span>
<!-- ================================================================================= -->
<div class="dbMultiEntryContainer">
@foreach ($treatment_notes as $item)
	<div class="col-md-12">
		<div class="col-md-2">
		</div>
		<div class="col-md-6">
		<input type="text" class="form-control" readonly value="{{$item->notes}}">
		</div>
		
		<div class="col-md-2">
		<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach

</div>

<script>

$(document).on('click', '.removeItem' ,function(e){
          e.preventDefault();
          $(this).closest('div.col-md-12').remove();
          //$('#surgeryDetails').remove($(this).closest('div.form-group'));
          return false;
        });

        //$(".removeDbItem").click(function(e) {
		$(document).on('click', '.removeDbItem', function(e) {
			var ClickedButton = $(this);
			var containerDiv = $(this).closest('div.form-group.row');

			var delete_type = ClickedButton.data('type');
			var url='{{url("psychiatrists-delete-note")}}/'+ $(ClickedButton).data('deleteid');
			//alert(url);
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
					type: 'POST',
					data: {
						id : $(ClickedButton).data('deleteid')
					}
				})
				.success(function() {
					$(containerDiv).remove();
					$(ClickedButton).button('reset');

					swal({title: "Deleted", text: "Successfully!!!", type: "success"},
						function(){ 
							//location.reload();
						}
					);
				}).error(function(){
				$(ClickedButton).button('reset');
				});

				 location.reload();
			});
			e.preventDefault();

        });

$(document).on('click', '.addmore', function(e) {
				//alert('hiiii');
            e.preventDefault();
            var template = $("#"+$(this).data('templatediv')).clone();
			//alert($(this).data('templatediv'));

			//console.log($(template).html());
            $(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));
            // $("#surgeryDetails").find('#patient_name').val('');
            $(this).closest('div.ContainerToAppend').append($(template).html());
            $(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});
            // .each(function(index,ele){
            //     $(ele).select2({width: '80%'});
            // });
        });
		
     function isEmpty( el ){
      return !$.trim(el.html())
  }
 $("#pastHistorybtnsave").click(function () {
        var content=$("#pastHistoryTextBoxesGroup").val();
        if (isEmpty($('#pastHistoryTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
 
 var data = $('#pastHistoryTextBoxesGroup :input').serialize();


        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Notes", text: "Added Successfully!", type: "success"},
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
     var pastHistorycnt = 1;
$("#pastHistorybtn").click(function () {
      
  if(pastHistorycnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+pastHistorycnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="psychiatrist_notes"><input class="form-control"  type="hidden"  name="fieldName2" value="pastHistory_OS"><input class="form-control"  type="text" id="optionsval'+pastHistorycnt+'" placeholder="value'+pastHistorycnt+'" name="optionsval[]"></div><span class="input-group-addon pastHistoryremoveButton" type="button" id="pastHistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#pastHistoryTextBoxesGroup").append(newTextBoxDiv);
  pastHistorycnt++;
     });

$(document).on('click', '.pastHistoryremoveButton', function(e) {
pastHistorycnt--;
   var target = $("#pastHistoryTextBoxesGroup").find("#TextBoxDiv" +pastHistorycnt);
  $(target).remove();
});

</script>