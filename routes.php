<?php

register_route("/",function() {
	
	echo eval( file_get_contents("pages/index.html") );
	
},null);



register_route("/css",function() {
	
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
	
},null);



register_route("/css/loggedout.css",function() {
	
	header("Content-type: text/css");
	readfile("pages/css/loggedout.css");
	
},null);



register_route("/css/simplegrid.css",function() {
	
	header("Content-type: text/css");
	readfile("pages/css/simplegrid.css");
	
},null);