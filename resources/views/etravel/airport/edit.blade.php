<td style="text-align: center; display: table-cell;">
<div class="form-group form-md-line-input has-info">
<input type="text" class="form-control" name="airport" id="airport" value="{{$airport['airport']}}">
<div class="form-control-focus"> </div>
</div>
</td>


<td style="text-align: left; display: table-cell;">{{$airport['created_at']}}</td>
<td style="text-align: left; display: table-cell;">{{$airport['updated_at']}}</td>
<td style="text-align: left; display: table-cell;">
	
	<button id="LeaveTypeEdit" type="button" accesskey="I"
		onclick="SaveAirport({{ $airport['id'] }})" class="btn green">
		<i class="fa fa-save"></i> <u>S</u>ave
	</button>
	<button id="LeaveTypeCancel" type="button" accesskey="D"
		onclick="CancelAirport({{ $airport['id'] }})"
		class="btn default">
		<i class="fa fa-share"></i> <u>C</u>ancel
	</button>
	
</td>