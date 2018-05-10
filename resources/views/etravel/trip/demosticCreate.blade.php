@extends("etravel.layout.main") 
@section("content")
<div class="container">
	<div class="page-content-inner">
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-bubble"></i> 
							<span class="caption-subject bold uppercase">DOMESTIC REQUEST</span>
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
											<label class="control-label">Department Approver</label> <select
												name="department_approver"
												class="cboSelect2 leave-control form-control" tabindex="-1">
												@foreach ($approvers as $item)
												<option value="{{ $item['UserID'] }}">&lt;&nbsp;{{
													$item['FirstName'] }}&nbsp;&gt;</option> @endforeach
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


								<div class="modal fade" id="addNewLineModal" tabindex="-1" role="dialog" aria-labelledby="addNewLineModal" aria-hidden="true">

									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">
													<span aria-hidden="true">&times;</span><span
														class="sr-only">Close</span>
												</button>
												<h4 class="modal-title">Add New Line</h4>
											</div>
											<div class="modal-body">
											
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Date</label>
															<div style="position: relative;">
																<input type="text" name="datetime_date[]"
																	class="form-control singleDatePicker"> <i
																	class="glyphicon glyphicon-calendar fa fa-calendar"
																	style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
															</div>

														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Time</label>
															<div class="input-group">
																<input type="text" 
																	name="datetime_time[]"
																	class="form-control timepicker timepicker-default time-input"
																	placeholder=""> <span class="input-group-btn">
																	<button class="btn default" type="button">
																		<i class="fa fa-clock-o"></i>
																	</button>
																</span>
															</div>

														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Location</label>
																<input type="text" name="location[]" class="form-control"/>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Customer Name</label>
															<input type="text" name="customer_name[]" class="form-control"/>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Contact Name</label>
															<input type="text" name="contact_name[]" class="form-control"/>
														</div>
														
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="">Purpose of Visit Category</label>
															<select class="form-control" name="purpose_id[]" id="purpose_id"> 
																@foreach ($purposeCats as $item)
																	<option value="{{ $item['purpose_id'] }}">
																	&lt;&nbsp;{{$item['purpose_catgory'] }}&nbsp;&gt;</option>
																@endforeach
															</select>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="">Purpose of Visit Description</label>
															<textarea id="purpose_desc" name="purpose_desc[]" class="form-control leave-control" style="overflow-y: scroll;" rows="1"></textarea>
														</div>
														
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="">Estimated Travel Cost</label>
																<input type="text" name="travel_cost[]" value="0.00" class="form-control input-number admin-non-edit"/>
														</div>
													</div>
												</div>
												
												<div class="row">
													
													<div class="col-md-6">
														<div class="form-group">
															<label for="">Estimated Entertainment Cost</label>
															<input type="text" name="entertain_cost[]"  value="0.00" class="form-control input-number"/>
														</div>
														
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="">Estimated Details</label>
																<input type="text" name="entertain_detail[]" class="form-control"/>
														</div>
													</div>
												
												</div>
												
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="button" class="btn btn-primary" onclick="addNewLine()">Save</button>
											</div>
										</div>
									</div>
									</div>
@endsection





