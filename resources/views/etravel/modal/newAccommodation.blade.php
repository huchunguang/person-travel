<div class="modal fade" id="addNewAccommodation" role="dialog" aria-labelledby="addNewAccommodation" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Add New Accommodation</h4>
			</div>
			<div class="modal-body">
				<form action="#" method="post" class="horizontal-form" id="hotelAccommodationCreate">
					<input type="hidden" name="tr_id" value=""/>
					<div class="alert alert-danger display-hide">
						<button class="close" data-close="alert"></button>
						You have some form errors. Please check below.
					</div>
					<div class="alert alert-success display-hide">
						<button class="close" data-close="alert"></button>
						Your form validation is successful!
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Hotel Name</label>
								<input type="hidden" name="hotel_id[]" id="" class="form-control"/>
								<input type="text" name="hotel_name[]" id="" class="form-control"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Rate</label>
<!-- 								<input type="text" name="rate[]" id="" class="form-control"/> -->
								<select class="form-control" name="rate[]" id="rate" disabled>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Check-in Date</label>
								<input type="text" id="" name="checkin_date[]"
																		class="form-control singleDatePicker"> <i
																		class="glyphicon glyphicon-calendar fa fa-calendar"
																		style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Check-out Date</label>
								<input type="text" id="" name="checkout_date[]"
																		class="form-control singleDatePicker"> <i
																		class="glyphicon glyphicon-calendar fa fa-calendar"
																		style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>
								 
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