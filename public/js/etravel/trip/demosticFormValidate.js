$('#department_id').on('change',function(){
	var department_id=$(this).val();
//	alert(department_id);
	$.get('/etravel/depApprover?department_id='+department_id,function(data){
		var depApproverOptions='';
		$.each(data,function(ind,val){
			depApproverOptions+='<option value="'+val.UserID+'">'+val.LastName+' '+val.FirstName+'</option>';
		});
			$('#department_approver').empty().append(depApproverOptions);
	});
	
});

//Form validation
	var FormValidation = function () {

	    // basic validation
	    var handleValidation1 = function() {
	        // for more info visit the official plugin documentation: 
	            // http://docs.jquery.com/Plugins/Validation

	            var form1 = $('#demosticTripCreate');
	            var error1 = $('.alert-danger', form1);
	            var success1 = $('.alert-success', form1);

	            form1.validate({
	                errorElement: 'span', //default input error message container
	                errorClass: 'help-block help-block-error', // default input error message class
//	                focusInvalid: false, // do not focus the last invalid input
	                ignore: "",  // validate all fields including form hidden input
	                messages: {
	                    select_multi: {
	                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
	                        minlength: jQuery.validator.format("At least {0} items must be selected")
	                    }
	                },
	                rules: {
	                	daterange_from: {
	                        required: true
	                    },
	                    daterange_to: {
	                        required: true
	                    },
//	                    extra_comment: {
//	                        required: true
//	                    },
//	                    project_code: {
//	                    	required: true
//	                    },
	                    department_approver: {
	                    	required: true
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
	    
	    var handleValidation2 = function() {
	        // for more info visit the official plugin documentation: 
	            // http://docs.jquery.com/Plugins/Validation

	            var form1 = $('#demosticItineraryCreate');
	            var error1 = $('.alert-danger', form1);
	            var success1 = $('.alert-success', form1);

	            form1.validate({
	                errorElement: 'span', //default input error message container
	                errorClass: 'help-block help-block-error', // default input error message class
//	                focusInvalid: false, // do not focus the last invalid input
	                ignore: "",  // validate all fields including form hidden input
	                messages: {
	                    select_multi: {
	                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
	                        minlength: jQuery.validator.format("At least {0} items must be selected")
	                    }
	                },
	                rules: {
	                	
	                    "datetime_date[]": {
	                    	required: true
	                    },
	                    "location[]": {
	                    	required: true,
	                    	
	                    },
	                    "customer_name[]": {
	                    	required: true,
	                    	
	                    },
	                    "contact_name[]": {
	                    	required: true,
	                    	
	                    },
	                    "purpose_id[]": {
	                    	required: true,
	                    	
	                    },
	                    "location[]": {
	                    	required: true,
	                    	
	                    },
	                    "travel_cost[]": {
	                    	number:true
	                    },
	                    "entertain_cost[]": {
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
	            handleValidation2();
	        }

	    };

	}();

	jQuery(document).ready(function() {
	    FormValidation.init();
	});	