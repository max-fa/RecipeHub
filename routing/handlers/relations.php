<?php
function fetch_relations() {
	
	require '../db/pdo_connect.php';
	$pdo = pdo_connect();

	if( $pdo ) {
		
		try {
			
			$statement = $pdo->prepare("SELECT * FROM item_traits_mappings");
			if( $statement->execute() ) {
				
				echo json_encode([
					"success"=>true,
					"relations"=>$statement->fetchAll(PDO::FETCH_ASSOC)
				]);
				
			} else {
				
				http_response_code(500);
				echo json_encode([
					"success"=>false,
					"why"=>"Couldn't fetch relations"
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
			"why"=>"Couldn't connect to database"
		]);
		
	}
	
}
