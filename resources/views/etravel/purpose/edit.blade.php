<td style="text-align: left; display: table-cell;">{{ $purpose['purpose_id'] }}</td>
<td style="text-align: left; display: table-cell;">
<div class="form-group form-md-line-input has-info">
<input type="text" class="form-control" name="purpose_catgory" id="purpose_catgory" value="{{ $purpose['purpose_catgory'] }}">
<div class="form-control-focus"> </div>
</div>

</td>
<td style="text-align: left; display: table-cell;">
<div class="form-group form-md-line-input has-info">
<input type="text" class="form-control" name="purpose_desc" id="purpose_desc" value="{{ $purpose['purpose_desc'] }}">
<div class="form-control-focus"> </div>
</div>

</td>
<td style="text-align: left; display: table-cell;">
	<button id="LeaveTypeEdit" type="button" accesskey="I"
		onclick="SavePurposeType({{ $purpose['purpose_id'] }})"
		title="Edit Leave Type" class="btn green">
		<i class="fa fa-save"></i> <u>S</u>ave
	</button>
	<button id="LeaveTypeCancel" type="button" accesskey="D"
		onclick="CancelPurposeType({{ $purpose['purpose_id'] }})" title="Delete Operation"
		class="btn default">
		<i class="fa fa-share"></i> <u>C</u>ancel
	</button>
</td>