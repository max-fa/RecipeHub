<?php


function register_route($path,callable $handler,$method) {
	
	
	if( gettype($path) === "string" ) {
		
		if( isset($method) && gettype($method) === "string" ) {
			
			return true;
			
		} else {
			
			return true;
			
		}		
		
	} else {
		
		return false;
		
	}
	
}

require 'routes.php';

function run() {
	
	

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
