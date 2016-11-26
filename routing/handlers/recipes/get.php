<?php
require '../db/pdo_connect.php';
require '../db/recipes/get.php';

function get_one_recipe($request) {
	
	$pdo = pdo_connect();
	
	if( $pdo ) {
		
		try {
			
			echo json_encode([
				"success"=>true,
				"recipe"=>recipes_get([ "recipe_id"=>$request["recipe_id"] ],$pdo)
			]);
			
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



function get_many_recipes($request) {
	
	$pdo = pdo_connect();
	
	if( $pdo ) {
		
		try {
			
			echo json_encode([
				"success"=>true,
				"recipes"=>recipes_get([],$pdo)
			]);
			
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