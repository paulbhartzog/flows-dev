#! /usr/bin/env python
import cgi
import cgitb
import urlparse
import urllib
import os

# output errors while coding
import cgitb
cgitb.enable()

# for self info
me = urlparse.urlunparse(("http", os.environ["HTTP_HOST"], os.environ["SCRIPT_NAME"], "", "", ""))
version = "1245722271" # a unix timestamp

# sip response in XML
def sip_xml_response():
	return '''
	<response>
	<canonical_name>''' + me + '''</canonical_name>
	<version>''' + version + '''</version>
	<request_types>
		<request_type>REST</request_type>
	</request_types>
	<response_types>
		<response_type>XML</response_type>
		<response_type>HTML</response_type>
	</response_types>
	</response>
	'''

# see if there is any additional information coming in on the HTTP GET request
fields = cgi.FieldStorage()

# get querystring from URL
querystring = os.environ['QUERY_STRING']
escaped_querystring = cgi.escape(querystring)

# if there is NOT any additional information coming in on the HTTP GET request
# return the same response as you would if the HTTP GET request was a sip.

if (querystring == ""):
	print "Content-Type: text/xml\n\n"
	print sip_xml_response()

# if there IS incoming GET information then
else:
	# if the incoming GET information is a sip
	# return the sip response.
	# The standard Flows format for the default sip response is XML
	if (querystring == "sip"):
		print "Content-Type: text/xml\n\n"
		print sip_xml_response()
	# if the incoming GET information is NOT a sip then
	else:
		# check for response_type
		if fields.has_key("response_type"):
			if (fields["response_type"].value=="html"):
				print "Content-Type: text/html\n\n"
				print escaped_querystring
			if (fields["response_type"].value=="xml"):
				print "Content-Type: text/xml\n\n"
				print "<response><querystring>" + escaped_querystring + "</querystring></response>"
		# otherwise assume response_type is XML
		else:
				print "Content-Type: text/xml\n\n"
				print "<response><querystring>" + escaped_querystring + "</querystring></response>"
		




	



