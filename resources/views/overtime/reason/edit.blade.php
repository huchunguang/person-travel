<td style="text-align: left; display: table-cell;">{{$reason['id']}}</td>
<td style="text-align: center; display: table-cell;">
	<div class="form-group form-md-line-input has-info">
		<input type="text" class="form-control" name="reason_subject" value="{{$reason['reason_subject']}}">
		<div class="form-control-focus"></div>
	</div>
</td>
<td style="text-align: left; display: table-cell;">{{$reason['created_at']}}</td>
<td style="text-align: left; display: table-cell;">{{$reason['updated_at']}}</td>
<td style="text-align: left; display: table-cell;">
	<button id="reasonUpdate" type="button" accesskey="U" class="btn green" onclick="reasonUpdate({{$reason['id']}})">
		<i class="fa fa-save"></i> <u>U</u>pdate
	</button>
	<button id="reasonCancel" type="button" accesskey="D" class="btn default" onclick="reasonCancel({{$reason['id']}})">
		<i class="fa fa-share"></i> <u>C</u>ancel
	</button>
</td>
