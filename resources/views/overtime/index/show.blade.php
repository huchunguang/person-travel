@extends("overtime.layout.main") @section('styles')
<!-- BEGIN PAGE LEVEL PLUGINS(DATE TIME) -->
<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS(DATE TIME) -->
@endsection @section('script.header')
<!-- BEGIN PAGE LEVEL PLUGINS(DATE TIME) -->
<script src="{{asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/clockface/js/clockface.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS(DATE TIME) -->
<!-- BEGIN PAGE LEVEL SCRIPTS(DATE TIME) -->
<script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS(DATE TIME) -->
@endsection @section("content")
<div class="col-md-12">
	<!-- BEGIN SAMPLE FORM PORTLET-->
	@if($overtime->status=='approved')
	<div class="portlet box blue-steel">
		@elseif($overtime->status=='pending')
		<div class="portlet box green">
			@elseif($overtime->status=='rejected')
			<div class="portlet box red">
				@elseif($overtime->status=='partly-approved')
				<div class="portlet box yellow-crusta">
					@elseif($overtime->status=='cancelled')
					<div class="portlet box grey">
						@else
						<div class="portlet box dark">
							@endif
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-settings font-green"></i>
									<span class="caption-subject sbold uppercase">OverTime Request Form Detail ({{$overtime->status}})</span>
								</div>
							</div>
							<div class="portlet-body form">
								<form class="form-horizontal" role="form" action="/overtime/edit/{{$overtime->id}}" method="get">
									<div class="form-body">
										<input type="hidden" name="_token" value="{{csrf_token()}}" />
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">Requestor Name</label>
													<div class="col-md-9">
														<input type="text" class="form-control" placeholder="{{$overtime->user()->first()->LastName}} {{$overtime->user()->first()->FirstName}}--{{$overtime->user()->first()->UserName}}" disabled>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">Site</label>
													<div class="col-md-9">
														<select class="form-control select2" disabled>
															<option>{{$overtime->user()->first()->site()->first()->Site}}</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">IGG</label>
													<div class="col-md-9">
														<select class="form-control select2" name="igg" disabled>
															@if(count($iggAll)) @foreach($iggAll as $iggItem) @if($overtime['igg'] == $iggItem['id'])
															<option value="{{$iggItem['id']}}" selected>{{$iggItem['igg']}}</option>
															@else
															<option value="{{$iggItem['id']}}">{{$iggItem['igg']}}</option>
															@endif @endforeach @endif
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">Department</label>
													<div class="col-md-9">
														<select class="form-control select2" disabled>
															<option>{{$overtime->user()->first()->department()->first()->Department}}</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">Position</label>
													<div class="col-md-9">
														<select class="form-control select2" disabled>
															<option>{{$overtime->user()->first()->WorkPosition}}</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">Head Count</label>
													<div class="col-md-9">
														<input type="text" class="form-control" placeholder="" name="head_count" value="{{$overtime['head_count']}}" disabled>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">Shift</label>
													<div class="col-md-9">
														<select class="form-control select2" name="shift" disabled>
															@if(count($shiftAll)) @foreach($shiftAll as $shiftItem) @if($overtime['shift'] == $shiftItem['id'])
															<option value="{{$shiftItem['id']}}" selected>{{$shiftItem['shift']}}</option>
															@else
															<option value="{{$shiftItem['id']}}">{{$shiftItem['shift']}}</option>
															@endif @endforeach @endif
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">No. of Hour</label>
													<div class="col-md-9">
														<input type="text" class="form-control" placeholder="0" name="hours" value="{{$overtime['hours']}}" disabled>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">Rate</label>
													<div class="col-md-9">
														<select class="form-control select2" name="rate" disabled>
															@if(count($rateAll)) @foreach($rateAll as $rateItem) @if($overtime['rate'] == $rateItem['id'])
															<option value="{{$rateItem['id']}}" selected>{{$rateItem['rate']}}</option>
															@else
															<option value="{{$rateItem['id']}}">{{$rateItem['rate']}}</option>
															@endif @endforeach @endif
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">Reason</label>
													<div class="col-md-9">
														<select class="form-control select2" name="reason" disabled>
															@if(count($reasonAll)) @foreach($reasonAll as $reasonItem) @if($overtime['reason'] == $reasonItem['id'])
															<option value="{{$reasonItem['id']}}" selected>{{$reasonItem['reason_subject']}}</option>
															@else
															<option value="{{$reasonItem['id']}}">{{$reasonItem['reason_subject']}}</option>
															@endif @endforeach @endif
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">Overtime Start Date</label>
													<div class="col-md-9">
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
															<input type="text" class="form-control" name="start_date" value="{{$overtime['start_date']}}" disabled>
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
													<label class="col-md-3 control-label">Overtime End Date</label>
													<div class="col-md-9">
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
															<input type="text" class="form-control" name="end_date" value="{{$overtime['end_date']}}" disabled>
															<span class="input-group-btn">
																<button class="btn default" type="button">
																	<i class="fa fa-calendar"></i>
																</button>
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">HR Approver</label>
													<div class="col-md-9">
														<select class="form-control select2" name="hr_approver" disabled>
															@if(count($hrUserList)) @foreach($hrUserList as $hrUser) @if($overtime['hr_approver']==$hrUser['UserID'])
															<option value="{{$hrUser->UserID}}" selected>{{$hrUser->LastName}} {{$hrUser->FirstName}}</option>
															@else
															<option value="{{$hrUser->UserID}}">{{$hrUser->LastName}} {{$hrUser->FirstName}}</option>
															@endif @endforeach @endif
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">Remark</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<textarea class="form-control" rows="4" name="remark" disabled>{{$overtime['remark']}}</textarea>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												@if($overtime->user_id==$currentUser->UserID && ($overtime->status == 'pending' || $overtime->status == 'partly-approved' || $overtime->status == 'rejected'))
												<button type="submit" class="btn green">
													<i class="fa fa-pencil"></i>Edit
												</button>
												@endif @if($overtime->user_id==$currentUser->UserID && ($overtime->status == 'pending'))
												<button type="button" class="btn default" onclick="window.location.href='/overtime/{{$overtime->id}}/cancel'">
													<i class="fa fa-share"></i>Cancel
												</button>
												@endif
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					@endsection