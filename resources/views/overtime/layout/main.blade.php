<!DOCTYPE html>
<html lang="en" class="hb-loaded">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('meta')
<title>@yield('title','Overtime')</title>
<link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS(SELECT2) -->
<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS(SELECT2) -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="{{ asset('assets/global/css/components.css') }}" rel="stylesheet" id="style_components" type="text/css" />
<link href="{{ asset('assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="{{ asset('assets/layouts/layout6/css/layout.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/layouts/layout6/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
@yield('styles')
</head>
<body class="">
	@if(Auth::check()) @include('overtime.layout.header') @endif
	<div class="page-content page-content-popup">
		@yield('main.prepend')
		<div class="page-sidebar-wrapper">@include('overtime.layout.sidebar')</div>
		<div class="page-fixed-main-content">@yield('content')</div>
		@yield('main.append') @yield('footer.prepend') @include('overtime.layout.footer') @yield('footer.append')
	</div>
	<!-- SCRIPTS -->
	<script></script>
	<script src="{{asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
	<script src="{{asset('js/function.js')}}"></script>
	<!-- BEGIN CORE PLUGINS -->
	<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="{{asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/patterns.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/chalk.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/amcharts/ammap/ammap.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/amcharts/ammap/maps/js/worldLow.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/amcharts/amstockcharts/amstock.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/horizontal-timeline/horizontal-timeline.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN THEME GLOBAL SCRIPTS -->
	<script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
	<!-- END THEME GLOBAL SCRIPTS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="{{asset('assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
	<!-- END PAGE LEVEL SCRIPTS -->
	<!-- BEGIN THEME LAYOUT SCRIPTS -->
	<script src="{{asset('assets/layouts/layout6/scripts/layout.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
	<!-- BEGIN PAGE LEVEL PLUGINS(SELECT2) -->
	<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>
	<!-- BEGIN PAGE LEVEL PLUGINS(SELECT2) -->
	<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
	<!-- END THEME LAYOUT SCRIPTS -->
	@yield('script.header')
</body>
</html>
