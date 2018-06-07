@extends("etravel.layout.main") 
@section("content")
<div class="container">
	<div class="page-content-inner">
		<div class="row">
			<div class="col-md-12">
			@include('etravel.layout.error')
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-bubble"></i> <span
								class="caption-subject bold uppercase">NEW Travel Purpose</span>
						</div>
					</div>
					<div class="portlet-body form">
						<form action="/etravel/purpose" method="post" class="horizontal-form" id="adminPurposeCatform">
							<div class="form-body">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="_method" value="PUT"/>
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
																 		@foreach($countryList as $countryItem)
																 		@if($purpose['country'] == $countryItem['CountryID'])
																 		<option value="{{$countryItem['CountryID']}}" selected="selected">{{$countryItem['Country']}}</option>
																 		@else
                                                    						<option value="{{$countryItem['CountryID']}}">{{$countryItem['Country']}}</option>
                                                    						@endif
                                                    						
                                                    						@endforeach
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
																	@foreach($siteList as $siteItem)
																	@if($purpose['site_id'] == $siteItem['SiteID'])
																	<option value="{{$siteItem['SiteID']}}" selected="selected">{{$siteItem['Site']}}</option>
																	@else
																	<option value="{{$siteItem['SiteID']}}">{{$siteItem['Site']}}</option>
																	@endif
																	@endforeach
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
																<select id="siteSel" name="site_id" class="form-control input-sm select2">
																	<span class="select2-chosen" id="select2-chosen-2">
																	@foreach($companyList as $companyItem)
																	@if($purpose['company_id'] == $companyItem['CompanyID'])
																	<option value="{{$companyItem['CompanyID']}}" selected="selected">{{$companyItem['CompanyCode']}}-{{$companyItem['CompanyName']}}</option>
																	@else
																	<option value="{{$companyItem['CompanyID']}}">{{$companyItem['CompanyCode']}}-{{$companyItem['CompanyName']}}</option>
																	@endif
																	@endforeach
																	</span>
                                            					</select>
															</div>

														</div>
													
													
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Purpose Type</label>
															<input type="text" class="form-control" name="purpose_catgory" value="{{$purpose['purpose_catgory']}}"/>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group col-md-12">

														<label for="" class="">Purpose Description</label>
														<textarea name="purpose_desc" class="form-control" style="overflow-y: scroll;" rows="2">{{$purpose['purpose_desc']}}</textarea>
													</div>
												</div>
							</div>
							<div class="form-actions right">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn green">Update</button>
										<button type="button" class="btn default" onclick="window.location.href='/etravel/purpose'">Cancel</button>
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
<script src="{{asset('/js/etravel/purpose/validate.js')}}"></script>
@endsection





