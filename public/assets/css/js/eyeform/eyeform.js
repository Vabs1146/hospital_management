$(document).ready(function() {

	$(document).on('click', '.remove-custom-item', function() {
		$(this).closest('.custom-item-values').remove();
	});

	$('.add-custom-item').click(function() {
            //var drop_down = $('.add-custom-item').closest('.custom-item').find('custom-item-dropdown');
            //var selected_item = $('.add-custom-item').closest('.custom-item').find('.custom-item-dropdown').val();

            var terget_element = $(this).closest('.custom-item').find('.custom-item-dropdown').children(':selected');

            var selected_dropdown = $(this).closest('.custom-item').find('.custom-item-dropdown');

            var selected_item = $(this).closest('.custom-item').find('.custom-item-dropdown').children(':selected').text();

            //alert(selected_dropdown.val());

            if(selected_dropdown.val() != "") {

                var label			= terget_element.data('title');
                var custom_od_name	= terget_element.data('od');
                var custom_os_name	= terget_element.data('os');
                var custom_val		= terget_element.val();

                var custom_od = $('.add-custom-item').closest('.custom-item').find('.custom-od-val').val();
                var custom_os = $('.add-custom-item').closest('.custom-item').find('.custom-os-val').val();


                selected_dropdown.val('');
                selected_dropdown.trigger('click');
                $('.add-custom-item').closest('.custom-item').find('.custom-od-val').val('');
                $('.add-custom-item').closest('.custom-item').find('.custom-os-val').val('');

                var html = '<div class="row custom-item-values">';

html += '<div class="col-md-4"> <label>'+label+'</label> <input type="hidden" name="custom_values[]" value="'+custom_val+'"></div>';
html += '<div class="col-md-3"> <input type="text" class="form-control custom-od" name="custom_values_od[]" value=""> </div>';

                if(custom_os_name == 'surgery_OS') {
                    html += '<div class="col-md-3 surgery-eye"> <input class="surgery-eye-radio" type="radio" name="surgery_OS_temp"  value="left" style="opacity: 1; left: auto; position: relative;">Left <input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="right" style="opacity: 1; left: auto; position: relative;">Right <input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="both" style="opacity: 1; left: auto; position: relative;">Both <input type="hidden" class="surgery-eye-val" name="custom_values_os[]"> </div>'; 
                } else {
                    var display = (!custom_os_name) ? "display:none;" : '';
                    html += '<div class="col-md-3" style="'+display+'">';

                    html += '<input type="text" class="form-control custom-os" name="custom_values_os[]" value="">';

                    html += '</div>';
                }
                
                html += '<div class="col-md-2"> <span class="remove-custom-item btn btn-default">Remove</span> </div></div>';


                $(this).closest('.custom-item-parent-div').find('.custom-item-container').append(html);
            }
            console.log($('.add-custom-item').closest('.custom-item').find('.custom-item-dropdown').val());
	});
	
});