@extends("etravel.layout.main") @section("content")
<div class="container">
	<div class="page-content-inner">
		<div class="row">
			<div class="col-md-12">
				@include('etravel.layout.error')
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-bubble"></i>
							<span class="caption-subject bold uppercase">EDIT ANNOUNCEMENT</span>
						</div>
					</div>
					<div class="portlet-body form">
						<form action="/etravel/announcement/{{$announce['id']}}" method="post" class="horizontal-form" id="adminAnnounceform">
							<div class="form-body">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="_method" value="PUT" />
								<div class="alert alert-danger display-hide">
									<button class="close" data-close="alert"></button>
									You have some form errors. Please check below.
								</div>
								<div class="alert alert-success display-hide">
									<button class="close" data-close="alert"></button>
									Your form validation is successful!
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<lavel class="control-label">Country</lavel>
											<div class="input-group">
												<select id="countrySel" name="country" class="form-control input-sm select2">
													@foreach($countryList as $countryItem) @if($announce['country'] == $countryItem['CountryID'])
													<option value="{{$countryItem['CountryID']}}" selected="selected">{{$countryItem['Country']}}</option>
													@else
													<option value="{{$countryItem['CountryID']}}">{{$countryItem['Country']}}</option>
													@endif @endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Site</label>
											<div class="input-group">
												<select id="siteSel" name="site_id" class="form-control input-sm select2">
													<span class="select2-chosen" id="select2-chosen-2">
														@foreach($siteList as $siteItem) @if($announce['site_id'] == $siteItem['SiteID'])
														<option value="{{$siteItem['SiteID']}}" selected="selected">{{$siteItem['Site']}}</option>
														@else
														<option value="{{$siteItem['SiteID']}}">{{$siteItem['Site']}}</option>
														@endif @endforeach
													</span>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Company</label>
											<div class="input-group">
												<select id="siteSel" name="company_id" class="form-control input-sm select2">
													<span class="select2-chosen" id="select2-chosen-2">
														@foreach($companyList as $companyItem) @if($announce['company_id'] == $companyItem['CompanyID'])
														<option value="{{$companyItem['CompanyID']}}" selected="selected">{{$companyItem['CompanyCode']}}-{{$companyItem['CompanyName']}}</option>
														@else
														<option value="{{$companyItem['CompanyID']}}">{{$companyItem['CompanyCode']}}-{{$companyItem['CompanyName']}}</option>
														@endif @endforeach
													</span>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Type</label>
											<select id="type_id" name="type_id" class="form-control input-sm select2">
												@foreach($typeList as $typeItem) @if($typeItem['id'] == $announce['type_id'])
												<option value="{{$typeItem['id']}}" selected="selected">{{$typeItem['type']}}</option>
												@else
												<option value="{{$typeItem['id']}}">{{$typeItem['type']}}</option>
												@endif @endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-12">
										<label for="" class="">Announcement:</label>
										<textarea id="announcement">
    											{{$announce['announcement']}}
										</textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Effectivity Date</label>
											<div class="input-group date date-picker" data-date-format="mm/dd/yyyy" data-date-start-date="+0d">
												<input id="date_effectivity" type="text" class="form-control" name="date_effectivity" value="{{$announce['date_effectivity']}}">
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
											<label for="">Expiration Date</label>
											<div class="input-group date date-picker" data-date-format="mm/dd/yyyy" data-date-start-date="+0d">
												<input id="date_effectivity" type="text" class="form-control" name="date_expired" value="{{$announce['date_expired']}}">
												<span class="input-group-btn">
													<button class="btn default" type="button">
														<i class="fa fa-calendar"></i>
													</button>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-actions right">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn green">Save</button>
										<button type="button" class="btn default" onclick="window.location.href='/etravel/announcement'">Cancel</button>
									</div>
								</div>
							</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>
				<!-- END VALIDATION STATES-->
			</div>
		</div>
	</div>
</div>
<script src="{{asset('/js/etravel/announcement/announcement.js')}}"></script>
@endsection
