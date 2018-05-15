$('a .btn-steel').on('click',function(){
	$('a .btn-steel').removeClass('active');
	$(this).addClass('active');
});


//Search
$("#txtDateSearch").on('input', function () {
    SearchRecord('tblTravelList', 1, this.value, 0);
});
$("#txtCostCenterSearch").on('input', function () {
    SearchRecord('tblTravelList', 3, this.value, 0);
});
$("#txtApproverSearch").on('input', function () {
    SearchRecord('tblTravelList', 5, this.value, 0);
});