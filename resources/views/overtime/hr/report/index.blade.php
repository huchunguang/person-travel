<?php
use Carbon\Carbon;
?>
@extends("overtime.layout.main")
@section('styles')
<!-- BEGIN PAGE LEVEL PLUGINS(DATE TIME) -->
<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS(DATE TIME) -->
@endsection @section('script.header')
<!-- BEGIN PAGE LEVEL PLUGINS(DATE TIME) -->
<script src="{{asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/clockface/js/clockface.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS(DATE TIME) -->
<!-- BEGIN PAGE LEVEL SCRIPTS(DATE TIME) -->
<script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS(DATE TIME) -->
@endsection @section("content")
<div class="row" style="margin-left: 10px;">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-database"></i>
					<span class="uppercase">
						HR OVERTIME DOCUMENT LIST
						<input type="hidden" name="status" value="{{$status}}" />
				
				</div>
				<div class="tools"></div>
			</div>
			<div class="portlet-body" style="display: block;">
				<form id="overtimeListFrom" action="{{url('/overtime/hr/report')}}" method="post" name="adminTravelform" role="form">
					<input type="hidden" name="_token" value="{{csrf_token()}}" />
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<lavel class="control-label">Country</lavel>
								<div class="input-group">
									<select id="country_id" name="country_id" class="form-control input-sm select2">
										<option value="">Select...</option>
										@foreach($countryList as $countryItem) @if($CountryAssignedID && $CountryAssignedID==$countryItem['CountryID'])
										<option value="{{$countryItem['CountryID']}}" selected>{{$countryItem['Country']}}</option>
										@else
										<option value="{{$countryItem['CountryID']}}">{{$countryItem['Country']}}</option>
										@endif @endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<lavel class="control-label">Site</lavel>
								<div class="input-group">
									<select id="site_id" name="site_id" class="form-control input-sm select2">
										<option value="">Select...</option>
										@foreach($siteList as $siteItem) @if($SiteID==$siteItem['SiteID'])
										<option value="{{$siteItem['SiteID']}}" selected>{{$siteItem['Site']}}</option>
										@else
										<option value="{{$siteItem['SiteID']}}">{{$siteItem['Site']}}</option>
										@endif @endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<lavel class="control-label">Company</lavel>
								<div class="input-group">
									<select id="company_id" name="company_id" class="form-control input-sm select2">
										<option value="">Select...</option>
										@foreach($companyList as $company) @if($CompanyID == $company['company']['CompanyID'])
										<option value="{{$company['company']['CompanyID']}}" selected>{{$company['company']['CompanyCode']}}-{{$company['company']['CompanyName']}}</option>
										@else
										<option value="{{$company['company']['CompanyID']}}">{{$company['company']['CompanyCode']}}-{{$company['company']['CompanyName']}}</option>
										@endif @endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<lavel class="control-label">Department</lavel>
								<div class="input-group">
									<select id="department_id" name="department_id" class="form-control input-sm select2">
										<option value="">Select...</option>
										@foreach($departmentList as $department)
										<option value="{{$department['DepartmentID']}}">{{$department['Department']}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Status</label>
								<div class="input-group">
									<select id="status" name="status" class="form-control input-sm select2">
										<option value="">Select...</option>
										<option value="pending">Pending</option>
										<option value="approved">Approved</option>
										<option value="cancelled">Cancelled</option>
										<option value="rejected">Rejected</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">From</label>
								@if(old('start_date'))
								<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
									<input type="text" class="form-control" name="start_date" value="{{old('start_date')}}">
									<span class="input-group-btn">
										<button class="btn default" type="button">
											<i class="fa fa-calendar"></i>
										</button>
									</span>
								</div>
								@else
								<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
									<input type="text" class="form-control" name="start_date" value="{{Carbon::now()->firstOfMonth()->format('Y-m-d')}}">
									<span class="input-group-btn">
										<button class="btn default" type="button">
											<i class="fa fa-calendar"></i>
										</button>
									</span>
								</div>
								@endif <i class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; bottom: 20px; right: 20px; top: auto; cursor: pointer;"></i>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">To</label>
								@if(old('end_date'))
								<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
									<input type="text" class="form-control" name="end_date" value="{{old('end_date')}}">
									<span class="input-group-btn">
										<button class="btn default" type="button">
											<i class="fa fa-calendar"></i>
										</button>
									</span>
								</div>
								@else
								<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
									<input type="text" class="form-control" name="end_date" value="{{Carbon::now()->format('Y-m-d')}}">
									<span class="input-group-btn">
										<button class="btn default" type="button">
											<i class="fa fa-calendar"></i>
										</button>
									</span>
								</div>
								@endif <i class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; bottom: 20px; right: 20px; top: auto; cursor: pointer;"></i>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 text-right">
							<button id="btnExecute" type="submit" class="btn green" data-toggle="tooltip" data-placement="bottom" title="Click to execute.">
								<i class="fa fa-filter"></i> Filter
							</button>
							<button id="btnExport" type="button" class="btn yellow-gold" data-toggle="tooltip" data-placement="bottom" title="Click to Print.">
								<i class="glyphicon glyphicon-list-alt"></i> Export to Excel
							</button>
						</div>
					</div>
				</form>
				<p></p>
				<div class="row">
					<div class="form-group col-md-12">
						<div class="panel panel-default" style="margin-bottom: 0px">
							<div class="panel-heading" style="height: 35px;">
								<span id="CompanySiteLabel" class="bold">{{ $status or 'All' }} List</span>
								<span id="CompanySiteExpand" class="expander glyphicon glyphicon-plus"></span>
							</div>
							<div id="" class="panel-body" style="padding: 0 0 0 0">
								<div class="table-scrollable" id="BalanceDetailsDiv" style="overflow-y: auto; height: 260px; padding-left: 0px">
									<table id="adminTripListTbl" class="table table-striped table-hover sortable">
										<thead>
											<tr class="btn-info roundborder">
												<th style="display: none"></th>
												<th style="text-align: right">Search:</th>
												<th colspan="2"><input id="txtEmployeeSearch" type="text" placeholder="Search by Employee" style="color: black"></th>
												<th colspan="2"><input id="txtStartDateSearch" type="text" placeholder="Search By Start Date" style="color: black"></th>
												<th colspan="2"><input id="txtEndDateSearch" type="text" placeholder="Search by End Date" style="color: black"></th>
												<th></th>
											</tr>
											<tr class="btn-info roundborder">
												<th>#</th>
												<th>Reference #</th>
												<th>Date Submitted</th>
												<th>Employee</th>
												<th>No of Hours</th>
												<th>Start Date</th>
												<th>End Date</th>
												<th>View</th>
											</tr>
										</thead>
										<tbody>
											@if(isset($overtimeList) && count($overtimeList)>0) @foreach($overtimeList as $overtime)
											<tr>
												<td>{{$overtime['id']}}</td>
												<td>{{$overtime['reference_id']}}</td>
												<td>{{$overtime->created_at->format('Y-m-d')}}</td>
												<td>{{$overtime->getUserName()}}</td>
												<td>{{$overtime['hours']}}</td>
												<td>{{$overtime['start_date']}}</td>
												<td>{{$overtime['end_date']}}</td>
												<td>
													<a href="/overtime/{{$overtime['id']}}">
														@if($overtime['status']=='pending')
														<span class="glyphicon glyphicon-hand-right" style="color: green"></span>
														@elseif($overtime['status']=='approved')
														<span class="fa fa-check-circle-o" style="color: green"></span>
														@elseif($overtime['status']=='rejected')
														<span class="glyphicon glyphicon-thumbs-down" style="color: red"></span>
														@elseif($overtime['status']=='cancelled')
														<span class="fa fa-exclamation-triangle" style="color: black"></span>
														@endif
													</a>
												</td>
											</tr>
											@endforeach @else
											<tr>
												<td colspan="8" style="text-align: center; color: red" data-value="No records found.">No records found.</td>
											</tr>
											@endif
										</tbody>
										<tfoot>
											<tr class="btn-info roundborder">
												<th colspan="2" style="text-align: right">Total List:</th>
												<th id="tblCounter" style="text-align: left">{{$overtimeList->total()}}</th>
												<th style="text-align: center;"></th>
												<th></th>
												<th></th>
												<th style="text-align: center"></th>
												<th></th>
											</tr>
										</tfoot>
									</table>
									<?php echo $overtimeList->render();?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<iframe id="DownloadExcelFile" style="display: none;"></iframe>
<script src="{{asset('js/overtime/hr/report/index.js')}}"></script>
@endsection
