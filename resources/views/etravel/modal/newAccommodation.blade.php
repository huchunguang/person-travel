<div class="modal fade" id="addNewAccommodation" role="dialog" aria-labelledby="addNewAccommodation" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Add New Accommodation</h4>
			</div>
			<div class="modal-body">
				<form action="#" method="post" class="horizontal-form" id="hotelAccommodationCreate">
					<input type="hidden" name="tr_id" value="" />
					<div class="alert alert-danger display-hide">
						<button class="close" data-close="alert"></button>
						You have some form errors. Please check below.
					</div>
					<div class="alert alert-success display-hide">
						<button class="close" data-close="alert"></button>
						Your form validation is successful!
					</div>
					<div class="row" style="position: relative;">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Hotel Name</label>
								<div class="input-group">
									<div class="icheck-inline">
										<label>
											<input type="radio" name="hotel_is_corporate" class="icheck hotel_is_corporate" id="hotel__corporate" value="1" checked>
											Corporate Hotel
										</label>
									</div>
									<div class="icheck-inline">
										<label>
											<input type="radio" name="hotel_is_corporate" class="icheck hotel_is_corporate" id="hotel_non_corporate" value="0">
											Non Corporate Hotel
										</label>
									</div>
								</div>
								<input type="hidden" name="hotel_id[]" id="" class="form-control" />
								<input type="text" name="hotel_name[]" id="" class="form-control" />
							</div>
						</div>
						<div class="col-md-6" style="position: absolute; bottom: 0; right: 0;">
							<div class="form-group">
								<label class="control-label">Rate</label>
								<input type="text" name="rate[]" id="rate" class="form-control rateTextField" / style="display: none;">
								<select class="form-control rateSelectBox" name="rate[]" id="rate" disabled>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Check-in Date</label>
								<input type="text" id="" name="checkin_date[]" class="form-control singleDatePicker" readonly>
								<i class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; bottom: 16px; right: 24px; top: auto; cursor: pointer;"></i>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Check-out Date</label>
								<input type="text" id="" name="checkout_date[]" class="form-control singleDatePicker" readonly>
								<i class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; bottom: 16px; right: 24px; top: auto; cursor: pointer;"></i>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="addNewAccommodation()">Save</button>
			</div>
		</div>
	</div>
</div>