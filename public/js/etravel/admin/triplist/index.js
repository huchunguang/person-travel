var Expand=false;
$("#CompanySiteExpand").click(function () {
    try {
        Expand = !Expand;
        if (Expand) {
            $("#BalanceDetailsDiv").css('height', 'auto');
            $("#CompanySiteExpand").removeClass('glyphicon-plus').addClass('glyphicon-minus');
        } else {
            $("#BalanceDetailsDiv").css('height', '260px');
            $("#CompanySiteExpand").removeClass('glyphicon-minus').addClass('glyphicon-plus');
        }
    } catch (err) {
        alert(err.message);
    }
});
$('#country_id').change(function(){
	$('#site_id').empty();
	$('#company_id').empty();
	$('#department_id').empty();
	getSiteOptByCountry($(this).val());
});
$('#site_id').change(function(){
	var siteId=$(this).val();
	$('#company_id').empty();
	$('#department_id').empty();
	getCompanyBySiteId(siteId);
});
$('#company_id').change(function(){
	var companyId=$(this).val();
	var siteId=$('#site_id option:selected').val();
	$('#department_id').empty();
	getDepBySiteCompany(siteId,companyId);
});
$('#trip_type').change(function(event){
	var trip_type = parseInt($(this).val());
	if(trip_type==1){
		$('<option value="partly-approved">partly-approved</option>').insertAfter('#status option:last');
	}else if(trip_type==2){
		var lastVal=$('#status option:last').val();
		if(lastVal=='partly-approved'){
			$('#status option:last').empty();
		}
	}
		
});

//Search
$("#txtEmployeeSearch").on('input', function () {
    SearchRecord('adminTripListTbl', 2, this.value, 0);
});
$("#txtStartDateSearch").on('input', function () {
    SearchRecord('adminTripListTbl', 4, this.value, 0);
});
$("#txtEndDateSearch").on('input', function () {
    SearchRecord('adminTripListTbl', 5, this.value, 0);
});
//Export 
$('#btnExport').on('click',function(){
//	var formData=new FormData(document.getElementById("tripListFrom"));
//	var startDate=$('#txtStartDateSearch').val();
//	var endDate=$('#txtEndDateSearch').val();
//	if(startDate){
//		formData.append('daterange_from', startDate);
//	}
//	if(endDate){
//		formData.append('daterange_to', endDate);
//	}
	var formData=$('#tripListFrom').serialize();
//	$.get("/excel/export", formData );
	var url = "/excel/export?"+formData;
	document.getElementById('DownloadExcelFile').src = url;

});