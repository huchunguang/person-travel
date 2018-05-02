@extends("etravel.layout.main") @section("content")
<div class="container">
	@include("etravel.layout.pagebar")
	<div class="page-content-inner">
		<div class="inbox row">
			<div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-comments"></i>List of Announcement</div>
                                    <div class="actions">
					<div class="btn-group btn-group-devided" accesskey="N" onclick="window.location.href='/etravel/announcement/create'">
						<label class="btn blue-steel leave-type-button"> <i class="fa fa-plus"></i><u>N</u>EW
						</label>
					</div>
				</div>
                                </div>
                                <div class="portlet-body" style="display: block;">
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th> # </th>
                                                    <th> AnnouncementType </th>
                                                    <th> Description </th>
                                                    <th> Effectivity Date	 </th>
                                                    <th> Expiration Date </th>
                                                    <th> Operation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                                <tr>
                                                    <td> 1 </td>
                                                    <td> Mark </td>
                                                    <td> Otto </td>
                                                    <td> makr124 </td>
                                                    <td> test date</td>
                                                    <td>
                                                        <button id="LeaveTypeEdit" type="button" accesskey="I" onclick="EditPurposeType(1)" title="Edit Leave Type" class="btn yellow-gold leave-type-button">
										<i class="fa fa-pencil"></i> Ed<u>i</u>t
									</button>
									<button id="LeaveTypeCancel" type="button" accesskey="D" onclick="DeletePurposeType(1)" title="Delete Operation" class="btn red-mint leave-type-button">
										<i class="fa fa-times"></i> <u>D</u>elete
									</button>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END SAMPLE TABLE PORTLET-->
                        </div>
		</div>
	</div>
	
</div>
@endsection
