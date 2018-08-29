@extends("etravel.layout.main") @section("content")
<script src="{{asset('assets/pages/scripts/components-bootstrap-switch.min.js')}}" type="text/javascript"></script>
<div class="container">
	<div class="page-content-inner">
		<div class="row">
			<!-- BEGIN FORM-->
			<form action="/etravel/tripapproval/{{$trip->trip_id}}" method="post" class="horizontal-form" id="national_approval">
				@if($trip->status == 'pending' && ($trip->department_approver == Auth::user()->UserID || ($trip->overseas_approver == Auth::user()->UserID && $trip->overseas_approver!=$trip->user_id)) && $trip->is_depart_approved != 1) @include('etravel.layout.approverAction') @elseif($trip->status == 'pending' && $trip->overseas_approver == Auth::user()->UserID && $trip->is_depart_approved ==1 ) @include('etravel.layout.approverAction') @endif @include('etravel.layout.error')
				<div class="col-md-12">
					<!-- BEGIN VALIDATION STATES-->
					@if($trip->status=='approved')
					<div class="portlet box blue-steel">
						@elseif($trip->status=='pending')
						<div class="portlet box blue">
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
												<span class="caption-subject bold uppercase">{{ $trip->status }} @if($trip->is_depart_approved && $trip->department_approver == Auth::user()->UserID) TO {{$trip->overseasApprover()->first()['FirstName']}} @endif</span>
											</div>
										</div>
										<div class="portlet-body form">
											<input type="hidden" name="_token" value="{{csrf_token()}}" />
											<input type="hidden" name="_method" value="PUT" />
											<input type="hidden" name="status" value="rejected" />
											<div class="form-body">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Applicant</label>
															<input disabled type="text" class="form-control" placeholder="{{ $applicantUser->FirstName }} {{ $applicantUser->LastName }}-{{ $applicantUser->UserName }}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Request For</label>
															<input disabled type="text" class="form-control" placeholder="{{ $userObjMdl->FirstName }} {{ $userObjMdl->LastName }}-{{ $userObjMdl->UserName }}">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Destination</label>
															<select id="destinationSel" name="destination[]" class="form-control input-sm select2" multiple disabled>
																@if(count($destination)>0) @foreach($destination as $item)
																<option value="{{$item['CountryID']}}" selected="selected">{{$item['Country']}}</option>
																@endforeach @endif
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
																<input type="text" name="daterange_from" value="{{$trip->daterange_from}}" class="form-control" disabled>
																<i class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; bottom: 10px; right: 10px; top: auto; cursor: pointer;"></i>
															</div>
															<div class="col-md-6" style="padding-right: 0px;">
																<input type="text" name="daterange_to" value="{{$trip->daterange_to}}" class="form-control" disabled>
																<i class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; bottom: 10px; right: 10px; top: auto; cursor: pointer;"></i>
															</div>
														</div>
													</div>
													<div class="col-md-6">
													<div class="form-group">
															<label class="control-label">Department</label>
															<select id="department_id" name="department_id" class="select2 form-control" disabled>
																<option value="{{$department}}" selected>{{$department}}</option>
															</select>
														</div>
														
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Project Code</label>
															<select id="project_code" disabled name="project_code" class="form-control input-sm select2">
																<option value="{{$trip->project_code}}">{{$trip->wbsCode()->first()['wbs_code']}}</option>
															</select>
														</div>
													</div>
													<div class="col-md-6">
													<div class="form-group">
															<label class="control-label">Cost Center</label>
															<select name="cost_center_id" class="form-control input-sm select2" disabled>
																<option value="1">{{$costCenterCode}}</option>
															</select>
														</div>
														
														
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Department Approver</label>
															<select id="department_approver" name="department_approver" class="form-control input-sm select2" disabled>
																<option value="{{$approver->UserID}}">{{ $approver->LastName }} {{ $approver->FirstName }}</option>
															</select>
															<div style="background-color: #32c5d2; margin-top: 2px;">
																@if($trip->status=='pending')
																<span class="glyphicon glyphicon-hand-right" style="color: green"></span>
																@elseif($trip->status=='approved')
																<span class="fa fa-check-circle-o" style="color: green"></span>
																@elseif($trip->status=='rejected')
																<span class="glyphicon glyphicon-thumbs-down" style="color: red"></span>
																@elseif($trip->status=='cancelled')
																<span class="fa fa-exclamation-triangle" style="color: black"></span>
																@elseif($trip->status=='partly-approved')
																<span class="glyphicon glyphicon-check" style="color: yellow"></span>
																@endif @if($trip->is_depart_approved=='1') Approved @else {{ ucfirst($trip->status)}} @endif by: @if($trip->status != 'cancelled') {{ ucfirst($approver->LastName) }} {{ $approver->FirstName }} @else {{ ucfirst($userObjMdl->FirstName) }} {{ ucfirst($userObjMdl->LastName) }} @endif on {{$trip->updated_at}}
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Overseas Approver</label>
															<select id="overseas_approver" name="overseas_approver" class="form-control select2" disabled>
																@if($overseas_approver)
																<option value="{{$overseas_approver->UserID}}">{{ $overseas_approver->LastName }} {{ $overseas_approver->FirstName }}</option>
																@endif
															</select>
															@if($trip->is_depart_approved=='1')
															<div style="background-color: #32c5d2; margin-top: 2px;">
																@if($trip->status=='pending')
																<span class="glyphicon glyphicon-hand-right" style="color: green"></span>
																@elseif($trip->status=='approved')
																<span class="fa fa-check-circle-o" style="color: green"></span>
																@elseif($trip->status=='rejected')
																<span class="glyphicon glyphicon-thumbs-down" style="color: red"></span>
																@elseif($trip->status=='cancelled')
																<span class="fa fa-exclamation-triangle" style="color: black"></span>
																@elseif($trip->status=='partly-approved')
																<span class="glyphicon glyphicon-check" style="color: yellow"></span>
																@endif {{ ucfirst($trip->status)}} by: @if($trip->status != 'cancelled') {{ ucfirst($overseas_approver->LastName) }} {{ $overseas_approver->FirstName }} @else {{ ucfirst($userObjMdl->FirstName) }} {{ ucfirst($userObjMdl->LastName) }} @endif on {{$trip->updated_at}}
															</div>
															@endif
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
																<div class="form-group">
																	<textarea class="form-control" rows="4" placeholder="purpose" style="padding-top: 0; overflow-y: scroll;" disabled>{{$trip->purpose_desc}}</textarea>
																	@if($trip->purpose_file)
																	<button type="button" class="btn purple" id="downloadFile" data-filename="{{$trip->purpose_file}}">Download File</button>
																	@endif
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
															<li>
																<a href="#camry" data-toggle="tab">TRAVEL INSURANCE</a>
															</li>
														</ul>
														<div id="myTabContent" class="tab-content" style="border: 2px #dddddd solid;">
															<div class="tab-pane fade in active" id="home">
																<ul class="list-group">
																	<li class="list-group-item">
																		Notification To Be Sent General Affairs?:
																		<label class="">
																			<div class="iradio_minimal-grey" style="position: relative;">
																				@if($trip->flight_itinerary_prefer['is_sent_affairs']=='1')
																				<input type="radio" name="is_sent_affairs" class="icheck" style="position: absolute; opacity: 0;" value="1" checked disabled>
																				@else
																				<input type="radio" name="is_sent_affairs" class="icheck" style="position: absolute; opacity: 0;" value="1" disabled>
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
																	@if($cc)
																	<li class="list-group-item">
																		<div class="row">
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label">CC</label>
																					<select name="CC" class="form-control select2" disabled multiple>
																						@foreach($cc as $item)
																						<option value="{{$item}}" selected>{{$item}}</option>
																						@endforeach
																					</select>
																				</div>
																			</div>
																		</div>
																	</li>
																	@endif
																</ul>
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
																		<tr>
																			<td>{{$flightItem['flight_date']}}</td>
																			<td>{{$flightItem['flight_from']}}</td>
																			<td>{{$flightItem['flight_to']}}</td>
																			<td>@if($flightItem['airline_or_train']=='1') Airline {{$flightItem['air_code']}} @elseif($flightItem['airline_or_train']=='0') Train @endif</td>
																			<td>{{$flightItem['etd_time']}}</td>
																			<td>{{$flightItem['eta_time']}}</td>
																			<td>{{$flightItem['class_flight']}}</td>
																			<td>@if($flightItem['is_visa']=='1') YES @elseif($flightItem['is_visa']=='0') NO @endif</td>
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
																			<td class="text-center">{{$item['estimate_type']}} Travel</td>
																			<td>{{$item['employee_annual_budget']}}</td>
																			<td>{{$item['employee_ytd_expenses']}}</td>
																			<td>{{$item['available_amount']}}</td>
																			<td>{{$item['required_amount']}}</td>
																		</tr>
																		@endforeach @endif
																	</tbody>
																</table>
																<div class="row">
																	<div class="form-group">
																		<div class="col-md-2 text-center" style="padding-right: 0px;">Entertainment Details</div>
																		<div class="col-md-7" style="margin: 0px; padding: 0px;">
																			<textarea id="entertainment_details" class="form-control" rows="1" style="overflow-y: scroll;" disabled>{{$trip->entertainment_details}}</textarea>
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
																						<select class="form-control js-data-example-ajax" name="rep_office[]" style="width: 230px;" disabled multiple>
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
																								<input disabled type="radio" name="room_type" class="icheck" value="double" <?php if ($trip->hotel_prefer['room_type']=='double'){echo "checked";}?>>
																								Double
																							</label>
																							<label>
																								<input disabled type="radio" name="room_type" class="icheck" value="king" <?php if ($trip->hotel_prefer['room_type']=='king'){echo "checked";}?>>
																								King
																							</label>
																							<label>
																								<input disabled type="radio" name="room_type" class="icheck" value="suite" <?php if ($trip->hotel_prefer['room_type']=='suite'){echo "checked";}?>>
																								Suite
																							</label>
																							<label>
																								<input disabled type="radio" name="room_type" class="icheck" value="standard" <?php if ($trip->hotel_prefer['room_type']=='standard'){echo "checked";}?>>
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
																						<input type="text" class="form-control" name="per_hotel_name" disabled value="{{ $trip->hotel_prefer['per_hotel_name'] or '' }}">
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
																								<input disabled type="radio" name="smoking" class="icheck" value="1" <?php if($trip->hotel_prefer['smoking']=='1'){echo "checked";}?>>
																								Smoking
																							</label>
																							<label>
																								<input disabled type="radio" name="smoking" class="icheck" value="0" <?php if($trip->hotel_prefer['smoking']=='0'){echo "checked";}?>>
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
																						<input type="text" class="form-control" name="rate_per_night" disabled value="{{ $trip->hotel_prefer['rate_per_night'] or '' }}">
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
																					<div class="col-md-9">@if(count($trip->hotel_prefer['foods'])) @foreach($trip->hotel_prefer['foods'] as $food) {{$food}} @endforeach @endif</div>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label col-md-3">No. of Nights</label>
																					<div class="col-md-9">
																						<input type="text" class="form-control" name="no_of_nights" disabled value="{{ $trip->hotel_prefer['no_of_nights'] or '' }}">
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
																						<input type="text" class="form-control" name="total_amount" disabled value="{{ $trip->hotel_prefer['no_of_nights'] or '' }}">
																					</div>
																				</div>
																			</div>
																		</div>
																	</li>
																</ul>
																<table class="table table-bordered">
																	<thead>
																		<tr class="info">
																			<td class="text-center">Hotel Name</td>
																			<td class="text-center">Check-in Date</td>
																			<td class="text-center">Check-out Date</td>
																			<td class="text-center">Rate</td>
																		</tr>
																	</thead>
																	<tbody>
																		@if(count($hotelData)) @foreach($hotelData as $hotelItem)
																		<tr>
																			<td>{{$hotelItem['hotel_name']}}</td>
																			<td>{{$hotelItem['checkin_date']}}</td>
																			<td>{{$hotelItem['checkout_date']}}</td>
																			<td>{{$hotelItem['rate']}}</td>
																		</tr>
																		@endforeach @endif
																	</tbody>
																</table>
															</div>
															<div class="tab-pane fade" id="camry">
																<ul class="list-group">
																	<li class="list-group-item">
																		<div class="row">
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label col-md-3">Type: </label>
																					<div class="col-md-9">
																						<label class="">
																							<div class="iradio_minimal-grey" style="position: relative;">
																								<input type="radio" name="insurance_type" class="icheck" style="position: absolute; opacity: 0;" value="adhoc" disabled <?php if($insuranceData['insurance_type']=='adhoc'){echo 'checked';}?>>
																								<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																							</div>
																							Adhoc
																						</label>
																						<label class="">
																							<div class="iradio_minimal-grey" style="position: relative;">
																								<input type="radio" name="insurance_type" class="icheck" style="position: absolute; opacity: 0;" value="yearly" disabled <?php if($insuranceData['insurance_type']=='yearly'){echo 'checked';}?>>
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
																						<input type="text" class="form-control" name="nominee_name" disabled value="{{$insuranceData['nominee_name']}}">
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
																						<input type="text" class="form-control" name="passport_fullname" disabled value="{{$insuranceData['passport_fullname']}}">
																					</div>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label col-md-3">NRIC/Passport No</label>
																					<div class="col-md-9">
																						<input type="text" class="form-control" name="nric_no" disabled value="{{$insuranceData['nric_no']}}">
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
																						<input type="text" class="form-control" name="nric_num" disabled value="{{$insuranceData['nric_no']}}">
																					</div>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="control-label col-md-3">Relationship</label>
																					<div class="col-md-9">
																						<input type="text" class="form-control" name="elationship" disabled value="{{$insuranceData['nric_no']}}">
																					</div>
																				</div>
																			</div>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</div>
												<p></p>
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
																<textarea id="extra_comment" name="extra_comment" class="form-control leave-control" style="overflow-y: scroll;" rows="2" disabled>{{$trip['extra_comment']}}</textarea>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row form-actions text-right">
												@if(($trip->user_id == Auth::user()->UserID || $trip->applicant_id == Auth::user()->UserID) && ($trip->status == 'pending' || $trip->status == 'partly-approved' || $trip->status == 'rejected'))
												<button type="button" accesskey="I" onclick="window.location.href='/etravel/trip/nationalEdit/{{$trip->trip_id}}'" class="btn yellow-gold leave-type-button">
													<i class="fa fa-pencil"></i> Ed<u>i</u>t
												</button>
												@endif @if(($trip->user_id == Auth::user()->UserID || $trip->applicant_id == Auth::user()->UserID) && ($trip->status == 'pending' || $trip->status == 'partly-approved'))
												<button type="button" accesskey="C" onclick="window.location.href='/etravel/trip/nationalCancel/{{$trip->trip_id}}'" class="btn default">
													<i class="fa fa-share"></i> <u>C</u>ancel
												</button>
												@endif
											</div>
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
@include('etravel.modal.forApproval') @include('etravel.modal.forPartlyApproval')
<script src="{{asset('js/etravel/trip/tripNationalDetail.js')}}"></script>
@endsection
