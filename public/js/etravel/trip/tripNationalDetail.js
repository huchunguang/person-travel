$('#downloadFile').on('click',function(){
	window.location.href='/download?filename='+$(this).data('filename');
});