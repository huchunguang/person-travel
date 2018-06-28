<div class="row" style="background-color: rgba(51,122,183,1);margin:0px;">
	<div class="row" style="background-color: rgba(51,122,183,1);margin-left:10px;margin-right:10px;">
	<div class="col-md-9">
		<ul class="nav nav-pills" style="text-align: center; margin-bottom: 0px;">
		<li class="active"><a href="{{ route('dashboard') }}" style="color: white;">
			<i class="fa fa-home"></i>Dashboard</a></li>
		<li><a href="{{url('delegate/index')}}" style="color: white;"><i class="fa fa-exchange"></i>Delegation</a></li>
		<li><a href="##" style="color: white;"><i class="fa fa-bar-chart"></i>Reports</a></li>
		@if(Auth::user()->UserTypeID=='1')
		<li class="dropdown">
			<a href="##" class="dropdown-toggle" data-toggle="dropdown" style="color: white;">
				<i class="fa fa-gears"></i>Configuration<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li><a href="/etravel/airline">AirLine</a></li>
			</ul>
		</li>
		@endif
		
		@if($isEtravelAdmin)
		<li class="dropdown">
			<a href="##" class="dropdown-toggle" data-toggle="dropdown" style="color: white;">
				<i class="fa fa-book"></i>Etravel Admin<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li><a href="/etravel/admin/hr-listing">Travel Listing</a></li>
				<li><a href="/etravel/announcement">Announcement</a></li>
				<li><a href="/etravel/purpose">Purpose List Category</a></li>
			</ul>
		</li>
		@endif
	</ul>
	</div>
	<div class="col-md-3">
		<ul>
				<li class="nav navbar-nav pull-right">
				<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false" style="color: white;">
					{{Auth::user()->FirstName}} 
					 @if(Auth::user()->GenderID == 2) 
					 <img alt="" class="img-circle" src="{{ asset('storage/global/layout3/img/avatar.png') }}"> 
					 @else
					 <img alt="" class="img-circle" src="{{ asset('storage/global/layout3/img/avatar.png') }}"> 
					 @endif
				</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="#newTravel" data-toggle="modal"><i class="fa fa-calendar-plus-o"></i>New Travel Request</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="/etravel/{{Auth::user()->UserID}}/triplist?status">
								<i class="fa fa-file-text-o"></i> My Travel Requests
                            </a>
                       	</li>
                        <li class="divider"></li>
                        <li><a href="/etravel/staff/travellist"><i class="fa fa-flag-o"></i> My Staff Travel Requests</a></li>
                        <li><a href="/etravel/staff/travellist?status=pending"><i class="fa fa-check"></i>  For My Approval</a></li>
                        <li class="divider"></li>
                        <li><a href="/password/email"> <i class="icon-key"></i> Reset Password</a></li>
                        <li class="divider"></li>
						<li><a href="/auth/logout"> <i class="fa fa-sign-out"></i> Log Out </a></li>
					</ul>
				</li>
			</ul>
	</div>
		
	</div>
</div>
<div class="row" style="margin: 10px;margin-bottom:0px;">
	<div class="col-md-3">
		<figure>
			<img src="{{ asset('storage/arkema2.png') }}" style="width: 160px; height: 43px;" alt=""/>
		</figure>
	</div>
	
	<div class="col-md-3" style="margin-bottom: ">
			<span class="app-title policies-text bold" style="font-size: 20px;">e-Travel Application</span>
	</div>
</div>















