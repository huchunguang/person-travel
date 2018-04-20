@extends("etravel.layout.main") @section("content")
<div class="page-content-inner">
	@include('etravel.layout.error')
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light portlet-fit portlet-form ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bubble font-green"></i> <span
						class="caption-subject font-green bold uppercase">INTERNATIONAL REQUEST</span>
				</div>
			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				<form action="/etravel/trip/store" method="post"
					class="form-horizontal">

					<div class="form-body">

						<div class="row">
							<div class="form-group col-md-6 " style="margin-top: 20px;">
								<label for="TravellerName"
									class="control-label col-md-4 text-right">NAME OF TRAVELLER:</label>
								<div class="col-md-7">
									<div id="TravellerName">
										<span class="label label-default label-lg">{{
											$userProfile['FirstName'] }}</span>
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="LeaveDate" class="control-label col-md-4 text-right">SITE:</label>
								<div class="col-md-7">
									<select id="Site" name="Site" disabled=""
										class="cboSelect2 leave-control form-control" tabindex="-1">
										<option value="0">&lt;&nbsp;{{ $userProfile['site']['Site']
											}}&nbsp;&gt;</option>
									</select>
								</div>
								<label for="Department" style="padding-right: 0px;"
									class="control-label col-md-4 text-right">Department:</label>
								<div class="col-md-7">
									<select id="Department" name="Department" disabled=""
										class="cboSelect2 leave-control form-control" tabindex="-1">
										<option value="0">&lt;&nbsp;{{
											$userProfile['department']['Department'] }}&nbsp;&gt;</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="Destinations" style="padding-right: 0px;"
									class="control-label col-md-4 text-right">Destinations:</label>
								<div class="col-md-7">
									<select id="Destinations" name="Destinations"
										class="cboSelect2 leave-control form-control" tabindex="-1">
										<option value="0">&lt;&nbsp;shanghai&nbsp;&gt;</option>
									</select>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="CostCenter" style="padding-right: 0px;"
									class="control-label col-md-4 text-right">Cost Center:</label>
								<div class="col-md-7">
									<select id="CostCenter" name="CostCenter"
										class="cboSelect2 leave-control form-control" tabindex="-1">
										<option value="0">&lt;&nbsp;{{
											$userProfile['costcenter']['CostCenterCode'] }}&nbsp;&gt;</option>
									</select>
								</div>
								<label for="TravelFrom" style="padding-right: 0px;"
									class="control-label col-md-4 text-right">Period of Travel
									From:</label>
								<div class="col-md-7">
									<div class="input-group">
										<button type="button" class="btn btn-default pull-right"
											id="daterange-btn">
											<span>Pick Range Date<i class="fa fa-calendar"></i></span> <i
												class="fa fa-caret-down"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="LeaveRecipientCompanyCode"
									class="control-label col-md-4 text-right"
									style="padding-right: 0px;">Department Approver:</label>
								<div class="col-md-7">
									<select id="CostCenter" name="CostCenter"
										class="cboSelect2 leave-control form-control" tabindex="-1">
										<option value="0">&lt;&nbsp;ASCO&nbsp;&gt;</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="LeaveApplicantDepartment"
									style="padding-right: 0px;"
									class="control-label col-md-4 text-right">Overseas Approver:</label>
								<div class="col-md-7">
									<select id="CostCenter" name="CostCenter"
										class="cboSelect2 leave-control form-control" tabindex="-1">
										<option value="0">&lt;&nbsp;ASCO&nbsp;&gt;</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-10 col-md-push-1">
								<label for="ApprovesComment" class="control-label col-xs-2"><strong>Approves
										Comment</strong></label>
								<textarea id="ApprovesComment" name="ApprovesComment"
									class="form-control leave-control" style="overflow-y: scroll;"
									rows="2"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-gift"></i> PURPOSE OF TRAVEL
									</div>
									<div class="tools">
										<a href="" class="collapse" data-original-title="" title=""> </a>
									</div>
								</div>
								<div class="portlet-body form">

									<div class="form-group col-md-6">
										<label for="LeaveApplicantDepartment"
											style="padding-right: 0px;"
											class="control-label col-md-4 text-right">PURPOSE OF TRAVEL:</label>
										<div class="col-md-7">
											<select id="CostCenter" name="CostCenter"
												class="cboSelect2 leave-control form-control" tabindex="-1">
												<option value="0">&lt;&nbsp;others&nbsp;&gt;</option>
											</select>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div class="row">

							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-gift"></i> PRE-APPROVAL PURCHASE/REQUEST(RENT)
									</div>
									<div class="tools">
										<a href="" class="collapse" data-original-title="" title=""> </a>
									</div>
								</div>
								<div class="portlet-body form">

									<div class="form-group col-md-6">

										<label for="LeaveApplicantDepartment"
											style="padding-right: 0px;"
											class="control-label col-md-4 text-right">PRE-APPROVAL
											PURCHASE/REQUEST(RENT):</label>
										<div class="col-md-7">
											<select id="CostCenter" name="CostCenter"
												class="cboSelect2 leave-control form-control" tabindex="-1">
												<option value="0">&lt;&nbsp;visa&nbsp;&gt;</option>
											</select>
										</div>

									</div>

								</div>
							</div>

						</div>
						<div class="row">


							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-gift"></i> FLIGHT ITINERARY
									</div>
									<div class="tools">
										<a href="" class="collapse" data-original-title="" title=""> </a>
									</div>
								</div>
								<div class="portlet-body form">
									<div class="col-md-10 col-md-offset-1">
										<ul class="list-group">
											<li class="list-group-item">Notification to be sent
												generalaffairs?: <input type="radio" name="NitifyYes"
												id="NitifyYes" />&nbsp;&nbsp;YES&nbsp;&nbsp;&nbsp;&nbsp; <input
												type="radio" name="NitifyNo" id="NitifyNo" />&nbsp;&nbsp;NO
											</li>
											<li class="list-group-item"><label> Ticket Booker?: <input
													type="checkbox" value="1" name="IsTicketBooker"> France
													Travel
											</label></li>
											<li class="list-group-item">
												<div class="row">
													<div class="form-group col-md-1">
														<label for="LeaveApplicantDepartment"
															style="padding-right: 0px;"
															class="control-label col-md-1 text-left">CC:</label>
													</div>
													<div class="form-group col-md-4">
														<select class="form-control" style="display: inline;">
															<option>1</option>
															<option>2</option>
															<option>3</option>
															<option>4</option>
															<option>5</option>
														</select>
													</div>
												</div>

											</li>
										</ul>
									</div>

									<div class="col-md-10 col-md-offset-1">
										<table class="table table-bordered ">
											<thead>
												<tr>
													<th class="text-center text-danger">Date</th>
													<th class="text-center text-danger">From</th>
													<th class="text-center text-danger">To</th>
													<th class="text-center text-danger">Airline/Train</th>
													<th class="text-center text-danger">ETD</th>
													<th class="text-center text-danger">ETA</th>
													<th class="text-center text-danger">Class Fight</th>
													<th class="text-center text-danger">Visa?</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>表格单元格</td>
													<td>表格单元格</td>
													<td>表格单元格</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-gift"></i> ESTIMATED EXPENSES
									</div>
									<div class="tools">
										<a href="" class="collapse" data-original-title="" title=""> </a>
									</div>
								</div>
								<div class="portlet-body form">
									<div class="col-md-10 col-md-offset-1">
										<table class="table table-bordered">
											<thead>
												<tr class="info">
													<th class="text-center"></th>
													<th class="text-center">Employee Annual Budget</th>
													<th class="text-center">Employee YTD Expenses</th>
													<th class="text-center">Available Amount</th>
													<th class="text-center">Required Amount</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Overseas Travel</td>
													<td>JPY:0</td>
													<td>JPY:0</td>
													<td>JPY:0</td>
													<td>JPY:0</td>
												</tr>
												<tr>
													<td>Entertainment</td>
													<td>JPY:0</td>
													<td>JPY:0</td>
													<td>JPY:0</td>
													<td>JPY:0</td>
												</tr>
											</tbody>
										</table>
									</div>


								</div>
							</div>
						</div>
						<div class="row">
							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-gift"></i> HOTEL ACCOMODATION
									</div>
									<div class="tools">
										<a href="" class="collapse" data-original-title="" title=""> </a>
									</div>
								</div>
								<div class="portlet-body form">


									<div class="col-md-10 col-md-offset-1">
										<ul class="list-group">
											<li class="list-group-item">
												<div class="row">
													<div class="form-group col-md-4">
														<label for="LeaveApplicantDepartment"
															style="padding-right: 0px;"
															class="control-label text-left">Select address from the
															list to inform Rep. office:</label>
													</div>
													<div class="form-group col-md-4">
														<select class="form-control" style="display: inline;">
															<option>1</option>
															<option>2</option>
															<option>3</option>
															<option>4</option>
															<option>5</option>
														</select>
													</div>
												</div>


											</li>
											<li class="list-group-item">
												<p>
													<label> User Preference:</label>
												</p> 
												
												<div class="form-group">
													
                                                                    <label>Inline Radios</label>
                                                                    <div class="input-group">
                                                                        <div class="icheck-inline">
                                                                            <label>
                                                                                <input type="radio" name="radio2" class="icheck"> Radio Button 1 </label>
                                                                            <label>
                                                                                <input type="radio" name="radio2" checked class="icheck"> Radio Button 2 </label>
                                                                            <label>
                                                                                <input type="radio" name="radio2" class="icheck"> Radio Button 3 </label>
                                                                        </div>
                                                                    </div>
                                                                
												</div>													
												
												<label for="" class="text-right">Room Type: </label> 
												<input type="radio" value="1" name="RoomType">Double 
												<input type="radio" value="2" name="RoomType">King 
												<input type="radio" value="3" name="RoomType">Suite 
												<input type="radio" value="4" name="RoomType">Standrd <br /> 
												
												<label for="" class="text-right">Smoking?: </label> 
												<input type="radio" value="1" name="Smoking">Double 
												<input type="radio" value="2" name="Smoking">King 
												<input type="radio" value="3" name="Smoking">Suite 
												<input type="radio" value="4" name="Smoking">Standrd <br />
												<div class="row">
													<div class="form-group col-md-1">
														<label for="LeaveApplicantDepartment"
															style="padding-right: 0px;"
															class="control-label text-left">Food:</label>
													</div>
													<div class="form-group col-md-4">
														<select class="form-control" style="display: inline;">
															<option>1</option>
															<option>2</option>
															<option>3</option>
															<option>4</option>
															<option>5</option>
														</select>
													</div>
												</div>
											</li>
										</ul>
									</div>

									<div class="col-md-10 col-md-offset-1">
										<table class="table table-bordered">
											<thead>
												<tr class="info">
													<th class="text-center">Hotel Name</th>
													<th class="text-center">Check-in Date</th>
													<th class="text-center">Check-out Date</th>
													<th class="text-center">Rate</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1:Hotel Name</td>
													<td>
														<div class="col-md-4 col-md-offset-2"
															style="position: relative;">
															<input type="text" id=""
																class="form-control singleDatePicker"> <i
																class="glyphicon glyphicon-calendar fa fa-calendar"
																style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>

														</div>
													</td>
													<td>
														<div class="col-md-4 col-md-offset-2"
															style="position: relative;">
															<input type="text" id=""
																class="form-control singleDatePicker"> <i
																class="glyphicon glyphicon-calendar fa fa-calendar"
																style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>

														</div>
													</td>
													<td>JPY:0</td>
												</tr>
												<tr>
													<td>2:Hotel Name</td>
													<td>
														<div class="col-md-4 col-md-offset-2"
															style="position: relative;">
															<input type="text" id=""
																class="form-control singleDatePicker"> <i
																class="glyphicon glyphicon-calendar fa fa-calendar"
																style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>

														</div>
													</td>
													<td>
														<div class="col-md-4 col-md-offset-2"
															style="position: relative;">
															<input type="text" id=""
																class="form-control singleDatePicker"> <i
																class="glyphicon glyphicon-calendar fa fa-calendar"
																style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>

														</div>
													</td>
													<td>JPY:0</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-gift"></i> Extras Comments
									</div>
									<div class="tools">
										<a href="" class="collapse" data-original-title="" title=""> </a>
									</div>
								</div>
								<div class="portlet-body form">
									<textarea id="ApprovesComment" name="ApprovesComment"
										class="form-control leave-control" style="overflow-y: scroll;"
										rows="2"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button type="submit" class="btn green">Submit</button>
								<button type="button" class="btn default">Cancel</button>
							</div>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END VALIDATION STATES-->
	</div>
</div>
@endsection













