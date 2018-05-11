@extends("etravel.layout.main") @section("content")
<div class="container">
	<div class="page-content-inner">
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN SAMPLE TABLE PORTLET-->
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-comments"></i>List of Airline
						</div>
						<div class="actions">
							<div class="btn-group btn-group-devided" data-toggle="modal" data-target="#newAirlineModal" accessKey="N">
								<label class="btn blue-steel leave-type-button"> <i class="fa fa-plus"></i><u>N</u>EW</label>
							</div>
						</div>
					</div>
					<div class="portlet-body" style="display: block;">
						<div class="table-scrollable">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Air Name</th>
										<th>Air Code</th>
										<th>Create Time</th>
										<th>Update Time</th>
									</tr>
								</thead>
								<tbody>
									@if(count($airlineList)>0)
									@foreach($airlineList as $item)
									<tr>
										<td>1</td>
										<td>{{$item['airline_name']}}</td>
										<td>{{$item['airline_code']}}</td>
										<td>{{$item['created_time']}}</td>
										<td>{{$item['updated_time']}}</td>
										<td>
											<button type="button" accesskey="I" onclick="EditPurposeType({{ $purposeList[$i]['purpose_id'] }})" class="btn yellow-gold">
												<i class="fa fa-pencil"></i> Ed<u>i</u>t
											</button>
											<button type="button" onclick="DeletePurposeType({{ $purposeList[$i]['purpose_id'] }})" class="btn red-mint">
												<i class="fa fa-times"></i> <u>D</u>elete
											</button>
										</td>
									</tr>
									@endforeach 
									@else
									<tr>
										<td align="center" colspan="8" style="color: red" data-value=" No records found.">No records found.</td>
									</tr>
									@endif
								</tbody>
							</table>
                                        <?php echo $airlineList->render();?>
                                    </div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<script src="{{asset('/js/etravel/airline/index.js')}}"></script>
@include('etravel.modal.newAirline')
@endsection
