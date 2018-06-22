jQuery(document).ready(function() {
	$('input[name="start_date"]').prop('disabled',true);
	$('input[name="end_date"]').prop('disabled',true);
	$('#delegate_id').prop('disabled',true);
	$('input[name="EnableDelegation"]').iCheck('disable');
	$('input').iCheck({checkboxClass: 'icheckbox_minimal-green'});
	$(".leave-date").prop('disabled',true);
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


$('#country_id').change(function(){
	$('#site_id').empty();
	siteListWithCountry($(this).val());
});


$('#site_id').change(function(){
	var siteId=$(this).val();
	$('#manager_id').prop('disabled',false).empty();
	getUserBySiteId(siteId);
});
function enableDelegationSave() {
    $("#delegateSave").prop('disabled', false);
}
$("#delegateEdit").on('click', function () {
    
    enableDelegationControl(true);
});
function enableDelegationControl(df){
	$(".leave-date").prop('disabled',!df);
    $("#delegate_id").prop('disabled', !df);
    $('input[name="EnableDelegation"]').iCheck('enable');
}
$(".leave-date").change(function () {
    enableDelegationSave();
});
$("#delegate_id").change(function () {
    enableDelegationSave();
});
$('input[name="EnableDelegation"]').on('ifClicked',function(){
	enableDelegationSave();
});
$('#delegateSave').on('click',function(){
	submitFormDelegation();
});
function submitFormDelegation() {
    ViewProgressBar();
    $("#FormDelegation").submit();
}