function EditPurposeType(purpose_id){
	$.get('/etravel/purpose/edit/'+purpose_id,{},function(data){
		$('#TableClassRowID-'+purpose_id).html(data);
	});
}
function CancelPurposeType(purpose_id){
	$.get('/etravel/purpose/'+purpose_id,{},function(data){
		$('#TableClassRowID-'+purpose_id).html(data);
	});
}
function SavePurposeType(purpose_id){
	var purpose_catgory = $('#purpose_catgory').val();
	var purpose_desc = $('#purpose_desc').val();
	$.post('/etravel/purpose/'+purpose_id,{'purpose_catgory':purpose_catgory,'purpose_desc':purpose_desc},function(data){
		$('#TableClassRowID-'+purpose_id).html(data);
	});
}
function DeletePurposeType(purpose_id){
	$.ajax({
		'type':'DELETE',
		'url':'/etravel/purpose/'+purpose_id,
		'data':'',
		'dataType':'json',
		'success':function(data){
			if(data.res_info.code == '100000'){
				$('#TableClassRowID-'+purpose_id).remove();
			}
		},
		'error':function(data){
			
		}
	});

}