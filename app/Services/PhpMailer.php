<?php
namespace App\Services;


use App\Contacts\SystemMail;

class PhpMailer implements SystemMail{
	//Private
	private $Recipient;
	private $headers;
	private $Subject;
	public $Body;
	/**
	 *
	 * @param type $To Recipient if mulitiple should be separated by comma
	 * @param type $Subject The Subject of Email this is required
	 * @param type $Body The Body of Message
	 * @param type $CC Carbon Copy to
	 * @param type $BCC Blind Carbon Copy it does not appeared on header
	 * @param type $HighPriority Specified whether this email is in Priosity or not
	 * @param type $ApplicationName The Name of the Application default is 'Arkema-Eclaim'
	 * @param type $Attachment Specify if the email contained an attachment which is the path of file
	 */
	function __construct($To,$Subject, $Body, $CC='', $BCC='', $HighPriority=false, $ApplicationName='Arkema-ELeave',$Attachment=''){
		$sender=$ApplicationName;
		$this->headers='From: ' . $sender . "\r\n";
		if ($CC!=''){
			$this->headers.= 'CC: ' .$CC . "\r\n";
		}elseif ($BCC!=''){
			$this->headers.= 'BC: ' .$BCC . "\r\n";
		}
		if ($HighPriority){
			$this->headers .= "X-Priority: 1 (Highest)\r\n";
			$this->headers .= "X-MSMail-Priority: High\r\n";
			$this->headers .= "Importance: High\r\n";
		}
		$uid = md5(uniqid(time()));
		$random_hash = md5(date('r', time()));
		$this->headers.="MIME-Version: 1.0\r\n";
		//$this->headers.="Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
		// $this->headers.="Content-Type: text/html; charset=ISO-8859-1\r\n";
		//$this->headers.="Content-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"";
		// define('End_Line', '\r\n');//End line
		if ($Attachment!=''){
			$file_size = filesize($Attachment);
			$handle = fopen($Attachment, "r");
			$content = fread($handle, $file_size);
			fclose($handle);
			$filename=basename($Attachment);
			$FileContent = chunk_split(base64_encode($content));
			$this->headers.="Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
			$this->headers.="This is a multi-part message in MIME format.\r\n";
			$this->headers.="--".$uid."\r\n";
			$this->headers.="Content-type:text/plain; charset=iso-8859-1\r\n";
			//$this->headers.="Content-Type: text/html; charset=ISO-8859-1\r\n";
			$this->headers.="Content-Transfer-Encoding: 7bit\r\n\r\n";
			$this->headers.=$Body."\r\n\r\n";
			$this->headers.="--".$uid."\r\n";
			$this->headers.="Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
			$this->headers.="Content-Transfer-Encoding: base64\r\n";
			$this->headers.="Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
			$this->headers.=$FileContent."\r\n\r\n";
			$this->headers.="--".$uid."--";
			$this->Body="";
		}else{
			$this->headers.="Content-Type: text/html; charset=ISO-8859-1\r\n";
			$this->Body=$Body;
		}
		//
		$this->Subject=$Subject;
		$this->Recipient=$To;
	}
	/**
	 *
	 * @return TRUE if Mail is Successful or else False when failed
	 */
	function SendMail(){
		$Success=1;
		//echo $this->headers;
		$errLevel = error_reporting(E_ALL ^ E_NOTICE);  // suppress NOTICEs
		if (@mail($this->Recipient,$this->Subject,$this->Body,$this->headers)){
			//Successful
			$Success=1;
		}else{ //Failed
			$Success=-1;
		}
		error_reporting($errLevel);  // restore old error levels
		return $Success;
	}
}