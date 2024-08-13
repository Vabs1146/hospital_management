
<div class="panel-heading" role="tab" id="heading_followup">
	<h4 class="panel-title">
		<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#followup_section" aria-expanded="true" aria-controls="followup_section">
		Follow Up
		</a>
	</h4>
</div>

<div id="followup_section" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_followup">
	<div class="panel-body">
	
	
	
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Follow up date :</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<div class="form-line">
						{{ $casedata['FollowUpDate'] }}
					</div>
				</div>
			</div> 
			
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Follow up time :</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<div class="form-line">
						{{ $casedata->FollowUpTimeSlot }}
					</div>
				</div>
			</div> 
		</div>
	
	<!-- =========================== Start form head ===================================== -->	
	{!! $followup_html !!}
<!-- ============================= End form footer ======================================= -->
</div>
</div>