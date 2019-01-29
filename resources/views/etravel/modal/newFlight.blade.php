<div class="modal fade" id="addNewFlight" role="dialog" aria-labelledby="addNewFlight" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Add New Flight</h4>
			</div>
			<div class="modal-body">
				<form action="#" method="post" class="horizontal-form" id="flightCreate">
					<input type="hidden" name="tr_id" value="" />
					<input type="hidden" name="modalFlag" id="modalFlag" />
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
								<div class="input-group date date-picker" data-date-format="mm/dd/yyyy">
									<input type="text" class="form-control" name="flight_date[]" readonly>
									<span class="input-group-btn">
										<button class="btn default" type="button">
											<i class="fa fa-calendar"></i>
										</button>
									</span>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" style="margin-bottom: 0px;">
								<label class="control-label">From</label>
								
								 <input type="text" id="flight_from" name="flight_from[]" class="form-control cityairport_search"  data-provide="typeahead" data-value="" autocomplete="off" placeholder="Search by city">
						<!-- 		<select class="form-control select2 cityAirportSea" id="flight_from" name="flight_from[]" style="width: 100%">
									
							</select> -->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">To</label>
								<input type="text" id="flight_to" name="flight_to[]" class="form-control cityairport_search"  data-provide="typeahead" data-value="" autocomplete="off" placeholder="Search by city">
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Airline/Train</label>
								<div class="row">
									<div class="col-md-4" style="padding-right: 0;">
										<input type="text" name="air_code[]" class="form-control" readonly />
									</div>
									<div class="col-md-8" style="padding-left: 0;">
										<select class="form-control select2 airlineSel" style="width: 100%" name="airline_or_train" id="airline_or_train" required style="display:inline">
											<option value=""></option>
											<option value="0">Train</option>
											<option value="1" data-id="">Airline</option>
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
								<select class="form-control select2" id="etd_time" name="etd_time[]" style="width: 100%">
										<option value="12:00 AM" >12:00 AM</option>
										<option value="12:30 AM" >12:30 AM</option>
										<option value="1:00 AM" >1:00 AM</option>
										<option value="1:30 AM" >1:30 AM</option>
										<option value="2:00 AM" >2:00 AM</option>
										<option value="2:30 AM" >2:30 AM</option>
										<option value="3:00 AM" >3:00 AM</option>
										<option value="3:30 AM" >3:30 AM</option>
										<option value="4:00 AM" >4:00 AM</option>
										<option value="4:30 AM" >4:30 AM</option>
										<option value="5:00 AM" >5:00 AM</option>
										<option value="5:30 AM" >5:30 AM</option>
										<option value="6:00 AM" >6:00 AM</option>
										<option value="6:30 AM" >6:30 AM</option>
										<option value="7:00 AM" >7:00 AM</option>
										<option value="7:30 AM" >7:30 AM</option>
										<option value="8:00 AM" >8:00 AM</option>
										<option value="8:30 AM" >8:30 AM</option>
										<option value="9:00 AM" >9:00 AM</option>
										<option value="9:30 AM" >9:30 AM</option>
										<option value="10:00 AM" >10:00 AM</option>
										<option value="10:30 AM" >10:30 AM</option>
										<option value="11:00 AM" >11:00 AM</option>
										<option value="11:30 AM" >11:30 AM</option>
										<option value="12:00 AM" >12:00 PM</option>
										<option value="12:30 AM" >12:30 PM</option>
										<option value="1:00 PM" >1:00 PM</option>
										<option value="1:30 PM" >1:30 PM</option>
										<option value="1:30 PM" >1:30 PM</option>
										<option value="2:00 PM" >2:00 PM</option>
										<option value="2:30 PM" >2:30 PM</option>
										<option value="3:00 PM" >3:00 PM</option>
										<option value="3:30 PM" >3:30 PM</option>
										<option value="4:00 PM" >4:00 PM</option>
										<option value="4:30 PM" >4:30 PM</option>
										<option value="5:00 PM" >5:00 PM</option>
										<option value="5:30 PM" >5:30 PM</option>
										<option value="6:00 PM" >6:00 PM</option>
										<option value="6:30 PM" >6:30 PM</option>
										<option value="7:00 PM" >7:00 PM</option>
										<option value="7:30 PM" >7:30 PM</option>
										<option value="8:00 PM" >8:00 PM</option>
										<option value="8:30 PM" >8:30 PM</option>
										<option value="9:00 PM" >9:00 PM</option>
										<option value="9:30 PM" >9:30 PM</option>
										<option value="10:00 PM" >10:00 PM</option>
										<option value="10:30 PM" >10:30 PM</option>
										<option value="11:00 PM" >11:00 PM</option>
										<option value="11:30 PM" >11:30 PM</option>
								</select>
								
<!-- 								<div class="input-group"> -->
<!-- 									<input type="text" name="etd_time[]" class="form-control timepicker timepicker-no-seconds"> -->
									
<!-- 									<span class="input-group-btn"> -->
<!-- 										<button class="btn default" type="button"> -->
<!-- 											<i class="fa fa-clock-o"></i> -->
<!-- 										</button> -->
<!-- 									</span> -->
<!-- 								</div> -->
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">ETA</label>
								<select class="form-control select2 " id="eta_time" name="eta_time[]" style="width: 100%">
										<option value="12:00 AM" >12:00 AM</option>
										<option value="12:30 AM" >12:30 AM</option>
										<option value="1:00 AM" >1:00 AM</option>
										<option value="1:30 AM" >1:30 AM</option>
										<option value="2:00 AM" >2:00 AM</option>
										<option value="2:30 AM" >2:30 AM</option>
										<option value="3:00 AM" >3:00 AM</option>
										<option value="3:30 AM" >3:30 AM</option>
										<option value="4:00 AM" >4:00 AM</option>
										<option value="4:30 AM" >4:30 AM</option>
										<option value="5:00 AM" >5:00 AM</option>
										<option value="5:30 AM" >5:30 AM</option>
										<option value="6:00 AM" >6:00 AM</option>
										<option value="6:30 AM" >6:30 AM</option>
										<option value="7:00 AM" >7:00 AM</option>
										<option value="7:30 AM" >7:30 AM</option>
										<option value="8:00 AM" >8:00 AM</option>
										<option value="8:30 AM" >8:30 AM</option>
										<option value="9:00 AM" >9:00 AM</option>
										<option value="9:30 AM" >9:30 AM</option>
										<option value="10:00 AM" >10:00 AM</option>
										<option value="10:30 AM" >10:30 AM</option>
										<option value="11:00 AM" >11:00 AM</option>
										<option value="11:30 AM" >11:30 AM</option>
										<option value="12:00 AM" >12:00 PM</option>
										<option value="12:30 AM" >12:30 PM</option>
										<option value="1:00 PM" >1:00 PM</option>
										<option value="1:30 PM" >1:30 PM</option>
										<option value="1:30 PM" >1:30 PM</option>
										<option value="2:00 PM" >2:00 PM</option>
										<option value="2:30 PM" >2:30 PM</option>
										<option value="3:00 PM" >3:00 PM</option>
										<option value="3:30 PM" >3:30 PM</option>
										<option value="4:00 PM" >4:00 PM</option>
										<option value="4:30 PM" >4:30 PM</option>
										<option value="5:00 PM" >5:00 PM</option>
										<option value="5:30 PM" >5:30 PM</option>
										<option value="6:00 PM" >6:00 PM</option>
										<option value="6:30 PM" >6:30 PM</option>
										<option value="7:00 PM" >7:00 PM</option>
										<option value="7:30 PM" >7:30 PM</option>
										<option value="8:00 PM" >8:00 PM</option>
										<option value="8:30 PM" >8:30 PM</option>
										<option value="9:00 PM" >9:00 PM</option>
										<option value="9:30 PM" >9:30 PM</option>
										<option value="10:00 PM" >10:00 PM</option>
										<option value="10:30 PM" >10:30 PM</option>
										<option value="11:00 PM" >11:00 PM</option>
										<option value="11:30 PM" >11:30 PM</option>
								</select>
								
<!-- 								<div class="input-group"> -->
<!-- 									<input type="text" name="eta_time[]" class="form-control timepicker timepicker-no-seconds"> -->
<!-- 									<span class="input-group-btn"> -->
<!-- 										<button class="btn default" type="button"> -->
<!-- 											<i class="fa fa-clock-o"></i> -->
<!-- 										</button> -->
<!-- 									</span> -->
<!-- 								</div> -->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Class Flight</label>
								<select class="form-control select2" name="class_flight[]" id="classFlightSel" required style="display: inline">
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
							<div class="form-group" style="margin-bottom: 0px;">
								<label class="control-label">Flight No.</label>
								<input type="text" id="flight_from" name="flight_no[]" class="form-control" placeholder="">
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">VISA</label>
								<select class="form-control select2" name="is_visa" id="is_visa">
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