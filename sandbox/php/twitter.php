<?php

if($_GET) {
	foreach($_GET as $key => $value) {
		$incoming_array[$key] = $value;
	}
	if (array_key_exists("sip", $incoming_array)){
		header ("content-type: text/xml");
		$xml_output  = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
		$xml_output .= "<xml>\n"; 
		$xml_output .= "\t<canonical_name>flows_twitter</canonical_name>\n";
		$xml_output .= "\t<display_name>Twitter Test</display_name>\n";
		$xml_output .= "\t<version>2009/06/02</version>\n";
		$xml_output .= "\t<request_types>\n";
		$xml_output .= "\t\t<request_type>REST</request_type>\n";
		$xml_output .= "\t</request_types>\n";
		$xml_output .= "\t<response_types>\n";
		$xml_output .= "\t\t<response_type>XML</response_type>\n";
		$xml_output .= "\t\t<response_type>HTML</response_type>\n";
		$xml_output .= "\t</response_types>\n";
		$xml_output .= "\t<usage>
		This Flows component accepts REST requests and retrieves data from twitter component.
	</usage>\n";
	$xml_output  .=  "</xml>\n";
	echo $xml_output; 
	} else {
		// this gets some remote content
		$rss_file = "http://search.twitter.com/search.rss?q=%23localfoods";
		$rss_feed = simplexml_load_file( $rss_file );
		// end remote content
		if (array_key_exists("return_type", $incoming_array)){
			switch ($incoming_array["return_type"]) {
				case "xml":
					header ("content-type: text/xml");
					$xml_output  = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
					$xml_output .= "<xml>";
					foreach( $rss_feed->channel->item as $item ) {
					        $xml_output .=  "<title>" . htmlspecialchars($item->title) . "</title>\n";
					        $xml_output .=  "<description>" . htmlspecialchars($item->description) . "</description>\n";
					        $xml_output .=  "<pubDate>" . htmlspecialchars($item->pubDate) . "</pubDate>\n";
					}
					$xml_output .= "</xml>";
					echo $xml_output; 
					break;
				case "html":
					header('Content-Type: text/html; charset=iso-8859-1');
					$html_output = "<html><head></head><body>";
					$html_output .= "<h3>" . $rss_feed->channel->title . "</h3>";
					$html_output .=  '<p style="font:italic 9px Verdana;">';
					foreach( $rss_feed->channel->item as $item ) {
					        $html_output .=  "<b><a href=$item->link>$item->title</a></b><br>";
					        $html_output .=  "$item->description<br>";
					        $html_output .=  "<i>$item->pubDate</i><br><br>";
					}
					$html_output .=  "</p></body></html>";
					echo $html_output; 
					break;
			}
				
		}
	}
}


?>
