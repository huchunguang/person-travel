@extends("etravel.layout.main") 
@section("content")
<script src="{{asset('assets/pages/scripts/components-bootstrap-switch.min.js')}}" type="text/javascript"></script>
<div class="container">
	<div class="page-content-inner">
		<div class="row">
			<div class="col-md-12">
			@include('etravel.layout.error')
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-bubble"></i> <span
								class="caption-subject bold uppercase">Business Travel Request</span>
						</div>
					</div>

					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<form action="/etravel/trip/storeNational" method="post" class="horizontal-form" enctype="multipart/form-data" id="nationTripCreate">
							<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							<div class="form-body">
						<div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
								<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Name Of Traveller</label> 
											<input type="text" class="form-control" placeholder="{{ $userProfile['FirstName'] }} {{ $userProfile['LastName'] }}-{{ $userProfile['UserName'] }}" disabled>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">SITE</label> 
											<select id="Site" class="form-control input-sm select2" disabled>
												<option>
												{{ $userProfile['site']['Site']}}
												</option>
											</select>


										</div>
									</div>

								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Destination</label>
											<select id="destinationSel" name="destination[]" class="form-control input-sm select2" multiple>
													@foreach($countryList as $countryItem)
                                                    		<option data-region="{{$countryItem['RegionID']}}" value="{{$countryItem['CountryID']}}" <?php if(in_array($countryItem['CountryID'], old('destination',[]))){echo "selected";}?>>
                                                    		{{$countryItem['Country']}}
                                                    		</option>
                                                    @endforeach
                                            </select>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Cost Center</label> 
											<select name="cost_center_id" class="form-control input-sm select2" required>
												@if($costCenters)
												@foreach($costCenters as $costItem)
												@if(old('cost_center_id') == $costItem['CostCenterID'] || $costItem['CostCenterID']==$defaultCostCenterID)
												<option value="{{ $costItem['CostCenterID'] }}" selected="selected">
												@else
												<option value="{{ $costItem['CostCenterID'] }}" >
												@endif
												{{$costItem['CostCenterCode'] }}
												</option>
												@endforeach
												@endif
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

											<div class="col-md-6" style="margin-left: 0px;padding:0px;">
												<input type="text" name="daterange_from" value="{{old('daterange_from')}}"
													class="form-control singleDatePicker" > <i
													class="glyphicon glyphicon-calendar fa fa-calendar"
													style="position: absolute; bottom: 10px; right: 10px; top: auto; cursor: pointer;"></i>
											</div>
											<div class="col-md-6" style="padding-right: 0px;">
												<input type="text" name="daterange_to" value="{{old('daterange_to')}}"
													class="form-control singleDatePicker"> <i
													class="glyphicon glyphicon-calendar fa fa-calendar"
													style="position: absolute; bottom: 10px; right: 10px; top: auto; cursor: pointer;"></i>
											</div>


										</div>

									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Project Code</label>
											
											<select id="project_code" name="project_code" class="form-control">
												<option value="">Select...</option>
												@if($wbscodeList)
												@foreach ($wbscodeList as $item)
													@if($item['wbs_id']==old('project_code'))
													<option value="{{$item['wbs_id']}}" selected="selected">{{$item['wbs_code']}}</option>
													@else
													<option value="{{$item['wbs_id']}}">{{$item['wbs_code']}}</option>
													@endif
												@endforeach
												@endif
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3" style="padding-right:0;">
										<div class="form-group">
											<p style="margin-bottom: 0px;">
												<label class="control-label">Department Approver</label>
											</p> 
											<select id="department_approver" name="department_approver" class="form-control input-sm select2">
												@foreach ($approvers as $item)
												@if($item['UserID'] == old('department_approver'))
												<option value="{{ $item['UserID'] }}" selected="selected">
												@else
												<option value="{{ $item['UserID'] }}">
												@endif
												{{$item['LastName']}} {{$item['FirstName']}}
												</option> 
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Add'l Notification</label>
											<div class="row" style="background-color:#eef1f5;margin-left:1px;height: 34px;margin-right:1px;">
												<div class="col-md-8" style="margin-top: 10px;">											
													<span class="icon icon-user-tie"></span> 
													{{ isset($currentUser->manager()->first()->LastName)? $currentUser->manager()->first()->LastName :'' }}
													{{ isset($currentUser->manager()->first()->FirstName)? $currentUser->manager()->first()->FirstName :'' }}
												</div>
												<div class="col-md-4">
													<input type="text" class="form-control" disabled style="border: none;"/>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Overseas Approver</label> 
											<select id="overseas_approver" name="overseas_approver" class="form-control select2" disabled>
											</select>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-12 ">
										<div class="form-group">
											<label>Approver Comments</label>
											<textarea name="approver_comment" class="form-control leave-control" style="overflow-y: scroll;" rows="2" disabled>{{old('approver_comment')}}</textarea>
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
                                                    <div class="fileinput fileinput-new" data-provides="fileinput" style="margin-top: 5px;">
                                                        <div class="input-group input-large">
                                                            <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                                <span class="fileinput-filename"> {{old('purpose_file')}}</span>
                                                            </div>
                                                            <span class="input-group-addon btn btn-file yellow-gold">
                                                                <span class="fileinput-new"> Select file </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="purpose_file" value="{{old('purpose_file')}}"> </span>
                                                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                              		</div>
											</div>
										</div>
									</div>
								</div>
								
								
								<div class="row form-group col-sm-12">
									<ul id="myTab" class="nav nav-tabs">
										<li class="active"><a href="#home" data-toggle="tab">FLIGHT ITINERARY</a></li>
										<li><a href="#ios" data-toggle="tab">ESTIMATED EXPENSES</a></li>
										<li><a href="#teana" data-toggle="tab">HOTEL ACCOMMODATION</a></li>
										<li><a href="#camry" data-toggle="tab">TRAVEL INSURANCE</a></li>
									</ul>
									<div id="myTabContent" class="tab-content" style="border: 2px #dddddd solid;">
										<div class="tab-pane fade in active" id="home">
											<ul class="list-group">
												<li class="list-group-item">
												Notification To Be Sent General Affairs?:
													<label class=""> 
													<div class="iradio_minimal-grey" style="position: relative;">
													<input type="radio" name="is_sent_affairs" class="icheck" style="position: absolute; opacity: 0;" value="1">
													<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
													</div>
													 YES 
													 </label>
													 <label class=""> 
													<div class="iradio_minimal-grey" style="position: relative;">
													<input type="radio" name="is_sent_affairs" class="icheck" style="position: absolute; opacity: 0;" value="0">
													<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
													</div>
													 NO 
													 </label>
													
												</li>
												
												
												<li class="list-group-item">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label" for="cc">CC</label>
																<select id="cc" name="cc[]" class="form-control select2" multiple disabled>
																<option value="">Select an option</option>
																@foreach($userList as $user)
																	<option value="{{$user['Email']}}">{{$user['LastName']}} {{$user['FirstName']}}</option>
																@endforeach
																</select>
															</div>
														</div>


													</div>

												</li>
											</ul>
											<div class="row" style="margin-left: 0px;">
												
													
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<button data-target="#addNewFlight" data-toggle="modal" type="button" class="btn btn-primary">
													<i class="glyphicon glyphicon-plus-sign"></i> 
													Add Line Item
												</button>
												<button id="flightEditBut" type="button" accesskey="I" onclick="editFlight()" disabled class="btn yellow-gold leave-type-button">
									 				<i class="fa fa-pencil"></i> Ed<u>i</u>t
												</button>
												<button id="flightDelBut" type="button" class="btn red-mint" disabled onclick="delFlightItem()">
													<i class="glyphicon glyphicon-remove-sign"></i> 
													Delete
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
														<tr>
															<td class="text-center">Overseas Travel
																<input type="hidden" name="estimate_type[]" value="overseas"/>
															</td>
															<td><input type="text" name="employee_annual_budget[]" id="" placeholder="0.00"/></td>
															<td><input type="text" name="employee_ytd_expenses[]" id="" placeholder="0.00"/></td>
															<td><input type="text" name="available_amount[]" id="" placeholder="0.00"/></td>
															<td><input type="text" name="required_amount[]" id="" placeholder="0.00"/></td>
															
														</tr>
														<tr>
															<td class="text-center">Entertainment
																<input type="hidden" name="estimate_type[]" value="entertain"/>
															</td>
															<td><input type="text" name="employee_annual_budget[]" id="" placeholder="0.00"/></td>
															<td><input type="text" name="employee_ytd_expenses[]" id="" placeholder="0.00"/></td>
															<td><input type="text" name="available_amount[]" id="" placeholder="0.00"/></td>
															<td><input type="text" name="required_amount[]" id="" placeholder="0.00"/></td>
														</tr>
													</tbody>
												</table>
												<div class="row">
												<div class="form-group">
													<div class="col-md-2 text-center" style="padding-right: 0px;">Entertainment Details</div>
												
													<div class="col-md-7" style="margin:0px;padding:0px;">
														<textarea id="entertainment_details" name="entertainment_details" class="form-control" rows="1" style="overflow-y: scroll;">{{old('entertainment_details')}}</textarea>
													</div>
												</div>
												</div>
												
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
																<input type="radio" name="insurance_type" class="icheck" style="position: absolute; opacity: 0;" value="adhoc">
																<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																</div>
																 Adhoc 
																 </label>
																 <label class=""> 
																<div class="iradio_minimal-grey" style="position: relative;">
																<input type="radio" name="insurance_type" class="icheck" style="position: absolute; opacity: 0;" value="yearly">
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
																<div class="col-md-9"><input type="text" class="form-control" name="nominee_name" value="{{old('nominee_name')}}"> </div>
															</div>
														</div>
													</div>
												</li>
												<li class="list-group-item">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Full Name as in Passport</label>
																<div class="col-md-9"><input type="text" class="form-control" name="passport_fullname" value="{{old('passport_fullname')}}"> </div>
															</div>
														
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">NRIC/Passport No</label>
																<div class="col-md-9"><input type="text" class="form-control" name="nric_no" value="{{old('nric_no')}}"> </div>
															</div>
														</div>
													</div>
												</li>
												
												<li class="list-group-item">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">NRIC/Passport Number</label>
																<div class="col-md-9"><input type="text" class="form-control" name="nric_num" value="{{old('nric_num')}}"> </div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">elationship</label>
																<div class="col-md-9"><input type="text" class="form-control" name="elationship" value="{{old('elationship')}}"> </div>
															</div>
														</div>
													</div>
												
												</li>
											</ul>
										
										</div>
										<div class="tab-pane fade" id="teana">
											
												<ul class="list-group">
													<li class="list-group-item">
														<div class="row">
														<div class="col-md-7">
															<div class="form-group">
																<label class="control-label col-md-7">Select address from the list to inform Rep. Office</label>
																<div class="col-md-5">
																	<select class="form-control js-data-example-ajax" name="rep_office[]" style="width: 230px;" multiple></select>
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
																		class="icheck" value="double" <?php if(old('room_type')=='double'){echo 'checked';}?>> Double
																	</label> <label> <input type="radio" name="room_type"
																		class="icheck" value="king" <?php if(old('room_type')=='king'){echo 'checked';}?>> King
																	</label> <label> <input type="radio" name="room_type"
																		class="icheck" value="suite" <?php if(old('room_type')=='suite'){echo 'checked';}?>> Suite
																	</label> <label> <input type="radio" name="room_type"
																		class="icheck" value="standard" <?php if(old('room_type')=='standard'){echo 'checked';}?>> Standard
																	</label>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label>Smoking?:</label>
															<div class="input-group">
																<div class="icheck-inline">
																	<label> <input type="radio" name="smoking" class="icheck" value="1" <?php if(old('smoking')=='1'){echo 'selected';}?>> Smoking
																	</label> 
																	<label> <input type="radio" name="smoking" class="icheck" value="0" <?php if(old('smoking')=='0'){echo 'selected';}?>> Non Smoking
																	</label>
																</div>
															</div>


														</div>
														</div>
														<div class="row">
														<div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-3">Food Restrictions</label>
                                                                                        <div class="col-md-9">
                                                                                            <select name="foods[]" class="form-control select2-multiple" multiple>
                                                                                                <option value="Vegetarian" <?php if(in_array('Vegetarian', old('foods',[]))){echo "selected";}?>>Vegetarian</option>
                                                                                                <option value="Halal" <?php if(in_array('Halal', old('foods',[]))){echo "selected";}?>>HALAL</option>
                                                                                                <option value="Muslim Food" <?php if(in_array('Muslim Food', old('foods',[]))){echo "selected";}?>>Muslim Food</option>
                                                                                            </select>
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
													<i class="glyphicon glyphicon-plus-sign"></i> 
													Add Line Item
												</button>
												<button id="itemEditBut" type="button" accesskey="I" onclick="editHotel()" disabled class="btn yellow-gold leave-type-button">
									 				<i class="fa fa-pencil"></i> Ed<u>i</u>t
												</button>
												<button id="itemDelBut" type="button" class="btn red-mint" disabled onclick="delHotelItem()">
													<i class="glyphicon glyphicon-remove-sign"></i> 
													Delete
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
														
													</tbody>
												</table>
										
										</div>
									</div>
								</div>
								
<!-- 								<div class="row form-group col-sm-12" > -->

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
											<div class="caption">
												Extra Comments
											</div>
											<div class="tools">
												<a href="" class="collapse" data-original-title="" title="">
												</a>
											</div>
										</div>
										<div class="portlet-body form">
											<textarea id="extra_comment" name="extra_comment" class="form-control"
												style="overflow-y: scroll;" rows="2">{{old('extra_comment')}}</textarea>
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

@include('etravel.modal.airlineList')
@include('etravel.modal.newAccommodation')
@include('etravel.modal.newFlight')
@include('etravel.modal.hotel')
<script src="{{asset('/js/etravel/trip/create.js')}}"></script>

@endsection













