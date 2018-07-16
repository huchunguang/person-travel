<div class="row">
	
						

							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Country</label>
									<div class="input-group">
										<select id="countrySel" name="country" class="form-control input-sm select2"> 
										@foreach($countryList as $countryItem) 
											@if($country && $country==$countryItem['CountryID'])
											<option value="{{$countryItem['CountryID']}}" selected="selected">{{$countryItem['Country']}}</option>
											@else
											<option value="{{$countryItem['CountryID']}}">{{$countryItem['Country']}}</option>
											@endif
										@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Site</label>
									<div class="input-group">
										<select id="siteSel" name="site_id" class="form-control input-sm select2"> 
										@foreach($siteList as $siteItem) 
											@if($site_id==$siteItem['SiteID'])
											<option value="{{$siteItem['SiteID']}}" selected="selected">{{$siteItem['Site']}}</option>
											@else
											<option value="{{$siteItem['SiteID']}}">{{$siteItem['Site']}}</option>
											@endif 
										@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">CompanyID</label>
									<div class="input-group">
										<select id="companySel" name="company_id" class="form-control input-sm select2"> 
										@foreach($companyList as $companyItem) 
											@if($company_id==$companyItem['CompanyID'])
												<option value="{{$companyItem['CompanyID']}}" selected="selected">{{$companyItem['CompanyCode']}}-{{$companyItem['CompanyName']}}</option>
											@else
												<option value="{{$companyItem['CompanyID']}}">{{$companyItem['CompanyCode']}}-{{$companyItem['CompanyName']}}</option>
											@endif 
										@endforeach
										</select>
									</div>
								</div>
							</div>
	
						
</div>