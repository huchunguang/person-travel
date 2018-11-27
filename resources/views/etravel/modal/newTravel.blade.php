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
					<div class="input-group">
						<div class="icheck-inline">
							<label for="tabInternationalTrip"> 
							<input type="radio" name="trip" class="icheck" value="1" id="tabInternationalTrip" checked>
							 <span style="font-size: 16px; padding-left: 13px; color: #337ab7;" class="bold">International Trip</span>
							</label>
						</div>

					</div>
					<p></p>
					@if(Auth::user()->CountryAssignedID!=15)
					<div class="input-group">
						<div class="icheck-inline">
							<label for="domesticTrip"> 
							<input type="radio" name="trip" class="icheck" value="2" id="domesticTrip"> 
							<span style="font-size: 16px; padding-left: 13px; color: #337ab7;" class="bold">Domestic Trip</span>
							</label>
						</div>
					</div>
					@endif

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="btnLeaveControl-Delete" type="submit" accesskey="N" class="btn green">
					<i class="glyphicon glyphicon-plus-sign"></i><u>N</u>ew
				</button>
			</div>
			</form>
		</div>
	</div>
</div>