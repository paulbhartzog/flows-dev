<?php
if($_GET) {
	$url = $_GET['url'];
	echo file_get_contents($url);
}
?>
