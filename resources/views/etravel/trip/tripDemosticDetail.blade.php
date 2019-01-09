@extends("etravel.layout.main") @section("content")
<div class="container">
	<div class="page-content-inner">
		<div class="row">
			<form action="/etravel/tripapproval/{{$trip->trip_id}}" method="post" class="horizontal-form" id="domestic_approval">
				@if($trip->status == 'pending' && $trip->department_approver == Auth::user()->UserID ) @include('etravel.layout.approverAction') @endif @include('etravel.layout.error')
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
												<span class="caption-subject bold uppercase">{{ $trip->status }}</span>
											</div>
										</div>
										<div class="portlet-body form">
											<div class="form-body">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="_method" value="PUT" />
												<input type="hidden" name="status" value="approved" />
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
															<input disabled type="text" class="form-control" placeholder="{{ $applicantUser->FirstName }} {{ $applicantUser->LastName }}-{{ $applicantUser->UserName }}">
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
													
														<div class="form-group">
															<label class="control-label">Request For</label>
															<input disabled type="text" class="form-control" placeholder="{{ $userObjMdl->FirstName }} {{ $userObjMdl->LastName }}-{{ $userObjMdl->UserName }}">
														</div>
														
														
													</div>
													<!--/span-->
												</div>
												<div class="row">
													<div class="col-md-6">
													<div class="form-group">
															<label class="control-label">Site</label>
															<select id="Site" name="Site" disabled class="select2 form-control">
																<option value="0">{{ $userObjMdl->site()->first()['Site'] }}</option>
															</select>
														</div>
														
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Department</label>
															<select id="Department" name="Department" disabled class="select2 form-control">
																<option value="0">{{$department}}</option>
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
																<input type="text" name="daterange_from" disabled value="{{ $trip->daterange_from }}" class="form-control">
																<i class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; bottom: 10px; right: 10px; top: auto; cursor: pointer;"></i>
															</div>
															<div class="col-md-6" style="padding-right: 0px;">
																<input type="text" name="daterange_to" disabled value="{{ $trip->daterange_to }}" class="form-control">
																<i class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; bottom: 10px; right: 10px; top: auto; cursor: pointer;"></i>
															</div>
														</div>
													</div>
													<div class="col-md-6">
													<div class="form-group">
															<label class="control-label">Cost Center</label>
															<select name="cost_center_id" class="select2 form-control" disabled>
																<option>{{ $costCenterCode }}</option>
															</select>
														</div>
														
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Project Code</label>
															<input type="text" name="project_code" class="form-control" disabled value="{{ $trip->wbsCode()->first()['wbs_code'] }}" />
														</div>
													</div>
													<div class="col-md-6">
														@if($trip->cc)
														<div class="form-group">
															<label class="control-label">CC</label>
															<select name="CC" class="form-control select2" disabled multiple>
																@foreach($trip->cc as $item)
																<option value="{{$item}}" selected>{{$item}}</option>
																@endforeach
															</select>
														</div>
														@endif
													</div>
												</div>
												<hr class="divider" />
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
																	<td class="text-center">Date</td>
																	<td class="text-center">Time</td>
																	<td class="text-center">Location</td>
																	<td class="text-center">Company Name</td>
																	<td class="text-center">Contact Name</td>
																	<td class="text-center">Purpose of Visit Category</td>
																	<td class="text-center">Purpose of Visit Description</td>
																	<td class="text-center">Estimated Travel Cost</td>
																	<td class="text-center">Estimated Entertainment Cost</td>
																	<td class="text-center">Details</td> @if($trip->status == 'pending' && $trip->department_approver == Auth::user()->UserID )
																	<td class="text-center text-danger">Approved?</td> @elseif($trip->status == 'approved' || $trip->status=='partly-approved')
																	<td class="text-center">Approved?</td> @endif
																</tr>
															</thead>
															<tbody>
																@foreach($demosticInfo as $item)
																<tr id="trOne">
																	<td>{{ $item['datetime_date'] }}</td>
																	<td>{{ $item['datetime_time'] }}</td>
																	<td>{{ $item['location'] }}</td>
																	<td>{{ $item['customer_name'] }}</td>
																	<td>{{ $item['contact_name'] }}</td>
																	<td>{{ $item->visitPurpose()->first()['purpose_catgory'] }}</td>
																	<td data-toggle="tooltip" title="{{$item['purpose_desc']}}">{{ str_limit($item['purpose_desc'],10) }}</td>
																	<td>{{ $item['travel_cost'] }}</td>
																	<td>{{ $item['entertain_cost'] }}</td>
																	<td>{{ $item['entertain_detail'] }}</td> @if($trip->status == 'pending' && $trip->department_approver == Auth::user()->UserID)
																	<td>@if($item['is_approved'] == '0') <input type="hidden" name="id[]" value="{{$item['id']}}" />
																		<div class="input-group">
																			<div class="icheck-inline">
																				<label class="">
																					<div class="icheckbox_minimal-grey" style="position: relative;">
																						<input type="checkbox" class="icheck domesticIcheck" name="is_approve_{{$item['id']}}" style="position: absolute; opacity: 0;" checked>
																						<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																					</div>
																					YES
																				</label>
																			</div>
																		</div> @elseif($item['is_approved']== '1') YES @endif
																	</td> @endif @if($trip->status=='approved' || $trip->status=='partly-approved')
																	<td>@if($item['is_approved']==1) YES @elseif($item['is_approved']==0) NO @endif</td> @endif
																</tr>
																@endforeach
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
															<input disabled type="text" class="form-control" id="advance_amount" name="advance_amount" value="{{$trip->advance_amount}}">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Amount Currency</label>
															<select id="amount_currency" name="amount_currency" class="form-control input-sm select2" disabled>
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
													<div class="col-md-12 ">
														<div class="form-group">
															<label class="uppercase">Extra Comments</label>
															<textarea name="extra_comment" class="form-control" disabled style="overflow-y: scroll;" rows="2">{{ $trip->extra_comment }}</textarea>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Department Approver</label>
															<select name="department_approver" class="select2 form-control" disabled>
																<option value="{{ $approver->FirstName }}">{{ $approver->LastName }} {{ $approver->FirstName }}</option>
															</select>
															<div style="background-color: #32c5d2;margin-top:2px;">
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
															@endif
															{{ ucfirst($trip->status)}} by: @if($trip->status != 'cancelled') {{ ucfirst($approver->LastName) }} {{ $approver->FirstName }} @else {{ ucfirst($userObjMdl->FirstName) }} {{ ucfirst($userObjMdl->LastName) }} @endif on {{$trip->updated_at}}
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 ">
														<div class="form-group">
															<label>Approver Comments</label>
															<textarea name="approver_comment" class="form-control" style="overflow-y: scroll;" disabled rows="2">{{$trip->approver_comment}}</textarea>
														</div>
													</div>
												</div>
											</div>
											<div class="row form-actions text-right">
												@if(($trip->user_id == Auth::user()->UserID || $trip->applicant_id == Auth::user()->UserID) && ($trip->status == 'pending' || $trip->status == 'partly-approved' || $trip->status == 'rejected'))
												<button id="TravelTypeEdit" type="button" accesskey="I" onclick="window.location.href='/etravel/trip/edit/{{$trip->trip_id}}'" class="btn yellow-gold leave-type-button">
													<i class="fa fa-pencil"></i> Ed<u>i</u>t
												</button>
												@endif @if(($trip->user_id == Auth::user()->UserID || $trip->applicant_id == Auth::user()->UserID) && ($trip->status == 'pending' || $trip->status == 'partly-approved'))
												<button id=TravelTypeCancel type="button" accesskey="D" onclick="window.location.href='/etravel/trip/cancel/{{$trip->trip_id}}'" class="btn default">
													<i class="fa fa-share"></i> <u>C</u>ancel
												</button>
												@endif
											</div>
										</div>
									</div>
									<!-- END VALIDATION STATES-->
								</div>
							</div>
			
			</form>
			<!-- END FORM-->
		</div>
	</div>
	@include('etravel.modal.forApproval') @include('etravel.modal.forPartlyApproval')
	<script>
var total_approved_num = {{$approvedCnt}};
$('#approveBtn').on('click',function(){
	$('#domestic_approval').submit();
	$('#approveBtn').prop('disabled',true);
});
$('#partlyApproveBtn').on('click',function(){
	$('#domestic_approval').submit();
	$('#partlyApproveBtn').prop('disabled',true);
});
$('#btnRejectTravel').on('click',function(){
	$('input[name="status"]').val('rejected');
	$('#domestic_approval').submit();
	$('#btnRejectTravel').prop('disabled',true);
});

$('input[name^="is_approve"]').on('ifChanged', function(event){
	  var approved_num=$("#domestic_approval :checkbox:checked").length;
// 	 	alert(approved_num)
// 	 	alert(total_approved_num)
		if(approved_num == total_approved_num){
			$('#btnApproveValidate').attr('disabled',false);
			$('#btnRejectTravel').attr('disabled',false);
			$('#PartlybtnApproveValidate').attr('disabled',true);
			$('input[name="status"]').val('approved');
		}else if(approved_num > 0 && approved_num < total_approved_num){
			$('#btnApproveValidate').attr('disabled',true);
			$('#btnRejectTravel').attr('disabled',true)
			$('#PartlybtnApproveValidate').attr('disabled',false);
			$('input[name="status"]').val('partly-approved');
		}else{
			$('#btnApproveValidate').attr('disabled',true);
			$('#PartlybtnApproveValidate').attr('disabled',true);
			$('#btnRejectTravel').attr('disabled',false)
			
		}
});

</script>
	@endsection