<td style="text-align: left; display: table-cell;">{{$airline['id']}}</td>
<td style="text-align: center; display: table-cell;">
<div class="form-group form-md-line-input has-info">
<input type="text" class="form-control" name="airline_name" id="airline_name" value="{{$airline['airline_name']}}">
<div class="form-control-focus"> </div>
</div>
</td>

<td style="text-align: center; display: table-cell;">
<div class="form-group form-md-line-input has-info">
<input type="text" class="form-control" name="airline_code" id="airline_code" value="{{$airline['airline_code']}}">
<div class="form-control-focus"> </div>
</div>
</td>
<td style="text-align: left; display: table-cell;">{{$airline['created_at']}}</td>
<td style="text-align: left; display: table-cell;">{{$airline['updated_at']}}</td>
<td style="text-align: left; display: table-cell;">
	
	<button id="LeaveTypeEdit" type="button" accesskey="I"
		onclick="SaveAirline({{ $airline['id'] }})" class="btn green">
		<i class="fa fa-save"></i> <u>S</u>ave
	</button>
	<button id="LeaveTypeCancel" type="button" accesskey="D"
		onclick="CancelAirline({{ $airline['id'] }})"
		class="btn default">
		<i class="fa fa-share"></i> <u>C</u>ancel
	</button>
	
</td>