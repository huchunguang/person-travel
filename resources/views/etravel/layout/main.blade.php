
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Arkema Etravel</title>
    <link rel="Shortcut Icon" href="{{ asset('storage/shortIcon.jpeg') }}" type="image/x-icon">
   	<link rel="stylesheet" type="text/css" href="/css/app.css">
    <link href="/css/blog.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/wangEditor.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
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
<link href="{{asset('storage/global/plugins/select2-stable-3.5/select2.css')}}"
	rel="stylesheet" type="text/css" />
<link
	href="{{asset('storage/global/plugins/select2-stable-3.5/select2-bootstrap.css')}}"
	rel="stylesheet" type="text/css" />
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
</head>

<body class="">
	@include('etravel.layout.header')
<div style="background-color: #a5a3a312;" class="page-wrapper">
	@yield("content")
	@include("etravel.layout.footer")
</div>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/wangEditor.min.js')}}"></script>
<script src="{{asset('js/etravel/trip/demosticCreate.js')}}"></script>
<script src="{{asset('storage/global/plugins/bootstrap-daterangepicker/moment.js')}}"></script>
<script src="{{asset('storage/global/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('storage/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
</body>
</html>


