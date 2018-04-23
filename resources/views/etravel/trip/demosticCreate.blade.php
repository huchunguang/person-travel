@extends("etravel.layout.main") @section("content")
<div class="container">
	<div class="page-content-inner">
		<div class="row">
			@include('etravel.layout.error')
			<div class="col-md-12">
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-bubble"></i> <span
								class="caption-subject bold uppercase">DEMOSTIC REQUEST</span>
						</div>
					</div>
					<div class="portlet-body form">
						<form action="/etravel/trip/store" method="post" class="horizontal-form">
							<div class="form-body">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">

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
											<label class="control-label">Name Of Traveller</label> <input
												disabled type="text" class="form-control"
												placeholder="{{ $userProfile['FirstName'] }}">
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">SITE</label> <select id="Site"
												name="Site" disabled=""
												class="cboSelect2 leave-control form-control" tabindex="-1">
												<option value="0">&lt;&nbsp;{{ $userProfile['site']['Site']
													}}&nbsp;&gt;</option>
											</select>


										</div>
									</div>
									<!--/span-->
								</div>

								<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Cost Center</label> <select
												name="cost_center_id"
												class="cboSelect2 leave-control form-control" tabindex="-1">
												@foreach($costCenters as $costItem)
												<option value="{{ $costItem['CostCenterID'] }}">&lt;&nbsp;{{
													$costItem['CostCenterCode'] }}&nbsp;&gt;</option>
												@endforeach
											</select>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Department</label> <select
												id="Department" name="Department" disabled=""
												class="cboSelect2 leave-control form-control" tabindex="-1">
												<option value="0">&lt;&nbsp;{{
													$userProfile['department']['Department'] }}&nbsp;&gt;</option>
											</select>


										</div>
									</div>
									<!--/span-->

								</div>

								<div class="row">
									<div class="col-md-6">

										<div class="form-group">
											<p>
												<label class="control-label">Period of Travel From</label>
											</p>

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
								</div>
								<hr class="divider" />

<!-- 								<div class="row"> -->
<!-- 									<div class="col-md-6"> -->
<!-- 										<div class="form-group"> -->
<!-- 											<label class="control-label"><button id="addLineItem" -->
<!-- 													type="button" class="btn btn-default"> -->
<!-- 													<i class="glyphicon glyphicon-new-window"></i> Add Line -->
<!-- 													Item -->
<!-- 												</button></label> -->
<!-- 										</div> -->
<!-- 									</div> -->
<!-- 								</div> -->
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<button data-target="addNewLineModal" type="button" class="btn btn-default">
													<i class="glyphicon glyphicon-plus-sign"></i> 
													Add Line Item
												</button>
											</label>
										</div>
									</div>
								</div>



								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">LTINERARY</label>
										</div>
									</div>
								</div>

								<div class="row">
									<table
										class="table table-bordered table-striped table-condensed flip-content"
										id="requestTable">
										<thead>
											<tr class="info">
												<td class="text-center" class="">Date</td>
												<td class="text-center" class="">Time</td>
												<td class="text-center" class="">Location</td>
												<td class="text-center" class="">Customer Name</td>
												<td class="text-center" class="">Contact Name</td>
												<td class="text-center" class="">Purpose of Visit Category</td>
												<td class="text-center" class="">Purpose of Visit
													Description</td>
												<td class="text-center" class="">Estimated Travel Cost</td>
												<td class="text-center" class="">Estimated Entertainment
													Cost</td>
												<td class="text-center" class="">Estimated Details</td>
												<td class="text-center" class="">Approved?</td>


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
													name="purpose_id[]"> @foreach ($purposeCats as $item)
														<option value="{{ $item['purpose_id'] }}">
															&lt;&nbsp;{{$item['purpose_catgory'] }}&nbsp;&gt;</option>
														@endforeach
												</select></td>
												<td class="col-md-1"><textarea name="purpose_desc[]"
														class="form-control leave-control"
														style="overflow-y: scroll;" rows="2"></textarea></td>
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
								<div class="row">
									<div class="col-md-12 ">
										<div class="form-group">
											<label>Extra Comments</label>
											<textarea name="extra_comment" class="form-control"
												style="overflow-y: scroll;" rows="2"></textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Department Approver</label> <select
												name="department_approver"
												class="cboSelect2 leave-control form-control" tabindex="-1">
												@foreach ($approvers as $item)
												<option value="{{ $item['UserID'] }}">&lt;&nbsp;{{
													$item['FirstName'] }}&nbsp;&gt;</option> @endforeach
											</select>
										</div>
									</div>
								</div>

								<div class="row">

									<div class="col-md-12 ">
										<div class="form-group">
											<label>Approver Comments</label>
											<textarea name="approver_comment"
												class="form-control leave-control"
												style="overflow-y: scroll;" rows="2"></textarea>
										</div>
									</div>

								</div>

							</div>
							<div class="form-actions right">
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

	</div>
</div>
@endsection






