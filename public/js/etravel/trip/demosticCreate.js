$(function(){
	function initializeDateSettings(){
		var nowTime = '<%=DateTime.Now.ToString("HH:mm")%>';
		 $(".time-input").val(nowTime).timepicker('setTime', nowTime);
		 
			$('#daterange-btn').daterangepicker({
		        startDate: moment(),
		        endDate: moment().endOf('month'),
		        drops: "up"
		    },
		    function(start, end) {
		        $('#daterange-btn span').html(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
		    }
		);
			$('.singleDatePicker').daterangepicker({
		        startDate: moment(),
		        endDate: moment().endOf('month'),
		        drops: "up",
		        singleDatePicker:true,
		    },
		    function(start, end) {
		        $('#daterange-btn span').html(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
		    }
		);
	}
	initializeDateSettings();
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
