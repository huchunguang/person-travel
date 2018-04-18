@extends("etravel.layout.main")
@section("content")
<div class="page-content-inner">
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
											<span class="label label-default label-lg">{{ Auth::user()->FirstName }}</span>
										</div>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label for="LeaveDate"
										class="control-label col-md-4 text-right">SITE:</label>
									<div class="col-md-7">
										<select id="Site" name="Site" disabled=""
											class="cboSelect2 leave-control form-control" tabindex="-1">
											<option value="0">&lt;&nbsp;{{ Auth::user()->site()->first()['Site'] }}&nbsp;&gt;</option>
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
											<option value="0">&lt;&nbsp;{{ $costCenterCode }}&nbsp;&gt;</option>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label for="Department" style="padding-right: 0px;"
										class="control-label col-md-4 text-right">Department:</label>
									<div class="col-md-7">
										<select id="Department" name="Department" disabled=""
											class="cboSelect2 leave-control form-control" tabindex="-1">
											<option value="0">&lt;&nbsp;{{ Auth::user()->department()->first()['Department'] }}&nbsp;&gt;</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="TravelFrom" style="padding-right: 0px;"
										class="control-label col-md-4 text-right">Period of Travel
										From:</label>
									<div class="col-md-4">
											<input type="text"  name="daterange_from" class="form-control singleDatePicker" value="{{ $trip['daterange_from'] }}"> 
											<i class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
									</div>
									<div class="col-md-4">
											<input type="text"  name="daterange_to" class="form-control singleDatePicker" value="{{ $trip['daterange_to'] }}"> 
											<i class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
									</div>
								</div>
							</div>
						</div>
						<hr class="divider" />
						

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
											<th class="text-center">Contact Name</th>
											<th class="text-center">Purpose of Visit Category</th>
											<th class="text-center">Purpose of Visit Description</th>
											<th class="text-center">Estimated Travel Cost JPY</th>
											<th class="text-center">Estimated Entertainment Cost JPY</th>
											<th class="text-center">Estimated Details</th>
											<th class="text-center">Approved?</th>


										</tr>
									</thead>
									<tbody>
									@foreach($demosticInfo as $item)
										<tr id="trOne">
											<td>
												{{ $item['datetime_date'] }}
											</td>
											<td>
												{{ $item['datetime_time'] }}
											</td>
											<td>{{ $item['location'] }}</td>
											<td>{{ $item['customer_name'] }}</td>
											<td>{{ $item['contact_name'] }}</td>
											<td>
												<select class="form-control" name="purpose_cat[]">
														<option value="{{ $item['purposeId'] }}">&lt;&nbsp;{{ $item['purpose_catgory'] }}&nbsp;&gt;</option>
												</select>
											</td>
											<td>
												{{ $item['purpose_desc'] }}
											</td>
											<td>
												{{ $item['travel_cost'] }}
											</td>
											<td>
												{{ $item['entertain_cost'] }}
											</td>
											<td>
												{{ $item['entertain_detail'] }}
											</td>
											<td>
												<select class="form-control" name="is_approved[]">
													@if($item['is_approved'] == '1')
													<option value="1">YES</option>
													@elseif($item['is_approved'] == '0')
													<option value="0">NO</option>
													@endif
												</select>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="extra_comment" class="control-label col-xs-2"><strong>Extras
										Comments</strong></label>
								<textarea name="extra_comment" disabled="" class="form-control leave-control" style="overflow-y: scroll;" rows="2">{{ $trip['extra_comment'] }}
								</textarea>
							</div>
						</div>
						<div class="row">

							<div class="form-group col-md-6">
								<label for="DepartmentApprover" style="padding-right: 0px;"
									class="control-label col-md-4 text-right">Department Approver:</label>
								<div class="col-md-7">
									<select name="department_approver"
										class="cboSelect2 leave-control form-control" tabindex="-1">
												<option value="{{ $item['UserID'] }}">&lt;&nbsp;TakeHeart&nbsp;&gt;</option>
									</select>
								</div>
							</div>

						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="approver_comment" class="control-label col-xs-2">
									<strong>Approvers Comment</strong>
								</label>
								<textarea name="approver_comment" disabled="" class="form-control leave-control" style="overflow-y: scroll;" rows="2">{{ $trip['extra_comment'] }}
								</textarea>
							</div>
						</div>
					</div>
					
				</div>

			</div>
		</div>

</div>

</div>
</div>
@endsection
