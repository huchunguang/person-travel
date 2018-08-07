<td>{{$rate['id']}}</td>
<td>{{$rate['rate']}}</td>
<td>{{$rate['created_at']}}</td>
<td>{{$rate['updated_at']}}</td>
<td>
	<button type="button" accesskey="I"
		onclick="rateEdit({{ $rate['id'] }})" class="btn yellow-gold">
		<i class="fa fa-pencil"></i> Ed<u>i</u>t
	</button>
	<button type="button" onclick="rateDel({{ $rate['id'] }})"
		class="btn red-mint">
		<i class="fa fa-times"></i> <u>D</u>elete
	</button>
</td>