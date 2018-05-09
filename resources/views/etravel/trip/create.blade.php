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
								class="caption-subject bold uppercase">INTERNATIONAL REQUEST</span>
						</div>
					</div>

					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<form action="/etravel/trip/storeNational" method="post" class="horizontal-form" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							<div class="form-body">

								<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Name Of Traveller</label> <input
												disabled type="text" class="form-control"
												placeholder="{{ $userProfile['FirstName'] }}">
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
                                                    		<option value="{{$countryItem['CountryID']}}" <?php if(in_array($countryItem['CountryID'], old('destination',[]))){echo "selected";}?>>
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

								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<p>
												<label class="control-label">Period of Travel From</label>
											</p>

											<div class="col-md-4">
												<input type="text" name="daterange_from" value="{{old('daterange_from')}}"
													class="form-control singleDatePicker"> <i
													class="glyphicon glyphicon-calendar fa fa-calendar"
													style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
											</div>
											<div class="col-md-4">
												<input type="text" name="daterange_to" value="{{old('daterange_to')}}"
													class="form-control singleDatePicker"> <i
													class="glyphicon glyphicon-calendar fa fa-calendar"
													style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
											</div>


										</div>

									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Project Code</label>
											<select id="project_code" name="project_code" class="form-control input-sm select2">
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
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Department Approver</label> 
											<select id="department_approver" name="department_approver" class="form-control input-sm select2">
												@foreach ($approvers as $item)
												@if($item['UserID'] == old('department_approver'))
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
											<select id="overseas_approver" name="overseas_approver" class="form-control select2" >
												<option value="123">&lt;&nbsp;ASCO&nbsp;&gt;</option>
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
										<li><a href="#teana" data-toggle="tab">HOTEL ACCOMODATION</a></li>
										<li><a href="#camry" data-toggle="tab">TRAVEL INSURANCE</a></li>
									</ul>
									<div id="myTabContent" class="tab-content">
										<div class="tab-pane fade in active" id="home">
											
											<ul class="list-group">
												<li class="list-group-item">Notification To Be Sent General Affairs?: 
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
													<tr>
														<td>
															<div class="col-md-8">
																<input type="text" name="flight_date[]"
																	class="form-control singleDatePicker"> <i
																	class="glyphicon glyphicon-calendar fa fa-calendar"
																	style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
															</div>

														</td>
														<td>
															<input type="text" name="flight_from[]" id="" />
														</td>
														<td>
															<input type="text" name="flight_to[]" id="" />
														</td>
														<td>
															<select class="form-control" name="airline_or_train[]">
																<option value="1">airline</option>
																<option value="0">train</option>
															</select>
														</td>
														<td>
															
																<input type="text" name="etd_time[]"class="form-control timepicker timepicker-default time-input" placeholder=""> 
																<span class="input-group-btn">
<!-- 																	<button class="btn default" type="button"> -->
<!-- 																		<i class="fa fa-clock-o"></i> -->
<!-- 																	</button> -->
																</span>
															
														</td>
														<td>
																<input type="text" name="eta_time[]"class="form-control timepicker timepicker-default time-input" placeholder=""> 
																<span class="input-group-btn">
<!-- 																	<button class="btn default" type="button"> -->
<!-- 																		<i class="fa fa-clock-o"></i> -->
<!-- 																	</button> -->
																</span>
														</td>
														<td><input type="text" name="class_flight[]" id="" /></td>
														<td>
															<select class="form-control" name="is_visa[]">
																<option value="1">YES</option>
																<option value="0">NO</option>
															</select>
														</td>
													</tr>
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
															<td>Overseas Travel
																<input type="hidden" name="estimate_type[]" value="overseas"/>
															</td>
															<td><input type="text" name="employee_annual_budget[]" id="" placeholder="0.00"/></td>
															<td><input type="text" name="employee_ytd_expenses[]" id="" placeholder="0.00"/></td>
															<td><input type="text" name="available_amount[]" id="" placeholder="0.00"/></td>
															<td><input type="text" name="required_amount[]" id="" placeholder="0.00"/></td>
															
														</tr>
														<tr>
															<td>Entertainment
																<input type="hidden" name="estimate_type[]" value="entertain"/>
															</td>
															<td><input type="text" name="employee_annual_budget[]" id="" placeholder="0.00"/></td>
															<td><input type="text" name="employee_ytd_expenses[]" id="" placeholder="0.00"/></td>
															<td><input type="text" name="available_amount[]" id="" placeholder="0.00"/></td>
															<td><input type="text" name="required_amount[]" id="" placeholder="0.00"/></td>
														</tr>
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
														<tr>
															<td><input type="text" name="hotel_name[]" id="" /></td>
															<td>
																<div class="col-md-8">
																	<input type="text" id="" name="checkin_date[]"
																		class="form-control singleDatePicker"> <i
																		class="glyphicon glyphicon-calendar fa fa-calendar"
																		style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>
																</div>
	
															</td>
															<td>
																<div class="col-md-8"
																	style="position: relative;">
																	<input type="text" id="" name="checkout_date[]"
																		class="form-control singleDatePicker"> <i
																		class="glyphicon glyphicon-calendar fa fa-calendar"
																		style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>

																</div>
															</td>
															<td><input type="text" name="rate[]" id="" /></td>
														</tr>
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




@endsection













