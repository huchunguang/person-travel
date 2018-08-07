<td style="text-align: left; display: table-cell;">{{$shift['id']}}</td>
<td style="text-align: center; display: table-cell;">
	<div class="form-group form-md-line-input has-info">
		<input type="text" class="form-control" name="shift" value="{{$shift['shift']}}">
		<div class="form-control-focus"></div>
	</div>
</td>
<td style="text-align: left; display: table-cell;">{{$shift['created_at']}}</td>
<td style="text-align: left; display: table-cell;">{{$shift['updated_at']}}</td>
<td style="text-align: left; display: table-cell;">
	<button id="iggUpdate" type="button" accesskey="U" class="btn green" onclick="shiftUpdate({{$shift['id']}})">
		<i class="fa fa-save"></i> <u>U</u>pdate
	</button>
	<button id="iggCancel" type="button" accesskey="D" class="btn default" onclick="shiftCancel({{$shift['id']}})">
		<i class="fa fa-share"></i> <u>C</u>ancel
	</button>
</td>
