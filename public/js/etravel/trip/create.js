$('#destinationSel').on('change',function(){
	var countryId=$('#destinationSel option:selected').map(function(){
		var regionId=$(this).data('region');
			if(regionId!='6'){
				//此处配置亚太地区ID
				return $(this).val();
			}
		}).get();
	if(countryId){
		$.get('/etravel/approver?countryId='+countryId,function(data){
			var overseasOptions='';
			$.each(data,function(ind,val){
				overseasOptions+='<option value="'+val.UserID+'">'+val.FirstName+'</option>';
			});
			if(overseasOptions!=''){
				$('#overseas_approver').attr('disabled',false).empty().append(overseasOptions);
			}
			
		});
//		alert(countryId);
	}else{
		$overseas_approver.attr('disabled',true);
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
                    extra_comment: {
                        required: true
                    },
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

    return {
        //main function to initiate the module
        init: function () {
            handleValidation1();

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
	if(selVal == '1'){
		var trInd=$(this).closest("tr").index();
		$('#airlineList').modal('show');
		$('#checkAirlineBtn').on('click',function(){
			var airlineCode = $("#aircodeSel").find('option:selected').data('code');
//			alert(airlineCode);
			$('#flightLtinerary tbody>tr').eq(trInd).find('td').eq(3).html(airlineCode);
			$('#airlineList').modal('hide');
		});
		
	}
	
});








