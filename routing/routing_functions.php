<?php

function remove_query_string($uri) {
	
	$end_index = strpos($uri,"?");
	return substr($uri,0,$end_index);
	
}



function explode_uri($uri) {
	
	$uri_parts = explode("/",$uri);
	//array_shift($uri_parts);
	//$route_identifier = isset( $route_parts[1] ) ? $route_parts[1] : null;
	
	return [
	"whole"=>$uri,
	"pieces"=>$uri_parts,
	"base"=>$uri_parts[1],
	"count"=>count($uri_parts)
	];
	
}