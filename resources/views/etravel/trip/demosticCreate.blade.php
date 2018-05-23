@extends("etravel.layout.main") 
@section("content")
<div class="container">
	<div class="page-content-inner">
		<div class="row">
			<div class="col-md-12">
			@include('etravel.layout.error')
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-bubble"></i> 
							<span class="caption-subject bold uppercase">Business Domestic Itinerary Request</span>
						</div>
					</div>
					<div class="portlet-body form">
						<form action="/etravel/trip/store" method="post" class="horizontal-form" id="demosticTripCreate">
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
											<label class="control-label">Cost Center</label> 
											<select name="cost_center_id" class="form-control input-sm select2">
												@foreach($costCenters as $costItem)
												@if(old('cost_center_id') == $costItem['CostCenterID'] || $costItem['CostCenterID']==$defaultCostCenterID)
												<option value="{{ $costItem['CostCenterID'] }}" selected="selected">
												@else
												<option value="{{ $costItem['CostCenterID'] }}" >
												@endif
												{{$costItem['CostCenterCode'] }}
												</option>
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
											<p style="margin-bottom: 0px;">
												<label class="control-label">Period of Travel From</label>
											</p>

											<div class="col-md-6" style="margin-left: 0px;padding:0px;">
												<input type="text" name="daterange_from"
													class="form-control singleDatePicker"> <i
													class="glyphicon glyphicon-calendar fa fa-calendar"
													style="position: absolute; bottom: 10px; right: 10px; top: auto; cursor: pointer;"></i>
											</div>
											<div class="col-md-6" style="padding-right: 0px;">
												<input type="text" name="daterange_to" class="form-control singleDatePicker"> 
												<i class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; bottom: 10px; right: 10px; top: auto; cursor: pointer;"></i>
											</div>


										</div>

									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Project Code</label>
											<select id="project_code" name="project_code" class="form-control input-sm">
													<option value="">Select...</option>
												@foreach ($wbscodeList as $item)
													@if($item['wbs_id']==old('project_code'))
													<option value="{{$item['wbs_id']}}" selected="selected">{{$item['wbs_code']}}</option>
													@else
													<option value="{{$item['wbs_id']}}">{{$item['wbs_code']}}</option>
													@endif
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<hr class="divider" />

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<button data-target="#addNewLineModal" data-toggle="modal" type="button" class="btn btn-primary">
													<i class="glyphicon glyphicon-plus-sign"></i> 
													Add Line Item
												</button>
												<button id="itemEditBut" type="button" accesskey="I" onclick="editNewLine()" disabled class="btn yellow-gold leave-type-button">
									 				<i class="fa fa-pencil"></i> Ed<u>i</u>t
												</button>
												<button id="itemDelBut" type="button" class="btn red-mint" disabled onclick="delLineItem()">
													<i class="glyphicon glyphicon-remove-sign"></i> 
													Delete
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
									<div class="col-md-12">
										
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

											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								
									</div>
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
											<label class="control-label">Department Approver</label> 
											<select name="department_approver" class="form-control input-sm select2">
												@foreach ($approvers as $item)
												<option value="{{ $item['UserID'] }}">{{$item['LastName']}} {{$item['FirstName']}}</option> 
												@endforeach
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
												style="overflow-y: scroll;" rows="2" disabled></textarea>
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
@include('etravel.modal.newItinerary')
<script src="{{asset('js/etravel/trip/demosticFormValidate.js')}}"></script>
@endsection





