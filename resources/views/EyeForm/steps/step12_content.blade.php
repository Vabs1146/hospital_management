<div class="col-md-12 dropdown-container">
	<div class="row">
		<label>Upload Images</label>
		<input type="file" multiple name="fundus_images[]">
	</div>
</div>

<button type="submit" formaction="{{ url('/patientDetails/saveFundusImages') }}" type="submit" name="submit" class="btn btn-primary btn-lg" value="submit">
	Upload Images
</button>

<!-- <div class="col-md-12" style="clear:both;height: 600px;"> -->
<div class="row" style=" display: block; height: 260px; ">
	<div class="col-md-12">
		<!-- <div class="row"> -->
			@foreach($fundus_main_images as $key => $fundus_main_images_row)
				@if(!in_array( $fundus_main_images_row, ['.', '..']))
				<div style="width:200px; display:inline-block; float:left; text-align:center; margin-top:20px; margin-left: 20px;" >
					<input style="display:none;" type="radio" name="selected_fundus_img"  id="selected_fundus_img_{{$key}}" class="selected_fundus_img" value="{{$fundus_main_images_row}}" onclick="loadImage_png('{{ '/fundus_images/'. $fundus_main_images_row}}')" style="display:none;">
					<label for="selected_fundus_img_{{$key}}" style="height: auto;">
						<img style="max-width: 200px;height: 175px;" src="{{ '/fundus_images/'. $fundus_main_images_row}}" >
					</label>
					<a href="javascript:void(0)" class="remove-fundus-main-image btn btn-warning" data-case_id="{{$casedata['id']}}" data-image_id="{{$fundus_main_images_row}}" data-img="{{$fundus_main_images_row}}">Remove</a>
				</div>
				@endif
			@endforeach
		<!-- </div> -->
	</div>
</div>




<div class="row" style="">
	<div class="col-md-12 col-lg-8 ">
		 <div id="wPaint" style="position:relative; width:600px; height:400px; background-color:#7a7a7a; margin:70px auto 20px auto;"></div>

      <!-- <center style="margin-bottom: 50px;">
        <input type="button" value="toggle menu" onclick="console.log($('#wPaint').wPaint('menuOrientation')); $('#wPaint').wPaint('menuOrientation', $('#wPaint').wPaint('menuOrientation') === 'vertical' ? 'horizontal' : 'vertical');"/>
      </center> -->
		
		<!-- <a href="javascript:loadImage_png();">load image (png)</a> -->

		<div><img id="canvasImage" src=""/></div>

		<center id="wPaint-img"></center>
	</div>
	<div class="col-md-12 col-lg-4 ">
		<div class="row">
			<div class="col-md-12">
			<label for="fundus_image_name">Name : </label> <input type="text" class="form-control" name="fundus_image_name" id="fundus_image_name">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<label for="fundus_image_eye">Eye : </label> <input style="
    position: relative;
    left: auto;
    opacity: 1;
" type="radio" value="left"  name="fundus_image_eye" id="fundus_image_eye_lleft"> Left
			<input style="
    position: relative;
    left: auto;
    opacity: 1;
" type="radio" value="right"  name="fundus_image_eye" id="fundus_image_eye_right"> right
		</div>
		</div>

		<div class="row">
			<div class="col-md-12">
			<label for="fundus_image_name">Description : </label><br> <textarea style="
    width: 100%;
" name="fundus_image_description" id="fundus_image_description" row="5"></textarea>
			</div>
		</div>

		<div class="row" style="text-align:center;">
		<a class="btn btn-success" href="javascript:saveImage();">save image</a>

		<a class="btn btn-info"  href="javascript:clearCanvas();">clear canvas</a>
</div>
	</div>
</div>


     
<div class="row" id="modified_fundus_images">
	@foreach($updated_fundus_images as $key => $modified_fundus_main_images_row)
	{{-- @if(!in_array( $modified_fundus_main_images_row, ['.', '..'])) --}}
			<div class="col-md-3 modified-fundus-image" style="text-align:center;" >
				<img class="show-image" data-src="{{'/uploads/fundus_images/'.$casedata['id'].'/'.$modified_fundus_main_images_row->image}}" data-info="<div><b>Name</b> : {{$modified_fundus_main_images_row->name}}</div><div><b>Eye</b> : {{ucfirst($modified_fundus_main_images_row->eye)}}</div><div><b>Description</b> : {{$modified_fundus_main_images_row->description}}</div>" style="max-width: 200px;height: 175px;" src="{{ '/uploads/fundus_images/'.$casedata['id'].'/'.$modified_fundus_main_images_row->image}}" >

				<a href="javascript:void(0)" class="remove-fundus-image btn btn-warning" data-case_id="{{$casedata['id']}}" data-image_id="{{$modified_fundus_main_images_row->id}}" data-img="{{$modified_fundus_main_images_row->image}}">Remove</a>
			</div>
			{{-- @endif --}}
		@endforeach
</div>
<div class="col-md-12">
	<div class="col-md-6 col-md-offset-4">
		<div class="form-group">
			
			<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination1') }}" name="submit" class="btn btn-primary btn-lg" value="submit">Submit & View
			</button>                                       
		</div>
	</div>
</div>


