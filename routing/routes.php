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
	
	header('Content-type:application/json;charset:utf-8');
	require 'handlers/fooditems/get.php';
	
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
			
			get_one_item($request);
			
			break;
			
		case "many":
			
			unset($request["item_id"]);
			get_all_items($request);
			
			break;
			
		default:
			
			http_response_code(400);
			echo json_encode([
				"success"=>false,
				"why"=>"You don't want that!"
			]);
			
			break;
		
	}
	
},"GET");



register_route("/fooditems",function($request) {
	
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
			
			require 'handlers/fooditems/create.php';
			create_item_handler($request);
			
			break;
			
		case "update":
			
			require 'handlers/fooditems/update.php';
			update_item_handler($request);
			
			break;
			
		case "associate":
			
			require 'handlers/fooditems/associate.php';
			associate_item_handler($request);
			
			break;
			
		case "dissociate":
			
			require 'handlers/fooditems/dissociate.php';
			dissociate_item_handler($request);
			
			break;
			
		default:
			
			http_response_code(400);
			echo json_encode([
				"success"=>false,
				"why"=>"You don't want that!"
			]);
			
			break;
		
	}
	
},"POST");



register_route("/fooditems",function($request) {
	
	header('Content-type:application/json;charset:utf-8');
	require 'handlers/fooditems/delete.php';
	delete_item_handler($request);
	
},"DELETE");



register_route("/traits",function($request) {
	
	header('Content-type:application/json;charset:utf-8');
	require 'handlers/traits/get.php';
	
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
			
			get_one_trait($request);
			
			break;
			
		case "many":
			
			unset($request["trait_id"]);
			get_all_traits($request);
			
			break;
			
		default:
			
			http_response_code(400);
			echo json_encode([
				"success"=>false,
				"why"=>"You don't want that!"
			]);
			
			break;
		
	}
	
},"GET");



register_route("/traits",function($request) {
	
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
			
			require 'handlers/traits/create.php';
			create_trait_handler($request);
			
			break;
			
		case "update":
			
			require 'handlers/traits/update.php';
			update_trait_handler($request);
			
			break;
			
		default:
			
			http_response_code(400);
			echo json_encode([
				"success"=>false,
				"why"=>"You don't want that!"
			]);
			
			break;
		
	}
	
},"POST");



register_route("/traits",function($request) {
	
	header('Content-type:application/json;charset:utf-8');
	require 'handlers/traits/delete.php';
	delete_trait_handler($request);
	
	
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