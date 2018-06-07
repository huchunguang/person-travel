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
							<i class="fa fa-comments"></i>List Of Travel Purpose
						</div>
						<div class="actions">
							<div class="btn-group btn-group-devided" accesskey="N"
								onclick="window.location.href='/etravel/purpose/create'">
								<label class="btn blue-steel leave-type-button"> <i
									class="fa fa-plus"></i><u>N</u>EW
								</label>
							</div>
						</div>
					</div>
					<div class="portlet-body" style="display: block;">
					<form action="{{url('etravel/purpose')}}" method="get" id="adminPurposeCatform" role="form">
							<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							@include('etravel.snippets.CountrySiteCompany')
						<div class="row">
								<div class="col-md-6 text-right">
									<button id="btnExecute" type="submit" class="btn green" data-toggle="tooltip" data-placement="bottom" title="Click to execute.">
										<i class="fa fa-filter"></i> Filter
									</button>
								</div>
						</div>
						</form>
						<div class="table-scrollable">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Purpose Type</th>
										<th>Purpose Description</th>
										<th>Operation</th>
									</tr>
								</thead>
								<tbody>
									@if(count($purposeList)>0) 
									@foreach($purposeList as $purposeItem)
									<tr id="announce_{{$purposeItem['purpose_id']}}">
										<td>{{$purposeItem['purpose_id']}}</td>
										<td>{{$purposeItem['purpose_catgory']}}</td>
										<td>{!! str_limit($purposeItem['purpose_desc'],10) !!}</td>
										<td>
											<button type="button" accesskey="I"
												onclick="window.location.href='/etravel/purpose/{{$purposeItem['purpose_id']}}/edit'"
												class="btn yellow-gold leave-type-button">
												<i class="fa fa-pencil"></i> Ed<u>i</u>t
											</button>
											<button type="button" accesskey="D"
												onclick="announcementDel({{$purposeItem['purpose_id']}})"
												class="btn red-mint leave-type-button">
												<i class="fa fa-times"></i> <u>D</u>elete
											</button>
										</td>
									</tr>
									@endforeach 
									@else
									<tr>
										<td align="center" colspan="8" style="color: red"
											data-value=" No records found.">No records found.</td>
									</tr>
									@endif
								</tbody>
							</table>
                                        <?php echo $purposeList->render();?>
                                    </div>
					</div>
				</div>
				<!-- END SAMPLE TABLE PORTLET-->
			
				</div>
			</div>
	</div>
	
</div>
<script src="{{asset('/js/etravel/announcement/announcement.js')}}"></script>
@endsection
