<?php
require '../db/fooditems/get.php';
require '../db/traits/get.php';
require '../db/pdo_connect.php';

function get_one_item($request) {
	
	$pdo = pdo_connect();
	
	if( $pdo ) {
		
		try {
			
			echo json_encode([
				"success"=>true,
				"fooditem"=>fooditems_get($request,$pdo)
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



function get_all_items($request) {
	
	$pdo = pdo_connect();
	
	if( $pdo ) {
		
		try {
			
			echo json_encode([
				"success"=>true,
				"fooditems"=>fooditems_get($request,$pdo)
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



function get_item_traits($request) {
	
	$pdo = pdo_connect();
	$foods;
	$traits;
	$item_names;
	
	if( $pdo ) {
		
		try {
			
			if( isset($request["names"]) ) {
				
				$item_names = explode(",",$request["names"]);
				$foods = fooditems_get_array_from_names($item_names,$pdo);
				$traits = traits_from_fooditems($foods,$pdo);
				
				echo json_encode([
					"success"=>true,
					"traits"=>$traits
				]);
				
			} else {
				
				$traits = traits_from_fooditem($request["item_id"],$pdo);
				
				echo json_encode([
					"success"=>true,
					"traits"=>$traits
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