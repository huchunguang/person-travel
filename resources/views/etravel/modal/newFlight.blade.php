<div class="modal fade" id="addNewFlight" role="dialog" aria-labelledby="addNewFlight" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Add New Flight</h4>
			</div>
			<div class="modal-body">
				<form action="#" method="post" class="horizontal-form" id="flightCreate">
					<input type="hidden" name="tr_id" value=""/>
					<input type="hidden" name="modalFlag" id="modalFlag"/>
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
								<label class="control-label">Date</label>
								<input type="text" name="flight_date[]"
																	class="form-control singleDatePicker"> <i
																	class="glyphicon glyphicon-calendar fa fa-calendar"
																	style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">From</label>
								<input type="text" name="flight_from[]" id="" class="form-control"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">To</label>
								<input type="text" name="flight_to[]" id="" class="form-control"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Airline/Train</label>
									<div class="row">
											
									<div class="col-md-4" style="padding-right:0;">
											<input type="text" name="air_code[]" class="form-control" readonly/>
											
										</div>
										<div class="col-md-8" style="padding-left:0;">
										<select class="form-control select2 airlineSel" style="width: 100%" name="airline_or_train" id="airline_or_train" required style="display:inline">
																<option value=""></option>																
																<option value="1" data-id="">airline</option>
																<option value="0">train</option>
											</select>
										</div>
									</div>
									
																	 
							</div>
						</div>
					</div>
					
					<div class="row">
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">ETD</label>
								<input type="text" name="etd_time[]"class="form-control" placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">ETA</label>
								<input type="text" name="eta_time[]"class="form-control" placeholder="">
							</div>
						</div>
					
					</div>
					
					<div class="row">
						
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Class Fight</label>
								<select class="form-control" name="class_flight[]" id="classFlightSel" required style="display:inline">
									<option value="">Select...</option>																
									<option value="Economy">Economy</option>
									<option value="Economy Plus">Economy Plus</option>
									<option value="Business Class">Business Class</option>
									<option value="First Class">First Class</option>
								</select>
<!-- 								<input type="text" name="class_flight[]" id="" class="form-control"/> -->
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">VISA</label>
								<select class="form-control" name="is_visa" id="is_visa">
									<option value="1">YES</option>
									<option value="0">NO</option>
								</select>
							</div>
						</div>
					
					
					</div>
					
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" onclick="addNewFlight()">Save</button>
			</div>
		</div>
	</div>
</div>