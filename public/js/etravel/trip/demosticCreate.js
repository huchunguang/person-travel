$(function(){

	$('#addLineItem').on('click',function(){
		var obj=document.all.requestTable;
		if(obj==null) return false;
		var rw=document.all.trOne;
		var newRow= obj.insertRow();
		var cell=null;
		 for (var i=0; i<rw.cells.length; i++)
		  {
		    cel=newRow.insertCell();
		    cel.innerHTML=rw.cells[i].innerHTML;
		  }
//		 $.getScript("{{asset('storage/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}");
		 initializeDateSettings();
		 return true;
	});
	
});
