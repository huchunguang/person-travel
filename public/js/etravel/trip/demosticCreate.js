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
		        $('#daterange-btn').val(start.format('MM/DD') + ' - ' + end.format('MM/DD'));
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

var addnewLineNum = 0;
function addNewLine(){
	var datetime_date=$('input[name="datetime_date[]"]').val();
	var datetime_time=$('input[name="datetime_time[]"]').val();
	var location=$('input[name="location[]"]').val();
	var customer_name=$('input[name="customer_name[]"]').val();
	var contact_name=$('input[name="contact_name[]"]').val();
	var purpose_id=$('#purpose_id').val();
	var purpose_text=$('#purpose_id').find('option:selected').text();
	var purpose_desc=$('#purpose_desc').val();
	var travel_cost=$('input[name="travel_cost[]"]').val();
	var entertain_cost=$('input[name="entertain_cost[]"]').val();
	var entertain_detail=$('input[name="entertain_detail[]"]').val();
	var is_approved=$('#is_approved').val();
	var 	is_approved_text=$('#is_approved').find('option:selected').text();
	addnewLineNum++;

	 var rowTem = '<tr id="tr_' + addnewLineNum + '" onclick="showItemOperate(this)">'
     + '<td class="col-md-1"><input type="hidden" name="datetime_date[]" value="'+datetime_date+'"/>'+datetime_date+'</td>'
     + '<td class="col-md-2"><input type="hidden" name="datetime_time[]" value="'+datetime_time+'"/>'+datetime_time+'</td>'
     + '<td class="col-md-1"><input type="hidden" name="location[]" value="'+location+'"/>'+location+'</td>'
     + '<td class="col-md-1"><input type="hidden" name="customer_name[]" value="'+customer_name+'"/>'+customer_name+'</td>'
     + '<td class="col-md-1"><input type="hidden" name="contact_name[]" value="'+contact_name+'"/>'+contact_name+'</td>'
     + '<td class="col-md-1"><input type="hidden" name="purpose_id[]" value="'+purpose_id+'"/>'+purpose_text+'</td>'
     + '<td class="col-md-1"><input type="hidden" name="purpose_desc[]" value="'+purpose_desc+'"/>'+purpose_desc+'</td>'
     + '<td class="col-md-1"><input type="hidden" name="travel_cost[]" value="'+travel_cost+'"/>'+travel_cost+'</td>'
     + '<td class="col-md-1"><input type="hidden" name="entertain_cost[]" value="'+entertain_cost+'"/>'+entertain_cost+'</td>'
     + '<td class="col-md-1"><input type="hidden" name="entertain_detail[]" value="'+entertain_detail+'"/>'+entertain_detail+'</td>'
     + '</tr>';
	 $("#ltineraryTable tbody:last").append(rowTem);
	 $('#addNewLineModal').modal("hide");
}
function showItemOperate(obj){
	thisObj=$(obj);
	thisObj.addClass('prepareDelTr');
	thisObj.css({
		"background-color":"rgba(249,202,206,1)"
	});
	$('#itemDelBut').attr('disabled',false);
}
function delLineItem(){
	$('.prepareDelTr').remove();
	var remainTrNum = $('#ltineraryTable tbody tr').length;
	if(remainTrNum==0){
		$('#itemDelBut').attr('disabled',true);
	}
}
