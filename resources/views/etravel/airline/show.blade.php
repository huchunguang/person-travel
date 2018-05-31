<td>{{$airline['id']}}</td>
<td>{{$airline['airline_name']}}</td>
<td>{{$airline['airline_code']}}</td>
<td>{{$airline['created_at']}}</td>
<td>{{$airline['updated_at']}}</td>
<td>
	<button type="button" accesskey="I"
		onclick="EditAirline({{ $airline['id'] }})" class="btn yellow-gold">
		<i class="fa fa-pencil"></i> Ed<u>i</u>t
	</button>
	<button type="button" onclick="DeleteAirline({{ $airline['id'] }})"
		class="btn red-mint">
		<i class="fa fa-times"></i> <u>D</u>elete
	</button>
</td>