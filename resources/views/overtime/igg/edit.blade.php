<td style="text-align: left; display: table-cell;">{{$igg['id']}}</td>
<td style="text-align: center; display: table-cell;">
	<div class="form-group form-md-line-input has-info">
		<input type="text" class="form-control" name="igg" value="{{$igg['igg']}}">
		<div class="form-control-focus"></div>
	</div>
</td>
<td style="text-align: left; display: table-cell;">{{$igg['created_at']}}</td>
<td style="text-align: left; display: table-cell;">{{$igg['updated_at']}}</td>
<td style="text-align: left; display: table-cell;">
	<button id="iggUpdate" type="button" accesskey="U" class="btn green" onclick="iggUpdate({{$igg['id']}})">
		<i class="fa fa-save"></i> <u>U</u>pdate
	</button>
	<button id="iggCancel" type="button" accesskey="D" class="btn default" onclick="iggCancel({{$igg['id']}})">
		<i class="fa fa-share"></i> <u>C</u>ancel
	</button>
</td>
