<?php
require '../db/traits/get.php';
require '../db/pdo_connect.php';

function get_one_trait($request) {
	
	$pdo = pdo_connect();
	
	if( $pdo ) {
		
		try {
			
			echo json_encode([
				"success"=>true,
				"trait"=>traits_get($request,$pdo)
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



function get_all_traits($request) {
	
	$pdo = pdo_connect();
	
	if( $pdo ) {
		
		try {
			
			echo json_encode([
				"success"=>true,
				"traits"=>traits_get($request,$pdo)
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