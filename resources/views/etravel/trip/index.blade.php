@extends("etravel.layout.main") 
@section("content")
<div class="container">
	<div class="row">
		<div class="btn-group">
			<button class="btn btn-default dropdown-toggle"
				data-toggle="dropdown" type="button">
				REQUEST TYPE<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><a href="##">International</a></li>
				<li><a href="##">Demostic</a></li>
			</ul>
		</div>
		<div class="btn-group">
			<button class="btn btn-default dropdown-toggle"
				data-toggle="dropdown" type="button">
				STATUS<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><a href="##">pending</a></li>
				<li><a href="##">approved</a></li>
				<li><a href="##">draft</a></li>
			</ul>
		</div>
	</div>
	<div></div>
	<div class="row">
			<div class="panel panel-info">
				<div class="panel-heading" style="font-size: 25px;"><strong>Demostic</strong></div>
				<div class="panel-body">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr class="btn-primary roundborder">
                                                    <th colspan="1" style="text-align: right" class="nosort" data-sortcolumn="0" data-sortkey="0-0">Search:</th>
                                                    <th class="nosort" data-sortcolumn="1" data-sortkey="1-0"><input id="txtEmployeeSearch" type="text" placeholder="Search by Reference #" style="width: 100%;color:black"></th>
                                                    <th class="nosort" data-sortcolumn="2" data-sortkey="2-0"></th>
                                                    <th class="nosort" data-sortcolumn="3" data-sortkey="3-0"></th>
                                                    <th colspan="5" class="nosort" data-sortcolumn="4" data-sortkey="4-0"></th>
                                                </tr>
							<tr>
								<th>＃</th>
								<th>begin datetime</th>
								<th>end datetime</th>
								<th>extra comments</th>
								<th>pre-approval</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>
						@if (count($tripList) >0 )
							@foreach($tripList as $item)
								<tr>
									<td>{{ $item['trip_id'] }}</td>
									<td>{{ $item['begin_datetime'] }}</td>
									<td>{{ $item['end_datetime'] }}</td>
									<td>{{ $item['extra_comments'] }}</td>
									<td>{{ $item['pre_purchase'] }}</td>
									<td><a href="#"><span class="glyphicon glyphicon-hand-up" style="color:green"></span></a></td>
								</tr>
							@endforeach
						@endif
						</tbody>
					</table>
				
				</div>
				<div class="panel-footer">
					@if (count($tripList) == 0 )
					<p class="text-center text-danger"><strong>No records found.</strong></p>
					@else
					<?php echo $tripList->render();?>
					@endif
				</div>
			</div>
		</div>
</div>
@endsection
