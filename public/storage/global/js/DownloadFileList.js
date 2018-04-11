/* 
 * Arkema Pte Ltd
 * Website Developed by: Nolan F. Sunico
 * Date Created: Sep 29, 2015
 * Time Created: 9:17:00 AM
 * Module: DownloadFileList
 * Project: eclaim
 */
function DownloadFileList(){
   this.row='';
   /**
    * 
    * @param {type} Filename Filename of a File with Fullpath
    * @param {type} FileSize Size of a File
    * @returns {undefined}
    */
   this.AddRow=function(Filename, FileSize, urlPath,id){
      var OrigFname=GetFileNameOnly(Filename);
      var ext=Filename.split('.').pop();//Right(Fname,3);
      var flen=OrigFname.length;
      var xFilename=Left(OrigFname,flen-(ext.length+1));
      OrigFname=id+'-'+OrigFname;
      var OnClickDel='onclick="DeleteFiles(\''+OrigFname+'\')"';
       var Fname=OrigFname.split(' ').join('+');
      var URLDownload='../pages/download.php?file='+Fname;
      //var URLView='../DocViewer/#../attachment/'+Fname;
      var URLView='';
      switch(ext){
        case 'pdf':
          URLView="../pages/viewer.php?f="+Fname+"&tk=c4ca4238a0b923820dcc509a6f75849b";
          break;
        default:
          URLView='../uploads/'+OrigFname;
          break;
      }
      //var URLDelete='../pages/delete.php?file='+Fname;
      this.row+='<tr class="DownloadRowTools">\n';
      this.row+='<td style="width: 20px"><input type="checkbox" class="DownloadCheckbox" data-toggle="tooltip" data-placement="bottom" title="Select This File"></td>\n';
      this.row+='<td>'+xFilename+'.'+ext+' '+FileSize+'</td>\n';
      this.row+='<td></td>\n';
      this.row+='<td><a href="'+URLView+'" target="_blank" data-toggle="tooltip" data-placement="bottom" title="View This File" class="DownloadHideTools glyphicon glyphicon-zoom-in"></span></td>\n';
      this.row+='<td><a href="'+URLDownload+'" data-toggle="tooltip" data-placement="bottom" title="Download This File" class="DownloadHideTools glyphicon glyphicon-save"></a></td>\n';
      this.row+='<td><a href="#" '+OnClickDel+' data-toggle="tooltip" data-placement="bottom" title="Delete This File" class="DownloadHideTools glyphicon glyphicon-flash"></a></td>\n';
      this.row+='<td></td>\n';
      this.row+='</tr>\n';
   };
   this.AppendToTable=function(tblName){

      $("#"+tblName+" tbody").append(this.row);
   };
}
