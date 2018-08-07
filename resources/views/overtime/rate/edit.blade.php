<td style="text-align: left; display: table-cell;">{{$rate['id']}}</td>
<td style="text-align: center; display: table-cell;">
	<div class="form-group form-md-line-input has-info">
		<input type="text" class="form-control" name="rate" value="{{$rate['rate']}}">
		<div class="form-control-focus"></div>
	</div>
</td>
<td style="text-align: left; display: table-cell;">{{$rate['created_at']}}</td>
<td style="text-align: left; display: table-cell;">{{$rate['updated_at']}}</td>
<td style="text-align: left; display: table-cell;">
	<button id="rateUpdate" type="button" accesskey="U" class="btn green" onclick="rateUpdate({{$rate['id']}})">
		<i class="fa fa-save"></i> <u>U</u>pdate
	</button>
	<button id="rateCancel" type="button" accesskey="D" class="btn default" onclick="rateCancel({{$rate['id']}})">
		<i class="fa fa-share"></i> <u>C</u>ancel
	</button>
</td>
