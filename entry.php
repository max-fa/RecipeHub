<?php
$dir;
$output;
$i;
switch( $_SERVER["REQUEST_URI"] ) {
	case "/":
		echo eval( file_get_contents("pages/index.html") );
		break;
		
	case "/css/":
		$dir = scandir("pages/css");
		$i = 0;
		$output = "<ul>";
		while( $i < count($dir) ) {
			if( $i >= 2 ) {
				$output .= "
					<li>$dir[$i]</li>
				";
			}
			$i++;
		}
		$output .= "</ul>";
		echo $output;
		break;
		
	case "/css":
		$dir = scandir("pages/css");
		$i = 0;
		$output = "<ul>";
		while( $i < count($dir) ) {
			if( $i >= 2 ) {
				$output .= "
					<li>$dir[$i]</li>
				";
			}
			$i++;
		}
		$output .= "</ul>";
		echo $output;		
		break;
		
	case "/css/loggedout.css":
		header("Content-type: text/css");
		readfile("pages/css/loggedout.css");
		break;
		
	case "/css/simplegrid.css":
		header("Content-type: text/css");
		readfile("pages/css/simplegrid.css");
		break;
		
	default:
		http_response_code(404);
		$old_template = file_get_contents("pages/404.html");
		echo str_replace("uri",$_SERVER["REQUEST_URI"],$old_template);
		break;
}