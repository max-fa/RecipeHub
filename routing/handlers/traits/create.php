<?php

function create_trait_handler($request) {
	
	require '../db/pdo_connect.php';
	require '../db/traits/create.php';
	require '../db/traits/get.php';
	$pdo = pdo_connect();
	
	if( $pdo ) {
		
		try {
			
			unset($request["action"]);
			create_trait($request,$pdo);
			
			echo json_encode([
				"success"=>true,
				"trait"=>traits_get(["trait_id"=>$pdo->lastInsertId("traits_id_seq")], $pdo)
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