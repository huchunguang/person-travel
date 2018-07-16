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
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-database"></i>OVERTIME REQUEST LIST
				</div>
				<div class="tools">
				</div>
			</div>
			<div class="portlet-body">
				<!-- 						<div class="row"><div class="col-md-6 col-sm-12"><div class="dataTables_length" id="TblOvertimeList_length"><label><select name="TblOvertimeList_length" aria-controls="TblOvertimeList" class="form-control input-sm input-xsmall input-inline"><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="-1">All</option></select> entries</label></div></div><div class="col-md-6 col-sm-12"><div id="TblOvertimeList_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm input-small input-inline" placeholder="" aria-controls="TblOvertimeList"></label></div></div></div> -->
				<table class="table table-striped table-bordered" id="TblOvertimeList" style="width:100%;">
					<thead>
						<tr>
							<th>Reference #</th>
							<th>Position</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Head Count</th>
							<th>Shift</th>
							<th>Rate</th>
							<th>No. of hours</th>
							<th>Reason</th>
							<th>Request Date</th>
							<th>Remark</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Reference #</th>
							<th>Position</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Head Count</th>
							<th>Shift</th>
							<th>Rate</th>
							<th>No. of hours</th>
							<th>Reason</th>
							<th>Request Date</th>
							<th>Remark</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
