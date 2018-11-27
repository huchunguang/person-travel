@extends("etravel.layout.main") @section("content")
<div class="row" style="margin: 10px;">
	<div class="col-md-3">
		<p class="text-left lead" style="margin-left: 10px;">TRIP SEARCH</p>
	</div>
	<div class="col-md-3">
		<p class="text-left lead portlet-title">MY TASKS</p>
	</div>
</div>
<div class="row" style="margin: 10px;">
	<div class="col-md-3">
		<ul id="myTab" class="nav nav-tabs">
			<li class="active">
				<a href="#home" data-toggle="tab">
					<span class="glyphicon glyphicon-plane"></span>
				</a>
			</li>
			<li>
				<a href="#teana" data-toggle="tab">
					<i class="fa fa-car"></i>
				</a>
			</li>
			<li>
				<a href="#camry" data-toggle="tab">
					<i class="fa fa-hotel"></i>
				</a>
			</li>
		</ul>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade in active" id="home">
				<form action="/etravel/trip" role="form" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row">
						<div class="col-md-8">
							<div class="input-group">
								<div class="icheck-inline">
									<label for="tabInternationalTrip">
										<input type="radio" name="trip" class="icheck" value="1" id="tabInternationalTrip" checked>
										<span style="font-size: 16px; padding-left: 13px; color: #337ab7;" class="bold">International Trip</span>
									</label>
								</div>
							</div>
							@if(Auth::user()->CountryAssignedID!=15)
							<div class="input-group">
								<div class="icheck-inline">
									<label for="domesticTrip">
										<input type="radio" name="trip" class="icheck" value="2" id="domesticTrip">
										<span style="font-size: 16px; padding-left: 13px; color: #337ab7;" class="bold">Domestic Trip</span>
									</label>
								</div>
							</div>
							@endif
						</div>
						<div class="col-md-4" style="margin-top: 10px;">
							<div>
								<button id="btnLeaveControl-Delete" type="submit" accesskey="N" class="btn green">
									<i class="glyphicon glyphicon-plus-sign"></i> <u>N</u>ew
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="tab-pane fade" id="teana">
				<form action="/etravel/trip" role="form" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="bycar" value="1">
					<div class="row">
						<div class="col-md-8">
							<div class="input-group">
								<div class="icheck-inline">
									<label for="tabInternationalTrip">
										<input type="radio" name="trip" class="icheck" value="1" id="tabInternationalTrip" checked>
										<span style="font-size: 16px; padding-left: 13px; color: #337ab7;" class="bold">International Trip</span>
									</label>
								</div>
							</div>
							@if(Auth::user()->CountryAssignedID!=15)
							<div class="input-group">
								<div class="icheck-inline">
									<label for="domesticTrip">
										<input type="radio" name="trip" class="icheck" value="2" id="domesticTrip">
										<span style="font-size: 16px; padding-left: 13px; color: #337ab7;" class="bold">Domestic Trip</span>
									</label>
								</div>
							</div>
							@endif
						</div>
						<div class="col-md-4" style="margin-top: 10px;">
							<div>
								<button id="btnLeaveControl-Delete" type="submit" accesskey="N" class="btn green">
									<i class="glyphicon glyphicon-plus-sign"></i> <u>N</u>ew
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="tab-pane fade" id="camry">
				<section class="text-center text-success bold">
					Pls. Click this link >
					<a href="http://aspa-ehotel-prod.ic.corp.local/pages/dashboard.php">www.arkema-ehotel.com</a>
					You can view here all the approved Arkema Corporate Hotel in Asia Pacific
				</section>
			</div>
		</div>
		<div class="portlet box" style="margin-top: 20px; border: 1px solid #337ab7; background-color: #337ab7;">
			<div class="portlet-title">
				<div class="caption">
					MY INCOMING TRIPS ({{sprintf('%02d',count($incomingTrips)) }}) <i class="glyphicon glyphicon-arrow-right"></i>
				</div>
				<div class="tools">
					<a title="" class="fullscreen" href="" data-original-title=""> </a>
				</div>
			</div>
			<div class="portlet-body policy-content portlet-collapsed" style="display: block; padding: 0px; height: 421px;">
				<div class="table-scrollable" style="overflow-y: auto; padding: 0px; margin: 0;">
					<table class="table table-light">
						<thead>
							<tr class="">
								<td class="">Date</td>
								<td class="">To</td>
								<td class="">AirLine Code</td>
								<td class="" style="width: 78px">ETA</td>
								<td class="" style="width: 78px">ETD</td>
							</tr>
						</thead>
						<tbody>
							@if(count($incomingTrips)) @foreach($incomingTrips as $item)
							<tr>
								<td class="highlight" data-toggle="tooltip" title="ETD: {{$item['etd_time']}},ETA: {{$item['eta_time']}}">
									<div class="success"></div>
									<a href="/etravel/tripnationallist/{{ $item['trip_id'] }}">{{$item->flight_date}} </a>
								</td>
								<td>{{$item->flight_to}}</td>
								<td>{{$item->air_code}}</td>
								<td>{{$item->eta_time}}</td>
								<td>{{$item->etd_time}}</td>
							</tr>
							@endforeach @else
							<tr>
								<td style="text-align: center; color: rgb(87, 142, 190);" colspan="5">No records found.</td>
								@endif
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="row">
			<div class="col-md-4">
				<!-- BEGIN PORTLET-->
				<div class="portlet light sameheight-box">
					<div class="portlet-title tabbable-line">
						<button type="button" class="btn btn-primary" style="margin-bottom: 10px; font-size: 28px;">{{ sprintf('%02d',count($pendingRequests)) }}</button>
						<div class="caption" style="float: right; margin-right: 10px;">
							<i class="icon-globe font-dark hide"></i>
							<span class="caption-subject policies-text bold uppercase">Open Requests </span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="table-scrollable">
							<table class="table table-light">
								<tbody>
									@if(count($pendingRequests)) @foreach($pendingRequests as $item)
									<tr>
										<td class="highlight">
											<div class="success"></div>
											@if($item['trip_type']=='1')
											<a href="/etravel/tripnationallist/{{ $item['trip_id'] }}">{{isset($item->destination_name)?$item->destination_name:'Destination'}} </a>
											@elseif($item['trip_type']=='2')
											<a href="/etravel/tripdemosticlist/{{ $item['trip_id'] }}">{{isset($item->destination_name)?$item->destination_name:'Destination'}} </a>
											@endif
										</td>
										<td class="hidden-xs">{{$item->daterange_from}}</td>
										<td>{{$item->daterange_to}}</td>
										<td>
											<i class="fa fa-arrow-right" style="color: orange;"></i>
										</td>
									</tr>
									@endforeach
									<tr>
										<td colspan="4" align="right">
											<a href="/etravel/{{Auth::user()->UserID}}/triplist?status=pending" target="_blank">See More</a>
										</td>
									</tr>
									@else
									<tr>
										<td style="text-align: center; color: rgb(87, 142, 190);" colspan="3">No records found.</td>
									</tr>
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- END PORTLET-->
			</div>
			<div class="col-md-4">
				<!-- BEGIN PORTLET-->
				<div class="portlet light sameheight-box">
					<div class="portlet-title tabbable-line">
						<button type="button" class="btn btn-primary" style="margin-bottom: 10px; font-size: 28px;">{{ sprintf('%02d',count($approved_request)) }}</button>
						<div class="caption" style="float: right; margin-right: 10px;">
							<i class="icon-globe font-dark hide"></i>
							<span class="caption-subject policies-text bold uppercase">APPROVED REQUEST</span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="table-scrollable">
							<table class="table table-light">
								<tbody>
									@if(count($approved_request)) @foreach($approved_request as $item)
									<tr>
										<td class="highlight">
											<div class="success"></div>
											@if($item['trip_type']=='1')
											<a href="/etravel/tripnationallist/{{ $item['trip_id'] }}">{{isset($item->destination_name)?$item->destination_name:'Destination'}} </a>
											@elseif($item['trip_type']=='2')
											<a href="/etravel/tripdemosticlist/{{ $item['trip_id'] }}">{{isset($item->destination_name)?$item->destination_name:'Destination'}} </a>
											@endif
										</td>
										<td class="hidden-xs">{{$item->daterange_from}}</td>
										<td>{{$item->daterange_to}}</td>
										<td>
											<i class="fa fa-check" style="color: green;"></i>
										</td>
									</tr>
									@endforeach
									<tr>
										<td colspan="4" align="right">
											<a href="/etravel/{{Auth::user()->UserID}}/triplist?status=approved" target="_blank">See More</a>
										</td>
									</tr>
									@else
									<tr>
										<td style="text-align: center; color: rgb(87, 142, 190);" colspan="3">No records found.</td>
										@endif
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- END PORTLET-->
			</div>
			<div class="col-md-4">
				<!-- BEGIN PORTLET-->
				<div class="portlet light sameheight-box">
					<div class="portlet-title tabbable-line">
						<button type="button" class="btn btn-primary" style="margin-bottom: 10px; font-size: 28px;">{{ sprintf('%02d',$staffTripCnt) }}</button>
						<div class="caption" style="float: right; margin-right: 10px;">
							<i class="icon-globe font-dark hide"></i>
							<span class="caption-subject policies-text bold uppercase">Manager Section</span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="portlet box blue-soft">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-male"></i>Staff Trips
								</div>
								<div class="tools">
									<a href="javascript:;" class="expand" data-original-title="" title=""> </a>
								</div>
							</div>
							<div class="portlet-body portlet-collapsed">
								<div class="table-scrollable">
									<table class="table table-light">
										<tbody>
											<tr>
												<td colspan="3" class="font-dark list-title">
													<i class="fa fa-upload">Pending</i>
												</td>
											</tr>
											@if(isset($staffTripList['pending']) && count($staffTripList['pending'])) @for ($i = 0; $i < count($staffTripList['pending']); $i++) @if($i<5)
											<tr>
												<td>
													@if($staffTripList['pending'][$i]['trip_type']=='1')
													<a href="/etravel/tripnationallist/{{ $staffTripList['pending'][$i]['trip_id'] }}">{{$staffTripList['pending'][$i]->user()->first()['FirstName']}}</a>
													@elseif($staffTripList['pending'][$i]['trip_type']=='2')
													<a href="/etravel/tripdemosticlist/{{ $staffTripList['pending'][$i]['trip_id'] }}">{{$staffTripList['pending'][$i]->user()->first()['FirstName']}}</a>
													@endif
												</td>
												<td>{{$staffTripList['pending'][$i]['daterange_from']}}</td>
												<td>{{$staffTripList['pending'][$i]['daterange_to']}}</td>
											</tr>
											@endif @endfor @else
											<tr>
												<td style="text-align: center; color: rgb(87, 142, 190);" colspan="3">No records found.</td>
											</tr>
											@endif
											<tr>
												<td colspan="3" class="font-dark list-title">
													<i class="fa fa-check-square-o">Approved</i>
												</td>
											</tr>
											@if(isset($staffTripList['approved']) && count($staffTripList['approved'])) @for ($i = 0; $i < count($staffTripList['approved']); $i++) @if($i<5)
											<tr>
												<td>
													@if($staffTripList['approved'][$i]['trip_type']=='1')
													<a href="/etravel/tripnationallist/{{ $staffTripList['approved'][$i]['trip_id'] }}">{{$staffTripList['approved'][$i]->user()->first()['FirstName']}}</a>
													@elseif($staffTripList['approved'][$i]['trip_type']=='2')
													<a href="/etravel/tripdemosticlist/{{ $staffTripList['approved'][$i]['trip_id'] }}">{{$staffTripList['approved'][$i]->user()->first()['FirstName']}}</a>
													@endif
												</td>
												<td>{{$staffTripList['approved'][$i]['daterange_from']}}</td>
												<td>{{$staffTripList['approved'][$i]['daterange_to']}}</td>
											</tr>
											@endif @endfor @else
											<tr>
												<td style="text-align: center; color: rgb(87, 142, 190);" colspan="3">No records found.</td>
											</tr>
											@endif
											<tr>
												<td colspan="3" class="font-dark list-title">
													<i class="fa fa-check-square-o">Partly Approved</i>
												</td>
											</tr>
											@if(isset($staffTripList['partly-approved']) && count($staffTripList['partly-approved'])) @for ($i = 0; $i < count($staffTripList['partly-approved']); $i++) @if($i<5)
											<tr>
												<td>
													@if($staffTripList['partly-approved'][$i]['trip_type']=='1')
													<a href="/etravel/tripnationallist/{{ $staffTripList['partly-approved'][$i]['trip_id'] }}">{{$staffTripList['partly-approved'][$i]->user()->first()['FirstName']}}</a>
													@elseif($staffTripList['partly-approved'][$i]['trip_type']=='2')
													<a href="/etravel/tripdemosticlist/{{ $staffTripList['partly-approved'][$i]['trip_id'] }}">{{$staffTripList['partly-approved'][$i]->user()->first()['FirstName']}}</a>
													@endif
												</td>
												<td>{{$staffTripList['partly-approved'][$i]['daterange_from']}}</td>
												<td>{{$staffTripList['partly-approved'][$i]['daterange_to']}}</td>
											</tr>
											@endif @endfor @else
											<tr>
												<td style="text-align: center; color: rgb(87, 142, 190);" colspan="3">No records found.</td>
											</tr>
											@endif
											<tr>
												<td colspan="3" class="font-dark list-title">
													<i class="fa fa-thumbs-down">Rejected</i>
												</td>
											</tr>
											@if(isset($staffTripList['rejected']) && count($staffTripList['rejected'])) @for ($i = 0; $i < count($staffTripList['rejected']); $i++) @if($i<5)
											<tr>
												<td>
													@if($staffTripList['rejected'][$i]['trip_type']=='1')
													<a href="/etravel/tripnationallist/{{ $staffTripList['rejected'][$i]['trip_id'] }}">{{$staffTripList['rejected'][$i]->user()->first()['FirstName']}}</a>
													@elseif($staffTripList['rejected'][$i]['trip_type']=='2')
													<a href="/etravel/tripdemosticlist/{{ $staffTripList['rejected'][$i]['trip_id'] }}">{{$staffTripList['rejected'][$i]->user()->first()['FirstName']}}</a>
													@endif
												</td>
												<td>{{$staffTripList['rejected'][$i]['daterange_from']}}</td>
												<td>{{$staffTripList['rejected'][$i]['daterange_to']}}</td>
											</tr>
											@endif @endfor @else
											<tr>
												<td style="text-align: center; color: rgb(87, 142, 190);" colspan="3">No records found.</td>
											</tr>
											@endif
											<tr>
												<td colspan="3" class="font-dark list-title">
													<i class="fa fa-times">Cancelled</i>
												</td>
											</tr>
											@if(isset($staffTripList['cancelled']) && count($staffTripList['cancelled'])) @for ($i = 0; $i < count($staffTripList['cancelled']); $i++) @if($i<5)
											<tr>
												<td>
													@if($staffTripList['cancelled'][$i]['trip_type']=='1')
													<a href="/etravel/tripnationallist/{{ $staffTripList['cancelled'][$i]['trip_id'] }}">{{$staffTripList['cancelled'][$i]->user()->first()['FirstName']}}</a>
													@elseif($staffTripList['cancelled'][$i]['trip_type']=='2')
													<a href="/etravel/tripdemosticlist/{{ $staffTripList['cancelled'][$i]['trip_id'] }}">{{$staffTripList['cancelled'][$i]->user()->first()['FirstName']}}</a>
													@endif
												</td>
												<td>{{$staffTripList['cancelled'][$i]['daterange_from']}}</td>
												<td>{{$staffTripList['cancelled'][$i]['daterange_to']}}</td>
											</tr>
											@endif @endfor @else
											<tr>
												<td style="text-align: center; color: rgb(87, 142, 190);" colspan="3">No records found.</td>
											</tr>
											@endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<div class="portlet box blue-soft">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-database"></i> Pending For My Approval
								</div>
								<div class="tools">
									<a href="javascript:;" class="expand" data-original-title="" title=""> </a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="table-scrollable">
									<table class="table table-light">
										<tbody>
											@if(isset($staffTripList['pending']) && count($staffTripList['pending'])) @for ($i = 0; $i < count($staffTripList['pending']); $i++) @if($i<7)
											<tr>
												<td>
													@if($staffTripList['pending'][$i]['trip_type']=='1')
													<a href="/etravel/tripnationallist/{{ $staffTripList['pending'][$i]['trip_id'] }}">{{$staffTripList['pending'][$i]->user()->first()['FirstName']}}</a>
													@elseif($staffTripList['pending'][$i]['trip_type']=='2')
													<a href="/etravel/tripdemosticlist/{{ $staffTripList['pending'][$i]['trip_id'] }}">{{$staffTripList['pending'][$i]->user()->first()['FirstName']}}</a>
													@endif
												</td>
												<td>{{$staffTripList['pending'][$i]['daterange_from']}}</td>
												<td>{{$staffTripList['pending'][$i]['daterange_to']}}</td>
											</tr>
											@endif @endfor @endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END PORTLET-->
			</div>
		</div>
		<div class="row" style="margin-top: 10px;">
			<div class="col-md-12">
				<div class="portlet box default">
					<div class="portlet-title">
						<div class="caption">Announcement</div>
						<div class="tools">
							<a title="" class="fullscreen" href="" data-original-title=""> </a>
						</div>
					</div>
					<div class="portlet-body policy-content portlet-collapsed" style="display: block; height: 66px; overflow-y: scroll;">{!! $generalAnnouncement['announcement'] or 'No Announcement' !!}</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
