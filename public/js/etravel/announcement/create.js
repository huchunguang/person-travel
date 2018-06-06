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
		var companyStr="<option disabled selected value></option>";
		var siteId = $(this).val();
		$.get('/site-companies/'+siteId,function(companyList){
			for(var i=0;i<companyList.length;i++){
				companyStr+="<option value="+companyList[i].CompanyID+">"+companyList[i].CompanyName+"</option>";
			}
			if(companyStr!=""){
				$('#companySel').empty().append(companyStr);
			}
			
		});
	});
	
	var textarea = document.getElementById('announcement');
    // editor generator 
    var editor = new wangEditor(textarea);
    editor.create();
    $('form').submit(function(e){
    		e.preventDefault();
    		var formData=$(this).serialize();
    		var announcement=$.trim(editor.$txt.html());//trim blank space
    		formData+='&announcement='+announcement;
    		var action=$(this).attr('action');
    		$.post(action,formData,function(resData){
    			console.log(resData);
    			if(resData.res_info.code=='100000'){
    				window.location.href='/etravel/announcement';
    			}else{
    				
    			}
        	});
    });