/* 
 * Copyright(C)2016 A6178879
 *
 * All rights reserved Arkema Pte. Ltd.(international.ic.corp.local)
 * Javascript Class Developed by: Eng'r Nolan F. Sunico
 * Date Created: Mar 30, 2016
 * Time Created: 3:53:45 PM
 * Module: ButtonControl Class
 * Project: Arkema-Eleave
 */
ButtonClassTheme = {
      Default: 0,
      Primary: 1,
      Danger: 2
};
var ButtonControl=function(ButtonID, ButtonTheme,options){
   var ShowPrint=false;
   var ShowDelete=true;
   if(options){
      //with options
      if(options.ShowPrint!=undefined){
         ShowPrint=options.ShowPrint;
      }
      if(options.ShowDelete!=undefined){
         ShowDelete=options.ShowDelete;
      }
   }
   ButtonTheme=ButtonTheme.toLowerCase();
   ButtonControl.prototype.ButtonClassTheme=ButtonTheme;
   ButtonControl.prototype.ButtonID=ButtonID;
   //Create the Buttons
   var buttons="<button id='"+ButtonControl.prototype.ButtonID+"-Add' type='button' accesskey='N' class='btn btn-"+ButtonTheme+"'><i class='glyphicon glyphicon-file'></i> <u>N</u>ew</button> ";
   buttons+="<button id='"+ButtonControl.prototype.ButtonID+"-Edit' type='button' accesskey='I' class='btn btn-"+ButtonTheme+"'><i class='glyphicon glyphicon-edit'></i> Ed<u>i</u>t</button> ";
   buttons+="<button id='"+ButtonControl.prototype.ButtonID+"-Save' type='button' accesskey='S' class='btn btn-"+ButtonTheme+"'><i class='glyphicon glyphicon-floppy-disk'></i> S<u>a</u>ve</button> ";
   if(ShowDelete){
      buttons+="<button id='"+ButtonControl.prototype.ButtonID+"-Delete' type='button' accesskey='D' class='btn btn-"+ButtonTheme+"'><i class='glyphicon glyphicon-remove-sign'></i> <u>D</u>elete</button> ";
   }
   if(ShowPrint){
      buttons+="<button id='"+ButtonControl.prototype.ButtonID+"-Print' type='button' accesskey='P' class='btn btn-"+ButtonTheme+"'><i class='glyphicon glyphicon-print'></i> <u>P</u>rint</button> "; 
   }
   buttons+="<button id='"+ButtonControl.prototype.ButtonID+"-Cancel' type='button' accesskey='C' class='btn btn-"+ButtonTheme+"'><i class='glyphicon glyphicon-share-alt'></i> C<u>a</u>ncel</button> ";
   $("#"+ButtonControl.prototype.ButtonID).append(buttons);
   $(document).ready(function(){/* jQuery toggle layout */
      $("#"+ButtonControl.prototype.ButtonID+"-Add").on('click', function(){
          ButtonControl.prototype.newclick();
      });
      $("#"+ButtonControl.prototype.ButtonID+"-Edit").on('click', function(){
          ButtonControl.prototype.editclick();
      });
      $("#"+ButtonControl.prototype.ButtonID+"-Save").on('click', function(){
          ButtonControl.prototype.saveclick();
      });
      $("#"+ButtonControl.prototype.ButtonID+"-Print").on('click', function(){
          ButtonControl.prototype.printclick();
      });
      $("#"+ButtonControl.prototype.ButtonID+"-Delete").on('click', function(){
          ButtonControl.prototype.deleteclick();
      });
      $("#"+ButtonControl.prototype.ButtonID+"-Cancel").on('click', function(){
          ButtonControl.prototype.cancelclick();
      });
   });
};
//Prototyping
/**
 * 
 * @returns {undefined}
 */
ButtonControl.prototype.ButtonID=function(){};
/**
 * 
 * @returns {undefined}
 */
ButtonControl.prototype.ButtonClassTheme=function(){};
/**
 * 
 * @returns {undefined}
 */
ButtonControl.prototype.newclick=function(){
   try{
       var evt = $.Event('newclick');
       evt.cancel=false;
       $("#"+ButtonControl.prototype.ButtonID).trigger(evt);
       ButtonControl.prototype.EnableButton(!evt.cancel);
   }catch(err){
     //alert(err.message);
   }
};
/**
 * 
 * @returns {undefined}
 */
ButtonControl.prototype.editclick=function(){
   try{
       var evt = $.Event('editclick');
       evt.cancel=false;
       $("#"+ButtonControl.prototype.ButtonID).trigger(evt);
       ButtonControl.prototype.EnableButton(!evt.cancel);
   }catch(err){
     //alert(err.message);
   }
};
/**
 * 
 * @returns {undefined}
 */
ButtonControl.prototype.saveclick=function(){
   try{
       var evt = $.Event('saveclick');
       evt.cancel=false;
       $("#"+ButtonControl.prototype.ButtonID).trigger(evt);
       ButtonControl.prototype.EnableButton(evt.cancel);
   }catch(err){
     //alert(err.message);
   }
};
/**
 * 
 * @returns {undefined}
 */
ButtonControl.prototype.cancelclick=function(){
   try{
       var evt = $.Event('cancelclick');
       evt.cancel=false;
       $("#"+ButtonControl.prototype.ButtonID).trigger(evt);
       ButtonControl.prototype.EnableButton(evt.cancel);
   }catch(err){
     //alert(err.message);
   }
};
ButtonControl.prototype.deleteclick=function(){
   try{
       var evt = $.Event('deleteclick');
       evt.cancel=false;
       $("#"+ButtonControl.prototype.ButtonID).trigger(evt);
   }catch(err){
     //alert(err.message);
   }
};
/**
 * 
 * @returns {undefined}
 */
ButtonControl.prototype.printclick=function(){
   try{
       var evt = $.Event('printclick');
       evt.cancel=false;
       $("#"+ButtonControl.prototype.ButtonID).trigger(evt);
   }catch(err){
     //alert(err.message);
   }
};
/**
 * 
 * @param {Boolean} df
 * @returns {undefined}
 */
ButtonControl.prototype.EnableButton=function(df){
   try{
      $("#"+ButtonControl.prototype.ButtonID+"-Add").prop('disabled',df);
      $("#"+ButtonControl.prototype.ButtonID+"-Delete").prop('disabled',df);
      $("#"+ButtonControl.prototype.ButtonID+"-Edit").prop('disabled',df);
      $("#"+ButtonControl.prototype.ButtonID+"-Save").prop('disabled',true);
      $("#"+ButtonControl.prototype.ButtonID+"-Print").prop('disabled',df);
   }catch(err){
      //alert(err.message);
   }
};
