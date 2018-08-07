@extends("overtime.layout.main") @section('styles')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS(DATATABLES) -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ asset('assets/pages/css/profile.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/apps/css/ticket.min.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
@endsection @section('script.header')
<!-- BEGIN PAGE LEVEL PLUGINS(DATATABLE) -->
<script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS(DATATABLE) -->
<!-- BEGIN PAGE LEVEL SCRIPTS(DATATABLE) -->
<script src="{{asset('assets/pages/scripts/table-datatables-rowreorder.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS(DATATABLE) -->
<script src="{{asset('assets/pages/scripts/profile.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/table-datatables-managed.js')}}" type="text/javascript"></script>
@endsection @section("content")
<div class="row" style="margin-left: 10px;">
	<div class="col-md-12">
		@if($status=='approved')
		<div class="portlet box blue-steel">
			@elseif($status=='pending')
			<div class="portlet box green">
				@elseif($status=='rejected')
				<div class="portlet box red">
					@elseif($status=='partly-approved')
					<div class="portlet box yellow-crusta">
						@elseif($status=='cancelled')
						<div class="portlet box grey">
							@else
							<div class="portlet box dark">
								@endif
								<div class="portlet-title">
									<div class="caption uppercase">
										<i class="fa fa-database"></i> {{$status}} Approval List
										<input type="hidden" name="status" value="{{$status}}" />
									</div>
									<div class="actions">
										<div class="btn-group">
											<a class="btn btn-sm blue dropdown-toggle" href="javascript:;" data-toggle="dropdown">
												Status <i class="fa fa-angle-down"></i>
											</a>
											<ul class="dropdown-menu pull-right">
												<li>
													<a href="{{url('overtime/approvalList/pending')}}" class="bold">
														<span class="glyphicon glyphicon-hand-right" style="color: green"></span>
														Pending
													</a>
												</li>
												<li>
													<a href="{{url('overtime/approvalList/approved')}}" class="bold">
														<span class="fa fa-check-circle-o" style="color: green"></span>
														Approved
													</a>
												</li>
												<li>
													<a href="{{url('overtime/approvalList/rejected')}}" class="bold">
														<span class="glyphicon glyphicon-thumbs-down" style="color: red"></span>
														Rejected
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="portlet-body">
									<div class="table-toolbar">
										@if($status=='pending')
										<div class="row">
											<div class="col-md-6">
												<div class="btn-group">
													<button id="sample_editable_1_new" class="btn sbold green" data-toggle="modal" data-target="#forApproval">
														<i class="fa fa-thumbs-up"></i>Approve
													</button>
													<button id="sample_editable_1_new" class="btn sbold red" data-toggle="modal" data-target="#forReject">
														<i class="fa fa-thumbs-down"></i> Reject
													</button>
												</div>
											</div>
											<div class="col-md-6"></div>
										</div>
										@endif
									</div>
									<form action="{{url('overtime/approve')}}" method="post" id="overtime_approval">@if($status=='pending') @include('overtime.snippets.approvalOvertimeList') @else @include('overtime.snippets.staffOvertimeList') @endif @include('overtime.modal.forApproval') @include('overtime.modal.forReject')</form>
								</div>
							</div>
						</div>
					</div>
					@endsection