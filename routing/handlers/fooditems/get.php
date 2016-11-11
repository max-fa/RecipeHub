<?php
require '../db/fooditems/get.php';
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