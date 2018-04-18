@extends("etravel.layout.main") @section("content")
<div class="page-content-inner">
	@include('etravel.layout.error')
	<form action="#" class="form-horizontal">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="row inbox">
			<div class="col-md-12">
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption font-red-sunglo">
							<i class="glyphicon glyphicon-plus"></i> <span
								class="caption-subject font-dark sbold uppercase">DEMOSTIC
								REQUEST</span>
						</div>
					</div>
					<div class="portlet-body form">
						<div class="form-body">
							<div class="alert alert-danger display-hide">
								<button class="close" data-close="alert"></button>
								You have some form errors. Please check below.
							</div>
							<div class="alert alert-success display-hide">
								<button class="close" data-close="alert"></button>
								Your form validation is successful!
							</div>
							<div class="row">
								<div class="form-group col-md-6 " style="margin-top: 20px;">
									<label for="TravellerName"
										class="control-label col-md-4 text-right">Name Of Traveller:</label>
									<div class="col-md-7">
										<div id="TravellerName">
											<span class="label label-default label-lg">{{
												$userProfile['FirstName'] }}</span>
										</div>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label for="LeaveDate"
										class="control-label col-md-4 text-right">SITE:</label>
									<div class="col-md-7">
										<select id="Site" name="Site" disabled=""
											class="cboSelect2 leave-control form-control" tabindex="-1">
											<option value="0">&lt;&nbsp;{{ $userProfile['site']['Site']
												}}&nbsp;&gt;</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="CostCenter" style="padding-right: 0px;"
										class="control-label col-md-4 text-right">Cost Center:</label>
									<div class="col-md-7">
										<select name="cost_center_id"
											class="cboSelect2 leave-control form-control" tabindex="-1">
											@foreach($costCenters as $costItem)
											<option value="{{ $costItem['CostCenterID'] }}">&lt;&nbsp;{{
												$costItem['CostCenterCode'] }}&nbsp;&gt;</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group col-md-6">
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
									<label for="TravelFrom" style="padding-right: 0px;"
										class="control-label col-md-4 text-right">Period of Travel
										From: <span class="required"> * </span>
									</label>
									<div class="col-md-4">
										<input type="text" name="daterange_from"
											class="form-control singleDatePicker"> <i
											class="glyphicon glyphicon-calendar fa fa-calendar"
											style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
									</div>
									<div class="col-md-4">
										<input type="text" name="daterange_to"
											class="form-control singleDatePicker"> <i
											class="glyphicon glyphicon-calendar fa fa-calendar"
											style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
									</div>
								</div>
							</div>
							<hr class="divider" />

							<div class="row">
								<div class="col-md-6 col-md-offset-1">
									<button id="addLineItem" type="button" class="btn btn-default">
										<i class="glyphicon glyphicon-new-window"></i> Add Line Item
									</button>
								</div>
							</div>

							<div class="row">
								<div class="form-group col-md-6">
									<label for="LeaveApplicantDepartment"
										style="padding-right: 0px;"
										class="control-label col-md-4 text-right">REQUESTS LTINERARY:</label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10 col-md-offset-1">
									<table class="table table-bordered" id="requestTable">
										<thead>
											<tr class="info">
												<th class="text-center" class="col-md-1">Date</th>
												<th class="text-center" class="col-md-1">Time</th>
												<th class="text-center" class="col-md-1">Location</th>
												<th class="text-center" class="col-md-1">Customer Name</th>
												<th class="text-center" class="col-md-1">Contact Name</th>
												<th class="text-center" class="col-md-1">Purpose of Visit
													Category</th>
												<th class="text-center" class="col-md-1">Purpose of Visit
													Description</th>
												<th class="text-center" class="col-md-1">Estimated Travel
													Cost JPY</th>
												<th class="text-center" class="col-md-1">Estimated
													Entertainment Cost JPY</th>
												<th class="text-center" class="col-md-1">Estimated Details</th>
												<th class="text-center" class="col-md-1">Approved?</th>


											</tr>
										</thead>
										<tbody>
											<tr id="trOne">
												<td class="col-md-1">
													<div style="position: relative;">
														<input type="text" name="datetime_date[]"
															class="form-control singleDatePicker"> <i
															class="glyphicon glyphicon-calendar fa fa-calendar"
															style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
													</div>
												</td>
												<td class="col-md-2">
													<div class="input-group">
														<input type="text" readonly="readonly"
															name="datetime_time[]"
															class="form-control timepicker timepicker-default time-input"
															placeholder=""> <span class="input-group-btn">
															<button class="btn default" type="button">
																<i class="fa fa-clock-o"></i>
															</button>
														</span>
													</div>
												</td>
												<td class="col-md-1"><input type="text" name="location[]"
													id="" style="width: 70px;" /></td>
												<td class="col-md-1"><input type="text"
													name="customer_name[]" id="" style="width: 70px;" /></td>
												<td class="col-md-1"><input type="text"
													name="contact_name[]" id="" style="width: 70px;" /></td>
												<td class="col-md-1"><select class="form-control"
													name="purpose_cat[]"> @foreach ($purposeCats as $item)
														<option value="{{ $item['purposeId'] }}">&lt;&nbsp;{{
															$item['purpose_catgory'] }}&nbsp;&gt;</option>
														@endforeach
												</select></td>
												<td class="col-md-1"><input type="text"
													name="purpose_desc[]" style="width: 120px;" /></td>
												<td class="col-md-1"><input type="text" name="travel_cost[]"
													placeholder="0.00" style="width: 60px;" /></td>
												<td class="col-md-1"><input type="text"
													name="entertain_cost[]" placeholder="0.00"
													style="width: 60px;" /></td>
												<td class="col-md-1"><input type="text"
													name="entertain_detail[]" style="width: 60px;" /></td>
												<td class="col-md-1"><select class="form-control"
													name="is_approved[]">
														<option value="1">YES</option>
														<option value="0">NO</option>
												</select></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-10 col-md-offset-1">
									<label for="extra_comment" class="control-label "> Extras
										Comments </label>
									<textarea name="extra_comment"
										class="form-control leave-control" style="overflow-y: scroll;"
										rows="2"></textarea>
								</div>
							</div>
							<div class="row">

								<div class="form-group col-md-6">
									<label for="DepartmentApprover" style="padding-right: 0px;"
										class="control-label col-md-4 text-right">Department Approver:</label>
									<div class="col-md-7">
										<select name="department_approver"
											class="cboSelect2 leave-control form-control" tabindex="-1">
											@foreach ($approvers as $item)
											<option value="{{ $item['UserID'] }}">&lt;&nbsp;{{
												$item['FirstName'] }}&nbsp;&gt;</option> @endforeach
										</select>
									</div>
								</div>

							</div>
							<div class="row">
								<div class="form-group col-md-10 col-md-offset-1">
									<label for="approver_comment" class="control-label"> Approvers
										Comment </label>
									<textarea name="approver_comment"
										class="form-control leave-control" style="overflow-y: scroll;"
										rows="2"></textarea>
								</div>
							</div>
							<div class="row form-actions text-right">
								<div id="btnLeaveControl">
									<button type="submit" accesskey="D" class="btn green">
										<i class="glyphicon glyphicon-new-window"></i> Submit
									</button>
									<button type="button" accesskey="P" class="btn btn-primary"
										disabled="">
										<i class="glyphicon glyphicon-retweet"></i>Draft
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	
                        <div class="col-md-12">
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bubble font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">Validation Using Icons</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->
                                    <form action="#" id="form_sample_2" class="form-horizontal">
                                    
                                        <div class="form-body">
                                        		<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                            
                                            <div class="row">
								<div class="form-group col-md-6 " style="margin-top: 20px;">
									<label for="TravellerName"
										class="control-label col-md-4 text-right">Name Of Traveller:</label>
									<div class="col-md-7">
										<div id="TravellerName">
											<span class="label label-default label-lg">{{
												$userProfile['FirstName'] }}</span>
										</div>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label for="LeaveDate"
										class="control-label col-md-4 text-right">SITE:</label>
									<div class="col-md-7">
										<select id="Site" name="Site" disabled=""
											class="cboSelect2 leave-control form-control" tabindex="-1">
											<option value="0">&lt;&nbsp;{{ $userProfile['site']['Site']
												}}&nbsp;&gt;</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="CostCenter" style="padding-right: 0px;"
										class="control-label col-md-4 text-right">Cost Center:</label>
									<div class="col-md-7">
										<select name="cost_center_id"
											class="cboSelect2 leave-control form-control" tabindex="-1">
											@foreach($costCenters as $costItem)
											<option value="{{ $costItem['CostCenterID'] }}">&lt;&nbsp;{{
												$costItem['CostCenterCode'] }}&nbsp;&gt;</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group col-md-6">
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
									<label for="TravelFrom" style="padding-right: 0px;"
										class="control-label col-md-4 text-right">Period of Travel
										From: <span class="required"> * </span>
									</label>
									<div class="col-md-4">
										<input type="text" name="daterange_from"
											class="form-control singleDatePicker"> <i
											class="glyphicon glyphicon-calendar fa fa-calendar"
											style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
									</div>
									<div class="col-md-4">
										<input type="text" name="daterange_to"
											class="form-control singleDatePicker"> <i
											class="glyphicon glyphicon-calendar fa fa-calendar"
											style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
									</div>
								</div>
							</div>
							<hr class="divider" />

							<div class="row">
								<div class="col-md-6 col-md-offset-1">
									<button id="addLineItem" type="button" class="btn btn-default">
										<i class="glyphicon glyphicon-new-window"></i> Add Line Item
									</button>
								</div>
							</div>

							<div class="row">
								<div class="form-group col-md-6">
									<label for="LeaveApplicantDepartment"
										style="padding-right: 0px;"
										class="control-label col-md-4 text-right">REQUESTS LTINERARY:</label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10 col-md-offset-1">
									<table class="table table-bordered" id="requestTable">
										<thead>
											<tr class="info">
												<th class="text-center" class="col-md-1">Date</th>
												<th class="text-center" class="col-md-1">Time</th>
												<th class="text-center" class="col-md-1">Location</th>
												<th class="text-center" class="col-md-1">Customer Name</th>
												<th class="text-center" class="col-md-1">Contact Name</th>
												<th class="text-center" class="col-md-1">Purpose of Visit
													Category</th>
												<th class="text-center" class="col-md-1">Purpose of Visit
													Description</th>
												<th class="text-center" class="col-md-1">Estimated Travel
													Cost JPY</th>
												<th class="text-center" class="col-md-1">Estimated
													Entertainment Cost JPY</th>
												<th class="text-center" class="col-md-1">Estimated Details</th>
												<th class="text-center" class="col-md-1">Approved?</th>


											</tr>
										</thead>
										<tbody>
											<tr id="trOne">
												<td class="col-md-1">
													<div style="position: relative;">
														<input type="text" name="datetime_date[]"
															class="form-control singleDatePicker"> <i
															class="glyphicon glyphicon-calendar fa fa-calendar"
															style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
													</div>
												</td>
												<td class="col-md-2">
													<div class="input-group">
														<input type="text" readonly="readonly"
															name="datetime_time[]"
															class="form-control timepicker timepicker-default time-input"
															placeholder=""> <span class="input-group-btn">
															<button class="btn default" type="button">
																<i class="fa fa-clock-o"></i>
															</button>
														</span>
													</div>
												</td>
												<td class="col-md-1"><input type="text" name="location[]"
													id="" style="width: 70px;" /></td>
												<td class="col-md-1">
													<input type="text" name="customer_name[]" id="" style="width: 70px;" />
												</td>
												<td class="col-md-1"><input type="text"
													name="contact_name[]" id="" style="width: 70px;" /></td>
												<td class="col-md-1"><select class="form-control"
													name="purpose_cat[]"> @foreach ($purposeCats as $item)
														<option value="{{ $item['purposeId'] }}">&lt;&nbsp;{{
															$item['purpose_catgory'] }}&nbsp;&gt;</option>
														@endforeach
												</select></td>
												<td class="col-md-1"><input type="text"
													name="purpose_desc[]" style="width: 120px;" /></td>
												<td class="col-md-1"><input type="text" name="travel_cost[]"
													placeholder="0.00" style="width: 60px;" /></td>
												<td class="col-md-1"><input type="text"
													name="entertain_cost[]" placeholder="0.00"
													style="width: 60px;" /></td>
												<td class="col-md-1"><input type="text"
													name="entertain_detail[]" style="width: 60px;" /></td>
												<td class="col-md-1"><select class="form-control"
													name="is_approved[]">
														<option value="1">YES</option>
														<option value="0">NO</option>
												</select></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-10 col-md-push-1">
									<label for="extra_comment" class="control-label "> Extras
										Comments <span class="required" aria-required="true"> * </span>
										</label>
										<div class="input-icon right">
                                                        <i class="fa"></i>
									<textarea name="extra_comment"
										class="form-control" style="overflow-y: scroll;"
										rows="2"></textarea>
										</div>
								</div>
								
								
							</div>
						
							<div class="row">

								<div class="form-group col-md-6">
									<label for="DepartmentApprover" style="padding-right: 0px;"
										class="control-label col-md-4 text-right">Department Approver:</label>
									<div class="col-md-7">
										<select name="department_approver"
											class="cboSelect2 leave-control form-control" tabindex="-1">
											@foreach ($approvers as $item)
											<option value="{{ $item['UserID'] }}">&lt;&nbsp;{{
												$item['FirstName'] }}&nbsp;&gt;</option> @endforeach
										</select>
									</div>
								</div>

							</div>
							<div class="row">
								<div class="form-group col-md-10 col-md-push-1">
									<label for="approver_comment" class="control-label"> Approvers
										Comment
										<span class="required" aria-required="true"> * </span> 
										</label>
									<textarea name="approver_comment"
										class="form-control leave-control" style="overflow-y: scroll;"
										rows="2"></textarea>
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
