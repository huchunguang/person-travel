$('#destinationSel').on('change',function(){
	var countryIds=[];
	$('#destinationSel option:selected').map(function(){
		var regionId=$(this).data('region');
		countryIds.push(regionId);
	});
	if(countryIds.length!=0){
		if($.inArray('',countryIds)>=0||$.inArray(1,countryIds)>=0||$.inArray(2,countryIds)>=0||$.inArray(3,countryIds)>=0||$.inArray(4,countryIds)>=0||$.inArray(5,countryIds)>=0){
			$.get('/etravel/approver',function(data){
				var overseasOptions='';
				$.each(data,function(ind,val){
					overseasOptions+='<option value="'+val.UserID+'">'+val.FirstName+'</option>';
				});
				if(overseasOptions!=''){
					$('#overseas_approver').attr('disabled',false).empty().append(overseasOptions);
				}
				
			});
		}else{
			$('#overseas_approver').attr('disabled',true);
		}
	}else{
		$('#overseas_approver').attr('disabled',true);
	}
	
});
//to check whether sent a notify to the affairs
$(':radio[name="is_sent_affairs"]').on('ifChecked',function(event){
	var isChecked=parseInt($(this).val());
	localStorage.setItem('name','Item');
	$('#cc').prop('disabled',!Boolean(isChecked));
});

//Form validation
var FormValidation = function () {

    // basic validation
    var handleValidation1 = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#nationTripCreate');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
//                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }
                },
                rules: {
                	"destination[]":{
                		required:true,
                		minlength:1,
                		maxlength:3
                	},
                	daterange_from: {
                        required: true
                    },
//                    extra_comment: {
//                        required: true
//                    },
                    project_code: {
                    	required: true
                    },
                    "employee_annual_budget[]": {
                    	number:true
                    },
                    "employee_ytd_expenses[]": {
                    	number:true
                    },
                    "available_amount[]": {
                    	number:true
                    },
                    "required_amount[]": {
                    	number:true
                    },
                    
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var cont = $(element).parent('.input-group');
                    if (cont.size() > 0) {
                        cont.after(error);
                    } else {
                        element.after(error);
                    }
                },

                highlight: function (element) { // hightlight error inputs
                    $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label.closest('.form-group').removeClass('has-error'); // set success class to the control group
                },
                submitHandler: function (form) {
                    success1.show();
                    error1.hide();
                    form.submit();
                }

            });


    }

    
    var flightValidate=function(){

        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#flightCreate');
            var error1 = $('#flightCreate .alert-danger', form1);
            var success1 = $('#flightCreate .alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
//                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }
                },
                rules: {
                	"flight_date[]":{
                		required:true,
                		
                	},
                	"flight_from[]": {
                        required: true
                    },
                    "flight_to[]": {
                        required: true
                    },
                    "etd_time[]": {
                    	required: true
                    },
                    "eta_time[][]": {
                    	required:true
                    },
                    "employee_ytd_expenses[]": {
                    	required:true
                    },
                    "available_amount[]": {
                    	required:true
                    },
                    
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var cont = $(element).parent('.input-group');
                    if (cont.size() > 0) {
                        cont.after(error);
                    } else {
                        element.after(error);
                    }
                },

                highlight: function (element) { // hightlight error inputs
                    $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label.closest('.form-group').removeClass('has-error'); // set success class to the control group
                },
                submitHandler: function (form) {
                    success1.show();
                    error1.hide();
                    form.submit();
                }

            });


    
    }
    
    
    
    return {
        //main function to initiate the module
        init: function () {
            handleValidation1();
            flightValidate();
        }

    };

}();

jQuery(document).ready(function() {
	FormValidation.init();
	
	function formatUserList(userList){
		var markup = "<div class='select2-result-repository clearfix'>" +
	      "<div class='select2-result-repository__title'>"+userList.LastName +userList.FirstName+"</div>";

	  if (userList.Email) {
	    markup += "<div class='select2-result-repository__description'>"+userList.Email+"</div>";
	  }

	  markup += "</div>";

	  return markup;
	} 
	function formatUserSelection (user) {
		  return user.text;
	}
	// Select2 Search
	$('.js-data-example-ajax').select2({
		ajax : {
			url : '/user/search',
			dataType : 'json',
			delay : 250,
			data: function (params) {
				
			      return {
			        q: params.term, // search term
			      };
			    },
		    processResults: function (data, params) {
			      // parse the results into the format expected by Select2
			      // since we are using custom formatting functions we do not
					// need to
			      // alter the remote JSON data, except to indicate that
					// infinite
			      // scrolling can be used
		    	  params.page = params.page || 1;
			      return {
			        results: data.data,
			        pagination: {
			            more: (params.page * 30) < data.total
			          }
			      };
			    },
			    cache: false
			 },
		cache : false,
		placeholder: 'Search user...',
		escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		minimumInputLength : 1,
		templateResult: formatUserList,
		templateSelection: formatUserSelection,

		});
});
$('.airlineSel').on('change',function(){
	
	var selVal=$(this).val();
//	alert(selVal);
	if(selVal == '1'){
		$('#addNewFlight').modal('hide');
		$('#airlineList').modal('show');
		$('#checkAirlineBtn').on('click',function(){
			var airlineCode = $("#aircodeSel").find('option:selected').data('code');
//			alert(airlineCode);
			$('.modal input[name="air_code[]"]').val(airlineCode);
			$('#airlineList').modal('hide');
			$('#addNewFlight').modal('show');
		});
		
	}else{
		$('.modal input[name="air_code[]"]').val('');
	}
	
});
$('.modal input[name="hotel_name[]"]').on('click',function(){
	$('#hotelList').modal('show');
});
//New Accommodation
var addnewLineNum = 0;
function addNewAccommodation(){
	var hotel_id=$('.modal input[name="hotel_id[]"]').val();
	var hotel_name=$('.modal input[name="hotel_name[]"]').val();
	var rate=$('.modal #rate').val();
	var checkin_date=$('.modal input[name="checkin_date[]"]').val();
	var checkout_date=$('.modal input[name="checkout_date[]"]').val();
	if(hotel_name=='' || checkin_date=='' || checkout_date==''){
		return false;
	}	
	addnewLineNum++;

	 var rowTem = '<tr id="tr_' + addnewLineNum + '" onclick="showHotelItemOperate(this)" data-id="'+ addnewLineNum +'">'
     + '<td><input type="hidden" name="hotel_id[]" value="'+hotel_id+'"/><input type="hidden" name="hotel_name[]" value="'+hotel_name+'"/>'+hotel_name+'</td>'
     + '<td><input type="hidden" name="checkin_date[]" value="'+checkin_date+'"/>'+checkin_date+'</td>'
     + '<td><input type="hidden" name="checkout_date[]" value="'+checkout_date+'"/>'+checkout_date+'</td>'
     + '<td><input type="hidden" name="rate[]" value="'+rate+'"/>'+rate+'</td>'
     + '</tr>';
	 var editId=$('.modal input[name="tr_id"]').val();
	 if(editId){
		 var accomodate_id=$('#tr_'+editId+' input[name="accomodate_id[]"]').val();
		 rowTem = '<td><input type="hidden" name="hotel_id[]" value="'+hotel_id+'"/><input type="hidden" name="accomodate_id[]"value="'+accomodate_id+'" /><input type="hidden" name="hotel_name[]" value="'+hotel_name+'"/>'+hotel_name+'</td>'
	     + '<td><input type="hidden" name="checkin_date[]" value="'+checkin_date+'"/>'+checkin_date+'</td>'
	     + '<td><input type="hidden" name="checkout_date[]" value="'+checkout_date+'"/>'+checkout_date+'</td>'
	     + '<td><input type="hidden" name="rate[]" value="'+rate+'"/>'+rate+'</td>';
		 
		 	$tr = $('#tr_'+editId).html(rowTem);
		 	
	 }else{
		 $("#hotelItinerary tbody:last").append(rowTem);
	 }
	 $('#addNewAccommodation').modal("hide");
}

$('#addNewAccommodation').on('hide.bs.modal', function () {
	$('.modal input').val('');
});
function editHotel()
{
	
	var id=$('.prepareDelTr').data('id');
	var hotel_id=$('#tr_'+id+' input[name="hotel_id[]"]').val();
	var hotel_name=$('#tr_'+id+' input[name="hotel_name[]"]').val();
	var checkin_date=$('#tr_'+id+' input[name="checkin_date[]"]').val();
	var checkout_date=$('#tr_'+id+' input[name="checkout_date[]"]').val();
	var rate=$('#tr_'+id+' input[name="rate[]"]').val();
	
	$('.modal input[name="hotel_id[]"]').val(hotel_id);
	$('.modal input[name="hotel_name[]"]').val(hotel_name);
	$('.modal input[name="checkin_date[]"]').val(checkin_date);
	$('.modal input[name="checkout_date[]"]').val(checkout_date);
//	$('.modal input[name="rate[]"]').val(rate);
	
	$('.modal input[name="tr_id"]').val(id);
	//
	$('#addNewAccommodation').modal('show');
}
function showHotelItemOperate(obj){
	thisObj=$(obj);
//	$('#hotelItinerary tbody tr').;
	thisObj.siblings().removeClass('prepareDelTr').removeClass('warning');
	thisObj.toggleClass('prepareDelTr').toggleClass('warning');
	$('#itemDelBut').prop('disabled',!$('.prepareDelTr').length);
	if($('.prepareDelTr').length===1){
		$('#itemEditBut').prop('disabled',false);
	}else{
		$('#itemEditBut').prop('disabled',true);
	}
}
function delHotelItem(){
	$('.prepareDelTr').remove();
	var remainTrNum = $('#hotelItinerary tbody tr').length;
	if(remainTrNum==0){
		$('#itemDelBut').attr('disabled',true);
		$('#itemEditBut').attr('disabled',true);
	}
	

	
}



//New Flight

var addFlightNum = 0;
function addNewFlight(){
	var flight_date=$('.modal input[name="flight_date[]"]').val();
	var flight_from=$('.modal input[name="flight_from[]"]').val();
	var air_code=$('.modal input[name="air_code[]"]').val();
	var flight_to=$('.modal input[name="flight_to[]"]').val();
	var etd_time=$('.modal input[name="etd_time[]"]').val();
	var eta_time=$('.modal input[name="eta_time[]"]').val();
	var airline_or_train=$('.modal #airline_or_train').val();
	var airline_or_train_text=$('.modal #airline_or_train').find('option:selected').text();
	var class_flight=$('.modal #classFlightSel option:selected').val();
//	alert(class_flight)
	var is_visa=$('.modal #is_visa').val();
	var is_visa_text=$('.modal #is_visa').find('option:selected').text();
	if(flight_date=='' || flight_from=='' || flight_to==''){
		return false;
	}
	addFlightNum++;

	 var rowTem = '<tr id="tr_' + addFlightNum + '" onclick="showFlightItemOperate(this)" data-id="'+ addFlightNum +'">'
     + '<td><input type="hidden" name="air_code[]" value="'+air_code+'"/><input type="hidden" name="flight_date[]" value="'+flight_date+'"/>'+flight_date+'</td>'
     + '<td><input type="hidden" name="flight_from[]" value="'+flight_from+'"/>'+flight_from+'</td>'
     + '<td><input type="hidden" name="flight_to[]" value="'+flight_to+'"/>'+flight_to+'</td>'
     + '<td><input type="hidden" name="airline_or_train[]" value="'+airline_or_train+'"/>'+airline_or_train_text+'  '+air_code+'</td>'
     + '<td><input type="hidden" name="etd_time[]" value="'+etd_time+'"/>'+etd_time+'</td>'
     + '<td><input type="hidden" name="eta_time[]" value="'+eta_time+'"/>'+eta_time+'</td>'
     + '<td><input type="hidden" name="class_flight[]" value="'+class_flight+'"/>'+class_flight+'</td>'
     + '<td><input type="hidden" name="is_visa[]" value="'+is_visa+'"/>'+is_visa_text+'</td>'
     + '</tr>';
	 var editId=$('.modal input[name="tr_id"]').val();
	 if(editId){
		 var flight_id=$('#tr_'+editId+' input[name="flight_id[]"]').val();
		 rowTem = '<td><input type="hidden" name="flight_id[]" value="'+flight_id+'"/><input type="hidden" name="air_code[]" value="'+air_code+'"/><input type="hidden" name="flight_date[]" value="'+flight_date+'"/>'+flight_date+'</td>'
	     + '<td><input type="hidden" name="flight_from[]" value="'+flight_from+'"/>'+flight_from+'</td>'
	     + '<td><input type="hidden" name="flight_to[]" value="'+flight_to+'"/>'+flight_to+'</td>'
	     + '<td><input type="hidden" name="airline_or_train[]" value="'+airline_or_train+'"/>'+airline_or_train_text+'  '+air_code+'</td>'
	     + '<td><input type="hidden" name="etd_time[]" value="'+etd_time+'"/>'+etd_time+'</td>'
	     + '<td><input type="hidden" name="eta_time[]" value="'+eta_time+'"/>'+eta_time+'</td>'
	     + '<td><input type="hidden" name="class_flight[]" value="'+class_flight+'"/>'+class_flight+'</td>'
	     + '<td><input type="hidden" name="is_visa[]" value="'+is_visa+'"/>'+is_visa_text+'</td>';
		 
		 	$tr = $('#tr_'+editId).html(rowTem);
		 	
	 }else{
		 $("#flightLtinerary tbody:last").append(rowTem);
	 }
	 $('.modal #modalFlag').val('1');
//	 $('#airline_or_train option:selected').val('')
	 $('#addNewFlight').modal("hide");
}

$('#addNewFlight').on('hide.bs.modal', function () {
//	var isAirline = $('#airline_or_train option:selected').val();
//	if(isAirline!='1' && isAirline!='0'){
//		$('.modal input').val('');
//	}
	var flag = $('.modal #modalFlag').val();
	if(flag){
		$('.modal input').val('');
	}
});
function editFlight()
{
	var id=$('.prepareDelTr').data('id');
	var air_code=$('#tr_'+id+' input[name="air_code[]"]').val();
	var flight_id=$('#tr_'+id+' input[name="flight_id[]"]').val();
	var flight_date=$('#tr_'+id+' input[name="flight_date[]"]').val();
	var flight_from=$('#tr_'+id+' input[name="flight_from[]"]').val();
	var flight_to=$('#tr_'+id+' input[name="flight_to[]"]').val();
	var etd_time=$('#tr_'+id+' input[name="etd_time[]"]').val();
	var eta_time=$('#tr_'+id+' input[name="eta_time[]"]').val();
	var class_flight=$('#tr_'+id+' input[name="class_flight[]"]').val();
	var airline_or_train=$('#tr_'+id+' input[name="airline_or_train[]"]').val();
	var is_visa=$('#tr_'+id+' input[name="is_visa[]"]').val();
	
	$('.modal input[name="air_code[]"]').val(air_code);
	$('.modal input[name="flight_id[]"]').val(flight_id);
	$('.modal input[name="flight_date[]"]').val(flight_date);
	$('.modal input[name="flight_from[]"]').val(flight_from);
	$('.modal input[name="flight_to[]"]').val(flight_to);
	$('.modal input[name="etd_time[]"]').val(etd_time);
	$('.modal input[name="eta_time[]"]').val(eta_time);
//	$('.modal input[name="class_flight[]"]').val(class_flight);
	$('.modal #classFlightSel option[value="'+class_flight+'"]').attr("select","selected");
	$('.modal #airline_or_train option[value="'+airline_or_train+'"]').attr("select","selected");
	$('.modal #is_visa option[value="'+is_visa+'"]').attr("select","selected");
	
	$('.modal input[name="tr_id"]').val(id);
	//
	$('#addNewFlight').modal('show');
}
function showFlightItemOperate(obj){
	thisObj=$(obj);
	thisObj.siblings().removeClass('prepareDelTr').removeClass('warning');
	thisObj.toggleClass('prepareDelTr').toggleClass('warning');
	$('#flightDelBut').prop('disabled',!$('.prepareDelTr').length);
	if($('.prepareDelTr').length===1){
		$('#flightEditBut').prop('disabled',false);
	}else{
		$('#flightEditBut').prop('disabled',true);
	}
}
function delFlightItem(){
	$('.prepareDelTr').remove();
	var remainTrNum = $('#flightLtinerary tbody tr').length;
	if(remainTrNum==0){
		$('#flightDelBut').attr('disabled',true);
		$('#flightEditBut').attr('disabled',true);
	}
	

	
}



