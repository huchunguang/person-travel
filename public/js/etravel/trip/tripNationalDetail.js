$('#downloadFile').on('click',function(){
	window.location.href='/download?filename='+$(this).data('filename');
});


$('#approveBtn').on('click',function(){
	$('input[name="status"]').val('approved');
	$('#national_approval').submit();
	$('#approveBtn').prop('disabled',true);
});

$('#btnRejectTravel').on('click',function(){
	$('#national_approval').submit();
	$('#btnRejectTravel').prop('disabled',true);
});