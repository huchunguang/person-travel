@extends("etravel.layout.main") @section("content")
<script
	src="{{asset('assets/pages/scripts/components-bootstrap-switch.min.js')}}"
	type="text/javascript"></script>
<div class="container">
	<div class="page-content-inner">
		<div class="row">
			@include('etravel.layout.error')
			<div class="col-md-12">
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
						<form action="/etravel/trip/store" method="post"
							class="horizontal-form">
							<div class="form-body">

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
											<label class="control-label">Destinations</label> <select
												id="Destinations" name="Destinations"
												class="cboSelect2 leave-control form-control" tabindex="-1">
												<option value="0">&lt;&nbsp;shanghai&nbsp;&gt;</option>
											</select>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Cost Center</label> <select
												name="cost_center_id"
												class="cboSelect2 leave-control form-control" tabindex="-1">
												@foreach($costCenters as $costItem)
												<option value="{{ $costItem['CostCenterID'] }}">&lt;&nbsp;{{
													$costItem['CostCenterCode'] }}&nbsp;&gt;</option>
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
												<input type="text" name="daterange_from"
													class="form-control singleDatePicker"> <i
													class="glyphicon glyphicon-calendar fa fa-calendar"
													style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
											</div>
											<div class="col-md-4">
												<input type="text" name="daterange_to"
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
											<label class="control-label">Department Approver</label> <select
												id="CostCenter" name="CostCenter"
												class="cboSelect2 leave-control form-control" tabindex="-1">
												<option value="0">&lt;&nbsp;ASCO&nbsp;&gt;</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Overseas Approver</label> <select
												id="CostCenter" name="CostCenter"
												class="cboSelect2 leave-control form-control" tabindex="-1">
												<option value="0">&lt;&nbsp;ASCO&nbsp;&gt;</option>
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
												style="overflow-y: scroll;" rows="2"></textarea>
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
												<select id="CostCenter" name="CostCenter"
													class="cboSelect2 leave-control form-control" tabindex="-1">
													<option value="0">&lt;&nbsp;others&nbsp;&gt;</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row form-group col-sm-12">

									<div class="portlet box default">
										<div class="portlet-title">
											<div class="caption">PRE-APPROVAL PURCHASE/REQUEST(RENT)</div>
											<div class="tools">
												<a href="" class="collapse" data-original-title="" title="">
												</a>
											</div>
										</div>
										<div class="portlet-body form">
											<div class="form-group">
												<select id="CostCenter" name="CostCenter"
													class="cboSelect2 leave-control form-control" tabindex="-1">
													<option value="0">&lt;&nbsp;others&nbsp;&gt;</option>
												</select>
											</div>
										</div>
									</div>

								</div>
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
												<li class="list-group-item">Notification To Be Sent
													Generalaffairs?: 
													<label class=""> 
													<div class="iradio_minimal-grey" style="position: relative;">
													<input type="radio" name="radio2" class="icheck" style="position: absolute; opacity: 0;">
													<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
													</div>
													 YES 
													 </label>
													 <label class=""> 
													<div class="iradio_minimal-grey" style="position: relative;">
													<input type="radio" name="radio2" class="icheck" style="position: absolute; opacity: 0;">
													<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
													</div>
													 NO 
													 </label>
													
												</li>
												<li class="list-group-item"><label> 
												Ticket Booker?: 
												<input type="checkbox" class="icheck" style="position: absolute; opacity: 0;">
												 France Travel
												</label></li>
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

											<table
												class="table table-bordered table-striped table-condensed flip-content">
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
																<input type="text" name="daterange_from"
																	class="form-control singleDatePicker"> <i
																	class="glyphicon glyphicon-calendar fa fa-calendar"
																	style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
															</div>

														</td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td><select class="form-control" name="is_visa[]">
																<option value="1">YES</option>
																<option value="0">NO</option>
														</select></td>
													</tr>
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
														<tr>
															<td>Overseas Travel</td>
															<td>JPY:0</td>
															<td>JPY:0</td>
															<td>JPY:0</td>
															<td>JPY:0</td>
														</tr>
														<tr>
															<td>Entertainment</td>
															<td>JPY:0</td>
															<td>JPY:0</td>
															<td>JPY:0</td>
															<td>JPY:0</td>
														</tr>
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
                                                                                        <label class="control-label col-md-3">Gender</label>
                                                                                        <div class="col-md-9">
                                                                                            <select class="form-control">
                                                                                                <option value="">Male</option>
                                                                                                <option value="">Female</option>
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
																	<label> <input type="radio" name="RoomType"
																		class="icheck" checked> Double
																	</label> <label> <input type="radio" name="RoomType"
																		class="icheck"> King
																	</label> <label> <input type="radio" name="RoomType"
																		class="icheck"> Suite
																	</label> <label> <input type="radio" name="RoomType"
																		class="icheck"> Standrd
																	</label>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label>Smoking?:</label>
															<div class="input-group">
																<div class="icheck-inline">
																	<label> <input type="radio" name="Smoking"
																		class="icheck"> Smoking
																	</label> <label> <input type="radio" name="Smoking"
																		class="icheck" checked> Non Smoking
																	</label>
																</div>
															</div>


														</div>
														</div>
														<div class="row">
														<div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-3">Food</label>
                                                                                        <div class="col-md-9">
                                                                                            <select class="form-control">
                                                                                                <option value="">salad</option>
                                                                                                <option value="">hamburger</option>
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
															<td>1:Hotel Name</td>
															<td>
																<div class="col-md-4 col-md-offset-2"
																	style="position: relative;">
																	<input type="text" id=""
																		class="form-control singleDatePicker"> <i
																		class="glyphicon glyphicon-calendar fa fa-calendar"
																		style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>

																</div>
															</td>
															<td>
																<div class="col-md-4 col-md-offset-2"
																	style="position: relative;">
																	<input type="text" id=""
																		class="form-control singleDatePicker"> <i
																		class="glyphicon glyphicon-calendar fa fa-calendar"
																		style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>

																</div>
															</td>
															<td>JPY:0</td>
														</tr>
														<tr>
															<td>2:Hotel Name</td>
															<td>
																<div class="col-md-4 col-md-offset-2"
																	style="position: relative;">
																	<input type="text" id=""
																		class="form-control singleDatePicker"> <i
																		class="glyphicon glyphicon-calendar fa fa-calendar"
																		style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>

																</div>
															</td>
															<td>
																<div class="col-md-4 col-md-offset-2"
																	style="position: relative;">
																	<input type="text" id=""
																		class="form-control singleDatePicker"> <i
																		class="glyphicon glyphicon-calendar fa fa-calendar"
																		style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>

																</div>
															</td>
															<td>JPY:0</td>
														</tr>
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
											<textarea id="ApprovesComment" name="ApprovesComment"
												class="form-control leave-control"
												style="overflow-y: scroll;" rows="2"></textarea>
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













