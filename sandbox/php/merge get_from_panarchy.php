<?php

if($_GET) {
	foreach($_GET as $key => $value) {
		$incoming_array[$key] = $value;
	}
	if (array_key_exists("sip", $incoming_array)){
		header ("content-type: text/xml");
		$xml_output  = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
		$xml_output .= "<xml>\n"; 
		$xml_output .= "\t<canonical_name>flows_get</canonical_name>\n";
		$xml_output .= "\t<display_name>Get</display_name>\n";
		$xml_output .= "\t<version>2009/06/02</version>\n";
		$xml_output .= "\t<request_types>\n";
		$xml_output .= "\t\t<request_type>REST</request_type>\n";
		$xml_output .= "\t</request_types>\n";
		$xml_output .= "\t<response_types>\n";
		$xml_output .= "\t\t<response_type>XML</response_type>\n";
		$xml_output .= "\t\t<response_type>HTML</response_type>\n";
		$xml_output .= "\t</response_types>\n";
		$xml_output .= "\t<usage>
		This Flows component accepts REST requests and retrieves data from a \"Hello World\" Flows component.
	</usage>\n";
	$xml_output  .=  "</xml>\n";
	echo $xml_output; 
	} else {
		// this gets some remote content
//		$dir_path = str_replace( $_SERVER['DOCUMENT_ROOT'], "", dirname(realpath(__FILE__)) ) . DIRECTORY_SEPARATOR; 
//		$rest_url = "http://" . $_SERVER["SERVER_NAME"] . $dir_path . "hello_world.php";
		$rest_url = "http://flows.panarchy.com/sandbox/hello_world_from_panarchy.php";
		$result = file_get_contents($rest_url);
		// end remote content
		if (array_key_exists("return_type", $incoming_array)){
			switch ($incoming_array["return_type"]) {
				case "xml":
					header ("content-type: text/xml");
					$xml_output  = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
					$xml_output .= "<xml>\n"; 
					foreach ($incoming_array as $key => $value){
					    $xml_output .= "\t<received>" . htmlspecialchars($key . " = " . $value) . "</received>\n";
					}
					$xml_output  .=  "<remote_content>\n";
					$xml_output  .=  $result."\n";
					$xml_output  .=  "</remote_content>\n";
					$xml_output  .=  "</xml>\n";
					echo $xml_output; 
					break;
				case "html":
					header('Content-Type: text/html; charset=iso-8859-1');
					foreach ($incoming_array as $key => $value){
					    $html_output .= "\t" . htmlspecialchars($key . " = " . $value) . "<br />\n";
					}
				    $html_output .= "\tRemote Content:  " . htmlspecialchars($result) . "<br />\n";
					echo $html_output; 
					break;
			}
				
		}
	}
}


?>
