<td>{{$shift['id']}}</td>
<td>{{$shift['shift']}}</td>
<td>{{$shift['created_at']}}</td>
<td>{{$shift['updated_at']}}</td>
<td>
	<button type="button" accesskey="I"
		onclick="shiftEdit({{ $shift['id'] }})" class="btn yellow-gold">
		<i class="fa fa-pencil"></i> Ed<u>i</u>t
	</button>
	<button type="button" onclick="shiftDel({{ $shift['id'] }})"
		class="btn red-mint">
		<i class="fa fa-times"></i> <u>D</u>elete
	</button>
</td>