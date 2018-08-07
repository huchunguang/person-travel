<!--（Modal） -->
<div class="modal fade" id="forReject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-danger bold" id="myModalLabel">Are you sure you want to reject this overtime request?</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 control-label">Comments<span class="required" aria-required="true"> * </span></label>
							
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<textarea class="form-control" rows="4" name="hr_reject_comment" required></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
				<button type="button" class="btn btn-primary" id="rejectBtn">YES</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal -->
</div>