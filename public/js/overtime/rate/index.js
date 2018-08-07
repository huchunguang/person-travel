
function rateEdit(rate_id){
	$.get('/overtime/rate/'+rate_id+'/edit',{},function(data){
		$('#TableClassRowID-'+rate_id).html(data);
	});
};


function rateUpdate(rate_id){
	var rate = $('input[name="rate"]').val();
	$.post('/overtime/rate/'+rate_id,{'rate':rate,'_method':'PUT'},function(data){
		$('#TableClassRowID-'+rate_id).html(data);
	});
};


function rateDel(rate_id){
	$.ajax({
		'type':'DELETE',
		'url':'/overtime/rate/'+rate_id,
		'data':'',
		'dataType':'json',
		'success':function(data){
			if(data.res_info.code == '100000'){
				$('#TableClassRowID-'+rate_id).remove();
			}
		},
		'error':function(data){
			
		}
	});


};

function rateCancel(rate_id)
{
	$.get('/overtime/rate/'+rate_id,{},function(data){
		$('#TableClassRowID-'+rate_id).html(data);
	});
}
