@extends("etravel.layout.main") 
@section("content")
<script src="{{asset('assets/pages/scripts/components-bootstrap-switch.min.js')}}" type="text/javascript"></script>
<div class="container">
	<div class="page-content-inner">
		<div class="row">
		<!-- BEGIN FORM-->
		<form action="/etravel/trip/storeNational" method="post" class="horizontal-form">
			@if($trip->status == 'pending' && $trip->department_approver == Auth::user()->UserID )
				@include('etravel.layout.approverAction')
			@endif
			@include('etravel.layout.error')
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
							<i class="icon-bubble"></i> <span
								class="caption-subject bold uppercase">{{ $trip->status }}</span>
						</div>
					</div>

					<div class="portlet-body form">
							<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							<div class="form-body">

								<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Name Of Traveller</label> <input
												disabled type="text" class="form-control"
												placeholder="{{ $userObjMdl->FirstName }}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">SITE</label> 
											<select id="Site" class="form-control input-sm select2" disabled>
												<option>
												{{ $userObjMdl->site()->first()['Site'] }}
												</option>
											</select>


										</div>
									</div>

								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Destination</label>
											<select id="destinationSel" name="destination" class="form-control input-sm select2" disabled>
                                            		<option value="{{$destination['CountryID']}}">{{$destination['Country']}}</option>
                                            </select>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Cost Center</label>
											<select name="cost_center_id" class="form-control input-sm select2" disabled>
												<option value="1">
												{{$costCenterCode}}
												</option>
											</select> 
											
										</div>
									</div>

								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<p>
												<label class="control-label">Period of Travel From</label>
											</p>

											<div class="col-md-4">
												<input type="text" name="daterange_from" value="{{$trip->daterange_from}}"
													class="form-control singleDatePicker" disabled> <i
													class="glyphicon glyphicon-calendar fa fa-calendar"
													style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
											</div>
											<div class="col-md-4">
												<input type="text" name="daterange_to" value="{{$trip->daterange_to}}"
													class="form-control singleDatePicker" disabled> <i
													class="glyphicon glyphicon-calendar fa fa-calendar"
													style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
											</div>


										</div>

									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Project Code</label>
											<select id="project_code" disabled name="project_code" class="form-control input-sm select2">
												<option value="{{$trip->project_code}}">{{$trip->wbsCode()->first()['wbs_code']}}</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Department Approver</label> 
											<select id="department_approver" name="department_approver" class="form-control input-sm select2" disabled>
												<option value="{{$approver->UserID}}">
												{{ $approver->FirstName }}
												</option> 
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Overseas Approver</label> 
											<select id="overseas_approver" name="overseas_approver" class="form-control select2" disabled>
												<option value="123">David</option>
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

								<div class="row form-group col-sm-12">
									<div class="portlet box default">
										<div class="portlet-title">
											<div class="caption">PURPOSE OF TRAVEL</div>
											<div class="tools">
												<a href="" class="collapse" data-original-title="" title="">
												</a>
											</div>
										</div>
										<div class="portlet-body form">
											
											<div class="form-group">
												<button type="button" class="btn purple" id="downloadFile" data-filename="{{$trip->purpose_file}}">Download File</button>
											</div>
										
										</div>
									</div>
								</div>
								
<!-- 								<div class="row form-group col-sm-12"> -->

<!-- 									<div class="portlet box default"> -->
<!-- 										<div class="portlet-title"> -->
<!-- 											<div class="caption">PRE-APPROVAL PURCHASE/REQUEST(RENT)</div> -->
<!-- 											<div class="tools"> -->
<!-- 												<a href="" class="collapse" data-original-title="" title=""> -->
<!-- 												</a> -->
<!-- 											</div> -->
<!-- 										</div> -->
<!-- 										<div class="portlet-body form"> -->
<!-- 											<div class="form-group"> -->
<!-- 												<select id="CostCenter" name="CostCenter" -->
<!-- 													class="cboSelect2 leave-control form-control" tabindex="-1"> -->
<!-- 													<option value="0">&lt;&nbsp;others&nbsp;&gt;</option> -->
<!-- 												</select> -->
<!-- 											</div> -->
<!-- 										</div> -->
<!-- 									</div> -->

<!-- 								</div> -->
								<div class="row form-group col-sm-12">
									
									<ul id="myTab" class="nav nav-tabs">
										<li class="active"><a href="#home" data-toggle="tab">FLIGHT ITINERARY</a></li>
										<li><a href="#ios" data-toggle="tab">ESTIMATED EXPENSES</a></li>
										<li><a href="#teana" data-toggle="tab">HOTEL ACCOMODATION</a></li>
										<li><a href="#camry" data-toggle="tab">TRAVEL INSURANCE</a></li>
									</ul>
									<div id="myTabContent" class="tab-content">
										<div class="tab-pane fade in active" id="home">
											
											<ul class="list-group">
												<li class="list-group-item">Notification To Be Sent General Affairs?: 
													<label class=""> 
													<div class="iradio_minimal-grey" style="position: relative;">
													@if($trip->flight_itinerary_prefer['is_sent_affairs']=='1')
													<input type="radio" name="is_sent_affairs" class="icheck" style="position: absolute; opacity: 0;" value="1" checked >
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
													<input type="radio" name="is_sent_affairs" class="icheck" style="position: absolute; opacity: 0;" value="0" checked >
													@else
													<input type="radio" name="is_sent_affairs" class="icheck" style="position: absolute; opacity: 0;" value="0">
													@endif
													<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
													</div>
													 NO 
													 </label>
													
												</li>
												
												<li class="list-group-item">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">CC</label> <select
																	id="CostCenter" name="CC"
																	class="cboSelect2 leave-control form-control"
																	tabindex="-1">
																	<option value="1">&lt;&nbsp;1&nbsp;&gt;</option>
																	<option value="2">&lt;&nbsp;2&nbsp;&gt;</option>
																	<option value="3">&lt;&nbsp;3&nbsp;&gt;</option>

																</select>
															</div>
														</div>


													</div>

												</li>
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
												@if(count($flightData)>0)
													@foreach($flightData as $flightItem)
													<tr>
														<td>
															{{$flightItem['flight_date']}}
														</td>
														<td>
															{{$flightItem['flight_from']}}
														</td>
														<td>
															{{$flightItem['flight_to']}}
														</td>
														<td>
															@if($flightItem['airline_or_train']=='1')
															Airline
															@elseif($flightItem['airline_or_train']=='0')
															Train
															@endif
														</td>
														<td>
															{{$flightItem['etd_time']}}
														</td>
														<td>
															{{$flightItem['eta_time']}}
														</td>
														<td>
															{{$flightItem['class_flight']}}
														</td>
														<td>
															@if($flightItem['is_visa']=='1')
															YES
															@elseif($flightItem['is_visa']=='0')
															NO
															@endif
														</td>
													</tr>
													@endforeach
												@endif
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
															<td class="text-center">Required Amount</td>
														</tr>
													</thead>
													<tbody>
													@if(count($estimateExpenses)>0)
														@foreach($estimateExpenses as $item)
														<tr>
															<td>{{$item['estimate_type']}} Travel
															</td>
															<td>
																{{$item['employee_annual_budget']}}
															</td>
															<td>
																{{$item['employee_ytd_expenses']}}
															</td>
															<td>
																{{$item['available_amount']}}
															</td>
															<td>
																{{$item['required_amount']}}
															</td>
															
														</tr>
														@endforeach
													@endif
													</tbody>
												</table>
										
										</div>
										<div class="tab-pane fade" id="teana">
											
												<ul class="list-group">
													<li class="list-group-item">
														<div class="row">
														<div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-3">Select address from the list to inform Rep. Office</label>
                                                                                        <div class="col-md-9">
                                                                                            <select class="form-control select2" name="rep_office">
                                                                                                <option value="12">Male</option>
                                                                                                <option value="13">Female</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
														
														
														</div>


													</li>
													<li class="list-group-item">
														<div class="form-group">
															<strong>User Preference:</strong>
														</div>
														<div class="col-md-10">
														<div class="form-group">
															<label>Room Type:</label>
															<div class="input-group">
																<div class="icheck-inline">
																	<label> <input type="radio" name="room_type"
																		class="icheck" value="double"<?php if ($trip->hotel_prefer['room_type']=='double'){echo "checked";}?>> Double
																	</label> <label> <input type="radio" name="room_type"
																		class="icheck" value="king" <?php if ($trip->hotel_prefer['room_type']=='king'){echo "checked";}?>> King
																	</label> <label> <input type="radio" name="room_type"
																		class="icheck" value="suite" <?php if ($trip->hotel_prefer['room_type']=='suite'){echo "checked";}?>> Suite
																	</label> <label> <input type="radio" name="room_type"
																		class="icheck" value="standard" <?php if ($trip->hotel_prefer['room_type']=='standard'){echo "checked";}?>> Standard
																	</label>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label>Smoking?:</label>
															<div class="input-group">
																<div class="icheck-inline">
																	<label> <input type="radio" name="smoking" class="icheck" value="1" <?php if($trip->hotel_prefer['smoking']=='1'){echo "checked";}?>> Smoking
																	</label> 
																	<label> <input type="radio" name="smoking" class="icheck" value="0" <?php if($trip->hotel_prefer['smoking']=='0'){echo "checked";}?>> Non Smoking
																	</label>
																</div>
															</div>


														</div>
														</div>
														<div class="row">
														<div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-3">Food Restrictions:</label>
                                                                                        <div class="col-md-9">
                                                                                        @if(count($trip->hotel_prefer['foods']))
                                                                                            @foreach($trip->hotel_prefer['foods'] as $food)
                                                                                            		{{$food}}
                                                                                            @endforeach
                                                                                         @endif
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
													@if(count($hotelData))
													@foreach($hotelData as $hotelItem)
														<tr>
															<td>{{$hotelItem['hotel_name']}}</td>
															<td>
																{{$hotelItem['checkin_date']}}
															</td>
															<td>
																{{$hotelItem['checkout_date']}}
															</td>
															<td>
																{{$hotelItem['rate']}}
															</td>
														</tr>
													@endforeach
													@endif
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
																<div class="col-md-9"><input type="text" class="form-control" name="nominee_name" disabled value="{{$insuranceData['nominee_name']}}"> </div>
															</div>
														</div>
													</div>
												</li>
												<li class="list-group-item">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Full Name as in Passport</label>
																<div class="col-md-9"><input type="text" class="form-control" name="passport_fullname" disabled value="{{$insuranceData['passport_fullname']}}"> </div>
															</div>
														
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">NRIC/Passport No</label>
																<div class="col-md-9"><input type="text" class="form-control" name="nric_no" disabled value="{{$insuranceData['nric_no']}}"> </div>
															</div>
														</div>
													</div>
												</li>
												
												<li class="list-group-item">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">NRIC/Passport Number</label>
																<div class="col-md-9"><input type="text" class="form-control" name="nric_num" disabled value="{{$insuranceData['nric_no']}}"> </div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">elationship</label>
																<div class="col-md-9"><input type="text" class="form-control" name="elationship" disabled value="{{$insuranceData['nric_no']}}"> </div>
															</div>
														</div>
													</div>
												
												</li>
											</ul>
										
										
										</div>
									</div>
								
								</div>
								<div class="row form-group col-sm-12">
									<div class="portlet box default">
										<div class="portlet-title">
											<div class="caption">
												Extras Comments
											</div>
											<div class="tools">
												<a href="" class="collapse" data-original-title="" title="">
												</a>
											</div>
										</div>
										<div class="portlet-body form">
											<textarea id="extra_comment" name="extra_comment"
												class="form-control leave-control"
												style="overflow-y: scroll;" rows="2" disabled>{{$trip['extra_comment']}}</textarea>
										</div>
									</div>
								</div>
							</div>
							@if($trip->user_id == Auth::user()->UserID && ($trip->status == 'pending' || $trip->status == 'partly-approved'))
								<div class="row form-actions text-right">
									<button type="button" accesskey="I" onclick="window.location.href='/etravel/trip/nationalEdit/{{$trip->trip_id}}'" class="btn yellow-gold leave-type-button">
									 	<i class="fa fa-pencil"></i> Ed<u>i</u>t
									</button>
								
                                 	<button type="button" accesskey="C"  onclick="window.location.href='/etravel/trip/nationalCancel/{{$trip->trip_id}}'" class="btn default">
										<i class="fa fa-share"></i> <u>C</u>ancel
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
<script src="{{asset('js/etravel/trip/tripNationalDetail.js')}}"></script>
@endsection













