<td style="text-align: left; display: table-cell;">{{ $purpose['purpose_id'] }}</td>
<td style="text-align: left; display: table-cell;">{{ $purpose['purpose_catgory'] }}</td>
<td style="text-align: left; display: table-cell;">{{ $purpose['purpose_desc'] }}</td>
<td style="text-align: left; display: table-cell;">
	<button id="LeaveTypeEdit" type="button" accesskey="I"
		onclick="EditPurposeType({{ $purpose['purpose_id'] }})"
		title="Edit Leave Type" class="btn yellow-gold leave-type-button">
		<i class="fa fa-pencil"></i> Ed<u>i</u>t
	</button>
	<button id="LeaveTypeCancel" type="button" accesskey="D"
		onclick="DeletePurposeType({{ $purpose['purpose_id'] }})"
		title="Delete Operation" class="btn red-mint leave-type-button">
		<i class="fa fa-times"></i> <u>D</u>elete
	</button>
</td>

