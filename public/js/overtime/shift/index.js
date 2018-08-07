
function shiftEdit(shift_id){
	$.get('/overtime/shift/'+shift_id+'/edit',{},function(data){
		$('#TableClassRowID-'+shift_id).html(data);
	});
};


function shiftUpdate(shift_id){
	var shift = $('input[name="shift"]').val();
	$.post('/overtime/shift/'+shift_id,{'shift':shift,'_method':'PUT'},function(data){
		$('#TableClassRowID-'+shift_id).html(data);
	});
};


function shiftDel(shift_id){
	$.ajax({
		'type':'DELETE',
		'url':'/overtime/shift/'+shift_id,
		'data':'',
		'dataType':'json',
		'success':function(data){
			if(data.res_info.code == '100000'){
				$('#TableClassRowID-'+shift_id).remove();
			}
		},
		'error':function(data){
			
		}
	});


};

function shiftCancel(shift_id)
{
	$.get('/overtime/shift/'+shift_id,{},function(data){
		$('#TableClassRowID-'+shift_id).html(data);
	});
}
