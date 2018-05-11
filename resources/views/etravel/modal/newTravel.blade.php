<div class="modal fade" id="newTravel" role="dialog" aria-labelledby="addNewLineModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">New Travel Request</h4>
			</div>
			<form action="/etravel/trip" role="form" method="post">
			<div class="modal-body">

				
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<input type="radio" name="trip" value="international" /> <a
							href="javascript:;" class="btn info "> <strong>International Trip</strong>
						</a>

					</div>
					<div class="form-group">
						<input type="radio" name="trip" value="demostic" /> <a
							href="javascript:;" class="btn info "><strong>Domestic Trip</strong></a>

					</div>

				

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				
						<button id="btnLeaveControl-Delete" type="submit" accesskey="N"
							class="btn green">
							<i class="glyphicon glyphicon-plus-sign"></i> <u>N</u>ew
						</button>
					
			</div>
			</form>
		</div>
	</div>
</div>