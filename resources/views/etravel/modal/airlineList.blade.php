<div class="modal fade" id="airlineList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">
					<strong>Select Carrier</strong>
				</h4>
			</div>
			<div class="modal-body">
				<label for="">Select Carrier from the list</label>
				@if(count($airlineList))
				<select name="airlineSel" id="aircodeSel" class="form-control" multiple size="6">
					@foreach($airlineList as $item)
					<option value="{{$item['id']}}" data-code="{{$item['airline_code']}}">{{$item['airline_name']}}</option>
					@endforeach
				</select>
				@endif
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="cancelAirlineBtn">Cancel</button>
				<button type="button" class="btn btn-primary" id="checkAirlineBtn">OK</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal -->
</div>