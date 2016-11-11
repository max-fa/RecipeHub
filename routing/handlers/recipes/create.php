<?php

function create_recipe_handler($request) {
	
	require '../db/pdo_connect.php';
	require '../db/recipes/create.php';
	require '../db/recipes/get.php';
	$pdo = pdo_connect();
	$recipe;
	
	if( $pdo ) {
		
		try {
			
			if( create_recipe($request,$pdo) ) {
				
				echo json_encode([
					"success"=>true,
					"recipe"=>recipes_get([
						"recipe_id"=>$pdo->lastInsertId("recipes_id_seq")
					],$pdo)
				]);
				
			} else {
				
				http_response_code(500);
				echo json_encode([
					"success"=>false,
					"why"=>"Database error"
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
		
		http_response_code(400);
		echo json_encode([
			"success"=>false,
			"why"=>"Could not connect to database"
		]);
		
	}
	
}