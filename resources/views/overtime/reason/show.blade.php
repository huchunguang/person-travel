<td>{{$reason['id']}}</td>
<td>{{$reason['reason_subject']}}</td>
<td>{{$reason['created_at']}}</td>
<td>{{$reason['updated_at']}}</td>
<td>
	<button type="button" accesskey="I"
		onclick="reasonEdit({{ $reason['id'] }})" class="btn yellow-gold">
		<i class="fa fa-pencil"></i> Ed<u>i</u>t
	</button>
	<button type="button" onclick="reasonDel({{ $reason['id'] }})"
		class="btn red-mint">
		<i class="fa fa-times"></i> <u>D</u>elete
	</button>
</td>