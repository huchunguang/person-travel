
function reasonEdit(reason_id){
	$.get('/overtime/reason/'+reason_id+'/edit',{},function(data){
		$('#TableClassRowID-'+reason_id).html(data);
	});
};


function reasonUpdate(reason_id){
	var reason_subject = $('input[name="reason_subject"]').val();
	$.post('/overtime/reason/'+reason_id,{'reason_subject':reason_subject,'_method':'PUT'},function(data){
		$('#TableClassRowID-'+reason_id).html(data);
	});
};


function reasonDel(reason_id){
	$.ajax({
		'type':'DELETE',
		'url':'/overtime/reason/'+reason_id,
		'data':'',
		'dataType':'json',
		'success':function(data){
			if(data.res_info.code == '100000'){
				$('#TableClassRowID-'+reason_id).remove();
			}
		},
		'error':function(data){
			
		}
	});


};

function reasonCancel(reason_id)
{
	$.get('/overtime/reason/'+reason_id,{},function(data){
		$('#TableClassRowID-'+reason_id).html(data);
	});
}
