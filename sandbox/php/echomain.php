<?php
main();
function main(){
	/**
	* $CanonicalName:				blah $
	* $RequestTypes:				blah $
	* $ResponseTypes:				blah $
	* $Parameters:					blah $
	* $Usage:						blah $

	*/
	/**
	*/
	function test(){
		// does nothing
	}
	
	if($_GET) {
		foreach($_GET as $key => $value) {
			$incoming_array[$key] = $value;
		}
		if (array_key_exists("sip", $incoming_array)){
			header ("content-type: text/xml");
			$xml_output  = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
			$xml_output .= "<xml>\n"; 
			$xml_output .= "\t<canonical_name>http://flows.panarchy.com/sandbox/echosss.php</canonical_name>\n";
			$xml_output .= "\t<request_types>\n";
			$xml_output .= "\t\t<request_type>HTTP GET</request_type>\n";
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
		} else {
			if (array_key_exists("response_type", $incoming_array)){
				switch ($incoming_array["response_type"]) {
					case "xml":
						header ("content-type: text/xml");
						$xml_output  = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
						$xml_output .= "<xml>\n"; 
						foreach ($incoming_array as $key => $value){
						    $xml_output .= "\t<received>" . htmlspecialchars($key . " = " . $value) . "</received>\n";
						}
						$xml_output  .=  "</xml>\n";
						echo $xml_output; 
						break;
					case "html":
						header('Content-Type: text/html; charset=iso-8859-1');
						foreach ($incoming_array as $key => $value){
						    $html_output .= "\t" . htmlspecialchars($key . " = " . $value) . "<br />\n";
						}
						echo $html_output; 
						break;
				}
					
			}
		}
	} else {
		header ("content-type: text/xml");
		$xml_output  = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
		$xml_output .= "<xml>\n"; 
		$xml_output .= "\t<canonical_name>http://flows.panarchy.com/sandbox/echo.php</canonical_name>\n";
		$xml_output .= "\t<display_name>Echo</display_name>\n";
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
	}

}

?>
