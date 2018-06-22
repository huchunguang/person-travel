<!DOCTYPE html>
<html lang="en" class="hb-loaded">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Etravel')</title>
    
        <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ asset('assets/layouts/layout2/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/layouts/layout2/css/themes/blue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('assets/layouts/layout2/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
<!--         <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" /> -->
<!--         <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" /> -->
		<link href="{{ asset('assets/global/plugins/jstree/dist/themes/default/style.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/icheck/skins/minimal/green.css') }}" rel="stylesheet" type="text/css" />
    
    
    
    <link rel="Shortcut Icon" href="{{ asset('storage/shortIcon.jpeg') }}" type="image/x-icon">
   	<link rel="stylesheet" type="text/css" href="/css/app.css">
    <link href="/css/blog.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/wangEditor.min.css">
	<link href="{{ asset('storage/global/css/error.min.css') }}" rel="stylesheet">
<link
	href="{{ asset('storage/global/plugins/font-awesome/css/font-awesome.min.css') }}"
	rel="stylesheet" type="text/css" />
<link
	href="{{asset('storage/global/plugins/bootstrap/css/bootstrap.min.css')}}"
	rel="stylesheet" type="text/css" />
<link
	href="{{asset('storage/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}"
	rel="stylesheet" type="text/css" />
<link href="{{asset('storage/global/plugins/morris/morris.css')}}"
	rel="stylesheet" type="text/css" />
<link
	href="{{asset('storage/global/plugins/fullcalendar/fullcalendar.min.css')}}"
	rel="stylesheet" type="text/css" />
<link href="{{asset('storage/global/css/components-rounded.css')}}"
	rel="stylesheet" id="style_components" type="text/css" />
<link href="{{asset('storage/global/css/plugins.min.css')}}"
	rel="stylesheet" type="text/css" />
<link href="{{asset('storage/global/css/style.css')}}" rel="stylesheet"
	type="text/css" />
<link href="{{asset('storage/global/layout3/css/layout.css') }}"
	rel="stylesheet" type="text/css" />
<link
	href="{{asset('storage/global/layout3/css/themes/blue-steel.min.css')}}"
	rel="stylesheet" type="text/css" id="style_color" />
<link href="{{asset('storage/global/layout3/css/custom.min.css')}}"
	rel="stylesheet" type="text/css" />
<link
	href="{{asset('storage/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}"
	rel="stylesheet" type="text/css" />
<link
	href="{{asset('storage/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}"
	rel="stylesheet" type="text/css" />
<link
	href="{{asset('storage/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}"
	rel="stylesheet" type="text/css" />
<link
	href="{{asset('storage/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}"
	rel="stylesheet" type="text/css" />
<link href="{{asset('apps/css/inbox.css')}}" rel="stylesheet"
	type="text/css" />
<link
	href="{{asset('storage/global/plugins/datatables/datatables.min.css')}}"
	rel="stylesheet" type="text/css" />
<link
	href="{{asset('storage/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}"
	rel="stylesheet" type="text/css" />
<link
	href="{{asset('storage/global/plugins/bootstrap-select/css/bootstrap-select.min.css')}}"
	rel="stylesheet" type="text/css" />
<link
	href="{{asset('storage/global/plugins/jquery-multi-select/css/multi-select.css')}}"
	rel="stylesheet" type="text/css" />

<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('storage/global/js/bootstrap-dialog/css/bootstrap-dialog.min.css')}}"
	rel="stylesheet" type="text/css" />
<link href="{{asset('storage/global/css/custom-glyph.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('storage/global/css/custom.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('storage/global/js/css/jquery-ui.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('storage/global/js/BootstrapTable/bootstrap-table.css')}}" rel="stylesheet"
	type="text/css" />
<link href="{{asset('storage/global/js/BootstrapValidator/dist/css/bootstrapValidator.css')}}"
	rel="stylesheet" type="text/css" />
<link href="{{asset('storage/global/js/jqwidgets/styles/jqx.bootstrap.css')}}" rel="stylesheet"
	type="text/css" />
<link href="{{asset('storage/global/css/bootstrap-sortable.css')}}" rel="stylesheet"
	type="text/css" />
	
<script src="{{asset('js/jquery-1.8.3.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="/js/wangEditor.min.js"></script>
<script src="{{asset('storage/global/plugins/bootstrap-daterangepicker/moment.js')}}"></script>
<script src="{{asset('storage/global/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('storage/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<script src="{{asset('storage/global/js/bootstrap-sortable.js')}}"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-markdown/lib/markdown.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/form-icheck.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/form-validation.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/layouts/layout2/scripts/layout.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/layouts/layout2/scripts/demo.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/layouts/global/scripts/quick-nav.min.js') }}" type="text/javascript"></script>
</head>

<body class="page-container-bg-solid page-header-menu-fixed">
<div class="page-wrapper">
@if(Auth::check())
	@include('etravel.layout.header')
@endif
<div style="background-color: rgba(165,163,163,0.07);" class="page-wrapper">
	<div class="page-wrapper-row full-height">
			<div class="page-wrapper-middle">
					<div class="page-content">
						@yield('content')
					</div>
			</div>
	</div>
	@include('etravel.modal.newTravel')
	@include("etravel.layout.footer")
</div>
</div>

<script src="{{asset('js/etravel/trip/demosticCreate.js')}}"></script>
<script src="{{asset('js/function.js')}}"></script>

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
</body>
<script src="{{asset('assets/global/plugins/jstree/dist/jstree.min.js')}}" type="text/javascript"></script>
</html>


