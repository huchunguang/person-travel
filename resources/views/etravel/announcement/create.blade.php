@extends("etravel.layout.main") 
@section("content")
<div class="container">
	<div class="page-content-inner">
		<div class="row">
			@include('etravel.layout.error')
			<div class="col-md-12">
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-bubble"></i> <span
								class="caption-subject bold uppercase">NEW ANNOUNCEMENT</span>
						</div>
					</div>
					<div class="portlet-body form">
						<form action="/etravel/announcement" method="post" class="horizontal-form">
							<div class="form-body">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">

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
                                                    						<option value="{{$countryItem['CountryID']}}">{{$countryItem['Country']}}</option>
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
																	<span class="select2-chosen" id="select2-chosen-2">&lt;&nbsp;Select Site&nbsp;&gt;</span>
                                            						 </select>
															</div>

														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Type</label>
															<select id="type_id" name="type_id" class="form-control input-sm select2">
																	@foreach($typeList as $typeItem)
																	<option value="{{$typeItem['id']}}">{{$typeItem['type']}}</option>
																	@endforeach
                                            					</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Description</label>
															<textarea id="description" name="description" class="form-control leave-control" style="overflow-y: scroll;" rows="1"></textarea>
														</div>
													</div>
												</div>
												<div class="row">
                                    <div class="form-group col-md-12">
                                   
                                        <label for="" class="">Announcement:</label>
                                        <textarea id="announcement">
    											<p>please input announcement info...</p>
										</textarea>
                                    </div>
                                </div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Effectivity Date</label>
															<div style="position: relative;">
																<input id="date_effectivity" type="text" name="date_effectivity" class="form-control singleDatePicker"> 
																<i class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
															</div>
														</div>
														
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="">Expiration Date</label>
															<div style="position: relative;">
																<input type="text" name="date_expired"
																	class="form-control singleDatePicker"> <i
																	class="glyphicon glyphicon-calendar fa fa-calendar"
																	style="position: absolute; bottom: 10px; right: 20px; top: auto; cursor: pointer;"></i>
															</div>
														</div>
													</div>
												</div>
												
												
												
												
											

							</div>
							<div class="form-actions right">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn green">Submit</button>
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

<script src="{{asset('/js/etravel/announcement/create.js')}}"></script>
@endsection





