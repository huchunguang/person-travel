function announcementDel(id){
	$.ajax({
		'type':'DELETE',
		'url':'/etravel/announcement/'+id,
		'data':'',
		'dataType':'json',
		'success':function(data){
			window.location.reload();
		},
		'error':function(data){
			
		}
	});
}



$('#countrySel').change(function(){
	var siteStr="<option disabled selected value></option>";
	var countryId = $(this).val();
	$.get('/country-sites/'+countryId,function(siteList){
		for(var i=0;i<siteList.length;i++){
			siteStr+="<option value="+siteList[i].SiteID+">"+siteList[i].Site+"</option>";
		}
		if(siteStr!=""){
			$('#siteSel').empty().append(siteStr);
		}
		
	});
});
$('#siteSel').change(function(){
	var siteId=$(this).val();
	var country=$('#countrySel').val();
	window.location.href='/etravel/announcement?site_id='+siteId+'&country='+country;
});