<html>
<head>
<script type="text/javascript">
// --------------------------------------------------------------------------
// function for fixing html chars in url's
// --------------------------------------------------------------------------
function HTMLEncode(str){
	var result = '';
	for(var i=0; i<str.length; i++){
		result += '&#' + str.charCodeAt(i) + ';';
	}
	return result;
}

// --------------------------------------------------------------------------
// onreadystatechange function
// --------------------------------------------------------------------------
function checkReadystate() {
	//  see if the complete flag is set.
	if (AJAX.readyState==4 || AJAX.readyState=="complete") {
		// Pass the response to our processing function
		callback(AJAX.responseText, AJAX.status);
	}
}

// --------------------------------------------------------------------------
// Called automatically when we get data back from server
// --------------------------------------------------------------------------
function callback(serverData, serverStatus) {
	document.getElementById('serverStatus').innerHTML = serverStatus;
	document.getElementById('result').innerHTML = HTMLEncode(serverData);
}

// --------------------------------------------------------------------------
// the actual ajax doodiddly
// --------------------------------------------------------------------------
function ajaxRequest(url,method) {
	// Initialize the AJAX variable.
	var AJAX = null;											
	// Does this browser have an XMLHttpRequest object?
	if (window.XMLHttpRequest) {
		// Yes -- initialize it.
		AJAX=new XMLHttpRequest();
	// No, try to initialize it IE style
	} else {
		//  Wheee, ActiveX, how do we format c: again?
		AJAX=new ActiveXObject("Microsoft.XMLHTTP");
	}
	// End setup Ajax.
	// If we couldn't initialize Ajax...
	if (AJAX==null) {
		alert("Your browser doesn't support AJAX.");															  
		// Return false, couldn't set up ajax
		return false
	}
	// When the browser has the request info check state
	AJAX.onreadystatechange = function() {
	 	if (AJAX.readyState==4 || AJAX.readyState=="complete") {
		// Pass the response to our processing function
		callback(AJAX.responseText, AJAX.status);
		}
	}
	// Open the url this object was set-up with.
	AJAX.open(method, url, true);
	// http.open("GET",url+"?"+params, true);
	// http.open("POST", url, true);

	// Send the request.
	AJAX.send(null);
}

function ajaxProcess(method){
	var url = document.getElementById('url').value;
	var querystring = document.getElementById('querystring').value;
	var fullurl = url + querystring;
	ajaxRequest(fullurl, method);
}

// --------------------------------------------------------------------------
// update internal application fields
// --------------------------------------------------------------------------
function urlUpdate(){
	var url = document.getElementById('url').value;
	var querystring = document.getElementById('querystring').value;
	var fullurl = url + querystring;
	var href = '<a href="' + fullurl + '">' + fullurl + '</a>';
	document.getElementById('combinedURL').innerHTML = href;
}
</script>
<style>
legend {
	font-weight: bold;
}
h2 {
	text-align: center;
}
#application {
	margin-left: 20px;
	margin-right: 20px;
}
</style>
</head>
<body style="background-color: #eeeeee;" onLoad="urlUpdate()">
	<div id="application">
		<h2>Flows component-testing application:</h3>
		<fieldset>
			<legend>Flows Component: </legend>
			<fieldset>
				<legend>URL of Flows Component: (type in "http://" at the beginning)</legend>
				<form method="get" action="">
					<input type="text" id="url" name="url" size="100" onblur="urlUpdate();" />
				</form>
			</fieldset>
			<fieldset>
				<legend>QueryString (type in the "?" at the beginning): </legend>
				<form method="get" action="">
					<input type="text" id="querystring" name="querystring" size="100" onblur="urlUpdate();" /> 
				</form>
			</fieldset>
			<fieldset>
				<legend>Combined Flows URL:</legend>
				<div id="combinedURL">&nbsp;</div>
				<br />
				<input type="button" value="GET" onClick="ajaxProcess('GET')" />
			</fieldset>
		</fieldset>
		<br />
		<br />
		<fieldset>
			<legend>Response:</legend>
			<fieldset>
				<legend>HTTP Status header returned by server:</legend>
				<div id="serverStatus">&nbsp;</div>
			</fieldset>
			<fieldset>
				<legend>Response returned from Flows component:</legend>
				<pre id="result"></pre>
			</fieldset>
		</fieldset>
	</div>
</body>
</html>

