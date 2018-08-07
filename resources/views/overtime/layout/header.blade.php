<header class="page-header">
	<nav class="navbar" role="navigation">
		<div class="container-fluid">
			<div class="havbar-header">
				<!-- BEGIN LOGO -->
				<a id="index" class="navbar-brand" href="{{url('overtime/dashboard')}}">
					<img src="{{ asset('assets/layouts/layout6/img/logo.png') }}" style="width: 248px;" alt="Logo">
				</a>
				<!-- END LOGO -->
				<!-- BEGIN TOPBAR ACTIONS -->
				<div class="topbar-actions">
					<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
					<!-- BEGIN GROUP NOTIFICATION -->
					<!-- END GROUP NOTIFICATION -->
					<!-- BEGIN USER PROFILE -->
					<span style="font-weight: 600;">Hi,{{Auth::user()->FirstName}}</span>
					<div class="btn-group-img btn-group">
						<button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<img src="{{ asset('storage/global/layout3/img/avatar.png') }}" alt="" class="img-circle">
						</button>
						<ul class="dropdown-menu-v2" role="menu">
							<li>
								<a href="{{url('/auth/logout')}}">
									<i class="icon-key"></i> Log Out
								</a>
							</li>
						</ul>
					</div>
					<!-- END USER PROFILE -->
				</div>
				<!-- END TOPBAR ACTIONS -->
			</div>
		</div>
		<!--/container-->
	</nav>
</header>