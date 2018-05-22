	function initializeDateSettings(){
		var nowTime = '<%=DateTime.Now.ToString("HH:mm")%>';
		 $(".time-input").val(nowTime).timepicker('setTime', nowTime);
	
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

var addnewLineNum = 0;
function addNewLine(){
	var datetime_date=$('.modal input[name="datetime_date[]"]').val();
	var datetime_time=$('.modal input[name="datetime_time[]"]').val();
	var location=$('.modal input[name="location[]"]').val();
	var customer_name=$('.modal input[name="customer_name[]"]').val();
	var contact_name=$('.modal input[name="contact_name[]"]').val();
	var purpose_id=$('.modal #purpose_id').val();
	var purpose_text=$('.modal #purpose_id').find('option:selected').text();
	var purpose_desc=$('.modal #purpose_desc').val();
	var travel_cost=$('.modal input[name="travel_cost[]"]').val();
	var entertain_cost=$('.modal input[name="entertain_cost[]"]').val();
	var entertain_detail=$('.modal input[name="entertain_detail[]"]').val();
	addnewLineNum++;

	 var rowTem = '<tr id="tr_' + addnewLineNum + '" onclick="showItemOperate(this)" data-id="'+ addnewLineNum +'">'
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
	 var editId=$('.modal input[name="tr_id"]').val();
	 if(editId){
		 rowTem = '<td class="col-md-1"><input type="hidden" name="datetime_date[]" value="'+datetime_date+'"/>'+datetime_date+'</td>'
	     + '<td class="col-md-2"><input type="hidden" name="datetime_time[]" value="'+datetime_time+'"/>'+datetime_time+'</td>'
	     + '<td class="col-md-1"><input type="hidden" name="location[]" value="'+location+'"/>'+location+'</td>'
	     + '<td class="col-md-1"><input type="hidden" name="customer_name[]" value="'+customer_name+'"/>'+customer_name+'</td>'
	     + '<td class="col-md-1"><input type="hidden" name="contact_name[]" value="'+contact_name+'"/>'+contact_name+'</td>'
	     + '<td class="col-md-1"><input type="hidden" name="purpose_id[]" value="'+purpose_id+'"/>'+purpose_text+'</td>'
	     + '<td class="col-md-1"><input type="hidden" name="purpose_desc[]" value="'+purpose_desc+'"/>'+purpose_desc+'</td>'
	     + '<td class="col-md-1"><input type="hidden" name="travel_cost[]" value="'+travel_cost+'"/>'+travel_cost+'</td>'
	     + '<td class="col-md-1"><input type="hidden" name="entertain_cost[]" value="'+entertain_cost+'"/>'+entertain_cost+'</td>'
	     + '<td class="col-md-1"><input type="hidden" name="entertain_detail[]" value="'+entertain_detail+'"/>'+entertain_detail+'</td>';
		 
		 	$tr = $('#tr_'+editId).html(rowTem);
		 	
	 }else{
		 $("#ltineraryTable tbody:last").append(rowTem);
	 }
	 $('#addNewLineModal').modal("hide");
}

$('#addNewLineModal').on('hide.bs.modal', function () {
	$('.modal input').val('');
	$('.modal #purpose_desc').val('');
});
function editNewLine()
{
	var id=$('.prepareDelTr').data('id');
	var datetime_date=$('#tr_'+id+' input[name="datetime_date[]"]').val();
	var datetime_time=$('#tr_'+id+' input[name="datetime_time[]"]').val();
	var location=$('#tr_'+id+' input[name="location[]"]').val();
	var customer_name=$('#tr_'+id+' input[name="customer_name[]"]').val();
	var contact_name=$('#tr_'+id+' input[name="contact_name[]"]').val();
	var purpose_id=$('#tr_'+id+' input[name="purpose_id[]"]').val();
	var purpose_desc=$('#tr_'+id+' input[name="purpose_desc[]"]').val();
	var travel_cost=$('#tr_'+id+' input[name="travel_cost[]"]').val();
	var entertain_cost=$('#tr_'+id+' input[name="entertain_cost[]"]').val();
	var entertain_detail=$('#tr_'+id+' input[name="entertain_detail[]"]').val();
	
	$('.modal input[name="datetime_date[]"]').val(datetime_date);
	$('.modal input[name="datetime_time[]"]').val(datetime_time);
	$('.modal input[name="location[]"]').val(location);
	$('.modal input[name="customer_name[]"]').val(customer_name);
	$('.modal input[name="contact_name[]"]').val(contact_name);
	$('.modal #purpose_desc option[value="'+purpose_id+'"]').attr('selected',true);
	$('.modal input[name="travel_cost[]"]').val(travel_cost);
	$('.modal input[name="entertain_cost[]"]').val(entertain_cost);
	$('.modal input[name="entertain_detail[]"]').val(entertain_detail);
	$('.modal input[name="tr_id"]').val(id);
	//
	$('#addNewLineModal').modal('show');
}
function showItemOperate(obj){
	thisObj=$(obj);
	thisObj.toggleClass('prepareDelTr').toggleClass('warning');
	$('#itemDelBut').attr('disabled',false);
	$('#itemEditBut').attr('disabled',false);
}
function delLineItem(){
	$('.prepareDelTr').remove();
	var remainTrNum = $('#ltineraryTable tbody tr').length;
	if(remainTrNum==0){
		$('#itemDelBut').attr('disabled',true);
		$('#itemEditBut').attr('disabled',true);
	}
	

	
}
