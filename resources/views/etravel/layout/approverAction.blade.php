<div class="col-md-12">
	<div class="portlet box grey-cararra">
		<div class="portlet-title">
			<div class="caption">For your action</div>
		</div>

		<div class="portlet-body form">
			<div class="form-body text-center">
				<div class="row">
					<div class="btn-group btn-group-solid margin-bottom-10">
						@if($trip->trip_type == 2)
						<button id="PartlybtnApproveValidate" style="margin-right: 10px;" type="button"
							data-toggle="modal" data-target="#forPartlyApproval"
							class="btn yellow-crusta" disabled>
							<i class="fa fa-thumbs-up"></i> Partly Approve
						</button>
						@endif
						<button id="btnApproveValidate" style="margin-right: 10px;" type="button"
							 data-toggle="modal" data-target="#forApproval" 
							 title="Approve Leave Request"
							class="btn green" <?php if($trip->trip_type=='2'){echo 'disabled';}?>>
							<i class="fa fa-thumbs-up"></i> Approve
						</button>
						<button id="btnRejectTravel" type="button"
							class="btn red" disabled="" style="margin-right: 10px;">
							<i class="fa fa-thumbs-down"></i> Reject
						</button>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-12">
						<textarea id="approver_comment" name="approver_comment"
							class="form-control leave-control" style="overflow-y: scroll;"
							rows="2" placeholder="Please Enter Comment to be able to Reject"></textarea>
						<span class="help-block" style="color: red;"> *Comment is required
							for rejection </span>
					</div>
				</div>
				<script src="{{asset('js/etravel/trip/demosticDetail.js')}}"></script>
			</div>
		</div>
	</div>
</div>