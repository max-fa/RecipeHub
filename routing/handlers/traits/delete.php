<?php

function delete_trait_handler($request) {
	
	require '../db/pdo_connect.php';
	require '../db/traits/delete.php';
	$pdo = pdo_connect();
	
	if( $pdo ) {
		
		try {
			
			$pdo->prepare("DELETE FROM item_traits_mappings WHERE trait_id = :trait_id")->execute([":trait_id"=>$request["trait_id"]]);
			delete_trait($request["trait_id"],$pdo);
			
			echo json_encode([
				"success"=>true
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