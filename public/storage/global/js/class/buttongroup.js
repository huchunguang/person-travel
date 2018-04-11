/* 
 * Copyright(C)2016 A6178879
 *
 * All rights reserved Arkema Pte. Ltd.(international.ic.corp.local)
 * Website Developed by: Eng'r Nolan F. Sunico
 * Date Created: Mar 31, 2016
 * Time Created: 9:11:13 AM
 * Class: buttongroup Class
 * Project: Arkema-Eleave
 */

(function ($) {
   $.fn.buttongroup = function (options) {
      try{
      var Theme = "";
      var settings = $.extend({
         // These are the defaults.
         ModuleName: 'Record',
         ButtonTheme: 'primary',
         ShowPrint: false,
         ShowDelete: true,
         ShowCancel: true,
         ShowExtraButton: false,
         ShowNew: true,
         ShowEdit: true,
         ShowLine: false,
         ShowSave: true,
         DataPlacement: "bottom",
         SaveLabel: "S<u>a</u>ve",
         DeleteLabel: "<u>D</u>elete",
         EditLabel: "Ed<u>i</u>t",
         PrintLabel: " <u>P</u>rint",
         NewLabel: " <u>N</u>ew",
         PrintTitle: "Print Record",
         DeleteTitle: "Delete Record",
         EditTitle: "Edit Record",
         AddIcon: 'fa fa-plus',
         EditIcon: 'fa fa-pencil',
         SaveIcon: 'fa fa-save',
         DeleteIcon: 'fa fa-trash-o',
         PrintIcon: 'fa fa-print',
         ExtraIcon: 'fa fa-reorder',
         CancelIcon: 'fa fa-share',
         CancelLabel: 'C<u>a</u>ncel',
         ExtraLabel: 'E<u>x</u>tra',
         CancelTitle: 'Cancel Operations'
      }, options);
      Theme=settings.ButtonTheme;
      var id=this.attr('id');
      //Create the Buttons
      var buttons="";
//      if(settings.ShowLine){
//          buttons +="<hr style='height:1px;border-top: 1px solid #7f7f7f;margin-top: 5px; margin-bottom: 5px;'>";
//      }
                                                                                        
      if (settings.ShowNew) {
          buttons += "<button id='"+id+"-Add' type='button' accesskey='N' class='btn blue-steel'><i class='"+settings.AddIcon+"'></i> "+settings.NewLabel+"</button> ";
      }
      if(settings.ShowEdit){
          buttons += "<button id='"+id+"-Edit' type='button' accesskey='I' class='btn yellow-casablanca'><i class='"+settings.EditIcon+"'></i> "+settings.EditLabel+"</button> ";
      }
      if(settings.ShowSave){
          buttons += "<button id='"+id+"-Save' disabled type='button' accesskey='S' class='btn green-jungle'><i class='"+settings.SaveIcon+"'></i>  "+settings.SaveLabel+"</button> ";
      }
      if (settings.ShowDelete) {
         buttons += "<button id='"+id+"-Delete' type='button' accesskey='D' class='btn red-mint'><i class='"+settings.DeleteIcon+"'></i> "+settings.DeleteLabel+"</button> ";
      }
      if (settings.ShowPrint) {
         buttons += "<button id='"+id+"-Print' type='button' accesskey='P' class='btn btn-" + Theme + "'><i class='"+settings.PrintIcon+"'></i> "+settings.PrintLabel+"</button> ";
      }
      if(settings.ShowCancel){
         buttons += "<button id='"+id+"-Cancel' type='button' accesskey='C' class='btn default'><i class='"+settings.CancelIcon+"'></i> "+settings.CancelLabel+"</button> ";
      }
      if(settings.ShowExtraButton){
         buttons += "<button id='"+id+"-Extra' type='button' accesskey='C' class='btn  btn-" + Theme + "'><i class='"+settings.ExtraLabel+"'></i> "+settings.ExtraLabel+"</button> "; 
      }
//      if(settings.ShowLine){
//          buttons +="<hr style='height:1px;border-top: 1px solid #7f7f7f;margin-top: 5px; margin-bottom: 5px;'>";
//      }
      //Append the Button
      this.append(buttons);
      //Build the event
      $('#'+id+'-Add').click(function(e) {
          newclick();
      });
      $('#'+id+'-Edit').click(function(e) {
          editclick();
      });
      $('#'+id+'-Save').click(function(e) {
          saveclick();
      });
      $('#'+id+'-Print').click(function(e) {
          printclick();
      });
      $('#'+id+'-Delete').click(function(e) {
          deleteclick();
      });
      $('#'+id+'-Cancel').click(function(e) {
          cancelclick();
      });
      $('#'+id+'-Extra').click(function(e) {
          extraclick();
      });
      //return the control
      return;
   }catch(err){
      alert(err.message);
   }
      //Functions
      function EnableSave(){
         $("#"+id+"-Save").prop('disabled',false);
      }
      function newclick(){
         var evt = $.Event('newclick');
         evt.cancel=false;
         $("#"+id).trigger(evt);
         evt.Enable=function(df){
            enablebutton(!df);
         };
         enablebutton(!evt.cancel);
      };
      function editclick(){
         var evt = $.Event('editclick');
         evt.cancel=false;
         $("#"+id).trigger(evt);
         enablebutton(!evt.cancel);
      };
      function printclick(){
         var evt = $.Event('printclick');
         evt.cancel=false;
         $("#"+id).trigger(evt);
      };
      function deleteclick(){
         var evt = $.Event('deleteclick');
         evt.cancel=false;
         $("#"+id).trigger(evt);
         enablebutton(evt.cancel);
      };
      function saveclick(){
         var evt = $.Event('saveclick');
         evt.cancel=false;
         $("#"+id).trigger(evt);
         $('#'+id+'-Save').prop('disabled',false);
      };
      function cancelclick(){
         var evt = $.Event('cancelclick');
         evt.cancel=false;
         $("#"+id).trigger(evt);
         enablebutton(evt.cancel);
      };
      function extraclick(){
         var evt = $.Event('extraclick');
         evt.cancel=false;
         $("#"+id).trigger(evt);
      };
      function enablebutton(df){
         $("#"+id+"-Add").prop('disabled',df);
         $("#"+id+"-Delete").prop('disabled',df);
         $("#"+id+"-Edit").prop('disabled',df);
         $("#"+id+"-Save").prop('disabled',true);
         $("#"+id+"-Print").prop('disabled',df);
      }
   };
}(jQuery));

