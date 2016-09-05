<?php
require 'functions.php';
require '..\routes.php';
require '..\engine.php';


//function_exists("find_route") ? var_dump("Y") : var_dump("N");

class Router {
	
	private static $routes = [];
	
	private static function render($file) {
		
		if( file_exists( $file ) ) {
			
			echo eval(file_get_contents($file));
			
		} else {
			
			echo "Error: file not found: <b>$file</b>";
			
		}
		
	}
	
	private static function handle($handler) {
		
		if( gettype($handler) === "object" ) {
			
			$handler();
			
		} else if( gettype($handler) === "string" ) {
			
			$file = dirname(__DIR__)  . $handler;
			self::render($file);
			
		}
		
	}
	
	public static function serve($url,$handler) {

		$route = [];
		$route["url"] = $url;
		$route["handler"] = $handler;
		$route["protected"] = false;
		
		array_push(self::$routes,$route);
		
	}
	
	public static function send_error($type,$uri) {
		
		switch( $type ) {
			
			case "noprotect":
				throw new Exception("Can't protect route <b>$url</b>: route not registered");
				break;
				
			case "404":
				echo "
			
					<!DOCTYPE html>
					<html>
						<head>
							<meta charset=\"utf-8\">
						</head>
						<body>
							<h1>404: Page not found.</h1>
							<p>
								No page at $uri.
							</p>
						</body>
					</html>
			
				";				
				break;
				
			default:
				//do nothing
				break;
			
		}
		
	}
	
	public static function protect($url) {
		
		$route;
		$index = find_route(self::$routes,"url",$url);
		
		$index !== false ? $route = &self::$routes[$index] : $route = false;
		
		$route !== false ? $route["protected"] = true : self::send_error("noprotect");
		
	}
	
	public static function run($uri) {
		
		$handler;
		$let_through;
		$route_index = find_route( self::$routes,"url",$uri );
		$route;
		
		if( $route_index !== false ) {
			
			$route = self::$routes[$route_index];
			$handler = $route["handler"];
			
			if( $route["protected"] ) {
				
				$let_through = Engine(0);
				
				if( $let_through === true ) {
					
					self::handle($handler);
					exit;
					
				} else {
					
					echo '
					
						<h1>FORBIDDEN!</h1>
					
					';
					exit;
					
				}				
				
			} else {
				
				self::handle($handler);
				
			}
			
		} else {
			
			self::send_error("404",$uri);
			
		}
		
	}
	
}

Router::run($_SERVER["REQUEST_URI"]);