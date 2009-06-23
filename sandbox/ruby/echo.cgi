#!/usr/bin/env ruby
require "cgi"

# cgi_request = CGI::new("html4")
cgi_request = CGI::new("html4")
params = cgi_request.params

# puts cgi_request['example']
# puts cgi_request.params['example']
# puts cgi_request.query_string

sipstring = <<MINE
<response>
<canonical_name>URL goes here</canonical_name>
<version>Unix timestamp goes here.</version>
<request_types>
	<request_type>REST</request_type>
</request_types>
<response_types>
	<response_type>XML</response_type>
	<response_type>HTML</response_type>
</response_types>
</response>
MINE


if  params.has_key? "sip"
	puts "Content-Type: text/xml"
	puts
	puts sipstring
else
	puts "Content-type: text/html"
	puts
	puts "Incoming params: "
	puts params.length
	puts "<br /><br />"
	params.each do |key, value|
		if key!="sip"
			puts key
			puts ' = '
			puts value
			puts "<br />\n"
		end
	end
end

