/* 
 * Copyright(C)2016 A6178879
 *
 * All rights reserved Arkema Pte. Ltd.(international.ic.corp.local)
 * Website Developed by: Eng'r Nolan F. Sunico
 * Date Created: Feb 17, 2016
 * Time Created: 11:27:49 AM
 * Module: function
 * Project: Arkema-Eleave
 */
/* Document Jquery  */
var submitcount = 0;
$(document).ready(function(){/* jQuery toggle layout */
   $("#InputIcon").change(function(e){
      $("#InputSelectedicon").removeClass();
      $("#InputSelectedicon").addClass(e.val);
   });
   $('#LeaveLock').bind('contextmenu', function(e) {
       return false;
   }); 
   $('.table-clickable').on('click', '.clickable-row', function(event) {
         $(this).addClass('active').siblings().removeClass('active');
   });
});
function InitializeLeaveDateInput() {

   $(".leave-date").jqxDateTimeInput({
      width: 'auto',
      height: '28px',
      formatString: 'MM/dd/yyyy',
      maxDate: new Date(new Date().getFullYear() + 1, 11, 31),
      disabled: true
   });
}

function InitCLeaveDateInput() {
   $(".cleave-date").jqxDateTimeInput({
      width: 'auto',
      height: '28px',
      formatString: 'MM/dd/yyyy',
      maxDate: new Date(),
      disabled: true
   });
}

var getLocalization = function () {
    var localizationobj = {};
    localizationobj.pagerGoToPageString = "Go to Page:";
    localizationobj.pagerShowRowsString = "Show Row:";
    localizationobj.pagerRangeString = " of ";
    localizationobj.pagerNextButtonString = "next";
    localizationobj.pagerFirstButtonString = "first";
    localizationobj.pagerLastButtonString = "last";
    localizationobj.pagerPreviousButtonString = "Previous";
    localizationobj.sortAscendingString = "Sort Ascending";
    localizationobj.sortDescendingString = "Sort Descending";
    localizationobj.sortRemoveString = "Remove Sort";
    localizationobj.firstDay = 1;
    localizationobj.percentSymbol = "%";
    localizationobj.currencySymbol = " ";
    localizationobj.currencySymbolPosition = "before";
    localizationobj.decimalSeparator = ".";
    localizationobj.thousandsSeparator = ",";
    var days = {
	    // full day names
	    names: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
	    // abbreviated day names
	    namesAbbr: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
	    // shortest day names
	    namesShort: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]
    };
    localizationobj.days = days;
    var months = {
	    // full month names (13 months for lunar calendards -- 13th month should be "" if not lunar)
	    names: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", ""],
	    // abbreviated month names
	    namesAbbr: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", ""]
    };
    var patterns = {
	    d: "MM/dd/yyyy",
	    D: "dddd, d. MMMM yyyy",
	    t: "HH:mm",
	    T: "HH:mm:ss",
	    f: "dddd, d. MMMM yyyy HH:mm",
	    F: "dddd, d. MMMM yyyy HH:mm:ss",
	    M: "dd MMMM",
	    Y: "MMMM yyyy"
    };
    localizationobj.patterns = patterns;
    localizationobj.months = months;
    return localizationobj;
};
/**
 * This will Disable Developer Toole for Security reasons.
 * @returns {undefined}
 */
function DisableDeveloperTools(){
   $(document).keydown(function (event) {
      alert(event.keyCode);
      if (event.keyCode == 123) {
         return false;
      }
      else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
         return false;  //Prevent from ctrl+shift+i
      }
   });
}
function IntegerToBoolean(intvalue){
    var ret=0;
    if(intvalue==1){
       ret=true; 
    }else{
       ret=false;
    }
    return ret;
}
function BooleanToInteger(BoolFlag){
    var ret=0;
    if(BoolFlag){
       ret=1; 
    }else{
       ret=0;
    }
    return ret;
}
/**
 * @description This Function USes to Search Table for Data
 * @param {type} tblName
 * @param {type} SearchColumnIndex
 * @param {type} SearchValue
 * @param {type} ColumnIndexCounter
 * @returns {undefined}
 */
 function SearchRecord(tblName,SearchColumnIndex,SearchValue,ColumnIndexCounter){
 try{
      var SearachLen=SearchValue.length;
      var CurrentSearch="";
      var EmpList="";
      var TotalEmp=$('#'+tblName+'>tbody>tr').length;
      var TotalHidden=0;
      var counter=0;
      $('#'+tblName+'>tbody>tr').removeClass('active');
      $('#'+tblName+'>tbody>tr').each(function (i, row) {
         CurrentSearch=row.cells[SearchColumnIndex].innerHTML;
         var mCell=row.cells[ColumnIndexCounter];
         var $mCell=$(mCell);
         CurrentSearch=CurrentSearch.toLowerCase();
         SearchValue=SearchValue.toLowerCase();
         $(this).show();
         if(CurrentSearch.indexOf(SearchValue)<0){
            $(this).hide();
         }else{
            counter=parseInt(counter)+1;
            $mCell.html(counter);
         }
      });
   }catch(err){
      //
   }
 } 
function InitializeProfileImports(){
    var btnUpload=$('#btnImportFile');
    var status=$('#UploadProgress');
    var msg="";
    new AjaxUpload(btnUpload, {
        action: 'upload-import-file.php',
        data:{
           //
        },
        name: 'fileUpload',
        autoSubmit: true,
        disabled: true,
        onSubmit: function(file,ext) {
            var compid=$("#CompanyDropdownList").select2('val');
            var sid=$("#SiteList").select2('val');
            $("#ImportStatus").removeClass();
            if(sid<=0){
               msg="Select Site before you can proceed!";
               MessageBoxAlert(msg,BootstrapDialog.TYPE_WARNING);
               $("#ImportStatus").html('No Site Selected');
               $("#ImportStatus").addClass('alert alert-warning');
               return false; 
            }
            if(compid<=0){
               msg="Select Company before you can proceed!";
               MessageBoxAlert(msg,BootstrapDialog.TYPE_WARNING);
               $("#ImportStatus").html('No Company Selected');
               $("#ImportStatus").addClass('alert alert-warning');
               return false; 
            }
            if(ext=='xlsx' || ext=='xlx'){
               status.attr('src','../images/wait_progress.gif');
               $("#ImportStatus").html('Upload Successful');
               $("#ImportStatus").addClass('alert alert-success');
               return true;
            }else{
               msg='This File "'+file+'" is not allowed to upload.\n';
               msg+="<b>File Type Currently Supported:</b> Microsoft Excel(xlsx,xlx)";
               MessageBoxAlert(msg,BootstrapDialog.TYPE_WARNING);
               $("#ImportStatus").html('File not Allowed');
               $("#ImportStatus").addClass('alert alert-danger');
               return false;
            }
        },
        onComplete: function(file, response) {
            try{
            status.attr('src','');
            var urlPath=response;
	    if(urlPath!=""){
                $("#FileImport").val(urlPath);
                $("#ImportFilename").html(file);
		$("#btnAnalyze").prop('disabled',false);
                $("#ImportStatus").html();
	    }
           }catch(err){
               alert(err.message);
           }
        }
      });
}
function InitializeUploadFiles(lid, IsLeave){
    var btnUpload=$('#btnAddFiles');
    var status=$('#UploadProgress');
    //var DisabledEditControl=$("#EclaimAdd").is(":disabled");
    var AEdit=$("#_AllowEdit").val();
    new AjaxUpload(btnUpload, {
        action: 'upload-file.php',
        data:{
          lid: lid,
          il: IsLeave
        },
        name: 'fileUpload',
        autoSubmit: true,
        disabled: true,
        onSubmit: function(file,ext) {
            var rStat=$("#_RowStatusID").val();
            if(AEdit!=1){
               return false;
            }
            //if(rStat==='0'){
            //    var msg="Please <strong>Save Eclaim</strong> first before you can add attachment!";
            //    MessageBoxAlert(msg,BootstrapDialog.TYPE_WARNING);
            //    return false;
            //}
            if(EvaluateFiles(ext)){
               status.attr('src','../images/wait_progress.gif');
               return true;
            }else{
               var msg='This File "'+file+'" is not allowed to upload.\n';
               msg+="<b>File Type Currently Supported:</b> "+SupportedFiles+"...";
               MessageBoxAlert(msg,BootstrapDialog.TYPE_WARNING);
               return false;
            }
        },
        onComplete: function(file, response) {
            try{
            status.attr('src','');
            //Add uploaded file to list
            var urlPath=response;
	    if(urlPath!=""){
                //var s=file.size;
		var DFL=new DownloadFileList();
                DFL.AddRow(file,urlPath,urlPath,lid);
                DFL.AppendToTable("FileAttachments");
                InitializeBootstrapTooltips();
                BindFileAttachments();
	    }
           }catch(err){
               alert(err.message);
           }
        }
      });
}
function MessageBoxDeleteAttachment(msg,DialogType){
   if(DialogType==='undefined'){
      DialogType=BootstrapDialog.TYPE_INFO;
   }
   BootstrapDialog.alert({
       title: AppName,
       message: msg,
       type: DialogType, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
       closable: true, // <-- Default value is false
       draggable: true, // <-- Default value is false
       btnOKLabel: 'Yes', // <-- Default value is 'OK',
       btnCancelLabel: 'No', // <-- Default value is 'Cancel',
       btnOKClass: 'btn-info', // <-- If you didn't specify it, dialog type will be used,
       callback: function() {
            document.getElementById("FileAttachments").deleteRow(FileAttachmentsIndex);
      }
  });
}
function ReloadPage(){
    window.location.reload();
}
function CancelReload(){
    //
}
function UpdateBalanceProfileINTODatabase(xml,msg){
    var iReload="";
    if(msg==undefined){
        msg="Balance Profile Successfully Imported!";
        iReload="CancelReload";
    }else{
        iReload="ReloadPage";
    }
    $.ajax({
        type: "POST",
        url: "../class/ajax.php",
        data:{
            Param: xml,
            nIndex: 36
        },
        success: function(data,response){//it's always good to check server output when developing...
            var action=response;
            
            if (action){
                if(data==0){
                   MessageBoxAlert(msg,BootstrapDialog.TYPE_INFO,iReload);
                   return true;
                }
            }
        } 
    }); 
}
function ImportBalanceProfileINTODatabase(xml,msg){
    var iReload="CancelReload";
    if(msg==undefined){
        msg="Balance Profile Successfully Imported!";
        iReload="CancelReload";
    }else{
        iReload="ReloadPage";
    }
    $.ajax({
        type: "POST",
        url: "../class/ajax.php",
        data:{
            Param: xml,
            nIndex: 32
        },
        success: function(data,response){//it's always good to check server output when developing...
            var action=response;
            
            if (action){
                if(data==0){
                   MessageBoxAlert(msg,BootstrapDialog.TYPE_INFO);
                   return true;
                }
            }
        } 
    }); 
}
function DeleteFiles(Filename){
  var lid=$("#_LeaveID").val();
  BootstrapDialog.confirm({
       title: AppName,
       message: 'Are you sure you want to delete this attachment?',
       type: BootstrapDialog.TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
       closable: true, // <-- Default value is false
       draggable: true, // <-- Default value is false
       btnOKLabel: 'Yes', // <-- Default value is 'OK',
       btnCancelLabel: 'No', // <-- Default value is 'Cancel',
       btnOKClass: 'btn-info', // <-- If you didn't specify it, dialog type will be used,
       callback: function(result) {
           if(result){
               $.ajax({
                   type: "POST",
                   url: "delete.php",
                   data:{
                       file: Filename,
                       lid: lid
                   },
                   success: function(data,response){//it's always good to check server output when developing...
                   var action=response;
                   if (action){
                       MessageBoxDeleteAttachment("'"+Filename+"' Successfully Deleted!",BootstrapDialog.TYPE_INFO);
                       return;
                   }
                   } 
              }); 
           }
      }
  });
}
function ExportExcelUserList(cid,sid,cmi,did,site){
    var result="cid: "+cid+"\nsid: "+sid+"\ncmi: "+cmi+"\ndid: "+did;
   $.ajax({
	type: "GET",
	url: "export-balance-profile.php",
	data:{
          cid: cid,
	  sid: sid,
          cmi: cmi,
          did: did,
          sit: site
	},
	success: function(data,response){//it's always good to check server output when developing...
           var action=response;
	   if (action){
               //alert(data);
               url='../temp/BalanceProfile.xlsx';
               location=url;
               //Processed
	   }
	} 
   }); 
}
function GetFileNameOnly(fileName){
   var fname=fileName.match(/[^\/\\]+$/);
   return String(fname);
}
function Left(str,len){
   //var l=str.length;
   var ret=str.substring(0, len);
   return ret;
}
function Right(str,len){
   var l=str.length;
   var ret=str.substring(l, len);
   return ret;
}
function strlen(str){
    var l=str.length;
    return l;
}
function BindFileAttachments(){
$('#FileAttachments tr').click(function() {
    //alert( this.rowIndex );  // alert the index number of the clicked row.
    FileAttachmentsIndex=this.rowIndex;
});
}

function ViewProgressBar(){
   $("#ShowHideProgress").removeClass("leave-progress");
   $("#ShowHideProgress").addClass("leave-progress-start");
}

function hexc(colorval) {
    var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    delete(parts[0]);
    for (var i = 1; i <= 3; ++i) {
        parts[i] = parseInt(parts[i]).toString(16);
        if (parts[i].length == 1) parts[i] = '0' + parts[i];
    }
    var color = '#' + parts.join('');
    return color;
}
function HideProgressBar(){
   $("#ShowHideProgress").removeClass("leave-progress-start");
   $("#ShowHideProgress").addClass("leave-progress");
}
function ShowAddCreditLeaveHistory(){
   $('#CreditLeaveHistoryModal').modal('show');
}
function ShowAddAnnualLeaveHistory(){
   $('#AnnualLeaveHistoryModal').modal('show');
}
function ShowWokFlow(){
   $('#workflowModal').modal('show');
}
function MakeActive(IdMakeActive){
 $(".nav li").removeClass("active");//this will remove the active class from 
 $('#'+IdMakeActive).addClass('active');//previously active menu item 
}
function InitializeEleaveCalendar(mYear) {
   $(".eleave-calendar").jqxCalendar({ 
      width: '170px', 
      height: '143px',
      selectionMode: 'range' 
   });
   for(var i=1;i<=12;i++){
      var mDate=i+"/1/"+mYear;
      $("#EleaveCalendar"+i).jqxCalendar("setDate", new Date(mDate));
   }
   $("#EleaveCalendar1").jqxCalendar("setDate", new Date("1/15/2016"));
   $("#EleaveCalendar1").jqxCalendar("setDate", new Date("1/19/2016"));
}
function InitializeSelect2(){
  $('.cboSelect2').select2();
}

function addUserPic(opt) {
      var $opt = $('<span class="glyphicon glyphicon-user">sdssdsd' + $(opt.element).text() + '</span>');
      return $opt;
}
//$("#vehicle").select2().on("change", function(e) {
//    if (e.added) {
//        var icon = ""
//        $('.select2-search-choice div').filter(function() {
//            icon = '<span style="color: green" class="glyphicon glyphicon-'+e.added.css+'">&nbsp;</span>';
//            return $(this).text() == e.added.id;
//        }).prepend(icon);
//      }
//});
function format(icon) {
    var originalOption = icon.id;
    console.log(originalOption);
    return '<i class="fa fa' + originalOption + '"></i> ' + icon.text;
}
function InitializeBootstrapTooltips(){
  // $('[data-toggle="tooltip"]').tooltip({html: true}); 
}
function HideBootstrapTooltips(){
   try{
   $('[data-toggle="popover"]').popover('hide');
   }catch(err){
     //
   }
}
function ShowModalDialog(PageUrl,options,Func,FuncCancel){
   var Content=$('<div></div>').load(PageUrl);
   var settings = $.extend({
      // These are the defaults.
      title: $("#AppTitle").html(),
      size: BootstrapDialog.SIZE_NORMAL,
      icon: 'glyphicon glyphicon-floppy-disk',
      autoclosable: false,
      closable: false,
      oklabel: 'OK',
      idOK: 'btnOK',
      idCancel: 'btnCancel',
      cancellabel: 'Cancel',
      cssClass: 'btn-primary'
   }, options);
BootstrapDialog.show({
   title: settings.title,
   size: settings.size,
   buttons: [{
      id: settings.idOK,
      icon: settings.icon,
      label: settings.oklabel,
      cssClass: settings.cssClass,
      action: function(dialogItself){
         window[Func](arguments);
         dialogItself.close();
      }
   }, 
   {
      label: settings.cancellabel,
      action: function(dialogItself){
         window[FuncCancel](arguments);
         dialogItself.close();
      }
   }],
    autoclosable: settings.autoclosable,
    closable: settings.closable,
    message: Content
  });
}
function ShowContactUs(){
  var title=$("#AppTitle").html();
  try{
  BootstrapDialog.show({
    title: title,
    width: 200,
    autoclosable: false,
    message: $('<div></div>').load('contactus.php?action=display')
  });
  }catch(err){
     alert(err.message);
  }
  InitializeBootstrapTooltips();
}
function CloseBootStrapDialog(){
   BootstrapDialog.closeAll();
}
function SendContactUsSubmit(){
   var cName=$("#ContactName").val();
   var cEmail=$("#ContactEmail").val();
   var cMessage=$("#ContactMessage").text();
   //Check for empty data entry
   if(cName=='' || cEmail=='' || cMessage==''){
      MessageBoxEx('Please fill up the required fields.',BootstrapDialog.TYPE_DANGER,'');
      return 1;
   }
    $.ajax({
     type: "POST",
     url: "../pages/sendcontactus.php",
     data:{
       cname: cName,
       cmail:  cEmail,
       cmessage:  cMessage
     },
     success: function(data,response){//it's always good to check server output when developing...
       var action=response;
       if (action){
          if(data=='OK'){
             MessageBoxEx('Email Successfully Sent.',BootstrapDialog.TYPE_INFO,'Close');
          }else{
             MessageBoxEx('Email Failed to Sent.',BootstrapDialog.TYPE_DANGER,'Close');
          }
       }
     } 
   }); 
}

function MessageBoxEx(msg,DialogType,Func,CancelFunc){
   if(DialogType==='undefined'){
      DialogType=BootstrapDialog.TYPE_INFO;
   }
   BootstrapDialog.confirm({
       title: AppName,
       message: msg,
       type: DialogType, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
       closable: true, // <-- Default value is false
       draggable: true, // <-- Default value is false
       btnOKLabel: 'Yes', // <-- Default value is 'OK',
       btnCancelLabel: 'No', // <-- Default value is 'Cancel',
       btnOKClass: 'btn-info', // <-- If you didn't specify it, dialog type will be used,
       callback: function(result) {
          // result will be true if button was click, while it will be false if users close the dialog directly.
          if(result) {
             window[Func](arguments);
             return true;
          }else{
            if(CancelFunc!=undefined){
               window[CancelFunc](arguments);
            }
            return false;
          }
      }
   });
}
function MessageBoxAlert(msg, DialogType,Func) {
   BootstrapDialog.show({
      message: msg,
      closable: false,
      title: AppName,
      type: DialogType,
      buttons: [{
            label: 'Ok',
            cssClass: 'btn-warning',
            action: function (dialogItself) {
               if(Func==undefined){
                  dialogItself.close();
                  return 1;
               }else{
                  window[Func](arguments);
                  return 1;
               }
               
            }
         }]
   });

}
function PadNumber(Str) { 
   return (Str < 10) ? '0' + Str : Str; 
}
function FormatDate(inputDate,DateFormat) {
  var ReturnDate='';
  if(DateFormat==undefined){
     DateFormat='mm/dd/yyyy';
  }
  if (inputDate==null){
      return null;
  }
  var d = new Date(inputDate);
  switch(DateFormat){
     case 'mm/dd/yyyy':
        ReturnDate=[PadNumber(d.getMonth()+1),PadNumber(d.getDate()), d.getFullYear()].join('/');
        break;
     case 'dd/mm/yyyy':
        ReturnDate=[PadNumber(d.getDate()),PadNumber(d.getMonth()+1), d.getFullYear()].join('/');
        break;
     case 'mm-dd-yyyy':
        ReturnDate=[PadNumber(d.getMonth()+1),PadNumber(d.getDate()), d.getFullYear()].join('-');
        break;
     case 'yyyy-mm-dd':
        ReturnDate=[d.getFullYear(),PadNumber(d.getMonth()+1),PadNumber(d.getDate())].join('-');
        break;
     case 'dd-mm-yyyy':
        ReturnDate=[PadNumber(d.getDate()),PadNumber(d.getMonth()+1), d.getFullYear()].join('-');
        break;
     case 'y,m,d':
        ReturnDate=[d.getFullYear(),d.getMonth()-1,d.getDate()].join(',');
        break;
  }
  
  return ReturnDate;
}
function UncheckBoxes(){
   $('#LeaveHalfDayAM').jqxRadioButton({checked: false});
   $('#LeaveHalfDayPM').jqxRadioButton({checked: false});
   $('#LeaveFourthDay').jqxRadioButton({checked: false});
}
function ComputeDaysApplied(AllowOneFourth){
   //var checked = $('#jqxCheckBox').jqxCheckBox('checked'); 
   var HalfdayAM=$('#LeaveHalfDayAM').jqxRadioButton('checked');
   var HalfdayPM=$('#LeaveHalfDayPM').jqxRadioButton('checked');
   var OneFourthDay=$('#LeaveFourthDay').jqxRadioButton('checked');
   var RecipientID=$("#LeaveRecipient").select2('val');
   var CountryID=$("#_LeaveCompanyID").val();
   var sDate=FormatDate($('#LeaveStartDate').jqxDateTimeInput('getDate'),"yyyy-mm-dd"); 
   var eDate=FormatDate($('#LeaveEndDate').jqxDateTimeInput('getDate'),"yyyy-mm-dd"); 
   var lt=$("#LeaveTypeList").select2('val');
   if(!AllowOneFourth && OneFourthDay){
      //if(HalfdayAM && HalfdayPM){
         var msg="You are not allowed to have One Fourth day Leave\nBased on the configuration of your Site <strong>'"+Site+"'</strong>.";
         msg=msg+"\n<b>Please contact your local HR!</b>";
         MessageBoxAlert(msg,BootstrapDialog.TYPE_DANGER);
         UncheckBoxes();
         GetTotalDaysApplied(RecipientID,CountryID,sDate,eDate,lt);
      //}
   }else{
      GetTotalDaysApplied(RecipientID,CountryID,sDate,eDate,lt);
   }
}

function UpdateApproverCostCenterOwner(){
    var CostCenterID=$("#CostCenter").select2('val');
    var CostCenterOwnerID=$("#CostCenterOwner").select2('val');
    var ConID=$("#ApproverConfigCountry").select2('val');
    var ComID=$("#CompanyDropdownBySiteList").select2('val');
    var SiteID=$("#SiteList").select2('val');
    var DepID=$("#DepartmentDropdownByCompanyList").select2('val');
    var param=CostCenterID+'|'+CostCenterOwnerID;
     $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 19, //
         Param: param
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){
           window.location="../pages/approver-config.php?cid="+ConID+'&sid='+SiteID+'&sdid='+DepID+'&cmid='+ComID+'&scid='+CostCenterID;
        }
     } 
    });
}
function InsertUpdateAnnualLeaveAllocations(){
   var AnnualLeaveAllocationID=$("#_AnnualLeaveAllocationID").val();
   var EmploymentCategoryID=$("#EmploymentCategoryList").select2('val');
   var LengthOfService=$("#LengthOfService").select2('val');
   var CountryID=$("#LeaveBalanceCountry").select2('val');
   var CompanyID=$("#CompanyDropdownList").select2('val');
   var SiteID=$("#SiteList").select2('val');
   var RowIndex=$("#_RowIndex").val();
   var LeaveEntitled=$("#EntitledLeave").val();
   var RowStatus=0;
   if (AnnualLeaveAllocationID>0){// Existing Record so Update
       RowStatus=2;
   }else{//Zero meaning New Record
       RowStatus=0;
   }
   //alert(SelectedYears);
   var LeaveTypeID=$("#LeaveTypeList").select2('val');
   var IsPopulate= $("#LeaveAllocationPopulateAllYears").jqxCheckBox('checked')? 1:0; 
   var param=AnnualLeaveAllocationID+"|"+EmploymentCategoryID+"|"+SiteID+"|"+CompanyID+"|"+LengthOfService+"|"+LeaveEntitled+"|"+LeaveTypeID+"|"+IsPopulate+"|"+SelectedYears+"|"+RowStatus;
   //alert(param);
   //return 1;
    $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 15, //InsertUpdateAnnualLeaveAllocations
         Param: param
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){
           //alert(param);
           window.location="../pages/leave-allocations.php?cn="+CountryID+"&ec="+EmploymentCategoryID+"&si="+SiteID+"&ltd="+LeaveTypeID+"&ls="+LengthOfService+"&ri="+RowIndex+'&ci='+CompanyID;
        }
     } 
    });
}
function CheckIfHolidayExist(SiteID,HDate){
   var param=SiteID+"|"+FormatDate(HDate,"yyyy-mm-dd");
   $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 14, //Insert, Update EmploymentStatus
         Param: param
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){
           alert(data);
           HolidayExist=data;
        }
     } 
    });
}
function InsertUpdateCompanySiteXML(){
   var xmlParser=new XMLWriter();
   xmlParser.BeginNode("entry");
   xmlParser.BeginNode("companysites");
   var CompanySiteRowsCount=$("#tblCompanySite>tbody>tr").length;
   var CompanySiteTableRows = $("#tblCompanySite")[0];
   for(var n=1;n<=CompanySiteRowsCount;n++){
       var curCell=CompanySiteTableRows.rows[n].cells;
       var mRowStatus=curCell[6].innerHTML;
       if(parseInt(mRowStatus)!=1){
         xmlParser.BeginNode("companysite");
         xmlParser.Node("CompanySiteID",curCell[0].innerHTML);
         xmlParser.Node("CountryID",curCell[1].innerHTML);
         xmlParser.Node("CompanyID",curCell[2].innerHTML);
         xmlParser.Node("SiteID",curCell[3].innerHTML);
         xmlParser.Node("RowStatus",mRowStatus);
         xmlParser.EndNode();// close employmentstatusrows
       }
   }
   xmlParser.EndNode();// close companysites
   xmlParser.EndNode();// close entry
   xmlParser.Close();
   var xml=xmlParser.xml();
   /*
   document.write("<xmp>");
   document.write(xml);
   document.write("</xmp>");
   return 1;
   */
   ViewProgressBar();
   $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 18, //Insert, Update EmploymentStatus
         Param: xml
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        var param=data.split("|");
        if (action){
           if(parseInt(param[3])>=0){
              //Successful
              var cid=param[1];
              var sid=param[2];
              if(cid==""){
                  cid=$("#CompanySiteCountry").select2('val');
              }
              if(sid==""){
                  sid=$("#SiteList").select2('val');
              }
              document.location="company-sites.php?cid="+cid+"&sid="+sid;
           }else{ //There is an error
              MessageBoxAlert("Error Saving/Submitting LeaveType Site, \nPlease Check your data.",BootstrapDialog.TYPE_DANGER);
              HideProgressBar();
           }
        }
     } 
    });
}
function InsertUpdateLeaveTypeSitesXML(SiteID, CompanyID){
   var xmlParser=new XMLWriter();
   xmlParser.BeginNode("entry");
   xmlParser.BeginNode("leavetypesites");
   var LeaveTypeRowsCount=$("#tblIncludedLeaveType>tbody>tr").length;
   var LeaveTypeTableRows = $("#tblIncludedLeaveType")[0];
   try{
   for(var n=1;n<=LeaveTypeRowsCount;n++){
      var curCell=LeaveTypeTableRows.rows[n].cells;
      var mLeaveTypeSiteID=curCell[0].innerHTML;
      var mLeaveTypeID=curCell[1].innerHTML;
      var mMessage=curCell[2].innerHTML;
      var mRowStatus=curCell[3].innerHTML;
      var mShowMarriage=curCell[6].innerHTML;
      var mBabyBirthday=curCell[7].innerHTML;
      var mIncludeHolidays=curCell[8].innerHTML;
      var mIncludeWeekEnd=curCell[9].innerHTML;
      var mIncludeRestdays=curCell[10].innerHTML;
      var mAutoDistribution=curCell[11].innerHTML;
      var mLeaveAllocationLimit=curCell[12].innerHTML;
      var mIsProRata=curCell[13].innerHTML;
      var mShowInDashboard=curCell[14].innerHTML;
      if(parseInt(mRowStatus)!=1){
         xmlParser.BeginNode("leavetypesite");
         xmlParser.Node("LeaveTypeSiteID",mLeaveTypeSiteID);
         xmlParser.Node("LeaveTypeID",mLeaveTypeID);
         xmlParser.Node("SiteID",SiteID);
         xmlParser.Node("CompanyID",CompanyID);
         xmlParser.Node("Message",mMessage);
         xmlParser.Node("ShowMarriageDate",mShowMarriage);
         xmlParser.Node("ShowBabyBirthday",mBabyBirthday);
         xmlParser.Node("IncludeHolidays",mIncludeHolidays);
         xmlParser.Node("IncludeWeekEnd",mIncludeWeekEnd);
         xmlParser.Node("IncludeRestDays",mIncludeRestdays);
         xmlParser.Node("AutoDistribution",mAutoDistribution);
         xmlParser.Node("IsProRata",mIsProRata);
         xmlParser.Node("LeaveAllocationLimit",CurrencyFormat(mLeaveAllocationLimit,2));
         xmlParser.Node("RowStatus",mRowStatus);
         xmlParser.Node("ShowInDashboard",mShowInDashboard);
         xmlParser.EndNode();// close employmentstatusrows
      }
   }
   }catch(err){
      alert(err.message);
   }
   xmlParser.EndNode();// close employmentstatus
   xmlParser.EndNode();// close entry
   xmlParser.Close();
   var xml=xmlParser.xml();

   /*
   document.write("<xmp>");
   document.write(xml);
   document.write("</xmp>");
   return 1;
   */
   ViewProgressBar();
   $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{ 
         nIndex: 16, //Insert, Update EmploymentStatus
         Param: xml
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        var param=data.split("|");
        if (action){
           if(parseInt(param[2])>=0){
              //Successful
             // alert(data);
              var sid=param[0];
              var cid=param[1];
              //document.location="leavetype-sites.php?cid="+cid+"&sid="+sid+"&cmid="+CompanyID;
           }else{ //There is an error
              MessageBoxAlert("Error Saving/Submitting LeaveType Site, \nPlease Check your data.",BootstrapDialog.TYPE_DANGER);
              HideProgressBar();
           }
        }
     } 
    });
}
function ShowLeaveSiteSetting(nSiteID, nLeaveTypeID){
   var params=nSiteID+"|"+nLeaveTypeID;
   $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 17, //Insert, Update EmploymentStatus
         Param: params
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        var param=data.split("|");
        var ShowMarriageDate=parseInt(param[1]);
        var ShowBabyBirthday=parseInt(param[2]);
        if(ShowMarriageDate==1){
           $("#DivLeaveMarriage").show();
        }else{
           $("#DivLeaveMarriage").hide();
        }
        if(ShowBabyBirthday==1){
           $("#DivLeaveShowBabyBirthday").show();
        }else{
           $("#DivLeaveShowBabyBirthday").hide();
        }
     } 
    });
}
function InsertUpdateEmploymentStatusXML(){
   var xmlParser=new XMLWriter();
   xmlParser.BeginNode("entry");
   xmlParser.BeginNode("employmentstatus");
   var TotalRows=tEmp.rowCount;
   for(i=1;i<=TotalRows;i++){
      xmlParser.BeginNode("employmentstatusrows");
      xmlParser.Node("EmploymentStatusID",tEmp.CurrentCell(0,i));
      xmlParser.Node("SiteID",tEmp.CurrentCell(1,i));
      xmlParser.Node("EmploymentStatus",tEmp.CurrentCell(5,i));
      xmlParser.Node("CountryID",tEmp.CurrentCell(2,i));
      xmlParser.Node("DefaultAnnualLeaveDays",tEmp.CurrentCell(6,i));
      xmlParser.Node("RowStatus",tEmp.CurrentCell(3,i));
      xmlParser.EndNode();// close employmentstatusrows
   }
   xmlParser.EndNode();// close employmentstatus
   xmlParser.EndNode();// close entry
   xmlParser.Close();
   var xml=xmlParser.xml();
   //alert(xml);
   //document.write(xml);
   //return;
   ViewProgressBar();
   $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 11, //Insert, Update EmploymentStatus
         Param: xml
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){
           if(parseInt(data)>=0){
              //Successful
              document.location="employment-status.php";
           }else{ //There is an error
              MessageBoxAlert("Error Saving/Submitting Employment Status, \nPlease Check your data.",BootstrapDialog.TYPE_DANGER);
              HideProgressBar();
           }
        }
     } 
    });
}
function InsertUpdateLeaveCreditXML(IsSubmit){
   var SubmitValue='';
   if(IsSubmit==0){
      SubmitValue='0';
   }else{
      SubmitValue='1';
   }
   var xmlParser=new XMLWriter();
   xmlParser.BeginNode("entry");
   xmlParser.BeginNode("creditleave");
   xmlParser.Node("CreditLeaveID",$("#_CreditLeaveID").val());
   xmlParser.Node("UserID",UserID);
   var DApplied=$("#LeaveCreditDate").jqxDateTimeInput('getDate'); 
   xmlParser.Node("DateApplied",FormatDate(DApplied,"yyyy-mm-dd"));
   xmlParser.Node("TotalDays",$("#TotalDaysCount").html());
   xmlParser.Node("CreditLeaveStatusID",$("#_CreditLeaveStatusID").val());//_CreditLeaveStatusID
   xmlParser.Node("Comments",$("#LeaveCreditComment").text());
   xmlParser.Node("IsSubmit",SubmitValue);
   xmlParser.Node("StatusID",$("#_RowStatusID").val());
   xmlParser.EndNode();
   var TotalRows=tclass.rowCount;
   xmlParser.BeginNode("creditleavedetails");
   for(i=1;i<=TotalRows;i++){
      xmlParser.BeginNode("creditleavedetail");
      xmlParser.Node("CreditLeaveDetailsID",tclass.CurrentCell(0,i));
      xmlParser.Node("StartDate",FormatDate(tclass.CurrentCell(3,i),"yyyy-mm-dd"));
      xmlParser.Node("EndDate",FormatDate(tclass.CurrentCell(4,i),"yyyy-mm-dd"));
      xmlParser.Node("DetailStatus",tclass.CurrentCell(6,i));
      xmlParser.Node("IsWholeDay",tclass.CurrentCell(7,i));
      xmlParser.EndNode();
   }
   xmlParser.EndNode();
   xmlParser.Close();
   var xml=xmlParser.xml();
   /*
   document.write('<xmp>');
   document.write(xml);
   document.write('</xmp>');
   return 1;
   */
   ViewProgressBar();
   $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 9, //Insert, Update Leave Credit
         Param: xml
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){
           var ArrData=data.split("|");
           if(parseInt(ArrData[1])>=0){
              //Successful
              document.location="leave-credit-application.php?action=view&id="+ArrData[0];
           }else{ //There is an error
              MessageBoxAlert("Error Saving/Submitting Leave Credit Application, \nPlease Check your data.",BootstrapDialog.TYPE_DANGER);
              HideProgressBar();
           }
        }
     } 
    });
}
function CurrencyFormat(number,decimalplaces){
   if (typeof decimalplaces === 'undefined'){ 
       decimalplaces = 2; 
   }
   var decimalcharacter = ".";
   var thousandseparater = ",";
   number = parseFloat(number);
   var sign = number < 0 ? "-" : "";
   var formatted = new String(number.toFixed(decimalplaces));
   if( decimalcharacter.length && decimalcharacter != "." ) { formatted = formatted.replace(/\./,decimalcharacter); }
   var integer = "";
   var fraction = "";
   var strnumber = new String(formatted);
   var dotpos = decimalcharacter.length ? strnumber.indexOf(decimalcharacter) : -1;
   if( dotpos > -1 )
   {
      if( dotpos ) { integer = strnumber.substr(0,dotpos); }
      fraction = strnumber.substr(dotpos+1);
   }
   else { integer = strnumber; }
   if( integer ) { integer = String(Math.abs(integer)); }
   while( fraction.length < decimalplaces ) { fraction += "0"; }
   temparray = new Array();
   while( integer.length > 3 )
   {
      temparray.unshift(integer.substr(-3));
      integer = integer.substr(0,integer.length-3);
   }
   temparray.unshift(integer);
   integer = temparray.join(thousandseparater);
   return sign + integer + decimalcharacter + fraction;
}
function StringToFloat(str, decimalForm){
	//This function will convert string value into Float valid values
	if (typeof decimalForm === 'undefined'){ 
		decimalForm = 2; 
	}
	var v=str.replace(',','').replace(' ','');
	v=v.replace(',','').replace(' ','');
	v=parseFloat(v);
	//console.log(v);
	var v=v.toFixed(decimalForm);
	return v;
}
function EnableLeaveControl(df){
   $(".leave-control").prop('disabled',!df);
   $(".leave-date").jqxDateTimeInput({disabled: !df});
   $("#LeaveEditButton").prop('disabled',df);
   $("#btnAddFiles").prop('disabled',!df);
   $(".leave-check").jqxRadioButton({disabled: !df}); //$(".leave-check").jqxRadioButton({disabled: false});
   if(df){
      var rw=$("#_RowStatusID").val();
      if(rw==0){//New Leave
         $("#_RowStatusID").val(0);
      }else{
         $("#_RowStatusID").val(2);
      }
   }
   //HideBootstrapTooltips();
}
/******* Ajax ****************************/
function GetTotalDaysApplied(UserID,CountryID,sDate,eDate,lt){
    var sParam=UserID+"|"+CountryID+"|"+sDate+"|"+eDate+"|"+lt;

    if(sDate==null){
        return 0;
    }
    $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 1, //Get total Days Applied
         Param: sParam
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){
            var num=parseInt(data);
            var daysDisplay='';
            if (num>1){
               daysDisplay=" Days.";
            }else{
               daysDisplay=" Day.";
            }
            var n=CurrencyFormat(num);
            //Check if half day is tick jqxCheckBox('checked');
            var HalfdayAM=$('#LeaveHalfDayAM').jqxRadioButton('checked');
            var HalfdayPM=$('#LeaveHalfDayPM').jqxRadioButton('checked');
            var OneFourthDay=$('#LeaveFourthDay').jqxRadioButton('checked');
            var FractionDay=0;
            if(HalfdayAM || HalfdayPM){
               FractionDay=0.5;
            }else if(OneFourthDay){
               FractionDay=0.75;
            }
            //alert(FractionDay);
            n=CurrencyFormat(n-FractionDay);

            if (isNaN(n)){
               n=0;
            }
            var bal=0;
            //Check for Unpaid Leave
            if(IsPaid==0){//No Payment Leave Allow any days
              $("#eLeaveCurrentYearEntitled").html("0.00");
              $("#eLeaveTotalDaysApplied").html("0.00");
              $("#_LeaveTotalDaysApplied").val(0.00);
              $("#eLeaveBalance").html("0.00");
              $("#eLeaveTotalDaysToApply").html(n);
              $("#_LeaveTotalDaysToApply").val(n);
              bal=0.00;
		
            }else{
              $("#eLeaveTotalDaysToApply").html(n);
              $("#_LeaveTotalDaysToApply").val(n);
			  console.log(parseFloat($("#eLeaveBalance").html()));
			  console.log(parseFloat($("#eLeaveTotalDaysToApply").html()));
              bal=parseFloat($("#eLeaveBalance").html())-parseFloat($("#eLeaveTotalDaysToApply").html());
			  console.log("here:" + bal);
            }
			console.log("bal:" + bal);
            $("#LeaveBalanceAfter").css("background-color","white");
            $("#LeaveBalanceAfter").css("color","black");
            mAlert.Hide();
            DisableSaveSubmit(false);
            var bgcolor="white";
            var fncolor="black";
//            console.log("test:: " + bal + $("#eLeaveBalance").html());
            if (bal<0){
               // alert('Bal: '+bal+' Allowed: '+NegativeLeaveAllocationLimit);
                if(!AllowedNegativeBalance){
                   mAlert.Show('AlertDiv','Advance Leave is not Permitted for your Site.',"Please Contact your Local HR!");
                   DisableSaveSubmit(true);
                   bgcolor="red";
                   fncolor="white";
                }else if(AllowedNegativeBalance && bal<NegativeLeaveAllocationLimit){
                    mAlert.Show('AlertDiv','Your Advance Leave is not Permitted.',LeaveMessage);
                    DisableSaveSubmit(true);
                    bgcolor="red";
                    fncolor="white";
                }
                $("#LeaveBalanceAfter").css("background-color",bgcolor);
                $("#LeaveBalanceAfter").css("color",fncolor);
                $("#LeaveBalanceAfter").css("font-weight","bold");
            }
            $("#LeaveBalanceAfter").html(CurrencyFormat(bal));
            //Check for Cross Date
            CheckCorssDate();
        }
     } 
    });
}


function ExecuteCreditLeaveNow(){
    var CreditLeaveID=$("#_CreditLeaveID").val();
    var IsSubmit=$("#_LeaveIsSubmit").val();
    var ApplicantID=$("#_LeaveApplicantID").val();
    var RecipientID=$("#LeaveRecipient").select2('val');
	//var RecipientID=$("#LeaveRecipient").val();
	
    var StartDate=FormatDate($('#LeaveStartDate').jqxDateTimeInput('getDate'),'yyyy-mm-dd');
    var EndDate=FormatDate($('#LeaveEndDate').jqxDateTimeInput('getDate'),'yyyy-mm-dd');
    var HalfdayAM=BooleanToInteger($('#LeaveHalfDayAM').jqxRadioButton('checked'));
    var HalfdayPM=BooleanToInteger($('#LeaveHalfDayPM').jqxRadioButton('checked'));
    var LeaveTypeID=$("#_LeaveTypeID").val();
    var DaysToApply=StringToFloat($("#eLeaveTotalDaysToApply").html());
    var Remarks=$("#LeaveRemarks").text();
    var LocalHRID=$("#_LocalHRID").val();
    var ApproverID=$("#_LeaveApproverID").val();
    var CurrentUserID=$("#_CurrentUserID").val();
    var Param=CreditLeaveID+"|"+IsSubmit+"|"+ApplicantID+"|"+RecipientID;
    Param=Param+"|"+StartDate+"|"+EndDate+"|"+HalfdayAM+"|"+HalfdayPM;
    Param=Param+"|"+LeaveTypeID+"|"+DaysToApply+"|"+Remarks+"|"+LocalHRID;
    Param=Param+"|"+ApproverID+"|"+CurrentUserID;
    ViewProgressBar();
   $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 30, //Update Credit Leave
         Param: Param
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){
           var ArrData=data.split("|");
           if(parseInt(ArrData[1])>=0 && ArrData[0]){
              //Successful
              if(IsSubmit==1){
//                 document.location="dashboard.php";
                 document.location="leave-credit-list.php?status=in-process";
              }else{
                 //document.location="leave-credit-application.php?action=view&id="+ArrData[0];
                 document.location="leave-credit-list.php?status=draft";
              }
           }
	   else{ //There is an error
              //MessageBoxAlert("Error Saving/Submitting Leave Credit Application, \nPlease Check your data.",BootstrapDialog.TYPE_DANGER);
	      var msg = "Date Request Conflict!";
              var DateRange="You have a pending/approved leave request from "+FormatDate(StartDate);
              DateRange+="-"+FormatDate(EndDate);
              DateRange+="<br>You can only apply same date range if total days to apply is less than or greater than 1 day.";
              DateRange+="<br>Please Check your Date Entries.";
              MessageBoxAlert(DateRange, BootstrapDialog.TYPE_DANGER);
              HideProgressBar();
           }
        }
     } 
    });
}

function ExecuteLeaveNow(){
   var leaveID=$("#_LeaveID").val();
   var leaveApproverID=$("#_ApproverID").val();
   var leaveCompanyID=$("#_LeaveCompanyID").val();
   var leaveDateApplied=$("#_LeaveDateApplied").val();
   var leaveReference=$("#_LeaveReference").val();
   var curYearEntitled=$("#_LeaveCurrentYearEntitled").val();
   var curYearEntitledProRata=$("#_LeaveCurrentYearEntitledProRata").val();
   var leaveCarryForward=$("#_LeaveCarryForward").val();
   var leaveCarryForwardBalance=$("#_LeaveCarryForwardBalance").val();
   var leaveBalance=$("#_LeaveBalance").val();
   var leaveTotalDaysApplied=$("#_LeaveTotalDaysApplied").val();
   var leaveTotalDaysToApply=$("#_LeaveTotalDaysToApply").val();
   var leaveIsSubmit=$("#_LeaveIsSubmit").val();
   var leaveApplicant=$("#_LeaveApplicant").val();
   var leaveRecipient= $("#LeaveRecipient").val() == '' ? $("#LeaveRecipient").val() : $("#LeaveRecipient").select2('val');
   var leaveTypeList=$("#LeaveTypeList").select2('val');
   var leaveStartDate=$('#LeaveStartDate').jqxDateTimeInput('getDate'); 
   var leaveEndDate=$('#LeaveEndDate').jqxDateTimeInput('getDate'); 
   var leaveRemarks=$("#_LeaveRemarks").val();
   var leaveHalfDayAM=$('#LeaveHalfDayAM').jqxRadioButton('checked') ? 1:0;
   var leaveHalfDayPM=$('#LeaveHalfDayPM').jqxRadioButton('checked') ? 1:0;
   var leaveFourthDay=$('#LeaveFourthDay').jqxRadioButton('checked') ? 1:0;
   var leaveStatusID=$("#_LeaveStatusID").val();
   var lc=$("#_LeaveCredit").val();
   var rowStatusID=$("#_RowStatusID").val();
  
   $.ajax({
      type: "POST",
      url: "../pages/leaveupdate.php",
      async: true,
      data:{
          lid: leaveID,
          lda: FormatDate(leaveDateApplied,"yyyy-mm-dd"),
          lref:leaveReference,
          ls:  leaveIsSubmit,
          lsi: leaveStatusID,
          la:  leaveApplicant,
          lr:  leaveRecipient,
          lsd: FormatDate(leaveStartDate,"yyyy-mm-dd"),
          led: FormatDate(leaveEndDate,"yyyy-mm-dd"),
          lha: leaveHalfDayAM,
          lhp: leaveHalfDayPM,
          lfd: leaveFourthDay,
          ltl: leaveTypeList,
          re:  leaveRemarks,
          cy:  curYearEntitled,
          cyp: curYearEntitledProRata,
          lcf: leaveCarryForward,
          lcfb:leaveCarryForwardBalance,
          lbc: leaveBalance,
          lt:  leaveTotalDaysApplied,
          lta: leaveTotalDaysToApply,
          lci: leaveCompanyID,
          lai: leaveApproverID,
          lc:  lc,
          rsi: rowStatusID
      },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){

            var arr=data.split("|");

            if (parseInt(arr[0])>0) {
               var msg = "Date Request Conflict!";
               var DateRange="You have a pending/approved leave request from "+FormatDate($('#LeaveStartDate').jqxDateTimeInput('getDate'));
               DateRange+="-"+FormatDate($('#LeaveEndDate').jqxDateTimeInput('getDate'));
               DateRange+="<br>You can only apply same date range if total days to apply is less than or equal to 1 day.";
               DateRange+="<br>Please Check your Date Entries.";
               MessageBoxAlert(DateRange, BootstrapDialog.TYPE_DANGER);
               
               HideProgressBar();
            }else{
               if(leaveIsSubmit==1){//If Submitted then Redirect to dashboard
                    document.location="leave-list.php?status=in-process";

               }else{
                    document.location="leave-list.php?status=draft";
               }
            }
            
        }
     } 
    });
}
function InsertUpdateSite(){
   var SiteID=$("#_SiteID").val();
   var CountryID=$("#SiteCountry").select2('val');
   var Site=$("#Site").val();
   var SiteActive=$("#SiteActive").jqxCheckBox('checked')? 1:0;
   var SiteAllowNegativeCredit=$("#SiteAllowNegativeCredit").jqxCheckBox('checked')? 1:0;
   var SiteStatus=$("#_SiteStatus").val();
   var RowIndex=$("#_RowIndex").val();
   var mParam=SiteID+"|"+CountryID+"|"+Site+"|"+SiteActive;
   mParam+="|"+SiteAllowNegativeCredit+"|"+SiteStatus+"|"+RowIndex;
   ViewProgressBar();
    $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 7, //Insert, Update Site
         Param: mParam
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){
            if (data>0) {
               document.location=location.href;
            } else {
               var msg = "Error on saving Site.";
               mAlert.Show('AlertDiv', msg, "Please check your entry.");
               HideProgressBar();
            }
            //
        }
     } 
    });
}
function InsertUpdateEmployeeDetails(){
   var EmploymentDetailID=$("#_EmploymentDetailID").val();
   var EmploymentUser=$("#EmploymentUser").select2('val');
   var EmploymentDateHired=FormatDate($("#EmploymentDateHired").jqxDateTimeInput('getDate'),"yyyy-mm-dd"); 
   var EmploymentStatus=$("#EmploymentStatusList").select2('val');
   var WorkPosition=$("#EmploymentPosition").val();
   var EmploymentCategoryID=$("#EmploymentCategoryList").select2('val');
   var SiteID=$("#SiteList").select2('val');
   var Active=$("#EmploymentActive").prop('checked')? 1:0;
   var EmploymentRowStatus=$("#_EmploymentRowStatus").val();
   var mParam=EmploymentDetailID+"|"+EmploymentUser+"|"+EmploymentDateHired+"|"+EmploymentStatus;
   mParam+="|"+WorkPosition+"|"+EmploymentCategoryID;
   mParam+="|"+SiteID+"|"+Active+"|"+EmploymentRowStatus;
   //alert(mParam);
   ViewProgressBar();
    $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 8, //Insert/Update EmploymentDetails
         Param: mParam
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){
            if (data == 0) {
               document.location=location.href;
               HideBootstrapTooltips();
            } else {
               var msg = "Error on saving Employment Details.";
               mAlert.Show('AlertDiv', msg, "Please check your entries.");
            }
            HideProgressBar();
        }
     } 
    });
}
function GenerateRestDaysXML(){
   var xmlParser=new XMLWriter();
   xmlParser.BeginNode("entry");
   var TotalRows=tclass.rowCount;
   xmlParser.BeginNode("restdays");
   for(i=1;i<=TotalRows;i++){
      xmlParser.BeginNode("restday");
      xmlParser.Node("RestDayID",tclass.CurrentCell(0,i));
      xmlParser.Node("UserID",tclass.CurrentCell(1,i));
      xmlParser.Node("RestDay",FormatDate(tclass.CurrentCell(4,i),"yyyy-mm-dd"));
      xmlParser.Node("RestDayStatus",tclass.CurrentCell(2,i));
      xmlParser.EndNode();
   }
   xmlParser.EndNode();
   xmlParser.Close();
   var xml=xmlParser.xml();
   return xml;
}
function InsertRestDaysXML(){
   var mParam=GenerateRestDaysXML();
   /*
   document.write("<xmp>");
   document.write(mParam);
   document.write("</xmp>");
   return 1;
   */
   ViewProgressBar();
    $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 10, //Insert, Update Rest Days
         Param: mParam
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){
            var arr=data.split("|");
            if (arr[1] == 0) {
               location='../pages/rest-days.php?uid='+arr[0];
            } else {
               var msg = "Error On Saving Rest Days.";
               mAlert.Show('AlertDiv', msg, "Please check your entries.");
            }
            HideProgressBar();
        } 
     } 
    });
}
function ExecuteAdditionalLeaveCredit(){
    //Check which record has been selected
    //This Function Will Add Credit Leave to Seletected Employee
try{
    var selectedEmployee="";
    var tot= $('#tblLeavebalanceProfileList>tbody>tr').length-1;
    var Selected=EmployeeIDList;
    var EffectivityDate=FormatDate($("#DateEffectivity").jqxDateTimeInput('getDate'),'yyyy-mm-dd');
    var Expiration=$("#MonthExpiration").select2('val');
    var DaysUsed=$("#LeaveDayUsed").val();
    var DaysToAdd=$("#LeaveDayToAdd").val();
    var LeaveCreditReason=$("#LeaveReason").text();
    var TypeID=$("#AddionalCreditLeaveType").select2('val');
    var d = new Date();
    var CurrentYear = d.getFullYear(); 
    var mParam=$("#SiteList").select2('val');
    mParam=mParam+"|"+$("#_UserID").val();
    mParam=mParam+"|"+EffectivityDate;
    mParam=mParam+"|"+Expiration;
    mParam=mParam+"|"+LeaveCreditReason;
    mParam=mParam+"|"+DaysToAdd;
    mParam=mParam+"|"+CurrentYear;
    mParam=mParam+"|"+Selected;
    mParam=mParam+"|"+DaysUsed;
    mParam=mParam+"|"+TypeID;
    //alert(mParam);
    //return 1;
 }catch(err){
     alert(err.message);
 }
     $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 22, //Execute Additional Leave Credit
         Param: mParam
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){
            //alert(data);
            location.reload();
        }
     } 
    });
}
function InsertUpdateLeaveBalanceProfile(){
   var LeaveAllocationID=parseInt($("#LeaveAllocationID").val());
   var LeaveTypeID=$("#LeaveTypeList").select2('val');
   var LeaveRecipient=$("#LeaveRecipient").select2('val');
   var LeaveCurrentYear=$("#LeaveCurrentYear").select2('val');
   var LeaveEntitled=StringToFloat($("#LeaveEntitled").val(),2);
   var CarryForward=StringToFloat($("#CarryForward").val(),2);
   var CarryForwardBalance=StringToFloat($("#CarryForwardBalance").val(),2);
   var TotalLeaveTaken=StringToFloat($("#TotalLeaveTaken").val(),2);
   var CancelledLeave=StringToFloat($("#leaveCancelledLeave").val(),2);
   var Forfeiture=StringToFloat($("#leaveForfeitureLeave").val(),2);
   var LeaveCredit=StringToFloat($("#leaveCreditAmount").val(),2);
   var LeaveRowStatus=$("#_RowStatus").val();
   var mParam=LeaveAllocationID+"|"+LeaveTypeID+"|"+LeaveRecipient+"|"+LeaveCurrentYear;
   mParam+="|"+LeaveEntitled+"|"+CarryForward;
   mParam+="|"+CarryForwardBalance+"|"+TotalLeaveTaken;
   mParam+="|"+CancelledLeave+"|"+Forfeiture+"|"+LeaveCredit+"|"+LeaveRowStatus;
   //alert(LeaveRowStatus);
   ViewProgressBar();
    $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 6, //Insert, Update Leave Balance Profile
         Param: mParam
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){
            if (data == 0) {
               location.reload();
            } else {
               var msg = "Error on saving Leave Balance Profile.";
               mAlert.Show('LeaveBalanceAlert', msg, "Please check your entry.");
            }
            HideProgressBar();
        }
     } 
    });
}
function CurrencyFormat(number,decimalplaces){
   if (typeof decimalplaces === 'undefined'){ 
       decimalplaces = 2; 
   }
   var decimalcharacter = ".";
   var thousandseparater = ",";
   number = parseFloat(number);
   var sign = number < 0 ? "-" : "";
   var formatted = new String(number.toFixed(decimalplaces));
   if( decimalcharacter.length && decimalcharacter != "." ) { formatted = formatted.replace(/\./,decimalcharacter); }
   var integer = "";
   var fraction = "";
   var strnumber = new String(formatted);
   var dotpos = decimalcharacter.length ? strnumber.indexOf(decimalcharacter) : -1;
   if( dotpos > -1 )
   {
      if( dotpos ) { integer = strnumber.substr(0,dotpos); }
      fraction = strnumber.substr(dotpos+1);
   }
   else { integer = strnumber; }
   if( integer ) { integer = String(Math.abs(integer)); }
   while( fraction.length < decimalplaces ) { fraction += "0"; }
   temparray = new Array();
   while( integer.length > 3 )
   {
      temparray.unshift(integer.substr(-3));
      integer = integer.substr(0,integer.length-3);
   }
   temparray.unshift(integer);
   integer = temparray.join(thousandseparater);
   return sign + integer + decimalcharacter + fraction;
}
function StringToFloat(str, decimalForm){
	//This function will convert string value into Float valid values
	if (typeof decimalForm === 'undefined'){ 
		decimalForm = 2; 
	}
	var v=str.replace(',','').replace(' ','');
	v=v.replace(',','').replace(' ','');
	v=parseFloat(v);
	//console.log(v);
	var v=v.toFixed(decimalForm);
	return v;
}
// for china, remove. only one leave of approval
function AcknowledgeCreditLeaveRequest(){
    MessageBoxEx("Are you sure you want to acknowledge this Credit Leave Request?",BootstrapDialog.TYPE_DANGER,"ExecuteAcknowledgeCreditLeaveRequest","HideProgressBar");
}

function ExecuteAcknowledgeCreditLeaveRequest(){
   var CreditLeaveID=$("#_CreditLeaveID").val();
   var CreditLeaveIDMD5=$("#_CreditLeaveIDMD5").val();
   var CurrentUserID=$("#_CurrentUserID").val();
    ViewProgressBar();
    $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 31, //Acknowledge Cancel Leave request
         Param: CreditLeaveID+"|"+CurrentUserID
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){
            document.location="leave-credit-application.php?status=view&id="+CreditLeaveIDMD5;
        }
     } 
    });
}


function ApproveRejectLeaveRequest(IsReject){
   var msg;
   var func;
   //Check This when Last year is not Yet Closed
   var LastYearNotClosed =0; //$("#_LastYearNotClosed").val();
   var sdate=$('#LeaveStartDate').jqxDateTimeInput('getDate');
   var d= new Date(sdate);
   var cy=d.getFullYear()-1;
   var mLeaveTypeDesc=$("#LeaveTypeList").select2('data').text;
   var mDaysToApply=parseFloat($("#eLeaveTotalDaysToApply").html());
   var mBalanceAfterApprove=LeaveBalanceForApproval-mDaysToApply;
   var mLeaveBalanceLessThanApplied=LeaveBalanceForApproval<mDaysToApply;
   var mAllowedNegativeBalance=AllowedNegativeBalance;
   var mNegativeLeaveAllocationLimit=NegativeLeaveAllocationLimit;
   var mNegativeLimitLessThanApplied=Math.abs(mNegativeLeaveAllocationLimit)<Math.abs(mBalanceAfterApprove);
   var BT;
   var PromptToReject=mLeaveBalanceLessThanApplied && (!mAllowedNegativeBalance || (mAllowedNegativeBalance && mNegativeLimitLessThanApplied));
   var LTypeID=$("#LeaveTypeList").select2('val');
   var IsPaidLeave=LeaveTypeArray[LTypeID];
    if(PromptToReject && parseInt(IsPaidLeave)==1){
       var msg3="Cannot Approve Leave request with Days Applied Exceeds the limit!";
       msg3=msg3+"\n<strong>Details of Request:</strong>";
       msg3=msg3+"\n&nbsp;&nbsp;&nbsp;Days To Apply: "+mDaysToApply;
       msg3=msg3+"\n&nbsp;&nbsp;&nbsp;Current Balance Remaining for "+mLeaveTypeDesc+": "+LeaveBalanceForApproval;
       msg3=msg3+"\n&nbsp;&nbsp;&nbsp;Allow Advance Leave: "+mAllowedNegativeBalance.toString().toUpperCase();
       msg3=msg3+"\n&nbsp;&nbsp;&nbsp;Advance Leave Allocation Limit: "+Math.abs(mNegativeLeaveAllocationLimit);
       msg3=msg3+"\n<strong>Note: Please Reject this Request.</strong>";
       MessageBoxAlert(msg3,BootstrapDialog.TYPE_DANGER); 
       return false;
   }
   if(LastYearNotClosed==1){
       var msg1="Leave Application cannot be approve/reject, Profile Balance has not yet been reset.\nYear "+cy+" has not yet been closed.";
       MessageBoxAlert(msg1,BootstrapDialog.TYPE_INFO); 
       return false;
   }
   if(IsReject==0){
      //Reject
      msg="Are you sure you want to reject this leave request?";
      func="RejectLeaveRequest";
      BT=BootstrapDialog.TYPE_DANGER;
   }else{ //Approved
      msg="Are you sure you want to approve this leave request?";
      func="ApproveLeaveRequest";
      BT=BootstrapDialog.TYPE_INFO;
   }

    MessageBoxEx(msg,BT,func,'HideProgressBar'); 
}

function ReloadPage(){
   location.reload();
}

function InitializeCalendar(Selector,IsDisabled){
   if(IsDisabled==undefined){
      IsDisabled=true;
   }
   $(Selector).jqxCalendar({ 
      width: '200px', 
      height: '200px',
      selectionMode: 'default',
      disabled: !IsDisabled,
      theme: 'summer' 
   });
}
function RejectLeaveRequest() {
   var IApprove=0;
   var LeaveID = $("#_LeaveID").val();
   var ActorID = $("#_UserID").val();
   var nComment = $("#LeaveApproverComment").text();
   if (nComment=="Please Enter Comment to be able to Reject"){
       nComment="";
   }
   if(submitcount == 0){
    submitcount++;
   }else{
    alert('We are processing your application,Please wait.');
    return false;
   }
   var nParam = LeaveID + "|" + ActorID + "|" + nComment + "|" + IApprove;
   ViewProgressBar();
   $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data: {
         nIndex: 5, //Cancel Leave request
         Param: nParam
      },
      success: function (data, response) {//it's always good to check server output when developing...
         var action = response;
         if (action) {
            var ret=data;
            if (data==0){
               MessageBoxAlert("Sending Email Notification failed, Please check your email provider!",BootstrapDialog.TYPE_DANGER,"ReloadPage");
            }else{
               ReloadPage();
            }
         }
      }
   });
}

function ApproveLeaveRequest() {
   var IsApprove=1; //1 for Approved
   var LeaveID = $("#_LeaveID").val();
   var ActorID = $("#_UserID").val();
   var nComment = $("#LeaveApproverComment").text();
   var nParam = LeaveID + "|" + ActorID + "|" + nComment + "|"+ IsApprove;
   if(submitcount == 0){
    submitcount++;
   }else{
    alert('We are processing your application,Please wait.');
    return false;
   }
   ViewProgressBar();
   $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data: {
         nIndex: 5, //Approve/Reject Leave request
         Param: nParam
      },
      success: function (data, response) {//it's always good to check server output when developing...
         var action = response;
         //document.write(data);
         //return 1;
         if (action) {
            if (data==0){
               MessageBoxAlert("Sending Email Notification failed, Please check your email provider!",BootstrapDialog.TYPE_DANGER);
            }
            location.reload();            
         }
      }
   });
   
   
}
function GetCompanyDepartment(UserID){
    $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 3, //Get total Days Applied
         Param: UserID
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){
            var Leave=JSON.parse(data);

            var NoData=Leave.Company=="";
            if(NoData){
               var msg="The system has detected you haven't configured yet your employment details.";
               var resp="Please contact HR to configure employment details for "+Leave.Employee+"!";
               mAlert.Show(msg,resp);
            }
            $("#LeaveList").prop('disabled',NoData);
            //DisableSaveSubmit(NoData);
            $("#LeaveRecipientCompanyCode").val(Leave.CompanyCode+"-"+Leave.Company);
            $("#LeaveApplicantDepartment").val(Leave.Department);
            $("#_LeaveCompanyID").val(Leave.CompanyID);
        }
     } 
    });
}
function DefaultLeaveCreditValues(){
    $("#eLeaveCurrentYearEntitled").html("0.00");
    $("#eLeaveBalanceForwarded").html("0.00");
    $("#_LeaveCarryForward").val(0.00);
    $("#eLeaveBalance").html("0.00");//_LeaveBalance
    $("#_LeaveBalance").val(0.00);
    $("#eLeaveTotalDaysApplied").html("0.00");
    $("#_LeaveCurrentYearEntitled").val(0.00);
    $("#_LeaveBalanceCredit").val(0.00);
    $("#_LeaveTotalDaysApplied").val(0.00);
    var Lt=$("#LeaveTypeList").select2('data').text;
    //$("#LeaveTypeLabel").html(Lt);
    $("#_CurrentYearEntitledLabel").html('Leave Entitlement'); //Leave.LeaveTypeFull
    $("#_CurrentYearEntitledProRataLabel").html(Lt + "-ProRata");//
    $("#eLeaveCurrentYearEntitledProRata").html("0.00");
    $("#_LeaveCurrentYearEntitledProRata").val(0.00);
    $("#eLeaveCarryForwardBalance").html("0.00");
    $("#_LeaveCarryForwardBalance").val(0.00);
    $("#eLeaveTotalEntitlement").html("0.00");
    //alert(Leave.LeaveCreditAlloc);
    $("#eLeaveLeaveCredit").html("0.00");
    $("#_LeaveCredit").val(0.00);
    $("#LeaveBalanceAfter").html(CurrencyFormat(0.00));
    $("#eLeaveTotalDaysToApply").html(CurrencyFormat(0.00));
    //var bal=Leave.LeaveBalance-Leave.LeaveApplied;
    $("#LeaveBalanceAfter").css("background-color", "white");
    $("#LeaveBalanceAfter").css("color", "black");
}
function GetLeaveCredits(UserID,LeaveTypeID,CurrentYear){
    var sParam=UserID+"|"+LeaveTypeID+"|"+CurrentYear;
    if(CurrentYear==1900){
        DefaultLeaveCreditValues();
        return 1;
    }
    $.ajax({
      type: "POST",
      url: "../class/ajax.php",
      data:{
         nIndex: 2, //Get total Days Applied
         Param: sParam
         },
      success: function(data,response){//it's always good to check server output when developing...
        var action=response;
        if (action){
            var Leave=JSON.parse(data);
            $("#eLeaveCurrentYearEntitled").html(Leave.LeaveEntitlement);
            $("#eLeaveBalanceForwarded").html(Leave.CarryForward);
            $("#_LeaveCarryForward").val(Leave.CarryForward);
            $("#eLeaveBalance").html(Leave.LeaveBalance);//_LeaveBalance
            $("#_LeaveBalance").val(Leave.LeaveBalance);
            $("#eLeaveTotalDaysApplied").html(Leave.TotalLeaveTaken);
            $("#_LeaveCurrentYearEntitled").val(Leave.LeaveEntitlement);
            $("#_LeaveBalanceCredit").val(Leave.LeaveBalance);
            $("#_LeaveTotalDaysApplied").val(Leave.TotalLeaveTaken);
            $("#LeaveTypeLabel").html(Leave.ShowLeaveType);
            $("#_CurrentYearEntitledLabel").html('Leave Entitlement'); //Leave.LeaveTypeFull
            $("#_CurrentYearEntitledProRataLabel").html(Leave.LeaveType+"-ProRata");//
            $("#eLeaveCurrentYearEntitledProRata").html(Leave.LeaveEntitlementProRata);
            $("#_LeaveCurrentYearEntitledProRata").val(Leave.LeaveEntitlementProRata);
            $("#eLeaveCarryForwardBalance").html(Leave.CarryForwardBalance);
            $("#_LeaveCarryForwardBalance").val(Leave.CarryForwardBalance);
            $("#eLeaveTotalEntitlement").html(Leave.TotalEntitlement);
            //alert(Leave.LeaveCreditAlloc);
            $("#eLeaveLeaveCredit").html(Leave.LeaveCreditAlloc);
            $("#_LeaveCredit").val(Leave.LeaveCreditAlloc);
            LeaveMessage=Leave.LeaveMessage;
            NegativeLeaveAllocationLimit=Leave.NegativeLeaveAllocationLimit;
            $("#LeaveBalanceAfter").html(CurrencyFormat(0.00));
            
            $("#eLeaveTotalDaysToApply").html(CurrencyFormat(0.00));
            ComputeDaysApplied(AllowOneFourthDay);
            //var bal=Leave.LeaveBalance-Leave.LeaveApplied;
            $("#LeaveBalanceAfter").css("background-color","white");
            $("#LeaveBalanceAfter").css("color","black");
           // if (bal<0){
           //    $("#LeaveBalanceAfter").css("background-color","red");
           //    $("#LeaveBalanceAfter").css("color","white");
           //    $("#LeaveBalanceAfter").css("font-weight","bold");
           // }
            if(Leave.LeaveCredit<=0){
                $(".Leave-Credit").hide();
            }else{
                $(".Leave-Credit").show();
            }
            if(Leave.LeaveEntitlementProRata<=0){
               $(".ProRate-Entry").hide(); 
            }else{ 
               $(".ProRate-Entry").show(); 
            }
            if(Leave.CarryForward<=0){
                $(".Carry-Forward").hide();
            }else{
                $(".Carry-Forward").show();
            }
        }
     } 
    });
}

/******************************************************************************
 * 
 * ALL CANCELLATION FUNCTIONALITIES BELOW:
 * 
 */

function CancelLeaveForApproval(comment) {
    var LeaveID = $("#_LeaveID").val();
    var ApplicantID = $("#_LeaveApplicant").val();

    ViewProgressBar();
    $.ajax({
        type: "POST",
        url: "../class/ajax.php",
        data: {
            nIndex: 42, //Cancel Leave request
            Param: LeaveID + "|" + ApplicantID + "|" + comment
        },
        success: function (data, response) {//it's always good to check server output when developing...
            var action = response;
            if (action) {
                location.reload();
            }
        }
    });
}

function CancelLeaveApplication() {
    var LeaveStatus = $("#_LeaveStatusID").val();
    var Comment = "";
    var CurrentDate = new Date();
    var SelectedDate = new Date($('#_LeaveDateApplied').val());
    var StartDate = new Date($('#LeaveStartDate').jqxDateTimeInput('getDate'));

    // NOTE:: If the leave request is approved OR date already started, need approval from N+1. Else, just notify HR
    
    if (LeaveStatus == 2 && (CurrentDate < StartDate)) {
        //In-Process
        Comment = "Cancel In Process";
        CancelLeaveSubmission(Comment);
    }
    else if (LeaveStatus == 3 || (CurrentDate > StartDate) || (LeaveStatus == 2 && (CurrentDate > StartDate))) {
        //Cancel Approved
        Comment = "Cancel Approved";
        CancelLeaveForApproval(Comment); // for N+1 Approval  
    }

//    console.log(CurrentDate, StartDate, Comment);
//    return;

    /*else {
     Comment = "Cancel Validated";
     CancelLeaveApprove(Comment); // notify HR
     }*/
}

// PLEASE LOGIN USING NON-ADMIN ACCOUNT
function CancelLeave() {
    var LeaveStatus = $("#_LeaveStatusID").val();
    var msg = "";
    var sdate = $('#LeaveStartDate').jqxDateTimeInput('getDate');
    var mApplicantID = $("#_ApplicantID").val();
    var mCurrentUserID = $("#_UserID").val();
    var mLocalHRID = $("#_LocalHRID").val();
    var CurrentDate = new Date();
    var StartDate = new Date($('#LeaveStartDate').jqxDateTimeInput('getDate'));

    if (mApplicantID != mCurrentUserID && HRFullAccess != 1) {
        // Allow Cancel only if the Current User is the Applicant or the LocalHR
        msg = "Sorry, Only the Applicant and the Local HR can cancel this request";
        msg = msg + "\nPlease Contact your Local HR for more Info.";
        MessageBoxAlert(msg, BootstrapDialog.TYPE_WARNING);
        return false;
    }
    // Allow only to Cancel When the Start Date greater than the current date; IF start date < current date, needs approval from N+1
    /*if ((StartDate < CurrentDate) && LeaveStatus == 3) { // disable temp for testing
     //if ((StartDate < CurrentDate) && LeaveStatus == 3 && HRFullAccess != 1) {
     msg = "Sorry, You can only cancel your leave request before the start date!";
     msg = msg + "\n<b>StartDate</b>: " + FormatDate(sdate) + "\n<b>CurrentDate</b>: " + FormatDate(CurrentDate);
     msg = msg + "\nPlease Contact your Local HR for more Info.";
     MessageBoxAlert(msg, BootstrapDialog.TYPE_WARNING);
     return false;
     }*/

    if (LeaveStatus == 2) {
        //In-Process
        msg = "This Leave request is in the Process for Approval,\nAre you sure you want to Cancel it?";
    } else if (LeaveStatus == 3) {
        //Approved 
        msg = "This Leave request has already been approved,\nDo you still want to Cancel this Leave Request?";
    }

    MessageBoxEx(msg, BootstrapDialog.TYPE_DANGER, "CancelLeaveApplication");
}

function AcknowledgeCancelLeaveRequest(){
    MessageBoxEx("Are you sure you want to approve this Cancel Leave Request?",BootstrapDialog.TYPE_DANGER,"ExecuteCancelLeaveRequest","HideProgressBar");
}

function ExecuteCancelLeaveRequest() {
    var LeaveID = $("#_LeaveID").val();
    var LeaveIDMD5 = $("#_LeaveIDMD5").val();
    var CurrentUserID = $("#_UserID").val();
    var RecipientID = $("#_LeaveRecipient").val();
    console.log('here');
    $.ajax({
        type: "POST",
        url: "../class/ajax.php",
        data: {
            nIndex: 21, //Acknowledge Cancel Leave request
            Param: LeaveID + "|" + RecipientID 
        },
		fail: function () {
			console.log('failed');
		},
        success: function (data, response) {//it's always good to check server output when developing...
            var action = response;
			console.log(response);
            if (action) {
                document.location = "leave.php?id=" + LeaveIDMD5;
            }
        }
    });
}

function CancelLeaveApprove(comment) {
    var LeaveID = $("#_LeaveID").val();
    var ApplicantID = $("#_LeaveApplicant").val();
    
    ViewProgressBar();
    $.ajax({
        type: "POST",
        url: "../class/ajax.php",
        data: {
            nIndex: 20, //Cancel Leave request
            Param: LeaveID + "|" + ApplicantID + "|" + comment
        },
        success: function (data, response) {//it's always good to check server output when developing...
            var action = response;
            if (action) {
                location.reload();
            }
        }
    });
}

function CancelLeaveSubmission(comment){
    var LeaveID = $("#_LeaveID").val();
    var ApplicantID = $("#_LeaveApplicant").val();
    
    ViewProgressBar();
    $.ajax({
        type: "POST",
        url: "../class/ajax.php",
        data: {
            nIndex: 4, //Cancel Leave request
            Param: LeaveID + "|" + ApplicantID + "|" + comment
        },
        success: function (data, response) {//it's always good to check server output when developing...
            var action = response;
            if (action) {
                location.reload();
            }
        }
    });
}

function RejectCancelValidation() {
    MessageBoxEx("Are you sure you want to reject this cancellation?",BootstrapDialog.TYPE_DANGER,"RejectCancelLeaveRequest","HideProgressBar");
}

function RejectCancelLeaveRequest() {
    var LeaveID = $("#_LeaveID").val();
    var LeaveIDMD5 = $("#_LeaveIDMD5").val();
    var CurrentUserID = $("#_UserID").val();
    var RecipientID = $("#_LeaveRecipient").val();
    var Comment = $("#LeaveApproverComment").val();

    $.ajax({
        type: "POST",
        url: "../class/ajax.php",
        data: {
            nIndex: 44, //Reject cancellation request
            Param: LeaveID + "|" + LeaveIDMD5 + "|" + CurrentUserID + "|" + RecipientID + "|" + Comment 
        },
        success: function (data, response) {
            document.location = "leave.php?id=" + LeaveIDMD5;
        }
    });
}