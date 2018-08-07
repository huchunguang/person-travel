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
	@include('layout.error')
	<!-- BEGIN SAMPLE TABLE PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-comments"></i>List of Rate
			</div>
			<div class="actions">
<!-- 				saveIggBut -->
				<div class="btn-group btn-group-devided" data-toggle="modal" data-target="#newRate" accessKey="N">
					<label class="btn blue-steel leave-type-button">
						<i class="fa fa-plus"></i><u>N</u>EW
					</label>
				</div>
			</div>
		</div>
		<div class="portlet-body" style="display: block;">
			<div class="table-scrollable">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Rate</th>
							<th>Create Time</th>
							<th>Update Time</th>
							<th>Operation</th>
						</tr>
					</thead>
					<tbody>
						@if(count($rateList)>0) 
						@foreach($rateList as $item)
						<tr id="TableClassRowID-{{$item->id}}">
							<td>{{$item['id']}}</td>
							<td>{{$item['rate']}}</td>
							<td>{{$item['created_at']}}</td>
							<td>{{$item['updated_at']}}</td>
							<td>
								<button type="button" onclick="rateEdit({{$item['id']}})" accesskey="E" class="btn yellow-gold">
									<i class="fa fa-pencil"></i> Ed<u>i</u>t
								</button>
								<button type="button" onclick="rateDel({{$item['id']}})" accesskey="D" class="btn red-mint">
									<i class="fa fa-times"></i> <u>D</u>elete
								</button>
							</td>
						</tr>
						@endforeach 
						@else
						<tr>
							<td align="center" colspan="8" style="color: red" data-value=" No records found.">No records found.</td>
						</tr>
						@endif
					</tbody>
				</table>
				<?php echo $rateList->render();?>
			</div>
		</div>
	</div>
</div>
<script src="{{asset('/js/overtime/rate/index.js')}}"></script>
@include('overtime.modal.newRate') 
@endsection
