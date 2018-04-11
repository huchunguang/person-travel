@extends("etravel.layout.main")

@section("content")
<div class="row">
	<div class="col-md-3">
		<p class="text-left lead">TRIP SEARCH</p> 
	</div>
	<div class="col-md-3">
		<p class="text-left lead">MY TASKS</p> 
	</div>	
</div>
<div class="row">
	<div class="col-md-3">
		<ul id="myTab" class="nav nav-tabs">
			<li class="active"><a href="#home" data-toggle="tab"> <span
					class="glyphicon glyphicon-send"></span>
			</a></li>
			<li><a href="#ios" data-toggle="tab"> <span class="glyphicon glyphicon-road"></span>
			</a></li>
			<li><a href="#teana" data-toggle="tab"> <span class="glyphicon glyphicon-plane"></span>
			</a></li>
			<li><a href="#camry" data-toggle="tab"> <span class="glyphicon glyphicon-map-marker"></span>
			</a></li>
			<li><a href="#accord" data-toggle="tab"> <span class="glyphicon glyphicon-screenshot"></span>
			</a></li>
		</ul>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade in active" id="home">
				<form action="" role="form">
					<div class="form-group">
						<label for="" class="control-label"> From: <span
							class="glyphicon glyphicon-question-sign"></span></label> <input
							class="form-control input-sm" type="text"
							placeholder="Insert from city name">

					</div>
					<div class="form-group">
						<label for="" class="control-label">To: <span
							class="glyphicon glyphicon-question-sign"></span></label> <input
							class="form-control input-sm" type="text"
							placeholder="Insert to city name">
					</div>
					<center>
						<button type="button" class="btn btn-primary">Submit</button>
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
	<div class="col-md-3"">
		
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
		<div class="col-md-3"">
	
		<!-- BEGIN PORTLET-->
		<div class="portlet light sameheight-box">
			<div class="portlet-title tabbable-line">
				<button type="button" class="btn btn-primary"
					style="margin-bottom: 10px; font-size: 28px;">06</button>
				<div class="caption" style="float: right; margin-right: 10px;">
					<i class="icon-globe font-dark hide"></i> <span
						class="caption-subject policies-text bold uppercase">Open Reports
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
		<div class="col-md-3"">
		<!-- BEGIN PORTLET-->
		<div class="portlet light sameheight-box">
			<div class="portlet-title tabbable-line">
				<button type="button" class="btn btn-primary"
					style="margin-bottom: 10px; font-size: 28px;">22</button>
				<div class="caption" style="float: right; margin-right: 10px;">
					<i class="icon-globe font-dark hide"></i> <span
						class="caption-subject policies-text bold uppercase">Avalanche Requests
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
		<p class="text-left lead" style="display: inline-block;">MY TRIPS(2)</p> 
		<p class="glyphicon glyphicon-arrow-right" style="display: inline-block;float:right;"></p>
	</div>
</div>
	
</div>
@endsection