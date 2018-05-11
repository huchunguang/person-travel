$('#downloadFile').on('click',function(){
	window.location.href='/download?filename='+$(this).data('filename');
});


$('#approveBtn').on('click',function(){
	$('input[name="status"]').val('approved');
	
	$('form').submit();
});

$('#btnRejectTravel').on('click',function(){
	$('form').submit();
});