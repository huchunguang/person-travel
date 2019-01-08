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
							<i class="fa fa-comments"></i>List Of Delegation
						</div>
						<div class="actions">
							<div class="btn-group btn-group-devided" accesskey="N"
								onclick="window.location.href='/delegate/create'">
								<label class="btn blue-steel leave-type-button"> <i
									class="fa fa-plus"></i><u>N</u>EW
								</label>
							</div>
						</div>
					</div>
					<div class="portlet-body" style="display: block;">
					
						<div class="table-scrollable">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Country</th>
										<th>Delegated Manager</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Status</th>
<!-- 										<th>Operation</th> -->
									</tr>
								</thead>
								<tbody>
									@if(count($delegateList)>0) 
									@foreach($delegateList as $delegateItem)
									<tr id="TableClassRowID-{{$delegateItem['DelegationID']}}">
										<td>{{$delegateItem['DelegationID']}}</td>
										<td>{{$delegateItem->delegatedCountry()->first()->Country}}</td>
										<td>{{$delegateItem->delegatedApprover()->first()->LastName}} {{$delegateItem->delegatedApprover()->first()->FirstName}}</td>
										<td>{{$delegateItem['DelegationStartDate']}}</td>
										<td>{{$delegateItem['DelegationEndDate']}}</td>
										<td>{{$delegateItem['EnableDelegation']}}</td>
										
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
                                        <?php echo $delegateList->render();?>
                                    </div>
					</div>
				</div>
				<!-- END SAMPLE TABLE PORTLET-->
			
				</div>
			</div>
	</div>
	
</div>
<script src="{{asset('/js/etravel/purpose/index.js')}}"></script>
@endsection
