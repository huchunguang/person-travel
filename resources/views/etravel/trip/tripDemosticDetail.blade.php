@extends("etravel.layout.main") @section("content")
<div class="container">

<div class="page-content-inner">
<form action="" method="post" class="form-horizontal">
<div class="row">
	<div class="col-md-12">
		
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light portlet-fit portlet-form ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bubble font-green"></i> <span
						class="caption-subject font-green bold uppercase">DEMOSTIC REQUEST DETAIL</span>
				</div>
			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
					<div class="form-body">
						<div class="row">
							<div class="form-group col-md-6 " style="margin-top: 20px;">
								<label for="TravellerName"
									class="control-label col-md-4 text-right">Name Of Traveller:</label>
								<div class="col-md-7">
									<div id="TravellerName">
										<span class="label label-default label-lg">{{ $userObjMdl->FirstName }}</span>
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="LeaveDate" class="control-label col-md-4 text-right">SITE:</label>
								<div class="col-md-7">
									<select id="Site" name="Site" disabled=""
										class="cboSelect2 leave-control form-control" tabindex="-1">
										<option value="0">&lt;&nbsp;{{ $userObjMdl->site()->first()['Site'] }}&nbsp;&gt;</option>
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
										class="cboSelect2 leave-control form-control" tabindex="-1" disabled>
										<option >&lt;&nbsp;{{ $costCenterCode }}&nbsp;&gt;</option>
									</select>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="Department" style="padding-right: 0px;"
									class="control-label col-md-4 text-right">Department:</label>
								<div class="col-md-7">
									<select id="Department" name="Department" disabled=""
										class="cboSelect2 leave-control form-control" tabindex="-1">
										<option value="0">&lt;&nbsp;{{ $userObjMdl->department()->first()['Department']}}&nbsp;&gt;</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="TravelFrom" style="padding-right: 0px;"
									class="control-label col-md-4 text-right">Period of Travel
									From:
								</label>
								<div class="col-md-4">
									<input type="text" name="daterange_from" disabled
										class="form-control singleDatePicker"  value="{{ $trip->daterange_from }}"> <i
										class="glyphicon glyphicon-calendar fa fa-calendar"
										style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
								</div>
								<div class="col-md-4">
									<input type="text" name="daterange_to" disabled
										class="form-control singleDatePicker" value="{{ $trip->daterange_to }}"> <i
										class="glyphicon glyphicon-calendar fa fa-calendar"
										style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
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
												{{ $item->visitPurpose()->first()['purpose_catgory'] }}
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
													@if($item['is_approved'] == '1')
													YES
													@elseif($item['is_approved'] == '0')
													NO
													@endif
											</td>
										</tr>
									@endforeach
									
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-10 col-md-push-1">
								<label for="extra_comment" class="control-label "> Extras
									Comments 
								</label>
								<div class="input-icon right">
									<i class="fa"></i>
									<textarea name="extra_comment" class="form-control" disabled
										style="overflow-y: scroll;" rows="2">{{ $trip->extra_comment }}</textarea>
								</div>
							</div>


						</div>

						<div class="row">

							<div class="form-group col-md-6">
								<label for="DepartmentApprover" style="padding-right: 0px;"
									class="control-label col-md-4 text-right">Department Approver:</label>
								<div class="col-md-7">
									<select name="department_approver" disabled
										class="cboSelect2 leave-control form-control" tabindex="-1">
										<option value="">&lt;&nbsp;{{ $approver->FirstName }}&nbsp;&gt;</option> 
									</select>
								</div>
							</div>

						</div>
						<div class="row">
							<div class="form-group col-md-10 col-md-push-1">
								<label for="approver_comment" class="control-label"> Approvers
									Comment 
								</label>
								<textarea name="approver_comment"
									class="form-control leave-control" style="overflow-y: scroll;" disabled
									rows="2">{{ $trip->approver_comment }}</textarea>
							</div>
						</div>

					</div>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END VALIDATION STATES-->
	</div>
	</div>
					</form>
	
</div>
</div>
@endsection