@extends("etravel.layout.main") @section("content")
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
											<label class="control-label">Applicant</label>
											<input disabled type="text" class="form-control" placeholder="{{ $userProfile['FirstName'] }} {{ $userProfile['LastName'] }}-{{ $userProfile['UserName'] }}">
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Request For</label>
											<select id="user_id" name="user_id" class="form-control select2">
												@foreach($userList as $user) @if($user['UserID']==Auth::user()->UserID)
												<option value="{{$user['UserID']}}" selected>{{$user['LastName']}} {{$user['FirstName']}}-{{ $userProfile['UserName'] }}</option>
												@else
												<option value="{{$user['UserID']}}">{{$user['LastName']}} {{$user['FirstName']}}-{{ $user['UserName'] }}</option>
												@endif @endforeach
											</select>
										</div>
									</div>
									<!--/span-->
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Site</label>
											<select id="Site" name="Site" class="select2 form-control" disabled>
												<option value="0">{{$userProfile['site']['Site']}}</option>
											</select>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Department</label>
											<select id="department_id" name="department_id" class="select2 form-control">
												@foreach($departmentList as $dep) @if($dep['DepartmentID']==Auth::user()->DepartmentID)
												<option value="{{$dep['DepartmentID']}}" selected>{{$dep['Department'] }}</option>
												@else
												<option value="{{$dep['DepartmentID']}}">{{$dep['Department'] }}</option>
												@endif @endforeach
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
											<div class="col-md-6" style="margin-left: 0px; padding: 0px;">
												<div class="input-group date date-picker" data-date-format="mm/dd/yyyy">
													<input type="text" class="form-control" name="daterange_from" value="{{old('daterange_from')}}" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button">
															<i class="fa fa-calendar"></i>
														</button>
													</span>
												</div>
											</div>
											<div class="col-md-6" style="padding-right: 0px;">
												<div class="input-group date date-picker" data-date-format="mm/dd/yyyy">
													<input type="text" class="form-control" name="daterange_to" value="{{old('daterange_to')}}" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button">
															<i class="fa fa-calendar"></i>
														</button>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Cost Center</label>
											<select name="cost_center_id" class="form-control input-sm select2">
												@foreach($costCenters as $costItem) @if(old('cost_center_id') == $costItem['CostCenterID'] || $costItem['CostCenterID']==$defaultCostCenterID)
												<option value="{{ $costItem['CostCenterID'] }}" selected="selected">@else
												
												
												<option value="{{ $costItem['CostCenterID'] }}">@endif {{$costItem['CostCenterCode'] }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Project Code</label>
											<select id="project_code" name="project_code" class="form-control input-sm select2">
												<option disabled selected value></option>
												@foreach ($wbscodeList as $item) @if($item['wbs_id']==old('project_code'))
												<option value="{{$item['wbs_id']}}" selected="selected">{{$item['wbs_code']}}</option>
												@else
												<option value="{{$item['wbs_id']}}">{{$item['wbs_code']}}</option>
												@endif @endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">CC</label>
											@if(Auth::user()->CountryAssignedID ==15)
											<select id="cc" name="cc[]" class="form-control select2" multiple>
												@else
												<select id="cc" name="cc[]" class="form-control select2" multiple>
													@endif
													<option value="">Select an option</option>
													@foreach($userList as $user) @if(Auth::user()->CountryAssignedID ==15 && $user['Email']=='hiroko.yamada@arkema.com')
													<option value="{{$user['Email']}}" selected>{{$user['LastName']}} {{$user['FirstName']}}</option>
													@else
													<option value="{{$user['Email']}}">{{$user['LastName']}} {{$user['FirstName']}}</option>
													@endif @endforeach
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
													<i class="glyphicon glyphicon-plus-sign"></i> Add Line Item
												</button>
												<button id="itemEditBut" type="button" accesskey="I" onclick="editNewLine()" disabled class="btn yellow-gold leave-type-button">
													<i class="fa fa-pencil"></i> Ed<u>i</u>t
												</button>
												<button id="itemDelBut" type="button" class="btn red-mint" disabled onclick="delLineItem()">
													<i class="glyphicon glyphicon-remove-sign"></i> Delete
												</button>
											</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">ITINERARY</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table id="ltineraryTable" class="table table-bordered table-striped table-condensed flip-content">
											<thead>
												<tr class="info">
													<td class="text-center" class="">Date</td>
													<td class="text-center" class="">Time</td>
													<td class="text-center" class="">Location</td>
													<td class="text-center" class="">Company Name</td>
													<td class="text-center" class="">Contact Name</td>
													<td class="text-center" class="">Purpose of Visit Category</td>
													<td class="text-center" class="">Purpose of Visit Description</td>
													<td class="text-center" class="">Estimated Travel Cost</td>
													<td class="text-center" class="">Estimated Entertainment Cost</td>
													<td class="text-center" class="">Details</td>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
								<div class="row" style="margin-top: 8px;">
									<div class="col-md-12">
										<div class="form-group">
											Do you need Cash Advance?:
											<label class="">
												<div class="iradio_minimal-grey" style="position: relative;">
													<input type="radio" name="is_cash_advance" class="icheck" style="position: absolute; opacity: 0;" value="1">
													<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
												</div>
												YES
											</label>
											<label class="">
												<div class="iradio_minimal-grey" style="position: relative;">
													<input type="radio" name="is_cash_advance" class="icheck" style="position: absolute; opacity: 0;" value="0" checked>
													<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
												</div>
												NO
											</label>
										</div>
									</div>
								</div>
								<div id="advance_amount_section" class="row" style="display: none;">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Advance Amount</label>
											<input type="text" class="form-control" id="advance_amount" name="advance_amount" value="{{old('advance_amount')}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Amount Currency</label>
											<select id="amount_currency" name="amount_currency" class="form-control input-sm select2">
												@foreach($currencyList as $currencyItem)
												<option value="{{$currencyItem['CurrencyID']}}">{{$currencyItem['Currency']}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 ">
										<div class="form-group">
											<label class="uppercase">Extra Comments</label>
											<textarea name="extra_comment" class="form-control" style="overflow-y: scroll;" rows="2"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Department Approver</label>
											<select id="department_approver" name="department_approver" class="form-control input-sm select2">
												@foreach ($approvers as $item)
												<option value="{{ $item['UserID'] }}">{{$item['LastName']}} {{$item['FirstName']}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Add'l Notification</label>
											<div class="row" style="background-color: #eef1f5; margin-left: 1px; height: 34px; margin-right: 1px;">
												<div class="col-md-8" style="margin-top: 10px;">
													<span class="icon icon-user-tie"></span>
													<span id="addNotify"> {{ isset($currentUser->manager()->first()->LastName)? $currentUser->manager()->first()->LastName :'' }} {{ isset($currentUser->manager()->first()->FirstName)? $currentUser->manager()->first()->FirstName :'' }} </span>
												</div>
												<div class="col-md-4">
													<input type="text" class="form-control" disabled style="border: none;" />
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 ">
										<div class="form-group">
											<label>Approver Comments</label>
											<textarea name="approver_comment" class="form-control leave-control" style="overflow-y: scroll;" rows="2" disabled></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="form-actions right">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn green" id="submitBtnForDemostic">Submit</button>
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
