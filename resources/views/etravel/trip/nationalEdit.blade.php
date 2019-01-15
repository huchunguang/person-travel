@extends("etravel.layout.main") @section("content")
<script src="{{asset('assets/pages/scripts/components-bootstrap-switch.min.js')}}" type="text/javascript"></script>
<div class="container">
	<div class="page-content-inner">
		<div class="row">
			<!-- BEGIN FORM-->
			<form action="/etravel/trip/nationalUpdate/{{$trip->trip_id}}" method="post" class="horizontal-form" enctype="multipart/form-data" id="nationalEditForm">
				@if($trip->status == 'pending' && $trip->department_approver == Auth::user()->UserID ) @include('etravel.layout.approverAction') @endif @include('etravel.layout.error')
				<div class="col-md-12">
					<!-- BEGIN VALIDATION STATES-->
					@if($trip->status=='approved')
					<div class="portlet box blue-steel">
						@elseif($trip->status=='pending')
						<div class="portlet box green">
							@elseif($trip->status=='rejected')
							<div class="portlet box red">
								@elseif($trip->status=='partly-approved')
								<div class="portlet box yellow-crusta">
									@elseif($trip->status=='cancelled')
									<div class="portlet box grey">
										@endif
										<div class="portlet-title">
											<div class="caption">
												<i class="icon-bubble"></i>
												<span class="caption-subject bold uppercase">{{ $trip->status }}</span>
											</div>
										</div>
										<div class="portlet-body form">
											<input type="hidden" name="_token" value="{{csrf_token()}}" />
											<div class="form-body">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="_method" value="PUT" />
												<input type="hidden" name="status" value="{{$trip->status}}" />
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Applicant</label>
															<input disabled type="text" class="form-control" placeholder="{{ $applicantUser->FirstName }} {{ $applicantUser->LastName }}-{{ $applicantUser->UserName }}">
														</div>
													</div>
													<div class="col-md-6"><div class="form-group">
															<label class="control-label">Request For</label>
															<input disabled type="text" class="form-control" placeholder="{{ $userObjMdl->FirstName }} {{ $userObjMdl->LastName }}-{{ $userObjMdl->UserName }}">
														</div></div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Destination</label>
															<select id="destinationSel" name="destination[]" class="form-control input-sm select2" multiple disabled>
																@foreach($countryList as $countryItem) @if(old('destination') == $countryItem['CountryID'] || in_array($countryItem['CountryID'],$destination))
																<option data-region="{{$countryItem['IsAsia']}}" value="{{$countryItem['CountryID']}}" selected="selected">@else
																
																
																<option data-region="{{$countryItem['IsAsia']}}" value="{{$countryItem['CountryID']}}">@endif {{$countryItem['Country']}}</option>
																@endforeach
															</select>
														</div>
													</div>
													<div class="col-md-6">
													<div class="form-group">
															<label class="control-label">Site</label>
															<select id="Site" class="form-control input-sm select2" disabled>
																<option>{{ $userObjMdl->site()->first()['Site'] }}</option>
															</select>
														</div>
														
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<p style="margin-bottom: 0px;">
																<label class="control-label">Period of Travel From</label>
															</p>
															<div class="col-md-6" style="margin-left: 0px; padding: 0px;">
																<div class="input-group date date-picker" data-date-format="mm/dd/yyyy">
																	<input type="text" class="form-control" name="daterange_from" value="{{$trip->daterange_from}}" readonly>
																	<span class="input-group-btn">
																		<button class="btn default" type="button">
																			<i class="fa fa-calendar"></i>
																		</button>
																	</span>
																</div>
															</div>
															<div class="col-md-6" style="padding-right: 0px;">
															
																<div class="input-group date date-picker" data-date-format="mm/dd/yyyy">
																	<input type="text" class="form-control" name="daterange_to" value="{{$trip->daterange_to}}" readonly>
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
															<label class="control-label">Department</label>
															<select id="department_id" name="department_id" class="form-control">
																@foreach($departmentList as $dep) @if($dep['DepartmentID']==$trip->department_id)
																<option value="{{$dep['DepartmentID']}}" selected>{{$dep['Department'] }}</option>
																@else
																<option value="{{$dep['DepartmentID']}}">{{$dep['Department'] }}</option>
																@endif @endforeach
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
																@foreach ($wbsList as $item) @if($item['wbs_id']==old('project_code') || $item['wbs_id']==$trip->project_code)
																<option value="{{$item['wbs_id']}}" selected="selected">{{$item['wbs_code']}}</option>
																@else
																<option value="{{$item['wbs_id']}}">{{$item['wbs_code']}}</option>
																@endif @endforeach
															</select>
														</div>
													</div>
													
													<div class="col-md-6">
													<div class="form-group">
															<label class="control-label">Cost Center</label>
															<select name="cost_center_id" class="form-control input-sm select2">
																@foreach($costCenters as $costItem) @if(old('cost_center_id') == $costItem['CostCenterID'] || $costCenterCode == $costItem['CostCenterID'])
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
															<label class="control-label">Department Approver</label>
															<select id="department_approver" name="department_approver" class="form-control input-sm select2">
																@foreach ($approvers as $item) @if($item['UserID'] == old('department_approver') || $item['UserID'] == $approver->UserID)
																<option value="{{ $item['UserID'] }}" selected="selected">@else
																
																
																<option value="{{ $item['UserID'] }}">@endif {{$item['LastName']}} {{$item['FirstName']}}</option>
																@endforeach
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Overseas Approver</label>
															<select id="overseas_approver" name="overseas_approver" class="form-control select2" disabled>
																@if($overseas_approver)
																<option value="{{$overseas_approver['UserID']}}">{{$overseas_approver->LastName}} {{$overseas_approver->FirstName}}</option>
																@endif
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 ">
														<div class="form-group">
															<label>Approver Comments</label>
															<textarea disabled name="approver_comment" class="form-control leave-control" style="overflow-y: scroll;" rows="2">{{ $trip->approver_comment }}</textarea>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="portlet box default">
															<div class="portlet-title">
																<div class="caption" style="font-size: 14px;">PURPOSE OF TRAVEL</div>
																<div class="tools">
																	<a href="" class="collapse" data-original-title="" title=""> </a>
																</div>
															</div>
															<div class="portlet-body form">
																<div class="form-group" style="border: 2px #dddddd solid;">
																	<textarea class="form-control" rows="4" placeholder="purpose" name="purpose_desc" style="padding-top: 0; overflow-y: scroll;">{{$trip->purpose_desc}}</textarea>
																	<div class="fileinput fileinput-exists" data-provides="fileinput" style="margin-top: 5px;">
																		<div class="input-group input-large">
																			<div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
																				<i class="fa fa-file fileinput-exists"></i>&nbsp;
																				<span class="fileinput-filename">{{$trip->purpose_file}}</span>
																			</div>
																			<span class="input-group-addon btn btn-file yellow-gold">
																				<span class="fileinput-new"> Select file </span>
																				<span class="fileinput-exists"> Change </span>
																				<input type="hidden" value="" name="">
																				@if($trip->purpose_file)
																				<input type="file" name="purpose_file" value="{{Storage::get($trip->purpose_file)}}">
																			</span>
																			@else
																			<input type="file" name="purpose_file" value="">
																			</span>
																			@endif
																			<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<ul id="myTab" class="nav nav-tabs">
															<li class="active">
																<a href="#home" data-toggle="tab">FLIGHT ITINERARY</a>
															</li>
															<li>
																<a href="#ios" data-toggle="tab">ESTIMATED EXPENSES</a>
															</li>
															<li>
																<a href="#teana" data-toggle="tab">HOTEL ACCOMMODATION</a>
															</li>
															@if(Auth::user()->CountryAssignedID!=15)
															<li>
																<a href="#camry" data-toggle="tab">TRAVEL INSURANCE</a>
															</li>
															@endif
														</ul>
														<div id="myTabContent" class="tab-content" style="border: 2px #dddddd solid;">
															<div class="tab-pane fade in active" id="home">
																<ul class="list-group">
																	<li class="list-group-item">
																		Notification To Be Sent General Affairs?:
																		<label class="">
																			<div class="iradio_minimal-grey" style="position: relative;">
																				@if($trip->flight_itinerary_prefer['is_sent_affairs']=='1')
																				<input type="radio" name="is_sent_affairs" class="icheck" style="position: absolute; opacity: 0;" value="1" checked>
																				@else
																				<input type="radio" name="is_sent_affairs" class="icheck" style="position: absolute; opacity: 0;" value="1">
																				@endif
																				<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																			</div>
																			YES
																		</label>
																		<label class="">
																			<div class="iradio_minimal-grey" style="position: relative;">
																				@if($trip->flight_itinerary_prefer['is_sent_affairs']=='0')
																				<input type="radio" name="is_sent_affairs" class="icheck" style="position: absolute; opacity: 0;" value="0" checked>
																				@else
																				<input type="radio" name="is_sent_affairs" class="icheck" style="position: absolute; opacity: 0;" value="0">
																				@endif
																				<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																			</div>
																			NO
																		</label>
																	</li>
																	@if($trip->cc)
																	<li class="list-group-item">
																		<div class="row">
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label">CC</label>
																					<select id="cc" name="cc[]" class="form-control select2" multiple>
																						@foreach($userList as $user) @if(in_array($user['Email'],$trip->cc))
																						<option value="{{$user['Email']}}" selected>@else
																						
																						
																						<option value="{{$user['Email']}}">@endif {{$user['LastName']}} {{$user['FirstName']}}</option>
																						@endforeach
																					</select>
																				</div>
																			</div>
																		</div>
																	</li>
																	@endif
																</ul>
																<div class="row" style="margin-left: 0px;">
																	<div class="col-md-6">
																		<div class="form-group">
																			<label class="control-label">
																				<button onclick="showFlight()" type="button" class="btn btn-primary">
																					<i class="glyphicon glyphicon-plus-sign"></i> Add Line Item
																				</button>
																				<button id="flightEditBut" type="button" accesskey="I" onclick="editFlight()" disabled class="btn yellow-gold leave-type-button">
																					<i class="fa fa-pencil"></i> Ed<u>i</u>t
																				</button>
																				<button id="flightDelBut" type="button" class="btn red-mint" disabled onclick="delFlightItem()">
																					<i class="glyphicon glyphicon-remove-sign"></i> Delete
																				</button>
																			</label>
																		</div>
																	</div>
																</div>
																<table id="flightLtinerary" class="table table-bordered table-striped table-condensed flip-content">
																	<thead>
																		<tr>
																			<td class="text-center text-danger">Date</td>
																			<td class="text-center text-danger">From</td>
																			<td class="text-center text-danger">To</td>
																			<td class="text-center text-danger">Airline/Train</td>
																			<td class="text-center text-danger">ETD</td>
																			<td class="text-center text-danger">ETA</td>
																			<td class="text-center text-danger">Class Fight</td>
																			<td class="text-center text-danger">Visa?</td>
																		</tr>
																	</thead>
																	<tbody>
																		@if(count($flightData)>0) @foreach($flightData as $flightItem)
																		<tr></tr>
																		<tr id="tr_{{$flightItem['id']}}" onclick="showFlightItemOperate(this)" data-id="{{$flightItem['id']}}">
																			<input type="hidden" name="air_code[]" value="{{$flightItem['air_code']}}" />
																			<input type="hidden" name="flight_id[]" value="{{$flightItem['id']}}" />
																			<td>
																				<input type="hidden" name="flight_date[]" value="{{$flightItem['flight_date']}}" />
																				{{$flightItem['flight_date']}}
																			</td>
																			<td>
																				<input type="hidden" name="flight_from[]" value="{{$flightItem['flight_from']}}" />
																				{{$flightItem['flight_from']}}
																			</td>
																			<td>
																				<input type="hidden" name="flight_to[]" value="{{$flightItem['flight_to']}}" />
																				{{$flightItem['flight_to']}}
																			</td>
																			<td>
																				<input type="hidden" name="airline_or_train[]" value="{{$flightItem['airline_or_train']}}" />
																				@if($flightItem['airline_or_train']=='1') airline {{$flightItem['air_code']}} @else train @endif
																			</td>
																			<td>
																				<input type="hidden" name="etd_time[]" value="{{$flightItem['etd_time']}}" />
																				{{$flightItem['etd_time']}}
																			</td>
																			<td>
																				<input type="hidden" name="eta_time[]" value="{{$flightItem['eta_time']}}" />
																				{{$flightItem['eta_time']}}
																			</td>
																			<td>
																				<input type="hidden" name="class_flight[]" value="{{$flightItem['class_flight']}}" />
																				{{$flightItem['class_flight']}}
																			</td>
																			<td>
																				<input type="hidden" name="is_visa[]" value="{{$flightItem['is_visa']}}" />
																				{{ $flightItem['is_visa']==1 ? 'YES' : 'NO' }}
																			</td>
																		</tr>
																		@endforeach @endif
																	</tbody>
																</table>
															</div>
															<div class="tab-pane fade" id="ios">
																<table class="table table-bordered table-striped table-condensed flip-content">
																	<thead>
																		<tr class="info">
																			<td class="text-center"></td>
																			<td class="text-center">Employee Annual Budget</td>
																			<td class="text-center">Employee YTD Expenses</td>
																			<td class="text-center">Available Amount</td>
																			<td class="text-center">Required Budget for this Trip</td>
																		</tr>
																	</thead>
																	<tbody>
																		@if(count($estimateExpenses)>0) @foreach($estimateExpenses as $item)
																		<tr>
																			<input type="hidden" name="estimate_id[]" value="{{$item['expense_id']}}" />
																			<td class="text-center">
																				{{$item['estimate_type']}} Travel
																				<input type="hidden" name="estimate_type[]" value="{{$item['estimate_type']}}" />
																			</td>
																			<td>
																				<input type="text" name="employee_annual_budget[]" id="" placeholder="0.00" value="{{$item['employee_annual_budget']}}" />
																			</td>
																			<td>
																				<input type="text" name="employee_ytd_expenses[]" id="" placeholder="0.00" value="{{$item['employee_ytd_expenses']}}" />
																			</td>
																			<td>
																				<input type="text" name="available_amount[]" id="" placeholder="0.00" value="{{$item['available_amount']}}" />
																			</td>
																			<td>
																				<input type="text" name="required_amount[]" id="" placeholder="0.00" value="{{$item['required_amount']}}" />
																			</td>
																		</tr>
																		@endforeach @endif
																	</tbody>
																</table>
																<div class="row">
																	<div class="form-group">
																		<div class="col-md-2 text-center" style="padding-right: 0px;">Entertainment Details</div>
																		<div class="col-md-7" style="margin: 0px; padding: 0px;">
																			<textarea id="entertainment_details" class="form-control" rows="1" style="overflow-y: scroll;">{{$trip->entertainment_details}}</textarea>
																		</div>
																	</div>
																</div>
															</div>
															<div class="tab-pane fade" id="teana">
																<ul class="list-group">
																	@if(count($rep_office))
																	<li class="list-group-item">
																		<div class="row">
																			<div class="col-md-7">
																				<div class="form-group">
																					<label class="control-label col-md-7">Select address from the list to inform Rep. Office</label>
																					<div class="col-md-5">
																						<select class="form-control js-data-example-ajax" name="rep_office[]" style="width: 230px;" multiple>
																							@foreach($rep_office as $officeUser)
																							<option value="{{$officeUser['UserID']}}" selected>{{$officeUser['LastName']}} {{$officeUser['FirstName']}}</option>
																							@endforeach
																						</select>
																					</div>
																				</div>
																			</div>
																		</div>
																	</li>
																	@endif
																	<li class="list-group-item">
																		<div class="form-group">
																			<strong>User Preference:</strong>
																		</div>
																		<div class="row">
																			<div class="col-md-6">
																				<div class="form-group">
																					<label>Room Type:</label>
																					<div class="input-group">
																						<div class="icheck-inline">
																							<label>
																								<input type="radio" name="room_type" class="icheck" value="double" <?php if ($trip->hotel_prefer['room_type']=='double'){echo "checked";}?>>
																								Double
																							</label>
																							<label>
																								<input type="radio" name="room_type" class="icheck" value="king" <?php if ($trip->hotel_prefer['room_type']=='king'){echo "checked";}?>>
																								King
																							</label>
																							<label>
																								<input type="radio" name="room_type" class="icheck" value="suite" <?php if ($trip->hotel_prefer['room_type']=='suite'){echo "checked";}?>>
																								Suite
																							</label>
																							<label>
																								<input type="radio" name="room_type" class="icheck" value="standard" <?php if ($trip->hotel_prefer['room_type']=='standard'){echo "checked";}?>>
																								Standard
																							</label>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label col-md-3">Hotel Name</label>
																					<div class="col-md-9">
																						<input type="text" class="form-control" name="per_hotel_name" value="{{old('per_hotel_name')}}" placeholder="{{ $trip->hotel_prefer['per_hotel_name'] or '' }}">
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-6">
																				<div class="form-group">
																					<label>Smoking?:</label>
																					<div class="input-group">
																						<div class="icheck-inline">
																							<label>
																								<input type="radio" name="smoking" class="icheck" value="1" <?php if($trip->hotel_prefer['smoking']=='1'){echo "checked";}?>>
																								Smoking
																							</label>
																							<label>
																								<input type="radio" name="smoking" class="icheck" value="0" <?php if($trip->hotel_prefer['smoking']=='0'){echo "checked";}?>>
																								Non Smoking
																							</label>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label col-md-3">Rate per Night</label>
																					<div class="col-md-9">
																						<input type="text" class="form-control" name="rate_per_night" value="{{old('rate_per_night')}}" placeholder="{{ $trip->hotel_prefer['rate_per_night'] or '' }}">
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label col-md-2" style="padding-left: 0;">
																						Food <br /> Restrictions
																					</label>
																					<div class="col-md-9">
																						<select name="foods[]" class="form-control select2-multiple" multiple>
																							<option value="Vegetarian" <?php if(in_array('Vegetarian', $trip->hotel_prefer['foods']?:[])){echo 'selected';}?>>Vegetarian</option>
																							<option value="Halal" <?php if(in_array('Halal', $trip->hotel_prefer['foods']?:[])){echo 'selected';}?>>Halal</option>
																							<option value="Muslim Food" <?php if(in_array('Muslim Food', $trip->hotel_prefer['foods']?:[])){echo 'selected';}?>>Muslim Food</option>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label col-md-3">No. of Nights</label>
																					<div class="col-md-9">
																						<input type="text" class="form-control" name="no_of_nights" value="{{old('no_of_nights')}}" placeholder="{{ $trip->hotel_prefer['no_of_nights'] or ''}}">
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-6"></div>
																			<div class="col-md-6">
																				<div class="form-group" style="margin-top: 8px;">
																					<label class="control-label col-md-3">Total Amount</label>
																					<div class="col-md-9">
																						<input type="text" class="form-control" name="total_amount" value="{{old('total_amount')}}" placeholder="{{ $trip->hotel_prefer['no_of_nights'] or '' }}">
																					</div>
																				</div>
																			</div>
																		</div>
																	</li>
																</ul>
																<div class="row" style="margin-left: 0px;">
																	<div class="col-md-6">
																		<div class="form-group">
																			<label class="control-label">
																				<button data-target="#addNewAccommodation" data-toggle="modal" type="button" class="btn btn-primary">
																					<i class="glyphicon glyphicon-plus-sign"></i> Add Line Item
																				</button>
																				<button id="itemEditBut" type="button" accesskey="I" onclick="editHotel()" disabled class="btn yellow-gold leave-type-button">
																					<i class="fa fa-pencil"></i> Ed<u>i</u>t
																				</button>
																				<button id="itemDelBut" type="button" class="btn red-mint" disabled onclick="delHotelItem()">
																					<i class="glyphicon glyphicon-remove-sign"></i> Delete
																				</button>
																			</label>
																		</div>
																	</div>
																</div>
																<table class="table table-bordered" id="hotelItinerary">
																	<thead>
																		<tr class="info">
																			<td class="text-center">Hotel Name</td>
																			<td class="text-center">Check-in Date</td>
																			<td class="text-center">Check-out Date</td>
																			<td class="text-center">Rate</td>
																		</tr>
																	</thead>
																	<tbody>
																		@foreach($hotelData as $hotelItem)
																		<tr id="tr_{{$hotelItem['accomodate_id']}}" onclick="showHotelItemOperate(this)" data-id="{{$hotelItem['accomodate_id']}}">
																			<td>
																				<input type="hidden" name="accomodate_id[]" value="{{$hotelItem['accomodate_id']}}" />
																				<input type="hidden" name="hotel_id[]" value="{{$hotelItem['hotel_id']}}" />
																				<input type="hidden" name="hotel_name[]" value="{{$hotelItem['hotel_name']}}" />
																				{{$hotelItem['hotel_name']}}
																			</td>
																			<td>
																				<input type="hidden" name="checkin_date[]" value="{{$hotelItem['checkin_date']}}" />
																				{{$hotelItem['checkin_date']}}
																			</td>
																			<td>
																				<input type="hidden" name="checkout_date[]" value="{{$hotelItem['checkout_date']}}" />
																				{{$hotelItem['checkout_date']}}
																			</td>
																			<td>
																				<input type="hidden" name="rate[]" value="{{$hotelItem['rate']}}" />
																				<input type="hidden" name="hotel_is_corporate[]" value="{{$hotelItem['hotel_is_corporate']}}" />
																				{{$hotelItem['rate']}}
																			</td>
																		</tr>
																		@endforeach
																	</tbody>
																</table>
															</div>
															@if(Auth::user()->CountryAssignedID!=15)
															<div class="tab-pane fade" id="camry">
																<ul class="list-group">
																	<li class="list-group-item">
																		<div class="row">
																			<input type="hidden" name="insurance_id" value="{{$insuranceData['id']}}" />
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label col-md-3">Type: </label>
																					<div class="col-md-9">
																						<label class="">
																							<div class="iradio_minimal-grey" style="position: relative;">
																								<input type="radio" name="insurance_type" class="icheck" style="position: absolute; opacity: 0;" value="adhoc" <?php if($insuranceData['insurance_type']=='adhoc'){echo 'checked';}?>>
																								<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																							</div>
																							Adhoc
																						</label>
																						<label class="">
																							<div class="iradio_minimal-grey" style="position: relative;">
																								<input type="radio" name="insurance_type" class="icheck" style="position: absolute; opacity: 0;" value="yearly" <?php if($insuranceData['insurance_type']=='yearly'){echo 'checked';}?>>
																								<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																							</div>
																							Yearly
																						</label>
																					</div>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label col-md-3">Name of Nominee</label>
																					<div class="col-md-9">
																						<input type="text" class="form-control" name="nominee_name" value="{{$insuranceData['nominee_name']}}">
																					</div>
																				</div>
																			</div>
																		</div>
																	</li>
																	<li class="list-group-item">
																		<div class="row">
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label col-md-3">Full Name as in Passport</label>
																					<div class="col-md-9">
																						<input type="text" class="form-control" name="passport_fullname" value="{{$insuranceData['passport_fullname']}}">
																					</div>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label col-md-3">NRIC/Passport No</label>
																					<div class="col-md-9">
																						<input type="text" class="form-control" name="nric_no" value="{{$insuranceData['nric_no']}}">
																					</div>
																				</div>
																			</div>
																		</div>
																	</li>
																	<li class="list-group-item">
																		<div class="row">
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label col-md-3">NRIC/Passport Number</label>
																					<div class="col-md-9">
																						<input type="text" class="form-control" name="nric_num" value="{{$insuranceData['nric_no']}}">
																					</div>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label col-md-3">Relationship</label>
																					<div class="col-md-9">
																						<input type="text" class="form-control" name="elationship" value="{{$insuranceData['nric_no']}}">
																					</div>
																				</div>
																			</div>
																		</div>
																	</li>
																</ul>
															</div>
															@endif
														</div>
													</div>
												</div>
												<div class="row" style="margin-top: 8px;">
													<div class="col-md-12">
														<div class="form-group">
															Do you need Cash Advance?:
															<label class="">
																<div class="iradio_minimal-grey" style="position: relative;">
																	@if($trip->is_cash_advance=='1')
																		<input type="radio" name="is_cash_advance" class="icheck" style="position: absolute; opacity: 0;" value="1" checked>
																	@else
																		<input type="radio" name="is_cash_advance" class="icheck" style="position: absolute; opacity: 0;" value="1">
																	@endif
																	<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																</div>
																YES
															</label>
															<label class="">
																<div class="iradio_minimal-grey" style="position: relative;">
																	@if($trip->is_cash_advance=='0')
																		<input type="radio" name="is_cash_advance" class="icheck" style="position: absolute; opacity: 0;" value="0" checked>
																	@else
																		<input type="radio" name="is_cash_advance" class="icheck" style="position: absolute; opacity: 0;" value="0">
																	@endif
																	<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																</div>
																NO
															</label>
														</div>
													</div>
												</div>
												@if($trip->is_cash_advance=='1')
												<div id="advance_amount_section" class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Advance Amount</label>
															<input type="text" class="form-control" id="advance_amount" name="advance_amount" value="{{$trip->advance_amount}}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Amount Currency</label>
															<select id="amount_currency" name="amount_currency" class="form-control input-sm select2">
																@foreach($currencyList as $currencyItem)
																@if($currencyItem['CurrencyID']==$trip->amount_currency)
																<option value="{{$currencyItem['CurrencyID']}}" selected>{{$currencyItem['Currency']}}</option>
																@else
																<option value="{{$currencyItem['CurrencyID']}}">{{$currencyItem['Currency']}}</option>
																@endif
																@endforeach
															</select>
														</div>
													</div>
												</div>
												@endif
												@if($trip->is_cash_advance=='0')
												<div id="advance_amount_section" class="row" style="display:none;">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Advance Amount</label>
															<input type="text" class="form-control" id="advance_amount" name="advance_amount" value="{{$trip->advance_amount}}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Amount Currency</label>
															<select id="amount_currency" name="amount_currency" class="form-control input-sm select2">
																@foreach($currencyList as $currencyItem)
																@if($currencyItem['CurrencyID']==$trip->amount_currency)
																<option value="{{$currencyItem['CurrencyID']}}" selected>{{$currencyItem['Currency']}}</option>
																@else
																<option value="{{$currencyItem['CurrencyID']}}">{{$currencyItem['Currency']}}</option>
																@endif
																@endforeach
															</select>
														</div>
													</div>
												</div>
												@endif
												<div class="row">
													<div class="col-md-12">
														<div class="portlet box default">
															<div class="portlet-title">
																<div class="caption uppercase" style="font-size: 14px;">Extra Comments</div>
																<div class="tools">
																	<a href="" class="collapse" data-original-title="" title=""> </a>
																</div>
															</div>
															<div class="portlet-body form">
																<textarea id="extra_comment" name="extra_comment" class="form-control leave-control" style="overflow-y: scroll;" rows="2">{{$trip['extra_comment']}}</textarea>
															</div>
														</div>
													</div>
												</div>
											</div>
											@if(($trip->user_id == Auth::user()->UserID || $trip->applicant_id == Auth::user()->UserID) && ($trip->status == 'pending' || $trip->status == 'partly-approved' || $trip->status == 'rejected'))
											<div class="row form-actions text-right">
												<button onclick="disableResubmit()" accesskey="D" class="btn red-mint" id="nationalResubmitBtn">
													<i class="glyphicon glyphicon-new-window"></i> Resubmit
												</button>
											</div>
											@endif
											<!-- END FORM-->
										</div>
									</div>
									<!-- END VALIDATION STATES-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
function disableResubmit(){
	$('#nationalEditForm').submit();
	$('#nationalResubmitBtn').prop('disabled',true);
}
</script>
@include('etravel.modal.airlineList') @include('etravel.modal.newAccommodation') @include('etravel.modal.newFlight') @include('etravel.modal.hotel')
<script src="{{asset('js/etravel/trip/tripNationalDetail.js')}}"></script>
<script src="{{asset('/js/etravel/trip/create.js')}}"></script>
@endsection
