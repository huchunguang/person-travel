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
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-database"></i><span class="uppercase">{{$status}}</span> OVERTIME REQUEST LIST
					<input type="hidden" name="status" value="{{$status}}"/>
				</div>
				<div class="tools">
				</div>
			</div>
			<div class="portlet-body">
			@include('overtime.snippets.overtimeList')
			</div>
		</div>
	</div>
</div>
@endsection
