function EditAirline(airline_id)
{
	$.get('/etravel/airline/'+airline_id+'/edit',{},function(data){
		$('#TableClassRowID-'+airline_id).html(data);
	});
}


function SaveAirline(airline_id){
	var airline_name = $('#airline_name').val();
	var airline_code = $('#airline_code').val();
	$.post('/etravel/airline/'+airline_id,{'airline_name':airline_name,'airline_code':airline_code,'_method':'PUT'},function(data){
		$('#TableClassRowID-'+airline_id).html(data);
	});
}
function CancelAirline(airline_id)
{
	$.get('/etravel/airline/'+airline_id,{},function(data){
		$('#TableClassRowID-'+airline_id).html(data);
	});
}

function DeleteAirline(airline_id){
	$.ajax({
		'type':'DELETE',
		'url':'/etravel/airline/'+airline_id,
		'data':'',
		'dataType':'json',
		'success':function(data){
			if(data.res_info.code == '100000'){
				$('#TableClassRowID-'+airline_id).remove();
			}
		},
		'error':function(data){
			
		}
	});

}