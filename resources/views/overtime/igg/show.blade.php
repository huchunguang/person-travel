<td>{{$igg['id']}}</td>
<td>{{$igg['igg']}}</td>
<td>{{$igg['created_at']}}</td>
<td>{{$igg['updated_at']}}</td>
<td>
	<button type="button" accesskey="I"
		onclick="iggEdit({{ $igg['id'] }})" class="btn yellow-gold">
		<i class="fa fa-pencil"></i> Ed<u>i</u>t
	</button>
	<button type="button" onclick="iggDel({{ $igg['id'] }})"
		class="btn red-mint">
		<i class="fa fa-times"></i> <u>D</u>elete
	</button>
</td>