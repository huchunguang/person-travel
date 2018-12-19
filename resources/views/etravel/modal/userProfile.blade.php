<div class="modal fade" id="userProfileModal" role="dialog" aria-labelledby="userProfileModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">My Profile</h4>
			</div>
			<form id="ProfileForm" role="form" data-toggle="validator" action="/userUpdate/{{Auth::user()->UserID}}" method="POST" enctype="multipart/form-data">
				<div class="modal-body" style="padding-bottom: 0px;">
					<div class="form-group" style="padding-right: 15px; padding-bottom: 0px; margin-bottom: 0px;">
						<div class="panel" style="margin-bottom: 0px">
							<div class="panel-heading" style="height: 35px; background-color: #32c5d2;">
								<span style="font-size: 14px; line-height: 14px;">Employment Informations</span>
							</div>
							<div id="EmploymentInfoDetails" class="panel-body" style="font-size: 12px; padding: 0 0 0 3">
								<div class="row">
									<div class="form-group col-sm-6" style="padding-right: 0px;">
										<label class="control-label col-xs-4" style="padding-right: 0px; text-align: right;">Date-Hired:</label>
										<div class="col-xs-8" style="padding-right: 0px;">
											<input type="text" disabled="disabled" class="form-control profile-entry" name="inputBusinessPlace" id="inputBusinessPlace" value="{{Auth::user()->DateHired}}">
										</div>
									</div>
									<div class="form-group col-sm-6" style="padding-right: 0px;">
										<label class="control-label col-xs-4" style="padding-right: 0px; text-align: right;">Position:</label>
										<div class="col-xs-8" style="padding-right: 0px;">
											<input type="text" disabled="disabled" class="form-control profile-entry" name="inputWorkPosition" id="inputWorkPosition" placeholder="Position" value="{{Auth::user()->WorkPosition}}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6" style="padding-right: 0px;">
										<label for="EmploymentStatusList" class="control-label col-xs-4" style="padding-right: 0px; text-align: right;">Category:</label>
										<div class="col-xs-8" style="padding-right: 0px;">
											<input type="text" disabled="disabled" class="form-control profile-entry" name="inputWorkPosition" id="inputWorkPosition" placeholder="Category" value="{{Auth::user()->employmentcategory()->first()->EmploymentCategory}}" required>
										</div>
									</div>
									<div class="form-group col-sm-6" style="padding-right: 0px;">
										<label for="EmploymentStatusList" class="control-label col-xs-4" style="padding-right: 0px; text-align: right;">Status:</label>
										<div class="col-xs-8" style="padding-right: 0px;">
											<input type="text" disabled="disabled" class="form-control profile-entry" name="inputWorkPosition" id="inputWorkPosition" placeholder="Status" value="{{Auth::user()->employmentstatus()->first()->EmploymentStatus}}" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6" style="padding-right: 0px;">
										<label class="control-label col-xs-4" style="padding-right: 0px; text-align: right;">Add'l Notification:</label>
										<div class="col-xs-8" style="padding-right: 0px;">
											@if(Auth::user()->manager())
											
											<input type="text" disabled="disabled" class="form-control profile-entry" name="inputWorkPosition" id="inputWorkPosition" placeholder="Add'l Notification" value="{{Auth::user()->manager()->first()->LastName}} {{Auth::user()->manager()->first()->FirstName}}">
											@else
											<input type="text" disabled="disabled" class="form-control profile-entry" name="inputWorkPosition" id="inputWorkPosition" placeholder="Add'l Notification" value="">
											@endif
										</div>
									</div>
									<div class="form-group col-sm-6" style="padding-right: 0px;">
										<label class="control-label col-xs-4" style="padding-right: 0px; text-align: right;">Site:</label>
										<div class="col-xs-8" style="padding-right: 0px;">
											<input type="text" disabled="disabled" class="form-control profile-entry" name="inputBusinessPlace" id="Site" value="{{Auth::user()->site()->first(['Site'])->Site}}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6" style="padding-right: 0px;">
										<label class="control-label col-xs-4" style="padding-right: 0px; text-align: right;">Company:</label>
										<div class="col-xs-8" style="padding-right: 0px;">
											<input type="text" disabled="disabled" class="form-control profile-entry" name="inputBusinessPlace" id="Company" value="{{Auth::user()->company->first()->CompanyName}}">
										</div>
									</div>
									<div class="form-group col-sm-6" style="padding-right: 0px;">
										<label class="control-label col-xs-4" style="padding-right: 0px; text-align: right;">Department:</label>
										<div class="col-xs-8" style="padding-right: 0px;">
											<input type="text" disabled="disabled" class="form-control profile-entry" name="inputBusinessPlace" id="inputBusinessPlace" value="{{Auth::user()->department()->first(['Department'])->Department}}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6" style="padding-right: 0px;">
										<label for="inputBusinessPlace" style="padding-right: 0px; text-align: right;" class="control-label col-xs-4">Business Place:</label>
										<div class="col-xs-8" style="padding-right: 0px;">
											<input type="text" disabled="disabled" class="form-control profile-entry" name="inputBusinessPlace" id="inputBusinessPlace" placeholder="Business Place" value="{{Auth::user()->BusinessPlace}}">
										</div>
									</div>
									<div class="form-group col-sm-6" style="padding-right: 0px;">
										<label for="ProfileCostCenter" style="padding-right: 0px; text-align: right;" class="control-label col-xs-4">Cost Center:</label>
										<div class="col-xs-8" style="padding-right: 0px;">
											<input type="text" disabled="disabled" class="form-control profile-entry" name="inputBusinessPlace" id="inputBusinessPlace" value="{{Auth::user()->costcenter->first()->CostCenterCode}}">
										</div>
									</div>
								</div>
								<!-- 								<div class="row"> -->
								<!-- 									<div class="form-group col-sm-6">										<label for="inputStaffVendorCode" style="padding-right: 0px; text-align: right;" class="control-label col-xs-4">Off Days:</label>
 -->
								<!-- 										<div class="col-xs-8"></div> -->
								<!-- 									</div> -->
								<!-- 									<div class="form-group col-sm-6">										<label for="inputStaffVendorCode" style="padding-right: 0px; text-align: right;" class="control-label col-xs-4">Off Date:</label>
 -->
								<!-- 										<div class="col-xs-8"></div> -->
								<!-- 									</div> -->
								<!-- 								</div> -->
								<div class="row">
									<div class="form-group col-sm-6" style="padding-right: 0px;">
										<label for="inputStaffCode" style="padding-right: 0px; text-align: right;" class="control-label col-xs-4">Staff Code:</label>
										<div class="col-xs-8" style="padding-right: 0px;">
											<input type="text" disabled="disabled" class="form-control profile-entry" name="inputBusinessPlace" id="inputBusinessPlace" placeholder="Enter Business Place" value="{{Auth::user()->StaffCode}}">
										</div>
									</div>
									<div class="form-group col-sm-6" style="padding-right: 0px;">
										<label for="inputStaffVendorCode" style="padding-right: 0px; text-align: right;" class="control-label col-xs-4">Vendor Code:</label>
										<div class="col-xs-8" style="padding-right: 0px;">
											<input type="text" disabled="disabled" class="form-control profile-entry" onblur="checkStaffVendorCode()" name="inputStaffVendorCode" id="inputStaffVendorCode" placeholder="NA" value="{{Auth::user()->StaffVendorCode}}">
											<span id="StaffVendorCodeNotification" style="display: none; color: red; font-size: 10px">Staff Vendor Code already existed!</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" style="padding-right: 15px;">
						<div class="panel" style="margin-bottom: 0px">
							<div class="panel-heading" style="height: 35px; background-color: #32c5d2;">
								<span style="font-size: 14px; line-height: 14px;">My Picture</span>
							</div>
							<div id="EmploymentInfoDetails" class="panel-body" style="font-size: 12px; padding: 0 0 0 3; padding-bottom: 0px;">
								<div class="row">
									<div class="form-group col-sm-7">
										<label class="control-label col-xs-4" style="padding-right: 0px; text-align: right;">Profile Photo:</label>
										<div class="col-xs-8">
											<div id="PreviewImage">
												<img alt="" class="" id="inputSignature" src="{{ Auth::user()->Signature }}" height="150px" width="150px">
											</div>
										</div>
									</div>
									<div class="form-group col-sm-5" style="height: 150px;">
										<a style="margin-top: 0px; position: absolute; bottom: 0px;" href="#" class="btn btn-primary profile-entry btn-LoadSignature" style="margin-top: 10px" onclick="$('#Signature').click();"> Upload Picture </a>
									</div>
									<input type="file" style="visibility: hidden;" accept=".jpg,.png,.gif" id="Signature" name="Signature" class="">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="btnLeaveControl-Delete" type="submit" accesskey="N" class="btn btn-primary">
						<u>U</u>pdate
					</button>
				</div>
			</form>
		</div>
	</div>
</div>