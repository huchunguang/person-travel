
function iggEdit(igg_id){
	$.get('/overtime/igg/'+igg_id+'/edit',{},function(data){
		$('#TableClassRowID-'+igg_id).html(data);
	});
};


function iggUpdate(igg_id){
	var igg = $('input[name="igg"]').val();
	$.post('/overtime/igg/'+igg_id,{'igg':igg,'_method':'PUT'},function(data){
		$('#TableClassRowID-'+igg_id).html(data);
	});
};


function iggDel(igg_id){
	$.ajax({
		'type':'DELETE',
		'url':'/overtime/igg/'+igg_id,
		'data':'',
		'dataType':'json',
		'success':function(data){
			if(data.res_info.code == '100000'){
				$('#TableClassRowID-'+igg_id).remove();
			}
		},
		'error':function(data){
			
		}
	});


};

function iggCancel(igg_id)
{
	$.get('/overtime/igg/'+igg_id,{},function(data){
		$('#TableClassRowID-'+igg_id).html(data);
	});
}
