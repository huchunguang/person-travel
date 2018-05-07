@extends("etravel.layout.main") 
@section("content")
<script src="{{asset('assets/pages/scripts/components-bootstrap-switch.min.js')}}" type="text/javascript"></script>
<div class="container">
	<div class="page-content-inner">
		<div class="row">
		<!-- BEGIN FORM-->
		<form action="/etravel/trip/nationalUpdate/{{$trip->trip_id}}" method="post" class="horizontal-form" enctype="multipart/form-data">
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
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="_method" value="PUT"/>
								<input type="hidden" name="status" value="{{$trip->status}}"/>
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
											<select id="destinationSel" name="destination" class="form-control input-sm select2">
												@foreach($countryList as $countryItem)
													@if(old('destination') == $countryItem['CountryID'] || $destination['CountryID'] == $countryItem['CountryID'])
                                                    		<option value="{{$countryItem['CountryID']}}" selected="selected">
                                                    	@else
                                                    		<option value="{{$countryItem['CountryID']}}">
                                                    	@endif
                                                    		{{$countryItem['Country']}}
                                                    		</option>
                                                 @endforeach
                                            </select>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Cost Center</label>
											<select name="cost_center_id" class="form-control input-sm select2">
											@foreach($costCenters as $costItem)
												@if(old('cost_center_id') == $costItem['CostCenterID'] || $costCenterCode == $costItem['CostCenterID'])
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

								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<p>
												<label class="control-label">Period of Travel From</label>
											</p>

											<div class="col-md-4">
												<input type="text" name="daterange_from" value="{{$trip->daterange_from}}"
													class="form-control singleDatePicker"> <i
													class="glyphicon glyphicon-calendar fa fa-calendar"
													style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
											</div>
											<div class="col-md-4">
												<input type="text" name="daterange_to" value="{{$trip->daterange_to}}"
													class="form-control singleDatePicker"> <i
													class="glyphicon glyphicon-calendar fa fa-calendar"
													style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
											</div>


										</div>

									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Department Approver</label> 
											<select id="department_approver" name="department_approver" class="form-control input-sm select2">
											@foreach ($approvers as $item)
												@if($item['UserID'] == old('department_approver') || $item['UserID'] == $approver->UserID)
												<option value="{{ $item['UserID'] }}" selected="selected">
												@else
												<option value="{{ $item['UserID'] }}">
												@endif
												{{$item['FirstName']}}
												</option> 
											@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Overseas Approver</label> 
											<select id="overseas_approver" name="overseas_approver" class="form-control select2">
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
                                                                <input type="file" name="purpose_file" value="{{Storage::get($trip->purpose_file)}}"> </span>
<!--                                                             <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> -->
                                                        </div>
                                              		</div>
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
									<div class="portlet box default">
										<div class="portlet-title">
											<div class="caption">FLIGHT ITINERARY</div>
											<div class="tools">
												<a href="" class="collapse" data-original-title="" title="">
												</a>
											</div>
										</div>
										<div class="portlet-body form">
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
												<label> Ticket Booker?:
												@if($trip->flight_itinerary_prefer['ticket_booker']=='1')
												<input type="checkbox" class="icheck" name="ticket_booker" style="position: absolute; opacity: 0;" value="1" checked>
												@else
												<input type="checkbox" class="icheck" name="ticket_booker" style="position: absolute; opacity: 0;" value="1">
												@endif
												France Travel
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
														<input type="hidden" name="flight_id[]" value="{{$flightItem['id']}}"/>
														<td>
															<div class="col-md-8">
																<input type="text" name="flight_date[]" value="{{$flightItem['flight_date']}}"
																	class="form-control singleDatePicker"> <i
																	class="glyphicon glyphicon-calendar fa fa-calendar"
																	style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
															</div>

														</td>
														<td>
															<input type="text" name="flight_from[]" id="" value="{{$flightItem['flight_from']}}"/>
														</td>
														<td>
															<input type="text" name="flight_to[]" id="" value="{{$flightItem['flight_to']}}"/>
														</td>
														<td>
															<select class="form-control" name="airline_or_train[]">
																@if($flightItem['airline_or_train']=='1')
																<option value="1" selected="selected">airline</option>
																@else
																<option value="1">airline</option>
																@endif
																@if($flightItem['airline_or_train']=='0')
																<option value="0" selected="selected">train</option>
																@else
																<option value="0">train</option>
																@endif
															</select>
														</td>
														<td>
															
																<input type="text" name="etd_time[]"class="form-control timepicker timepicker-default time-input" placeholder="" value="{{$flightItem['etd_time']}}"> 
																<span class="input-group-btn">
<!-- 																	<button class="btn default" type="button"> -->
<!-- 																		<i class="fa fa-clock-o"></i> -->
<!-- 																	</button> -->
																</span>
															
														</td>
														<td>
																<input type="text" name="eta_time[]"class="form-control timepicker timepicker-default time-input" placeholder="" value="{{$flightItem['eta_time']}}"> 
																<span class="input-group-btn">
<!-- 																	<button class="btn default" type="button"> -->
<!-- 																		<i class="fa fa-clock-o"></i> -->
<!-- 																	</button> -->
																</span>
														</td>
														<td><input type="text" name="class_flight[]" id="" value="{{$flightItem['class_flight']}}"/></td>
														<td>
															<select class="form-control" name="is_visa[]">
															@if($flightItem['is_visa']=='1')
																<option value="1" selected="selected">YES</option>
															@else
																<option value="1">YES</option>
															@endif
															
															@if($flightItem['is_visa']=='0')
															<option value="0" selected="selected">NO</option>
															@else
															<option value="0">NO</option>
															@endif
															</select>
														</td>
													
													</tr>
													@endforeach
												@endif
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="row form-group col-sm-12">
									<div class="portlet box default">
										<div class="portlet-title">
											<div class="caption">
											 ESTIMATED EXPENSES
											</div>
											<div class="tools">
												<a href="" class="collapse" data-original-title="" title="">
												</a>
											</div>
										</div>
										<div class="portlet-body form">
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
														<input type="hidden" name="estimate_id[]" value="{{$item['expense_id']}}"/>
														
															<td>{{$item['estimate_type']}} Travel
																<input type="hidden" name="estimate_type[]" value="{{$item['estimate_type']}}"/>
															</td>
															<td><input type="text" name="employee_annual_budget[]" id="" placeholder="0.00" value="{{$item['employee_annual_budget']}}"/></td>
															<td><input type="text" name="employee_ytd_expenses[]" id="" placeholder="0.00" value="{{$item['employee_ytd_expenses']}}"/></td>
															<td><input type="text" name="available_amount[]" id="" placeholder="0.00" value="{{$item['available_amount']}}"/></td>
															<td><input type="text" name="required_amount[]" id="" placeholder="0.00" value="{{$item['required_amount']}}"/></td>
														</tr>
														@endforeach
													@endif
													</tbody>
												</table>
										</div>
									</div>
								</div>
								<div class="row form-group col-sm-12">
									<div class="portlet box default">
										<div class="portlet-title">
											<div class="caption">
												HOTEL ACCOMODATION
											</div>
											<div class="tools">
												<a href="" class="collapse" data-original-title="" title="">
												</a>
											</div>
										</div>
										<div class="portlet-body form">
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
                                                                                        <label class="control-label col-md-3">Food:</label>
                                                                                        <div class="col-md-9">
                                                                                        		<select name="foods[]" class="form-control select2-multiple" multiple>
                                                                                            		<option value="salad" <?php if(in_array('salad', $trip->hotel_prefer['foods'])){echo 'selected';}?>>salad</option>
                                                                                                	<option value="hamburger" <?php if(in_array('hamburger', $trip->hotel_prefer['foods'])){echo 'selected';}?>>hamburger</option>
																							</select>	                                                                                               										
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
													@foreach($hotelData as $hotelItem)
														<tr>
															<input type="hidden" name="hotel_id" value="{{$hotelItem['accomodate_id']}}"/>
															<td><input type="text" name="hotel_name[]" id="" value="{{$hotelItem['hotel_name']}}"/></td>
															<td>
																<div class="col-md-8">
																	<input type="text" id="" name="checkin_date[]" value="{{$hotelItem['checkin_date']}}"
																		class="form-control singleDatePicker"> <i
																		class="glyphicon glyphicon-calendar fa fa-calendar"
																		style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>
																</div>
	
															</td>
															<td>
																<div class="col-md-8"
																	style="position: relative;">
																	<input type="text" id="" name="checkout_date[]" value="{{$hotelItem['checkout_date']}}"
																		class="form-control singleDatePicker"> <i
																		class="glyphicon glyphicon-calendar fa fa-calendar"
																		style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>

																</div>
															</td>
															<td><input type="text" name="rate[]" id="" value="{{$hotelItem['rate']}}"/></td>
														
														</tr>
													@endforeach
													</tbody>
												</table>
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
												style="overflow-y: scroll;" rows="2">{{$trip['extra_comment']}}</textarea>
										</div>
									</div>
								</div>
							</div>
							@if($trip->user_id == Auth::user()->UserID && ($trip->status == 'pending' || $trip->status == 'partly-approved'))
								<div class="row form-actions text-right">
                                 	<button type="submit" accesskey="D" class="btn red-mint"><i class="glyphicon glyphicon-new-window"></i> Resubmit</button>
                                 	
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













