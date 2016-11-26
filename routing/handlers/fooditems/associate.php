<?php
require '../db/pdo_connect.php';
require '../db/fooditems/get.php';
require '../db/traits/get.php';
require '../db/item_mappings/get.php';

function associate_item_handler($request) {
	
	$pdo = pdo_connect();
	$updates;
	
	if( $pdo ) {
		
		try {
			
			$statement = $pdo->prepare("INSERT INTO item_traits_mappings (item_id,trait_id) VALUES(:item_id,:trait_id)");
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



function associate_many_handler($request) {
	
	$pdo = pdo_connect();
	$statement;
	$success;
	$trait_ids = explode(",",$request["traits"]);
	$mappings = [];
	
	if( $pdo ) {
		
		try {
			
			foreach( $trait_ids as $trait_id ) {
				
				$statement = $pdo->prepare("INSERT INTO item_traits_mappings (item_id,trait_id) VALUES(:item_id,:trait_id)");
				$statement->bindValue(":item_id",$request["item_id"]);
				$statement->bindValue(":trait_id",$trait_id);
				
				if( $statement->execute() ) {
					
					$success = true;
					array_push($mappings,get_mapping($request["item_id"],$trait_id,$pdo));
					
				} else {
					
					$success = false;
					
				}
				
			}
			
			if( $success ) {
				
				echo json_encode([
					"success"=>true,
					"fooditem"=>fooditems_get(["item_id"=>$request["item_id"]], $pdo),
					"mappings"=>$mappings
				]);
				
			} else {
				
				http_response_code(500);
				echo json_encode([
					"success"=>false,
					"why"=>"I don't know"
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
			"why"=>"Could not connect to database"
		]);
		
	}
	
}