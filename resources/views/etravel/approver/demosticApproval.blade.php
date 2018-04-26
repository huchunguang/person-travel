@extends("etravel.layout.main") 
@section("content")

<div class="container">
	<div class="page-content-inner">
		<div class="row">
			
			@include('etravel.layout.approverAction')
			@include('etravel.layout.error')
			<div class="col-md-12">
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-bubble"></i> <span
								class="caption-subject bold uppercase">PENDING</span>
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
												placeholder="{{ $userObjMdl->FirstName }}">
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">SITE</label> <select id="Site"
												name="Site" disabled=""
												class="cboSelect2 leave-control form-control" tabindex="-1">
												<option value="0">&lt;&nbsp; {{ $userObjMdl->site()->first()['Site'] }}&nbsp;&gt;</option>
											</select>


										</div>
									</div>
									<!--/span-->
								</div>

								<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Cost Center</label> 
											<select name="cost_center_id" class="cboSelect2 leave-control form-control" tabindex="-1" >
												<option >&lt;&nbsp;{{ $costCenterCode }}&nbsp;&gt;</option>
											</select>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Department</label> 
											<select id="Department" name="Department" disabled="" class="cboSelect2 leave-control form-control" tabindex="-1">
												<option value="0">&lt;&nbsp;{{ $userObjMdl->department()->first()['Department']}}&nbsp;&gt;</option>
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
								</div>
								<hr class="divider" />


								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">LTINERARY</label>
										</div>
									</div>
								</div>

								<div class="row">
									<table  id="ltineraryTable" class="table table-bordered table-striped table-condensed flip-content">
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
								<div class="row">
									<div class="col-md-12 ">
										<div class="form-group">
											<label>Extra Comments</label>
											<textarea name="extra_comment" class="form-control" disabled
										style="overflow-y: scroll;" rows="2">{{ $trip->extra_comment }}</textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Department Approver</label> 
											<select name="department_approver" class="cboSelect2 leave-control form-control" tabindex="-1">
												<option value="">&lt;&nbsp;{{ $approver->FirstName }}&nbsp;&gt;</option> 
											</select>
										</div>
									</div>
								</div>

								<div class="row">

									<div class="col-md-12 ">
										<div class="form-group">
											<label>Approver Comments</label>
											<textarea name="approver_comment"
									class="form-control leave-control" style="overflow-y: scroll;" disabled
									rows="2">{{ $trip->approver_comment }}</textarea>
										</div>
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