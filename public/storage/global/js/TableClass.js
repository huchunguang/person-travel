/* 
 * TABLE CLASS PLUGIN 1.0.0
 * Date Created: Feb 11, 2016
 * Time Created: 2:36:33 PM
 * Module: TableClass
 * Project: TableClass Plugin
 * Version 1.0.0
 * Description: This Class Module convert ordinary table into 
 * responsive table and purely Objected Oriented table
 * Requirements: This Table Classs uses Bootstrap plugins for designs.
 * Author: Eng'r Nolan F. Sunico
 */


// Customed Dispatcher ********************************************************/
/**
 * @description This is a customed Event Disparcher Class.
 * @returns {Dispatcher}
 */
function Dispatcher(){
	this.events=[];
};
/**
 * @description Add an Event Listener
 * @param {type} event
 * @param {type} callback
 * @returns {undefined}
 */
Dispatcher.prototype.addEventlistener=function(event,callback){
      this.events[event] = this.events[event] || [];
      if ( this.events[event] ) {
         this.events[event].push(callback);
      }
};
/**
 * @description Remove an Event Listener.
 * @param {type} event
 * @param {type} callback
 * @returns {Boolean}
 */
Dispatcher.prototype.removeEventlistener=function(event,callback){
   if ( this.events[event] ) {
      var listeners = this.events[event];
      for ( var i = listeners.length-1; i>=0; --i ){
	 if ( listeners[i] === callback ) {
	    listeners.splice( i, 1 );
	    return true;
	 }
      }
   }
   return false;
};
/**
 * @description Dispatched an specific event.
 * @param {type} event
 * @returns {undefined}
 */
Dispatcher.prototype.dispatch = function (event) {
   if (this.events[event]) {
      var listeners = this.events[event], len = listeners.length;
      while (len--) {
         listeners[len](this);	//callback with self
      }
   }
};

/*****************************************************************************/
var Table_Class_Selected_Row_Index;
var Table_Class_Current_Column_Index=0;
/**
 * 
 * @param {type} TableName
 * @returns {TableClass}
 * @description Create a Class from exisiting table
 * @author Eng'r Nolan F. Sunico
 */
var TableClass=function(TableName, TableClassTheme){
   this.TableClassTheme = {
      Default: 0,
      Primary: 1,
      Danger: 2
   };
   $('head').append('<link rel="stylesheet" href="../js/TableClass.css" type="text/css" />');
   //Dispatcher
   Dispatcher.call(this);
   //Private
   this.events=[];
   /**
    * @description The table rows.
    */
   //this.Rows;
   /**
    * @description Header Array.
    */
   this.header=[];
   /**
    * @description Table Object derivced from an exisiting table
    */
   this.Table=$("#"+TableName+">tbody");
   /**
    * 
    * @type @call;@arr;$
    * @description Table Rows
    */
   this.TableRows;
   /**
    * @description Table Cells.
    */
   this.Cells;
   /**
    * @description The Table Name of an exisiting table
    */
   TableClass.prototype.TableName=TableName;
   /**
    * @description The Current Row Index.
    */
   this.CurrentRowIndex=0;
   /**
    * @description The Selected Row Index.
    */
   this.Table_Class_Selected_Row_Index=0;
   //Iterating to exisiting table rows if theres any
   /**
    * @description The Table Rows object.
    */
   this.TableRows = $("#"+TableClass.prototype.TableName)[0];
   var TableRowsCount=$("#"+TableClass.prototype.TableName+">tbody>tr").length;
   var colCount=this.TableRows.rows[0].cells.length;
   TableClass.prototype.rows=$("#"+TableClass.prototype.TableName+">tbody>tr");
   TableClass.prototype.rowCount=TableClass.prototype.rows.length;
   var myRows = [];
   var $headers = $("th");
   var $rows = $("#"+TableClass.prototype.TableName+">tbody>tr").each(function(index) {
      $cells = $(this).find("td");
      myRows[index] = {};
      $cells.each(function(cellIndex) {
         myRows[index][$($headers[cellIndex]).html()] = $(this).html();
      });    
   });
   var myObj = {};
   myObj.myRows = myRows;
   TableClass.prototype.rowsToJSON=JSON.stringify(myObj);
   var myTheme="";
   if(!TableClassTheme){
      TableClassTheme=0;
   }
  switch(TableClassTheme){
     case 0:
        myTheme="btn-primary";
        break;
     case 1:
        myTheme="btn-danger";
        break;
     case 2:
        myTheme="btn-primary";
        break;
     default:
        myTheme="btn-default";
        break;     
  }
  TableClass.prototype.TableTheme=myTheme;
  //initialize 
  TableClass.prototype.IsDisabled=false;
  //Apply theme
  $("#"+TableClass.prototype.TableName+">thead>tr").addClass(myTheme);
  $("#"+TableClass.prototype.TableName).addClass("table table-bordered table-responsive table-striped table-hover");
   try{
   //Build an Array of headertext
   for(i=0;i<colCount;i++){
         var cell = this.TableRows.rows[0].cells[i]; // This is a DOM "TD" element
         this.header[i]=cell.innerHTML.toLowerCase();
   }
   for(var n=1;n<=TableRowsCount;n++){
      var row=this.TableRows.rows[n];
      var $row=$(row);
      $row.attr("id","TableClassRowID-"+n);
      $row.attr('onclick','TableClassSelectRow("'+TableClass.prototype.TableName+'",'+n+')');
      for(var i=0;i<colCount;i++){
         var cell = this.TableRows.rows[0].cells[i]; // This is a DOM "TD" element
         var $cell=$(cell);
         //Get the Style of the header and copy it to tbody td styles
         var csscal=$cell.css('text-align');
         var csshidden=$cell.css('display');
         var dtype=$cell.attr('datatype');
         var curCell=this.TableRows.rows[n].cells[i];
         var $curCell=$(curCell);
         var dt='';
         if(dtype){
            dt=dtype.toLowerCase();
         }
         switch(dt){
            case 'n':
               break;
            case 'n2':
               var nstr=TableClass.prototype.TableClassFormat($curCell.html(),2);
               $curCell.html(nstr);
               break;
            case 'n3':
               var nstr=TableClass.prototype.TableClassFormat($curCell.html(),3);
               $curCell.html(nstr);
               break;
            case 'n4':
               var nstr=TableClass.prototype.TableClassFormat($curCell.html(),4);
               $curCell.html(nstr);
               break;
            default:
               break;
         }
         $curCell.css('text-align',csscal);
         if(csshidden!=""){
            $curCell.css('display',csshidden);
         }
      }   
   }
   $(document).ready(function(){/* jQuery toggle layout */
     var Table=$("#"+TableName)[0];
     var colCountIndex=Table.rows[0].cells.length;
     var CurIndex=0;
     var CurColIndex=-1;
     $("#"+TableName+" tbody td").click(function() {    
          var col = parseInt($(this).index()) + 1;
          TableClass.prototype.ColumnID=col;
     });
     $("#"+TableName).on("keydown",function(evt){
         var CurrentRowsCount=$("#"+TableName+">tbody>tr").length; 
         var keypress=evt.which;
         //var stat=TableClass.prototype.IsDisabled;
         //alert(keypress);
         switch (keypress){
            case 37: //Arrow Left 
              CurIndex=TableClass.prototype.CurrentRowIndex;
              CurColIndex=Table_Class_Current_Column_Index;
              CurColIndex-=1;
              if(CurColIndex<0){
                 CurColIndex=0;
              }
              Table_Class_Current_Column_Index=CurColIndex;
              break;
            case 38: //Arrow UP
              CurIndex=TableClass.prototype.CurrentRowIndex-1;
              if(CurIndex<1){
                 CurIndex=1;
              }
              break;
            case 40: //Arrow Down
              CurIndex=TableClass.prototype.CurrentRowIndex+1;
              if(CurIndex>CurrentRowsCount){
                 CurIndex=CurrentRowsCount;
              }
              break;
           case 39: //Arrow Right
              CurIndex=TableClass.prototype.CurrentRowIndex;
              CurColIndex=Table_Class_Current_Column_Index;
              CurColIndex+=1;
              if(CurColIndex>=colCountIndex){
                 CurColIndex=colCountIndex-1;
              }
              Table_Class_Current_Column_Index=CurColIndex;
              break;
            case 46: //Delete key
              CurIndex=TableClass.prototype.CurrentRowIndex;
              if(CurIndex>CurrentRowsCount){
                 CurIndex=CurrentRowsCount;
              }
              TableClass.prototype.DeleteRow(CurIndex);
              CurIndex-=1;
              break;
         }
         //TableClassSelectRow(TableName,CurIndex);
         TableClass.prototype.TableName=TableName;
         TableClass.prototype.SelectRow(CurIndex);
         //TableClass.prototype.SelectColumn(TableName,CurIndex,CurColIndex);
         TableClass.prototype.CurrentRowIndex=CurIndex;
      });
     });
   }catch(err){
      //alert(err.message);
   }
};
/**
 * 
 * @param {type} RowIndex
 * @param {type} ColumnIndex
 * @param {type} Value
 * @returns {undefined}
 */
TableClass.prototype.TableCell=function(ColumnIndex,Value){
   var RowIndex=TableClass.prototype.CurrentRowIndex;
   var table=$("#"+TableClass.prototype.TableName)[0];
   var cell = table.rows[RowIndex].cells[ColumnIndex]; // This is a DOM "TD" element
   var $cell=$(cell);
   $cell.html(Value);
};
/**
 * @description The Table Theme
 * @returns {undefined}
 */
TableClass.prototype.TableTheme=function(){};
/**
 * @description The Table Name
 * @returns {undefined}
 */
TableClass.prototype.TableName=function(){};
/**
 * Specify whether this table is enabled or disabled
 * @returns {undefined}
 */
TableClass.prototype.IsDisabled=function(){};
/**
 * 
 * @returns {undefined}
 */
TableClass.prototype.ColumnID=function(){};
/**
 * The Current Row Index
 * @returns {undefined}
 */
TableClass.prototype.CurrentRowIndex=function(){};
/**
 * The Current Column Index
 * @returns {undefined}
 */
TableClass.prototype.CurrentColumnIndex=function(){};
/**
 * @description Enable/Disable table from accessing it and as well as the table events.
 * @returns {undefined}
 */
TableClass.prototype.Enable=function(df){
   TableClass.prototype.IsDisabled=!df;
   $("#"+TableClass.prototype.TableName+">thead>tr").removeClass();
   $("#"+TableClass.prototype.TableName+">tfoot>tr").removeClass();
   var fontsize=$("#"+TableClass.prototype.TableName).css('font-size');
   if(!df){
      $("#"+TableClass.prototype.TableName+">thead>tr").addClass("btn-defafult");
      $("#"+TableClass.prototype.TableName+">tfoot>tr").addClass("btn-defafult");
      $("#"+TableClass.prototype.TableName).removeClass("table-hover");
      $("#"+TableClass.prototype.TableName).css('cssText', 'font-size: '+fontsize+';cursor: not-allowed !important');
   }else{
      $("#"+TableClass.prototype.TableName+">thead>tr").addClass(TableClass.prototype.TableTheme);
      $("#"+TableClass.prototype.TableName+">tfoot>tr").addClass(TableClass.prototype.TableTheme);
      $("#"+TableClass.prototype.TableName).css('cssText', 'font-size: '+fontsize+';cursor: default !important');
   }
   //
};
/**
 * @description Converts table data row to JSON.
 * @returns {undefined}
 */
TableClass.prototype.rowsToJSON=function(){
   //
};
/**
 * @description Returns the number of rows on tbody.
 * @returns {$.length}
 */
TableClass.prototype.rowCount=function(){};
/**
 * @description returns the table rows collection.
 * @returns {undefined}
 */
TableClass.prototype.rows=function(){
   //
};
/**
 * @description Update Table Class Row
 * @returns {undefined}
 */
TableClass.prototype.UpdateTableRow=function(TableName){
   var TableRowsCount=$("#"+TableName+">tbody>tr").length;
   for(var n=1;n<=TableRowsCount;n++){
      var row=this.TableRows.rows[n];
      var $row=$(row);
      $row.attr("id","TableClassRowID-"+n);
      $row.attr('onclick','TableClassSelectRow("'+this.TableName+'",'+n+')');
      for(i=0;i<colCount;i++){
         var cell = this.TableRows.rows[0].cells[i]; // This is a DOM "TD" element
         var $cell=$(cell);
         //Get the Style of the header and copy it to tbody td styles
         var csscal=$cell.css('text-align');
         var dtype=$cell.attr('datatype');
         var curCell=this.TableRows.rows[n].cells[i];
         var $curCell=$(curCell);
         var dt='';
         if(dtype){
            dt=dtype.toLowerCase();
         }
         switch(dt){
            case 'n':
               break;
            case 'n2':
               var nstr=TableClass.prototype.TableClassFormat($curCell.html(),2);
               $curCell.html(nstr);
               break;
            case 'n3':
               var nstr=TableClass.prototype.TableClassFormat($curCell.html(),3);
               $curCell.html(nstr);
               break;
            case 'n4':
               var nstr=TableClass.prototype.TableClassFormat($curCell.html(),4);
               $curCell.html(nstr);
               break;
            default:
               break;
         }
         $curCell.css('text-align',csscal);
      }   
   } 
};
/**
 * @description Delete Row Event triggered when you delete a row
 * @param {type} index
 * @returns {undefined}
 */
TableClass.prototype.DeleteRow=function(index){
   try{
   var table = $("#" + this.TableName)[0];
   var evt = $.Event('DeleteRow');
   var cell=table.rows[index].cells;
   cell=TableClass.prototype.AddMethod(cell);
   evt.index = index;
   evt.cell=cell;
   /**
    * @description Proceed with deletion
    * @param {type} status
    * @returns {undefined}
    */
   evt.RemoveRow=function(){
      DeleteThisRow(this.TableName,index);
      //;
   };
   /**
    * 
    * @returns {undefined}
    */
   evt.HideRow=function(){
      TableClass.prototype.HideRow(index);
   };
   //trigger event
   $("#" + this.TableName).trigger(evt);
   }catch(err){
      //
   }
};
/**
 * @description Create RowChange Event Delegation.
 * @param {type} index
 * @returns {undefined}
 */
TableClass.prototype.RowChange=function(index){
   var table = $("#" + this.TableName)[0];
   var evt = $.Event('RowChange');
   var $tr=$("#" + this.TableName+' tbody tr td');
   $tr.removeClass("highlightcell");
   evt.index = index;
   evt.columnindex=TableClass.prototype.ColumnID-1;
   evt.disabled=TableClass.prototype.IsDisabled;
   var HeaderCell=table.rows[0].cells;
   HeaderCell=TableClass.prototype.AddMethod(HeaderCell);
   evt.HeaderCell=HeaderCell;
   var cells=table.rows[index].cells;
   var $mCell=$(cells[evt.columnindex]);
   $mCell.addClass("highlightcell");
   //Add Method to Cells Object
   cells=TableClass.prototype.AddMethod(cells);
   evt.cells=cells;
   TableClass.prototype.CurrentRowIndex=index;
   $("#" + this.TableName).trigger(evt);
};
/**
 * @description Build Method on cells object
 * @param {type} arr
 * @returns {unresolved}
 */
TableClass.prototype.AddMethod=function(arr){
   var cCount=arr.length;
   for(i=0;i<cCount;i++){
      var cellvalue=arr[i].innerHTML;
      var cvalue=cellvalue.replace(",","");
      if(!isNaN(cvalue)){
         arr[i].value=TableClass.prototype.TableClassToFloat(cvalue,2);
         arr[i].text=cellvalue;
         arr[i].FormatValue=TableClass.prototype.TableClassFormat(cvalue,2);
      }else{
         arr[i].text=cellvalue;
         arr[i].value=0;
         arr[i].FormatValue=0.00;
      }
   }
   //Return as cell object
   return arr;
};
TableClass.prototype.FormatTableCells=function(TableN,RowIndex){
      this.TableRows = $("#"+TableN)[0];
      var curCell=this.TableRows.rows[RowIndex].cells;
      var mcell=this.TableRows.rows[0].cells;
      var colCount=mcell.length;
      for(i=0;i<colCount;i++){
         var cell = mcell[i]; // This is a DOM "TD" element
         var $cell=$(cell);
         var $curCell=$(curCell[i]);
         //Get the Style of the header and copy it to tbody td styles
         var mStyle = TableClass.prototype.CSS($cell);
         var csscal=$cell.css('text-align');
         var dtype=$cell.attr('datatype');
         var dt='';
         if(dtype){
            dt=dtype.toLowerCase();
         }
         //alert(dt);
         switch(dt){
            case 'n':
               break;
            case 'n2':
               var nstr=TableClass.prototype.TableClassFormat($curCell.html(),2);
               $curCell.html(nstr);
               break;
            case 'n3':
               var nstr=TableClass.prototype.TableClassFormat($curCell.html(),3);
               $curCell.html(nstr);
               break;
            case 'n4':
               var nstr=TableClass.prototype.TableClassFormat($curCell.html(),4);
               $curCell.html(nstr);
               break;
            default:
               break;
         }
         $curCell.css('text-align',csscal);
         if(mStyle.display=='none;'){
            $curCell.css('display','none');
         }
      }   
};
/**
 * 
 * @param {type} a
 * @returns {Object}
 */
TableClass.prototype.CSS=function(a) {
   try{
    var sheets = document.styleSheets, o = {};
    for (var i in sheets) {
        var rules = sheets[i].rules || sheets[i].cssRules;
        for (var r in rules) {
            if (a.is(rules[r].selectorText)) {
                o = $.extend(o, TableClass.prototype.CSS2JSON(rules[r].style), TableClass.prototype.CSS2JSON(a.attr('style')));
            }
        }
    }
    return o;
   }catch(e){
     // alert(e.message);
   }
};
/**
 * 
 * @param {type} css
 * @returns {TableClass.prototype.CSS2JSON.s}
 */
TableClass.prototype.CSS2JSON=function(css) {
    var s = {};
    if (!css) return s;
    if (css instanceof CSSStyleDeclaration) {
        for (var i in css) {
            if ((css[i]).toLowerCase) {
                s[(css[i]).toLowerCase()] = (css[css[i]]);
            }
        }
    } else if (typeof css == "string") {
        css = css.split("; ");
        for (var i in css) {
            var l = css[i].split(": ");
            s[l[0].toLowerCase()] = (l[1]);
        }
    }
    return s;
};
/**
 * 
 * @returns {$}
 * @description Insert New Row on an existing table object with array of Objects 
 * separated with commas can be variable, object or control of values.
 * @example [TableInstance].InsertRow($("#selector").val(),variable....).
 * @author Eng'r Nolan F. Sunico
 * @param {type} Object Array of Objects
 * @author Eng'r Nolan F. Sunico
 */
TableClass.prototype.InsertRow = function () {
   var table = $("#" + this.TableName)[0];
   var tablerowcount = $("#" + TableClass.prototype.TableName + ">tbody>tr").length;
   //this.rowCount=tablerowcount;
   //Get the Array of columns
   var TableCellArray = arguments;
   // Get the number of cell array
   var CellNumber = arguments.length;
   //Get the total rows in tbody
   var TotalRow = $("#" + TableClass.prototype.TableName + ">tbody>tr").length + 1;
   TableClass.prototype.CurrentRowIndex=TotalRow;
   var Row = "<tr id='TableClassRowID-" + TotalRow + "' onclick='TableClassSelectRow(\"" + this.TableName + "\"," + TotalRow + ")'>\n";
   for (i = 0; i < CellNumber; i++) {
      Row += "<td>" + TableCellArray[i] + "</td>\n";
   }
   Row += "</tr>\n";
   if (this.Table.length <= 0) {
      this.Table = $("#" + this.TableName);
      this.Table.append("<tbody></tbody>");
      this.Table = $("#" + this.TableName + ">tbody");
   }
   this.Table.append(Row);
   this.Rows = table.rows[TotalRow];
   var mcells = table.rows[tablerowcount].cells;
   mcells=TableClass.prototype.AddMethod(mcells);
   this.cells=mcells;
   //Format Cells
   TableClass.prototype.FormatTableCells(this.TableName,TotalRow);
   //Activate Custom Event RowChange
   TableClass.prototype.RowChange(TotalRow);
   //Update RowCount
   TableClass.prototype.rowCount=TotalRow;
   return this.Rows;
};
/**
 * 
 * @returns {Boolean}
 * @description Delete All Rows on tbody from an existing table object.
 * @author Eng'r Nolan F. Sunico
 */
TableClass.prototype.DeleteAllRows = function () {
   var ret=false;
   try{
      $("#" + this.TableName + ">tbody>tr").remove();
      TableClass.prototype.CurrentRowIndex = 0;
      //TableClass.prototype.rowCount=0;
      ret=true;
   }catch(err){
      alert(err.message);
      ret=false;
   }
   return ret;
};
/**
 * 
 * @param {type} HeaderText
 * @returns {TableClass@pro;TableRows@arr;rows@arr;cells@pro;innerHTML|String}
 * @description Get the Current Cell value.
 * @author Eng'r Nolan F. Sunico
 */
TableClass.prototype.CurrentCell = function (HeaderText,RowIndex) {
   var ret = "";
   var index=0;
   if(RowIndex==undefined){
      RowIndex=TableClass.prototype.CurrentRowIndex;
   }
   try {
      if(isNaN(HeaderText)){
         index = this.header.indexOf(HeaderText.toLowerCase()); // 1
      }else{
         index=HeaderText;
      }
      if (index >= 0) {
         ret = this.TableRows.rows[RowIndex].cells[index].innerHTML;
      } else {
         alert("We could not find header '" + HeaderText + "'!");
      }
   } catch (err) {
      //nothing
   }
   return ret;
};
/**
 * @description Hide the specific row.
 * @param {type} RowIndex
 * @returns {undefined}
 */
TableClass.prototype.HideRow=function(RowIndex){
   HideThisRow(RowIndex);
};
/**
 * 
 * @returns {Boolean}
 * @description Deletes the selected current row from table object.
 * @author Eng'r Nolan F. Sunico
 */
TableClass.prototype.DeleteCurrentRow = function () {
    TableClass.prototype.DeleteRow(TableClass.prototype.CurrentRowIndex);
};
/**
 * @description Select a row from the given row index.
 * @param {integer} RowIndex
 * @returns {Boolean}
 */
TableClass.prototype.SelectRow=function(RowIndex){
   try{
      var table = $("#" + this.TableName)[0];
      $("#" + this.TableName + ">tbody>tr").removeClass("highlight");
      //hilight-row
      $("#TableClassRowID-" + RowIndex).addClass("highlight");
      TableClass.prototype.CurrentRowIndex = RowIndex;
      this.CurrentRowIndex = TableClass.prototype.CurrentRowIndex;
      this.Rows = table.rows[RowIndex];
      //Activate Custom Event RowChange
      TableClass.prototype.RowChange(RowIndex);
      TableClass.prototype.SelectColumn(this.TableName,RowIndex,0);
   }catch(err){
      alert(err.message);
   }
   return this.Rows;
};
/*
 * 
 * @param {type} ColumnIndex
 * @param {type} ColumnRefValue
 * @returns {Number}
 */
TableClass.prototype.SearchRow=function(ColumnIndex,ColumnRefValue){
    var returnValue=0;
    try{
      var SearchTableRows = $("#"+TableClass.prototype.TableName)[0];
      var SearchRowCount = $("#" + TableClass.prototype.TableName + ">tbody>tr").length;
      for(var i=1;i<=SearchRowCount;i++){
        var curCell=SearchTableRows.rows[i].cells;
        var $curCell=$(curCell[ColumnIndex]);
        var ColumnValue=$curCell.html();
        if(ColumnValue==ColumnRefValue){
            TableClass.prototype.SelectRow(i);
            returnValue= i;
            return returnValue;
        }
      }
      return returnValue;
   }catch(err){
       alert(err.message);
   }
};
TableClass.prototype.SelectColumn=function(TableName,RowIndex,ColumnIndex){
   try{
      //$("#"+TableName+">tbody>tr>td").removeClass("highlightcell");
      //$('#'+TableName+' tr').eq(RowIndex).find('td').eq(ColumnIndex).addClass("highlightcell");
      //TableClass.prototype.CurrentColumnIndex=ColumnIndex;
      //TableClass.prototype.CurrentRowIndex=RowIndex;
   }catch(err){
      alert(err.message);
   }
   return this.Rows;
};
/**
 * @description Format Value to decimal Places.
 * @param {type} number
 * @param {type} decimalplaces
 * @returns {String|TableClass.prototype.TableClassFormat.decimalcharacter|TableClass.prototype.TableClassFormat.integer|TableClass.prototype.TableClassFormat.strnumber|TableClass.prototype.TableClassFormat.fraction}
 */
TableClass.prototype.TableClassFormat=function(number,decimalplaces){
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
};
/**
 * @description Convert String values into valid numeric value
 * @param {type} str
 * @param {type} decimalForm
 * @returns {TableClass.prototype.TableClassToFloat.v}
 */
TableClass.prototype.TableClassToFloat=function(str, decimalForm){
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
};
/*******************************************************************************************/
function HideThisRow(RowIndex){
   var RowIndexToHide = RowIndex;
      if (RowIndexToHide > 0) {
         $("#TableClassRowID-" + RowIndexToHide).hide();
      }
}
function DeleteThisRow(TableName,RowIndex){
   var ret=true;
   try {
      var RowIndexToDelete = RowIndex;
      if (RowIndexToDelete > 0) {
         $("#TableClassRowID-" + RowIndexToDelete).remove();
         RowIndexToDelete -= 1;
      }
      //Activate Custom Event RowChange
      TableClass.prototype.RowChange(RowIndexToDelete);
      TableClass.prototype.UpdateTableRow(TableName);
   } catch (err) {
      alert(err.message);
      ret=false;
   }
   return ret;
}
/**
 * 
 * @param {type} TableName
 * @param {type} i
 * @returns {Boolean}
 * @description Select a table class Row.
 * @author Eng'r Nolan F. Sunico
 */
function TableClassSelectRow(TableName, i) {
   if (!TableClass.prototype.IsDisabled) {
      //Unselect selected row
      $("#" + TableName + ">tbody>tr").removeClass("highlight");
      //hilight-row
      $("#TableClassRowID-" + i).addClass("highlight");
      TableClass.prototype.CurrentRowIndex = i;
      TableClass.CurrentRowIndex = TableClass.prototype.CurrentRowIndex;
      TableClass.prototype.TableName = TableName;
      TableClass.prototype.SelectRow(i);
   }
   return true;
};

function TableClassLeft(str,len){
   //var l=str.length;
   var ret=str.substring(0, len);
   return ret;
}
function TableClassRight(str,len){
   var l=str.length;
   var ret=str.substring(l, len);
   return ret;
}
function TableClassStrlen(str){
    var l=str.length;
    return l;
}
