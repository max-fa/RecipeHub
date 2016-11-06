<?php

$request_handler_mappings = [];

function register_route($uri,callable $handler,$method) {
	
	global $request_handler_mappings;
	
	if( gettype($uri) === "string" ) {
		
		if( isset($method) && gettype($method) === "string" ) {
			
			array_push( $request_handler_mappings,[ "uri"=>$uri,"method"=>$method,"handler"=>$handler ] );
			return true;
			
		} else {
			
			array_push( $request_handler_mappings,[ "uri"=>$uri,"method"=>"*","handler"=>$handler ] );
			return true;
			
		}		
		
	} else {
		
		return false;
		
	}
	
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
	$request_uri;
	
	foreach( $request_handler_mappings as $route ) {
		
		if( $request["method"] === strtoupper($route["method"]) ) {
			
			if( has_query_params($request["uri"]) ) {
				
				$request_uri = basic_uri($request["uri"]);
				
				if( $request_uri === $route["uri"] || $request_uri === $route["uri"] . "/" ) {
					
					$matched = true;
					$route["handler"]($_GET);
					
				}
				
			} else {
				
				if( $request["uri"] === $route["uri"] || $request["uri"] === $route["uri"] . "/" ) {
					
					$matched = true;
					$route["handler"]( file_get_contents("php://input") );
					
				}
				
			}
			
		}
		
	}

	if( !$matched ) {
		
		echo '404';
		
	}
	
}
run();