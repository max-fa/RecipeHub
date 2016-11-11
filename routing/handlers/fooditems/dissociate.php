<?php

function dissociate_item_handler($request) {
	
	require '../db/pdo_connect.php';
	require '../db/fooditems/get.php';
	require '../db/traits/get.php';
	$pdo = pdo_connect();
	
	if( $pdo ) {
		
		try {
			
			$statement = $pdo->prepare("DELETE FROM item_traits_mappings WHERE item_id = :item_id AND trait_id = :trait_id");
			$statement->bindValue(":item_id",$request["item_id"]);
			$statement->bindValue(":trait_id",$request["trait_id"]);
			
			$statement->execute();
			
			echo json_encode([
				"success"=>true,
				"fooditem"=>fooditems_get(["item_id"=>$request["item_id"]], $pdo),
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