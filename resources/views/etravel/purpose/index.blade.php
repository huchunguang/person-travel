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





<!-- 模态框（Modal） -->
<div class="modal fade" id="newPurposeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="#" id="form_sample_2" class="form-horizontal"
				method="post" novalidate="novalidate">

				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">×</button>
					<h4 class="modal-title" id="myModalLabel">
						<span class="caption-subject bold uppercase"> New Travel Purpose</span>
					</h4>
				</div>
				<div class="modal-body">

					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Your form validation is successful!
						</div>
						<div class="form-group">
						<div class="col-md-4">
							<label class="control-label ">PURPOSE CATEGORY <span class="required"
								aria-required="true"> * </span>
							</label>
						</div>
						
							
							<div class="col-md-10">
								<div class="input-icon right">
									<i class="fa"></i> <input type="text" class="form-control"
										name="purpose_catgory">
								</div>
							</div>
						</div>
						<div class="form-group">
						<div class="col-md-4">
							<label>PURPOSE DESCRIPTION  <span
								class="required" aria-required="true"> * </span>
							</label>
							</div>
							<div class="col-md-10">
								<div class="input-icon right">
									<i class="fa"></i> <input type="text" class="form-control"
										name="purpose_desc ">
								</div>
							</div>
						</div>
					</div>



				</div>
				<div class="modal-footer">
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button type="submit" class="btn green">Save</button>
								<button type="button" class="btn default" data-dismiss="modal">Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->






@endsection
