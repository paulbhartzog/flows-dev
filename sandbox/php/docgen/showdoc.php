<?php
main();
function main(){

	// header
	// doc
	// code
	// actual source

	$filename = "example.php";
	$lines = file($filename);

	// doc
	$doc = "Documentation:\n\n\n";
	foreach ($lines as $line_num => $line) {
		$line_trimmed = trim($line);
		// identify comments section
		if (substr($line_trimmed, 0, 3) == "/**"){
		    // $doc .= "{$line_num}  |\t" . $line;
		}
		// identify comment lines
		if (substr($line_trimmed, 0, 2) == "* "){
			// identify headers
			if (substr($line_trimmed, 2, 1) == "$"){
				$reg = '/\$(.*)\$/s';
				preg_match($reg,$line_trimmed,$matches);
				$parts = explode(":", $matches[1]);
				$doc .= trim($parts[0]) . "\n";
				$doc .= trim($parts[1]) . "\n";
			}
		}
	}
	$doc .= "\n\n";

	// link to dl

	// code
	$code = "Code:\n\n\n";
	foreach ($lines as $line_num => $line) {
		if($line_num<10){
		    $code .= "{$line_num}  |\t" . $line;
		} else {
		    $code .= "{$line_num} |\t" . $line;
		}
	}

	// actual source
	$source = "Source:\n\n\n";
	foreach ($lines as $line_num => $line) {
		$source .= $line;
	}

	// header
	header ("content-type: text/plain");
	$output = $doc . $code . $source;
	print $output;
}

?>
