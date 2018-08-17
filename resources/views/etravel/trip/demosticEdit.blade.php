@extends("etravel.layout.main") @section("content")
<div class="container">
	<div class="page-content-inner">
		<div class="row">
			<form action="/etravel/trip/update/{{$trip->trip_id}}" method="post" class="horizontal-form">
				@if($trip->status == 'pending' && $trip->department_approver == Auth::user()->UserID ) @include('etravel.layout.approverAction') @endif
				<div class="col-md-12">
					@include('etravel.layout.error')
					<!-- BEGIN VALIDATION STATES-->
					@if($trip->status=='approved')
					<div class="portlet box blue-steel">
						@elseif($trip->status=='pending')
						<div class="portlet box green">
							@elseif($trip->status=='rejected')
							<div class="portlet box red">
								@elseif($trip->status=='partly-approved')
								<div class="portlet box yellow-crusta">
									@endif
									<div class="portlet-title">
										<div class="caption">
											<i class="icon-bubble"></i>
											<span class="caption-subject bold uppercase">{{ $trip->status }}</span>
										</div>
									</div>
									<div class="portlet-body form">
										<div class="form-body">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="_method" value="PUT" />
											<input type="hidden" name="status" value="{{$trip->status}}" />
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
														<label class="control-label">Name Of Traveller</label>
														<input disabled type="text" class="form-control" placeholder="{{ $userObjMdl->FirstName }} {{ $userObjMdl->LastName }}-{{ $userObjMdl->UserName }}">
													</div>
												</div>
												<!--/span-->
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Site</label>
														<select id="Site" name="Site" class="select2 form-control" disabled>
															<option value="0">{{ $userObjMdl->site()->first()['Site'] }}</option>
														</select>
													</div>
												</div>
												<!--/span-->
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Cost Center</label>
														<select name="cost_center_id" class="select2 form-control">
															@foreach($costCenters as $costItem)
															<option value="{{ $costItem['CostCenterID'] }}">{{ $costItem['CostCenterCode'] }}</option>
															@endforeach
															<option value="{{$costCenterCode}}">{{ $costCenterCode }}</option>
														</select>
													</div>
												</div>
												<!--/span-->
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Department</label>
														<select id="department_id" name="department_id" class="select2 form-control">
															@foreach($departmentList as $dep) @if($dep['DepartmentID']==$trip->department_id)
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
													<div class="form-group" style="margin-bottom: 0px;">
														<p style="margin-bottom: 0px;">
															<label class="control-label">Period of Travel From</label>
														</p>
														<div class="col-md-6" style="margin-left: 0px; padding: 0px;">
												<div class="input-group date date-picker" data-date-format="mm/dd/yyyy" data-date-start-date="+0d">
													<input type="text" class="form-control" name="daterange_from" value="{{$trip->daterange_from}}" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button">
															<i class="fa fa-calendar"></i>
														</button>
													</span>
												</div>
											</div>
														<div class="col-md-6" style="padding-right: 0px;">
															<div class="input-group date date-picker" data-date-format="mm/dd/yyyy" data-date-start-date="+0d">
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
														<label class="control-label">Project Code</label>
														<select id="project_code" name="project_code" class="form-control input-sm select2">
															<option disabled selected value></option>
															@foreach ($wbscodeList as $item) @if($item['wbs_id']==old('project_code') || $item['wbs_id']==$trip->project_code)
															<option value="{{$item['wbs_id']}}" selected="selected">{{$item['wbs_code']}}</option>
															@else
															<option value="{{$item['wbs_id']}}">{{$item['wbs_code']}}</option>
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
													<table id="ltineraryTable" class="table table-bordered table-striped table-condensed flip-content">
														<thead>
															<tr class="info">
																<td class="text-center">Date</td>
																<td class="text-center">Time</td>
																<td class="text-center">Location</td>
																<td class="text-center">Customer Name</td>
																<td class="text-center">Contact Name</td>
																<td class="text-center">Purpose of Visit Category</td>
																<td class="text-center">Purpose of Visit Description</td>
																<td class="text-center">Estimated Travel Cost</td>
																<td class="text-center">Estimated Entertainment Cost</td>
																<td class="text-center">Estimated Details</td>
																@if($trip->status == 'partly-approved')
																<td class="text-center">Approved?</td>
																@endif
															</tr>
														</thead>
														<tbody>
															@foreach($demosticInfo as $item)
															<tr id="trOne">
																<td>
																	@if(($trip->status == 'pending') || ($trip->status == 'rejected') || ($trip->status == 'partly-approved' && $item->is_approved == '0'))
																	<input type="hidden" name="demostic_id[]" value="{{$item['id']}}" />
																	<div style="position: relative;">
																		<input type="text" name="datetime_date[]" value="{{ $item['datetime_date'] }}" class="form-control singleDatePicker">
																		<i class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
																	</div>
																	@else {{ $item['datetime_date'] }} @endif
																</td>
																<td>
																	@if(($trip->status == 'pending') || ($trip->status == 'rejected') || ($trip->status == 'partly-approved' && $item->is_approved == '0'))
																	<div class="input-group">
																		<input type="text" name="datetime_time[]" class="form-control timepicker timepicker-default time-input" placeholder="" value="{{ $item['datetime_time'] }}">
																		<span class="input-group-btn">
																			<button class="btn default" type="button">
																				<i class="fa fa-clock-o"></i>
																			</button>
																		</span>
																	</div>
																	@else {{ $item['datetime_time'] }} @endif
																</td>
																<td>
																	@if(($trip->status == 'pending') || ($trip->status == 'rejected') || ($trip->status == 'partly-approved' && $item->is_approved == '0'))
																	<input type="text" name="location[]" class="form-control" value="{{ $item['location'] }}" />
																	@else {{ $item['location'] }} @endif
																</td>
																<td>
																	@if(($trip->status == 'pending') || ($trip->status == 'rejected') || ($trip->status == 'partly-approved' && $item->is_approved == '0'))
																	<input type="text" name="customer_name[]" class="form-control" value="{{ $item['customer_name'] }}" />
																	@else {{ $item['customer_name'] }} @endif
																</td>
																<td>
																	@if(($trip->status == 'pending') || ($trip->status == 'rejected') || ($trip->status == 'partly-approved' && $item->is_approved == '0'))
																	<input type="text" name="contact_name[]" class="form-control" value="{{ $item['contact_name'] }}" />
																	@else {{ $item['contact_name'] }} @endif
																</td>
																<td>
																	@if(($trip->status == 'pending') || ($trip->status == 'rejected') || ($trip->status == 'partly-approved' && $item->is_approved == '0'))
																	<select class="form-control" name="purpose_id[]" id="purpose_id">
																		@foreach ($purposeCats as $purpose)
																		<option value="{{ $purpose['purpose_id'] }}">{{$purpose['purpose_catgory'] }}</option>
																		@endforeach
																	</select>
																	@else {{ $item->visitPurpose()->first()['purpose_catgory'] }} @endif
																</td>
																<td>
																	@if(($trip->status == 'pending') || ($trip->status == 'rejected') || ($trip->status == 'partly-approved' && $item->is_approved == '0'))
																	<textarea id="purpose_desc" name="purpose_desc[]" class="form-control leave-control" style="overflow-y: scroll;" rows="1">{{ $item['purpose_desc'] }}</textarea>
																	@else {{ $item['purpose_desc'] }} @endif
																</td>
																<td>
																	@if(($trip->status == 'pending') || ($trip->status == 'rejected') || ($trip->status == 'partly-approved' && $item->is_approved == '0'))
																	<input type="text" name="travel_cost[]" value="{{ $item['travel_cost'] }}" class="form-control input-number admin-non-edit" />
																	@else {{ $item['travel_cost'] }} @endif
																</td>
																<td>
																	@if(($trip->status == 'pending') || ($trip->status == 'rejected') || ($trip->status == 'partly-approved' && $item->is_approved == '0'))
																	<input type="text" name="entertain_cost[]" value="{{ $item['entertain_cost'] }}" class="form-control input-number" />
																	@else {{ $item['entertain_cost'] }} @endif
																</td>
																<td>
																	@if(($trip->status == 'pending') || ($trip->status == 'rejected') || ($trip->status == 'partly-approved' && $item->is_approved == '0'))
																	<input type="text" name="entertain_detail[]" class="form-control" value="{{ $item['entertain_detail'] }}" />
																	@else {{ $item['entertain_detail'] }} @endif
																</td>
																@if($trip->status=='partly-approved')
																<td>@if($item['is_approved']==1) YES @elseif($item['is_approved']==0) NO @endif</td>
																@endif
															</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 ">
													<div class="form-group">
														<label class="uppercase">Extra Comments</label>
														@if($trip->status == 'pending' || $trip->status == 'rejected' || $trip->status == 'partly-approved')
														<textarea name="extra_comment" class="form-control" style="overflow-y: scroll;" rows="2">{{ $trip->extra_comment }}</textarea>
														@else
														<textarea name="extra_comment" class="form-control" disabled style="overflow-y: scroll;" rows="2">{{ $trip->extra_comment }}</textarea>
														@endif
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Department Approver </label>
														<select id="department_approver" name="department_approver" class="select2 form-control">
															<option value="{{ $approver->UserID }}">{{ $approver->LastName }} {{ $approver->FirstName }}</option>
														</select>
														@if($trip->status == 'partly-approved')
														<span class="fa fa-thumbs-o-down"></span>
														<strong> {{ ucfirst($trip->status)}} by: {{ ucfirst($approver->LastName) }} {{ $approver->FirstName }} on {{$trip->updated_at}}</strong>
														@endif
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 ">
													<div class="form-group">
														<label>Approver Comments</label>
														<textarea name="approver_comment" class="form-control" style="overflow-y: scroll;" disabled rows="2">{{ $trip->approver_comment }}</textarea>
													</div>
												</div>
											</div>
										</div>
										@if($trip->user_id == Auth::user()->UserID && ($trip->status == 'pending' || $trip->status == 'partly-approved' || $trip->status == 'rejected'))
										<div class="row form-actions text-right">
											<button type="submit" accesskey="D" class="btn red-mint">
												<i class="glyphicon glyphicon-new-window"></i> Resubmit
											</button>
										</div>
										@endif
									</div>
								</div>
								<!-- END VALIDATION STATES-->
							</div>
						</div>
			
			</form>
			<!-- END FORM-->
		</div>
	</div>
	<!--（Modal） -->
	<div class="modal fade" id="forApproval" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Arkema-eTravel Enterprise</h4>
				</div>
				<div class="modal-body">Are you sure you want to approve this travel request?</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
					<button type="button" class="btn btn-primary" id="approveBtn">YES</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal -->
	</div>
	<!--（Modal） -->
	<div class="modal fade" id="forPartlyApproval" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Arkema-eTravel Enterprise</h4>
				</div>
				<div class="modal-body">Are you sure you want to approve this partly travel request?</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
					<button type="button" class="btn btn-primary" id="partlyApproveBtn">YES</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal -->
	</div>
	<!--（Modal） -->
	<div class="modal fade" id="addNewLineModal" tabindex="-1" role="dialog" aria-labelledby="addNewLineModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title">Add New Line</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Date</label>
								<div style="position: relative;">
									<input type="text" name="datetime_date[]" class="form-control singleDatePicker">
									<i class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Time</label>
								<div class="input-group">
									<input type="text" name="datetime_time[]" class="form-control timepicker timepicker-default time-input" placeholder="">
									<span class="input-group-btn">
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
								<input type="text" name="location[]" class="form-control" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Customer Name</label>
								<input type="text" name="customer_name[]" class="form-control" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Contact Name</label>
								<input type="text" name="contact_name[]" class="form-control" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Purpose of Visit Category</label>
								<select class="form-control" name="purpose_id[]" id="purpose_id">
									@foreach ($purposeCats as $item)
									<option value="{{ $item['purpose_id'] }}">&lt;&nbsp;{{$item['purpose_catgory'] }}&nbsp;&gt;</option>
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
								<input type="text" name="travel_cost[]" value="0.00" class="form-control input-number admin-non-edit" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Estimated Entertainment Cost</label>
								<input type="text" name="entertain_cost[]" value="0.00" class="form-control input-number" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Estimated Details</label>
								<input type="text" name="entertain_detail[]" class="form-control" />
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
	<script>
	$('#department_id').on('change',function(){
		var department_id=$(this).val();
		$.get('/etravel/depApprover?department_id='+department_id,function(data){
			var depApproverOptions='';
			$.each(data,function(ind,val){
				depApproverOptions+='<option value="'+val.UserID+'">'+val.LastName+' '+val.FirstName+'</option>';
			});
				$('#department_approver').empty().append(depApproverOptions);
		});
		
	});
	
var total_approved_num = {{ count($demosticInfo) }};
$('#approveBtn').on('click',function(){
	$('form').submit();
});
$('#partlyApproveBtn').on('click',function(){
	$('form').submit();
});
$('#btnRejectTravel').on('click',function(){
	$('form').submit();
});

$('input').on('ifChanged', function(event){
	  var approved_num=$(":checkbox:checked").length;
// 	 	alert(approved_num)
		if(approved_num == total_approved_num){
			$('#btnApproveValidate').attr('disabled',false);
			$('#PartlybtnApproveValidate').attr('disabled',true);
			$('input[name="status"]').val('approved');
		}else if(approved_num > 0 && approved_num < total_approved_num){
			$('#btnApproveValidate').attr('disabled',true);
			$('#PartlybtnApproveValidate').attr('disabled',false);
			$('input[name="status"]').val('partly-approved');
		}else{
			$('#btnApproveValidate').attr('disabled',true);
			$('#PartlybtnApproveValidate').attr('disabled',true);
			
		}
});

</script>
	@endsection