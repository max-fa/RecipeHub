<?php

function update_recipe_handler($request) {
	
	require '../db/pdo_connect.php';
	require '../db/recipes/update.php';
	require '../db/recipes/get.php';
	$pdo = pdo_connect();
	$updates = array_filter($request,function($key) {
		
		$valid_keys = ["title","ingredients","instructions"];
		
		if( !in_array($key,$valid_keys) ) {
			
			return false;
			
		} else {
			
			return true;
			
		}
		
	},ARRAY_FILTER_USE_KEY);
	
	if( $pdo ) {
		
		try {
			
			if( update_recipe($request["recipe_id"],$updates,$pdo) ) {
				
				echo json_encode([
					"success"=>true,
					"recipe"=>recipes_get([ "recipe_id"=>$request["recipe_id"] ],$pdo )
				]);
				
			} else {
				
				http_response_code(500);
				echo json_encode([
					"success"=>false,
					"why"=>"Deep shit,man"
				]);
				
			}
			
		} catch( PDOException $e ) {
			
			http_response_code(500);
			echo json_encode([
				"success"=>false,
				"why"=>$e->getMessage()
			]);
			
		}
		
	} else {
		
		http_response_code(500);
		echo json_encode([
			"success"=>false,
			"why"=>"Could not connect to database"
		]);
		
	}
	
}