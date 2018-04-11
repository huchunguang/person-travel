/* JavaScript Document  
Javascript Class Created by Eng'r Nolan F. Sunico
November 9, 2014  - 4:23 PM
*/
/**
 * @description XMl Writer Class
 * @returns {XMLWriter}
 */
function XMLWriter()
{
    var header='<?xml version="1.0" encoding="utf-8" ?>\n';
    this.mXML=[];
    this.Nodes=[];
    this.State="";
    /**
     * @description Format XML
     * @param {type} Str
     * @returns {String}
     */
    this.FormatXML = function(Str){
        if (Str){
	    return Str.replace(/&/g, "&amp;").replace(/\"/g, "&quot;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
	}else{
            return "";
	}
        
    };
    /**
     * @description Start of the beginning of an XML Node
     * @param {type} Name
     * @returns {undefined}
     */
    this.BeginNode = function(Name){
        if (!Name) return;
        if (this.State=="beg") this.mXML.push(">\n");
        this.State="beg";
        this.Nodes.push(Name);
        this.mXML.push("<"+Name);
    };
    /**
     * @description End of an XML Node
     * @returns {undefined}
     */
    this.EndNode = function(){
        if (this.State=="beg"){
            this.mXML.push("/>\n");
            this.Nodes.pop();
        }
        else if (this.Nodes.length>0)
            this.mXML.push("</"+this.Nodes.pop()+">\n");
        this.State="";
    };
    /**
     * @description Creates an Attribute for XML
     * @param {type} Name
     * @param {type} Value
     * @returns {undefined}
     */
    this.Attrib = function(Name, Value){
        if (this.State!="beg" || !Name) return;
        this.mXML.push(" "+Name+"=\""+this.FormatXML(Value)+"\"");
    };
    /**
     * @description Writes an XML String
     * @param {type} Value
     * @returns {undefined}
     */
    this.WriteString = function(Value){
        if (this.State=="beg") this.mXML.push(">\n");
        this.mXML.push(this.FormatXML(Value.toString()));
        this.State="";
    };
    /**
     * @description An XML Node
     * @param {type} Name
     * @param {type} Value
     * @returns {undefined}
     */
    this.Node = function(Name, Value){
        if (!Name) return;
        if (this.State=="beg") this.mXML.push(">\n");
        this.mXML.push((Value=="" || !Value)?"<"+Name+"/>\n":"<"+Name+">"+this.FormatXML(Value.toString())+"</"+Name+">\n");
        this.State="";
    };
    /**
     * @description Close an XML Document
     * @returns {undefined}
     */
    this.Close = function(){
        while (this.Nodes.length>0)
            this.EndNode();
        this.State="closed";
    };
    /**
     * Push an XML Header
     */
    this.mXML.push(header);
    /**
     * @description Joins XML Nodes as one string of XML Structure
     * @returns {XMLWriter@pro;mXML@call;join}
     */
    this.xml = function(){
        return this.mXML.join("");
    };
}