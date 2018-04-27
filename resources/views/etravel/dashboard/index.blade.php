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
					class="glyphicon glyphicon-send"></span>
			</a></li>
			<li><a href="#ios" data-toggle="tab"> <span
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
			<div class="tab-pane fade" id="ios">
				
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
			<div class="tab-pane fade" id="camry">
				
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
		</div>
	</div>
	<div class="col-md-3">

		<!-- BEGIN PORTLET-->
		<div class="portlet light sameheight-box">
			<div class="portlet-title tabbable-line">
				<button type="button" class="btn btn-primary"
					style="margin-bottom: 10px; font-size: 28px;">10</button>
				<div class="caption" style="float: right; margin-right: 10px;">
					<i class="icon-globe font-dark hide"></i> <span
						class="caption-subject policies-text bold uppercase">Open Requests
					</span> 
				</div>
			</div>
			<div class="portlet-body">
			
			<div class="panel-group accordion" id="transactions">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#transactions" href="#leaves" aria-expanded="true">My Leave Transactions </a>
                                                <!-- <a class="accordion-toggle" href="./leave-list.php?status=all">My Leave Transactions </a> -->
                                            </h4>
                                        </div>
                                        <div id="leaves" class="panel-collapse table-responsive collapse in" aria-expanded="true" style="">
                                            <table class="table table-light">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="5" class="font-dark list-title">Drafts</td>
                                                    </tr>
                                                    <tr><td colspan="4" style="color: red; text-align: center">No records found.</td></tr>
                                                    <tr>
                                                        <td colspan="5" class="font-dark list-title">Submitted</td>
                                                    </tr>
                                                    <tr><td colspan="4" style="color: red; text-align: center">No records found.</td></tr>
                                                    <tr>
                                                        <td colspan="5" class="font-dark list-title">Approved</td>
                                                    </tr>
                                                    <tr><td colspan="4" style="color: red; text-align: center">No records found.</td></tr>
                                                    <tr>
                                                        <td colspan="5" class="font-dark list-title">Rejected</td>
                                                    </tr>
                                                    <tr><td colspan="4" style="color: red; text-align: center">No records found.</td></tr>
                                                    <tr>
                                                        <td colspan="5" class="font-dark list-title">Cancelled</td>
                                                    </tr>
                                                    <tr><td colspan="4" style="color: red; text-align: center">No records found.</td></tr>                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
			
			
				<div class="table-scrollable table-scrollable-borderless">
					<div class="slimScrollDiv"
						style="position: relative; overflow: hidden; width: auto; height: 370px;">
						<div class="scroller table-responsive"
							style="height: 370px; overflow: hidden; width: auto;"
							data-always-visible="1" data-rail-visible="0"
							data-initialized="1">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a  href="/etravel/{{Auth::user()->UserID}}/triplist?status=pending">My Pending Requests </a>
											
										<!-- <a class="accordion-toggle" href="./leave-list.php?status=all">My Leave Transactions </a> -->
									</h4>
								</div>
								<div id="leaves"
									class="panel-collapse collapse table-responsive">
									<table class="table table-light">
										<tbody>
											<tr>
												<td colspan="5" class="font-dark list-title">Drafts</td>
											</tr>
											<tr>
												<td colspan="4" style="color: red; text-align: center">No
													records found.</td>
											</tr>
											<tr>
												<td colspan="5" class="font-dark list-title">Submitted</td>
											</tr>
											<tr>
												<td colspan="4" style="color: red; text-align: center">No
													records found.</td>
											</tr>
											<tr>
												<td colspan="5" class="font-dark list-title">Approved</td>
											</tr>
											<tr>
												<td colspan="4" style="color: red; text-align: center">No
													records found.</td>
											</tr>
											<tr>
												<td colspan="5" class="font-dark list-title">Rejected</td>
											</tr>
											<tr>
												<td colspan="4" style="color: red; text-align: center">No
													records found.</td>
											</tr>
											<tr>
												<td colspan="5" class="font-dark list-title">Cancelled</td>
											</tr>
											<tr>
												<td colspan="4" style="color: red; text-align: center">No
													records found.</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<table class="table table-light">
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="slimScrollBar"
							style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 370px;"></div>
						<div class="slimScrollRail"
							style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div>
					</div>
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
				<div class="table-scrollable table-scrollable-borderless">
					<div class="slimScrollDiv"
						style="position: relative; overflow: hidden; width: auto; height: 370px;">
						<div class="scroller table-responsive"
							style="height: 370px; overflow: hidden; width: auto;"
							data-always-visible="1" data-rail-visible="0"
							data-initialized="1">
							@foreach($approved_request as $request)
							
							<h5>
								<strong>{{$request->daterange_from}} Travel to shanghai </strong>
							</h5>
							<p>$3500.00 - Travel</p>
							@endforeach
							<h5>
								<strong>01/23 Travel to shanghai </strong>
							</h5>
							<p>$3500.00 - Travel</p>
							<h5>
								<strong>01/23 Travel to shanghai </strong>
							</h5>
							<p>$3500.00 - Travel</p>
							<table class="table table-light">
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="slimScrollBar"
							style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 370px;"></div>
						<div class="slimScrollRail"
							style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div>
					</div>
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
                                            <a class="accordion-toggle" href="staff/travellist"> My Staff Leave Transactions </a>
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
			<div class="portlet-body policy-content portlet-collapsed"
				style="display: block;">No Announcement</div>
		</div>
	</div>
</div>

</div>
@endsection
