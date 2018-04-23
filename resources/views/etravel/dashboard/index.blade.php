@extends("etravel.layout.main") @section("content")
<div class="row">
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
					class="glyphicon glyphicon-road"></span>
			</a></li>
			<li><a href="#teana" data-toggle="tab"> <span
					class="glyphicon glyphicon-plane"></span>
			</a></li>
			<li><a href="#camry" data-toggle="tab"> <span
					class="glyphicon glyphicon-map-marker"></span>
			</a></li>
			<li><a href="#accord" data-toggle="tab"> <span
					class="glyphicon glyphicon-screenshot"></span>
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
							class="btn info "><strong>Demostic Trip</strong></a>

					</div>

					<center>
						<button id="btnLeaveControl-Delete" type="submit" accesskey="S"
							class="btn green">
							<i class="glyphicon glyphicon-new-window"></i> <u>S</u>ubmit
						</button>
					</center>
				</form>
			</div>
			<div class="tab-pane fade" id="ios">
				<p>iOS 是一个由苹果公司开发和发布的手机操作系统。最初是于 2007 年首次发布 iPhone、iPod Touch 和
					Apple TV。iOS 派生自 OS X，它们共享 Darwin 基础。OS X 操作系统是用在苹果电脑上，iOS
					是苹果的移动版本。</p>
			</div>
			<div class="tab-pane fade" id="teana">
				<p>iOS 是一个由苹果公司开发和发布的手机操作系统。最初是于 2007 年首次发布 iPhone、iPod Touch 和
					Apple TV。iOS 派生自 OS X，它们共享 Darwin 基础。OS X 操作系统是用在苹果电脑上，iOS
					是苹果的移动版本。</p>
			</div>
			<div class="tab-pane fade" id="camry">
				<p>iOS 是一个由苹果公司开发和发布的手机操作系统。最初是于 2007 年首次发布 iPhone、iPod Touch 和
					Apple TV。iOS 派生自 OS X，它们共享 Darwin 基础。OS X 操作系统是用在苹果电脑上，iOS
					是苹果的移动版本。</p>
			</div>
			<div class="tab-pane fade" id="accord">
				<p>iOS 是一个由苹果公司开发和发布的手机操作系统。最初是于 2007 年首次发布 iPhone、iPod Touch 和
					Apple TV。iOS 派生自 OS X，它们共享 Darwin 基础。OS X 操作系统是用在苹果电脑上，iOS
					是苹果的移动版本。</p>
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
					</span> <span class="glyphicon glyphicon-arrow-right"></span>
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
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse"
											data-parent="#transactions" href="#leaves">My Leave
											Transactions </a>
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
					style="margin-bottom: 10px; font-size: 28px;">06</button>
				<div class="caption" style="float: right; margin-right: 10px;">
					<i class="icon-globe font-dark hide"></i> <span
						class="caption-subject policies-text bold uppercase">APPROVED
						REQUEST </span> <span class="glyphicon glyphicon-arrow-right"></span>
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
							<h5>
								<strong>01/23 Travel to shanghai </strong>
							</h5>
							<p>$3500.00 - Travel</p>
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
						class="caption-subject policies-text bold uppercase">REJECTED
						REQUEST </span> <span class="glyphicon glyphicon-arrow-right"></span>
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
							<p style="color: red; text-align: center">No records found.</p>
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
</div>
<div class="row">
	<div class="col-md-3">
		<div class="portlet box default">
			<div class="portlet-title">
				<div class="caption">
					MY TRIPS(2) <i class="glyphicon glyphicon-arrow-right"></i>
				</div>
				<div class="tools">
					<!--                                     <a title="" class="collapse" href="javascript:;" data-original-title=""> </a> -->
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
