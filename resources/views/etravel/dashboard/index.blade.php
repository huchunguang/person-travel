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
			<li class="active"><a href="#home" data-toggle="tab"> <span
					class="glyphicon glyphicon-plane"></span>
			</a></li>
			<li><a href="#teana" data-toggle="tab"> 
				<i class="fa fa-car"></i>
			</a></li>
			<li><a href="#camry" data-toggle="tab"> 
				<i class="fa fa-hotel"></i>
			</a></li>
		</ul>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade in active" id="home">
				<form action="/etravel/trip" role="form" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<input type="radio" name="trip" value="international"/> <a href="javascript:;"
							class="btn info "> <strong>International Trip</strong>  </a>

					</div>
					<div class="form-group">
						<input type="radio" name="trip" value="demostic"/> <a href="javascript:;"
							class="btn info "><strong>Domestic Trip</strong></a>

					</div>

					<center>
						<button id="btnLeaveControl-Delete" type="submit" accesskey="N"
							class="btn green">
							<i class="glyphicon glyphicon-plus-sign"></i> <u>N</u>ew
						</button>
					</center>
				</form>
			</div>
			<div class="tab-pane fade" id="teana">
				
				<form action="/etravel/trip" role="form" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<input type="radio" name="trip" value="international"/> <a href="javascript:;"
							class="btn info "> <strong>International Trip</strong>  </a>

					</div>
					<div class="form-group">
						<input type="radio" name="trip" value="demostic"/> <a href="javascript:;"
							class="btn info "><strong>Domestic Trip</strong></a>

					</div>

					<center>
						<button id="btnLeaveControl-Delete" type="submit" accesskey="S"
							class="btn green">
							<i class="glyphicon glyphicon-new-window"></i> <u>S</u>ubmit
						</button>
					</center>
				</form>
			
			</div>
			<div class="tab-pane fade" id="camry"></div>
		</div>
	</div>
	<div class="col-md-3">

		<!-- BEGIN PORTLET-->
		<div class="portlet light sameheight-box">
			<div class="portlet-title tabbable-line">
				<button type="button" class="btn btn-primary"
					style="margin-bottom: 10px; font-size: 28px;">{{ sprintf('%02d',count($pendingRequests)) }}</button>
				<div class="caption" style="float: right; margin-right: 10px;">
					<i class="icon-globe font-dark hide"></i> <span
						class="caption-subject policies-text bold uppercase">Open Requests
					</span> 
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-scrollable">
                                        <table class="table table-light">
                                            <tbody>
                                        		@if(count($pendingRequests))
                                            		@foreach($pendingRequests as $item)
                                                <tr>
                                                    <td class="highlight">
                                                        <div class="success"></div>
                                                       	@if($item['trip_type']=='1')
														<a href="/etravel/tripnationallist/{{ $item['trip_id'] }}">{{$item->destination_name['Country']?$item->destination_name['Country']:'Destination'}}  </a>
														@elseif($item['trip_type']=='2')
														<a href="/etravel/tripdemosticlist/{{ $item['trip_id'] }}">{{$item->destination_name['Country']?$item->destination_name['Country']:'Destination'}}  </a>
														@endif
                                                        
                                                    </td>
                                                    <td class="hidden-xs">{{$item->daterange_from}}</td>
                                                    <td> {{$item->daterange_to}}</td>
                                                </tr>
                                             	@endforeach
                                          	@else
                                          		<tr>
                                          			<td style="text-align: center;color:rgb(87,142,190);"colspan="3">No records found.</td>
                                           	@endif
                                          		</tr>	
                                            </tbody>
                                        </table>
                                    </div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
	<div class="col-md-3"">

		<!-- BEGIN PORTLET-->
		<div class="portlet light sameheight-box">
			<div class="portlet-title tabbable-line">
				<button type="button" class="btn btn-primary"
					style="margin-bottom: 10px; font-size: 28px;">{{ sprintf('%02d',count($approved_request)) }}</button>
				<div class="caption" style="float: right; margin-right: 10px;">
					<i class="icon-globe font-dark hide"></i> <span
						class="caption-subject policies-text bold uppercase">APPROVED REQUEST</span> 
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-scrollable">
                                        <table class="table table-light">
                                            <tbody>
                                        		@if(count($approved_request))
                                            		@foreach($approved_request as $item)
                                                <tr>
                                                    <td class="highlight">
                                                        <div class="success"></div>
                                                        <a href="">  {{$item->destination_name['Country']?$item->destination_name['Country']:'Destination'}}  </a>
                                                    </td>
                                                    <td class="hidden-xs">{{$item->daterange_from}}</td>
                                                    <td> {{$item->daterange_to}}</td>
                                                </tr>
                                             	@endforeach
                                          	@else
                                          		<tr>
                                          			<td style="text-align: center;color:rgb(87,142,190);"colspan="3">No records found.</td>
                                           	@endif
                                          		</tr>	
                                            </tbody>
                                        </table>
                  </div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
	<div class="col-md-3"">
		<!-- BEGIN PORTLET-->
		<div class="portlet light sameheight-box">
			<div class="portlet-title tabbable-line">
				<button type="button" class="btn btn-primary"
					style="margin-bottom: 10px; font-size: 28px;">22</button>
				<div class="caption" style="float: right; margin-right: 10px;">
					<i class="icon-globe font-dark hide"></i> <span
						class="caption-subject policies-text bold uppercase">Manager Section</span> 
				</div>
			</div>
			<div class="portlet-body">
				<div class="panel-default">
					
					<div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" href="staff/travellist"> My Staff Travel Requests </a>
                                        </h4>
                    </div>
				</div>
				
			</div>
			<div class="portlet-body">
				<div class="panel-default">
					<div class="panel-heading">
                                        <h4 class="panel-title">
                                                <a class="accordion-toggle" href="staff/travellist?status=pending"> Pending for my Approval</a>
                                        </h4>
                    </div>
				</div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>
<div class="row" style="margin: 10px;">
	<div class="col-md-3">
		<div class="portlet box default">
			<div class="portlet-title">
				<div class="caption">
					MY INCOMING TRIPS(2) <i class="glyphicon glyphicon-arrow-right"></i>
				</div>
				<div class="tools">
					<a title="" class="fullscreen" href="" data-original-title=""> </a>
				</div>
			</div>
			<div class="portlet-body policy-content portlet-collapsed"
				style="display: block;">to do list</div>
		</div>

	</div>
	<div class="col-md-9">
		<div class="portlet box default">
			<div class="portlet-title">
				<div class="caption">Announcement</div>
				<div class="tools">
					<a title="" class="fullscreen" href="" data-original-title=""> </a>
				</div>
			</div>
			<div class="portlet-body policy-content portlet-collapsed"style="display: block;">
				{!! $generalAnnouncement['announcement'] or 'No Announcement' !!}
			</div>
		</div>
	</div>
</div>

</div>
@endsection
