<?php

function update_trait_handler($request) {
	
	require '../db/pdo_connect.php';
	require '../db/traits/update.php';
	require '../db/traits/get.php';
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
			
			update_trait($request["trait_id"],$updates,$pdo);
			
			echo json_encode([
				"success"=>true,
				"trait"=>traits_get(["trait_id"=>$request["trait_id"]], $pdo)
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