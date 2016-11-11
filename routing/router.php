<?php

$request_handler_mappings = [];

function register_route($uri,callable $handler,$method) {
	
	global $request_handler_mappings;
	
	array_push( $request_handler_mappings,[ "uri"=>$uri,"method"=>$method,"handler"=>$handler ] );
	
}

require 'routes.php';
require 'routing_functions.php';

function run() {
	
	global $request_handler_mappings;
	$request = [
	"uri"=>$_SERVER["REQUEST_URI"],
	"method"=>$_SERVER["REQUEST_METHOD"]
	];
	$matched = false;
	
	if( strpos($request["uri"],"?") ) {
		
		$dequeried_uri = remove_query_string($request["uri"]);
		
	} else {
		
		$dequeried_uri = $request["uri"];
		
	}
	
	foreach( $request_handler_mappings as $route ) {
		
		if( $dequeried_uri === $route["uri"] || $dequeried_uri === $route["uri"] . "/" ) {
			
			if( $request["method"] === strtoupper($route["method"]) || $route["method"] === "*" ) {
				
				if( $request["method"] === "GET" ) {
					
					$matched = true;
					$route["handler"]($_GET);
					
				} else {
					
					$matched = true;
					$route["handler"]( json_decode(file_get_contents("php://input"),true ) );
					
				}
				
			}
			
		}
		
	}

	if( !$matched ) {
		
		echo '404';
		
	}
	
}
run();