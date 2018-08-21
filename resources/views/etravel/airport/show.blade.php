<td>{{$airport['airport']}}</td>
<td>{{$airport['created_at']}}</td>
<td>{{$airport['updated_at']}}</td>
<td>
	<button type="button" accesskey="I"
		onclick="EditAirport({{ $airport['id'] }})" class="btn yellow-gold">
		<i class="fa fa-pencil"></i> Ed<u>i</u>t
	</button>
	<button type="button" onclick="DeleteAirport({{ $airport['id'] }})"
		class="btn red-mint">
		<i class="fa fa-times"></i> <u>D</u>elete
	</button>
</td>