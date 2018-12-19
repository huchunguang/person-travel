<?php namespace App\Http\Traits;


trait GDI{
	static $SetHeight=180;
	static function getSizeByFixedWidth($CurrentHeight,$CurrentWidth,$newWidth){
		$ratio = $CurrentHeight / $CurrentWidth;
		$newHeight = $newWidth * $ratio;
		return $newHeight;
	}
	static function ImageToJpeg($img, $mime_type, $to=NULL){
		$image = NULL;
		switch ($mime_type){
			case 'image/jpeg':
				$image = \imagecreatefromjpeg($img);
				break;
			case 'image/gif':
				$image = \imagecreatefromgif($img);
				break;
			case 'image/png':
				$image = \imagecreatefrompng($img);
				break;
		}
		$w=imagesx($image);
		$h=imagesy($image);
		$new_w = GDI::$SetHeight;
		$new_h = intval(GDI::getSizeByFixedWidth($h,$w,$new_w));
		if (is_resource($image)){
			// Convert image to JPEG
			$new_image = imagecreatetruecolor($new_w, $new_h);
			imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
			imagejpeg($new_image, $to);
			imagedestroy($image);
		}
		return true;
	}
	static function ImageFromBlob($content, $mime_type='GDI/jpeg'){
		$result = '';
		if (!empty($mime_type) && !empty($content)){
			$result = 'data:'.$mime_type.';base64,'.base64_encode($content);
		}
		return $result;
	}
}