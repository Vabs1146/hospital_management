

<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
{{ Form::label('Before_file', 'Before image') }} 
</div>
</div>
<div class="col-md-4">
<div class="form-group"> 
{{ Form::file('Before_file', Request::old('Before_file'), array('class'=> 'form-control')) }}
@if(isset($casedata['Before_file']) && $casedata['Before_file'] != null)
<a href="{{Storage::disk('local')->url($casedata['Before_file']) }}" class="" target="_blank"> Before Image link</a>              
@endif 
</div>
</div> 
<div class="col-md-2">
<div class="form-group labelgrp">
{{ Form::label('After_file', 'After image') }} 
</div>
</div>
<div class="col-md-4">
<div class="form-group">
{{ Form::file('After_file', Request::old('After_file'), array('class'=> 'form-control')) }}
@if(isset($casedata['After_file']) && $casedata['After_file'] != null)
<a href="{{ Storage::disk('local')->url($casedata['After_file']) }}" class="" target="_blank"> After Image link</a>              
@endif
</div>
</div>    
</div>

<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Upload Case Paper Image</label>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
{{ Form::file('reportImage', Request::old('reportImage'), array('class'=> 'form-control', "accept"=> "image/png, image/gif, image/jpeg" )) }}
</div>
</div> 


</div> 
<div class="col-md-12 col-md-offset-4"> 
<div class="col-md-4">
<button type="submit" name="submit_reportImage" class="btn btn-lg" value="submit_reportImage"><i class="fa fa-plus"></i> Add
</button>&nbsp;
<a class="btn btn-default btn-lg" href="{{ url('/ViewEyeReportFiles/').'/'.$casedata['id'] }}"><i class="glyphicon glyphicon-chevron-left"></i> View Report Files  
</a>
</div>
</div>  
<div class="col-md-12">
<div class="col-md-6 col-md-offset-4">
<div class="form-group">
<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination') }}" name="submit" class="btn btn-primary btn-lg" value="submit">Submit</button>
<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination1') }}" name="submit" class="btn btn-primary btn-lg" value="submit">Submit & View
</button>
<!--                                        <button type="submit" formaction="{{ url('/patientDetails/SendEmailSave') }}" name="SubmitMail" class="btn btn-primary btn-lg" value="SubmitMail">Submit & Mail</button>-->
</div>
</div>
</div> 
