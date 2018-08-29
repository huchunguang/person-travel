<div class="modal fade" id="addNewLineModal" tabindex="-1" role="dialog" aria-labelledby="addNewLineModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Add New Line</h4>
			</div>
			<div class="modal-body">
				<form action="#" method="post" class="horizontal-form" id="demosticItineraryCreate">
					<input type="hidden" name="tr_id" value="" />
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
								<div style="position: relative;">
									<input type="text" name="datetime_date[]" class="form-control singleDatePicker" readonly>
									<i class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Time</label>
								<select class="form-control select2" id="datetime_time" name="datetime_time[]" style="width: 100%">
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
<!-- 									<input type="text" name="datetime_time[]" class="form-control timepicker timepicker-default time-input" placeholder=""> -->
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
								<label class="control-label">Location</label>
								<input type="text" name="location[]" class="form-control" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Customer Name</label>
								<input type="text" name="customer_name[]" class="form-control" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Contact Name</label>
								<input type="text" name="contact_name[]" class="form-control" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Purpose of Visit Category</label>
								<select class="form-control" name="purpose_id[]" id="purpose_id">
									@foreach ($purposeCats as $item)
									<option value="{{ $item['purpose_id'] }}">{{$item['purpose_catgory'] }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Purpose of Visit Description</label>
								<textarea id="purpose_desc" name="purpose_desc[]" class="form-control leave-control" style="overflow-y: scroll;" rows="1"></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Estimated Travel Cost</label>
								<input type="text" name="travel_cost[]" value="0.00" class="form-control input-number admin-non-edit" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Estimated Entertainment Cost</label>
								<input type="text" name="entertain_cost[]" value="0.00" class="form-control input-number" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Estimated Details</label>
								<input type="text" name="entertain_detail[]" class="form-control" />
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="addNewLine()">Save</button>
			</div>
		</div>
	</div>
</div>