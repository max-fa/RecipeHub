<?php

function update_item_handler($request) {
	
	require '../db/pdo_connect.php';
	require '../db/fooditems/update.php';
	require '../db/fooditems/get.php';
	$pdo = pdo_connect();
	$updates;
	
	if( $pdo ) {
		
		try {
			
			$updates = array_filter($request,function($key) {
				
				$valid = ["name","description"];
				
				if( !in_array($key,$valid) ) {
					
					return false;
					
				} else {
					
					return true;
					
				}
				
			},ARRAY_FILTER_USE_KEY);
			
			update_fooditem($request["item_id"],$updates,$pdo);
			
			echo json_encode([
				"success"=>true,
				"fooditem"=>fooditems_get(["item_id"=>$request["item_id"]], $pdo)
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