@extends("etravel.layout.main")
@section("content")
<div class="page-content-inner">
	<form role="form" action="" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box green">
					<div class="portlet-title">
						<h4>Demostic Etravel Request</h4>
					</div>
					<div class="portlet-body form">
						<div class="form-body">
							<div class="row">
								<div class="form-group col-md-6 " style="margin-top: 20px;">
									<label for="TravellerName"
										class="control-label col-md-4 text-right">NAME OF TRAVELLER:</label>
									<div class="col-md-7">
										<div id="TravellerName">
											<span class="label label-default label-lg">{{ $userProfile['FirstName'] }}</span>
										</div>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label for="LeaveDate"
										class="control-label col-md-4 text-right">SITE:</label>
									<div class="col-md-7">
										<select id="Site" name="Site" disabled=""
											class="cboSelect2 leave-control form-control" tabindex="-1">
											<option value="0">&lt;&nbsp;{{ $userProfile['site']['Site'] }}&nbsp;&gt;</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="CostCenter" style="padding-right: 0px;"
										class="control-label col-md-4 text-right">Cost Center:</label>
									<div class="col-md-7">
										<select id="CostCenter" name="CostCenter" disabled=""
											class="cboSelect2 leave-control form-control" tabindex="-1">
											<option value="0">&lt;&nbsp;{{ $userProfile['costcenter']['CostCenterCode'] }}&nbsp;&gt;</option>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label for="Department" style="padding-right: 0px;"
										class="control-label col-md-4 text-right">Department:</label>
									<div class="col-md-7">
										<select id="Department" name="Department" disabled=""
											class="cboSelect2 leave-control form-control" tabindex="-1">
											<option value="0">&lt;&nbsp;{{ $userProfile['department']['Department'] }}&nbsp;&gt;</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
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
											<th class="text-center">Date</th>
											<th class="text-center">Time</th>
											<th class="text-center">Location</th>
											<th class="text-center">Customer Name</th>
											<th class="text-center">Purpose of Visit Category</th>
											<th class="text-center">Purpose of Visit Description</th>
											<th class="text-center">Estimated Travel Cost JPY</th>
											<th class="text-center">Estimated Entertainment Cost JPY</th>
											<th class="text-center">Estimated Details</th>
											<th class="text-center">Approved?</th>


										</tr>
									</thead>
									<tbody>
										<tr id="trOne">
											<td><div style="position: relative;">
													<input type="text" id=""
														class="form-control singleDatePicker"> <i
														class="glyphicon glyphicon-calendar fa fa-calendar"
														style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>

												</div></td>
											<td>
												<div class="input-group">
													<input type="text" id="startTime" readonly="readonly"
														class="form-control timepicker timepicker-default time-input"
														placeholder=""> <span class="input-group-btn">
														<button class="btn default" type="button">
															<i class="fa fa-clock-o"></i>
														</button>
													</span>
												</div>
											</td>
											<td>JPY:0</td>
											<td>JPY:0</td>
											<td>JPY:0</td>
											<td><select class="form-control">
													<option>study</option>
													<option>like trip</option>

											</select></td>
											<td>placeholder</td>
											<td>placeholder</td>
											<td>placeholder</td>
											<td><select class="form-control">
													<option>YES</option>
													<option>NO</option>
											</select></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="ApprovesComment" class="control-label col-xs-2"><strong>Extras
										Comments</strong></label>
								<textarea id="ApprovesComment" name="ApprovesComment"
									class="form-control leave-control" style="overflow-y: scroll;"
									rows="2"></textarea>
							</div>
						</div>
						<div class="row">

							<div class="form-group col-md-6">
								<label for="DepartmentApprover" style="padding-right: 0px;"
									class="control-label col-md-4 text-right">Department Approver:</label>
								<div class="col-md-7">
									<select id="DepartmentApprover" name="DepartmentApprover"
										class="cboSelect2 leave-control form-control" tabindex="-1">
											@foreach ($approvers as $item)
												<option value="{{ $item['UserID'] }}">&lt;&nbsp;{{ $item['FirstName'] }}&nbsp;&gt;</option>
											@endforeach
									</select>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>

</div>

</div>
</form>
</div>
@endsection
