@extends("overtime.layout.main") @section('styles')
<!-- BEGIN PAGE LEVEL PLUGINS(DATATABLES) -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS(DATATABLES) -->
@endsection @section('script.header')
<!-- BEGIN PAGE LEVEL PLUGINS(DATATABLE) -->
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS(DATATABLE) -->
<!-- BEGIN PAGE LEVEL SCRIPTS(DATATABLE) -->
<script src="{{asset('assets/pages/scripts/table-datatables-rowreorder.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS(DATATABLE) -->
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
									<div class="caption">
										<i class="fa fa-database"></i>
										<span class="uppercase">{{$status}}</span>
										OVERTIME REQUEST LIST
										<input type="hidden" name="status" value="{{$status}}" />
									</div>
									<div class="actions">
										<div class="btn-group">
											<a class="btn btn-sm blue dropdown-toggle" href="javascript:;" data-toggle="dropdown">
												Status <i class="fa fa-angle-down"></i>
											</a>
											<ul class="dropdown-menu pull-right">
												<li>
													<a href="{{url('overtime/list?status=pending')}}" class="bold">
														<span class="glyphicon glyphicon-hand-right" style="color: green"></span>
														Pending
													</a>
												</li>
												<li>
													<a href="{{url('overtime/list?status=approved')}}" class="bold">
														<span class="fa fa-check-circle-o" style="color: green"></span>
														Approved
													</a>
												</li>
												<li>
													<a href="{{url('overtime/list?status=rejected')}}" class="bold">
														<span class="glyphicon glyphicon-thumbs-down" style="color: red"></span>
														Rejected
													</a>
												</li>
												<li>
													<a href="{{url('overtime/list?status=cancelled')}}" class="bold">
														<span class="fa fa-exclamation-triangle" style="color: red"></span>
														Cancelled
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="portlet-body">@include('overtime.snippets.overtimeList')</div>
							</div>
						</div>
					</div>
					@endsection