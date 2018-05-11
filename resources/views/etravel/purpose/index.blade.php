@extends("etravel.layout.main") 
@section("content")
<script src="{{asset('js/etravel/purpose/index.js')}}" type="text/javascript"></script>
<div class="page-content-inner">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-comments"></i>Travel Purpose Settings
				</div>
				<div class="actions">
					<div class="btn-group btn-group-devided" data-toggle="modal" data-target="#newPurposeModal" accessKey="N">
						<label class="btn blue-steel leave-type-button"> <i class="fa fa-plus"></i><u>N</u>EW
						</label>
					</div>
				</div>
			</div>
			<div class="portlet-body">
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
							@for ($i = 0; $i < count($purposeList); $i++)
							<tr id="TableClassRowID-{{ $purposeList[$i]['purpose_id'] }}"
								class="highlight">
								<td style="text-align: left; display: table-cell;">{{
									$purposeList[$i]['purpose_id'] }}</td>
								<td style="text-align: center; display: table-cell;">{{
									$purposeList[$i]['purpose_catgory'] }}</td>
								<td style="text-align: left; display: table-cell;">{{
									$purposeList[$i]['purpose_desc'] }}</td>
								<td style="text-align: left; display: table-cell;">
									<button id="LeaveTypeEdit" type="button" accesskey="I"
										onclick="EditPurposeType({{ $purposeList[$i]['purpose_id'] }})"
										title="Edit Leave Type"
										class="btn yellow-gold leave-type-button">
										<i class="fa fa-pencil"></i> Ed<u>i</u>t
									</button>
									<button id="LeaveTypeCancel" type="button" accesskey="D"
										onclick="DeletePurposeType({{ $purposeList[$i]['purpose_id'] }})"
										title="Delete Operation"
										class="btn red-mint leave-type-button">
										<i class="fa fa-times"></i> <u>D</u>elete
									</button>
								</td>
							</tr>
							@endfor
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- END SAMPLE TABLE PORTLET-->
	</div>
</div>
</div>
@include('etravel.modal.newPurpose')
@endsection
