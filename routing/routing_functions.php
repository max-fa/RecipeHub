<?php
/*
	route["uri"]: /recipes/#id
	request uri: /recipes/25
*/
function has_query_params($uri) {
	
	if( strpos($uri,"?") ) {
		
		return true;
		
	} else {
		
		return false;
		
	}
	
}



function basic_uri($uri) {
	
	$end_index = strpos($uri,"?");
	return substr($uri,0,$end_index);
	
}



function explode_uri($uri) {
	
	$uri_parts = explode( "/",$uri);
	array_shift($uri_parts);
	//$route_identifier = isset( $route_parts[1] ) ? $route_parts[1] : null;
	
	return [
	"whole"=>$uri,
	"pieces"=>$uri_parts,
	"base"=>$uri_parts[0],
	"count"=>count($uri_parts)
	];
	
}