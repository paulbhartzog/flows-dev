<?php
if (!$_GET){
		header ("content-type: text/xml");
	$xml_output  = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
	$xml_output .= "<xml>\n"; 
	$xml_output .= "\t<canonical_name>http://flows.panarchy.com/sandbox/png_to_jpg.php</canonical_name>\n";
	$xml_output .= "\t<display_name>PNG to JPG</display_name>\n";
	$xml_output .= "\t<version>2009/06/02</version>\n";
	$xml_output .= "\t<request_types>\n";
	$xml_output .= "\t\t<request_type>REST</request_type>\n";
	$xml_output .= "\t</request_types>\n";
	$xml_output .= "\t<response_types>\n";
	$xml_output .= "\t\t<response_type>XML</response_type>\n";
	$xml_output .= "\t\t<response_type>HTML</response_type>\n";
	$xml_output .= "\t</response_types>\n";
	$xml_output .= "\t<usage>
	This Flows component accepts REST requests and returns whatever data the component received with the request.
	</usage>\n";
	$xml_output  .=  "</xml>\n";
	echo $xml_output; 
	exit;
}

$type = isset($_GET['type'])? htmlentities($_GET['type']) : 'jpg';
$url = isset($_GET['url'])? realpath($_GET['url']) : '';
$url = "../images/" . $url;
$color = isset($_GET['color'])? $_GET['color']: 'ffffff';

$file = explode('.', basename($url));
$image_name = $file[0];
$image_output = "{$image_name}.{$type}";
list($sx, $sy) = getimagesize($url);

//colored background image
$bg_image = imagecreatetruecolor($sx,$sy);
list($R, $G, $B)= (hex2rgb($color));
$mycolor = ImageColorAllocate($bg_image, $R,$G,$B);
imagefill($bg_image, 0, 0, $mycolor);

//the 24bit png with an alpha channel
$image = imagecreatefrompng($url);
imagealphablending($image, false);
imagesavealpha($image, true);

imagecopy($bg_image, $image, 0, 0, 0, 0, $sx, $sy);

header('Content-type:image/jpeg');
imagejpeg($bg_image,'',95);
imagedestroy($bg_image);
imagedestroy($image);

function &hex2rgb($hex)
{
if (0 === strpos($hex, '#')) {
$hex = substr($hex, 1);
} else if (0 === strpos($hex, '&H')) {
$hex = substr($hex, 2);
}

$cutpoint = ceil(strlen($hex) / 2)-1;
$rgb = explode(':', wordwrap($hex, $cutpoint, ':', $cutpoint), 3);

$rgb[0] = (isset($rgb[0])? hexdec($rgb[0]) : 0);
$rgb[1] = (isset($rgb[1])? hexdec($rgb[1]) : 0);
$rgb[2] = (isset($rgb[2])? hexdec($rgb[2]) : 0);

return $rgb;
}
?> 