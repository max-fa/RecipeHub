<?php

$request_handler_mappings = [];

function register_route($path,callable $handler,$method) {
	
	global $request_handler_mappings;
	
	if( gettype($path) === "string" ) {
		
		if( isset($method) && gettype($method) === "string" ) {
			
			array_push( $request_handler_mappings,[ "path"=>$path,"method"=>$method,"handler"=>$handler ] );
			return true;
			
		} else {
			
			array_push( $request_handler_mappings,[ "path"=>$path,"method"=>"*","handler"=>$handler ] );
			return true;
			
		}		
		
	} else {
		
		return false;
		
	}
	
}

require 'routes.php';

function run() {
	
	global $request_handler_mappings;
	
	foreach( $request_handler_mappings as $route ) {

		if( $route["path"] === $_SERVER["REQUEST_URI"] ) {
			
			if( $route["method"] === $_SERVER["REQUEST_METHOD"] ) {
				
				$route["handler"]();	
				
			} else if( $route["method"] === "*" ) {
				
				$route["handler"]();
				
			}
			
		} else if( $route["path"] . "/" === $_SERVER["REQUEST_URI"] ) {
			
			$route["handler"]();
			
		}
		
	}	
	
}
run();