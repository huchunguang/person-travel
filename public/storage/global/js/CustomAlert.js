/* 
 * Copyright(C)2016 A6178879
 *
 * All rights reserved Arkema Pte. Ltd.(international.ic.corp.local)
 * Website Developed by: Eng'r Nolan F. Sunico
 * Date Created: Feb 25, 2016
 * Time Created: 1:17:59 PM
 * Module: CustomAlert
 * Project: Arkema-Eleave
 */
/**
 * @description Create a Bootstrap Alert Box Class.
 * @param {String} id
 * @returns {CustomAlert}
 */
var CustomAlert=function(id){
   CustomAlert.prototype.id=id;
};
/**
 * @description The Id of the main container of this Alert box.
 * @returns {String}
 */
CustomAlert.prototype.id=function(){};
/**
 * @description the Alert Box Content.
 * @returns {String}
 */
CustomAlert.prototype.Content=function(){};
/**
 * @description Set the Message that will appear on alert box.
 * @param {String} Message
 * @param {String} Response
 * @returns {String}
 */
CustomAlert.prototype.SetMessage=function(Message,Response){
   var div="<div class='alert alert-danger alert-dismissible' role='alert' style='font-size: 12px;margin-bottom: 6px'>\n";
   div+=" <button class='close' aria-label='Close' type='button' data-dismiss='alert'><span aria-hidden='true' data-toggle='tooltip' title='Close' style='margin-left: -50px'>×</span></button>\n";
   div+="<span><span class='glyphicon glyphicon-remove-sign' style='font-size:22px'></span>&nbsp;";
   div+="<strong>"+Message+"</strong><br>";
   div+=Response+"\n</span>\n</div>\n";
   CustomAlert.prototype.Content=div;
   return div;
};
/**
 * @description Show Alert with the given parameters.
 * @param {String} Message
 * @param {String} Response
 * @returns {Boolean}
 */
CustomAlert.prototype.Show=function(id,Message,Response){
   var M;
   var R;
   if(!Message){
      M="Something's went wrong";
   }else{
      M=Message;
   }
   if(!Response){
      R="Please Contact Administrator";
   }else{
      R=Response;
   }
   var Content=CustomAlert.prototype.SetMessage(M,R);
   $("#"+id).append(Content);
   $("#"+id).show();
   return true;
};
/**
 * @description Hides the Alert main Container
 * @returns {Boolean}
 */
CustomAlert.prototype.Hide=function(){
   //Hide the main container fo alert
   $("#"+CustomAlert.prototype.id).hide();
   //Clear the html content
   $("#"+CustomAlert.prototype.id).html("");
   return true;
};
