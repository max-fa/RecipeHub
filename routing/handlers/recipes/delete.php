<?php

function delete_recipe_handler($request) {
	
	require '../db/pdo_connect.php';
	require '../db/recipes/delete.php';
	$pdo = pdo_connect();
	
	if( $pdo ) {
		
		try {
			
			if( delete_recipe($request["recipe_id"],$pdo) ) {
				
				echo json_encode([
					"success"=>true
				]);
				
			} else {
				
				http_response_code(500);
				echo json_encode([
					"success"=>false,
					"why"=>"Da'fuck do i know?"
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
			"why"=>"Could no connect to database"
		]);
		
	}
	
}