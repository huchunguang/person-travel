<div class="modal fade" id="newReason" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{url('overtime/reason')}}" id="" class="form-horizontal" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myModalLabel">
						<span class="caption-subject bold uppercase"> New Reason Item</span>
					</h4>
				</div>
				<div class="modal-body">
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Your form validation is successful!
						</div>
						<div class="form-group">
							<div class="col-md-4">
								<label class="control-label ">
									Reason Subject <span class="required" aria-required="true"> * </span>
								</label>
							</div>
							<div class="col-md-10">
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" class="form-control" name="reason_subject" required>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button type="submit" class="btn green" id="saveReasonBut">Save</button>
								<button type="button" class="btn default" data-dismiss="modal">Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
