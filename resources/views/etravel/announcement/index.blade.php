@extends("etravel.layout.main") 
@section("content")
<div class="container">
	<div class="page-content-inner">
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN SAMPLE TABLE PORTLET-->
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-comments"></i>List of Announcement
						</div>
						<div class="actions">
							<div class="btn-group btn-group-devided" accesskey="N"
								onclick="window.location.href='/etravel/announcement/create'">
								<label class="btn blue-steel leave-type-button"> <i
									class="fa fa-plus"></i><u>N</u>EW
								</label>
							</div>
						</div>
					</div>
					<div class="portlet-body" style="display: block;">
						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<lavel class="control-label">Country</lavel>
									<div class="input-group">
										<select id="countrySel" name="country"
											class="form-control input-sm select2"> @foreach($countryList
											as $countryItem) @if($country &&
											$country==$countryItem['CountryID'])
											<option value="{{$countryItem['CountryID']}}"
												selected="selected">{{$countryItem['Country']}}</option>
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
										<select id="siteSel" name="site_id"
											class="form-control input-sm select2"> @foreach($siteList as
											$siteItem) @if($site_id==$siteItem['SiteID'])
											<option value="{{$siteItem['SiteID']}}" selected="selected">{{$siteItem['Site']}}</option>
											@else
											<option value="{{$siteItem['SiteID']}}">{{$siteItem['Site']}}</option>
											@endif @endforeach
										</select>
									</div>
								</div>
							</div>

						</div>
						<div class="table-scrollable">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>AnnouncementType</th>
										<th>Description</th>
										<th>Effectivity Date</th>
										<th>Expiration Date</th>
										<th>Operation</th>
									</tr>
								</thead>
								<tbody>
									@if(count($announcementList)>0) @foreach($announcementList as
									$announceItem)
									<tr>
										<td>{{$announceItem['id']}}</td>
										<td>{{$announceItem->announceType()->first()['type']}}</td>
										<td>{!! str_limit($announceItem['announcement'],10) !!}</td>
										<td>{{$announceItem['date_effectivity']}}</td>
										<td>{{$announceItem['date_expired']}}</td>
										<td>
											<button type="button" accesskey="I"
												onclick="window.location.href='/etravel/announcement/{{$announceItem['id']}}/edit'"
												class="btn yellow-gold leave-type-button">
												<i class="fa fa-pencil"></i> Ed<u>i</u>t
											</button>
											<button type="button" accesskey="D"
												onclick="announcementDel({{$announceItem['id']}})"
												class="btn red-mint leave-type-button">
												<i class="fa fa-times"></i> <u>D</u>elete
											</button>
										</td>
									</tr>
									@endforeach @else
									<tr>
										<td align="center" colspan="8" style="color: red"
											data-value=" No records found.">No records found.</td>
									</tr>
									@endif
								</tbody>
							</table>
                                        <?php echo $announcementList->render();?>
                                    </div>
					</div>
				</div>
				<!-- END SAMPLE TABLE PORTLET-->
			
				</div>
			</div>
	</div>
	
</div>
<script src="{{asset('/js/etravel/announcement/index.js')}}"></script>
@endsection
