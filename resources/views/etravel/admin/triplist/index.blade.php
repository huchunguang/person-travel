<?php
use Carbon\Carbon;
?>
@extends("etravel.layout.main") @section("content")
<div class="container">
	@include("etravel.layout.pagebar")
	<div class="page-content-inner">
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN SAMPLE TABLE PORTLET-->
				<div class="portlet box default">
					<div class="portlet-body" style="display: block;">
						<form id="tripListFrom" action="{{url('/etravel/admin/hr-listing')}}" method="post" name="adminTravelform" role="form">
							<input type="hidden" name="_token" value="{{csrf_token()}}" />
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<lavel class="control-label">Country</lavel>
										<div class="input-group">
											<select id="country_id" name="country_id" class="form-control input-sm select2">
												<option value="">Select...</option>
												@foreach($countryList as $countryItem) @if(($CountryAssignedID && $CountryAssignedID==$countryItem['CountryID']) || $country_id==$countryItem['CountryID'])
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
												@foreach($siteList as $siteItem) @if($SiteID==$siteItem['SiteID'] || $site_id==$siteItem['SiteID'])
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
												@foreach($companyList as $company) @if($CompanyID == $company['company']['CompanyID'] || $company_id==$company['company']['CompanyID'])
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
										<lavel class="control-label">Travel Type</lavel>
										<div class="input-group">
											<select id="trip_type" name="trip_type" class="form-control input-sm select2">
												<option value="">Select...</option>
												<option value="1" <?php if ($trip_type=='1')echo 'selected';?>>INTERNATIONAL</option>
												<option value="2" <?php if ($trip_type=='2')echo 'selected';?>>DOMESTIC</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<lavel class="control-label">Status</lavel>
										<div class="input-group">
											<select id="status" name="status" class="form-control input-sm select2">
												<option value="">Select...</option>
												<option value="pending" <?php if ($status=='pending')echo 'selected';?>>pending</option>
												<option value="approved" <?php if ($status=='approved')echo 'selected';?>>approved</option>
												<option value="cancelled" <?php if ($status=='cancelled')echo 'selected';?>>cancelled</option>
												<option value="rejected" <?php if ($status=='rejected')echo 'selected';?>>rejected</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">From</label>
										<div class="input-group date date-picker" data-date-format="mm/dd/yyyy" >
											@if($daterange_from)
											<input id="hr_daterange_from" type="text" class="form-control" name="daterange_from" value="{{$daterange_from}}">
											@else
											<input id="hr_daterange_from" type="text" class="form-control" name="daterange_from" value="{{Carbon::now()->firstOfMonth()->format('m/d/Y')}}">
											@endif
											<span class="input-group-btn">
												<button class="btn default" type="button">
													<i class="fa fa-calendar"></i>
												</button>
											</span>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">To</label>
										<div class="input-group date date-picker" data-date-format="mm/dd/yyyy" >
											@if($daterange_to)
											<input id="hr_daterange_from" type="text" class="form-control" name="daterange_to" value="{{$daterange_to}}">
											@else
											<input id="hr_daterange_from" type="text" class="form-control" name="daterange_to" value="{{Carbon::now()->format('m/d/Y')}}">
											@endif
											<span class="input-group-btn">
												<button class="btn default" type="button">
													<i class="fa fa-calendar"></i>
												</button>
											</span>
										</div>
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
										<span id="CompanySiteLabel" class="bold">{{ $status or 'Approved' }} List</span>
										<span id="CompanySiteExpand" class="expander glyphicon glyphicon-plus"></span>
									</div>
									<div id="" class="panel-body" style="padding: 0 0 0 0">
										<div class="table-scrollable" id="BalanceDetailsDiv" style="overflow-y: auto; height: 260px; padding-left: 0px">
											<table id="adminTripListTbl" class="table table-striped table-hover sortable">
												<thead>
													<tr class="btn-info roundborder">
														<th style="display: none"></th>
														<th style="text-align: right">Search:</th>
														<th colspan="2">
															<input id="txtEmployeeSearch" type="text" placeholder="Search by Employee" style="color: black">
														</th>
														<th colspan="2">
															<input id="txtStartDateSearch" type="text" placeholder="Search By Start Date" style="color: black">
														</th>
														<th colspan="2">
															<input id="txtEndDateSearch" type="text" placeholder="Search by End Date" style="color: black">
														</th>
													</tr>
													<tr class="btn-info roundborder">
														<th>#</th>
														<th>Date Submitted</th>
														<th>Employee</th>
														<th>Travel Type</th>
														<th>Start Leave</th>
														<th>End Leave</th>
														<th>View</th>
													</tr>
												</thead>
												<tbody>
													@if(isset($tripList) && count($tripList)>0) @foreach($tripList as $trip)
													<tr>
														<td>{{$trip['trip_id']}}</td>
														<td>{{$trip->created_at->format('Y-m-d')}}</td>
														<td>{{$trip->user()->first()->LastName}} {{$trip->user()->first()->FirstName}}</td>
														<td>@if($trip->trip_type=='1') INTERNATIONAL @elseif($trip->trip_type=='2') DOMESTIC @endif</td>
														<td>{{$trip['daterange_from']}}</td>
														<td>{{$trip['daterange_to']}}</td>
														<td>
															@if($trip['trip_type']=='1')
															<a href="/etravel/tripnationallist/{{ $trip['trip_id'] }}">
																@elseif($trip['trip_type']=='2')
																<a href="/etravel/tripdemosticlist/{{ $trip['trip_id'] }}">
																	@endif @if($trip['status']=='pending')
																	<span class="glyphicon glyphicon-hand-right" style="color: green"></span>
																	@elseif($trip['status']=='approved')
																	<span class="fa fa-check-circle-o" style="color: green"></span>
																	@elseif($trip['status']=='rejected')
																	<span class="glyphicon glyphicon-thumbs-down" style="color: red"></span>
																	@elseif($trip['status']=='cancelled')
																	<span class="fa fa-exclamation-triangle" style="color: black"></span>
																	@elseif($trip['status']=='partly-approved')
																	<span class="glyphicon glyphicon-check" style="color: yellow"></span>
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
														<th id="tblCounter" style="text-align: left">{{$tripList->total()}}</th>
														<th style="text-align: center;"></th>
														<th></th>
														<th></th>
														<th style="text-align: center"></th>
														<th></th>
														<th></th>
														<th></th>
													</tr>
												</tfoot>
											</table>
											<?php echo $tripList->render();?>
										</div>
									</div>
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
<script src="{{asset('js/etravel/admin/triplist/index.js')}}"></script>
@endsection
