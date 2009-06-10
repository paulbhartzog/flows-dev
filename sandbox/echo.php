<?php
/*
 * ===========================================================================
 * Class:         [Enter the sdfcanonical name of this Flows component.]
 * Date Created:  [Enter the date created: "00/00/0000"]
 * Author:        [Enter the name of the author.]
 * Description:   [Enter a description of the contents of the file.]
 * Last Modified:   $Revision: [Enter the revision number.] $
 *                  $Author: [Enter the name of the author.] $
 *                  $Date: [Enter the Last Modified date.] $
 *
 * ===========================================================================
*/
/**
* [Enter a description of the following method for doc generator.]
* @param [Enter parameter name] [Enter a description of the parameter.]
* @param [Enter parameter name] [Can have many parameters like this.]
* @response [Enter a description of the response types.]
* @exception [Enter the type of error returned.  NOT IMPLEMENTED YET.]
*/

if($_GET) {
	foreach($_GET as $key => $value) {
		$incoming_array[$key] = $value;
	}
	if (array_key_exists("sip", $incoming_array)){
		header ("content-type: text/xml");
		$xml_output  = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
		$xml_output .= "<xml>\n"; 
		$xml_output .= "\t<canonical_name>flows_echo</canonical_name>\n";
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
	} else {
		if (array_key_exists("return_type", $incoming_array)){
			switch ($incoming_array["return_type"]) {
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
	$xml_output .= "\t<canonical_name>flows_echo</canonical_name>\n";
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

?>
