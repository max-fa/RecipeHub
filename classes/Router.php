<?php
require '..\routes.php';
require '..\engine.php';

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
			
		} else if(gettype($handler) === "string" ) {
			
			$file = dirname(__DIR__)  . $handler;
			self::render($file);
			
		}
		
	}
	
	public static function register($url,$handler) {

		$route = [];
		$route["url"] = $url;
		$route["handler"] = $handler;
		$route["protected"] = false;
		
		array_push(self::$routes,$route);
		
	}
	
	public static function expose($folder) {
		
		if( file_exists($folder) ) {
			
			array_push(self::$directories,$folder);
			
		} else {
			
			echo '4-0-Folder';
			
		}
		
		
	}
	
	public static function protect($url) {
		
		$no_match = true;
		$stored_url;
		
		foreach( self::$routes as &$route ) {
			
			$stored_url = $route["url"];
			
			if( $stored_url === $url ) {
				
				$no_match = false;
				$route["protected"] = true;
				
			}
			
		}
		unset($route);
		
		if( $no_match ) {
			
			throw new Exception("Can't protect route <b>$url</b>: route not registered");
			
		}
		
	}
	
	public static function run($uri) {
		
		$handler;
		$let_through;
		
		foreach( self::$routes as $route ) {
			
			$handler = $route["handler"];
			if( $route["url"] === $uri ) {
				
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
					exit;
					
				}
				
			}			
			
		}
		
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
		
	}
	
}

Router::run($_SERVER["REQUEST_URI"]);