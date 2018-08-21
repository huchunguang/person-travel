function EditAirport(airport_id)
{
	$.get('/cityAirport/'+airport_id+'/edit',{},function(data){
		$('#TableClassRowID-'+airport_id).html(data);
	});
}


function SaveAirport(airport_id){
	var airport = $('#airport').val();
	$.post('/cityAirport/'+airport_id,{'airport':airport,'_method':'PUT'},function(data){
		$('#TableClassRowID-'+airport_id).html(data);
	});
}
function CancelAirport(airport_id)
{
	$.get('/cityAirport/'+airport_id,{},function(data){
		$('#TableClassRowID-'+airport_id).html(data);
	});
}

function DeleteAirport(airport_id){
	$.ajax({
		'type':'DELETE',
		'url':'/cityAirport/'+airport_id,
		'data':'',
		'dataType':'json',
		'success':function(data){
			if(data.res_info.code == '100000'){
				$('#TableClassRowID-'+airport_id).remove();
			}
		},
		'error':function(data){
			
		}
	});

}