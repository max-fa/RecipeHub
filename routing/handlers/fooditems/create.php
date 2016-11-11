<?php

function create_item_handler($request) {
	
	require '../db/pdo_connect.php';
	require '../db/fooditems/create.php';
	require '../db/fooditems/get.php';
	$pdo = pdo_connect();
	
	if( $pdo ) {
		
		try {
			
			unset($request["action"]);
			create_fooditem($request,$pdo);
			
			echo json_encode([
				"success"=>true,
				"fooditem"=>fooditems_get(["item_id"=>$pdo->lastInsertId("fooditems_id_seq")], $pdo)
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