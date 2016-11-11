<?php

register_route("/",function() {
	
	//require '../views/index.php';
	echo "Welcome";
	
},"*");


/* 
	Start: resource routes
*/


register_route("/recipes",function($request) {
	
	header('Content-type:application/json;charset:utf-8');
	
	if( !isset( $request["action"] ) ) {
		
		http_response_code(400);
		echo json_encode([
			"success"=>false,
			"why"=>"Tell us what you want!!"
		]);
		return;
		
	}
	
	switch( $request["action"] ) {
		
		case "one":
			
			require 'handlers/recipes/get.php';
			get_one_recipe($request);
			
			break;
			
		case "many":
			
			require 'handlers/recipes/get.php';
			get_many_recipes($request);
			
			break;
			
		default:
			
			http_response_code(400);
			echo json_encode([
				"success"=>false,
				"why"=>"You don't want that!"
			]);
			
			break;
		
	}
	
},"GET",false);



register_route("/recipes",function($request) {
	
	header('Content-type:application/json;charset:utf-8');
	
	if( !isset( $request["action"] ) ) {
		
		http_response_code(400);
		echo json_encode([
			"success"=>false,
			"why"=>"Tell us what you want!!"
		]);
		return;
		
	}
	
	switch( $request["action"] ) {
		
		case "create":
			require 'handlers/recipes/create.php';
			create_recipe_handler($request);
			break;
		
		case "update":
			require 'handlers/recipes/update.php';
			update_recipe_handler($request);
			break;
			
		default:
			
			http_response_code(400);
			echo json_encode([
				"success"=>false,
				"why"=>"You don't want that"
			]);
			
			break;
		
	}
	
},"POST");



register_route("/recipes",function($request) {
	
	require 'handlers/recipes/delete.php';
	header('Content-type:applications/json;charset=utf-8');
	delete_recipe_handler($request);
	
},"DELETE");



register_route("/fooditems",function($request) {
	
	if( $request["action"] === "one" ) {
		
		
		
	} else if( $request["action"] === "from_user" ) {
		
		
		
	} else {
		
		/* Bad Request */
		
	}
	
},"GET");



register_route("/fooditems",function($request) {
	
	switch( $request["action"] ) {
		
		case "create":
			
			break;
			
		case "update":
			
			break;
			
		case "associate":
			
			break;
			
		case "dissociate":
			
			break;
			
		default:
			/* Bad Request */
			break;
		
	}
	
},"POST");



register_route("/fooditems",function($request) {
	
	
	
},"DELETE");



register_route("/traits",function($request) {
	
	if( $request["action"] === "one" ) {
		
		
		
	} else if( $request["action"] === "from_user" ) {
		
		
		
	} else {
		
		/* Bad Request */
		
	}
	
},"GET");



register_route("/traits",function($request) {
	
	if( $request["action"] === "create" ) {
		
		
		
	} else if( $request["action"] === "update" ) {
		
		
		
	} else {
		
		/* Bad Request */
		
	}
	
},"POST");



register_route("/traits",function($request) {
	
	
	
},"DELETE");

/* 
	End: resource routes
*/

register_route("/css",function() {
	
	$dir = scandir("../views/css");
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
	readfile("../views/css/loggedout.css");
	
},null);



register_route("/css/simplegrid.css",function() {
	
	header("Content-type: text/css");
	readfile("../views/css/simplegrid.css");
	
},null);