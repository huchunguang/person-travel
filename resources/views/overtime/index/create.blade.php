@extends("overtime.layout.main")

@section('styles')
	 <!-- BEGIN PAGE LEVEL PLUGINS(DATE TIME) -->
        <link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS(DATE TIME) -->
@endsection

@section('script.header')
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
@endsection 

@section("content")
<div class="col-md-12">
	<!-- BEGIN SAMPLE FORM PORTLET-->
	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">OverTime Request Form</span>
			</div>
			
		</div>
		<div class="portlet-body form">
			<form class="form-horizontal" role="form" action="{{url('/overtime/store')}}" method="post">
				@include('layout.error')
				<div class="form-body">
					<input type="hidden" name="_token" value="{{csrf_token()}}"/>
					<input type="hidden" name="user_id" value="{{$currentUser->UserID}}"/>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-3 control-label">Requestor Name</label>
								<div class="col-md-9">
									<input type="text" class="form-control" placeholder="{{Auth::user()->LastName}}{{Auth::user()->FirstName}}--{{Auth::user()->UserName}}" disabled>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-3 control-label">Site</label>
								<div class="col-md-9">
									<select class="form-control select2">
										<option>{{$currentUser->site()->first()->Site}}</option>
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
									<select class="form-control select2" name="igg">
										@if(count($iggAll))
											@foreach($iggAll as $iggItem)
												<option value="{{$iggItem['id']}}">{{$iggItem['igg']}}</option>
											@endforeach
										@endif
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-3 control-label">Department</label>
								<div class="col-md-9">
									<select class="form-control select2">
										<option>{{$currentUser->department()->first()->Department}}</option>
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
									<select class="form-control select2">
										<option>{{$currentUser->WorkPosition}}</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-3 control-label">Head Count</label>
								<div class="col-md-9">
									<input type="text" class="form-control" placeholder="" name="head_count">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-3 control-label">Shift</label>
								<div class="col-md-9">
									<select class="form-control select2" name="shift">
										@if(count($shiftAll))
											@foreach($shiftAll as $shiftItem)
												<option value ="{{$shiftItem['id']}}">{{$shiftItem['shift']}}</option>
											@endforeach
										@endif
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-3 control-label">No. of Hour</label>
								<div class="col-md-9">
									<input type="text" class="form-control" placeholder="0" name="hours">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-3 control-label">Rate</label>
								<div class="col-md-9">
									<select class="form-control select2" name="rate">
										@if(count($rateAll))
											@foreach($rateAll as $rateItem)
												<option value ="{{$rateItem['id']}}">{{$rateItem['rate']}}</option>
											@endforeach
										@endif
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-3 control-label">Reason</label>
								<div class="col-md-9">
									<select class="form-control select2" name="reason">
										@if(count($reasonAll))
											@foreach($reasonAll as $reasonItem)
												<option value ="{{$reasonItem['id']}}">{{$reasonItem['reason_subject']}}</option>
											@endforeach
										@endif
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
										<input type="text" class="form-control date-picker" name="start_date" data-date-format="yyyy-mm-dd" data-date-start-date="+0d"> <span class="input-group-btn">
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
										<input type="text" class="form-control date-picker" name="end_date" data-date-format="yyyy-mm-dd" data-date-start-date="+0d"> <span class="input-group-btn">
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
									<select class="form-control select2" name="hr_approver">
									@if($hrUserList)
										@foreach($hrUserList as $hrUser)
										<option value="{{$hrUser->UserID}}">{{$hrUser->LastName}} {{$hrUser->FirstName}}</option>
										@endforeach
									@endif
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
							<textarea class="form-control" rows="4" name="remark"></textarea>
						</div>
					</div>
					
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn green">Submit</button>
							<button type="button" class="btn default">Cancel</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

