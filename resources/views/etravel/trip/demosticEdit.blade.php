@extends("etravel.layout.main") 
@section("content")
<div class="container">
	<div class="page-content-inner">
		<div class="row">
			<form action="/etravel/trip/update" method="post" class="horizontal-form">
		
			@if($trip->status == 'pending' && $trip->department_approver == 346 )
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
				@endif
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-bubble"></i> <span
								class="caption-subject bold uppercase">{{ $trip->status }}</span>
						</div>
					</div>
					<div class="portlet-body form">
							<div class="form-body">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="_method" value="PUT"/>
								<input type="hidden" name="status" value="rejected"/>
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
												placeholder="{{ $userObjMdl->FirstName }}">
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">SITE</label> <select id="Site"
												name="Site" disabled=""
												class="cboSelect2 leave-control form-control" tabindex="-1">
												<option value="0">&lt;&nbsp; {{ $userObjMdl->site()->first()['Site'] }}&nbsp;&gt;</option>
											</select>


										</div>
									</div>
									<!--/span-->
								</div>

								<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Cost Center</label> 
											<select name="cost_center_id" class="cboSelect2 leave-control form-control" tabindex="-1">
												<option >&lt;&nbsp;{{ $costCenterCode }}&nbsp;&gt;</option>
											</select>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Department</label> 
											<select id="Department" name="Department" disabled="" class="cboSelect2 leave-control form-control" tabindex="-1">
												<option value="0">&lt;&nbsp;{{ $userObjMdl->department()->first()['Department']}}&nbsp;&gt;</option>
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
										class="form-control singleDatePicker"  value="{{ $trip->daterange_from }}"> <i
										class="glyphicon glyphicon-calendar fa fa-calendar"
										style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
								</div>
								<div class="col-md-4">
									<input type="text" name="daterange_to" 
										class="form-control singleDatePicker" value="{{ $trip->daterange_to }}"> <i
										class="glyphicon glyphicon-calendar fa fa-calendar"
										style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
								</div>


										</div>

									</div>
								</div>
								<hr class="divider" />


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
										<tr id="trOne" >
											<td>
												@if($trip->status == 'partly-approved' && $item->is_approved == '0')
												{{ $item['datetime_date'] }}
												@elseif(($trip->status == 'pending') || ($trip->status == 'partly-approved' && $item->is_approved == '0'))
												<div style="position: relative;">
																<input type="text" name="datetime_date[]" value="{{ $item['datetime_date'] }}"
																	class="form-control singleDatePicker"> <i
																	class="glyphicon glyphicon-calendar fa fa-calendar"
																	style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
															</div>
												
												@endif
											</td>
											<td>
												{{ $item['datetime_time'] }}
											</td>
											<td>{{ $item['location'] }}</td>
											<td>{{ $item['customer_name'] }}</td>
											<td>{{ $item['contact_name'] }}</td>
											<td>
												{{ $item->visitPurpose()->first()['purpose_catgory'] }}
											</td>
											<td>
												{{ $item['purpose_desc'] }}
											</td>
											<td>
												{{ $item['travel_cost'] }}
											</td>
											<td>
												{{ $item['entertain_cost'] }}
											</td>
											<td>
												{{ $item['entertain_detail'] }}
											</td>
											
												@if($trip->status=='partly-approved')
													<td>
														@if($item['is_approved']==1)
															YES
														@elseif($item['is_approved']==0)
															NO
														@endif
													</td>
												@endif
											
											
										</tr>
									@endforeach
										</tbody>
									</table>
								</div>
								<div class="row">
									<div class="col-md-12 ">
										<div class="form-group">
											<label>Extra Comments</label>
											<textarea name="extra_comment" class="form-control" disabled
										style="overflow-y: scroll;" rows="2">{{ $trip->extra_comment }}</textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Department Approver
											</label> 
											<select name="department_approver" class="cboSelect2 leave-control form-control" tabindex="-1" disabled>
												<option value="">&lt;&nbsp;{{ $approver->FirstName }}&nbsp;&gt;</option> 
											</select>
											<span class="fa fa-thumbs-o-down"></span> <strong> Rejected by: ILANO Victor on 11/30/2017 06:23:04 PM</strong> 
											
										</div>
									</div>
								</div>

								<div class="row">

									<div class="col-md-12 ">
										<div class="form-group">
											<label>Approver Comments</label>
											<textarea name="approver_comment"
									class="form-control leave-control" style="overflow-y: scroll;" disabled
									rows="2">{{ $trip->approver_comment }}</textarea>
										</div>
									</div>

								</div>
								
								

							</div>
						
							@if($trip->user_id == Auth::user()->UserID && $trip->status == 'pending')
								<div class="row form-actions text-right">
									<button id="TravelTypeEdit" type="button" accesskey="I" class="btn yellow-gold leave-type-button">
										<a href="/etravel/trip/edit/{{$trip->trip_id}}"> <i class="fa fa-pencil"></i> Ed<u>i</u>t</a>
										
									</button>
								
                                 	<button id="btnLeaveControl-Delete" type="button" accesskey="D" class="btn red-mint"><i class="glyphicon glyphicon-new-window"></i> Resubmit</button>
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<script>
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